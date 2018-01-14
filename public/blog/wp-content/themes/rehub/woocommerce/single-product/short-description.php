<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_excerpt ) return;
?>
<div itemprop="description">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div>
<?php $rehub_woo_review_related = vp_metabox('rehub_framework_woo.review_woo_id'); if ($rehub_woo_review_related !='') :?>
<div class="woo_related_review"><a href="<?php echo get_permalink($rehub_woo_review_related) ;?>" target="_blank"><?php _e('Read review of product', 'rehub_framework') ;?></a> &#8594;</div>
<?php endif ;?>