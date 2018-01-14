<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <?php if(rehub_option('rehub_homecarousel_toggle') && rehub_option('rehub_homecarousel_cat')) : ?>
        <?php get_template_part('inc/parts/home_carousel'); ?>
    <?php endif; ?>
    <div class="clearfix">
        <!-- Main Side -->
        <div class="main-side clearfix<?php if (rehub_option('rehub_framework_category_layout') == 'rehub_framework_category_gridfull') : ?> full_width<?php endif ;?>">
            <div class="heading"><h5><?php _e('Category:', 'rehub_framework'); ?> <span class="thin"><?php single_cat_title(); ?></span></h5></div>
            <div class='top_rating_text'><?php echo category_description(); ?></div>
            <?php if (rehub_option('rehub_framework_category_layout') == 'rehub_framework_category_gridfull') : ?>
                <div class="masonry_grid_fullwidth three-col-gridhub">
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
            <?php elseif (rehub_option('rehub_framework_category_layout') == 'rehub_framework_category_grid') : ?>
                <div class="masonry_grid_fullwidth two-col-gridhub">
                <?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init'); ?>
            <?php else : ?>
                <div>    
            <?php endif ;?>
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php if (rehub_option('rehub_framework_category_layout') == 'rehub_framework_category_blog') : ?>
                        <?php get_template_part('inc/parts/query_type2'); ?>
                    <?php elseif (rehub_option('rehub_framework_category_layout') == 'rehub_framework_category_list') : ?>
                        <?php get_template_part('inc/parts/query_type1'); ?>
                    <?php elseif (rehub_option('rehub_framework_category_layout') == 'rehub_framework_category_grid') : ?>
                        <?php get_template_part('inc/parts/query_type3'); ?> 
                    <?php elseif (rehub_option('rehub_framework_category_layout') == 'rehub_framework_category_gridfull') : ?>
                        <?php get_template_part('inc/parts/query_type3'); ?>                                       
                    <?php else : ?>
                        <?php get_template_part('inc/parts/query_type2'); ?>	
                    <?php endif ;?>
                <?php endwhile; ?>

                <?php else : ?>		
                    <h5><?php _e('Sorry. No posts in this category yet', 'rehub_framework'); ?></h5>			   
                <?php endif; ?>
                </div>
                <div class="clearfix"></div>    
            <?php rehub_pagination();?>  	
        </div>	
        <!-- /Main Side -->
        <?php if (rehub_option('rehub_framework_category_layout') != 'rehub_framework_category_gridfull') : ?>
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            <!-- /Sidebar --> 
        <?php endif ;?>
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>