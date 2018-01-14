<?php 
	$post_formats = $enable_pagination = $data_source = $cat = $ids = $orderby = $order = $meta_key = $show = $offset ='';
	extract(shortcode_atts(array(
	    'post_formats' => '',
	    'enable_pagination' => '',
      	'data_source' => '',
        'cat' => '',
        'ids' => '',
        'orderby' => '',
        'order' => 'DESC',
        'meta_key' => '',
        'show' => '',
        'offset' => ''	    
	), $atts));		    
?>
<?php
	global $wp_query; 
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
    if ($data_source == 'ids' && $ids !='') {
        $ids = explode(',', $ids);
        $args = array(
            'post__in' => $ids,
            'numberposts' => '-1',
            'orderby' => 'post__in',            
        );
    }
    else {
        $args = array(
            'post_type' => 'post',
            'posts_per_page'   => $show, 
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => 1,                  
        );
        if ($enable_pagination != '') {$args['paged'] = $paged;}
        if ($offset != '') {$args['offset'] = $offset;}
        if (($orderby == 'meta_value' || $orderby == 'meta_value_num') && $meta_key !='') {$args['meta_key'] = $meta_key;}
        if ($data_source == 'cat' && $cat !='') {$args['cat'] = $cat;}
        if ($post_formats != 'all') {$args['meta_key'] = 'rehub_framework_post_type'; $args['meta_value'] = $post_formats;}
    }    
	$wp_query = new WP_Query($args);
?> 
<?php if($wp_query->have_posts()): while($wp_query->have_posts()): $wp_query->the_post(); ?>
	<?php include(locate_template('inc/parts/query_type2.php')); ?>
<?php endwhile; endif; ?>
<div class="clearfix"></div>
<?php if ($enable_pagination != '') :?>
	<?php rehub_pagination();?>
<?php endif ;?>
<?php  wp_reset_query(); ?>