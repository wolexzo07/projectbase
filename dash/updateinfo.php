<?php 
include_once("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<h3 class="yi" style="text-transform:uppercase"><i class="fa fa-lock"></i><font style="color:green;"> Update </font> Profile<br/><small style="text-transform:lowercase;color:blue;">Please fill all fields available below</small></h3>
<script src="../online.js"></script>
<script>
function readURL(input){
	var file_size = input.files[0].size / 1024;
	if(file_size > 200){
		
		alert("You can not upload file that exceeds 200kb in size!");
		
		
	}else{

if(input.files && input.files[0]){
var reader = new FileReader();
reader.onload = function (e) {
$('#img_prev').attr('src' , e.target.result);

};
reader.readAsDataURL(input.files[0]);

}	
	
	}


}
function validatesize(file){
	var file_size = file.files[0].size / 1024;
	if(file_size > 200){
		
		alert("File size exceeds 200kb!");
		
	}else{
		
	}
	
}
</script>
<style type="text/css">
.banp{
	margin-top:10pt;margin-bottom:10pt;color:gray;font-style:none;
}
</style>
<form id="updatenow" autocomplete="off" method="POST">

<div class="fomlink">
<p class="banp">Upload photo (Max: 200kb):*</p>

<div class="row">
<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
<!--<input type="file" onchange="readURL(this)" required="required" class="form-control txt" name="userphoto" placeholder="Please upload photo"/>--->

<input type="file"  onchange="readURL(this)" required="required" class="vphoto" name="userphoto" placeholder="Please upload photo"/>

</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<img src="../image/users.png" id="img_prev" class="imglog"/>
</div>
</div>
</div>

<div class="fomlink" style="margin-top:10pt;margin-bottom:10pt;">
<p class="banp">Gender*:&nbsp;&nbsp;
<input type="radio" required="required" name="gen" value="male"/>&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;
<input type="radio" required="required" name="gen" value="female"/>&nbsp;&nbsp;Female&nbsp;&nbsp;&nbsp;
</p>

</div>

<div class="fomlink">
<p class="banp">Mobile*:</p>
<input type="text" class="form-control txt" maxlength="11" autocomplete="off" name="mobile" placeholder="Enter mobile number"/>
</div>
	<style>
	#schname{
		display:none;
		}
	</style>
	<script type="text/javascript">
	function checksch(str){
		var ss = document.getElementById("schname");
		var sinp = document.getElementById("schnamee");
		if(str == "OTHER"){
			ss.style.display="block";
			sinp.required="required";
			}else{
				$("#schnamee").removeAttr("required");
				ss.style.display="none";
				
				}
		
		}
	</script>

<div class="fomlink">

<p class="banp">Choose school (or OTHER if not listed)*:</p>

<select required="required" class="form-control slec" onchange="return checksch(this.value)" id="schlist" name="schlist">
<option value="">Select school..</option>
<?php
if(x_count("school","01") > 0){
	foreach(x_select("name","school","0","0","name") as $key){
		$nam = $key["name"];
		echo "<option value='$nam'>$nam</option>";
		
		}
	
	}else{
		?><option value="">No schools uploaded</option><?php
		}

?>

</select>
</div>

<div class="fomlink" id="schname">
<p class="banp">Enter school name *:</p>

<input type="text" autocomplete="off" class="form-control txt" style="text-transform:capitalize;" id ="schnamee" name="schlist_other" placeholder="Enter school name"/>

</div>


<script type="text/javascript" src="../countries.js"></script>

<div class="fomlink">
<p class="banp">Country*:</p>
<select required="" class="form-control slec" onchange="print_state('state',this.selectedIndex);" data-trigger="focus" data-location="top-left" data-title="Please select your country" id="country" name="country"></select>
</div>


<div class="fomlink">
<p class="banp">State*:</p>
<select name="state" required="required" id="state" class="form-control slec" data-trigger="focus" data-location="top-left" data-title="Please select your state of origin"></select>
<script language="javascript">print_country("country");</script>
</div>


<div class="fomlink">
<p class="banp">Skills(List and separate with comma)*:</p>
<textarea maxlength="300" class="form-control" style="resize:none;" autocomplete="off" name="skill" placeholder="Enter your skills"></textarea>
</div>

<div class="fomlink">

<p class="banp">How did you hear about us*:</p>

<select required="required" class="form-control slec" name="how">
<option value="">Select medium..</option>
<?php
if(x_count("school","01") > 0){
	foreach(x_select("title","how","0","0","title") as $key){
		$nam = $key["title"];
		echo "<option value='$nam'>$nam</option>";
		
		}
	
	}else{
		?><option value="">No medium found</option><?php
		}

?>

</select>
</div>

<p class="banp">Enter secret pin*</p>
<input type="password" id="pin" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"></p>


<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>
						       
<input type="hidden" name="identity_update" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="UPDATE NOW" class="btn btn-primary" id="bup"/>
</form>

<div id="gallery"><img src="image/load.gif"/></div>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
