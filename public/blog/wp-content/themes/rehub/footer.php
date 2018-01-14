<?php if(rehub_option('rehub_ads_infooter') != '') : ?><div class="content mediad_footer"><div class="clearfix"></div><div class="mediad megatop_mediad"><?php echo do_shortcode(rehub_option('rehub_ads_infooter')); ?></div><div class="clearfix"></div></div><?php endif; ?>
<?php if(rehub_option('rehub_footer_widgets')) : ?>
<div class="footer-bottom<?php if(rehub_option('rehub_footer_block') =='1') : ?> block_foot<?php endif;?>">
  <div class="container clearfix">
	<div class="footer_widget">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		<?php else : ?>
			<p><?php _e('No widgets added. You can disable footer widget area in theme options - footer options', 'rehub_framework'); ?></p>
		<?php endif; ?> 
	</div>
	<div class="footer_widget">
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		<?php endif; ?> 
	</div>
	<div class="footer_widget last">
		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		<?php endif; ?> 
	</div>		
  </div>
</div>
<?php endif; ?>
<footer<?php if(rehub_option('rehub_footer_block') =='1') : ?> class="block_foot"<?php endif;?> id='theme_footer'>
  <div class="container clearfix">
    <div class="left">
		<?php if(rehub_option('rehub_footer_text')) : ?>
		<div class="f_text"><?php echo rehub_kses(rehub_option('rehub_footer_text')); ?></div>
		<?php endif; ?>
    </div>
    <div class="right"> <?php if(rehub_option('rehub_footer_logo')) : ?><img src="<?php echo rehub_option('rehub_footer_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /><?php endif; ?></div>
  </div>
</footer>
<!-- FOOTER --> 
<?php if(rehub_option('rehub_analytics')) : ?><?php echo rehub_option('rehub_analytics'); ?><?php endif; ?>
<a href="#top_ankor" class="rehub_scroll" id="topcontrol"><i class="fa fa-chevron-up"></i></a>
<?php if(rehub_option('rehub_adblock_enable') =='1') : ?><?php  wp_enqueue_script('adblock_init'); ?><div id="noblockdiv" style="display:none"><div class="noadb"><span class="noadb-span"><?php echo rehub_kses(rehub_option('rehub_adblock_notice')); ?></span></div></div><?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>