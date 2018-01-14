<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <?php if(rehub_option('rehub_featured_toggle') && is_front_page() && !is_paged()) : ?>
        <?php get_template_part('inc/parts/featured'); ?>
    <?php endif; ?>
    <?php if(rehub_option('rehub_homecarousel_toggle') && is_front_page() && !is_paged()) : ?>
        <?php get_template_part('inc/parts/home_carousel'); ?>
    <?php endif; ?>    
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix<?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?> full_width<?php endif ;?>">
            <div class="heading"><h5><?php _e('Latest Posts', 'rehub_framework'); ?></h5></div>
            <?php
                $module_exclude = rehub_option('rehub_exclude_posts');
                if(($module_exclude) == 1) {
                        $exclude_posts = rehub_exclude_feature_posts();
                }
                else $exclude_posts ='';
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                  'paged' => $paged,
                  'post__not_in' => $exclude_posts
                );
            ?>
            <?php $query = new WP_Query( $args ); ?> 
            <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid') : ?>
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
                <div class="masonry_grid_fullwidth two-col-gridhub">
            <?php elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?>   
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
                <div class="masonry_grid_fullwidth three-col-gridhub">                     
            <?php endif ;?>   
            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_blog') : ?>
                    <?php get_template_part('inc/parts/query_type2'); ?>
                <?php elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_list') : ?>
                    <?php get_template_part('inc/parts/query_type1'); ?>
                <?php elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid' || rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?>
                    <?php get_template_part('inc/parts/query_type3'); ?>                    
                <?php else : ?>
                    <?php get_template_part('inc/parts/query_type2'); ?>	
                <?php endif ;?>
            <?php endwhile; endif;?>
            <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid' || rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?></div><?php endif ;?>
            <div class="clearfix"></div>
            <?php rehub_pagination(); ?>	
            <?php wp_reset_query(); ?>
        </div>	
        <!-- /Main Side -->
        <?php if (rehub_option('rehub_framework_archive_layout') != 'rehub_framework_archive_gridfull') : ?>
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            <!-- /Sidebar --> 
        <?php endif ;?>
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>