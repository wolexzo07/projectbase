<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['changepin']) || !empty($_POST['changepin'])){

$new = xp("new");
$neww = xp("neww");
$email = strtolower(xp("email"));

$pass = xp("new");



 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
 $hashnew = md5(sha1($pass).$sa).sha1(sha1($pass).$sa);
  
  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  
  $os = xos();$br = xbr();$ip = xip();
  
  $token = sha1(xrands(30).DATE("His"));
  
  $refid = time().rand(50,500900222).xrands(10);
  

if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	
	if($new == $neww){
		
	x_update("userdb","email='$email' AND pin='$pin' AND status='active'","pin='$hashnew'","0","Failed to update pin");
		
		echo "Pin changed successfully!";	
		
		}else{
			
			echo "New password does not match!";
			
			}

}else{
			echo "Incorrect Pin! Please provide valid pin";
}
		
}
?>
