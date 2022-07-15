<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 sper">
<?php
#include("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && !empty($_SESSION["PBNG_ID_2018_VISION"]) && isset($_GET['id']) && isset($_GET['token'])){
	$pid = xg("id");
	$ptoken = xg("token");
	$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);

?>
<h3 style="text-align:center;padding:15px;">PBNG Project <font style="color:green;">Payment </font></h3>
<button onclick="load('buyprojectbase')" style="padding:10px;margin-top:0pt;margin-bottom:10pt;" class="btn btn-success"><i class="fa fa-arrow-left"></i> </button>
<?php
//get project title and amount
if(x_count("buy_sell","id='$pid' AND token='$ptoken'") > 0){
	foreach(x_select("amount,ptitle","buy_sell","id='$pid' AND token='$ptoken'","1","ptitle") as $key){
$ptitle = $key["ptitle"];
$amp = $key["amount"];
?><button style="padding:10px;margin-top:0pt;margin-bottom:10pt;" class="btn btn-primary"><i class="fa fa-briefcase"></i> 
<?php echo $ptitle;?></button><?php

	$amt = $amp;
	
	//get paystack charge of 1.5% + 100
	if($amt < 2500){
		
		$charge = (1.5/100)*$amt;
		
		}else{
			$charge = ((1.5/100)*$amt) + 100;
			}
	
	$paynow = ($amt + $charge) * 100;
	
	?>
<h4>Hi, <font style="color:green;"><?php echo ucwords(strtolower($_SESSION["PBNG_NAME_2018_VISION"]));?></font></h4>

<!---Start the payment gateway--->

<?php
if(x_count("paymentkeys","status='Yes' LIMIT 1") > 0){
foreach(x_select("secretkey,publickey","paymentkeys","status='Yes'","1","id") as $key){

		$sk = $key["secretkey"];
		$pk = $key["publickey"];
		
		?>
		
		<div id="paystackEmbedContainer"></div>

<script>
  PaystackPop.setup({
   key: '<?php echo $pk;?>',
   email: '<?php echo $user;?>',
   amount: <?php echo $paynow;?>,
   container: 'paystackEmbedContainer',
   callback: function(response){
	   var rip = response.reference;
	   var un = "completepro?id=<?php echo $pid;?>&token=<?php echo $ptoken;?>&reference=" + rip ;
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
<td>Project Fee</td><td><?php echo "NGN ".number_format($amt,2);?></td>
</tr>

<tr>
<td>Payment Gateway</td><td><?php echo "NGN ".number_format($charge,2);?></td>
</tr>

<tr>
<th>Total Amount</th><th><?php echo "NGN ".number_format(($paynow/100),2);?></th>
</tr>
</table>
		<?php
		
		}
}else{

echo "Payment key deactivated!";

}
?><?php

}


	}else{
		echo "Invalid project detected!";
		}


?>


<?php
	
}

?>
</div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12"></div>
</div>
