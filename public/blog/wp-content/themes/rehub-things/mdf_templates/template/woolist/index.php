<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php global $mdf_loop; MDTF_SORT_PANEL::mdtf_catalog_ordering();?>
<div class="clearfix"></div>
<?php while ($mdf_loop->have_posts()) : $mdf_loop->the_post(); ?>
<div class="aff_offer_links">
<?php $i=1;  $product = new WC_Product(get_the_ID()); global $product; ?>
    
<?php $woolink = ($product->product_type =='external') ? $product->add_to_cart_url() : get_post_permalink(get_the_ID()) ;?>
<?php $term_ids =  wp_get_post_terms(get_the_ID(), 'product_tag', array("fields" => "ids")); if (!empty($term_ids)) {$term_brand = $term_ids[0]; $term_brand_image = get_option("taxonomy_term_$term_ids[0]");} else {$term_brand_image ='';}
?>
<div class="rehub_feat_block table_view_block"><a name="woo-link-list"></a>
    <?php if ($product->is_on_sale()) : ?><div class="vip_corner"><span class="vip_badge sale_badge">Sale!</span></div><?php endif ?> 
    <div class="block_with_coupon">
        <div class="offer_thumb">
        <a href="<?php echo $woolink; ?>" target="_blank"><?php wpsm_thumb( 'med_thumbs') ?></a>    
        </div>
        <div class="desc_col">
            <div class="offer_title"><a href="<?php echo $woolink; ?>" target="_blank"><?php the_title(); ?></a></div>
            <p>
                <?php kama_excerpt('maxchar=150'); ?>
                <?php $rehub_woo_review_related = get_post_meta( get_the_ID(), "review_woo_id", true ); if ( !empty($rehub_woo_review_related)) : ?>
                    <a href="<?php echo get_permalink($rehub_woo_review_related) ;?>" target="_blank" class="color_link"><?php _e("Read review", "rehub_framework") ;?></a>
                    <div class="clearfix"></div>    
                <?php endif; ?>
            </p>
            <p> 
                <?php if (in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?>               
                    <?php echo do_shortcode('[yith_compare_button]'); ?>                
                <?php } ?>
                <?php if (in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  { ?> 
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?> 
                <?php } ?>                                       
            </p>            
        </div>
            <div class="price_col">
                <?php if ($product->get_price() !='') : ?>           
                <p><span class="price_count"><?php echo $product->get_price_html(); ?></span></p>
                <?php endif ;?>  
                <?php if (!empty($term_brand_image['brand_image'])) :?>                              
                <div class="aff_tag">
                    <img src="<?php $params = array( 'width' => 120, 'height' => 90 ); echo bfi_thumb( $term_brand_image['brand_image'], $params ); ?>" alt="<?php the_title_attribute(); ?>" />               
                </div>
                <?php endif; ?>
            </div>                     
            <div class="buttons_col">
                <div class="priced_block">
                    <?php if ( $product->is_in_stock() &&  $product->add_to_cart_url() !='') : ?>
                        <?php  echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                            sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn_offer_block %s product_type_%s"%s>%s</a>',
                            esc_url( $product->add_to_cart_url() ),
                            esc_attr( $product->id ),
                            esc_attr( $product->get_sku() ),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : 'add_to_cart_button',
                            esc_attr( $product->product_type ),
                            $product->product_type =='external' ? ' target="_blank"' : '',
                            esc_html( $product->add_to_cart_text() )
                            ),
                        $product );?>
                    <?php endif; ?>
                </div>
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
                    <?php if(!empty($offer_coupon_date)) {echo '<div class="time_offer">'.$coupon_text.'</div>';} ?>  
                <?php endif ;?>                      
            </div>
    </div>
</div>
<?php $i++; ?>   
</div>
<?php endwhile; // end of the loop.    ?>
<div class="clearfix"></div>