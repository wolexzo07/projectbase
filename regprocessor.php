<?php
include_once("xe-library/xe-library74.php");
include_once("siteinfo.php");
xstart("0");
if(x_validatepost("_token") && x_validatesession("XCAPE_HACKS")){

	 // xcape session hacks
	$xcapehacks = $_SESSION["XCAPE_HACKS"];
	
	if(!x_validatepost("$xcapehacks")){
		finish("login","Error:: Parameter was modified!.");
	}
	// Controlled google captcha
	if(x_count("control_captcha","status='1'") > 0){
		$secret = "$gsecret";
		$gpost = xp("g-recaptcha-response");
		$params = array(
				   "secret" => $secret,
				   "response" => $gpost
					);
		$result = x_google("https://www.google.com/recaptcha/api/siteverify",$params);
		$response = $result['success'];
	}else{
		$response = "ok";	
	}

		
 if($response){
	 
 $fullname = xp("full");$pos = xp("pos");$email = xpmail("email");
 $salt = "ABCDEFGHIJKKLMNOPQ1234567890abcghdtuwioalkjsnh?@";
 $pass = xp("pass");$hash = md5(sha1($pass).$salt).sha1(sha1($pass).$salt);

 $ref = xpp("ref");

 $checkterms = xp("checkterms");

		  
		  if($checkterms != "Yes"){
			  echo "<p class='hubmsg'>Sorry! You must accept our terms of use</p>";
			  exit();
			  }

 
 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
 
 $time = x_curtime("0","0");$rtime = x_curtime("0","1");
 
 $tok = "pbng_".sha1(uniqid().xrands(10).$email.Date("His"));
 $token = sha1($email.uniqid().xrands(10).Date("His"))."_";
 	 
$create = x_create("userdb","
	verify ENUM('no','yes') NOT NULL,
	id_type ENUM('intl. passport','Drivers License','Voters Card','National ID Card') NOT NULL,
	wallet_balance DOUBLE NOT NULL,
	sub_status ENUM('inactive','active') NOT NULL,
	sub_date DATETIME NOT NULL,
	user_photo TEXT NOT NULL,
	test_photo TEXT NOT NULL,
	testt_photo TEXT NOT NULL, 
	status ENUM('active','inactive') NOT NULL, 
	name VARCHAR(220) NOT NULL,
	gender ENUM('male','female') NOT NULL, 
	position ENUM('student','professional') NOT NULL, 
	email VARCHAR(150) NOT NULL, 
	pass TEXT NOT NULL,
	pin TEXT NOT NULL,	
	ref VARCHAR(100) NOT NULL, 
	skills TEXT NOT NULL, 
	school VARCHAR(230) NOT NULL, 
	medium VARCHAR(230) NOT NULL, 
	mobile VARCHAR(150) NOT NULL,
	country VARCHAR(150) NOT NULL, 
	state VARCHAR(150) NOT NULL, 
	account_name VARCHAR(220) NOT NULL,
	account_number VARCHAR(220) NOT NULL,	
	bank_name VARCHAR(220) NOT NULL, 
	token TEXT NOT NULL, 
	timest DATETIME NOT NULL,
	realtime VARCHAR(100) NOT NULL,
	posted_job DOUBLE NOT NULL,
	bidded_job DOUBLE NOT NULL,
	approved_job DOUBLE NOT NULL,
	cancelled_job DOUBLE  NOT NULL,
	completed_job DOUBLE  NOT NULL,
	earned_job DOUBLE  NOT NULL,
	total_spent_onjob DOUBLE  NOT NULL,
	os VARCHAR(100) NOT NULL,
	br VARCHAR(220) NOT NULL,
	ip VARCHAR(30) NOT NULL,
	last_login DATETIME NOT NULL,
	last_login_r VARCHAR(220) NOT NULL
			");
			$os = xos();$br = xbr();$ip = xip();
if($create){
if(x_count("userdb","email='$email' LIMIT 1") > 0){
echo "<p class='hubmsg'>Email <b>$email</b> already used!</p>";
}else{

if(x_count("signup_activation","status='1' LIMIT 1") > 0){
include_once("usermail.php");
x_insert("pin,status,name,email,pass,token,timest,realtime,os,br,ip,position,ref","userdb","'$pin','inactive','$fullname','$email','$hash','$tok','$time','$rtime','$os','$br','$ip','$pos','$ref'","<script>window.location='finalize_it';</script>","Failed to submit data.");
}else{

x_insert("pin,status,name,email,pass,token,timest,realtime,os,br,ip,position,ref","userdb","'$pin','active','$fullname','$email','$hash','$tok','$time','$rtime','$os','$br','$ip','$pos','$ref'","<script>window.location='finalize_it';</script>","Failed to submit data.");

}


}
	}else{
		echo "<p class='hubmsg'>Failed to create table!</p>";
	}
	

}else{
		//echo "<p class='hubmsg'>Invalid captcha! Please try another captcha</p>";
		if(x_count("control_captcha","status='1'") > 0){
			finish("login","Invalid Captcha!Try again.");
		}else{
			finish("login","Invalid response!Try again.");
		}
	}
	
	
}else{
	echo "<p class='hubmsg'>Parameter missing!!...</p>";
}
?>
