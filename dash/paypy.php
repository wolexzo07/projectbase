<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['payment_system']) || !empty($_POST['payment_system'])){
$cat = xp("category");
$amt = xp("amount");
$email = xp("email");

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
  
  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  
  $os = xos();$br = xbr();$ip = xip();
  
   $token = sha1(xrands(30).DATE("His"));
  
  $create = x_dbtab("transaction","
owner VARCHAR(200) NOT NULL,
pid INT NOT NULL,
currency VARCHAR(10) NOT NULL,
amount DOUBLE NOT NULL,
status ENUM('pending','approved','cancelled') NOT NULL,
comment TEXT NOT NULL,
os VARCHAR(100) NOT NULL,
br VARCHAR(220) NOT NULL,
ip VARCHAR(30) NOT NULL,
time_stamp DATETIME NOT NULL,
timereal VARCHAR(100) NOT NULL,
token TEXT NOT NULL
			","MYISAM");
			if($create){
if(empty($_POST["pin"]) || empty($_POST["amount"]) || empty($_POST["category"])){
$msg="Please all fields must be filled!";
echo $msg;
}else{
if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){

	if(x_count("projects","id='$cat' AND owner='$email' AND status='active' AND bidded_status='active' AND processing_status='active' AND completion_status='inactive' AND payment_status='inactive' LIMIT 1") > 0){
		
		
	if(x_count("transaction","pid='$cat' AND owner='$email' LIMIT 1") > 0){
		
		echo "Payment transaction is pending! Please check transaction menu to complete payment";
		
		}else{
			
		x_insert("owner,pid,currency,amount,status,os,br,ip,time_stamp,timereal,token","transaction","'$email','$cat','NGN','$amt','pending','$os','$br','$ip','$time','$rtime','$token'","Payment Transaction opened.Make payment now","Failed to open payment transaction");
		?>
		<script type="">
		load("payment_page?userpay=<?php echo $email;?>&cathash=<?php echo sha1($email);?>&pid=<?php echo $cat;?>&amtbase=<?php echo $amt;?>");
		</script>
		<?php
		}	
		
		
		}else{
		echo "Sorry! Project does not exist in our db! ";
		}
	
}else{
	echo "Incorrect Pin! Please provide valid pin";
}
}
				}else{
				echo "Failed to create table!";
				}



}
?>
