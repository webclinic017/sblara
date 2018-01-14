<?php require_once(dirName(__FILE__).'/../../../../../../wp-load.php'); ?>
<script type="text/javascript">

// executes this when the DOM is ready
jQuery(function(){ 
	// handles the click event of the submit button
	jQuery('#submit').click(function(){
        var idvalue = jQuery('#woolist-ids').val();
        var idtag = jQuery('#woolist-tag').val();
        var show = jQuery('#woolist-show').val();        

		var shortcode = '[wpsm_woolist';

		if (idvalue !='') {
			shortcode += ' data_source="ids" ids="' + idvalue + '"';
		}

		else {
			shortcode += ' data_source="tag" tag="' + idtag + '" show="' + show + '"';
		}

		shortcode += ']';

		
		// inserts the shortcode into the active editor
		window.send_to_editor(shortcode);
		
		
		// closes Thickbox
		tinyMCEPopup.close();
	});
}); 
</script>
<form action="/" method="get" id="form" name="form" accept-charset="utf-8">
    <p><label><?php _e('Product ids', 'rehub_framework') ;?></label>
        <input type="text" name="woolist-ids" value="" id="woolist-ids" /><br />
        <small><?php _e('Insert woocommerce product IDs with commas. Example, 1,2,3', 'rehub_framework') ;?></small>
    </p> 
    <p><label><?php _e('Or set product tags ids', 'rehub_framework') ;?></label>
        <input type="text" name="woolist-tag" value="" id="woolist-tag" /><br />
        <small><?php _e('Insert product tags IDs with commas. Example, 1,2,3', 'rehub_framework') ;?></small>
    </p>
    <p><label><?php _e('Numbers of posts to show', 'rehub_framework') ;?></label>
        <input type="text" name="woolist-show" value="" id="woolist-show" /><br />
        <small><?php _e('Set number', 'rehub_framework') ;?></small>
    </p>	 <p>
        <label>&nbsp;</label>
        <input type="button" id="submit" class="button" value="<?php _e('Insert', 'rehub_framework') ;?>" name="submit" />
    </p>
</form>