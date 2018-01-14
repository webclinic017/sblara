<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );
?>

<h2><?php echo $heading; ?></h2>

<?php the_content(); ?>

<?php $rehub_woo_review_related = vp_metabox('rehub_framework_woo.review_woo_id'); if ($rehub_woo_review_related !='') :?>
<p><a href="<?php echo get_permalink($rehub_woo_review_related) ;?>" target="_blank"><?php _e('Read review of product', 'rehub_framework') ;?></a> &#8594;</p>
<?php endif ;?>