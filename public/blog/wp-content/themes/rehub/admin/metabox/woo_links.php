<?php

return array(
	'id'          => 'rehub_framework_woo',
	'types'       => array('product'),
	'title'       => __('Additional rehub settings', 'rehub_framework'),
	'priority'    => 'low',
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'template'    => array(

		array(
			'type' => 'multiselect',
			'name' => 'review_woo_links',
			'label' => __('Choose affiliate offers', 'rehub_framework'),
			'description' => __('Choose affiliate links that you want to show in list.', 'rehub_framework'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value'  => 'rehub_get_aff',
					),
				),
			),
			'default' => '',																																						
		),
		array(
			'type' => 'select',
			'name' => 'review_woo_id',
			'label' => __('Choose related review post', 'rehub_framework'),
			'description' => __('Choose post with review of this product', 'rehub_framework'),
			'items' => array(
				'data' => array(
					array(
						'source' => 'function',
						'value'  => 'rehub_manual_ids_func',
					),
				),
			),			
			'default' => '',
		),																						
	),
);

/**
 * EOF
 */