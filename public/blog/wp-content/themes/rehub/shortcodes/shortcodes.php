<?php

if (rehub_option('shortcode_enable') == '1') {
	require_once ( get_template_directory() . '/shortcodes/tinyMCE/tinyMCE.php'); 
}

//////////////////////////////////////////////////////////////////
// Buttons
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_button_shortcode') ) {
function wpsm_shortcode_button( $atts, $content = null ) {
        $atts = shortcode_atts(
			array(
				'color' => 'orange',
				'size' => 'small',
				'icon' => 'none',
				'link' => '',
				'target' => '',
				'border_radius' => '0',
				'rel' => ''
			), $atts);

	$out = '<a href="'.$atts['link'].'"';
    if ($atts['target'] !='') :
    	$out .=' target="'.$atts['target'].'"';
    endif;
    if ($atts['rel'] !='') :
    	$out .=' rel="'.$atts['rel'].'"';
    endif;    
    $out .=' style="border-radius:'.$atts['border_radius'].'" class="wpsm-button '.$atts['color'].' '.$atts['size'].'"><span class="wpsm-button-inner" style="border-radius:'.$atts['border_radius'].'"><span class="fa fa-'.$atts['icon'].'"></span>' .do_shortcode($content). '</span></a>';
    return $out;
}
add_shortcode('wpsm_button', 'wpsm_shortcode_button');
}

//////////////////////////////////////////////////////////////////
// Column
//////////////////////////////////////////////////////////////////

if( !function_exists('wpsm_column_shortcode') ) {
	function wpsm_column_shortcode( $atts, $content = null ){
		extract( shortcode_atts( array(
			'size' => 'one-half',
			'position' =>'first'
		  ), $atts ) );
		  $out = '';
		  // Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		  $content = do_shortcode($content);
		  $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		  $Old     = array( '<br />', '<br>' );
		  $New     = array( '','' );
		  $content = str_replace( $Old, $New, $content );		  
		  $out .= '<div class="wpsm-' . $size . ' wpsm-column-'.$position.'">' . $content . '</div>';
		  if($position == 'last') {
			$out .= '<div class="clearfix"></div>';
		      }
		  return $out;	  
	}
	add_shortcode('wpsm_column', 'wpsm_column_shortcode');
}


//////////////////////////////////////////////////////////////////
// Highlight
//////////////////////////////////////////////////////////////////

if ( !function_exists( 'wpsm_highlight_shortcode' ) ) {
	function wpsm_highlight_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => 'yellow',
		  ),
		  $atts ) );
		  return '<span class="wpsm-highlight wpsm-highlight-'. $color .'">' . do_shortcode( $content ) . '</span>';
	
	}
	add_shortcode('wpsm_highlight', 'wpsm_highlight_shortcode');
}

//////////////////////////////////////////////////////////////////
// Color table
//////////////////////////////////////////////////////////////////
if ( !function_exists( 'wpsm_colortable_shortcode' ) ) {
	function wpsm_colortable_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => 'black',
		  ),
		  $atts ) );
		  // Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		  $content = do_shortcode($content);
		  $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		  $Old     = array( '<br />', '<br>' );
		  $New     = array( '','' );
		  $content = str_replace( $Old, $New, $content );		  
		  return '<div class="wpsm-table wpsm-table-'. $color .'">' . do_shortcode( $content ) . '</div>';
	
	}
	add_shortcode('wpsm_colortable', 'wpsm_colortable_shortcode');
}

//////////////////////////////////////////////////////////////////
// Quote
//////////////////////////////////////////////////////////////////	
	if(!function_exists('wpsm_quote_shortcode')) {
		function wpsm_quote_shortcode($atts, $content) {   
			$out = '';
			$out .= '<blockquote class="wpsm-quote';
			if(!empty($atts['float']) && $atts['float']):
		      $out .= ' align'.$atts['float'].'';
		    endif;  
			$out .= '"';
			if(!empty($atts['width']) && $atts['width']):
		      $out .= 'style="width:'.$atts['width'].'"';
		    endif;
			$out .= '><p>'.$content.'</p>';
			if(!empty($atts['author']) && $atts['author']):
		      $out .= '<cite>'.$atts['author'].'</cite>';
		    endif;
			$out .='</blockquote>';
			return $out;
		} 
		// add the shortcode to system
		add_shortcode('wpsm_quote', 'wpsm_quote_shortcode');
	}

//////////////////////////////////////////////////////////////////
// Dropcap
//////////////////////////////////////////////////////////////////	
if(!function_exists('wpsm_dropcap_shortcode')) {
function wpsm_dropcap_shortcode( $atts, $content = null ) { 
    return '<span class="wpsm_dropcap">'.$content.'</span>';  
}  
add_shortcode("wpsm_dropcap", "wpsm_dropcap_shortcode");  
}	

//////////////////////////////////////////////////////////////////
// Video
//////////////////////////////////////////////////////////////////
if(!function_exists('wpsm_shortcode_AddVideo')) {
function wpsm_shortcode_AddVideo( $atts, $content = null ) {
    @extract($atts);
    if ($schema =='yes') {
		$width  = ($width)  ? $width  :'703' ;
		$height = ($height) ? $height : '395';
    }
    else {
 		$width  = ($width)  ? $width  :'765' ;
		$height = ($height) ? $height : '430';   	
    }
	$title = ($title) ? $title : get_the_title();
	$description = ($description) ? $description : get_the_title();

		if ($schema =='yes') {
			$out = '<div class="media_video clearfix" itemscope itemtype="http://schema.org/VideoObject"><meta content="'.$title.'" itemprop="name"><meta itemprop="thumbnail" content="'.parse_video_url($content, "hqthumb").'"><div class="clearfix inner"><div class="video-container">'.parse_video_url($content, "embed", "$width", "$height").'</div><h4 itemprop="name">'.$title.'</h4><p itemprop="description">'.$description.'</p></div></div>';
		}
		else {	
		$out ='<div class="video-container">'.parse_video_url($content, "embed", "$width", "$height").'</div>';
		}
		
    return $out;
}
add_shortcode('wpsm_video', 'wpsm_shortcode_AddVideo');
}

//////////////////////////////////////////////////////////////////
// Lightbox
//////////////////////////////////////////////////////////////////
if(!function_exists('wpsm_shortcode_lightbox')) {
function wpsm_shortcode_lightbox( $atts, $content = null ) {
	wp_enqueue_script('prettyphoto');
	wp_enqueue_script('custom_pretty');
    @extract($atts);
	if(!isset($title)) {
		$title = '';
	}
	$out = '<a rel="prettyPhoto" href="'.$full.'" title="'.$title.'">' .do_shortcode($content). '</a>';
    return $out;
}
add_shortcode('wpsm_lightbox', 'wpsm_shortcode_lightbox');
}



//////////////////////////////////////////////////////////////////
// Boxes
//////////////////////////////////////////////////////////////////
if(!function_exists('wpsm_shortcode_box')) {
function wpsm_shortcode_box( $atts, $content = null ) {
        $atts = shortcode_atts(
			array(
				'type' => 'info',
				'float' => 'none',
				'textalign' => 'left',
				'width' => 'auto',
			), $atts);
	// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
	$content = do_shortcode($content);
	$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$content = str_replace( $Old, $New, $content );

	$out = '<div class="wpsm_box '.$atts['type'].'_type '.$atts['float'].'float_box" style="text-align:'.$atts['textalign'].'; width:'.$atts['width'].'"><i></i><div>
			' .do_shortcode($content). '
			</div></div>';
    return $out;
}
add_shortcode('wpsm_box', 'wpsm_shortcode_box');
}


//////////////////////////////////////////////////////////////////
// Promoboxes
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_promobox_shortcode') ) {
function wpsm_promobox_shortcode( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
			'background' => '#f8f8f8',
			'border_size' => '',
			'border_color' => '',
			'highligh_color' => '',
			'highlight_position' => '',
			'title' => '',
			'description' => ''
		), $atts));	

	$out = '<div class="wpsm_promobox" style="background-color:'.$background.' !important;';
	if((isset($atts['border_size']) && $atts['border_size']) && (isset($atts['border_color']) && $atts['border_color'])):
		$out .= ' border-width:'.$border_size.';border-color:'.$border_color.'!important; border-style:solid;';
	endif;
	if((isset($atts['highligh_color']) && $atts['highligh_color']) && (isset($atts['highlight_position']) && $atts['highlight_position'])):
		$out .= ' border-'.$highlight_position.'-width:3px !important;border-'.$highlight_position.'-color:'.$highligh_color.'!important;border-'.$highlight_position.'-style:solid';
	endif;
	$out .= '">';
	if((isset($atts['button_link']) && $atts['button_link']) && (isset($atts['button_text']) && $atts['button_text'])):
		$out .= '<a href="'.$atts['button_link'].'" class="continue_btn wpsm-button rehub_main_btn" target="_blank"><span><i class="fa fa-arrow-circle-o-right"></i><strong>'.$atts['button_text'].'</strong></span></a>';
	endif;
	if(isset($atts['title']) && $atts['title']):
		$out .= '<div class="title_promobox">'.$atts['title'].'</div>';
	endif;
	if(isset($atts['description']) && $atts['description']):
		$out.= '<p>'.$atts['description'].'</p>';
	endif;
	$out .= '</div>';
    return $out;
}
add_shortcode('wpsm_promobox', 'wpsm_promobox_shortcode');
}

//////////////////////////////////////////////////////////////////
// Number box
//////////////////////////////////////////////////////////////////

if(!function_exists('wpsm_numbox_shortcode')) {
		function wpsm_numbox_shortcode($atts, $content) {  
			// get the optional style value
			extract(shortcode_atts( array('num' => '1', 'style' => '1'), $atts));
			// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
			$content = do_shortcode($content);
			$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
			$Old     = array( '<br />', '<br>' );
			$New     = array( '','' );
			$content = str_replace( $Old, $New, $content );			
			// return output
		    return "<p class=\"wpsm-numbox wpsm-style$style\"><span>" . $num . "</span>" . $content . "</p>";  
		} 
		// add the shortcode to system
		add_shortcode('wpsm_numbox', 'wpsm_numbox_shortcode');
}

//////////////////////////////////////////////////////////////////
// Numbered heading
//////////////////////////////////////////////////////////////////

if(!function_exists('wpsm_numhead_shortcode')) {
		function wpsm_numhead_shortcode($atts, $content) {  
			// get the optional style value
			extract(shortcode_atts( array('num' => '1', 'style' => '1', 'heading' => '2'), $atts));
			// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
			$content = do_shortcode($content);
			$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
			$Old     = array( '<br />', '<br>' );
			$New     = array( '','' );
			$content = str_replace( $Old, $New, $content );			
			// return output
		    return "<div class=\"wpsm-numhead wpsm-style$style\"><span>" . $num . "</span><h$heading>" . $content . "</h$heading></div>";  
		} 
		// add the shortcode to system
		add_shortcode('wpsm_numhead', 'wpsm_numhead_shortcode');
}

//////////////////////////////////////////////////////////////////
// Titled box
//////////////////////////////////////////////////////////////////

if(!function_exists('wpsm_titlebox_shortcode')) {
		function wpsm_titlebox_shortcode($atts, $content) {   
			// get the optional style value
			extract(shortcode_atts( array('title' => 'Sample title', 'style' => '1'), $atts));
			// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
			$content = do_shortcode($content);
			$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
			$Old     = array( '<br />', '<br>' );
			$New     = array( '','' );
			$content = str_replace( $Old, $New, $content );			
			// return the url
		    return '<div class="wpsm-titlebox wpsm_style_' . $style . '"><strong>' . $title . '</strong><div>'.$content.'</div></div>';  
		} 
		// add the shortcode to system
		add_shortcode('wpsm_titlebox', 'wpsm_titlebox_shortcode');
}

//////////////////////////////////////////////////////////////////
// Code box
//////////////////////////////////////////////////////////////////

if(!function_exists('wpsm_code_shortcode')) {
		function wpsm_code_shortcode($atts, $content) {   
			// get the optional style value
			extract(shortcode_atts( array('style' => '1'), $atts));
			// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
			$content = do_shortcode($content);
			$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
			$Old     = array( '<br />', '<br>' );
			$New     = array( '','' );
			$content = str_replace( $Old, $New, $content );			
			// return the element
		    return '<pre class="wpsm-code wpsm_code_' . $style . '"><code>'. trim($content) .'</code></pre>'; 
			 
		} 
		// add the shortcode to system
		add_shortcode('wpsm_codebox', 'wpsm_code_shortcode');
}

//////////////////////////////////////////////////////////////////
// Accordition
//////////////////////////////////////////////////////////////////

// Main
if( !function_exists('wpsm_accordion_main_shortcode') ) {
	function wpsm_accordion_main_shortcode( $atts, $content = null  ) {	
		// Enque scripts
		wp_enqueue_script('jquery-ui-accordion');	
        
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );
		
		// Display the accordion	
		return '<div class="wpsm-accordion">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'wpsm_accordion', 'wpsm_accordion_main_shortcode' );
}

// Section
if( !function_exists('wpsm_accordion_section_shortcode') ) {
	function wpsm_accordion_section_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
		  'title' => 'Title',
		), $atts ) );
		
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );
		  
	   return '<h3 class="wpsm-accordion-trigger"><a href="#">'. $title .'</a></h3><div>' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'wpsm_accordion_section', 'wpsm_accordion_section_shortcode' );
}

//////////////////////////////////////////////////////////////////
// Testimonial
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_testimonial_shortcode') ) { 
	function wpsm_testimonial_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'by' => ''
		  ), $atts ) );
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );
				  
		$out = '';
		$out .= '<div class="wpsm-testimonial"><div class="wpsm-testimonial-content">';
		$out .= $content;
		$out .= '</div><div class="wpsm-testimonial-author">';
		$out .= $by .'</div></div>';	
		return $out;
	}
	add_shortcode( 'wpsm_testimonial', 'wpsm_testimonial_shortcode' );
}

//////////////////////////////////////////////////////////////////
// Slider
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_shortcode_slider') ) {

	function wpsm_shortcode_slider($atts, $content = null) {
		wp_enqueue_script('flexslider');
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );
				
		$str = '';
		$str .= '<div class="post_slider media_slider blog_slider loading">';
		$str .= do_shortcode($content);
		$str .= '</div>';

		return $str;
	}
	add_shortcode('wpsm_slider', 'wpsm_shortcode_slider');
}


//////////////////////////////////////////////////////////////////
// Post image attachment slider
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_post_slide') ) {
function wpsm_post_slide( $atts, $content = null ) {
		wp_enqueue_script('flexslider');
    @extract($atts);
	return wpsm_get_post_slide();
}
add_shortcode('wpsm_post_images_slider', 'wpsm_post_slide');


function wpsm_get_post_slide() {
        $attachments = get_posts( array(
            'post_type' => 'attachment',
			'post_mime_type' => 'image',
            'posts_per_page' => -1,
            'post_parent' => get_the_ID(),
            'exclude'     => get_post_thumbnail_id()
        ) );

        if ( $attachments ) {

            $out = '<div class="post_slider media_slider blog_slider" id="wpsm_flex_post_at"><ul class="slides">';
            foreach ( $attachments as $attachment ) {

                $thumbimg = wp_get_attachment_image($attachment->ID, 'large', false);               
                $out .= '<li>' . $thumbimg . '</li>';
            }
            $out .='</ul></div>';
            
        }
        return $out;
    }
}

//////////////////////////////////////////////////////////////////
// Recent Posts slider
//////////////////////////////////////////////////////////////////
if( !function_exists('shortcode_recent_posts') ) {
function shortcode_recent_posts($atts, $content = null) {
	wp_enqueue_script('carouFredSel');
	global $post;

	if(!isset($atts['number_posts'])) {
		$atts['number_posts'] = 5;
	}


	$attachment = '';
	$html = '<div class="def-carousel best_from_cat_carousel media_carousel loading"><section class="clearfix">';
	if(!empty($atts['cat_id']) && $atts['cat_id']){

	$args = array(
		'category__in'     => $atts['cat_id'],
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => $atts['number_posts'], // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1
	);
	$recent_posts = new WP_Query($args);
	$cat_name = get_cat_name($atts['cat_id']);
	$category_link = get_category_link( $atts['cat_id']);
	$html .= '<h5>'.__('From category: ', 'rehub_framework').'<a href="'.$category_link.'" class="link_to_cat">'.$cat_name.'</a></h5>';
	} else {
	$args = array(
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => $atts['number_posts'], // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1
	);

		$recent_posts = new WP_Query($args);
	}
	$count = 1;

	$html .= '<ul class="gallery-pics clearfix">';

	while($recent_posts->have_posts()): $recent_posts->the_post();
	$html .='<li>';
		$args = array(
	    'post_type' => 'attachment',
	    'numberposts' => 1,
	    'post_status' => null,
	    'post_mime_type' => 'image',
	    'post_parent' => get_the_ID(),
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'exclude' => get_post_thumbnail_id()
	);
	$attachments = get_posts($args);
	if($attachments || has_post_thumbnail()):
		if(has_post_thumbnail()):
			$img = get_post_thumb();
			$params = array( 'width' => 200, 'height' => 140, 'crop' => true  );
			$resize = bfi_thumb($img, $params);
			$attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id());
			$html .= '<a href="'.get_permalink(get_the_ID()).'" rel=""><img src="'.$resize.'" alt="'.get_the_title().'" /></a>';
		else:
		if ( ! is_array($attachments) ) continue;
            $count = count($attachments);
            $first_attachment = array_shift($attachments);
			$attachment_image = wp_get_attachment_url($first_attachment->ID);
            $params = array( 'width' => 200, 'height' => 140, 'crop' => true  );
			$resize = bfi_thumb($img, $params);
			$attachment_data = wp_get_attachment_metadata($attachment->ID);
			$html .= '<a href="'.get_permalink(get_the_ID()).'"><img src="'. $resize.'" alt="'.$attachment->post_title.'" /></a>';
			endif;	
	else: $html .= '<a href="'.get_permalink(get_the_ID()).'"><img src="' . get_template_directory_uri() . '/images/default/noimage_200_140.png" alt="'.get_the_title().'" /></a>';		

	endif;
	   $html .= '<a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</a>';
	   $html .='</li>';
	   $count++;
	endwhile;
	wp_reset_postdata();
       $html .= '</ul></section><div class="carousel-prev"></div><div class="carousel-next"></div></div>';
	return $html;


}
add_shortcode('wpsm_recent_posts', 'shortcode_recent_posts');
}

//////////////////////////////////////////////////////////////////
// List of recent posts
//////////////////////////////////////////////////////////////////
if( !function_exists('recent_posts_function') ) {    
function recent_posts_function($atts, $content = null) {
   extract(shortcode_atts(array(
      'posts' => '3',
	  'catid' => '',
   ), $atts));
   $return_string = '';
   $return_string .= '<ul class="wpsm_recent_posts_list">';
   query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts, 'category__in' => array($catid)));
   if (have_posts()) :
      while (have_posts()) : the_post();
         $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
      endwhile;
   endif;
   $return_string .= '</ul>';

   wp_reset_query();
   return $return_string;
}
add_shortcode('wpsm_recent_posts_list', 'recent_posts_function');
}


//////////////////////////////////////////////////////////////////
// Map
//////////////////////////////////////////////////////////////////
if (! function_exists( 'wpsm_shortcode_googlemaps' ) ) :
	function wpsm_shortcode_googlemaps($atts, $content = null) {	
		extract(shortcode_atts(array(
				"title" => '',
				"location" => '',
				"height" => '300px',
				"zoom" => 8,
				"align" => '',
		), $atts));
		
		// load scripts
		wp_enqueue_script('wpsm_googlemap');
		wp_enqueue_script('wpsm_googlemap_api');
		
		
		$output = '<div id="map_canvas_'.rand(1, 100).'" class="wpsm_googlemap" style="height:'.$height.';width:100%">';
			$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
			$output .= '<input class="location" type="hidden" value="'.$location.'" />';
			$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
			$output .= '<div class="map_canvas"></div>';
		$output .= '</div>';
		
		return $output;
	   
	}
	add_shortcode("wpsm_googlemap", "wpsm_shortcode_googlemaps");
endif;


//////////////////////////////////////////////////////////////////
// Dividers
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_divider_shortcode') ) {
	function wpsm_divider_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'style' => 'solid',
			'margin_top' => '20px',
			'margin_bottom' => '20px',
		  ),
		  $atts ) );
		$style_attr = '';
		if ( $margin_top && $margin_bottom ) {  
			$style_attr = 'style="margin-top: '. $margin_top .';margin-bottom: '. $margin_bottom .';"';
		} elseif( $margin_bottom ) {
			$style_attr = 'style="margin-bottom: '. $margin_bottom .';"';
		} elseif ( $margin_top ) {
			$style_attr = 'style="margin-top: '. $margin_top .';"';
		} else {
			$style_attr = NULL;
		}
	 return '<hr class="wpsm-divider '. $style .'_divider" '.$style_attr.' />';
	}
	add_shortcode( 'wpsm_divider', 'wpsm_divider_shortcode' );
}


//////////////////////////////////////////////////////////////////
// Price Table shortcode
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_price_shortcode') ) {
	function wpsm_price_shortcode( $atts, $content = null  ) {
	  // Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
	  $content = do_shortcode($content);
	  $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
	  $Old     = array( '<br />', '<br>' );
	  $New     = array( '','' );
	  $content = str_replace( $Old, $New, $content );		
	   return '<ul class="wpsm-price clear">' . $content . '</ul><br class="clear" />';
	}
	add_shortcode( 'wpsm_price_table', 'wpsm_price_shortcode' );
}
/* Column of price*/
if( !function_exists('wpsm_price_column_shortcode') ) {
	function wpsm_price_column_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'size' => '3',
			'featured' => '',
			'name' => 'Sample Name',
			'price' => '',
			'per' => '',
			'button_url' => '',
			'button_text' => 'Buy Now',
			'button_color' => 'orange',
		), $atts ) );
		
	  // Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
	  $content = do_shortcode($content);
	  $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
	  $Old     = array( '<br />', '<br>' );
	  $New     = array( '','' );
	  $content = str_replace( $Old, $New, $content );		
		
		if($size == '2') $column_size = 'one-half';
		if($size == '3') $column_size = 'one-third';
		if($size =='4') $column_size = 'one-fourth';
		if($size =='5') $column_size = 'one-fifth';
	
		if($featured =='yes') $featured_price = 'wpsm-featured-price';
		else $featured_price = NULL;
			
		//fetch content  
		$out_price ='';
		$out_price .= '<li class="wpsm-price-column wpsm-'. $column_size .' '. $featured .' '. $featured_price .'">';
		$out_price .= '<div class="wpsm-price-header"><h4>'. $name. '</h4></div>';
		$out_price .= '<div class="wpsm-price-content"><div class="wpsm-price-cell"><span class="wpsm-price-value">'. $price .'</span> /'.$per.'</div>';
		$out_price .= $content;
		$out_price .= '<div class="wpsm-price-button"><a href="'. $button_url .'" class="wpsm-button '. $button_color .'"><span class="wpsm-button-inner">'. $button_text .'</span></a></div></div>';
		$out_price .= '</li>';
		  
	   return $out_price;
	}
	add_shortcode( 'wpsm_price_column', 'wpsm_price_column_shortcode' );
}

//////////////////////////////////////////////////////////////////
// tab shortcode
//////////////////////////////////////////////////////////////////

if (!function_exists('wpsm_tabgroup_shortcode')) {
	function wpsm_tabgroup_shortcode( $atts, $content = null ) {
		
		//Enque scripts
		wp_enqueue_script('jquery-ui-tabs');
		
		// Display Tabs
		
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tab_titles = array();
		
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );
		
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		$output = '';
		if( count($tab_titles) ){
		    $output .= '<div id="wpsm-tab-'. rand(1, 100) .'" class="wpsm-tabs">';
			$output .= '<ul class="ui-tabs-nav wpsm-clearfix">';
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#wpsm-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}
		return $output;
	}
	add_shortcode( 'wpsm_tabgroup', 'wpsm_tabgroup_shortcode' );
}
if (!function_exists('wpsm_tab_shortcode')) {
	function wpsm_tab_shortcode( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );
		
		return '<div id="wpsm-tab-'. sanitize_title( $title ) .'" class="tab-content">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'wpsm_tab', 'wpsm_tab_shortcode' );
}

//////////////////////////////////////////////////////////////////
// Toggle
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_toggle_shortcode') ) {
	function wpsm_toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array( 'title' => 'Toggle Title'), $atts ) );
		
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );
		
		// Display the Toggle

		$opens = '';
		$class ='';
		if ( $class == 'active' ) {  
			$opens = 'style="display:block"';
		} else {
			$opens = NULL;
		}

		return '<div class="wpsm-toggle"><h3 class="wpsm-toggle-trigger '.$class.'">'. $title .'</h3><div class="wpsm-toggle-container"'.$opens.'>' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode('wpsm_toggle', 'wpsm_toggle_shortcode');
}

//////////////////////////////////////////////////////////////////
// Get feeds
//////////////////////////////////////////////////////////////////

if( !function_exists('wpsm_shortcode_feeds') ) {
function wpsm_shortcode_feeds( $atts, $content = null ) {
    @extract($atts);
	$number  = ($number)  ? $number  : '5' ;
	return wpsm_get_feeds( $url , $number );
}
add_shortcode('wpsm_feed', 'wpsm_shortcode_feeds');
}

function wpsm_get_feeds( $feed , $number ){
	include_once(ABSPATH . WPINC . '/feed.php');

	$rss = @fetch_feed( $feed );
	if (!is_wp_error( $rss ) ){
		$maxitems = $rss->get_item_quantity($number); 
		$rss_items = $rss->get_items(0, $maxitems); 
	}
	if ($maxitems == 0) {
		$out = "<ul><li>No items</li></ul>";
	}else{
		$out = "<ul>";
		
		foreach ( $rss_items as $item ) : 
			$out .= '<li><a href="'. esc_url( $item->get_permalink() ) .'" title="Posted '.$item->get_date("j F Y | g:i a").'">'. esc_html( $item->get_title() ) .'</a></li>';
		endforeach;
		$out .='</ul>';
	}
	
	return $out;
}

//////////////////////////////////////////////////////////////////
// Percent bars
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_bar_shortcode') ) {
	function wpsm_bar_shortcode( $atts  ) {		
		extract( shortcode_atts( array(
			'title' => '',
			'percentage' => '100%',
			'color' => '#6adcfa'
		), $atts ) );		

		$output = '<div class="wpsm-bar wpsm-clearfix" data-percent="'. $percentage .'%">';
			if ( $title !== '' ) $output .= '<div class="wpsm-bar-title" style="background: '. $color .';"><span>'. $title .'</span></div>';
			$output .= '<div class="wpsm-bar-bar" style="background: '. $color .';"></div>';
			$output .= '<div class="wpsm-bar-percent">'.$percentage.' %</div>';
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode( 'wpsm_bar', 'wpsm_bar_shortcode' );
}

//////////////////////////////////////////////////////////////////
// List
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_list_shortcode') ) {
function wpsm_list_shortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'type' => 'arrow'
		), $atts ) ); 
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );		
    return '<div class="wpsm_'.$type.'list">'.do_shortcode($content).'</div>';  
}  
add_shortcode("wpsm_list", "wpsm_list_shortcode");
}

//////////////////////////////////////////////////////////////////
// Pros
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_pros_shortcode') ) {
function wpsm_pros_shortcode( $atts, $content = null ) {

		@extract($atts);
		if( empty($title) ) $title = 'Positives';
		// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
		$content = do_shortcode($content);
        $content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
		$Old     = array( '<br />', '<br>' );
		$New     = array( '','' );
		$content = str_replace( $Old, $New, $content );		 	
    return '<div class="wpsm_pros"><div class="title_pros">'.$title.'</div>'.do_shortcode($content).'</div>';  
}  
add_shortcode("wpsm_pros", "wpsm_pros_shortcode");
}

//////////////////////////////////////////////////////////////////
// Cons
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_cons_shortcode') ) {
function wpsm_cons_shortcode( $atts, $content = null ) {

		@extract($atts);
		if( empty($title) ) $title = 'Negatives'; 	
    return '<div class="wpsm_cons"><div class="title_cons">'.$title.'</div>'.do_shortcode($content).'</div>';  
}  
add_shortcode("wpsm_cons", "wpsm_cons_shortcode");
}

//////////////////////////////////////////////////////////////////
// Tooltip
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_shortcode_tooltip') ) {
function wpsm_shortcode_tooltip( $atts, $content = null ) {
	wp_enqueue_script('tipsy');

    @extract($atts);
	if( empty($gravity) ) $gravity = '';
	$out = '<script type="text/javascript" charset="utf-8">jQuery(document).ready(function($) {$(".wpsm-tooltip-'.$gravity.'").tipsy({gravity: "'.$gravity.'", fade: true});})</script>';
	$out .= '<span class="wpsm-tooltip wpsm-tooltip-'.$gravity.'" original-title="'.$content.'">'.$text.'</span>';
   return $out;
}
add_shortcode('wpsm_tooltip', 'wpsm_shortcode_tooltip');
}


//////////////////////////////////////////////////////////////////
// Member content
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_shortcode_is_logged_in') ) {
function wpsm_shortcode_is_logged_in( $atts, $content = null ) {
	@extract($atts);
	// Remove all instances of "<p>&nbsp;</p><br>" to avoid extra lines.
	$content = do_shortcode($content);
	$content = preg_replace( '%<p>&nbsp;\s*</p>%', '', $content ); 
	$Old     = array( '<br />', '<br>' );
	$New     = array( '','' );
	$content = str_replace( $Old, $New, $content );	
	if($guest_text == '') $guest_text = ' This content visible only for members. You can login <a href="/wp-login.php">here</a>.';
	if (is_user_logged_in() && !is_null( $content ) && !is_feed()) {
		return '<div class="wpsm-members"><strong>Members only</strong>' . do_shortcode( $content ) . '</div>';
	}
	else { 

		return '<div class="wpsm-members not-logined"><strong>Members only</strong> '.$guest_text.'</div>';	
		 }

	}	
add_shortcode('wpsm_member', 'wpsm_shortcode_is_logged_in');
}

//////////////////////////////////////////////////////////////////
// Gallery carousel
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_gallery_carousel') ) {
function wpsm_gallery_carousel( $atts, $content = null ) {
	wp_enqueue_script('carouFredSel');
	$title='';
    @extract($atts);
    $pretty_id = rand(5, 15) ;
    $everul =''; 
	$gals = explode(',', $ids);
	$everul .='<div class="def-carousel media_carousel loading"><h3>'.$title.'</h3><section class="photo_carousel pretty_photo_'.$pretty_id.' clearfix"><ul class="gallery-pics clearfix">';
	foreach ($gals as $gal){
		$urlgal =  wp_get_attachment_url( $gal);
		$params = array( 'width' => 200, 'height' => 140, 'crop' => true  );
		$everul .='<li><a href="'.$urlgal.'"><img src="'.bfi_thumb($urlgal, $params).'" alt="" /></a></li>';
	}
	$everul .='</ul></section><div class="carousel-prev"></div><div class="carousel-next"></div></div>';
    if (isset ($prettyphoto) && $prettyphoto == 'true'){
    	wp_enqueue_script('prettyphoto');
    	$everul .='<script>jQuery(function($){$(document).ready(function($){
     		$(".pretty_photo_'.$pretty_id.' a").attr("rel","prettyPhoto[gallery_'.$pretty_id.']").prettyPhoto({social_tools:false});
      	});});</script>';	
    } 			
	 return $everul;
}
add_shortcode('wpsm_minigallery', 'wpsm_gallery_carousel');
}

//////////////////////////////////////////////////////////////////
// Offer Box
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_offerbox_shortcode') ) {
function wpsm_offerbox_shortcode( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
			'title' => '',
			'description' => '',
			'price' => '',

		), $atts));
		
	$out = '<div class="rehub_feat_block table_view_block"><div class="block_with_coupon">';

	if(isset($atts['offer_linkid']) && $atts['offer_linkid']):

		$linkpost = get_post($atts['offer_linkid']);
		if ($linkpost) :
			$term_list = wp_get_post_terms($linkpost->ID, 'thirstylink-category', array("fields" => "names"));
			$term_ids =  wp_get_post_terms($linkpost->ID, 'thirstylink-category', array("fields" => "ids")); 
			if (!empty($term_ids)) {$term_brand = $term_ids[0]; $term_brand_image = get_option("taxonomy_term_$term_brand");}	
			$attachments = get_posts( array(
	            'post_type' => 'attachment',
				'post_mime_type' => 'image',
	            'posts_per_page' => -1,
	            'post_parent' => $linkpost->ID,
		    ) );
		    if (!empty($attachments)) {$offer_thumb = wp_get_attachment_url( $attachments[0]->ID);} 
		    elseif (!empty($term_brand_image['brand_image'])) {$offer_thumb = $term_brand_image['brand_image'];}
		    else {$offer_thumb ='';}
		    $offer_price = get_post_meta( $linkpost->ID, 'rehub_aff_price', true );
		    $offer_price_old = get_post_meta( $linkpost->ID, 'rehub_aff_price_old', true );
			$offer_desc = get_post_meta( $linkpost->ID, 'rehub_aff_desc', true );
		    $offer_url = get_post_permalink($atts['offer_linkid']);
		    $offer_title = $linkpost->post_title;
		    $offer_btn_text = get_post_meta( $linkpost->ID, 'rehub_aff_btn_text', true );
		    $offer_coupon = get_post_meta( $linkpost->ID, 'rehub_aff_coupon', true );
		    $offer_coupon_date = get_post_meta( $linkpost->ID, 'rehub_aff_coupon_date', true );
		    $offer_coupon_mask = get_post_meta( $linkpost->ID, 'rehub_aff_coupon_mask', true );
		    $rehub_aff_review_related = get_post_meta( $linkpost->ID, "rehub_aff_rel", true );

		    if (!empty($offer_thumb) ) :
			    $params = array( 'width' => 100, 'height' => 100 );	
			    $out .= '<div class="offer_thumb"><img src="'.bfi_thumb($offer_thumb, $params).'" alt="" /></div>'; 
		    endif; 
		    $out .= '<div class="desc_col"><div class="offer_title">'.$offer_title.'</div>';
		    $out.= '<p>'.$offer_desc.'</p>';
		    if ( !empty($rehub_aff_review_related)) :
                $out .= '<a href="'.$rehub_aff_review_related.'" target="_blank" class="color_link">'.__("Read review", "rehub_framework").'</a>';    
            endif;
		    $out.= '</div>';

			if ( !empty($offer_price) || !empty($term_list[0])) :
				$out .='<div class="price_col">'; 
				if (!empty($offer_price)) :
					$out .='<p><span class="price_count"><ins>'.$offer_price.'</ins>';
					if($offer_price_old !='') :
						$out .=' <del>'.$offer_price_old.'</del>';
					endif ;
					$out .='</span></p>';						
				endif ;	
					$out .='<div class="aff_tag">';
					$params = array( 'width' => 100, 'height' => 100 );			        			        	
			        if (!empty($term_brand_image['brand_image'])) :
			            $out .='<img src="'.bfi_thumb( $term_brand_image['brand_image'], $params ).'" alt="'.$linkpost->post_title.'" />';  
			        elseif (!empty($term_list[0])) : 
			            $out .=''.$term_list[0].'';
			        endif;         
		            $out .='</div>';
		        $out .='</div>';
	        endif;

	        $out .='<div class="buttons_col"><div class="priced_block">';
			if(!empty($offer_coupon_date)) :
				$timestamp1 = strtotime($offer_coupon_date); 
				$seconds = $timestamp1 - time(); 
				$days = floor($seconds / 86400);
				$seconds %= 86400;
        		if ($days > 0) {
        			$coupon_text = $days.' '.__('days left', 'rehub_framework');
        			$coupon_style = '';
        		}
        		elseif ($days == 0){
        			$coupon_text = __('Last day', 'rehub_framework');
        			$coupon_style = '';
        		}
        		else {
        			$coupon_text = __('Coupon is Expired', 'rehub_framework');
        			$coupon_style = 'expired_coupon';
        		}									
			endif;
			$out .='<div><a class="btn_offer_block" href="'.get_post_permalink($linkpost).'">';	
			if($offer_btn_text !='') :
				$out .=''.$offer_btn_text.'';
			elseif(rehub_option('rehub_btn_text') !='') :
				$out .=''.rehub_option("rehub_btn_text").''; 
			else :
				$out .=''.__("Buy this item", "rehub_framework").''; 
			endif ;
			$out .='</a></div>';
			
			if(!empty($offer_coupon)) :
				wp_enqueue_script('zeroclipboard');
				if ($offer_coupon_mask !='1') :
					$out .='<div class="rehub_offer_coupon not_masked_coupon';
					if(!empty($offer_coupon_date)):
						$out .=' '.$coupon_style.'';
					endif;
					$out .='" data-clipboard-text="'.$offer_coupon.'"><i class="fa fa-scissors fa-rotate-180"></i><span class="coupon_text">'.$offer_coupon.'</span></div>';										
				else:
					$out .='<div class="rehub_offer_coupon masked_coupon';
					if(!empty($offer_coupon_date)):
						$out .=' '.$coupon_style.'';
					endif;
					$out .='" data-clipboard-text="'.$offer_coupon.'" data-codeid="'.$linkpost->ID.'" data-dest="'.get_post_permalink($linkpost).'">';
					if(rehub_option('rehub_mask_text') !='') :
						$out .=''.rehub_option("rehub_mask_text").'';
					else:
						$out .=''.__("Reveal coupon", "rehub_framework").'<i class="fa fa-external-link-square"></i>';
					endif;	
					$out .='</div>';
				endif;				
				if(!empty($offer_coupon_date)):
				 $out .='<div class="time_offer">'.$coupon_text.'</div>';
				endif;						
			endif ;									
				
			$out .='</div></div>';	
		
		endif;
	
	else :
	
		if(isset($atts['image_id']) && $atts['image_id']):
			$offer_thumb = wp_get_attachment_url($atts['image_id']);
			$params = array( 'width' => 120, 'height' => 90 );
			$out .= '<div class="offer_thumb"><img src="'.bfi_thumb($offer_thumb, $params).'" alt="" /></div>';
		elseif(isset($atts['thumb']) && $atts['thumb']):
			$offer_thumb = $atts['thumb'];
			$params = array( 'width' => 120, 'height' => 90 );
			$out .= '<div class="offer_thumb"><img src="'.bfi_thumb($offer_thumb, $params).'" alt="" /></div>';	           		
		endif;	
		$out .= '<div class="desc_col">';
		if(isset($atts['title']) && $atts['title']):
			$out .= '<div class="offer_title">'.$atts['title'].'</div>';
		endif;

		if(isset($atts['description']) && $atts['description']):
			$out.= '<p>'.$atts['description'].'</p>';
		endif;
		$out .= '</div>';

		if((isset($atts['button_link']) && $atts['button_link']) && (isset($atts['button_text']) && $atts['button_text'])):
			$out .= '<div class="buttons_col"><div class="priced_block clearfix">';
			if(isset($atts['price']) && $atts['price']):
		    	$out .= '<p><span class="price_count">'.$atts['price'].'</span></p>';
			endif;
		    $out .= '<div><a href="'.$atts['button_link'].'" class="btn_offer_block">'.$atts['button_text'].'</a></div>';
		    $out .= '</div></div>';
		endif;

	endif;

	$out .= '</div></div><div class="clearfix"></div>';
    return $out;
}
add_shortcode('wpsm_offerbox', 'wpsm_offerbox_shortcode');
}

//////////////////////////////////////////////////////////////////
// Woo Box
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_woobox_shortcode') ) {
function wpsm_woobox_shortcode( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
			'id' => '',
			'wooid'=> '',
		), $atts));
		
	if(isset($atts['id']) && $atts['id']):
		ob_start(); 
		rehub_get_woo_offer($id);
		$output = ob_get_contents();
		ob_end_clean();
		return $output;	
	endif;	

}
add_shortcode('wpsm_woobox', 'wpsm_woobox_shortcode');
}

//////////////////////////////////////////////////////////////////
// Woo List
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_woolist_shortcode') ) {
function wpsm_woolist_shortcode( $atts, $content = null ) {
	
    $type = $data_source = $cat = $tag = $ids = $orderby = $order = $show = $show_coupons_only = '';
    extract(shortcode_atts(array(
        'data_source' => '',    	
        'type' => '',
        'cat' => '',
        'tag' => '',        
        'ids' => '',
        'orderby' => '',
        'order' => 'DESC',
        'show' => '', 
        'show_coupons_only' => '',             
    ), $atts)); 
		
	ob_start(); 
	rehub_get_woo_list($data_source, $type, $cat, $tag, $ids, $orderby, $order, $show, $show_coupons_only );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;		

}
add_shortcode('wpsm_woolist', 'wpsm_woolist_shortcode');
}

//////////////////////////////////////////////////////////////////
// Offer List
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_afflist_shortcode') ) {
function wpsm_afflist_shortcode( $atts, $content = null ) {

	if(!isset($atts['show'])) {
		$atts['show'] = 10;
	}
	
	if(isset($atts['cat']) && $atts['cat']):
		$args = array(
			'post_type' => 'thirstylink',
			'thirstylink-category' => $atts['cat'],
			'posts_per_page'   => $atts['show'],
			'meta_key' => 'rehub_aff_sticky',
			'orderby' => 'meta_value',
			'order' => 'DESC',			
		);
	elseif(isset($atts['ids']) && $atts['ids']):
		$aff_ids = explode(',', $atts['ids']);
		$args = array(
			'post_type' => 'thirstylink',
			'post__in' => $aff_ids,
			'numberposts' => '-1',
			'orderby' => 'post__in',			
		);
	else :
		$args = array(
			'post_type' => 'thirstylink',
			'posts_per_page'   => $atts['show'],
			'meta_key' => 'rehub_aff_sticky',
			'orderby' => 'meta_value',
			'order' => 'DESC',			
		);			
	endif;
	$rehub_aff_posts = get_posts($args);

	$html ='<div class="aff_offer_links m25">';

	foreach($rehub_aff_posts as $aff_post) {	
		
		$attachments = get_posts( array(
            'post_type' => 'attachment',
			'post_mime_type' => 'image',
            'posts_per_page' => -1,
            'post_parent' => $aff_post->ID,
	    ));
	    
		if (!empty($attachments)) {$aff_thumb_list = wp_get_attachment_url( $attachments[0]->ID );} else {$aff_thumb_list ='';}
		$term_list = wp_get_post_terms($aff_post->ID, 'thirstylink-category', array("fields" => "names")); 
		$term_ids =  wp_get_post_terms($aff_post->ID, 'thirstylink-category', array("fields" => "ids")); 
		if (!empty($term_ids)) {$term_brand = $term_ids[0]; $term_brand_image = get_option("taxonomy_term_$term_ids[0]");} else {$term_brand_image ='';}
		
		$html .='<div class="rehub_feat_block table_view_block">';
		if (get_post_meta( $aff_post->ID, 'rehub_aff_sticky', true) == '1') :
			$html .='<div class="vip_corner"><span class="vip_badge"><i class="fa fa-thumbs-o-up"></i></span></div>';
		endif;	
		$html .='<div class="block_with_coupon">';
			$html .='<div class="offer_thumb"><a href="'.get_post_permalink($aff_post).'">';
			$params = array( 'width' => 120, 'height' => 90 );
			if (!empty($aff_thumb_list) ) :	
    			$html .='<img src="'.bfi_thumb( $aff_thumb_list, $params ).'" alt="'.$aff_post->post_title.'" />';
    		elseif (!empty($term_brand_image['brand_image'])) :
    			$html .='<img src="'.bfi_thumb( $term_brand_image['brand_image'], $params ).'" alt="'.$aff_post->post_title.'" />';   			
    		else :
    			$html .='<img src="'.get_template_directory_uri().'/images/default/noimage_100_70.png" alt="'.$aff_post->post_title.'" />';
    		endif;
			$html .='</a></div>';

			$html .='<div class="desc_col">';
				$html .='<div class="offer_title"><a href="'.get_post_permalink($aff_post).'">'.$aff_post->post_title.'</a></div>';
				$html .='<p>'.get_post_meta( $aff_post->ID, "rehub_aff_desc", true ).'</p>';
				$rehub_aff_review_related = get_post_meta( $aff_post->ID, "rehub_aff_rel", true );
				if ( !empty($rehub_aff_review_related)) :
					$html .='<a href="'.$rehub_aff_review_related.'" target="_blank" class="color_link">'.__("Read review", "rehub_framework").'</a>';	
				endif;	
			$html .='</div>';
			
			$product_price = get_post_meta( $aff_post->ID, 'rehub_aff_price', true ); 
			$offer_price_old = get_post_meta( $aff_post->ID, 'rehub_aff_price_old', true );	
			if ( !empty($product_price) || !empty($term_list[0])) :
				$html .='<div class="price_col">'; 
				if (!empty($product_price)) :
					$html .='<p><span class="price_count"><ins>'.$product_price.'</ins>';
					if($offer_price_old !='') :
						$html .=' <del>'.$offer_price_old.'</del>';
					endif ;
					$html .='</span></p>';						
				endif ;	
					$html .='<div class="aff_tag">';
					$params = array( 'width' => 120, 'height' => 90 );			        			        	
			        if (!empty($term_brand_image['brand_image'])) :
			            $html .='<img src="'.bfi_thumb( $term_brand_image['brand_image'], $params ).'" alt="'.$aff_post->post_title.'" />';  
			        elseif (!empty($term_list[0])) : 
			            $html .=''.$term_list[0].'';
			        endif;         
		            $html .='</div>';
		        $html .='</div>';
	        endif;

	        $html .='<div class="buttons_col"><div class="priced_block">';
			$offer_btn_text = get_post_meta( $aff_post->ID, 'rehub_aff_btn_text', true );
			$offer_coupon = get_post_meta( $aff_post->ID, 'rehub_aff_coupon', true );
			$offer_coupon_date = get_post_meta( $aff_post->ID, 'rehub_aff_coupon_date', true );
			$offer_coupon_mask = get_post_meta( $aff_post->ID, 'rehub_aff_coupon_mask', true );
			if(!empty($offer_coupon_date)) :
				$timestamp1 = strtotime($offer_coupon_date); 
				$seconds = $timestamp1 - time(); 
				$days = floor($seconds / 86400);
				$seconds %= 86400;
        		if ($days > 0) {
        			$coupon_text = $days.' '.__('days left', 'rehub_framework');
        			$coupon_style = '';
        		}
        		elseif ($days == 0){
        			$coupon_text = __('Last day', 'rehub_framework');
        			$coupon_style = '';
        		}
        		else {
        			$coupon_text = __('Coupon is Expired', 'rehub_framework');
        			$coupon_style = 'expired_coupon';
        		}									
			endif;
			$html .='<div><a class="btn_offer_block" href="'.get_post_permalink($aff_post).'">';	
			if($offer_btn_text !='') :
				$html .=''.$offer_btn_text.'';
			elseif(rehub_option('rehub_btn_text') !='') :
				$html .=''.rehub_option("rehub_btn_text").''; 
			else :
				$html .=''.__("Buy this item", "rehub_framework").''; 
			endif ;
			$html .='</a></div>';
			
			if(!empty($offer_coupon)) :
				wp_enqueue_script('zeroclipboard');
				if ($offer_coupon_mask !='1') :
					$html .='<div class="rehub_offer_coupon not_masked_coupon';
					if(!empty($offer_coupon_date)):
						$html .=' '.$coupon_style.'';
					endif;
					$html .='" data-clipboard-text="'.$offer_coupon.'"><i class="fa fa-scissors fa-rotate-180"></i><span class="coupon_text">'.$offer_coupon.'</span></div>';										
				else:
					$html .='<div class="rehub_offer_coupon masked_coupon';
					if(!empty($offer_coupon_date)):
						$html .=' '.$coupon_style.'';
					endif;
					$html .='" data-clipboard-text="'.$offer_coupon.'" data-codeid="'.$aff_post->ID.'" data-dest="'.get_post_permalink($aff_post).'">';
					if(rehub_option('rehub_mask_text') !='') :
						$html .=''.rehub_option("rehub_mask_text").'';
					else:
						$html .=''.__("Reveal coupon", "rehub_framework").'<i class="fa fa-external-link-square"></i>';
					endif;	
					$html .='</div>';
				endif;				
				if(!empty($offer_coupon_date)):
				 $html .='<div class="time_offer">'.$coupon_text.'</div>';
				endif;						
			endif ;
				
			$html .='</div></div>';		

		$html .='</div></div>';
	}

	$html .='</div>';
	return $html;
}
add_shortcode('wpsm_afflist', 'wpsm_afflist_shortcode');

//////////////////////////////////////////////////////////////////
// POPUP BUTTON
//////////////////////////////////////////////////////////////////
if( !function_exists('wpsm_button_popup_funtion') ) {
function wpsm_button_popup_funtion( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'color' => 'orange',
		'size' => 'medium',
		'icon' => 'none',
		'btn_text' => 'Show me popup',
		'max_width' => '500',
		'enable_icon' => ''    
    ), $atts));	
    $rand = rand(1, 100) ;
    $iconshow = ($enable_icon !='') ? '<span class="'.$icon.'"></span>' : '';
	$out = '<div id="popup_cont_'.$rand.'" class="popup_cont_div"><div class="popup_cont_inside">'.do_shortcode($content).'</div></div>';
	$out .= '<a href="javascript:void(0)" class="popup_btn'.$rand.' wpsm-button wpsm-flat-btn '.$color.' '.$size.'"><span class="wpsm-button-inner">'.$iconshow.$btn_text.'</span></a>';
	$out .= '<script>jQuery(document).ready(function($) {
     			$(".popup_btn'.$rand.'").click(function(){
     				$.pgwModal({target: "#popup_cont_'.$rand.'",maxWidth: '.$max_width.',titleBar: false});
     			});
     		});</script>';
    return $out;
}
add_shortcode('wpsm_button_popup', 'wpsm_button_popup_funtion');
}

//////////////////////////////////////////////////////////////////
// Map
//////////////////////////////////////////////////////////////////
if (! function_exists( 'wpsm_countdown' ) ) :
	function wpsm_countdown($atts, $content = null) {	
		extract(shortcode_atts(array(
				"year" => '',
				"month" => '',
				"day" => '',
				"hour" => '',
		), $atts));
		
		// load scripts
		wp_enqueue_script('lwtCountdown');
		ob_start(); 		
		?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
			  $('#countdown_dashboard').countDown({
				  targetDate: {
					  'day': 	<?php echo $day ?>,
					  'month': 	<?php echo $month ?>,
					  'year': 	<?php echo $year ?>,
					  'hour': 	<?php echo $hour ?>,
					  'min': 		0,
					  'sec': 		0
				  },
				  omitWeeks: true,
				  onComplete: function() { $('#countdown_dashboard').hide() }
			  });
			});
		</script>
		<div id="countdown_dashboard"> 			  
			<div class="dash days_dash"> <span class="dash_title">days</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>
			<div class="dash hours_dash"> <span class="dash_title">hours</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>
			<div class="dash minutes_dash"> <span class="dash_title">minutes</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>
			<div class="dash seconds_dash"> <span class="dash_title">seconds</span>
				<div class="digit">0</div>
				<div class="digit">0</div>
			</div>
		</div>
		<!-- Countdown dashboard end -->
		<div class="clearfix"></div>		

		<?php		
		$output = ob_get_contents();
		ob_end_clean();
		return $output;	
	   
	}
	add_shortcode("wpsm_countdown", "wpsm_countdown");
endif;

}