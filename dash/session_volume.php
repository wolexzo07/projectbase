<?php
if(!isset($_SESSION["PBNG_SECURITY"])){
	echo "You are not authorized";
	exit();
}
if(!isset($_SESSION["PBNG_EMAIL_2018_VISION"])){
	echo "You are not authorized";
	exit();
}
?>