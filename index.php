<?php
session_start();
include("xe-library/xe-library74.php");
include("xe-library/nftfunctions.php");
include("siteinfo.php");
include("refcoder.php");

if(x_count("portalmode","status='offline' AND id='1' LIMIT 1") > 0){

	finish("notify/maintenance","Site maintenance in progress");
	exit();
}

//generating session to prevent cross request forgery attack

if(!isset($_SESSION["AUTH_PAGE_PROJECTBASE"])){
	
$_SESSION["AUTH_PAGE_PROJECTBASE"] = sha1(md5(rand(23,10989))).sha1(md5(rand(10,5098))).sha1(md5(rand(12,60987)));
	
}

$host = sha1($_SERVER['REMOTE_ADDR']);
$uag = sha1($_SERVER['HTTP_USER_AGENT']);
$toks = sha1($_SESSION["AUTH_PAGE_PROJECTBASE"].sha1(Date("Y-m-d")));
$extra = "?auth_toks=$toks&user_agent=$uag&identify_client=$host";

if(!x_validateget("auth_toks") || !x_validateget("user_agent") || !x_validateget("identify_client")){
	finish("./$extra","0");
}
//generating session to prevent cross request forgery attack

include("mainPage.php");
?>