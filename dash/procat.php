<?php
require_once("../finishit.php");
if(x_count("paper_category","0") > 0){
		foreach(x_select("category","paper_category",0,0,"category") as $key){
		$bank = $key["category"];
		echo "<option value='$bank'>$bank</option>";
	}
}
else{
	echo "<option value=''>No bank found</option>";
}
?>
