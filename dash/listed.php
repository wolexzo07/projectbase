<p class="banp">Amount Budgeted*</p>
<select name="amount" required="required" class="form-control slec">
<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"]) && isset($_GET["q"])){
	$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	$q = xg("q");
	
	if(x_count("projects","id='$q' AND owner='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND completion_status='inactive' AND payment_status='inactive' LIMIT 1") > 0){
		
foreach(x_select("amount_to_pay,amount_currency","projects","id='$q' AND owner='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND completion_status='inactive' AND payment_status='inactive'","0","ptitle") as $key){

		$amt = $key["amount_to_pay"];
		$c = $key["amount_currency"];
		echo "<option value='$amt'>".$c." ".number_format($amt,2)."</option>";
	}
}
else{
	echo "<option value=''>No project found</option>";
}
}


?>
</select>
