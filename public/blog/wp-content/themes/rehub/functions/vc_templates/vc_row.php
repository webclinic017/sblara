<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $rehub_container = $bg_width_type = $centered_container = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'rehub_container' => '',
    'bg_width_type' => '',
    'centered_container' => '',
    'css' => ''
), $atts));

if ($rehub_container !='' && $bg_width_type=='simple'){$rehub_style =' vc_rehub_container';}
elseif ($bg_width_type=='container_width' || $bg_width_type=='window_width'){$rehub_style =' vc_custom_row_width';}
else {
$rehub_style ='';
	}
$bg_wrap_width = ($bg_width_type !='' && $bg_width_type!='simple') ? ' data-bg-width="'.$bg_width_type.'"' : '';
$centered = ($centered_container !='') ? ' centered-container' : '';   
// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$output .= '<div class="'.$css_class.$rehub_style.$centered.'"'.$style.$bg_wrap_width.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');

echo $output;