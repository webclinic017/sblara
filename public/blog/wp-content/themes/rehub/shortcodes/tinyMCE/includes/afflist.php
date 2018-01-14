<?php require_once(dirName(__FILE__).'/../../../../../../wp-load.php'); ?>
<script type="text/javascript">
jQuery(function(){ 
	// handles the click event of the submit box
	jQuery('#submit').click(function(){
				var afflistids = jQuery('#afflistids').val();
				var afflistcat = jQuery('#afflistcat').val();
				var afflistshow = jQuery('#afflistshow').val();

				var shortcode = '[wpsm_afflist ';
				if(afflistids !== '') {
					shortcode += 'ids="'+afflistids+'" ';
				}
				if(afflistshow !== '') {
					shortcode += 'show="'+afflistshow+'" ';
				}													
				if(afflistcat !== '') {
					shortcode += 'cat="'+afflistcat+'" ';
				}					
				shortcode += ']';							

		// inserts the shortcode into the active editor
		window.send_to_editor(shortcode);
				
		// closes Thickbox
		tb_remove();
				
			});
			
});

</script>

<form action="/" method="get" id="form" name="form" accept-charset="utf-8">
	<p><?php _e('This shortcode works only with Thirsty affiliate offers', 'rehub_framework') ;?></p>
    <p>
		<label for="afflistcat"><?php _e('Affiliate category :', 'rehub_framework') ;?></label>
		<input id="afflistcat" name="afflistcat" type="text" value="" />
	</p>	
    <p>
		<label for="afflistshow"><?php _e('Number of offers to show', 'rehub_framework') ;?></label>
		<input id="afflistshow" name="afflistshow" type="text" value="" />
	</p>
    <p>
		<label for="afflistids"><?php _e('Or set Offer ids :', 'rehub_framework') ;?></label>
		<input id="afflistids" name="afflistids" type="text" value="" />
		<small><?php _e('Set affiliate link IDs with comas without spaces. Example: 233,235,289. This field is working if you don\'t set category', 'rehub_framework') ;?></small>		
	</p> 

	 <p>
        <label>&nbsp;</label>
        <input type="button" id="submit" class="button" value="<?php _e('Insert', 'rehub_framework') ;?>" name="submit" />
    </p>
</form>