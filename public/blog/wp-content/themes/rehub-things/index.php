<?php get_header(); ?>
<!-- CONTENT -->
<div class="content">     
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix<?php if (rehub_option('rehub_framework_archive_layout') == 'three_column_full' || rehub_option('rehub_framework_archive_layout') == 'two_column_full' || rehub_option('rehub_framework_archive_layout') == 'blog_full') : ?> full_width<?php else : ?> w_sidebar<?php endif ;?>">
            <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $infinitescrollwrap = (rehub_option('index_pagination') =='3') ? ' inf_scr_wrap_auto' : ''; 
                $i = 0 ;
                $args = array(
                  'paged' => $paged,
                  'ignore_sticky_posts' => 1
                );
            ?>
            <?php $query = new WP_Query( $args ); ?> 
            <?php if (rehub_option('rehub_framework_archive_layout') == 'two_column_full' || rehub_option('rehub_framework_archive_layout') == 'two_column_with') : ?>              
                <div class="two-col-gridhub<?php echo $infinitescrollwrap ;?>"> 
            <?php elseif (rehub_option('rehub_framework_archive_layout') == 'three_column_full') : ?>   
                <div class="three-col-gridhub<?php echo $infinitescrollwrap ;?>">               
            <?php else :?> 
                <div class="one-col-gridhub<?php echo $infinitescrollwrap ;?>">                        
            <?php endif ;?>   
            <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); $i ++ ; ?>
                <?php if($i == 1 && rehub_option('index_feature_post') == '1') : ?>
                    <?php get_template_part('inc/parts/query_type5'); ?>
                <?php else :?>
                    <?php if (rehub_option('rehub_framework_archive_layout') == 'blog_full' || rehub_option('rehub_framework_archive_layout') == 'blog_with') : ?>
                        <?php get_template_part('inc/parts/query_type2'); ?>
                    <?php elseif (rehub_option('rehub_framework_archive_layout') == 'list_with') : ?>
                        <?php get_template_part('inc/parts/query_type1'); ?>
                    <?php elseif (rehub_option('rehub_framework_archive_layout') == 'two_column_full' || rehub_option('rehub_framework_archive_layout') == 'two_column_with' || rehub_option('rehub_framework_archive_layout') == 'three_column_full') : ?>
                        <?php get_template_part('inc/parts/query_type4'); ?>                    
                    <?php else : ?>
                        <?php get_template_part('inc/parts/query_type4'); ?>    
                    <?php endif ;?>                    
                <?php endif ;?>    
            <?php endwhile; endif;?>
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
            <?php wp_reset_query(); ?>
        </div>	
        <!-- /Main Side -->
        <?php if (rehub_option('rehub_framework_archive_layout') == 'two_column_with' || rehub_option('rehub_framework_archive_layout') == 'blog_with' || rehub_option('rehub_framework_archive_layout') == 'list_with') : ?>
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            <!-- /Sidebar --> 
        <?php endif ;?>
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>