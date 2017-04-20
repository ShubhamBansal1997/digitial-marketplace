$(function() {
	
	// tooltip
	$('[data-toggle="tooltip"]').tooltip(); 
	
	//tabs	
	$(".tab-content").hide();
	$(".tabs li:first-child").addClass("active");
	$(".tab-content:first-child").show();

	$(".tabs li").click(function() {
		if (!$(this).hasClass("active")) {
			$(this).parent().find("li").removeClass("active");
			$(this).parent().next().find(".tab-content").hide();
			
			var activeTab = $(this).find("a").attr("href");
			$(this).addClass("active");
			$(this).parent().next().find(activeTab).fadeIn();
		}
		return false;
	});


// Slick slider
 $('#review').slick({
			centerMode: true,
			centerPadding: '140px',
			dots: true,
			slidesToShow: 1,
			infinite: true,
			speed: 1000,
			autoplay :true,
			arrows:false,
		
		});

// Product page slider
	 $('#productSlider').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  speed: 1000,
			autoplay :false,
		  arrows: true,
		  fade: false,
		  asNavFor: '#productSliderNav'
		});
		$('#productSliderNav').slick({
		  slidesToShow: 5,
		  slidesToScroll: 1,
		  asNavFor: '#productSlider',
		  dots: false,
		  centerMode: false,
		  focusOnSelect: true
		  
		});
		
//Accordian
	/*$(overviewAccordion).html($(overview).html());
	$(dimensionsAccordion).html($(dimensions).html());
	$(tipAccordion).html($(tip).html());
	
	$('.accordion .accordion-content').hide();
	$('.accordion .trigger:first-child').addClass('active').next().show();
	$('.accordion .trigger').click(function() {
			if($(this).next().is(':hidden')) {
				$(this).parent().find(".trigger").removeClass('active').next().slideUp(500).removeClass('open');
				$(this).toggleClass('active').next().slideDown(500).addClass('open');
			}
			return false;
	});	*/
	
	// Login register modal
	$(".LoginOpen").click(function(){ 
			$("#RegisterModal").fadeOut(500); 
			$("#LoginModal").fadeIn(1000);
		});
		$(".Registeropen").click(function(){
			$("#LoginModal").fadeOut(500);
			$("#RegisterModal").fadeIn(1000);
		});
		//close Login popup
		$("#close-login").click(function(){ $("#LoginModal").fadeOut(500); });
		//close Register popup
		$("#close-register").click(function(){ $("#RegisterModal").fadeOut(500); });	
	
});