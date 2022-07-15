<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"])){
	//$cat = xg("cat");
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(isset($_GET['call']) && !empty($_GET['call'])){
$call = xclean($_GET['call']);
$query="select id from buy_sell WHERE ptitle LIKE '%$call%' OR postedby LIKE '%$call%' order by id desc";
}else{
$query="select id from buy_sell order by id desc";
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
$query="SELECT * FROM buy_sell WHERE ptitle LIKE '%$call%' OR postedby LIKE '%$call%' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM buy_sell ORDER BY id desc
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
<tr><th>No.</th><th>Photo</th><th>By</th><th>Title</th><th>Status</th><th>Amount</th><th>Buyer</th><th>
 Downloads</th><th>	 Action</th><th> </th><th> </th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
$id = $key["id"];
		$tok = $key["token"];
		$status = $key["status"];
		$ptitle = xup($key["ptitle"],"");
		$amt = number_format($key["amount"],2);
		$cat = x_vert($key["category"],"");
		$bc = $key["buyer_count"];
		$postedby = $key["postedby"];
		$fp = $key["filepath"];
		$fs = $key["filesize"];
		$ext = $key["ext"];
		
		$abfp = $key["abfilepath"];
		$abfs = $key["abfilesize"];
		$abext = $key["abext"];
		
		$sfp = $key["sfilepath"];
		$sfs = $key["sfilesize"];
		$sext = $key["sext"];
		
		foreach(x_select("name,mobile,email,user_photo","userdb","email='$postedby'","1","id") as $key){
			$nameby = $key["name"];$mobileby = $key["mobile"];$emailby = $key["email"];
			;$photo = "../".$key["user_photo"];
		}
		
		?><tr>
<td><?php echo $counter;?></td>	
<td><img src="<?php echo $photo;?>" class="img-circle img-responsive imgl"/></td>		
<td>
<font style="color:blue;"><?php echo $nameby;?></font><br/>
<font style="color:green;"><?php echo $mobileby;?></font><br/>
<font style="color:blue;"><?php echo $emailby;?></font><br/>
</td>	
<td><?php echo $ptitle;?></td>	
<td><?php 
if($status == "pending"){
	echo "<font style='color:green;font-weight:bold;'><i class='fa fa-minus'></i> ".$status."</font>";
}elseif($status == "declined"){
	echo "<font style='color:red;font-weight:bold;'><i class='fa fa-minus'></i> ".$status."</font>";
}else{
	echo "<font style='color:blue;font-weight:bold;'><i class='fa fa-check'></i>".$status."</font>";
}?></td>	
<!---<td><?php echo $cat;?></td>-->
<td><?php echo "NGN ".$amt;?></td>
<td><?php echo $bc;?></td>	
<td>
	<button onclick="parent.location='<?php echo $abfp;?>'" class="btn btn-success "><i class="fa fa-cloud-download"></i> Abstract &nbsp;<?php echo $abfs;?> &nbsp;<span class="badge"><?php echo $abext;?></span></button><br/><br/>
	<button onclick="parent.location='<?php echo $fp;?>'" class="btn btn-primary "><i class="fa fa-cloud-download"></i> Complete <?php echo $fs;?> <span class="badge"><?php echo $ext;?></span></button><br/><br/>
		<?php
	if($sfp == ""){
		echo "";
		}else{
			?><button onclick="parent.location='<?php echo $sfp;?>'" class="btn btn-info"><i class="fa fa-cloud-download"></i> Sourcecod <?php echo $sfs;?> <span class="badge"><?php echo $sext;?></span></button><?php
			}
	?>
	
</td>	

<td>

	<script type="text/javascript">
		$(document).ready(function(e){
		$("#appromej<?php echo $id;?>").on('submit',(function(e) {
		$("#msgj<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/approve_ps",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msgj<?php echo $id;?>").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>
	
	<form style="float:none;margin-left:5pt;" id="appromej<?php echo $id;?>">
		<input type="hidden" value="<?php echo $id;?>" name='id'/>
		<input type="hidden" value="<?php echo $tok;?>" name='token'/>

	<button class="btn btn-primary"><i class="glyphicon glyphicon-check"></i></button>
	
	</form>
	
	<style>
	#msgj<?php echo $id;?>{
	margin:5pt;
	display:none;
	color:green;
	font-weight:bold;
	float:none;
	width:100%;
}
		</style>
<div id="msgj<?php echo $id;?>"><img src="../image/load.gif"/></div>

</td>	
<td>

	<script type="text/javascript">
		$(document).ready(function(e){
		$("#approme<?php echo $id;?>").on('submit',(function(e) {
		$("#msg<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/denypro",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msg<?php echo $id;?>").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>
	
	<form style="float:none;margin-left:5pt;" id="approme<?php echo $id;?>">
		<input type="hidden" value="<?php echo $id;?>" name='id'/>
		<input type="hidden" value="<?php echo $tok;?>" name='token'/>

	<button class="btn btn-info"><i class="fa fa-minus"></i></button>
	
	</form>
	
	<style>
	#msg<?php echo $id;?>{
	margin:5pt;
	display:none;
	color:green;
	font-weight:bold;
	float:none;
	width:100%;
}
		</style>
<div id="msg<?php echo $id;?>"><img src="../image/load.gif"/></div>

</td>

<td>
	<script type="text/javascript">
		$(document).ready(function(e){
		$("#appromed<?php echo $id;?>").on('submit',(function(e) {
		$("#msgd<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/delpro",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data){
			$("#msgd<?php echo $id;?>").html(data);

		    },
		  	error: function(){} 	        
	   });
	}));
	});
	</script>
	
	<form style="float:none;margin-left:5pt;" id="appromed<?php echo $id;?>">
		<input type="hidden" value="<?php echo $id;?>" name='id'/>
		<input type="hidden" value="<?php echo $tok;?>" name='token'/>

	<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
	
	</form>
	
	<style>
	#msgd<?php echo $id;?>{
	margin:5pt;
	display:none;
	color:green;
	font-weight:bold;
	float:none;
	width:100%;
}
		</style>
<div id="msgd<?php echo $id;?>"><img src="../image/load.gif"/></div>
</td>	
		</tr><?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-book'></span></p>";
$msg .= "<p class='text-center'>No project found!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
