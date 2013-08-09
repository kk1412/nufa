<div id="main">
    <!-- Start Main Body Wrap -->
    <div id="main-wrap">
        
        <!-- Start Full Width -->
        <div class="boxes-full">
        
            <div class="contacttitle">
            
                <h2>Gallery</h2>
            
            </div>
        
        	<div class="boxes-padding fullpadding">
                
                <div class="common-content">				
					<fieldset class="form-horizontal">			
						<?php
							foreach($gallerys as $gallery) :
						?>
						<ul class="thumbnails">
							<?php foreach($pictures as $picture) { ?>
							<li id="image-<?php echo $picture->name_picture; ?>" class="thumbnail">
								<a style="background:url(<?php echo $uploads; ?>/thumbs/thumb_<?php echo $picture->name_picture; ?>)" title="<?php echo $picture->name_picture; ?>" href="<?php echo $uploads ?>/<?php echo $picture->name_picture; ?>">
									<img class="grayscale" src="<?php echo $upload ?>/thumbs/thumb_<?php echo $picture->name_picture; ?>" />
								</a>
							</li>
							<?php } ?>
						</ul>
				<?php
					endforeach;
				?>
				</fieldset>
	
                </div>
            
            </div>
            
            <span class="box-arrow"></span>
            
        </div>
        <!-- End Full Width -->
        
    </div>
    <!-- End Main Body Wrap -->
	
	
	
	
	
			
        	<!-- Start Blog Post -->
        	<div class="blogwrap">
            
            	<div class="blogcommenttitle"><h3><?php echo ($count_comments == 1)?$count_comments . " Comment":$count_comments . " Comments"; ?></h3></div>
                <span class="box-arrow"></span>
            
            </div>
            <!-- End Blog Post -->
            <!-- Start Blog Comments -->
			<?php
				foreach($comments as $comment):
			?>
            <div class="blogcomment">
			  
				<?php echo ($comment->parent_comment != 0)?"<div class=\"blogcommentreply\">":""?>
            
					<div class="blogwcommentwrap">
					
						<div class="commenttitle">
						
							<p><span class="avatarname"><?php echo $comment->author_comment; ?></span> <span class="avatardate">On: <span class="avatardateorange"><?php echo $this->method->dateFromDatabaseText($comment->cd_comment); ?></span></span><span class="avatarreply"><a href="<?php echo base_url() . "$controller/gallery/picture/$id_content/$comment->id_comment" . $url_suffix; ?>#comment" title="Reply">Reply</a></span></p>
						
						</div>
						
						<div class="<?php echo ($comment->parent_comment != 0)?"commentuserreply":"commentuser"?>"><img src="<?php echo $thumb_image . $this->method->getImage($comment->picture_user); ?>" alt="<?php echo $comment->full_name; ?>" width="80px" height="80px" /></div>
						
						<div class="<?php echo ($comment->parent_comment != 0)?"commenttextreply":"commenttext"?>">
						
							<p style="margin:0% -<?php echo ($comment->parent_comment != 0)?"":"19"?>%" >
								<?php 
									$parent_comments = $this->mdl_comment->record($comment->parent_comment)->result();
									foreach($parent_comments as $parent_comment):
								?>
										<div class="contentreply">
											Posted by : <?php echo $parent_comment->author_comment; ?> <span class="avatardateorange" style="float:right;"><?php echo $this->method->dateFromDatabaseText($parent_comment->cd_comment); ?></span><br />
											<i><?php echo $parent_comment->desc_comment; ?></i>
										</div><br />
								<?php
									endforeach;
								?>
								<?php echo $comment->desc_comment; ?>
								
							</p>
						
						</div>
						
						<span class="box-arrow"></span>
                
					<?php echo ($comment->parent_comment != 0)?"</div>":""?>
					
                </div>
            
            </div>
			<?php
				endforeach;
			?>
            <!-- End Blog Comments -->
            <!-- Start Comment Form -->
            <div class="blogcomment" id="comment">
            
           	  <div class="blogwcommentwrap2">
              
              	<div class="blogcommentform">
				
					<form action="" method="post" name="ajaxcontactform" id="ajaxcontactform">
            
						<div class="contacttextarea" style="margin-left:2%;">
						
							<input name="id_content" type="hidden" value="<?php echo $id_content; ?>" />
						
							<?php
								if($this->session->userdata('is_login_front') == TRUE) {
									echo "<input type=\"hidden\" name=\"author_comment\" value=\"" . $this->session->userdata('full_name_front') . "\"/>";
									echo "<input type=\"hidden\" name=\"email_comment\" value=\"" . $this->session->userdata('email_front') . "\"/>";
									echo "<input type=\"hidden\" name=\"id_user\" value=\"" . $this->session->userdata('id_user_front'). "\"/>";
								}
								else {
							?>
							<input type="hidden" name="id_user" value="0" />
							<fieldset>
								<input name="author_comment" type="text" class="commenttextform" placeholder="Please Insert Your Name" value="<?php echo (set_value('author_comment'))?set_value('author_comment'):""; ?>">
								<?php if(form_error('author_comment') != null) echo "<span class=\"help-inline\"> " . form_error('author_comment') . " </span>"; ?>
							</fieldset>
							<fieldset>
								<input name="email_comment" type="email" class="commenttextform" placeholder="Please Insert Your Email" value="<?php echo (set_value('email_comment'))?set_value('email_comment'):""; ?>">
								<?php if(form_error('email_comment') != null) echo "<span class=\"help-inline\"> " . form_error('email_comment') . " </span>"; ?>
							</fieldset>
							<?php
								}
							?>
							<fieldset>
								<textarea style="width:150%;height:150%" name="desc_comment" cols="10" rows="12"><?php echo (set_value('desc_comment'))?set_value('desc_comment'):""; ?></textarea>
								<?php if(form_error('desc_comment') != null) echo "<span class=\"help-inline\"> " . form_error('desc_comment') . " </span>"; ?>
							</fieldset>
							<fieldset>
								<input style="margin:5% -52% 0%;cursor:pointer;" name="do" type="submit" class="contactformbutton" value="Send">
							</fieldset>
						
						</div>
                
					</form>
            
                </div>
              
              	<span class="box-arrow"></span>
              
              </div>
            
            </div>
            <!-- End Comment Form -->
	
	
	

</div>
