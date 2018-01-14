<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php global $mdf_loop; MDTF_SORT_PANEL::mdtf_catalog_ordering();?>
<div class="clearfix"></div>
<?php  wp_enqueue_script('masonry'); wp_enqueue_script('imagesloaded'); wp_enqueue_script('masonry_init');?>
<div class="masonry_grid_fullwidth two-col-gridhub">
    <?php global $more; $more = 0;  while ($mdf_loop->have_posts()) : $mdf_loop->the_post(); ?>
        <?php include(locate_template('inc/parts/query_type3.php')); ?>
    <?php endwhile; // end of the loop.    ?>
</div> 
<div class="clearfix"></div>