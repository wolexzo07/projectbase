<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<?php
if(x_count("projects","status='active' OR status='inactive' LIMIT 1") > 0){
	?>
	<table style="background-color:white;margin-top:20pt;" class="table table-striped table-bordered table-hover">
	<caption class="">NEW PROJECTS</caption>
	<tr>
	<th>No.</th>
	<th>Photo</th><th>Name</th><th>Title</th><th>Type</th><th>Amount</th><th>Action</th>
	</tr>
	<?php
	$counter = 0;
	foreach(x_select("id,token,ptitle,owner,amount_to_pay,amount_currency,status,pcategory","projects","status='active' OR status='inactive'","50","id desc") as $keyy){
		$counter++;
		$id = $keyy["id"];
		$tok = $keyy["token"];
		$ptitle = $keyy["ptitle"];
		$owner = $keyy["owner"];
		$amt = $keyy["amount_to_pay"];
		$amc = $keyy["amount_currency"];
		$stat = $keyy["status"];
		$pcat = $keyy["pcategory"];
		
		foreach(x_select("user_photo,name","userdb","email='$owner' AND status='active'","1","id desc") as $keu){
		$pht = $keu["user_photo"];
		$nam = $keu["name"];
		}
		
		?>
		<tr align='left'>
		<td><?php echo $counter;?></td>
		<td><img src="<?php echo "../".$pht;?>" class="img-responsive" style="width:30px;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;"/></td>
		<td><?php echo $nam;?></td>
		<td><?php echo ucfirst(strtolower($ptitle));?></td>
		<td><?php echo $pcat;?></td>
		<td><?php echo $amc." ".number_format($amt,2);?></td>
		<td>
		<button class="btn btn-danger" onclick="load('fpine/checkfull?tid=<?php echo $id;?>&key=<?php echo $tok;?>')"><i class="fa fa-edit"></i> Check</button>
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
