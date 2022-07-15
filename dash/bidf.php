<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">

	<?php
if(isset($_GET['key']) && isset($_GET['tid']) && !empty($_GET['key']) && !empty($_GET['tid'])){
	?>
	<h3 class="yii"><i class="glyphicon glyphicon-briefcase"></i> Jobs Biddings</h3>
		
	
<?php

 include("bidboss.php");?>
	<?php
	
	}else{
		echo "Failed to load!!";
		
		}?>

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
