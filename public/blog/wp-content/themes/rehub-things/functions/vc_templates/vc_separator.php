<?php
$style = $color = $sep_align = $sep_width = $border_width = $m_top = $m_bottom = $accent_color = '';
extract( shortcode_atts( array(
	'style' => '',
	'color' => '',
	'sep_align' => 'left',
	'sep_width' => '60px',
	'border_width' => '1',
	'm_top' => '10px',
	'm_bottom' => '10px',
	'accent_color' => ''
), $atts ) );


$class = "wpsm_sep_line";
$class .= ($sep_align!='') ? ' wpsm_sep_'.$sep_align : '';
$style_inline = ($style !='') ? 'border-style: '.$style.'' : 'border-style: solid;';
$sep_color_inline = ($color !='custom') ? vc_get_css_color('border-color', $color) : vc_get_css_color('border-color', $accent_color) ; 
$sep_width_inline = ($sep_width !='') ? 'width: '.$sep_width.';' : '';
$sep_height_inline = ($border_width !='') ? 'height: '.$border_width.'px;' : '';
$sep_height_border_inline = ($border_width !='') ? 'border-bottom-width: '.$border_width.'px;' : '';
$sep_inline_m_top = ($m_top !='') ? 'margin-top: '.$m_top.';' : '';
$sep_inline_m_bottom = ($m_bottom !='') ? 'margin-bottom: '.$m_bottom.';' : '';
$inline_css_wrap = $sep_inline_m_top.$sep_inline_m_bottom.$sep_height_inline;
$inline_css = $sep_color_inline.$sep_width_inline.$sep_height_border_inline.$style_inline;
?>

<div class="<?php echo esc_attr(trim($class)); ?>" style="<?php echo $inline_css_wrap; ?>">
	<span style="<?php echo $inline_css; ?>"></span>
</div>
<?php echo $this->endBlockComment('separator')."\n";