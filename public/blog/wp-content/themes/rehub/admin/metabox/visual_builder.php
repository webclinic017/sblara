<?php

return array(
	'id'          => 'vcr',
	'types'       => array('page'),
	'title'       => __('Page options', 'rehub_framework'),
	'priority'    => 'low',
	'context'     => 'side',
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'template'    => array(
		array(
			'type' => 'toggle',
			'name' => 'header_disable',
			'label' => __('Disable header', 'rehub_framework'),
		),		
		array(
			'type' => 'toggle',
			'name' => 'footer_disable',
			'label' => __('Disable footer', 'rehub_framework'),
		),
		array(
			'type' => 'radiobutton',
			'name' => 'content_type',
			'label' => __('Type of content area', 'rehub_framework'),
			'default' => 'normal_post',
			'items' => array(
				array(
					'value' => 'def',
					'label' => __('Default content box', 'rehub_framework'),
				),
				array(
					'value' => 'no_shadow',
					'label' => __('Content box without shadow', 'rehub_framework'),
				),
				array(
					'value' => 'full_post_area',
					'label' => __('Full width', 'rehub_framework'),
				),				
			),
			'default' => array(
				'def',
			),	
		),	
		array(
			'type' => 'toggle',
			'name' => 'bg_disable',
			'label' => __('Disable default background image', 'rehub_framework'),
		),																			
	),
	'include_template' => 'visual_builder.php',
);

/**
 * EOF
 */