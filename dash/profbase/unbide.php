<?php
include("../../finishit.php");
xstart("0");
if(isset($_POST["pid"]) && !empty($_POST["pid"]) && isset($_POST["ptoken"]) && !empty($_POST["ptoken"])){
	$userb = xp("userb");
	$pid = xp("pid");
	$ptoken = xp("ptoken");
	$time = x_curtime("0","0");$rtime = x_curtime("0","1");
	
if(x_count("projects","id='$pid' AND token='$ptoken' LIMIT 1") > 0){
		
		if(x_count("bidded","bidder_email='$userb' AND pid='$pid' LIMIT 1") > 0){
		
		//Getting project owner and bidder email and status
		
		foreach(x_select("project_owner,bidder_email,status","bidded","bidder_email='$userb' AND pid='$pid'","1","id") as $key){
			
			$powner = $key["project_owner"];
			$bdmail = $key["bidder_email"];
			$status = $key["status"];
				
				}
				
		//Getting project bidcount and bidded status	
		foreach(x_select("bidcount,bidded_status","projects","id='$pid'","1","id") as $key){
			
		$bcount = $key["bidcount"];
		$bstatus = $key["bidded_status"];
		$mcount = $bcount - 1;
		
		
		}
		
			
				
	  //validating the project is not yet approved
	  if($status == "approved"){
		  #echo "<script>alert('Use dispute section to send us message to reallocate the project')</script>";
		  
		  include("testbase.php");
		  
		  }elseif($status == "pending"){
			  
	//checking bidcount to know if is more than one
		if($bcount == 1){
			x_update("projects","id='$pid'","bidded_status='inactive',bidcount='$mcount'","0","0");
			}elseif($bcount > 1){
		x_update("projects","id='$pid'","bidded_status='active',bidcount='$mcount'","0","0");
				}else{
				//nothing to update
				}
		
		//getting project owner info
		if(x_count("userdb","email='$powner' LIMIT 1") > 0){
		
		foreach(x_select("bidded_job","userdb","email='$powner'","1","id") as $key){
			
			$bidjob = $key["bidded_job"];
			$nbid = abs($bidjob - 1);
			//updating project owner bidded job count
			x_update("userdb","email='$powner'","bidded_job='$nbid'","0","0");
			}
			//getting bidder info	
			if(x_count("userdb","email='$bdmail' LIMIT 1") > 0){
			
			foreach(x_select("bidded_job","userdb","email='$bdmail'","1","id") as $key){
			
			$bidjobb = $key["bidded_job"];
			$nbider = abs($bidjobb - 1);
			//updating project bidder bidded job count
			x_update("userdb","email='$bdmail'","bidded_job='$nbider'","0","0");
			
			}
			
			
			
			}else{
				echo "invalid bid.owner!";
				}
			
			}else{
				echo "invalid p.owner!";
				}
		
		  x_del("bidded","bidder_email='$userb' AND pid='$pid'","","");
		 
			  echo "Unbidded";
			  
			  }
		  else{
			  echo "invalid status";
			  }	
			  
				
			}else{
				echo "inactive bid!";
				}
		
}else{
		echo "Invalid project";
		
		} 
	
	}else{
		
		echo "Parameter missing!";
		
		}

?>
