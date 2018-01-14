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
<?php if(rehub_option('rehub_ads_megatop') !='') : ?>
	<div class="megatop_wrap">
		<div class="mediad megatop_mediad">
			<?php echo do_shortcode(rehub_option('rehub_ads_megatop')); ?>
		</div>
	</div>
<?php endif ;?>	
<!-- HEADER -->
<header id="main_header"<?php if(rehub_option('rehub_headercolor_style') =='1') : ?> class="dark_header"<?php endif; ?>>
<div class="top_line_header<?php if(rehub_option('rehub_header_style') =='header_five') : ?> header_menu_row<?php endif; ?>">
  <div id="top_ankor"></div>
<?php if(rehub_option('rehub_header_top') !='1')  : ?>  
  <!-- top -->  
  <div class="header_top_wrap">
    <div class="header-top clearfix">
      <?php wp_nav_menu( array( 'container_class' => 'top-nav', 'container' => 'div', 'theme_location' => 'top-menu', 'fallback_cb' => 'add_top_menu_for_blank', 'depth' => '1'  ) ); ?>
      <div class="top-social"> 
        <?php if(rehub_option('rehub_header_style') != 'header_first') : ?><div class="search top_search responsive_search"><?php get_search_form(); ?></div><?php endif; ?>
			    <?php if(rehub_option('rehub_header_social')) : ?>
          	<?php rehub_get_social_links('small');?>  
        	<?php endif; ?>        
          <?php global $woocommerce; ?>
          <?php if ($woocommerce && rehub_option('exclude_cart_header') !='1') : ?><a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i> <?php _e( 'Cart', 'rehub_framework' ); ?> (<?php echo $woocommerce->cart->cart_contents_count; ?>) - <?php echo $woocommerce->cart->get_cart_total(); ?></a><?php endif; ?>
      </div>
    </div>
  </div>
  <!-- /top --> 
<?php endif; ?>
  <!-- Logo section -->
  <div class="logo-section <?php echo rehub_option('rehub_header_style') ;?>_style clearfix">
    <div class="logo">
  		<?php if(rehub_option('rehub_logo')) : ?>
  			<a href="<?php echo home_url(); ?>"><img src="<?php echo rehub_option('rehub_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
  		<?php elseif (rehub_option('rehub_text_logo')) : ?>
        <div class="textlogo"><?php echo rehub_option('rehub_text_logo'); ?></div>
        <div class="sloganlogo">
          <?php if(rehub_option('rehub_text_slogan')) : ?><?php echo rehub_option('rehub_text_slogan'); ?><?php else : ?><?php bloginfo( 'description' ); ?><?php endif; ?>
        </div> 
      <?php else : ?>
  			<div class="textlogo"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></div>
        <div class="sloganlogo"><?php bloginfo( 'description' ); ?></div>
  		<?php endif; ?> 
      <?php if( rehub_option( 'logo_retina' ) && rehub_option( 'logo_retina_width' ) && rehub_option( 'logo_retina_height' )): ?>
      <script type="text/javascript">
      jQuery(document).ready(function($) {
        var retina = window.devicePixelRatio > 1 ? true : false;
        if(retina) {
              jQuery('header .logo img').attr('src', '<?php echo rehub_option( 'rehub_logo_retina' ); ?>');
              jQuery('header .logo img').attr('width', '<?php echo rehub_option( 'rehub_logo_retina_width' ); ?>');
              jQuery('header .logo img').attr('height', '<?php echo rehub_option( 'rehub_logo_retina_height' ); ?>');
        }
      });
      </script>
      <?php endif; ?>      
    </div>
    <?php if(rehub_option('rehub_header_style') == 'header_first') : ?><div class="search head_search"><?php get_search_form(); ?></div><?php endif; ?>
    <?php if(rehub_option('rehub_header_style') != 'header_third') : ?><?php if(rehub_option('rehub_ads_top')) : ?><div class="mediad"><?php echo do_shortcode(rehub_option('rehub_ads_top')); ?></div><?php endif; ?><?php endif; ?>
  </div>
  <!-- /Logo section -->  
  <!-- Main Navigation -->
  <div class="main-nav">
    <?php wp_nav_menu( array( 'container_class' => 'top_menu', 'container' => 'nav', 'theme_location' => 'primary-menu', 'fallback_cb' => 'add_menu_for_blank', 'walker' => new Rehub_Walker ) ); ?>
    <div class="responsive_nav_wrap"></div>
  </div>
  <!-- /Main Navigation -->
</div>  
</header>
<?php get_template_part('inc/parts/branded_banner'); ?>
<?php get_template_part('inc/parts/news_ticker'); ?>