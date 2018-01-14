<article class="stream_title clearfix<?php if(is_sticky()) {echo " sticky";} ?>">
    <div class="top"><?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment_two', ''); ?><?php endif ;?></div>
    <?php $category = get_the_category(); if ($category) {$first_cat = $category[0]->term_id;} ?>
    <div class="post-meta"> <?php if ($category) {meta_all( true, $first_cat, true );} ?> </div>
    <h2><?php if(is_sticky()) {echo "<i class='fa fa-thumb-tack'></i>";} ?><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php rehub_format_score('small') ?>
    <?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'gallery') : ?>
        <?php  wp_enqueue_script('flexslider'); ?>
        <?php $gallery_images = vp_metabox('rehub_post.gallery_post.0.gallery_post_images'); ?>
        <div class="post_slider blog_slider loading">
            <?php $gallery_i=0; foreach ($gallery_images as $gallery_img) { $gallery_i++;}; $gallery_i = $gallery_i-3; ;?>
            <?php if ($gallery_i > 0) :?>
                <div class="caption"><a href="<?php the_permalink();?>">+<?php echo $gallery_i; ?></a><i class="fa fa-camera"></i></div>
            <?php endif ;?>        
            <ul class="slides">              
                <?php $gallery_count=1;
                    foreach ($gallery_images as $gallery_img) {
                ?>
                    <?php if ($gallery_count <= '3'):?>
                        <li>
                            <img src="<?php $params = array( 'width' => 765, 'height' => 478 ); echo bfi_thumb($gallery_img['gallery_post_image'], $params); ?>" />
                        </li>                                                
                    <?php endif ;?>
                <?php
                $gallery_count++;
                    }
                ?>
            </ul>           
        </div>
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
               <figure><div class="pattern"></div><?php rehub_formats_icons('full'); ?><?php the_post_thumbnail(); ?></figure>                                     
        <?php } ?>  
    <?php endif; ?>    
    <?php the_content(''); ?>
    <?php rehub_create_btn('yes') ;?>
<div class="post_share blog_end"></div>
</article>