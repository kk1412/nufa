<div id="main">
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">
        
        
        <!-- Start Full Width -->
        <div class="boxes-full">
        
            <div class="contacttitle">
            
                <h2>Ubah Foto</h2>
            
            </div>
        
        	<div class="boxes-padding fullpadding">
            
            <div id="contactwarning"></div>
            <div id="contactajax"></div>
            
            <form action="" method="post" name="ajaxcontactform" id="ajaxcontactform" enctype="multipart/form-data">
                
                <div class="change-password">
                	<fieldset>
						<input type="file" name="userfile" />
						<?php if($errorImage != null) echo "<span class=\"help-inline\"> " . $errorImage . " </span>"; ?>
					</fieldset>
                    
                	<fieldset>
                    	<input name="do" type="submit" class="contactformbutton" value="Perbaharui" style="cursor:pointer;">
                    </fieldset>
                
                </div>
				
            </form>
            
            </div>
            
            <span class="box-arrow"></span>
            
        </div>
        <!-- End Full Width -->
        
    </div>
    <!-- End Main Body Wrap -->

</div>
