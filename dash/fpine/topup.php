<div style="margin-top:20pt;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">

<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-credit-card"></i> RECENT TOP-UP</div>
<div class="panel-body">

<?php
if(x_count("withdrawalbase","type='topup' LIMIT 1") > 0){
	?>
<table style="background-color:white;margin-top:0pt;" class="table table-striped table-hover tabover">
	<tr>
	<th>No.</th><th>Photo</th><th>Name</th><th>Paystack ID</th><th>Amount</th><th>Profit</th>
	<th>Date</th><th>Status</th><th>Action</th></tr>
	<?php
$counter = 0;	
foreach(x_select("id,email,amount,paystackid,profit,timereal,status","withdrawalbase","type='topup'","50","id desc") as $key){
$counter++;
		$id = $key["id"];
		$email = $key["email"];
		$amount = "NGN ".number_format($key["amount"],2);
		$payid = $key["paystackid"];
		$profit = $key["profit"];
		$tr = $key["timereal"];
		$stat = $key["status"];
		
		foreach(x_select("user_photo,name,mobile","userdb","email='$email' AND status='active'","1","id desc") as $keu){
		$pht = $keu["user_photo"];
		$nam = $keu["name"];
		$mobile_u = $keu["mobile"];
		}
		
		?>
		<tr>
		<td><?php echo $counter;?></td>
		<td><img src="<?php echo "../".$pht;?>" class="img-responsive" style="width:30px;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;"/></td>
		<td>
		<?php echo $nam;?><br/>
		<font style="color:green;"><?php echo $email;?></font>
		<br/>
		<font style="color:blue;"><?php echo $mobile_u;?></font></td>
		<td><?php echo $payid;?></td>
		<td><?php echo $amount;?></td>
		<td><?php echo $profit;?></td>
		<td><?php echo $tr;?></td>
		<td><?php echo $stat;?></td>
		<td>
		<?php
		if($stat == "approved"){
		echo "<font style='color:blue;'>Completed</font>";
		}else{
		?>
		$stat
		<?php
		}
		?>

		</td>
		</tr>
		<?php
	}
	?></table><?php
}else{
	echo "<center><p> <i class='fa fa-credit-card' style='font-size:50pt;'></i><br/><br/> No Top-up History</p></center>";
}
?>

</div>

</div>

</div>
