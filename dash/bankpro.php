<?php
require_once("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['bank_update']) || !empty($_POST['bank_update'])){
$bankname = xp("bankname");
$acctname = xp("acctname");
$acctnum = xp("acctnum");
$email = xp("email");

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);

if(empty($_POST["bankname"]) || empty($_POST["acctname"]) || empty($_POST["acctnum"])){
$msg="Please all fields must be filled!";
echo $msg;
}else{
if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	x_update("userdb","email='$email'","bank_name='$bankname',account_name='$acctname',account_number='$acctnum'","0","0");
	echo "Account Updated successfully";
}else{
	echo "Incorrect Pin! Please provide valid pin";
}
}

}
?>