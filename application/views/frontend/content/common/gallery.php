  <!--/////////////////////////BEGINNING contentWrapper///////////////////-->
	<div id="contentWrapper"><!--beginning contentWrapper-->
		<!--/////////////////// BEGINNING SECTION ITEM-CONTAINER-BLOG /////////////////-->
		<section id="item-container-blog"><!--beginning item-container-blog-->
		<h3 class="title-three-5"><span><?php echo $this->uri->segment(2) . " "; ?></span></h3> 
		
			<!--|||||||||||||||||||||||BEGINNING ITEM-CONTENT-BLOG|||||||||||||||||||||||||||-->
			
			<article class="item-content-blog"><!--beginning item-content-blog--> 
		  
	      
		  
				<div class="holder" style="float:right"></div><br/><br/><br/><br/>
				<!--///////////////////////////////BEGINNING POST WITH PHOTO//////////////////////////////////////-->
				<ul id="itemContainer">
					<?php $i = 0;foreach($gallerys as $gallery) { ?>
					<li>
						<div class="photos-blog"><!--beginning photos-blog--> 
							<?php echo anchor("$controller/".$this->uri->segment(2)."/$gallery->id_content", '<span class=""></span><img src="'. $dir_uploads.$gallery->picture_content .'" style="width:650px;height:300px;margin-bottom:20px;" alt="">'); ?>
							<div class="intro-text-blog"><!--beginning intro-text-blog-->
							  
<!-- 							  <?php echo anchor("$controller/".$this->uri->segment(2)."/$gallery->id_content", '<h3 class="title-three-4"><span>'.$gallery->name_content.' </span></h3>'); ?> -->
							  
								<p class="doc-post"> 
									<span class="time-post"><img src="<?=$dir_images?>calendar_alt_fill_16x16.png" alt=""> </span> 
									<span class="admin-post">
										<?php echo ($gallery->gender != 0 || $gallery->gender == null)? '<img src="'.$dir_images.'user_12x16_grey.png" alt="">' : '<img src="'.$dir_images.'user-woman_12x14_grey.png" alt="">';?> 
										<?php echo anchor("$controller/".$this->uri->segment(2)."/$gallery->id_content", ($gallery->id_user ==null)?"Admin":$gallery->full_name); ?>
									</span> 
									<span class="comment-post"><img src="<?=$dir_images?>comment_stroke_16x14.png" alt=""> </span> 
									<span class="category-post"><img src="<?=$dir_images?>tag_fill_16x16.png" alt=""> 
									</span> 
								</p>
								<p>
								<?php 
									$data['pictures'] = $this->mdl_picture->id_content_records($gallery->id_content)->result(); 
									$i = 0;
									foreach($data['pictures'] as $picture):
										if($i!=0)break;
											echo anchor("$controller/gallery/picture/$gallery->id_content", "<img src=\"$dir_uploads_thumbs".$this->method->getImage($picture->name_picture)."\" alt=\"hasdffffffffffffffffha\"/><br />");
										$i++;
									endforeach;
								?>
								</p>
							  
							<p></p>
							  
							<div class="separator-post"></div>  
						  
						</div>
						<!--end intro-text-blog-->
					</li>
					<?php } ?>
				</ul>
				<!--//////////////////////////////////////END POST WITH PHOTO//////////////////////////////////////-->
				<!--end intro-text-blog-->
				<div class="holder" style="float:right"></div>
			</article>
		<!--end item-container-blog--> 
		
	<!--||||||||||||||||||||||||||||END ITEM-CONTENT-BLOG|||||||||||||||||||||||||||||||||--> 



					<?php $i = 0;foreach($gallerys as $gallery) { ?>
						<div>
							<?php 
								$data['pictures'] = $this->mdl_picture->id_content_records($gallery->id_content)->result(); 
								$i = 0;
								foreach($data['pictures'] as $picture):
								if($i!=0)break;
								echo anchor("$controller/gallery/picture/$gallery->id_content", "<img src=\"$dir_uploads_thumbs$picture->name_picture\" alt=\"haha\"/><br />");
								$i++;
								endforeach;
								echo anchor("$controller/gallery/picture/$gallery->id_content", "$gallery->name_content");
							?>
						</div>
					<?php } ?>