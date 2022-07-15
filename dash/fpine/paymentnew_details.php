<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<table style="background-color:white;margin-top:20pt;" class="table table-striped table-hover">
	<caption class="">PAYMENTS TRANSACTION</caption>
<tr>
<th>Currency</th><th>Pending Prof.</th><th>Approved Prof.</th>
<th>Today std.</th><th>Total Appr std.</th><th>Total Pend std.</th>
<!--<th>Today Appr std.</th>-->
</tr>
<?php
if(x_count("currency","status='1'") > 0){
	foreach(x_select("currency","currency","status='1'","50","currency") as $key){
		$curri = $key["currency"];
	?>
	<tr>
	<td><?php echo $curri;?></td>
	<td><?php 
			echo "$curri ";
			$date = date("Y-m-d");
			$sub = x_sum("amount","clientpayment","payment_approval='No' AND currency='$curri'");
			if($sub == ""){
				echo number_format(0,2);
			}else{
				echo number_format($sub,2);
			}
			?></td>
	<td><?php 
			echo "$curri ";
			$date = date("Y-m-d");
			$sub = x_sum("amount","clientpayment","payment_approval='Yes' AND currency='$curri'");
			if($sub == ""){
				echo number_format(0,2);
			}else{
				echo number_format($sub,2);
			}
			?></td>
	<td>
	<?php 
echo "$curri ";
$date = date("Y-m-d");
$sub = x_sum("amount","transaction","status='approved' AND currency='$curri' AND paydate LIKE '$date%'");
if($sub == ""){
	echo number_format(0,2);
}else{
	echo number_format($sub,2);
}
?>
	</td>
	<td>
	<?php 
echo "$curri ";
$date = date("Y-m-d");
$sub = x_sum("amount","transaction","status='approved' AND currency='$curri'");
if($sub == ""){
	echo number_format(0,2);
}else{
	echo number_format($sub,2);
}
?>
	</td>
	<td>
<?php 
echo "$curri ";
$date = date("Y-m-d");
$sub = x_sum("amount","transaction","status='pending' AND currency='$curri'");
if($sub == ""){
	echo number_format(0,2);
}else{
	echo number_format($sub,2);
}
?>
	</td>
	<!--<td>
	</td>-->
	</tr>
	<?php
	}
}
?>
</table>
</div>