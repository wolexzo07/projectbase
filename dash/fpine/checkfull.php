<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 tourbase">
<?php
require_once("../../finishit.php");
if(isset($_GET['key']) && isset($_GET['tid']) && !empty($_GET['key']) && !empty($_GET['tid'])){
	
	$token = xg("key");
	$id = xg("tid");
	if(x_count("projects","id='$id' AND token='$token' LIMIT 1") > 0){
		foreach(x_select("0","projects","id='$id' AND token='$token'","1","id") as $key ){
		$id = $key["id"];
		$title = $key["ptitle"];
		$status = $key["status"];
		$des = $key["pdes"];
		$tr = $key["timereal"];
		$amt = $key["amount_to_pay"];
		$amt_c = $key["amount_currency"];
		$user = $key["owner"];
		$own = $key["owner"];
		$pcat = $key["pcategory"];
		$tfrom = $key["time_from"];
		$tto = $key["time_to"];
		$token = $key["token"];
		
		$apprto = $key["approved_to"];
		
		$bds = $key["bidded_status"];
		$pys = $key["payment_status"];
		$pps = $key["processing_status"];
		$cos = $key["completion_status"];
		
	foreach(x_select("email,mobile,user_photo,id,token,name","userdb","email='$own'","1","id") as $key ){
		$ida = $key["id"];
		$toke = $key["token"];
		$mob = $key["mobile"];
		$emal = $key["email"];
		$uph = $key["user_photo"];
		$nameme = $key["name"];
	}
	
		?>

<button onclick="parent.location='./'" style="padding:15px;margin-bottom:20pt;" class="btn btn-primary"><i class="fa fa-arrow-left"></i> </button>
<button style="padding:15px;margin-bottom:20pt;" class="btn btn-success"><i class="fa fa-briefcase"></i> <?php echo htmlspecialchars(ucwords(strtolower($title)));?></button>
	
		
		<table id="fftab" class="table table-striped table-hover tabover">
			<caption class="capp"><i class="fa fa-briefcase"></i> PROJECT FULL DETAILS</caption>
		<tr>
		<th>
		<img class="img-responsive imglog" src="<?php
		 if($uph == ""){
			 echo "../image/avatar.png";
			 }else{
				 echo "../".$uph;
				 }?>"/>
				 
		</th>
		<td>
		<button class="btn btn-primary btn-lg" onclick="load('fpine/userdetails?userid=<?php echo $ida;?>&key=<?php echo $toke;?>')" style="margin:20pt;"><i class="fa fa-briefcase"></i> Check profile</button>
		</td>
		</tr>
	
	
		<tr>
		<th><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp; PROJECT OWNER</th>
		<td><?php echo htmlspecialchars(ucfirst(strtoupper($nameme)));?></td>
		</tr>
		
		<tr>
		<th><i class="fa fa-signal"></i>&nbsp;&nbsp;&nbsp; TOTAL POSTED</th>
		<td>
			<span class="badge"><?php echo x_count("projects","owner='$emal'");?></span></td>
		</tr>
		
		<tr>
		<th><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp; PROJECT CATEGORY</th>
		<td><?php echo htmlspecialchars(ucfirst(strtoupper($pcat)));?></td>
		</tr>
		
		<tr>
		<th><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp; PROJECT TITLE</th>
		<td><?php echo htmlspecialchars(ucfirst(strtoupper($title)));?></td>
		</tr>
		
		<tr>
		<th><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp; PROJECT DESCRIPTION</th>
		<td><?php echo htmlspecialchars(ucfirst(strtolower($des)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp; BUDGETED AMOUNT</th><td><?php echo htmlspecialchars($amt_c." ".number_format($amt,2));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp; TIME FRAME</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($tfrom." <<>> ".$tto)));?></b> &nbsp;&nbsp;&nbsp;(<?php echo x_datediff($tfrom,$tto);?>)</td>
		</tr>
		<tr>
		<th><i class="glyphicon glyphicon-time"></i>&nbsp;&nbsp;&nbsp; POSTED ON</th><td><?php echo htmlspecialchars(ucfirst(strtolower($tr)));?></td>
		</tr>
		
<tr><th><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; MOBILE</th><td><?php echo htmlspecialchars($mob);?></td></tr>

<tr><th><i class="fa fa-inbox"></i>&nbsp;&nbsp;&nbsp; EMAIL</th><td><?php echo htmlspecialchars($emal);?></td></tr>

		<tr>
		<th><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp; STATUS</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($status)));?></b></td>
		</tr>
		
		</table>
		
		<table id="fftab" class="table table-striped table-hover tabover">
			<caption class="capp"><i class="fa fa-briefcase"></i> PROJECT STATUS</caption>
		<tr>
		<th>Bidding Status</th>
		<td><span class="badge"><?php echo $bds;?></span></td>
		</tr>
		<tr>
		<th>Processing Status</th>
		<td><span class="badge"><?php echo $pps;?></span></td>
		</tr>
		<tr>
		<th>Payment Status</th>
		<td><span class="badge"><?php echo $pys;?></span></td>
		</tr>
		<tr>
		<th>Completion Status</th>
		<td><span class="badge"><?php echo $cos;?></span></td>
		</tr>
		
		</table>
		
		<?php
		if($pps == "active"){
			if(x_count("userdb","email='$apprto' LIMIT 1") > 0){
foreach(x_select("email,mobile,user_photo,id,token,name","userdb","email='$apprto'","1","id") as $key ){
		$idaa = $key["id"];
		$tokea = $key["token"];
		$moba = $key["mobile"];
		$emala = $key["email"];
		$upha = $key["user_photo"];
		$namemea = $key["name"];
	}
	
	?>
	<table id="fftab" class="table table-striped table-hover tabover">
			<caption class="capp"><i class="fa fa-user"></i> PROFESSIONAL DETAILS</caption>
		<tr>
		<th>
		<img class="img-responsive imglog" src="<?php
		 if($upha == ""){
			 echo "../image/avatar.png";
			 }else{
				 echo "../".$upha;
				 }?>"/>
				 
		</th>
		<td>
		<button class="btn btn-warning btn-lg" onclick="load('fpine/userdetails?userid=<?php echo $idaa;?>&key=<?php echo $tokea;?>')" style="margin:20pt;"><i class="fa fa-briefcase"></i> Check profile</button>
		</td>
		</tr>
		
		<tr>
		<th><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp; NAME</th>
		<td><?php echo htmlspecialchars(ucfirst(strtoupper($namemea)));?></td>
		</tr>
		
		<tr><th><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; MOBILE</th><td><?php echo htmlspecialchars($moba);?></td></tr>

		<tr><th><i class="fa fa-inbox"></i>&nbsp;&nbsp;&nbsp; EMAIL</th><td><?php echo htmlspecialchars($emala);?></td></tr>
		
		</table>
	<?php
				}else{
					
					echo "<p class='hubmsg'>Invalid user ($apprto)</p>";
					}

			?>
			
			<?php
			}else{
				
				}
		?>
		
		
		
		<?php
		//Getting payment details
		if($pys == "active"){
			if(x_count("transaction","pid='$id' LIMIT 1") > 0){
				?>	
			<table  id="fftab" class="table table-striped table-hover tabover">
			<caption style="color:purple;" class="capp"><i class="fa fa-credit-card"></i> PAYMENT DETAILS</caption><?php
	foreach(x_select("0","transaction","pid='$id'","5","id") as $key ){
		$payid = $key["paystack_id"];
		$pv = $key["paystack_verify"];
		$pstatus = $key["status"];
		$amt = $key["amount"];
		$cur = $key["currency"];
		?>
			<tr>
		<th><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp; PAYSTACK ID</th>
		<td><?php echo $payid;?></td>
		</tr>
		<tr>
		<th><i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp; PAYSTACK VERI.</th>
		<td><?php echo $pv;?></td>
		</tr>
		
		<tr><th><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; AMOUNT</th><td><?php echo $cur." ".number_format($amt,2);?></td></tr>

		<tr><th><i class="fa fa-inbox"></i>&nbsp;&nbsp;&nbsp; STATUS</th><td><i class="fa fa-check"></i>&nbsp;<?php echo htmlspecialchars($pstatus);?></td></tr>
		<?php
		}
			?></table><?php	
				}
			else{
				echo "<p class='hubmsg'>Payment History not found!</p>";
				}
			
			}else{
			
			
			}
		//Getting payment details ended
			?>
		
		<?php
		
	}
		}else{
			echo "<p class='hubmsg'>Invalid project!</p>";
			}
	
	
}else{
	echo "<p class='hubmsg'>Parameter Missing</p>";
}
?>
</div>
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
</div>
