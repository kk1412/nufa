
        <!-- Start Left Section -->
        <div class="leftsection">
			<?php foreach($historys as $history): ?>
        	<!-- Start Blog Post -->
        	<div class="blogwrapstart">
            
            	<div class="blogtitle"><h3><a href="" title="<?php echo $history->name_content; ?>"><?php echo $history->name_content; ?></a></h3></div>
                
                <div class="blogbody">
                    <!-- End Blog Information -->
                    <!-- Start Blog Text -->
                    <div class="blogtext">
                    
                    	<?php echo $history->desc_content; ?>
                    
                    </div>
                	<!-- End Blog Text -->
                </div>
            
            </div>
            <!-- End Blog Post -->
            <?php endforeach; ?>
        	<!-- Start Blog Post -->
        
        </div>
        <!-- End Left Section -->
    