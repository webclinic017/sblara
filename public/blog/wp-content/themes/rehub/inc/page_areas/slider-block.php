<?php 
	$title_enable = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_toggle_title');
	$title_name = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_title');
	$title_position = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_title_position');
	$title_url_title = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_url_text');
	$title_url_url = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_url_url');
	$module_fetch = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_fetch');
	$module_cats = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_cats');
	$module_enable = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.slider_mod.0.slider_toggle_posts');
	$module_exclude = rehub_option('rehub_exclude_posts');
	if(($module_exclude) == 1) {
			$exclude_posts = rehub_exclude_feature_posts();
	}
	else $exclude_posts = '';		    
?>

<?php title_custom_block ($title_enable, $title_name, $title_position, $title_url_title, $title_url_url) ?>
<?php  wp_enqueue_script('flexslider');  ?>
<section class="clearfix">
    <!-- Feature Slider -->
    <div class="flexslider main_slider loading">
    	<i class="fa fa-spinner fa-pulse"></i>
    	<ul class="slides">
    		<?php if ($module_enable == '0') : ?>
		    	<?php $args = array(
		          'showposts' => $module_fetch,
				   'ignore_sticky_posts' => 1,
		          'meta_query' => array(
		            array(
		              'key' => 'is_featured',
		              'value' => '1'
		            ),
		            array(
		              'key' => 'filter_featured_for',
		              'value' => 'featured_for_slider'
		            )
		          )
		        );
		        $post_slider = new WP_Query($args); if ($post_slider->have_posts()) : ?>
		        <?php while ($post_slider->have_posts()) : $post_slider->the_post(); ?>
		          <li class="slide"> <?php wpsm_thumb ('feature_slider') ?> <span class="pattern"></span>
		            <div class="flex-overlay">
		              <div class="post-meta">
		                <div class="inner_meta"><?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id; meta_small( true, $first_cat, false ); ?></div>
		              </div>
		              <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		              <a href="<?php the_permalink();?>" class="read-more"><?php _e('Read more', 'rehub_framework') ;?></a> <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?> </div>
		          </li>
		        <?php endwhile; endif; wp_reset_query(); ?>
    		<?php else :?>
				<?php
				$post_slider = new WP_Query(array( 'cat' => $module_cats, 'post_type' => 'post', 'showposts' => $module_fetch, 'post__not_in' => $exclude_posts,  'ignore_sticky_posts' => 1));
				if( $post_slider->have_posts() ) :
				while($post_slider->have_posts()) : $post_slider->the_post();
		   		?>
		          <li class="slide"> <?php wpsm_thumb ('feature_slider') ?> <span class="pattern"></span>
		            <div class="flex-overlay">
		              <div class="post-meta">
		                <div class="inner_meta"><?php meta_small( true, $module_cats, false ); ?></div>
		              </div>
		              <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		              <a href="<?php the_permalink();?>" class="read-more"><?php _e('Read more', 'rehub_framework') ;?></a> <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?> </div>
		          </li>
		        <?php endwhile; endif; wp_reset_query(); ?>    		
        	<?php endif ;?> 
    	</ul>
    </div>
    <!-- /Feature Slider --> 
</section> 