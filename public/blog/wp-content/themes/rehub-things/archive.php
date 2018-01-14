<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix<?php if (rehub_option('rehub_framework_archive_layout') == 'three_column_full' || rehub_option('rehub_framework_archive_layout') == 'two_column_full' || rehub_option('rehub_framework_archive_layout') == 'blog_full') : ?> full_width<?php else : ?> w_sidebar<?php endif ;?>">
            <?php
                if(isset($_GET['author_name'])) :
                $curauth = get_userdatabylogin($author_name);
            else :
                $curauth = get_userdata(intval($author));
            endif;?>

            <?php /* If this is a category archive */ 
            $infinitescrollwrap = (rehub_option('index_pagination') =='3') ? ' inf_scr_wrap_auto' : ''; 
            if (is_category()) { ?>
            <div class="heading"><h5><?php _e('Category:', 'rehub_child'); ?> <span class="thin"><?php single_cat_title(); ?></span></h5></div>
            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            <div class="heading"><h5><?php _e('Tag:', 'rehub_child'); ?> <span class="thin"><?php single_tag_title(); ?></span></h5></div>
            <div class='top_rating_text'><?php echo tag_description(); ?></div>				
            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            <div class="heading"><h5><?php _e('Archive:', 'rehub_child'); ?> <span class="thin"><?php the_time('F jS, Y'); ?></span></h5></div>
            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            <div class="heading"><h5><?php _e('Browsing Archive', 'rehub_child'); ?> <span class="thin"><?php the_time('F, Y'); ?></span></h5></div>
            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
            <div class="heading"><h5><?php _e('Browsing Archive', 'rehub_child'); ?> <span class="thin"><?php the_time('Y'); ?></span></h5></div>
            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <div class="author_quote clearfix"><?php echo get_avatar( get_the_author_meta('email'), '69' ); ?></a>
                    <div class="clearfix">
                        <h4><?php the_author_posts_link(); ?></h4>
                        <div class="social_icon small_i">
                            <?php if(get_the_author_meta('user_url')) : ?><a href="<?php echo the_author_meta('user_url'); ?>" class="author-social hm" rel="nofollow"><i class="fa fa-home"></i></a><?php endif; ?>
                            <?php if(get_the_author_meta('facebook')) : ?><a href="<?php echo the_author_meta('facebook'); ?>" class="author-social fb" rel="nofollow"><i class="fa fa-facebook"></i></a><?php endif; ?>
                            <?php if(get_the_author_meta('twitter')) : ?><a href="<?php echo the_author_meta('twitter'); ?>" class="author-social tw" rel="nofollow"><i class="fa fa-twitter"></i></a><?php endif; ?>
                            <?php if(get_the_author_meta('google')) : ?><a href="<?php echo the_author_meta('google'); ?>?rel=author" class="author-social gp" rel="nofollow"><i class="fa fa-google-plus"></i></a><?php endif; ?>
                            <?php if(get_the_author_meta('tumblr')) : ?><a href="<?php echo the_author_meta('tumblr'); ?>" class="author-social tm" rel="nofollow"><i class="fa fa-tumblr"></i></a><?php endif; ?>
                            <?php if(get_the_author_meta('instagram')) : ?><a href="<?php echo the_author_meta('instagram'); ?>" class="author-social ins" rel="nofollow"><i class="fa fa-instagram"></i></a><?php endif; ?>
                            <?php if(get_the_author_meta('vkontakte')) : ?><a href="<?php echo the_author_meta('vkontakte'); ?>" class="author-social vk" rel="nofollow"><i class="fa fa-vk"></i></a><?php endif; ?>
                            <?php if(get_the_author_meta('youtube')) : ?><a href="<?php echo the_author_meta('youtube'); ?>" class="author-social yt" rel="nofollow"><i class="fa fa-youtube"></i></a><?php endif; ?>
                         </div>
                        <?php if (the_author_meta('description') !='') :?><p><?php the_author_meta('description'); ?></p><?php endif;?>
                    </div>
                </div>			
            <div class="heading"><h5><?php _e('Browsing All Posts By', 'rehub_child'); ?> <span class="thin"><?php echo $curauth->display_name; ?></span></h5></div>			
            <?php } ?>  
            <?php if (rehub_option('rehub_framework_archive_layout') == 'two_column_full' || rehub_option('rehub_framework_archive_layout') == 'two_column_with') : ?>              
                <div class="two-col-gridhub<?php echo $infinitescrollwrap ;?>"> 
            <?php elseif (rehub_option('rehub_framework_archive_layout') == 'three_column_full') : ?>   
                <div class="three-col-gridhub<?php echo $infinitescrollwrap ;?>">               
            <?php else :?> 
                <div class="one-col-gridhub<?php echo $infinitescrollwrap ;?>">                        
            <?php endif ;?>                        
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php if (rehub_option('rehub_framework_archive_layout') == 'blog_full' || rehub_option('rehub_framework_archive_layout') == 'blog_with') : ?>
                    <?php get_template_part('inc/parts/query_type2'); ?>
                <?php elseif (rehub_option('rehub_framework_archive_layout') == 'list_with') : ?>
                    <?php get_template_part('inc/parts/query_type1'); ?>
                <?php elseif (rehub_option('rehub_framework_archive_layout') == 'two_column_full' || rehub_option('rehub_framework_archive_layout') == 'two_column_with' || rehub_option('rehub_framework_archive_layout') == 'three_column_full') : ?>
                    <?php get_template_part('inc/parts/query_type4'); ?>                    
                <?php else : ?>
                    <?php get_template_part('inc/parts/query_type4'); ?>    
                <?php endif ;?>
            <?php endwhile; ?>
            <?php else : ?>		
            <h5><?php _e('Sorry. No posts in this category yet', 'rehub_framework'); ?></h5>	
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