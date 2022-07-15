<?php
#session_start();
include_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])){
if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["token"]) && !empty($_GET["token"])){	
include("profbase/coninc.php"); //include config file
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	echo "Invalid page number!";
	exit();
}

$pid = xclean($_GET["id"]);
$ptoken = xclean($_GET["token"]);

//get current starting point of records
$position = ($page_number * $item_per_page);

//Limit our results within a specified range. 
$results = mysqli_query($connecDB,"SELECT token,pid,id,bidder_email,comment,date_time,timereal,status,project_owner FROM bidded WHERE pid='$pid' ORDER BY id desc LIMIT $position, $item_per_page");

/***$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
$photo = xclean($_SESSION["PBNG_PHOTO_2018_VISION"]);****/
?>
<table class="table table-hover table-striped">
	<tr><th>No</th><th>Photo</th><th>Name</th><th>Comment</th><th>Bidded On</th><th>Action</th></tr>
<?php
$counter = 0;
while($key = mysqli_fetch_array($results)){
	$counter++;
	$id = $key["id"];
	$po = $key["project_owner"];
	$email = $key["bidder_email"];
	$pid = $key["pid"];
	$comment = $key["comment"];
	$ts = $key["date_time"];
	$tr = $key["timereal"];
	$token = $key["token"];
	$status = $key["status"];
	

	foreach(x_select("user_photo,name","userdb","email='$email' AND status='active'","1","name") as $key){
	$ph = $key["user_photo"];
	$name = $key["name"];
	}
	
?>

<tr>
<td><?php echo $counter;?></td>
<td><img src="../<?php echo $ph;?>" class="img-responsive remitr"/></td>
<td><?php echo $name;?></td>
<td><?php echo $comment;?></td>
<td><?php echo $tr;?></td>
<td>
	<script type="text/javascript">
		$(document).ready(function(e){
		$("#approme<?php echo $id;?>").on('submit',(function(e) {
		$("#msg<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "appron",
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
	<form id="approme<?php echo $id;?>">
		<input type="hidden" value="<?php echo $email;?>" name='bidder'/>
		<input type="hidden" value="<?php echo $po;?>" name='owner'/>
		<input type="hidden" value="<?php echo $id;?>" name='bidid'/>
		<input type="hidden" value="<?php echo $pid;?>" name='pid'/>
	<button class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Approve</button>
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
</td>
</tr>
<?php

}
echo "</table>";
}else{
	echo "Parameter Missing!";
	
	}
		}
?>
