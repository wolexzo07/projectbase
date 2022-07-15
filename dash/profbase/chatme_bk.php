<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	<button class="btn btn-primary" onclick="load('profbase/chate')"><i class="fa fa-arrow-left"></i> Go back</button>
<h3 class="yii"><i class="fa fa-comment"></i> Chat Window </h3>

<?php
if(isset($_GET["tid"]) && !empty($_GET["tid"]) && isset($_GET["key"]) && !empty($_GET["key"])){
	?>
	
<div class="chatme">
<script type="text/javascript">
chatall("pid=<?php echo $_GET['tid'];?>&ptoken=<?php echo $_GET['key'];?>")
</script>

</div>

<script src="../log.js"></script>
<form id="chatme" method="POST">
<p class="banp">Write Message*</p>
<textarea name="message" maxlength="400" required="required" id="pdes" class="form-control pdes" style="margin-bottom:10pt;"  placeholder="Enter Message"></textarea>
<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<input type="hidden" name="tid" value="<?php echo $_GET["tid"];?>"/>
<input type="hidden" name="token" value="<?php echo $_GET["key"];?>"/>

<input type="hidden" name="chatme" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="Send" class="btn btn-success" id="bup" />
</form>
<div id="gallery"><img src="../image/load.gif"/></div>
	<?php
	}else{
		
		?>
		<p style="30pt">Missing Parameter!</p>
		<?php
		}

?>

</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
