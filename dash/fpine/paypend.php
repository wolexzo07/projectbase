<?php
include_once("../../finishit.php");
session_start();
if(isset($_GET["sm"]) && isset($_GET["cat"]) && isset($_GET["cur"])){
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
$cur = xg("cur");
$cat = xg("cat");

if($cat == "appr"){
$query="select id from clientpayment WHERE payment_approval='Yes' AND payment_type='$cur' order by id desc";
}elseif($cat == "pend"){
$query="select id from clientpayment WHERE payment_approval='No' AND payment_type='$cur' order by id desc";
}else{
$query="select id from clientpayment WHERE payment_type='$cur' order by id desc";	
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
$cur = xg("cur");
$cat = xg("cat");
if($cat == "appr"){
$query="SELECT * FROM clientpayment WHERE payment_approval='Yes' AND payment_type='$cur' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}elseif($cat == "pend"){
$query="SELECT * FROM clientpayment WHERE payment_approval='No' AND payment_type='$cur' ORDER BY id desc
limit ".mysqli_real_escape_string(x_cstring(),$start).",$recordsPerPage";
}else{
$query="SELECT * FROM clientpayment WHERE payment_type='$cur' ORDER BY id desc
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
<tr><th>No</th><th>Project Title</th><th>Amount</th><th>Pay By</th><th>Paid To</th><th>Bank Details</th><th>Ap.status</th><th>Action</th></tr>
<?php
    while($key=mysqli_fetch_array($res))
    {
	$counter++;
		$id = $key["id"];
		$pid = $key["pid"];
		$pa = $key["payment_approval"];
		$uf = $key["userfrom"];
		$ut = $key["userto"];
		$amt = $key["amount"];
		$cur = $key["currency"];
		$dt = $key["datetim"];
		$bn = $key["bank_name"];
		$aname = $key["account_name"];
		$anumb = $key["account_number"];
		$token = $key["token"];
		
		#Getting Paid by name
		if(x_count("userdb","email='$uf' LIMIT 1") > 0){
		foreach(x_select("name,wallet_balance,wallet_currency","userdb","email='$uf'","1","name") as $key){
			$nam_ow = $key["name"];
			$wb_ow = number_format($key["wallet_balance"],0);
			$wc_ow = $key["wallet_currency"];
		}
		}else{
			$nam_ow = "nil";
		}
		#Getting Paid To name
		if(x_count("userdb","email='$ut' LIMIT 1") > 0){
		foreach(x_select("wallet_balance,wallet_currency,name,account_name,account_number,bank_name","userdb","email='$ut'","1","name") as $key){
			$nam_me = $key["name"];
			$wb_me = number_format($key["wallet_balance"],0);
			$wc_me = $key["wallet_currency"];
			$acn_me = $key["account_name"];
			$ac_me = $key["account_number"];
			$bn_me = $key["bank_name"];
		}
		}else{
			$nam_me = "nil";
		}
		#Getting Project title
		if(x_count("projects","id='$pid' LIMIT 1") > 0){
		foreach(x_select("ptitle","projects","id='$pid'","1","ptitle") as $key){
			$pt = $key["ptitle"];
		}
		}else{
			$pt = "nil";
		}

		
?>

<tr>
<td><?php echo $counter?></td>
<td><?php echo ucwords(strtolower($pt));?></td>
<td><?php echo $cur." ".number_format($amt,0)?></td>
<td><?php echo x_vert($uf,"")."<br/><font style='color:blue;'>(".x_vert($nam_ow,"").")<br/><font style='color:green;font-weight:bold'>($wc_ow $wb_ow)</font></font>";?></td>
<td><?php echo x_vert($ut,"")."<br/><font style='color:blue;'>(".x_vert($nam_me,"").")<br/><font style='color:green;font-weight:bold'>($wc_me $wb_me)</font></font>";?></td>
<td><?php
if(($aname == "") && ($bn == "") && ($anumb == "")){
	if(($ac_me == "") && ($bn_me == "") && ($acn_me == "")){
		echo "<font style='color:green;'>Not Avail.</font>";
	}else{
		echo x_vert($bn_me,"")."<br/><font style='color:blue;font-weight:bold;'>$ac_me</font><br/><font style='color:green;font-weight:bold;'>".x_vert($acn_me,"")."</font>";
	}

}else{
echo x_vert($bn,"")."<br/><font style='color:blue;font-weight:bold;'>$anumb</font><br/><font style='color:green;font-weight:bold;'>".x_vert($aname,"")."</font>";	
}
?></td>
<td><?php
if($pa == "Yes"){
	?><font style="color:blue;font-weight:bold;"><?php echo "Paid";?></font><?php
}else{
	?><font style="color:green;font-weight:bold;"><?php echo "Unpaid";?></font><?php
}
?></td>

<td>
	<script type="text/javascript">
		$(document).ready(function(e){
		$("#approme<?php echo $id;?>").on('submit',(function(e) {
		$("#msg<?php echo $id;?>").show("slow");
		e.preventDefault();
		$.ajax({
        	url: "fpine/appmoney",
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
		<input type="hidden" value="<?php echo $token;?>" name='token'/>

	<button class="btn btn-warning"><i class="glyphicon glyphicon-credit-card"></i></button>
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
</tr>


<?php
				
	}
	?></table><?php

}
else
{
    
$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;'><span class='fa fa-credit-card'></span></p>";
$msg .= "<p class='text-center'>No Pending Payment!</p>";
			echo $msg;
	
}

echo "<div style='margin-bottom:1%;'></div>";
echo $pagination;
}
?>
