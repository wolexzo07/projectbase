<?php
include("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_POSITION_2018_VISION"])){
$pid = xp("pid");
$ptok = xp("ptoken");
if(x_count("projects","id='$pid' AND token='$ptok' LIMIT 1") > 0){
	if(x_count("projects","id='$pid' AND token='$ptok' AND status='inactive' LIMIT 1") > 0){
		x_update("projects","id='$pid' AND token='$ptok'","status='active'","0","Failed");
		echo "Approved";
	}else{
		echo "active already";	
	}

}else{
	echo "Invalid Project";
}

}else{
	echo "Session expired";
}
?>