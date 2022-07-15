<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h3 class="yii"> <font style="color:green;"><i class="glyphicon glyphicon-credit-card"></i> Client </font>Payment <button onclick="load('fpine/paybase')" class="btn btn-primary"><i class="fa fa-arrow-left"></i></button></h3>
	<?php
	include("../../finishit.php");
	if(!isset($_GET["cur"]) && !isset($_GET["cat"]) ){
		echo "<p>Parameter Modified!</p>";
		exit();
	}
	?>
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
           url: "fpine/paypend?cur=<?php if(isset($_GET['cur']) && !empty($_GET['cur'])){echo $_GET['cur'];}else{} ?>&cat=<?php if(isset($_GET['cat']) && !empty($_GET['cat'])){echo $_GET['cat'];}else{} ?>&sm=<?php echo md5(rand(123,8929203867));?>",
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
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
