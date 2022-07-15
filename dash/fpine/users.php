<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
$type = xg("type");
$status = xg("status");
$os = "nil";
if(($status == "active") || ($status == "inactive")){
	$os = "nil";
	$status = xg("status");
	}else{
	$os = xg("status");
	$status = "active";
		}

if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from userdb WHERE position='$type' AND other_status='$os' AND status='$status' AND email LIKE '%$call%' order by id desc";
}else{
$query="select id from userdb WHERE position='$type' AND other_status='$os' AND status='$status' order by id desc";
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
$type = xg("type");
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="SELECT id,other_status,wallet_currency,wallet_balance,user_photo,name,email,gender,position,mobile,country,state,verify,id_type,sub_status,account_name,account_number,bank_name,realtime,posted_job,bidded_job,approved_job,cancelled_job,completed_job,earned_job,earnings,total_spent_onjob,os,br,ip,last_login_r FROM userdb WHERE position='$type' AND other_status='$os' AND status='$status' AND email LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT id,other_status,wallet_currency,wallet_balance,user_photo,name,email,gender,position,mobile,country,state,verify,id_type,sub_status,account_name,account_number,bank_name,realtime,posted_job,bidded_job,approved_job,cancelled_job,completed_job,earned_job,earnings,total_spent_onjob,os,br,ip,last_login_r FROM userdb WHERE position='$type' AND other_status='$os' AND status='$status' ORDER BY id desc
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
<table class="table table-striped table-hover">
	<caption><?php echo $count;?> Record(s) Found in the database</caption>
<tr><th>No</th><th>Photo</th><th>Name</th><th>Wallet Balan.</th><th>Mobile</th><th>Email</th><th>Position</th><th>S/B Status</th><th>Action</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$userp = $key["user_photo"];
		$name = $key["name"];
		$mobile = $key["mobile"];
		$email = $key["email"];
		$pos = $key["position"];
		$os = $key["other_status"];
		$wc = $key["wallet_currency"];
		$wb = $key["wallet_balance"];
		if($pos == "professional"){
			$pos = "pro";
		}elseif($pos == "student"){
			$pos = "std";
		}elseif($pos == "super"){
			$pos = "super";
		}elseif($pos == "admin"){
			$pos = "admin";
		}else{
			$pos = "Nil";
		}
?>

<tr>
<td><?php echo $counter?></td>
<td><img src="<?php echo "../".$userp;?>" class="img-responsive img-circle" style="width:30px;"/></td>
<td><?php echo x_vert($name,"");?></td>
<td><?php echo $wc." ".number_format($wb,0);?></td>
<td><?php echo $mobile;?></td>
<td><?php echo xlow($email,"");?></td>
<td><font style="color:blue;font-weight:bold;"><?php echo $pos;?></font></td>
<td><font style="color:green;font-weight:bold;"><?php echo $os;?></font></td>
<td>
<button onclick="load('checkfull?tid=<?php echo $id;?>&key=<?php echo $token;?>')" class="btn btn-primary"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
</td>
</tr>


<?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-users'></span></p>";
$msg .= "<p class='text-center'>No Active users found!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
