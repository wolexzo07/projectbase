<?php
require_once("../../finishit.php");
xstart("0");
if(isset($_SESSION["PBNG_ID_2018_VISION"]) && isset($_POST['bidmenow']) || !empty($_POST['bidmenow'])){
	
$message = ucfirst(strtolower(xp("message")));
$projectowner = xp("project_owner");
$bidemail = strtolower(xp("bid_email"));
$pid = xp("pid");
$ptoken = xp("token");
$user = xclean($_SESSION["PBNG_EMAIL_2018_VISION"]);

 $sa = "IhAvEtHEAbIlItYOfThSpiRiT156725637892?@";
 $code = xp("pin");$pin = md5(sha1($code).$sa).sha1(sha1($code).$sa);
  
  $time = x_curtime("0","0");$rtime = x_curtime("0","1");
  
  $os = xos();$br = xbr();$ip = xip();
  
  $token = sha1(xrands(30).DATE("His"));
  
  $refid = time().rand(50,500900222).xrands(10);
  
  $create = x_create("bidded","
pid INT NOT NULL,
project_owner VARCHAR(100) NOT NULL,
bidder_email VARCHAR(100) NOT NULL,
comment TEXT NOT NULL,
ref_id TEXT NOT NULL,
date_time DATETIME NOT NULL,
timereal VARCHAR(50) NOT NULL,
status ENUM('pending','approved','cancelled') NOT NULL,
token TEXT NOT NULL,
os VARCHAR(100) NOT NULL,
br VARCHAR(220) NOT NULL,
ip VARCHAR(30) NOT NULL
			");

		if($create){
if(x_count("userdb","email='$user' AND pin='$pin' AND status='active' LIMIT 1") > 0){
	
	
			
	//checking to know if a professional can undertake more than one job at a time
	
	if(x_count("bidmore","status='yes' AND id='1' LIMIT 1") > 0){
		
		//bidmore true
		
		}else{
					
			//checking that the proffessional finished all the pending projects
		if(x_count("projects","approved_to='$user' AND processing_status='active' AND completion_status='inactive' AND bidded_status='active' LIMIT 1") > 0){
				echo "Complete pending job before bidding for more!";
				exit();
				}
				//checking that the proffessional finished all the pending projects ended	
			
			}	
	
	//checking to know if a professional can undertake more than one job at a time
	
		//checking if bidding submission is restricted to a count
	
	if(x_count("bidding_for_more","status='no' AND id='1' LIMIT 1") > 0){
		
				foreach(x_select("bidmax","bidding_for_more","status='no' AND id='1'","1","id") as $key){
					$bidmax = $key["bidmax"];
					
					//check that the bidding is not more than some level
				if(x_count("bidded","pid='$pid' LIMIT $bidmax") >= $bidmax){
				echo "Biddings exceeded.You can not have more than $bidmax bid per project";
				exit();
				}
				//check that the bidding is not more than some level ended
					}
			
		}else{
			
			//remove bid restriction
			
			}
			
	//checking if bidding submission is restricted to a count ended
	
	
	
	if(x_count("projects","id='$pid' AND token='$ptoken' AND processing_status='inactive' LIMIT 1") > 0){
		if(x_count("bidded","pid='$pid' AND bidder_email='$bidemail' LIMIT 1") > 0){
			echo "You have already bidded for this project";
			}else{
		#updating bid count	in project database	
	foreach(x_select("bidcount","projects","id='$pid'","1","bidcount") as $key){
	$pj = $key["bidcount"];
	}
	$njob = $pj + 1;
	
x_update("projects","id='$pid'","bidded_status='active',bidcount='$njob'","0","0");

#updating bidded_job in users database

foreach(x_select("bidded_job","userdb","email='$projectowner'","1","bidded_job") as $key){
	$pjj = $key["bidded_job"];
	}
	$njobb = $pjj + 1;
	
x_update("userdb","email='$projectowner'","bidded_job='$njobb'","0","0");

foreach(x_select("bidded_job","userdb","email='$bidemail'","1","bidded_job") as $key){
	$plp = $key["bidded_job"];
	}
	$njo = $plp + 1;
	
	x_update("userdb","email='$bidemail'","bidded_job='$njo'","0","0");
				
x_insert("pid,project_owner,bidder_email,comment,ref_id,date_time,timereal,status,token,os,br,ip","bidded","'$pid','$projectowner','$bidemail','$message','$refid','$time','$rtime','pending','$token','$os','$br','$ip'","Bidding submitted successfully","Failed to send bidding");

			}
		
		}else{
		echo "Project is approved to someone";
		}
		
		}else{
			echo "Incorrect Pin! Please provide valid pin";
}
		}else{
		echo "Failed to create table";
		}



}
?>
