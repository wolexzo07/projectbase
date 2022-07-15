<?php
include_once("../finishit.php");
if(isset($_GET["id"]) && isset($_GET["token"])){
	$id = xg("id");
	$token = xg("token");
	
if(x_count("buy_sell","id='$id' AND token='$token' AND status='pending' LIMIT 1") > 0){
	foreach(x_select("filepath,abfilepath,sfilepath","buy_sell","id='$id' AND token='$token' AND status='pending'","1","id") as $key){
		$fp = $key["filepath"];$abfp = $key["abfilepath"];$sfp = $key["sfilepath"];
	}
		if(file_exists($fp) && ($fp != "")){
		unlink($fp);	
		}
		if(file_exists($abfp) && ($abfp != "")){
		unlink($abfp);	
		}
		if(file_exists($sfp) && ($sfp != "")){
		unlink($sfp);	
		}
	x_del("buy_sell","id='$id' AND token='$token' AND status='pending'","<script>alert('project deleted!');load('pfs');</script>","Failed to delete");
	
	}else{
		?>
		<script>
		alert("You can not delete an approved or declined project!");
		load("pfs");
		</script>
		<?php
		}
	
	}else{
		?>
		<script>
		alert("Parameter missing");
		load("pfs");
		</script>
		<?php
		
		}


?>
