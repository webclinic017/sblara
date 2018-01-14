<?php     
    $module_exclude = rehub_option('rehub_exclude_posts');
    if(($module_exclude) == 1) {
            $exclude_posts = rehub_exclude_feature_posts();
    }
    else $exclude_posts = '';
?>
<?php wp_enqueue_script('carouFredSel');   ?>
<!-- Carousel -->
    <div class="home_carousel loading">    
        <?php if (rehub_option('rehub_homecarousel_label')=='1'): ?><div class="stamp <?php echo rehub_option('rehub_label_color');?>_stamp"><?php echo rehub_option('rehub_homecarousel_label_text');?></div><?php endif;?>
        <div id="home_carousel" <?php if (rehub_option('rehub_homecarousel_label')=='1'): ?>style="margin-top:2px"<?php endif;?>>
            <a href="/" class="controls prev" id="prev2"></a>

            <div class="container">
                <div class="carousel-block">
                    <?php $result_cat = array();
                        $tag_carousel = rehub_option('rehub_homecarousel_tag');
                        if (rehub_option('rehub_homecarousel_ed') == '1') {
                            $home_carousel = new WP_Query(array('showposts' => 10, 'post__not_in' => $exclude_posts, 'meta_key' => 'is_editor_choice', 'meta_value' => '1', 'ignore_sticky_posts' => 1 ));
                        }
                        elseif ($tag_carousel !=''){
                            $home_carousel = new WP_Query(array('showposts' => 10, 'post__not_in' => $exclude_posts, 'tag' => $tag_carousel, 'ignore_sticky_posts' => 1 ));
                        }
                        else {
                            $home_carousel = new WP_Query(array('showposts' => 10, 'post__not_in' => $exclude_posts, 'ignore_sticky_posts' => 1 ));
                        }    
                        if( $home_carousel->have_posts() ) :
                        while($home_carousel->have_posts()) : $home_carousel->the_post();
                    ?>
                    <div class="preview tabcat-<?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id; $result_cat[] = $first_cat; echo $first_cat; ?>">
                        <figure>
                            <span class="pattern"></span>
                            <?php rehub_formats_icons() ?><a href="<?php the_permalink();?>"><?php wpsm_thumb ('grid_news') ?></a>
                            <div class="text-overlay-oncarousel"><div class="rcnt_meta"><?php meta_small( false, $first_cat, false, false ); ?></div><h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3><?php rehub_format_score('small') ?><div class="views-in-carosel"><?php meta_small( false, false, true, false ); ?></div></div>
                        </figure>                        
                    </div>
                    <?php endwhile; endif; wp_reset_query(); ?>
                </div>
            </div>
            <a href="/" class="controls next" id="next2"></a>
            <?php 
                echo '<style scoped>';
                $category_ids = $result_cat;
                foreach($category_ids as $cat_id) { ?>      
                    <?php $cat_data = get_option("category_$cat_id"); ?>
                    <?php if (!empty($cat_data['cat_color'])) :?>
                        #home_carousel .tabcat-<?php echo $cat_id ;?> .text-overlay-oncarousel{border-bottom: 6px solid <?php echo $cat_data['cat_color'];?> !important; color:#fff !important; text-decoration: none;}
                    <?php else :?><?php endif;?>
                <?php }
                echo '</style>';
            ?>             
        </div>
    </div>     
<!-- End Carousel -->