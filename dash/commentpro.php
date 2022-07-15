<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 tourbase">
<h3 class="yii"><font style='color:green;'><i class="glyphicon glyphicon-check"></i> Professional </font> Review
<button class="btn btn-primary pull-right" onclick="load('completejob')">
<i class="fa fa-arrow-left"></i></button>
</h3>
<?php
if(isset($_GET["pid"]) && !empty($_GET["pid"]) && isset($_GET["ptoken"]) && !empty($_GET["ptoken"]) && isset($_GET["powner"]) && !empty($_GET["powner"]) && isset($_GET["bidder"]) && !empty($_GET["bidder"])){

$powner = xg("powner");	$bidmail = xg("bidder");
$pid = xg("pid");	$ptoken = xg("ptoken");	

if(x_count("projects","id='$pid' AND token='$ptoken' LIMIT 1") > 0){
foreach(x_select("pcategory,ptitle","projects","id='$pid' AND token='$ptoken'","1","id desc") as $key){
	$ptitle = $key["ptitle"];$pcat = $key["pcategory"];	
	}
if(x_count("userdb","email='$bidmail' LIMIT 1") > 0){
foreach(x_select("name,email,mobile,user_photo","userdb","email='$bidmail'","1","id desc") as $key){
	$name = $key["name"];$ph = $key["user_photo"];
	$email = $key["email"];$mobile = $key["mobile"];	
	}	
if(x_count("userdb","email='$powner' LIMIT 1") > 0){
	?>
	<table class="table table-striped table-hover ">
	<tr>
	<th><img  src="<?php echo "../".$ph;?>" class="img-circle img-responsive imglog"/></th>
	<td>
	<p class="rebu"><?php echo strtoupper($name);?></p>
	<p class="rebu"><?php echo strtolower($email);?></p>
	<p class="rebu"><?php echo strtolower($mobile);?></p>
	</td>
	</tr>
	
	
	<tr>
	<th>PROJECT TITLE</th>
	<td style="color:green;"><?php echo strtoupper($ptitle);?>
	&nbsp;&nbsp;</td>
	</tr>
	<tr>
	<th>CATEGORY</th>
	<td style="color:green;"><?php echo strtoupper($pcat);?></td>
	</tr>
	
	<tr>
	<th>STATUS</th>
	<td style="color:green;"><span style="background-color:green;padding:10px;" class="badge">Completed</span></td>
	</tr>
	
	
	</table>
	<script type="text/javascript">
		$(document).ready(function(e){
		$("#approme").on('submit',(function(e) {
		$("#msg").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "procomment",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msg").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>

<form id="approme">
	<input type="hidden" value="<?php echo xg('pid');?>" name='pid'/>
	<input type="hidden" value="<?php echo xg('ptoken');?>" name='ptoken'/>
	<input type="hidden" value="<?php echo xg('bidder');?>" name='bidder'/>
	<input type="hidden" value="<?php echo xg('powner');?>" name='powner'/>
	<textarea class="form-control" style="resize:none;height:120px;" name="comment"></textarea>
	<button style="padding:15px;width:100%;" class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Submit</button>
	</form>
	<div id="msg"><img src="../image/load.gif"/></div>
	
		<style>
		#msg{
	margin-top:10pt;
	display:none;
	color:green;
	font-weight:bold;
}
		</style>
		
		<?php
		if(x_count("review","pid='$pid' AND ptoken='$ptoken' LIMIT 1") > 0){
			
foreach(x_select("date_time,comment","review","pid='$pid' AND ptoken='$ptoken'","1","id desc") as $key){
	$dt = $key["date_time"];$com = $key["comment"];
	}
	?>
	<table style="margin-top:20pt;" class="table table-hover table-striped table-bordered">
	<tr style="background-color:white;">
	<th><i class="fa fa-edit"></i> Posted Review
	<i style="background-color:white;color:green;" class="badge pull-right"><i class="fa fa-calendar"></i> <?php echo $dt;?></i></th>
	</tr>
	
	<tr>
	<td><?php echo $com;?><br/>
	
	</td>
	</tr>
	</table>
	<?php
			
		}else{
			echo "<p class='hubmsg'>No review found!!</p>";
		}
		?>

	<?php
		
}else{
	echo "<p class='hubmsg'>Invalid project owner</p>";
}	

}else{
	echo "<p class='hubmsg'>Invalid bid email</p>";
}	
	
}else{
echo "<p class='hubmsg'>Invalid project!</p>";	
}


}else{

?>
<script>
alert("Missing Parameter!");
load("completejob");
</script><?php	
	
}

?>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
</div>
