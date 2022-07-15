<?php
#include("../finishit.php");

	
include("profbase/coninc.php");
$ido = xg("tid");

if(x_count("projects","id='$ido' AND status='active' LIMIT 1") > 0){
	
	foreach(x_select("ptitle","projects","id='$ido' AND status='active'","1","ptitle") as $key){
	$ptitle = $key["ptitle"];
	}
	$pill = x_count("bidded","pid='$ido'");
	?>
	<button onclick="load('approvenow')" style="padding:10px;margin-bottom:10pt;" class="btn btn-success"><i class="fa fa-arrow-left"></i></button> <button onclick="alert('You have just <?php echo $pill;?> <?php if($pill > 1){echo 'Biddings';}else{echo 'Bidding';}?>')" class="btn btn-primary" style="padding:10px;margin-bottom:10pt;"><?php echo $ptitle;?> &nbsp;&nbsp;&nbsp;<span class="badge "><?php echo x_count("bidded","pid='$ido'");?></span></button>
	<?php
	}else{
		
		}

	
	

$results = mysqli_query($connecDB,"SELECT COUNT(*) FROM bidded WHERE pid='$ido'");
$get_total_rows = mysqli_fetch_array($results); //total records

//break total records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);	
$reder = x_count("bidded","pid='$ido'");
?>

<script type="text/javascript">
$(document).ready(function() {

	var track_click = 0; //track user click on "load more" button, righ now it is 0 click
	
	var total_pages = <?php echo $total_pages; ?>;
	$('#results').load("pager?id=<?php echo $ido;?>&token=<?php echo sha1($ido);?>", {'page':track_click}, function() {track_click++;}); //initial data to load

	$(".load_more").click(function (e) { //user clicks on button
	
		$(this).hide(); //hide load more button on click
		$('.animation_image').show(); //show loading image

		if(track_click <= total_pages) //make sure user clicks are still less than total pages
		{
			//post page number and load returned data into result element
			$.post('pager?id=<?php echo $ido;?>&token=<?php echo sha1($ido);?>',{'page': track_click}, function(data) {
			
				$(".load_more").show(); //bring back load more button
				
				$("#results").append(data); //append data received from server
				
				//scroll page to button element
				$(".chatmee").animate({scrollTop: $("#load_more_button").offset().top}, 500);
				
				//hide loading image
				$('.animation_image').hide(); //hide loading image once data is received
	
				track_click++; //user click increment on load button
			
			}).fail(function(xhr, ajaxOptions, thrownError) { 
				alert(thrownError); //alert any HTTP error
				$(".load_more").show(); //bring back load more button
				$('.animation_image').hide(); //hide loading image once data is received
			});
			
			
			if(track_click >= total_pages-1)
			{
				//reached end of the page yet? disable load button
				$(".load_more").attr("disabled", "disabled");
			}
		 }
		  
		});
});


</script>

<div id="results"><img src="../image/load.gif"/></div>

	<?php
	if($total_pages == "0"){
		?>
		
		<?php
		}elseif($reder < $item_per_page){
			
			}else{
			?>
			
			<div align="center">
<button class="btn btn-primary load_more" style="width:40%;" id="load_more_button">load More</button>
<div class="animation_image" style="display:none;width:100%;"><img src="../image/ajax-loader.gif"> Loading...</div>
</div>
			<?php
			}
	
	?>



<style>
#results{

margin-left: auto;
margin-right: auto;
}
#results .loading-indication{
	background:#FFFFFF;
	padding:10px;
	position: absolute;
}
.paginate {
	padding: 0px;
	margin: 0px;
	height: 30px;
	display: block;
	text-align: center;
}
.paginate li {
	display: inline-block;
	list-style: none;
	padding: 0px;
	margin-right: 1px;
	width: 30px;
	text-align: center;
	background: #4CC2AF;
	line-height: 25px;
}
.paginate .active {
	display: inline-block;
	list-style: none;
	padding: 0px;
	margin-right: 1px;
	width: 30px;
	text-align: center;
	line-height: 25px;
	background-color: #666666;
}
.paginate li a{
	color:#FFFFFF;
	text-decoration:none;
}
.page_result{
	padding: 0px;
}
.page_result li{
	background: #E4E4E4;
	margin-bottom: 5px;
	padding: 10px;
	font-size: 12px;
	list-style: none;
}
.page_result .page_name {
font-size: 14px;
font-weight: bold;
margin-right: 5px;
}


</style>
