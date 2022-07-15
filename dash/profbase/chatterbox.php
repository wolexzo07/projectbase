<?php
require_once("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && isset($_POST['chatme']) || !empty($_POST['chatme'])){
	
$message = ucfirst(strtolower(xp("message")));
$email = xp("email");
$name = strtolower(xp("name"));

$pid = xp("tid");
$ptoken = strtolower(xp("token"));

$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);

$ct = "t";  
  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  
  $os = xos();$br = xbr();$ip = xip();
  
  $token = sha1(xrands(30).DATE("His"));
  
  $refid = time().rand(50,500900222).xrands(10);
  
  $create = x_create("chatbox","
pid INT NOT NULL,
chattype ENUM('t','f') NOT NULL,
f_type VARCHAR(20) NOT NULL,
fsize DOUBLE NOT NULL,
ptoken TEXT NOT NULL,
email VARCHAR(100) NOT NULL,
comment TEXT NOT NULL,
time_stamp DATETIME NOT NULL,
timereal VARCHAR(50) NOT NULL,
status ENUM('no','yes') NOT NULL,
token TEXT NOT NULL,
os VARCHAR(100) NOT NULL,
br VARCHAR(220) NOT NULL,
ip VARCHAR(30) NOT NULL
			");

		if($create){
if(x_count("userdb","email='$user' AND status='active' LIMIT 1") > 0){
	
	if(x_count("projects","id='$pid' AND token='$ptoken' AND processing_status='active' LIMIT 1") > 0){
	
	x_insert("chattype,pid,ptoken,email,comment,time_stamp,timereal,status,token,os,br,ip","chatbox","'$ct','$pid','$ptoken','$email','$message','$time','$rtime','no','$token','$os','$br','$ip'","","Failed to post message");
		
		}else{
		echo "Project is not approved";
		}
		
		}else{
			echo "Invalid users";
}
		}else{
		echo "Failed to create table";
		}



}
?>
