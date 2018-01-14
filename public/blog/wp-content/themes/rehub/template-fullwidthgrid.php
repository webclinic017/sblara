<?php

    /* Template Name: Full width grid */

?>
<?php 
    $module_cats = vp_metabox('rehub_grid_cat.fullwidth_grid_cat');
    $module_tag = vp_metabox('rehub_grid_cat.fullwidth_grid_tag');
    $module_fetch = vp_metabox('rehub_grid_cat.fullwidth_grid_fetch');
    $module_pagination = vp_metabox('rehub_grid_cat.fullwidth_grid_pagination');
    if ($module_fetch ==''){$module_fetch = '9';};
    if ($module_pagination ==''){$module_pagination = '2';};       
?>
<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <?php if(rehub_option('rehub_featured_toggle') && is_front_page()) : ?>
        <?php get_template_part('inc/parts/featured'); ?>
    <?php endif; ?>
    <?php if(rehub_option('rehub_homecarousel_toggle') && is_front_page()) : ?>
        <?php get_template_part('inc/parts/home_carousel'); ?>
    <?php endif; ?> 
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix full_width">
            <div class="title"><h1><?php the_title(); ?></h1></div>
            <div class="top_rating_text">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?><?php the_content(); ?><?php endwhile; endif; ?>
            </div>
            <?php if(class_exists('MetaDataFilterPage')) :?> <?php echo do_shortcode('[mdf_sort_panel]'); ?><div class="clearfix"></div><?php endif; ?>
            <div class="masonry_grid_fullwidth three-col-gridhub">
            <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); ?>
            <?php  if($module_pagination =='2'): ?>
                <?php wp_enqueue_script('infinitescroll'); wp_enqueue_script('masonry_init_infauto'); ?>
            <?php  else: ?>
                <?php wp_enqueue_script('masonry_init'); ?>    
            <?php endif ;?>
            <?php  $temp_query = $wp_query;
            if ( get_query_var('paged') ) { $pageds = get_query_var('paged'); } else if ( get_query_var('page') ) {$pageds = get_query_var('page'); } else {$pageds = 1; }
            $temp = $wp_query; $args = null;
            $args = array( 
                'cat' => $module_cats, 
                'tag' => $module_tag, 
                'posts_per_page' => $module_fetch, 
                'ignore_sticky_posts' => 1, 
                'paged' => $pageds
            );
            ?> 
            <?php  
                if(class_exists('MetaDataFilter') AND MetaDataFilter::is_page_mdf_data()){
     
                    $_REQUEST['mdf_do_not_render_shortcode_tpl'] = true;
                    $_REQUEST['mdf_get_query_args_only'] = true;
                    do_shortcode('[meta_data_filter_results]');
                    $args = $_REQUEST['meta_data_filter_args'];
                    global $wp_query;
                    $wp_query=new WP_Query($args);
                    $_REQUEST['meta_data_filter_found_posts']=$wp_query->found_posts;
                }
                else {query_posts($args);} 
                if(have_posts()): while(have_posts()): the_post(); ?>

                    <?php get_template_part('inc/parts/query_type3'); ?>                                       

            <?php endwhile; ?>

            <?php else : ?>		
            <div class="heading"><h5><?php _e('Sorry. No posts in this category yet', 'rehub_framework'); ?></h5></div>				   
            <?php endif; ?>
            </div>

            <?php if ($module_pagination == '1') :?>

                <div class="pagination"><?php rehub_pagination();?></div>

            <?php elseif ($module_pagination == '2') :?>    

                <div class="more_post"><?php echo get_next_posts_link('' . __('More posts', 'rehub_framework') . ''); ?></div>

            <?php endif ;?>

        </div>	
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>