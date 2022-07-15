<?php
include("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_POSITION_2018_VISION"])){
$id = xp("id");
$tok = xp("token");
if(x_count("clientpayment","id='$id' AND token='$tok' LIMIT 1") > 0){
	foreach(x_select("userfrom,userto,amount,currency,payment_type,pid,bank_name,account_name,account_number","clientpayment","id='$id' AND token='$tok'","1","id") as $key){
	$paidby = $key["userfrom"];	
	$paidto = $key["userto"];
	$amt = $key["amount"];
	$cur = $key["currency"];
	$pt = $key["payment_type"];
	$pid = $key["pid"];
	$bn = $key["bank_name"];
	$anumb = $key["account_number"];
	$aname = $key["account_name"];
	
	}
	#verifying the availabilty of Bank account
	if(($bn=="") && ($anumb=="") && ($aname=="")){
		echo "Invalid Bank";
		exit();
	}
	
foreach(x_select("wallet_balance,wallet_currency","userdb","email='$paidto'","1","id") as $key){
	$wb = $key["wallet_balance"];	
	$wc = $key["wallet_currency"];
	}
	#check for currency
	if($wc != $pt){
		echo "Invalid currency";
		exit();
	}
	#check for client wallet balance
	  if($amt > $wb){
		echo "Insufficient wb";
		exit();
	}
	$nwb = $wb - $amt;
	
	if(x_count("clientpayment","id='$id' AND token='$tok' AND payment_approval='Yes' LIMIT 1") > 0){
		echo "Already Done";
		exit();
	}
	if(x_count("projects","id='$pid' LIMIT 1") > 0){
	#updating wallet_balance
	x_update("userdb","email='$paidto'","wallet_balance='$nwb'","0","Failed");
	
	#updating client payment status to approved
	$tm = x_curtime("0","0");
	x_update("clientpayment","id='$id' AND token='$tok'","approval_date='$tm',payment_approval='Yes'","0","Failed");
	echo "Payment approved";	
	}else{
		echo "Invalid Project";
	}
}else{
	echo "No Data";
}

}else{
	echo "Session expired";
}
?>