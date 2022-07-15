
<div style="margin-top:20pt;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">

<div class="panel panel-default">
<div class="panel-heading"><i class="fa fa-credit-card"></i> PENDING WITHDRAWAL</div>
<div class="panel-body">

<?php
if(x_count("withdrawalbase","status='pending' AND type='withdrawal' LIMIT 1") > 0){
	?>
<table style="background-color:white;margin-top:0pt;" class="table table-striped table-hover tabover">
	<tr>
	<th>No.</th><th>Photo</th><th>Name</th><th>Paystack ID</th><th>Amount</th><th>Profit</th>
	<th>Date</th><th>Status</th><th>Action</th><th></th></tr>
	<?php
$counter = 0;	
foreach(x_select("id,email,amount,paystackid,profit,timereal,token,status","withdrawalbase","status='pending' AND type='withdrawal'","50","id desc") as $key){
$counter++;
		$id = $key["id"];
		$email = $key["email"];
		$amount = "NGN ".number_format($key["amount"],2);
		$payid = $key["paystackid"];
		$profit = $key["profit"];
		$tr = $key["timereal"];
		$tok = $key["token"];$status = $key["status"];
		
		foreach(x_select("user_photo,name,mobile","userdb","email='$email' AND status='active'","1","id desc") as $keu){
		$pht = $keu["user_photo"];
		$nam = $keu["name"];	
		$mobile_u = $keu["mobile"];
		}
		
		?>
		<tr>
		<td><?php echo $counter;?></td>
		<td><img src="<?php echo "../".$pht;?>" class="img-responsive" style="width:30px;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;"/></td>
		<td><?php echo $nam;?><br/>
		<font style="color:green;"><?php echo $email;?></font>
		<br/>
		<font style="color:blue;"><?php echo $mobile_u;?></font>
		</td>
		<td><?php echo $payid;?></td>
		<td><?php echo $amount;?></td>
		<td><?php echo $profit;?></td>
		<td><?php echo $tr;?></td>
		<td><?php echo $status;?></td>
		<td>
		
<script type="text/javascript">
		$(document).ready(function(e){
		$("#appromeda<?php echo $id;?>").on('submit',(function(e) {
		$("#msgda<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/withdrawal_approve",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msgda<?php echo $id;?>").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>
	
	<form style="float:none;margin-left:5pt;" id="appromeda<?php echo $id;?>">
		<input type="hidden" value="<?php echo $id;?>" name='id'/>
		<input type="hidden" value="<?php echo $tok;?>" name='token'/>

	<button class="btn btn-primary"><i class="fa fa-check"></i> Approve</button>
	
	</form>
	
	<style>
	#msgda<?php echo $id;?>{
	margin:5pt;
	display:none;
	color:green;
	font-weight:bold;
	float:none;
	width:100%;
}
		</style>
<div id="msgda<?php echo $id;?>"><img src="../image/load.gif"/></div>
		</td>
		<td>
		
<script type="text/javascript">
		$(document).ready(function(e){
		$("#appromedad<?php echo $id;?>").on('submit',(function(e) {
		$("#msgdad<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/reject_withdrawal",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msgdad<?php echo $id;?>").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>
	
	<form style="float:none;margin-left:5pt;" id="appromedad<?php echo $id;?>">
		<input type="hidden" value="<?php echo $id;?>" name='id'/>
		<input type="hidden" value="<?php echo $tok;?>" name='token'/>

	<button class="btn btn-danger"><i class="fa fa-minus"></i> Reject</button>
	
	</form>
	
	<style>
	#msgdad<?php echo $id;?>{
	margin:5pt;
	display:none;
	color:green;
	font-weight:bold;
	float:none;
	width:100%;
}
		</style>
<div id="msgdad<?php echo $id;?>"><img src="../image/load.gif"/></div>
		
		</td>
		</tr>
		<?php
	}
	?></table><?php
}else{
	echo "<center><p> <i class='fa fa-credit-card' style='font-size:50pt;'></i><br/><br/> No pending widthdrawal</p></center>";
}
?>

</div>

</div>

</div>