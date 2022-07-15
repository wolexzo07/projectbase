<?php
include("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"]) && isset($_GET["q"]) && !empty($_GET["q"])){
$id = xg("q");

if(x_count("notifyme","id='$id' LIMIT 1") > 0){
	
	foreach(x_select("status,type","notifyme","id='$id'","1","id") as $key){
		$status = $key["status"];
		$type = $key["type"];
		
		if(($status == "0") && ($type=="p")){
			x_update("notifyme","id='$id'","status='1'","0","0");
			
			}else{
				
				}
		}
	
	}else{
		
		echo "Invalid parameter";
		}

}else{

echo "Parameter Missing";
}


?>
