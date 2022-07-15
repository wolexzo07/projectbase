<?php
include_once("../../finishit.php");
xstart("0");
if(isset($_GET["sm"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);

$query="select id from workdone WHERE bidder='$user' order by id desc";

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

$query="SELECT * FROM workdone WHERE bidder='$user' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";


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
<caption class="capp"><i class="fa fa-briefcase"></i> Total <font class='coml'>Uploads = <?php echo x_count("workdone","bidder='$user'");?></font></caption>
<tr><th>No</th><th>Project</th><th>Type</th><th>Client</th><th>Size</th><th>Date</th><th>Attachment</th></tr>
<?php

    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$pid = $key["pid"];
		$owner = $key["owner"];
		$bidder = $key["bidder"];
		$fs = $key["filesize"];
		$fp = $key["filepath"];
		$note = $key["note"];
		$ext = $key["ext"];
		$stat = $key["status"];
		$dt = $key["date_time"];
		$token = $key["token"];
		$cate = $key["category"];
		
		
		
	foreach(x_select("user_photo,name","userdb","email='$owner' AND status='active'","1","name") as $key){
	$photo = $key["user_photo"];
	$rname = $key["name"];
	}
	
	foreach(x_select("ptitle","projects","id='$pid'","1","id") as $key){
	$ptitle = $key["ptitle"];
	}	
	
	
		
?>

<tr>
<td><?php echo $counter?></td>
<td><?php echo ucwords(strtolower($ptitle));?></td>
<td style="color:blue;font-weight:bold;"><?php echo ucwords(strtolower($cate));?></td>
<td><?php echo ucwords(strtolower($rname))."<br/><font style='color:green'>(".strtolower($owner).")</font>";?></td>
<td><?php echo $fs;?></td>
<td><?php echo $dt;?></td>
<td>
<button class="btn btn-success" onclick="parent.location='<?php echo $fp;?>'"><span class="fa fa-cloud-download"></span> Download</button>
	</td>
</tr>


<?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-cloud-upload'></span></p>";
$msg .= "<p class='text-center'>No Job upload yet!</p>";
echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
