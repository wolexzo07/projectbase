<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<?php
require_once("../finishit.php");
if(isset($_GET['key']) && isset($_GET['tid']) && !empty($_GET['key']) && !empty($_GET['tid'])){
	
	$token = xg("key");
	$email = xg("tid");
	foreach(x_select("0","projects","id='$email' AND token='$token'","1","id") as $key ){
		$id = $key["id"];
		$title = $key["ptitle"];
		$status = $key["status"];
		$des = $key["pdes"];
		$tr = $key["timereal"];
		$amt = $key["amount_to_pay"];
		$amt_c = $key["amount_currency"];
		$user = $key["owner"];
		$pcat = $key["pcategory"];
		$tfrom = $key["time_from"];
		$tto = $key["time_to"];
		$token = $key["token"];
		$pay = $key["payment_status"];
	
		?>
<button onclick="load('approved')" style="padding:15px;width:250px;margin-bottom:20pt;" class="btn btn-success"><i class="fa fa-briefcase"></i> APPROVED JOBS &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge"><?php

if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
	$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	echo x_count("projects","owner='$user' AND bidded_status='active' AND processing_status='active'");
}else{
	echo "0";
}

?></span></button>
		<h4 style="display:block;margin-bottom:20pt;" class="protitle"><i class="fa fa-edit"></i> <?php echo htmlspecialchars(ucwords(strtolower($title)));?></h4>
		
		<table class="table table-striped table-hover ftab">
		<tr>
		<th><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp; PROJECT CATEGORY</th><td><?php echo htmlspecialchars(ucfirst(strtoupper($pcat)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp; PROJECT TITLE</th><td><?php echo htmlspecialchars(ucfirst(strtoupper($title)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp; PROJECT DESCRIPTION</th><td><?php echo htmlspecialchars(ucfirst(strtolower($des)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp; BUDGETED AMOUNT</th><td><?php echo htmlspecialchars($amt_c." ".number_format($amt,2));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp; TIME FRAME</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($tfrom." <<>> ".$tto)));?></b></td>
		</tr>
		<tr>
		<th><i class="glyphicon glyphicon-time"></i>&nbsp;&nbsp;&nbsp; POSTED ON</th><td><?php echo htmlspecialchars(ucfirst(strtolower($tr)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp; STATUS</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($status)));?></b></td>
		</tr>
		<tr>
		<th><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp; PAYMENT STATUS</th><td><b style="color:blue;"><?php echo htmlspecialchars(ucfirst(strtolower($pay)));?></b></td>
		</tr>
		
		<!---<tr>
		<th><i class="fa fa-cog"></i>&nbsp;&nbsp;&nbsp; ACTION</th><td>
		<button class="btn btn-primary"><i class="fa fa-edit"></i></button>
		<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
		<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i></button>
		</td>
		</tr>---->
		
		</table>
		<?php
		
	}
	
}else{
	echo "Parameter Missing";
}
?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
