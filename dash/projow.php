<p class="banp">Project Owner*</p>
<select name="owner" required="required" class="form-control slec">
<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"]) && isset($_GET["q"])){
	$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	$q = xg("q");
	
	if(x_count("projects","id='$q' AND approved_to='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND completion_status='inactive' AND payment_status='active' LIMIT 1") > 0){
		
foreach(x_select("owner","projects","id='$q' AND approved_to='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND completion_status='inactive' AND payment_status='active'","1","ptitle") as $key){

		$amt = $key["owner"];
		foreach(x_select("name","userdb","email='$amt'","1","name") as $key){
			$nm = $key["name"];
		}
		echo "<option value='$amt'>".$nm." (".$amt.")</option>";
	}
}
else{
	echo "<option value=''>No project found</option>";
}
}


?>
</select>
