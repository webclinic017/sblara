<?php 
	$module_cat = $module_tag = $module_fetch ='';
	extract(shortcode_atts(array(
	    'module_cat' => '',
	    'module_tag' => '',
	    'module_fetch' => '4'
	), $atts));
	if(($module_cat) == 'all') {
		$module_cat = '';
	}		    
?>
<?php if( !is_paged()) : ?>
<?php  wp_enqueue_script('flexslider');  ?>
<section class="clearfix">
    <!-- Feature Slider -->
    <div class="flexslider main_slider s_for_sidebar loading">
    	<i class="fa fa-spinner fa-pulse"></i>
    	<ul class="slides">
    		<?php $post_slider = new WP_Query(array( 'cat' => $module_cat, 'tag' => $module_tag, 'post_type' => 'post', 'showposts' => $module_fetch, 'ignore_sticky_posts' => 1)); ?>
		        <?php if ($post_slider->have_posts()) : while ($post_slider->have_posts()) : $post_slider->the_post(); ?>
		          <li class="slide"> <?php wpsm_thumb ('feature_slider') ?> <span class="pattern"></span>
		            <div class="flex-overlay">
		              <div class="post-meta">
		                <div class="inner_meta"><?php $category = get_the_category(get_the_ID()); $first_cat = $category[0]->term_id; meta_small( true, $first_cat, false ); ?></div>
		              </div>
		              <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		              <a href="<?php the_permalink();?>" class="read-more"><?php _e('Read more', 'rehub_framework') ;?></a> <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?> </div>
		          </li>
		        <?php endwhile; endif; wp_reset_query(); ?>
    	</ul>
    </div>
    <!-- /Feature Slider --> 
</section> 
<?php endif ; ?>