<?php
include("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
$cat = xp("cat");
?>
<script>
load("fpine/approvd?cat=<?php echo $cat;?>");
</script>
<?php
}
?>

