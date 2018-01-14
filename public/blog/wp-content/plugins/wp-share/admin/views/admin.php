<?php
/**
 * Administration dashboard.
 * @package   WP_Share
 * @author    Alex Ilie <me@wpshare.co>
 * @license   GPL-2.0+
 * @link      http://wpshare.com
 * @copyright 2014 Alex Ilie
 */
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<?php
			$active_tab = 'share-options';
	?>

	<h2 class="nav-tab-wrapper">
		<a href="?page=wp-share&tab=share-options" class="nav-tab <?php echo 'share-options' == $active_tab || $this->plugin_slug == $active_tab ? 'nav-tab-active' : ''; ?>"><?php _e( 'Share', $this->plugin_slug ); ?></a>
	</h2>

	<form method="post" action="options.php">
		<?php

		settings_fields( 'share-options' );
		do_settings_sections( 'share-options' );

		submit_button();

		?>
	</form>

</div>
