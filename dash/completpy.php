<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style='background-color:white'>
<?php
#include("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && !empty($_SESSION["PBNG_ID_2018_VISION"]) && isset($_SESSION["PBNG_PAYG"]) && !empty($_SESSION["PBNG_PAYG"]) && isset($_GET["reference"]) && !empty($_GET["reference"])){
$pid = xclean($_SESSION["PBNG_PAYG"]);
$paystackid = xg("reference");
?>
<h3 style="text-align:center;padding:15px;">PBNG Jobs <font style="color:green;">Payment </font></h3>
<button onclick="load('projectpy')" style="padding:10px;margin-top:0pt;margin-bottom:10pt;" class="btn btn-success"><i class="fa fa-arrow-left"></i> </button>
<button style="padding:10px;margin-top:0pt;margin-bottom:10pt;" class="btn btn-primary"><i class="fa fa-briefcase"></i> 
<?php
foreach(x_select("ptitle","projects","id='$pid'","1","ptitle") as $key){
$ptitle = $key["ptitle"];
echo " ".$ptitle;
}
?>
</button>
<h4>Hi, <font style="color:green;"><?php echo ucwords(strtolower($_SESSION["PBNG_NAME_2018_VISION"]));?></font></h4>
<?php
 
 //including main payment verification file
 include_once("payext.php");

?>

<?php
	
}

?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
