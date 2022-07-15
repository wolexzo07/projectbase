<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['changephoto']) || !empty($_POST['changephoto'])){

$email = strtolower(xp("email"));

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
 
  
  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  

if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	
echo "You cannot change photo now";

}else{
	
			echo "Incorrect Pin! Please provide valid pin";
			
}
		
}
?>
