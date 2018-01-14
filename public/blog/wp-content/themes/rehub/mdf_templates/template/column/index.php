<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php global $mdf_loop; MDTF_SORT_PANEL::mdtf_catalog_ordering();?>
<div class="clearfix"></div>
<?php $i=1; while ($mdf_loop->have_posts()) : $mdf_loop->the_post(); ?>
<article class="column_grid<?php if (($i % 3) == '0') :?> last-col<?php endif ?><?php if (($i % 3) == '1') :?> first-col<?php endif ?>">
    <figure>             
        <a href="<?php the_permalink();?>"><?php wpsm_thumb ('news_big') ?></a>
    </figure>
    <div class="content_constructor">
        <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
        <div class="rehub_catalog_desc">                                 
            <?php kama_excerpt('maxchar=120'); ?>                       
        </div>
    </div>
</article>
<?php $i++; endwhile; // end of the loop.    ?> 
<div class="clearfix"></div>