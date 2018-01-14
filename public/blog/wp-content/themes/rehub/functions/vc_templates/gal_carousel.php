<?php
$output = $onclick = $custom_links = $images = $el_class = $custom_links_target = '';
extract( shortcode_atts( array(
	'title' => '',
	'onclick' => 'link_image',
	'custom_links' => '',
	'images' => '',
	'el_class' => '',
	'custom_links_target' => ''
), $atts ) );
$gal_images = '';
$el_start = '';
$el_end = '';
$pretty_rand = $onclick == 'link_image' ? rand() : '';
$img_size ='grid_news';

wp_enqueue_script('carouFredSel'); 
if ( $onclick == 'link_image' ) {
	wp_enqueue_script('prettyphoto');
}

$el_class = $this->getExtraClass( $el_class );

if ( $images == '' ) $images = '-1,-2,-3';

if ( $onclick == 'custom_link' ) {
	$custom_links = explode( ',', $custom_links );
}

$images = explode( ',', $images );
$i = - 1;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_images_carousel wpb_content_element' . $el_class . ' vc_clearfix', $this->settings['base'], $atts );
?>
<?php if( !is_paged()) : ?>
<div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->settings['base'], $atts ) ?>">
<div class="def-carousel media_carousel loading">
	<section class="photo_carousel pretty_photo_<?php echo $pretty_rand ; ?> clearfix">
		<ul class="gallery-pics clearfix">
			<?php foreach ( $images as $attach_id ): ?>
						<?php
						$i ++;
						if ( $attach_id > 0 ) {
							$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
						} else {
							$post_thumbnail = array();
							$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
							$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
						}
						$thumbnail = $post_thumbnail['thumbnail'];
						?>
						<li>
							<?php if ( $onclick == 'link_image' ): ?>
							<?php $p_img_large = $post_thumbnail['p_img_large']; ?>
								<?php echo $thumbnail ?>
								<div class="gp-overlay"><a class="prettyphoto" href="<?php echo $p_img_large[0] ?>" <?php echo ' rel="prettyPhoto[rel-' . $pretty_rand . ']"' ?>></a> </div>
							<?php elseif ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ): ?>
								<?php echo $thumbnail ?>
								<div class="gp-overlay"><a href="<?php echo $custom_links[$i] ?>"<?php echo ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>></a></div>
							<?php else: ?>
							<?php echo $thumbnail ?>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
		</ul>
	</section>
	<div class="carousel-prev"></div>
	<div class="carousel-next"></div>
</div>	
	
</div><?php echo $this->endBlockComment( '.wpb_images_carousel' ) ?>
<?php endif ; ?>