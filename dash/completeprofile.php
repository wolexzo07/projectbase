<?php
require_once("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['identity_update']) || !empty($_POST['identity_update'])){
$email = xp("email");
$mobile = xp("mobile");$gen = xp("gen"); $skill = xp("skill");

 if(!is_numeric($mobile) || strlen($mobile)!=11){
  echo "<p class='hubmsg'>Enter valid mobile number e.g 081xxxxxxxx</p>";
	exit();
 }

 $country = xp("country");$state = xp("state");
  if($country != "Nigeria"){
  echo "<p class='hubmsg'>Nigerian is supported for now</p>";
	exit();
 }

  $how = xp("how");
  $schlist = xp("schlist");
  if($schlist == "OTHER"){
	   $schlist = xp("schlist_other");
	  }else{
		   $schlist = xp("schlist");
		  }

//getting upload limit from db started

if(x_count("filelimit","status='1' LIMIT 1") > 0){
	foreach(x_select("user_reg","filelimit","status='1'","1","id") as $key){

		$sizep = $key["user_reg"];
		xcsize("userphoto",$sizep);

		}
	}else{
		echo "<p class='hubmsg'>No upload limit detected!</p>";
		exit();
		}

//getting upload limit fromdb ended

xcload("userphoto");

xtex("png,gif,jpg","userphoto");
 $token = sha1($email.uniqid().xrands(10).Date("His"))."_";
$path_one = xpath("userphoto","userphoto/$token");
$path_oner = xpath("userphoto","../userphoto/$token");



$sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
$code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);

 $time = x_curtime("0","0");$rtime = x_curtime("0","1");

if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){

if(x_count("userdb","mobile='$mobile' AND email != '$email' LIMIT 1") > 0){
echo "<p class='hubmsg'>Mobile <b>$mobile</b> already used!</p>";
}else{

xmload("userphoto",$path_oner,"");	

x_update("userdb","email='$email'","school='$schlist',medium='$how',user_photo='$path_one',mobile='$mobile',country='$country',state='$state',gender='$gen',skills='$skill',profile_updated_on='$time',profile_updated_onr='$rtime'","","<p class='hubmsg'>Failed to update account</p>");
//echo "<p class='hubmsg'>Data updated successfully</p>";
?>
<!---<script>
alert("Data updated successfully!");
load("updateinfo");
</script>--->
<?php
finish("./","Data updated successfully! Re-Login to effect changes");
}

}else{
echo "<p class='hubmsg'>Incorrect Pin! Please provide valid pin</p>";
}


}else{
		echo "<p class='hubmsg'>Parameter is missing!</p>";
		//exit();
}
?>
