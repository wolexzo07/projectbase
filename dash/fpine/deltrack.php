<?php
include_once("../../finishit.php");
if(isset($_POST["id"]) && isset($_POST["token"])){
	$id = xp("id");
	$token = xp("token");
	
if(x_count("withdrawalbase","id='$id' AND token='$token' LIMIT 1") > 0){

	//x_update("withdrawalbase","id='$id' AND token='$token'","status='approved'","project approved!","Failed to approve!");
	//echo "Approved!";	
x_del("withdrawalbase","id='$id' AND token='$token'","Deleted","Failed");

	}else{

		echo "Invalid!";
		}
	
	}else{
echo "Parameter Missing";
		
		}


?>
