<?php
include("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
$type = xp("user");
$cat = xp("cat");
?>
<script>
load("fpine/user?type=<?php echo $type;?>&status=<?php echo $cat;?>");
</script>
<?php
}
?>
