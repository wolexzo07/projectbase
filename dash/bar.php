            <?php require_once("validate.php");?>
		
		<div id="content">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
						 <button onclick="parent.location='../'" type="button" class="btn btn-success navbar-btn">
                                <i class="glyphicon glyphicon-home"></i>
                                <!---<span>Toggle</span>--->
                                <span></span>
                            </button>
							
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <!---<span>Toggle</span>--->
                                <span></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' LIMIT 1") > 0){
	foreach(x_select("wallet_currency,wallet_balance","userdb","email='$user' AND status='active'","1","name") as $key){
	$wb = $key["wallet_balance"];
	$wc = $key["wallet_currency"];
	}
	}else{
		exit();
		}
?>	
                            <ul class="nav navbar-nav navbar-right">
								 <li class="mb ju"><a href="#"><i class="fa fa-credit-card"></i> <?php if($wc != ""){
									 echo $wc;
									 }else{
										 echo "NGN ";
										 }?> <?php echo number_format($wb,2);?></a></li>
								
                                <li><a href="#" onclick="load('notifyme')">
                                <span class="glyphicon glyphicon-bell"></span>
                                <span class="badge badge-primary">
	<?php 
	$cut = x_count("notifyme","type='all' AND status='0' OR type='p' AND email='$user' AND status='0' LIMIT 1");
	echo $cut;
	?>
							</span>
                                </a></li>
                                <li><a href="../logout"><span class="glyphicon glyphicon-log-out"></span></a></li>
                                <li><a href="#"><img src="../image/logome.png" class="eri"/></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

			<div id="calculate">
			
			<div class="row firbar">
			
<?php include("ads.php");?>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' AND user_photo=''") > 0){

	?>
		<h4><button onclick="load('updateinfo')" class="btn btn-danger hider">
						<span class="glyphicon glyphicon-cog"></span>
						Update Now</button> Incomplete Profile </h4>
	<div class="progress">
  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
  aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
    50% Complete (info)
  </div>
</div>
	<?php

}
	?>
	
	
				<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' AND test_photo=''") > 0){
if(($_SESSION["PBNG_POSITION_2018_VISION"] == "super") || ($_SESSION["PBNG_POSITION_2018_VISION"] == "admin")){

}else{
	?>
		<h4><button onclick="load('completeinfo')" class="btn btn-primary hider">
						<span class="glyphicon glyphicon-check"></span>
						Verify Now</button> Profile Verification</h4>
	<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
  aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
    80% Complete (info)
  </div>
</div>
	<?php
}
}
	?>
					

<?php
$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
if(x_count("userdb","email='$user' AND status='active' AND account_name='' AND account_number='' AND bank_name=''") > 0){
if(($_SESSION["PBNG_POSITION_2018_VISION"] == "super") || ($_SESSION["PBNG_POSITION_2018_VISION"] == "admin")){

}else{
	?>
					<h4><button onclick="load('bankd')" class="btn btn-success hider">
						<span class="fa fa-bank"></span>
						Add Bank details</button> No Bank Details </h4>
	<div class="progress">
  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
  aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
    80% Complete (info)
  </div>
</div>
	<?php
}
}
?>
		

				</div>
				<?php
			// start checking for hostname
			if(x_count("contactinfo","status='1' AND type='host' LIMIT 1") > 0){
			foreach(x_select("title","contactinfo","status='1' AND type='host'","1","id desc") as $key){
				$host = $key["title"];
			}
			}
			// end checking for hostname				
			?>


<?php
if($_SESSION["PBNG_POSITION_2018_VISION"] == "professional"){
require_once("profbase/professpartone.php");
}elseif($_SESSION["PBNG_POSITION_2018_VISION"] == "student"){
require_once("studentpartone.php");
}elseif($_SESSION["PBNG_POSITION_2018_VISION"] == "marketer"){
require_once("marketer_affbase/marketerpartone.php");
}elseif($_SESSION["PBNG_POSITION_2018_VISION"] == "super"){
require_once("fpine/adminpartone.php");
}else{

}
?>

	<?php include("ads.php");?>
				

			</div>
			
			<table class="table table-striped table-hover table-bordered abil">
			<caption class="">PROFILE DETAILS</caption>
			<tr>
			<th><i class="fa fa-user"></i> &nbsp;&nbsp;&nbsp;Name</th><td><?php echo $_SESSION["PBNG_NAME_2018_VISION"];?></td>
			</tr>
			<tr>
			<th><i class="fa fa-inbox"></i> &nbsp;&nbsp;&nbsp;Email</th><td><?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?></td>
			</tr>
			<tr>
			<th><i class="fa fa-phone"></i> &nbsp;&nbsp;&nbsp;Mobile</th><td><?php echo $_SESSION["PBNG_MOBILE_2018_VISION"];?></td>
			</tr>
			<tr>
			<th><i class="fa fa-star"></i> &nbsp;&nbsp;&nbsp;Position</th><td><?php echo $_SESSION["PBNG_POSITION_2018_VISION"];?></td>
			</tr>
			<tr>
			<th><i class="fa fa-briefcase"></i> &nbsp;&nbsp;&nbsp;Skills</th><td><?php echo $_SESSION["PBNG_SKILL_2018_VISION"];?></td>
			</tr>
			<tr>
			<th><i class="fa fa-flag"></i> &nbsp;&nbsp;&nbsp;Country</th><td><?php echo $_SESSION["PBNG_COUNTRY_2018_VISION"];?></td>
			</tr>
			<tr>
			<th><i class="fa fa-home"></i> &nbsp;&nbsp;&nbsp;State</th><td><?php echo $_SESSION["PBNG_STATE_2018_VISION"];?></td>
			</tr>
			
			<tr>
			<th><i class="fa fa-calendar"></i> &nbsp;&nbsp;&nbsp;Joined on</th><td><?php echo $_SESSION["PBNG_RT_2018_VISION"];?></td>
			</tr>
			<tr>
			<th><i class="fa fa-calendar"></i> &nbsp;&nbsp;&nbsp;Last Login</th><td><?php echo $_SESSION["PBNG_LL_2018_VISION"];?></td>
			</tr>
			
			
			</table>
			
			</div>
			

                
                <div style="display:none" class="line"></div>


            </div>
