<?php
include("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"]) && isset($_GET["q"]) && !empty($_GET["q"])){
$id = xg("q");

if(x_count("workdone","id='$id' LIMIT 1") > 0){
	
	foreach(x_select("download_times","workdone","id='$id'","1","id") as $key){
		
		$dt = $key["download_times"];
		$ndt = $dt + 1;
		
		x_update("workdone","id='$id'","download_times='$ndt'","0","0");
		
		//echo success
		}
	
	}else{
		
		echo "Invalid parameter";
		
		}

}else{

echo "Parameter Missing";

}


?>
