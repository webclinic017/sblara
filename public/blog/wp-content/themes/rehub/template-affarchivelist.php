<?php

    /* Template Name: Offer archive list */

?>
<?php 
    $module_cats = vp_metabox('rehub_aff_archive.aff_archive_cat');
    $module_fetch = vp_metabox('rehub_aff_archive.aff_archive_fetch');
    if ($module_fetch ==''){$module_fetch = '10';};      
?>
<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <?php if(rehub_option('rehub_featured_toggle') && is_front_page()) : ?>
        <?php get_template_part('inc/parts/featured'); ?>
    <?php endif; ?>
    <?php if(rehub_option('rehub_homecarousel_toggle') && is_front_page()) : ?>
        <?php get_template_part('inc/parts/home_carousel'); ?>
    <?php endif; ?> 
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix">
            <div class="title"><h1><?php the_title(); ?></h1></div>
            <?php if (!is_paged()) :?>
                <article class="top_rating_text">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?><?php the_content(); ?><?php endwhile; endif; ?>
                </article>
                <div class="clearfix"></div>
            <?php endif; ?>
            <article class="post">
            <?php if(class_exists('MetaDataFilterPage')) :?> <?php echo do_shortcode('[mdf_sort_panel]'); ?><div class="clearfix"></div><?php endif; ?>
            <?php $temp = $wp_query; $wp_query = null; ?>

            <?php $args = array( 
                'thirstylink-category' => $module_cats, 
                'post_type' => 'thirstylink',
                'posts_per_page' => $module_fetch, 
                'meta_key' => 'rehub_aff_sticky',
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'paged' => $paged
            );
            ?> 
            <?php  
            if(class_exists('MetaDataFilter') AND MetaDataFilter::is_page_mdf_data()){   
                $_REQUEST['mdf_do_not_render_shortcode_tpl'] = true;
                $_REQUEST['mdf_get_query_args_only'] = true;
                do_shortcode('[meta_data_filter_results]');
                $args = $_REQUEST['meta_data_filter_args'];
                global $wp_query;
                $wp_query=new WP_Query($args);
                $_REQUEST['meta_data_filter_found_posts']=$wp_query->found_posts;
            }
            else {$wp_query = new WP_Query($args);} 
            if($wp_query->have_posts()): while($wp_query->have_posts()): $wp_query->the_post(); ?>

                
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
                <div class="rehub_feat_block table_view_block">
                    <?php if (get_post_meta( $post->ID, 'rehub_aff_sticky', true) == '1') :?><div class="vip_corner"><span class="vip_badge"><i class="fa fa-thumbs-o-up"></i></span></div><?php endif ?> 
                    <div class="block_with_coupon">
                        <div class="offer_thumb">
                        <a href="<?php the_permalink(); ?>" target="_blank">
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
                            <div class="offer_title"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></div>
                            <p><?php echo get_post_meta( $post->ID, 'rehub_aff_desc', true );?></p>
                            <?php $rehub_aff_review_related = get_post_meta( $post->ID, "rehub_aff_rel", true ); if ( !empty($rehub_aff_review_related)) : ?>
                                <a href="<?php echo $rehub_aff_review_related; ?>" target="_blank" class="color_link"><?php _e("Read review", "rehub_framework") ;?></a>    
                            <?php endif; ?>
                        </div>
                        <?php 
                        $product_price = get_post_meta( $post->ID, 'rehub_aff_price', true ); 
                        $offer_price_old = get_post_meta( $post->ID, 'rehub_aff_price_old', true );
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
                            <?php $offer_btn_text = get_post_meta( $post->ID, 'rehub_aff_btn_text', true ) ?>
                            <?php $offer_coupon = get_post_meta( $post->ID, 'rehub_aff_coupon', true ) ?>
                            <?php $offer_coupon_date = get_post_meta( $post->ID, 'rehub_aff_coupon_date', true ) ?>
                            <?php $offer_coupon_mask = get_post_meta( $post->ID, 'rehub_aff_coupon_mask', true ) ?>
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
                                <?php if(!empty($offer_coupon)) : ?> 
                                    <?php wp_enqueue_script('zeroclipboard'); ?>
                                    <div class="aff_grid_bottom">
                                        <?php if ($offer_coupon_mask !='1') :?>
                                            <div class="rehub_offer_coupon not_masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>"><i class="fa fa-scissors fa-rotate-180"></i><span class="coupon_text"><?php echo $offer_coupon ?></span></div>   
                                        <?php else :?>
                                            <div class="rehub_offer_coupon masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>" data-codeid="<?php echo $post->ID?>" data-dest="<?php the_permalink(); ?>"><?php if(rehub_option('rehub_mask_text') !='') :?><?php echo rehub_option('rehub_mask_text') ; ?><?php else :?><?php _e('Reveal coupon', 'rehub_framework') ?><?php endif ;?></div>   
                                        <?php endif;?>                                   
                                        <?php if(!empty($offer_coupon_date)) {echo '<div class="time_offer">'.$coupon_text.'</div>';} ?>
                                    </div>
                                <?php endif ;?>
                            </div>
                        </div>
                    </div>
                </div>

                                                          
            <?php endwhile; ?>
            <?php else : ?>		
                <div class="heading"><h5><?php _e('Sorry. No posts in this category yet', 'rehub_framework'); ?></h5></div>				   
            <?php endif; ?>
            <div class="pagination"><?php rehub_pagination();?></div>
            <?php $wp_query = null; $wp_query = $temp;  // Reset ?>
            <?php wp_reset_query(); ?>
            </article>
        </div>
        <!-- Sidebar -->
        <?php get_sidebar(); ?>
        <!-- /Sidebar -->         	
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>