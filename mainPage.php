<?php
if(!isset($sitename) || !isset($sitetitle)){
	exit();
}
$pageToken = sha1(uniqid());
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("metahead.php");?>
	<title><?php echo $sitename." | ".$sitetitle;?> </title>
    <?php include("header.php");?>

</head>
<body>

<?php include("navmenubar.php");?>
  
<section data-bs-version="5.1" style="padding-top:0pt;" class="header4 cid-t7B9APbWbB mbr-fullscreen mbr-parallax-background" id="header4-1">

    
    <div class="mbr-overlay"></div>
    <div class="container">
        <div class="row" >
            <div class="content-wrap">
                <?php echo $front_header;?>
                
                <?php echo $front_des;?>
			
                <div class="mbr-section-btn"><a class="btn btn-primary display-4" href="login"><i class="fa fa-users"></i>&nbsp;Create an Account</a></div>

            </div>
        </div>
    </div>
</section>



<section data-bs-version="5.1" class="features12 cid-t7CXw08jXd" id="features13-h">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card-wrapper">
                    <div class="card-box align-left">
						<?php
							$phase = 3;
							if(x_count("manage_front_phase","status='1' AND phases='$phase' AND is_header_content='1' LIMIT 1") > 0){
								foreach(x_select("0","manage_front_phase","status='1' AND phases='$phase' AND is_header_content='1'","1","id") as $whychooseus){
									$id = $whychooseus["id"];
									$phd = $whychooseus["phase_description"];
									$icon = $whychooseus["icon"];
									$title = $whychooseus["title"];
									$cn = $whychooseus["content"];
									$cnlink = $whychooseus["content_link"];
									$cnimg = $whychooseus["content_image"];
									$stat = $whychooseus["status"];
								}
								?>
						<h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong><?php echo $title;?></strong>
                        </h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            <?php echo $cn;?></p>
                        <div class="mbr-section-btn"><a class="btn btn-primary display-4" href="<?php echo $cnlink;?>">Learn More</a></div>
								<?php
							}else{
								?>
								<h4 class="card-title mbr-fonts-style mb-4 display-2">
									<strong>Oops: Missing content!!</strong>
								</h4>
								<?php
							}
						?>
 
                       
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
			<?php
				if(x_count("manage_front_phase","status='1' AND phases='$phase' AND is_header_content='0' LIMIT 1") > 0){
					foreach(x_select("0","manage_front_phase","status='1' AND phases='$phase' AND is_header_content='0'","0","id") as $whychooseus){
						$id = $whychooseus["id"];
						$phd = $whychooseus["phase_description"];
						$icon = $whychooseus["icon"];
						$title = $whychooseus["title"];
						$cn = $whychooseus["content"];
						$cnlink = $whychooseus["content_link"];
						$cnimg = $whychooseus["content_image"];
						$stat = $whychooseus["status"];
						
						?>
				<div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="<?php echo $icon;?>"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-black mbr-fonts-style display-7">
                            <strong><?php echo $title;?></strong>
                        </h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4"><?php echo $cn;?></h5>
                    </div>
                </div>
					<?php
					}
								
							}else{
								?>
								<h4 class="card-title mbr-fonts-style mb-4 display-2">
									<strong>Oops: Missing content!!</strong>
								</h4>
								<?php
							}
						?>
                
				<!--------Ended listing--------->
            </div>
        </div>
    </div>
</section>


<?php
	$phase = 4;
	if(x_count("manage_front_phase","status='1' AND phases='$phase' LIMIT 1") > 0){
		$scounter = 0;
		foreach(x_select("0","manage_front_phase","status='1' AND phases='$phase'","3","id") as $services){
				$scounter++;
				$id = $services["id"];
				$phd = $services["phase_description"];
				$icon = $services["icon"];
				$title = $services["title"];
				$cn = $services["content"];
				$cnlink = $services["content_link"];
				$cnimg = $services["content_image"];
				$stat = $services["status"];
			
				if($scounter == 1){
					?>
<section data-bs-version="5.1" class="features11 cid-t7D2lOq4ML" id="features12-i">
    <div>
        <div class="m-0 row align-items-center">
            <div class="col-12 col-lg offset-lg-1">
                <div class="card-wrapper">
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong><?php echo $title;?></strong></h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
							<?php echo $cn;?>
						</p>
                        
                        <div class="mbr-section-btn mb-4"><a class="btn btn-primary display-4" href="<?php echo $cnlink;?>">Get Started</a></div>
                    </div>
                </div>
            </div>
            <div class="p-3 col-12 col-lg-5 md-pb">
                <div class="image-wrapper">
                    <img src="<?php echo $cnimg;?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
					<?php
				}
				elseif($scounter == 2){
					?>
<section data-bs-version="5.1" class="features11 cid-t7DmoB8ar3" id="features12-l">
    <div>
        <div class="m-0 row align-items-center">
		  <div class="p-3 col-12 col-lg-5 md-pb">
                <div class="image-wrapper">
                    <img src="<?php echo $cnimg;?>" alt="">
                </div>
            </div>
            <div class="col-12 col-lg offset-lg-1">
                <div class="card-wrapper">
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong><?php echo $title;?></strong></h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
						<?php echo $cn;?>
                        </p>
                        
                        <div class="mbr-section-btn mb-4"><a class="btn btn-primary display-4" href="<?php echo $cnlink;?>">Get Hired</a></div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</section>
					<?php
				}
				else{
					?>
<section data-bs-version="5.1" class="features11 cid-t7Duf0yQam" id="features12-m">
    <div>
        <div class="m-0 row align-items-center">
            <div class="col-12 col-lg offset-lg-1">
                <div class="card-wrapper">
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong><?php echo $title;?></strong></h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7"><?php echo $cn;?></p>
                        
                        <div class="mbr-section-btn mb-4"><a class="btn btn-primary display-4" href="<?php echo $cnlink;?>">Get Started</a></div>
                    </div>
                </div>
            </div>
            <div class="p-3 col-12 col-lg-5 md-pb">
                <div class="image-wrapper">
                    <img src="<?php echo $cnimg;?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
					<?php
				}
			
			}
						
	}else{
		?>
		<h4 class="card-title mbr-fonts-style mb-4 display-2 text-center p-5">
			<strong>Oops: Missing content!!</strong>
		</h4>
		<?php
	}
?>


<section data-bs-version="5.1" class="image2 cid-t7DDq0Dvy0" id="image2-n">

    <div class="container">
       <?php
$phase = 5;
if(x_count("manage_front_phase","status='1' AND phases='$phase' LIMIT 1") > 0){
	foreach(x_select("0","manage_front_phase","status='1' AND phases='$phase'","0","id") as $cert){
		$id = $cert["id"];
		$phd = $cert["phase_description"];
		$icon = $cert["icon"];
		$title = $cert["title"];
		$cn = $cert["content"];
		$cnlink = $cert["content_link"];
		$cnimg = $cert["content_image"];
		$stat = $cert["status"];
		
		?>
		<div class="row align-items-center">
            <div class="col-12 col-lg">
                <div class="text-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                        <strong><?php echo $title;?></strong></h3>
                    <p class="mbr-text mbr-fonts-style display-7">
                        <?php echo $cn;?></p>
                </div>
            </div>
			<div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <img src="<?php echo $cnimg;?>" alt="cac certificate">
                    
                </div>
            </div>
        </div>
		<?php
	}
				
			}else{
				?>
				<h4 class="card-title mbr-fonts-style mb-4 display-2 text-center p-4">
					<strong>Oops: Missing content!!</strong>
				</h4>
				<?php
			}
		?>
    </div>
</section>


<?php include("newsAlone_Fetcher.php");?>


<?php include("testimonial_listings.php");?>


<section data-bs-version="5.1" class="contacts4 cid-t7CVKfB0gw" id="contacts4-c">

    

    

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="text-content col-12 col-md-6">
                <h2 class="mbr-section-title mbr-fonts-style display-2">
                    <strong>Follow Us</strong>
                </h2>
                
            </div>
            <div class="icons d-flex align-items-center col-12 col-md-6 justify-content-end mt-md-0 mt-2 flex-wrap">
                <a href="<?php echo $twitter;?>" target="_blank">
                    <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="<?php echo $facebook;?>" target="_blank">
                    <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="<?php echo $youtube;?>" target="_blank">
                    <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="<?php echo $instagram;?>" target="_blank">
                    <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                <a href="<?php echo $behance;?>" target="_blank">
                    <span class="socicon-behance socicon mbr-iconfont mbr-iconfont-social"></span>
                </a>
                
                
                
                
                
            </div>
        </div>
    </div>
    
</section>

<?php include("faqFetcher.php");?>


<section data-bs-version="5.1" class="clients1 cid-t7CVGfWRwI" id="clients1-b">
    
    <div class="images-container container-fluid">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong>Our Customers</strong></h3>
            
            
        </div>
        <div class="row justify-content-center mt-4">
		<?php
			if(x_count("customers_listing","status='1' LIMIT 1") > 0){
				foreach(x_select("0","customers_listing","status='1'","10","rand()") as $key){
				$cname = $key["customers_name"]; $clogo = $key["customers_logo"];
				?>
				<div class="col-md-3 card">
                  <img src="<?php echo $clogo;?>" alt="<?php echo $cname;?>">
				</div>
				<?php
				}
			}
		
		?>
            
         
            
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="features23 cid-t7ZOwlXNOK" id="features24-q">

    
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-wrapper mb-4">
                    <div class="card-box align-center">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong>Get started in 5 mins</strong></h4>
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="item first mbr-flex p-4">
                    <div class="icon-wrap w-100">
                        <div class="icon-box">
                            <span class="step-number mbr-fonts-style display-5">1</span>
                        </div>
                    </div>

                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Create Account</strong></h4>
                        <h5 class="mbr-text mbr-black mbr-fonts-style display-4">Create a free account with your valid informations.</h5>
                    </div>
                </div>
                <!-- <span mbr-icon class="mbr-iconfont mobi-mbri-devices mobi-mbri"></span> -->
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="item mbr-flex p-4">
                    <div class="icon-wrap w-100">
                        <div class="icon-box">
                            <span class="step-number mbr-fonts-style display-5">2</span>
                        </div>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Update account</strong></h4>
                        <h5 class="mbr-text mbr-black mbr-fonts-style display-4">You have to update your account to enable us to know you more.</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="item mbr-flex p-4">
                    <div class="icon-wrap w-100">
                        <div class="icon-box">
                            <span class="step-number mbr-fonts-style display-5">3</span>
                        </div>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title card-title mbr-black mbr-fonts-style display-7">
                            <strong>Verify your Identity</strong></h4>
                        <h5 class="mbr-text mbr-black mbr-fonts-style display-4">We are security conscious so it is necessary for all users to validate his/her identity.</h5>
                    </div>
                </div>
            </div>
            
            
            
            
            
        </div>
    </div>
</section>



<section data-bs-version="5.1" class="footer6 cid-t7CMdWWVWE" once="footers" id="footer6-3">

    <div class="container">
        <div class="row content mbr-white">
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 display-7">
                    <strong>Address</strong>
                </h5>
                <p class="mbr-text mbr-fonts-style display-7">
                    <?php echo $siteaddress;?>
                </p> <br/><br/>
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 mt-4 display-7">
                    <strong>Contacts</strong>
                </h5>
                <p class="mbr-text mbr-fonts-style mb-4 display-7">
				<?php echo $siteemail;?><br/>
				+1 (0) 000 0000 001 <br/>
				+1 (0) 000 0000 002
                </p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 display-7">
                    <strong>Links</strong>
                </h5>
                <ul class="list mbr-fonts-style mb-4 display-4">
                    <li class="mbr-text item-wrap">
                        <a class="text-primary" target="_blank" href="#">About us</a>
                    </li>
                    <li class="mbr-text item-wrap">
                        <a class="text-primary" target="_blank" href="#">Terms of use</a>
                    </li>
                    <li class="mbr-text item-wrap">
                        <a class="text-primary" target="_blank" href="#">Pricing</a>
                    </li>
					<li class="mbr-text item-wrap">
                        <a class="text-primary" target="_blank" href="#">Privacy policy</a>
                    </li>
					<li class="mbr-text item-wrap">
                        <a class="text-primary" target="_blank" href="#">Refunds Policy</a>
                    </li>
                </ul>
                <h5 class="mbr-section-subtitle mbr-fonts-style mb-2 mt-3 display-7">
                    <strong>Feedback</strong>
                </h5>
                <p class="mbr-text mbr-fonts-style mb-4 display-7">
                    Please send us your ideas, bug reports, suggestions! Any feedback would be appreciated.
                </p>
            </div>
            <div class="col-12 col-md-6">
                <div class="google-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDk89J4FSunMF33ruMVWJaJht_Ro0kvoXs&amp;q=350 5th Ave, New York, NY 10118" allowfullscreen=""></iframe></div>
            </div>
            <div class="col-md-6">
                <div class="social-list align-left">
                    <div class="soc-item">
                        <a href="https://twitter.com/mobirise" target="_blank">
                            <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://www.facebook.com/pages/Mobirise/1616226671953247" target="_blank">
                            <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://www.youtube.com/c/mobirise" target="_blank">
                            <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://instagram.com/mobirise" target="_blank">
                            <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://plus.google.com/u/0/+Mobirise" target="_blank">
                            <span class="socicon-googleplus socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://www.behance.net/Mobirise" target="_blank">
                            <span class="socicon-behance socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-lower">
            <div class="media-container-row">
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
            <div class="col-sm-12 copyright pl-0">
                <p class="mbr-text mbr-fonts-style mbr-white display-7">
                    © Copyright 2018 -  <?php echo DATE("Y")." ".$sitename;?> - All Rights Reserved
                </p>
            </div>
        </div>
    </div>
</section>

<section class="display-7" style="padding: 0;align-items: center;justify-content: center;flex-wrap: wrap;    align-content: center;display: flex;position: relative;height: 1rem;">

<a href="https://mobiri.se/356241" style="flex: 1 1;height: 4rem;position: absolute;width: 100%;z-index: 1;"><img alt="" style="height: 1rem;" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="></a>
<p style="margin: 0;text-align: center;" class="display-7"> &#8204;</p>
<a style="z-index:1" href="https://mobirise.com"></a>

</section>


  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/parallax/jarallax.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/ytplayer/index.js"></script> 
  <script src="assets/dropdown/js/navbar-dropdown.js"></script> 
  <script src="assets/embla/embla.min.js"></script> 
  <script src="assets/embla/script.js"></script> 
  <script src="assets/sociallikes/social-likes.js"></script> 
  <script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="assets/theme/js/script.js"></script>  

</body>
</html>