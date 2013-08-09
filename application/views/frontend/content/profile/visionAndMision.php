
        <!-- Start Left Section -->
        <div class="leftsection">
			<?php foreach($visionAndMissions as $visionAndMission): ?>
        	<!-- Start Blog Post -->
        	<div class="blogwrapstart">
            
            	<div class="blogtitle"><h3><a href="" title="<?php echo $visionAndMission->name_content; ?>"><?php echo $visionAndMission->name_content; ?></a></h3></div>
                
                <div class="blogbody">
                    <!-- End Blog Information -->
                    <!-- Start Blog Text -->
                    <div class="blogtext">
                    
                    	<?php echo $visionAndMission->desc_content; ?>
                    
                    </div>
                	<!-- End Blog Text -->
                </div>
            
            </div>
            <!-- End Blog Post -->
            <?php endforeach; ?>
        	<!-- Start Blog Post -->
        
        </div>
        <!-- End Left Section -->
    