<?php
/**
 * @since 4.4
 * Default templates list
 */

$data = array();
$data['name'] = __( 'Row with sidebar area', 'rehub_framework' );
$data['custom_class'] = 'img_row_sidebar'; // default is ''
$data['content'] = <<<CONTENT
[vc_row bg_width_type="simple" rehub_container="true" centered_container=""][vc_column width="2/3"][/vc_column][vc_column width="1/3"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Demo homepage 1', 'rehub_framework' );
$data['custom_class'] = 'img_demo_home_1';
$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1422119688472{margin-bottom: 5px !important;}" bg_width_type="simple" rehub_container="" centered_container=""][vc_column width="1/1"][wpsm_featured base="1" fetch="4"][/vc_column][/vc_row][vc_row css=".vc_custom_1422119743671{margin-bottom: 30px !important;}" bg_width_type="simple" rehub_container="" centered_container=""][vc_column width="1/1"][full_carousel base="1" fetch="10" badge="1" badge_color="orange" badge_text="RWRpdG9yJTI3cyUyMCUzQ3NwYW4lM0VjaG9pY2UlM0MlMkZzcGFuJTNF"][/vc_column][/vc_row][vc_row bg_width_type="simple" rehub_container="true" centered_container=""][vc_column width="2/3"][grid_loop_mod data_source="cat" columns="2_col" orderby="date" order="DESC" post_formats="all" show="10" module_pagination="1"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="sidebar-1"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Demo homepage 2', 'rehub_framework' );
$data['custom_class'] = 'img_demo_home_2';
$data['content'] = <<<CONTENT
[vc_row bg_width_type="simple" rehub_container="true"][vc_column width="2/3"][post_slider_mod module_cat="all" module_fetch="4"][title_mod title_position="center_title" title_name="NEWS BLOCK WITHOUT THUMBS" title_url="url:%2Fblog|title:Read%20all%20%2B|"][news_no_thumbs_mod module_cats="1"][title_mod title_position="top_title" title_name="News Block"][small_thumb_loop data_source="cat" orderby="date" order="DESC" post_formats="all" show="5" enable_pagination=""][vc_column_text bordered="1"]
[/vc_column_text][small_thumb_loop data_source="cat" orderby="date" order="DESC" post_formats="all" offset="5" show="5" enable_pagination=""][post_carousel_mod module_cat="9" module_formats="all" module_fetch="6"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="sidebar-1"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Woocommerce grid with tabs', 'js_composer' );
$data['custom_class'] = 'woo_tabs_grid';
$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1421962579921{margin-bottom: 15px !important;}" bg_width_type="simple" rehub_container="" centered_container=""][vc_column width="1/1"][vc_tabs interval="0" style_sec="1"][vc_tab title="SALE" tab_id="1421866490741-10"][wpsm_woogrid data_source="type" type="sale" columns="3_col" orderby="date" order="DESC" show="3" enable_pagination="" no_border="1"][/vc_tab][vc_tab title="FEATURED" tab_id="1421866490970-0"][wpsm_woogrid data_source="type" type="featured" columns="3_col" orderby="date" order="DESC" show="3" enable_pagination="" no_border="1"][/vc_tab][vc_tab title="LATEST" tab_id="1421866527111-2-9"][wpsm_woogrid data_source="type" type="recent" columns="3_col" orderby="date" order="DESC" show="3" enable_pagination="" no_border="1"][/vc_tab][/vc_tabs][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Images grid with titles', 'js_composer' );
$data['custom_class'] = 'images_grid';
$data['content'] = <<<CONTENT
[vc_row bg_width_type="simple" rehub_container="" centered_container="" css=".vc_custom_1421963004718{margin-top: 55px !important;padding-right: 50px !important;padding-left: 50px !important;}"][vc_column width="1/3"][vc_single_image alignment="center" style="vc_box_shadow_border" border_color="grey" img_link_large="" img_link_target="_self" css_animation="bottom-to-top" img_size="250x250" css=".vc_custom_1421873236704{margin-bottom: 15px !important;}"][vc_custom_heading text="Set title of image" font_container="tag:div|font_size:17px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/3"][vc_single_image alignment="center" style="vc_box_shadow_border" border_color="grey" img_link_large="" img_link_target="_self" css_animation="bottom-to-top" img_size="250x250" css=".vc_custom_1421873236704{margin-bottom: 15px !important;}"][vc_custom_heading text="Set title of image" font_container="tag:div|font_size:17px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/3"][vc_single_image alignment="center" style="vc_box_shadow_border" border_color="grey" img_link_large="" img_link_target="_self" css_animation="bottom-to-top" img_size="250x250" css=".vc_custom_1421873236704{margin-bottom: 15px !important;}"][vc_custom_heading text="Set title of image" font_container="tag:div|font_size:17px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][/vc_row][vc_row bg_width_type="simple" rehub_container="" centered_container="" css=".vc_custom_1421963014201{margin-bottom: 55px !important;padding-right: 50px !important;padding-left: 50px !important;}"][vc_column width="1/3"][vc_single_image alignment="center" style="vc_box_shadow_border" border_color="grey" img_link_large="" img_link_target="_self" css_animation="bottom-to-top" img_size="250x250" css=".vc_custom_1421873236704{margin-bottom: 15px !important;}"][vc_custom_heading text="Set title of image" font_container="tag:div|font_size:17px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/3"][vc_single_image alignment="center" style="vc_box_shadow_border" border_color="grey" img_link_large="" img_link_target="_self" css_animation="bottom-to-top" img_size="250x250" css=".vc_custom_1421873236704{margin-bottom: 15px !important;}"][vc_custom_heading text="Set title of image" font_container="tag:div|font_size:17px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][vc_column width="1/3"][vc_single_image alignment="center" style="vc_box_shadow_border" border_color="grey" img_link_large="" img_link_target="_self" css_animation="bottom-to-top" img_size="250x250" css=".vc_custom_1421873236704{margin-bottom: 15px !important;}"][vc_custom_heading text="Set title of image" font_container="tag:div|font_size:17px|text_align:center" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Mega call to action with image', 'js_composer' );
$data['custom_class'] = 'call_t_mega';
$data['content'] = <<<CONTENT
[vc_row  bg_width_type="container_width" rehub_container="" centered_container=""][vc_column width="1/2" css=".vc_custom_1421798251869{padding: 70px !important;}"][vc_row_inner][vc_column_inner width="1/6"][vc_icon type="fontawesome" icon_fontawesome="fa fa-flask" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="black" background_color="orange" size="sm" align="right" el_class="inlinestyle" background_style="boxed-outline"][/vc_column_inner][vc_column_inner width="1/6"][vc_icon type="fontawesome" icon_fontawesome="fa fa-heart-o" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="black" background_color="orange" size="sm" align="right" el_class="inlinestyle" background_style="boxed-outline"][/vc_column_inner][vc_column_inner width="1/6"][vc_icon type="fontawesome" icon_fontawesome="fa fa-clock-o" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="black" background_color="orange" size="sm" align="right" el_class="inlinestyle" background_style="boxed-outline"][/vc_column_inner][vc_column_inner width="1/6"][vc_icon type="fontawesome" icon_fontawesome="fa fa-angellist" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="black" background_color="orange" size="sm" align="right" el_class="inlinestyle" background_style="boxed-outline"][/vc_column_inner][vc_column_inner width="1/6"][vc_icon type="fontawesome" icon_fontawesome="fa fa-bomb" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="black" background_color="orange" size="sm" align="right" el_class="inlinestyle" background_style="boxed-outline"][/vc_column_inner][vc_column_inner width="1/6"][vc_icon type="fontawesome" icon_fontawesome="fa fa-gift" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="black" background_color="orange" size="sm" align="right" el_class="inlinestyle" background_style="boxed-outline"][/vc_column_inner][/vc_row_inner][vc_custom_heading text="Our verdict" font_container="tag:h2|font_size:36px|text_align:left|line_height:36px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421802107701{margin-bottom: 20px !important;}"][vc_custom_heading text="$49.99 - $59.99" font_container="tag:h2|font_size:24px|text_align:left|line_height:30px" google_fonts="font_family:Noto%20Serif%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421804070075{margin-bottom: 20px !important;}"][vc_column_text bordered=""]

Robust, 3-layer iPhone 6 case withstands accidents like drops, shocks and bumps
Built-in screen protector prevents scratches to the 4.7" touchscreen
Customize your case with a variety of color options
Protective membrane cradles the Touch ID to block dust and debris
[/vc_column_text][vc_button2 title="BUY IT NOW!" align="inline" style="square" color="orange" size="md" link="url:%23|title:DETAILS|"][vc_button2 title="DETAILS" align="inline" style="square_outlined" color="mulled_wine" size="md" link="url:%23||"][/vc_column][vc_column width="1/2" css=".vc_custom_1421798235150{padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Centered icon call to action', 'rehub_framework' );
$data['custom_class'] = 'call_centered_icon';
$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1422121618685{padding-top: 40px !important;padding-bottom: 40px !important;background-color: #af1156 !important;}" bg_width_type="window_width" rehub_container="" centered_container="true"][vc_column width="1/1"][vc_row_inner][vc_column_inner width="1/3"][vc_empty_space height="35px"][vc_custom_heading text="Watch Video Tutorials" font_container="tag:h2|font_size:26px|text_align:center|color:%23ffffff|line_height:24px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1422122019201{margin-bottom: 20px !important;}"][/vc_column_inner][vc_column_inner width="1/3"][vc_icon type="fontawesome" icon_fontawesome="fa fa-play-circle-o" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="white" background_color="grey" size="xl" align="center" link="url:http%3A%2F%2Fyoutube.com||target:%20_blank"][/vc_column_inner][vc_column_inner width="1/3"][vc_empty_space height="15px"][vc_custom_heading text="Watch our narrated HD video tutorial or share the with your clients. Our client love our YouTube channel!" font_container="tag:h2|font_size:18px|text_align:center|color:%23ffffff|line_height:21px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1422122030117{margin-bottom: 20px !important;}"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

/** Service List template */
$data = array();
$data['name'] = __( 'Call to action on background.', 'js_composer' );
$data['custom_class'] = 'call_bg_block';
$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1422122731549{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" bg_width_type="container_width" rehub_container="" centered_container=""][vc_column width="1/1" css=".vc_custom_1421870836974{padding: 70px !important;background-color: rgba(0,0,0,0.69) !important;*background-color: rgb(0,0,0) !important;}"][vc_custom_heading text="CUSTOM HEADING TITLE" font_container="tag:h2|font_size:40px|text_align:center|color:%23ffffff|line_height:40px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1421870967970{margin-bottom: 15px !important;}"][vc_custom_heading text="Cras ultricies ligula sed magna dictum porta. Cras ultricies ligula sed magna dictum porta.
Sed porttitor lectus nibh. Vestibulum faucibus orci luctus." font_container="tag:h2|font_size:20px|text_align:center|color:%23ffffff|line_height:20px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal" css=".vc_custom_1421871177994{margin-bottom: 25px !important;}"][vc_button2 title="BUTTON TEXT" align="center" style="square" color="green" size="md" link="url:%23||"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( '3 icons block', 'js_composer' );
$data['custom_class'] = 'iconed_block';
$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1421868396695{padding-top: 35px !important;padding-right: 40px !important;padding-bottom: 35px !important;padding-left: 40px !important;background-color: #f4f4f4 !important;}" bg_width_type="container_width" rehub_container="" centered_container=""][vc_column width="1/3"][vc_icon type="fontawesome" icon_fontawesome="fa fa-truck" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="white" background_style="rounded" background_color="sandy_brown" size="lg" align="center"][vc_custom_heading text="FREE DELIVERY" font_container="tag:h5|font_size:24px|text_align:center|line_height:24px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="IN YOUR CITY" font_container="tag:h5|font_size:21px|text_align:center|line_height:21px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421868445432{margin-bottom: 20px !important;}"][vc_column_text bordered="" el_class="font90"]Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.

<a href="#">Read more</a>[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon type="fontawesome" icon_fontawesome="fa fa-key" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="white" background_style="rounded" background_color="sandy_brown" size="lg" align="center"][vc_custom_heading text="GARANTEE" font_container="tag:h5|font_size:24px|text_align:center|line_height:24px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="ON ALL PRODUCTS" font_container="tag:h5|font_size:21px|text_align:center|line_height:21px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421868517860{margin-bottom: 20px !important;}"][vc_column_text bordered="" el_class="font90"]Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.

<a href="#">Read more</a>[/vc_column_text][/vc_column][vc_column width="1/3"][vc_icon type="fontawesome" icon_fontawesome="fa fa-life-ring" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="white" background_style="rounded" background_color="sandy_brown" size="lg" align="center"][vc_custom_heading text="FULL TIME" font_container="tag:h5|font_size:24px|text_align:center|line_height:24px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:700%20bold%20regular%3A700%3Anormal"][vc_custom_heading text="SUPPORT" font_container="tag:h5|font_size:21px|text_align:center|line_height:21px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421868633758{margin-bottom: 20px !important;}"][vc_column_text bordered="" el_class="font90"]Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.

<a href="#">Read more</a>[/vc_column_text][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );


$data = array();
$data['name'] = __( 'Contacts icons', 'js_composer' );
$data['custom_class'] = 'icons_contacts';
$data['content'] = <<<CONTENT
[vc_row bg_width_type="simple" rehub_container="" centered_container="" css=".vc_custom_1421963124920{margin-bottom: 0px !important;padding-top: 55px !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/3"][vc_icon type="fontawesome" icon_fontawesome="fa fa-mobile" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="blue" background_style="rounded-outline" background_color="blue" size="md" align="left" el_class="floatleft mr15"][vc_custom_heading text="Give us a call" font_container="tag:div|font_size:18px|text_align:left|line_height:18px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1421875299451{padding-bottom: 10px !important;}"][vc_custom_heading text="1-234-567-8910" font_container="tag:div|font_size:16px|text_align:left|line_height:16px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column_inner][vc_column_inner width="1/3"][vc_icon type="fontawesome" icon_fontawesome="fa fa-envelope-o" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="blue" background_style="rounded-outline" background_color="blue" size="md" align="left" el_class="floatleft mr15"][vc_custom_heading text="Email us at" font_container="tag:div|font_size:18px|text_align:left|line_height:18px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1421875500617{padding-bottom: 10px !important;}"][vc_custom_heading text="info@email.io" font_container="tag:div|font_size:16px|text_align:left|line_height:16px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column_inner][vc_column_inner width="1/3"][vc_icon type="fontawesome" icon_fontawesome="fa fa-twitter" icon_openiconic="vc-oi vc-oi-dial" icon_typicons="typcn typcn-adjust-brightness" icon_entypo="entypo-icon entypo-icon-note" icon_linecons="vc_li vc_li-heart" color="blue" background_style="rounded-outline" background_color="blue" size="md" align="left" el_class="floatleft mr15"][vc_custom_heading text="Follow us" font_container="tag:div|font_size:18px|text_align:left|line_height:18px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1421875572444{padding-bottom: 10px !important;}"][vc_custom_heading text="@envato" font_container="tag:div|font_size:16px|text_align:left|line_height:16px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Search full width block with title', 'js_composer' );
$data['custom_class'] = 'search_block';
$data['content'] = <<<CONTENT
[vc_row bg_width_type="window_width" rehub_container="" css=".vc_custom_1421789292280{margin-bottom: 0px !important;padding-top: 40px !important;padding-bottom: 40px !important;background-image: url(/wp-content/themes/rehub/images/default/poly.jpg) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" centered_container="true"][vc_column width="1/1"][vc_custom_heading text="Search products and deals" font_container="tag:h2|font_size:36px|text_align:center|color:%23ffffff|line_height:36px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421786971504{margin-bottom: 15px !important;}"][vc_custom_heading text="Save your time and money" font_container="tag:h2|font_size:16px|text_align:center|color:%23ffffff|line_height:16px" google_fonts="font_family:Droid%20Sans%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421787071851{margin-bottom: 15px !important;}"][wpsm_searchbox color="red" by="thirstylink,product" placeholder="Search"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );


$data = array();
$data['name'] = __( 'Offer with image, title, text, price', 'js_composer' );
$data['custom_class'] = 'call_img_t_price';
$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1421804132082{margin-top: -30px !important;margin-bottom: 0px !important;}" bg_width_type="container_width" rehub_container="" centered_container="true"][vc_column width="1/2" css=".vc_custom_1421798235150{padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][vc_column width="1/2" css=".vc_custom_1421798251869{padding: 70px !important;}"][vc_custom_heading text="This is custom heading element" font_container="tag:h2|font_size:36px|text_align:left|line_height:36px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421798365177{margin-bottom: 20px !important;}"][vc_separator color="sky" border_width="3" sep_align="left" sep_width="60px" m_top="10px" m_bottom="20px"][vc_column_text css=".vc_custom_1421798856971{margin-bottom: 20px !important;}" bordered=""]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][vc_custom_heading text="$99" font_container="tag:h2|font_size:24px|text_align:left|color:%23e0b816|line_height:24px" google_fonts="font_family:Noto%20Serif%3Aregular%2Citalic%2C700%2C700italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421799496313{padding-right: 10px !important;}" el_class="inlinestyle"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

$data = array();
$data['name'] = __( 'Offer with image, title, text, button', 'js_composer' );
$data['custom_class'] = 'call_t_btn';
$data['content'] = <<<CONTENT
[vc_row bg_width_type="container_width" rehub_container="" centered_container=""][vc_column width="1/2" css=".vc_custom_1421798251869{padding: 70px !important;}"][vc_custom_heading text="This is custom heading element" font_container="tag:h2|font_size:36px|text_align:right|line_height:36px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421799585775{margin-bottom: 20px !important;}"][vc_separator color="sky" border_width="3" sep_align="right" sep_width="60px" m_top="10px" m_bottom="20px"][vc_column_text bordered=""]

I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.

[/vc_column_text][vc_button2 title="$99 / BUY IT NOW!" align="right" style="square" color="mulled_wine" size="md" link="url:%23|title:%2499%2FBuy%20it%20Now!|"][/vc_column][vc_column width="1/2" css=".vc_custom_1421798235150{padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );


$data = array();
$data['name'] = __( 'Offer with image, title, bars', 'js_composer' );
$data['custom_class'] = 'call_bars';
$data['content'] = <<<CONTENT
[vc_row bg_width_type="container_width" rehub_container="" centered_container=""][vc_column width="1/2" css=".vc_custom_1421798235150{padding-right: 0px !important;padding-left: 0px !important;}"][vc_single_image border_color="grey" img_link_target="_self"][/vc_column][vc_column width="1/2" css=".vc_custom_1421798251869{padding: 70px !important;}"][vc_custom_heading text="This is custom heading element" font_container="tag:h2|font_size:36px|text_align:left|line_height:36px" google_fonts="font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal" css=".vc_custom_1421800124166{margin-bottom: 25px !important;}"][vc_separator color="custom" sep_align="left" sep_width="100%" m_top="10px" m_bottom="30px" accent_color="#ededed"][vc_progress_bar values="90|Development|#fb7203,80|Design|#fb7203,70|Marketing|#fb7203,90|Price|#fb7203" bgcolor="bar_grey" options="striped" units="%"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

/** Square on background */
$data = array();
$data['name'] = __( 'Square on background', 'js_composer' );
$data['custom_class'] = 'vc_default_template-13';
$data['content'] = <<<CONTENT
[vc_row css=".vc_custom_1411477992738{background-color: #3098ad !important;}"][vc_column width="1/1"][vc_empty_space height="200px"][vc_row_inner][vc_column_inner width="1/3"][/vc_column_inner][vc_column_inner width="1/3" css=".vc_custom_1422129069566{padding: 25px !important;background-color: #ffffff !important;}"][vc_cta_button2 style="square" txt_align="center" title="Try Now" btn_style="square" color="juicy_pink" size="md" position="bottom" accent_color="rgba(255,255,255,0.01)" link="url:%23||" h2="Hey! I am first heading line feel free to change me"][/vc_cta_button2][/vc_column_inner][vc_column_inner width="1/3"][/vc_column_inner][/vc_row_inner][vc_empty_space height="200px"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );

/** Video description */
$data = array();
$data['name'] = __( 'Video with description', 'js_composer' );
$data['custom_class'] = 'vc_default_template-16';
$data['content'] = <<<CONTENT
[vc_row][vc_column width="1/6"][/vc_column][vc_column width="4/6"][vc_video][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/1"][vc_separator color="grey" style="dotted"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_row_inner][vc_column_inner width="1/2"][vc_single_image border_color="grey" img_link_target="_self" style="vc_box_rounded"][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][vc_row_inner][vc_column_inner width="1/2"][vc_single_image border_color="grey" img_link_target="_self" style="vc_box_rounded"][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );