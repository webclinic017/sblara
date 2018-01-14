<?php

return array(
	'id'          => 'rehub_catalog',
	'types'       => array('page'),
	'title'       => __('Catalogue constructor', 'rehub_child'),
	'priority'    => 'low',
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'template'    => array(
		array(
			'type' => 'toggle',
			'name' => 'catalog_title_before',
			'label' => __('Enable title of page before posts?', 'rehub_child'),
			'default' => '0',
		),
		array(
			'type' => 'toggle',
			'name' => 'catalog_content_before',
			'label' => __('Enable content of page before posts?', 'rehub_child'),
			'default' => '0',
		),		
		array(
			'type' => 'select',
			'name' => 'catalog_design',
			'label' => __('Choose design of posts', 'rehub_child'),
			'items' => array(
				array(
					'value' => 'list',
					'label' => __('List style', 'rehub_child'),
				),
				array(
					'value' => 'grid_two',
					'label' => __('Two column grid', 'rehub_child'),
				),
				array(
					'value' => 'grid_three',
					'label' => __('Three column grid', 'rehub_child'),
				),				
			),
			'default' => 'grid_three',
		),
		array(
			'type' => 'textbox',
			'name' => 'catalog_fetch',
			'label' => __('Fetch Count', 'rehub_child'),
			'description' => __('How much posts you\'d like to display?', 'rehub_child'),
			'default' => '',
			'validation' => 'numeric',		
		),
		array(
			'type' => 'textbox',
			'name' => 'catalog_post_type',
			'label' => __('Name of post type', 'rehub_child'),
			'description' => __('Enter name of your post type. By default, post', 'rehub_child'),			
		),		
		array(
			'type' => 'textbox',
			'name' => 'catalog_tax',
			'label' => __('Enter taxonomy name', 'rehub_child'),
			'description' => __('Enter name of your taxonomy. Example, taxonomy for posts - is category. Or leave blank', 'rehub_child'),			
		),
		array(
			'type' => 'textbox',
			'name' => 'catalog_tax_slug',
			'label' => __('Show posts by taxonomy slug', 'rehub_child'),
			'description' => __('Enter slug of your taxonomy if you want to show only posts from certain category of your taxonomy (from field above) or leave blank to show all posts', 'rehub_child'),			
		),
		array(
			'type' => 'toggle',
			'name' => 'catalog_tax_show',
			'label' => __('Show your taxonomy in meta of posts?', 'rehub_child'),
			'default' => '0',
		),					
		array(
			'type' => 'textbox',
			'name' => 'catalog_desc',
			'label' => __('Show exerpt', 'rehub_child'),
			'description' => __('Enter number of symbols for exerpt. Leave blank if you don\'t want to use exerpt' , 'rehub_child'),			
		),
		array(
			'type'      => 'group',
			'repeating' => true,
			'sortable'  => true,
			'name'      => 'catalog_fields',
			'title'     => __('Add values from custom fields', 'rehub_child'),
			'fields'    => array(
				array(
					'type' => 'select',
					'name' => 'catalog_icon',
					'label' => __('Choose icon', 'rehub_child'),
					'description' => __('Choose icon before field title or leave blank', 'rehub_child'),
					'items' => array(
						'data' => array(
							array(
								'source' => 'function',
								'value'  => 'vp_get_fontawesome_icons',
							),
						),
					),
					'default' => '',			
				),				
				array(
					'type'      => 'textbox',
					'name'      => 'catalog_fields_title',
					'label'     => __('Title before value', 'rehub_child'),
					'description' => __('Set title before value or leave blank', 'rehub_child'),
				),
				array(
					'type'      => 'textbox',
					'name'      => 'catalog_fields_name',
					'label'     => __('Name of custom field', 'rehub_child'),
				),				
			),
		),
		array(
			'type' => 'select',
			'name' => 'catalog_readmore',
			'label' => __('Add button to end?', 'rehub_child'),
			'items' => array(
				array(
					'value' => 'read',
					'label' => __('Read more button', 'rehub_child'),
				),
				array(
					'value' => 'buybutton',
					'label' => __('Buy/Affiliate Button (use only in Post post type!!!)', 'rehub_child'),
				),
				array(
					'value' => 'none',
					'label' => __('Disable button', 'rehub_child'),
				),				
			),
			'default' => 'none',
		),								

	),
    'include_template' => 'catalogue_constructor.php',
);

/**
 * EOF
 */