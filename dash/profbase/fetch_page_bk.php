<?php
include_once("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"])){

$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw error if page number is not valid
if(!is_numeric($page_number)){
	echo "Invalid page number";
	exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);

$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);
if(x_count("chatbox","pid='4'")){
	
	foreach(x_select("id,pid,ptoken,email,comment,time_stamp,status,token","chatbox","pid='4'","$position,$item_per_page","comment") as $key){
	$id = $key["id"];
	$email = $key["email"];
	$pid = $key["pid"];
	$ptoken = $key["ptoken"];
	$comment = $key["comment"];
	$ts = $key["time_stamp"];
	$token = $key["token"];
	$status = $key["status"];

if($email == $user){
	?>
	<div class="callout right"><?php htmlspecialchars($comment);?></div>

	<?php
	}else{
		?>
		<div class="callout left"><?php htmlspecialchars($comment);?></div>
		<?php
		}
		
		}
	
	}else{
		echo "No chat record found";
		}

}
?>
