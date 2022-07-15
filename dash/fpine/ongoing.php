<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-briefcase"></i> ONGOING PROJECTS</div>
<div class="panel-body">
<?php
if(x_count("projects","status='active' AND processing_status='active' LIMIT 1") > 0){
	?>
<table style="background-color:white;" class="table table-striped  table-hover">

	<tr>
	<th>No.</th>
	<th>Project</th><th>Approved-By</th><th>Approved-To</th><th>Biddings</th><th>Completion</th><th>Payment </th><th>Action</th>
	</tr>
	<?php
	$counter = 0;
	foreach(x_select("ptitle,owner,amount_to_pay,amount_currency,status,pcategory,approved_to,bidcount,payment_status,completion_status","projects","status='active' AND processing_status='active'","50","id desc") as $keyy){
		$counter++;
		$ptitle = $keyy["ptitle"];
		$owner = $keyy["owner"];
		$amt = $keyy["amount_to_pay"];
		$amc = $keyy["amount_currency"];
		$pstat = $keyy["payment_status"];
		$cstat = $keyy["completion_status"];
		$pcat = $keyy["pcategory"];
		$appto = $keyy["approved_to"];
		$bidcount = $keyy["bidcount"];
		
		foreach(x_select("name","userdb","email='$owner' AND status='active'","1","id desc") as $keu){
		$nam = $keu["name"];
		}
		foreach(x_select("name","userdb","email='$appto' AND status='active'","1","id desc") as $keu){
		$namto = $keu["name"];
		}
		
		?>
		<tr align='left'>
		<td><?php echo $counter;?></td>
		<td><?php echo ucfirst(strtolower($ptitle));?></td>
		<td><?php echo ucfirst(strtolower($nam));?></td>
		<td><?php echo ucfirst(strtolower($namto));?></td>
		<td><span style="background-color:green;color:white;padding:10px;" class="badge"><?php echo $bidcount;?></span></td>
		<td><?php 
		if($cstat == "active"){
			?>
			<span style="background-color:green;color:white;padding:10px;" class="badge"><?php echo $cstat;?></span>
			<?php
			}else{
			?>
			<span style="background-color:purple;color:white;padding:10px;" class="badge"><?php echo $cstat;?></span>
			<?php
				}
		
		
		?></td>
		<td><?php 
		if($pstat == "active"){
			?>
			<span style="background-color:green;color:white;padding:10px;" class="badge"><?php echo $pstat;?></span>
			<?php
			}else{
			?>
			<span style="background-color:purple;color:white;padding:10px;" class="badge"><?php echo $pstat;?></span>
			<?php
				}
		
		
		?></td>
		<td>
		<button class="btn btn-success" onclick=""><i class="fa fa-edit"></i> Details</button>
		</td>
		</tr>
		<?php
	}
	?></table>
	
	<!---<div class="">
	
	</div>--->
	
	<?php
}else{
	
}
?>
</div>

</div>

</div>
