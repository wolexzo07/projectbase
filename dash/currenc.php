<?php
require_once("../finishit.php");
if(x_count("currency","status='1'") > 0){
		foreach(x_select("currency,des","currency","status='1'",0,"id asc") as $key){
			
		$cur = $key["currency"];
		$des = $key["des"];
		
		echo "<option value='$cur'>$des</option>";
	}
}
else{
	echo "<option value=''>No currency found</option>";
}
?>
