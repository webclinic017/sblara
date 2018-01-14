<?php
$imagedir = get_template_directory_uri().'/images/';
return array(
	'title' => __('Theme Options', 'rehub_framework'),
	'page' => 'Rehub Theme Options',
	'logo' => '',
	'menus' => array(
		array(
			'title' => __('General Options', 'rehub_framework'),
			'name' => 'menu_1',
			'icon' => 'font-awesome:fa-codepen',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('General Options', 'rehub_framework'),
					'fields' => array(
					
						array(
							'type' => 'select',
							'name' => 'rehub_framework_archive_layout',
							'label' => __('Select Blog Layout', 'rehub_framework'),
							'description' => __('Select what kind of post string layout you want to use for blog, archives, search pages', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'rehub_framework_archive_blog',
									'label' => __('Blog Layout', 'rehub_framework'),
								),								
								array(
									'value' => 'rehub_framework_archive_list',
									'label' => __('List Layout with left thumbnails', 'rehub_framework'),
								),	
								array(
									'value' => 'rehub_framework_archive_grid',
									'label' => __('Grid layout', 'rehub_framework'),
								),
								array(
									'value' => 'rehub_framework_archive_gridfull',
									'label' => __('Full width Grid layout', 'rehub_framework'),
								),																							
							),
							'default' => array(
								'rehub_framework_archive_blog',
							),
						),
						array(
							'type' => 'select',
							'name' => 'rehub_framework_category_layout',
							'label' => __('Select Category Layout', 'rehub_framework'),
							'description' => __('Select what kind of post string layout you want to use for categories', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'rehub_framework_category_blog',
									'label' => __('Blog Layout', 'rehub_framework'),
								),								
								array(
									'value' => 'rehub_framework_category_list',
									'label' => __('List Layout with left thumbnails', 'rehub_framework'),
								),
								array(
									'value' => 'rehub_framework_category_grid',
									'label' => __('Grid layout with sidebar', 'rehub_framework'),
								),	
								array(
									'value' => 'rehub_framework_category_gridfull',
									'label' => __('Full width Grid layout', 'rehub_framework'),
								),																									
							),
							'default' => array(
								'rehub_framework_category_list',
							),
						),	
											
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_custom_css',
							'label' => __('Custom CSS', 'rehub_framework'),
							'description' => __('Write your custom CSS here', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'css',
						),						
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_analytics',
							'label' => __('Analytics Code/js code', 'rehub_framework'),
							'description' => __('Enter your Analytics code or any html, js code', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_sidebar_left',
							'label' => __('Set sidebar to left side?', 'rehub_framework'),
							'default' => '0',
						),																			
					),
				),
			),
		),
		array(
			'title' => __('Logo & favicon', 'rehub_framework'),
			'name' => 'menu_12',
			'icon' => 'font-awesome:fa-gear',
			'controls' => array(

				array(
					'type' => 'section',
					'title' => __('Logo settings', 'rehub_framework'),
					'fields' => array(						
						array(
							'type' => 'upload',
							'name' => 'rehub_logo',
							'label' => __('Upload Logo', 'rehub_framework'),
							'description' => __('Upload your logo. Max width is 463px. (1200px for full width)', 'rehub_framework'),
							'default' => '',
						),
						 array(
							'type' => 'slider',
							'name' => 'rehub_logo_margin',
							'label' => __('Margin logo from top', 'rehub_framework'),
							'description' => __('Set space between logo and top area in pixels', 'rehub_framework'),
							'min' => '0',
							'max' => '100',
							'step' => '5',
							'default' => '5',
						),						
						array(
							'type' => 'upload',
							'name' => 'rehub_logo_retina',
							'label' => __('Upload Logo (retina version)', 'rehub_framework'),
							'description' => __('Upload retina version of the logo. It should be 2x the size of main logo.', 'rehub_framework'),
							'default' => '',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_logo_retina_width',
							'label' => __('Retina logo width', 'rehub_framework'),
							'description' => __('If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.', 'rehub_framework'),
						),	
						array(
							'type' => 'textbox',
							'name' => 'rehub_logo_retina_height',
							'label' => __('Retina logo height', 'rehub_framework'),							
							'description' => __('If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.', 'rehub_framework'),
						),																	
						array(
							'type' => 'textbox',
							'name' => 'rehub_text_logo',
							'label' => __('Text logo', 'rehub_framework'),							
							'description' => __('You can type text logo. Use this field only if no image logo', 'rehub_framework'),
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_text_slogan',
							'label' => __('Slogan', 'rehub_framework'),							
							'description' => __('You can type slogan below text logo. Use this field only if no image logo', 'rehub_framework'),
						),							
					),
				),

				array(
					'type' => 'section',
					'title' => __('Favicons', 'rehub_framework'),
					'fields' => array(
						//Favicon 144
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_144',
							'label' => __('144px Favicon', 'rehub_framework'),
							'description' => __('Upload your favicon for third-generation iPad with high-resolution Retina display (144x144 px)', 'rehub_framework'),
							'default' => $imagedir . 'default/apple-touch-icon-144x144-precomposed.png',
						),
						//Favicon 114
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_114',
							'label' => __('114px Favicon', 'rehub_framework'),
							'description' => __('Upload your favicon for iPhone with high-resolution Retina display (114x114 px)', 'rehub_framework'),
							'default' => $imagedir . 'default/apple-touch-icon-114x114-precomposed.png',
						),
						//Favicon 72
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_72',
							'label' => __('72px Favicon', 'rehub_framework'),
							'description' => __('Upload your favicon For first- and second-generation iPad (72x72 px)', 'rehub_framework'),
							'default' => $imagedir . 'default/apple-touch-icon-72x72-precomposed.png',
						),
						//Favicon 57
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_57',
							'label' => __('57px Favicon', 'rehub_framework'),
							'description' => __('Upload your favicon For non-Retina iPhone, iPod Touch, and Android 2.1+ devices (57x57 px)', 'rehub_framework'),
							'default' => $imagedir . 'default/apple-touch-icon-precomposed.png',
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon',
							'label' => __('Default Favicon', 'rehub_framework'),
							'description' => __('Upload your favicon For Default Browser', 'rehub_framework'),
							'default' => $imagedir . 'default/favicon.png',
						),							
					),
				),
			),
		),
		array(
			'title' => __('Header and Menu', 'rehub_framework'),
			'name' => 'menu_2',
			'icon' => 'font-awesome:fa-wrench ',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Header Options', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'rehub_header_style',
							'label' => __('Select Header style', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'header_first',
									'label' => __('Logo + banner 468X60 + search box', 'rehub_framework'),
								),
								array(
									'value' => 'header_second',
									'label' => __('Logo + banner 728X90', 'rehub_framework'),
								),
								array(
									'value' => 'header_third',
									'label' => __('Full width logo', 'rehub_framework'),
								),
								array(
									'value' => 'header_fourth',
									'label' => __('Full width logo + full width banner', 'rehub_framework'),
								),	
								array(
									'value' => 'header_five',
									'label' => __('Logo + menu', 'rehub_framework'),
								),															
							),
								'default' => array(
								'header_first',
							),
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_body_block',
							'label' => __('Enable block width of header', 'rehub_framework'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_sticky_nav',
							'label' => __('Sticky Navigation Bar', 'rehub_framework'),
							'description' => __('Enable/Disable Sticky navigation bar.', 'rehub_framework'),
							'default' => '0',
						),
	
						array(
							'type' => 'toggle',
							'name' => 'rehub_header_social',
							'label' => __('Enable Header Social Icons', 'rehub_framework'),
							'description' => __('You can set your social media URLs in the Social Media Options tab.', 'rehub_framework'),
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'exclude_cart_header',
							'label' => __('Disable cart in header', 'rehub_framework'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_header_top',
							'label' => __('Disable top block', 'rehub_framework'),
							'description' => __('You can disable top block with links, cart, social icons in header', 'rehub_framework'),
							'default' => '0',
						),						
						array(
							'type' => 'select',
							'name' => 'rehub_headercolor_style',
							'label' => __('Choose color style of header', 'rehub_framework'),
							'description' => __('Choose one of predefinite style of header or set custom', 'rehub_framework'),							
							'items' => array(
								array(
									'value' => '0',
									'label' => __('White', 'rehub_framework'),
								),
								array(
									'value' => '1',
									'label' => __('Dark', 'rehub_framework'),
								),
								array(
									'value' => '2',
									'label' => __('Custom', 'rehub_framework'),
								),
							),
							'default' => array(
								'0',
							),
						),
																						
					),
				),							
				array(
					'type' => 'section',
					'title' => __('Custom Header Options', 'rehub_framework'),
					'fields' => array(
						 array(
							'type' => 'notebox',
							'name' => 'rehub_header_note',
							'label' => __('Note!', 'rehub_framework'),
							'description' => __('Custom colors will work only if you choose custom style of header in select box above', 'rehub_framework'),
							'status' => 'info',
						),						
						array(
							'type' => 'color',
							'name' => 'rehub_header_color_background',
							'label' => __('Background Color', 'rehub_framework'),
							'description' => __('Choose the background color or leave blank for default', 'rehub_framework'),
							'format' => 'hex',	
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_header_background_image',
							'label' => __('Background Image', 'rehub_framework'),
							'description' => __('Upload a background image or leave blank', 'rehub_framework'),
							'default' => '',
							
						),
						array(
							'type' => 'select',
							'name' => 'rehub_header_background_repeat',
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
							'name' => 'rehub_header_background_position',
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
							'name' => 'rehub_header_background_offset',
							'label' => __('Set offset', 'rehub_framework'),
							'description' => __('Set offset from top for background (without px) for avoid overlap', 'rehub_framework'),
							'validation' => 'numeric',
							
						),						
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_nav',
							'label' => __('Custom color of menu background', 'rehub_framework'),
							'description' => __('Or leave blank for default color', 'rehub_framework'),
							'format' => 'hex',
							
						),	
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_nav_font',
							'label' => __('Custom color of menu font', 'rehub_framework'),
							'description' => __('Or leave blank for default color', 'rehub_framework'),
							'format' => 'hex',
							
						),
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_top',
							'label' => __('Custom color for top line of header', 'rehub_framework'),
							'description' => __('Or leave blank for default white color', 'rehub_framework'),
							'format' => 'hex',
							
						),	
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_top_font',
							'label' => __('Custom color of menu font for top line of header', 'rehub_framework'),
							'description' => __('Or leave blank for default color', 'rehub_framework'),
							'format' => 'hex',
							
						),		
					),
				),
				array(
					'type' => 'section',
					'title' => __('News ticker', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_enable_newstick',
							'label' => __('Enable news ticker', 'rehub_framework'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_enable_newstick_home',
							'label' => __('Show only on home', 'rehub_framework'),
							'default' => '0',
						),	
						array(
							'type' => 'textbox',
							'name' => 'rehub_newstick_label',
							'label' => __('Type label of newsticker', 'rehub_framework'),
							'default' => 'Special',							
						),						
						array(
							'type' => 'multiselect',
							'name' => 'rehub_newstick_cat',
							'label' => __('Categories', 'rehub_framework'),
							'description' => __('Pick the categories that will show in Newsticker.', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_categories',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),							
						),
						array(
							'type' => 'multiselect',
							'name' => 'rehub_newstick_tag',
							'label' => __('Tags', 'rehub_framework'),
							'description' => __('Pick the tags that will show in Newsticker.', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_tags',
									),
								),
							),						
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_newstick_fetch',
							'label' => __('Number of posts to display', 'rehub_framework'),
							'default' => '5',
							'validation' => 'numeric',							
						),						

					),
				),							
			),
		),
		array(
			'title' => __('Footer Options', 'rehub_framework'),
			'name' => 'menu_3',
			'icon' => 'font-awesome:fa-caret-square-o-down',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Footer options', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_footer_widgets',
							'label' => __('Footer Widgets', 'rehub_framework'),
							'description' => __('Enable or Disable the footer widget area', 'rehub_framework'),
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_footer_block',
							'label' => __('Enable footer block width?', 'rehub_framework'),
							'default' => '0',
						),						
					
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_footer_text',
							'label' => __('Footer Bottom Text', 'rehub_framework'),
							'description' => __('Enter your copyright text or whatever you want right here.', 'rehub_framework'),
							'default' => '&copy; 2014 Sizam Design. All rights reserved.',
							'theme' => 'chrome',
							'mode' => 'html',
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_footer_logo',
							'label' => __('Upload Logo for footer', 'rehub_framework'),
							'description' => __('Upload your logo for footer.', 'rehub_framework'),
							'default' => '',
						),						
					),
				),
			),
		),
		array(
			'title' => __('Homepage Options', 'rehub_framework'),
			'name' => 'menu_4',
			'icon' => 'font-awesome:fa-home',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Featured Area Options', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_featured_toggle',
							'label' => __('Display Featured Area', 'rehub_framework'),
							'description' => __('Display the featured area on the homepage', 'rehub_framework'),
							'default' => '0',
						),	

						array(
							'type' => 'notebox',
							'name' => 'rehub_featured_note',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('Each post has option to be chosen as Featured Post in post settings. You need to have minimum 5 featured posts (3 for slider and 2 for right section) for correct work of feature section. Also, you can create featured section based on tag name. Don\'t choose any posts and set tag for this. If you leave all fields blank, 5 last posts that you mark as featured will be shown', 'rehub_framework'),
							'status' => 'normal',
							'dependency' => array(
                            	'field' => 'rehub_featured_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),																


						array(
							'type' => 'sorter',
							'max_selection' => 6,
							'name' => 'rehub_featured_slider',
							'label' => __('Posts for feature slider', 'rehub_framework'),
							'description' => __('Select posts for feature slider', 'rehub_framework'),
							'items'=> array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_get_featured_posts'
									)
								)
							),
							'dependency' => array(
                            	'field' => 'rehub_featured_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),
						),						

						array(
							'type' => 'sorter',
							'max_selection' => 2,
							'name' => 'rehub_featured_right',
							'label' => __('Posts for right feature section', 'rehub_framework'),
							'description' => __('Select 2 posts for right feature section', 'rehub_framework'),
							'items'=> array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_framework_get_featured_posts_right'
									)
								)
							),
							'dependency' => array(
                            	'field' => 'rehub_featured_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),
						),
						array(
							'type' => 'color',
							'name' => 'rehub_feature_color',
							'label' => __('Set color for overlay in slider', 'rehub_framework'),
							'description' => __('Or leave blank for slider without overlay', 'rehub_framework'),
							'format' => 'rgba',
							'dependency' => array(
                            	'field' => 'rehub_featured_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							  
						),													


						array(
							'type' => 'textbox',
							'name' => 'rehub_featured_tag',
							'label' => __('Set tag', 'rehub_framework'),
							'description' => __('Set name of tag', 'rehub_framework'),
							'default' => '',
							'dependency' => array(
                            	'field' => 'rehub_featured_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),											

						array(
							'type' => 'toggle',
							'name' => 'rehub_exclude_posts',
							'label' => __('Exclude featured posts from posts string', 'rehub_framework'),
							'description' => __('Set this to on if you want to exclude your featured posts from posts string of other post blocks', 'rehub_framework'),
							'default' => '0',
							'dependency' => array(
                            	'field' => 'rehub_featured_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),
					),
				),

				array(
					'type' => 'section',
					'title' => __('Home page carousel Options', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_homecarousel_toggle',
							'label' => __('Display Homepage carousel', 'rehub_framework'),
							'description' => __('Display fullwidth carousel area on the homepage', 'rehub_framework'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_homecarousel_ed',
							'label' => __('Editor\'s choice posts', 'rehub_framework'),
							'description' => __('Display posts with editor\'s choice label?', 'rehub_framework'),
							'default' => '0',
							'dependency' => array(
                            	'field' => 'rehub_homecarousel_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),																	
						array(
							'type' => 'textbox',
							'name' => 'rehub_homecarousel_tag',
							'label' => __('Or from tag', 'rehub_framework'),
							'description' => __('Or enter name of tag for posts to show (also disable checkbox above for this)', 'rehub_framework'),
							'default' => '',
							'dependency' => array(
                            	'field' => 'rehub_homecarousel_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),
						array(
							'type' => 'notebox',
							'name' => 'rehub_homecarousel_note',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('You need to have minimum 5 posts for correct work of feature section. Editor\'s choice label you can set in options of each post on right section.', 'rehub_framework'),
							'status' => 'normal',
							'dependency' => array(
                            	'field' => 'rehub_homecarousel_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_homecarousel_label',
							'label' => __('Show badge on carousel', 'rehub_framework'),
							'description' => __('Display badge on carousel?', 'rehub_framework'),
							'default' => '1',
							'dependency' => array(
                            	'field' => 'rehub_homecarousel_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),
						array(
							'type' => 'select',
							'name' => 'rehub_label_color',
							'label' => __('Choose badge color', 'rehub_framework'),
							'items' => array(
								array(
								'value' => 'def',
								'label' => __('Orange - default', 'rehub_framework'),
								),
								array(
								'value' => 'blue',
								'label' => __('Blue', 'rehub_framework'),
								),
								array(
								'value' => 'green',
								'label' => __('Green', 'rehub_framework'),
								),
								array(
								'value' => 'violet',
								'label' => __('Violet', 'rehub_framework'),
								),								
								),
							'default' => 'def',
							'dependency' => array(
                            	'field' => 'rehub_homecarousel_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),								
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_homecarousel_label_text',
							'label' => __('Set text on label', 'rehub_framework'),
							'description' => __('Text in span tag will be on second row, please, use short text (8 symbols for 1 row, 7 symbols for 2 row)', 'rehub_framework'),
							'default' => 'Editor\'s <span>choice</span>',
							'dependency' => array(
                            	'field' => 'rehub_homecarousel_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),		
						array(
							'type' => 'toggle',
							'name' => 'rehub_homecarousel_cat',
							'label' => __('Display on category pages?', 'rehub_framework'),
							'description' => __('Display fullwidth carousel area also on category pages?', 'rehub_framework'),
							'default' => '0',
							'dependency' => array(
                            	'field' => 'rehub_homecarousel_toggle',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),																
					),
				),


			),
		),
		array(
			'title' => __('Social Media Options', 'rehub_framework'),
			'name' => 'menu_5',
			'icon' => 'font-awesome:fa-twitter',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Social Media Pages', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'rehub_facebook',
							'label' => __('Facebook link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_twitter',
							'label' => __('Twitter link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_google',
							'label' => __('Google plus link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_instagram',
							'label' => __('Instagram link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_tumblr',
							'label' => __('Tumblr link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_youtube',
							'label' => __('Youtube link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_vimeo',
							'label' => __('Vimeo link', 'rehub_framework'),
							'validation' => 'url',
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_pinterest',
							'label' => __('Pinterest link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_linkedin',
							'label' => __('Linkedin link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_soundcloud',
							'label' => __('Soundcloud link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_dribbble',
							'label' => __('Dribbble link', 'rehub_framework'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_vk',
							'label' => __('Vk.com link', 'rehub_framework'),
							'validation' => 'url',
						),

						array(
							'type' => 'textbox',
							'name' => 'rehub_rss',
							'label' => __('Rss link', 'rehub_framework'),
							'validation' => 'url',
						),												
					),
				),
			),
		),
		array(
			'title' => __('Appearance/Color', 'rehub_framework'),
			'name' => 'menu_6',
			'icon' => 'font-awesome:fa-pencil-square-o',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Color schema of website', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'rehub_color_schema',
							'label' => __('Choose color schema', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'default',
									'label' => __('Default - orange', 'rehub_framework'),
								),
								array(
									'value' => 'blue',
									'label' => __('Blue', 'rehub_framework'),
								),
								array(
									'value' => 'green',
									'label' => __('Green', 'rehub_framework'),
								),
								array(
									'value' => 'violet',
									'label' => __('Violet', 'rehub_framework'),
								),
								array(
									'value' => 'yellow',
									'label' => __('Yellow', 'rehub_framework'),
								),								
							),
							'default' => array(
								'default',
							),
						),
						array(
							'type' => 'color',
							'name' => 'rehub_custom_color',
							'label' => __('Custom color', 'rehub_framework'),
							'description' => __('Or you can set any main color (it will be used under white text)', 'rehub_framework'),
							'format' => 'hex',
						),
						array(
							'type' => 'color',
							'name' => 'rehub_bg_flat_color',
							'label' => __('Create flat color for background', 'rehub_framework'),
							'description' => __('Disable default background image and add flat color. If you want to add images to background - use enhanced branded background options in Ads Options', 'rehub_framework'),
							'format' => 'hex',
						),

					),
				),
				array(
					'type' => 'toggle',
					'name' => 'rehub_pattern_disable',
					'label' => __('Disable dotted overlay on thumbnails?', 'rehub_framework'),
					'default' => '0',
				),
				array(
					'type' => 'toggle',
					'name' => 'rehub_ecwid_enable',
					'label' => __('Enable ecwid store customization?', 'rehub_framework'),
					'default' => '0',
				),
				array(
					'type' => 'color',
					'name' => 'rehub_color_link',
					'label' => __('Custom color for links inside posts', 'rehub_framework'),
					'format' => 'hex',	
				),				

			),
		),
		array(
			'title' => __('Fonts Options', 'rehub_framework'),
			'name' => 'menu_7',
			'icon' => 'font-awesome:fa-font',
			'controls' => array(

				array(
					'type' => 'section',
					'title' => __('Navigation Font', 'rehub_framework'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_nav_font',
							'label' => __('Navigation Font Family', 'rehub_framework'),
							'description' => __('Font for navigation', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_nav_font_style',
							'label' => __('Font Style', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_nav_font',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_nav_font_weight',
							'label' => __('Font Weight', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_nav_font',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type' => 'multiselect',
							'name' => 'rehub_nav_font_subset',
							'label' => __('Font Subset', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_nav_font',
										'value' => 'vp_get_gwf_subset',
									),
								),
							),
							'default' => 'latin',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_nav_font_trans',
							'label' => __('Disable uppercase?', 'rehub_framework'),
							'default' => '0',							
						),												
					),
				),//END NAV FONT

				array(
					'type' => 'section',
					'title' => __('Headings Font', 'rehub_framework'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_headings_font',
							'label' => __('Headings Font Family', 'rehub_framework'),
							'description' => __('Font for headings in text, sidebar, footer', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_headings_font_style',
							'label' => __('Font Style', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_headings_font',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_headings_font_weight',
							'label' => __('Font Weight', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_headings_font',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type' => 'multiselect',
							'name' => 'rehub_headings_font_subset',
							'label' => __('Font Subset', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_headings_font',
										'value' => 'vp_get_gwf_subset',
									),
								),
							),
							'default' => 'latin',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_headings_font_trans',
							'label' => __('Disable uppercase?', 'rehub_framework'),
							'default' => '0',							
						),												
					),
				),//END Headings FONT

				array(
					'type' => 'section',
					'title' => __('Block Titles', 'rehub_framework'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_block_font',
							'label' => __('Block Titles Font', 'rehub_framework'),
							'description' => __('Font for titles of content blocks and pages', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_block_font_style',
							'label' => __('Font Style', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_block_font',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_block_font_weight',
							'label' => __('Font Weight', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_block_font',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type' => 'multiselect',
							'name' => 'rehub_block_font_subset',
							'label' => __('Font Subset', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_block_font',
										'value' => 'vp_get_gwf_subset',
									),
								),
							),
							'default' => 'latin',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_block_font_trans',
							'label' => __('Disable uppercase?', 'rehub_framework'),
							'default' => '0',							
						),												
					),
				),//END Block titles FONT

				array(
					'type' => 'section',
					'title' => __('Slider Headings', 'rehub_framework'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_slider_font',
							'label' => __('Slider Headings Font', 'rehub_framework'),
							'description' => __('Font for slider headings', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_slider_font_style',
							'label' => __('Font Style', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_slider_font',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_slider_font_weight',
							'label' => __('Font Weight', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_slider_font',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type' => 'multiselect',
							'name' => 'rehub_slider_font_subset',
							'label' => __('Font Subset', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_slider_font',
										'value' => 'vp_get_gwf_subset',
									),
								),
							),
							'default' => 'latin',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_slider_font_trans',
							'label' => __('Disable uppercase?', 'rehub_framework'),
							'default' => '0',							
						),													
					),
				),//END Slider FONT

				array(
					'type' => 'section',
					'title' => __('Body Font', 'rehub_framework'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_body_font',
							'label' => __('Body Font Family', 'rehub_framework'),
							'description' => __('Font for body text', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_body_font_style',
							'label' => __('Font Style', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_body_font',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'rehub_body_font_weight',
							'label' => __('Font Weight', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_body_font',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type' => 'multiselect',
							'name' => 'rehub_body_font_subset',
							'label' => __('Font Subset', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'rehub_body_font',
										'value' => 'vp_get_gwf_subset',
									),
								),
							),
							'default' => 'latin',
						),						
					),
				),//END Body FONT


			),
		),
		array(
			'title' => __('Global Enable/Disable', 'rehub_framework'),
			'name' => 'menu_8',
			'icon' => 'font-awesome:fa-globe',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Global options', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'aq_resize',
							'label' => __('Enable resizer script', 'rehub_framework'),
							'description' => __('Use resizer script for thumbnails', 'rehub_framework'),
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'aq_resize_crop',
							'label' => __('Disable crop in resizer script', 'rehub_framework'),
							'default' => '0',
							'dependency' => array(
                            	'field' => 'aq_resize',
                            	'function' => 'vp_dep_boolean',
                            ),
						),						
						array(
							'type' => 'toggle',
							'name' => 'shortcode_enable',
							'label' => __('Enable theme shortcode', 'rehub_framework'),
							'description' => __('Enable built-in shortcode plugin', 'rehub_framework'),
							'default' => '1',
						),						
						array(
							'type' => 'toggle',
							'name' => 'exclude_author_meta',
							'label' => __('Disable author link', 'rehub_framework'),
							'description' => __('Disable author link from meta in string', 'rehub_framework'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'exclude_cat_meta',
							'label' => __('Disable category link', 'rehub_framework'),
							'description' => __('Disable category link from meta in string', 'rehub_framework'),
							'default' => '0',
						),	
						array(
							'type' => 'toggle',
							'name' => 'exclude_date_meta',
							'label' => __('Disable date', 'rehub_framework'),
							'description' => __('Disable date from meta in string', 'rehub_framework'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'exclude_comments_meta',
							'label' => __('Disable comments count', 'rehub_framework'),
							'description' => __('Disable comments count from meta in string', 'rehub_framework'),
							'default' => '0',
						),	
						array(
							'type' => 'toggle',
							'name' => 'font_fallback',
							'label' => __('Font Awesome icons fallback', 'rehub_framework'),
							'description' => __('Load Font Awesome icons from theme. Enable only if CDN of Font Awesome icons falls', 'rehub_framework'),
							'default' => '0',
						),																																												
					),
				),
				array(
					'type' => 'section',
					'title' => __('Global disabling parts on single pages', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_fulltitle',
							'label' => __('Disable full width title?', 'rehub_framework'),
							'description' => __('This option disables big full width title and places it inside content', 'rehub_framework'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_breadcrumbs',
							'label' => __('Disable breadcrumbs', 'rehub_framework'),
							'description' => __('Disable breadcrumbs from pages', 'rehub_framework'),
							'default' => '0',
						),

						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_share',
							'label' => __('Disable share buttons', 'rehub_framework'),
							'description' => __('Disable share buttons after content on pages', 'rehub_framework'),
							'default' => '0',
						),	
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_share_top',
							'label' => __('Disable share buttons', 'rehub_framework'),
							'description' => __('Disable share buttons before content on pages', 'rehub_framework'),
							'default' => '1',
						),											
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_prev',
							'label' => __('Disable previous and next', 'rehub_framework'),
							'description' => __('Disable previous and next post buttons', 'rehub_framework'),
							'default' => '0',
						),											
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_tags',
							'label' => __('Disable tags', 'rehub_framework'),
							'description' => __('Disable tags after content from pages', 'rehub_framework'),
							'default' => '0',
						),
		
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_author',
							'label' => __('Disable author box', 'rehub_framework'),
							'description' => __('Disable author box after content from pages', 'rehub_framework'),
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_relative',
							'label' => __('Disable relative posts', 'rehub_framework'),
							'description' => __('Disable relative posts box after content from pages', 'rehub_framework'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_feature_thumb',
							'label' => __('Disable top thumbnail on single page', 'rehub_framework'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_comments',
							'label' => __('Disable standart comments', 'rehub_framework'),
							'default' => '0',
						),							
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_widget_comments',
							'label' => __('Insert comments widget code', 'rehub_framework'),
							'description' => __('You can set here comments widget, for example, from disqus', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
						),																											

					),
				),
			),
		),
		array(
			'title' => __('Ads Options', 'rehub_framework'),
			'name' => 'menu_9',
			'icon' => 'font-awesome:fa-bullhorn',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Ads code in header and footer', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_ads_top',
							'label' => __('Insert custom ads code', 'rehub_framework'),
							'description' => __('This banner code will be visible in header. Width of this zone depends on style of header (You can choose it in Main Option tab)', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_ads_megatop',
							'label' => __('Insert custom ads code', 'rehub_framework'),
							'description' => __('This banner code will be visible before header.', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_ads_infooter',
							'label' => __('Insert custom ads code', 'rehub_framework'),
							'description' => __('This banner code will be visible before footer', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),																																				
					),
				),
				array(
					'type' => 'section',
					'title' => __('Global code for single page', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_single_after_title',
							'label' => __('Insert custom ads code', 'rehub_framework'),
							'description' => __('This code will be visible after title', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_single_before_post',
							'label' => __('Insert custom ads code', 'rehub_framework'),
							'description' => __('This code will be visible before post content', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						 array(
							'type' => 'notebox',
							'name' => 'rehub_single_before_post_note',
							'label' => __('Tips', 'rehub_framework'),
							'description' => __('You can wrap your code with &lt;div class=&quot;right_code&quot;&gt;your ads code&lt;/div&gt; if you want to add right float or &lt;div class=&quot;left_code&quot;&gt;your ads code&lt;/div&gt; for left float. Please, use square ads with width 250-300px for floated ads.', 'rehub_framework'),
							'status' => 'info',
						),																	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_single_code',
							'label' => __('Insert custom ads code', 'rehub_framework'),
							'description' => __('This code will be visible after post', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_shortcode_ads',
							'label' => __('Insert custom ads code for shortcode', 'rehub_framework'),
							'description' => __('You can insert this code in any place of content by shortcode [wpsm_ads1]', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
						),
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_shortcode_ads_2',
							'label' => __('Insert custom ads code for shortcode', 'rehub_framework'),
							'description' => __('You can insert this code in any place of content by shortcode [wpsm_ads2]', 'rehub_framework'),
							'theme' => 'chrome',
							'mode' => 'html',
						),																							
					),
				),				
				array(
					'type' => 'section',
					'title' => __('AdBlock notify', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_adblock_enable',
							'label' => __('Enable Adblock notify?', 'rehub_framework'),
							'description' => __('If enabled, site visitors can see notice in place of your ads if they have installed ads blocker', 'rehub_framework'),
							'default' => '0',
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_adblock_notice',
							'label' => __('Set notice', 'rehub_framework'),
							'description' => __('Set notice or leave default', 'rehub_framework'),
							'default' => 'You use the AdBlock plugin or similar. <br /> You can add our site to white list, so you will make the contribution to development of this site.',
							'dependency' => array(
                            	'field' => 'rehub_adblock_enable',
                            	'function' => 'vp_dep_boolean',
                            ),
						),																								
					),
				),					
				array(
					'type' => 'section',
					'title' => __('Background settings', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'color',
							'name' => 'rehub_color_background',
							'label' => __('Background Color', 'rehub_framework'),
							'description' => __('Choose the background color', 'rehub_framework'),
							'default' => '#ffffff',
							'format' => 'hex',
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_background_image',
							'label' => __('Background Image', 'rehub_framework'),
							'description' => __('Upload a background image', 'rehub_framework'),
							'default' => '',
						),
						array(
							'type' => 'select',
							'name' => 'rehub_background_repeat',
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
							'default' => array(
								'repeat',
							),
						),
						array(
							'type' => 'select',
							'name' => 'rehub_background_position',
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
							'name' => 'rehub_background_offset',
							'label' => __('Set offset', 'rehub_framework'),
							'description' => __('Set offset from top for background (without px) for avoid header overlap', 'rehub_framework'),
							'validation' => 'numeric',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_background_fixed',
							'label' => __('Fixed Background Image?', 'rehub_framework'),
							'description' => __('The background is fixed with regard to the viewport.', 'rehub_framework'),
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_sized_background',
							'label' => __('Fit size?', 'rehub_framework'),
							'description' => __('Set background image width and height to fit the size of window', 'rehub_framework'),
						),												
						array(
								'type' => 'toggle',
								'name' => 'rehub_content_shadow',
								'label' => __('Disable box shadow under content box?', 'rehub_framework'),
							),
						array(
							'type' => 'textbox',
							'name' => 'rehub_content_margin',
							'label' => __('Set margin', 'rehub_framework'),
							'description' => __('Set margin between menu and content (without px)', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),													
					),
				),							
				array(
					'type' => 'section',
					'title' => __('Global branded pages options', 'rehub_framework'),
					'fields' => array(	
						 array(
							'type' => 'notebox',
							'name' => 'rehub_branded_bg_note',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('Cover background has centered position. Cover background works only if url (field above) is definite. You can find some examples in folder Demo_data/branded. Psd sources for these examples - in file PSD/28-branded-pages.psd', 'rehub_framework'),
							'status' => 'normal',							
							),	
						array(
							'type' => 'textbox',
							'name' => 'rehub_branded_bg_url',
							'label' => __('Url for branded background', 'rehub_framework'),
							'description' => __('Insert url that will be display on background', 'rehub_framework'),
							'default' => '',
							'validation' => 'url',
						),																	
						array(
							'type' => 'upload',
							'name' => 'rehub_branded_background_image',
							'label' => __('Cover Background Image', 'rehub_framework'),
							'description' => __('Upload cover background image', 'rehub_framework'),
							'default' => '',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_branded_bg_fixed',
							'label' => __('Fixed Cover Background Image?', 'rehub_framework'),
							'description' => __('The background is fixed with regard to the viewport.', 'rehub_framework'),
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_branded_bg_margin',
							'label' => __('Set offset', 'rehub_framework'),
							'description' => __('Set offset from top for cover background (without px) for avoid header overlap', 'rehub_framework'),
							'default' => '',
							'validation' => 'numeric',
						),												

					),
				),
				array(
					'type' => 'section',
					'title' => __('Global branded banner', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'rehub_branded_banner_image',
							'label' => __('Branded banner', 'rehub_framework'),
							'description' => __('Upload branded banner image', 'rehub_framework'),
							'default' => '',
						),
						 array(
							'type' => 'notebox',
							'name' => 'rehub_branded_banner_note',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('Branded banner displays after header. Recommended Width of image 1200px. You can find some examples in folder Demo_data/branded. Psd sources for these examples - in file PSD/28-branded-pages.psd', 'rehub_framework'),
							'status' => 'normal',							
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_branded_banner_url',
							'label' => __('Url on branded banner', 'rehub_framework'),
							'description' => __('Insert url for banner', 'rehub_framework'),
							'default' => '',
							'validation' => 'url',
						),												
					),
				),

			),
		),

		array(
			'title' => __('Reviews/Affiliate', 'rehub_framework'),
			'name' => 'menu_10',
			'icon' => 'font-awesome:fa-money',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Reviews, links, rating', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'type_user_review',
							'label' => __('Type of user ratings', 'rehub_framework'),
							'items' => array(
								array(
									'value' => 'simple',
									'label' => __('simple rating, no criterias', 'rehub_framework'),
								),
								array(
									'value' => 'full_review',
									'label' => __('full review with criterias and pros, cons', 'rehub_framework'),
								),	
								array(
									'value' => 'none',
									'label' => __('none', 'rehub_framework'),
								),															
							),
							'default' => 'simple',
						),	
						array(
							'type' => 'select',
							'name' => 'type_total_score',
							'label' => __('How to calculate total score of review', 'rehub_framework'),
							'items' => array(
								array(
								'value' => 'editor',
								'label' => __('based on editor\'s score', 'rehub_framework'),
								),
								array(
								'value' => 'average',
								'label' => __('average (editor\'s and user\'s)', 'rehub_framework'),
								),		
								array(
								'value' => 'user',
								'label' => __('user\'s score (don\'t show editor\'s review)', 'rehub_framework'),
								),														
							),
							'dependency' => array(
								'field'    => 'type_user_review',
								'function' => 'rehub_framework_rev_type',
							),							
							'default' => 'average',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_user_rev_criterias',
							'label' => __('User review criteria names', 'rehub_framework'),
							'description' => __('Type with commas and no spaces. Example: Design,Price,Battery life', 'rehub_framework'),
							'dependency' => array(
								'field'    => 'type_total_score',
								'function' => 'user_rev_type',
							),							
						),																	
						array(
							'type' => 'select',
							'name' => 'allowtorate',
							'label' => __('Allow to rate posts', 'rehub_framework'),
							'description' => __('Who can rate review posts?', 'rehub_framework'),
							'items' => array(
								array(
								'value' => 'guests',
								'label' => __('guests', 'rehub_framework'),
								),
								array(
								'value' => 'users',
								'label' => __('users', 'rehub_framework'),
								),
								array(
								'value' => 'guests_users',
								'label' => __('guests and users', 'rehub_framework'),
								),								
								),
							'default' => 'guests_users',
						),
						array(
							'type' => 'select',
							'name' => 'color_type_review',
							'label' => __('Color type of review box', 'rehub_framework'),
							'items' => array(
								array(
								'value' => 'simple',
								'label' => __('one color', 'rehub_framework'),
								),
								array(
								'value' => 'multicolor',
								'label' => __('multicolor', 'rehub_framework'),
								),								
							),
							'default' => 'simple',
						),						
						array(
							'type' => 'color',
							'name' => 'rehub_review_color',
							'label' => __('Default color for editor\'s review box and total score', 'rehub_framework'),
							'description' => __('Choose the background color or leave blank for default red color', 'rehub_framework'),	
							'format' => 'hex',
							'dependency' => array(
								'field'    => 'color_type_review',
								'function' => 'rehub_framework_rev_color_is_mono',
							),							
						),	
						array(
							'type' => 'color',
							'name' => 'rehub_review_color_user',
							'label' => __('Default color for user review box and user stars', 'rehub_framework'),
							'description' => __('Choose the background color or leave blank for default blue color', 'rehub_framework'),	
							'format' => 'hex',
							'dependency' => array(
								'field'    => 'color_type_review',
								'function' => 'rehub_framework_rev_color_is_mono',
							),							
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_replace_color',
							'label' => __('Replace colors by category color', 'rehub_framework'),
							'description' => __('Do you want to replace default colors of review box with custom color of category?', 'rehub_framework'),							
							'default' => '0',
							'dependency' => array(
								'field'    => 'color_type_review',
								'function' => 'rehub_framework_rev_color_is_mono',
							),							
						),	
						array(
							'type' => 'color',
							'name' => 'rehub_userreview_multicolor',
							'label' => __('Color for stars in comments (default is blue)', 'rehub_framework'),
							'format' => 'hex',
							'dependency' => array(
								'field'    => 'color_type_review',
								'function' => 'rehub_framework_rev_color_is_multi',
							),							
						),																																																		
						array(
							'type' => 'textbox',
							'name' => 'rehub_currency',
							'label' => __('Set symbol of main currency (example, $)', 'rehub_framework'),
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_target_blank',
							'label' => __('Open links in new tab?', 'rehub_framework'),
							'description' => __('Open links in offer boxes in new tab?', 'rehub_framework'),							
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_tracking',
							'label' => __('Add tracking?', 'rehub_framework'),
							'description' => __('Add tracking on offer buttons? It works with google Analytics. Reports is under \"Offer\" category in analytics website', 'rehub_framework'),							
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_rel_nofollow',
							'label' => __('Add nofollow?', 'rehub_framework'),
							'description' => __('Add to all links in offer boxes rel nofollow?', 'rehub_framework'),							
							'default' => '1',
						),																		
						array(
							'type' => 'textbox',
							'name' => 'rehub_btn_text',
							'label' => __('Set text for button', 'rehub_framework'),
							'description' => __('It will be used on button for product reviews, top rating pages instead BUY THIS ITEM', 'rehub_framework'),
							'validation' => 'maxlength[14]',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_mask_text',
							'label' => __('Set text for coupon mask', 'rehub_framework'),
							'description' => __('It will be used on coupon mask instead REVEAL COUPON', 'rehub_framework'),
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_btn_text_aff_links',
							'label' => __('Set text for button', 'rehub_framework'),
							'description' => __('It will be used on button for products with list of links instead CHOOSE OFFER.', 'rehub_framework'),
							'validation' => 'maxlength[14]',
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_review_text',
							'label' => __('Set text for full review link', 'rehub_framework'),
							'description' => __('It will be used top review pages instead READ FULL REVIEW', 'rehub_framework'),
						),												
					),
				),
			),
		),

		array(
			'title' => __('EasyDigitalDownload', 'rehub_framework'),
			'name' => 'menu_11',
			'icon' => 'font-awesome:fa-download',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Options for plugin Easydigitaldownload', 'rehub_framework'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'rehub_framework_edd_layout',
							'label' => __('Select Easydigitaldownload Layout', 'rehub_framework'),
							'description' => __('Select what layout you want to use for archives of easydigitaldownload plugin pages.', 'rehub_framework'),
							'items' => array(							
								array(
									'value' => 'rehub_framework_edd_list',
									'label' => __('List Layout with left thumbnails', 'rehub_framework'),
								),
								array(
									'value' => 'rehub_framework_edd_grid',
									'label' => __('Grid layout with sidebar', 'rehub_framework'),
								),	
								array(
									'value' => 'rehub_framework_edd_gridfull',
									'label' => __('Full width Grid layout', 'rehub_framework'),
								),																									
							),
							'default' => array(
								'rehub_framework_edd_gridfull',
							),
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_framework_edd_rating',
							'label' => __('Enable rating?', 'rehub_framework'),
							'description' => __('Enable built-in user rating system?', 'rehub_framework'),
							'default' => '1',
						),	
						array(
							'type' => 'toggle',
							'name' => 'rehub_framework_edd_counter',
							'label' => __('Enable counter for sales and downloads?', 'rehub_framework'),
							'description' => __('Enable counter in widget download details?', 'rehub_framework'),
							'default' => '1',
						),										
					),
				),
			),
		),



	)
);

/**
 *EOF
 */