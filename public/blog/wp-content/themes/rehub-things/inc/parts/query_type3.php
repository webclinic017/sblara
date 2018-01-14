<article class="small_post<?php if(is_sticky()) {echo " sticky";} ?>">
    <div class="top">
        <div class="cats_def">
            <?php
            $categories = get_the_category();
            $separator = '';
            $output = '';
            if($categories){
                foreach($categories as $category) {
                	$cat_id = $category->term_id;
                	$cat_data = get_option("category_$cat_id");
                    $output .= '<a href="'.get_category_link( $category->term_id ).'" class="cat-'.$cat_id.'"';
                    if (!empty($cat_data['cat_color'])) {
                    	$output .= ' style="color: '.$cat_data["cat_color"].' !important; "';
                    }
                	$output .='>'.$category->cat_name.'</a>'.$separator;
                }
            echo trim($output, $separator);
            }
            ?>
         </div>
        <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment_two', ''); ?><?php endif ;?>
    </div>
    <h2><?php if(is_sticky()) {echo "<i class='fa fa-thumb-tack'></i>";} ?><?php rehub_permalink() ;?><?php the_title();?></a></h2>
    <div class="post-meta"> <?php meta_all( true, false, true ); ?> </div>
    <?php rehub_format_score('small') ?>
    <?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'gallery') : ?>
    	<?php $gallery_images = vp_metabox('rehub_post.gallery_post.0.gallery_post_images'); ?>
        <?php $gallery_i=0; foreach ($gallery_images as $gallery_img) { $gallery_i++;} ;?>
		<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
              <figure class="slider_post">
                  <div class="pattern"></div>
                  <div class="caption"><?php rehub_permalink() ;?>+<?php echo $gallery_i; ?></a><i class="fa fa-camera"></i></div>
                  <?php rehub_formats_icons(); ?>
                  <?php echo getPostLikeLink( get_the_ID() );?>
                  <?php if( rehub_option( 'aq_resize') == 1 ) : ?>
                      <?php $img = get_post_thumb(); ?> 
                      <?php rehub_permalink() ;?><img src="<?php $params = array( 'width' => 300, 'height' => 200, 'crop' => true  ); echo bfi_thumb($img, $params); ?>" alt="<?php the_title(); ?>" /></a>
                  <?php else :?>    
                      <?php rehub_permalink() ;?><?php the_post_thumbnail('grid_news'); ?></a>
                  <?php endif ;?>
              </figure>                                     
		<?php } ?> 
    <?php elseif(vp_metabox('rehub_post.rehub_framework_post_type') == 'music') : ?>
        <?php if(vp_metabox('rehub_post.music_post.0.music_post_source') == 'music_post_soundcloud') : ?>
            <div class="music_soundcloud">
                <?php echo vp_metabox('rehub_post.music_post.0.music_post_soundcloud_embed'); ?>
            </div>       
        <?php elseif(vp_metabox('rehub_post.music_post.0.music_post_source') == 'music_post_spotify') : ?>
            <div class="music_spotify">
                <iframe src="https://embed.spotify.com/?uri=<?php echo vp_metabox('rehub_post.music_post.0.music_post_spotify_embed'); ?>" width="100%" height="80" frameborder="0" allowtransparency="true"></iframe>
            </div>
        <?php endif; ?>   
    <?php else : ?>   
        <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
                <figure>
                    <div class="pattern"></div>
                    <?php rehub_formats_icons('full'); ?>
                    <?php echo getPostLikeLink( get_the_ID() );?>
                    <?php rehub_permalink() ;?><?php wpsm_thumb ('grid_news') ?></a>
                </figure>                                     
        <?php } ?>   
    <?php endif; ?>
    <p><?php kama_excerpt('maxchar=250'); ?></p>
    <?php rehub_create_btn('yes') ;?>
</article>