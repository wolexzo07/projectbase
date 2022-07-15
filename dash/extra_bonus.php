<?php

// starting referral payments

if(x_count("referral_percentage","id='1' LIMIT 1") > 0){
foreach(x_select("referred_buyer,referred_student","referral_percentage","id='1'","1","id") as $key){
$ref_buyer = $key["referred_buyer"];  //Referred project buyer percentage
$ref_student = $key["referred_student"];  //Referred fresh project poster percentage

$ref_buyer_percent = ($ref_buyer/100)*$commission;
$ref_student_percent = ($ref_student/100)*$commission;

//checking for whether refer is active or not

if($referred_user != ""){
	
	if(x_count("userdb","email='$referred_user' LIMIT 1") > 0){
	
	foreach(x_select("wallet_balance,name","userdb","email='$referred_user'","1","id") as $key){
		$tok = sha1(xrands(10));
		$referred_user_name = $key["name"];
		$rwb = $key["wallet_balance"];
		$new_rwb = $rwb + $ref_student_percent;
		
		//Update referred user balance 
		
		x_update("userdb","email='$referred_user'","wallet_balance=$new_rwb'","0","0");

//send notification to the referred user

$bco = number_format($ref_student_percent,2);

x_insert("type,title,email,message,status,rtime,stime","notifyme","'p','YOU JUST EARNED NGN $bco REFERRAL BONUS!','$referred_user','Congratulations $referred_user_name! You just earned referral bonus of <b>NGN $bco</b> from a user called <b>$apname ( $owner )</b>.Thank you','0','$rtime','$time'","","Failed to send notification");

include_once("donemail.php");
		
//insert the bonus into ref_biz database

$position = x_clean($_SESSION["PBNG_POSITION_2018_VISION"]);	
$py = "";	
x_insert("status,paidfrom,paidto,paystack_id,currency,refamount,total_amount,percent,trans_type,trans,type,paydate,rpaydate,token","ref_biz","'approved','$owner','$referred_user','$py','NGN','$ref_student_percent','$commission','$ref_student','fp','credit','$position','$time','$rtime','$tok'","","Failed to update ref data");
		
		
	}
		
	}else{
		//echo "Inactive Referral";
	}
	
}else{
	//echo "No body was referred by $user";
}

//checking for whether refer is active or not
}

}else{
	
	//echo "Inactive referral system";
	
}


// Ending referral payments

?>
