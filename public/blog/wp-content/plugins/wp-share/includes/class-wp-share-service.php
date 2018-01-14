<?php
/**
 * WP Share.
 *
 * @package   WP_Share_Service
 * @author    Alex Ilie <me@wpshare.co>
 * @license   GPL-2.0+
 * @link      http://wpshare.com
 * @copyright 2014 Alex Ilie
 */
abstract class WP_Share_Service{

	public function __construct( $id ){
		if ( !is_admin() ) {
			global $post;
			$this->id = $id;
			$this->url = get_permalink( $post->ID );
			$this->description = wp_trim_words( $post->post_content, 40 );// generate excerpt

			if ( has_post_thumbnail( $post->ID ) ) {
				$this->image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$this->image = $this->image[0];
			} else {
				$this->image = '';
			}
			$this->title = get_the_title( $post );
		}
	}

	abstract function get_name();
	abstract public function display_button( $post );
	abstract public function display_original( $post );

	public function display( $post, $type ){

		echo '<li class="share-button-' . $this->id . '-' . $type . '">';
		switch ( $type ) {
			case 'icon':
				$this->display_button( $post );
				break;

			case 'icon-text':
				$this->display_button( $post );
				break;

			case 'original':
				$this->display_original( $post );
				break;

			default:
				$this->display_original( $post );
				break;
		}
		echo '</li>';

	}
}

/**
 * Twitter sharing class
 *
 * @since 1.0.0
 */
class Service_Twitter extends WP_Share_Service{

	public function __construct( $id ){
		parent::__construct( $id );
	}

	public function get_name(){
		return __( 'Twitter', 'wp-share' );
	}

	public function display_original( $post ){
		?>
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $this->url; ?>" data-text="<?php echo $this->title; ?>" data-lang="en" data-count="horizontal">Twitter</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<?php
	}

	public function display_button( $post ){
		?>
		<a href="https://twitter.com/share?url=<?php echo rawurlencode( $this->url ); ?>&amp;text=<?php echo rawurlencode( $this->title ); ?>" target="_blank">Tweet</a>
		<?php
	}

}

/**
 * Facebook sharing class
 *
 * @since 1.0.0
 */
class Service_Facebook extends WP_Share_Service{

	public function __construct( $id ){
		parent::__construct( $id );
	}

	public function get_name(){
		return __( 'Facebook', 'wp-share' );
	}

	public function display_original( $post ){
		?>
		<div id="fb-root"></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like" data-href="<?php echo $this->url; ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
		<?php
	}

	public function display_button( $post ){
		?>
		<a href="http://www.facebook.com/sharer.php?u=<?php echo rawurlencode( $this->url ); ?>&amp;t=<?php echo rawurlencode( $this->title ); ?>" target="_blank">Facebook</a>
		<?php
	}

}

/**
 * LinkedIn sharing class
 *
 * @since 1.0.0
 */
class Service_LinkedIn extends WP_Share_Service{

	public function __construct( $id ){
		parent::__construct( $id );
	}

	public function get_name(){
		return __( 'LinkedIn', 'wp-share' );
	}

	public function display_original( $post ){
		?>
		<script src="//platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script><script type="IN/Share" data-url="<?php echo $this->url; ?>" data-counter="right"></script>
		<?php
	}

	public function display_button( $post ){
		?>
		<a href="https://www.linkedin.com/shareArticle?summary=<?php echo rawurlencode( $this->description ); ?>&amp;title=<?php echo rawurlencode( $this->title) ?>&amp;mini=true&amp;url=<?php echo rawurlencode( $this->url ); ?>&amp;source=<?php echo rawurlencode( get_bloginfo( 'name' ) ); ?>" target="_blank" >LinkedIn</a>
		<?php
	}

}

/**
 * GooglePlus sharing class
 *
 * @since 1.0.0
 */
class Service_GooglePlus extends WP_Share_Service{

	public function __construct( $id ){
		parent::__construct( $id );
	}

	public function get_name(){
		return __( 'Google Plus', 'wp-share' );
	}

	public function display_original( $post ){
		?>
		<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php echo $this->url; ?>"></div>
		<script type="text/javascript">
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/platform.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
		<?php
	}

	public function display_button( $post ){
		?>
		<a href="https://plus.google.com/share?url=<?php echo rawurlencode( $this->url ); ?>" target="_blank">Google</a>
	  <?php
	}

}

/**
 * Pinterest sharing class
 *
 * @since 1.0.0
 */
class Service_Pinterest extends WP_Share_Service{

	public function __construct( $id ){
		parent::__construct( $id );
	}

	public function get_name(){
		return __( 'Pinterest', 'wp-share' );
	}

	public function display_original( $post ){
		?>
		<a href="http://pinterest.com/pin/create/button/?url=<?php echo $this->url; ?>&amp;media=<?php echo $this->image; ?>&amp;description=<?php echo $this->description; ?>" class="pin-it-button" count-layout="horizontal">
		  <img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" />
		</a>
		<script type="text/javascript">
		(function(d){
		    var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
		    p.type = 'text/javascript';
		    p.async = true;
		    p.src = '//assets.pinterest.com/js/pinit.js';
		    f.parentNode.insertBefore(p, f);
		}(document));
		</script>
		<?php
	}

	public function display_button( $post ){
		if ( 1 > strlen( $this->image ) ){
			$media = '';
		} else {
			$media = '&amp;media=' . rawurlencode( $this->image );
		}
		?>
		<a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( $this->url ); ?>&amp;description=<?php echo rawurlencode( $this->title ); echo $media;?>" target="_blank">Pinterest</a>
		<?php
	}

}