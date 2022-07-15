<?php
#include("finishit.php");
if(isset($_GET["ref_code"]) && !empty($_GET["ref_code"])){

/**
		if(isset($_SESSION["pbng_refcoded"])){
				
			unset($_SESSION["pbng_refcoded"]);
							
			}**/

		$code = xg("ref_code");
		
		if(x_count("userdb","token='$code' LIMIT 1") > 0){
			foreach(x_select("email","userdb","token='$code'","1","email") as $key){
				$email = $key["email"];
				$_SESSION["pbng_refcoded"] = $email;
				session_write_close();
				#finish("./","$email");
				}
				
			}else{

			if(isset($_SESSION["pbng_refcoded"])){
				
			unset($_SESSION["pbng_refcoded"]);
							
			}
			finish("./","Invalid referral");
			
				}

}

?>
