(function ( $ ) {
	"use strict";

	$(function () {

		$( "#available-services, #enabled-services" ).sortable({
      connectWith: ".services-connection"
    }).disableSelection();

    $( "#enabled-services" ).on( "sortreceive out sort", function( event, ui ) {
    	var enabled = [];
    	var serviceList = $(this);
    	setTimeout( function(){
    		serviceList.find('li').each(function(index, el) {
	    		enabled.push( $(el).attr('id') );
	    	});
	    	$('#button-order').val( enabled.splice(',') );
    	}, 1000 );
    } );

	});

}(jQuery));