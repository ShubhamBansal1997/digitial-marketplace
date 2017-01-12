/*
Copyright © 2016 Themeportal
------------------------------------------------------------------
[Authentication Javascript]

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
			this.Auth();
			this.WindowHeight();
		},

		/*-------------- themeportal Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/

		PreLoader: function () {
			jQuery("#status").fadeOut();
			jQuery("#preloader").delay(350).fadeOut("slow");
		},
		WindowHeight: function(){
			var window_height = window.innerHeight;
			$(".ts_login_page").css("height", window_height);
		},
		Auth: function(){
		// on enter submit every form
            $('.validate').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    checkformvalidation();
                }
            });
		    $('.validate').on('blur', function(){

                var err_count = 0;
    			var CurrentId = $(this).attr('id');
				var CurrentCls = $(this).parent();
                CurrentCls.removeClass('ts_error_input');
                CurrentCls.removeClass('ts_success_input');

                if( $.trim($(this).val()) == '' ) {

                    CurrentCls.addClass('ts_error_input');
					CurrentCls.removeClass('ts_success_input');
                    err_count++;
                }
                else {
                    var clsStr = $(this).attr('class');

                    if( clsStr.search('email') != -1 ) {

                        var em = $.trim($(this).val());
                        var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;

                        if(!emRegex.test(em)) {
                            CurrentCls.addClass('ts_error_input');
					        CurrentCls.removeClass('ts_success_input');
                             err_count++;
                        }
                    }

                    if( clsStr.search('pwd') != -1 ) {

                        var pwd = $.trim($(this).val());

                        if(pwd.length < 7) {
                            CurrentCls.addClass('ts_error_input');
					        CurrentCls.removeClass('ts_success_input');
                             err_count++;
                        }
                    }

                    if( clsStr.search('repwd') != -1 ) {

                        var repwd = $.trim($(this).val());
                        var pwd = $.trim($('.pwd').val());

                        if(pwd != repwd) {
                            CurrentCls.addClass('ts_error_input');
					        CurrentCls.removeClass('ts_success_input');
                             err_count++;
                        }
                    }
                }

                if( err_count == 0 ) {
                    CurrentCls.addClass('ts_success_input');
                    CurrentCls.removeClass('ts_error_input');
                }
			});
		}
	};

	themeportal.init();

	// Load Event
	$(window).on('load', function() {
		themeportal.PreLoader();
	});
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

/* Validate All Input Fields Function */

function checkformvalidation(){
var err_count = 0;
var dataArr = {};
$('.ts_submit_wait').removeClass('hideme');
    $('.validate').each(function() {

        var CurrentId = $(this).attr('id');
        var CurrentCls = $(this).parent();
        CurrentCls.removeClass('ts_error_input');
        CurrentCls.removeClass('ts_success_input');

        if( $.trim($(this).val()) == '' ) {

            CurrentCls.addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#emptyerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            err_count++;
        }
        else {
            var clsStr = $(this).attr('class');

            CurrentCls.addClass('ts_error_input');

            if( clsStr.search('username') != -1 ) {

                var username = $.trim($(this).val());
                if(/^[a-zA-Z0-9]*$/.test(username) == false || username.length > 10) {
                    $('.ts_message_popup_text').text($('#usernameerr_text').val());
                    $('.ts_message_popup').addClass('ts_popup_error');
                     err_count++;
                }
            }

            if( clsStr.search('email') != -1 ) {

                var em = $.trim($(this).val());
                var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;

                if(!emRegex.test(em)) {
                    $('.ts_message_popup_text').text($('#emailerr_text').val());
                    $('.ts_message_popup').addClass('ts_popup_error');
                     err_count++;
                }
            }

            if( clsStr.search('pwd') != -1 ) {

                var pwd = $.trim($(this).val());

                if(pwd.length < 7) {
                    $('.ts_message_popup_text').text($('#pwderr_text').val());
                    $('.ts_message_popup').addClass('ts_popup_error');
                     err_count++;
                }
            }

            if( clsStr.search('repwd') != -1 ) {

                var repwd = $.trim($(this).val());
                var pwd = $.trim($('.pwd').val());

                if(pwd != repwd) {
                    $('.ts_message_popup_text').text($('#repwderr_text').val());
                    $('.ts_message_popup').addClass('ts_popup_error');
                     err_count++;
                }
            }
        }

        if( err_count == 0 ) {
            dataArr[ $(this).attr('id') ] = $(this).val() ;
        }
    });


    if( err_count == 0 ){
        // signup form
        ( $('#register_typepage').length > 0 ) ? submit_loginform(dataArr) : '' ;

        // forgot password form
        ( $('#forgotpwd_typepage').length > 0 ) ? submit_loginform(dataArr) : '' ;

        // reset password form
        ( $('#resetpwd_typepage').length > 0 ) ? submit_resetpwdform(dataArr) : '' ;

        // Login form
        ( $('#login_typepage').length > 0 ) ? submit_loginform(dataArr) : '' ;

        // Change Password - Account Page
        ( $('#changepwdfromaccount').length > 0 ) ? changepwdfromaccount(dataArr) : '' ;
    }
    else {
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();
    }

}


/* Login Form link */

function submit_loginform(dataArr) {
   // $('.ts_btn').removeAttr('onclick');
    $('.ts_submit_wait').removeClass('hideme');
    if( $('#remember_me').length > 0 ) {
        var rem_me = $('#remember_me:checked').length;
        dataArr [ 'rem_me' ] = rem_me;
    }

    $('.validate').parent().removeClass('ts_success_input ts_error_input');
    var basepath = $('#basepath').val();
    $.post(basepath+"authenticate/getuserin_section",dataArr,function(data, status) {
console.log(data);
        var resStr = data.split('#');
        if(resStr[1] == 'redirect'){
            $('.ts_message_popup_text').text($('#loginsuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            $('.validate').parent().addClass('ts_success_input');
            setInterval(function(){
               window.location = basepath+"dashboard";
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
        else if(resStr[1] == 'email'){
            $('.validate').parent().addClass('ts_success_input');
            $('.ts_message_popup_text').text($('#forgotpwdsuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            setInterval(function(){
               window.location = basepath+"authenticate/login";
            }, 5000);
        }
        else if(resStr[1] == 'register'){
            $('.validate').parent().addClass('ts_success_input');
            $('.ts_message_popup_text').text($('#registersuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
            setInterval(function(){
               window.location = basepath+"authenticate/login";
            }, 5000);
        }
        else if(resStr[0] == 2){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#actvtacnt_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            $('.ts_btn').attr('onclick','checkformvalidation()');
        }
        else if(resStr[0] == 3){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#blockacnt_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            $('.ts_btn').attr('onclick','checkformvalidation()');
        }
        else if(resStr[0] == 0){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#loginerr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            $('.ts_btn').attr('onclick','checkformvalidation()');
        }
        else if(resStr[0] == 6){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#usernameexists_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            $('.ts_btn').attr('onclick','checkformvalidation()');
        }
        else if(resStr[0] == 5){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text($('#forgotpwderr_text').val());
            $('.ts_message_popup').addClass('ts_popup_error');
            $('.ts_btn').attr('onclick','checkformvalidation()');
        }
        else if(resStr[0] == 404){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text('Server Error. Page will refreshed in 3 seconds.');
            $('.ts_message_popup').addClass('ts_popup_error');
            setInterval(function(){
               window.location.reload(1);
            }, 3000);
        }
        $('.ts_submit_wait').addClass('hideme');
        removeMessage();

    });
}


/* Reset Password */

function submit_resetpwdform(dataArr) {
    $('.ts_btn').removeAttr('onclick');
    $('.validate').parent().removeClass('ts_success_input ts_error_input');
    var basepath = $('#basepath').val();
    dataArr [ 'key' ] = $('#pwdKey').val();
    $.post(basepath+"authenticate/update_resetpwdform",dataArr,function(data, status) {
        var resStr = data.split('#');
        if(resStr[1] == 'suc'){
            $('.validate').parent().addClass('ts_success_input');
            $('.ts_message_popup_text').text($('#pwdchngsuc_text').val());
            $('.ts_message_popup').addClass('ts_popup_success');
        }
        if(resStr[1] == 'ts_popup_error'){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text('Server Error. Page will refreshed in 3 seconds.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        setInterval(function(){
           window.location = basepath+"authenticate/login";
        }, 4000);
    });
}

/* Change Password - Account Page */

function changepwdfromaccount(dataArr) {
    $('.ts_btn').removeAttr('onclick');
    $('.validate').parent().removeClass('ts_success_input ts_error_input');
    var basepath = $('#basepath').val();
    $.post(basepath+"account/change_password",dataArr,function(data, status) {
        if(data == 'ts_popup_success'){
            $('.validate').parent().addClass('ts_success_input');
            $('.ts_message_popup_text').text('Password changed successfully.');
            $('.ts_message_popup').addClass('ts_popup_success');
            setInterval(function(){
                $('.validate').parent().removeClass('ts_success_input');
                $('.ts_message_popup_text').text('Password changed successfully.');
                $('.ts_message_popup').removeClass('ts_popup_success');
            }, 4000);
        }
        if(data == 'ts_popup_error'){
            $('.validate').parent().addClass('ts_error_input');
            $('.ts_message_popup_text').text('Server Error. Page will refreshed in 3 seconds.');
            $('.ts_message_popup').addClass('ts_popup_error');
            setInterval(function(){
               window.location.reload(1);
            }, 3000);
        }
    });
}
