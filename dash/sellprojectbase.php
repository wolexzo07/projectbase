<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yii">
<button class="btn btn-success" onclick="load('buy&sell')"><i class="fa fa-arrow-left"></i></button> &nbsp;<font style="color:green;"><i class="fa fa-cloud-upload"></i> Upload </font>Project(s)</h3>

<div id="project_ready">
<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading"><i class="fa fa-edit"></i> Project Upload Requirement</h4>
    <p class="list-group-item-text">Your project will be approved only if you meet all these requirements.</p>
  </a></div>
 <ul class="list-group">
  <li class="list-group-item">Please upload project that you want to sell using this section</li>
 <li class="list-group-item">Project format must be in <b style="color:green;">pdf or docx</b> format.</li>
  <li class="list-group-item">Your school information,dedication and acknowledgement page must be removed.</li>
  <li class="list-group-item">Project must have chapter one to five (1-5)</li>
    <li class="list-group-item">It must have the conclusion and recommendation page coupled with all the references.</li>
	  <li class="list-group-item">The project abstract must be uploaded seperately inorder to enable the buyer to have an hint on what he/she wants to pay for. </li>
	  <li class="list-group-item">The complete project must also include the abstract page that was uploaded seperately. </li>
	  <!---<li class="list-group-item">For project(s) that has source code you must select <b>computer science</b> department to enable you to upload source code along side your project write-up.</li>
	  <li class="list-group-item">For  <b>computer science</b> project(s) that does not involve source code ,a <b>zipped </b> copy of the experiment screenshots must be uploaded as source code.</li>--->
</ul>
<button id="btnupload" class="btn btn-success" style="width:100%;padding:15px;"><i class="fa fa-upload"></i> START PROJECT UPLOAD NOW</button>
</div>
 <!---<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4 class="list-group-item-heading">First List Group Item Heading</h4>
    <p class="list-group-item-text">List Group Item Text</p>
  </a>
  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading">Second List Group Item Heading</h4>
    <p class="list-group-item-text">List Group Item Text</p>
  </a>
  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading">Third List Group Item Heading</h4>
    <p class="list-group-item-text">List Group Item Text</p>
  </a>
</div>-->
<script src="../log.js"></script>
<script type="text/javascript" src="fetch.js"></script>
<script type="text/javascript" src="mani.js"></script>
<style>
.read_dept{
	display:none;
	}
	#read_code{
		display:none;
		}
		#upload_data{
			display:none;
		}
</style>

<div id="upload_data">


<form id="uploadproduct" autocomplete="off" method="POST">
<p class="banp">Project Category *</p>
<select name="ptype" id="cat" required="required" class="form-control slec">
	<option value="">Select Category....</option>
<?php include("procat.php");?>
</select>
<p class="banp">Select Department (choose <b>others</b> if not available) *</p>
<select name="dept" id="dept" onchange="return checksch(this.value)" required="required" class="form-control slec">
	<option value="">Select Department....</option>
<?php include("deptfetch.php");?>
</select>

<div class="read_dept" id="read_dept">
<p class="banp">Enter Department*</p>
<input autocomplete="off" type="text" maxlength="60" id="dpt" style="text-transform:capitalize;" class="form-control ttx" placeholder="Enter Department" name="deptother" value=""/>
</div>


<p class="banp">Project Title*</p>
<input type="text" autocomplete="off" style="text-transform:capitalize;" class="form-control ttx" maxlength="500" required="required" id="ptitl" placeholder="Enter Project Title" name="ptitle" value=""/>

<p class="banp">Project Amount (NGN)*</p>
<input type="number" autocomplete="off" class="form-control ttx" required="required" placeholder="Enter Project amount" name="amount" id="amt" value=""/>

<p class="banp"><font style="color:green;font-weight:bold;">Does your project has source code ?*</font> &nbsp;&nbsp;&nbsp;
<input type="radio" required="required" name="sc" onclick="radi(this.value)" id="scy" value="yes"/>&nbsp;&nbsp; Yes&nbsp;&nbsp;&nbsp;
<input type="radio" required="required" name="sc" onclick="radi(this.value)"  id="scy" value="no"/>&nbsp;&nbsp; No&nbsp;&nbsp;&nbsp;
</p>

<p class="banp">Attach project files (pdf or docx):*</p>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<p class="banp" style="color:blue;"><i class="fa fa-upload"></i> project abstract (Max:2mb) :*</p>
<input type="file" id="upme"  onchange="vals(this,2,'Abstract cannot exceed 2mb')" required="required" class="vvphoto" name="userphoto_two" placeholder="Please upload project abstract"/>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<p class="banp" style="color:green;"><i class="fa fa-upload"></i> Completed project (Max:20mb):*</p>
<input type="file" id="upmee" onchange="vals(this,20,'Completed project cannot exceed 20mb')" required="required" class="vvphoto" name="userphoto" placeholder="Please upload completed project here"/>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="read_code">
	<p class="banp" style="color:green;"><i class="fa fa-upload"></i> Sourcecode with installation instructions (Max:25mb ; zip):*</p>
<input type="file" onchange="vals(this,25,'Sourcecode cannot exceed 25mb')" id="read_codee" class="vvphoto" name="userphoto_three" placeholder="Please upload project sourcecode"/>
</div>

</div>

	<p class="banp">Project description*</p>
<textarea name="message" required="required" id="pdes" class="form-control pdes"  placeholder="Enter Message"></textarea>
<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<p class="banp">Enter secret pin</p>
<input type="password" id="pin" autocomplete="off" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>
      
<input type="hidden" name="uploaded_job" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="Send" class="btn btn-success" id="bup" />
</form>
<div id="gallery"><img src="../image/load.gif"/></div>

</div>

</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>

<?php include("ads.php");?>

</div>
