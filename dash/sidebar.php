<?php require_once("validate.php");?>
<nav id="sidebar">
                <div class="sidebar-header">

	<center><img id="imgbase" class="img-responsive imcl" src="<?php
	if($_SESSION["PBNG_PHOTO_2018_VISION"] == ""){
		echo "../image/users.png";
	}else{
	echo "../".$_SESSION["PBNG_PHOTO_2018_VISION"];	
	}
	
	
	?>"/></center>
					<p class="tol" style="display:none;text-align:none;">
						<span class="fa fa-user"></span> 
						<span><?php echo substr($_SESSION["PBNG_NAME_2018_VISION"],0,7);?></span>
						<!---
						</p>
						<p style="display:block;" class="tol">---->&nbsp;
						<span class="glyphicon glyphicon-check"></span>  
						<?php 
						if($_SESSION["PBNG_POSITION_2018_VISION"] == "professional"){
							echo substr($_SESSION["PBNG_POSITION_2018_VISION"],0,3);
							}else{
						echo $_SESSION["PBNG_POSITION_2018_VISION"];
					}
						
						?></p>
					
                    <h3>
	<button onclick="alert('<?php echo 'I am '.$_SESSION['PBNG_NAME_2018_VISION'];?>')" class="btn btn-primary" style="text-align:left;color:white;background-color:;margin-top:0pt;border:1px solid white;width:100%;font-size:;font-weight:none;"><span class="glyphicon glyphicon-user"></span>
						<?php echo substr($_SESSION["PBNG_NAME_2018_VISION"],0,20);?></button>
						
<button onclick="alert('<?php echo 'I am '.$_SESSION["PBNG_POSITION_2018_VISION"].' user';?>')" class="btn btn-success" style="text-align:left;margin-top:5pt;border:1px solid white;width:100%;color:white;font-size:;font-weight:none;"><span class="glyphicon glyphicon-check"></span> <?php echo $_SESSION["PBNG_POSITION_2018_VISION"];?></button>
                    </h3>
                    <strong><?php echo x_short($_SESSION["PBNG_NAME_2018_VISION"]);?></strong>
                </div>

                <?php
if($_SESSION["PBNG_POSITION_2018_VISION"] == "professional"){
	
	if(x_count("enable_sub","status='1' LIMIT 1") > 0){
			?>
	<script src="js/renter.js"></script>
<script type="text/javascript">
setInterval("renter('xelowgc')",60000);
</script>
<div id="rent"></div>
	<?php
	}else{
	//echo "Subscription disabled!";		
	}

require_once("profbase/profesbase.php");
}elseif($_SESSION["PBNG_POSITION_2018_VISION"] == "student"){
	if(x_count("enable_sub","status='1' LIMIT 1") > 0){
			?>
	<script src="js/renter.js"></script>
<script type="text/javascript">
setInterval("renter('xelowgc')",60000);
</script>
<div id="rent"></div>
	<?php
	}else{
	//echo "Subscription disabled!";		
	}
require_once("studentbase.php");
}elseif($_SESSION["PBNG_POSITION_2018_VISION"] == "marketer"){
	
	require_once("marketer_affbase/affmenu.php");
		
	}elseif($_SESSION["PBNG_POSITION_2018_VISION"] == "super"){
require_once("fpine/adminbase.php");
}else{

}
?>

              <!--  <ul class="list-unstyled CTAs">
                    <li><a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">
						<i class="glyphicon glyphicon-cloud-download"></i>
						Download Tutorial</a></li>
                    <li><a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">
						<i class="glyphicon glyphicon-download"></i> Download Policy</a></li>
                </ul>--->
            </nav>
