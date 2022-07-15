<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<h3 class="yii"> <font style="color:green;"><i class="fa fa-users"></i> Active</font> Users</h3>
	<script src="../log.js"></script>
<form id="formuser">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<select name="user" style="padding:;" id="user" class="form-control selec">
<?php
include("../../finishit.php");
if(x_count("statuscat","status='y'") > 0){
	
	echo "<option value=''>Select user category....</option>";
	foreach(x_select("cat","statuscat","status='y'","10","cat") as $key){
		$cat = x_vert($key["cat"],"");
		echo "<option  value='$cat'>$cat</option>";
		}
	}else{
		echo "<option value=''>No status available</option>";
		}
?>
</select>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<select name="cat" style="padding:;" id="user" class="form-control selec">
	<option value="">Select status category....</option>
	<option value="active">Active User</option>
	<option value="inactive">Inactive User</option>
	<option value="suspend">Suspended User</option>
	<option value="blacklist">Blacklisted User</option>
</select>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
<button style="width:100%;padding:;" class="btn btn-success txt"><i class="fa fa-users"></i> Get Data</butto>
</div>
</div>
</form>
<div id="gallery"><img src="../image/load.gif"/></div>

</div>
<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
</div>
