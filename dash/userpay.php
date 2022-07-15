<?php
include_once("../finishit.php");
session_start();
if(isset($_GET["sm"])){
$user = xclean(	$_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from transaction WHERE owner='$user' AND pid LIKE '%$call%' order by id desc";
}else{
$query="select id from transaction WHERE owner='$user' order by id desc";
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
$user = xclean(	$_SESSION["PBNG_EMAIL_2018_VISION"]);
$query="SELECT * FROM transaction WHERE owner='$user' AND pid LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM transaction WHERE owner='$user' ORDER BY id desc
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
<caption class="capp"><i class="fa fa-money"></i> Total <font class='coml'>Payment = <?php echo x_count("transaction","owner='$user'");?></font></caption>
<tr><th>No</th><th>Project Title</th><th>Amount</th><th>Payment Status</th><th>Time</th><th>Action</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$idp = $key["id"];
		$pid = $key["pid"];
		$cur = $key["currency"];
		$amt = $key["amount"];
		$sta = $key["status"];
		$tr = $key["timereal"];
		
		$token = $key["token"];

	foreach(x_select("ptitle,owner","projects","id='$pid'","1","ptitle") as $key){
	$pj = $key["ptitle"];
	$email = $key["owner"];
	}
		
?>


<tr>
<td><?php echo $counter?></td>
<td><?php echo $pj;?></td>
<td><?php echo $cur." ".number_format($amt,0)?></td>
<td><font style='color:green;font-weight:bold;'><?php echo $sta?></font></td>
<td><?php echo $tr?></td>
<td>
<?php
if($sta == "approved"){
	echo "<font style='color:blue;font-weight:bold;'>completed</font>";
}else{
	?>
	<button onclick="load('payment_page?userpay=<?php echo $email;?>&cathash=<?php echo sha1($email);?>&pid=<?php echo $pid;?>&amtbase=<?php echo $amt;?>')" class="btn btn-primary"><i class="fa fa-credit-card"></i> Paynow</button>&nbsp;&nbsp;
<?php
if(x_count("transaction","id='$idp' AND status='pending' LIMIT 1") > 0){
	?><!--<button onclick="alert('Alert disabled')" class="btn btn-success"><i class="fa fa-bell"></i> Send alert</button>--><?php
	}else{
		
		}
?>

	<?php
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
  $msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-credit-card'></span></p>";
$msg .= "<p class='text-center'>No Transaction Found!</p>";
			echo $msg;
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
