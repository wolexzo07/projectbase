<?php
require_once("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['identity_update']) || !empty($_POST['identity_update'])){
$email = xp("email");
$id = xp("identity");
$sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
$code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);

$cardnum = xp("cardnum");
$token = sha1($email.xrands(10).Date("His"))."_";
xcload("userphoto");
xcsize("userphoto",5242880);
xtex("png,gif,jpg","userphoto");
	

$path_one = xpath("userphoto","../userphotoid/$token");
$path_onen = xpath("userphoto","userphotoid/$token");

if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	foreach(x_select("verify,test_photo","userdb","email='$email'","1","id") as $key){
		$verify = $key["verify"];
		$idcard = $key["test_photo"];
		
		}
	
	if($verify == "yes"){
		
		echo "<p class='hubmsg'>Account Verified already</p>";
		
		}else{
			//checking for uploaded file already and delete them
			if($idcard == ""){
				
	xmload("userphoto",$path_one,"");
	x_update("userdb","email='$email'","id_type='$id',test_photo='$path_onen',verify='no',cardnum='$cardnum'","0","0");
	echo "<p class='hubmsg'>Credential uploaded successfully! Wait for approval within 2 days</p>";
				
				}else{
					$rm = "../".$idcard;
					unlink($rm);
	xmload("userphoto",$path_one,"");
	x_update("userdb","email='$email'","id_type='$id',test_photo='$path_onen',verify='no',cardnum='$cardnum'","0","0");
	echo "<p class='hubmsg'>Credential updated successfully! Wait for approval within 2 days</p>";
				
				}
	
			
			}

}else{
	
	echo "<p class='hubmsg'>Incorrect Pin! Please provide valid pin</p>";
	
}


}
?>
