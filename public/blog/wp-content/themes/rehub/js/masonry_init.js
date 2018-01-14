jQuery(document).ready(function($) {
'use strict';	
var $containerfull = $('.masonry_grid_fullwidth');
$containerfull.imagesLoaded( function() {
	$containerfull.addClass('loaded');
	$containerfull.masonry({
	    itemSelector: '.small_post',   
	});
});
});