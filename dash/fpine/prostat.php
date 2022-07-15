<div style="margin-top:20pt;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">

<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-briefcase"></i> PROJECT MANAGER</div>
<div class="panel-body">

<?php
if(x_count("paper_category","status='1' LIMIT 50") > 0){
	?>
<table style="background-color:white;margin-top:0pt;" class="table table-striped table-hover tabover">
	<tr>
	<th>No.</th><th>Account Type</th><th>Active</th><th>Inactive</th><th>Total</th><th>UnBidded</th><th>Bidded</th><th>Approved</th><th>Paid</th><th>Completed</th><th>Expected Income</th></tr>
	<?php
$counter = 0;	
foreach(x_select("id,category","paper_category","status='1'","50","id desc") as $key){
$counter++;
		$id = $key["id"];
		$type = $key["category"];
		
		?>
		<tr>
		<td><?php echo $counter;?></td>
		<td><?php echo $type;?></td>
		<td><?php echo x_count("projects","status='active' AND pcategory='$type'");?></td>
		<td><?php echo x_count("projects","status='inactive' AND pcategory='$type'");?></td>
		<td><?php echo x_count("projects","pcategory='$type'");?></td>
		<td><?php echo x_count("projects","pcategory='$type' AND bidded_status='inactive'");?></td>
		<td><?php echo x_count("projects","pcategory='$type' AND bidded_status='active'");?></td>
		<td><?php echo x_count("projects","pcategory='$type' AND processing_status='active'");?></td>
		<td><?php echo x_count("projects","pcategory='$type' AND payment_status='active'");?></td>
		<td style="color:blue;font-weight:bold;"><?php echo x_count("projects","pcategory='$type' AND completion_status='active'");?></td>
		<td style="color:green;font-weight:bold;"><?php 
		$firt = x_count("projects","pcategory='$type'");
		$firts = x_count("projects","pcategory='$type' AND completion_status='active'");
		$rdi = $firt - $firts;echo $rdi
		?></td>
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
