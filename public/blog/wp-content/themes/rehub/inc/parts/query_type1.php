<div class="news clearfix<?php if(is_sticky()) {echo " sticky";} ?>">
    <figure>
        <div class="pattern"></div>
        <?php rehub_formats_icons('full'); ?>
        <a href="<?php the_permalink();?>"><?php wpsm_thumb ('grid_news') ?></a>
    </figure>
    <div class="detail">
	    <h3><?php if(is_sticky()) {echo "<i class='fa fa-thumb-tack'></i>";} ?><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	    <?php if (rehub_option('exclude_comments_meta') == 0) : ?><?php comments_popup_link( 0, 1, '%', 'comment_two', ''); ?><?php endif ;?>
	    <?php $category = get_the_category(); if ($category) {$first_cat = $category[0]->term_id;} ?>
	    <div class="post-meta"> <?php if ($category) {meta_all( true, $first_cat, true );} ?> </div>
	    <?php rehub_format_score('small') ?>
	    <p><?php kama_excerpt('maxchar=180'); ?></p>
		<?php rehub_create_btn('yes') ;?>     
    </div>
</div>