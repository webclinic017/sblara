<?php
/**
 * WP Share
 *
 * @package   WP_Share_Admin
 * @author    Alex Ilie <me@wpshare.co>
 * @license   GPL-2.0+
 * @link      http://wpshare.com
 * @copyright 2014 Alex Ilie
 */

/**
 *
 * @package WP_Share_Admin
 * @author  Alex Ilie <me@wpshare.co>
 */
class WP_Share_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		$plugin = WP_Share::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// initialize the options
		$this->options = $plugin->get_share_settings();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add settings
		add_action( 'admin_init', array( $this, 'add_plugin_settings' ) );

		// Add metabox to post types
		add_action( 'add_meta_boxes', array( $this, 'add_share_post_metabox' ) );

		// Save metabox value for post types and attachments
		add_action( 'save_post', array( $this, 'save_share_post_metabox' ) );
		add_action( 'edit_attachment', array( $this, 'save_share_post_metabox' ) );

		// Add metabox to taxonomies
		// add_action( 'admin_init', array( $this, 'add_share_taxonomies_metabox' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), WP_Share::VERSION );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), WP_Share::VERSION );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/**
		 * Add a settings page for this plugin to the Settings menu.
		 */
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'WP Share', $this->plugin_slug ),
			__( 'WP Share', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

		/**
		 * Add Settings submenu
		 */
		add_submenu_page(
			$this->plugin_screen_hook_suffix,
			__( 'General', $this->plugin_slug ),
			__( 'General', $this->plugin_slug ),
			'manage_options',
			'share-options',
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Register the plugin settings
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_settings() {

		add_settings_section(
			'general_settings_section',
			__( 'Display Options', $this->plugin_slug ),
			array( $this, 'general_options_display' ),
			'share-options'
		);

		add_settings_field(
			'heading_text',
			__( 'Heading text', $this->plugin_slug ),
			array( $this, 'heading_text_callback' ),
			'share-options',
			'general_settings_section',
			array(
				__( 'Enter the heading/button text', $this->plugin_slug ),
			)
		);

		add_settings_field(
			'button_style',
			__( 'Button style', $this->plugin_slug ),
			array( $this, 'button_style_callback' ),
			'share-options',
			'general_settings_section',
			array(
				__( 'Choose the button style', $this->plugin_slug ),
			)
		);

		add_settings_field(
			'button_layout',
			__( 'Button Layout', $this->plugin_slug ),
			array( $this, 'button_layout_callback' ),
			'share-options',
			'general_settings_section',
			array(
				__( 'Drag and drop from <strong>Available services</strong> to <strong>Enabled services</strong> in order to activate the service.', $this->plugin_slug ),
			)
		);

		// Next, we'll introduce the fields for toggling the visibility of content elements.
		add_settings_field(
			'display_on',
			__( 'Display on', $this->plugin_slug ),
			array( $this, 'display_on_callback' ),
			'share-options',
			'general_settings_section',
			array(
				__( 'Activate this setting to display the header.', $this->plugin_slug ),
			)
		);

		// Finally, we register the fields with WordPress
		register_setting(
			'share-options',
			'share_options',
			array( $this, 'share_options_sanitize' )
		);
	}

	/**
	 * Share settings section subheading
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function general_options_display()	{
		_e( 'General plugin display options', $this->plugin_slug );
	}

	/**
	 * Renders the button style select
	 *
	 * @since 1.0.0
	 *
	 * @param  array $args  array containing the caption
	 * @return echos the button style html
	 */
	public function button_style_callback( $args ){
		if ( ! isset( $this->options['button_style'] ) ){
			$style = 'icon';
		} else {
			$style = $this->options['button_style'];
		}
		?>
		<label for="button-style"><?php echo $args[0]; ?></label><br>
		<select id="button-style" name="share_options[button_style]">
			<option value="icon" <?php selected( $style, 'icon' ); ?>>Icon</option>
			<option value="icon-text" <?php selected( $style, 'icon-text' ); ?>>Icon + Text</option>
			<option value="original" <?php selected( $style, 'original' ); ?>>Original button</option>
		</select>
		<?php
	}

	/**
	 * Render the heading text input
	 *
	 * @since  1.0.0
	 *
	 * @param  array $args
	 * @return output the item html
	 */
	public function heading_text_callback( $args ){
		if ( ! isset( $this->options['heading_text'] ) ){
			$heading_text = '';
		} else {
			$heading_text = $this->options['heading_text'];
		}
		?>
		<p><?php echo $args[0]; ?></p>
		<input type="text" name="share_options[heading_text]" value="<?php echo $heading_text; ?>">
		<?php
	}

	/**
	 * Render the button layout section
	 *
	 * @since  1.0.0
	 *
	 * @param  array $args
	 *
	 * @return null
	 */
	public function button_layout_callback( $args ){
		$plugin = WP_Share::get_instance();
		$available = $this->get_available_services();
		$enabled = $this->get_enabled_services();
		?>
		<p><?php echo $args[0]; ?></p>
		<h3><?php _e( 'Available services', $this->plugin_slug ); ?></h3>
		<ul id="available-services" class="services-connection">
			<?php foreach ( $available as $id => $service_class ) { ?>
				<?php
					if ( ! in_array( $id, $enabled ) && class_exists( $service_class ) ) {
						$service = new $service_class( $id );
				?>
							<li id="<?php echo $id; ?>" class="share-button-<?php echo $id; ?>"><?php echo $service->get_name(); ?></li>
				<?php } ?>
			<?php } ?>
		</ul>
		<h3><?php _e( 'Enabled services', $this->plugin_slug ); ?></h3>
		<ul id="enabled-services" class="services-connection">
			<?php	foreach ( $enabled as $id ) { ?>
				<?php
					if ( isset( $available[$id] ) && class_exists( $available[$id] ) ){
						$service = new $available[$id] ( $id );
				?>
					<li id="<?php echo $id; ?>" class="share-button-<?php echo $id; ?>"><?php echo $service->get_name(); ?></li>
					<?php } ?>
			<?php }	?>
		</ul>
		<input type="hidden" name="share_options[button_layout]" id="button-order" value="<?php echo implode( ',', $enabled ); ?>">
		<?php
	}

	/**
	 * Render the display on section
	 *
	 * @since  1.0.0
	 *
	 * @param  array $args
	 *
	 * @return null
	 */
	public function display_on_callback( $args ) {
		$plugin = WP_Share::get_instance();
		$objects = $plugin->get_objects();
		$display = $this->options['display_on'];

		foreach ( $objects as $type => $name ) {
			if ( ! isset( $display[$type] ) ) {
				$display[$type] = 0;
			}
			?>
			<p class="wp-share-admin-row">
				<label for="<?php echo $type; ?>"><?php echo $name; ?></label>
				<select id="<?php echo $type; ?>" name="share_options[display_on][<?php echo $type; ?>]">
					<option value="0" <?php selected( $display[$type], 0 ); ?>>Don't display</option>
					<option value="1" <?php selected( $display[$type], 1 ); ?>>Top</option>
					<option value="2" <?php selected( $display[$type], 2 ); ?>>Bottom</option>
					<option value="3" <?php selected( $display[$type], 3 ); ?>>Both</option>
				</select>
			</p>
			<?php
		}
	}

	/**
	 * Sanitize the share options on save
	 *
	 * @since 1.0.0
	 *
	 * @param  array  $share_options    the options before sanitizations
	 * @return array                    the sanitized options
	 */
	public function share_options_sanitize( $share_options ){

		$return = array();

		if ( isset( $share_options['display_on'] ) ){

			$display_on = $share_options['display_on'];

			foreach ( $display_on as $key => $value) {
				$return['display_on'][$key] = (int) $value;
			}

		}

		if ( isset( $share_options['button_layout'] ) ){
			$return['button_layout'] = explode( ',', $share_options['button_layout'] );
		}

		if ( isset( $share_options['heading_text'] ) ){
			$return['heading_text'] = sanitize_text_field( $share_options['heading_text'] );
		}

		if ( isset( $share_options['button_style'] ) ){
			$return['button_style'] = sanitize_text_field( $share_options['button_style'] );
		}

		return $return;
	}

	/**
	 * Get all the available sharing services
	 *
	 * @since    1.0.0
	 *
	 * @return   array    Returns an array of services where the key is the service id and value the service class
	 */
	private function get_available_services(){

		$plugin = WP_Share::get_instance();

		return $plugin->get_services();
	}

	/**
	 * Get the enabled sharing services
	 *
	 * @since    1.0.0
	 *
	 * @return   array     Returns an array of enabled services id
	 */
	private function get_enabled_services(){

		$plugin = WP_Share::get_instance();

		return $plugin->get_enabled_services();
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page( $active_tab = '' ) {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	 * Add the metabox option to the post types
	 *
	 * @since 1.0.0
	 */
	public function add_share_post_metabox(){
		$plugin = WP_Share::get_instance();
		$types = array_keys( $plugin->get_post_types() );

		foreach ( $types as $type ) {
			add_meta_box(
				'wp-share-options',
				__( 'Sharing Buttons', $this->plugin_slug ),
				array( $this, 'display_share_post_metabox'),
				$type,
				'side',
				'core'
			);
		}
	}

	/**
	 * Render the post metabox
	 *
	 * @since 1.0.0
	 *
	 * @param  object $post   the post object
	 * @return outputs the metabox html
	 */
	public function display_share_post_metabox( $post ) {
		wp_nonce_field( 'wp_share_post_display', 'wp_share_post_display_nonce' );
		?>
		<label for="display-sharing_buttons">
			<input type="checkbox" id="display-sharing_buttons" value="1" name="wp_share_display" <?php checked( get_post_meta( $post->ID, '_display_sharing_buttons', true ), '1' ); ?>>
			<?php _e( 'Hide sharing buttons on this post?', $this->plugin_slug ); ?>
		</label>
		<?php
	}

	/**
	 * Save the sharing option when a post is saved
	 *
	 * @since  1.0.0
	 *
	 * @param  int    $post_id  The ID of the post being saved
	 */
	public function save_share_post_metabox( $post_id ) {

		// nonces check
		if ( ! isset( $_POST['wp_share_post_display_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['wp_share_post_display_nonce'];

		// verify if the nonce is valid
		if ( ! wp_verify_nonce( $nonce, 'wp_share_post_display' ) ) {
			return $post_id;
		}

		// do not save on autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		// save the data
		if ( isset( $_POST['wp_share_display'] ) ) {
			update_post_meta( $post_id, '_display_sharing_buttons', '1' );
		} else {
			update_post_meta( $post_id, '_display_sharing_buttons', '0' );
		}

	}

}
