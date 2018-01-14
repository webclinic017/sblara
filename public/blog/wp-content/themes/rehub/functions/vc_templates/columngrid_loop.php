<?php 
    $post_formats = $enable_pagination = $data_source = $cat = $ids = $orderby = $order = $meta_key = $show = $offset = $columns = $enable_btn = $exerpt_count = '';
    extract(shortcode_atts(array(
        'post_formats' => '',
        'enable_pagination' => '',
        'data_source' => '',
        'cat' => '',
        'ids' => '',
        'orderby' => '',
        'order' => 'DESC',
        'meta_key' => '',
        'columns' => '3_col',
        'show' => '',
        'offset' => '',
        'enable_btn' => '',
        'exerpt_count' => '120'     
    ), $atts));
        
?>
<?php if(class_exists('MetaDataFilterPage')) :?> <?php echo do_shortcode('[mdf_sort_panel]'); ?><div class="clearfix"></div><?php endif; ?>
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
    if(class_exists('MetaDataFilter') AND MetaDataFilter::is_page_mdf_data()){   
        $_REQUEST['mdf_do_not_render_shortcode_tpl'] = true;
        $_REQUEST['mdf_get_query_args_only'] = true;
        do_shortcode('[meta_data_filter_results]');
        $args = $_REQUEST['meta_data_filter_args'];
        $wp_query=new WP_Query($args);
        $_REQUEST['meta_data_filter_found_posts']=$wp_query->found_posts;
    }
    else { $wp_query = new WP_Query($args); }
?>
<?php $i=1; if ( $wp_query->have_posts() ) : ?>                      
<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
  
    <?php if ($columns == '3_col') :?>
    <article class="column_grid<?php if (($i % 3) == '0') :?> last-col<?php endif ?><?php if (($i % 3) == '1') :?> first-col<?php endif ?>">
    <?php elseif ($columns == '4_col') :?>
    <article class="col_4_grid column_grid<?php if (($i % 4) == '0') :?> last-col<?php endif ?><?php if (($i % 4) == '1') :?> first-col<?php endif ?>">
    <?php endif ;?> 
        <figure>             
            <a href="<?php the_permalink();?>"><?php wpsm_thumb ('news_big') ?></a>
        </figure>
        <div class="content_constructor">
            <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <div class="rehub_catalog_desc">                                 
                <?php kama_excerpt('maxchar='.$exerpt_count.''); ?>                       
            </div> 
            <?php if($enable_btn):?>
                <?php rehub_create_btn('yes');?>
            <?php endif?>
        </div>                           
    </article>
<?php $i++; endwhile; endif; ?>
<div class="clearfix"></div>
<?php if ($enable_pagination != '') :?>
    <?php rehub_pagination();?>
<?php endif ;?>
<?php  wp_reset_query(); ?>