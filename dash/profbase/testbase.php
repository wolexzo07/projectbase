
	<?php		  
	//check for the completed project
	if(x_count("projects","id='$pid' AND completion_status='active'") > 0){
		#echo "Completed project";
		echo "<script>alert('You can not unbid a completed project! Please contact admin')</script>";
		exit();
		}
	
	//checking bidcount to know if is more than one
		if($bcount == 1){
			x_update("projects","id='$pid'","bidded_status='inactive',processing_status='inactive',approved_to='',bidcount='$mcount'","0","0");
			}elseif($bcount > 1){
		x_update("projects","id='$pid'","bidded_status='active',processing_status='inactive',approved_to='',bidcount='$mcount'","0","0");
				}else{
				//nothing to update
				}
		
		//getting project owner info
		if(x_count("userdb","email='$powner' LIMIT 1") > 0){
		
		foreach(x_select("bidded_job,approved_job","userdb","email='$powner'","1","id") as $key){
			
			$bidjob = $key["bidded_job"];
			$apjob = $key["approved_job"];
			
			$apbn = abs($apjob - 1);
			
			$nbid = abs($bidjob - 1);
			//updating project owner bidded job count
			x_update("userdb","email='$powner'","bidded_job='$nbid',approved_job='$apbn'","0","0");
			}
			//getting bidder info	
			if(x_count("userdb","email='$bdmail' LIMIT 1") > 0){
			
			foreach(x_select("bidded_job,approved_job,cancelled_job","userdb","email='$bdmail'","1","id") as $key){
			
			$bidjobb = $key["bidded_job"];
			$apjobb = $key["approved_job"];
			$cajobb = $key["cancelled_job"];
			$nbider = abs($bidjobb - 1);
			$apb = abs($apjobb - 1);
			$cjobb = abs($cajobb + 1);
			//updating project bidder bidded job count
			x_update("userdb","email='$bdmail'","bidded_job='$nbider',approved_job='$apb',cancelled_job='$cjobb'","0","0");
			
			}
			
			
			
			}else{
				echo "invalid bid.owner!";
				}
			
			}else{
				echo "invalid p.owner!";
				}
			
			//checking for chatrecords and clear if any
			if(x_count("chatbox","pid='$pid' LIMIT 1") > 0){
				
				x_del("chatbox","pid='$pid'","","");
				
				}else{
					
					}
					//checking for chatrecords and clear if any ended
		
		  x_del("bidded","bidder_email='$userb' AND pid='$pid'","","");
		 
			  echo "Unbidded";
			  ?>
