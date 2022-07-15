<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style='background-color:white'>
<?php
#include("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && !empty($_SESSION["PBNG_ID_2018_VISION"]) && isset($_GET["reference"]) && !empty($_GET["reference"]) && isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["token"]) && !empty($_GET["token"])){
$pid = xg("id");
$ptoken = xg("token");
$paystackid = xg("reference");
?>
<h3 style="text-align:center;padding:15px;">PBNG Project<font style="color:green;">Payment </font></h3>
<button onclick="load('buyprojectbase')" style="padding:10px;margin-top:0pt;margin-bottom:10pt;" class="btn btn-success"><i class="fa fa-arrow-left"></i> </button>
<?php
if(x_count("buy_sell","id='$pid' AND token='$ptoken'") > 0){
	foreach(x_select("amount,ptitle","buy_sell","id='$pid' AND token='$ptoken'","1","ptitle") as $key){
$ptitle = $key["ptitle"];
$amp = $key["amount"];
?><button style="padding:10px;margin-top:0pt;margin-bottom:10pt;" class="btn btn-primary"><i class="fa fa-briefcase"></i> 
<?php echo $ptitle;?></button>
<h4>Hi, <font style="color:green;"><?php echo ucwords(strtolower($_SESSION["PBNG_NAME_2018_VISION"]));?></font></h4>

<?php
 //including main payment verification file
 include_once("paymenow.php");
}

}else{
	echo "Invalid Project detected!";
	}


	
}else{
	echo "Parameter Missing!";
	}

?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
