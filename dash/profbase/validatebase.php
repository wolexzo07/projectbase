<?php
include("../../finishit.php");
xstart("0");

include("ads.php");

if(x_count("enable_sub","status='1' LIMIT 1") > 0){

//start generating subscription payment
$userd = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(x_count("userdb","sub_status='inactive' AND email='$userd' LIMIT 1") > 0){
	
?>
<div class="pmes">
<button class="btn btn-danger ptee"><i class="glyphicon glyphicon-remove-circle paybtn"></i> <p class="paytex">Subscription Expired! <br/>Make Payment to access portal.</p></button>

<?php
$posiu = x_clean($_SESSION["PBNG_POSITION_2018_VISION"]);
if(x_count("subcription","type='$posiu' LIMIT 1") > 0){
	foreach(x_select("amount,currency","subcription","type='$posiu'","1","id") as $key){
					
	$sub_amt = $key["amount"];
	$sub_c = $key["currency"];
	
	?><button onclick="load('paysub')" class="btn btn-primary pte"><i class="fa fa-credit-card"></i> PAY FEES <?php echo $sub_c." ".$sub_amt;?> NOW</button><?php
	
					}
	}else{
		echo "<button class='btn btn-danger pte'><i class='fa fa-trash'></i> Failed to get Pricing!</button>";
		
		}

?>


</div>
<?php
exit();
}
}elseif(x_count("enable_sub","status='0' LIMIT 1") > 0){
		//echo "subscription disabled!";
}else{
		//echo "No subscription option is available!";
}

?>
