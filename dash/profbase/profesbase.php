<ul class="list-unstyled components">
					<li class="active">
					  <a href="./">
                            <i class="glyphicon glyphicon-dashboard"></i>
                            Dashboard
                        </a>
					</li>
					
 <li class=""> 
     <a href="#chatuser" data-toggle="collapse" aria-expanded="false">
     <i class="fa fa-users"></i>
                            Job Manager
                        </a>
         <ul class="collapse list-unstyled" id="chatuser">
		<li>
					  <a href="#" onclick="load('profbase/avaljobs')">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Available Jobs 
                        </a>
					</li>
					
				<li>
					  <a href="#" onclick="load('profbase/bidjob')">
                            <i class="glyphicon glyphicon-asterisk"></i>
                            Jobs Bidded
                        </a>
					</li>
				<li>
					  <a href="#" onclick="load('profbase/apprjob')">
                            <i class="glyphicon glyphicon-ok-sign"></i>
                            Approved Jobs
                        </a>
					</li>
					
					
					   <li>
                        <a href="#" onclick="load('../dash/jobsubmit')">
                            <i class="glyphicon glyphicon-cloud-upload"></i>
                            Upload work
                        </a>
                    </li>
					
					  <li>
                        <a href="#" onclick="load('profbase/jobsubmitted')">
                            <i class="fa fa-upload"></i>
                             Jobs Uploaded
                        </a>
                    </li>
                    
                    	<li>
					  <a href="#" onclick="load('profbase/comjobs')">
                            <i class="glyphicon glyphicon-ok-sign"></i>
                            Completed Jobs
                        </a>
					</li>
					<li>
					  <a href="#" onclick="load('profbase/payment_details')">
                            <i class="fa fa-money"></i>
                            Jobs Payment
                        </a>
					</li>
         </ul>
   </li>				

 <li class=""> 
     <a href="#chatusert" data-toggle="collapse" aria-expanded="false">
     <i class="fa fa-shopping-cart"></i>
                             Buy & Sell Projects
                        </a>
         <ul class="collapse list-unstyled" id="chatusert">
         
         	<li>
					  <a href="#" onclick="load('buy&sell')">
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                            Buy & Sell project
                           
                        </a>
					</li>
					
         				<li>
					  <a href="#" onclick="load('pfs')">
                            <i class="fa fa-briefcase"></i>
                            Project onsale
                           
                        </a>
					</li>
         
		<li>
					  <a href="#" onclick="load('porder')">
                            <i class="glyphicon glyphicon-credit-card"></i>
                            Project(s) Ordered
                        </a>
					</li>
					

         </ul>
   </li>
   
   
					
					<li>
					  <a href="#" onclick="load('referral_base')">
                            <i class="fa fa-users"></i>
                            Manage Referrals 
                        </a>
					</li>
					
					<li>
					  <a href="#" onclick="load('profbase/chate')">
                            <i class="glyphicon glyphicon-comment"></i>
                            Open Chat
                        </a>
					</li>
					
					<li>
					  <a href="#" onclick="load('walletmanager')">
                            <i class="glyphicon glyphicon-credit-card"></i>
                            Wallet Manager
                        </a>
					</li>
					
					<li>
					  <a href="#" onclick="load('dispute')">
                            <i class="glyphicon glyphicon-edit"></i>
                            Dispute
                        </a>
					</li>
					
					
					
					<li>
					  <a href="#" onclick="load('testify')">
                            <i class="fa fa-gift"></i>
                            Testify
                        </a>
					</li>
					
					<li>
					  <a href="#" onclick="load('developerbase')">
                            <i class="fa fa-users"></i>
                           Developers
                        </a>
					</li>
					
                    <li>
                        <a href="#" onclick="load('../dash/faqbase')">
                            <i class="glyphicon glyphicon-paperclip"></i>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="load('../dash/contactbase')">
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
                        <a href="#" onclick="load('../dash/settings')">
                            <i class="glyphicon glyphicon-cog"></i>
                            Settings
                        </a>
                    </li>
					
					<li>
                        <a href="<?php
                        if(isset($_SESSION["ANDROID_2018_VISION"])){
							?>../logout_android<?php
							}else{
								?>../logout<?php
								}
                        ?>">
                            <i class="glyphicon glyphicon-log-out"></i>
                            Logout
                        </a>
                    </li>
                </ul>
