<?php

return array(
	'id'          => 'rehub_aff_archive',
	'types'       => array('page'),
	'title'       => __('Offer archive settings', 'rehub_child'),
	'priority'    => 'low',
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'template'    => array(
		 array(
			'type' => 'notebox',
			'name' => 'affgrid_note',
			'label' => __('Note', 'rehub_child'),
			'description' => __('This template works only with ThirstyAffiliate link posts', 'rehub_child'),
			'status' => 'normal',
		),		
		array(
			'type' => 'textbox',
			'name' => 'aff_archive_cat',
			'label' => __('Enter slug of category', 'rehub_child'),
			'description' => __('Leave blank or set category to show', 'rehub_child'),
		),
		array(
			'type' => 'textbox',
			'name' => 'aff_archive_fetch',
			'label' => __('Fetch Count', 'rehub_child'),
			'description' => __('How much posts you\'d like to display on page?', 'rehub_child'),
			'default' => '',
			'validation' => 'numeric',
		),										
	),
    'include_template' => 'template-affarchivelist.php,template-affarchivegrid.php',
);

/**
 * EOF
 */