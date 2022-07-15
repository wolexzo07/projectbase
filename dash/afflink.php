<?php 
include_once("validatebase.php");
include_once("qrlib.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3 class="yii"><font style="color:green"><i class="fa fa-link"></i> Affiliate </font> Link </h3>
<!--<p style="color:purple;"></p>--->

	<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' LIMIT 1") > 0){
	
	foreach(x_select("token","userdb","email='$user' AND status='active'","1","name") as $key){
		
	$tok = $key["token"];
	
	}
	
	}else{
		echo "<p class='hubmsg'>Something Goes wrong!</p>";
		exit();
		}
?>	

	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
				
			<table class="table table-responsive tabover">
				<caption style="color:purple;" class="capp">Make use of your affiliate link to refer users and earn referral bonus </caption>
			<tr>
			<td>
			<?php
$refcode = "refcode/".$tok.md5(1).".png";
if(file_exists($refcode)){
echo "";
}else{
 $trk = "https://projectbase.ng?ref_code=".$tok;
QRcode::png("$trk", "$refcode", "H", 4, 2);
}
			?>
			<img src="<?php echo $refcode;?>" class="qrcod"/>
			</td>
			
			<td><p class='lin'><a href="https://projectbase.ng?ref_code=<?php echo $tok;?>">https://projectbase.ng?ref_code=<?php echo $tok;?></a></p>
			</td>
			
			</tr>
			
			<tr>
			<td> 
			<?php
$refcodee = "refcode/".$tok.md5(2).".png";
if(file_exists($refcodee)){
echo "";
}else{

 $trkk = "https://projectbase.ng/register?ref_code=".$tok;
QRcode::png("$trkk", "$refcodee", "H", 4, 2);
}
			?>
			<img src="<?php echo $refcodee;?>" class="qrcod"/>
			</td>
			<td>
			<p class='lin'><a href="https://projectbase.ng/register?ref_code=<?php echo $tok;?>">https://projectbase.ng/register?ref_code=<?php echo $tok;?></a></p>
			</td>
			</tr>
			
			</table>
			
			</div>
			
		
		
<div style="margin-top:20pt;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">

<table class="table table-responsive tabover">
<caption style="color:purple;" class="capp">Make use of your affiliate link to refer users and earn referral bonus </caption>
<tr>
<th>REFERRALS CATEGORIES</th>
<th>PERCENTAGE EARNINGS </th>
<th>DESCRIPTION </th>
</tr>

<tr>
<td>Student</td>
<td style="color:purple;">Completed project = 3%<br/><br/>
Purchased project = 5%<br/><br/>
Yearly subscription = 2%
</td>
<td>For every referred student that post fresh project and the project was completed successfully by the professional you will earn referral bonus of 3% while for every referred student that purchase project material you will earn referral bonus of 5% and 2% from yearly subscription</td>
</tr>

<tr>
<td>Professional</td>
<td style="color:green;">Yearly subscription = 1%</td>
<td>
	For every referred professional you will earn 1% of the payment. </td>
</tr>

<tr>
<td>Marketers</td>
<td style="color:green;">0%</td>
<td>No referral bonus is attached for referring a marketer to us.</td>
</tr>

</table>

</div>
			


</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


</div>

<?php include("ads.php");?>

</div>
