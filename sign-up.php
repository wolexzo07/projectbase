<?php
if(isset($pageToken)){
?>
          <form autocomplete="off" id="uploadFormnow" class="sign-up-form">
            <h2 class="title"><img src="<?php echo $sitelogo;?>" style="width:40px;"/>&nbsp;&nbsp;Sign up</h2>
			
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" autocomplete="off" id="full" class="input-0" name="full" required placeholder="Last and First name" />
            </div>
			
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" autocomplete="off" id="email" class="input-0" name="email" required placeholder="Valid email" />
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="pass" id="pass" class="input-0" autocomplete="off" required placeholder="Password" />
            </div>
			
			<select required class="select-field" name="pos" id="position" class="input-0">
				<option value="">Choose your role</option>
				<?php
				if(x_count("registration_category","status='1' LIMIT 1") > 0){
					foreach(x_select("type,description","registration_category","status='1'","5","id") as $key){
						$type = $key["type"];
						$descrip = $key["description"];
						?>
						<option value="<?php echo $type;?>"><?php echo $type;?> (<?php echo $descrip;?>)</option>
						<?php
						
						}
					}else{
						
						?>
						<option value="">No role was found in the db!</option>
						<?php
						
						}

				?>
			  </select>
			  
			<div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" autocomplete="off" id="pin" class="input-0" placeholder="4-digit Pin" name="pin" />
            </div>
			
			<input type="hidden" readonly="readonly" value="<?php 
					if(isset($_SESSION["pbng_refcoded"])){
						echo $_SESSION["pbng_refcoded"];
						}else{echo '';}
			?>" name="ref"  id="fpir" class="form-control"/>
			<input type="hidden" name="_token" value="<?php echo sha1(rand().uniqid())?>"/>
			
			<?php
				if(x_count("control_captcha","status='1'") > 0){
					?>
				<div class="re-captcha">
					<div class="g-recaptcha" data-sitekey="<?php echo $captcha;?>"></div>
			    </div>
					<?php
				}
			?>
			
			<input type="hidden" name="<?php echo $_SESSION["XCAPE_HACKS"];?>" value="<?php echo sha1(uniqid());?>"/>	
            <!---<input type="submit" class="btn" value="Sign up" />
            <input type="submit" class="btn" value="Save & Continue" />--->
			<button class="btn" id="next_btn">Continue</button>
			
			<div id="sign-up-Result">
					<img src="image/ajax-loader.gif"/>
			</div>
			
			<p class="Forgotten-link"> 
					<a href="resetpass">Reset password / pin?</a>
			</p>
			
            <!----<p class="social-text">Or Sign up with social platforms</p>
			
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
            </div>--->
			</form>
          
		  
<?php
}
?>