<?php
require_once("../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && isset($_POST['uploaded_job']) && !empty($_POST['uploaded_job'])){

$sc = xp("sc");
$email = xp("email");
$name = xp("name");
$amt = xp("amount");
$dept = xp("dept");
if($dept == "others"){
	$dept = xp("deptother");
	}else{
		$dept = xp("dept");
		}
$note = xp("message");
$ptitle = xp("ptitle");
$ptype = xp("ptype");
$sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
$code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);

//getting upload limit from db started

if(x_count("upload_product_limit","id='1' AND status='yes' LIMIT 1") > 0){
	foreach(x_select("abstract_size,real_size,sourcecode","upload_product_limit","id='1' AND status='yes'","1","id") as $key){
		
		$absize = $key["abstract_size"];
		$rsize = $key["real_size"];
		$source = $key["sourcecode"];
		xcsize("userphoto_two",$absize);xcsize("userphoto",$rsize);
		
		//$depter = xp("dept");
		$sc = xp("sc");
		if($sc == "yes"){
			
			xcsize("userphoto_three",$source);
			
			}else{
				
				}
		
		
		}
		
	}else{
		echo "No upload limit detected!";
		exit();
		}
		
		//getting upload limit fromdb ended
		
$token = sha1($email.xrands(10).Date("His"))."_";

//getting real Project work

xcload("userphoto");xtex("docx,pdf","userphoto");
$type = x_file("userphoto");
$size = x_size("userphoto");	

$path_one = xpath("userphoto","realproject_fileup/$token");

//getting project abtract

xcload("userphoto_two");xtex("docx,pdf","userphoto_two");
$type_two = x_file("userphoto_two");
$size_two = x_size("userphoto_two");	

$path_two = xpath("userphoto_two","abstract_fileup/$token");

//getting source codes
//$depter = xp("dept");
$sc = xp("sc");
if($sc == "yes"){
xcload("userphoto_three");xtex("zip","userphoto_three");
$type_three = x_file("userphoto_three");
$size_three = x_size("userphoto_three");	

$path_three = xpath("userphoto_three","sourcecode_fileup/$token");
			}else{
				
				}


$tok = sha1($email.xrands(10).Date("His")).sha1($email.xrands(10).Date("His")).md5($email.xrands(10).Date("His"));

if(x_count("userdb","email='$email' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	$create = x_dbtab("buy_sell","
	category VARCHAR(255) NOT NULL,
	ptitle VARCHAR(255) NOT NULL,
	postedby VARCHAR(255) NOT NULL,
	department VARCHAR(255) NOT NULL,
	amount DOUBLE NOT NULL,
	filesize VARCHAR(255) NOT NULL,
	filepath TEXT NOT NULL,
	ext ENUM('zip','pdf','docx','pptx','xlsx','mp4') NOT NULL,
	abfilesize VARCHAR(255) NOT NULL,
	abfilepath TEXT NOT NULL,
	abext ENUM('zip','pdf','docx','pptx','xlsx','mp4') NOT NULL,
	sfilesize VARCHAR(255) NOT NULL,
	sfilepath TEXT NOT NULL,
	sext ENUM('zip','pdf','docx','pptx','xlsx','mp4','') NOT NULL,
	note TEXT NOT NULL,
	buyer_count DOUBLE NOT NULL,
	downloads_count DOUBLE NOT NULL,
	status ENUM('pending','approved','declined') NOT NULL,
	rtime VARCHAR(255) NOT NULL,
	date_time DATETIME NOT NULL,
	token TEXT NOT NULL
	","MYISAM");
	if($create){
	$time = x_curtime("0","0");$rtime = x_curtime("0","1");

	if($sc == "yes"){
	xmload("userphoto",$path_one,"");
	xmload("userphoto_two",$path_two,"");
	xmload("userphoto_three",$path_three,"");
	
	x_insert("category,ptitle,postedby,department,amount,filesize,filepath,ext,abfilesize,abfilepath,abext,sfilesize,sfilepath,sext,note,buyer_count,downloads_count,status,rtime,date_time,token","buy_sell","'$ptype','$ptitle','$email','$dept','$amt','$size','$path_one','$type','$size_two','$path_two','$type_two','$size_three','$path_three','$type_three','$note','0','0','pending','$rtime','$time','$tok'","<script>alert('Upload Completed! Wait for approval within 48 hrs');load('sellprojectbase');</script>","Failed to insert data!");
		
		}else{
	xmload("userphoto",$path_one,"");
	xmload("userphoto_two",$path_two,"");
	
		x_insert("category,ptitle,postedby,department,amount,filesize,filepath,ext,abfilesize,abfilepath,abext,sfilesize,sfilepath,sext,note,buyer_count,downloads_count,status,rtime,date_time,token","buy_sell","'$ptype','$ptitle','$email','$dept','$amt','$size','$path_one','$type','$size_two','$path_two','$type_two','','','','$note','0','0','pending','$rtime','$time','$tok'","<script>alert('Upload Completed! Wait for approval within 48 hrs');load('sellprojectbase');</script>","Failed to insert data!");
			
			}

	}else{
		echo "Failed to dump table!";
	}
	
}else{
	echo "Incorrect Pin!";
}


}
?>
