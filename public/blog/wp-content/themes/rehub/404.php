<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side clearfix">
            <div class="post errorpage">				
                <span class="error-text"><?php _e('Houston, we have a problem.', 'rehub_framework'); ?></span>
                <h2>404</h2>
                <span class="error-text"><?php _e('The page you are looking for has not been found.', 'rehub_framework'); ?></span>			
            </div>				
        </div>	
        <!-- /Main Side -->
        <!-- Sidebar -->
        <?php get_sidebar(); ?>
        <!-- /Sidebar --> 
    </div>
</div>
<!-- /CONTENT -->     
<!-- FOOTER -->
<?php get_footer(); ?>