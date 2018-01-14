<?php

    /* Template Name: Ecwid shop */

?>
<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side page clearfix">
            <article class="post" id="page-<?php the_ID(); ?>">					
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <?php the_content(); ?>
            <?php endwhile; endif; ?>               
            </article>
        </div>	
        <!-- /Main Side -->  
        <!-- Sidebar -->
        <aside class="sidebar">					
                    <!-- SIDEBAR WIDGET AREA -->
					<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-5' ); ?>
					<?php else : ?>
						<p><?php _e('No ecwid widgets added. Add text widget to ecwid widget area and insert widget code from ecwid account', 'rehub_framework'); ?></p>
					<?php endif; ?>                      				
        </aside>
        <!-- /Sidebar -->  
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>