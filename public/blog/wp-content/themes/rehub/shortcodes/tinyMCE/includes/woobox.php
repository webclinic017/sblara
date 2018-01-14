<?php require_once(dirName(__FILE__).'/../../../../../../wp-load.php'); ?>
<script type="text/javascript">

// executes this when the DOM is ready
jQuery(function(){ 
	// handles the click event of the submit button
	jQuery('#submit').click(function(){
        var idvalue = jQuery('#woobox-ids').val();

		var shortcode = '[wpsm_woobox';

			shortcode += ' id="' + idvalue + '"';

		shortcode += ']';

		
		// inserts the shortcode into the active editor
		window.send_to_editor(shortcode);
		
		
		// closes Thickbox
		tinyMCEPopup.close();
	});
}); 
</script>
<form action="/" method="get" id="form" name="form" accept-charset="utf-8">
    <p><label><?php _e('Product id', 'rehub_framework') ;?></label>
        <input type="text" name="woobox-ids" value="" id="woobox-ids" /><br />
        <small><?php _e('Insert woocommerce product ID', 'rehub_framework') ;?></small>
    </p>          
	 <p>
        <label>&nbsp;</label>
        <input type="button" id="submit" class="button" value="<?php _e('Insert', 'rehub_framework') ;?>" name="submit" />
    </p>
</form>