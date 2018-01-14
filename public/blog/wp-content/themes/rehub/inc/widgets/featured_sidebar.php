<?php
/**
 * Plugin Name: News Widget
 */

add_action( 'widgets_init', 'rehub_featured_slider_load_widget' );

function rehub_featured_slider_load_widget() {
	register_widget( 'rehub_featured_slider_widget' );
}

class rehub_featured_slider_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function rehub_featured_slider_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'featured_slider', 'description' => __('Widget that displays custom featured slider of posts. Use only in sidebar!', 'rehub_framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rehub_featured_slider' );

		/* Create the widget. */
		$this->WP_Widget( 'rehub_featured_slider', __('ReHub: Featured Slider', 'rehub_framework'), $widget_ops, $control_ops );
	}

/**
 * How to display the widget on the screen.
 */
function widget( $args, $instance ) {
	extract( $args );

	/* Our variables from the widget settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$tags = $instance['tags'];
	$number = $instance['number'];
	$post_type = $instance['post_type'];
	global $post;
	
	if($post_type == 'tags') :
		$query = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'tag' => $tags);
	elseif($post_type == 'featured') :
		$query = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'meta_key' => 'is_featured', 'meta_value' => '1'); 
	else :
		$query = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'meta_key' => 'is_featured', 'meta_value' => '1');
	endif;	
	$loop = new WP_Query($query);
	
	/* Before widget (defined by themes). */
	echo $before_widget;

	if ($loop->have_posts()) :

	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title )
		echo $before_title . $title . $after_title;
	?>
		<?php wp_enqueue_script('flexslider');   ?>
		<div class="slides">		
		<?php  while ($loop->have_posts()) : $loop->the_post(); ?>	
			<div class="slide">
				<div class="wrap">
					<a href="<?php the_permalink();?>" class="view-link">
						<span class="pattern"></span>
						<div class="image"><?php wpsm_thumb ('grid_news') ?></div>
						<?php if(vp_metabox('rehub_post.rehub_framework_post_type') == 'review') :?><span class="score"><i><?php echo rehub_get_overall_score() ?></i><?php _e('SCORE', 'rehub_framework'); ?></span><?php endif;?>
						<?php $category = get_the_category($post->ID); $first_cat = $category[0]->term_id; $cat_name = get_cat_name($first_cat);?>
						<span class="reviews"><?php echo $cat_name ;?></span>
					</a>
					<h3><a class="link" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
					<p><?php kama_excerpt('maxchar=100'); ?></p>
				</div>
            </div>	
		<?php endwhile; ?>
		</div>
		<?php wp_reset_query(); ?>
		<?php else: ?><?php _e('No posts for this criteria.', 'rehub_framework');  ?>
		<?php endif; ?>
			
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
		$instance['number'] = strip_tags( $new_instance['number'] );
		$instance['post_type'] = $new_instance['post_type'];

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Featured', 'rehub_framework'), 'number' => 3, 'tag' => '', 'post_type' => 'featured');
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
		<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Slider based on:', 'rehub_framework');?></label> 
		<select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" style="width:100%;">
			<option value="featured" <?php if ( 'featured' == $instance['post_type'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Featured posts', 'rehub_framework');?></option>
			<option value="tags" <?php if ( 'tags' == $instance['post_type'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Tag', 'rehub_framework');?></option>
		</select>
		</p>

		<p><em><?php _e('If you select slider based on tag, enter tag slug in field below ', 'rehub_framework');?></em></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tags' ); ?>"><?php _e('Enter tag slug:', 'rehub_framework'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'tags' ); ?>" name="<?php echo $this->get_field_name( 'tags' ); ?>" value="<?php echo $instance['tags']; ?>"  />
		</p>

	<?php
	}
}

?>