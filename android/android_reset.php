<?php
include_once("headconnect.php");
include_once("../finishit.php");
xstart("0");
if(isset($_GET["blessme"]) || !empty($_GET["blessme"])){
	 
$email = xgmail("email");
$salt = "ABCDEFGHIJKKLMNOPQ1234567890abcghdtuwioalkjsnh?@"; 
 $pass = xrands(5);
 $hash = md5(sha1($pass).$salt).sha1(sha1($pass).$salt);
 
 
  $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = substr(rand(1000,9999999878),0,4);
 $pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
  
 $opt = xg("opt"); 

if(x_count("userdb","email='$email' LIMIT 1") > 0){
	
	if($opt == "pass"){
		
x_update("userdb","email='$email'","pass='$hash'","0","<h2 class='hubmsg'>Failed to update security!</h2>");
include_once("../passmail.php");
echo "<h2 class='hubmsg'>Your password has been sent to your email.</h2>";

		}elseif($opt == "pin"){
			
x_update("userdb","email='$email'","pin='$pin'","0","<h2 class='hubmsg'>Failed to update security!</h2>");
include_once("../pinmail.php");
echo "<h2 class='hubmsg'>Your pin has been sent to your email.!</h2>";

			}else{
			echo "<h2 class='hubmsg'>Invalid option!</h2>";
			}

	}else{
		echo "<h2 class='hubmsg'>Invalid email account!</h2>";
		}


}else{
	echo "<h2 class='hubmsg'>Parameter missing!</h2>";
}
include_once("footconnect.php");
?>



