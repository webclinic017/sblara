<!-- Title area -->
<div class="top_single_area">
    <?php if(rehub_option('rehub_disable_breadcrumbs') =='1' || (vp_metabox('rehub_post_side.disable_parts') == '1' && vp_metabox('rehub_post_side.show_breadcrumb') == '1'))  : ?>
    <?php else :?>
        <?php kama_breadcrumbs(); ?>
    <?php endif; ?>
    <div class="top"><?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment_two', ''); ?><?php endif ;?></div>
    <div itemtype="http://schema.org/Thing" itemscope="" itemprop="itemReviewed">                            
        <h1 itemprop="name"><?php the_title(); ?></h1>
    </div>                                
    <div class="meta post-meta">
        <?php if(rehub_option('exclude_author_meta') == 0) :?>
            <?php global $post; $author_id=$post->post_author; ?>
            <?php _e('By', 'rehub_framework') ;?><a class="admin" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $author_id ) )?>"><?php echo get_the_author_meta( 'user_nicename', $author_id ) ?></a>
        <?php endif; ?>
        <?php if(rehub_option('exclude_date_meta') == 0) :?>
            <?php _e('on', 'rehub_framework') ;?> <span class="date"><?php the_time('F j, Y'); ?></span>
        <?php endif; ?>    
    </div>
</div>