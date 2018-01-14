<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php global $mdf_loop; MDTF_SORT_PANEL::mdtf_catalog_ordering();?>
<div class="clearfix"></div>
<?php $i=1; while ($mdf_loop->have_posts()) : $mdf_loop->the_post(); ?>
<?php   $attachments = get_posts( array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'post_parent' => $post->ID,
) );
if (!empty($attachments)) {$aff_thumb_list = wp_get_attachment_url( $attachments[0]->ID );} else {$aff_thumb_list ='';}
$term_list = wp_get_post_terms($post->ID, 'thirstylink-category', array("fields" => "names")); 
$term_ids =  wp_get_post_terms($post->ID, 'thirstylink-category', array("fields" => "ids")); if (!empty($term_ids)) {$term_brand = $term_ids[0]; $term_brand_image = get_option("taxonomy_term_$term_ids[0]");} else {$term_brand_image ='';}
?>                           

<div class="offer_grid column_grid<?php if (($i % 3) == '0') :?> last-col<?php endif ?><?php if (($i % 3) == '1') :?> first-col<?php endif ?>">
    <?php if (get_post_meta( $post->ID, 'rehub_aff_sticky', true) == '1') :?><div class="vip_corner"><span class="vip_badge"><i class="fa fa-thumbs-o-up"></i></span></div><?php endif ?> 
        
        <div class="aff_grid_top">
            <div class="aff_tag">
                <?php if (!empty($term_brand_image['brand_image'])) :?>
                    <img src="<?php $params = array( 'width' => 120, 'height' => 90 ); echo bfi_thumb( $term_brand_image['brand_image'], $params ); ?>" alt="<?php the_title_attribute(); ?>" />
                <?php elseif (!empty($term_list[0])) :?> 
                    <?php echo $term_list[0]; ?>
                <?php endif; ?>          
            </div>
        </div>

        <div class="offer_thumb">
        <a href="<?php the_permalink(); ?>" target="_blank">
            <?php if (!empty($aff_thumb_list) ) :?> 
                <img src="<?php $params = array( 'width' => 378, 'height' => 310 ); echo bfi_thumb( $aff_thumb_list, $params ); ?>" alt="<?php the_title_attribute(); ?>" />
            <?php elseif (!empty($term_brand_image['brand_image'])) :?>
                <img src="<?php $params = array( 'width' => 378, 'height' => 310 ); echo bfi_thumb( $term_brand_image['brand_image'], $params ); ?>" alt="<?php the_title_attribute(); ?>" />
            <?php else :?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/default/noimage_378_310.png" alt="<?php the_title_attribute(); ?>" />
            <?php endif?>
        </a>    
        </div>
        <div class="desc_col">
            <h4><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h4>
            <div class="r_offer_details">
            <?php 
            $rehub_aff_review_related = get_post_meta( $post->ID, "rehub_aff_rel", true ); 
            $rehub_aff_desc = get_post_meta( $post->ID, 'rehub_aff_desc', true ); 
            if (!empty($rehub_aff_review_related) || !empty($rehub_aff_desc)) :
            ?>
                <span id="r_show_hide"><?php _e('Details +', 'rehub_framework') ?></span>
                <p>
                    <?php echo get_post_meta( $post->ID, 'rehub_aff_desc', true );?>
                    <?php if ( !empty($rehub_aff_review_related)) : ?>
                        <br /><a href="<?php echo $rehub_aff_review_related; ?>" target="_blank" class="color_link"><?php _e("Read review", "rehub_framework") ;?></a>    
                    <?php endif; ?>
                </p>
            <?php endif ;?>    
            </div>
        </div>
        <?php 
        $product_price = get_post_meta( $post->ID, 'rehub_aff_price', true ); 
        $offer_price_old = get_post_meta( $post->ID, 'rehub_aff_price_old', true );
        if ( !empty($product_price)) :?>
            <div class="price_col">
                <p><span class="price_count"><ins><?php echo $product_price ;?></ins><?php if($offer_price_old !='') :?> <del><?php echo $offer_price_old ; ?></del><?php endif ;?></span></p>                        
            </div>
        <?php endif ;?>                     
        <div class="buttons_col">
            <div class="priced_block">
            <?php $offer_btn_text = get_post_meta( $post->ID, 'rehub_aff_btn_text', true ) ?>
            <?php $offer_coupon = get_post_meta( $post->ID, 'rehub_aff_coupon', true ) ?>
            <?php $offer_coupon_date = get_post_meta( $post->ID, 'rehub_aff_coupon_date', true ) ?>
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
                <div><a class="btn_offer_block" href="<?php the_permalink(); ?>"><?php if($offer_btn_text !='') :?><?php echo $offer_btn_text ; ?><?php elseif(rehub_option('rehub_btn_text') !='') :?><?php echo rehub_option('rehub_btn_text') ; ?><?php else :?><?php _e('Buy this item', 'rehub_framework') ?><?php endif ;?></a></div>
            </div>
        </div>
        <?php if(!empty($offer_coupon)) : ?> 
            <div class="aff_grid_bottom">
                <div class="rehub_offer_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>"><i class="fa fa-scissors fa-rotate-180"></i><input value="<?php echo $offer_coupon ?>" ></div>   
                <?php if(!empty($offer_coupon_date)) {echo '<div class="time_offer">'.$coupon_text.'</div>';} ?>
            </div>
        <?php endif ;?> 

</div>
<?php $i++; endwhile; // end of the loop.    ?> 
<div class="clearfix"></div>