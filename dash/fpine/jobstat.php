<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<h3 class="yii"> <font style="color:green;"><i class="fa fa-briefcase"></i> Projects</font> Manager</h3>
	<script src="fpine/log.js"></script>
<form id="formjobm">
<div class="row">

<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
<select name="cat" style="padding:;" id="user" class="form-control selec">
	<option value="">Select Job status ....</option>
	<option value="active">Approved Jobs </option>
	<option value="inactive">Pending Jobs</option>
	<option value="bid">Approved biddings</option>
	<option value="paid">Paid Jobs</option>
	<option value="pend">Pending Payments</option>
</select>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<button style="width:100%;padding:;" class="btn btn-success txt"><i class="fa fa-briefcase"></i> Get Data</button>
</div>
</div>
</form>
<div id="gallery"><img src="../image/load.gif"/></div>

</div>
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
</div>
