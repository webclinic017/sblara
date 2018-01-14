<?php if (vp_metabox('rehub_framework_brand.rehub_branded_bg_url_single') && (is_single() || is_page())) :?>
  <?php $branded_bg_url = vp_metabox('rehub_framework_brand.rehub_branded_bg_url_single');?>
  <a id="branded_bg" href="<?php echo $branded_bg_url; ?>" target="_blank"></a>
<?php elseif (rehub_option('rehub_branded_bg_url') ) :?>
  <?php $branded_bg_url = rehub_option('rehub_branded_bg_url');?>
  <a id="branded_bg" href="<?php echo $branded_bg_url; ?>" target="_blank"></a>
<?php endif; ?>