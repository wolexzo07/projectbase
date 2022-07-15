<?php
include_once("../finishit.php");
session_start();
if(isset($_GET["sm"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query ="select id from userdb WHERE ref LIKE '%$call%' order by id desc";
}else{
$query="select id from userdb WHERE ref='$user' order by id desc";
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
$query="SELECT id,name,user_photo,gender,position,realtime,token,mobile,email FROM userdb WHERE ref LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT id,name,user_photo,gender,position,realtime,token,mobile,email FROM userdb WHERE ref='$user' ORDER BY id desc
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
<caption class="capp"><i class="fa fa-users"></i> Total <font class='coml'>Referrals = <?php echo x_count("userdb","ref='$user'");?></font></caption>
<tr><th>No</th><th>Photo</th><th>Name</th><th>position</th><th>Gender</th>
<th>Mobile</th><th>Earnings</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$name = $key["name"];
		$email = $key["email"];
		$usp = $key["user_photo"];
		$gen = $key["gender"];
		$pos = $key["position"];
		$rt = $key["realtime"];
		$tok = $key["token"];
		$mobile = $key["mobile"];

		
?>

<tr>
<td><?php echo $counter?></td>
<td><img style="width:50px;" class="img-circle img-responsive " src="
<?php
if($usp == ""){
	?>../image/avatar.png<?php
	
	}else{
		?>../<?php echo $usp;?><?php
		
		}
?>"/></td>
<td><?php echo $name?></td>
<td><?php echo $pos?></td>
<td><?php echo $gen?></td>
<td><?php echo $mobile?></td>
<td>
<?php
$summ = x_sum("refamount","ref_biz","paidto='$user' AND paidfrom='$email'");
echo "NGN ".number_format($summ,2);
?>
</td>
</tr>


<?php
				
	}
	?>
	<tr>
<td></td>
<td></td>
<th>Total Earnings</th>
<td></td>
<td></td>
<td></td>
<th>
<?php
$summ = x_sum("refamount","ref_biz","paidto='$user'");
echo "NGN ".number_format($summ,2);
?>
</th>
</tr>
	</table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-users'></span></p>";
$msg .= "<p class='text-center'>No referral found!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
