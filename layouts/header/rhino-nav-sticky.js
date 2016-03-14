// Class swap for sticky header
jQuery(document).ready(function($) {

	$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		if (scroll > 0) {
			$("#header-container").addClass("container-scroll");
		} else {
			$("#header-container").removeClass("container-scroll");
		}

	});

	var height = $( "#header-container" ).height(); // get the height of the header dynamically.
	$(".rhino_nav_sticky_wrap,#rockhouse-powered").css( "top", height);  // add the height of the header to the content css class.

});
