<?php
#session_start();
include_once("../../finishit.php");
include_once("../classes/develop_php_library.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])){
if(isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["token"]) && !empty($_GET["token"])){	
include("coninc.php"); //include config file
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
	echo "Invalid page number!";
	exit();
}

$pid = xclean($_GET["id"]);
$ptoken = xclean($_GET["token"]);

//get current starting point of records
$position = ($page_number * $item_per_page);

//Limit our results within a specified range. 
$results = mysqli_query($connecDB,"SELECT seen,timereal,id,pid,ptoken,email,comment,time_stamp,status,token FROM chatbox WHERE pid='$pid' AND ptoken='$ptoken' ORDER BY id desc LIMIT $position, $item_per_page");

if(x_count("chatbox","pid='$pid' AND ptoken='$ptoken' LIMIT 1") > 0){
	$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
$photo = xclean($_SESSION["PBNG_PHOTO_2018_VISION"]);

while($key = mysqli_fetch_array($results)){
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
			<img src="../<?php echo $ph;?>" class="img-responsive pull-left imgbal" style=""/>
		<?php echo htmlspecialchars($comment);?><br/><br/>
		<span class="badge extrr"><?php echo htmlspecialchars($when." ago");?>&nbsp;&nbsp;<?php if($seen == "1"){
			?><i class="fa fa-check"></i><i class="fa fa-check"></i><?php
			}elseif($seen == "0"){
				?><i class="fa fa-check"></i><?php
				}else{
				
				}?> </span>
				</div>

	<?php
	}else{
		
		if(x_count("chatbox","id='$id' AND seen='0' LIMIT 1") > 0){
			x_update("chatbox","id='$id'","seen='1'","0","0");
			}else{
				
				}
		
		?>
		<div class="callout right">
		<img  src="../<?php echo $ph;?>" class="img-responsive imgbal"/>&nbsp;&nbsp;
		<?php echo htmlspecialchars($comment);?><br/><br/>
	<span class="badge extrr"><?php echo htmlspecialchars($when." ago");?>&nbsp;&nbsp; <?php if($seen == "1"){
			?><i class="fa fa-check"></i><i class="fa fa-check"></i><?php
			}elseif($seen == "0"){
				?><i class="fa fa-check"></i><?php
				}else{
				
				}?>
	</span></div>
	
		<?php
		}
}
	}else{
		
		$msg = "<p class='text-center' style='font-size:60pt;margin-bottom:10pt;margin-top:20pt;'><span class='fa fa-comment'></span></p>";
		$msg .= "<p class='text-center'>No chat record found!</p>";
			echo $msg;
		
		}



}else{
	echo "Parameter Missing!";
	
	}
		}
?>
