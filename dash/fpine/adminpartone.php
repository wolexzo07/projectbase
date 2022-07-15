	<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' LIMIT 1") > 0){
	foreach(x_select("wallet_currency,posted_job,bidded_job,approved_job,cancelled_job,completed_job,earned_job,total_spent_onjob,wallet_balance","userdb","email='$user' AND status='active'","1","name") as $key){
	$pj = $key["posted_job"];$wc = $key["wallet_currency"];$bj = $key["bidded_job"];$aj = $key["approved_job"];
	$cancel = $key["cancelled_job"];$cj = $key["completed_job"];$ej = $key["earned_job"];
	$ts = $key["total_spent_onjob"];$wb = $key["wallet_balance"];
	}
	}else{
		exit();
		}
?>	
<script src="js/jquery-1.11.1.min.js"></script>
<script>
$(document).ready(function(){
$("#imgbase").click(function(){
$(".baseme").fadeToggle("slow");	
});
});
</script>
<style type="text/css">
.baseme{
	display:none;
	}
</style>
<div class="baseme">

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
				<div class="boxme13">
			<span class="fa fa-money gl"></span>
			<h1 class="tp"><?php 
			echo "NGN ";
			$date = date("Y-m-d");
			$sub = x_sum("amount","clientpayment","payment_approval='No' AND currency='NGN'");
			if($sub == ""){
				echo number_format(0,2);
			}else{
				echo number_format($sub,2);
			}
			?></h1>
			<p class="tti">Pending Professionals Payment</p>
			</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
			<div class="boxme1">
			<span class="glyphicon glyphicon-credit-card gl"></span>
			<h1 class="tp"><?php 
			echo "NGN ";
			$date = date("Y-m-d");
			$sub = x_sum("amount","clientpayment","payment_approval='Yes' AND currency='NGN'");
			if($sub == ""){
				echo number_format(0,2);
			}else{
				echo number_format($sub,2);
			}
			?></h1>
			<p class="tti">Approved Professionals Payment</p>
			</div>
			</div>



				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			
			<div class="boxmep">
			<span class="fa fa-user gl"></span>
			<h1 class="tp"><?php echo x_count("userdb","status='active' AND other_status='nil' AND position='super'");?></h1>
			<p class="tti">Active Superadmin</p>
			</div>
			
			</div>				
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			
<div class="boxme">
<span class="fa fa-users gl"></span>
<h1 class="tp"><?php echo x_count("userdb","status='active' AND other_status='nil' AND position='admin'");?></h1>
<p class="tti">Active Admin</p>
</div>
			
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			<div class="boxme2">
			<span class="fa fa-money gl"></span>
			<h1 class="tp">
			<?php 
			echo "NGN ";
			$date = date("Y-m-d");
			$sub = x_sum("amount","transaction","status='approved' AND currency='NGN' AND paydate LIKE '$date%'");
			if($sub == ""){
				echo number_format(0,2);
			}else{
				echo number_format($sub,2);
			}
			?></h1>
			<p class="tti">Today student Payment</p>
			</div>
			</div>
			<div  class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			<div class="boxme3">
			<span class="glyphicon glyphicon-credit-card gl"></span>
			<h1 class="tp">
			<?php 
			echo "NGN ";
			$subb = x_sum("amount","transaction","status='approved' AND currency='NGN'");
				if($subb == ""){
				echo number_format(0,2);
			}else{
				echo number_format($subb,2);
			}
			?></h1>
			<p class="tti">Total student Payment</p>
			</div>
			</div>
			
			
			<!-----First panel end here---->
			
			
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxme12">
			<span class="fa fa-users gl"></span>
			<h1 class="tp"><?php echo x_count("userdb","status='active' AND other_status='nil' AND position='professional'");?></h1>
			<p class="tti">Active Professionals</p>
			</div>
			</div>
			
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxme13">
			<span class="fa fa-money gl"></span>
			<h1 class="tp"><?php echo x_count("userdb","status='active' AND other_status='nil' AND position='student'");?></h1>
			<p class="tti">Active Students</p>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxme1">
			<span class="fa fa-edit gl"></span>
			<h1 class="tp"><?php 
			echo x_count("projects","status='inactive'");
			?></h1>
			<p class="tti">Pending Post</p>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxmel">
			<span class="glyphicon glyphicon-ok-sign gl"></span>
			<h1 class="tp"><?php 
				echo x_count("projects","status='active'");
			?></h1>
			<p class="tti">Approved Post</p>
			</div>
			</div>
			
		
				
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			
			<div class="boxmep">
			<span class="fa fa-bank gl"></span>
			<h1 class="tp"><?php echo x_count("projects","status='active' OR status='inactive'");?></h1>
			<p class="tti">Posted Jobs</p>
			</div>
			
			</div>				
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			
<div class="boxme">
<span class="fa fa-briefcase gl"></span>
<h1 class="tp"><?php echo x_count("bidded","status='approved'");?></h1>
<p class="tti">Approved Biddings</p>
</div>
			
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			<div class="boxme2">
			<span class="glyphicon glyphicon-minus-sign gl"></span>
			<h1 class="tp"><?php echo x_count("bidded","status='pending'");?></h1>
			<p class="tti">Pending Biddings</p>
			</div>
			</div>
			<div  class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			<div class="boxme3">
			<span class="glyphicon glyphicon-check gl"></span>
			<h1 class="tp"><?php echo x_count("projects","completion_status='active'");?></h1>
			<p class="tti">Completed Jobs</p>
			</div>
			</div>
			
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
				<div class="boxme3">
			<span class="fa fa-trash gl"></span>
			<h1 class="tp"><?php echo x_count("userdb","status='active' AND other_status='suspend'");?></h1>
			<p class="tti">Suspended Users</p>
			</div>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
			<div class="boxme13">
			<span class="glyphicon glyphicon-remove-circle gl"></span>
			<h1 class="tp"><?php echo x_count("userdb","status='active' AND other_status='blacklist'");?></h1>
			<p class="tti">Blacklisted</p>
			</div>
			</div>
			</div>


<?php include_once("userstat.php");?>
<?php include_once("ongoing.php");?>
<?php include_once("prostat.php");?>
<?php include_once("pending_withdrawal.php");?>
<?php include_once("topup.php");?>
			
<?php include_once("paymentnew_details.php");?>

<div style="margin-top:20pt;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<?php include_once("fpine/propost.php");?>

</div>

<?php include_once("newuser.php");?>

<?php include_once("newproject.php");?>

<?php include_once("newpayment.php");?>
