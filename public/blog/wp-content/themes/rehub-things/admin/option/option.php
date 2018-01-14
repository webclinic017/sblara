<?php
$imagedir = get_template_directory_uri().'/images/';
return array(
	'title' => __('Theme Options', 'rehub_child'),
	'page' => 'Rehub Theme Options',
	'logo' => '',
	'menus' => array(
		array(
			'title' => __('General Options', 'rehub_child'),
			'name' => 'menu_1',
			'icon' => 'font-awesome:fa-codepen',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('General Options', 'rehub_child'),
					'fields' => array(
					
						array(
							'type' => 'select',
							'name' => 'rehub_framework_archive_layout',
							'label' => __('Select Main Layout', 'rehub_child'),
							'description' => __('Select what kind of post string layout you want to use for blog, archives, search pages and home', 'rehub_child'),
							'items' => array(
								array(
									'value' => 'two_column_full',
									'label' => __('Two column full width', 'rehub_child'),
								),
								array(
									'value' => 'three_column_full',
									'label' => __('Three column full width', 'rehub_child'),
								),								
								array(
									'value' => 'blog_full',
									'label' => __('Blog layout full width', 'rehub_child'),
								),	
								array(
									'value' => 'two_column_with',
									'label' => __('Two column with sidebar', 'rehub_child'),
								),																							
								array(
									'value' => 'blog_with',
									'label' => __('Blog Layout with sidebar', 'rehub_child'),
								),								
								array(
									'value' => 'list_with',
									'label' => __('List Layout with sidebar', 'rehub_child'),
								),																							
							),
							'default' => array(
								'two_column_full',
							),
						),
						array(
							'type' => 'toggle',
							'name' => 'index_feature_post',
							'label' => __('Enable first post of loop as full width', 'rehub_child'),
							'default' => '0',
						),
						
						array(
							'type' => 'codeeditor',
							'name' => 'ads_index_feature',
							'label' => __('Insert custom ads code', 'rehub_child'),
							'description' => __('This ads code will be visible inside featured first post. Size - 300*200px', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
							'dependency' => array(
                            	'field' => 'index_feature_post',
                            	'function' => 'vp_dep_boolean',
                            ),							
						),	

						array(
							'type' => 'select',
							'name' => 'rehub_framework_category_layout',
							'label' => __('Select Category Layout', 'rehub_child'),
							'description' => __('Select what kind of post string layout you want to use for categories', 'rehub_child'),
							'items' => array(
								array(
									'value' => 'two_column_full',
									'label' => __('Two column full width', 'rehub_child'),
								),
								array(
									'value' => 'three_column_full',
									'label' => __('Three column full width', 'rehub_child'),
								),								
								array(
									'value' => 'blog_full',
									'label' => __('Blog layout full width', 'rehub_child'),
								),	
								array(
									'value' => 'two_column_with',
									'label' => __('Two column with sidebar', 'rehub_child'),
								),																							
								array(
									'value' => 'blog_with',
									'label' => __('Blog Layout with sidebar', 'rehub_child'),
								),								
								array(
									'value' => 'list_with',
									'label' => __('List Layout with sidebar', 'rehub_child'),
								),																							
							),
							'default' => array(
								'two_column_full',
							),
						),	

						array(
							'type' => 'select',
							'name' => 'index_pagination',
							'label' => __('Select pagination type', 'rehub_child'),
							'items' => array(
								array(
									'value' => '1',
									'label' => __('Simple Pagination', 'rehub_child'),
								),								
								array(
									'value' => '2',
									'label' => __('Next page button', 'rehub_child'),
								),
								array(
									'value' => '3',
									'label' => __('Infinite scroll', 'rehub_child'),
								),																									
							),
							'default' => array(
								'1',
							),
						),
											
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_custom_css',
							'label' => __('Custom CSS', 'rehub_child'),
							'description' => __('Write your custom CSS here', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'css',
						),						
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_analytics',
							'label' => __('Analytics Code/js code', 'rehub_child'),
							'description' => __('Enter your Analytics code or any html, js code', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
						),
																			
					),
				),
			),
		),
		array(
			'title' => __('Logo & favicon', 'rehub_child'),
			'name' => 'menu_12',
			'icon' => 'font-awesome:fa-gear',
			'controls' => array(

				array(
					'type' => 'section',
					'title' => __('Logo settings', 'rehub_child'),
					'fields' => array(						
						array(
							'type' => 'upload',
							'name' => 'rehub_logo',
							'label' => __('Upload Logo', 'rehub_child'),
							'description' => __('Upload your logo. Max width is 463px. (1200px for full width)', 'rehub_child'),
							'default' => '',
						),
						 array(
							'type' => 'slider',
							'name' => 'rehub_logo_margin',
							'label' => __('Margin logo from top', 'rehub_child'),
							'description' => __('Set space between logo and top area in pixels', 'rehub_child'),
							'min' => '0',
							'max' => '100',
							'step' => '5',
							'default' => '5',
						),						
						array(
							'type' => 'upload',
							'name' => 'rehub_logo_retina',
							'label' => __('Upload Logo (retina version)', 'rehub_child'),
							'description' => __('Upload retina version of the logo. It should be 2x the size of main logo.', 'rehub_child'),
							'default' => '',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_logo_retina_width',
							'label' => __('Retina logo width', 'rehub_child'),
							'description' => __('If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.', 'rehub_child'),
						),	
						array(
							'type' => 'textbox',
							'name' => 'rehub_logo_retina_height',
							'label' => __('Retina logo height', 'rehub_child'),							
							'description' => __('If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.', 'rehub_child'),
						),																	
						array(
							'type' => 'textbox',
							'name' => 'rehub_text_logo',
							'label' => __('Text logo', 'rehub_child'),							
							'description' => __('You can type text logo. Use this field only if no image logo', 'rehub_child'),
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_text_slogan',
							'label' => __('Slogan', 'rehub_child'),							
							'description' => __('You can type slogan below text logo. Use this field only if no image logo', 'rehub_child'),
						),							
					),
				),

				array(
					'type' => 'section',
					'title' => __('Favicons', 'rehub_child'),
					'fields' => array(
						//Favicon 144
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_144',
							'label' => __('144px Favicon', 'rehub_child'),
							'description' => __('Upload your favicon for third-generation iPad with high-resolution Retina display (144x144 px)', 'rehub_child'),
							'default' => $imagedir . 'default/apple-touch-icon-144x144-precomposed.png',
						),
						//Favicon 114
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_114',
							'label' => __('114px Favicon', 'rehub_child'),
							'description' => __('Upload your favicon for iPhone with high-resolution Retina display (114x114 px)', 'rehub_child'),
							'default' => $imagedir . 'default/apple-touch-icon-114x114-precomposed.png',
						),
						//Favicon 72
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_72',
							'label' => __('72px Favicon', 'rehub_child'),
							'description' => __('Upload your favicon For first- and second-generation iPad (72x72 px)', 'rehub_child'),
							'default' => $imagedir . 'default/apple-touch-icon-72x72-precomposed.png',
						),
						//Favicon 57
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon_57',
							'label' => __('57px Favicon', 'rehub_child'),
							'description' => __('Upload your favicon For non-Retina iPhone, iPod Touch, and Android 2.1+ devices (57x57 px)', 'rehub_child'),
							'default' => $imagedir . 'default/apple-touch-icon-precomposed.png',
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_favicon',
							'label' => __('Default Favicon', 'rehub_child'),
							'description' => __('Upload your favicon For Default Browser', 'rehub_child'),
							'default' => $imagedir . 'default/favicon.png',
						),							
					),
				),
			),
		),
		array(
			'title' => __('Header and Menu', 'rehub_child'),
			'name' => 'menu_2',
			'icon' => 'font-awesome:fa-wrench ',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Header Options', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'rehub_header_style',
							'label' => __('Select Header style', 'rehub_child'),
							'items' => array(
								array(
									'value' => 'header_first',
									'label' => __('Logo + banner 468X60 + search box', 'rehub_child'),
								),
								array(
									'value' => 'header_second',
									'label' => __('Logo + banner 728X90', 'rehub_child'),
								),
								array(
									'value' => 'header_third',
									'label' => __('Full width logo', 'rehub_child'),
								),
								array(
									'value' => 'header_fourth',
									'label' => __('Full width logo + full width banner', 'rehub_child'),
								),
								array(
									'value' => 'header_five',
									'label' => __('Logo + menu', 'rehub_child'),
								),																
							),
								'default' => array(
								'header_fourth',
							),
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_body_block',
							'label' => __('Enable block width of header', 'rehub_child'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_sticky_nav',
							'label' => __('Sticky Navigation Bar', 'rehub_child'),
							'description' => __('Enable/Disable Sticky navigation bar.', 'rehub_child'),
							'default' => '0',
						),
	
						array(
							'type' => 'toggle',
							'name' => 'rehub_header_social',
							'label' => __('Enable Header Social Icons', 'rehub_child'),
							'description' => __('You can set your social media URLs in the Social Media Options tab.', 'rehub_child'),
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'exclude_cart_header',
							'label' => __('Disable cart in header', 'rehub_child'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_header_top',
							'label' => __('Disable top block', 'rehub_child'),
							'description' => __('You can disable top block with links, cart, social icons in header', 'rehub_child'),
							'default' => '0',
						),						
						array(
							'type' => 'select',
							'name' => 'rehub_headercolor_style',
							'label' => __('Choose color style of header', 'rehub_child'),
							'description' => __('Choose one of predefinite style of header or set custom', 'rehub_child'),							
							'items' => array(
								array(
									'value' => '0',
									'label' => __('White', 'rehub_child'),
								),
								array(
									'value' => '1',
									'label' => __('Dark', 'rehub_child'),
								),
								array(
									'value' => '2',
									'label' => __('Custom', 'rehub_child'),
								),
							),
							'default' => array(
								'1',
							),
						),
																						
					),
				),							
				array(
					'type' => 'section',
					'title' => __('Custom Header Options', 'rehub_child'),
					'fields' => array(
						 array(
							'type' => 'notebox',
							'name' => 'rehub_header_note',
							'label' => __('Note!', 'rehub_child'),
							'description' => __('Custom colors will work only if you choose custom style of header in select box above', 'rehub_child'),
							'status' => 'info',
						),						
						array(
							'type' => 'color',
							'name' => 'rehub_header_color_background',
							'label' => __('Background Color', 'rehub_child'),
							'description' => __('Choose the background color or leave blank for default', 'rehub_child'),
							'format' => 'hex',	
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_header_background_image',
							'label' => __('Background Image', 'rehub_child'),
							'description' => __('Upload a background image or leave blank', 'rehub_child'),
							'default' => '',
							
						),
						array(
							'type' => 'select',
							'name' => 'rehub_header_background_repeat',
							'label' => __('Background Repeat', 'rehub_child'),
							'items' => array(
								array(
									'value' => 'repeat',
									'label' => __('Repeat', 'rehub_child'),
								),
								array(
									'value' => 'no-repeat',
									'label' => __('No Repeat', 'rehub_child'),
								),
								array(
									'value' => 'repeat-x',
									'label' => __('Repeat X', 'rehub_child'),
								),
								array(
									'value' => 'repeat-y',
									'label' => __('Repeat Y', 'rehub_child'),
								),
							),
							
						),
						array(
							'type' => 'select',
							'name' => 'rehub_header_background_position',
							'label' => __('Background Position', 'rehub_child'),
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
							'label' => __('Set offset', 'rehub_child'),
							'description' => __('Set offset from top for background (without px) for avoid overlap', 'rehub_child'),
							'validation' => 'numeric',
							
						),						
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_nav',
							'label' => __('Custom color of menu background', 'rehub_child'),
							'description' => __('Or leave blank for default color', 'rehub_child'),
							'format' => 'hex',
							
						),	
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_nav_font',
							'label' => __('Custom color of menu font', 'rehub_child'),
							'description' => __('Or leave blank for default color', 'rehub_child'),
							'format' => 'hex',
							
						),
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_top',
							'label' => __('Custom color for top line of header', 'rehub_child'),
							'description' => __('Or leave blank for default white color', 'rehub_child'),
							'format' => 'hex',
							
						),	
						 array(
							'type' => 'color',
							'name' => 'rehub_custom_color_top_font',
							'label' => __('Custom color of menu font for top line of header', 'rehub_child'),
							'description' => __('Or leave blank for default color', 'rehub_child'),
							'format' => 'hex',
							
						),		
					),
				),							
			),
		),
		array(
			'title' => __('Footer Options', 'rehub_child'),
			'name' => 'menu_3',
			'icon' => 'font-awesome:fa-caret-square-o-down',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Footer options', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_footer_widgets',
							'label' => __('Footer Widgets', 'rehub_child'),
							'description' => __('Enable or Disable the footer widget area', 'rehub_child'),
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_footer_block',
							'label' => __('Enable footer block width?', 'rehub_child'),
							'default' => '0',
						),						
					
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_footer_text',
							'label' => __('Footer Bottom Text', 'rehub_child'),
							'description' => __('Enter your copyright text or whatever you want right here.', 'rehub_child'),
							'default' => '&copy; 2014 Sizam Design. All rights reserved.',
							'theme' => 'chrome',
							'mode' => 'html',
						),
						array(
							'type' => 'upload',
							'name' => 'rehub_footer_logo',
							'label' => __('Upload Logo for footer', 'rehub_child'),
							'description' => __('Upload your logo for footer.', 'rehub_child'),
							'default' => '',
						),						
					),
				),
			),
		),
		array(
			'title' => __('Social Media Options', 'rehub_child'),
			'name' => 'menu_5',
			'icon' => 'font-awesome:fa-twitter',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Social Media Pages', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'textbox',
							'name' => 'rehub_facebook',
							'label' => __('Facebook link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_twitter',
							'label' => __('Twitter link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_google',
							'label' => __('Google plus link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_instagram',
							'label' => __('Instagram link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_tumblr',
							'label' => __('Tumblr link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_youtube',
							'label' => __('Youtube link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_vimeo',
							'label' => __('Vimeo link', 'rehub_child'),
							'validation' => 'url',
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_pinterest',
							'label' => __('Pinterest link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_linkedin',
							'label' => __('Linkedin link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_soundcloud',
							'label' => __('Soundcloud link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_dribbble',
							'label' => __('Dribbble link', 'rehub_child'),
							'validation' => 'url',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_vk',
							'label' => __('Vk.com link', 'rehub_child'),
							'validation' => 'url',
						),

						array(
							'type' => 'textbox',
							'name' => 'rehub_rss',
							'label' => __('Rss link', 'rehub_child'),
							'validation' => 'url',
						),												
					),
				),
			),
		),
		array(
			'title' => __('Appearance/Color', 'rehub_child'),
			'name' => 'menu_6',
			'icon' => 'font-awesome:fa-pencil-square-o',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Color schema of website', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'rehub_color_schema',
							'label' => __('Choose color schema', 'rehub_child'),
							'items' => array(
								array(
									'value' => 'default',
									'label' => __('Default - brown', 'rehub_child'),
								),
								array(
									'value' => 'blue',
									'label' => __('Blue', 'rehub_child'),
								),
								array(
									'value' => 'green',
									'label' => __('Green', 'rehub_child'),
								),
								array(
									'value' => 'violet',
									'label' => __('Violet', 'rehub_child'),
								),
								array(
									'value' => 'yellow',
									'label' => __('Yellow', 'rehub_child'),
								),								
							),
							'default' => array(
								'default',
							),
						),
						array(
							'type' => 'color',
							'name' => 'rehub_custom_color',
							'label' => __('Custom color', 'rehub_child'),
							'description' => __('Or you can set any main color (it will be used under white text)', 'rehub_child'),
							'format' => 'hex',
						),
						array(
							'type' => 'color',
							'name' => 'rehub_btnoffer_color',
							'label' => __('Default offer buttons color', 'rehub_child'),
							'format' => 'hex',						
						),
						array(
							'type' => 'color',
							'name' => 'rehub_btnoffer_color_hover',
							'label' => __('Default hover offer buttons color', 'rehub_child'),
							'format' => 'hex',						
						),
						array(
							'type' => 'color',
							'name' => 'rehub_btnofferinside_color',
							'label' => __('Secondary offer buttons color (inside posts)', 'rehub_child'),
							'format' => 'hex',						
						),																								
						array(
							'type' => 'color',
							'name' => 'rehub_bg_flat_color',
							'label' => __('Create flat color for background', 'rehub_child'),
							'description' => __('Disable default grey color of background and set your own', 'rehub_child'),
							'format' => 'hex',
						),
						array(
							'type' => 'color',
							'name' => 'rehub_color_link',
							'label' => __('Custom color for links inside posts', 'rehub_child'),
							'format' => 'hex',	
						),												

					),
				),

				array(
					'type' => 'toggle',
					'name' => 'rehub_ecwid_enable',
					'label' => __('Enable ecwid store customization?', 'rehub_child'),
					'default' => '0',
				),
				array(
					'type' => 'toggle',
					'name' => 'rehub_pattern_disable',
					'label' => __('Disable dotted overlay on thumbnails?', 'rehub_child'),
					'default' => '0',
				),											

			),
		),
		array(
			'title' => __('Fonts Options', 'rehub_child'),
			'name' => 'menu_7',
			'icon' => 'font-awesome:fa-font',
			'controls' => array(

				array(
					'type' => 'section',
					'title' => __('Navigation Font', 'rehub_child'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_nav_font',
							'label' => __('Navigation Font Family', 'rehub_child'),
							'description' => __('Font for navigation', 'rehub_child'),
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
							'label' => __('Font Style', 'rehub_child'),
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
							'label' => __('Font Weight', 'rehub_child'),
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
							'label' => __('Font Subset', 'rehub_child'),
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
							'label' => __('Disable uppercase?', 'rehub_child'),
							'default' => '0',							
						),												
					),
				),//END NAV FONT

				array(
					'type' => 'section',
					'title' => __('Titles Font', 'rehub_child'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_headings_font',
							'label' => __('Headings Font Family', 'rehub_child'),
							'description' => __('Font for headings in text, sidebar, footer, buttons', 'rehub_child'),
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
							'label' => __('Font Style', 'rehub_child'),
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
							'label' => __('Font Weight', 'rehub_child'),
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
							'label' => __('Font Subset', 'rehub_child'),
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
							'label' => __('Disable uppercase?', 'rehub_child'),
							'default' => '0',							
						),												
					),
				),//END Headings FONT

				array(
					'type' => 'section',
					'title' => __('Block Titles', 'rehub_child'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_block_font',
							'label' => __('Block Titles Font', 'rehub_child'),
							'description' => __('Font for titles of content blocks and pages', 'rehub_child'),
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
							'label' => __('Font Style', 'rehub_child'),
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
							'label' => __('Font Weight', 'rehub_child'),
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
							'label' => __('Font Subset', 'rehub_child'),
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
							'label' => __('Disable uppercase?', 'rehub_child'),
							'default' => '0',							
						),												
					),
				),//END Block titles FONT

				array(
					'type' => 'section',
					'title' => __('Slider Headings', 'rehub_child'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_slider_font',
							'label' => __('Slider Headings Font', 'rehub_child'),
							'description' => __('Font for slider headings', 'rehub_child'),
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
							'label' => __('Font Style', 'rehub_child'),
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
							'label' => __('Font Weight', 'rehub_child'),
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
							'label' => __('Font Subset', 'rehub_child'),
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
							'label' => __('Disable uppercase?', 'rehub_child'),
							'default' => '0',							
						),													
					),
				),//END Slider FONT

				array(
					'type' => 'section',
					'title' => __('Body Font', 'rehub_child'),
					'fields' => array(						
						array(
							'type' => 'select',
							'name' => 'rehub_body_font',
							'label' => __('Body Font Family', 'rehub_child'),
							'description' => __('Font for body text', 'rehub_child'),
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
							'label' => __('Font Style', 'rehub_child'),
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
							'label' => __('Font Weight', 'rehub_child'),
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
							'label' => __('Font Subset', 'rehub_child'),
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
			'title' => __('Global Enable/Disable', 'rehub_child'),
			'name' => 'menu_8',
			'icon' => 'font-awesome:fa-globe',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Global options', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'aq_resize',
							'label' => __('Enable resizer script', 'rehub_child'),
							'description' => __('Use resizer script for thumbnails', 'rehub_child'),
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'aq_resize_crop',
							'label' => __('Disable crop in resizer script', 'rehub_child'),
							'default' => '0',
							'dependency' => array(
                            	'field' => 'aq_resize',
                            	'function' => 'vp_dep_boolean',
                            ),
						),						
						array(
							'type' => 'toggle',
							'name' => 'shortcode_enable',
							'label' => __('Enable theme shortcode', 'rehub_child'),
							'description' => __('Enable built-in shortcode plugin', 'rehub_child'),
							'default' => '1',
						),						
						array(
							'type' => 'toggle',
							'name' => 'exclude_author_meta',
							'label' => __('Disable author link', 'rehub_child'),
							'description' => __('Disable author link from meta in string', 'rehub_child'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'exclude_cat_meta',
							'label' => __('Disable category link', 'rehub_child'),
							'description' => __('Disable category link from meta in string', 'rehub_child'),
							'default' => '0',
						),	
						array(
							'type' => 'toggle',
							'name' => 'exclude_date_meta',
							'label' => __('Disable date', 'rehub_child'),
							'description' => __('Disable date from meta in string', 'rehub_child'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'exclude_comments_meta',
							'label' => __('Disable comments count', 'rehub_child'),
							'description' => __('Disable comments count from meta in string', 'rehub_child'),
							'default' => '0',
						),	
						array(
							'type' => 'toggle',
							'name' => 'exclude_post_like',
							'label' => __('Disable post like', 'rehub_child'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'font_fallback',
							'label' => __('Font Awesome icons fallback', 'rehub_child'),
							'description' => __('Load Font Awesome icons from theme. Enable only if CDN of Font Awesome icons falls', 'rehub_child'),
							'default' => '0',
						),																																												
					),
				),
				array(
					'type' => 'section',
					'title' => __('Global disabling parts on single pages', 'rehub_child'),
					'fields' => array(						


						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_share',
							'label' => __('Disable share buttons', 'rehub_child'),
							'description' => __('Disable share buttons after content on pages', 'rehub_child'),
							'default' => '0',
						),	
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_share_top',
							'label' => __('Disable share buttons', 'rehub_child'),
							'description' => __('Disable share buttons before content on pages', 'rehub_child'),
							'default' => '1',
						),																						
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_tags',
							'label' => __('Disable tags', 'rehub_child'),
							'description' => __('Disable tags after content from pages', 'rehub_child'),
							'default' => '0',
						),
		
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_author',
							'label' => __('Disable author link', 'rehub_child'),
							'description' => __('Disable author name', 'rehub_child'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_relative',
							'label' => __('Disable relative posts', 'rehub_child'),
							'description' => __('Disable relative posts box after content from pages', 'rehub_child'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_feature_thumb',
							'label' => __('Disable top thumbnail on single page', 'rehub_child'),
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_disable_comments',
							'label' => __('Disable standart comments', 'rehub_child'),
							'default' => '0',
						),							
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_widget_comments',
							'label' => __('Insert comments widget code', 'rehub_child'),
							'description' => __('You can set here comments widget, for example, from disqus', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
						),																											

					),
				),
			),
		),
		array(
			'title' => __('Ads Options', 'rehub_child'),
			'name' => 'menu_9',
			'icon' => 'font-awesome:fa-bullhorn',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Ads code in header and footer', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_ads_top',
							'label' => __('Insert custom ads code', 'rehub_child'),
							'description' => __('This banner code will be visible in header. Width of this zone depends on style of header (You can choose it in Main Option tab)', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_ads_megatop',
							'label' => __('Insert custom ads code', 'rehub_child'),
							'description' => __('This banner code will be visible before header.', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_ads_infooter',
							'label' => __('Insert custom ads code', 'rehub_child'),
							'description' => __('This banner code will be visible before footer', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),																																				
					),
				),
				array(
					'type' => 'section',
					'title' => __('Global code for single page', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_single_after_title',
							'label' => __('Insert custom ads code', 'rehub_child'),
							'description' => __('This code will be visible after title', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_single_before_post',
							'label' => __('Insert custom ads code', 'rehub_child'),
							'description' => __('This code will be visible before post content', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						 array(
							'type' => 'notebox',
							'name' => 'rehub_single_before_post_note',
							'label' => __('Tips', 'rehub_child'),
							'description' => __('You can wrap your code with &lt;div class=&quot;right_code&quot;&gt;your ads code&lt;/div&gt; if you want to add right float or &lt;div class=&quot;left_code&quot;&gt;your ads code&lt;/div&gt; for left float. Please, use square ads with width 250-300px for floated ads.', 'rehub_child'),
							'status' => 'info',
						),																	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_single_code',
							'label' => __('Insert custom ads code', 'rehub_child'),
							'description' => __('This code will be visible after post', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
							'default' => '',
						),	
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_shortcode_ads',
							'label' => __('Insert custom ads code for shortcode', 'rehub_child'),
							'description' => __('You can insert this code in any place of content by shortcode [wpsm_ads1]', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
						),
						array(
							'type' => 'codeeditor',
							'name' => 'rehub_shortcode_ads_2',
							'label' => __('Insert custom ads code for shortcode', 'rehub_child'),
							'description' => __('You can insert this code in any place of content by shortcode [wpsm_ads2]', 'rehub_child'),
							'theme' => 'chrome',
							'mode' => 'html',
						),																							
					),
				),				
				array(
					'type' => 'section',
					'title' => __('AdBlock notify', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'rehub_adblock_enable',
							'label' => __('Enable Adblock notify?', 'rehub_child'),
							'description' => __('If enabled, site visitors can see notice in place of your ads if they have installed ads blocker', 'rehub_child'),
							'default' => '0',
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_adblock_notice',
							'label' => __('Set notice', 'rehub_child'),
							'description' => __('Set notice or leave default', 'rehub_child'),
							'default' => 'You use the AdBlock plugin or similar. <br /> You can add our site to white list, so you will make the contribution to development of this site.',
							'dependency' => array(
                            	'field' => 'rehub_adblock_enable',
                            	'function' => 'vp_dep_boolean',
                            ),
						),																								
					),
				),												
			),
		),

		array(
			'title' => __('Reviews/Affiliate', 'rehub_child'),
			'name' => 'menu_10',
			'icon' => 'font-awesome:fa-money',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Reviews, links, rating', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'type_user_review',
							'label' => __('Type of user ratings', 'rehub_child'),
							'items' => array(
								array(
									'value' => 'simple',
									'label' => __('simple rating, no criterias', 'rehub_child'),
								),
								array(
									'value' => 'full_review',
									'label' => __('full review with criterias and pros, cons', 'rehub_child'),
								),	
								array(
									'value' => 'none',
									'label' => __('none', 'rehub_child'),
								),															
							),
							'default' => 'simple',
						),	
						array(
							'type' => 'select',
							'name' => 'type_total_score',
							'label' => __('How to calculate and show total score of review', 'rehub_child'),
							'items' => array(
								array(
								'value' => 'editor',
								'label' => __('based on editor\'s score', 'rehub_child'),
								),
								array(
								'value' => 'average',
								'label' => __('average (editor\'s and user\'s)', 'rehub_child'),
								),	
								array(
								'value' => 'user',
								'label' => __('user\'s score (don\'t show editor\'s review)', 'rehub_child'),
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
							'label' => __('User review criteria names', 'rehub_child'),
							'description' => __('Type with commas and no spaces. Example: Design,Price,Battery life', 'rehub_child'),
							'dependency' => array(
								'field'    => 'type_total_score',
								'function' => 'user_rev_type',
							),							
						),																	
						array(
							'type' => 'select',
							'name' => 'allowtorate',
							'label' => __('Allow to rate posts', 'rehub_child'),
							'description' => __('Who can rate review posts?', 'rehub_child'),
							'items' => array(
								array(
								'value' => 'guests',
								'label' => __('guests', 'rehub_child'),
								),
								array(
								'value' => 'users',
								'label' => __('users', 'rehub_child'),
								),
								array(
								'value' => 'guests_users',
								'label' => __('guests and users', 'rehub_child'),
								),								
								),
							'default' => 'guests_users',
						),						
						array(
							'type' => 'color',
							'name' => 'rehub_review_color',
							'label' => __('Default color for review box and total score', 'rehub_child'),
							'description' => __('Choose the background color or leave blank for default red color', 'rehub_child'),	
							'format' => 'hex',						
						),																																																		
						array(
							'type' => 'textbox',
							'name' => 'rehub_currency',
							'label' => __('Set symbol of main currency (example, $)', 'rehub_child'),
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_target_blank',
							'label' => __('Open links in new tab?', 'rehub_child'),
							'description' => __('Open links in offer boxes in new tab?', 'rehub_child'),							
							'default' => '1',
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_tracking',
							'label' => __('Add tracking?', 'rehub_child'),
							'description' => __('Add tracking on offer buttons? It works with google Analytics. Reports is under \"Offer\" category in analytics website', 'rehub_child'),							
							'default' => '0',
						),						
						array(
							'type' => 'toggle',
							'name' => 'rehub_rel_nofollow',
							'label' => __('Add nofollow?', 'rehub_child'),
							'description' => __('Add to all links in offer boxes rel nofollow?', 'rehub_child'),							
							'default' => '1',
						),																		
						array(
							'type' => 'textbox',
							'name' => 'rehub_btn_text',
							'label' => __('Set text for button', 'rehub_child'),
							'description' => __('It will be used on button for product reviews, top rating pages instead BUY THIS ITEM', 'rehub_child'),
							'validation' => 'maxlength[14]',
						),
						array(
							'type' => 'textbox',
							'name' => 'rehub_mask_text',
							'label' => __('Set text for coupon mask', 'rehub_child'),
							'description' => __('It will be used on coupon mask instead REVEAL COUPON', 'rehub_child'),
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_btn_text_aff_links',
							'label' => __('Set text for button', 'rehub_child'),
							'description' => __('It will be used on button for products with list of links instead CHOOSE OFFER.', 'rehub_child'),
							'validation' => 'maxlength[14]',
						),						
						array(
							'type' => 'textbox',
							'name' => 'rehub_review_text',
							'label' => __('Set text for full review link', 'rehub_child'),
							'description' => __('It will be used top review pages instead READ FULL REVIEW', 'rehub_child'),
						),												
					),
				),
			),
		),

		array(
			'title' => __('EasyDigitalDownload', 'rehub_child'),
			'name' => 'menu_11',
			'icon' => 'font-awesome:fa-download',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Options for plugin Easydigitaldownload', 'rehub_child'),
					'fields' => array(
						array(
							'type' => 'select',
							'name' => 'rehub_framework_edd_layout',
							'label' => __('Select Easydigitaldownload Layout', 'rehub_child'),
							'description' => __('Select what layout you want to use for archives of easydigitaldownload plugin pages.', 'rehub_child'),
							'items' => array(							
								array(
									'value' => 'rehub_framework_edd_list',
									'label' => __('List Layout with left thumbnails', 'rehub_child'),
								),
								array(
									'value' => 'rehub_framework_edd_grid',
									'label' => __('Grid layout with sidebar', 'rehub_child'),
								),	
								array(
									'value' => 'rehub_framework_edd_gridfull',
									'label' => __('Full width Grid layout', 'rehub_child'),
								),																									
							),
							'default' => array(
								'rehub_framework_edd_gridfull',
							),
						),
						array(
							'type' => 'toggle',
							'name' => 'rehub_framework_edd_rating',
							'label' => __('Enable rating?', 'rehub_child'),
							'description' => __('Enable built-in user rating system?', 'rehub_child'),
							'default' => '1',
						),	
						array(
							'type' => 'toggle',
							'name' => 'rehub_framework_edd_counter',
							'label' => __('Enable counter for sales and downloads?', 'rehub_child'),
							'description' => __('Enable counter in widget download details?', 'rehub_child'),
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