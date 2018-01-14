<?php

	/* Template Name: Page for visual layout builder */

?>
<?php 
    $header_disable = vp_metabox('vcr.header_disable');
    $footer_disable = vp_metabox('vcr.footer_disable');
    $content_type = vp_metabox('vcr.content_type');
    if ($content_type =='def') {$content_type = '';}      
?>
<?php if ($header_disable =='1') :?>
<!DOCTYPE html>
<!--[if IE 8]>    <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)] <?php language_attributes(); ?>><![endif]-->
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width" />
<!-- Title -->
<title><?php wp_title("", true, 'right'); ?></title>
<!-- feeds & pingback -->
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- favicon -->
<?php if(rehub_option('rehub_favicon_144')) : ?>
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo rehub_option('rehub_favicon_144'); ?>">
<?php endif; ?>
<?php if(rehub_option('rehub_favicon_114')) : ?>
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo rehub_option('rehub_favicon_114'); ?>">
<?php endif; ?>
<?php if(rehub_option('rehub_favicon_72')) : ?>
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo rehub_option('rehub_favicon_72'); ?>">
<?php endif; ?>
<?php if(rehub_option('rehub_favicon_57')) : ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo rehub_option('rehub_favicon_57'); ?>">
<?php endif; ?>
<?php if(rehub_option('rehub_favicon')) : ?>
<link rel="shortcut icon" href="<?php echo rehub_option('rehub_favicon'); ?>"  type="image/x-icon" />
<?php endif; ?>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script><![endif]-->	
<?php if(is_single())  : ?> 
<script type="text/javascript"> 
  /* <![CDATA[ */
  var rehub = {"ajaxurl":"<?php echo admin_url('admin-ajax.php'); ?>" , "your_rating":"<?php _e( 'Your Rating:' , 'rehub_framework' ) ?>"};
  /* ]]> */ 
</script>
<?php endif; ?>
<?php wp_head(); ?>
<?php if(rehub_option('rehub_custom_css')) : ?><style><?php echo rehub_option('rehub_custom_css'); ?></style><?php endif; ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part('inc/parts/branded_bg'); ?>
<?php get_template_part('inc/parts/branded_banner'); ?>	
<!-- HEADER -->	
<?php else :?>
<?php get_header(); ?>
<?php endif ;?>

    <!-- CONTENT -->
    <div class="content <?php echo $content_type ?>">     
		<div class="clearfix">
		    <!-- Main Side -->
            <div class="main-side visual_page_builder page_builder clearfix full_width">
					
					<!-- CONTENT -->
					<?php while (have_posts()) : the_post(); ?>
						<?php the_content();?>
					<?php endwhile; ?>

			</div>	
            <!-- /Main Side -->   
        </div>
    </div>
    <!-- /CONTENT -->     
<!-- FOOTER -->
<?php if ($footer_disable =='1') :?>
<?php if(rehub_option('rehub_analytics')) : ?><?php echo rehub_option('rehub_analytics'); ?><?php endif; ?>
<a href="#top_ankor" class="rehub_scroll" id="topcontrol"><i class="fa fa-chevron-up"></i></a>
<?php wp_footer(); ?>
</body>
</html>
<?php else :?>
<?php get_footer(); ?>
<?php endif ;?>