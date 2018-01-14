<?php if( is_category() || is_singular('post') ){
	if( is_category() ) $cat_id = get_query_var('cat') ;
	if( is_single() ){ 
		$categories = get_the_category( $post->ID );
		$cat_id = $categories[0]->term_id ;
	}
	$cat_data = get_option("category_$cat_id");
}
?>
<?php if (vp_metabox('rehub_framework_brand.rehub_branded_banner_image_single') && (is_single() || is_page())) :?>
  <?php $branded_banner_url = vp_metabox('rehub_framework_brand.rehub_branded_banner_url_single');?>
  <?php $branded_banner_image = vp_metabox('rehub_framework_brand.rehub_branded_banner_image_single');?>
  <div id="branded_img"><a href="<?php echo $branded_banner_url; ?>" target="_blank"><img alt="" src="<?php echo $branded_banner_image; ?>"></a></div>
<?php elseif (!empty($cat_data['cat_image_url']) && (is_single() || is_category())  ) :?>
  <?php $branded_banner_url = $cat_data['cat_banner_url'];?>
  <?php $branded_banner_image = $cat_data['cat_image_url'];?>
  <div id="branded_img"><a href="<?php echo $branded_banner_url; ?>" target="_blank"><img alt="" src="<?php echo $branded_banner_image; ?>"></a></div>
  <style>.top_theme { display: none } header .main-nav { margin-bottom: 0 !important } .content.landing_page{ margin-top: 0 !important}</style>
<?php elseif (rehub_option('rehub_branded_banner_image') ) :?>
  <?php $branded_banner_url = rehub_option('rehub_branded_banner_url');?>
  <?php $branded_banner_image = rehub_option('rehub_branded_banner_image');?>
  <div id="branded_img"><a href="<?php echo $branded_banner_url; ?>" target="_blank"><img alt="" src="<?php echo $branded_banner_image; ?>"></a></div>
<?php endif; ?>