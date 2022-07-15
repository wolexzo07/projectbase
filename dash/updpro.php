<?php
include("../finishit.php");
if(isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["token"]) && !empty($_POST["token"])){
	$id = xp("id");
	$token = xp("token");

	
	 $time = x_curtime("0","0");$rtime = x_curtime("0","1");
	
	if(x_count("projects","id='$id' AND token='$token' AND status='active' LIMIT 1") > 0){
	
foreach(x_select("status,bidded_status,processing_status,payment_status,completion_status","projects","id='$id' AND token='$token' AND status='active'","1","id") as $key){
	$status = $key["status"];
	$bstatus = $key["bidded_status"];
	$pstatus = $key["processing_status"];
	$paystatus = $key["payment_status"];
	$cstatus = $key["completion_status"];
	
	if(($pstatus == "active") || ($paystatus == "active") || ($cstatus == "active")){
		
		echo "<script>alert('You can not update an approved Job! Please contact admin');</script>";
		
		}else{
			$title = xp("title");
			$amt = xp("amount");
			$des = xp("des");
			$tf = xp("timefrom");
			$tt = xp("timeto");
			
			x_update("projects","id='$id' AND token='$token'","pdes='$des',ptitle='$title',time_from='$tf',time_to='$tt',amount_to_pay='$amt'","0","0");
			echo "Project updated successfully!";
			
			
			}
	
	}

		
	}else{
		echo "Invalid Project";
		} 
	
	}else{
		
		echo "Parameter missing!";
		
		}

?>
