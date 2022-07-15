<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<button class="btn btn-primary probtn" onclick="load('fettch_post.php')"><i class="fa fa-briefcase"></i> Posted Project&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge"><?php
#include("../finishit.php");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
	$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	echo x_count("projects","owner='$user'");
}else{
	echo "0";
}

?></span></button>
<h3 class="yi"><i class="fa fa-edit"></i> Post a New Project<br/><small style="color:purple;font-weight:bold;">Please do not post a project you are not ready to pay for.</small></h3>
<script src="../log.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("form").attr("autocomplete","off");
	});
</script>

<form id="writepost" autocomplete="off" method="POST">
<p class="banp">Select Post category*</p>
<select name="category" required="required" class="form-control slec">
<option> Select post category .......</option>
<?php include("procat.php");?>
            </select>
<p class="banp">Enter Project Title*</p>
<input type="text" id="title" required="required" placeholder="Enter post title" name="title" value="" class="form-control ttx">
<p class="banp">Select Payment currency*</p>
<select onchange="cur(this.value)" name="curr" required="required" class="form-control slec">
<option> Select currency .......</option>
<?php include("currenc.php");?>
            </select><br/>
<p class="banp">Enter budgeted amount (<font id='pcu'></font>)*</p>
<input type="number" value=""  id="naira" required="required" placeholder="Enter the amount you want to pay for this project" name="amount" class="form-control ttx">
<p class="banp">Select Time duration*</p>
<?php include("fetch_date.php");?>
	<p class="banp">Enter project description*</p>
	<textarea maxlength="400" value="" class="form-control pdes" required="required" id="pdes" name="pdes" placeholder="Enter project description"></textarea>
	<p class="banp">Enter secret pin</p>
<input type="password" id="pin" value="" maxlength="4" required="required" placeholder="Enter secret pin" name="pin" class="form-control ttx"/>


<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>
						       
<input type="hidden" name="write_post" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit" value="POST NOW" class="btn btn-success" id="bup"/>
</form>

<div id="gallery"><img src="../image/load.gif"/></div>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>

<?php include("ads.php");?>

</div>

<script src="build/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" language="javascript">
	function cur(str){
		
		if(str == ""){
			document.getElementById("pcu").innerHTML = str;
			}else{
				document.getElementById("pcu").innerHTML = str;
				}
		
		}
$.datetimepicker.setLocale('en');
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
startDate:	'<?php echo Date("Y-m-d");?>',
formatTime:'H:i:s',
formatDate:'Y-m-d',
format:'Y-m-d',
timepicker:false
});

$('#datetimepickerr').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
startDate:	'<?php echo Date("Y-m-d");?>',
formatTime:'H:i:s',
formatDate:'Y-m-d',
format:'Y-m-d',
timepicker:false
});
</script>
