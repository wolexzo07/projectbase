	<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' LIMIT 1") > 0){
	foreach(x_select("wallet_currency,posted_job,bidded_job,approved_job,cancelled_job,completed_job,earned_job,total_spent_onjob,wallet_balance,token","userdb","email='$user' AND status='active'","1","name") as $key){
	$pj = $key["posted_job"];$wc = $key["wallet_currency"];$bj = $key["bidded_job"];$aj = $key["approved_job"];
	$cancel = $key["cancelled_job"];$cj = $key["completed_job"];$ej = $key["earned_job"];
	$ts = $key["total_spent_onjob"];$wb = $key["wallet_balance"];
	$tok = $key["token"];
	}
	}else{
		exit();
		}
?>	
			
			
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
			
			<div class="boxmep">
			<span class="fa fa-bank gl"></span>
			<h1 class="tp"><?php echo "NGN ".number_format(x_sum("amount","withdrawalbase","email='$user' AND status='pending' AND type='withdrawal'"),2);?></h1>
			<p class="tti">Pending Withdrawals</p>
			</div>
			
			</div>				
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
			
			<div class="boxme">
			<span class="fa fa-briefcase gl"></span>
			<h1 class="tp"><?php echo "NGN ".number_format(x_sum("amount","withdrawalbase","email='$user' AND status='approved' AND type='withdrawal'"),2);?></h1>
			<p class="tti">Approved Withdrawals</p>
			</div>
			
			</div>
				
				
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxme12">
			<span class="fa fa-users gl"></span>
			<h1 class="tp">
			<?php 
			echo x_count("userdb","position='professional' AND ref='$user'");
			?></h1>
			<p class="tti">Referred Professionals 
			</div>
			</div>
			
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxme13">
			<span class="fa fa-user gl"></span>
			<h1 class="tp">
			<?php 
			echo x_count("userdb","position='student' AND ref='$user'");
			?>
			</h1>
			<p class="tti">Referred Students </p>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxme1">
			<span class="fa fa-credit-card gl"></span>
			<h1 class="tp"><?php 
			echo x_count("userdb","position='marketer' AND ref='$user'");
			?></h1>
			<p class="tti">Referred Marketers </p>
			</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
				<div class="boxmel">
			<span class="glyphicon glyphicon-ok-sign gl"></span>
			<h1 class="tp">
				<?php 
			echo x_count("userdb","ref='$user'");
			?></h1>
			<p class="tti">Total Referred</p>
			</div>
			</div>
			
		
				

			<!---<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			<div class="boxme2">
			<span class="glyphicon glyphicon-minus-sign gl"></span>
			<h1 class="tp"><?php echo $cj;?></h1>
			<p class="tti">Completed Jobs</p>
			</div>
			</div>
			<div  class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center">
			<div class="boxme3">
			<span class="glyphicon glyphicon-check gl"></span>
			<h1 class="tp"><?php echo $aj;?></h1>
			<p class="tti">Approved Jobs</p>
			</div>
			</div>--->
			
			
			
<?php include("ads.php");?>
			
			
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 upo">
				
			<div style="overflow-x:auto;" class="panel panel-default">
				
			<div class="panel panel-heading">
				<i class="fa fa-users"></i> Refer someone and earn 
			</div>
			
			<div class="panel panel-body">
			
			<table class="table table-responsive">
			<tr>
			<td>
			<?php
$refcode = "refcode/".$tok.md5(1).".png";
if(file_exists($refcode)){
echo "";
}else{
 $trk = "https://<?php echo $host;?>?ref_code=".$tok;
QRcode::png("$trk", "$refcode", "H", 4, 2);
}
			?>
			<img src="<?php echo $refcode;?>" class="qrcod"/>
			</td>
			
			<td><p class='lin'><a href="https://<?php echo $host;?>?ref_code=<?php echo $tok;?>">https://<?php echo $host;?>?ref_code=<?php echo $tok;?></a></p>
			</td>
			
			</tr>
			
			<tr>
			<td> 
			<?php
$refcodee = "refcode/".$tok.md5(2).".png";
if(file_exists($refcodee)){
echo "";
}else{

 $trkk = "https://<?php echo $host;?>/register?ref_code=".$tok;
QRcode::png("$trkk", "$refcodee", "H", 4, 2);
}
			?>
			<img src="<?php echo $refcodee;?>" class="qrcod"/>
			</td>
			<td>
			<p class='lin'><a href="https://<?php echo $host;?>/register?ref_code=<?php echo $tok;?>">https://<?php echo $host;?>/register?ref_code=<?php echo $tok;?></a></p>
			</td>
			</tr>
			
			</table>
			
			</div>
			</div>
			
			</div>
