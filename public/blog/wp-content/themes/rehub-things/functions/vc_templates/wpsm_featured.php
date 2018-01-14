<?php 
	$base = $tag = $fetch = $dis_exerpt = $bottom_style = '';
  	extract(shortcode_atts(array(
  		'base' => '',
  		'tag' => '',
  		'fetch' => '4',
  		'bottom_style' => '',
  		'dis_exerpt' => '',
  	), $atts));  			    
?>
<?php  wp_enqueue_script('flexslider'); ?>
<section class="clearfix"> 
	<!-- Feature Slider -->
	<div class="flexslider loading re_thing_slider<?php if ($bottom_style =='1') :?> bottom_style_slider<?php endif ?>">
    <i class="fa fa-spinner fa-pulse"></i>
    <ul class="slides">
		<?php $args = array(
			'tag' => $tag,
    		'showposts' => $fetch,
			'ignore_sticky_posts' => 1
		); ?>	

		<?php $loop_slider = new WP_Query($args); if ($loop_slider->have_posts()) : ?>
      	<?php while ($loop_slider->have_posts()) : $loop_slider->the_post(); 
      	$image_id = get_post_thumbnail_id(get_the_ID());  
		$image_url = wp_get_attachment_image_src($image_id,'full');
		$image_url = $image_url[0];
		?>
        	<li class="slide" style="background-image: url('<?php echo $image_url ;?>');"> 
        		<span class="pattern"></span>
          		<div class="flex-overlay">
          			<div class="flex-overlay-wrap">
	            		<div class="post-meta">
	              			<div class="inner_meta"><?php $category = get_the_category(get_the_ID()); $first_cat = $category[0]->term_id; meta_small( false, $first_cat, false, false ); ?></div>
	            		</div>
	            		<h2><?php rehub_permalink() ;?><?php the_title();?></a></h2>
	            		<div class="hero-description"><?php if ($dis_exerpt !='1') :?><p><?php kama_excerpt('maxchar=100'); ?></p><?php endif ;?></div>
	            		<?php rehub_create_btn('yes') ;?>
            		</div>
            	</div>
        	</li>
      	<?php endwhile; endif; wp_reset_query(); ?> 
  		</ul>
  	</div>
  	<!-- /Feature Slider --> 
</section>
<!-- Feature Post -->