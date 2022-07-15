<?php
session_start();
include("../xe-library/xe-library74.php");
include("../xe-library/nftfunctions.php");
include("../siteinfo.php");
if(x_count("portalmode","status='online' AND id='1' LIMIT 1") > 0){
	
	finish("../","No Site maintenance in progress!");
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $sitename;?> - Site maintenance in progress</title>
	<meta charset="utf-8">
	<meta name="author" content="xelowgc">
	<meta name="description" content="Site maintenance in progress"/>

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="shortcut icon" type="image/x-icon" href="../image/logome.png">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/TimeCircles.js"></script>
    <script type="text/javascript" src="js/backstretch.js"></script>
    <script type="text/javascript" src="js/ajaxchimp.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5aa27dacd7591465c7086b3f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
	<section class="content wrapper">

<?php
if(x_count("portalmode","status='offline' AND id='1' LIMIT 1") > 0){
	foreach(x_select("timecount,headertext,descriptext","portalmode","status='offline' AND id='1'","1","id") as $key){
		$tc = $key["timecount"];
		$ht = $key["headertext"];
		$dt = $key["descriptext"];
		?>
				<h3><?php echo $ht;?></h3>
		<p class="description"><?php echo $dt;?></p>

		<div class="subscription_form clearfix">
			<div>
				<form action="" method="post" id="sub_form">
					<input type="email" id="mc-email" placeholder="enter your email">
					<button disabled="disabled" type="submit" id="mc_submit"><i class="icon"></i></button>
				</form>
			</div>
		</div>
		<div class="counter clear" data-date="<?php echo $tc;?>"></div>
		<?php
	}

}else{
	finish("../","Access denied!");
	exit();
}
?>
		

	</section>
	
</body>
</html>
