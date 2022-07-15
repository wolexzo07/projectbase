<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from bidded WHERE bidder_email='$user' AND pid LIKE '%$call%' order by id desc";
}else{
$query="select id from bidded WHERE bidder_email='$user' order by id desc";
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
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="SELECT pid,project_owner,status FROM bidded WHERE bidder_email='$user' AND pid LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT pid,project_owner,status FROM bidded WHERE bidder_email='$user' ORDER BY id desc
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
<caption class="capp"><i class="fa fa-briefcase"></i> Total <font class='coml'>Bidded = <?php echo x_count("bidded","bidder_email='$user'");?></font></caption>
<tr><th>No</th><th>Photo</th><th>Job Title</th><th>Amount</th><!---<th>Bidded</th>---><th>Status</th><th>Action</th></tr>
<?php

    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["pid"];
		$userr = $key["project_owner"];
		$status = $key["status"];
		
	
		
	foreach(x_select("user_photo","userdb","email='$userr' AND status='active'","1","name") as $key){
	$photo = $key["user_photo"];
	}

	foreach(x_select("approved_to,ptitle,amount_to_pay,amount_currency,id,token,payment_status","projects","id='$id'","1","id") as $key){
	$ptitle = $key["ptitle"];
	$amt = $key["amount_to_pay"];
	$amt_c = $key["amount_currency"];
	$prid = $key["id"];
	$prtoken = $key["token"];
	$pys = $key["payment_status"];
	$apto = $key["approved_to"];
	}	

		
?>

<tr>
<td><?php echo $counter?></td>
<td><img src="<?php
$userb = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(($pys == "active") && ($apto == "$userb")){
	?>../<?php echo $photo;?><?php
	}else{
		?>../image/avatar.png<?php
		}
?>" class="img-responsive remitr"/></td>
<td><?php echo ucwords(strtolower($ptitle));?></td>
<td><?php echo $amt_c." ".number_format($amt,0);?></td>
<!---<td><?php $userb = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
		
		if(x_count("bidded","bidder_email='$userb' AND pid='$id' LIMIT 1") > 0){
echo "<font style='color:green;font-weight:bold;'>yes</font>";
			}else{
				echo "<font style='color:blue;font-weight:bold;'>No</font>";
				}?></td>--->
				<td><?php 
		//checking for project given out to someone else than the current user
		$reco = x_count("bidded","pid='$prid' AND bidder_email !='$userb' AND status='approved' LIMIT 1");
		if($reco > 0){
			echo "<font style='color:red;font-weight:bold;'>Given out</font>";
			}else{
				echo $status;
				}
		
				
				
				?></td>
<td>
<!---<button onclick="load('profbase/unbidding?tid=<?php echo $id;?>&key=<?php echo $token;?>')" class="btn btn-success"><i class="fa fa-remove"></i> Unbid</button>-->
<?php $userb = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);?>

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
		<input type="hidden" value="<?php echo $prid;?>" name='pid'/>
		<input type="hidden" value="<?php echo $prtoken;?>" name='ptoken'/>
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

</td>

</tr>


<?php
				
	}
	?></table><?php

}
else
{
    
	$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-briefcase'></span></p>";
$msg .= "<p class='text-center'>No Job bidded yet!!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
