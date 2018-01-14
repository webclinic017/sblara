<?php if( rehub_option('rehub_enable_newstick') && (!rehub_option('rehub_enable_newstick_home') || ( rehub_option('rehub_enable_newstick_home') && is_front_page() ) ) ): ?>
<?php 
	$label_ticker = rehub_option('rehub_newstick_label');
	$cats_ticker = rehub_option('rehub_newstick_cat');
	$tags_ticker = rehub_option('rehub_newstick_tag');
	$fetch_ticker = rehub_option('rehub_newstick_fetch');
	wp_enqueue_script('totemticker');
?>
<!-- NEWS SLIDER -->
<div class="top_theme">
	<h5><strong><?php echo $label_ticker;?></strong></h5>
	<div class="scrollers"> <a href="/" class="scroller down"></a> <a href="/" class="scroller up"></a> </div>
	<ul id="vertical-ticker">
	<?php $pq = new WP_Query(array( 'category__in' => $cats_ticker, 'tag__in' => $tags_ticker, 'post_type' => 'post', 'showposts' => $fetch_ticker )); 
		  if( $pq->have_posts() ) : while($pq->have_posts()) : $pq->the_post(); ?>
		<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
	<?php endwhile; wp_reset_postdata(); endif;?>	
	</ul>
	<div class="clearfix"></div>
</div>
<!-- /NEWS SLIDER -->
<?php endif ;?>