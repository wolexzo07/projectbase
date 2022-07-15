<!---<html>
<head>
<title>Projectbase.app</title>
<link rel="stylesheet" href="appbase.css" type="text/css"/>
</head>
<body class="bod">

<div class="proj1"></div>
<div class="proj2">
</div>
<div class="proj3"></div>

</body>

</html>
--->
<?php

include_once("headconnect.php");
include_once("../finishit.php");
xstart("0");
if(isset($_GET["blessme"]) || !empty($_GET["blessme"])){

$fullname = xg("full");$pos = xg("pos");$email = xgmail("email");
$salt = "ABCDEFGHIJKKLMNOPQ1234567890abcghdtuwioalkjsnh?@";
 $pass = xg("pass");$hash = md5(sha1($pass).$salt).sha1(sha1($pass).$salt);

 $ref = "";

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xg("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
 
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
	position ENUM('student','professional','marketer') NOT NULL, 
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
echo "<h2 class='hubmsg'>Email already used!</h2>";
}else{

if(x_count("signup_activation","status='1' LIMIT 1") > 0){
include_once("../usermail.php");
x_insert("pin,status,name,email,pass,token,timest,realtime,os,br,ip,position,ref","userdb","'$pin','inactive','$fullname','$email','$hash','$tok','$time','$rtime','$os','$br','$ip','$pos','$ref'","<h2 class='hubmsg'>Registration successful! Check email to activate account.</h2>","<h2 class='hubmsg'>Failed to register.</h2>");
}else{

x_insert("pin,status,name,email,pass,token,timest,realtime,os,br,ip,position,ref","userdb","'$pin','active','$fullname','$email','$hash','$tok','$time','$rtime','$os','$br','$ip','$pos','$ref'","<h2 class='hubmsg'>Registration successful!</h2>","<h2 class='hubmsg'>Failed to register.</h2>");

}


}
	}else{
		echo "<h2 class='hubmsg'>Failed to create table!</h2>";
	}

}else{
	echo "<h2 class='hubmsg'>Parameter missing!</h2>";
}
include_once("footconnect.php");
?>

