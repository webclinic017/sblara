<?php

return array(
	'id'          => 'rehub_post',
	'types'       => array('post'),
	'title'       => __('Post Type', 'rehub_framework'),
	'priority'    => 'high',
	'mode'        => WPALCHEMY_MODE_EXTRACT,
	'template'    => array(
		array(
			'type' => 'radioimage',
			'name' => 'rehub_framework_post_type',
			'label' => __('Choose Type of Post', 'rehub_framework'),
			'description' => '',
			'items' => array(
				array(
					'value' => 'regular',
					'label' => __('Regular', 'rehub_framework'),
					'img' => REHUB_ADMIN_URI . '/public/img/regular_post_icon.png',
				),
				array(
					'value' => 'video',
					'label' => __('Video', 'rehub_framework'),
					'img' => REHUB_ADMIN_URI . '/public/img/video_post_icon.png',
				),
				array(
					'value' => 'gallery',
					'label' => __('Gallery', 'rehub_framework'),
					'img' => REHUB_ADMIN_URI . '/public/img/gallery_post_icon.png',
				),
				array(
					'value' => 'review',
					'label' => __('Review', 'rehub_framework'),
					'img' => REHUB_ADMIN_URI . '/public/img/review_post_icon.png',
				),
				array(
					'value' => 'music',
					'label' => __('Music', 'rehub_framework'),
					'img' => REHUB_ADMIN_URI . '/public/img/music_post_icon.png',
				),
			),
			'default' => 'regular'
		),
		
		
		// video group
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'video_post',
			'title'     => __('Video Post', 'rehub_framework'),
			'dependency' => array(
				'field'    => 'rehub_framework_post_type',
				'function' => 'rehub_framework_post_type_is_video',
			),
			'fields'    => array(
				// embed
				array(
					'type' => 'textbox',
					'name' => 'video_post_embed_url',
					'description' => __('Insert youtube or vimeo link on page with video', 'rehub_framework'),
					'label' => __('Video Url', 'rehub_framework'),
				),				

				array(
					'type' => 'toggle',
					'name' => 'video_post_schema',
					'label' => __('Enable schema.org for video?', 'rehub_framework'),
					'description' => __('Check this box if you want to enable videoobject schema', 'rehub_framework'),
				),	
				array(
					'type' => 'textbox',
					'name' => 'video_post_schema_title',
					'label' => __('Title', 'rehub_framework'),
					'description' => __('Set title of video block or leave blank to use post title', 'rehub_framework'),					
					'dependency' => array(
                         'field' => 'video_post_schema',
                         'function' => 'vp_dep_boolean',
                    ),
					'default' => '',
				),
				array(
					'type' => 'textbox',
					'name' => 'video_post_schema_desc',
					'label' => __('Description', 'rehub_framework'),
					'description' => __('Set description of video block or leave blank to use post excerpt', 'rehub_framework'),					
					'dependency' => array(
                         'field' => 'video_post_schema',
                         'function' => 'vp_dep_boolean',
                    ),
					'default' => '',
				),
				array(
					'type' => 'toggle',
					'name' => 'video_post_schema_thumb',
					'label' => __('Auto thumbnail', 'rehub_framework'),
					'description' => __('Enable auto thumbnails or use post thumbnail. Note, that this thumbnail is not visible in post but can be use in seo snippet', 'rehub_framework'),
					'dependency' => array(
                         'field' => 'video_post_schema',
                         'function' => 'vp_dep_boolean',
                    ),					
				),																			
			),
		),
		// gallery group
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'gallery_post',
			'title'     => __('Gallery Post', 'rehub_framework'),
			'dependency' => array(
				'field'    => 'rehub_framework_post_type',
				'function' => 'rehub_framework_post_type_is_gallery',
			),
			
			'fields'    => array(
				array(
					'type' => 'toggle',
					'name' => 'gallery_post_images_resize',
					'label' => __('Disable height resize for slider', 'rehub_framework'),
					'description' => __('This option disable resize of photo. By default, photos are resized for 400 px height', 'rehub_framework'),												
				),				
				array(
					'type'      => 'group',
					'repeating' => true,
					'name'      => 'gallery_post_images',
					'title'     => __('Image', 'rehub_framework'),
					'fields'    => array(
						array(
							'type'      => 'upload',
							'name'      => 'gallery_post_image',
							'label'     => __('Add Image', 'rehub_framework'),
						),
						array(
							'type'      => 'textbox',
							'name'      => 'gallery_post_image_caption',
							'label'     => __('Caption', 'rehub_framework'),
						),
						array(
							'type' => 'textbox',
							'name' => 'gallery_post_video',
							'description' => __('Insert youtube link of page with video. If you set this field, image and caption will be ignored for this slide', 'rehub_framework'),
							'label' => __('Video Url', 'rehub_framework'),
						),													
					),
				),
			),
		),
		// review group
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'review_post',
			'title'     => 'Review Post',
			'dependency' => array(
				'field'    => 'rehub_framework_post_type',
				'function' => 'rehub_framework_post_type_is_review',
			),
			'fields'    => array(
				array(
					'type' => 'toggle',
					'name' => 'rehub_review_slider',
					'label' => __('Add slider of images to top of review page?', 'rehub_framework'),
					'default' => '0',
				),
				array(
					'type' => 'toggle',
					'name' => 'rehub_review_slider_resize',
					'label' => __('Disable height resize for slider', 'rehub_framework'),
					'description' => __('This option disable resize of photo. By default, photos are resized for 400 px height', 'rehub_framework'),
					'dependency' => array(
                         'field' => 'rehub_review_slider',
                         'function' => 'vp_dep_boolean',
                    ),										
				),				
				array(
					'type'      => 'group',
					'repeating' => true,
					'name'      => 'rehub_review_slider_images',
					'title'     => __('Images', 'rehub_framework'),
					'fields'    => array(
						array(
							'type'      => 'upload',
							'name'      => 'review_post_image',
							'label'     => __('Add Image', 'rehub_framework'),
						),
						array(
							'type'      => 'textbox',
							'name'      => 'review_post_image_caption',
							'label'     => __('Caption', 'rehub_framework'),
						),	
						array(
							'type' => 'textbox',
							'name' => 'review_post_video',
							'description' => __('Insert youtube link of page with video. If you set this field, image and caption will be ignored for this slide', 'rehub_framework'),
							'label' => __('Video Url', 'rehub_framework'),
						),											
					),
					'dependency' => array(
                         'field' => 'rehub_review_slider',
                         'function' => 'vp_dep_boolean',
                    ),					
				),


				 array(
					'type' => 'select',
					'name' => 'review_post_schema_type',
					'label' => __('Type of review', 'rehub_framework'),
					'items' => array(
						array(
						'value' => 'review_post_review_simple',
						'label' => __('Simple Review', 'rehub_framework'),
						),
						array(
						'value' => 'review_post_review_product',
						'label' => __('Product review', 'rehub_framework'),
						),
						array(
						'value' => 'review_woo_product',
						'label' => __('Woocommerce product review', 'rehub_framework'),
						),	
						array(
						'value' => 'review_woo_list',
						'label' => __('Product review with woocommerce offers list', 'rehub_framework'),
						),												
						array(
						'value' => 'review_aff_product',
						'label' => __('Product review with affiliate links list', 'rehub_framework'),
						),						
					),
					'default' => array(
						'review_post_review_simple',
					),
				),

				array(
					'type' => 'notebox',
					'name' => 'review_countdown_note',
					'label' => __('Note', 'rehub_framework'),
					'description' => __('You can add countdown before offer with shortcode. Example - [wpsm_countdown year="2015" month="04" day="03" hour="14"]', 'rehub_framework'),
					'status' => 'normal',
				),				 


				array(
					'type'      => 'group',
					'repeating' => false,
					'length'    => 1,
					'name'      => 'review_post_product',
					'title'     => __('Product review', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'review_post_schema_type',
						'function' => 'review_post_schema_type_is_product',
					),
					'fields'    => array(

						array(
							'type' => 'select',
							'name' => 'review_aff_link',
							'label' => __('Choose affiliate offer', 'rehub_framework'),
							'description' => __('Choose affiliate link that you want to show as product offer or set data manually below', 'rehub_framework'),
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
							'type' => 'html',
							'name' => 'review_aff_link_preview',
							'binding' => array(
								'field' => 'review_aff_link',
								'function' => 'review_aff_link_preview',
							),
						),						

						 array(
							'type' => 'notebox',
							'name' => 'review_aff_note',
							'label' => __('Note', 'rehub_framework'),
							'description' => __('If you choose affiliate offer from field above, data from it will be used on frontend. You can leave it blank and set data manually in the fields below ', 'rehub_framework'),
							'status' => 'normal',
						),																		

						array(
							'type'      => 'textbox',
							'name'      => 'review_post_product_name',
							'label'     => __('Name of product', 'rehub_framework'),
							'description' => __('Insert title or leave blank for using post title', 'rehub_framework'),						
						),	

						array(
							'type'      => 'textbox',
							'name'      => 'review_post_product_desc',
							'label'     => __('Short description of product', 'rehub_framework'),
							'description' => __('Enter description of product or leave blank', 'rehub_framework'),								
						),

						
						array(
							'type'      => 'textbox',
							'name'      => 'review_post_product_price',
							'label'     => __('Offer sale price', 'rehub_framework'),
							'description' => __('Insert sale price of offer (example, $55) or any text', 'rehub_framework'),							
						),	

						array(
							'type'      => 'textbox',
							'name'      => 'review_post_product_price_old',
							'label'     => __('Offer old price', 'rehub_framework'),
							'description' => __('Insert old price of offer or leave blank', 'rehub_framework'),							
						),

						array(
							'type'      => 'textbox',
							'name'      => 'review_post_product_coupon',
							'label'     => __('Set coupon code', 'rehub_framework'),
							'description' => __('Set coupon code or leave blank', 'rehub_framework'),							
						),

					    array(
					        'type' => 'date',
					        'name' => 'review_post_coupon_date',
					        'label' => __('Coupon End Date', 'rehub_framework'),
					        'format' => 'yy-mm-dd',
					    ),																		

						array(
							'type'      => 'textbox',
							'name'      => 'review_post_product_url',
							'label'     => __('Offer url', 'rehub_framework'),
							'description' => __('Insert url of offer', 'rehub_framework'),							
						),

						array(
							'type'      => 'textbox',
							'name'      => 'review_post_btn_text',
							'label'     => __('Button text', 'rehub_framework'),
							'description' => __('Insert text on button or leave blank to use default text. Use short names', 'rehub_framework'),
							'validation' => 'maxlength[14]',														
						),						

						array(
							'type' => 'upload',
							'name' => 'review_post_product_thumb',
							'label' => __('Upload thumbnail', 'rehub_framework'),
							'description' => __('Upload thumbnail of product or leave blank to use post thumbnail', 'rehub_framework'),							
						),	

						array(
							'type' => 'toggle',
							'name' => 'review_post_offer_shortcode',
							'label' => __('Enable shortcode inserting', 'rehub_framework'),
							'description' => __('If enable you can insert offer box in any place of content with shortcode [offer_product]. If disable - it will be before review box.', 'rehub_framework'),					
						),																																																	

					),
				),	

				array(
					'type'      => 'group',
					'repeating' => false,
					'length'    => 1,
					'name'      => 'review_woo_product',
					'title'     => __('Woocommerce product review', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'review_post_schema_type',
						'function' => 'review_post_schema_type_is_woo',
					),
					'fields'    => array(
						
						array(
							'type' => 'select',
							'name' => 'review_woo_link',
							'label' => __('Choose woocommerce product', 'rehub_framework'),
							'description' => __('Choose woocommerce product for review', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_get_woo',
									),
								),
							),
							'default' => '',																																						
						),

						array(
							'type' => 'toggle',
							'name' => 'review_woo_slider',
							'label' => __('Enable slider', 'rehub_framework'),
							'description' => __('This option enables slider in top of review page with images from woocommerce gallery', 'rehub_framework'),					
						),	

						array(
							'type' => 'toggle',
							'name' => 'review_woo_slider_resize',
							'label' => __('Disable height resize for slider', 'rehub_framework'),
							'description' => __('This option disable resize of photo. By default, photos are resized for 400 px height', 'rehub_framework'),
							'dependency' => array(
		                         'field' => 'review_woo_slider',
		                         'function' => 'vp_dep_boolean',
		                    ),												
						),																								

						array(
							'type' => 'toggle',
							'name' => 'review_woo_offer_shortcode',
							'label' => __('Enable shortcode inserting', 'rehub_framework'),
							'description' => __('If enable you can insert offer box in any place of content with shortcode [woo_offer_product]. If disable - it will be before review box.', 'rehub_framework'),					
						),																																																

					),
				),

				array(
					'type'      => 'group',
					'repeating' => false,
					'length'    => 1,
					'name'      => 'review_woo_list',
					'title'     => __('Product review with woocommerce offers list', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'review_post_schema_type',
						'function' => 'review_post_schema_type_is_woo_list',
					),
					'fields'    => array(
						
						array(
							'type' => 'sorter',
							'name' => 'review_woo_list_links',
							'label' => __('Choose woocommerce offers', 'rehub_framework'),
							'description' => __('Choose woocommerce offers that you want to show in list', 'rehub_framework'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value'  => 'rehub_get_woo',
									),
								),
							),
							'default' => '',																																						
						),						

						array(
							'type' => 'toggle',
							'name' => 'review_woo_list_shortcode',
							'label' => __('Enable shortcode inserting', 'rehub_framework'),
							'description' => __('If enable you can insert offers list in any place of content with shortcode [woo_offer_list]. If disable - it will be before review box.', 'rehub_framework'),					
						),																																																

					),
				),					

				array(
					'type'      => 'group',
					'repeating' => false,
					'length'    => 1,
					'name'      => 'review_aff_product',
					'title'     => __('Product review with affiliate offers list', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'review_post_schema_type',
						'function' => 'review_post_schema_type_is_aff_product',
					),
					'fields'    => array(

						array(
							'type'      => 'textbox',
							'name'      => 'review_aff_product_name',
							'label'     => __('Name of product', 'rehub_framework'),
							'description' => __('Insert title or leave blank for using post title', 'rehub_framework'),
						),	

						array(
							'type'      => 'textbox',
							'name'      => 'review_aff_product_desc',
							'label'     => __('Short description of product', 'rehub_framework'),
							'description' => __('Enter description of product or leave blank', 'rehub_framework'),
						),	

						array(
							'type' => 'upload',
							'name' => 'review_aff_product_thumb',
							'label' => __('Upload thumbnail', 'rehub_framework'),
							'description' => __('Upload thumbnail of product or leave blank to use post thumbnail', 'rehub_framework'),
						),	
						
						array(
							'type' => 'sorter',
							'name' => 'review_aff_links',
							'label' => __('Choose affiliate offers', 'rehub_framework'),
							'description' => __('Choose affiliate links that you want to show in list', 'rehub_framework'),
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
							'type' => 'toggle',
							'name' => 'review_aff_offer_shortcode',
							'label' => __('Enable shortcode inserting', 'rehub_framework'),
							'description' => __('If enable you can insert offer box in any place of content with shortcode [aff_offer_product]. If disable - it will be before review box.', 'rehub_framework'),					
						),																																																

					),
				),								 

				array(
					'type'      => 'textbox',
					'name'      => 'review_post_heading',
					'label'     => __('Review Heading', 'rehub_framework'),
					'description' => __('Short review heading (e.g. Excellent!)', 'rehub_framework'),
				),
				array(
					'type'      => 'textarea',
					'name'      => 'review_post_summary_text',
					'label'     => __('Summary Text', 'rehub_framework'),
				),

				array(
					'type' => 'toggle',
					'name' => 'review_post_product_shortcode',
					'label' => __('Enable shortcode inserting', 'rehub_framework'),
					'description' => __('If enable you can insert review box in any place of content with shortcode [review]. If disable - it will be after content.', 'rehub_framework'),					
				),

				array(
					'type'      => 'slider',
					'name'      => 'review_post_score_manual',
					'label'     => __('Set overall score', 'rehub_framework'),
					'description' => __('Enter overall score of review or leave blank to auto calculation based on criterias score', 'rehub_framework'),
					'min'       => 0,
					'max'       => 10,
					'step'      => 0.5,					
				),

				array(
					'type'      => 'group',
					'repeating' => true,
					'name'      => 'review_post_criteria',
					'title'     => __('Review Criterias', 'rehub_framework'),
					'fields'    => array(
						array(
							'type'      => 'textbox',
							'name'      => 'review_post_name',
							'label'     => __('Name', 'rehub_framework'),
						),
						array(
							'type'      => 'slider',
							'name'      => 'review_post_score',
							'label'     => __('Score', 'rehub_framework'),
							'min'       => 0,
							'max'       => 10,
							'step'      => 0.5,
						),
					),
				),
			),
		),
		
		// music group
		array(
			'type'      => 'group',
			'repeating' => false,
			'length'    => 1,
			'name'      => 'music_post',
			'title'     => __('Music Post', 'rehub_framework'),
			'dependency' => array(
				'field'    => 'rehub_framework_post_type',
				'function' => 'rehub_framework_post_type_is_music',
			),
			'fields'    => array(
				array(
					'type' => 'radiobutton',
					'name' => 'music_post_source',
					'label' => __('Music Source', 'rehub_framework'),
					'items' => array(
						array(
							'value' => 'music_post_soundcloud',
							'label' => __('Music from Soundcloud', 'rehub_framework'),
						),
						array(
							'value' => 'music_post_spotify',
							'label' => __('Music from Spotify', 'rehub_framework'),
						),
					),
				),

				array(
					'type' => 'textarea',
					'name' => 'music_post_soundcloud_embed',
					'description' => __('Insert full Soundcloud embed code.', 'rehub_framework'),
					'label' => __('Soundcloud embed code', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'music_post_source',
						'function' => 'rehub_framework_post_music_is_soundcloud',
					),
				),
				array(
					'type' => 'textbox',
					'name' => 'music_post_spotify_embed',
					'description' => __('To get the Spotify Song URI go to <strong>Spotify</strong> > Right click on the song you want to embed > Click <strong>Copy Spotify URI</strong> > Paste code in this field.)', 'rehub_framework'),
					'label' => __('Spotify Song URI', 'rehub_framework'),
					'dependency' => array(
						'field'    => 'music_post_source',
						'function' => 'rehub_framework_post_music_is_spotify',
					),
				),

			),
		),
		
	),
);

/**
 * EOF
 */