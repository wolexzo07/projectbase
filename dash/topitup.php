<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && isset($_POST['topup']) || !empty($_POST['topup'])){
	
$mainamt = xp("amount");

if(!is_numeric($mainamt)){
	echo "Enter valid amount!";
	exit();
	}
	
	//getting limit from db!
	
	if(x_count("withdrawal_limit","status='approved' AND type='topup' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","withdrawal_limit","status='approved' AND type='topup'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];
			
	if($mainamt < $ramt){
	echo "You can not top-up your wallet with an amount lesser than $rcur $rkl !";
	exit();
	}
			}
			
		}else{
			//No limit found
			}
	//getting limit from db!

	
$name = xp("name");
$email = strtolower(xp("email"));

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
  
  $create = x_create("withdrawalbase","
email TEXT NOT NULL,
amount DOUBLE NOT NULL,
paystackid TEXT NOT NULL,
charge DOUBLE NOT NULL,
profit DOUBLE NOT NULL,
refid TEXT NOT NULL,
date_time DATETIME NOT NULL,
timereal VARCHAR(50) NOT NULL,
type ENUM('withdrawal','topup') NOT NULL,
status ENUM('pending','approved') NOT NULL,
token TEXT NOT NULL,
os VARCHAR(100) NOT NULL,
br VARCHAR(220) NOT NULL,
ip VARCHAR(30) NOT NULL
			");

		if($create){
if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){

?>

<!---Start the payment gateway--->

<?php
if(x_count("paymentkeys","status='Yes' LIMIT 1") > 0){
foreach(x_select("secretkey,publickey","paymentkeys","status='Yes'","1","id") as $key){

		$sk = $key["secretkey"];
		$pk = $key["publickey"];
		
		//getting topup fee

	if(x_count("topup_withdraw","status='approved' AND type='topup' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","topup_withdraw","status='approved' AND type='topup'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];
			
	
				//paystack charge
		if($mainamt < 2500){
		$charge = (1.5/100)*$mainamt;
		}else{
			$charge = ((1.5/100)*$mainamt) + 100;
			}
			$paynow = ($mainamt + $charge + $ramt)*100;  //converting amount to paystack standard
			//paystack charge ended
			
			//generating session to get
			$_SESSION["WALLET_AMOUNT"] = $mainamt;
			$_SESSION["WALLET_CHARGE"] = $charge;
			$_SESSION["WALLET_FEE"] = $ramt;
			//generating session to get ended
		
		?>
<h3 style="text-align:center;padding:15px;">PBNG Wallet <font style="color:green;">Top-up </font></h3>
<h4>Hi, <font style="color:green;"><?php echo ucwords(strtolower($_SESSION["PBNG_NAME_2018_VISION"]));?></font></h4>
		
<div id="paystackEmbedContainer"></div>

<script>
  PaystackPop.setup({
   key: '<?php echo $pk;?>',
   email: '<?php echo $email;?>',
   amount: <?php echo $paynow;?>,
   container: 'paystackEmbedContainer',
   callback: function(response){
	   var rip = response.reference;
	   var un = "gettheamount?reference=" + rip ;
		load(un);
    },
  });
  
</script>

<table style='color:gray;font-weight:none;' class="table table-striped table-hover">
	<caption class="clapp"><i class="fa fa-credit-card"></i> PAYMENT BREAKDOWN</caption>
<tr style='color:black;font-weight:bold;'>
<th>Fees Breakdown</th><th>Amount</th>
</tr>

<tr>
<td>Top-up Amount</td><td><?php echo "NGN ".number_format($mainamt,2);?></td>
</tr>

<tr>
<td>Payment Gateway</td><td><?php echo "NGN ".number_format($charge,2);?></td>
</tr>

<?php
	if(x_count("topup_withdraw","status='approved' AND type='topup' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","topup_withdraw","status='approved' AND type='topup'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];
			
?><tr>
<td>Top-up Fee</td><td><?php echo $rcur." ".$rkl;?></td>
</tr><?php
			}
			
		}else{
			echo "No topup fee found in the db!";
			}
?>

<tr>
<th>Total Amount</th><th><?php echo "NGN ".number_format(($paynow/100),2);?></th>
</tr>
</table>
		<?php
	
			}
			
		}else{
			echo "No topup fee found in the db!";
			}
		
		//getting topup fee 
		

		
		}
}else{

echo "Payment key deactivated!";

}

?>
<!---Start the payment gateway End--->
<?php
	
		}else{
			echo "Incorrect Pin! Please provide valid pin";
}
		}else{
		echo "Failed to create table";
		}



}
?>
