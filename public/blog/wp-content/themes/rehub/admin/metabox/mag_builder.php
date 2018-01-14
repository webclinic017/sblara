<?php

return array(
	'id'          => 'mag_builder_page',
	'types'       => array('page'),
	'title'       => __('Page block builder', 'rehub_framework'),
	'priority'    => 'high',
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'template'    => array(

	    array(
			'type'      => 'group',
			'repeating' => true,
			'sortable'  => true,
			'name'      => 'pagebuilders',
			'title'     => __('Block', 'rehub_framework'),
			'fields'    => array(

				array(
					'type' => 'radioimage',
					'name' => 'rehub_framework_pb',
					'label' => __('Choose block', 'rehub_framework'),
					'description' => '',
					'items' => array(
						array(
							'value' => 'two_col_news_block',
							'label' => __('Two column news', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_1.png',
						),
						array(
							'value' => 'gal_carousel_block',
							'label' => __('Photo gallery', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_2.png',
						),
						array(
							'value' => 'video_block',
							'label' => __('Video block', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_3.png',
						),
						array(
							'value' => 'tab_block',
							'label' => __('1-4 tabs block', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_4.png',
						),
						array(
							'value' => 'woo_block',
							'label' => __('Woo commerce carousel', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_5.png',
						),
						array(
							'value' => 'news_with_thumbs_block',
							'label' => __('News block with small thumbs', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_6.png',
						),
						array(
							'value' => 'post_carousel_block',
							'label' => __('Posts carousel block', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_7.png',
						),								
						array(
							'value' => 'news_no_thumbs_block',
							'label' => __('News block without small thumbs', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_8.png',
						),
						array(
							'value' => 'small_thumb_loop',
							'label' => __('Posts string with small thumbs', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_9.png',
						),
						array(
							'value' => 'grid_loop',
							'label' => __('Posts grid', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_10.png',
						),
						array(
							'value' => 'regular_blog_loop',
							'label' => __('Posts string with big thumbs', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_11.png',
						),
						array(
							'value' => 'slider_block',
							'label' => __('Slider block', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_12.png',
						),
						array(
							'value' => 'custom_block',
							'label' => __('Custom text or banner', 'rehub_framework'),
							'img' => REHUB_ADMIN_URI . '/public/pb/pb_13.png',
						),																								
					),	
					'default' => 'custom_block',
				),


				// two column news block
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'two_col_news',
					'title'     => __('Two column news block', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_two_col_news',
					),					
					'fields'    => array(

						array(
							'type' => 'select',
							'name' => 'two_col_news_module_cats_1',
							'label' => __('Choose category for 1 column', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to first column', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'two_col_news_module_formats_1',
							'label' => __('Choose post formats for 1 column', 'rehub_framework'),
							'description' => __('Choose post formats to display in first column or leave blank to display all', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_post_formats',
									),
								),
							),
							'default' => 'all',
						),	

						array(
							'type' => 'textbox',
							'name' => 'two_col_news_module_offset_1',
							'label' => __('Offset for 1 col', 'rehub_framework'),
							'description' => __('Number of posts to offset for first column  or leave blank', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),											

						array(
							'type' => 'select',
							'name' => 'two_col_news_module_cats_2',
							'label' => __('Choose category for 2 column', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to second column', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'two_col_news_module_formats_2',
							'label' => __('Choose post formats for 2 column', 'rehub_framework'),
							'description' => __('Choose post formats to display in second column or leave blank to display all', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_post_formats',
									),
								),
							),
							'default' => 'all',
						),


						array(
							'type' => 'textbox',
							'name' => 'two_col_news_module_offset_2',
							'label' => __('Offset for 2 col', 'rehub_framework'),
							'description' => __('Number of posts to offset for second column  or leave blank', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),																		

						array(
							'type' => 'textbox',
							'name' => 'two_col_news_module_fetch',
							'label' => __('Fetch Count', 'rehub_framework'),
							'description' => __('How much posts you\'d like to display?', 'rehub_framework'),
							'default' => '4',
							'validation' => 'numeric',
						),


						array(
							'type' => 'toggle',
							'name' => 'two_col_news_module_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'two_col_news_module_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'two_col_news_module_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'two_col_news_module_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'two_col_news_module_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'two_col_news_module_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'two_col_news_module_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'two_col_news_module_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'two_col_news_module_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// Gallery block
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'gal_carousel',
					'title'     => __('Photo gallery', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_gal_carousel',
					),					
					'fields'    => array(																																	

						array(
							'type'      => 'group',
							'repeating' => true,
							'sortable'  => true,
							'name'      => 'gal_carousel_group',
							'title'     => __('Image', 'rehub_framework'),
							'fields'    => array(
								array(
									'type' => 'upload',
									'name' => 'gal_carousel_img',
									'label' => __('Upload the Image Here', 'rehub_framework'),
									'default' => '',
								),
							    array(
							        'type' => 'textbox',
							        'name' => 'gal_carousel_url',
							        'label' => __('Set url', 'rehub_framework'),
							        'description' => __('Set url on image or leave blank', 'rehub_framework'),
							        'validation' => 'url',
							    ),								
							),
						),						

						array(
							'type' => 'toggle',
							'name' => 'gal_carousel_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'gal_carousel_module_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'gal_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'gal_carousel_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'gal_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'gal_carousel_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'gal_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'gal_carousel_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'gal_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// Video news block
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'video_mod',
					'title'     => __('Video news block', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_video_block',
					),					
					'fields'    => array(
					
						array(
							'type' => 'select',
							'name' => 'video_mod_loop_tags',
							'label' => __('Choose tag for block', 'rehub_framework'),
							'description' => __('Choose tag from which to display content in block or leave blank', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'vp_get_tags',
									),
								),
							),
							'default' => '',
						),						

						array(
							'type' => 'toggle',
							'name' => 'video_mod_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'video_mod_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'video_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'video_mod_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'video_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'video_mod_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'video_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'video_mod_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'video_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// Tabbed block
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'tab_mod',
					'title'     => __('Tabbed block', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_tab_block',
					),					
					'fields'    => array(

						array(
							'type' => 'select',
							'name' => 'tab_mod_cats_1',
							'label' => __('Choose category for 1 tab', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to first tab', 'rehub_framework'),
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
							'name' => 'tab_mod_name_1',
							'label' => __('Choose name for 1 tab', 'rehub_framework'),
							'description' => __('Note, name must be maximum 15 symbols', 'rehub_framework'),
							'validation' => 'maxlength[15]',
						),

						array(
							'type' => 'select',
							'name' => 'tab_mod_cats_2',
							'label' => __('Choose category for 2 tab', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to second tab', 'rehub_framework'),
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
							'name' => 'tab_mod_name_2',
							'label' => __('Choose name for 2 tab', 'rehub_framework'),
							'description' => __('Note, name must be maximum 12 symbols', 'rehub_framework'),
							'validation' => 'maxlength[15]',
						),

						array(
							'type' => 'select',
							'name' => 'tab_mod_cats_3',
							'label' => __('Choose category for 3 tab', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to third tab', 'rehub_framework'),
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
							'name' => 'tab_mod_name_3',
							'label' => __('Choose name for 3 tab', 'rehub_framework'),
							'description' => __('Note, name must be maximum 12 symbols', 'rehub_framework'),
							'validation' => 'maxlength[15]',
						),

						array(
							'type' => 'select',
							'name' => 'tab_mod_cats_4',
							'label' => __('Choose category for 4 tab', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to fourth tab', 'rehub_framework'),
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
							'name' => 'tab_mod_name_4',
							'label' => __('Choose name for 4 tab', 'rehub_framework'),
							'description' => __('Note, name must be maximum 12 symbols', 'rehub_framework'),
							'validation' => 'maxlength[15]',
						),

						array(
							'type' => 'toggle',
							'name' => 'tab_mod_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'tab_mod_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'tab_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'tab_mod_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'tab_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'tab_mod_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'tab_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'tab_mod_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'tab_mod_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),


					),
				),	

				// Blog posts with small thumbs left align
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'small_thumb_loop_mod',
					'title'     => __('Blog posts with small thumbs', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_small_thumb_loop',
					),					
					'fields'    => array(

						array(
							'type' => 'multiselect',
							'name' => 'small_thumb_loop_cats',
							'label' => __('Exclude Categories', 'rehub_framework'),
							'description' => __('Choose categories that you\'d like to exclude from blog stream', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'small_thumb_loop_cats_in',
							'label' => __('Or Include Category', 'rehub_framework'),
							'description' => __('Choose parent category that you\'d like to include to stream. Or leave blank both fields to show posts from all categories', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'small_thumb_loop_format',
							'label' => __('Choose post formats for block', 'rehub_framework'),
							'description' => __('Choose post formats to display in block or leave blank to display all', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_post_formats',
									),
								),
							),
							'default' => 'all',
						),						

						array(
							'type' => 'textbox',
							'name' => 'small_thumb_loop_fetch',
							'label' => __('Fetch Count', 'rehub_framework'),
							'description' => __('How much posts you\'d like to display in 1 page?', 'rehub_framework'),
							'default' => '5',
							'validation' => 'numeric',
						),
						
						array(
							'type' => 'textbox',
							'name' => 'small_thumb_loop_offset',
							'label' => __('Offset for block', 'rehub_framework'),
							'description' => __('Enter number of posts to offset or leave blank', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),						

						array(
							'type' => 'toggle',
							'name' => 'small_thumb_loop_toggle_page',
							'label' => __('Enable pagination?', 'rehub_framework'),
						),						

						array(
							'type' => 'toggle',
							'name' => 'small_thumb_loop_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'small_thumb_loop_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'small_thumb_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'small_thumb_loop_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'small_thumb_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'small_thumb_loop_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'small_thumb_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'small_thumb_loop_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'small_thumb_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),


				// Regular blog posts
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'regular_blog_loop_mod',
					'title'     => __('Regular blog posts', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_regular_blog_loop',
					),					
					'fields'    => array(

						array(
							'type' => 'multiselect',
							'name' => 'regular_blog_loop_cats',
							'label' => __('Exclude Categories', 'rehub_framework'),
							'description' => __('Choose categories that you\'d like to exclude from blog stream', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'regular_blog_loop_cats_in',
							'label' => __('Or Include Category', 'rehub_framework'),
							'description' => __('Choose parent category that you\'d like to include to stream. Or leave blank both fields to show posts from all categories', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'regular_blog_loop_format',
							'label' => __('Choose post formats for block', 'rehub_framework'),
							'description' => __('Choose post formats to display in block or leave blank to display all', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_post_formats',
									),
								),
							),
							'default' => 'all',
						),						

						array(
							'type' => 'textbox',
							'name' => 'regular_blog_loop_fetch',
							'label' => __('Fetch Count', 'rehub_framework'),
							'description' => __('How much posts you\'d like to display in 1 page?', 'rehub_framework'),
							'default' => '5',
							'validation' => 'numeric',
						),
						
						array(
							'type' => 'textbox',
							'name' => 'regular_blog_loop_offset',
							'label' => __('Offset for block', 'rehub_framework'),
							'description' => __('Enter number of posts to offset or leave blank', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),						

						array(
							'type' => 'toggle',
							'name' => 'regular_blog_loop_toggle_page',
							'label' => __('Enable pagination?', 'rehub_framework'),
						),						

						array(
							'type' => 'toggle',
							'name' => 'regular_blog_loop_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'regular_blog_loop_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'regular_blog_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'regular_blog_loop_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'regular_blog_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'regular_blog_loop_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'regular_blog_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'regular_blog_loop_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'regular_blog_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// Grid blog posts
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'grid_loop_mod',
					'title'     => __('Grid style posts', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_grid_loop',
					),					
					'fields'    => array(

						array(
							'type' => 'multiselect',
							'name' => 'grid_loop_cats',
							'label' => __('Exclude Categories', 'rehub_framework'),
							'description' => __('Choose categories that you\'d like to exclude from blog stream', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'grid_loop_cats_in',
							'label' => __('Or Include Category', 'rehub_framework'),
							'description' => __('Choose parent category that you\'d like to include to stream. Or leave blank both fields to show posts from all categories', 'rehub_framework'),
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
							'type' => 'select',
							'name' => 'grid_loop_format',
							'label' => __('Choose post formats for block', 'rehub_framework'),
							'description' => __('Choose post formats to display in block or leave blank to display all', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_post_formats',
									),
								),
							),
							'default' => 'all',
						),						

						array(
							'type' => 'textbox',
							'name' => 'grid_loop_fetch',
							'label' => __('Fetch Count', 'rehub_framework'),
							'description' => __('How much posts you\'d like to display in 1 page?', 'rehub_framework'),
							'default' => '10',
							'validation' => 'numeric',
						),
						
						array(
							'type' => 'textbox',
							'name' => 'grid_loop_offset',
							'label' => __('Offset for block', 'rehub_framework'),
							'description' => __('Enter number of posts to offset or leave blank', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),

						array(
							'type' => 'select',
							'name' => 'grid_loop_toggle_page',
							'label' => __('Pagination type', 'rehub_framework'),
							'items' => array(
								array(
									'value' => '1',
									'label' => __('Simple pagination', 'rehub_framework'),
								),
								array(
									'value' => '2',
									'label' => __('New item will be added by click', 'rehub_framework'),
								),
								array(
									'value' => 'no',
									'label' => __('No pagination', 'rehub_framework'),
								),
							),
							'default' => array(
								'no',
							),
						),																	

						array(
							'type' => 'toggle',
							'name' => 'grid_loop_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'grid_loop_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'grid_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'grid_loop_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'grid_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'grid_loop_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'grid_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'grid_loop_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'grid_loop_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// 1 big + 4 small news with thumbs
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'news_with_thumbs_mod',
					'title'     => __('News block with thumbs', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_news_with_thumbs_block',
					),					
					'fields'    => array(

						array(
							'type' => 'select',
							'name' => 'news_with_thumbs_cats',
							'label' => __('Choose Category', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to block', 'rehub_framework'),
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
							'type' => 'toggle',
							'name' => 'news_with_thumbs_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'news_with_thumbs_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'news_with_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'news_with_thumbs_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'news_with_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'news_with_thumbs_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'news_with_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'news_with_thumbs_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'news_with_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// 1 big + 4 small news no thumbs
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'news_no_thumbs_mod',
					'title'     => __('News block without small thumbs', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_news_no_thumbs_block',
					),					
					'fields'    => array(

						array(
							'type' => 'select',
							'name' => 'news_no_thumbs_cats',
							'label' => __('Choose Category', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to block', 'rehub_framework'),
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
							'type' => 'toggle',
							'name' => 'news_no_thumbs_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'news_no_thumbs_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'news_no_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'news_no_thumbs_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'news_no_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'news_no_thumbs_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'news_no_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'news_no_thumbs_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'news_no_thumbs_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// posts carousel
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'post_carousel_mod',
					'title'     => __('Posts carousel block', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_post_carousel_block',
					),					
					'fields'    => array(

						array(
							'type' => 'select',
							'name' => 'post_carousel_cats',
							'label' => __('Choose Category', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to block', 'rehub_framework'),
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
							'name' => 'post_carousel_fetch',
							'label' => __('Fetch Count', 'rehub_framework'),
							'description' => __('How much posts you\'d like to display in carousel?', 'rehub_framework'),
							'default' => '6',
							'validation' => 'numeric',
						),

						array(
							'type' => 'select',
							'name' => 'post_carousel_formats',
							'label' => __('Choose post formats for carousel', 'rehub_framework'),
							'description' => __('Choose post formats to display in carousel or leave blank to display all', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_post_formats',
									),
								),
							),
							'default' => 'all',
						),						
						

						array(
							'type' => 'toggle',
							'name' => 'post_carousel_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'post_carousel_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'post_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'post_carousel_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'post_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'post_carousel_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'post_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'post_carousel_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'post_carousel_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),

				// post slider
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'slider_mod',
					'title'     => __('Posts slider block', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_slider_block',
					),					
					'fields'    => array(

						array(
							'type' => 'toggle',
							'name' => 'slider_toggle_posts',
							'label' => __('Enable category?', 'rehub_framework'),
						),

						 array(
							'type' => 'notebox',
							'name' => 'slider_note',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('If you enable field above, you can choose certain category for slider. Disable to display latest featured posts in slider.', 'rehub_framework'),
							'status' => 'normal',
						),						


						array(
							'type' => 'select',
							'name' => 'slider_cats',
							'label' => __('Choose Category', 'rehub_framework'),
							'description' => __('Choose the category that you\'d like to include to block', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'vp_get_categories',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'slider_toggle_posts',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',																																						
						),

						array(
							'type' => 'textbox',
							'name' => 'slider_fetch',
							'label' => __('Fetch Count', 'rehub_framework'),
							'description' => __('How much posts you\'d like to display in slider?', 'rehub_framework'),
							'default' => '6',
							'validation' => 'numeric',
						),						
						

						array(
							'type' => 'toggle',
							'name' => 'slider_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'slider_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'slider_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'slider_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'slider_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'slider_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'slider_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'slider_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'slider_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),


				// custom block
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'custom_mod',
					'title'     => __('Custom block', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_custom_block',
					),					
					'fields'    => array(

						 array(
							'type' => 'textarea',
							'name' => 'custom_mod_area',
							'label' => __('Custom code', 'rehub_framework'),
							'description' => __('Insert your custom code (adsense ads, banner, etc.)', 'rehub_framework'),
							'default' => '',
						),

						array(
							'type' => 'toggle',
							'name' => 'custom_toggle_border',
							'label' => __('Enable box border?', 'rehub_framework'),
						),										

						array(
							'type' => 'toggle',
							'name' => 'custom_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						



						array(
							'type' => 'textbox',
							'name' => 'custom_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'custom_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'custom_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'custom_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'custom_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'custom_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'custom_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'custom_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),


				// woo block
			    array(
					'type'      => 'group',
					'repeating' => false,
					'sortable'  => false,
					'name'      => 'woo_mod',
					'title'     => __('Woo commerce product carousel', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'rehub_framework_pb',
						'function' => 'rehub_framework_pb_is_woo_block',
					),					
					'fields'    => array(


						array(
							'type' => 'slider',
							'name' => 'woo_mod_fetch',
							'label' => __('Number of products to display', 'rehub_framework'),
							'min' => '4',
							'max' => '10',
							'step' => '1',
							'default' => '4',
						),

						 array(
							'type' => 'select',
							'name' => 'woo_mod_type',
							'label' => __('Type of products to display in block', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'latest',
									'label' => __('Latest products', 'rehub_framework'),
								),
								array(
									'value' => 'featured',
									'label' => __('Featured products', 'rehub_framework'),
								),
								array(
									'value' => 'best',
									'label' => __('Best sellers', 'rehub_framework'),
								),
							),
							'default' => array(
							'latest',
							),
						),

						array(
							'type' => 'textbox',
							'name' => 'woo_cat',
							'label' => __('Set category', 'rehub_framework'),
							'description' => __('Set slug of product category or leave blank', 'rehub_framework'),
						),												
									
						array(
							'type' => 'toggle',
							'name' => 'woo_toggle_title',
							'label' => __('Enable title of box?', 'rehub_framework'),
						),						

						array(
							'type' => 'textbox',
							'name' => 'woo_title',
							'label' => __('Title of block', 'rehub_framework'),
							'description' => __('Set title of block (use short titles)', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'woo_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => '',
						),

						array(
							'type' => 'radioimage',
							'name' => 'woo_title_position',
							'label' => __('Choose style of title', 'rehub_framework'),
							'description' => __('Choose position and style of title', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_block_title_position',
									),
								),
							),
							'dependency' => array(
                                 'field' => 'woo_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),
							'default' => 'top_title',
						),							

						array(
							'type' => 'textbox',
							'name' => 'woo_url_text',
							'label' => __('Custom URL Text:', 'rehub_framework'),
							'description' => __('Set text of url near title', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'woo_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
						),

						array(
							'type' => 'textbox',
							'name' => 'woo_url_url',
							'label' => __('Custom URL:', 'rehub_framework'),
							'description' => __('Set url with http://', 'rehub_framework'),
							'dependency' => array(
                                 'field' => 'woo_toggle_title',
                                 'function' => 'vp_dep_boolean',
                            ),							
							'default' => '',
							'validation' => 'url',
						),	

					),																			              
                ),




            ),
        ),
						
    ),
    'include_template' => 'page_builder.php',
);



/**
 * EOF
 */