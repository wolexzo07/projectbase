<ul class="list-unstyled components">
    
					<li class="active">
					  <a href="./">
                            <i class="glyphicon glyphicon-dashboard"></i>
                            Dashboard
                        </a>
					</li>	
					
					<li>
					  <a href="#" onclick="load('afflink')">
                            <i class="fa fa-link"></i>
                           Affiliate Link
                        </a>
					</li>
					
					<li>
					  <a href="#" onclick="load('developerbase')">
                            <i class="fa fa-laptop"></i>
                           Affiliate Codes
                        </a>
					</li>
					
					<!----<li>
					  <a href="#" onclick="load('developerbase')">
                            <i class="fa fa-laptop"></i>
                           Download Banners
                        </a>
					</li>--->
					
					
					
					<li>
					  <a href="#" onclick="load('referral_base')">
                            <i class="fa fa-users"></i>
                            Manage Referrals 
                        </a>
					</li>
				
					
					<li>
					  <a href="#" onclick="load('walletmanager')">
                            <i class="glyphicon glyphicon-credit-card"></i>
                            Wallet Manager
                        </a>
					</li>
					
				
					
					<li>
					  <a href="#" onclick="load('testify')">
                            <i class="fa fa-gift"></i>
                            Testify
                        </a>
					</li>
					
				
					
                    <li>
                        <a href="#" onclick="load('faqbase')">
                            <i class="glyphicon glyphicon-paperclip"></i>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="load('contactbase')">
                            <i class="glyphicon glyphicon-send"></i>
                            Contact us
                        </a>
                    </li>
				
					 <li>
                        <a href="#" onclick="load('notifyme')">
                            <i class="glyphicon glyphicon-bell"></i>
                            Notifications <span class="badge pull-right">
	<?php 
	$user = $_SESSION["PBNG_EMAIL_2018_VISION"];
	$cut = x_count("notifyme","type='all' AND status='0' OR type='p' AND email='$user' AND status='0' LIMIT 1");
	echo $cut;
	?></span>
                        </a>
                    </li>
					
					<li>
                        <a href="#" onclick="load('settings')">
                            <i class="glyphicon glyphicon-cog"></i>
                            Settings
                        </a>
                    </li>
					
					<li>
                        <a href="../logout">
                            <i class="glyphicon glyphicon-log-out"></i>
                            Logout
                        </a>
                    </li>
                </ul>
