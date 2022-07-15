<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from bidded WHERE bidder_email='$user' AND status='approved' AND pid LIKE '%$call%' order by id desc";
}else{
$query="select id from bidded WHERE bidder_email='$user' AND status='approved' order by id desc";
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
$query="SELECT id,pid,project_owner,timereal,token FROM bidded WHERE bidder_email='$user' AND status='approved' AND pid LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT id,pid,project_owner,timereal,token FROM bidded WHERE bidder_email='$user' AND status='approved' ORDER BY id desc
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
	<caption class="capp"><i class="fa fa-briefcase"></i> Total <font class='coml'>Approved (completed inclusive) = <?php echo x_count("bidded","bidder_email='$user' AND status='approved'");?></font></caption>

<tr><th>No</th><th>Photo</th><th>Project Title</th><th>Amount</th><th>Payment status</th><th>Action</th></tr>
<?php

    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$pid = $key["pid"];
		$po = $key["project_owner"];
		$tr = $key["timereal"];
		$token = $key["token"];
		
	
		
	foreach(x_select("user_photo,name","userdb","email='$po' AND status='active'","1","name") as $key){
	$photo = $key["user_photo"];
	$pname = $key["name"];
	}
	
	foreach(x_select("ptitle,amount_to_pay,amount_currency,time_from,time_to,payment_status,token,completion_status","projects","id='$pid'","1","id") as $key){
	$ptitle = $key["ptitle"];
	$amt = $key["amount_to_pay"];
	$amt_c = $key["amount_currency"];
	$tfr = $key["time_from"];
	$tto = $key["time_to"];
	$ps = $key["payment_status"];
	$cs = $key["completion_status"];
	$toker = $key["token"];
	}	
	
	if($cs == "inactive"){
		?>
		<tr>
<td><?php echo $counter?></td>
<td>
<?php
if($ps == "active"){
	?><img src="../<?php echo $photo;?>" class="img-responsive remitr"/><?php
	}else{
		?><img src="../image/avatar.png" class="img-responsive remitr"/><?php
		
		}

?>
</td>
<td><?php echo ucwords(strtolower($ptitle));?></td>
<td><?php echo $amt_c." ".number_format($amt,0);?></td>
<!---<td><font style="color:blue;font-weight:bold;"><?php echo $tfr." - "."$tto";?></font></td>--->
<td><font style='color:blue;font-weight:bold;'><?php echo $ps;?></font></td>
<td>
<button onclick="load('profbase/checker?tid=<?php echo $pid;?>&key=<?php echo $toker;?>')" class="btn btn-primary"><i class="fa fa-edit"></i> </button>

</td>
</tr>
		<?php
		}else{
			
			}
	
		
				
	}
	?></table><?php

}
else
{
    
	$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-briefcase'></span></p>";
$msg .= "<p class='text-center'>No Job was approved!!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
