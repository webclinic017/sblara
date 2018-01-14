(function ( $ ) {
	"use strict";

	$(function () {

		if ( $('.share-buttons.share-icon').length || $('.share-buttons.share-icon-text').length ) {
			$('.share-buttons a').click(function(event) {
				event.preventDefault();
				window.open( this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
			});
		}

	});

}(jQuery));