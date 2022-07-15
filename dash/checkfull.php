<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tourbase">
<?php
require_once("../finishit.php");
if(isset($_GET['key']) && isset($_GET['tid']) && !empty($_GET['key']) && !empty($_GET['tid'])){
	
	$token = xg("key");
	$email = xg("tid");
	foreach(x_select("0","projects","id='$email' AND token='$token'","1","id") as $key ){
		$id = $key["id"];
		$title = $key["ptitle"];
		$status = $key["status"];
		$des = $key["pdes"];
		$tr = $key["timereal"];
		$amt = $key["amount_to_pay"];
		$amt_c = $key["amount_currency"];
		$user = $key["owner"];
		$own = $key["owner"];
		$pcat = $key["pcategory"];
		$tfrom = $key["time_from"];
		$tto = $key["time_to"];
		$token = $key["token"];
		
		$bds = $key["bidded_status"];
		$pys = $key["payment_status"];
		$pps = $key["processing_status"];
	
		?>
<button onclick="load('fettch_post')" style="padding:15px;width:250px;margin-bottom:20pt;" class="btn btn-success"><i class="fa fa-briefcase"></i> POSTED JOBS &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge"><?php

if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
	#$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	echo x_count("projects","owner='$user'");
}else{
	echo "0";
}

?></span></button>
		<h4 style="display:block;margin-bottom:20pt;" class="protitle"><i class="fa fa-edit"></i> <?php echo htmlspecialchars(ucwords(strtolower($title)));?></h4>
		
		<table id="fftab" class="table table-striped table-hover ftab">
		<tr>
		<th><i class="fa fa-briefcase"></i>&nbsp;&nbsp;&nbsp; PROJECT CATEGORY</th><td><?php echo htmlspecialchars(ucfirst(strtoupper($pcat)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-edit"></i>&nbsp;&nbsp;&nbsp; PROJECT TITLE</th><td><?php echo htmlspecialchars(ucfirst(strtoupper($title)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp; PROJECT DESCRIPTION</th><td><?php echo htmlspecialchars(ucfirst(strtolower($des)));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp; BUDGETED AMOUNT</th><td><?php echo htmlspecialchars($amt_c." ".number_format($amt,2));?></td>
		</tr>
		<tr>
		<th><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp; TIME FRAME</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($tfrom." <<>> ".$tto)));?></b></td>
		</tr>
		<tr>
		<th><i class="glyphicon glyphicon-time"></i>&nbsp;&nbsp;&nbsp; POSTED ON</th><td><?php echo htmlspecialchars(ucfirst(strtolower($tr)));?></td>
		</tr>
		
		<?php
		#$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
		$posl = xclean($_SESSION["PBNG_POSITION_2018_VISION"]);
		if(($pys == "active") || ($posl == "super")){
		
		if(x_count("userdb","email='$user' LIMIT 1") > 0){
		
		foreach(x_select("email,mobile","userdb","email='$user'","1","id") as $key ){
		$mob = $key["mobile"];
		$emal = $key["email"];
		
?>
<tr><th><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp; MOBILE</th><td><?php echo htmlspecialchars($mob);?></td></tr>

<tr><th><i class="fa fa-inbox"></i>&nbsp;&nbsp;&nbsp; EMAIL</th><td><?php echo htmlspecialchars($emal);?></td></tr>
<?php
		
		}
			}else{
			echo "No user found!";
			}
		
			}else{
				
				
				}
		
		?>
		
		<tr>
		<th><i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp; STATUS</th><td><b style="color:green;"><?php echo htmlspecialchars(ucfirst(strtolower($status)));?></b></td>
		</tr>
		<tr>
		<th><i class="fa fa-cog"></i>&nbsp;&nbsp;&nbsp; ACTION</th><td>
			<button id="adj" class="btn btn-primary btn-lg"><i class="fa fa-edit"></i> Adjust Post / Budget</button>

		</td>
		</tr>
		
		</table>
		
		<!--------------------Start here--------------------->
		<div class='edtform'>
		
					<?php
			$userr = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
			if($own == $userr){
				?>
		<script type="text/javascript">
		$(document).ready(function(e){
		$("#approme<?php echo $id;?>").on('submit',(function(e) {
		$("#msg<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "updpro",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msg<?php echo $id;?>").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>
<form  id="approme<?php echo $id;?>">
<p>Enter Project Title:</p>
<input type="text" class="form-control ttx" style="width:100%;" value="<?php echo htmlspecialchars(ucfirst(strtoupper($title)));?>" name='title'/>
<p>Enter Bugdet:</p>
<input type="number" class="form-control ttx" value="<?php echo $amt;?>" name='amount'/>
<p>Enter Description:</p>
<textarea class="form-control pdes" maxlength="400" name="des" style="resize:none;"><?php echo htmlspecialchars(ucfirst(strtolower($des)));?></textarea>
<p>Time Frame From:</p>
<input type="text" class="form-control ttx" id="datetimepicker" value="<?php echo $tfrom;?>" name='timefrom'/>
<p>Time Frame To:</p>
<input type="text" class="form-control ttx" id="datetimepickerr" value="<?php echo $tto;?>" name='timeto'/>
<input type="hidden" value="<?php echo $id;?>" name='id'/>
<input type="hidden" value="<?php echo $token;?>" name='token'/>
<button class="btn btn-primary ttx"><i class="fa fa-edit"></i> Adjust Post / Budget</button>
</form>
	<div id="msg<?php echo $id;?>"><img src="../image/load.gif"/></div>
	
		<style>
		#msg<?php echo $id;?>{
	margin-top:10pt;
	display:none;
	color:green;
	font-weight:bold;
}
		</style>		
		
				<?php
				}else{
					
					
					}
			
			?>
		
		</div>
		
		<!--------------------Ends Here--------------------------->
		<?php
		
	}
	
}else{
	echo "Parameter Missing";
}
?>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>
<style>

	.edtform{
		display:none;
		}
</style>
<script src="build/jquery.datetimepicker.full.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$("#adj").click(function(){
	$("#fftab").hide("slow");
	$(".edtform").show("slow");
		
		});
	});
$.datetimepicker.setLocale('en');
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
startDate:	'<?php echo $tfrom;?>',
formatTime:'H:i:s',
formatDate:'Y-m-d',
format:'Y-m-d',
timepicker:false
});

$('#datetimepickerr').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
startDate:	'<?php echo $tto;?>',
formatTime:'H:i:s',
formatDate:'Y-m-d',
format:'Y-m-d',
timepicker:false
});
</script>
