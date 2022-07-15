<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yii">
<font style="color:green;"><i class="glyphicon glyphicon-cloud-upload"></i> Upload Completed</font> Jobs</h3>
<script src="../log.js"></script>
<script type="text/javascript" src="fetch.js"></script>
<form id="uploadjobs" method="POST">
<p class="banp">Select  Type*</p>
<select name="ptype" id="cat" required="required" class="form-control slec">
<option value=""> Select Project type....</option>
<option value="real"> Complete Project </option>
<option value="abstract"> Project Abstract </option>
</select>
<p class="banp">Select project*</p>
<select name="category" id="cat" onchange="return powner(this.value)" required="required" class="form-control slec">
<option value=""> Select Project.......</option>
<?php include("paidpro.php");?>
</select>
<div id="showitnow"></div>
<p class="banp">Attach project file ( docx,pdf,zip,pptx,xlsx ) :(max 50mb)*</p>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<input type="file"  onchange="readURL(this)" required="required" class="vvphoto" name="userphoto" placeholder="Please upload photo"/>
</div>
<!--<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<img src="../image/users.png" id="img_prev" class="imglog"/>
</div>-->
</div>
	<p class="banp">Enter Note*</p>
<textarea name="message" required="required" id="pdes" class="form-control pdes"  placeholder="Enter Message"></textarea>
<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="uploaded_job" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="Send" class="btn btn-success" id="bup" />
</form>
<div id="gallery"><img src="../image/load.gif"/></div>

</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
