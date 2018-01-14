<article class="rething_item small_post inf_scr_item">
    <?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
        <figure>
            <?php rehub_formats_icons('full'); ?>
            <span class="pattern"></span>
            <?php echo getPostLikeLink( get_the_ID() );?>
            <?php rehub_permalink() ;?>
                <?php  $image_id = get_post_thumbnail_id($post->ID); 
                $size = 'feature_slider'; 
                $image_url = wp_get_attachment_image($image_id, $size , false, array( 'alt'   => get_the_title() ,'title' =>  get_the_title()  )); 
                $nothumb = get_stylesheet_directory_uri() . '/images/default/noim.png' ;
                if(!empty($image_url)){ ?>
                    <?php echo $image_url; ?>
                <?php } elseif ((vp_metabox('rehub_post.rehub_framework_post_type') == 'video') && (vp_metabox('rehub_post.video_post.0.video_post_embed_url') !='')) {?>   
                    <?php $img_video_url = vp_metabox('rehub_post.video_post.0.video_post_embed_url'); $img_video = parse_video_url($img_video_url, 'hqthumb');?>   
                    <img src="<?php echo $img_video ?>" alt="<?php the_title_attribute(); ?>"/>
                <?php } else {?>
                    <img src="<?php echo $nothumb; ?>" alt="<?php the_title_attribute(); ?>" />
                <?php } ?>
            </a>
        </figure>                                     
    <?php } ?>
    <div class="wrap_thing">
        <div class="top">
            <?php $category = get_the_category(get_the_ID());  ?>
            <?php if ($category) {$first_cat = $category[0]->term_id; meta_small( false, $first_cat, false, false );} ?>
        </div>
        <div class="hover_anons">
            <h2><?php rehub_permalink() ;?><?php the_title();?></a></h2>
            <div class="post-meta"> <?php meta_small( true, false, true, false ); ?> </div>
            <?php rehub_format_score('small') ?>
            <p><?php kama_excerpt('maxchar=320'); ?></p>
        </div>
        <?php rehub_create_btn('yes') ;?>
    </div>
</article>