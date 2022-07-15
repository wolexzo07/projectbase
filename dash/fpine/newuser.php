<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<?php
if(x_count("userdb","status='active' OR status='inactive' LIMIT 1") > 0){
	?>
	<table style="background-color:white;margin-top:20pt;" class="table table-striped table-bordered table-hover">
	<caption class="">NEWS USERS</caption>
	<tr>
	<th>No.</th><th>Photo</th><th>Name</th><th>Position</th><th>Mobile</th>
	<th>State</th><th>Country</th><th>Status</th><th>Check</th><th>Delete</th>
	</tr>
	<?php
	$counter=0;
	foreach(x_select("id,token,user_photo,name,position,mobile,country,state,status","userdb","status='active' OR status='inactive'","50","id desc") as $keyy){
		$counter++;
		$id = $keyy["id"];
		$tok = $keyy["token"];
		$ph = $keyy["user_photo"];
		$name = $keyy["name"];
		$pos = $keyy["position"];
		$mobile = $keyy["mobile"];
		$country = $keyy["country"];
		$state = $keyy["state"];
		$sta = $keyy["status"];
		?>
		<tr>
		<td><?php echo $counter;?></td>
		<td><img src="<?php
if($ph == ""){
	?>../image/avatar.png<?php
	
	}else{
		echo "../".$ph;
		
		}
?>" class="img-responsive" style="width:30px;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;"/></td><td><?php echo ucfirst(strtolower($name));?></td>
		<td><?php echo $pos;?></td><td><?php echo $mobile;?></td>
		<td><?php echo $state;?></td><td><?php echo $country;?></td>
		<td><?php echo $sta;?></td>
		<td>
		<button class="btn btn-primary" onclick="load('fpine/userdetails?userid=<?php echo $id;?>&key=<?php echo $tok;?>')"><i class="fa fa-briefcase"></i></button>
		</td>
		<td>
	
	<!--<button class="btn btn-danger" onclick="load('fpine/deleteuser?userid=<?php echo $id;?>&key=<?php echo $tok;?>')"><i class="fa fa-trash"></i></button>--->
	
	<script type="text/javascript">
		$(document).ready(function(e){
		$("#appromeder<?php echo $id;?>").on('submit',(function(e) {
		$("#msgder<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/deleteuser",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msgder<?php echo $id;?>").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>
	
	<form style="float:none;margin-left:5pt;" id="appromeder<?php echo $id;?>">
		<input type="hidden" value="<?php echo $id;?>" name='id'/>
		<input type="hidden" value="<?php echo $tok;?>" name='token'/>

	<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
	
	</form>
	
	<style>
	#msgder<?php echo $id;?>{
	margin:5pt;
	display:none;
	color:green;
	font-weight:bold;
	float:none;
	width:100%;
}
		</style>
<div id="msgder<?php echo $id;?>"><img src="../image/load.gif"/></div>

	
		</td>
		
		</tr>
		<?php
	}
	?></table><?php
}else{
	
}
?>

</div>
