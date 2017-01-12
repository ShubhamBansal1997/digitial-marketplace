/*
Copyright © 2016 Themeportal
------------------------------------------------------------------
[Homepage Javascript]

Project:	Themeportal

-------------------------------------------------------------------*/

(function ($) {
	"use strict";
	var themeportal = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			/*-------------- themeportal Functions Calling ---------------------------------------------------
			------------------------------------------------------------------------------------------------*/
			this.Initialize();
			this.ShowProducts();
			this.SearchSection();
			this.CartCheckout();
			this.PopupJS();
		},

		/*-------------- themeportal Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/

		PreLoader: function () {
			jQuery("#status").fadeOut();
			jQuery("#preloader").delay(350).fadeOut("slow");
		},
		Initialize: function(){

            // Client Say Slider
            var owl =  $(".ts_client_say_slider .owl-carousel");
            owl.owlCarousel({
                loop:true,
                items:1,
                dots: true,
                nav: false,
                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                autoHeight: false,
                touchDrag: false,
                mouseDrag: false,
                margin:10,
                autoplay:true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                    },
                    600:{
                        items:1,
                    },
                    1000:{
                        items:1,
                    }
                }
            });

            // initialise Stellar js
                $(window).stellar();
				
			// Second Menu Hide ShowProducts
			$("#menu_show").click(function(){
				$("#menu_hide").slideToggle();
			});

            // Menu show Hide
            var counter = 0;
            $('.ts_menu_btn').click(function(){
                if( counter == 0 ) {
                    $('.ts_main_menu_wrapper').addClass('ts_main_menu_hide');
                    $(this).children().removeAttr('class');
                    $(this).children().attr('class','fa fa-close');
                    counter++;
                }
                else {
                    $('.ts_main_menu_wrapper').removeClass('ts_main_menu_hide');
                    $(this).children().removeAttr('class');
                    $(this).children().attr('class','fa fa-bars');
                    counter--;
                }
            });

            // Main Menu on Responsive
            $('.ts_main_menu ul li a.first_sb').on('click',function() {
               $('.ts_main_menu ul li a.first_sb').not($(this)).parent('li').find('ul.sub_menu:first').slideUp(10);
               $(this).parent('li').find('ul.sub_menu:first').slideToggle(10);
              var arrow =  $(this).find('i');
              if(arrow.hasClass('fa-angle-down')){
                  arrow.attr('class','fa fa-angle-right');
              }else{
                   arrow.attr('class','fa fa-angle-down');
              }

            });

            $('.ts_main_menu ul li ul.sub_menu li a.second_sb').on('click',function() {
                $('.ts_main_menu ul li ul.sub_menu li a').not($(this)).parent('li').find('ul.sub_menu').slideUp(10);
                $(this).parent('li').find('ul.sub_menu').slideToggle(10);
                var arrow =  $(this).find('i');
                  if(arrow.hasClass('fa-angle-down')){
                      arrow.attr('class','fa fa-angle-right');
                  }else{
                       arrow.attr('class','fa fa-angle-down');
                  }
            });

		},
		ShowProducts: function () {
		    $('.cateCls').on('click',function(){
		        $('.cateCls').removeClass('ts_cate_active');
		        var idd = $(this).attr('id');
		        var basepath = $('#basepath').val();
		        var dataArr = {};
                dataArr [ 'cid' ] = idd;
                $(this).addClass('ts_cate_active');
                $.post(basepath+"home/get_ajx_products",dataArr,function(data, status) {
                   $('.LatestThemeDiv').html('');
                   $('#inside_loader').removeClass('hideme');
                   if(data != '0') {
                        var dataStr = $.parseJSON(data);
                        $('.LatestThemeDiv').html(dataStr);
                   }
                   $('#inside_loader').addClass('hideme');
                });
		    });
		},
		SearchSection: function () {
		    $('#searchInputBtn').on('click',function(){
		        internalsearchfunction();
		    });
		    $('#searchInput').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    internalsearchfunction();
                }
            });
		    function internalsearchfunction() {
                var searchInput = $('#searchInput').val();
                var basepath = $('#basepath').val();

                if( searchInput != '' ) {
                    window.location.href = basepath+"home/products/"+searchInput;
                }
            }
		},
		CartCheckout: function(){
		    var basepath = $('#basepath').val();
		    $('#checkoutBtnCart').on('click',function(){
		    	var paid_total = ($('.paid_total').html()).split(' ');	
		    	console.log(paid_total);
		    	if( paid_total[1] == 0 ) {
		    		$('.paymentmethod').attr('style','display:none;');
		    		$('.paymentmethod_cls').addClass('hideme');
		    	}
		    	else {
		    		$('.paymentmethod').removeAttr('style','display:none;');
		    		$('.paymentmethod_cls').removeClass('hideme');
		    	}
		        $('.ts_cmn_checkoutbox').each(function(){
		           if( !$(this).is('.hideme') ) {
		                $(this).addClass('hideme');
		           }
		        });
		        var whetherlogin = $('#whetherlogin').val();
		        if(whetherlogin == '1') {
		            $('#payment_checkoutbox').removeClass('hideme');
		        }
		        else {
		            $('#login_checkoutbox').removeClass('hideme');
		        }
		    });

		    $('.authenticateBtnCart').on('click',function(){
		        $('.ts_cmn_checkoutbox').each(function(){
		           if( !$(this).is('.hideme') ) {
		                $(this).addClass('hideme');
		           }
		        });
		        var type = $(this).attr('data-type');
		        $('#'+type+'_checkoutbox').removeClass('hideme');
		    });

            $('.paymentmethod').change(function(){
                var paymentmethod = $(this).val();
                $('.paymentmethod_cls').attr('src',basepath+'themes/default/images/'+paymentmethod+'_logo.png');
            });

            $('.cartloginfields').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    loginfromcartpage();
                }
            });
            $('.cartregisterfields').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    registerfromcartpage();
                }
            });
            
            /*** Discount Coupons ****/
            
            $('body').on('click','.apply_coupons',function(){
                var prodID = ($(this).attr('id')).split('_')[1];
                $('#coup_code_text').val('');
                $('.coup_code_btn').attr('data-prod',prodID);
                $('.coup_code_btn').attr('data-type',$(this).attr('data-type'));
                $('#apply_coupons').modal('show');
            });
            
            $('.coup_code_btn').on('click',function(event){
            	var c_code = $.trim($('#coup_code_text').val());
            	var prod_id = $('.coup_code_btn').attr('data-prod');
            	var prod_type = $('.coup_code_btn').attr('data-type');
            	if( c_code != '' ) {
            		var dataArr = {};
            		dataArr['coupon_code'] = c_code;
            		dataArr['prodID'] = prod_id;
            		dataArr['prod_type'] = prod_type;
					$.post(basepath+"shop/verify_coupon_code",dataArr,function(data, status) {
						if(data == '2') {
							$('.ts_message_popup_text').text($('#coupincorrecterr_text').val());
							$('.ts_message_popup').addClass('ts_popup_error');	
							removeMessage();
						}
						else if(data == '3') {
							$('.ts_message_popup_text').text($('#coupexpirederr_text').val());
							$('.ts_message_popup').addClass('ts_popup_error');	
							removeMessage();
						}
						else {
							var cost_arr = data.split('@#');
							var discount_total = ($('.discount_total').html()).split(' ');
							var paid_total = ($('.paid_total').html()).split(' ');
														
							var show_discount = parseFloat(cost_arr[1]) + parseFloat(discount_total[1]);
							
							$('.discount_total').html(discount_total[0]+' '+parseFloat(show_discount));
							
							var show_total = paid_total[1] - cost_arr[0];
							var show_final_amount = parseFloat(show_total) + parseFloat(cost_arr[2]);
							
							$('.paid_total').html(discount_total[0]+' '+parseFloat(show_final_amount));
							
							$('#coup_'+prod_id).html($('#appliedtext_text').val()+' <i class="fa fa-times"></i>');
							$('#coup_'+prod_id).removeAttr('class');
							$('#coup_'+prod_id).attr('onclick','remove_coupon(this)');
							$('.ts_message_popup_text').text($('#coupsuccess_text').val());
							$('.ts_message_popup').addClass('ts_popup_success');
							removeMessage();
							$('#apply_coupons').modal('hide');
							return false;
						}
					});
				}
				else {
					$('.ts_message_popup_text').text($('#coupemptyerr_text').val());
					$('.ts_message_popup').addClass('ts_popup_error');	
					removeMessage();
				}
            });
            
		},
		PopupJS: function(){
		    // popup close
            $('.ts_popup_close').on('click', function(){
            
			// Stop Audio / Video Play on Popup Close
				if( $('#tp_audio').length > 0 ) {
					$('#tp_audio')[0].pause();
					$('#tp_audio')[0].currentTime = 0;
				}
				
				if( $('#tp_video').length > 0 ) {
					$('#tp_video')[0].pause();
					$('#tp_video')[0].currentTime = 0;
				}

               // $('.ts_popup_wrapper').addClass('popup_close');
                $('.ts_popup_wrapper').removeClass('popup_open');
            });
		}
	};

	themeportal.init();

	// Load Event
	$(window).on('load', function() {
		themeportal.PreLoader();
	});

	// pagination form
	$('.ts_pagination>ul>li>a').click(function(){
		$(this).closest('.ts_pagination').append('<form method="post" style="display:none;" id="paginationForm"><input type="text" name="paginationCount" value="'+$(this).parent().attr('data')+'"></form>');
		$('#paginationForm').submit();
	});
	
	// MFP Popup JS
	if($('.popup-gallery').length){
	  $('.popup-gallery').magnificPopup({
	   delegate: 'a',
	   type: 'image',
	   tLoading: 'Loading image #%curr%...',
	   mainClass: 'mfp-img-mobile',
	   gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	   },
	   image: {
		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		titleSrc: function(item) {
		 return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
		}
	   }
	  });
	 }

})(jQuery);

/********** Remove Error / Success Message *************/
function removeMessage(){
    if( $('.ts_message_popup').is('.ts_popup_error') || $('.ts_message_popup').is('.ts_popup_success') ) {
        setTimeout(function(){
            $('.ts_message_popup_text').text('');
            $('.ts_message_popup').removeClass('ts_popup_error ts_popup_success');
        }, 3000);
    }
}

/************** Subscribe Email STARTS *********************/

function subscribe_email(type){
    var em = $('#email_from_'+type).val();
    var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;

    var err = 0;
    if( em == '' || !emRegex.test(em)) {
        $('.ts_message_popup_text').text($('#emailerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
        removeMessage();
        err++;
        return false;
    }

    if( err == '0' ) {
        var dataArr = {} ;
        dataArr['emails'] = em;
        dataArr['type'] = type;

        var basepath = $('#basepath').val();
        $.post(basepath+"home/subscribe_email",dataArr,function(data, status) {
            if(data != '0'){
                $('.ts_message_popup_text').text($('#newslettersucsuc_text').val());
                $('.ts_message_popup').addClass('ts_popup_success');
            }
            else {
                $('.ts_message_popup_text').text($('#newslettersucerr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
            }
            $('#email_from_'+type).val('');
            removeMessage();
        });
    }
}

/************** Subscribe Email ENDS *********************/

/*************** Register / Login from Cart Page STARTS **************/
function registerfromcartpage(){
    $('.ts_submit_wait').removeClass('hideme');
    var uname = $.trim($('#reg_uname').val());
    var pwd = $.trim($('#reg_pwd').val());
    var email = $.trim($('#reg_email').val());
    var dataArr = {};
    if( uname != '' && pwd != '' && email != '' ) {
        var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;

        if(!emRegex.test(email)) {
            $('.ts_message_popup_text').text($('#emailerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            $('.ts_submit_wait').addClass('hideme');
            removeMessage();
            return false;
        }
        else {
            if( pwd.length > 7 ) {
                dataArr['users_uname'] = uname;
                dataArr['users_pwd'] = pwd;
                dataArr [ 'users_email' ] = email;
                getuserin_fromcart(dataArr);
                return false;
            }
            else {
                $('.ts_message_popup_text').text($('#pwderr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
                $('.ts_submit_wait').addClass('hideme');
                removeMessage();
                return false;
            }
        }
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();
        return false;
    }
}
function loginfromcartpage() {
    $('.ts_submit_wait').removeClass('hideme');
    var uname = $.trim($('#users_uname').val());
    var pwd = $.trim($('#users_pwd').val());
    var dataArr = {};
    if( uname != '' && pwd != '' ) {

        dataArr['users_uname'] = uname;
        dataArr['users_pwd'] = pwd;
        dataArr[ 'rem_me' ] = 0;
        getuserin_fromcart(dataArr);
        return false;
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();
        return false;
    }
}

function getuserin_fromcart(dataArr){
    var basepath = $('#basepath').val();
    $.post(basepath+"authenticate/getuserin_section",dataArr,function(data, status) {
        var resStr = data.split('#');
        if(resStr[1] == 'redirect'){
            $('.ts_message_popup_text').text($('#loginsuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            $('.validate').parent().addClass('ts_success_input');
            setInterval(function(){
               $('#login_checkoutbox').addClass('hideme');
               $('#payment_checkoutbox').removeClass('hideme');
            }, 2000);
        }
        else if(resStr[1] == 'adminredirect'){
            $('.ts_message_popup_text').text($('#loginsuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            $('.validate').parent().addClass('ts_success_input');
            setInterval(function(){
               window.location = basepath+"backend";
            }, 2000);
        }
        else if(resStr[1] == 'register'){
            $('.validate').parent().addClass('ts_success_input');
            $('.ts_message_popup_text').text($('#registersuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            setInterval(function(){
               $('#register_checkoutbox').addClass('hideme');
               $('#payment_checkoutbox').removeClass('hideme');
            }, 2000);
        }
        else if(resStr[0] == 2){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#actvtacnt_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 3){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#blockacnt_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 0){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#loginerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 6){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#usernameexists_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        else if(resStr[0] == 7){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#emailexists_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();
    });
}
/*************** Login from Cart Page ENDS **************/


/**************** Initiate payment after clicking Proceed STARTS ************/

function initiatepayment(){
	var basepath = $('#basepath').val();
	var paid_total = ($('.paid_total').html()).split(' ');	
	$('.ts_proceed_wait').removeClass('hideme');
	var paymentmethod = '';

	$('.paymentmethod').each(function(){
		paymentmethod = $(this).val();
	});
	var basepath = $('#basepath').val();
	if( paymentmethod != '' ) {		
		var dataArr = {};
		dataArr [ 'paymentmethod' ] = paymentmethod;
		dataArr [ 'total_paid' ] = paid_total[1];
		$.post(basepath+"shop/proceed_payment",dataArr,function(data, status) {
			console.log(data);
			if(data == '0') {
				$('.ts_message_popup_text').text('Server error.');
				$('.ts_message_popup').addClass('ts_popup_error');
				$('.ts_proceed_wait').addClass('hideme');
				window.location.reload(1);
			}
			else if(data == 'PURCHASED') {
				window.location.href = basepath+"dashboard/purchased";
			}
			else if(data == 'EXISTS') {
				window.location.href = basepath+"dashboard/purchased";
			}
			else if(data == 'OWNER') {
				window.location.href = basepath+"vendorboard";
			}
			else if(data == 'empty') {
				$('.ts_message_popup_text').text($('#emptycart_text').val());
				$('.ts_message_popup').addClass('ts_popup_error');
				$('.ts_proceed_wait').addClass('hideme');
			}
			else {
				$('#pay_form_box').html(data);
				if( paymentmethod == 'payu') {
					$('form[name="payuForm"]').submit();
				}
				else if( paymentmethod == 'paypal') {
					$('form[name="pay_form_name"]').submit();
				}
				else if( paymentmethod == 'stripe') {
					$('.ts_proceed_wait').addClass('hideme');
				}
				else if( paymentmethod == '2checkout') {
					$('form[name="2checkout"]').submit();
				}
				else if( paymentmethod == 'webmoney') {
					$('form[name="pay"]').submit();
				}
				else if( paymentmethod == 'tpay') {
					$('form[name="tpay_form_name"]').submit();
				}
				else if( paymentmethod == 'pagseguro') {
					$('form[name="pagseguro_form_name"]').submit();
				}
				else if( paymentmethod == 'permoney') {
					$('form[name="permoney_form_name"]').submit();
				}

			}
			removeMessage();

		});
		return false;
	}
}
/**************** Initiate payment after clicking Proceed ENDS ************/

/************** Send contact form STARTS *******************/
function sendcontactform($this){
    var err = 0;
    var dataArr = {};
    var waittext = $('#waittext').val();
    var sendtext = $('#sendtext').val();
    $($this).html(waittext+' <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
    $($this).removeAttr('onclick');
    $('.validate').each(function(){
        var v = $.trim($(this).val());
        var i = $(this).attr('id');
        if( v == '' ) {
            err++;
        }
        else {
            dataArr[i] = v;
        }
    });
    if(err == 0) {

        if( $('#email').length > 0 ) {
            var em = $('#email').val();
            var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
            if(!emRegex.test(em)) {
                $('.ts_message_popup_text').text($('#emailerr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
                err++;
            }
        }

        if( err == 0 ) {
            var basepath = $('#basepath').val();
            $.post(basepath+"home/contact",dataArr,function(data, status) {
                if(data == '1') {
                    $('.ts_message_popup_text').text($('#contactsuc_text').val());
                    $('.ts_message_popup').addClass('ts_popup_success');
                }
                else {
                    $('.ts_message_popup_text').text($('#emailerr_text').val());
                    $('.ts_message_popup').addClass('ts_popup_error');
                }
                setTimeout(function(){
                    window.location.reload(1);
                }, 3000);
            });
            return false;
        }
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
    }
    $($this).html(sendtext+' <i class="fa fa-rocket" aria-hidden="true"></i>');
    $($this).attr('onclick','sendcontactform(this);');
    removeMessage();
    return false;
}
/************** Send contact form ENDS *******************/

/************** Image Gallery STARTS **********************/
    function openthegalleryimages(prodId,type){
        var dataArr = {};
        dataArr['prodId'] = prodId;
        var basepath = $('#basepath').val();
        $.post(basepath+"home/getgalleryimages",dataArr,function(data, status) {
            if( data != '0' ) {
            	if( type == 'other' ) {
                	$('#popupgallery ul').append(data);
                }
                else if( type == 'audio' ) {
					$('#tp_audio')[0].play();
                }
                else if( type == 'video' ) {
                	$('#tp_video')[0].play();
                }
            }
            $('.ts_popup_wrapper').addClass('popup_open');

        });
        return false;
    }
/************** Image Gallery ENDS **********************/

/**************** Manual Transactions START ****************/
    function transactionDone($this){
        if( $($this).is(':checked') ) {
            $('.transactionDone_div').css('display','block');
        }
        else {
            $('.transactionDone_div').css('display','none');
        }
    }

    function savetransactionmadedetails(){
        $('.ts_transactionDone_wait').removeClass('hideme');
        var txtDetails = $.trim($('.transactionDone_textarea').val());
        if( txtDetails != '' ) {
            var dataArr = {};
            dataArr['txtDetails'] = txtDetails;
            var basepath = $('#basepath').val();
            $.post(basepath+"shop/savetransactionmadedetails",dataArr,function(data, status) {
                if(data == '1') {
                    window.location = basepath+"pages/wait_for_approval";
                }
            });
        }
        else {
            $('.ts_message_popup_text').text($('#emptyerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }
    }
/**************** Manual Transactions ENDS ****************/

/**************** User to Vendor Process STARTS *******************/
    function become_a_vendor(type){
        var tnc_chek = $('#tnc:checked').length;
        if(tnc_chek == '1') {
            if( type == 'plans' ) {
                var basepath = $('#basepath').val();
                window.location = basepath+"home/vendor_plans";
            }
            else {
                var dataArr = {};
                dataArr['comm'] = 'comm';
                var basepath = $('#basepath').val();
                $.post(basepath+"dashboard/complete_vendor",dataArr,function(data, status) {
                    setTimeout(function(){
                        window.location = basepath+"vendorboard";
                    }, 3000);
                });
            }
        }
        else {
            $('.ts_message_popup_text').text($('#checkpop_error').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }
    }
/**************** User to Vendor Process ENDS *******************/
/************** Send Query form to Vendor STARTS *******************/
function sendvendorcontactform($this){
    var msg = $.trim($('#vendorMessage').val());
    $($this).removeAttr('onclick','');
    if( msg != '' ) {
        var dataArr = {};
        dataArr [ 'msg' ] = msg;
        dataArr [ 'vid' ] = $($this).attr('data-vendor');
        var basepath = $('#basepath').val();
        $.post(basepath+"home/vendor_contact",dataArr,function(data, status) {
            if(data == '1') {
                $('.ts_message_popup_text').text($('#contactsuc_text').val());
                $('.ts_message_popup').addClass('ts_popup_success');
            }
            else {
                $('.ts_message_popup_text').text($('#emptyerr_text').val());
                $('.ts_message_popup').addClass('ts_popup_error');
            }
            setTimeout(function(){
                window.location.reload(1);
            }, 3000);
        });
        return false;
    }
    else {
        $('.ts_message_popup_text').text($('#emptyerr_text').val());
        $('.ts_message_popup').addClass('ts_popup_error');
    }
    $($this).attr('onclick','sendvendorcontactform(this);');
    removeMessage();
    return false;
}
/************** Send Query form to Vendor ENDS *******************/

/********************** Set Cookie Language STARTS **********************/

	function set_cookie_language($this) {
		var lan = $($this).val();
		document.cookie = "language="+lan+"; path=/";
		window.location.reload(1);
	}
	
/********************** Set Cookie Language ENDS **********************/

/*********************** Remove Coupons STARTS ***********************/
	
	function remove_coupon($this) {
		var basepath = $('#basepath').val();
		var prod_id = ($($this).attr('id')).split('p_')[1];
		var dataArr = {};
		dataArr['prod_ID'] = prod_id;
		dataArr['prod_type'] = $($this).attr('data-type');
		$.post(basepath+"shop/verify_coupon_code",dataArr,function(data, status) {
			if(data == '0') {
				$('.ts_message_popup_text').text('Server Error');
			}
			else {
				var cost_arr = data.split('@#');
				var discount_total = ($('.discount_total').html()).split(' ');
				var paid_total = ($('.paid_total').html()).split(' ');
											
				var show_discount = parseFloat(discount_total[1]) - parseFloat(cost_arr[1]);
				
				$('.discount_total').html(discount_total[0]+' '+parseFloat(show_discount))
				
				var show_total = paid_total[1] - cost_arr[2];
				var show_final_amount = parseFloat(show_total) + parseFloat(cost_arr[0]);
				
				$('.paid_total').html(discount_total[0]+' '+parseFloat(show_final_amount));
				
				$('#coup_'+prod_id).html($('#applytext_text').val());
				$('#coup_'+prod_id).removeAttr('onclick');
				$('#coup_'+prod_id).attr('class','apply_coupons');
				$('.ts_message_popup_text').text($('#coupremoved_text').val());
				$('.ts_message_popup').addClass('ts_popup_success');
				removeMessage();
				return false;
			}
		});
	
	
	}

/*********************** Remove Coupons ENDS ***********************/
	