<?php require_once(dirName(__FILE__).'/../../../../../../wp-load.php'); ?>
<script type="text/javascript">

// executes this when the DOM is ready
jQuery(function(){ 
	// handles the click event of the submit button
	jQuery('#submit').click(function(){

		var testimonial_text = jQuery('#testimonial-text').val();
		var author_by = jQuery('#author_by').val();	

		if( ! tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
		 var contenttestimonial = jQuery("textarea.wp-editor-area").selection('get');
		}
		else {
        	var contenttestimonial = tinyMCE.activeEditor.selection.getContent();  
        }
		var shortcode = '[wpsm_testimonial';
		
		if(author_by !='') {
					shortcode += ' by="' + author_by + '" ';
		}
		shortcode += ']<br />';
		
		
		if ( testimonial_text !== '' )
			shortcode += testimonial_text;
		else if	( contenttestimonial !== '' )
			shortcode += contenttestimonial;
		else 
			shortcode += 'Testimonial';

		shortcode += '<br />[/wpsm_testimonial]';
        
  
        window.send_to_editor(shortcode);
		
		// closes Thickbox
		tb_remove();
	});

				jQuery(".authorby").css("display","none");

	         jQuery("#authorcheck").click(function(){
               // If checked
		       if (jQuery("#authorcheck").is(":checked"))
		       {
			     //show the hidden div
			     jQuery(".authorby").show("slow");
		       }
		       else
		       {
			     //otherwise, hide it
			     jQuery(".authorby").hide("slow");
		       }
		   });

}); 
</script>
<form action="/" method="get" id="form" name="form" accept-charset="utf-8">
	<p>
		<label><?php _e('With author? :', 'rehub_framework') ;?></label>
        <input id="authorcheck" name="authorcheck" type="checkbox" class="checks" value="false" />
	</p>
	<p class="authorby">
		<label><?php _e('Author :', 'rehub_framework') ;?></label>
		<input id="author_by" name="author_by" type="text" value="" />
	</p>
    <p>
        <label>Text</label>
        <textarea type="text" name="testimonial-text" value="" id="testimonial-text" col="10"></textarea><br />
        <small><?php _e('Leave blank if you selected text in visual editor', 'rehub_framework') ;?></small>
    </p>
	 <p>
        <label>&nbsp;</label>
        <input type="button" name="submit" value="<?php _e('Insert', 'rehub_framework') ;?>" class="button" id="submit">
    </p>	
</form>