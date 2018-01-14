jQuery(document).ready(function() {

	jQuery(".thing-post-like a").live("click", function(e){
		e.preventDefault();
		heart = jQuery(this);
		post_id = heart.data("post_id");
		heart.children(".like").html("<i class='fa fa-spinner fa-spin'></i>");
		
		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
			success: function(count){
				if( count.indexOf( "already" ) !== -1 )
				{
					var lecount = count.replace("already","");
					if (lecount == 0)
					{
						var lecount = "0";
					}
					heart.children(".like").removeClass("pastliked").addClass("disliked").html("<i class='fa fa-heart-o'></i>");
					heart.children(".count").removeClass("liked").addClass("disliked").text(lecount);
				}
				else
				{
					heart.children(".like").addClass("pastliked").removeClass("disliked").html("<i class='fa fa-heart'></i>");
					heart.children(".count").addClass("liked").removeClass("disliked").text(count);
				}
			}
		});
		
		return false;
	})
	
})
