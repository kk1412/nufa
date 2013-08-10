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
							<div class="intro-text-blog"><!--beginning intro-text-blog-->
							  
<!-- 							  <?php echo anchor("$controller/".$this->uri->segment(2)."/$gallery->id_content", '<h3 class="title-three-4"><span>'.$gallery->name_content.' </span></h3>'); ?> -->
							  
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