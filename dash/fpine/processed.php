<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
	//$cat = xg("cat");
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from withdrawalbase WHERE status != 'pending' AND email LIKE '%$call%' order by id desc";
}else{
$query="select id from withdrawalbase WHERE status !='pending' order by id desc";
}
$res    = mysqli_query(x_cstring(),$query);
$count  = mysqli_num_rows($res);
$page = (int) (!isset($_REQUEST['pageId']) ? 1 :$_REQUEST['pageId']);
$page = ($page == 0 ? 1 : $page);
$recordsPerPage = 50;
$start = ($page-1) * $recordsPerPage;
$adjacents = "2";
    
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($count/$recordsPerPage);
$lpm1 = $lastpage - 1;   
$pagination = "";
if($lastpage > 1)
    {   
        $pagination .= "<div class='pagination'>";
        if ($page > 1)
            $pagination.= "<a href=\"#Page=".($prev)."\" onClick='changePagination(".($prev).");'>&laquo; Previous&nbsp;&nbsp;</a>";
        else
            $pagination.= "<span class='disabled'>&laquo; Previous&nbsp;&nbsp;</span>";   
        if ($lastpage < 7 + ($adjacents * 2))
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class='current'>$counter</span>";
                else
                    $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
                         
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))
        {
            if($page < 1 + ($adjacents * 2))
            {
                for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if($counter == $page)
                        $pagination.= "<span class='current'>$counter</span>";
                    else
                        $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
                }
                $pagination.= "...";
                $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
                $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   
           
           }
           elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "...";
               for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
               {
                   if($counter == $page)
                       $pagination.= "<span class='current'>$counter</span>";
                   else
                       $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
               }
               $pagination.= "..";
               $pagination.= "<a href=\"#Page=".($lpm1)."\" onClick='changePagination(".($lpm1).");'>$lpm1</a>";
               $pagination.= "<a href=\"#Page=".($lastpage)."\" onClick='changePagination(".($lastpage).");'>$lastpage</a>";   
           }
           else
           {
               $pagination.= "<a href=\"#Page=\"1\"\" onClick='changePagination(1);'>1</a>";
               $pagination.= "<a href=\"#Page=\"2\"\" onClick='changePagination(2);'>2</a>";
               $pagination.= "..";
               for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
               {
                   if($counter == $page)
                        $pagination.= "<span class='current'>$counter</span>";
                   else
                        $pagination.= "<a href=\"#Page=".($counter)."\" onClick='changePagination(".($counter).");'>$counter</a>";     
               }
           }
        }
        if($page < $counter - 1)
            $pagination.= "<a href=\"#Page=".($next)."\" onClick='changePagination(".($next).");'>Next &raquo;</a>";
        else
            $pagination.= "<span class='disabled'>Next &raquo;</span>";
        
        $pagination.= "</div>";       
    }
    
if(isset($_POST['pageId']) && !empty($_POST['pageId']))
{
    $id=$_POST['pageId'];
}
else
{
    $id='0';
}

if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="SELECT * FROM withdrawalbase WHERE status !='pending' AND email LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM withdrawalbase WHERE status !='pending' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}

//echo $query;
$res    =   mysqli_query(x_cstring(),$query);
$count  =   mysqli_num_rows($res);
$HTML='';
echo $pagination;
if($count > 0)
{
	$counter = 0;
?>
<table class="table table-striped table-hover tabover">
<caption class="capp"><?php echo $count;?> Record(s) Found in the database</caption>
	<tr>
	<th>No.</th><th>Photo</th><th>Name</th><th>Paystack ID</th><th>Amount</th><th>Profit</th>
	<th>Date</th><th>Status</th><th>Action</th><th></th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
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
        	url: "fpine/deltrack",
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

	<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
	
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
		
		</td>
		</tr><?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-credit-card'></span></p>";
$msg .= "<p class='text-center'>No Processed Transaction!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
