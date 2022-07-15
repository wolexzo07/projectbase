<?php
include("validatebase.php");
?>
<div class="row">

<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 tourbase">
	<h3 style="display:none;" class="yii">
		<font style="color:green;"><i class="glyphicon glyphicon-user"></i></font> User <font style="color:green;">Profile</font><br/><small style="color:purple;display:none;">small write-up here</small></h3>

<?php
include_once("../../finishit.php");
if(isset($_GET["key"]) && !empty($_GET["key"]) && isset($_GET["userid"]) && !empty($_GET["userid"])){
	$key = xg("key"); $id=xg("userid");
	if(x_count("userdb","id='$id' AND token='$key' LIMIT 1") > 0){
		foreach(x_select("0","userdb","id='$id' AND token='$key'","1","id") as $key){
			$verify = $key["verify"];$idcard = $key["id_type"];
			$cardnum = $key["cardnum"];$wc = $key["wallet_currency"];$wb = $key["wallet_balance"];$sub_status = $key["sub_status"];
			$sd = $key["sub_date"];$sc = $key["sub_count"];$photo = $key["user_photo"];$tp = $key["test_photo"];
			$ttp = $key["testt_photo"];$status = $key["status"];$reason = $key["os_reason"];$name = $key["name"];
			$positon = $key["position"];$gen = $key["gender"];$ref = $key["ref"];$skill = $key["skills"];
			$sch = $key["school"];$med = $key["medium"];$mobile = $key["mobile"];$email = $key["email"];$country = $key["country"];
			$state = $key["state"];$acc_name = $key["account_name"];$accnum = $key["account_number"];$bankname = $key["bank_name"];
			$token = $key["token"];$rtime = $key["realtime"];$pj = $key["posted_job"];$bj = $key["bidded_job"];
			$apj = $key["approved_job"];$cj = $key["cancelled_job"];$comj= $key["completed_job"];$ej = $key["earned_job"];
			$earning = $key["earnings"];$tso = $key["total_spent_onjob"];	$os = $key["os"];$br = $key["br"];$ip = $key["ip"];$ll = $key["last_login_r"];$pu = $key["profile_updated_onr"];	}

			?>
			<button class="btn btn-primary " onclick="parent.location='./'"><i class="fa fa-arrow-left"></i></button>
			<button class="btn btn-success "><i class="fa fa-user"></i> PROFILE DETAILS OF <?php echo xup($name,"b");?></button>

			<table style="" class="table table-hover table-striped tabup">

			<tr>
			<td><img src="<?php
			if($photo == ""){
				echo "../image/avatar.png";
			}else{
				echo "../".$photo;

			}
			?>" class="img-circle imless"/><br/><br/>
<button class="btn btn-danger btn-lg"><span class="fa fa-user"></span> Access profile</button>
		</td>
			<th>

			</th>
			</tr>
			<tr>
			<td>Name</td>
			<th><?php echo xup($name,"b");?></th>
			</tr>
			<tr>
			<td>Position</td>
			<th><?php echo xup($positon,"b");?></th>
			</tr>

			<tr>
			<td>Gender</td>
			<th><?php echo xlow($gen,"b");?></th>
			</tr>
			<tr>
			<td>Skills</td>
			<th><?php echo xup($skill,"b");?></th>
			</tr>

			<tr>
			<td>Referred By</td>
			<th><?php echo xup($ref,"b");?></th>
			</tr>
			<tr>
			<td>Total Referred</td>
			<th><span class="badge clif"><?php echo x_count("userdb","ref='$email'");?></span></th>
			</tr>
			<tr>
			<td>Referred Through</td>
			<th><?php echo xup($med,"b");?></th>
			</tr>

			<tr>
			<td>Project Onsales</td>
			<th><span class="badge clif"><?php echo x_count("buy_sell","postedby='$email'");?></span></th>
			</tr>

			<tr>
			<td>Email</td>
			<th><?php echo xlow($email,"b");?></th>
			</tr>

			<tr>
			<td>Mobile</td>
			<th><?php echo xup($mobile,"b");?></th>
			</tr>

			<tr>
			<td>School</td>
			<th><?php echo xup($sch,"b");?></th>
			</tr>

			<tr>
			<td>Country</td>
			<th><?php echo xup($country,"b");?></th>
			</tr>

			<tr>
			<td>State</td>
			<th><?php echo xup($state,"b");?></th>
			</tr>

			<tr>
			<td>Registration Date</td>
			<th><?php echo xup($rtime,"b");?></th>
			</tr>

			<tr>
			<td>Last Login</td>
			<th><?php echo xup($ll,"b");?></th>
			</tr>

			<tr>
			<td>Last Profile Update</td>
			<th><?php echo xup($pu,"b");?></th>
			</tr>

			</table>

			<button style="margin-top:10pt;" class="btn btn-primary" onclick="parent.location='./'"><i class="fa fa-arrow-left"></i></button>
			<button style="margin-top:10pt;" class="btn btn-success"><i class="fa fa-signal"></i> FINANCIAL DETAILS</button>

			<table style="" class="table table-hover table-striped table-bordered tabup">

			<tr>
			<td>Wallet Balance</td>
			<th><?php
			if($wc == ""){
					echo "NGN ".number_format($tso,2);
			}else{
					echo xup($wc,"b")." ".number_format($tso,2);
			}


			?></th>
			</tr>

			<tr>
			<td>Amount Spent</td>
			<th><?php
			if($wc == ""){
					echo "NGN ".number_format($wb,2);
			}else{
					echo xup($wc,"b")." ".number_format($wb,2);
			}


			?></th>
			</tr>

			</table>





			<button style="margin-top:10pt;" class="btn btn-success" onclick="parent.location='./'"><i class="fa fa-arrow-left"></i></button>
			<button style="margin-top:10pt;" class="btn btn-primary"><i class="fa fa-credit-card"></i> BANK ACCOUNT DETAILS</button>
			<table style="" class="table table-hover table-striped table-bordered tabup">

			<tr>
			<td>Bank Name</td>
			<th><?php echo xup($bankname,"b");?></th>
			</tr>

			<tr>
			<td>Account Holder</td>
			<th><?php echo xup($acc_name,"b");?></th>
			</tr>

			<tr>
			<td>Account Number</td>
			<th><?php echo xup($accnum,"b");?></th>
			</tr>


			</table>



			<button style="margin-top:10pt;" class="btn btn-success" onclick="parent.location='./'"><i class="fa fa-arrow-left"></i></button>
			<button style="margin-top:10pt;" class="btn btn-primary"><i class="fa fa-credit-card"></i> PROFILE CREDIBILITY</button>

			<table style="" class="table table-hover table-striped table-bordered tabup">

			<tr>
			<td>Posted Jobs</td>
			<th><span class="badge clif"><?php echo $pj;?></span></th>
			</tr>
			<tr>
			<td>Bidded Jobs</td>
			<th><span class="badge clif"><?php echo $bj;?></span></th>
			</tr>
			<tr>
			<td>Approved Jobs</td>
			<th><span class="badge clif"><?php echo $apj;?></span></th>
			</tr>
			<tr>
			<td>Cancelled Jobs</td>
			<th><span class="badge clif"><?php echo $cj;?></span></th>
			</tr>
			<tr>
			<td>completed Jobs</td>
			<th><span class="badge clif"><?php echo $comj;?></span></th>
			</tr>
			<tr>
			<td>Earned Jobs</td>
			<th><span class="badge clif"><?php echo $ej;?></span></th>
			</tr>

			<tr>
			<td> Jobs Earnings</td>
			<th><span class="badge clif"><?php echo "NGN ".number_format($earning,2);?></span></th>
			</tr>


			</table>

			<button style="margin-top:10pt;" class="btn btn-success" onclick="parent.location='./'"><i class="fa fa-arrow-left"></i></button>
			<button style="margin-top:10pt;" class="btn btn-primary"><i class="fa fa-laptop"></i> LOGGED DEVICE DETAILS</button>
			<table style="" class="table table-hover table-striped table-bordered tabup">

			<tr>
			<td>Operating system</td>
			<th><?php echo xup($os,"b");?></th>
			</tr>

			<tr>
			<td>Ip Address</td>
			<th><?php echo xup($ip,"b");?></th>
			</tr>

			<tr>
			<td>Browser yes</td>
			<th><?php echo xup($br,"b");?></th>
			</tr>


			</table>

			<?php
				if(x_count("projects","owner='$email' LIMIT 1") > 0){
					?>
					<button style="margin-top:10pt;" class="btn btn-success" onclick="parent.location='./'"><i class="fa fa-arrow-left"></i></button>
					<button style="margin-top:10pt;" class="btn btn-primary"><i class="fa fa-edit"></i> FRESH POSTED PROJECTS</button>

					<table style="" class="table table-hover table-striped table-bordered tabup">
						<tr>
						<th>No.</th>
						<th>Title</th>
						<th>Category</th>
						<th>Amount</th>
						<th>Approved To</th>
						<th>Timestamp</th>
						<th>Status</th>
						</tr>
						<?php
						$counter = 0;
					foreach(x_select("ptitle,pcategory,amount_to_pay,amount_currency,status,timereal,approved_to","projects","owner='$email'","50","id") as $key){
						$counter++;
							$title = $key["ptitle"];$cat = $key["pcategory"];$amt = $key["amount_to_pay"];$stat = $key["status"];$cur = $key["amount_currency"];$rt = $key["timereal"];$appr = $key["approved_to"];

								?>
<tr>
<td><?php echo $counter;?></td>
<td><?php echo xup($title,"");?></td>
<td><?php echo xlow($cat,"");?></td>
<td><?php echo xup($cur,"")." ".number_format($amt,2);?></td>
<td><?php echo xlow($appr,"");?></td>
<td><?php echo xup($rt,"");?></td>
<td><span class="badge clif"><?php echo xlow($stat,"");?></span></td>
</tr>
								<?php

					}
?></table><?php
				}else{
					?><p class="hubmsg">No project was posted</p><?php

				}
			?>

<?php
if(x_count("buy_sell","postedby='$email' LIMIT 1") > 0){
?>
<button style="margin-top:10pt;" class="btn btn-success" onclick="parent.location='./'"><i class="fa fa-arrow-left"></i></button>
<button style="margin-top:10pt;" class="btn btn-primary"><i class="fa fa-edit"></i> PROJECTS POSTED FOR SALES</button>

<table style="" class="table table-hover table-striped table-bordered tabup">
  <tr>
  <th>No.</th>
  <th>Title</th>
  <th>Category</th>
  <th>Department</th>
  <th>Amount</th>
  <th>Buyers</th>
  <th>Downloads</th>
    <th>Date</th>
  <th>Status</th>
  </tr>
  <?php
  $counter = 0;
foreach(x_select("ptitle,category,amount,department,buyer_count,downloads_count,rtime,status","buy_sell","postedby='$email'","50","id") as $key){
  $counter++;
    $title = $key["ptitle"];$cat = $key["category"];$amt = $key["amount"];$stat = $key["status"];$rt = $key["rtime"];$dept = $key["department"];$bc = $key["buyer_count"];$dc = $key["downloads_count"];

      ?>
<tr>
<td><?php echo $counter;?></td>
<td><?php echo xup($title,"");?></td>
<td><?php echo xlow($cat,"");?></td>
<td><?php echo xlow($dept,"");?></td>
<td><?php echo xup($cur,"")." ".number_format($amt,2);?></td>
<td><span class="badge clif"><?php echo xlow($bc,"");?></span></td>
<td><span class="badge clif"><?php echo xlow($dc,"");?></span></td>
<td><?php echo xup($rt,"");?></td>
<td><span class="badge clif"><?php echo xlow($stat,"");?></span></td>
</tr>
      <?php

}
?></table>
<?php
}else{
	?><p class="hubmsg">No project was posted for sale</p><?php

}
?>

			<?php

		}else{
			echo "<p class='hubmsg'>No user found in the database!</p>";
			}

	}else{
		echo "<p class='hubmsg'>Invalid key detected</p>";
		}
?>

</div>
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
</div>
