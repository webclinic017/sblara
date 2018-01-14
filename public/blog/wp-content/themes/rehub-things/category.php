<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <div class="clearfix">
        <!-- Main Side -->
        <div class="main-side clearfix<?php if (rehub_option('rehub_framework_category_layout') == 'three_column_full' || rehub_option('rehub_framework_category_layout') == 'two_column_full' || rehub_option('rehub_framework_category_layout') == 'blog_full') : ?> full_width<?php else : ?> w_sidebar<?php endif ;?>">
            <div class="heading"><h5><?php _e('Category:', 'rehub_framework'); ?> <span class="thin"><?php single_cat_title(); ?></span></h5></div>
            <div class='top_rating_text'><?php echo category_description(); ?></div>
            <?php
                $infinitescrollwrap = (rehub_option('index_pagination') =='3') ? ' inf_scr_wrap_auto' : ''; 
                $i = 0 ;
            ?>            
            <?php if (rehub_option('rehub_framework_category_layout') == 'two_column_full' || rehub_option('rehub_framework_category_layout') == 'two_column_with') : ?>              
                <div class="two-col-gridhub<?php echo $infinitescrollwrap ;?>"> 
            <?php elseif (rehub_option('rehub_framework_category_layout') == 'three_column_full') : ?>   
                <div class="three-col-gridhub<?php echo $infinitescrollwrap ;?>">               
            <?php else :?> 
                <div class="one-col-gridhub<?php echo $infinitescrollwrap ;?>">                        
            <?php endif ;?>
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); $i ++ ; ?>
                    <?php if (rehub_option('rehub_framework_category_layout') == 'blog_full' || rehub_option('rehub_framework_category_layout') == 'blog_with') : ?>
                        <?php get_template_part('inc/parts/query_type2'); ?>
                    <?php elseif (rehub_option('rehub_framework_category_layout') == 'list_with') : ?>
                        <?php get_template_part('inc/parts/query_type1'); ?>
                    <?php elseif (rehub_option('rehub_framework_category_layout') == 'two_column_full' || rehub_option('rehub_framework_category_layout') == 'two_column_with' || rehub_option('rehub_framework_category_layout') == 'three_column_full') : ?>
                        <?php get_template_part('inc/parts/query_type4'); ?>                    
                    <?php else : ?>
                        <?php get_template_part('inc/parts/query_type4'); ?>    
                    <?php endif ;?>
                <?php endwhile; ?>

                <?php else : ?>		
                    <h5><?php _e('Sorry. No posts in this category yet', 'rehub_child'); ?></h5>				   
                <?php endif; ?>
                </div>
                <div class="clearfix"></div>    
            <?php if (rehub_option('index_pagination') =='3') :?>
                <?php wp_enqueue_script('infinitescroll'); ?>
                <div class="more_post"><?php echo get_next_posts_link('' . __('More posts', 'rehub_child') . ''); ?></div> 
            <?php elseif (rehub_option('index_pagination') =='2') :?> 
                <div class="more_post onclick index_next_pagination"><?php echo get_next_posts_link('' . __('More posts', 'rehub_child') . ''); ?></div>                               
            <?php else :?>
                <div class="pagination"><?php rehub_pagination();?></div>
            <?php endif ;?>  	
        </div>	
        <!-- /Main Side -->
        <?php if (rehub_option('rehub_framework_category_layout') == 'two_column_with' || rehub_option('rehub_framework_category_layout') == 'blog_with' || rehub_option('rehub_framework_category_layout') == 'list_with') : ?>
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            <!-- /Sidebar --> 
        <?php endif ;?>
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>