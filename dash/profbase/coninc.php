<?php
include_once("../../connections/connect.php");
$db_username = $usert;
$db_password = $passt;
$db_name = $dbt;
$db_host = $hostt;
$item_per_page = 30;

$connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name) or die('could not connect to database');
?>
