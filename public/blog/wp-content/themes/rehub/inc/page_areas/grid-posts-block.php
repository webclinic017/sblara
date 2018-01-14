<?php 
	$title_enable = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_toggle_title');
	$title_name = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_title');
	$title_position = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_title_position');
	$title_url_title = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_url_text');
	$title_url_url = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_url_url');
	$module_cats = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_cats');
	$module_cats_in = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_cats_in');	
	$module_fetch = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_fetch');
	$module_pagination = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_toggle_page');
	$module_offset = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_offset');
	$module_format = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.grid_loop_mod.0.grid_loop_format');
	if ($module_fetch ==''){$module_fetch = '10';};
	$module_exclude = rehub_option('rehub_exclude_posts');
	if(($module_exclude) == 1) {
			$exclude_posts = rehub_exclude_feature_posts();
	}
	else $exclude_posts = '';		    
?>
<?php title_custom_block ($title_enable, $title_name, $title_position, $title_url_title, $title_url_url) ?>
<?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); ?>
<?php if($module_pagination =='2'): ?>
    <?php wp_enqueue_script('infinitescroll'); wp_enqueue_script('masonry_init_infclick'); ?>
<?php  else: ?>
    <?php wp_enqueue_script('masonry_init'); ?>    
<?php endif ;?>
<?php
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
	if ($module_format=='all'){
		$args = array(
		   'category__not_in' => $module_cats, 
		   'post_type' => 'post', 
		   'posts_per_page' => $module_fetch,
		   'post__not_in' => $exclude_posts, 
		   'paged' => $paged,
		   'offset' => $module_offset,
		   'cat' => $module_cats_in		   
	   );
	}
	else {
		$args = array(
		   'category__not_in' => $module_cats, 
		   'post_type' => 'post', 
		   'posts_per_page' => $module_fetch,
		   'post__not_in' => $exclude_posts, 
		   'paged' => $paged,
		   'offset' => $module_offset,
		   'meta_key' => 'rehub_framework_post_type',
		   'meta_value' => $module_format,
		   'cat' => $module_cats_in		   
		);
	}
	if ($module_offset !='') {$args['ignore_sticky_posts'] = 1;}
?> 
<div class="masonry_grid_fullwidth two-col-gridhub">
<?php $temp = $wp_query; 
$wp_query = null; 
$wp_query = new WP_Query(); 
$wp_query->query( $args ); 
global $more;
// set $more to 0 in order to only get the first part of the post
$more = 0; 
if(have_posts()): while(have_posts()): the_post(); ?>
	<?php include(locate_template('inc/parts/query_type3.php')); ?>
<?php endwhile; endif; ?>
</div>	
<div class="clearfix"></div>
<?php if ($module_pagination == '1') :?>
    <div class="pagination"><?php rehub_pagination();?></div>
<?php elseif ($module_pagination == '2') :?>    
    <div class="more_post onclick"><?php echo get_next_posts_link('' . __('More posts', 'rehub_framework') . ''); ?></div>
<?php endif ;?>
<?php $wp_query = null; $wp_query = $temp;  // Reset ?>
<?php  wp_reset_query(); ?>