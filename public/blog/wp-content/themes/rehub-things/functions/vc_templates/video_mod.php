<?php 
	$loop_tags = $showposts = '';
  extract(shortcode_atts(array(
  'loop_tags' => '',
  'showposts' => '3'
  ), $atts));  		    
?>
<?php if( !is_paged()) : ?>
<div class="news_block clearfix<?php if ($showposts == '5') :?> full_width_video<?php endif;?>">
	<?php $args = array(
    'showposts' => $showposts,
	  'tag' => $loop_tags,
	  'ignore_sticky_posts' => 1
    );
    $video_news = new WP_Query($args); $count=0; if ($video_news->have_posts()) : while ($video_news->have_posts()) : $video_news->the_post(); global $post; $count ++ ?>
        <?php if (($count) == '1') :?>		    
            <div class="big_img">
              <figure>
                <span class="fa fa-play-circle vid_icon"></span><a href="<?php the_permalink();?>"><?php wpsm_thumb ('video_big') ?></a>
              </figure>
              <div class="video_anons">
                <div>
                  <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                  <div class="post-meta"><?php meta_small( true, false, true, false ); ?></div>
                </div>
              </div>              
            </div>
        <?php else: ?>
            <div class="right">
              <figure><span class="fa fa-play-circle vid_icon_min"></span><a href="<?php the_permalink();?>"><?php wpsm_thumb ('grid_news') ?></a></figure>
              <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
              <div class="post-meta"><?php meta_small( true, false, true, false ); ?></div>
            </div>
            <?php if (($count) == '3') :?><div class="second_video_row"></div><?php endif ;?>
        <?php endif ?>
    <?php endwhile; endif; wp_reset_query(); $count = 0; ?> 
</div>
<?php endif ; ?>