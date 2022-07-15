<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<?php
if(x_count("transaction","status='approved' OR status='pending' LIMIT 1") > 0){
	?>
	<table style="background-color:white;margin-top:20pt;" class="table table-striped table-bordered table-hover">
	<caption class="">NEW PAYMENTS</caption>
	<tr>
	<th>No.</th><th>Photo</th>
	<th>Name</th>
	<th>Project</th><th>Payment ID</th><th>Amount</th>
	<th>Status</th><th>Action</th>
	</tr>
	<?php
	$counter=0;
	foreach(x_select("paystack_id,owner,pid,amount,currency,status,paystack_verify","transaction","status='approved' OR status='pending'","50","id desc") as $base){
		$counter++;
		$user = $base["owner"];
		$pid = $base["pid"];
		$amt = $base["amount"];
		$cur = $base["currency"];
		$stat = $base["status"];
		$payid = $base["paystack_id"];
		$payverify = $base["paystack_verify"];
		
		
		foreach(x_select("user_photo,name","userdb","email='$user' AND status='active'","1","id desc") as $keu){
		$pht = $keu["user_photo"];
		$nam = $keu["name"];
		}
		
		foreach(x_select("ptitle","projects","id='$pid' AND status='active'","1","id desc") as $keui){
		$ptitle = $keui["ptitle"];
	
		}
		
		?>
		<tr align='left'>
		<td><?php echo $counter;?></td>
		<td><img src="<?php echo "../".$pht;?>" class="img-responsive" style="width:30px;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;"/></td>
		<td><?php echo $nam;?></td>
		<td><?php echo ucfirst(strtolower($ptitle));?></td>
		<td><?php echo $payid;?></td>
		<td><?php echo $cur." ".number_format($amt,2);?></td>
		<td><?php echo $stat;?></td>
		<td>
			<?php
			if($payid == ""){
				?><span class="badge" style="padding:10px;"><i class="fa fa-shopping-cart"></i> &nbsp;Awaiting</span><?php
				}else{
					?>
						<?php 
		if($payverify == "yes"){
			echo "<button class='btn btn'>Verified</button>";
			}else{
				?>
			
		<button class="btn btn-primary" onclick=""><i class="fa fa-check"></i> verify&nbsp;&nbsp;&nbsp;</button>
		<button class="btn btn-danger" onclick=""><i class="fa fa-minus"></i> Decline</button>
				<?php
				}
		?>
					<?php
					}
			
			?>
	

		</td>
		</tr>
		<?php
	}
	?></table><?php
}else{
	
}
?>
</div>
