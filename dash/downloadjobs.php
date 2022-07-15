<?php
include_once("../finishit.php");
session_start();
include_once("session_volume.php");
if(isset($_GET["sm"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from projects WHERE owner='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND payment_status='active' AND ptitle LIKE '%$call%' order by id desc";
}else{
$query="select id from projects WHERE owner='$user' AND status='active' AND bidded_status='active' AND processing_status='active' AND payment_status='active' order by id desc";
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
$query="SELECT id,ptitle,status,pdes,timereal,amount_to_pay,amount_currency,owner,pcategory,time_from,time_to,token,payment_status FROM projects WHERE owner='$user' AND  status='active' AND bidded_status='active' AND processing_status='active' AND payment_status='active' AND ptitle LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT id,ptitle,status,pdes,timereal,amount_to_pay,amount_currency,owner,pcategory,time_from,time_to,token,payment_status FROM projects WHERE owner='$user' AND  status='active' AND bidded_status='active' AND processing_status='active' AND payment_status='active' ORDER BY id desc
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
<script type="text/javascript">
function dtimes(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showitnow").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showitnow").style.display="block";
    document.getElementById("showitnow").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","dtimes?q="+str,true);
xmlhttp.send();
}

</script>
<div id="showitnow"></div>
<table class="table table-striped table-hover tabover">
<tr><th>No</th><th>Project Title</th><th>Project Abstract</th><th>Real Project</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$title = ucwords(strtolower($key["ptitle"]));
		$status = $key["status"];
		$des = $key["pdes"];
		$tr = $key["timereal"];
		$amt = $key["amount_to_pay"];
		$amt_c = $key["amount_currency"];
		$user = $key["owner"];
		$pcat = $key["pcategory"];
		$tfrom = $key["time_from"];
		$tto = $key["time_to"];
		$pay = $key["payment_status"];
		
		$token = $key["token"];


		
?>

<tr>
<td><?php echo $counter?></td>
<td><?php echo $title;?></td>

<?php

	?>
	
	
<td>
	<?php
	if(x_count("workdone","pid='$id' AND owner='$user' AND category='abstract' LIMIT 1") > 0){
foreach(x_select("id,download_times,status,owner,ext,filepath,filesize","workdone","pid='$id' AND owner='$user' AND category='abstract'","1","id") as $key){
	$id_a = $key["id"];
	$ext_a = $key["ext"];
	$fp_a = $key["filepath"];
	$fs_a = $key["filesize"];
	$dc = $key["download_times"];

	?><script>
	function download<?php echo $id_a;?>(){
		dtimes(<?php echo $id_a;?>);
		parent.location='<?php echo $fp_a;?>';
		}
	</script>
		<button onclick="download<?php echo $id_a;?>()" class="btn btn-primary">
		<span class="badge badge-primary"><?php echo $fs_a;?></span>
		<i class="fa fa-download"></i> Download &nbsp;&nbsp;<span class="badge badge-primary"><?php echo $dc;?></span></button>
	<?php
}
		}else{
		echo "No Upload";
		}
	
	?>
</td>
	
	<td>
	<?php
	if(x_count("workdone","pid='$id' AND owner='$user' AND category='real' LIMIT 1") > 0){
	foreach(x_select("id,download_times,status,owner,ext,filepath,filesize","workdone","pid='$id' AND owner='$user' AND category='real'","1","id") as $key){
	$id_r = $key["id"];
	$ext_r = $key["ext"];
	$fp_r = $key["filepath"];
	$fs_r = $key["filesize"];
	$dcc = $key["download_times"];
	$st = $key["status"];
	
	if($st == "approved"){
		?>
		<script>
	function downreal<?php echo $id_r;?>(){
		dtimes(<?php echo $id_r;?>);
		parent.location='<?php echo $fp_r;?>';
		}
	</script>
		<button onclick="downreal<?php echo $id_r;?>()" class="btn btn-success">
		<span class="badge badge-primary"><?php echo $fs_r;?></span>
		<i class="fa fa-download"></i> Download &nbsp;&nbsp;<span class="badge badge-primary"><?php echo $dcc;?></span></button><?php
		}else{
			
			?>
			
			<button onclick="alert('Click the done button on the completed job to release the client payment and also for you to be able to download completed project')" class="btn btn-danger">
				<span class="badge badge-primary"><?php echo $fs_r;?></span>
				<i class="fa fa-download"></i> Download &nbsp;&nbsp;<span class="badge badge-primary"><?php echo $dcc;?></span></button>
			<?php
			
			}
	?>
		
	<?php
}
		}else{
		echo "No Upload";
		}
	
	?>
</td>
<?php
	
?>

</tr>


<?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-cloud-download'></span></p>";
$msg .= "<p class='text-center'>No Jobs completed!</p>";
echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
