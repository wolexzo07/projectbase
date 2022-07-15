<?php 
include("validatebase.php");
?>
<div class="row">
<!----<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>--->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<h3 id="hiderf" class="yi"><i class="fa fa-credit-card"></i> <font style="color:green;">WALLET</font> MANAGER</h3>
<!--<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>--->
<script type="text/javascript" src="../log.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#wfbtn").click(function(){
	$(".cashout").show("slow");	
	$(".topup").hide("slow");	
		});
		
	$("#tubtn").click(function(){
	$(".topup").show("slow");	
	$(".cashout").hide("slow");	
		});
		
		$("#hiderf").click(function(){
	$(".topup").hide("slow");	
	$(".cashout").hide("slow");	
		});
	});
</script>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cashout">
		
		<div class="panel panel-default">
		<div class="panel-heading "><i class="fa fa-credit-card"></i> Make withdrawal <span class="badge pull-right">
		<?php 
		$usero = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
		echo x_count("withdrawalbase","type='withdrawal' AND email='$usero'");?></span></div>
		<div class="panel-body">
<form id="withdraw" method="POST">
<p class="banp">Enter Amount*</p>
<?php
//Getting limit from db!
	if(x_count("withdrawal_limit","status='approved' AND type='withdraw' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","withdrawal_limit","status='approved' AND type='withdraw'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];

	?><input type="number" id="amount" maxlength="6" min="<?php echo $ramt;?>" max="" required="required" placeholder="Enter amount to withdraw" name="amount" class="form-control ttx"/><?php
			}
			
		}else{
			//No limit found
			?><input type="number" id="amount" maxlength="6" min="" max="" required="required" placeholder="Enter amount to withdraw" name="amount" class="form-control ttx"/><?php
			}
			//Getting limit from db! ended
?>

<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="cashout" value="<?php echo sha1(rand());?>"/>
						      
<button class="btn btn-success" id="bup"><i class="fa fa-credit-card"></i> Withdraw Now</button>
</form>
<div id="gallery"><img src="../image/load.gif"/></div>
		
		</div>
		</div>
		
		</div>
		
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topup">
		
		<div class="panel panel-default">
		<div class="panel-heading"><i class="fa fa-credit-card"></i> Top-up Wallet Balance <span class="badge pull-right">
		<?php 
		$usero = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
		echo x_count("withdrawalbase","type='topup' AND email='$usero'");?></span></div>
		<div class="panel-body">
		<div id="galleryy"><img src="../image/load.gif"/></div>
<form id="topitup" method="POST">
<p class="banp"> Enter Amount* </p>
<?php
//Getting limit from db!
	if(x_count("withdrawal_limit","status='approved' AND type='topup' LIMIT 1") > 0){
		
	foreach(x_select("amount,currency","withdrawal_limit","status='approved' AND type='topup'","1","id") as $key){
	
	$ramt = $key["amount"];
	$rkl = number_format($ramt,2);
	$rcur = $key["currency"];
			
	/***if($mainamt < $ramt){
	echo "You can not withdraw less than $rcur $rkl !";
	exit();
	}***/
	?><input type="number" id="amount" maxlength="6" min="<?php echo $ramt;?>" max="" required="required" placeholder="Enter amount to top-up" name="amount" class="form-control ttx"/><?php
			}
			
		}else{
			//No limit found
			?><input type="number" id="amount" maxlength="6" min="" max="" required="required" placeholder="Enter amount to top-up" name="amount" class="form-control ttx"/><?php
			}
			//Getting limit from db! ended
?>

<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="topup" value="<?php echo sha1(rand());?>"/>
						      
<button class="btn btn-primary" id="bup"><i class="fa fa-credit-card"></i> Top-up Now</button>
</form>

		
		
		</div>
		</div>
		
		</div>
		
		

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<button id="wfbtn" class="btn btn-success tumi"><i class="fa fa-credit-card"></i> Withdraw Funds</button>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<button id="tubtn" class="btn btn-primary tumi"><i class="fa fa-credit-card"></i> Top up Wallet</button>
		</div>
		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
		<div class="boxme13">
			<span class="fa fa-credit-card gl"></span>
			<h1 class="tp">
				<?php
			$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
			if(x_count("userdb","email='$user' LIMIT 1") > 0){
				foreach(x_select("wallet_balance,wallet_currency","userdb","email='$user'","1","name") as $key){
					$wb = $key["wallet_balance"];
					$wc = $key["wallet_currency"];
					
					echo $wc." ".number_format($wb,2);
					}

				
				}else{
					echo "<h2 class='mer'>Inactive user</h2>";
					}
			
			?>
			</h1>
			<p class="tti">Available Balance</p>
			</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
				<div class="boxme1">
			<span class="fa fa-money gl"></span>
			<h1 class="tp">
			<?php
			$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
			if(x_count("userdb","email='$user' LIMIT 1") > 0){
				foreach(x_select("wallet_balance,wallet_currency","userdb","email='$user'","1","name") as $key){
					$wb = $key["wallet_balance"];
					$wc = $key["wallet_currency"];
					
					 //checking for pending professional balance
 
	if(x_count("clientpayment","payment_approval='No' AND userto='$user' LIMIT 1") > 0){
		
		$summat = x_sum("amount","clientpayment","payment_approval='No' AND userto='$user'");
		$npy = $summat;
		
		}else{
			
			$npy = 0;
			
			}
	//checking for pending professional balance
					
					if(x_count("projects","owner='$user' AND payment_status='active' LIMIT 1") > 0){
					$gsum = x_sum("amount_to_pay","projects","owner='$user' AND payment_status='active' AND completion_status='inactive'");
					if($gsum > $wb){
						$nbal = abs($gsum - ($wb - $npy));
						}else{
							$nbal = abs(($wb-$npy) - $gsum);
							}
					
					echo $wc." ".number_format($nbal,2);
						
						}else{
							$mb = abs($wb - $npy) ;
							echo $wc." ".number_format($mb,2);
							}
					
					}

				
				}else{
					echo "<h2 class='mer'>Inactive user</h2>";
					}
			
			?>
			</h1>
			<p class="tti">Withdrawable Amount</p>
			</div>
			</div>
			
			
<?php include("ads.php");?>
			
			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 trnm">
		<div class="panel panel-default">
		<div class="panel-heading fath"><i class="fa fa-bell"></i> Transactions From withdrawals / Top Up <span class="badge pull-right"><?php $userba = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]); echo x_count("withdrawalbase","email='$userba'");?></span></div>
		<div class="panel-body fathh">
		<?php
		
		if(x_count("withdrawalbase","email='$userba'") > 0){
			
		$counter=0;
		echo "<table class='table table-hover table-striped'>";
		?><tr>
			<th>No</th><th>Amount</th><th>Trans.Type</th><th>status</th><th>Timestamp</th>
			</tr><?php
	foreach(x_select("email,amount,timereal,type,status","withdrawalbase","email='$userba'","25","id desc") as $key){
	$counter++;
	$em = $key["email"];
	$amt = $key["amount"];
	$type = $key["type"];
	$time = $key["timereal"];
	$status = $key["status"];
	
	if(x_count("userdb","email='$em' LIMIT 1") > 0){
		
		foreach(x_select("wallet_currency","userdb","email='$em'","1","id") as $key){
			$wc = $key["wallet_currency"];
			
			?>
	<tr>
	<td><?php echo $counter;?></td><td><?php echo "$wc ".number_format($amt,2);?></td><td>
	<?php
	if($type == "topup"){
		echo "<font style='color:blue;'><i class='fa fa-credit-card'></i> $type</font>";
		}elseif($type == "withdrawal"){  
			 echo "<font style='color:green;'><i class='fa fa-money'></i> $type</font>";
			}else{
			 echo "Nil";
			}
	
	
	?></td><td><?php echo $status;?></td><td><?php echo $time;?></td>
	</tr>
	
	<?php
			
			}
		
		
		}else{
			
			}
	
	
	}
	echo "</table>";
	}else{
		echo "<center><i class='fa fa-trash' style='color:lightgray;font-size:60pt;'></i><br/>No transaction record found!<br/></center>";
		}
		
		?>
		</div>
		</div>
		
		</div>
		
		
		<?php include("ads.php");?>
		<!----Transaction FEE PANEL---->
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 trnm">
		<div class="panel panel-default">
		<div class="panel-heading fath"><i class="fa fa-bell"></i> Transactions Fees <span class="badge pull-right">
		<?php 
		echo x_count("topup_withdraw","status='approved'");?></span></div>
		<div class="panel-body fathh">
		<?php
		if(x_count("topup_withdraw","status='approved'") > 0){	
		$counter=0;
		echo "<table class='table table-hover table-striped'>";
		?><tr>
			<th>No</th><th>Transaction Type</th><th>Transaction Fee</th>
			</tr><?php
	foreach(x_select("currency,type,amount,status","topup_withdraw","status='approved'","2","id desc") as $key){
	$counter++;
	$em = $key["currency"];
	$amt = $key["amount"];
	$type = $key["type"];
	$status = $key["status"];

	?>
	<tr>
			<td><?php echo $counter;?></td><td><?php echo $type;?></td><td><?php echo "$em ".number_format($amt,2);?></td>
			</tr>
	<?php
	
	}
	echo "</table>";
	}else{
		echo "<center><i class='fa fa-trash' style='color:lightgray;font-size:60pt;'></i><br/>No transaction fee record found!<br/></center>";
		}
		
		?>
		</div>
		</div>
		
		</div>



</div>
<!---<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>--->
</div>
