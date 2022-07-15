<?php 
#include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style='background-color:white'>
<?php
include("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && !empty($_SESSION["PBNG_ID_2018_VISION"]) && isset($_GET["reference"]) && !empty($_GET["reference"])){

$paystackid = xg("reference");
?>
<h3 style="text-align:center;padding:15px;"><i class="fa fa-credit-card"></i> PBNG Subscription <font style="color:green;">Payment </font></h3>

<h4>Hi, <font style="color:green;"><?php echo ucwords(strtolower($_SESSION["PBNG_NAME_2018_VISION"]));?></font></h4>
<?php
 
 //including main payment verification file
 include_once("payex.php");

?>

<?php
	
}else{
	echo "Parameter Missing for subcription";
	}

?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
