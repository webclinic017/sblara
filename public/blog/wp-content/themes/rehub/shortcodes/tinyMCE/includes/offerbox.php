<?php require_once(dirName(__FILE__).'/../../../../../../wp-load.php'); ?>
<script type="text/javascript">
jQuery(function(){ 
	// handles the click event of the submit box
	jQuery('#submit').click(function(){
				var offerlinkid = jQuery('#offerlinkid').val();
				var offerBoxprice = jQuery('#offerBoxprice').val();
				var offerBoxbtnlink = jQuery('#offerBoxbtnlink').val();
				var offerBoxbtntext = jQuery('#offerBoxbtntext').val();
				var offerBoxtitle = jQuery('#offerBoxtitle').val();
				var offerBoximg = jQuery('#offerBoximg').val();
				var offerBoxcontent = jQuery('#offerBoxcontent').val();
				if( ! tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
					 var contentofferbox = jQuery("textarea.wp-editor-area").selection('get');
					}
				else {
			        var contentofferbox = tinyMCE.activeEditor.selection.getContent();
			        }

				var shortcode = '[wpsm_offerbox ';
				if(offerlinkid !== '') {
					shortcode += 'offer_linkid="'+offerlinkid+'" ';
				}
				if(offerBoxbtnlink !== '') {
					shortcode += 'button_link="'+offerBoxbtnlink+'" ';
				}
				if(offerBoxbtntext !== '') {
					shortcode += 'button_text="'+offerBoxbtntext+'" ';
				}													
				if(offerBoxprice !== '') {
					shortcode += 'price="'+offerBoxprice+'" ';
				}	
				if(offerBoxtitle !== '') {
					shortcode += 'title="'+offerBoxtitle+'" ';
				}
		        if ( offerBoxcontent !== '' )
				   shortcode += 'description="'+offerBoxcontent+'" ';
		        else if	( contentofferbox !== '' )
			       shortcode += 'description="'+contentofferbox+'" ';		

			   	if(offerBoximg !== '') {
					shortcode += 'thumb="'+offerBoximg+'" ';
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

    <p>
		<label for="offerlinkid"><?php _e('Affiliate link ID :', 'rehub_framework') ;?></label>
		<input id="offerlinkid" name="offerlinkid" type="text" value="" />
		<small><?php _e('Set affiliate link ID that you want to show as product offer or set data manually below. ThirstyAffiliate plugin must be installed for working with affiliate link ID', 'rehub_framework') ;?></small>
	</p>	
    <p>
		<label for="offerBoxprice"><?php _e('Offer price :', 'rehub_framework') ;?></label>
		<input id="offerBoxprice" name="offerBoxprice" type="text" value="" />
	</p>

    <p>
		<label for="offerBoxbtnlink"><?php _e('Button link :', 'rehub_framework') ;?></label>
		<input id="offerBoxbtnlink" name="offerBoxbtnlink" type="text" value="" />
	</p> 
    
    <p>
		<label for="offerBoxbtntext"><?php _e('Button text :', 'rehub_framework') ;?></label>
		<input id="offerBoxbtntext" name="offerBoxbtntext" type="text" value="" />
	</p>   

	<p>
		<label for="offerBoxtitle"><?php _e('Title of offer :', 'rehub_framework') ;?></label>
		<input id="offerBoxtitle" name="offerBoxtitle" type="text" value="" />
	</p>
    
    <p>
		<label for="offerBoxcontent"><?php _e('OfferBox description:', 'rehub_framework') ;?></label>
		<textarea id="offerBoxcontent" name="offerBoxcontent" type="text" col="10" value=""></textarea>
	</p>
	<p>
		<label for="offerBoximg"><?php _e('Offer thumbnail url', 'rehub_framework') ;?></label>
		<input id="offerBoximg" name="offerBoximg" type="text" value="" />
		<small><?php _e('You can leave this field blank', 'rehub_framework') ;?></small>
	</p>

	 <p>
        <label>&nbsp;</label>
        <input type="button" id="submit" class="button" value="<?php _e('Insert', 'rehub_framework') ;?>" name="submit" />
    </p>
</form>