<?php
/**
 * WP Share.
 *
 * @package   WP_Share
 * @author    Alex Ilie <me@wpshare.co>
 * @license   GPL-2.0+
 * @link      http://wpshare.com
 * @copyright 2014 Alex Ilie
 */

class WP_Share {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Plugin slug used for translation
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'wp-share';

	/**
	 * Contains the plugin options
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $options = array(
		'heading_text' => 'Share article',
		'button_style' => 'icon',
		'display_on' => array(),
		'button_layout' => array(),
		);

	/**
	 * The default services
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $services = array(
			'facebook'      => 'Service_Facebook',
			'linkedin'      => 'Service_LinkedIn',
			'twitter'       => 'Service_Twitter',
			'google-plus'   => 'Service_GooglePlus',
			'pinterest'     => 'Service_Pinterest',
		);

	/**
	 * Contains all the relevant post types in the WordPress install
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $post_types = array();

	/**
	 * Contains all the taxonomies in the WordPress install
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	protected $taxonomies = array();

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		$this->options = get_option( 'share_options', $this->options );

		$this->services = apply_filters( 'sharing_services', $this->services );

		add_action( 'after_setup_theme', array( $this, 'get_objects' ), 99 );

		add_filter( 'the_content', array( $this, 'render' ), 99 );
		add_filter( 'the_excerpt', array( $this, 'render' ), 99 );

		// sharing shortcode
		add_shortcode( 'sharing_buttons', array( $this, 'sharing_buttons') );

	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return the sharing settings.
	 *
	 * @since    1.0.0
	 *
	 * @return    sharing settings.
	 */
	public function get_share_settings() {
		return $this->options;
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
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-styles', plugins_url( 'assets/css/wpshare.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-script', plugins_url( 'assets/js/wpshare.js', __FILE__ ), array( 'jquery' ), self::VERSION );
	}

	/**
	 * Returns all valid post types
	 *
	 * @since    1.0.0
	 *
	 * @return   array
	 */
	public function get_post_types() {

		// get the post types including custom
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		$post_types = wp_list_pluck( $post_types, 'labels' );
		$post_types = wp_list_pluck( $post_types, 'name' );

		return $post_types;
	}

/**
	 * Returns all valid taxonomies
	 *
	 * @since    1.0.0
	 *
	 * @return   array
	 */
	public function get_taxonomies() {

		// get the taxonomies including custom
		$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );
		$taxonomies = wp_list_pluck( $taxonomies, 'label' );

		return $taxonomies;
	}

	/**
	 * Returns all valid post types and taxonomies
	 *
	 * @since    1.0.0
	 *
	 * @return   array
	 */
	public function get_objects() {

		// retrieve post types
		$this->post_types = $this->get_post_types();

		// retrieve taxonomies
		$this->taxonomies = $this->get_taxonomies();

		return array_merge( $this->post_types, $this->taxonomies );
	}

	/**
	 * Returns the available services
	 *
	 * @since 1.0.0
	 *
	 * @return array Returns an array of available services id
	 */
	public function get_services() {
		return $this->services;
	}

	/**
	 * Get the enabled sharing services
	 *
	 * @since    1.0.0
	 *
	 * @return   array     Returns an array of enabled services id
	 */
	public function get_enabled_services() {
		if ( ! isset( $this->options['button_layout'] ) ){
			return array();
		}
		return $this->options['button_layout'];
	}

	/**
	 * Find out the current content context
	 *
	 * @since 1.0.0
	 *
	 * @return string the content type, e.g. post, page, category
	 */
	private function content_type() {
		if ( is_singular() ) {
			// check if button should be hidden
			if ( get_post_meta( get_the_id(), '_display_sharing_buttons', true ) ) {
				return false;
			}
			return get_post_type();
		}
		if ( is_tax() ) {
			global $wp_query;
			$tax =	$wp_query->queried_object->taxonomy;
			return $tax;
		}
		if ( is_category() ) {
			return 'category';
		}
		if ( is_tag() ) {
			return 'post_tag';
		}
	}

	/**
	 * Determines the button position
	 *
	 * @since 1.0.0
	 *
	 * @return int the position of the sharing buttons
	 */
	private function content_location() {
		$type = $this->content_type();

		if ( ! $type ) {
			return 0;
		}

		$display = $this->options['display_on'];
		if ( !is_array( $display ) || 1 > count( $display ) ) {
			return 0;
		}
		if ( ! array_key_exists( $type, $display ) ) {
			return 0;
		}
		return $display[$type];
	}

	/**
	 * Add the share buttons to the content
	 *
	 * @since 1.0.0
	 *
	 * @return the content with the filter applied
	 */
	public function render( $content ) {

		$buttons = $this->get_enabled_services();

		if ( 1 > count( $buttons ) ) {
			return $content;
		}

		$html = '<div class="wp-share-container">';
		$services = $this->get_services();

		$style = $this->options['button_style'];

		$heading = $this->options['heading_text'];
		if ( 0 < strlen( trim( $heading ) ) ) {
			$html .= '<div class="share-heading"><p>' . $heading . '</p></div>';
		}

		$html .= '<div class="share-buttons share-' . $style . '"><ul>';
		foreach ( $buttons as $id ) {
			if ( isset( $services[$id] ) && class_exists( $services[$id] ) ){
				global $post;
				$service = new $services[$id] ( $id, $post );
				ob_start();
				$service->display( $post, $style );
				$html .= ob_get_clean();
			}
		}
		$html .= '</ul></div></div>';

		// determine where we should display the buttons
		$location = $this->content_location();

		switch ( $location ) {
			case '0':
				return $content;
				break;

			case '1':
				return $html . $content;
				break;

			case '2':
				return $content . $html;
				break;

			case '3':
				return $html . $content . $html;
				break;

			default:
				return $content;
				break;
		}

	}

	/**
	 * Function that allows buttons to be displayed everywhere.
	 * Not configurable at this poing
	 *
	 * @since 1.0.0
	 *
	 * @return string html for the buttons
	 */
	public function sharing_buttons() {

		$buttons = $this->get_enabled_services();

		if ( 1 > count( $buttons ) ) {
			return __( 'Please enable some services.', $this->plugin_slug );
		}

		$html = '<div class="wp-share-container">';
		$services = $this->get_services();

		$style = $this->options['button_style'];

		$heading = $this->options['heading_text'];
		if ( 0 < strlen( trim( $heading ) ) ) {
			$html .= '<div class="share-heading"><p>' . $heading . '</p></div>';
		}

		$html .= '<div class="share-buttons share-' . $style . '"><ul>';
		foreach ( $buttons as $id ) {
			if ( isset( $services[$id] ) && class_exists( $services[$id] ) ){
				global $post;
				$service = new $services[$id] ( $id, $post );
				ob_start();
				$service->display( $post, $style );
				$html .= ob_get_clean();
			}
		}
		$html .= '</ul></div></div>';

		return $html;
	}

}
