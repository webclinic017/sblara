<?php 
	$title_enable = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_toggle_title');
	$title_name = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_title');
	$title_position = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_title_position');
	$title_url_title = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_url_text');
	$title_url_url = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_url_url');
	$module_fetch = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_mod_fetch');
	$module_type = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_mod_type');
    $product_cat = vp_metabox('mag_builder_page.pagebuilders.'.$pbid.'.woo_mod.0.woo_cat');         		    
?>

<?php title_custom_block ($title_enable, $title_name, $title_position, $title_url_title, $title_url_url) ?>
<?php wp_enqueue_script('carouFredSel'); ?>
<!--CAROUSEL SHOP-->
<div class="def-carousel shop_carousel woocommerce loading">
    <section class="clearfix">
        <ul class="gallery-pics shop-pics clearfix">
        <?php if ($module_type =='latest') :?>
            <?php            		
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'showposts' => $module_fetch
                );
            ?>
        <?php elseif ($module_type =='featured') :?>
            <?php            		
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'showposts' => $module_fetch,
                    'meta_key' => '_featured',
                    'meta_value' => 'yes'
                );
            ?>	    	    
        <?php elseif ($module_type =='best') :?> 
            <?php            		
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'showposts' => $module_fetch,
                    'meta_key' 		=> 'total_sales',
                    'orderby' 		=> 'meta_value'
                );
            ?>    	
        <?php else :?>	
            <?php            		
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'showposts' => $module_fetch
                );
            ?>	    	
        <?php endif ;?>
        <?php if ($product_cat !='') {$args['product_cat'] = $product_cat;} ?>
        <?php $products = new WP_Query( $args );                    
            if ( $products->have_posts() ) : ?>                      
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>           
                <li>
                    <div class="image_container imagechange3"> 
                    <a href="<?php the_permalink(); ?>" class="prodimglink">
                        <?php if ($product->is_on_sale()) : ?><div class="sale_tag"><?php _e('Sale!', 'rehub_framework')?></div><?php endif ?>
                        <div class="loop_product front"><?php echo get_the_post_thumbnail( $post->ID, 'news_big') ?></div>
                        <?php $attachment_ids = $product->get_gallery_attachment_ids();?>
                            <?php if ( $attachment_ids ) :?>					
                                <?php $loop = 0;					
                                foreach ( $attachment_ids as $attachment_id ) {
                                    $image_link = wp_get_attachment_url( $attachment_id );
                                    if ( ! $image_link )
                                        continue;
                                    $loop++;
                                    printf( '<div class="loop_products back">%s</div>', wp_get_attachment_image( $attachment_id, 'news_big' ) );
                                    if ($loop == 1) break;
                                }
                                ?>
                            <?php else : ?>
                            <div class="loop_products back"><?php echo get_the_post_thumbnail( $post->ID, 'news_big') ?></div>
                            <?php endif ;?>
                    </a>
                        <div class="clearfix"></div>						
                    </div>
                    <div class="product_details">
                        <?php $product_cats = strip_tags($product->get_categories('|||', '', '')); //Categories without links separeted by ||| ?>
                        <p class="cats_urls"> <a href="<?php the_permalink(); ?>"><?php list($firstpart) = explode('|||', $product_cats); echo $firstpart; ?></a></p>                    
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                        <?php
                            // Availability
                            $availability = $product->get_availability();
                            if ( $availability['availability'] )
                                echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
                        ?>
                        <?php if ( $product->is_in_stock() &&  $product->add_to_cart_url() !='') : ?>
                         <?php  echo apply_filters( 'woocommerce_loop_add_to_cart_link',
    							sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="quick_buy %s product_type_%s"%s>%s</a>',
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
                        <div class="clearfix"></div>
                    </div>
            </li>       
                <?php endwhile; // end of the loop. ?>                
            <?php            
            endif; 
            //wp_reset_query();
            wp_reset_postdata();
        ?>
        </ul>
    </section>
    <div class="carousel-prev"></div>
    <div class="carousel-next"></div>
</div>
