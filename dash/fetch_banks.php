<?php
require_once("../finishit.php");
if(x_count("banks_info","0") > 0){
		foreach(x_select("banks","banks_info",0,0,"banks") as $key){
		$bank = $key["banks"];
		echo "<option value='$bank'>$bank</option>";
	}
}
else{
	echo "<option value=''>No bank found</option>";
}
?>