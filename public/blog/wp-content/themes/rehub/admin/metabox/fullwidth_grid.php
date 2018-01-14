<?php

return array(
	'id'          => 'rehub_grid_cat',
	'types'       => array('page'),
	'title'       => __('Full width grid settings', 'rehub_framework'),
	'priority'    => 'low',
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'context'     => 'side',
	'template'    => array(
		array(
			'type' => 'select',
			'name' => 'fullwidth_grid_cat',
			'label' => __('Choose category', 'rehub_framework'),
			'description' => __('Choose the category that you\'d like to include to page', 'rehub_framework'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value'  => 'vp_get_categories',
					),
				),
			),
			'default' => '',
		),
		array(
			'type' => 'textbox',
			'name' => 'fullwidth_grid_tag',
			'label' => __('Enter tag', 'rehub_framework'),
			'description' => __('Leave blank or set tag of posts', 'rehub_framework'),
		),
		array(
			'type' => 'textbox',
			'name' => 'fullwidth_grid_fetch',
			'label' => __('Fetch Count', 'rehub_framework'),
			'description' => __('How much posts you\'d like to display?', 'rehub_framework'),
			'default' => '',
			'validation' => 'numeric',
		),	
		array(
			'type' => 'select',
			'name' => 'fullwidth_grid_pagination',
			'label' => __('Pagination type', 'rehub_framework'),
			'items' => array(
				array(
					'value' => '1',
					'label' => __('Simple pagination', 'rehub_framework'),
				),
				array(
					'value' => '2',
					'label' => __('Infinite scroll', 'rehub_framework'),
				),
				array(
					'value' => 'no',
					'label' => __('No pagination', 'rehub_framework'),
				),
			),
			'default' => array(
				'2',
			),
		),									
	),
    'include_template' => 'template-fullwidthgrid.php',
);

/**
 * EOF
 */