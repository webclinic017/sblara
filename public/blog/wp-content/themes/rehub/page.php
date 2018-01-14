<?php get_header(); ?>
<!-- CONTENT -->
<div class="content"> 
    <?php if(rehub_option('rehub_featured_toggle') && is_front_page() && !is_paged()) : ?>
        <?php get_template_part('inc/parts/featured'); ?>
    <?php endif; ?>
    <?php if(rehub_option('rehub_homecarousel_toggle') && is_front_page() && !is_paged()) : ?>
        <?php get_template_part('inc/parts/home_carousel'); ?>
    <?php endif; ?>
    <div class="clearfix">
          <!-- Main Side -->
          <div class="main-side page clearfix">
            <div class="title"><h1><?php the_title(); ?></h1></div>
            <article class="post" id="page-<?php the_ID(); ?>">       
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'rehub_framework' ), 'after' => '</div>' ) ); ?>
            <?php endwhile; endif; ?>      
            </article>
            <?php if ( get_the_author_meta( 'google' ) ){ ?>
                <div class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><a href="<?php the_author_meta( 'google' ); ?>?rel=author">+<?php echo get_the_author(); ?></a></strong></div>
            <?php }else{ ?>
                <div class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong></div>
            <?php } ?>             
            <?php comments_template(); ?>
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