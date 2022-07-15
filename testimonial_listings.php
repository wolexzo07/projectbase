<?php
if(isset($pageToken)){
?>

		<?php
		
			if(x_count("testifyus","status='treated' LIMIT 1") > 0){
				?>

<section data-bs-version="5.1" class="testimonials2 cid-t7CNp82gRx" id="testimonials2-4">
  
    <div class="container">
        <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
            <strong>Testimonials</strong>
        </h3>
        <div class="row justify-content-center">
						
				<?php
				$postcounter = 0;
				foreach(x_select("0","testifyus","status='treated'","4","id desc") as $key){
				$postcounter++;
				$id = $key["id"];
				$userid = $key["user_id"];
				$msg = $key["message"];
				
				
				$getname = x_getsingle("SELECT name FROM userdb WHERE id='$userid' LIMIT 1","userdb WHERE id='$userid' LIMIT 1","name");
				
				$getphoto = x_getsingle("SELECT user_photo FROM userdb WHERE id='$userid' LIMIT 1","userdb WHERE id='$userid' LIMIT 1","user_photo");
				
				$getposition = x_getsingle("SELECT position FROM userdb WHERE id='$userid' LIMIT 1","userdb WHERE id='$userid' LIMIT 1","position");
				?>
				<div class="card col-12 col-md-6">
                <p class="mbr-text mbr-fonts-style mb-4 display-7"><?php echo ucwords(strtolower($msg));?></p>
                <div class="d-flex mb-md-0 mb-4">
                    <div class="image-wrapper">
                        <img src="<?php
						if($getphoto == ""){
							?>assets/images/team1.jpg<?php
						}else{
							echo $getphoto;
						}
						?>" alt="<?php echo $getname;?>">
                    </div>
                    <div class="text-wrapper">
                        <p class="name mbr-fonts-style mb-1 display-4">
                            <strong><?php echo $getname;?></strong>
                        </p>
                        <p class="position mbr-fonts-style display-4">
                            <strong><?php echo $getposition;?></strong>
                        </p>
                    </div>
                </div>
            </div>
				<?php
				}
			?>	
        </div>
    </div>
</section><?php
			}
			

}
?>