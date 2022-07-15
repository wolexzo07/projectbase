<div class="putu">
<?php
include_once("../../finishit.php");
include_once("../classes/develop_php_library.php");
xstart("0");
if(isset($_GET["sm"])){
$id = xg("id");
$token = xg("token");

$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from chatbox WHERE pid='$id' AND ptoken='$token' AND pid LIKE '%$call%' order by id desc";
}else{
$query="select id from chatbox WHERE pid='$id' AND ptoken='$token' order by id desc";
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
$id = xg("id");
$token = xg("token");
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="SELECT timereal,id,pid,ptoken,email,comment,time_stamp,status,token,seen FROM chatbox WHERE pid='$id' AND ptoken='$token' AND pid LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT timereal,id,pid,ptoken,email,comment,time_stamp,status,token,seen FROM chatbox WHERE pid='$id' AND ptoken='$token' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}

//echo $query;
?><p><?php echo x_count("chatbox","pid='$id' AND ptoken='$token'");?> Chatlog Found</p><?php
  
$res    =   mysqli_query(x_cstring(),$query);
$count  =   mysqli_num_rows($res);
$HTML='';
echo $pagination;
if($count > 0)
{
	$counter = 0;
?>

<?php
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
$photo = xclean($_SESSION["PBNG_PHOTO_2018_VISION"]);
  while($key=mysqli_fetch_array($res))
    {
	$counter++;
	$id = $key["id"];
	$email = $key["email"];
	$pid = $key["pid"];
	$ptoken = $key["ptoken"];
	$comment = $key["comment"];
	$ts = $key["time_stamp"];
	$tr = $key["timereal"];
	$token = $key["token"];
	$status = $key["status"];
	$seen = $key["seen"];
	
	$timeAgoObject = new convertToAgo;
	
	$convertedTime = ($timeAgoObject -> convert_datetime($ts)); // Convert Date Time
	$when = ($timeAgoObject -> makeAgo($convertedTime)); // Then convert to ago time

	foreach(x_select("user_photo","userdb","email='$email' AND status='active'","1","name") as $key){
	$ph = $key["user_photo"];
	}
	

if($email == $user){
	?>
		<div class="calloutt left">
			<img src="../<?php echo $ph;?>" class="img-responsive" style="width:40px;height:40px;border-radius:50%;float:left;margin-right:10px;"/>
		<?php echo htmlspecialchars($comment);?>
		
		<br/><br/><span class="badge" style="background-color:white;color:black;float:right;"><?php echo htmlspecialchars($when." ago");?>&nbsp;&nbsp;<?php if($seen == "1"){
			?><i class="fa fa-check"></i><i class="fa fa-check"></i><?php
			}elseif($seen == "0"){
				?><i class="fa fa-check"></i><?php
				}else{
				
				}?></span></div>

	<?php
	}else{
		?>
		<div class="callout right">
			<img  src="../<?php echo $ph;?>" class="img-responsive" style="width:40px;height:40px;border-radius:50%;float:left;margin-right:10px;"/>&nbsp;&nbsp;
			<?php echo htmlspecialchars($comment);?>
	<br/><br/><span class="badge" style="background-color:white;color:black;float:right;"><?php echo htmlspecialchars($when." ago");?>&nbsp;&nbsp;<?php if($seen == "1"){
			?><i class="fa fa-check"></i><i class="fa fa-check"></i><?php
			}elseif($seen == "0"){
				?><i class="fa fa-check"></i><?php
				}else{
				
				}?></span></div>
	
		<?php
		}
	

				
	}
	?></table><?php

}
else
{
    
	$msg = "<p class='text-center' style='font-size:80pt;margin-bottom:10pt;'><span class='fa fa-comment'></span></p>";
$msg .= "<p class='text-center'>No chatlog found!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
</div>
<style type="text/css">
.putu{
	height:800px;
	overflow-y:auto;
	}
</style>
