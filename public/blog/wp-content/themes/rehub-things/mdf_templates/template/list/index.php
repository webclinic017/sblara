<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php global $mdf_loop; MDTF_SORT_PANEL::mdtf_catalog_ordering();?>
<div class="clearfix"></div>



    <?php $i=1; while ($mdf_loop->have_posts()) : $mdf_loop->the_post(); ?>
<div class="news clearfix<?php if(is_sticky()) {echo " sticky";} ?>">
    <figure>
        <div class="pattern"></div>
        <?php rehub_formats_icons('full'); ?>
        <a href="<?php the_permalink();?>"><?php wpsm_thumb ('grid_news') ?></a>
    </figure>
    <div class="detail">
        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment_two', ''); ?><?php endif ;?>
        <div class="clearfix"></div>
        <?php rehub_format_score('small') ?>
        <p><?php kama_excerpt('maxchar=180'); ?></p>
        <?php rehub_create_btn('yes') ;?>    
    </div>
</div>   
    <?php $i++; endwhile; // end of the loop.    ?>    
    


