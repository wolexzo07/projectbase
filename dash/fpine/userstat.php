<div style="margin-top:20pt;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">

<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-signal"></i> USERS STATISTICS</div>
<div class="panel-body">

<?php
if(x_count("registration_category","status='1' LIMIT 50") > 0){
	?>
<table style="background-color:white;margin-top:0pt;" class="table table-striped table-hover tabover">
	<tr>
	<th>No.</th><th>Account Type</th><th>Active</th><th>Inactive</th><th>Total</th><!--<th>Status</th><th>Action</th>--></tr>
	<?php
$counter = 0;	
foreach(x_select("id,type","registration_category","status='1'","50","id desc") as $key){
$counter++;
		$id = $key["id"];
		$type = $key["type"];
		
		?>
		<tr>
		<td><?php echo $counter;?></td>
		<td><?php echo $type;?></td>
		<td><?php echo x_count("userdb","status='active' AND position='$type'");?></td>
		<td><?php echo x_count("userdb","status='inactive' AND position='$type'");?></td>
		<td><?php echo x_count("userdb","position='$type'");?></td>

		</tr>
		<?php
	}
	?></table><?php
}else{
	echo "<center><p> <i class='fa fa-users' style='font-size:50pt;'></i><br/><br/> No Registration category!</p></center>";
}
?>

</div>

</div>

</div>
