<?php
include_once("../../finishit.php");
if(isset($_POST["id"]) && isset($_POST["token"])){
	$id = xp("id");
	$token = xp("token");
	
if(x_count("buy_sell","id='$id' AND token='$token' AND status='pending' LIMIT 1") > 0){
	
	foreach(x_select("filepath,abfilepath,sfilepath","buy_sell","id='$id' AND token='$token' AND status='pending'","1","id") as $key){
		$fp = "../".$key["filepath"];$abfp = "../".$key["abfilepath"];$sfp = "../".$key["sfilepath"];
	}
		if(file_exists($fp) && ($fp != "../")){
		unlink($fp);	
		}
		if(file_exists($abfp) && ($abfp != "../")){
		unlink($abfp);	
		}
		if(file_exists($sfp) && ($sfp != "../")){
		unlink($sfp);	
		}
		
	x_del("buy_sell","id='$id' AND token='$token' AND status='pending'","Deleted","Failed");
	
	}else{
echo "Invalid Request";
		}
	
	}else{
	
	echo "Missing Parameter";
		
		}


?>
