<?php
include("../finishit.php");
xstart("0");
if(isset($_POST["bidder"]) && !empty($_POST["bidder"]) && isset($_SESSION["PBNG_ID_2018_VISION"])){
$bidder = xp("bidder");
$owner = xp("owner");
$pid = xp("pid");

$create = x_dbtab("clientpayment","
    pid INT NOT NULL,
   	userfrom VARCHAR(200) NOT NULL,
    userto VARCHAR(200) NOT NULL,
	payment_type VARCHAR(20) NOT NULL,
	bank_name VARCHAR(255) NOT NULL,
    account_name VARCHAR(255) NOT NULL,
	account_number VARCHAR(255) NOT NULL,
    usercomment TEXT NOT NULL,
	rating TEXT NOT NULL,
	currency VARCHAR(200) NOT NULL,
    amount DOUBLE NOT NULL,
    commission DOUBLE NOT NULL,
    commission_percent DOUBLE NOT NULL,
    total_involve DOUBLE NOT NULL,
    payment_approval ENUM('No','Yes') NOT NULL,
    datetim VARCHAR(200) NOT NULL,
	approval_date DATETIME NOT NULL,
    token TEXT NOT NULL
","MYISAM");
if($create){
	
	//check for the existence of uploaded project
	if(x_count("workdone","category='real' AND pid='$pid' LIMIT 1") > 0){
		
		//checking project abstract upload
		if(x_count("workdone","category='abstract' AND pid='$pid' LIMIT 1") > 0){
			
	x_update("workdone","category='real' AND pid='$pid'","status='approved'","0","0");
		
		}else{
		echo "<script>alert('Failed to complete transaction because no project abstract was uploaded by the client!')</script>";
			exit();
		}
		
		}else{
			echo "<script>alert('Failed to complete transaction because no project was uploaded by the client!')</script>";
			exit();
			
			}
	//check for the existence of uploaded project ended
	
	
	if(x_count("projects","id='$pid' AND status='active'") > 0){
		
		if(x_count("clientpayment","pid='$pid'") > 0){
			
			echo "Completed already";
			
			}else{

#Getting project owner wallet
foreach(x_select("wallet_balance,wallet_currency,completed_job,name,ref","userdb","email='$owner'","1","id") as $key){
					$referred_user = $key["ref"];
					$wb = $key["wallet_balance"];
					$wc = $key["wallet_currency"];
					$ownercpj = $key["completed_job"];
					$apname = $key["name"];
					
			}
			
#Getting projects status
foreach(x_select("ptitle,amount_to_pay,amount_currency,completion_status","projects","id='$pid'","1","id") as $key){
					$amp = $key["amount_to_pay"];
					$amc = $key["amount_currency"];
					$cs = $key["completion_status"];
					$ptit = strtoupper($key["ptitle"]);
					
			}
			
#confirming wallet balance before deduction.
if($wb < $amp){
				echo "insufficient balance!";
				exit();
				}
			
#updating completion status to active
x_update("projects","id='$pid'","completion_status='active'","0","0");
			
#Getting bidder wallet
foreach(x_select("wallet_balance,wallet_currency,completed_job,earned_job,earnings,bank_name,account_name,account_number,name","userdb","email='$bidder'","1","id") as $key){
					$wb_bidder = $key["wallet_balance"];
					$wc_bidder = $key["wallet_currency"];
					$cpj = $key["completed_job"];
					$ejob = $key["earned_job"];	
					$earn = $key["earnings"];	
					
					$bankname = $key["bank_name"];
					$acctname = $key["account_name"];	
					$acctnumb = $key["account_number"];	
					$appname = $key["name"];
			}
	

			

# Defining company percentage
foreach(x_select("percent","percent","userstatus='p'","1","id") as $key){
	$percent = $key["percent"];
}


#removing money from clientele account and updating it back
$clientele_bal = $wb - $amp;
$ncomp = $ownercpj + 1;   //clientele new job completion

x_update("userdb","email='$owner'","completed_job='$ncomp',wallet_balance='$clientele_bal'","0","0");

#bidder parameters

	$ncpj_bid = $cpj + 1;   // client new job completed
	$ejb_bid = $ejob + 1;	// client new job earning
	$earn_bidr = $earn + (((100-$percent)/100)*$amp) ;	// client new amount earned		
	$wb_bal = $wb_bidder + 	(((100-$percent)/100)*$amp) ;
	$commission = (($percent/100)*$amp); 
	$amt_paid = (((100-$percent)/100)*$amp); 			

x_update("userdb","email='$bidder'","completed_job='$ncpj_bid',earned_job='$ejb_bid',wallet_balance='$wb_bal',earnings='$earn_bidr'","0","0");

//send notification to the client
$rtimen = x_curtime("0","1");$stimen = x_curtime("0","0");
$amc_b = xup($amc,"");
$amt_paid_b = number_format($amt_paid,2);
$amp_b = number_format($amp,2);
$ptit = xup($ptit,"b");

//send notification to the bidder

x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','JOB PAYMENT OF $amc_b $amt_paid_b HAS BEEN RELEASED ','$bidder','Congratulations! Your wallet has been credited with Job payment of $amc_b $amt_paid_b for the project titled $ptit that was completed successfully.','0','$rtimen','$stimen'","","Failed to send notification");

include_once("jobpmail.php");

//send notification to the job owner

x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','$amc_b $amp_b WAS DEDUCTED FROM YOUR WALLET FOR JOB PAYMENT','$owner','Congratulations! $amc_b $amp_b was deducted from your wallet as payment for the project titled $ptit that was completed successfully.','0','$rtimen','$stimen'","","Failed to send notification");

include_once("jobdeductmail.php");

$timen = x_curtime("0","1");$token = sha1(xrands(12));

//Refferral system activated

include_once("extra_bonus.php");

//Referral system activated
	
#insert client payment details

x_insert("pid,userfrom,userto,payment_type,bank_name,account_name,account_number,currency,amount,commission,commission_percent,total_involve,payment_approval,datetim,token","clientpayment","'$pid','$owner','$bidder','$amc','$bankname','$acctname','$acctnumb','$amc','$amt_paid','$commission','$percent','$amp','No','$timen','$token'","Payment approved","Approval Failed");	

			}
		
		}else{
			echo "Project does not exist";
			}
	
	}else{
	echo "Failed to create table!";
	}


}

?>
