<?php
require_once("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['write_post']) || !empty($_POST['write_post'])){
$category = xp("category");
$title = ucwords(strtoupper(xp("title")));
$amount = xp("amount");
$pdes = ucwords(strtoupper(xp("pdes")));
$from = xp("from");
$to = xp("to");
$currency = xp("curr");
$email = xp("email");
 $time = x_curtime("0","0");$rtime = x_curtime("0","1");

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);

 $tok = sha1(xrands(30).DATE("His"));
 $create = x_dbtab("projects","
owner VARCHAR(100) NOT NULL,
pcategory VARCHAR(220) NOT NULL,
ptitle VARCHAR(220) NOT NULL,
pdes TEXT NOT NULL,
time_from DATE NOT NULL,
time_to DATE NOT NULL,
status ENUM('active','inactive') NOT NULL,
amount_to_pay DOUBLE NOT NULL,
amount_currency VARCHAR(20) NOT NULL,
bidded_status ENUM('inactive','active') NOT NULL,
processing_status ENUM('inactive','active') NOT NULL,
completion_status ENUM('inactive','active') NOT NULL,
payment_status ENUM('inactive','active') NOT NULL,
payment_amount DOUBLE NOT NULL,
payment_currency VARCHAR(50) NOT NULL,
bidcount INT NOT NULL,
status_reason TEXT NOT NULL,
completion_reason TEXT NOT NULL,
os VARCHAR(100) NOT NULL,
br VARCHAR(220) NOT NULL,
ip VARCHAR(30) NOT NULL,
time_stamp DATETIME NOT NULL,
timereal VARCHAR(100) NOT NULL,
token TEXT NOT NULL
			","MYISAM");
		$os = xos();$br = xbr();$ip = xip();
		if($create){
		if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){

	foreach(x_select("posted_job","userdb","email='$email' AND status='active'","1","name") as $key){
	$pj = $key["posted_job"];
	}
	$njob = $pj + 1;
	x_update("userdb","email='$email'","posted_job='$njob'","0","0");
	x_insert("owner,ptitle,pdes,pcategory,time_from,time_to,status,amount_to_pay,amount_currency,os,br,ip,time_stamp,timereal,token","projects","'$email','$title','$pdes','$category','$from','$to','inactive','$amount','$currency','$os','$br','$ip','$time','$rtime','$tok'","Success! Wait for approval in less than 48hr","Failed to upload project");

	
}else{
	echo "Incorrect Pin! Please provide valid pin";
}
		}else{
		echo "Failed to create table in the database";
		}
 



}
?>
