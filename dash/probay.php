<?php
include_once("../finishit.php");
session_start();
if(isset($_GET["sm"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from buy_sell WHERE status='approved' AND ptitle LIKE '%$call%' OR status='approved' AND department LIKE '%$call%' order by id desc";
}else{
$query="select id from buy_sell WHERE status='approved' order by id desc";
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
$query="SELECT * FROM buy_sell WHERE status='approved' AND ptitle LIKE '%$call%' OR status='approved' AND department LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM buy_sell WHERE status='approved' ORDER BY id desc
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
<caption class="capp"><i class="fa fa-briefcase"></i> Projects <font class='coml'>for sale = <?php 
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
echo x_count("buy_sell","status='approved' AND ptitle LIKE '%$call%' OR status='approved' AND department LIKE '%$call%'");
}else{
	echo x_count("buy_sell","status='approved'");
	}
?></font></caption>
<tr><th>No</th><th>Title</th><th>Amount</th><th>Category</th><th>Department</th><th>Abstract</th><th>Action</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$title = ucwords(strtolower($key["ptitle"]));
		$status = $key["status"];
		$cat = $key["category"];
		$dept = ucwords(strtolower($key["department"]));
		$amt = number_format($key["amount"],2);
		$abfs = $key["abfilesize"];
		$user = $key["postedby"];
		$abfp = $key["abfilepath"];
		$rt = $key["rtime"];
		$dt = $key["date_time"];
		$note = $key["note"];
		#$appr_to = $key["approved_to"];
		$token = $key["token"];


		
?>

<tr>
<td><?php echo $counter?></td>
<td><?php echo $title;?></td>
<td><?php echo "NGN $amt"?></td>
<td><?php echo $cat;?></td>
<td><?php echo $dept;?></td>
<td>
<button class="btn btn-success" onclick="parent.location='<?php echo $abfp;?>'"><i class="fa fa-download"></i> <?php echo $abfs;?></button>
</td>
<td>
	
	<?php
	$userr = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
	if($userr == $user){
		echo "<span class='badge' style='background-color:purple;padding:12px;'><i class='fa fa-edit'></i> Your post</span>";
		}else{
			?><button class="btn btn-primary" onclick="load('paypro?id=<?php echo $id;?>&token=<?php echo $token;?>')"><i class="fa fa-credit-card"></i> Buy</button><?php
			}
	?>
</td>
</tr>


<?php
				
	}
	?></table><?php

}
else
{
if(isset($_GET['call']) && !empty($_GET['call'])){
	$c = $_GET['call'];
	$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-briefcase'></span></p>";
$msg .= "<p class='text-center'>No project found for <b>$c</b>!</p>";
$msg .= "<button class='btn btn-primary text-center'><i class='fa fa-arrow-left'></i> Go Back</button>";
echo $msg;
	}else{
	$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-briefcase'></span></p>";
$msg .= "<p class='text-center'>No project was approved!</p>";
echo $msg;	
	}
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
