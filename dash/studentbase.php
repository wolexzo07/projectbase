<ul class="list-unstyled components">
    
					<li class="active">
					  <a href="./">
                            <i class="glyphicon glyphicon-dashboard"></i>
                            Dashboard
                        </a>
					</li>	
					
		 <li class=""> 
     <a href="#chatuser" data-toggle="collapse" aria-expanded="false">
     <i class="fa fa-briefcase"></i>
                            Job Manager
                        </a>
         <ul class="collapse list-unstyled" id="chatuser">

				<li>
					  <a href="#" onclick="load('writepostnow')">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            Post Jobs 
                        </a>
					</li>
					
					<li>
					  <a href="#" onclick="load('fettch_post')">
                            <i class="fa fa-bank"></i>
                            Posted Jobs 
                        </a>
					</li>
					
						<li>
					  <a href="#" onclick="load('approvenow')">
                            <i class="fa fa-check"></i>
                            Job Biddings 
                        </a>
					</li>
					
				<li>
					  <a href="#" onclick="load('projectpy')">
                            <i class="glyphicon glyphicon-credit-card"></i>
                            Jobs Payment
                        </a>
					</li>
						<li>
					  <a href="#" onclick="load('track')">
                            <i class="fa fa-money"></i>
                            Transactions
                        </a>
					</li>
						<li>
					  <a href="#" onclick="load('approved')">
                            <i class="glyphicon glyphicon-ok-sign"></i>
                            Approved Jobs
                        </a>
					</li>
					<li>
					  <a href="#" onclick="load('approved_ab')">
                            <i class="fa fa-check"></i>
                            Project Abstract
                        </a>
					</li>
						<li>
					  <a href="#" onclick="load('completejob')">
                            <i class="glyphicon glyphicon-check"></i>
                            Completed Jobs
                        </a>
					</li>
					
							<li>
					  <a href="#" onclick="load('download_job')">
                            <i class="glyphicon glyphicon-cloud-download"></i>
                            Download Jobs
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
					  <a href="#" onclick="load('chatme')">
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
