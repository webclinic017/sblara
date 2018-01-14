<?php 
	$loop_tags = '';
  extract(shortcode_atts(array(
  'loop_tags' => '',
  ), $atts));  	
	$module_exclude = rehub_option('rehub_exclude_posts');
	if(($module_exclude) == 1) {
			$exclude_posts = rehub_exclude_feature_posts();
	}
	else $exclude_posts = '';		    
?>
<?php if( !is_paged()) : ?>
<div class="news_block clearfix">
	<?php $args = array(
    'showposts' => 3,
	  'tag' => $loop_tags,
	  'meta_key' => 'rehub_framework_post_type',
	  'meta_value' => 'video',
    'post__not_in' => $exclude_posts,
	  'ignore_sticky_posts' => 1
    );
    $video_news = new WP_Query($args); $count=0; if ($video_news->have_posts()) : while ($video_news->have_posts()) : $video_news->the_post(); global $post; $count ++ ?>
        <?php if (($count) == '1') :?>		    
            <div class="big_img">
              <figure>
                <span class="fa fa-play-circle vid_icon"></span><a href="<?php the_permalink();?>"><?php wpsm_thumb ('video_big') ?></a>
                <div class="video_overlay">
                  <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
                  <div>
                    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <div class="post-meta"><?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id; meta_all( true, $first_cat, false ); ?> </div>
                  </div>
                </div>
              </figure>
            </div>
        <?php else: ?>
            <div class="right">
              <figure><span class="fa fa-play-circle vid_icon_min"></span><a href="<?php the_permalink();?>"><?php wpsm_thumb ('video_narrow') ?></a></figure>
              <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
              <div class="post-meta"><?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id; meta_all( true, $first_cat, false ); ?> </div>
            </div>
        <?php endif ?>
    <?php endwhile; endif; wp_reset_query(); $count = 0; ?> 
</div>
<?php endif ; ?>