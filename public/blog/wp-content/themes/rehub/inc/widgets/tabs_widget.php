<?php
/**
 * Plugin Name: News Widget
 */

add_action( 'widgets_init', 'rehub_tabs_load_widget' );

function rehub_tabs_load_widget() {
	register_widget( 'rehub_tabs_widget' );
}

class rehub_tabs_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function rehub_tabs_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'tabs', 'description' => __('A widget that displays 2 tabs (popular, categories, tags, latest comments). Use only in sidebar! ', 'rehub_framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'rehub_latest_tabs_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'rehub_latest_tabs_widget', __('ReHub: Tabs', 'rehub_framework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$tabs1 = $instance['tabs1'];
		$tabs2 = $instance['tabs2'];
		$sortby = $instance['sortby'];
		if( !empty($instance['dark']) ) $color = 'dark';
		else $color = '';
		if( empty($instance['basedby']) ) {$basedby = 'comments';}
		else {$basedby = $instance['basedby'];}

		if($sortby == 'this_week') {
		if( !function_exists('filter_where_week') ) {
			function filter_where_week($where = '') {
				//posts in the last 7 days
				$where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
				return $where;
			}
		}
		add_filter('posts_where', 'filter_where_week');
		} elseif($sortby == 'this_month') {
		if( !function_exists('filter_where_month') ) {
			function filter_where_month($where = '') {
				//posts in the last 30 days
				$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
				return $where;
			}
		}
		add_filter('posts_where', 'filter_where_month');
		} elseif($sortby == 'three_month') {
		if( !function_exists('filter_where_t_month') ) {
			function filter_where_t_month($where = '') {
				//posts in the last 30 days
				$where .= " AND post_date > '" . date('Y-m-d', strtotime('-90 days')) . "'";
				return $where;
			}
		}
		add_filter('posts_where', 'filter_where_t_month');
		}
		else {}
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		?>

		<ul class="clearfix tabs-menu">
            <li>
	            <?php if ($tabs1 == 'popular') :?>
	            	<?php _e('Popular', 'rehub_framework');?>
	            <?php elseif ($tabs1 == 'comments'):?>
	            	<?php _e('Comments', 'rehub_framework');?>
	            <?php elseif ($tabs1 == 'category'):?>	
	            	<?php _e('Categories', 'rehub_framework');?>
	            <?php else : ?>            
	            	<?php _e('Tags', 'rehub_framework');?>	            
	            <?php endif ;?>	
            </li>
            <li>
	            <?php if ($tabs2 == 'popular') :?>
	            	<?php _e('Popular', 'rehub_framework');?>
	            <?php elseif ($tabs2 == 'comments'):?>
	            	<?php _e('Comments', 'rehub_framework');?>
	            <?php elseif ($tabs2 == 'category'):?>	
	            	<?php _e('Categories', 'rehub_framework');?>
	            <?php else : ?>            
	            	<?php _e('Tags', 'rehub_framework');?>	            
	            <?php endif ;?>	
            </li>
       </ul>
    <div class="color_sidebar<?php if ($color == 'dark') :?> dark_sidebar<?php endif ;?>">
       <div class="tabs-item clearfix">
   			<?php if ($tabs1 == 'popular') :?>
            	<?php rehub_most_popular_widget_block($basedby, $sortby);?>
            <?php elseif ($tabs1 == 'comments'):?>
            	<?php rehub_latest_comment_widget_block();?>
            <?php elseif ($tabs1 == 'category'):?>	
            	<?php rehub_category_widget_block();?>
            <?php else : ?>            
            	<div class="tagcloud"><?php wp_tag_cloud(); ?></div> 	            
            <?php endif ;?>	      	
       	</div>
       <div class="tabs-item">
          	<?php if ($tabs2 == 'popular') :?>
            	<?php rehub_most_popular_widget_block($basedby);?>
            <?php elseif ($tabs2 == 'comments'):?>
            	<?php rehub_latest_comment_widget_block();?>
            <?php elseif ($tabs2 == 'category'):?>	
            	<?php rehub_category_widget_block();?>
            <?php else : ?>            
            	<div class="tagcloud"><?php wp_tag_cloud(); ?></div>	            
            <?php endif ;?>	    	
       	</div>
   </div>
			
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
		$instance['tabs1'] = $new_instance['tabs1'];
		$instance['tabs2'] = $new_instance['tabs2'];
		$instance['sortby'] = $new_instance['sortby'];
		$instance['basedby'] = $new_instance['basedby'];
		$instance['dark'] = strip_tags( $new_instance['dark'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'tabs1' => 'popular', 'tabs2' => 'comments', 'sortby' => 'all_time', 'basedby' => 'comments');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><em style="color:red;"><?php _e('Use this widget only in sidebar area!', 'rehub_framework');?></em></p>
				
		<p>
		<label for="<?php echo $this->get_field_id('tabs1'); ?>"><?php _e('Content for 1 tab', 'rehub_framework');?></label> 
		<select id="<?php echo $this->get_field_id('tabs1'); ?>" name="<?php echo $this->get_field_name('tabs1'); ?>" style="width:100%;">
			<option value='popular' <?php if ( 'popular' == $instance['tabs1'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Popular posts', 'rehub_framework');?></option>
			<option value='comments' <?php if ( 'comments' == $instance['tabs1'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Latest comments', 'rehub_framework');?></option>
			<option value='category' <?php if ( 'category' == $instance['tabs1'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Category list', 'rehub_framework');?></option>
			<option value='tags' <?php if ( 'tags' == $instance['tabs1'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Tags cloud', 'rehub_framework');?></option>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('tabs2'); ?>"><?php _e('Content for 2 tab', 'rehub_framework');?></label> 
		<select id="<?php echo $this->get_field_id('tabs2'); ?>" name="<?php echo $this->get_field_name('tabs2'); ?>" style="width:100%;">
			<option value='popular' <?php if ( 'popular' == $instance['tabs2'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Popular posts', 'rehub_framework');?></option>
			<option value='comments' <?php if ( 'comments' == $instance['tabs2'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Latest comments', 'rehub_framework');?></option>
			<option value='category' <?php if ( 'category' == $instance['tabs2'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Category list', 'rehub_framework');?></option>
			<option value='tags' <?php if ( 'tags' == $instance['tabs2'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Tags cloud', 'rehub_framework');?></option>
		</select>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e('Popular posts published by:', 'rehub_framework');?></label> 
		<select id="<?php echo $this->get_field_id('sortby'); ?>" name="<?php echo $this->get_field_name('sortby'); ?>" style="width:100%;">
			<option value='all_time' <?php if ( 'all_time' == $instance['sortby'] ) : echo 'selected="selected"'; endif; ?>><?php _e('all time', 'rehub_framework');?></option>
			<option value='this_week' <?php if ( 'this_week' == $instance['sortby'] ) : echo 'selected="selected"'; endif; ?>><?php _e('this week', 'rehub_framework');?></option>
			<option value='this_month' <?php if ( 'this_month' == $instance['sortby'] ) : echo 'selected="selected"'; endif; ?>><?php _e('this month', 'rehub_framework');?></option>
			<option value='three_month' <?php if ( 'three_month' == $instance['sortby'] ) : echo 'selected="selected"'; endif; ?>><?php _e('last 3 month', 'rehub_framework');?></option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('basedby'); ?>"><?php _e('Popular posts based on:', 'rehub_framework');?></label> 
		<select id="<?php echo $this->get_field_id('basedby'); ?>" name="<?php echo $this->get_field_name('basedby'); ?>" style="width:100%;">
			<option value='comments' <?php if ( 'comments' == $instance['basedby'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Comments', 'rehub_framework');?></option>
			<option value='views' <?php if ( 'views' == $instance['basedby'] ) : echo 'selected="selected"'; endif; ?>><?php _e('Post views', 'rehub_framework');?></option>
		</select>
		</p>
		<p><em><?php _e('Note, post views may not work if you use cache plugins!', 'rehub_framework');?></em></p>				
		<p>
			<label for="<?php echo $this->get_field_id( 'dark' ); ?>"><?php _e('Dark Skin ?', 'rehub_framework'); ?></label>
			<input id="<?php echo $this->get_field_id( 'dark' ); ?>" name="<?php echo $this->get_field_name( 'dark' ); ?>" value="true" <?php if( $instance['dark'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>		


	<?php
	}
}

?>