<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
	//$cat = xg("cat");
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from transaction WHERE owner LIKE '%$call%' order by id desc";
}else{
$query="select id from transaction order by id desc";
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
$query="SELECT * FROM transaction WHERE owner LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM transaction ORDER BY id desc
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
<tr>
<th>No.</th><th>Photo</th><th>Name</th><th>PayID</th><th>Project</th><th>Fee</th><th>Amount</th><th>Status</th><th>	Action</th>
</tr>
<?php
    while($base=mysqli_fetch_array($res))
    {
	$counter++;
		$user = $base["owner"];
		$pid = $base["pid"];
		$amt = $base["amount"];
		$fee = $base["portal_fee"];
		$cur = $base["currency"];
		$stat = $base["status"];
		$payid = $base["paystack_id"];
		$pv = $base["paystack_verify"];
		$pc = $base["paystack_charge"];
		
		foreach(x_select("user_photo,name,mobile,email","userdb","email='$user' AND status='active'","1","id desc") as $keu){
		$pht = $keu["user_photo"];
		$nam = $keu["name"];
		$mobi = $keu["mobile"];
		$emai = $keu["email"];
		}
		
		foreach(x_select("ptitle","projects","id='$pid' AND status='active'","1","id desc") as $keui){
		$ptitle = $keui["ptitle"];
	
		}
		
		?>
		<tr align='left'>
		<td><?php echo $counter;?></td>
		<td><img src="<?php echo "../".$pht;?>" class="img-responsive" style="width:30px;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;"/></td>
		<td>
		<font style="color:green;"><?php echo $nam;?></font><br/>
		<font style="color:blue;"><?php echo $emai;?></font><br/>
		<font style="color:green;"><?php echo $mobi;?></font>
		</td>
		<td><font style="font-weight:bold;color:green;"><?php echo $payid;?></font></td>
		<td><?php echo ucfirst(strtolower($ptitle));?></td>
		<td><?php echo $cur." ".number_format($amt,2);?></td>
		<td><?php echo $cur." ".number_format($fee,2);?></td>
		<td><?php 
		if($stat == "approved"){
			echo "<font style='color:blue;'>".$stat."</font>";
		}else{
			echo "<font style='color:green;'>".$stat."</font>";
		}
		
		
		?></td>
		<td>
		<?php
		if(($pv == "no") && ($payid != "")){
			?>
			<button class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Verify</button>
			<?php
		}elseif(($pv == "yes") && ($payid != "")){
			echo "<font style='color:green;font-weight:bold;'>Verified</font>";
		}else{
			
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
$msg .= "<p class='text-center'>No Payment Transaction!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
