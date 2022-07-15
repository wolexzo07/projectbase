<?php
include_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
	
	if(x_count("enable_sub","status='1' LIMIT 1") > 0){
		//echo "Subscription enabled!";
		
		if(($_SESSION["PBNG_POSITION_2018_VISION"] == "student") || ($_SESSION["PBNG_POSITION_2018_VISION"] == "professional")){
	
$userb = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
$posi = x_clean($_SESSION["PBNG_POSITION_2018_VISION"]);
if(x_count("userdb","email='$userb' AND status='active' AND sub_status='active' LIMIT 1") > 0){
	foreach(x_select("sub_status,sub_date","userdb","email='$userb' AND status='active' AND sub_status='active'","1","id") as $key){
		$sub_status = $key["sub_status"];
		$sub_date = $key["sub_date"];
		
		//if hack is detected then block account and put on suspension
		if($sub_date == "0000-00-00 00:00:00"){
			x_update("userdb","email='$userb'","sub_status='inactive',sub_date='0000-00-00 00:00:00'","0","0");
			#echo "Hack detected! Account is now block";
		}else{
include_once("classes/develop_php_library.php");
// Create an object for the time conversion functions
$timeAgoObject = new convertToAgo; 
// Query your database here and get timestamp
$convertedTime = ($timeAgoObject -> convert_datetime($sub_date)); // Convert Date Time
$when = ($timeAgoObject -> makeAgo($convertedTime)); // Then convert to ago time
$get = ($timeAgoObject -> getdigit($convertedTime)); // Get the digit part of time
$nam = ($timeAgoObject -> getnam($convertedTime)); // Get the string part of time

if(x_count("exptime","type='$posi' LIMIT 1") > 0){
	foreach(x_select("digit,attach","exptime","type='$posi'","1","id") as $key){
		$digit = $key["digit"];
		$attach = $key["attach"];
		}
		
		if((($get >= $digit) && ($nam == $attach))){
			#block an expired subscription
			x_update("userdb","email='$userb'","sub_status='inactive',sub_date='0000-00-00 00:00:00'","0","0");
			
			#echo "Account suspended successfully";
		}else{
			/**
			echo "<h1>$posi account detected<br/>Subscription is still active ";
			echo $when;
			$cur = DATE("Y-m-d H:i:s");
			echo "<br/>Updated at $cur</h1>";
			**/

		}
		
}else{
		$digit = "Nil";
		$attach = "Nil";
}

		
		}
			
	}
}else{
	#echo "User does not exist";
}	
			

		
	}else{
		
	}
		
		
	}elseif(x_count("enable_sub","status='0' LIMIT 1") > 0){
		//echo "Subscription disabled!";
	}else{
		finish("logout","Hack detected on this account!");
	}
	


	
}

?>