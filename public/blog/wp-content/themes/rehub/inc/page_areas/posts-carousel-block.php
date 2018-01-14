<?php 
	$title_enable = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_toggle_title');
	$title_name = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_title');
	$title_position = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_title_position');
	$title_url_title = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_url_text');
	$title_url_url = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_url_url');
	$module_fetch = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_fetch');
	$module_cats = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_cats');
	$module_formats = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.post_carousel_mod.0.post_carousel_formats');
	if(($module_formats) == 'all') {
		$module_formats = '';
	}
	$module_exclude = rehub_option('rehub_exclude_posts');
	if(($module_exclude) == 1) {
			$exclude_posts = rehub_exclude_feature_posts();
	}
	else $exclude_posts = '';		    
?>

<?php title_custom_block ($title_enable, $title_name, $title_position, $title_url_title, $title_url_url) ?>
<?php wp_enqueue_script('carouFredSel');  ?>
<div class="def-carousel sec_style_carousel loading">
<section class="clearfix">
    <ul class="gallery-pics clearfix">
        <?php
        $gal_post_block = new WP_Query(array( 'cat' => $module_cats, 'post_type' => 'post', 'showposts' => $module_fetch, 'post__not_in' => $exclude_posts, 'meta_key' => 'rehub_framework_post_type', 'meta_value' => $module_formats, 'ignore_sticky_posts' => 1 ));
        if( $gal_post_block->have_posts() ) :
        while($gal_post_block->have_posts()) : $gal_post_block->the_post();
        ?>
            <li> 
                <a href="<?php the_permalink();?>" class="gal_post_image"><?php rehub_formats_icons() ?><?php wpsm_thumb ('grid_news') ?></a>
                <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                <div class="rcnt_meta">
                    <p><?php if ($module_cats =='') :?><?php $category = get_the_category($post->ID); $module_cats = $category[0]->term_id; ?><?php endif ;?><?php meta_small( false, $module_cats, true ); ?></p>
                </div>
            </li>
        <?php endwhile; endif; wp_reset_query(); ?>
    </ul>
</section>
<div class="carousel-prev"></div>
<div class="carousel-next"></div>
</div>