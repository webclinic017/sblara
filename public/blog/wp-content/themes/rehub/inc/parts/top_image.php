<?php if(vp_metabox('rehub_post_side.show_featured_image') == '1')  : ?>
<?php else : ?>
	<?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'video') : ?>		
		<?php $video_schema = vp_metabox('rehub_post.video_post.0.video_post_schema');?>
		<?php  if (($video_schema)=='1'): ?>
			<?php                                                                               
				$video_schema_title = vp_metabox('rehub_post.video_post.0.video_post_schema_title');
				$video_schema_desc = vp_metabox('rehub_post.video_post.0.video_post_schema_desc');
			?>
			<?php if(vp_metabox('rehub_post.video_post.0.video_post_embed_url') !='') : ?>	
				<?php                                                                               
					$video_url = vp_metabox('rehub_post.video_post.0.video_post_embed_url');
					$video_post_schema_thumb = vp_metabox('rehub_post.video_post.0.video_post_schema_thumb');
				?>
				<div class="media_video clearfix" itemprop="video" itemscope itemtype="http://schema.org/VideoObject">			
				<?php if(($video_post_schema_thumb) =='0' && (has_post_thumbnail())) : ?>
					<?php $image_id = get_post_thumbnail_id($post->ID);  $image_url = wp_get_attachment_url($image_id);?>
					<meta itemprop="thumbnail" content="<?php echo $image_url; ?>">
				<?php else :?>
					<meta itemprop="thumbnail" content="<?php echo parse_video_url($video_url, 'hqthumb');?>">    
				<?php endif ;?> 
					<div class="clearfix inner">
						<div class="video-container">
							<?php if (vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
								<?php echo parse_video_url($video_url, 'embed', '1068', '600');?>
							<?php else : ?>
								<?php echo parse_video_url($video_url, 'embed', '703', '395');?>
							<?php endif ;?> 
						</div>
						<h4 itemprop="name">
							<?php if (($video_schema_title) !='') :?>
								<?php echo $video_schema_title ;?>
							<?php else :?>
								<?php the_title(); ?>
							<?php endif ;?>    
						</h4>
						<p itemprop="description">
							<?php if (($video_schema_desc) !='') :?>
								<?php echo $video_schema_desc ;?>
							<?php else :?>
								<?php kama_excerpt('maxchar=250'); ?>
							<?php endif ;?>
						</p>
					</div>
				</div>
			<?php else : ?>		
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<?php if (vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
						<figure><?php the_post_thumbnail('full'); ?></figure>
					<?php else : ?>
						<figure><?php the_post_thumbnail(); ?></figure>
					<?php endif ;?>                                     
				<?php } ?>		
			<?php endif; ?>
		<?php else : ?>
			<?php if(vp_metabox('rehub_post.video_post.0.video_post_embed_url') !='') : ?>
				<?php $video_url = vp_metabox('rehub_post.video_post.0.video_post_embed_url');?>
                    <div class="video-container">
                        <?php if (vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
                            <?php echo parse_video_url($video_url, 'embed', '1130', '635');?>
                        <?php else : ?>
                            <?php echo parse_video_url($video_url, 'embed', '765', '430');?>
                        <?php endif ;?> 
                    </div>	
			<?php else : ?>		
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
					<?php if (vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
						<figure><?php the_post_thumbnail('full'); ?></figure>
					<?php else : ?>
						<figure><?php the_post_thumbnail(); ?></figure>
					<?php endif ;?>                                     
				<?php } ?>		
			<?php endif; ?>		
		<?php endif ?>									  
	<?php elseif(vp_metabox('rehub_post.rehub_framework_post_type') == 'gallery') : ?>
		<?php  wp_enqueue_script('flexslider');  ?>
		<?php $gallery_images = vp_metabox('rehub_post.gallery_post.0.gallery_post_images'); $resizer = vp_metabox('rehub_post.gallery_post.0.gallery_post_images_resize');?>
		<div class="post_slider media_slider<?php if ($resizer =='1') :?> blog_slider<?php else :?> gallery_top_slider<?php endif ;?> loading">	
			<ul class="slides">		
				<?php 
					foreach ($gallery_images as $gallery_img) {
				?>
					<?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
                        <?php if (!empty ($gallery_img['gallery_post_video'])) :?>
                            <li data-thumb="<?php echo parse_video_url($gallery_img['gallery_post_video'], 'hqthumb'); ?>" class="play3">
                                <?php echo parse_video_url($gallery_img['gallery_post_video'], 'embed', '1130', '604');?>
                            </li>                                            
                        <?php else : ?>
	 						<li data-thumb="<?php $params = array( 'width' => 116, 'height' => 116, 'crop' => true  ); echo bfi_thumb($gallery_img['gallery_post_image'], $params); ?>">
								<?php if (!empty ($gallery_img['gallery_post_image_caption'])) :?><div class="bigcaption"><?php echo $gallery_img['gallery_post_image_caption']; ?></div><?php endif;?>
								<img src="<?php if ($resizer =='1') {$params = array( 'width' => 1130);} else {$params = array( 'width' => 1130, 'height' => 604,  'crop' => true );}; echo bfi_thumb($gallery_img['gallery_post_image'], $params); ?>" />
							</li>                                           
                        <?php endif; ?>						                                               
					<?php else : ?>
                        <?php if (!empty ($gallery_img['gallery_post_video'])) :?>
                            <li data-thumb="<?php echo parse_video_url($gallery_img['gallery_post_video'], 'hqthumb'); ?>" class="play3">
                                <?php echo parse_video_url($gallery_img['gallery_post_video'], 'embed', '765', '478');?>
                            </li>                                            
                        <?php else : ?>
							<li data-thumb="<?php $params = array( 'width' => 80, 'height' => 80, 'crop' => true ); echo bfi_thumb($gallery_img['gallery_post_image'], $params); ?>">
								<?php if (!empty ($gallery_img['gallery_post_image_caption'])) :?><div class="bigcaption"><?php echo $gallery_img['gallery_post_image_caption']; ?></div><?php endif;?>
								<img src="<?php if ($resizer =='1') {$params = array( 'width' => 765);} else {$params = array( 'width' => 765, 'height' => 478, 'crop' => true   );}; echo bfi_thumb($gallery_img['gallery_post_image'], $params); ?>" />
							</li>                                            
                        <?php endif; ?> 						                                                
					<?php endif; ?>
				<?php
					}
				?>
			</ul>
		</div>
	<?php else : ?>
		<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) && rehub_option('rehub_disable_feature_thumb') !='1'  ) { ?>
			<figure class="top_featured_image"><?php the_post_thumbnail('full'); ?></figure>                                    
		<?php } ?>
	<?php endif; ?>                    
<?php endif; ?>