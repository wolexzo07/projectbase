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
	$id = xg("tid");
		
	if(x_count("projects","id='$id' AND token='$token' AND processing_status='inactive' LIMIT 1") > 0){
			foreach(x_select("0","projects","id='$id' AND token='$token' AND processing_status='inactive'","1","id") as $key ){
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
	
		?>
<button onclick="load('profbase/avaljobs')" style="padding:15px;width:200px;margin-bottom:20pt;" class="btn btn-success"><i class="fa fa-briefcase"></i> AVAILABLE JOBS </button>
		<h4 style="display:block;margin-bottom:20pt;" class="protitle"><i class="fa fa-edit"></i> <?php echo htmlspecialchars(ucwords(strtolower($title)));?></h4>
		
		<table class="table table-striped table-hover ftab">
		<tr style='display:none;'>
		<th><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp; PROJECT TITLE</th><td><?php echo htmlspecialchars(ucfirst(strtoupper($title)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp; BUDGETED AMOUNT</th><td><?php echo htmlspecialchars($amt_c." ".number_format($amt,2));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp; TIME FRAME</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($tfrom." <<>> ".$tto)));?></b></td>
		</tr>
		</table>
		
<script src="../log.js"></script>
<form id="bidnow" method="POST">
<p class="banp">Bidding Comment*</p>
<textarea name="message" maxlength="200" required="required" id="pdes" class="form-control pdes"  placeholder="Enter Message"></textarea>
<input type="hidden" name="project_owner" value="<?php echo $user;?>"/>
<input type="hidden" name="bid_email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<input type="hidden" name="pid" value="<?php echo $id;?>"/>
<input type="hidden" name="token" value="<?php echo $token;?>"/>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="bidmenow" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="Bid Now" class="btn btn-primary" id="bup" />
</form>
<div id="gallery"><img src="../image/load.gif"/></div>
		
		<?php
		
	}
	}else{
		echo "Project is approved to someone";
	}

	
}else{
	echo "Parameter Missing";
}
?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
