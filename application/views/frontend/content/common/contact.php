<div id="main">
    <!-- Start H1 Title -->
    <div class="titlesnormal">
    
    	<h1>contact response</h1>
        
        <span></span>
    
    </div>
    <!-- End H1 Title -->
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">
        
        <!-- Start Left Section -->
        <div class="leftsection">

            <!-- Start Google Maps -->
        	<div class="blogwrapstart">
            
            	<div id="map_canvas">disini</div>
                <span class="box-arrow"></span>
            
            </div>
            <!-- End Google Maps -->
        
        </div>
        <!-- End Left Section -->
        
        <!-- Start Right Section -->
        <div class="rightsection">
            
        	<!-- Start Blog Widget -->
            <div class="blogwidgetstart">
            	<!-- Start Categories Widget -->
            	<div class="widgettitle"><h4>Contact Details</h4></div>
                
                <div class="widgetbody">
                
                	<div class="blogcategories">
                    
                    	<div class="contactdetails">
                    
						<?php
							foreach($our_contacts as $our_contact):
						?>
                            <p><?php echo $our_contact->email_comment; ?></p>
                            <p><?php echo $our_contact->phone_comment; ?></p>
                            <p><?php echo $our_contact->desc_comment; ?></p>
						<?php
							endforeach;
						?>
                            
                        </div>
                    
                    </div>
                
              </div>
              <!-- End Categories Widget -->
              <span class="box-arrow"></span>
            
            </div>
            <!-- End Blog Widget -->
        
        </div>
        <!-- End Right Section -->
        
        <!-- Start Full Width -->
        <div class="boxes-full">
        
            <div class="contacttitle">
            
                <h2>Contact <?php echo $_org; ?></h2>
            
            </div>
        
        	<div class="boxes-padding fullpadding">
            
            <div id="contactwarning"></div>
            <div id="contactajax"></div>
            
            <form action="" method="post" name="ajaxcontactform" id="ajaxcontactform">
            
            	<div class="contacttextarea">
                	<input name="id_content" type="hidden" value="0" />
                
                	<fieldset>
                    	<textarea name="desc_comment" cols="5" rows="5" class="contacttextarea"><?php echo (set_value('desc_comment'))?set_value('desc_comment'):""; ?></textarea><br/>
                    	<?php if(form_error('desc_comment') != null) echo "<span class=\"error-contact-textarea\"> " . form_error('desc_comment') . " </span>"; ?>
					</fieldset>
                
                </div>
                
                <div class="contacttextboxes">
                
					<?php
						if($this->session->userdata('is_login_front') == TRUE) {
							echo "<input type=\"hidden\" name=\"author_comment\" value=\"" . $this->session->userdata('full_name_front') . "\"/>";
							echo "<input type=\"hidden\" name=\"email_comment\" value=\"" . $this->session->userdata('email_front') . "\"/>";
							echo "<input type=\"hidden\" name=\"id_user\" value=\"" . $this->session->userdata('id_user_front'). "\"/>";
						}
						else {
					?>
                	<fieldset>
                    	<input name="author_comment" type="text" placeholder="Please Insert Your Name" class="contacttextform" value="<?php echo (set_value('author_comment'))?set_value('author_comment'):""; ?>">
                    	<?php if(form_error('author_comment') != null) echo "<span class=\"error-contact\"> " . form_error('author_comment') . " </span>"; ?>
					</fieldset>
                    
                	<fieldset>
                    	<input name="email_comment" type="text" placeholder="Please Insert Your Email" class="contacttextform" value="<?php echo (set_value('email_comment'))?set_value('email_comment'):""; ?>">
                    	<?php if(form_error('email_comment') != null) echo "<span class=\"error-contact\"> " . form_error('email_comment') . " </span>"; ?>
					</fieldset>
					<?php
						}
					?>
                	<fieldset>
                    	<input name="phone_comment" type="text" placeholder="Please Insert Your Phone" class="contacttextform" value="<?php echo (set_value('phone_comment'))?set_value('phone_comment'):""; ?>">
                    	<?php if(form_error('phone_comment') != null) echo "<span class=\"error-contact\"> " . form_error('phone_comment') . " </span>"; ?>
					</fieldset>
                    
                	<fieldset>
                    	<input name="do" type="submit" class="contactformbutton" value="Send" style="cursor:pointer;">
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
