  <?php
if(isset($pageToken)){
	?>
	
  <section data-bs-version="5.1" class="menu menu3 cid-t7B8QsZ31L" once="menu" id="menu3-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    
                        <img src="<?php echo $sitelogo;?>" alt="logo" style="height: 3rem;">
                    
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-7" href="#"><?php echo strtoupper($sitename);?></a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
				
				<li class="nav-item">
				<a class="nav-link link text-black display-4" href="#">Post <!--Project--> Gigs</a>
                </li>
				
				<li class="nav-item">
				<a class="nav-link link text-black display-4" href="#">Available <!--Project--> Gigs</a>
				</li>
								
				<li class="nav-item dropdown">
				<a class="nav-link link text-black dropdown-toggle show display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Project Materials</a>
				<div class="dropdown-menu show" data-bs-popper="none" aria-labelledby="dropdown-865">
				<a class="text-black dropdown-item display-4" href="#">Sell Projects Materials</a>
				<a class="text-black dropdown-item display-4" href="#">Buy Projects Materials</a>
				</div>
				</li>
				
				<li class="nav-item dropdown">
				<a class="nav-link link text-black dropdown-toggle show display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">About</a>
				<div class="dropdown-menu show" data-bs-popper="none" aria-labelledby="dropdown-865">
				<a class="text-black dropdown-item display-4" href="#">Company</a>
				<a class="text-black dropdown-item display-4" href="#">Pricing</a>
				<a class="text-black dropdown-item display-4" href="#">Blog</a>
				</div>
				</li>
				
				</ul>
                
                <div class="navbar-buttons mbr-section-btn"><a class="btn btn-primary display-4" href="login?action=logon"><i class="fa fa-sign-in"></i>&nbsp; Sign in</a></div>
            </div>
        </div>
    </nav>
</section>


	<?php
}
?>