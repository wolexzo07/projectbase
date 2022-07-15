
<div class="row">
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12" style='background-color:white;box-shadow:0 0 5px #cbcbcb;
-webkit-box-shadow:0 0 5px #cbcbcb;
-moz-box-shadow:0 0 5px #cbcbcb;'>
<?php
include("../finishit.php");
xstart("0");
if(x_count("paymentkeys","status='Yes' LIMIT 1") > 0){
	
$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
$position = x_clean($_SESSION["PBNG_POSITION_2018_VISION"]);	

foreach(x_select("secretkey,publickey","paymentkeys","status='Yes'","1","id") as $key){

		$sk = $key["secretkey"];
		$pk = $key["publickey"];
		
		if(x_count("subcription","type='$position'") > 0){
			
	foreach(x_select("amount","subcription","type='$position'","1","id") as $key){

		$samt = $key["amount"];
		
		
			//paystack charge
		if($samt < 2500){
		$charge = (1.5/100)*$samt;
		}else{
			$charge = ((1.5/100)*$samt) + 100;
			}
			//paystack charge ended
			
			$ramt = ($samt + $charge) * 100 ;
		
		?>
<h3 style="text-align:center;padding:15px;">PBNG Subscription <font style="color:green;">Payment </font></h3>
<h4>Hi, <font style="color:green;"><?php echo ucwords(strtolower($_SESSION["PBNG_NAME_2018_VISION"]));?></font></h4>

<div id="paystackEmbedContainer"></div>
<script>
  PaystackPop.setup({
   key: '<?php echo $pk;?>',
   email: '<?php echo $user;?>',
   amount: <?php echo $ramt;?>,
   container: 'paystackEmbedContainer',
   callback: function(response){
	   var rip = response.reference;
	   var un = "payall?reference=" + rip ;
		load(un);
    },
  });
  
</script>

<table class="table table-striped table-hover">
	<caption class="clapp"><i class="fa fa-credit-card"></i> PAYMENT BREAKDOWN</caption>
<tr>
<th>Fees Breakdown</th><th>Amount</th>
</tr>

<tr>
<td>Subscription Fee</td><td><?php echo "NGN ".number_format($samt,2);?></td>
</tr>

<tr>
<td>Payment Gateway</td><td><?php echo "NGN ".number_format($charge,2);?></td>
</tr>

<tr>
<th>Total Amount</th><th><?php echo "NGN ".number_format(($ramt/100),2);?></th>
</tr>
</table>
		<?php
		
	}
			
			}else{
				
				echo "No sub amount specified!";
				
				}
	
		
		}
}else{

echo "Payment key deactivated!";

}
?>

</div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12"></div>
</div>
