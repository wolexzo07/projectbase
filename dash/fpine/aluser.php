<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
	//$cat = xg("cat");
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from userdb WHERE email LIKE '%$call%' OR name LIKE '%$call%' order by id desc";
}else{
$query="select id from userdb order by id desc";
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
$query="SELECT * FROM userdb WHERE email LIKE '%$call%' OR name LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM userdb ORDER BY id desc
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
	<th>No</th><th>Photo</th><th>Name</th><th>Position</th><th>Contact</th>
	<th>State</th><th>Country</th><th>Status</th><th>Action</th>
	</tr>
<?php
    while($keyy=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $keyy["id"];
		$tok = $keyy["token"];
		$ph = $keyy["user_photo"];
		$name = $keyy["name"];
		$pos = $keyy["position"];
		$mobile = $keyy["mobile"];
		$email = $keyy["email"];
		$country = $keyy["country"];
		$state = $keyy["state"];
		$sta = $keyy["status"];
		?>
		<tr>
		<td><?php echo $counter;?></td>
		<td><img src="<?php
if($ph == ""){
	?>../image/avatar.png<?php
	
	}else{
		echo "../".$ph;
		
		}
?>
		
		" class="img-responsive" style="width:50px;border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;"/></td><td><?php echo $name;?></td>
		<td><?php echo $pos;?></td>
		<td><?php echo "<font style='color:blue;'>".$mobile."</font><br/><font style='color:green;'>".$email."</font>";?></td>
		<td><?php 
		if($state == "Abuja Federal Capital Territory"){
			echo x_short($state);
			}else{
				echo $state;
				}
		?></td><td><?php echo $country;?></td>
		<td><?php 
		if($sta == "active"){
			echo "<font style='color:blue;font-weight:bold;'>".$sta."</font>";
		}else{
		echo "<font style='color:green;font-weight:bold;'>".$sta."</font>";
		}
		?></td>
		<td>
		<button class="btn btn-primary" onclick="load('fpine/userdetails?userid=<?php echo $id;?>&key=<?php echo $tok;?>')"><i class="fa fa-briefcase"></i> Check</button>
		<button class="btn btn-danger" onclick="load('fpine/deleteuser?userid=<?php echo $id;?>&key=<?php echo $tok;?>')"><i class="fa fa-trash"></i> Delete</button>
		</td>
		</tr>
		<?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-users'></span></p>";
$msg .= "<p class='text-center'>No user found!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
