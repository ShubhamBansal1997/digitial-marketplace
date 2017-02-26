"use strict";
(function($) {
	/*-----------------
		TWEETS
	-----------------*/	
	$('.tweets').tweet({
	    modpath: 'js/vendor/twitter/',
	    count: 2,
	    loading_text: 'Loading twitter feed...',
		username:'your_username',
		template: '<p class="feed-text">{text}</p><p class="feed-timestamp">{time}</p>'
	});
	
	/*-----------------
		ACCOUNT SETTINGS TABS
	-----------------*/
		$(".tab-content").hide();
		$(".tabs-menu li:first-child").addClass("active-tab");
		$(".tab-content:first-child").show();
	
		$(".tabs-menu li").click(function() {
		if (!$(this).hasClass("active")) {
			$(this).parent().find("li").removeClass("active-tab");
			$(this).parent().next().find(".tab-content").hide();
			
			var activeTab = $(this).find("a").attr("href");
			$(this).addClass("active-tab");
			$(this).parent().next().find(activeTab).fadeIn();
		}
		return false;
    	});

	/*-----------------
		LOGIN REGISTER POP UP
	-----------------*/
	
	//open Login popup
	$(".LoginOpen").click(function(){ $("#RegisterPopup").fadeOut(500); $("#LoginPopup").fadeIn(1000);//toggleVisibility('#mobile-menu' );
		
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 			if( $('#mobile-menu' ).hasClass('open') ) {
				$('#mobile-menu' ).removeClass('open').addClass('closed');
				$('.shadow-film').removeClass('open').addClass('closed');
			} 
		}
		
	 });
	//close Login popup
	$("#close-login").click(function(){ $("#LoginPopup").fadeOut(500); });
	//open Register popup
	$(".Registeropen").click(function(){ $("#LoginPopup").fadeOut(500); $("#RegisterPopup").fadeIn(1000);
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 			if( $('#mobile-menu' ).hasClass('open') ) {
				$('#mobile-menu' ).removeClass('open').addClass('closed');
				$('.shadow-film').removeClass('open').addClass('closed');
			}
		}
	//toggleVisibility('#mobile-menu' ); 
	});
	//close Register popup
	$("#close-register").click(function(){ $("#RegisterPopup").fadeOut(500); });
	//open FORGOT password popup
	$(".ForgotOpen").click(function(){ $("#LoginPopup").fadeOut(500); $("#ForgotPopup").fadeIn(1000); });
	//open FORGOT password popup
	$("#close-forgot").click(function(){ $("#ForgotPopup").fadeOut(500); });

	

	
})(jQuery);