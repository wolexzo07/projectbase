<?php
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
			
		//create table for payment transactions
		
		$tab = x_dbtab("sub_biz","
		user VARCHAR(200) NOT NULL,
		paystack_id VARCHAR(200) NOT NULL,
		currency VARCHAR(10) NOT NULL,
		amount DOUBLE NOT NULL,
		refamount DOUBLE NOT NULL,
		charge DOUBLE NOT NULL,
		trans_type ENUM('sub','other') NOT NULL,
		status ENUM('approved','pending') NOT NULL,
		type ENUM('professional','student') NOT NULL,
		paydate DATETIME NOT NULL,
		rpaydate DATETIME NOT NULL,
		token TEXT NOT NULL
		","MYISAM");
		if(!$tab){
			
			echo "Failed to dump table";
			
			exit();
			
			}
			

		//create table for Referral transactions
		
		$tabb = x_dbtab("ref_biz","
		paidfrom VARCHAR(200) NOT NULL,
		paidto VARCHAR(200) NOT NULL,
		paystack_id VARCHAR(200) NOT NULL,
		currency VARCHAR(10) NOT NULL,
		refamount DOUBLE NOT NULL,
		trans_type ENUM('ref','other') NOT NULL,
		trans ENUM('credit','debit') NOT NULL,
		type ENUM('professional','student') NOT NULL,
		status ENUM('approved','pending') NOT NULL,
		paydate DATETIME NOT NULL,
		rpaydate DATETIME NOT NULL,
		token TEXT NOT NULL
		","MYISAM");
		if(!$tabb){
			
			echo "Failed to dump table";
			
			exit();
			
			}
		
		//checking for the existence of payment Id
		
		if(x_count("sub_biz","paystack_id='$py' LIMIT 1") > 0){
			
			echo "Transaction completed already";
			
			}else{
		//assigning value starts here
		$time = x_curtime("0","0");
		$rtime = x_curtime("0","1");
		$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
		$position = x_clean($_SESSION["PBNG_POSITION_2018_VISION"]);
		
		//Getting sub amount from db
	if(x_count("subcription","type='$position' LIMIT 1") > 0){	
		
		foreach(x_select("amount,currency","subcription","type='$position'","1","id") as $key){

		$samt = $key["amount"];
		$curr = $key["currency"];
		$tok = sha1(xrands(10));
		//paystack charge
		if($samt < 2500){
		$charge = (1.5/100)*$samt;
		}else{
			$charge = ((1.5/100)*$samt) + 100;
			}
			//paystack charge ended
			
			
	//Getting ref pecentage
	
	if(x_count("refcharge","type='$position' LIMIT 1") > 0){
		
	foreach(x_select("percent","refcharge","type='$position'","1","id") as $key){
		$refcharge = $key["percent"];
		
	//getting referral record
		
	if(x_count("userdb","email='$user' LIMIT 1") > 0){
		
	foreach(x_select("name,ref,total_spent_onjob,sub_count","userdb","email='$user'","1","id") as $key){
		$user_name = $key["name"];
		$refuser = $key["ref"];
		$amountspent = $key["total_spent_onjob"];
		$scount = $key["sub_count"];
		$nnc = $scount + 1;
		$namountspent = $key["total_spent_onjob"] + $samt;
		
		
		if($refuser != ""){
			
			if(x_count("ref_biz","paidfrom='$user' LIMIT 1") > 0){
						
						$refamt = 0  ; //Getting ref amount
			
			// send mail to referral about earnings here
						}else{
							
							$refamt = ($refcharge/100) * $samt ;//Getting ref amount
			
			// send mail to referral about earnings here
							}
			
			//getting ref data
			
			if(x_count("userdb","email='$refuser' LIMIT 1") > 0){
				foreach(x_select("name,wallet_balance","userdb","email='$refuser'","1","id") as $key){
					$refname = $key["name"];
					$wb = $key["wallet_balance"];
					$nwb = $wb + $refamt;
					
					//update referral wallet
					
					//checking to give out ref payment once
					
					if(x_count("ref_biz","paidfrom='$user' LIMIT 1") > 0){
						
						}else{
							
							//update referral wallet started
							
							x_update("userdb","email='$refuser'","wallet_balance='$nwb'","0","0");
							
							//update referral wallet ended
							}
					
					//checking to give out ref payment once ended
					
					
					
					
					}
				}else{
				echo "Referred user does not exist";
				}
			//getting ref data
			
			
			
			}else{
				$refamt = 0;
				}
		
	//Renewing user sub status,sub count and total amount spent	
	x_update("userdb","email='$user'","sub_count='$nnc',total_spent_onjob='$namountspent',sub_status='active',sub_date='$time'","0","0");
	
	
	//checking to give out ref payment once
					
	if(x_count("ref_biz","paidfrom='$user' LIMIT 1") > 0){
		
		}else{
			
	//Inserting ref data into the database
	
	x_insert("status,paidfrom,paidto,paystack_id,currency,refamount,trans_type,trans,type,paydate,rpaydate,token","ref_biz","'approved','$user','$refuser','$py','$curr','$refamt','ref','credit','$position','$time','$rtime','$tok'","","Failed to update ref data");
	
	//Send notification to project owner and send a mail
	
$rtimen = x_curtime("0","1");$stimen = x_curtime("0","0");
x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','PBNG REFERRAL - YOU JUST EARNED REFERRAL BONUS OF NGN $refamt','$refuser','Congratulations $refname! You just earned a referral bonus of NGN $refamt from $user_name ($user) and NGN $refamt has been credited to your wallet.','0','$rtimen','$stimen'","","Failed to send notification");

include_once("refmail.php");
	
			}

	
	//Inserting sub data into the database
	
	x_insert("refamount,user,paystack_id,currency,amount,charge,trans_type,type,paydate,rpaydate,token","sub_biz","'$refamt','$user','$py','$curr','$samt','$charge','sub','$position','$time','$rtime','$tok'","<h1 class='text-center' style='font-size:50pt;color:green;'><i class='fa fa-check'></i></h1><p class='text-center' style='font-size:14pt;color:green;'>Account unlocked successfully! Continue unrestricted access.</p>","Failed to update sub account");
		
		}
		
		}else{
				echo "User does not exist! Failed to get ref data";
				
				}
	
	}
		}else{
			echo "Refcharge does not exist";
			}
//Getting ref pecentage ended
			
				

		
		}
		
		}else{
		echo "NO subscription Fee exits in the db!";
		}	
		
				
				}
		

		}
		
		}
	
	}else{
		echo "Payment key deactivated!";
		#exit();
		}



?>
