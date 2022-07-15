<?php
include_once("../../finishit.php");
if(isset($_POST["id"]) && isset($_POST["token"])){
	$id = xp("id");
	$token = xp("token");
	
if(x_count("withdrawalbase","id='$id' AND token='$token' LIMIT 1") > 0){

if(x_count("withdrawalbase","id='$id' AND token='$token' AND status='approved' LIMIT 1") > 0){
	echo "Already Approved";
}else{
	x_update("withdrawalbase","id='$id' AND token='$token'","status='approved'","project approved!","Failed to approve!");
	echo "Approved!";	
}

	}else{

		echo "Invalid!";
		}
	
	}else{
echo "Parameter Missing";
		
		}


?>
