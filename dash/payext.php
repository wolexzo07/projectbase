<?php
//get paystack payment secret key
if(x_count("paymentkeys","status='Yes' LIMIT 1") > 0){
	
	//Regenerating charge fees ended
	
//get project title and amount
foreach(x_select("amount_to_pay","projects","id='$pid'","1","ptitle") as $key){
$amp = $key["amount_to_pay"];
echo " ".$ptitle;
}

//get charge and portal fee
foreach(x_select("portal_fee","charge","id='1'","1","id") as $key){
$portal_fee = $key["portal_fee"];
}

#$_SESSION["PBNG_PAYG"] = $pid;

	$amt = $amp;
	
	//get paystack charge of 1.5% + 100
	if($amt < 2500){
		
		$charge = (1.5/100)*$amt;
		
		}else{
			$charge = ((1.5/100)*$amt) + 100;
			}
	
	#$paynow = ($amt + $portal_fee + $charge) * 100;
	
	//Regenerating charge fees ended
	
	$py = $_GET['reference'];
	require 'Paystack.php'; 
	foreach(x_select("secretkey,publickey","paymentkeys","status='Yes'","1","id") as $key){
		$sk = $key["secretkey"];
		$pk = $key["publickey"];
		
		$paystack = new Paystack($sk);
		$trx = $paystack->transaction->verify(
			[
			 'reference'=>$_GET['reference']
			]
		);
		if(!$trx->status){
			exit($trx->message);
		}

		if('success' == $trx->data->status){
		
		//checking for the existence of payment Id
		
		if(x_count("transaction","paystack_id='$py' LIMIT 1") > 0){
			
			echo "Transaction completed already";
			
			}else{
				//assigning value start here
				
if(x_count("projects","id='$pid' AND status='active'") > 0){
	$rtime = x_curtime("0","1");
#updating projects
foreach(x_select("owner,amount_to_pay,amount_currency,ptitle,approved_to","projects","id='$pid'","1","id") as $key){
$amp = $key["amount_to_pay"];
$amc = $key["amount_currency"];
$owner = $key["owner"];
$biduser = $key["approved_to"];
$ptit = xup($key["ptitle"],"b");
}

if(x_count("userdb","email='$owner' LIMIT 1") > 0){
foreach(x_select("name","userdb","email='$owner'","1","id") as $key){
$apname = $key["name"]; //project owner name

if(x_count("userdb","email='$biduser' LIMIT 1") > 0){

foreach(x_select("name","userdb","email='$biduser'","1","id") as $key){
$biddername = $key["name"]; //project bidder name

	#updating Payment Transaction
x_update("transaction","pid='$pid'","paystack_charge='$charge',portal_fee='$portal_fee',paystack_id='$paystackid',status='approved',paydate='$rtime',paystack_verify='no'","0","0");



x_update("projects","id='$pid'","payment_status='active',payment_amount='$amp',payment_currency='$amc'","0","0");

#updating wallet balance
foreach(x_select("wallet_balance,total_spent_onjob","userdb","email='$owner' AND status='active'","1","id") as $key){
$wb = $key["wallet_balance"];
$ts = $key["total_spent_onjob"];
}
$nwb = $wb + $amp;
$nts = $ts + $amp;
x_update("userdb","email='$owner' AND status='active'","wallet_balance='$nwb',total_spent_onjob='$nts'","0","0");

//Send notification to project owner and send a mail
$rtimen = x_curtime("0","1");$stimen = x_curtime("0","0");
$amp_t = number_format($amp,2);
x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','PBNG JOB PAYMENT WAS SUCCESSFUL','$owner','Congratulations! Your job payment of $amc $amp_t for project titled $ptit was successful and $amc $amp_t has been credited to your wallet.','0','$rtimen','$stimen'","","Failed to send notification");

include_once("paymail.php");

//Send notification to project bidder and send a mail
$rtimen = x_curtime("0","1");$stimen = x_curtime("0","0");
$amp_t = number_format($amp,2);
x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','BIDDED JOB PAYMENT WAS SUCCESSFUL','$biduser','Congratulations! Your client just deposited $amc $amp_t for the job approved to you with project title $ptit.Please start the project immediately and ensure that you do not fail to meet up the time frame so as to enable your payment to be released promptly.Thank you','0','$rtimen','$stimen'","","Failed to send notification");

include_once("paybidmail.php");

?>

<div style='margin-bottom:20pt;'><center><i class='glyphicon glyphicon-check' style='font-size:80pt;color:lightgray;'></i><p style='color:lightgray;'><br/>Payment Completed successfully!</p>
<button class='btn btn-success btn-lg' onclick="load('approved')"><i class='fa fa-check'></i> Click to Continue </button>
</center></div>

<?php
	
	

}
}else{
	echo "Failed to get project biduser name!";
		exit();
	}

}
	}else{
		echo "Failed to get project owner name!";
		exit();
		} 
		

}else{
	echo "Project is not active or does not exists in our db!";
}
				
				//assigning value ends here
				
				}
		

		}
		
		}
	
	}else{
		echo "Payment key deactivated!";
		#exit();
		}



?>
