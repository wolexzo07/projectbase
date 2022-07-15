<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">

	<?php
if(isset($_GET['key']) && isset($_GET['tid']) && !empty($_GET['key']) && !empty($_GET['tid'])){
	?>
	<h3 class="yii"><font style="color:green;"><i class="glyphicon glyphicon-briefcase"></i> Jobs</font> Biddings</h3>
	<?php
	$ido = x_clean($_GET['tid']);
	$keyy = x_clean($_GET['key']);
	if(x_count("projects","id='$ido' AND status='active' LIMIT 1") > 0){
	
	foreach(x_select("ptitle","projects","id='$ido' AND status='active'","1","ptitle") as $key){
	$ptitle = $key["ptitle"];
	}
	$pill = x_count("bidded","pid='$ido'");
	?>
	<button onclick="load('approvenow')" style="padding:10px;margin-bottom:10pt;" class="btn btn-success"><i class="fa fa-arrow-left"></i></button> <button onclick="alert('You have just <?php echo $pill;?> <?php if($pill > 1){echo 'Biddings';}else{echo 'Bidding';}?>')" class="btn btn-primary" style="padding:10px;margin-bottom:10pt;"><?php echo $ptitle;?> &nbsp;&nbsp;&nbsp;<span class="badge "><?php echo x_count("bidded","pid='$ido'");?></span></button>
	<?php
	}else{
		
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
           url: "bidbase?call=<?php if(isset($_GET['call']) && !empty($_GET['call'])){echo $_GET['call'];}else{} ?>&sm=<?php echo md5(rand(123,8929203867));?>&tid=<?php echo $_GET['tid'];?>&key=<?php echo $_GET['key'];?>",
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
	
	<?php
	
	}else{
		echo "Failed to load!!";
		
		}?>

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
