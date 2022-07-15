<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yii"><font style="color:green"><i class="glyphicon glyphicon-gift"></i> Send us</font> Testimonies </h3>
<script src="../log.js"></script>
<form id="testifynow" method="POST">
<p class="banp">Enter Testimonies*</p>
<textarea name="message" required="required" id="pdes" class="form-control pdes"  placeholder="Enter Message"></textarea>
<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="testimoniesbase" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="Send" class="btn btn-success" id="bup" />
</form>
<div id="gallery"><img src="../image/load.gif"/></div>

</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
