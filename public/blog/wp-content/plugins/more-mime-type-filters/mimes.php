<?php
/*
Plugin Name: More Mime Type Filters
Plugin URI: http://trepmal.com
Description: Adds more options to the Media Library filter search (Images/Audio/Video)
Version: 0.3
Author: Kailey Lampert
Author URI: http://kaileylampert.com
*/

$mime_type_filters = new Mime_Type_Filters();

class Mime_Type_filters {

	function __construct() {
		add_filter( 'post_mime_types', array( &$this, 'post_mime_types' ) );
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
		add_action( 'contextual_help', array( &$this, 'contextual_help'), 10, 3);
		// used to save the plugin version, but this is a simple plugin and I don't anticipate needing any fancy upgrade procedures. //since version 0.3
		delete_option( 'more_mime_type_filters_version' );
	}

	function post_mime_types( $post_mime_types ) {

		$opts = get_option( 'mime_type_options', array() );
		//since image/audio/video are defaults, we need to explicitly remove them if they've been unchecked in the options
		if ( ! isset( $opts['image'] ) ) unset( $post_mime_types['image'] );
		if ( ! isset( $opts['audio'] ) ) unset( $post_mime_types['audio'] );
		if ( ! isset( $opts['video'] ) ) unset( $post_mime_types['video'] );
		foreach( $opts as $ext => $vs ) {
			$post_mime_types[ $vs['mime_type'] ] = array(
				$vs['singular'],
				'Manage '. $vs['singular'],
				_n_noop( $vs['singular'] .' <span class="count">(%s)</span>', $vs['plural'] . ' <span class="count">(%s)</span>')
			);
		}

		return $post_mime_types;
	}

	function admin_menu() {
		global $mmtf_admin_page;
		$mmtf_admin_page = add_media_page('Mime Types', 'Mime Types', 'administrator', 'mime_type_mngr', array( &$this, 'page' ) );
	}

	function contextual_help( $contextual_help, $screen_id, $screen ) {
		global $mmtf_admin_page;
		if ( $mmtf_admin_page != $screen->id ) return $contextual_help;
		$code = "add_filter( 'upload_mimes', 'make_alfredextenstion_allowed_upload' );
function make_alfredextenstion_allowed_upload( \$mimes ) {
	\$mimes['alfredextension'] = 'application/octet-stream';
	return \$mimes;
}";
		$help = '<p>If you have selected a particular type but there are no attachments of that type, it will be ignored until such a post is added.</p>';
		if ( current_user_can('activate_plugins') )
			$help .= '<p>You can add custom mime types using code like the following:</p>' . '<pre>'. htmlspecialchars( $code ) .'</pre>';

		$screen->add_help_tab( array(
			'id' => 'mmtf_help',
			'title' => 'Overview',
			'content' => $help
		) );
	}

	function page() {
		?><div class="wrap">
		<h2>Media Library Mime Types</h2>
		<?php
		if ( isset($_POST['mimes'] ) ) {
			$mimes = $_POST['mimes'];
			$x = array(); //selected items
			$y = array(); //all, so we can preserve labels
			foreach( $mimes as $ext => $type) {
				// For all mime types, update any label changes
				$y[ $ext ] = array(
					'singular' => $mimes[ $ext ]['singular'],
					'plural' => $mimes[ $ext ]['plural']
				);
				// If mime type is 'on' save that too
				if ( isset( $mimes[ $ext ]['on'] ) )
					$x[ $ext ] = $y[ $ext ] + array( 'mime_type' => $mimes[ $ext ]['on']);
			}
			// In retrospect, having *_options and *_settings was probably a dumb idea. Oh well.
			// So OPTIONS is the active selection, SETTINGS preserves labels for all mime types
			update_option( 'mime_type_options', $x );
			update_option( 'mime_type_settings', $y );
			
			echo '<div class="updated"><p>Your settings have been saved.</p></div>';
		}

		?>
		<form method="post">
		<table class="wp-list-table widefat fixed" cellspacing="0">
		<thead>
		<tr>
			<th scope="col" id="cb" class="manage-column column-cb check-column"></th>
			<th scope="col" class="manage-column">Mime Type</th>
			<th scope="col" class="manage-column">Singular Label</th>
			<th scope="col" class="manage-column">Plural Label</th>
		</tr>
		</thead>

		<tfoot>
		<tr>
			<th scope="col" class="manage-column column-cb check-column"></th>
			<th scope="col" class="manage-column">Mime Type</th>
			<th scope="col" class="manage-column">Singular Label</th>
			<th scope="col" class="manage-column">Plural Label</th>
		</tr>
		</tfoot>
		<tbody id="the-list">
		<?php
			$opts = get_option( 'mime_type_options', array() );
			$sets = get_option( 'mime_type_settings' , array() );

			$mimes = get_allowed_mime_types();
			//the default generics (image/audio/video) aren't in get_allowed_mime_types()
			//so we merge them here for ease
			$mimes = array_merge( array('image' => 'image', 'audio' => 'audio', 'video' => 'video'), $mimes );

			foreach( $mimes as $ext => $mime ) {
				$type = array_pop( explode( '/', $mime ) );
				$ext_label = '<code>'. str_replace( '|', '</code>, <code>', $ext ) .'</code>';
				?><tr>
					<th scope="row" class="check-column">
						<label class="screen-reader-text" for="mime_<?php echo $ext; ?>"><?php echo $ext; ?></label>
						<input type="checkbox" name="mimes[<?php echo $ext; ?>][on]" id="mime_<?php echo $ext; ?>" value="<?php echo $mime; ?>"
						<?php checked( ( isset( $opts[ $ext ] ) && is_array( $opts[ $ext ] ) ) ); ?>/>
					</th>
					<td>
						<strong><?php echo $ext_label; ?></strong>
					</td>
					<td>
						<label for="mime_singular_<?php echo $ext; ?>"><input type="text" name="mimes[<?php echo $ext; ?>][singular]" id="mime_singular_<?php echo $ext; ?>" value="<?php echo isset($sets[ $ext ]) ? $sets[ $ext ]['singular'] : $type; ?>" /></label>
					</td>
					<td>
						<label for="mime_plural_<?php echo $ext; ?>"><input type="text" name="mimes[<?php echo $ext; ?>][plural]" id="mime_plural_<?php echo $ext; ?>" value="<?php echo isset($sets[ $ext ]) ? $sets[ $ext ]['plural'] : $type.'s'; ?>" /></label>
					</td>
				</tr><?php
			}
		?>
		</tbody>
		</table>
		<?php submit_button(); ?>
		</form>

		</div><?php
	}

}