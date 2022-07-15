<?php
include("../finishit.php");
if(isset($_POST["ptoken"]) && !empty($_POST["ptoken"]) && isset($_POST["pid"]) && !empty($_POST["pid"])){
	$ptoken = xp("ptoken");$pid = xp("pid");$owner = xp("owner");
	
	 $time = x_curtime("0","0");$rtime = x_curtime("0","1");
	 
	 if(x_count("projects","id='$pid' AND token='$ptoken' LIMIT 1") > 0){
		 
		foreach(x_select("ptitle,payment_status","projects","id='$pid' AND token='$ptoken'","1","id") as $key){
			
		$ptit = xup($key["ptitle"],"b");
		$pys = $key["payment_status"];
		if($pys == "inactive"){
			echo "<script>alert('You can not confirm a non-funded project')</script>";
			exit();
			}
		
		if(x_count("bidded","pid='$pid' AND status='approved' LIMIT 1") > 0){
		foreach(x_select("id,abstract_approval,bidder_email","bidded","pid='$pid' AND status='approved'","1","id") as $key){
		$abp = $key["abstract_approval"];
		$bidder = $key["bidder_email"];
		$bidid = $key["id"];
		
		if($abp != "confirmed"){

//send notification to the job bidder
foreach(x_select("name","userdb","email='$bidder'","1","id") as $key){
	$bname = $key["name"];
	
	x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','CONFIRMATION OF SUBMITTED PROJECT ABTRACT','$bidder','Congratulations <b>$bname ($bidder)</b>! The project abstract you submitted titled $ptit has been confirmed by the project owner.You can proceed with the real project work and get paid after completion','0','$rtime','$time'","","Failed to send notification");

	include_once("absmail.php");
			
	x_update("bidded","id='$bidid'","abstract_approval='confirmed'","0","confirmation Failed");
	echo "Confirmed";
	
	}

			}else{
				echo "Confirmed already!";
				}
		
		}
			 }else{
				 echo "Invalid approval!";
				 }
		}
		 

		 
		 
		 }else{
			 
			 echo "invalid project!";
			 
			 }
	
	}else{
		
		echo "Parameter missing!";
		
		}

?>
