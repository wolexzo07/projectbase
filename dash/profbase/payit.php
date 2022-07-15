<?php
include_once("../../finishit.php");
xstart("0");
if(isset($_GET["sm"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);

$query="select id from clientpayment WHERE userto='$user' order by id desc";

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

$query="SELECT id,pid,userfrom,bank_name,account_number,currency,amount,datetim,payment_approval FROM clientpayment WHERE userto='$user' ORDER BY id desc
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
<table class="table table-striped table-hover">
<tr><th>No</th><th>Project</th><th>Client</th><th>Amount</th><th>Approval</th><th>Paid To</th></tr>
<?php

    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$pid = $key["pid"];
		$userfrom = $key["userfrom"];
		$acctnumb = $key["account_number"];
		$dtime = $key["datetim"];
		$pa = $key["payment_approval"];
		$bnk = $key["bank_name"];
		$amt = $key["amount"];
		$amt_c = $key["currency"];
		
		if($pa == "No"){
			$py = "<font style='color:green;font-weight:bold;'>Unpaid</font>";
			}else{
			$py = "<font style='color:navy;font-weight:bold;'>Paid</font>";	
				}
		
	foreach(x_select("user_photo,name","userdb","email='$userfrom' AND status='active'","1","name") as $key){
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
<td><?php echo ucwords(strtolower($rname))."<br/><font style='color:green'>(".strtolower($userfrom).")</font>";?></td>
<td><?php echo $amt_c." ".number_format($amt,0);?></td>
<td><?php echo $py;?></td>
<td><?php if($acctnumb == ""){
	echo "Update Bank";
	}else{
		echo $acctnumb."<br/><font style='color:blue'>($bnk)</font>";
		}?></td>

</tr>


<?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-credit-card'></span></p>";
$msg .= "<p class='text-center'>No Payment Transactions!</p>";
echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
