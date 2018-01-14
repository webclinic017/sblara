(function() {

	tinymce.create('tinymce.plugins.Addshortcodes', {
		init : function(ed, url) {

		    //ads
			ed.addButton('ads1', {  
				title : 'Ads 1',  
				image : url+'/images/bullhorn.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent('[wpsm_ads1 float="none"]');  
				}  
			}); 

		    //ads2
			ed.addButton('ads2', {  
				title : 'Ads 2',  
				image : url+'/images/bullhorn2.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent('[wpsm_ads2 float="none"]');  
				}  
			}); 

		    //contents
			ed.addButton('contents', {  
				title : 'Specification',  
				image : url+'/images/contents.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent('[wpsm_specification]');  
				}  
			}); 							 
			

		    //review
			ed.addButton('review', {  
				title : 'Top list',  
				image : url+'/images/star.png',  
				onclick : function() {
					//if(ed.selection.getContent().length > 0)				
					ed.selection.setContent('[wpsm_toplist]');  
				}  
			});
								  			
		},
	});
	tinymce.PluginManager.add('wpsm_shortcode', tinymce.plugins.Addshortcodes);	
	
})();