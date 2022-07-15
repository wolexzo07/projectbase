<?php
include_once("../../finishit.php");
if(isset($_POST["id"]) && isset($_POST["token"])){
	$id = xp("id");
	$token = xp("token");
	
if(x_count("buy_sell","id='$id' AND token='$token' LIMIT 1") > 0){

if(x_count("buy_sell","id='$id' AND token='$token' AND status='declined' LIMIT 1") > 0){
	echo "Declined Already";
}else{
	x_update("buy_sell","id='$id' AND token='$token'","status='declined'","project declined!","Failed to deny project!");
		echo "Declined";
}

	}else{
	echo "Inactive";
		}
	
	}else{
		?>
		<script>
		alert("Parameter missing");
		load("fpine/pons");
		</script>
		<?php
		
		}


?>
