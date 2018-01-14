<?php 
	$enable_pagination = $columns = $no_cloaking  = $data_source = $cat = $ids = $orderby = $order = $meta_key = $show = '';
	extract(shortcode_atts(array(
	    'enable_pagination' => '',
	    'columns' => '3_col',
        'enable_pagination' => '',
        'no_cloaking' => '',
        'data_source' => '',
        'cat' => '',
        'ids' => '',
        'orderby' => '',
        'order' => 'DESC',
        'meta_key' => '',
        'show' => '',
	), $atts));	
?>
<?php
	global $wp_query;
    if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
    if ($data_source == 'ids' && $ids !='') {
        $ids = explode(',', $ids);
        $args = array(
            'post_type' => 'thirstylink',
            'post__in' => $ids,
            'numberposts' => '-1',
            'orderby' => 'post__in',            
        );
    }
    else {
        $args = array(
            'post_type' => 'thirstylink',
            'posts_per_page'   => $show, 
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => 1,                  
        );
        if ($enable_pagination != '') {$args['paged'] = $paged;}
        if (($orderby == 'meta_value' || $orderby == 'meta_value_num') && $meta_key !='') {$args['meta_key'] = $meta_key;}
        if ($data_source == 'cat' && $cat !='') {
            $cat = explode(',', $cat);
            $args['tax_query'] = array(array('taxonomy' => 'thirstylink-category', 'terms' => $cat, 'field' => 'id'));             
        }
    }    
	$wp_query = new WP_Query($args);
?>
<?php $i=1; if($wp_query->have_posts()): while($wp_query->have_posts()): $wp_query->the_post(); ?>
<?php $linkData = unserialize(get_post_meta(get_the_ID(), 'thirstyData', true)); 
$link = ($no_cloaking !='') ? $linkData['linkurl'] : get_the_permalink() ;
?>
<?php   $attachments = get_posts( array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'post_parent' => get_the_ID(),
) );
if (!empty($attachments)) {$aff_thumb_list = wp_get_attachment_url( $attachments[0]->ID );} else {$aff_thumb_list ='';}
$term_list = wp_get_post_terms(get_the_ID(), 'thirstylink-category', array("fields" => "names")); 
$term_ids =  wp_get_post_terms(get_the_ID(), 'thirstylink-category', array("fields" => "ids")); if (!empty($term_ids)) {$term_brand = $term_ids[0]; $term_brand_image = get_option("taxonomy_term_$term_ids[0]");} else {$term_brand_image ='';}
?>
<div class="rehub_feat_block table_view_block">
    <?php if (get_post_meta( get_the_ID(), 'rehub_aff_sticky', true) == '1') :?><div class="vip_corner"><span class="vip_badge"><i class="fa fa-thumbs-o-up"></i></span></div><?php endif ?> 
    <div class="block_with_coupon">
        <div class="offer_thumb">
        <a href="<?php echo $link; ?>" target="_blank">
            <?php if (!empty($aff_thumb_list) ) :?> 
                <img src="<?php $params = array( 'width' => 120, 'height' => 90 ); echo bfi_thumb( $aff_thumb_list, $params ); ?>" alt="<?php the_title_attribute(); ?>" />
            <?php elseif (!empty($term_brand_image['brand_image'])) :?>
                <img src="<?php $params = array( 'width' => 120, 'height' => 90 ); echo bfi_thumb( $term_brand_image['brand_image'], $params ); ?>" alt="<?php the_title_attribute(); ?>" />
            <?php else :?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/default/noimage_100_70.png" alt="<?php the_title_attribute(); ?>" />
            <?php endif?>
        </a>    
        </div>
        <div class="desc_col">
            <div class="offer_title"><a href="<?php echo $link; ?>" target="_blank"><?php the_title(); ?></a></div>
            <p><?php echo get_post_meta( get_the_ID(), 'rehub_aff_desc', true );?></p>
            <?php $rehub_aff_review_related = get_post_meta( get_the_ID(), "rehub_aff_rel", true ); if ( !empty($rehub_aff_review_related)) : ?>
                <a href="<?php echo $rehub_aff_review_related; ?>" target="_blank" class="color_link"><?php _e("Read review", "rehub_framework") ;?></a>    
            <?php endif; ?>
        </div>
        <?php 
        $product_price = get_post_meta( get_the_ID(), 'rehub_aff_price', true ); 
        $offer_price_old = get_post_meta( get_the_ID(), 'rehub_aff_price_old', true );
        if ( !empty($product_price) || !empty($term_list[0])) :?>
            <div class="price_col">
                <p><span class="price_count"><ins><?php echo $product_price ;?></ins><?php if($offer_price_old !='') :?> <del><?php echo $offer_price_old ; ?></del><?php endif ;?></span></p>                         
                <div class="aff_tag">
                    <?php if (!empty($term_brand_image['brand_image'])) :?>
                        <img src="<?php $params = array( 'width' => 120, 'height' => 90 ); echo bfi_thumb( $term_brand_image['brand_image'], $params ); ?>" alt="<?php the_title_attribute(); ?>" />
                    <?php elseif (!empty($term_list[0])) :?> 
                        <?php echo $term_list[0]; ?>
                    <?php endif; ?>          
                </div>
            </div>
        <?php endif ;?>                     
        <div class="buttons_col">
            <div class="priced_block">
            <?php $offer_btn_text = get_post_meta( get_the_ID(), 'rehub_aff_btn_text', true ) ?>
            <?php $offer_coupon = get_post_meta( get_the_ID(), 'rehub_aff_coupon', true ) ?>
            <?php $offer_coupon_date = get_post_meta( get_the_ID(), 'rehub_aff_coupon_date', true ) ?>
            <?php $offer_coupon_mask = get_post_meta( get_the_ID(), 'rehub_aff_coupon_mask', true ) ?>
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
                <div><a class="btn_offer_block" href="<?php echo $link; ?>"><?php if($offer_btn_text !='') :?><?php echo $offer_btn_text ; ?><?php elseif(rehub_option('rehub_btn_text') !='') :?><?php echo rehub_option('rehub_btn_text') ; ?><?php else :?><?php _e('Buy this item', 'rehub_framework') ?><?php endif ;?></a></div>
                <?php if(!empty($offer_coupon)) : ?> 
                    <?php wp_enqueue_script('zeroclipboard'); ?>
                    <div class="aff_grid_bottom">
                        <?php if ($offer_coupon_mask !='1') :?>
                            <div class="rehub_offer_coupon not_masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>"><i class="fa fa-scissors fa-rotate-180"></i><span class="coupon_text"><?php echo $offer_coupon ?></span></div>   
                        <?php else :?>
                            <div class="rehub_offer_coupon masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>" data-codeid="<?php echo get_the_ID()?>" data-dest="<?php echo $link; ?>"><?php if(rehub_option('rehub_mask_text') !='') :?><?php echo rehub_option('rehub_mask_text') ; ?><?php else :?><?php _e('Reveal coupon', 'rehub_framework') ?><?php endif ;?><i class="fa fa-external-link-square"></i></div>   
                        <?php endif;?>                                   
                        <?php if(!empty($offer_coupon_date)) {echo '<div class="time_offer">'.$coupon_text.'</div>';} ?>
                    </div>
                <?php endif ;?>
            </div>
        </div>
    </div>
</div>

                                          
<?php $i++; endwhile; ?>
<?php else : ?>		
<div class="heading"><h5><?php _e('Sorry. No posts in this category yet', 'rehub_framework'); ?></h5></div>				   
<?php endif; ?>

<?php if ($enable_pagination != '') :?>
    <?php rehub_pagination();?>
<?php endif ;?>
<?php wp_reset_query(); ?>