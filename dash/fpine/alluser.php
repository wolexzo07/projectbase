<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
	<h3 class="yii">
		<font style="color:green;"><i class="fa fa-users"></i></font> Registered <font style="color:green;">Users</font><br/><small style="color:purple;">All users registration done on projectbase resides here</small></h3>
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
           url: "fpine/aluser?call=<?php if(isset($_GET['call']) && !empty($_GET['call'])){echo $_GET['call'];}else{} ?>&cat=<?php if(isset($_GET['cat']) && !empty($_GET['cat'])){echo $_GET['cat'];}else{} ?>&sm=<?php echo md5(rand(123,8929203867));?>",
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
