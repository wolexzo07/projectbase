<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<h3 class="yii">
	<button class="btn btn-primary" onclick="load('buy&sell')"><i class="fa fa-arrow-left"></i> <i class="fa fa-shopping-cart"></i></button>&nbsp;
<font style="color:green;"> Purchase</font> Project(s)<br/><small style="font-weight:;font-size:10pt;color:red;text-transform:;">DOWNLOAD AN ABSTRACT FOR THE PROJECT MATERIAL YOU INTEND TO BUY AND CHECK IT PROPERLY BEFORE MAKING ANY PAYMENT BECAUSE ANY PAYMENT MADE FOR PURCHASE OF ANY PROJECT IS NOT REFUNDABLE.</small></h3>

<script>
function navb(){
	var get_text = document.getElementById("ptitl").value;
	if(get_text == ""){
		alert("Please enter something");
		return false;
		}else{
			load("buyprojectbase?call="+get_text+"");
			return false;
			}
	
	}
</script>
<!---<button style="margin-left:10pt;padding:;" class="btn btn-info btn-lg"><i class="fa fa-search"></i> Search By Project Topic Or Department</button>--->

<form id="uploadproducted" onsubmit="return navb()" autocomplete="off" method="POST">
	
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<input type="text" autocomplete="off" style="text-transform:capitalize;" class="form-control ttx" maxlength="100" required="required" id="ptitl" placeholder="Search by project topic or Department" name="ptitle" value=""/>

<input type="hidden" name="uploaded_job" value="<?php echo sha1(rand());?>"/>
						       
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<!--<input type="submit" style="margin-top:10pt;" value="Search Topic" class="btn btn-success" id="bup" />--->

<button type="submit" style="margin-top:10pt;" id="bup" class="btn btn-success"><i class="fa fa-search"></i> Search Topic</button>

</div>
<div id="gallery" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><img src="../image/load.gif"/></div>
</div>

</form>

</div>

<?php include("ads.php");?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<h3 style="display:none;" class="yii">&nbsp;
<font style="color:green;"><i class="glyphicon glyphicon-shopping-cart"></i> Projects Available </font> for sale</h3>

<script type="text/javascript">
$(document).ready(function(){
changePagination('0');    
});
function changePagination(pageId){
     $(".flash").show();
     $(".flash").fadeIn(400).html
                ('Loading <img src="../image/load.gif" />');
     var dataString = 'pageId='+ pageId;
     $.ajax({
           type: "POST",
           url: "probay?call=<?php if(isset($_GET['call']) && !empty($_GET['call'])){echo $_GET['call'];}else{} ?>&sm=<?php echo md5(rand(123,8929203867));?>",
           data: dataString,
           cache: false,
           success: function(result){
           $(".flash").hide();
                 $("#pageData").html(result);
           }
      });
}
</script>

<div id="pageData"></div>
<span class="flash"></span>

</div>
</div>
