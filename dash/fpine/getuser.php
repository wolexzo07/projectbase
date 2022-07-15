<?php
include("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
$user = xg("q");
$cu = x_curtime("0","1");
if(x_count("userdb","email LIKE '$user%' or name LIKE '$user%' LIMIT 5") > 0){
	
foreach(x_select("name,email,status,other_status","userdb","email LIKE '$user%' or name LIKE '$user%'","5","name") as $key){
	$user = $key["email"];
	$name = $key["name"];
	$status = $key["status"];
	$os = $key["other_status"];
	
	echo "<b>$name ($user)</b>-----$status-----$os<br/>";
	
	}

	}else{
		
		echo "No user called (<b>$user</b>) found at $cu";
		}

}
?>
