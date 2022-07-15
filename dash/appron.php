<?php
include("../finishit.php");
if(isset($_POST["bidid"]) && !empty($_POST["bidid"]) && isset($_POST["pid"]) && !empty($_POST["pid"])){
	$bidid = xp("bidid");
	$pid = xp("pid");
	$bidder = xp("bidder");
	$owner = xp("owner");
	
	 $time = x_curtime("0","0");$rtime = x_curtime("0","1");
	
				
	//checking to know if a professional can undertake more than one job at a time
	
	if(x_count("bidmore","status='yes' AND id='1' LIMIT 1") > 0){
		
		//bidmore true
		
		}else{
					
			//checking that the proffessional finished all the pending projects
		if(x_count("projects","approved_to='$bidder' AND processing_status='active' AND completion_status='inactive' AND bidded_status='active' LIMIT 1") > 0){
				echo "<script>alert('Sorry! this user has a pending Job.Approve it to another user if you have more biddings')</script>";
				exit();
				}
				//checking that the proffessional finished all the pending projects ended	
			
			}	
	//checking to know if a professional can undertake more than one job at a time
	
	if(x_count("projects","id='$pid' AND processing_status='inactive' LIMIT 1") > 0){
		
		if(x_count("bidded","id='$bidid' LIMIT 1") > 0){
			
	foreach(x_select("approved_job,name","userdb","email='$bidder' AND status='active'","1","name") as $key){
	$appjob = $key["approved_job"];
	$appname = $key["name"];
	}
	
	$bcount = $appjob + 1;
	
	foreach(x_select("approved_job","userdb","email='$owner' AND status='active'","1","name") as $key){
	$appjobb = $key["approved_job"];
	}
	
	$owcount = $appjobb + 1;
	
x_update("userdb","email='$bidder'","approved_job='$bcount'","0","0");

x_update("userdb","email='$owner'","approved_job='$owcount'","0","0");

x_update("projects","id='$pid'","processing_status='active',bidded_status='active',approved_to='$bidder'","0","0");

x_update("bidded","id='$bidid'","approved_date='$time',appr_date='$rtime',status='approved'","0","0");

foreach(x_select("ptitle","projects","id='$pid'","1","id") as $key){
	$ptitl = xup($key["ptitle"],"b");
	
// sending notification to client
x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','JOB YOU BIDDED IS NOW APPROVED','$bidder','Congratulations <b>$appname</b>! Job you bidded for titled $ptitl is now approved successfully.Please make you sure you meet up with the time frame to get paid','0','$rtime','$time'","","Failed to send notification");

 include_once("jobappr_mail.php");

		echo "Job Approved";
	}

		}else{
			echo "Invalid bidding!";
			}
		
}elseif(x_count("projects","id='$pid' AND processing_status='active' LIMIT 1") > 0){
	echo "Already approved";
	}else{
		echo "Project does not exist";
		} 
	
	}else{
		
		echo "Parameter missing!";
		
		}

?>
