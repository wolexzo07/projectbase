<?php
if($_SESSION["PBNG_POSITION_2018_VISION"] == "professional"){
require_once("professpartone.php");
}elseif($_SESSION["PBNG_POSITION_2018_VISION"] == "student"){
require_once("studentpartone.php");
}else{

}
?>
