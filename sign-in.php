<?php
if(isset($pageToken)){
?>

		<form autocomplete="off" id="uploadForm" class="sign-in-form">
		
            <h2 class="title"><img src="<?php echo $sitelogo;?>" style="width:40px;"/>&nbsp;&nbsp;Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="email" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="pass"/>
            </div>
			<input type="hidden" name="_token" value="<?php echo sha1(rand().uniqid())?>"/>
			
			<?php
				if(x_count("control_captcha","status='1'") > 0){
					?>
				<div class="re-captcha">
					<div class="g-recaptcha" data-sitekey="6LcDo1sUAAAAAEPlrWpeHZlvDbV1ydwDuM0lJe9N"></div>
			    </div>
					<?php
				}
			?>
			<input type="hidden" name="<?php echo $_SESSION["XCAPE_HACKS"];?>" value="<?php echo sha1(uniqid());?>"/>	
			
            <input type="submit" value="Login" class="btn solid" />
			
			<p class="Forgotten-link"> 
					<a href="resetpass">Reset password / pin?</a>
			</p>
			
			<div id="sign-in-Result">
					<img src="image/ajax-loader.gif"/>
			</div>
			
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
			
          </form>
<?php
}
?>
