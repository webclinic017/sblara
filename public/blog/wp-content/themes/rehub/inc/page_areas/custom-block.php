<?php 
	$title_enable = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.custom_mod.0.custom_toggle_title');
	$title_name = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.custom_mod.0.custom_title');
	$title_position = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.custom_mod.0.custom_title_position');
	$title_url_title = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.custom_mod.0.custom_url_text');
	$title_url_url = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.custom_mod.0.custom_url_url');
    $custom_textarea = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.custom_mod.0.custom_mod_area');
    $custom_box_border = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.custom_mod.0.custom_toggle_border');	
?>
<?php title_custom_block ($title_enable, $title_name, $title_position, $title_url_title, $title_url_url) ?>
<article class="custom_textarea post<?php if($custom_box_border == '1') :?> rehub_feat_block<?php endif ;?>"><?php echo do_shortcode( $custom_textarea ); ?></article>