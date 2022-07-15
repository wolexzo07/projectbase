<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yi"><i class="fa fa-bank"></i> Add Bank Details</h3>
<script src="../log.js"></script>
<form id="bankForm" autocomplete="off" method="POST">
<p class="banp">Select Your bank*</p>
<select name="bankname" required="required" class="form-control slec">
<option> Select Bank name .......</option>
<?php require_once("fetch_banks.php");?>
            </select>
			<p class="banp">Enter account name*</p>
<input type="text" id="acname" required="required" placeholder="Enter account name" name="acctname" value="<?php echo $_SESSION["PBNG_ACN_2018_VISION"];?>" class="form-control ttx">
	<p class="banp">Enter account number*</p>
<input type="text" id="acnumb" maxlength="10" required="required" placeholder="Enter account number" name="acctnum" value="<?php echo $_SESSION["PBNG_ACNUMB_2018_VISION"];?>" class="form-control ttx">
	<p class="banp">Enter secret pin</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx">


<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>
						       
<input type="hidden" name="bank_update" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="UPDATE" class="btn btn-primary" id="bup"/>
</form>

<div id="gallery"><img src="../image/load.gif"/></div>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>

