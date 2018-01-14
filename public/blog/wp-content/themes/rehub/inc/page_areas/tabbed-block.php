<?php 
	$title_enable = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_toggle_title');
	$title_name = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_title');
	$title_position = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_title_position');
	$title_url_title = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_url_text');
	$title_url_url = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_url_url');
	$module_cats_first = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_cats_1');
	$module_cats_second = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_cats_2');
	$module_cats_third = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_cats_3');
	$module_cats_fourth = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_cats_4');	
	$module_name_first = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_name_1');
	$module_name_second = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_name_2');
	$module_name_third = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_name_3');
	$module_name_fourth = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.tab_mod.0.tab_mod_name_4');
    $cat_1_name = get_cat_name($module_cats_first);
	$cat_2_name = get_cat_name($module_cats_second);
	$cat_3_name = get_cat_name($module_cats_third);
	$cat_4_name = get_cat_name($module_cats_fourth);
	$module_exclude = rehub_option('rehub_exclude_posts');
	if(($module_exclude) == 1) {
			$exclude_posts = rehub_exclude_feature_posts();
	}
	else $exclude_posts = '';		    
?>
<?php title_custom_block ($title_enable, $title_name, $title_position, $title_url_title, $title_url_url) ?>
<div id="reviews_tabs" class="tabs">
<?php $category_ids = array($module_cats_first, $module_cats_second, $module_cats_third, $module_cats_fourth); //category colors for tabs
        foreach($category_ids as $cat_id) { ?>      
            <?php $cat_data = get_option("category_$cat_id"); ?>
            <?php if (!empty($cat_data['cat_color'])) :?>
                <style scoped>#reviews_tabs > ul > li.tabcat-<?php echo $cat_id ;?>:hover, #reviews_tabs > ul > li.current.tabcat-<?php echo $cat_id ;?>, #reviews_tabs .tabcat-<?php echo $cat_id ;?> .more, #reviews_tabs .tabcat-<?php echo $cat_id ;?> .score, .tabcat-<?php echo $cat_id ;?> .overlay_post_formats.review_formats_score{background-color: <?php echo $cat_data['cat_color'];?> !important; color:#fff !important; text-decoration: none;}</style>
            <?php endif;?>
        <?php }
?>
    <ul class="tabs-menu clearfix">
      <li class="first tabcat-<?php echo $module_cats_first ?>"><?php if( !empty( $module_name_first )) :?><?php echo $module_name_first ?><?php endif ;?></li>
      <li class="second tabcat-<?php echo $module_cats_second ?>"><?php if( !empty( $module_name_second )) :?><?php echo $module_name_second ?><?php endif ;?></li>
      <li class="third tabcat-<?php echo $module_cats_third ?>"><?php if( !empty( $module_name_third )) :?><?php echo $module_name_third ?><?php endif ;?></li>
      <li class="fourth tabcat-<?php echo $module_cats_fourth ?>"><?php if( !empty( $module_name_fourth )) :?><?php echo $module_name_fourth ?><?php endif ;?></li>
    </ul>
    <!--TABS-->
    <?php if( !empty( $module_cats_first )) :?>
    	<div class="tabs-item first clearfix tabcat-<?php echo $module_cats_first ?>">
	     	<?php $tab1news = new WP_Query(array( 'cat' => $module_cats_first, 'post_type' => 'post', 'showposts' => 4, 'post__not_in' => $exclude_posts, 'ignore_sticky_posts' => 1 ));$count = 0; 
				if( $tab1news->have_posts() ) :
				while($tab1news->have_posts()) : $tab1news->the_post(); $count ++ ;
	   		?>	 
	   		<?php if($count == 1) : ?> 
        		<div class="tabs_img">
        			<figure>
        				<div class="pattern"></div>
                        <?php rehub_format_score('small', 'square') ?>
        				<a href="<?php the_permalink();?>"><a href="<?php the_permalink();?>"><?php wpsm_thumb ('news_big') ?></a></a>
        				<div class="video_overlay">
        					<?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
        					<?php rehub_formats_icons() ?>
        					<div>
        						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        						<div class="post-meta"> <?php meta_all( true, $module_cats_first, false ); ?> </div>
        					</div>
        				</div>
        			</figure>
        		</div>     	
        	<?php else :?>
        		<div class="right">
        			<div class="clearfix">	
        				<figure><a href="<?php the_permalink();?>"><?php wpsm_thumb ('med_thumbs') ?></a><?php rehub_formats_icons('small') ?></figure>
						<div class="detail">
							<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
							<div class="f-postmeta"><?php meta_small( true, false, true ); ?></p></div>
							<?php rehub_format_score('small') ?>
						</div>
        			</div>
        		</div>
        	<?php endif;?>
        	<?php endwhile; endif; $count=0; wp_reset_query(); ?>
    		<a href="<?php echo get_category_link( $module_cats_first );?>" class="more"><span><?php _e('Read more from','rehub_framework') ?> <?php echo $cat_1_name?></span></a>	
    	</div>
    <?php endif ;?>
    <?php if( !empty( $module_cats_second )) :?>                
    	<div class="tabs-item second clearfix tabcat-<?php echo $module_cats_second ?>">
	     	<?php $tab2news = new WP_Query(array( 'cat' => $module_cats_second, 'post_type' => 'post', 'showposts' => 4, 'post__not_in' => $exclude_posts, 'ignore_sticky_posts' => 1 ));$count = 0;
				if( $tab2news->have_posts() ) :
				while($tab2news->have_posts()) : $tab2news->the_post();  $count ++ ;
	   		?>	 
	   		<?php if($count == 1) : ?> 
        		<div class="tabs_img">
        			<figure>
        				<div class="pattern"></div>
                        <?php rehub_format_score('small', 'square') ?>
        				<a href="<?php the_permalink();?>"><a href="<?php the_permalink();?>"><?php wpsm_thumb ('news_big') ?></a></a>
        				<div class="video_overlay">
        					<?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
        					<?php rehub_formats_icons() ?>
        					<div>
        						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        						<div class="post-meta"> <?php meta_all( true, $module_cats_second, false ); ?> </div>
        					</div>
        				</div>
        			</figure>
        		</div>       	
        	<?php else :?>
        		<div class="right">
        			<div class="clearfix">	
        				<figure><a href="<?php the_permalink();?>"><?php wpsm_thumb ('med_thumbs') ?></a><?php rehub_formats_icons('small') ?></figure>
						<div class="detail">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                            <div class="f-postmeta"><?php meta_small( true, false, true ); ?></p></div>
							<?php rehub_format_score('small') ?>
						</div>
        			</div>
        		</div>
        	<?php endif;?>
        	<?php endwhile; endif; $count=0; wp_reset_query(); ?>
    		<a href="<?php echo get_category_link( $module_cats_second );?>" class="more"><span><?php _e('Read more from','rehub_framework') ?> <?php echo $cat_2_name?></span></a>	
    	</div>
    <?php endif ;?>
    <?php if( !empty( $module_cats_third )) :?>
    	<div class="tabs-item third clearfix tabcat-<?php echo $module_cats_third ?>">
	     	<?php $tab3news = new WP_Query(array( 'cat' => $module_cats_third, 'post_type' => 'post', 'showposts' => 4, 'post__not_in' => $exclude_posts, 'ignore_sticky_posts' => 1 )); $count = 0;
				if( $tab3news->have_posts() ) :
				while($tab3news->have_posts()) : $tab3news->the_post();  $count ++ ;
	   		?>	 
	   		<?php if($count == 1) : ?> 
        		<div class="tabs_img">
        			<figure>
        				<div class="pattern"></div>
                        <?php rehub_format_score('small', 'square') ?>
        				<a href="<?php the_permalink();?>"><a href="<?php the_permalink();?>"><?php wpsm_thumb ('news_big') ?></a></a>
        				<div class="video_overlay">
        					<?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
        					<?php rehub_formats_icons() ?>
        					<div>
        						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        						<div class="post-meta"> <?php meta_all( true, $module_cats_third, false ); ?> </div>
        					</div>
        				</div>
        			</figure>
        		</div>        	
        	<?php else :?>
        		<div class="right">
        			<div class="clearfix">	
        				<figure><a href="<?php the_permalink();?>"><?php wpsm_thumb ('med_thumbs') ?></a><?php rehub_formats_icons('small') ?></figure>
						<div class="detail">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                            <div class="f-postmeta"><?php meta_small( true, false, true ); ?></p></div>
							<?php rehub_format_score('small') ?>
						</div>
        			</div>
        		</div>
        	<?php endif;?>
        	<?php endwhile; endif; $count=0; wp_reset_query(); ?>
    		<a href="<?php echo get_category_link( $module_cats_third );?>" class="more"><span><?php _e('Read more from','rehub_framework') ?> <?php echo $cat_3_name?></span></a>	
    	</div>
    <?php endif ;?>
    <?php if( !empty( $module_cats_fourth )) :?>
    	<div class="tabs-item fourth clearfix tabcat-<?php echo $module_cats_fourth ?>">
	     	<?php $tab4news = new WP_Query(array( 'cat' => $module_cats_fourth, 'post_type' => 'post', 'showposts' => 4, 'post__not_in' => $exclude_posts, 'ignore_sticky_posts' => 1 ));$count = 0;
				if( $tab4news->have_posts() ) :
				while($tab4news->have_posts()) : $tab4news->the_post();  $count ++ ;
	   		?>	 
	   		<?php if($count == 1) : ?> 
        		<div class="tabs_img">
        			<figure>
        				<div class="pattern"></div>
                        <?php rehub_format_score('small', 'square') ?>
        				<a href="<?php the_permalink();?>"><?php wpsm_thumb ('news_big') ?></a>
        				<div class="video_overlay">
        					<?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment', ''); ?><?php endif ;?>
        					<?php rehub_formats_icons() ?>
        					<div>
        						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        						<div class="post-meta"> <?php meta_all( true, $module_cats_fourth, false ); ?> </div>
        					</div>
        				</div>
        			</figure>
        		</div>      	
        	<?php else :?>
        		<div class="right">
        			<div class="clearfix">	
        				<figure><a href="<?php the_permalink();?>"><?php wpsm_thumb ('med_thumbs') ?></a><?php rehub_formats_icons('small') ?></figure>
						<div class="detail">
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                            <div class="f-postmeta"><?php meta_small( true, false, true ); ?></p></div>
							<?php rehub_format_score('small') ?>
						</div>
        			</div>
        		</div>
        	<?php endif;?>
        	<?php endwhile; endif; $count=0; wp_reset_query(); ?>
    		<a href="<?php echo get_category_link( $module_cats_fourth );?>" class="more"><span><?php _e('Read more from','rehub_framework') ?> <?php echo $cat_4_name?></span></a>	
    	</div>
    <?php endif ;?>       
</div>