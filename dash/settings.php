<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
	<script type="text/javascript" src="../log.js"></script>
<h3 class="yii"><font style="color:green"><i class="fa fa-cog"></i> Users</font> Settings </h3>
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-users"></i> Account Update</div>
<div class="panel-body text-center">
	<button onclick="load('bankd')" class="btn btn-primary btn-lg re"><i class="fa fa-bank"></i> Add Bank</button>
	<button onclick="load('completeinfo')" class="btn btn-success btn-lg re"><i class="fa fa-lock"></i> Verify Account</button>
	</div>
	</div>
	<style>
	.re{
		width:45%;
		}
	</style>

	

<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-image"></i> Change photo</div>
<div class="panel-body">
	<script>
	proform("#change_photo","change_photo","#showphoto","");
	</script>
	<style>
	.files{
		padding:15px;
		border:1px solid lightgray;
		width:100%;
		border-radius:10px;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
		-o-border-radius:10px;
		-ms-border-radius:10px;
	}
	</style>
<script type="text/javascript">
function readURL(input){
if(input.files && input.files[0]){
var reader = new FileReader();
reader.onload = function (e) {
$('#img_prev').attr('src' , e.target.result);

};
reader.readAsDataURL(input.files[0]);

}

}
</script>
<form id="change_photo" method="POST">
<p class="banp"><i class="fa fa-upload"></i> Upload photo*</p>
<input type="file" required="required" class="files"  name="file"/>
<input type="hidden" name="changephoto" value="<?php echo sha1(rand());?>"/>
						      
<p class="banp">Enter account pin*</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter old secret pin" name="pin" class="form-control ttx"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>				  
<button class="btn btn-success" id="bup"><i class="fa fa-image"></i> Change now</button>
</form>
<div id="showphoto"><img src="../image/load.gif"/></div>
	
</div>
</div>

	
	
<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-lock"></i> Change password</div>
<div class="panel-body">

	<script>
	proform("#change_password","change_p","#showus","");
	</script>
<form id="change_password" method="POST">
<p class="banp">Enter Old password*</p>
<input type="password" id="oldp" required="required" placeholder="Enter old password" name="old" class="form-control ttx"/>
<p class="banp">Enter New password*</p>
<input type="password" id="new" required="required" placeholder="Enter new password" name="new" class="form-control ttx"/>
<p class="banp">Confirm New password*</p>
<input type="password" id="new" required="required" placeholder="Confirm new password" name="neww" class="form-control ttx"/>
<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="changep" value="<?php echo sha1(rand());?>"/>
						      
<button class="btn btn-success" id="bup"><i class="fa fa-lock"></i> Change now</button>
</form>
<div id="showus"><img src="../image/load.gif"/></div>
	
</div>
</div>


<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-lock"></i> Change pincode</div>
<div class="panel-body">
	<script>
	proform("#change_pin","changepin","#gallery","");
	</script>
<form id="change_pin" method="POST">
<p class="banp">Enter new pin*</p>
<input type="password" maxlength="4" id="new" required="required" placeholder="Enter new pin" name="new" class="form-control ttx"/>
<p class="banp">Confirm New pin*</p>
<input type="password" maxlength="4" id="new" required="required" placeholder="Confirm new pin" name="neww" class="form-control ttx"/>

<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<p class="banp">Enter old secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter old secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="changepin" value="<?php echo sha1(rand());?>"/>
						      
<button class="btn btn-primary" id="bup"><i class="fa fa-lock"></i> Change Now</button>
</form>
<div id="gallery"><img src="../image/load.gif"/></div>
</div>
</div>

</div>

<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
