<?php get_header(); ?>
    <!-- CONTENT -->
    <div class="content"> 
		<div class="clearfix">
		    <!-- Main Side -->
            <div class="main-side single edd_single<?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?> full_width<?php endif; ?> clearfix">                  
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="post" id="post-<?php the_ID(); ?>" itemtype="http://schema.org/Product" itemscope="">  
                    <h1 itemprop="name"><?php the_title_attribute(); ?></h1>
                    <?php get_template_part('inc/parts/top_image'); ?>
                    <?php the_content(''); ?>     
                </article>
                <div class="clearfix"></div>
                <?php if(rehub_option('rehub_disable_share') =='1' || (vp_metabox('rehub_post_side.disable_parts') == '1' && vp_metabox('rehub_post_side.show_share_buttons') == '1'))  : ?>
                <?php else :?>
                    <?php get_template_part('inc/parts/post_share'); ?>   
                <?php endif; ?>                    
            <?php endwhile; endif; ?>
			</div>	
            <!-- /Main Side -->  
            <!-- Sidebar -->
            <?php if(vp_metabox('rehub_post_side.post_size') == 'full_post') : ?><?php else : ?><?php get_sidebar(); ?><?php endif; ?>
            <!-- /Sidebar --> 
        </div>
    </div>
    <!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>