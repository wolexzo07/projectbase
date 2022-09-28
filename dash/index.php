<?php
  include_once("../finishit.php");
  include_once("../siteinfo.php");
 // include("qrlib.php");
  xstart("0");
  xreq("validation.php");
  xreq("headtop.php");
  $user = $_SESSION["PBNG_NAME_2018_VISION"];
  xtitle("$sitename - DashBoard :: Welcome $user");
  xreq("headbt.php");
  ?>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <?php xreq("sidebar.php");?>

            <!-- Page Content Holder -->
			<?php xreq("bar.php")?>
        </div>
<?php xreq("foot.php")?>
