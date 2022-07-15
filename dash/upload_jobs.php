<?php
require_once("../finishit.php");
if(isset($_SESSION["PBNG_ID_2018_VISION"])&& isset($_POST['uploaded_job']) || !empty($_POST['uploaded_job'])){

$email = xp("email");
$name = xp("name");
$po = xp("owner");
$cat = xp("category");
$note = xp("message");

$ptype = xp("ptype");

$sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
$code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);

//getting upload limit from db started

if(x_count("filelimit","status='1' LIMIT 1") > 0){
	foreach(x_select("size","filelimit","status='1'","1","id") as $key){
		
		$sizep = $key["size"];
		xcsize("userphoto",$sizep);
		
		}
	}else{
		echo "No upload limit detected!";
		exit();
		}
		
		//getting upload limit fromdb ended
		
$token = sha1($ptype.$cat.$email.xrands(10).Date("His"))."_";
xcload("userphoto");xtex("docx,pdf,zip,pptx,xlsx","userphoto");
$type = x_file("userphoto");
$size = x_size("userphoto");	

$path_one = xpath("userphoto","projectwork_done/$token");
if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	$create = x_dbtab("workdone","
	category ENUM('abstract','real') NOT NULL,
	pid INT NOT NULL,
	owner VARCHAR(255) NOT NULL,
	bidder VARCHAR(255) NOT NULL,
	filesize VARCHAR(255) NOT NULL,
	filepath TEXT NOT NULL,
	note TEXT NOT NULL,
	ext ENUM('zip','pdf','docx','pptx','xlsx','mp4') NOT NULL,
	status ENUM('pending','approved','declined') NOT NULL,
	date_time VARCHAR(255) NOT NULL,
	token TEXT NOT NULL
	","MYISAM");
	if($create){
		if(x_count("workdone","pid='$cat' AND category='$ptype' LIMIT 1") > 0){
		$tim = x_curtime("0","1");
		xmload("userphoto",$path_one,"");
		
		foreach(x_select("filepath","workdone","pid='$cat' AND category='$ptype'","1","filepath") as $key){
			$file = $key["filepath"];
		}
		unlink($file);
		x_update("workdone","pid='$cat' AND category='$ptype'","filepath='$path_one',status='pending',date_time='$tim',token='$token',ext='$type',note='$note',filesize='$size'","0","0");
		echo "Upload Renewed successfully!";
		}else{
		$tim = x_curtime("0","1");
		xmload("userphoto",$path_one,"");
		x_insert("category,filesize,pid,owner,bidder,filepath,status,date_time,token,ext,note","workdone","'$ptype','$size','$cat','$po','$email','$path_one','pending','$tim','$token','$type','$note'","Upload Successful","Failed to insert data!");
		}

	}else{
		echo "Failed to dump table!";
	}
	
}else{
	echo "Incorrect Pin!";
}


}
?>
