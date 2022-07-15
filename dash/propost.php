
<div class="panel panel-default tiopp">
<div class="panel-heading"><i class="fa fa-briefcase"></i> Your posted Project(s)<span class="badge pull-right"></span></div>
			<div class="panel panel-body">
			<?php
			$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(x_count("buy_sell","postedby='$user' LIMIT 1") > 0){
	?><table class="table table-hover table-striped tabover">
	<tr><th>No.</th><th>Title</th><th>Status</th><!---<th>Category</th>---><th> Amount</th><th> Buyer</th><th>
		<i class="fa fa-cloud-download"></i> Downloads</th><th> Action</th></tr>
	<caption class="capp"><font style="color:green;">TOTAL</font> POSTED = <?php echo x_count("buy_sell","postedby='$user'");?></caption>
	<?php
	$counter = 0;
	foreach(x_select("id,token,status,ptitle,amount,category,filepath,filesize,sfilepath,sfilesize,abfilepath,abfilesize,ext,sext,abext,buyer_count","buy_sell","postedby='$user'","50","id desc") as $key){
		$counter++;
		$id = $key["id"];
		$tok = $key["token"];
		$status = $key["status"];
		$ptitle = x_vert($key["ptitle"],"");
		$amt = number_format($key["amount"],2);
		$cat = x_vert($key["category"],"");
		$bc = $key["buyer_count"];
		$fp = $key["filepath"];
		$fs = $key["filesize"];
		$ext = $key["ext"];
		
		$abfp = $key["abfilepath"];
		$abfs = $key["abfilesize"];
		$abext = $key["abext"];
		
		$sfp = $key["sfilepath"];
		$sfs = $key["sfilesize"];
		$sext = $key["sext"];
		
		?><tr>
<td><?php echo $counter;?></td>		
<td><?php echo $ptitle;?></td>	
<td><?php echo $status;?></td>	
<!---<td><?php echo $cat;?></td>-->
<td><?php echo "NGN ".$amt;?></td>
<td><?php echo $bc;?></td>	
<td>
	<button onclick="parent.location='<?php echo $abfp;?>'" class="btn btn-success btn-sm"><i class="fa fa-cloud-download"></i> Abstract &nbsp;<?php echo $abfs;?> &nbsp;<span class="badge"><?php echo $abext;?></span></button><br/><br/>
	<button onclick="parent.location='<?php echo $fp;?>'" class="btn btn-primary btn-sm"><i class="fa fa-cloud-download"></i> Complete <?php echo $fs;?> <span class="badge"><?php echo $ext;?></span></button><br/><br/>
		<?php
	if($sfp == ""){
		echo "";
		}else{
			?><button onclick="parent.location='<?php echo $sfp;?>'" class="btn btn-info btn-sm"><i class="fa fa-cloud-download"></i> Sourcecod <?php echo $sfs;?> <span class="badge"><?php echo $sext;?></span></button><?php
			}
	?>
	
</td>	

<td>

<!---<button style="float:left;" onclick="load('editseller?id=<?php echo $id;?>&token=<?php echo $tok;?>')" class="btn btn-success"><i class="fa fa-edit"></i></button>--->

<button style="float:left;" onclick="load('delseller?id=<?php echo $id;?>&token=<?php echo $tok;?>')" class="btn btn-danger"><i class="fa fa-trash"></i></button>

</td>		
		</tr><?php

	}
	?></table><?php

}else{
					?>
<div style='margin:10pt;'><center><i class='glyphicon glyphicon-trash' style='font-size:60pt;color:lightgray;'></i><p style='color:lightgray;'><br/>No was posted for sale!</p>
</center></div>
<?php
}
?>
			</div>
			</div>
