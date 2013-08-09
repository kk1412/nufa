<div id="main">
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">
        
        
        <!-- Start Full Width -->
        <div class="boxes-full">
        
            <div class="contacttitle">
            
                <h2>Rubah Password></h2>
            
            </div>
        
        	<div class="boxes-padding fullpadding">
            
            <div id="contactwarning"></div>
            <div id="contactajax"></div>
            
            <form action="" method="post" name="ajaxcontactform" id="ajaxcontactform">
                
                <div class="change-password">
					<?php
						foreach($student_record as $student):
					?>
					<input type="hidden" name="current_password" value="<?php echo $this->encrypt->decode($student->password); ?>" />
					<?php
						endforeach;
					?>
                	<fieldset>
                    	<input name="old_password" type="password" placeholder="Kata Sandi Lama" class="contacttextform" value="<?php echo (set_value('old_password'))?set_value('old_password'):""; ?>">
                    	<?php if(form_error('old_password') != null) echo "<span class=\"error-contact\"> " . form_error('old_password') . " </span>"; ?>
					</fieldset>
				
                	<fieldset>
                    	<input name="password" type="password" placeholder="Kata Sandi Baru" class="contacttextform" value="<?php echo (set_value('password'))?set_value('password'):""; ?>">
                    	<?php if(form_error('password') != null) echo "<span class=\"error-contact\"> " . form_error('password') . " </span>"; ?>
					</fieldset>
				
                	<fieldset>
                    	<input name="repeat_password" type="password" placeholder="Ulangi Kata Sandi" class="contacttextform" value="<?php echo (set_value('repeat_password'))?set_value('repeat_password'):""; ?>">
                    	<?php if(form_error('repeat_password') != null) echo "<span class=\"error-contact\"> " . form_error('repeat_password') . " </span>"; ?>
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
