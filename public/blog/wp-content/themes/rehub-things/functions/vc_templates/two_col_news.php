<?php 
	$module_cats_first = $module_cats_second = $module_formats_first = $module_formats_second = $module_offset_second = $module_fetch = ''; 
	extract(shortcode_atts(array(
	'module_cats_first' => '',
	'module_cats_second' => '',
	'module_formats_first' => '',
	'module_formats_second' => '',
	'module_offset_second' => '',
	'module_fetch' => '',
	), $atts));

	$module_exclude = rehub_option('rehub_exclude_posts');
	if(($module_exclude) == 1) {
		$exclude_posts = rehub_exclude_feature_posts();
	}
	else $exclude_posts = '';
	if(($module_formats_first) == 'all') {
		$module_formats_first = '';
	}	
	if(($module_formats_second) == 'all') {
		$module_formats_second = '';
	}
	if(($module_fetch) == '') {
		$module_fetch = '4';
	}			    
?>
<?php if( !is_paged()) : ?>
<div class="clearfix page_block">  
    <!-- first Col -->
    <div class="article-sec">
     	<?php
		$catnews = new WP_Query(array( 'cat' => $module_cats_first, 'post_type' => 'post', 'showposts' => $module_fetch, 'post__not_in' => $exclude_posts, 'meta_key' => 'rehub_framework_post_type', 'meta_value' => $module_formats_first,  'ignore_sticky_posts' => 1 )); $count = 0;
		if( $catnews->have_posts() ) :
		while($catnews->have_posts()) : $catnews->the_post();  $count ++ ;
   		 ?>
	        <?php if($count == 1) : ?>  
	    	<figure>
	    	    <a href="<?php the_permalink();?>"><?php wpsm_thumb ('medium_news') ?></a>
	    		<div class="pattern"></div>
	    		<?php rehub_formats_icons('full') ?>
	    		<?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
	        </figure>
	        <article>
	        	<div class="post-meta"> <?php meta_all( false, $module_cats_first, false ); ?> </div>
	            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	            <p><?php kama_excerpt('maxchar=160'); ?></p>                
	        </article>
	     	<?php else :?>
	     	<div class="f-post clearfix">
	            <figure> <a href="<?php the_permalink();?>"><?php wpsm_thumb ('med_thumbs') ?></a> <?php rehub_formats_icons('small') ?></figure>
	            <article>
	            	<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	                <div class="f-postmeta"> <?php meta_small( true, false, true ); ?> </div>
	            </article>
	        </div>
	    	<?php endif;?>
	    <?php endwhile; endif; $count=0; wp_reset_query(); ?>
    </div>
    <!-- second Col -->
    <div class="article-sec right-sec">
        <?php
		$catnewssec = new WP_Query(array( 'cat' => $module_cats_second, 'post_type' => 'post', 'showposts' => $module_fetch, 'offset' => $module_offset_second, 'post__not_in' => $exclude_posts, 'meta_key' => 'rehub_framework_post_type', 'meta_value' => $module_formats_second, 'ignore_sticky_posts' => 1  ));$count = 0;
		if( $catnewssec->have_posts() ) :
		while($catnewssec->have_posts()) : $catnewssec->the_post();  $count ++ ;
        ?>
	        <?php if($count == 1) : ?>  
	    	<figure>
 				<a href="<?php the_permalink();?>"><?php wpsm_thumb ('medium_news') ?></a>
	    		<div class="pattern"></div>
	    		<?php rehub_formats_icons('full') ?>
	    		<?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
	        </figure>
	        <article>
				<div class="post-meta"> <?php meta_all( false, $module_cats_second, false ); ?> </div>	        
	            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3> 
	            <p><?php kama_excerpt('maxchar=160'); ?></p>           
	        </article>
	     	<?php else :?>
	     	<div class="f-post clearfix">
	            <figure> <a href="<?php the_permalink();?>"><?php wpsm_thumb ('med_thumbs') ?></a><?php rehub_formats_icons('small') ?></figure>
	            <article>
	            	<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
	                <div class="f-postmeta"> <?php meta_small( true, false, true ); ?>  </div>
	                <?php rehub_format_score('small') ?>
	            </article>
	        </div>
	    	<?php endif;?>
	    <?php endwhile; endif; $count=0; wp_reset_query(); ?> 
    </div>       
</div> 
<?php endif ; ?>       							