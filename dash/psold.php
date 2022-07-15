<?php
			$user = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
			if(x_count("projectsold","user='$user' LIMIT 1") > 0){
				?><table class="table table-hover table-striped tabover">
	<tr><th>No.</th><th>Title</th><th>Amount</th><th>Downloads</th><!--<th>Sourcecode</th>---><th>Action</th></tr>
	<caption class="capp"><font style="color:green;">TOTAL</font> ORDER = <?php echo x_count("projectsold","user='$user'");?></caption>
	<?php
	$count = 0;
		foreach(x_select("pid,ptoken,user","projectsold","user='$user'","50","id desc") as $key){
			$count ++;
			$pid = $key["pid"];$ptoken = $key["ptoken"];
			if(x_count("buy_sell","id='$pid'AND token='$ptoken' LIMIT 1") > 0){
			foreach(x_select("ptitle,amount,filepath,filesize,ext,sfilepath,sfilesize,sext,postedby","buy_sell","id='$pid'AND token='$ptoken'","1","id desc") as $key){
			$pt = $key["ptitle"];$pamt = $key["amount"];$fp = $key["filepath"];$fs = $key["filesize"];
			$ext = $key["ext"];$sfp = $key["sfilepath"];$sfs = $key["sfilesize"];$sext = $key["sext"];$seller = $key["postedby"];
			
			}	
			?>
			<tr><td><?php echo $count;?></td><td><?php echo $pt;?></td>
			<td><?php echo "NGN ".number_format($pamt,2);?></td>
			<td><button onclick="parent.location='<?php echo $fp;?>'" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Complete  &nbsp;<?php echo $fs;?> &nbsp;<span class="badge"><?php echo $ext;?></span></button><br/><br/>
			<?php
	if($sfp == ""){
		echo "";
		}else{
			?><button onclick="parent.location='<?php echo $sfp;?>'" class="btn btn-success"><i class="fa fa-cloud-download"></i> Sourcecod <?php echo $sfs;?> <span class="badge"><?php echo $sext;?></span></button><?php
			}
	?>
			</td>
			<!---<td>	</td>--->
	<td>
		<?php
		if(x_count("userdb","email='$seller' LIMIT 1") > 0){
			foreach(x_select("mobile,email","userdb","email='$seller'","1","id desc") as $key){
			$mobile = $key["mobile"];$email = $key["email"];
			}
			?><button class="btn btn-info" onclick="alert('mobile:<?php echo $mobile;?> and Email:<?php echo $email;?>')"><i class="fa fa-mobile"></i> Seller's Contact</button><?php
			
			}else{
				
				}
		?>

	</td>
			</tr>
			<?php
			
				}else{
				//Invalid project
				}
			
			}
				
				}else{
					?>
<div style='margin:10pt;'><center><i class='glyphicon glyphicon-trash' style='font-size:60pt;color:lightgray;'></i><p style='color:lightgray;'><br/>No order was made!</p>
</center></div>
<?php
					}
			
			?>
