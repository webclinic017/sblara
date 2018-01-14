<div class="post_share">
	<script>
		(function() {
		    function async_load(u,id) {
		        if (!gid(id)) {
		            s="script", d=document,
		            o = d.createElement(s);
		            o.type = 'text/javascript';
		            o.id = id;
		            o.async = true;
		            o.src = u;
		            // Creating scripts on page
		            x = d.getElementsByTagName(s)[0];
		            x.parentNode.insertBefore(o,x);
		        }
		    }
		    function gid (id){
		        return document.getElementById(id);
		    }
		    window.onload = function() {	    	       
			    async_load("//platform.twitter.com/widgets.js", "id-twitter");//twitter
			    async_load("//connect.facebook.net/en_EN/all.js#xfbml=1", "id-facebook");//facebook
			    async_load("https://apis.google.com/js/plusone.js", "id-google");//google
		    };
		})();
	</script>
    <div class="share-item tw_like">
        <a id="s-twitter" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title_attribute(); ?>">tweet</a>
    </div>

    <div class="share-item fb_like">
        <div id="s-facebook" class="fb-like" data-href="<?php the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="122" data-show-faces="false"></div>
    </div>

    <div class="share-item google_like">
        <div id="s-google" class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>"></div>
    </div>

    <?php
        // try getting featured image
        $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        if( ! $featured_img )
        {
            $featured_img = '';
        }
        else
        {
            $featured_img = $featured_img[0];
        }
    ?>

    <div class="share-item pin_like">
        <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>
            &amp;media=<?php echo $featured_img; ?>
            &amp;description=<?php echo urlencode(get_the_title()); ?>" 
            class="pin-it-button" 
            count-layout="horizontal">
            <img src="//assets.pinterest.com/images/PinExt.png" title="Pin It" alt= "Pin It" />
        </a>
    </div>
</div>