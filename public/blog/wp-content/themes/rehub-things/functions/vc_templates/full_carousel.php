<?php 
    $base = $tag = $fetch  = '';
    extract(shortcode_atts(array(
        'base' => '',
        'tag' => '',
        'fetch' => '4',
    ), $atts));                 
?>
<?php if( !is_paged()) : ?>
<?php wp_enqueue_script('carouFredSel'); ?>
<!-- Carousel -->
    <div class="home_carousel loading">    
        <div id="home_carousel">
            <a href="/" class="controls prev" id="prev2"></a>

            <div class="container">
                <div class="carousel-block">
                    <?php 
                        if ($base == '1') {
                            $home_carousel = new WP_Query(array('showposts' => $fetch, 'meta_key' => 'is_editor_choice', 'meta_value' => '1', 'ignore_sticky_posts' => 1 ));
                        }
                        elseif ($tag !=''){
                            $home_carousel = new WP_Query(array('showposts' => $fetch, 'tag' => $tag, 'ignore_sticky_posts' => 1 ));
                        }
                        else {
                            $home_carousel = new WP_Query(array('showposts' => $fetch, 'ignore_sticky_posts' => 1 ));
                        } 
                        $i = 0;   
                        if( $home_carousel->have_posts() ) :
                        while($home_carousel->have_posts()) : $home_carousel->the_post(); $i++;
                    ?>
                    <?php $category = get_the_category(get_the_ID()); $first_cat = $category[0]->term_id; ?>
                    <div class="preview tabcat">
                        <figure>
                            <?php rehub_formats_icons() ?><?php rehub_permalink() ;?><?php wpsm_thumb ('video_big') ?></a>
                        </figure> 
                        <div class="text-oncarousel">
                            <h3><span class="count_carousel"><?php echo $i;?>. </span> <?php rehub_permalink() ;?><?php the_title();?></a></h3>
                            <div class="rcnt_meta"><?php meta_small( false, $first_cat, true, false ); ?></div>
                        </div>                       
                    </div>
                    <?php endwhile; endif; wp_reset_query(); ?>
                </div>
            </div>
            <a href="/" class="controls next" id="next2"></a>            
        </div>
    </div>     
<!-- End Carousel -->
<?php endif ; ?>