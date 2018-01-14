<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<li <?php post_class( $classes ); ?>>
    <div class="yith_float_btns">
	    <div class="button_action"> 
	        <?php if (in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?>               
	            <?php echo do_shortcode('[yith_compare_button]'); ?>                
	        <?php } ?>
	        <?php if (in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?> 
	            <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?> 
	        <?php } ?>                                       
	    </div> 
    </div>
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		<h3><?php the_title(); ?></h3>

		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</a>

    <?php $offer_coupon = get_post_meta( get_the_ID(), 'rehub_woo_coupon_code', true ) ?>
    <?php $offer_coupon_date = get_post_meta( get_the_ID(), 'rehub_woo_coupon_date', true ) ?>
    <?php $offer_coupon_mask = get_post_meta( get_the_ID(), 'rehub_woo_coupon_mask', true ) ?>
    <?php $offer_coupon_url = esc_url( $product->add_to_cart_url() ); ?>
    <?php if(!empty($offer_coupon_date)) : ?>
		<?php 
		$timestamp1 = strtotime($offer_coupon_date); 
		$seconds = $timestamp1 - time(); 
		$days = floor($seconds / 86400);
		$seconds %= 86400;
		if ($days > 0) {
		  $coupon_text = $days.' '.__('days left', 'rehub_framework');
		  $coupon_style = '';
		}
		elseif ($days == 0){
		  $coupon_text = __('Last day', 'rehub_framework');
		  $coupon_style = '';
		}
		else {
		  $coupon_text = __('Coupon is Expired', 'rehub_framework');
		  $coupon_style = 'expired_coupon';
		}                 
		?>
  	<?php endif ;?>
  	<?php if(!empty($offer_coupon)) : ?>
		<?php wp_enqueue_script('zeroclipboard'); ?>
		<?php if ($offer_coupon_mask !='1' && $offer_coupon_mask !='on') :?>
		  <div class="rehub_offer_coupon not_masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>"><i class="fa fa-scissors fa-rotate-180"></i><span class="coupon_text"><?php echo $offer_coupon ?></span></div>   
		<?php else :?>
		  <div class="rehub_offer_coupon masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>" data-codeid="<?php echo $product->id ?>" data-dest="<?php echo $offer_coupon_url ?>"><?php if(rehub_option('rehub_mask_text') !='') :?><?php echo rehub_option('rehub_mask_text') ; ?><?php else :?><?php _e('Reveal coupon', 'rehub_framework') ?><?php endif ;?><i class="fa fa-external-link-square"></i></div>   
		<?php endif;?> 
  	<?php endif ;?> 	

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>