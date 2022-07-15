<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])){
	
//get paystack payment secret key

if(x_count("paymentkeys","status='Yes' LIMIT 1") > 0){

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

		
$email = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);

  
  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  
  $os = xos();$br = xbr();$ip = xip();
  
  $token = sha1(xrands(30).DATE("His"));
  
  $refid = time().rand(50,500900222).xrands(5);
  
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
if(x_count("userdb","email='$email' AND status='active' LIMIT 1") > 0){
	
	if(x_count("withdrawalbase","paystackid='$py' LIMIT 1") > 0){
			
			echo "Transaction completed already";
			
			}else{
				
if(!isset($_SESSION["WALLET_AMOUNT"]) || !isset($_SESSION["WALLET_CHARGE"]) || !isset($_SESSION["WALLET_FEE"])){
	echo "Hack detected! Failed to continue!";
	exit();
	}
$amt = x_clean($_SESSION["WALLET_AMOUNT"]);
$charge = x_clean($_SESSION["WALLET_CHARGE"]);
$topupfee = x_clean($_SESSION["WALLET_FEE"]);
if(!is_numeric($amt)){
	echo "Hack detected! Enter valid amount!";
	exit();
	}

foreach(x_select("wallet_balance,wallet_currency,total_spent_onjob","userdb","email='$email'","1","id") as $key){
					
	$wb = $key["wallet_balance"];
	$wc = $key["wallet_currency"];
	$rrm = "$wc ".number_format($amt,2);
	$nwb = $wb + $amt;  
	
	$tsj = $key["total_spent_onjob"];
	$nts = $tsj + $amt; 
	
	x_update("userdb","email='$email'","wallet_balance='$nwb',total_spent_onjob='$nts'","0","0");
			 
x_insert("email,amount,paystackid,charge,profit,refid,date_time,timereal,type,status,token,os,br,ip","withdrawalbase","'$email','$amt','$py','$charge','$topupfee','$refid','$time','$rtime','topup','approved','$token','$os','$br','$ip'","<center><i class='fa fa-check' style='color:lightgray;font-size:60pt;'></i><br/>Wallet Top-up of $rrm was successful !<br/></center>","<center><i class='fa fa-trash' style='color:lightgray;font-size:60pt;'></i><br/>Failed to top-up!<br/></center>");	
unset($_SESSION["WALLET_AMOUNT"]);
unset($_SESSION["WALLET_CHARGE"]);
unset($_SESSION["WALLET_FEE"]);	
					}
				
				}
			/**
			unset($_SESSION["WALLET_AMOUNT"]);
			unset($_SESSION["WALLET_CHARGE"]);
			unset($_SESSION["WALLET_FEE"]);
			**/
	
		}else{
			echo "No user found";
}
		}else{
		echo "Failed to create table";
		}





		}
		
		}
	
	}else{
		echo "Payment key deactivated!";
		}



}else{
		echo "Parameter Missing!";
		}
?>
