<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix<?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?> full_width<?php endif ;?>">
            <div class="heading"><h5><?php _e('Search Results', 'rehub_framework'); ?></h5></div>
            <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid') : ?>
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
                <div class="masonry_grid_fullwidth two-col-gridhub">
            <?php elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?>   
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
                <div class="masonry_grid_fullwidth three-col-gridhub">                     
            <?php endif ;?>                        
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_blog') : ?>
                    <?php get_template_part('inc/parts/query_type2'); ?>
                <?php elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_list') : ?>
                    <?php get_template_part('inc/parts/query_type1'); ?>
                <?php elseif (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid' || rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?>
                    <?php get_template_part('inc/parts/query_type3'); ?>                    
                <?php else : ?>
                    <?php get_template_part('inc/parts/query_type2'); ?>    
                <?php endif ;?>
            <?php endwhile; ?>
            <?php else : ?>     
            <h5><?php _e('Sorry. No posts founded', 'rehub_framework'); ?></h5> 
            <?php endif; ?> 
            <?php if (rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_grid' || rehub_option('rehub_framework_archive_layout') == 'rehub_framework_archive_gridfull') : ?></div><?php endif ;?>
            <div class="clearfix"></div>
            <?php rehub_pagination(); ?>
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