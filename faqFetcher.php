<?php
if(isset($pageToken)){
?>

				<?php
				if(x_count("faqdata","status='active' LIMIT 1") > 0){
					?>
	<section data-bs-version="5.1" class="content16 cid-t7ZMFv11Bw" id="content16-p">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="mbr-section-head align-center mb-4">
                    <h3 class="mbr-section-title mb-0 mbr-fonts-style display-2"><strong>&nbsp;Customers FAQ</strong></h3>
                    
                </div>
                <div id="bootstrap-accordion_10" class="panel-group accordionStyles accordion" role="tablist" aria-multiselectable="true">				
					<?php
					$postcounter = 0;
					foreach(x_select("0","faqdata","status='active'","10","id desc") as $key){
					$postcounter++;
					$id = $key["id"];
					$title = $key["title"];
					$desc = $key["description"];
					?>
					  <div class="card mb-3">
                        <div class="card-header" role="tab" id="headingOne<?php echo $id;?>">
                            <a role="button" class="panel-title collapsed" data-toggle="collapse" data-bs-toggle="collapse" data-core="" href="#collapse1_10<?php echo $id;?>" aria-expanded="false" aria-controls="collapse1">
                                <h6 class="panel-title-edit mbr-fonts-style mb-0 display-7"><strong><?php echo strtoupper($title);?></strong>
                                </h6>
                                <span class="sign mbr-iconfont mbri-arrow-down"></span>
                            </a>
                        </div>
                        <div id="collapse1_10<?php echo $id;?>" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingOne<?php echo $id;?>" data-parent="#accordion" data-bs-parent="#bootstrap-accordion_10">
                            <div class="panel-body">
                                <p class="mbr-fonts-style panel-text display-4"><?php echo $desc;?></p>
                            </div>
                        </div>
                    </div>
					<?php
					}
					?>
	
                </div>
            </div>
        </div>
    </div>
</section>				
					<?php
				}
					?>
               
     


<?php
}?>
