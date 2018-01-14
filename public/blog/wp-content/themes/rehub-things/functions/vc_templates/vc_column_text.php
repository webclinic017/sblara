<?php
$output = $el_class = $css_animation = $bordered ='';

extract(shortcode_atts(array(
    'el_class' => '',
    'css_animation' => '',
    'css' => '',
    'bordered' => '',
), $atts));
if ($bordered !='') {$bordered =' rehub_feat_block';}

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element post ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$css_class .= $this->getCSSAnimation($css_animation);
$output .= "\n\t".'<article class="'.$css_class.$bordered.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</article> ' . $this->endBlockComment('.wpb_text_column');

echo $output;