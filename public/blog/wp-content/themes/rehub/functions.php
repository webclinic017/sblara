<?php

/** 
 * Register & enqueue styles/scripts 
 * 
 */


if(!is_admin()) add_action('init', 'rehub_framework_register_scripts');
if( !function_exists('rehub_framework_register_scripts') ) {
function rehub_framework_register_scripts() {

	// Stylesheets
	wp_register_style('style', get_stylesheet_directory_uri() . '/style.css');
	wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css');
	wp_register_style('rehub_shortcode', get_template_directory_uri() . '/shortcodes/css/css.css');
	wp_register_style('ecwid', get_template_directory_uri() . '/css/ecwid.css');
	wp_register_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_register_style('font-awesome-fallback', get_template_directory_uri() . '/vafpress-framework/public/css/vendor/font-awesome.min.css');
	wp_register_style( 'rehub-woocommerce', get_template_directory_uri().'/css/woocommerce.css' , array(), '', 'all' );
	wp_register_style('bbpress_css', get_template_directory_uri() . '/css/bbpresscustom.css');	
	wp_register_style('jquery.nouislider', get_template_directory_uri() . '/css/jquery.nouislider.css');

	
	//Scripts
    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.7.1'); // Modernizr
	wp_register_script('rehub', get_template_directory_uri() . '/js/custom.js', 'jquery', '', true);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', '2.2.2', true);
	wp_register_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery', '3.1.5', true);
	wp_register_script('totemticker', get_template_directory_uri() . '/js/jquery.totemticker.js', 'jquery', '', true);
	wp_register_script('carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', 'jquery', '6.2.1', true);
	wp_register_script('lwtCountdown', get_template_directory_uri() . '/js/jquery.lwtCountdown-1.0.js', 'jquery', '', true);
	wp_register_script('customInput', get_template_directory_uri() . '/js/jquery.customInput.js', 'jquery', '', true);
	wp_register_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.js', 'jquery', '1.0.0', true);
	wp_register_script('custom_scroll', get_template_directory_uri() . '/js/custom_scroll.js', 'jquery', '1.0.0', true);
	wp_register_script('masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js', 'jquery', '3.1.5', true);
	wp_register_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', 'jquery', '3.1.8', true);
	wp_register_script('masonry_init', get_template_directory_uri() . '/js/masonry_init.js', 'masonry', '3.1.5', true);
	wp_register_script('adblock_init', get_template_directory_uri() . '/js/adblock_notify.js', 'jquery', '1.0.0', true);
	wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', 'jquery', '2.0.2', true);
	wp_register_script('masonry_init_infauto', get_template_directory_uri() . '/js/masonry_init_infauto.js', 'jquery', '1.0.0', true);	
	wp_register_script('masonry_init_infclick', get_template_directory_uri() . '/js/masonry_init_scroll_on_click.js', 'jquery', '1.0.0', true);
	wp_register_script('jquery.nouislider', get_template_directory_uri() . '/js/jquery.nouislider.full.min.js', 'jquery', '7.0.0', true);
	wp_register_script( 'zeroclipboard', get_template_directory_uri() . '/js/zeroclipboard/ZeroClipboard.min.js', array( 'jquery' ), '2.1.6' );
	wp_register_script( 'custom_pretty', get_template_directory_uri() . '/shortcodes/js/custom_pretty.js', 'jquery', '1.0', true );
	wp_register_script('wpsm_googlemap',  get_template_directory_uri() . '/shortcodes/js/wpsm_googlemap.js', array('jquery'), '', true);
	wp_register_script('wpsm_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '', true);
	wp_register_script('tipsy', get_template_directory_uri() . '/shortcodes/js/jquery.tipsy.js', array('jquery'), '1.0.0'); // tipsy 		

}
}

if(!is_admin()) add_action('wp_enqueue_scripts', 'rehub_enqueue_scripts');
if( !function_exists('rehub_enqueue_scripts') ) {
function rehub_enqueue_scripts() {

	wp_enqueue_style('style');
	wp_enqueue_style('responsive');
	wp_enqueue_style('rehub_shortcode');	
	if (rehub_option('font_fallback') == '1') {wp_enqueue_style('font-awesome-fallback');} else {wp_enqueue_style('font-awesome');} 
	wp_enqueue_style('default_font', '//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,cyrillic');
	wp_enqueue_script('modernizr');
	wp_enqueue_script('rehub');
	if (class_exists('Woocommerce')) {wp_enqueue_style( 'rehub-woocommerce' );}
    if (class_exists('bbPress' )) {wp_enqueue_style('bbpress_css');}	
	if (rehub_option('rehub_ecwid_enable')) {wp_enqueue_style( 'ecwid' );}	
	if (rehub_option('rehub_sticky_nav')) {wp_enqueue_script( 'sticky' );}
	//wp_enqueue_script('customInput');

	$translation_array = array( 
		'back' => __( 'back', 'rehub_framework' ), 
		'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ),
		'templateurl' => get_template_directory_uri(),
		'fin' => __( 'That\'s all', 'rehub_framework' ),	  
	);
	if(rehub_option('rehub_target_blank') =='1') {$translation_array['target_blank'] = 'yes';}
	if(rehub_option('rehub_rel_nofollow') =='1') {$translation_array['rel_nofollow'] = 'yes';}
	if(rehub_option('rehub_tracking') =='1') {$translation_array['tracking'] = 'yes';}
	wp_localize_script( 'rehub', 'translation', $translation_array );

	$js_vars = array( 
		'fin' => __( 'That\'s all', 'rehub_framework' ),
		'theme_url' => get_template_directory_uri(),		  
	);
	wp_localize_script( 'masonry_init_infauto', 'js_local_vars', $js_vars );
	wp_localize_script( 'masonry_init_infclick', 'js_local_vars', $js_vars );	
	
	if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');

}
}

if( !function_exists('rehub_custom_css') ) {
function rehub_custom_css() {
    return get_template_part('inc/customization');
}
}
add_action( 'wp_head', 'rehub_custom_css' );

// Add specific CSS class by filter
add_filter('body_class','width_body_names');
function width_body_names($classes) {
if (rehub_option('rehub_body_block')) $classes[] = 'block_style';	
	// return the $classes array
	return $classes;
}

/*** Other essensials ***/
if ( ! isset( $content_width ) )
	$content_width = 765;
	
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'woocommerce' ); // Add theme support for WooCommerce plugin 

// This theme uses its own gallery styles.
add_filter( 'use_default_gallery_style', '__return_false' );

// EDD functions
if( !function_exists('twentytwelve_edd_shortcode_atts_downloads') ) {
function twentytwelve_edd_shortcode_atts_downloads( $atts ) {
	$atts[ 'columns' ]      = '1';
	$atts[ 'full_content' ] = 'no';
	$atts[ 'excerpt' ]      = 'no';
	return $atts;
}
}
add_filter( 'shortcode_atts_downloads', 'twentytwelve_edd_shortcode_atts_downloads' );

if( !function_exists('rate_edd') ) {
function rate_edd() {
  if(rehub_option('rehub_framework_edd_rating') =='1'){
  	echo rehub_get_user_rate('user');
  } 	
}
}
add_action( 'edd_product_details_widget_before_purchase_button', 'rate_edd' );

if( !function_exists('rehub_edd_show_download_sales') ) {
function rehub_edd_show_download_sales() {
	if(rehub_option('rehub_framework_edd_counter') =='1'){
		echo '<p>';
		echo edd_get_download_sales_stats( get_the_ID() ) . ' sales';
		echo '<br/>';
		echo sumobi_edd_get_download_count( get_the_ID() ) . ' downloads';
		echo '</p>';
	}
}
}
add_action( 'edd_product_details_widget_before_purchase_button', 'rehub_edd_show_download_sales' );

if( !function_exists('sumobi_edd_get_download_count') ) { 
function sumobi_edd_get_download_count( $download_id = 0 ) {
	global $edd_logs;
	$meta_query = array(
		'relation'	=> 'AND',
		array(
			'key' => '_edd_log_file_id'
		),
		array(
			'key' => '_edd_log_payment_id'
		)
	);
	return $edd_logs->get_log_count( $download_id, 'file_download', $meta_query );
}
}



//////////////////////////////////////////////////////////////////
// Translation
//////////////////////////////////////////////////////////////////
add_action('after_setup_theme', 'rehub_theme_setup');
if( !function_exists('rehub_theme_setup') ) {
function rehub_theme_setup(){
    load_theme_textdomain('rehub_framework', get_template_directory() . '/lang');
}
}


//////////////////////////////////////////////////////////////////
// REHub Theme Options and Metaboxes
//////////////////////////////////////////////////////////////////
require_once ( locate_template( 'admin/admin.php' ) );


// Here we populate the font face

$font_face_nav      = rehub_option('rehub_nav_font');
$font_face_nav_weight = rehub_option('rehub_nav_font_weight');
$font_face_nav_style  = rehub_option('rehub_nav_font_style');
$font_face_nav_subset  = rehub_option('rehub_nav_font_subset');

$font_face_headings = rehub_option('rehub_headings_font');
$font_face_headings_weight = rehub_option('rehub_headings_font_weight');
$font_face_headings_style  = rehub_option('rehub_headings_font_style');
$font_face_headings_subset  = rehub_option('rehub_headings_font_subset');

$font_face_block   = rehub_option('rehub_block_font');
$font_face_block_weight = rehub_option('rehub_block_font_weight');
$font_face_block_style  = rehub_option('rehub_block_font_style');
$font_face_block_subset  = rehub_option('rehub_block_font_subset');

$font_face_slider   = rehub_option('rehub_slider_font');
$font_face_slider_weight = rehub_option('rehub_slider_font_weight');
$font_face_slider_style  = rehub_option('rehub_slider_font_style');
$font_face_slider_subset  = rehub_option('rehub_slider_font_subset');

$font_face_body   = rehub_option('rehub_body_font');
$font_face_body_weight = rehub_option('rehub_body_font_weight');
$font_face_body_style  = rehub_option('rehub_body_font_style');
$font_face_body_subset  = rehub_option('rehub_body_font_subset');


// Add the font to the helper class
VP_Site_GoogleWebFont::instance()->add($font_face_nav, $font_face_nav_weight, $font_face_nav_style, $font_face_nav_subset);
VP_Site_GoogleWebFont::instance()->add($font_face_headings, $font_face_headings_weight, $font_face_headings_style, $font_face_headings_subset);
VP_Site_GoogleWebFont::instance()->add($font_face_block, $font_face_block_weight, $font_face_block_style, $font_face_block_subset);
VP_Site_GoogleWebFont::instance()->add($font_face_slider, $font_face_slider_weight, $font_face_slider_style, $font_face_slider_subset);
VP_Site_GoogleWebFont::instance()->add($font_face_body, $font_face_body_weight, $font_face_body_style, $font_face_body_subset);

// embed font function
function rehub_embed_fonts()
{
   VP_Site_GoogleWebFont::instance()->register_and_enqueue();
}
add_action('wp_enqueue_scripts', 'rehub_embed_fonts');

//////////////////////////////////////////////////////////////////
// Register WordPress menus
//////////////////////////////////////////////////////////////////
add_action( 'after_setup_theme', 'rehub_register_my_menus' );

if( !function_exists('rehub_register_my_menus') ) {
function rehub_register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'rehub_framework' ),
			'top-menu' => __( 'Top Menu', 'rehub_framework' ),
		)
	);
}
}


class Rehub_Walker extends Walker_Nav_Menu
{	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= ! empty( $item->description ) ? '<span class="subline">' . $item->description. '</span>' : '';
		$item_output .= $args->link_after . '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}	
}


function add_menu_for_blank(){
	echo '<nav class="top_menu"><ul class="menu"><li><a href="/wp-admin/nav-menus.php" target="_blank">Click to Add your menu</a></li></ul></nav>';
}
function add_top_menu_for_blank(){
	echo '<div class="top-nav"><ul class="menu"><li><a href="/wp-admin/nav-menus.php" target="_blank">Click to Add your menu</a></li></ul></div>';
}


//////////////////////////////////////////////////////////////////
// Resizer
//////////////////////////////////////////////////////////////////
require_once('inc/BFI_Thumb.php');
@define( BFITHUMB_UPLOAD_DIR, 'thumbs_dir');

//////////////////////////////////////////////////////////////////
// Post thumbnails
//////////////////////////////////////////////////////////////////

add_action( 'after_setup_theme', 'rehub_image_sizes' );
if ( !function_exists( 'rehub_image_sizes' ) ) {
	function rehub_image_sizes() {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 765, 0, true );
		add_image_size( 'grid_news', 336, 220, true );
		add_image_size( 'feature_slider', 765, 460, true );
		add_image_size( 'med_thumbs', 123, 90, true );
		add_image_size( 'medium_news', 370, 220, true );
		add_image_size( 'news_big', 378, 310, true );
		add_image_size( 'video_big', 474, 342, true );
		add_image_size( 'video_narrow', 270, 110, true );
	}
}


// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

//////////////////////////////////////////////////////////////////
// Get thumbnail
//////////////////////////////////////////////////////////////////
function get_post_thumb(){
	global $post ;
	if ( has_post_thumbnail($post->ID) ){
		$image_id = get_post_thumbnail_id($post->ID);  
		$image_url = wp_get_attachment_image_src($image_id,'full');  
		$image_url = $image_url[0];
		return $image_url;
	}
}

//////////////////////////////////////////////////////////////////
// Thumbnail function
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_thumb') ) {
function wpsm_thumb( $size = 'small' ){
	global $post;
		if( $size == 'medium_news' ){$width = 370; $height = 220; $nothumb = get_template_directory_uri() . '/images/default/noimage_370_220.png' ;}
		elseif( $size == 'med_thumbs' ){$width = 123; $height = 90; $nothumb = get_template_directory_uri() . '/images/default/noimage_123_90.png' ;}	
		elseif( $size == 'feature_slider' ){$width = 765; $height = 460; $nothumb = get_template_directory_uri() . '/images/default/noimage_765_460.jpg' ;}
		elseif( $size == 'video_big' ){$width = 474; $height = 342; $nothumb = get_template_directory_uri() . '/images/default/noimage_474_342.png' ;}
		elseif( $size == 'video_narrow' ){$width = 270; $height = 110; $nothumb = get_template_directory_uri() . '/images/default/noimage_270_110.png' ;}
		elseif( $size == 'news_big' ){$width = 378; $height = 310; $nothumb = get_template_directory_uri() . '/images/default/noimage_378_310.png' ;}
		elseif( $size == 'grid_news' ){$width = 336; $height = 220; $nothumb = get_template_directory_uri() . '/images/default/noimage_336_220.png' ;}
		else{ $width = 123; $height = 90; $nothumb = get_template_directory_uri() . '/images/default/noimage_123_90.png' ;}	
	
	if( rehub_option( 'aq_resize') == 1 ){
		if( rehub_option( 'aq_resize_crop') == '1') {$params = array( 'width' => $width, 'quality' =>'100');}
		else {$params = array( 'width' => $width, 'height' => $height, 'crop' => true, 'quality' =>'100');}
		$img = get_post_thumb(); 
		if(!empty($img)){ ?>
			<img src="<?php echo bfi_thumb( $img, $params ); ?>" alt="<?php the_title_attribute(); ?>" />
	    <?php } elseif ((vp_metabox('rehub_post.rehub_framework_post_type') == 'video') && (vp_metabox('rehub_post.video_post.0.video_post_embed_url') !='')) {?>	
	     	<?php $img_video_url = vp_metabox('rehub_post.video_post.0.video_post_embed_url'); $img_video = parse_video_url($img_video_url, 'hqthumb');?>	
        	<img src="<?php echo $img_video ?>" alt="<?php the_title_attribute(); ?>" />
        <?php } else {?>
			<img src="<?php echo $nothumb; ?>" alt="<?php the_title_attribute(); ?>" />
		<?php }  

	}else{
		$image_id = get_post_thumbnail_id($post->ID);  
		$image_url = wp_get_attachment_image($image_id, $size , false, array( 'alt'   => get_the_title() ,'title' =>  get_the_title()  )); 
		if(!empty($image_url)){ ?>
			<?php echo $image_url; ?>
	    <?php } elseif ((vp_metabox('rehub_post.rehub_framework_post_type') == 'video') && (vp_metabox('rehub_post.video_post.0.video_post_embed_url') !='')) {?>	
	     	<?php $img_video_url = vp_metabox('rehub_post.video_post.0.video_post_embed_url'); $img_video = parse_video_url($img_video_url, 'hqthumb');?>	
        	<img src="<?php echo $img_video ?>" alt="<?php the_title_attribute(); ?>"/>
        <?php } else {?>
			<img src="<?php echo $nothumb; ?>" alt="<?php the_title_attribute(); ?>" />
		<?php } 
	}
}	
}


//////////////////////////////////////////////////////////////////
// Exclude posts
//////////////////////////////////////////////////////////////////

function rehub_exclude_feature_posts()
{						
		// check which featured area layout is activated
		if(rehub_option('rehub_featured_select') == '1') :				
				$exclude_posts_slider = rehub_option('rehub_featured_slider');
			    $exclude_posts_right = rehub_option('rehub_featured_right');
			    $exclude_posts = array_merge($exclude_posts_slider,$exclude_posts_right);
				return $exclude_posts;
				
			else :
			
				$args = array(
					'showposts' => 5,
					'meta_query' => array(
						array(
							'key' => 'is_featured',
							'value' => '1',
						)
					)
				 );
				$postslist = get_posts( $args );
				
				foreach($postslist as $post) {
					$exclude_posts[] = $post->ID;
				}
				return $exclude_posts;
		endif;

}

//////////////////////////////////////////////////////////////////
// Icons for post formats
//////////////////////////////////////////////////////////////////

if( !function_exists('rehub_formats_icons') ) {
function rehub_formats_icons($editor='no')
{

	if(vp_metabox('rehub_post.rehub_framework_post_type') == 'video') {
		echo '<span class="overlay_post_formats"><i class="fa fa-play-circle"></i></span>';
	} elseif(vp_metabox('rehub_post.rehub_framework_post_type') == 'gallery') {
		echo '<span class="overlay_post_formats review_formats_gallery"><i class="fa fa-camera"></i></span>';
	} elseif(vp_metabox('rehub_post.rehub_framework_post_type') == 'music') {
		echo '<span class="overlay_post_formats"><i class="fa fa-music"></i></span>';
	}
	elseif(vp_metabox('rehub_post.rehub_framework_post_type') == 'review') {
		if(vp_metabox('rehub_post.review_post.0.review_post_schema_type') == 'review_post_review_product') {
			$review_aff_link = vp_metabox('rehub_post.review_post.0.review_post_product.0.review_aff_link');
			if(function_exists('thirstyInit') && !empty($review_aff_link)) {
				$linkpost = get_post($review_aff_link); 
				$offer_price = get_post_meta( $linkpost->ID, 'rehub_aff_price', true ); 
				$offer_price_old = get_post_meta( $linkpost->ID, 'rehub_aff_price_old', true );
			}
			else {
		        $offer_price = vp_metabox('rehub_post.review_post.0.review_post_product.0.review_post_product_price');
		        $offer_price_old = vp_metabox('rehub_post.review_post.0.review_post_product.0.review_post_product_price_old');				
			}
			if ( !empty($offer_price) && !empty($offer_price_old) ) {
				$offer_pricesale = preg_replace("/[^0-9.]/","", $offer_price); //Clean price from currence symbols
				$offer_priceold = preg_replace("/[^0-9.]/","", $offer_price_old); //Clean price from currence symbols
				$off_proc = 0 -(100 - ($offer_pricesale / $offer_priceold) * 100);
				$off_proc = round($off_proc);
				echo '<span class="overlay_post_formats sale_format"><i class="fa fa-tag"></i> <span>'.$off_proc.'%</span></span>';
			}		
		}
	}

	if($editor=='full' && vp_metabox('rehub_post_side.is_editor_choice') == '1') {
		echo '<span class="overlay_editor"><i class="fa fa-trophy"></i><span>'.__("Editor's choice", "rehub_framework").'</span></span>';
	}
	elseif($editor=='small' && vp_metabox('rehub_post_side.is_editor_choice') == '1') {
		echo '<span class="overlay_editor"><i class="fa fa-trophy"></i></span>';
	}	
}
}

if( !function_exists('rehub_format_score') ) {
function rehub_format_score($size = 'small', $type = 'star' )
{
	if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review') {
		$overall_score_icon = rehub_get_overall_score();
		$total = $overall_score_icon * 10;
		if ($overall_score_icon !='0') {
			if ($type == 'star') {
				echo '<div class="star-'.$size.'"><span class="stars-rate"><span style="width: '.$total.'%;"></span></span></div>';
			}
			elseif ($type == 'square') {
				echo '<span class="overlay_post_formats review_formats_score">'.$overall_score_icon.'</span>';
			}
			elseif ($type == 'line') { ?>
	            <div class="rate-line rate-line-inner<?php if (rehub_option('color_type_review') == 'multicolor') {echo ' colored_rate_bar';} ?>">
                    <div class="line" data-percent="<?php echo $total;?>%"> 
                        <span class="filled r_score_<?php echo round($overall_score_icon); ?>"><?php echo $overall_score_icon ?></span>
                    </div>
                </div>
			<?php
			}			
		}	
	}
}
}

if( !function_exists('meta_all') ) {
function meta_all ($time_exist, $cats_exist, $admin_exist ){   
	if(rehub_option('exclude_date_meta') == 0 && ($time_exist != false)){ ?>
 		<span class="date"><?php the_time('F j, Y'); ?></span>	
	<?php }
	if(rehub_option('exclude_cat_meta') == 0 && ($cats_exist != false)){ ?>
		<?php $cat_name = get_cat_name($cats_exist); ?>
		<i class="fa fa-circle"></i><a class="cat" href="<?php echo get_category_link( $cats_exist); ?>"><?php echo $cat_name ?></a>
	<?php }
	if(rehub_option('exclude_author_meta') == 0 && ($admin_exist != false)){ ?>
		<i class="fa fa-circle"></i><a class="admin" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>"><?php echo get_the_author() ?></a>
	<?php }    	
}
}

if( !function_exists('meta_small') ) {
function meta_small ($time_exist, $cats_exist, $comm_exist, $post_views = false ){     
	if(rehub_option('exclude_date_meta') == 0 && ($time_exist != false)){ ?>
 		<span class="date"><?php the_time('F j, Y'); ?></span>&nbsp; 	
	<?php }
	if(rehub_option('exclude_cat_meta') == 0 && ($cats_exist != false)){ ?>
		<?php $cat_name = get_cat_name($cats_exist); ?>
		<a href="<?php echo get_category_link( $cats_exist); ?>" class="cat"><?php echo $cat_name ?></a>
	<?php }
	if(rehub_option('exclude_comments_meta') == 0 && ($comm_exist != false)){ ?>
		<i class="fa fa-circle"></i> <?php comments_popup_link( 'no comments', '1 comment', '% comments', 'comm_meta', ''); ?>
	<?php } 
	if($post_views != false){ ?>
		<?php $rehub_views = get_post_meta (get_the_ID(),'rehub_views',true); if ($rehub_views !='') :?>
			<i class="fa fa-eye"></i> <span><?php echo $rehub_views; ?> </span>
		<?php endif ;?>
	<?php }     	   	
}
}


//////////////////////////////////////////////////////////////////
// Titles for custom block
//////////////////////////////////////////////////////////////////
if( !function_exists('title_custom_block') ) {
function title_custom_block ($title_enable, $title_name, $title_position, $title_url_title, $title_url_url ){

if (($title_enable) == 1) { 

	if (($title_position) == 'top_title' || ($title_position) =='') { ?>
       <div class="heading"><h5><?php echo $title_name?></h5>
         <?php if (($title_url_title) && ($title_url_url)) : ?>
         		<a href="<?php echo $title_url_url ?>"><?php echo $title_url_title ?></a>
         <?php endif; ?>
       </div>

    <?php } elseif (($title_position) == 'left_title') {?>
    	<div class="heading h-three">
    		<div class="head_section">
    	   		<div><?php echo $title_name?>
    	   		<?php if (($title_url_title) && ($title_url_url)) : ?>
         		<a href="<?php echo $title_url_url ?>"><?php echo $title_url_title ?></a>
                <?php endif; ?>
    	   		</div>
    	   </div>
    	</div> 

    <?php } else {?>
	<div class="heading h-three center">
		<div class="head_section">
	   		<div><?php echo $title_name?>
	   		<?php if (($title_url_title) && ($title_url_url)) : ?>
     		<a href="<?php echo $title_url_url ?>"><?php echo $title_url_title ?></a>
            <?php endif; ?>
	   		</div>
	   </div>
	</div> 

	<?php }	

}

}
}

//////////////////////////////////////////////////////////////////
// Get id and thumbs from youtube/vimeo url
//////////////////////////////////////////////////////////////////
if( !function_exists('parse_video_url') ) {
function parse_video_url($url,$return='embed',$width='',$height='',$rel=0){
    $urls = parse_url($url);

    //url is http://vimeo.com/xxxx
    if($urls['host'] == 'vimeo.com'){
        $vid = ltrim($urls['path'],'/');
    }
    //url is http://youtu.be/xxxx
    else if($urls['host'] == 'youtu.be'){
        $yid = ltrim($urls['path'],'/');
    }
    //url is http://www.youtube.com/embed/xxxx
    else if(strpos($urls['path'],'embed') == 1){
        $yid = end(explode('/',$urls['path']));
    }
     //url is xxxx only
    else if(strpos($url,'/')===false){
        $yid = $url;
    }
    //http://www.youtube.com/watch?feature=player_embedded&v=m-t4pcO99gI
    //url is http://www.youtube.com/watch?v=xxxx
    else{
        parse_str($urls['query']);
        $yid = $v;
        if(!empty($feature)){
            $yid = end(explode('v=',$urls['query']));
            $arr = explode('&',$yid);
            $yid = $arr[0];
        }
    }
  if(isset($yid)) {
    
    //return embed iframe
    if($return == 'embed'){
        return '<iframe width="'.($width?$width:765).'" height="'.($height?$height:430).'" src="//www.youtube.com/embed/'.$yid.'?rel='.$rel.'&enablejsapi=1" frameborder="0" ebkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

    }
    //return normal thumb
    else if($return == 'thumb' || $return == 'thumbmed'){
        return 'http://i1.ytimg.com/vi/'.$yid.'/default.jpg';
    }
    //return hqthumb
    else if($return == 'hqthumb' ){
        return 'http://i1.ytimg.com/vi/'.$yid.'/hqdefault.jpg';
    }
    // else return id
    else{
        return $yid;
    }
  }
  else if($vid) {
  $vimeoObject = json_decode(file_get_contents("http://vimeo.com/api/v2/video/".$vid.".json"));
   if (!empty($vimeoObject)) {
      //return embed iframe
      if($return == 'embed'){
      return '<iframe width="'.($width?$width:$vimeoObject[0]->width).'" height="'.($height?$height:$vimeoObject[0]->height).'" src="//player.vimeo.com/video/'.$vid.'?title=0&byline=0&portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
    }
    //return normal thumb
    else if($return == 'thumb'){
      return $vimeoObject[0]->thumbnail_small;
    }
    //return medium thumb
    else if($return == 'thumbmed'){
      return $vimeoObject[0]->thumbnail_medium;
    }
    //return hqthumb
    else if($return == 'hqthumb'){
      return $vimeoObject[0]->thumbnail_large;
    }
    // else return id
    else{
      return $vid;
    }
   }
  }
}
}


//////////////////////////////////////////////////////////////////
// EXCERPT
//////////////////////////////////////////////////////////////////


// Create the Custom Excerpts callback
if( !function_exists('kama_excerpt') ) {
function kama_excerpt($args=''){
	global $post;
		parse_str($args, $i);
		$maxchar 	 = isset($i['maxchar']) ?  (int)trim($i['maxchar'])		: 350;
		$text 		 = isset($i['text']) ? 			trim($i['text'])		: '';
		$save_format = isset($i['save_format']) ?	trim($i['save_format'])			: false;
		$echo		 = isset($i['echo']) ? 			false		 			: true;

	$out ='';	
	if (!$text){
		$out = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
		$out = preg_replace ("!\[/?.*\]!U", '', $out ); //delete shortcodes:[singlepic id=3]
		// for <!--more-->
		//if( !$post->post_excerpt && strpos($post->post_content, '<!--more-->') ){
		//	preg_match ('/(.*)<!--more-->/s', $out, $match);
		//	$out = str_replace("\r", '', trim($match[1], "\n"));
		//	$out = preg_replace( "!\n\n+!s", "</p><p>", $out );
		//	$out = "<p>". str_replace( "\n", "<br />", $out ) ."</p>";
		//	if ($echo)
		//		return print $out;
		//	return $out;
		//}
	}

	$out = $text.$out;
	if (!$post->post_excerpt)
		$out = strip_tags($out, $save_format);

	if ( iconv_strlen($out, 'utf-8') > $maxchar ){
		$out = iconv_substr( $out, 0, $maxchar, 'utf-8' );
		$out = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $out); //delete last word
	}

	if($save_format){
		$out = str_replace( "\r", '', $out );
		$out = preg_replace( "!\n\n+!", "</p><p>", $out );
		$out = "<p>". str_replace ( "\n", "<br />", trim($out) ) ."</p>";
	}

	if($echo) return print $out;
	return $out;
}
}

// login shortcode
if(!function_exists('wpsm_login_page')) {
function wpsm_login_page( $atts, $content = null ) {
	ob_start(); 
	rehub_login_form();
	$output = ob_get_contents();
	ob_end_clean();
	return $output; 
}
add_shortcode('wpsm_login_form', 'wpsm_login_page');
}


//////////////////////////////////////////////////////////////////
// POST VIEW FUNCTION
//////////////////////////////////////////////////////////////////
add_action('wp_head', 'rehub_postviews');
if( !function_exists('rehub_postviews') ) {
function rehub_postviews() {
$meta_key		= 'rehub_views';
$who_count 		= 0; 
$exclude_bots 	= 1;

global $user_ID, $post;
	if(is_singular()) {
		$id = (int)$post->ID;
		static $post_views = false;
		if($post_views) return true;
		$post_views = (int)get_post_meta($id,$meta_key, true);
		$should_count = false;
		switch( (int)$who_count ) {
			case 0: $should_count = true;
				break;
			case 1:
				if( (int)$user_ID == 0 )
					$should_count = true;
				break;
			case 2:
				if( (int)$user_ID > 0 )
					$should_count = true;
				break;
		}
		if( (int)$exclude_bots==1 && $should_count ){
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
			$bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
			if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
				$should_count = false;
		}

		if($should_count)
			if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
	}
	return true;
}
}


//////////////////////////////////////////////////////////////////
// ADD REVIEW FUNCTIONS
//////////////////////////////////////////////////////////////////
if (rehub_option('type_user_review') == 'full_review' && rehub_option('type_total_score') == 'user') {include (TEMPLATEPATH . '/functions/user_review_no_editor.php');}
include (TEMPLATEPATH . '/functions/review_functions.php');
if (rehub_option('type_user_review') == 'full_review') {include (TEMPLATEPATH . '/functions/user_review_functions.php');}


//////////////////////////////////////////////////////////////////
// COMMENTS LAYOUT
//////////////////////////////////////////////////////////////////

if( !function_exists('rehub_framework_comments') ) {
function rehub_framework_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;		
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="commbox">
			<div class="comment-author vcard clearfix">
            	<?php edit_comment_link(__('Edit', 'rehub_framework')); ?>
				<?php comment_reply_link(array_merge( $args, array('reply_text' => __(' Reply', 'rehub_framework'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>                    
				<?php echo get_avatar($comment,$args['avatar_size']); ?>
				<span class="fn"><?php echo get_comment_author_link(); ?></span>
				<span class="time"><?php printf(__('%1$s at %2$s', 'rehub_framework'), get_comment_date(),  get_comment_time()) ?></span>
                <?php if ($comment->comment_approved == '0') : ?><div class="ap_waiting"><em><?php _e('Comment awaiting for approval', 'rehub_framework'); ?></em></div><?php endif; ?>					
			</div>
			<?php if (rehub_option('type_user_review') == 'full_review') :?>               
	          	<?php $userCriteria = get_comment_meta(get_comment_ID(), 'user_criteria', true);
				if(is_array($userCriteria) && !empty($userCriteria)) :?> 
	              <div class="comment-content-withreview">
	                   <?php attach_comment_criteria_raitings () ;?>
	              </div>   
	     		<?php else :?>
	               <div class="comment-content"><?php comment_text(); ?></div>
				<?php endif; ?>
	     	<?php else :?>
	            <div class="comment-content"><?php comment_text(); ?></div>
			<?php endif; ?>			 
		</div>
	<?php 
}
}



//////////////////////////////////////////////////////////////////
// Category custom fields
//////////////////////////////////////////////////////////////////

add_action('admin_init', 'category_custom_fields', 1);
if( !function_exists('category_custom_fields') ) {
function category_custom_fields()
    {
        add_action('edit_category_form_fields', 'category_custom_fields_form');
        add_action('edited_category', 'category_custom_fields_save');
        add_action( 'create_category', 'category_custom_fields_save'); 
        add_action( 'category_add_form_fields', 'category_custom_fields_form_new');

    }
}    

if( !function_exists('category_custom_fields_form') ) {
function category_custom_fields_form($tag)
    {
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style( 'wp-color-picker' );
?>
        <tr class="form-field color_cat_grade">
        	<th scope="row" valign="top"><label><?php _e('Cat color','rehub_framework'); ?></label></th>
        	<td>
        		<input type="text" name="Cat_meta[cat_color]" id="Cat_meta[cat_color]" size="25" style="width:60%;" value="<?php echo $cat_meta['cat_color'] ? $cat_meta['cat_color'] : ''; ?>" data-default-color="#E43917"><br />
	            <script type="text/javascript">
	    			jQuery(document).ready(function($) {   
	        			$('.color_cat_grade input').wpColorPicker();
	    			});             
	    		</script>
                <span class="description"><?php _e('Set category color. Note, this color will be used under white text','rehub_framework'); ?></span>
            </td>
        </tr>
        <tr class="form-field">
        	<th scope="row" valign="top"><label><?php _e('Target url','rehub_framework'); ?></label></th>
        	<td>
        		<input type="text" name="Cat_meta[cat_banner_url]" id="Cat_meta[cat_banner_url]" size="25" style="width:60%;" value="<?php echo $cat_meta['cat_banner_url'] ? $cat_meta['cat_banner_url'] : ''; ?>"><br />
                <span class="description"><?php _e('Set category banner target url or left blank for display banner image without url','rehub_framework'); ?></span>
            </td>
        </tr> 
        <tr class="form-field">
        	<th scope="row" valign="top"><label><?php _e('Category banner image url','rehub_framework'); ?></label></th>
        	<td>
        		<input type="text" name="Cat_meta[cat_image_url]" id="Cat_meta[cat_image_url]" size="25" style="width:60%;" value="<?php echo $cat_meta['cat_image_url'] ? $cat_meta['cat_image_url'] : ''; ?>"><br />
                <span class="description"><?php _e('Set url to image of banner','rehub_framework'); ?></span>
            </td>
        </tr>          
<?php
    }
}    

if( !function_exists('category_custom_fields_form_new') ) {
function category_custom_fields_form_new($tag)
    {
        $t_id = $tag->term_id;
        $cat_meta = get_option("category_$t_id");
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style( 'wp-color-picker' );
?>
        <div class="form-field color_cat_grade">
        	<label><?php _e('Cat color','rehub_framework'); ?></label>        	
        		<input type="text" name="Cat_meta[cat_color]" id="Cat_meta[cat_color]" size="25" style="width:60%;" value="<?php echo $cat_meta['cat_color'] ? $cat_meta['cat_color'] : ''; ?>" data-default-color="#E43917"><br />
	            <script type="text/javascript">
	    			jQuery(document).ready(function($) {   
	        			$('.color_cat_grade input').wpColorPicker();
	    			});             
	    		</script>
                <span class="description"><?php _e('Set category color. Note, this color will be used under white text','rehub_framework'); ?></span> 
        </div>
        <div class="form-field">
        	<label><?php _e('Target url','rehub_framework'); ?></label>  	
       		<input type="text" name="Cat_meta[cat_banner_url]" id="Cat_meta[cat_banner_url]" size="25" style="width:60%;" value="<?php echo $cat_meta['cat_banner_url'] ? $cat_meta['cat_banner_url'] : ''; ?>"><br />
            <span class="description"><?php _e('Set category banner target url or left blank for display banner image without url','rehub_framework'); ?></span>        
        </div> 
        <div class="form-field">
        	<label><?php _e('Category banner image url','rehub_framework'); ?></label>
        		<input type="text" name="Cat_meta[cat_image_url]" id="Cat_meta[cat_image_url]" size="25" style="width:60%;" value="<?php echo $cat_meta['cat_image_url'] ? $cat_meta['cat_image_url'] : ''; ?>"><br />
                <span class="description"><?php _e('Set url to image of banner','rehub_framework'); ?></span>     
        </div>         
<?php
    }    
}

if( !function_exists('category_custom_fields_save') ) {    
function category_custom_fields_save($term_id)
    {
        if (isset($_POST['Cat_meta'])) {
            $t_id = $term_id;
            $cat_meta = get_option("category_$t_id");
            $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key) {
                if (isset($_POST['Cat_meta'][$key])) {
                    $cat_meta[$key] = $_POST['Cat_meta'][$key];
                }
            }
            //save the option array
            update_option("category_$t_id", $cat_meta);
        }
    }
}    

// A callback function to add a custom field to our "presenters" taxonomy 
if( !function_exists('shopimage_taxonomy_custom_fields') ) { 
function shopimage_taxonomy_custom_fields($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
?>  
  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="brand_image"><?php _e('Shop image', 'rehub_framework'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="term_meta[brand_image]" id="term_meta[brand_image]" size="25" style="width:60%;" value="<?php echo $term_meta['brand_image'] ? $term_meta['brand_image'] : ''; ?>"><br />  
        <span class="description"><?php _e('Add url to default image of affiliate shop', 'rehub_framework'); ?></span>  
    </td>  
</tr>  
  
<?php  
} 
}

// A callback function to add a custom field to our "presenters" taxonomy 
if( !function_exists('shopimage_taxonomy_custom_fields_new') ) { 
function shopimage_taxonomy_custom_fields_new($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
?>  
  
<div class="form-field">  
        <label for="brand_image"><?php _e('Shop image', 'rehub_framework'); ?></label>  
        <input type="text" name="term_meta[brand_image]" id="term_meta[brand_image]" size="25" style="width:60%;" value="<?php echo $term_meta['brand_image'] ? $term_meta['brand_image'] : ''; ?>"><br />  
        <span class="description"><?php _e('Add url to default image of affiliate shop', 'rehub_framework'); ?></span>   
</div>  
  
<?php  
}  
}

// A callback function to save our extra taxonomy field(s) 
if( !function_exists('rehub_save_taxonomy_custom_fields') ) { 
function rehub_save_taxonomy_custom_fields( $term_id ) {  
    if ( isset( $_POST['term_meta'] ) ) {  
        $t_id = $term_id;  
        $term_meta = get_option( "taxonomy_term_$t_id" );  
        $cat_keys = array_keys( $_POST['term_meta'] );  
            foreach ( $cat_keys as $key ){  
            if ( isset( $_POST['term_meta'][$key] ) ){  
                $term_meta[$key] = $_POST['term_meta'][$key];  
            }  
        }  
        //save the option array  
        update_option( "taxonomy_term_$t_id", $term_meta );  
    }  
} 
}


if(function_exists('thirstyInit')) { add_action('admin_init', 'aff_cat_custom_fields', 1);}
if( !function_exists('aff_cat_custom_fields') ) {
function aff_cat_custom_fields() {    
    // Add the fields to the "presenters" taxonomy, using our callback function  
	add_action( 'thirstylink-category_edit_form_fields', 'shopimage_taxonomy_custom_fields', 10, 2 );  
    // Save the changes made on the "presenters" taxonomy, using our callback function  
	add_action( 'edited_thirstylink-category', 'rehub_save_taxonomy_custom_fields', 10, 2 ); 
    add_action( 'create_thirstylink-category', 'rehub_save_taxonomy_custom_fields'); 
    add_action( 'thirstylink-category_add_form_fields', 'shopimage_taxonomy_custom_fields_new');
}
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_action('admin_init', 'woo_tag_custom_fields', 1);
}
if( !function_exists('woo_tag_custom_fields') ) {
function woo_tag_custom_fields() {    
    // Add the fields to the "presenters" taxonomy, using our callback function  
	add_action( 'product_tag_edit_form_fields', 'shopimage_taxonomy_custom_fields', 10, 2 );  
    // Save the changes made on the "presenters" taxonomy, using our callback function  
	add_action( 'edited_product_tag', 'rehub_save_taxonomy_custom_fields', 10, 2 ); 
    add_action( 'create_product_tag', 'rehub_save_taxonomy_custom_fields'); 
    add_action( 'product_tag_add_form_fields', 'shopimage_taxonomy_custom_fields_new');
}
}	


//////////////////////////////////////////////////////////////////
// Pagination
//////////////////////////////////////////////////////////////////

if( !function_exists('rehub_pagination') ) {
function rehub_pagination() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<ul class="page-numbers">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>&hellip;</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>&hellip;</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul>' . "\n";

}
}


//////////////////////////////////////////////////////////////////
// Breadcrumbs
//////////////////////////////////////////////////////////////////
if( !function_exists('kama_breadcrumbs') ) {
function kama_breadcrumbs( $sep=' &#187; ' ){

	global $post, $wp_query, $wp_post_types;
	// for localization
	$l = array(
		'home' => __('Home', 'rehub_framework')
		,'paged' => __('Page %s', 'rehub_framework')
		,'404' => __('Error 404', 'rehub_framework')
		,'search' => __('Search results - <b>%s</b>', 'rehub_framework')
		,'author' => __('Author archive: <b>%s</b>', 'rehub_framework')
		,'year' => __('Archive for <b>%s</b> year', 'rehub_framework')
		,'month' => __('Archive for: <b>%s</b>', 'rehub_framework')
		,'day' => ''
		,'attachment' => __('Attachment: %s', 'rehub_framework')
		,'tag' => __('Posts with tag: <b>%s</b>', 'rehub_framework')
		,'tax_tag' => __('%s from "%s" on tag: <b>%s</b>', 'rehub_framework')
	);

	$w1 = '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
	$w2 = '</div>';
	$patt1 = '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">';
	$sep .= '</span>'; 
	$patt = $patt1.'%s</a>';

	if( $paged = $wp_query->query_vars['paged'] ){
		$pg_patt = $patt1;
		$pg_end = '</a>'. $sep . sprintf($l['paged'], $paged);
	}

	$out = '';
	if( is_front_page() )
		return print $w1.($paged?sprintf($pg_patt, home_url()):'') . $l['home'] . $pg_end .$w2;

	elseif( is_404() )
		$out = $l['404']; 

	elseif( is_search() ){
		$out = sprintf($l['search'], $s);
	}
	elseif( is_author() ){
		$q_obj = &$wp_query->queried_object;
		$out = ($paged?sprintf( $pg_patt, get_author_posts_url($q_obj->ID, $q_obj->user_nicename) ):'') . sprintf($l['author'], $q_obj->display_name) . $pg_end;
	}
	elseif( is_year() || is_month() || is_day() ){
		$y_url = get_year_link( $year=get_the_time('Y') );
		$m_url = get_month_link( $year, get_the_time('m') );
		$y_link = sprintf($patt, $y_url, $year);
		$m_link = sprintf($patt, $m_url, get_the_time('F'));
		if( is_year() )
			$out = ($paged?sprintf($pg_patt, $y_url):'') . sprintf($l['year'], $year) . $pg_end;
		elseif( is_month() )
			$out = $y_link . $sep . ($paged?sprintf($pg_patt, $m_url):'') . sprintf($l['month'], get_the_time('F')) . $pg_end;
		elseif( is_day() )
			$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
	}

	// pages
	elseif( $wp_post_types[$post->post_type]->hierarchical ){
		$parent = $post->post_parent;
		$crumbs=array();
		while($parent){
		  $page = &get_post($parent);
		  $crumbs[] = sprintf($patt, get_permalink($page->ID), $page->post_title);
		  $parent = $page->post_parent;
		}
		$crumbs = array_reverse($crumbs);
		foreach ($crumbs as $crumb)
			$out .= $crumb.$sep;
		$out = $out . $post->post_title;
	}
	else // taxonomy
	{
		if( is_singular() ){$taxonomies ='';
			if( ! $taxonomies ){
				$taxonomies = get_taxonomies( array('hierarchical' => true, 'public' => true) );
				if( count( $taxonomies ) == 1 ) $taxonomies = 'category';
			}
			if( $term = get_the_terms( $post->post_parent ? $post->post_parent : $post->ID, $taxonomies ) ){
				$term = array_shift( $term );
			}
		}
		else
			$term = &$wp_query->get_queried_object();

		//if( ! $term && ! is_attachment() )
			//return print "Error: Taxonomy is not defined!"; 

		$pg_term_start = ($paged && $term->term_id) ? sprintf( $pg_patt, get_term_link( (int)$term->term_id, $term->taxonomy ) ) : '';

		if( is_attachment() ){
			if(!$post->post_parent)
				$out = sprintf($l['attachment'], $post->post_title);
			else
				$out = crumbs_tax($term->term_id, $term->taxonomy, $sep, $patt) . sprintf($patt, get_permalink($post->post_parent), get_the_title($post->post_parent) ).$sep.$post->post_title;
		}
		elseif( is_single() )
			$out = crumbs_tax($term->parent, $term->taxonomy, $sep, $patt) . sprintf($patt, get_term_link( (int)$term->term_id, $term->taxonomy ), $term->name). $sep.$post->post_title;

		elseif( ! is_taxonomy_hierarchical( $term->taxonomy ) ){

			if( is_tag() )
				$out = $pg_term_start . sprintf($l['tag'], $term->name) . $pg_end;

			elseif( !$term->term_id ) 
				$home_after = sprintf($patt, '/'. $term->name, $term->label). $pg_end;

			else {
				$post_label = $wp_post_types[$post->post_type]->labels->name;
				$tax_label = $GLOBALS['wp_taxonomies'][$term->taxonomy]->labels->name;
				$out = $pg_term_start . sprintf($l['tax_tag'], $post_label, $tax_label, $term->name) .  $pg_end;
			}
		}

		else
			$out = crumbs_tax($term->parent, $term->taxonomy, $sep, $patt) . $pg_term_start . $term->name . $pg_end;
	}
	$home_after ='';

	if( !empty($post->post_type) && $post->post_type != 'post' && !is_page() && !is_attachment() && !$home_after )
		$home_after = sprintf($patt, '/'. $post->post_type, $wp_post_types[$post->post_type]->labels->name ). $sep;

	if( $post->post_type == 'book' )
		$home_after = sprintf($patt, '/about_book', 'Books'). $sep;

	$home = sprintf($patt, home_url(), $l['home'] ). $sep . $home_after;

	return print $w1. $home . $out .$w2;
}
}

function crumbs_tax($term_id, $tax, $sep, $patt){
	$termlink = array();
	while( (int)$term_id ){
		$term2 = &get_term( $term_id, $tax );
		$termlink[] = sprintf($patt, get_term_link( (int)$term2->term_id, $term2->taxonomy ), $term2->name). $sep;
		$term_id = (int)$term2->parent;
	}
	$termlinks = array_reverse($termlink);
	return implode('', $termlinks);
}


//////////////////////////////////////////////////////////////////
// AUTHOR SOCIAL LINKS
//////////////////////////////////////////////////////////////////
function rehub_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = __('Url of Twitter page', 'rehub_framework');
	$contactmethods['facebook']  = __('Url of Facebook page', 'rehub_framework');
	$contactmethods['google']    = __('Url of Google Plus page', 'rehub_framework');
	$contactmethods['tumblr']    = __('Url of Tumblr page', 'rehub_framework');
	$contactmethods['instagram'] = __('Url of Instagram page', 'rehub_framework');
	$contactmethods['vkontakte'] = __('Url of Vk.com page', 'rehub_framework');
	$contactmethods['youtube'] = __('Url of Youtube page', 'rehub_framework');

	return $contactmethods;
}
add_filter('user_contactmethods','rehub_contactmethods',10,1);


//add widget sidebar functions
include (TEMPLATEPATH . '/functions/sidebar_functions.php');

//add woocommerce functions
include (TEMPLATEPATH . '/functions/woo_functions.php');

//add shortcode functions
include (TEMPLATEPATH . '/shortcodes/shortcodes.php');



//////////////////////////////////////////////////////////////////
// Helper Functions
//////////////////////////////////////////////////////////////////

function rehub_kses($html)
{
	$allow = array_merge(wp_kses_allowed_html( 'post' ), array(
		'link' => array(
			'href'    => true,
			'rel'     => true,
			'type'    => true,
		),
		'script' => array(
			'src' => true,
			'charset' => true,
			'type'    => true,
		),
		'div' => array(
			'data-href' => true,
			'data-width' => true,
			'data-numposts'    => true,
			'data-colorscheme'    => true,
			'class' => true,
			'id' => true,
			'style' => true,
			'title' => true,
			'role' => true,
			'align' => true,
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,			
		)
	));
	return wp_kses($html, $allow);
}


/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if( !function_exists('my_theme_register_required_plugins') ) {
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'WooSidebars (for custom sidebars)', // The plugin name
			'slug'     				=> 'woosidebars', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins/woosidebars.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'ThirstyAffiliates (cloaking affiliate links, creating offers with coupons)', // The plugin name
			'slug'     				=> 'thirstyaffiliates', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins/thirstyaffiliates.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'Visual Composer (enhanced layout builder)', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins/js_composer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),		


		array(
			'name'     				=> 'MDTF (creating directories, search filters and specification)', // The plugin name
			'slug'     				=> 'meta-data-filter', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory() . '/plugins/meta-data-filter.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)	

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'rehub_framework',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'rehub_framework' ),
            'menu_title'                      => __( 'Install Plugins', 'rehub_framework' ),
            'installing'                      => __( 'Installing Plugin: %s', 'rehub_framework' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'rehub_framework' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'rehub_framework' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s. Please, activate only those plug-ins which are necessary to you', 'rehub_framework' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'rehub_framework' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'rehub_framework' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'rehub_framework' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'rehub_framework' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'rehub_framework' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'rehub_framework' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'rehub_framework' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'rehub_framework' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'rehub_framework' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'rehub_framework' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'rehub_framework' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}
}

/**
 * Auto contents shortcode.
 * Author - http://wp-kama.ru
 * Version 0.2
 */
add_filter('the_content', 'make_contents');
if( !function_exists('make_contents') ) {
function make_contents($content){
	global $_mc_contain;

	if( !is_singular() || strpos($content, '[contents')===false )
		return $content;

	$_mc_contain = array();
 
	// get content
	preg_match('~\[contents\s*([^\]]*)\](.*)~s', $content, $m);
	$hds = $m[1] ? trim($m[1]) : 'h2';
	$hds = explode(' ', $hds);
	$hds = array_map('trim', $hds);
	$h = implode('|', $hds);

	// change heading to links
	$_content = $m[2];
	// get count
	preg_match_all('@</('.$h.')>@i', $_content, $n);
	$_mc_contain['all'] = count($n[0]);
	$_content = preg_replace_callback('@<(?:'.$h.')[^>]*>(.*?)</('.$h.')>@is', '_make_contents', $_content);

	// insert content

	if ($_mc_contain['contents'] !='') $contents = implode( "", $_mc_contain['contents'] );
	$out = '';
	$out .= "\n<ul id='c_menu' class='contents'>\n". $contents ."</ul>\n" . $_content;
	$content = str_replace($m[0], $out, $content);

	unset($_mc_contain);

	return $content;
}
}
if( !function_exists('_make_contents') ) {
function _make_contents($match){
	global $_mc_contain;

	$anchor = $match[2] .'_'. ++$_mc_contain['n'] ;

	$li = "\t<li><a href=\"#$anchor\">$match[1]</a></li>\n";
	$index = (int) preg_replace("/[^0-9]/", '', $match[2]);
	$prev_index = ($r =(int) @end($_mc_contain['index'])) ? $r : null;
	$_mc_contain['index'][] = $index;

	// conditional
	$close = $element = '';
	$_mc_contain['open'] ='';
	if( !isset($prev_index) || $prev_index == $index )
		$element = $li;

	elseif( $prev_index < $index ){
		++$_mc_contain['open'];
		$element = "\t<ul>\n$li";
	}
	else {
		if( $prev_index > $index ){
			$close = "\t</ul>\n$li";
			--$_mc_contain['open'];
		} 
	}
	// close if need
	if( $_mc_contain['n'] == $_mc_contain['all'] && $_mc_contain['open'] ){
		$close = "\t</ul>\n";
	}

	$_mc_contain['contents'][] = "$element $close"; 
	$menu_to_top = __('back to menu', 'rehub_framework');

	$out = $_mc_contain['n'] == 1 ? '' : "<a href=\"#c_menu\" style='display:block; text-align:right;' class='rehub_scroll'>".$menu_to_top." &#8593;</a>";
	$out .= "<$match[2] id=\"$anchor\">$match[1]</$match[2]>";

	return $out;
}
}

/***WPSM TOP ***/
add_filter('the_content', 'make_wpsm_toplist');
if( !function_exists('make_wpsm_toplist') ) {
function make_wpsm_toplist($content){
	global $_mc_contain;

	if( !is_singular() || strpos($content, '[wpsm_toplist')===false )
		return $content;

	$_mc_contain = array();

	// get content
	preg_match('~\[wpsm_toplist\s*([^\]]*)\](.*)~s', $content, $m);
	$hds = $m[1] ? trim($m[1]) : 'h2';
	$hds = explode(' ', $hds);
	$hds = array_map('trim', $hds);
	$h = implode('|', $hds);

	// change heading to links
	$_content = $m[2];
	// get count
	preg_match_all('@</('.$h.')>@i', $_content, $n);
	$_mc_contain['all'] = count($n[0]);
	$_content = preg_replace_callback('@<(?:'.$h.')[^>]*>(.*?)</('.$h.')>@is', '_make_wpsm_toplist', $_content);

	// insert content

	if ($_mc_contain['wpsm_toplist'] !='') $wpsm_toplist = implode( "", $_mc_contain['wpsm_toplist'] );
	$out = '';
	$out .= "\n<div id='c_menu'><ol class='wpsm_toplist'>\n". $wpsm_toplist ."</ol></div>\n" . $_content;
	$content = str_replace($m[0], $out, $content);

	unset($_mc_contain);

	return $content;
}
}

if( !function_exists('_make_wpsm_toplist') ) {
function _make_wpsm_toplist($match){
	global $_mc_contain;

	$anchor = 'top'.$match[2] .'_'. ++$_mc_contain['n'] ;

	$li = "\t<li><a href=\"#$anchor\">$match[1] &#8681;</a></li>\n";
	$index = (int) preg_replace("/[^0-9]/", '', $match[2]);
	$prev_index = ($r =(int) @end($_mc_contain['index'])) ? $r : null;
	$_mc_contain['index'][] = $index;

	// conditional
	$close = $element = '';
	$_mc_contain['open'] ='';
	if( !isset($prev_index) || $prev_index == $index )
		$element = $li;

	elseif( $prev_index < $index ){
		++$_mc_contain['open'];
		$element = "\t<ul>\n$li";
	}
	else {
		if( $prev_index > $index ){
			$close = "\t</ul>\n$li";
			--$_mc_contain['open'];
		} 
	}
	// close if need
	if( $_mc_contain['n'] == $_mc_contain['all'] && $_mc_contain['open'] ){
		$close = "\t</ul>\n";
	}

	$_mc_contain['wpsm_toplist'][] = "$element $close"; 
	$menu_to_top = __('back to menu', 'rehub_framework');

	$out = $_mc_contain['n'] == 1 ? '' : "<a href=\"#c_menu\" style='display:block; text-align:right;' class='rehub_scroll'>".$menu_to_top." &#8593;</a>";
	$out .= "<$match[2] id=\"$anchor\" class=\"wpsm_toplist_heading\">$match[1]</$match[2]>";

	return $out;
}
}

//remove some unuseful filter
remove_filter('comments_number', 'dsq_comments_text');
remove_filter('get_comments_number', 'dsq_comments_number');
remove_filter('pre_term_description', 'wp_filter_kses');
add_filter('widget_text', 'do_shortcode');
add_filter( 'category_description', 'do_shortcode' );

if ( !function_exists( 'mdtf_catalog_ordering' ) ) {
	function wpsm_old_mdtf( $atts, $content = null ) {
		  return false;
	}
	add_shortcode('mdf_sort_panel', 'wpsm_old_mdtf');
}

// Open Graph
function re_add_opengraph() {
	global $post;
	echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>"; // Sets the site name to the one in your WordPress settings
	echo "<meta property='og:url' content='" . get_permalink() . "'/>"; // Gets the permalink to the post/page

	if (is_singular()) { // If we are on a blog post/page
        echo "<meta property='og:title' content='" . get_the_title() . "'/>"; // Gets the page title
        echo "<meta property='og:type' content='article'/>"; // Sets the content type to be article.
    } elseif(is_front_page() or is_home()) { // If it is the front page or home page
    	echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>"; // Get the site title
    	echo "<meta property='og:type' content='website'/>"; // Sets the content type to be website.
    }

	if(has_post_thumbnail( get_the_ID() )) { // If the post has a featured image.
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>"; // If it has a featured image, then display this for Facebook
	} 
}
$using_jetpack_publicize = ( class_exists( 'Jetpack' ) && in_array( 'publicize', Jetpack::get_active_modules()) ) ? true : false;
if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin') && $using_jetpack_publicize == false) {
	add_action( 'wp_head', 're_add_opengraph', 5 );
}

//VC init
if (class_exists('WPBakeryVisualComposerAbstract')) {
	if(!function_exists('add_rehub_to_vc')) {
		function add_rehub_to_vc(){
			require_once ( locate_template( 'functions/vc_functions.php' ) );
		}
	}
	if(!function_exists('rehub_vc_styles')) {
		function rehub_vc_styles() {
			wp_enqueue_style('rehub_vc', get_template_directory_uri() .'/functions/vc/vc.css', array(), time(), 'all');
		}
	}
	add_action('init','add_rehub_to_vc', 5);
	add_action('admin_enqueue_scripts', 'rehub_vc_styles');
	if(function_exists('thirstyInit')) { 
		remove_action('init', 'thirstyInit');	
	    add_action('init', 'thirstyInit', 4);
	}    
}

?>