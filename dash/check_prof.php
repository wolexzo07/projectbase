
<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">	</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">

	<?php
if(isset($_GET['pid']) && !empty($_GET['pid']) && isset($_GET['userkey']) && !empty($_GET['userkey']) && isset($_GET['bidmail']) && !empty($_GET['bidmail'])){
	?>
	<h3 class="yii"><font style="color:green;"><i class="fa fa-users"></i> Professional</font> Profile</h3>
	<?php
	$ido = x_clean($_GET['pid']);
	$ptok = x_clean($_GET['token']);
	$bidid = x_clean($_GET['userkey']);
	$biduser = x_clean($_GET['bidmail']);
	
	if(x_count("projects","id='$ido' AND status='active' LIMIT 1") > 0){
	
	foreach(x_select("id,ptitle,owner,token,payment_status","projects","id='$ido' AND status='active'","1","ptitle") as $key){
	$ptitle = $key["ptitle"];
	$pown = $key["owner"];
	$pidd = $key["id"];
	$ptik = $key["token"];
	$pys = $key["payment_status"];
	}
	
	
	if(isset($_GET["loc"]) && !empty($_GET["loc"])){
		$locc = xg("loc");
		?><button onclick="load('<?php echo $locc;?>')" style="padding:10px;margin-bottom:10pt;" class="btn btn-success"><i class="fa fa-arrow-left"></i></button><?php
		}else{
			?><button onclick="load('allbids?tid=<?php echo $ido;?>&key=<?php echo $ptok;?>')" style="padding:10px;margin-bottom:10pt;" class="btn btn-success"><i class="fa fa-arrow-left"></i></button><?php
			}
	?> <button  class="btn btn-primary" style="padding:10px;margin-bottom:10pt;"><?php echo $ptitle;?> </button>
	<?php
	
	
		if(x_count("bidded","id='$bidid' AND bidder_email='$biduser' LIMIT 1") > 0){
		
		if(x_count("userdb","email='$biduser' LIMIT 1") > 0){
			?><table class="table table-hover table-striped tabover">
	<caption class="capp"><i class="fa fa-signal"></i> Profile <font class='coml'>Rating</font></caption>

			<!---<tr><th>No</th></tr>-->
				<?php
				$counter = 0;
foreach(x_select("last_login_r,realtime,user_photo,name,gender,email,mobile,bidded_job,approved_job,cancelled_job,completed_job","userdb","email='$biduser'","1","id desc") as $key){
			$counter++;
			$photo = $key["user_photo"];
			$name = $key["name"];
			$email = $key["email"];
			$mobile = $key["mobile"];
			$bj = $key["bidded_job"];
			$aj = $key["approved_job"];
			$cj = $key["cancelled_job"];
			$coj = $key["completed_job"];
			$rt = $key["realtime"];
			$llr = $key["last_login_r"];
			
			
			?>
			<tr>
			<td><img src="<?php
			if($pys == "active"){
				?>../<?php echo $photo;?><?php
				}else{
					?>../image/avatar.png<?php
					}
			
			?>" class="imgcl img-circle" style="width:120px;"/>
			
			<div class="upst">
				
			<button onclick="<?php
if($pys == "active"){
	?>	load('../dash/profbase/chatme?tid=<?php echo $pidd;?>&key=<?php echo $ptik;?>')<?php
	}else{
		?>alert('Sorry! Project owner must pay before chatting!')<?php
		}
?>" class="btn btn-primary"><i class="fa fa-comment"></i> Open Chat</button>

			</div>
			
			</td>
			<td>
			<table class="table table-striped table-hover">
			<tr>
				<th>Name:</th>
				<td><?php
			if($pys == "active"){
				echo $name;
				}else{
					echo "Non-funded Project";
					}
			?></td>
				</tr>
				<?php
			if($pys == "active"){
				?>
				<tr>
				<th>Mobile</th>
				<td><?php echo $mobile;?></td>
				</tr>
				
				<tr>
				<th>Email</th>
				<td><?php echo $email;?></td>
				</tr>
				
				<tr>
				<th>Joined On</th>
				<td><?php echo $rt;?></td>
				</tr>
				
				<tr>
				<th>Last Login</th>
				<td><?php echo $llr;?></td>
				</tr>
				
				<?php
				}else{
					
					}
			?>
			</table>
			
			</td>
			
			</tr>
			
			<tr>
			<th>Jobs Bidded</th>
			<td><?php echo $bj;?></td>
			</tr>
			
			<tr>
			<th>Approved Biddings</th>
			<td><?php echo $aj;?></td>
			</tr>
			
			<tr>
			<th>Failed Transaction(s)</th>
			<td><?php echo $cj;?></td>
			</tr>
			
			<tr>
			<th>Completed Transaction(s)</th>
			<td><?php echo $coj;?></td>
			</tr>
			<?php
			
			}
			?></table><?php	
			
			}else{
				echo "Fake user account detected!";
				}
		
		}else{
			
			echo "Invalid bidder identity!";
			
			}
	
	
	}else{
		
		}
	

	

		
	}else{
		echo "Parameter Missing!";
		}
		?>

</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
