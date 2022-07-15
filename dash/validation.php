<?php
if(x_count("portalmode","status='offline' AND id='1' LIMIT 1") > 0){
	
	finish("../notify/maintenance","Access denied!");
	exit();
}
if(!isset($_SESSION["PBNG_ID_2018_VISION"])){
	
	?>
	<script type="text/javascript"> window.location='../login';</script>
	<?php
	exit();
	}

?>