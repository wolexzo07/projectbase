<?php
include_once("../finishit.php");
session_start();
if(isset($_GET["sm"])){
	
$pid = xclean($_GET["tid"]);
$ptoken = xclean($_GET["key"]);

$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from bidded WHERE pid='$pid' AND pid LIKE '%$call%' order by id asc";
}else{
$query="select id from bidded WHERE pid='$pid' order by id asc";
}
$res    = mysqli_query(x_cstring(),$query);
$count  = mysqli_num_rows($res);
$page = (int) (!isset($_REQUEST['pageId']) ? 1 :$_REQUEST['pageId']);
$page = ($page == 0 ? 1 : $page);
$recordsPerPage = 25;
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
$query="SELECT token,pid,id,bidder_email,comment,date_time,timereal,status,project_owner FROM bidded WHERE pid='$pid' AND pid LIKE '%$call%' ORDER BY id asc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT token,pid,id,bidder_email,comment,date_time,timereal,status,project_owner FROM bidded WHERE pid='$pid' ORDER BY id asc
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
<caption class="capp"><i class="fa fa-users"></i> Total <font class='coml'>Bidding(s) = <?php echo x_count("bidded","pid='$pid'");?></font></caption>
<tr><th>No</th><th>Photo</th><th>Name</th> <th>Freedom Status</th><th>Comment</th><th>Bidded On</th><th>Action</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
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
	
	foreach(x_select("payment_status","projects","id='$pid'","1","id") as $key){
	$psy = $key["payment_status"];

	}
	
?>

<tr>
<td><?php echo $counter;?></td>
<td><img src="<?php
if($psy == "active"){
	?>../<?php echo $ph;?><?php
	}else{
		?>../image/avatar.png<?php
		}

?>" class="img-responsive remitr"/></td>
<td><?php
if($psy == "active"){
	?><?php echo $name;?><?php
	}else{
		?>Non-Funded<?php
		}

?></td>

<td><?php
if(x_count("bidmore","status='yes' AND id='1' LIMIT 1") > 0){
		
		//bidmore true
		echo "<font style='color:blue;'>free now</font>";
		
		}else{
					
			//checking that the proffessional finished all the pending projects
		if(x_count("projects","approved_to='$email' AND processing_status='active' AND completion_status='inactive' AND bidded_status='active' LIMIT 1") > 0){
				echo "<font style='color:green;'>occupied now</font>";
			}else{
				echo "<font style='color:blue;'>free now</font>";
				}
				//checking that the proffessional finished all the pending projects ended	
			
			}	
	//checking to know if a professional can undertake more than one job at a time
?></td>
<td><?php echo $comment;?></td>
<td><?php echo $tr;?></td>
<td>
	<button onclick="load('check_prof?pid=<?php echo $pid;?>&token=<?php echo $ptoken;?>&userkey=<?php echo $id;?>&bidmail=<?php echo $email;?>')" style="margin-right:10pt;" class="btn btn-primary pull-left"><i class="fa fa-user"></i> Profile</button>
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
	<form class="pull-left" id="approme<?php echo $id;?>">
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
