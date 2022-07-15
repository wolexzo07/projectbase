<?php
require_once("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && isset($_POST['chatme']) || !empty($_POST['chatme'])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);

$pid = xg("pid");
$ptoken = xg("ptoken");


  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  
  $os = xos();$br = xbr();$ip = xip();
  
  $token = sha1(xrands(30).DATE("His"));
  
  $refid = time().rand(50,500900222).xrands(10);
  

if(x_count("userdb","email='$user' AND status='active' LIMIT 1") > 0){
	
	if(x_count("projects","id='$pid' AND token='$ptoken' AND processing_status='active' LIMIT 1") > 0){	
	foreach(x_select("","","","","","")){
		
	}
		
		}else{
		echo "Project is not approved";
		}
		
		}else{
			echo "Invalid user";
}
		



}
?>
