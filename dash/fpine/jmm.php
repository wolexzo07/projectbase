<?php
include("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
$cat = xp("cat");
$cur = xp("cur");
?>
<script>
load("fpine/payme?cur=<?php echo $cur;?>&cat=<?php echo $cat;?>");
</script>
<?php
}
?>

