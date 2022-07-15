<?php
include_once("../finishit.php");
if(isset($_POST["pid"]) && isset($_POST["ptoken"]) && !empty($_POST["ptoken"]) && !empty($_POST["pid"])){
$pid = xp("pid");$ptoken = xp("ptoken");$bidder = xp("bidder");$powner = xp("powner");$date = x_curtime("0","1");$comment = xp("comment");
$create = x_dbtab("review","
bidder VARCHAR(100) NOT NULL,
powner VARCHAR(100) NOT NULL,
comment TEXT NOT NULL,
pid VARCHAR(100) NOT NULL,
ptoken VARCHAR(300) NOT NULL,
date_time DATETIME NOT NULL
","MYISAM");

if($create){
	
	if(x_count("projects","id='$pid' AND token='$ptoken' AND approved_to='$bidder' LIMIT 1") > 0){
	
	if(x_count("review","pid='$pid' AND ptoken='$ptoken' LIMIT 1") > 0){
			x_update("review","bidder='$bidder',powner='$powner',comment='$comment',pid='$pid',ptoken='$ptoken',date_time='$date'","pid='$pid' AND ptoken='$ptoken'","","<p class='hubmsg'>Failed to update!</p>");
			echo "<p class='hubmsg'>Review updated successfully!</p>";
	}else{
	x_insert("bidder,powner,comment,pid,ptoken,date_time","review","'$bidder','$powner','$comment','$pid','$ptoken','$date'","<p class='hubmsg'>Review submitted successfully!</p>","<p class='hubmsg'>Failed to insert data!</p>");
	}
		
	}else{
	echo "<p class='hubmsg'>Invalid Permission!</p>";	
	}
	
}else{
echo "<p class='hubmsg'>Failed to create table!</p>";	
}

	
}else{
	
	
}
?>