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
			
				
	//Regenerating charge fees ended
	
//get project title and amount
if(x_count("buy_sell","id='$pid' AND token='$ptoken' LIMIT 1") > 0){
foreach(x_select("amount,ptitle,postedby,buyer_count","buy_sell","id='$pid' AND token='$ptoken'","1","ptitle") as $key){
$buyc = $key["buyer_count"];
$nbuyc = $buyc + 1;
$seller = $key["postedby"];
$ptitle = $key["ptitle"];
$amp = $key["amount"];
echo " ".$ptitle;

	$amt = $amp;
	
	//get paystack charge of 1.5% + 100
	if($amt < 2500){
		
		$charge = (1.5/100)*$amt;
		
		}else{
			$charge = ((1.5/100)*$amt) + 100;
			}
			
	$create = x_dbtab("projectsold","
	pid INT NOT NULL,
	ptoken TEXT NOT NULL,
	paystack_id VARCHAR(255) NOT NULL,
	paystack_charge DOUBLE NOT NULL,
	user VARCHAR(255) NOT NULL,
	amountpaid DOUBLE NOT NULL,
	company_pay DOUBLE NOT NULL,
	user_pay DOUBLE NOT NULL, 
	status ENUM('approved','pending','declined') NOT NULL,
	paid_time DATETIME NOT NULL,
	paid_time_r VARCHAR(255) NOT NULL
	","MYISAM");	
	
	if($create){
		if(x_count("projectsold","paystack_id='$py' LIMIT 1") > 0){
			
			echo "Transaction was completed already!";
			
			}else{
			$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);	
			if(x_count("buy_sell_percent","status='1' LIMIT 1") > 0){
			foreach(x_select("percent","buy_sell_percent","status='1'","1","id") as $key){
			$cpercent = $key["percent"];  //company percentage
			$upercent = (100-$cpercent); // user percentage
			$cpay = ($cpercent/100)* $amt;
			$upay = ($upercent/100)* $amt;
			
			if(x_count("userdb","email='$seller' LIMIT 1") > 0){
				foreach(x_select("wallet_balance,name","userdb","email='$seller'","1","id") as $key){
				$seller_name = $key["name"];
				$wb = $key["wallet_balance"];	
				$nbal = $wb + $upay;
				
				
				
				if(x_count("userdb","email='$user' LIMIT 1") > 0){
				foreach(x_select("total_spent_onjob,name","userdb","email='$user'","1","id") as $key){
				$buyer_name = $key["name"];
				$tsj = $key["total_spent_onjob"];
				$ntsj = $tsj + $amt;
				
x_update("userdb","email='$seller'","wallet_balance='$nbal'","0","0");
x_update("userdb","email='$user'","total_spent_onjob='$ntsj'","0","0");
x_update("buy_sell","id='$pid' AND token='$ptoken'","buyer_count='$nbuyc'","0","0");

//send notification to the buyer
$time = x_curtime("0","0");$rtime = x_curtime("0","1");
x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','YOUR PROJECT PAYMENT OF NGN $amt WAS RECIEVED','$user','Hi $buyer_name! Your payment for the purchase of project titled <b>$ptitle</b> was recieved successfully.Please check the project(s) Ordered panel under the buy&sell section to download the project you paid for.Thank you for your patronage','0','$rtime','$time'","","Failed to send notification");

include_once("bmail.php");

//send notification to the seller

x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','ONE OF YOUR POSTED PROJECT(S) WAS SOLD SUCCESSFULLY!','$seller','Congratulations $seller_name! One of your posted project(s) titled <b>$ptitle</b> was sold , $cpercent percent was deducted and the remaining $upercent percent was credited to your wallet and is available for withdrawal at any time.Thank you','0','$rtime','$time'","","Failed to send notification");

include_once("smail.php");

x_insert("pid,ptoken,paystack_id,paystack_charge,user,amountpaid,company_pay,user_pay,status,paid_time,paid_time_r","projectsold","'$pid','$ptoken','$py','$charge','$user','$amt','$cpay','$upay','approved','$time','$rtime'","","Failed to insert");
	
?>
<div style='margin-bottom:20pt;'><center><i class='glyphicon glyphicon-check' style='font-size:80pt;color:purple;'></i><p style='color:purple;'><br/>Payment Completed successfully!</p>
<button class='btn btn-success btn-lg' onclick="load('buy&sell')"><i class='fa fa-check'></i> Click to Continue </button>
</center></div>
<?php
				
				}
					}else{
						echo "Invalid Buyer detected!";
						}
					
					}
				}else{
					echo "Invalid seller detected!";
					}	
				
				}
			
			}else{
				echo "Failed to get selling percent!";
				exit();
				}
				
				}
		
		}else{
			echo "Failed to create project transactions!";
			}
	
		
			
}
	}else{
		echo "Invalid project detected!";
		}

	//Regenerating charge fees ended
			
			}
		
		}
	
	}else{
		echo "Payment key deactivated!";
		#exit();
		}



?>
