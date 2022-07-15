<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<?php
require_once("../../finishit.php");
if(isset($_GET['key']) && isset($_GET['tid']) && !empty($_GET['key']) && !empty($_GET['tid'])){
	
	$token = xg("key");
	$email = xg("tid");
	if(x_count("projects","id='$email' AND token='$token' AND processing_status='inactive' LIMIT 1") > 0){
		foreach(x_select("0","projects","id='$email' AND token='$token' AND processing_status='inactive'","1","id") as $key ){
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
		
		$bds = $key["bidded_status"];
		$pys = $key["payment_status"];
		$pps = $key["processing_status"];
		
	foreach(x_select("user_photo","userdb","email='$user' AND status='active'","1","name") as $key){
	$photo = $key["user_photo"];
	}
	
		?>
<button onclick="load('profbase/avaljobs')" style="padding:15px;width:250px;margin-bottom:20pt;" class="btn btn-success"><i class="fa fa-briefcase"></i> AVAILABLE JOBS &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge"><?php

if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
	$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	echo x_count("projects","processing_status='inactive'");
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
		
				<?php
		#$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
		$posl = xclean($_SESSION["PBNG_POSITION_2018_VISION"]);
		if(($pys == "active") || ($posl == "super")){
		
		if(x_count("userdb","email='$user' LIMIT 1") > 0){
		
		foreach(x_select("email,mobile","userdb","email='$user'","1","id") as $key ){
		$mob = $key["mobile"];
		$emal = $key["email"];
		
?>
<tr><th><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; MOBILE</th><td><?php echo htmlspecialchars($mob);?></td></tr>

<tr><th><i class="fa fa-inbox"></i>&nbsp;&nbsp;&nbsp; EMAIL</th><td><?php echo htmlspecialchars($emal);?></td></tr>
<?php
		
		}
			}else{
			echo "No user found!";
			}
		
			}else{
				
				
				}
		
		?>
		
		<tr>
		<th><i class="glyphicon glyphicon-time"></i>&nbsp;&nbsp;&nbsp; POSTED ON</th><td><?php echo htmlspecialchars(ucfirst(strtolower($tr)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp; STATUS</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($status)));?></b></td>
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
		echo "Project is now approved to someone";
	}
	
	
}else{
	echo "Parameter Missing";
}
?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
