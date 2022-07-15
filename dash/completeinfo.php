<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yi" style="text-transform:uppercase"><i class="fa fa-lock"></i><font style="color:green;"> Verification</font> of identity<br/><small>FAKE ID WILL LEAD TO ACCOUNT SUSPENSION</small></h3>
<script src="../log.js"></script>
<script>
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
<form id="verify" autocomplete="off" method="POST">

<p class="banp">Means of Identity:*</p>
<select name="identity" id="identity" required="required" class="form-control slec">
<option value="intl. passport">International Passport</option>
<option value="Drivers License">Drivers License</option>
<option value="National ID Card">National ID Card</option>
</select>

<p class="banp">Upload Identity (max- 5mb):*</p>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<input type="file" id="file" onchange="readURL(this)" required="required" class="vphoto" name="userphoto" placeholder="Please upload photo"/>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<img src="../image/card.jpg" id="img_prev" style="width:100%;height:200px;"/>
</div>
</div>
<p class="banp">Enter ID card number*</p>
<input type="text" id="cardnum" required="required" placeholder="Enter id card Number" name="cardnum" class="form-control ttx"></p>

<p class="banp">Enter secret pin*</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"></p>


<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>
						       
<input type="hidden" name="identity_update" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="UPDATE" class="btn btn-primary" id="bup"/>
</form>

<div id="gallery"><img src="../image/load.gif"/></div>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>

