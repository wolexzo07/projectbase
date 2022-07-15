<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<h3 class="yii"> <font style="color:green;"><i class="fa fa-trash"></i> S/B </font> Manager</h3>
	<script src="../log.js"></script>
		<script src="fetch.js"></script>
<form id="formaction">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<p id="showitnow" style="display:none;color:green;"><img src="../image/load.gif"/></p>
</div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	
<input type="text" onkeyup="usercheck(this.value)" placeholder="Enter active email" id="email" class="form-control txt" name="email"/>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<select name="cat" id="cat" class="form-control selec">
	<option value="">Select action....</option>
	<option value="suspend">Suspend User</option>
	<option value="blacklist">Blacklist User</option>
	<option value="active">Activate User</option>
	<option value="inactive">Deactivate User</option>
</select>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<button style="width:100%;padding:;" class="btn btn-success txt"><i class="fa fa-check"></i> Approve action</button>
</div>

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
<textarea cols="" rows="" id="word" placeholder="Enter reason for action" name="reason" style="resize:none;margin-top:10pt;" class="form-control"></textarea>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

</div>

</div>
</form>
<div id="gallery"><img src="../image/load.gif"/></div>

</div>
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
</div>
