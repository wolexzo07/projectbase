<?php
include("../finishit.php");
if(isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["token"]) && !empty($_POST["token"])){
	$id = xp("id");
	$token = xp("token");

	
	 $time = x_curtime("0","0");$rtime = x_curtime("0","1");
	
	if(x_count("projects","id='$id' AND token='$token' AND status='active' LIMIT 1") > 0){
	
foreach(x_select("status,bidded_status,owner","projects","id='$id' AND token='$token' AND status='active'","1","id") as $key){
	$status = $key["status"];
	$bstatus = $key["bidded_status"];
	$owner = $key["owner"];
	
	if(($status == "active") && ($bstatus == "inactive")){
		if(x_count("userdb","email='$owner' AND status='active' LIMIT 1") > 0){
			
		foreach(x_select("posted_job","userdb","email='$owner' AND status='active'","1","id") as $key){
			$pj = $key["posted_job"];
			$npj = $pj - 1;
			
			x_update("userdb","email='$owner' AND status='active'","posted_job='$npj'","0","0");
			
			x_del("projects","id='$id' AND token='$token'","Deleted","Failed");
			
			}
			
			}else{
				echo "<script>alert('Invalid Project owner!');</script>";
				}

		
		}else{
			echo "<script>alert('Failed to delete! Please contact admin');</script>";
			}
	
	}

		
	}else{
		echo "Invalid Project";
		} 
	
	}else{
		
		echo "Parameter missing!";
		
		}

?>
