<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yi"><i class="fa fa-credit-card"></i> &nbsp;<font style="color:green;">MAKE PAYMENT</font> FOR PROJECTS</h3>
<script type="text/javascript" src="../log.js"></script>
<script type="text/javascript" src="fetch.js"></script>
<form id="projectpy" onsubmit="" method="post">
<p class="banp">Select project*</p>
<select name="category" id="cat" onchange="return showp(this.value)" required="required" class="form-control slec">
<option value=""> Select Project.......</option>
<?php include("minep.php");?>
</select>
<div id="showitnow"></div>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx">

<input type="hidden" name="payment_system" value="<?php echo sha1(rand());?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>
<button  class="btn btn-primary subnm"><i class="fa fa-credit-card"></i> Pay Now</button>
</form>
<div id="gallery"><img src="../image/load.gif"/></div>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
