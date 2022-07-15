<?php
require_once("../finishit.php");
if(x_count("courses","0") > 0){
		foreach(x_select("course","courses",0,0,"course") as $key){
		$bank = $key["course"];
		echo "<option value='$bank'>$bank</option>";
	}
}
else{
	echo "<option value=''>No dept found</option>";
}
?>
