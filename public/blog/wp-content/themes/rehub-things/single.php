<?php get_header(); ?>

    <!-- CONTENT -->
    <div class="content"<?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review') : ?> itemtype="http://schema.org/Review" itemscope="" itemprop="review"<?php endif; ?>> 
		<div class="clearfix">
		    <!-- Main Side -->
            <div class="main-side single<?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?> full_width<?php endif; ?> clearfix">            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="post <?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id; echo 'category-'.$first_cat.'';?>" id="post-<?php the_ID(); ?>">
                    <!-- Title area -->
                    <div class="top_single_area">
                        <?php if ($category) {meta_small( false, $first_cat, false, false );} ?>
                        <div itemtype="http://schema.org/Thing" itemscope="" itemprop="itemReviewed">                            
                            <h1 itemprop="name"><?php the_title(); ?></h1>
                        </div>                                
                        <div class="meta post-meta"> <?php meta_small( true, false, true, false ); ?> </div>
                    </div>
                    <?php if(rehub_option('rehub_single_after_title') && vp_metabox('rehub_post_side.show_banner_ads') != '1') : ?><div class="mediad mediad_top"><?php echo do_shortcode(rehub_option('rehub_single_after_title')); ?></div><div class="clearfix"></div><?php endif; ?>
                    <?php if(rehub_option('rehub_disable_share_top') =='1' || (vp_metabox('rehub_post_side.disable_parts') == '1' && vp_metabox('rehub_post_side.show_share_buttons') == '1'))  : ?>
                    <?php else :?>
                        <div class="top_share"><?php get_template_part('inc/parts/post_share'); ?></div>
                        <div class="clearfix"></div> 
                    <?php endif; ?>                	
                    <?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review' && vp_metabox('rehub_post.review_post.0.review_post_schema_type') == 'review_woo_product' && vp_metabox('rehub_post.review_post.0.review_woo_product.0.review_woo_slider') =='1') :?>
                		<?php  wp_enqueue_script('flexslider');   ?>
                		<?php $review_woo_link = vp_metabox('rehub_post.review_post.0.review_woo_product.0.review_woo_link'); $resizer = vp_metabox('rehub_post.review_post.0.review_woo_product.0.review_woo_slider_resize'); ?>
            		    <?php 	
							$args = array(
								'post_type' => 'product',
								'posts_per_page' => 1,
								'no_found_rows' => 1,
								'post_status' => 'publish',
								'p'	=> $review_woo_link,

							);
						?>
						<?php $products = new WP_Query( $args ); if ( $products->have_posts() ) : ?>                      
							<?php while ( $products->have_posts() ) : $products->the_post(); global $product?>
								<?php $gallery_images = $product->get_gallery_attachment_ids(); ?>
								<?php if ( $gallery_images ) { ?>
									<div class="post_slider media_slider<?php if ($resizer =='1') :?> blog_slider<?php else :?> gallery_top_slider<?php endif ;?> loading">	
										<ul class="slides">
										<?php if ( has_post_thumbnail($post->ID) ) :?>
											<?php $image_woo_id = get_post_thumbnail_id($post->ID);  $image_woo_url = wp_get_attachment_url($image_woo_id); ?>
											<?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
												<li data-thumb="<?php $params = array( 'width' => 116, 'height' => 116, 'crop' => true  ); echo bfi_thumb($image_woo_url, $params); ?>">
													<img src="<?php if ($resizer =='1') {$params = array( 'width' => 1130);} else {$params = array( 'width' => 1130, 'height' => 604, 'crop' => true    );}; echo bfi_thumb($image_woo_url, $params); ?>" />
												</li>                                                
											<?php else : ?>
												<li data-thumb="<?php $params = array( 'width' => 80, 'height' => 80, 'crop' => true  ); echo bfi_thumb($image_woo_url, $params); ?>">
													<img src="<?php if ($resizer =='1') {$params = array( 'width' => 765);} else {$params = array( 'width' => 765, 'height' => 478, 'crop' => true    );}; echo bfi_thumb($image_woo_url, $params); ?>" />
												</li>                                                
											<?php endif; ?>	
										<?php endif ;?>													
										<?php 
											foreach ($gallery_images as $gallery_img) {
										?>
										<?php $thumbimg = wp_get_attachment_url($gallery_img);?>
											<?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
												<li data-thumb="<?php $params = array( 'width' => 116, 'height' => 116, 'crop' => true  ); echo bfi_thumb($thumbimg, $params); ?>">
													<img src="<?php if ($resizer =='1') {$params = array( 'width' => 1130);} else {$params = array( 'width' => 1130, 'height' => 604, 'crop' => true    );}; echo bfi_thumb($thumbimg, $params); ?>" />
												</li>                                                
											<?php else : ?>
												<li data-thumb="<?php $params = array( 'width' => 80, 'height' => 80, 'crop' => true  ); echo bfi_thumb($thumbimg, $params); ?>">
													<img src="<?php if ($resizer =='1') {$params = array( 'width' => 765);} else {$params = array( 'width' => 765, 'height' => 478, 'crop' => true    );}; echo bfi_thumb($thumbimg, $params); ?>" />
												</li>                                                
											<?php endif; ?>
										<?php
											}
										?>
										</ul>
									</div> 
								<?php } ?>
						<?php endwhile; endif;  wp_reset_postdata(); ?> 

                	<?php elseif(vp_metabox('rehub_post.rehub_framework_post_type') == 'review' && vp_metabox('rehub_post.review_post.0.rehub_review_slider') =='1') :?>

						<?php  wp_enqueue_script('flexslider'); ?>
						<?php $gallery_images = vp_metabox('rehub_post.review_post.0.rehub_review_slider_images'); $resizer = vp_metabox('rehub_post.review_post.0.rehub_review_slider_resize'); ?>
						<div class="post_slider media_slider<?php if ($resizer =='1') :?> blog_slider<?php else :?> gallery_top_slider<?php endif ;?> loading"><?php echo getPostLikeLink( get_the_ID() );?>
							<ul class="slides">		<script src="http://a.vimeocdn.com/js/froogaloop2.min.js"></script>
								<?php 
									foreach ($gallery_images as $gallery_img) {
								?>
									<?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?>
                                        <?php if (!empty ($gallery_img['review_post_video'])) :?>
                                            <li data-thumb="<?php echo parse_video_url($gallery_img['review_post_video'], 'hqthumb'); ?>" class="play3">
                                                <?php echo parse_video_url($gallery_img['review_post_video'], 'embed', '1130', '604');?>
                                            </li>                                            
                                        <?php else : ?>
                                            <li data-thumb="<?php $params = array( 'width' => 116, 'height' => 116, 'crop' => true  ); echo bfi_thumb($gallery_img['review_post_image'], $params); ?>">
                                                <?php if (!empty ($gallery_img['review_post_image_caption'])) :?><div class="bigcaption"><?php echo $gallery_img['review_post_image_caption']; ?></div><?php endif;?>
                                                <img src="<?php if ($resizer =='1') {$params = array( 'width' => 1130);} else {$params = array( 'width' => 1130, 'height' => 604, 'crop' => true    );}; echo bfi_thumb($gallery_img['review_post_image'], $params); ?>" />
                                            </li>                                           
                                        <?php endif; ?>                                                                                       
									<?php else : ?>
                                        <?php if (!empty ($gallery_img['review_post_video'])) :?>
                                            <li data-thumb="<?php echo parse_video_url($gallery_img['review_post_video'], 'hqthumb'); ?>" class="play3">
                                                <?php echo parse_video_url($gallery_img['review_post_video'], 'embed', '765', '478');?>
                                            </li>                                            
                                        <?php else : ?>
                                            <li data-thumb="<?php $params = array( 'width' => 80, 'height' => 80, 'crop' => true  ); echo bfi_thumb($gallery_img['review_post_image'], $params); ?>">
                                                <?php if (!empty ($gallery_img['review_post_image_caption'])) :?><div class="bigcaption"><?php echo $gallery_img['review_post_image_caption']; ?></div><?php endif;?>
                                                <img src="<?php if ($resizer =='1') {$params = array( 'width' => 765);} else {$params = array( 'width' => 765, 'height' => 478, 'crop' => true    );};echo bfi_thumb($gallery_img['review_post_image'], $params); ?>" />
                                            </li>                                            
                                        <?php endif; ?>                                                                                            
									<?php endif; ?>
								<?php
									}
								?>
							</ul>
						</div>                        

                    <?php else :?> 

                    	<?php get_template_part('inc/parts/top_image'); ?>

                    <?php endif; ?>

                    <?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'music') : ?>

                        <?php if(vp_metabox('rehub_post.music_post.0.music_post_source') == 'music_post_soundcloud') : ?>
                            <div class="music_soundcloud">
                                <?php echo vp_metabox('rehub_post.music_post.0.music_post_soundcloud_embed'); ?>
                            </div>
                        
                        <?php elseif(vp_metabox('rehub_post.music_post.0.music_post_source') == 'music_post_spotify') : ?>
                            <div class="music_spotify">
                                <iframe src="https://embed.spotify.com/?uri=<?php echo vp_metabox('rehub_post.music_post.0.music_post_spotify_embed'); ?>" width="100%" height="80" frameborder="0" allowtransparency="true"></iframe>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if(rehub_option('rehub_single_before_post') && vp_metabox('rehub_post_side.show_banner_ads') != '1') : ?><div class="mediad mediad_before_content"><?php echo do_shortcode(rehub_option('rehub_single_before_post')); ?></div><?php endif; ?>

                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'rehub_child' ), 'after' => '</div>' ) ); ?>

                    <?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review') :?> 
                    
                        <?php if(vp_metabox('rehub_post.review_post.0.review_post_product.0.review_post_offer_shortcode') == '0' && vp_metabox('rehub_post.review_post.0.review_post_schema_type') == 'review_post_review_product') : ?>

                            <div class="lined_r_title"><?php _e('Where to buy', 'rehub_child') ;?></div>
                            <?php rehub_get_offer();?>

                        <?php endif ;?>   

                        <?php if(vp_metabox('rehub_post.review_post.0.review_aff_product.0.review_aff_offer_shortcode') == '0' && vp_metabox('rehub_post.review_post.0.review_post_schema_type') == 'review_aff_product') : ?>

                            <div class="lined_r_title"><?php _e('Where to buy', 'rehub_child') ;?></div>
                            <?php rehub_get_aff_offer();?>

                        <?php endif ;?>  

                        <?php if(vp_metabox('rehub_post.review_post.0.review_woo_product.0.review_woo_offer_shortcode') == '0' && vp_metabox('rehub_post.review_post.0.review_post_schema_type') == 'review_woo_product') : ?>
                        	<?php $review_woo_link = vp_metabox('rehub_post.review_post.0.review_woo_product.0.review_woo_link');?>
                            <div class="lined_r_title"><?php _e('Where to buy', 'rehub_child') ;?></div>
                            <?php rehub_get_woo_offer($review_woo_link);?>

                        <?php endif ;?>  

                        <?php if(vp_metabox('rehub_post.review_post.0.review_woo_list.0.review_woo_list_shortcode') == '0' && vp_metabox('rehub_post.review_post.0.review_post_schema_type') == 'review_woo_list') : ?>
                            <?php 
                            $review_woo_list_links = vp_metabox('rehub_post.review_post.0.review_woo_list.0.review_woo_list_links');
                            $review_woo_list_links = implode(',', $review_woo_list_links);?>
                            <div class="lined_r_title"><?php _e('Where to buy', 'rehub_child') ;?></div>
                            <?php rehub_get_woo_list($data_source = 'ids', $type ='', $cat = '', $tag = '', $ids = $review_woo_list_links);?>

                        <?php endif ;?>                                                    
					
					<?php endif ;?>  

                    <?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review' && vp_metabox('rehub_post.review_post.0.review_post_product_shortcode') == '0') :?>                        
                        <?php $overal_score = rehub_get_overall_score(); $postAverage = get_post_meta(get_the_ID(), 'post_user_average', true); ?>
                        <?php if ((rehub_option('type_user_review') == 'full_review') && ($postAverage !='0' && $postAverage !='' )) :?>                            
                            <div class="lined_r_title"><?php _e('Review Score', 'rehub_child'); ?></div>
                        <?php elseif ($overal_score !='0' && $overal_score !=''):?>
                            <div class="lined_r_title"><?php _e('Review Score', 'rehub_child'); ?></div>
                        <?php endif ;?>
                        <?php rehub_get_review();?>

                    <?php endif ;?>

                    <?php if ( get_the_author_meta( 'google' ) ){ ?>
                        <div class="vcard author disauthor" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><a href="<?php the_author_meta( 'google' ); ?>?rel=author">+<?php echo get_the_author(); ?></a></strong></div>
                    <?php }else{ ?>
                        <div class="vcard author disauthor" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong></div>
                    <?php } ?>                                              
                
                </article>

                <div class="clearfix"></div>
                <?php  if(vp_metabox('rehub_post_side.is_editor_choice') == '1') :?><div class="ed_choice"><span><i class="fa fa-thumbs-o-up"></i> <?php _e('Editor\'s choice', 'rehub_child') ;?> <?php the_time('Y'); ?></span></div><div class="clearfix"></div><?php endif; ?>
                <?php if(rehub_option('rehub_single_code') && vp_metabox('rehub_post_side.show_banner_ads') != '1') : ?><div class="single_custom_bottom"><?php echo do_shortcode (rehub_option('rehub_single_code')); ?></div><div class="clearfix"></div><?php endif; ?>
               
                <div class="bottom_meta">               
                    <div class="left_meta">
                        <?php if(rehub_option('rehub_disable_tags') =='1' || (vp_metabox('rehub_post_side.disable_parts') == '1' && vp_metabox('rehub_post_side.show_tags') == '1'))  : ?>
                        <?php else :?>
                            <span class="tags_meta"><?php the_tags('<i class="fa fa-tags"></i>',", "); ?></span>
                        <?php endif; ?>
                        <?php if(rehub_option('exclude_author_meta') != 1) : ?>
                            <span class="admin_meta"><i class="fa fa-pencil"></i><a class="admin" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>"><?php echo get_the_author() ?></a></span>
                        <?php endif; ?>
                        <span class="inline_like"><?php echo getPostLikeLink( get_the_ID() );?></span>                          
                    </div>                  
                    <div class="right_meta">  
                        <?php if(rehub_option('rehub_disable_share') =='1' || (vp_metabox('rehub_post_side.disable_parts') == '1' && vp_metabox('rehub_post_side.show_share_buttons') == '1'))  : ?>
                        <?php else :?>
                            <?php get_template_part('inc/parts/post_share'); ?>  
                        <?php endif; ?> 
                    </div>
                </div>
              

                <?php if(rehub_option('rehub_disable_relative') =='1' || (vp_metabox('rehub_post_side.disable_parts') == '1' && vp_metabox('rehub_post_side.show_related_posts') == '1'))  : ?>
                <?php else :?>
                    <?php get_template_part('inc/parts/related_posts'); ?>
                <?php endif; ?>                               

            <?php endwhile; endif; ?>

                <?php comments_template(); ?>

			</div>	
            <!-- /Main Side -->  

            <!-- Sidebar -->
            <?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?><?php else : ?><?php get_sidebar(); ?><?php endif; ?>
            <!-- /Sidebar --> 

        </div>
    </div>
    <!-- /CONTENT -->     

<!-- FOOTER -->
<?php get_footer(); ?>