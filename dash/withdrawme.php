<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && isset($_POST['cashout']) || !empty($_POST['cashout'])){
	
$mainamt = xp("amount");

if(!is_numeric($mainamt)){
	echo "Enter valid amount!";
	exit();
	}
	
	//getting limit from db!
	
	if(x_count("withdrawal_limit","status='approved' AND type='withdraw' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","withdrawal_limit","status='approved' AND type='withdraw'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];
			
	if($mainamt < $ramt){
	echo "You can not withdraw less than $rcur $rkl !";
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
if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){

//Getting withdrawable balance
foreach(x_select("wallet_balance,wallet_currency","userdb","email='$email'","1","name") as $key){
					$wb = $key["wallet_balance"];
					
					$wbb = number_format($wb,2);
					
					$wc = $key["wallet_currency"];
					
					if(x_count("projects","owner='$email' AND payment_status='active' LIMIT 1") > 0){
					$gsum = x_sum("amount_to_pay","projects","owner='$email' AND payment_status='active' AND completion_status='inactive'");
					if($gsum > $wb){
						$nbal = $gsum - $wb;
						}else{
							$nbal = $wb - $gsum;
							}
					
					#echo $wc." ".number_format($nbal,2);
					
						
	//getting withdrawal fee

	if(x_count("topup_withdraw","status='approved' AND type='withdraw' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","topup_withdraw","status='approved' AND type='withdraw'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];
	
	$checkamt = $mainamt + $ramt;
	
						//getting withdrawable balance and checking for funds sufficiency
					
					if($checkamt > $nbal){
						
						echo "Sorry you have insufficient funds in your wallet";
						
						}elseif($checkamt <= $nbal){
							
							#echo "You have sufficient funds in your wallet";
							$deduct = $wb - $checkamt;

							x_update("userdb","email='$email'","wallet_balance='$deduct'","0","0");
							
							$mmm = number_format($mainamt,2);
							
							x_insert("profit,email,amount,paystackid,refid,date_time,timereal,type,status,token,os,br,ip","withdrawalbase","'$ramt','$email','-$mainamt','','$refid','$time','$rtime','withdrawal','pending','$token','$os','$br','$ip'","Withdrawal of $wc $mmm was successful! Wait for approval in 48 hrs","Failed to withdraw money");
							//send user mail
							
							}else{
								
								echo "Invalid wallet amount detected";
						
						}
						
						//getting withdrawable balance ended
	
	}
	}else{
	
	echo "No withdrawal fee found in the database!";
	}
	
	//Getting withdrawal fee
						
						
						
						}else{
							
	// for professional that does not post project
	
	//getting withdrawal fee
	
	//checking for pending professional balance
	$use = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	
	if(x_count("clientpayment","payment_approval='No' AND userto='$use' LIMIT 1") > 0){
		
		$summat = x_sum("amount","clientpayment","payment_approval='No' AND userto='$use'");
		$nbal = abs($wb - $summat);
		
		}else{
			
			$nbal = $wb;
			
			}
	//checking for pending professional balance
	
	if(x_count("topup_withdraw","status='approved' AND type='withdraw' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","topup_withdraw","status='approved' AND type='withdraw'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];
	
	$checkamt = $mainamt + $ramt;
	
						//getting withdrawable balance and checking for funds sufficiency
					
					if($checkamt > $nbal){
						
						echo "Sorry you have insufficient funds in your wallet";
						
						}elseif($checkamt <= $nbal){
							
							#echo "You have sufficient funds in your wallet";
							$deduct = $wb - $checkamt;

							x_update("userdb","email='$email'","wallet_balance='$deduct'","0","0");
							
							$mmm = number_format($mainamt,2);
							
							x_insert("profit,email,amount,paystackid,refid,date_time,timereal,type,status,token,os,br,ip","withdrawalbase","'$ramt','$email','-$mainamt','','$refid','$time','$rtime','withdrawal','pending','$token','$os','$br','$ip'","Withdrawal of $wc $mmm was successful! Wait for approval in 48 hrs","Failed to withdraw money");
							//send user mail
							
							}else{
								
								echo "Invalid wallet amount detected";
						
						}
						
						//getting withdrawable balance ended
	
	}
	}else{
	
	echo "No withdrawal fee found in the database!";
	}
	
	//Getting withdrawal fee
						
					
							
							// Professional that does not post project ended
							
							}
					
					}
//Getting withdrawable balance ended

	
		}else{
			echo "Incorrect Pin! Please provide valid pin";
}
		}else{
		echo "Failed to create table";
		}



}else{
	echo "No withdrawal parameter found ";
	}
?>
