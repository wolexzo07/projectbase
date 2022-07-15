<?php
session_start();
if(isset($_POST["blessme"]) || !empty($_POST["blessme"])){
	include_once("../../finishit.php");
$title = xp("title");$full= xp("readpost");$cat= xp("cat");
	//getting upload limit from db started

	if(x_count("filelimit","status='1' LIMIT 1") > 0){
		foreach(x_select("news_img","filelimit","status='1'","1","id") as $key){

			$sizep = $key["news_img"];
			xcsize("userphoto",$sizep);

			}
		}else{
			echo "<p class='hubmsg'>No upload limit detected!</p>";
			exit();
			}

	//getting upload limit fromdb ended

	xcload("userphoto");

	xtex("png,gif,jpg,jpeg","userphoto");
	 $token = sha1($title.uniqid().xrands(10).Date("His"))."_";
	$path_one = xpath("userphoto","newsavatar/$token");


 $time = x_curtime("0","0");$rtime = x_curtime("0","1");

 $token = sha1($title.uniqid().xrands(10).Date("His"));

$create = x_create("writepost","
	cat VARCHAR(220) NOT NULL,
	user_photo TEXT NOT NULL,
	test_photo TEXT NOT NULL,
	testt_photo TEXT NOT NULL,
	status ENUM('0','1') NOT NULL,
	title VARCHAR(220) NOT NULL,
	full TEXT NOT NULL,
	token TEXT NOT NULL,
	realtime VARCHAR(100) NOT NULL,
	os VARCHAR(100) NOT NULL,
	br VARCHAR(220) NOT NULL,
	ip VARCHAR(30) NOT NULL
			");
			$os = xos();$br = xbr();$ip = xip();
if($create){
if(x_count("writepost","title='$title' LIMIT 1") > 0){
echo "<p class='hubmsg'>Post title already used!</p>";
}else{
xmload("userphoto",$path_one,"");
x_insert("token,cat,user_photo,title,full,realtime,os,br,ip,status","writepost","'$token','$cat','$path_one','$title','$full','$rtime','$os','$br','$ip','1'","<p class='hubmsg'>Post Submitted successfully!</p>","<p class='hubmsg'>Failed to submit data.</p>");

}
	}else{
		echo "<p class='hubmsg'>Failed to create table!</p>";
	}


}else{
	echo "<p class='hubmsg'>Parameter missing!!...</p>";
}
?>
