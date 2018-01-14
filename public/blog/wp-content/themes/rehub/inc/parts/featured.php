<?php  wp_enqueue_script('flexslider');  ?>
<!-- Feature Post -->
<section class="clearfix"> 
	<?php $postid = rehub_option('rehub_featured_slider'); $postidright = rehub_option('rehub_featured_right'); $tagid = rehub_option('rehub_featured_tag');?>
	<!-- Feature Slider -->
	<div class="flexslider main_slider loading">
		<i class="fa fa-spinner fa-pulse"></i>
    	<ul class="slides">
  		<?php if (!empty($postid)) : ?>
			<?php $args = array(
				'post__in' => $postid,
				'orderby' => 'post__in',
				'ignore_sticky_posts' => 1
			); ?>
		<?php elseif (!empty($tagid)) : ?>
			<?php $args = array(
				'tag' => $tagid,
        		'showposts' => 3,
				'ignore_sticky_posts' => 1
			); ?>
		<?php else : ?>				
			<?php $args = array(
			'showposts' => 3,
			'ignore_sticky_posts' => 1,
			'meta_query' => array(
			  	array(
			    	'key' => 'is_featured',
			    	'value' => '1'
			  	),
			  	array(
			    	'key' => 'filter_featured_for',
			    	'value' => 'featured_for_slider'
			  	)
			)); ?>
		<?php endif ; ?>	

		<?php $loop_slider = new WP_Query($args); if ($loop_slider->have_posts()) : ?>
      	<?php while ($loop_slider->have_posts()) : $loop_slider->the_post(); ?>
        	<li class="slide"> 
        		<?php wpsm_thumb ('feature_slider') ?> <span class="pattern"></span>
          		<div class="flex-overlay">
            		<div class="post-meta">
              			<div class="inner_meta"><?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id; meta_small( true, $first_cat, false ); ?></div>
            		</div>
            		<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            		<a href="<?php the_permalink();?>" class="read-more"><?php _e('Read more', 'rehub_framework') ;?></a> <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?> 
            	</div>
        	</li>
      	<?php endwhile; endif; wp_reset_query(); ?> 
  		</ul>
  	</div>
  	<!-- /Feature Slider --> 
  
  	<!-- Side Columns -->
  	<div class="side-twocol">

  		<?php if (!empty($postidright)) : ?>
  			<?php $i = 0;?>
			<?php $args = array(
				'post__in' => $postidright,
				'orderby' => 'post__in',
				'ignore_sticky_posts' => 1
			); ?>
		<?php elseif (!empty($tagid)) : ?>
			<?php $i = 0;?>
			<?php $args = array(
				'tag' => $tagid,
        		'showposts' => 2,
				'ignore_sticky_posts' => 1,
				'offset' => 3,
			); ?>
		<?php else : ?>	
			<?php $i = 0;?>			
			<?php $args = array(
			'showposts' => 2,
			'ignore_sticky_posts' => 1,
			'meta_query' => array(
			  	array(
			    	'key' => 'is_featured',
			    	'value' => '1'
			  	),
			  	array(
			    	'key' => 'filter_featured_for',
			    	'value' => 'featured_for_right'
			  	)
			)); ?>
		<?php endif ; ?>

  		<?php $loop = new WP_Query($args); if ($loop->have_posts()) : ?>
      		<?php while ($loop->have_posts()) : $loop->the_post(); ?>
        	<div class="columns<?php if (($i) == '0') :?> col-1<?php endif ?>">
        		<figure><?php wpsm_thumb ('grid_news') ?><span class="pattern"></span>
	          		<div class="sidecol-overlay">
	          			<?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
	            		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	          		</div>
        		</figure>
      		</div>
      	<?php $i++; ?>
      	<?php endwhile; endif; wp_reset_query(); ?> 
  	
  	</div>
  	<!-- /Side Columns --> 
</section>
<!-- Feature Post -->