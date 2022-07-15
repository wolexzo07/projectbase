<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h3 class="yii"><font style="color:green;">
		<button class="btn btn-primary" onclick="load('fpine/suser')"><i class="fa fa-arrow-left"></i></button>
		<i class="fa fa-users"></i> Active</font> Users</h3>

<?php

if(!isset($_GET["type"]) || empty($_GET["type"]) || !isset($_GET["status"]) || empty($_GET["status"])){
	?>
	<script>
	alert("Parameter Missing!");
	load("suser");
	</script>
	<?php
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
           url: "fpine/users?call=<?php if(isset($_GET['call']) && !empty($_GET['call'])){echo $_GET['call'];}else{} ?>&sm=<?php echo md5(rand(123,8929203867));?>&type=<?php if(isset($_GET['type']) && !empty($_GET['type'])){echo $_GET['type'];}else{}?>&status=<?php if(isset($_GET['status']) && !empty($_GET['status'])){echo $_GET['status'];}else{}?>",
           data: dataString,
           cache: false,
           success: function(result){
           $(".flash").hide();
                 $("#pageData").html(result);
           }
      });
}
</script>
<style>
.io{
	padding:10px;
	width:100%;
}
</style>
<div id="pageData"></div>
<span class="flash"></span>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
