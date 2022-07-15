<?php
include_once("../../finishit.php");
if(isset($_POST["id"]) && isset($_POST["token"])){
	$id = xp("id");
	$token = xp("token");
	
if(x_count("userdb","id='$id' AND token='$token' LIMIT 1") > 0){
	
	foreach(x_select("user_photo,test_photo,testt_photo","userdb","id='$id' AND token='$token'","1","id") as $key){
		$fp = "../../".$key["user_photo"];$abfp = "../../".$key["test_photo"];$sfp = "../../".$key["testt_photo"];
	}
		if(file_exists($fp) && ($fp != "../../")){
		unlink($fp);	
		}
		if(file_exists($abfp) && ($abfp != "../../")){
		unlink($abfp);	
		}
		if(file_exists($sfp) && ($sfp != "../../")){
		unlink($sfp);	
		}
		
	x_del("userdb","id='$id' AND token='$token'","Deleted","Failed");
	
	}else{
echo "Invalid Request";
		}
	
	}else{
	
	echo "Missing Parameter";
		
		}


?>
