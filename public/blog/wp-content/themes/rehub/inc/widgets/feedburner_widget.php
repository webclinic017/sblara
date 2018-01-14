<?php
/**
 * Plugin Name: News Widget
 */

add_action( 'widgets_init', 'rehub_feedburner_widget_load_widget' );

function rehub_feedburner_widget_load_widget() {
	register_widget( 'rehub_feedburner_widget_widget' );
}

class rehub_feedburner_widget_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function rehub_feedburner_widget_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'news_lettr', 'description' => __('Widget that displays subscribtion form of feedburner. Use only in sidebar!', 'rehub_framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rehub_feedburner_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'rehub_feedburner_widget', __('ReHub: Feedburner Email form', 'rehub_framework'), $widget_ops, $control_ops );
	}

/**
 * How to display the widget on the screen.
 */
function widget( $args, $instance ) {
	extract( $args );

	/* Our variables from the widget settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	if( function_exists('icl_t') )  $text_code = icl_t( 'rehub_theme' , 'widget_content_'.$this->id , $instance['text_code'] ); else $text_code = $instance['text_code'] ;
	$feedburner = $instance['feedburner'];

	
	/* Before widget (defined by themes). */
	echo $before_widget;

	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title )
		echo $before_title . $title . $after_title;
	?>	
		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
        	<input class="feedburner-email" type="text" name="email" onblur="if (value == '') {value = '<?php _e( 'Enter e-mail address' , 'rehub_framework') ; ?>'}" onfocus="if (value == '<?php _e( 'Enter e-mail address' , 'rehub_framework') ; ?>') {value = ''}" value="<?php _e( 'Enter e-mail address' , 'rehub_framework') ; ?>"/>
            <input class="feedburner-subscribe" type="submit" name="submit" value="<?php _e( 'GO' , 'rehub_framework') ; ?>"/>
            <input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
            <input type="hidden" name="loc" value="<?php echo get_locale() ?>">
        </form>
        <p><i class="fa fa-rss"></i> <?php echo $text_code ;?></p>	
	<?php

	/* After widget (defined by themes). */
	echo $after_widget;
}


	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text_code'] = $new_instance['text_code'] ;
		$instance['feedburner'] = strip_tags( $new_instance['feedburner'] );

		if (function_exists('icl_register_string')) {
			icl_register_string( 'rehub_theme' , 'widget_content_'.$this->id, $new_instance['text_code'] );
		}		

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Subscribe to NEWSLETTER', 'rehub_framework'), 'text_code' => __( 'Subscribe to our news by email.' , 'rehub_framework'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title of widget:', 'rehub_framework'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>"><?php _e('Text under Email Input Field :', 'rehub_framework'); ?> </label>
			<textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php echo $instance['text_code']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner' ); ?>"><?php _e('Feedburner ID:', 'rehub_framework'); ?></label>
			<input id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php echo $instance['feedburner']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}

?>