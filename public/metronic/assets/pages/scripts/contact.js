var Contact = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#gmapbg',
				lat: 23.7527621,
				lng: 90.392491
			  });
			   var marker = map.addMarker({
				lat: 23.7527621,
				lng: 90.392491,
		            title: 'Stock Bangladesh Limited.',
		            infoWindow: {
		                content: "<b>Stock Bangladesh Limited.</b> <br>Level 14, Dhaka Trade Center,<br> 99 Kazi Nazrul Islam Avenue,<br>Kawran Bazar, Dhaka 1215,<br>Bangladesh"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();

jQuery(document).ready(function() {    
   Contact.init(); 
});

