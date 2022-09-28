<?php
include_once("xe-library/xe-library74.php");
xstart("0");
if(x_validatepost("_token") && x_validatesession("XCAPE_HACKS")){
	 // xcape session hacks
	$xcapehacks = $_SESSION["XCAPE_HACKS"];
	
	if(!x_validatepost("$xcapehacks")){
		finish("login","Error:: Parameter was modified!.");
	}
	// Controlled google captcha
	if(x_count("control_captcha","status='1'") > 0){
		$secret = "6LcDo1sUAAAAAOF0Nwyg-jvChfPqH_w7s7YVNnn0";
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
	 $email = xp("email");
	 $salt = "ABCDEFGHIJKKLMNOPQ1234567890abcghdtuwioalkjsnh?@"; 
	 $pass = xp("pass");
	 $hash = md5(sha1($pass).$salt).sha1(sha1($pass).$salt);
	 $time = x_curtime("0","0");
	 $rtime = x_curtime("0","1");
	 $tok = sha1(uniqid().xrands(10).Date("His"));
		
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
			if(x_count("userdb","email='$email' AND pass='$hash' AND status='inactive' OR mobile='$email' AND pass='$hash' AND status='inactive' LIMIT 1") > 0){
				echo "<p class='hubmsg'>Please confirm your email!</p>";
				exit();
				}
			if(x_count("userdb","email='$email' AND pass='$hash' AND status='active' OR mobile='$email' AND pass='$hash' AND status='active' LIMIT 1") > 0){
				
			x_update("userdb","email='$email' AND pass='$hash' AND status='active' OR mobile='$email' AND pass='$hash' AND status='active'","last_login='$time',last_login_r='$rtime'","0","0");

			foreach(x_select("0","userdb","email='$email' AND pass='$hash' AND status='active' OR mobile='$email' AND pass='$hash' AND status='active'","1","name") as $key){
				$id = $key["id"];
				$photo = $key["user_photo"];
				$name = $key["name"];
				$email = $key["email"];
				$mobile = $key["mobile"];
				$country = $key["country"];
				$state = $key["state"];
				$ll = $key["last_login_r"];
				$rt = $key["realtime"];
				$gen = $key["gender"];
				$pos = $key["position"];
				$skill = $key["skills"];
				$token = $key["token"];
				$bn = $key["bank_name"];
				$acn = $key["account_name"];
				$acnumb = $key["account_number"];
				
				$os = $key["os"];
				$br = $key["br"];
				$ip = $key["ip"];
				
				}
				
				$_SESSION["PBNG_OS_2018_VISION"] = $os;
				$_SESSION["PBNG_BR_2018_VISION"] = $br;
				$_SESSION["PBNG_IP_2018_VISION"] = $ip;
				$_SESSION["PBNG_ID_2018_VISION"] = $id;
				$_SESSION["PBNG_PHOTO_2018_VISION"] = $photo;
				$_SESSION["PBNG_NAME_2018_VISION"] = $name;
				$_SESSION["PBNG_EMAIL_2018_VISION"] = $email;
				$_SESSION["PBNG_MOBILE_2018_VISION"] = $mobile;
				$_SESSION["PBNG_COUNTRY_2018_VISION"] = $country;
				$_SESSION["PBNG_STATE_2018_VISION"] = $state;
				$_SESSION["PBNG_GENDER_2018_VISION"] = $gen;
				$_SESSION["PBNG_POSITION_2018_VISION"] = $pos;
				$_SESSION["PBNG_TOKEN_2018_VISION"] = $token;
				$_SESSION["PBNG_SKILL_2018_VISION"] = $skill;
				$_SESSION["PBNG_LL_2018_VISION"] = $ll;
				$_SESSION["PBNG_RT_2018_VISION"] = $rt;
				$_SESSION["PBNG_BN_2018_VISION"] = $bn;
				$_SESSION["PBNG_ACN_2018_VISION"] = $acn;
				$_SESSION["PBNG_ACNUMB_2018_VISION"] = $acnumb;
				xstart("1");
				#echo "session written";
				finish("dash?session_token=$xcapehacks","0");
				echo "<p class='hubmsg'>Login was successful!!!</p>";

			}else{
			echo "<p class='hubmsg'>Failed to login! Try again.</p>";
			}
				}else{
					echo "<p class='hubmsg'>Failed to create table!</p>";
				}

}else{
		//echo "<p class='hubmsg'>Invalid captcha!</p>";
		if(x_count("control_captcha","status='1'") > 0){
			finish("login","Invalid Captcha!Try again.");
		}else{
			finish("login","Invalid response!Try again.");
		}
	}
	
}else{
	echo "<p class='hubmsg'>Parameter missing!</p>";
}
?>
