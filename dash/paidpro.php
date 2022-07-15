<?php
require_once("../finishit.php");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
	$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	
	if(x_count("projects","approved_to='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND completion_status='inactive' AND payment_status='active'") > 0){
		
foreach(x_select("id,ptitle,amount_to_pay,amount_currency,pcategory","projects","approved_to='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND completion_status='inactive' AND payment_status='active'","0","ptitle") as $key){
		$id = $key["id"];
		$bank = ucwords(strtolower($key["ptitle"]));
		$cat = $key["pcategory"];
		$amt = $key["amount_to_pay"];
		$c = $key["amount_currency"];
		echo "<option value='$id'>$bank</option>";
	}
}
else{
	echo "<option value=''>No project found</option>";
}
}


?>
