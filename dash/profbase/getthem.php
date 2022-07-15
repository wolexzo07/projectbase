<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){

if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from projects WHERE processing_status='inactive' AND status='active' AND title LIKE '%$call%' order by id desc";
}else{
$query="select id from projects WHERE processing_status='inactive' AND status='active' order by id desc";
}
$res    = mysqli_query(x_cstring(),$query);
$count  = mysqli_num_rows($res);
$page = (int) (!isset($_REQUEST['pageId']) ? 1 :$_REQUEST['pageId']);
$page = ($page == 0 ? 1 : $page);
$recordsPerPage = 10;
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
$query="SELECT id,ptitle,status,pdes,timereal,amount_to_pay,amount_currency,owner,pcategory,time_from,time_to,token,payment_status FROM projects WHERE processing_status='inactive' AND status='active' AND ptitle LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT id,ptitle,status,pdes,timereal,amount_to_pay,amount_currency,owner,pcategory,time_from,time_to,token,payment_status FROM projects WHERE processing_status='inactive' AND status='active' ORDER BY id desc
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
<caption class="capp"><i class="fa fa-briefcase"></i> Total <font class='coml'>Available = <?php echo x_count("projects","processing_status='inactive' AND status='active'");?></font></caption>
<tr><th>No</th><th>Photo</th><th>Job Title</th><th>Amount</th><th>Bidded</th><th>Bid Count</th><th>Action</th></tr>
<?php

    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$title = $key["ptitle"];
		$status = $key["status"];
		$des = $key["pdes"];
		$tr = $key["timereal"];
		$amt = $key["amount_to_pay"];
		$amt_c = $key["amount_currency"];
		$user = $key["owner"];
		$pcat = $key["pcategory"];
		$tfrom = $key["time_from"];
		$tto = $key["time_to"];
		
		$token = $key["token"];
		
		$pys = $key["payment_status"];
		
	
		
	foreach(x_select("user_photo","userdb","email='$user' AND status='active'","1","name") as $key){
	$photo = $key["user_photo"];
	}
	
	
		
?>

<tr>
<td><?php echo $counter?></td>
<td><img src="<?php
if($pys == "active"){
	?>../<?php echo $photo;?><?php
	}else{
		?>../image/avatar.png<?php
		}
?>" class="img-responsive remitr"/></td>
<td><?php echo ucwords(strtolower($title));?></td>
<td><?php echo $amt_c." ".number_format($amt,0);?></td>
<td>
<?php 
$userb = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);

if(x_count("bidded","bidder_email='$userb' AND pid='$id' LIMIT 1") > 0){
	
echo "<font style='color:green;font-weight:bold;'>yes</font>";
			}else{
				echo "<font style='color:blue;font-weight:bold;'>No</font>";
				}?></td>
				
				<td><span style="background-color:#663399" class="badge"><?php echo x_count("bidded","pid='$id'");?></span></td>
				
<td>
<?php $userb = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
		
		if(x_count("bidded","bidder_email='$userb' AND pid='$id' LIMIT 1") > 0){
				?>
				<!---<button onclick="alert('You have bidded for this project!')" class="btn btn-danger"><i class="fa fa-remove"></i> UnBid</button>--->
				
		<script type="text/javascript">
		$(document).ready(function(e){
		$("#approme<?php echo $id;?>").on('submit',(function(e) {
		$("#msg<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "profbase/unbide",
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
	<form style="float:none;" id="approme<?php echo $id;?>">
		<input type="hidden" value="<?php echo $userb;?>" name='userb'/>
		<input type="hidden" value="<?php echo $id;?>" name='pid'/>
		<input type="hidden" value="<?php echo $token;?>" name='ptoken'/>
	<button class="btn btn-danger"><i class="glyphicon glyphicon-remove-circle"></i> Unbid</button>
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
				?>
				<button onclick="load('profbase/checkjob?tid=<?php echo $id;?>&key=<?php echo $token;?>')" class="btn btn-primary"><i class="fa fa-edit"></i> </button>&nbsp;&nbsp;
				
				<button onclick="load('profbase/bidding?tid=<?php echo $id;?>&key=<?php echo $token;?>')" class="btn btn-success"><i class="fa fa-credit-card"></i> Bid</button>
				<?php
				}?>

</td>
</tr>


<?php
				
	}
	?></table><?php

}
else
{
    
	$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-briefcase'></span></p>";
$msg .= "<p class='text-center'>No Job is available now!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
