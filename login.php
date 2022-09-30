<?php
session_start();
include("xe-library/xe-library74.php");
include("xe-library/nftfunctions.php");
include("siteinfo.php");
include("refcoder.php");

if(x_count("portalmode","status='offline' AND id='1' LIMIT 1") > 0){

	finish("notify/maintenance","Site maintenance in progress");
	exit();
}

//generating session to prevent cross request forgery attack

if(!isset($_SESSION["AUTH_PAGE_PROJECTBASE"])){
	
$_SESSION["AUTH_PAGE_PROJECTBASE"] = sha1(md5(rand(23,10989))).sha1(md5(rand(10,5098))).sha1(md5(rand(12,60987)));
	
}

$host = sha1($_SERVER['REMOTE_ADDR']);
$uag = sha1($_SERVER['HTTP_USER_AGENT']);
$toks = sha1($_SESSION["AUTH_PAGE_PROJECTBASE"].sha1(Date("Y-m-d")));
$extra = "?auth_toks=$toks&user_agent=$uag&identify_client=$host";

if(!x_validateget("auth_toks") || !x_validateget("user_agent") || !x_validateget("identify_client")){
	if(x_validateget("action")){
		$action = x_get("action");
		$extra = "?action=$action&auth_toks=$toks&user_agent=$uag&identify_client=$host";
		finish("login$extra","0");
	}else{
		finish("login$extra","0");
	}
	
}
//generating session to prevent cross request forgery attack
$pageToken = sha1(uniqid()).md5(rand());
$_SESSION["XCAPE_HACKS"] = $pageToken;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login-assets/mod.css" />
    <link rel="shortcut icon" href="<?php echo $favico;?>" type="image/x-icon"/>
	<title><?php echo $sitename." | "."Member Sign in & Sign up section";?> </title>
	 <script src="dash/js/jquery-1.11.1.min.js"></script>
	 <script src="js/appController.js"></script>
	 <script src='https://www.google.com/recaptcha/api.js'></script>
	 <style>
		#sign-in-Result , #sign-up-Result {
			margin:6pt;
			display:none;
			color:green;
			font-weight:bold;
		}
		.Forgotten-link a{
			text-decoration:none;
			color:purple;
		}
		.Forgotten-link a:visited{
			text-decoration:none;
			color:red;
		}
		.Forgotten-link a:hover{
			text-decoration:none;
			color:green;
			font-size:15pt;
		}
		.re-captcha{
			
		}
 </style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <?php include_once("sign-in.php");?>
          <?php include_once("sign-up.php");?>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3 style="text-transform:uppercase;">Are you New Here?</h3>
            <p>
              Kindly sign up for a free account if you have not created.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="login-assets/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3 style="text-transform:uppercase;">Already own an account?</h3>
            <p>
              Kindly login if you have created an account with us before.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="login-assets/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
	<script src="login-assets/app.js"></script>
	<?php
	if(x_validateget("action")){
		if(x_get("action") == "register"){
		?>
		<script>
		$(document).ready(function(){
			$("#sign-up-btn").click();
		});
			
		</script>
		<?php	
		}
	}
 ?>
  </body>
</html>
