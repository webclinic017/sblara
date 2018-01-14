<?php
/**
 * Plugin Name: News Widget
 */

add_action( 'widgets_init', 'rehub_top_offers_load_widget' );

function rehub_top_offers_load_widget() {
	register_widget( 'rehub_top_offers_widget' );
}

class rehub_top_offers_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function rehub_top_offers_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'top_offers', 'description' => __('Widget displays top offers. Use only in sidebar!', 'rehub_framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rehub_top_offers' );

		/* Create the widget. */
		$this->WP_Widget( 'rehub_top_offers', __('ReHub: Top Offers', 'rehub_framework'), $widget_ops, $control_ops );
	}

/**
 * How to display the widget on the screen.
 */
function widget( $args, $instance ) {
	extract( $args );

	/* Our variables from the widget settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$tags = $instance['tags'];
	$order = $instance['order'];
	$number = $instance['number'];
	$post_type = $instance['post_type'];
	
	/* Before widget (defined by themes). */
	echo $before_widget;

	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title )
		echo $before_title . $title . $after_title;
	?>

	    <?php if ($post_type == 'post') :?>
	    	<?php rehub_top_offers_widget_block_post($tags, $number, $order);?>
	    <?php elseif ($post_type == 'thirsty'):?>
	    	<?php rehub_top_offers_widget_block_thirsty($number, $order);?> 
	    <?php elseif ($post_type == 'woo'):?>
	    	<?php rehub_top_offers_widget_block_woo($tags, $number, $order);?>
	    <?php else : ?> 	              
	    	<?php rehub_top_offers_widget_block_post($tags, $number, $order);?>
	    <?php endif ;?>	

			
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
		$instance['tags'] = strip_tags($new_instance['tags']);
		$instance['order'] = strip_tags($new_instance['order']);
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['post_type'] = $new_instance['post_type'];

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Top offers', 'rehub_framework'), 'number' => 5, 'tag' => '', 'post_type' => 'post', 'order' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title of widget:', 'rehub_framework'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of posts to show:', 'rehub_framework'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Widget is based on:', 'rehub_framework');?></label> 
		<select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" style="width:100%;">
			<option value="thirsty" <?php if ( 'thirsty' == $instance['post_type'] ) : echo 'selected="selected"'; endif; ?>><?php _e('ThirstyAffiliates offers', 'rehub_framework');?></option>
			<option value="post" <?php if ( 'post' == $instance['post_type'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Posts', 'rehub_framework');?></option>
			<option value="woo" <?php if ( 'woo' == $instance['post_type'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Woocommerce', 'rehub_framework');?></option>			
		</select>
		</p>

		<p><em><?php _e('If you select Widget base on posts or woocommerce, enter tag slug in field below. If you select ThirstyAffiliate base, widget will show top links of ThirstyAffiliates posts. Also, you can set name of meta key for ordering', 'rehub_framework');?></em></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e('Enter tag slug:', 'rehub_framework'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" value="<?php echo $instance['tags']; ?>"  />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Meta key name for ordering:', 'rehub_framework'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" value="<?php echo $instance['order']; ?>"  />
		</p>		

	<?php
	}
}

?>