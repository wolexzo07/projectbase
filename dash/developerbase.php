<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yii"><font style="color:green"><i class="fa fa-globe"></i> Developers</font> Page </h3>
<p>This is strictly for website owner that intend to put our banner on their website to earn referral bonus</p>
	<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' LIMIT 1") > 0){
	foreach(x_select("token","userdb","email='$user' AND status='active'","1","name") as $key){
	$tok = $key["token"];
	}
	}else{
		exit();
		}
?>	
	<?php
			// start checking for hostname
			if(x_count("contactinfo","status='1' AND type='host' LIMIT 1") > 0){
			foreach(x_select("title","contactinfo","status='1' AND type='host'","1","id desc") as $key){
				$host = $key["title"];
			}
			}
			// end checking for hostname				
			?>
<p class="bui">Banner 1</p>
<div class="bna">
<img src="../image/banner.png" style="width:100%;"/>
</div>
<p class="bui">Code for Banner 1</p>
<div class="bna">
<textarea onclick="this.focus();this.select()" style="padding:10px;height:110px;" class="form-control" readonly="readonly">
<a href="#" onclick="parent.location='https://<?php echo $host;?>/register?ref_code=<?php echo $tok;?>'">
<img src="https://<?php echo $host;?>/image/banner.png" style="width:100%;"/>
</a>
</textarea>
</div>

<!-----second banner started--->
<p class="bui">Banner 2</p>
<div class="bna">
<img src="../image/banner_2.png" style="width:250px;"/>
</div>
<p class="bui">Code for Banner 2</p>
<div class="bna">
<textarea onclick="this.focus();this.select()" style="padding:10px;height:110px;" class="form-control" readonly="readonly">
<a href="#" onclick="parent.location='https://<?php echo $host;?>/register?ref_code=<?php echo $tok;?>'">
<img src="https://<?php echo $host;?>/image/banner_2.png" style="width:250px;"/>
</a>
</textarea>
</div>



<!-----third banner started--->
<p class="bui">Banner 3</p>
<div class="bna">
<img src="../image/buyp.png" style="width:100%;"/>
</div>
<p class="bui">Code for Banner 3</p>
<div class="bna">
<textarea onclick="this.focus();this.select()" style="padding:10px;height:110px;" class="form-control" readonly="readonly">
<a href="#" onclick="parent.location='https://<?php echo $host;?>/register?ref_code=<?php echo $tok;?>'">
<img src="https://<?php echo $host;?>/image/buyp.png" style="width:100%;"/>
</a>
</textarea>
</div>

<!-----third banner started--->
<p class="bui">Banner 4</p>
<div class="bna">
<img src="../image/banner_3.png" style="width:250px;"/>
</div>
<p class="bui">Code for Banner 4</p>
<div class="bna">
<textarea onclick="this.focus();this.select()" style="padding:10px;height:110px;" class="form-control" readonly="readonly">
<a href="#" onclick="parent.location='https://<?php echo $host;?>/register?ref_code=<?php echo $tok;?>'">
<img src="https://<?php echo $host;?>/image/banner_3.png" style="width:250px;"/>
</a>
</textarea>
</div>




<style>
.bui{
	color:black;
	
}
</style>


</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>

<?php include("ads.php");?>

</div>
