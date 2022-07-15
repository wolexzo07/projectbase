<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
	//$cat = xg("cat");
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from projectsold WHERE user LIKE '%$call%' order by id desc";
}else{
$query="select id from projectsold order by id desc";
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
$query="SELECT * FROM projectsold WHERE user LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM projectsold ORDER BY id desc
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
<tr><th>No</th><th>Project</th><th>Paid</th><th>PID</th><th>Seller</th><th>Buyer</th><th>Upay</th><th>Cprofit</th><th>Date</th><th>Action</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$pid = $key["pid"];
		$ptok = $key["ptoken"];
		$payid = $key["paystack_id"];
		$pc = $key["paystack_charge"];
		$user = $key["user"];
		$amtpaid = $key["amountpaid"];
		$cpay = $key["company_pay"];
		$upay = $key["user_pay"];
		$ptr = $key["paid_time_r"];
		
		foreach(x_select("ptitle,category,postedby,department,amount","buy_sell","id='$pid' AND token='$ptok'","1","id") as $key){
			$title = $key["ptitle"];$cat = $key["category"];$by = $key["postedby"];$dept = $key["department"];$amt = $key["amount"];
		}
		
		foreach(x_select("name,mobile","userdb","email='$user'","1","id") as $key){
			$buyer = $key["name"];$buyer_no = $key["mobile"];
		}
		foreach(x_select("name,mobile","userdb","email='$by'","1","id") as $key){
			$seller = $key["name"];$seller_no = $key["mobile"];
		}
		
		?><tr>
		<td><?php echo $counter ;?></td><td><?php echo xup($title,"") ;?></td>
		<td><?php echo "NGN ".number_format($amtpaid) ;?></td>
		<td style="color:green;font-weight:bold;"><?php echo $payid;?></td>
		<td><?php echo "<font style='color:purple;'>".$seller."</font><br/><font style='color:green;'>$by</font><br/><font style='color:purple;'>$seller_no</font>";?></td>
		<td><?php echo "<font style='color:purple;'>".$buyer."</font><br/><font style='color:green;'>$user</font><br/><font style='color:purple;'>$buyer_no</font>";?></td>
		<td><?php echo "NGN ".number_format($upay) ;?></td>
		<td><?php echo "NGN ".number_format($cpay) ;?></td>
		<td><?php echo $ptr;?></td>
		<td>
		<button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
		</tr><?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-credit-card'></span></p>";
$msg .= "<p class='text-center'>No Payment History!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
