<?php

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_two_col_news');
function rehub_framework_pb_is_two_col_news($type)
{
	if( $type === 'two_col_news_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_gal_carousel');
function rehub_framework_pb_is_gal_carousel($type)
{
	if( $type === 'gal_carousel_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_video_block');
function rehub_framework_pb_is_video_block($type)
{
	if( $type === 'video_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_tab_block');
function rehub_framework_pb_is_tab_block($type)
{
	if( $type === 'tab_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_woo_block');
function rehub_framework_pb_is_woo_block($type)
{
	if( $type === 'woo_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_news_no_thumbs_block');
function rehub_framework_pb_is_news_no_thumbs_block($type)
{
	if( $type === 'news_no_thumbs_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_post_carousel_block');
function rehub_framework_pb_is_post_carousel_block($type)
{
	if( $type === 'post_carousel_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_news_with_thumbs_block');
function rehub_framework_pb_is_news_with_thumbs_block($type)
{
	if( $type === 'news_with_thumbs_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_small_thumb_loop');
function rehub_framework_pb_is_small_thumb_loop($type)
{
	if( $type === 'small_thumb_loop' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_grid_loop');
function rehub_framework_pb_is_grid_loop($type)
{
	if( $type === 'grid_loop' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_regular_blog_loop');
function rehub_framework_pb_is_regular_blog_loop($type)
{
	if( $type === 'regular_blog_loop' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_slider_block');
function rehub_framework_pb_is_slider_block($type)
{
	if( $type === 'slider_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_pb_is_custom_block');
function rehub_framework_pb_is_custom_block($type)
{
	if( $type === 'custom_block' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_post_formats');
function rehub_framework_post_formats() {
return array(
    
    array(
      'value' => 'all',
      'label' => __('all', 'rehub_framework'),
    ),	

    array(
      'value' => 'regular',
      'label' => __('regular', 'rehub_framework'),
    ),
    array(
      'value' => 'video',
      'label' => __('video', 'rehub_framework'),
    ),
    array(
      'value' => 'gallery',
      'label' => __('gallery', 'rehub_framework'),
    ),
    array(
      'value' => 'review',
      'label' => __('review', 'rehub_framework'),
    ),
    array(
      'value' => 'music',
      'label' => __('music', 'rehub_framework'),
    ),              
);
}

VP_Security::instance()->whitelist_function('rehub_framework_block_title_position');
function rehub_framework_block_title_position() {
return array(
    
    array(
      'value' => 'top_title',
      'label' => __('above line', 'rehub_framework'),
      'img' => REHUB_ADMIN_URI . '/public/pb/title_1.png',
    ),	

    array(
      'value' => 'left_title',
      'label' => __('left position inside line', 'rehub_framework'),
      'img' => REHUB_ADMIN_URI . '/public/pb/title_2.png',      
    ),
    array(
      'value' => 'center_title',
      'label' => __('center position inside line', 'rehub_framework'),
      'img' => REHUB_ADMIN_URI . '/public/pb/title_3.png',      
    ),             
);
}


VP_Security::instance()->whitelist_function('rehub_framework_post_type_is_regular');
function rehub_framework_post_type_is_regular($type)
{
	if( $type === 'regular' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_post_type_is_video');
function rehub_framework_post_type_is_video($type)
{
	if( $type === 'video' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('rehub_framework_post_type_is_gallery');
function rehub_framework_post_type_is_gallery($type)
{
	if( $type === 'gallery' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('rehub_framework_post_type_is_review');
function rehub_framework_post_type_is_review($type)
{
	if( $type === 'review' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('rehub_framework_post_type_is_music');
function rehub_framework_post_type_is_music($type)
{
	if( $type === 'music' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_post_type_is_link');
function rehub_framework_post_type_is_link($type)
{
	if( $type === 'link' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('review_post_schema_type_is_product');
function review_post_schema_type_is_product($type)
{
	if( $type === 'review_post_review_product' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('review_post_schema_type_is_woo_list');
function review_post_schema_type_is_woo_list($type)
{
	if( $type === 'review_woo_list' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('review_post_schema_type_is_woo');
function review_post_schema_type_is_woo($type)
{
	if( $type === 'review_woo_product' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('review_post_schema_type_is_aff_product');
function review_post_schema_type_is_aff_product($type)
{
	if( $type === 'review_aff_product' )
		return true;
	return false;
}


VP_Security::instance()->whitelist_function('rehub_framework_post_music_is_soundcloud');
function rehub_framework_post_music_is_soundcloud($type)
{
	if( $type === 'music_post_soundcloud' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('rehub_framework_post_music_is_spotify');
function rehub_framework_post_music_is_spotify($type)
{
	if( $type === 'music_post_spotify' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_get_featured_posts');
function rehub_framework_get_featured_posts()
{
	$args = array(
		'meta_query' => array(
			array(
				'key' => 'is_featured',
				'value' => '1'
			),
			array(
				'key' => 'filter_featured_for',
				'value' => 'featured_for_slider'
			)
		)
	);
	$query = new WP_Query( $args );
	$data  = array();
	foreach ($query->posts as $post)
	{
		$data[] = array(
			'value' => $post->ID,
			'label' => $post->post_title,
		);
	}
	return $data;
}

VP_Security::instance()->whitelist_function('rehub_framework_get_featured_posts_right');
function rehub_framework_get_featured_posts_right()
{

	$args = array(
		'meta_query' => array(
			array(
				'key' => 'is_featured',
				'value' => '1'
			),
			array(
				'key' => 'filter_featured_for',
				'value' => 'featured_for_right'
			)
		)
	);
	$query = new WP_Query( $args );
	$data  = array();
	foreach ($query->posts as $post)
	{
		$data[] = array(
			'value' => $post->ID,
			'label' => $post->post_title,
		);
	}
	return $data;
}

//Functions for affiliate links

VP_Security::instance()->whitelist_function('rehub_get_aff');
function rehub_get_aff()
{
if(function_exists('thirstyInit')) {
	$aff_posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type'        => 'thirstylink',
	));

	$result = array();
	foreach ($aff_posts as $aff_post)
	{
		$result[] = array('value' => $aff_post->ID, 'label' => $aff_post->post_title);
	}
	return $result;
}
else {
	$result[] = array('value' => 'none', 'label' => 'You need to install plugin ThirstyAffiliates');
	return $result;
}
}

VP_Security::instance()->whitelist_function('review_aff_link_preview');
function review_aff_link_preview($review_aff_link = '')
{
	if(empty($review_aff_link) && $review_aff_link !='none') {$result = '';}
	else {
		$linkpost = get_post($review_aff_link);
		$linkData = unserialize(get_post_meta($linkpost->ID, 'thirstyData', true));
		$attachments = get_posts( array(
	            'post_type' => 'attachment',
				'post_mime_type' => 'image',
	            'posts_per_page' => -1,
	            'post_parent' => $linkpost->ID,
	        ) );
		$result = '<table cellspacing="10"><tr>';
		if (!empty($attachments)) { $result .= '<td>'.wp_get_attachment_image( $attachments[0]->ID, array(50,50), true).'</td>'; }
		$result .= '<td><strong>'.$linkpost->post_title.'</strong></td>';
		$result .= '<td><i>'.get_post_permalink($review_aff_link).' &#8594;</i></td>';		
		$result .= '<td><i>'.$linkData["linkurl"].'</i></td>';
		$result .= '<td><span style="color:#0C9518">'.get_post_meta( $linkpost->ID, 'rehub_aff_price', true ).'</span></td>';
		$result .= '</tr></table>';
	}
	return $result;
}

VP_Security::instance()->whitelist_function('rehub_manual_ids_func');
function rehub_manual_ids_func($top_review_cat='')
{
	$args = array(
		'meta_query' => array(
			array(
				'key' => 'rehub_framework_post_type',
				'value' => 'review'
			),
		),
		'posts_per_page' => -1,
	);
	$query = new WP_Query( $args );
	$data  = array();
	foreach ($query->posts as $post)
	{
		$data[] = array(
			'value' => $post->ID,
			'label' => $post->post_title,
		);
	}
	return $data;
}

VP_Security::instance()->whitelist_function('top_review_choose_is_cat');
function top_review_choose_is_cat($type)
{
	if( $type === 'cat_choose' )
		return true;
	return false;
}
VP_Security::instance()->whitelist_function('top_review_choose_is_manual');
function top_review_choose_is_manual($type)
{
	if( $type === 'manual_choose' )
		return true;
	return false;
}


//Functions for woocommerce

VP_Security::instance()->whitelist_function('rehub_get_woo');
function rehub_get_woo()
{
global $woocommerce;
if($woocommerce) {
	$woo_posts = get_posts(array(
		'posts_per_page' => -1,
		'post_type'        => 'product',
	));

	$result = array();
	foreach ($woo_posts as $woo_post)
	{
		$result[] = array('value' => $woo_post->ID, 'label' => $woo_post->post_title);
	}
	return $result;
}
else {
	$result[] = array('value' => 'none', 'label' => 'You need to install plugin Woocommerce');
	return $result;
}
}

VP_Security::instance()->whitelist_function('top_list_shortcode');
function top_list_shortcode()
{
	
		$result = ''.__("You can use shortcode to insert this top list to another page", "rehub_framework").' <strong>[wpsm_top id="'.get_the_ID().'" full_width="1"]</strong><br />'.__("Delete full_width attribute if you insert shortcode in page with sidebar", "rehub_framework").'';

	return $result;
}

VP_Security::instance()->whitelist_function('use_fields_as_desc');
function use_fields_as_desc($type)
{
	if( $type === 'field' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_rev_type');
function rehub_framework_rev_type($type)
{
	if( $type === 'full_review' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('user_rev_type');
function user_rev_type($type)
{
	if( $type === 'user' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_rev_color_is_mono');
function rehub_framework_rev_color_is_mono($type)
{
	if( $type === 'simple' )
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('rehub_framework_rev_color_is_multi');
function rehub_framework_rev_color_is_multi($type)
{
	if( $type === 'multicolor' )
		return true;
	return false;
}


////////



/**
 * EOF
 */