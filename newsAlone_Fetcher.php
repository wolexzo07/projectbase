<?php
if(isset($pageToken)){

			if(x_count("writepost","status='1' AND cat='news' LIMIT 1") > 0){
					?>
	<section data-bs-version="5.1" class="slider4 mbr-embla cid-t7ZORao9FV" id="slider4-r">
    
    
    <div class="position-relative text-center">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong>News Updates</strong></h4>
            
        </div>
        <div class="embla mt-4" data-skip-snaps="true" data-align="center" data-contain-scroll="trimSnaps" data-auto-play-interval="5" data-draggable="true">
            <div class="embla__viewport container">
                <div class="embla__container">
								
					<?php
					$postcounter = 0;
					foreach(x_select("0","writepost","status='1' AND cat='news'","10","id desc") as $key){
					$postcounter++;
					$ph = $key["user_photo"];$title = $key["title"];$full = $key["full"];$rt = $key["realtime"];$tk = $key["token"];
					?>
						<div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img" style="height:300px;overflow-y:hidden;border:3px solid aqua;">
                                    <img src="<?php
									if($ph == ""){
										?>assets/images/new2.png<?php
									}else{
										echo "dash/fpine/".$ph;
									}
									?>" alt="News Update">
                                </div>
                            </div>
                            <div class="item-content">
                                <h5 class="item-title mbr-fonts-style display-7" title="<?php echo $title;?>">
								<strong><?php echo x_trunc($title,0,26);?></strong></h5>
                                
                                <p class="mbr-text mbr-fonts-style mt-3 display-7">
								<?php echo x_trunc($full,0,125);?>
								</p>
                            </div>
							<div class="mbr-section-btn item-footer mt-2">
							<?php
								if($postcounter%2 == 0){
									?>
									<a href="FullPostReader?token=<?php echo $tk; ?>" class="btn btn-success item-btn display-7" target="_blank">More >></a>
									<?php
								}else{
									?>
									<a href="FullPostReader?token=<?php echo $tk; ?>" class="btn btn-primary item-btn display-7" target="_blank">More >></a>
									<?php
								}
							?>
                            </div>
                        </div>
                    </div>
					<?php
					}
					?>
	                </div>
            </div>
            <button class="embla__button embla__button--prev">
                <span class="mobi-mbri mobi-mbri-arrow-prev mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Previous</span>
            </button>
            <button class="embla__button embla__button--next">
                <span class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>				
					<?php
				}?>
                   
<?php
}
?>