<?php

return array(
	'id'          => 'rehub_framework_brand',
	'types'       => array('post', 'page'),
	'title'       => __('Branded page option', 'rehub_framework'),
	'priority'    => 'high',
	'view' => WPALCHEMY_VIEW_START_CLOSED,
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'template'    => array(
						array(
							'type' => 'color',
							'name' => 'rehub_color_background_single',
							'label' => __('Background Color', 'rehub_framework'),
							'description' => __('Choose the background color', 'rehub_framework'),
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_background_image_single',
							'label' => __('Background Image', 'rehub_framework'),
							'description' => __('Upload a background image', 'rehub_framework'),
							'default' => '',
						),
						array(
							'type' => 'select',
							'name' => 'rehub_background_repeat_single',
							'label' => __('Background Repeat', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'repeat',
									'label' => __('Repeat', 'rehub_framework'),
								),
								array(
									'value' => 'no-repeat',
									'label' => __('No Repeat', 'rehub_framework'),
								),
								array(
									'value' => 'repeat-x',
									'label' => __('Repeat X', 'rehub_framework'),
								),
								array(
									'value' => 'repeat-y',
									'label' => __('Repeat Y', 'rehub_framework'),
								),
							),
						),
						array(
							'type' => 'select',
							'name' => 'rehub_background_position_single',
							'label' => __('Background Position', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'left',
									'label' => 'Left',
								),
								array(
									'value' => 'center',
									'label' => 'Center',
								),
								array(
									'value' => 'right',
									'label' => 'Right',
								),
							),
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_background_offset_single',
							'label' => __('Set offset', 'rehub_framework'),
							'description' => __('Set offset from top for background (without px) for avoid header overlap', 'rehub_framework'),
							'validation' => 'numeric',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_background_fixed_single',
							'label' => __('Fixed Background Image?', 'rehub_framework'),
							'description' => __('The background is fixed with regard to the viewport.', 'rehub_framework'),
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_background_sized_single',
							'label' => __('Fit size?', 'rehub_framework'),
							'description' => __('Set background image width and height to fit the size of window', 'rehub_framework'),
						),						
						array(
								'type' => 'toggle',
								'name' => 'rehub_content_shadow_single',
								'label' => __('Disable box shadow under content box?', 'rehub_framework'),
						),	
						array(
							'type' => 'textbox',
							'name' => 'rehub_content_margin_single',
							'label' => __('Set margin', 'rehub_framework'),
							'description' => __('Set margin between menu and content (without px)', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),													
						array(
							'type' => 'textbox',
							'name' => 'rehub_branded_bg_url_single',
							'label' => __('Url for branded background', 'rehub_framework'),
							'description' => __('Insert url that will be display on background', 'rehub_framework'),
							'default' => '',
							'validation' => 'url',
						),												
						 array(
							'type' => 'notebox',
							'name' => 'rehub_branded_bg_note_single',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('Cover background has centered position. Cover background works only if url (field above) is definite. You can find some examples in folder Demo_data/branded. Psd sources for these examples - in file PSD/28-branded-pages.psd', 'rehub_framework'),
							'status' => 'normal',							
						),												
						array(
							'type' => 'upload',
							'name' => 'rehub_branded_background_image_single',
							'label' => __('Cover Background Image', 'rehub_framework'),
							'description' => __('Upload cover background image', 'rehub_framework'),
							'default' => '',
						),

						array(
							'type' => 'toggle',
							'name' => 'rehub_branded_bg_fixed_single',
							'label' => __('Fixed Cover Background Image?', 'rehub_framework'),
							'description' => __('The background is fixed with regard to the viewport.', 'rehub_framework'),
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_branded_bg_margin_single',
							'label' => __('Set offset', 'rehub_framework'),
							'description' => __('Set offset from top for cover background (without px) for avoid header overlap', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),											
						 array(
							'type' => 'notebox',
							'name' => 'rehub_branded_banner_note_single',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('Branded banner displays after header. Recommended Width of image 1200px. You can find some examples in folder Demo_data/branded. Psd sources for these examples - in file PSD/28-branded-pages.psd', 'rehub_framework'),
							'status' => 'normal',							
						),						
						array(
							'type' => 'upload',
							'name' => 'rehub_branded_banner_image_single',
							'label' => __('Branded banner', 'rehub_framework'),
							'description' => __('Upload branded banner image', 'rehub_framework'),
							'default' => '',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_branded_banner_url_single',
							'label' => __('Url on branded banner', 'rehub_framework'),
							'description' => __('Insert url for banner', 'rehub_framework'),
							'default' => '',
							'validation' => 'url',
						),																
	),
);

/**
 * EOF
 */