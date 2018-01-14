<?php require_once(dirName(__FILE__).'/../../../../../../wp-load.php'); ?>
<script type="text/javascript">

// executes this when the DOM is ready
jQuery(function(){ 
	// handles the click event of the submit list
	jQuery('#submit').click(function(){

		var shortcode = '[wpsm_slider';
		
		shortcode += ']<ul class="slides">';
		
		if ( jQuery('#slider-text').val() !== '' ){
			jQuery.each(jQuery('#slider-text').val().split('\n'), function(index, value) { 
			  shortcode += '<li>' + value +'</li>';
			});
		}else{
			shortcode += '<li>Sample Image #1</li><li>Sample Image #2</li><li>Sample Image #3</li>';
		}
		
		shortcode += '</ul>[/wpsm_slider]';
		
		// inserts the shortcode into the active editor
		window.send_to_editor(shortcode);
		
		
		// closes Thickbox
		tb_remove();
	});
}); 
</script>
<form action="/" method="get" id="form" name="form" accept-charset="utf-8">
    <p>
        <label>Slider content</label>
        <textarea name="slider-text" id="slider-text" rows="6" /></textarea><br /><small><?php _e('Separated each image by a new-line (by Enter)', 'rehub_framework') ;?></small>
    </p>
	 <p>
        <label>&nbsp;</label>
        <input type="button" id="submit" class="button" value="<?php _e('Insert', 'rehub_framework') ;?>" name="submit" />
    </p>
</form>