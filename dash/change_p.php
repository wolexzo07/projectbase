<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['changep']) || !empty($_POST['changep'])){
	
$old = xp("old");
$new = xp("new");
$neww = xp("neww");
$email = strtolower(xp("email"));

$salt = "ABCDEFGHIJKKLMNOPQ1234567890abcghdtuwioalkjsnh?@"; 
$pass = xp("new");
$hashnew = md5(sha1($pass).$salt).sha1(sha1($pass).$salt);
 
$pass_me = xp("old");
$hashold = md5(sha1($pass_me).$salt).sha1(sha1($pass_me).$salt);

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
  
  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  
  $os = xos();$br = xbr();$ip = xip();
  
  $token = sha1(xrands(30).DATE("His"));
  
  $refid = time().rand(50,500900222).xrands(10);
  

if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	
	if($new == $neww){
		if(x_count("userdb","email='$email' AND pass='$hashold' AND status='active' LIMIT 1") > 0){
			x_update("userdb","email='$email' AND pass='$hashold' AND status='active'","pass='$hashnew'","0","Failed to update pass");
			echo "Password changed successfully!";
			}else{
			
			echo "Incorrect old password!";	
			
			}
		}else{
			
			echo "New password does not match!";
			}

}else{
			echo "Incorrect Pin! Please provide valid pin";
}
		
}
?>
