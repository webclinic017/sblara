//Addblock notify
jQuery(document).ready(function($) {
'use strict';    
  	var noblockad = $('#noblockdiv').html();
	$(".mediad").each(function(){
	  	if ($(this).height() == 0) 
	  		$(this).html(noblockad);
	});
	$(".single_custom_bottom").each(function(){
	  	if ($(this).height() == 0) 
	  		$(this).html(noblockad);
	});	
});