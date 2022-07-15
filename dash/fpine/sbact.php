<?php
include("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
$user = xp("email");
$cat = xp("cat");
$reason = xp("reason");
$cu = x_curtime("0","1");
if(x_count("userdb","email='$user' LIMIT 1") > 0){
	
	if(($cat == "active") || ($cat == "inactive")){
		x_update("userdb","email='$user'","status='$cat'","0","0");
		echo "Operation performed successfully for $user at $cu";
		}else{
			x_update("userdb","email='$user'","os_reason='$reason',other_status='$cat'","0","0");
			echo "Operation performed successfully for $user at $cu";
			}

	}else{
		
		echo "No user called (<b>$user</b>) found at $cu";
		}

}
?>
