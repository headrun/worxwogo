(function($) {
    $(window).on('load', function() {
        $('#preloader').modal({
            backdrop: 'static',
            keyboard: false
        });

        setTimeout(function() {
            $("#preloader").fadeOut(function() {
                $('.modal-backdrop.in').css('opacity', '0');
                $('#preloader').modal('hide');
            });
        }, 100);

    });



    $(document).ready(function() {
        function common() {
            $('#sessionerror').html('');


            $('.passworddiv').hide('slow');

            $(".login").css('border-bottom', '0px white solid');

            //reset data
            $('#mobileNumber').val('');
            $('#password').val('');

            //error reset
            $('#mobileNumber').parent().removeClass('has-error');
            $('#mobileNumber').parent().removeClass('has-feedback');
            $('.remove').css("display", "none");
            $('#password').val('');
            $('#confirmpassword').val('');
            $('#password').parent().removeClass('has-error');
            $('#password').parent().removeClass('has-feedback');
            $('.passremove').css("display", "none");
            $('#confirmpassword').parent().removeClass('has-error');
            $('#confirmpassword').parent().removeClass('has-feedback');
            $('.confirmpassremove').css("display", "none");
            $('#errormsg').empty();
            $('#ajaxmsg').empty();
            $('#otppassword').val('');
            $('#otppassword').parent().removeClass('has-error');
            $('#otppassword').parent().removeClass('has-feedback');
            $('.otppassremove').css("display", "none");

        }
        $('.register').click(function() {
            $('#ajaxmsg').empty();
            $('#ajaxmsg').css('display', 'block');
            // removing forgotpassword
            $('.forgotpassword').css('display', 'none');
            // changing value of submit btn
            $(".btn-submit").html('Continue to Register');
            $(".register").css('border-bottom', '2px white solid');
            $('.resendotp').css('font-size', 'smaller');
            common();


        });

        $('.forgotpassword').click(function() {
            $('#ajaxmsg').empty();
            $('#ajaxmsg').css('display', 'block');
            $(".btn-submit").html('Continue to Update Password');
            $(".btn-submit").css('font-size', 'smaller');
            $(".register").css('border-bottom', '0px white solid');
            // removing forgotpassword
            $('.forgotpassword').css('display', 'none');
            common();
        });

        $('.login').click(function() {
            $('#ajaxmsg').empty();
            $('#ajaxmsg').css('display', 'none');
            $('.mobilenodiv').show('slow');
            $('.passworddiv').show('slow');
            $('.resendotpdiv').hide('slow');
            $('.otpdiv').hide('slow');
            $('.confirmpassworddiv').hide('slow');
            $(".btn-submit").html('Log In');
            $(".login").css('border-bottom', '2px white solid');
            $(".register").css('border-bottom', "0px white solid");
            $('.forgotpassword').css('display', 'block');

            //reset data
            $('#mobileNumber').val('');
            $('#password').val('');
            //$('#confirmpassword').val('');


            //reset error
            $('#mobileNumber').parent().removeClass('has-error');
            $('#mobileNumber').parent().removeClass('has-feedback');
            $('.remove').css("display", "none");
            $('#errormsg').empty();
            $('#password').parent().removeClass('has-error');
            $('#password').parent().removeClass('has-feedback');
            $('.passremove').css("display", "none");

        });


        $('.resendotp').click(function() {
            event.preventDefault();
            $('#otppassword').parent().removeClass('has-error');
            $('#otppassword').parent().removeClass('has-feedback');
            $('.otppassremove').css("display", "none");

            if ($('.resendotp').html() == 'Resend OTP for Registration') {
                event.preventDefault();
                $('#preloader').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $.ajax({
                    type: "POST",
                    url: jqueryurl + "/quick/checkMobileNoforRegistration",
                    data: {
                        'mobileNumber': $('#mobileNumber').val(),
                        'client_id': $('#client_id').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });

                        console.log(response);
                        if (response.status == 'success') {

                            $('#ajaxmsg').css('color', 'white');
                            $('#ajaxmsg').html('*Resent OTP');
                            setTimeout(function() {
                                $('#ajaxmsg').html('');

                            }, 1000);


                        } else {
                            $('#ajaxmsg').css('color', 'red');
                            $('#ajaxmsg').html('Try Again later');
                        }

                    }
                });
            }



            if ($('.resendotp').html() == 'Resend OTP for Change Password') {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: jqueryurl + '/quick/checkmobilenumbervalid',
                    data: {
                        'client_id': $('#client_id').val(),
                        'mobileNumber': $('#mobileNumber').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });
                        if (response.status == 'success') {
                            $('#ajaxmsg').css('color', 'white');
                            $('#ajaxmsg').html('*Resent OTP ');

                            setTimeout(function() {
                                $('#ajaxmsg').html('');
                            }, 1000);

                        } else {
                            $('#ajaxmsg').css('color', 'red');
                            $('#ajaxmsg').html('* Tryagain later');
                        }
                    }
                });
            }

        });


        $('#loginForm').submit(function(event) {

            errors = "";
            // resetting the old 
            $('#mobileNumber').parent().removeClass('has-error');
            $('#mobileNumber').parent().removeClass('has-feedback');
            $('.remove').css("display", "none");
            $('#password').parent().removeClass('has-error');
            $('#password').parent().removeClass('has-feedback');
            $('.passremove').css("display", "none");
            $('#confirmpassword').parent().removeClass('has-error');
            $('#confirmpassword').parent().removeClass('has-feedback');
            $('.confirmpassremove').css("display", "none");
            $('#errormsg').empty();

            if ($('#mobileNumber').val().length != '10') {
                errors = "*Enter a valid 10 digit mobile number without leading zeroes or country code";
                $('#errormsg').html(errors);
                $('#mobileNumber').parent().addClass('has-error');
                $('#mobileNumber').parent().addClass('has-feedback');
                $('.remove').css("display", "block");
            }
            if (($('.btn-submit').html() == 'Log In')) {
                if ($('.password').val() == '') {
                    errors += "<br>*Password cannot be empty";
                    $('#errormsg').html(errors);
                    $('#password').parent().addClass('has-error');
                    $('#password').parent().addClass('has-feedback');
                    $('.passremove').css("display", "block");
                }
            }


            if (($('.btn-submit').html() == 'Register') || $('.btn-submit').html() == 'Update Password') {

                if ($('.password').val() === '') {
                    errors += "<br>*Password cannot be empty";
                    $('#errormsg').html(errors);
                    $('#password').parent().addClass('has-error');
                    $('#password').parent().addClass('has-feedback');
                    $('.passremove').css("display", "block");
                }
                if ($('#confirmpassword').val() === '') {
                    errors += "<br>*Confirm Password cannot be empty";
                    $('#errormsg').html(errors);
                    $('#confirmpassword').parent().addClass('has-error');
                    $('#confirmpassword').parent().addClass('has-feedback');
                    $('.confirmpassremove').css("display", "block");
                }
                if (($('#confirmpassword').val() !== '') && ($('.password').val() !== '')) {
                    if ($('.password').val() !== $('#confirmpassword').val()) {
                        errors += "<br>*Password and Confirm Password should be same";
                        $('#errormsg').html(errors);
                        $('#confirmpassword').parent().addClass('has-error');
                        $('#confirmpassword').parent().addClass('has-feedback');
                        $('.confirmpassremove').css("display", "block");
                        $('#password').parent().addClass('has-error');
                        $('#password').parent().addClass('has-feedback');
                        $('.passremove').css("display", "block");
                    } else {
                        $('#confirmpassword').parent().removeClass('has-error');
                        $('#confirmpassword').parent().removeClass('has-feedback');
                        $('.confirmpassremove').css("display", "none");
                        $('#password').parent().removeClass('has-error');
                        $('#password').parent().removeClass('has-feedback');
                        $('.passremove').css("display", "none");
                    }

                }
            }

            if ($('.btn-submit').html() == 'Confirm OTP' || $('.btn-submit').html() == 'Confirm  OTP') {
                if ($('#otppassword').val() === '') {
                    errors += "<br>*OTP cannot be empty";
                    $('#errormsg').html(errors);
                    $('#otppassword').parent().addClass('has-error');
                    $('#otppassword').parent().addClass('has-feedback');
                    $('.otppassremove').css("display", "block");
                }
            }


            //********* for Login *************//     
            if ((errors != '')) {
                event.preventDefault();
            }

            if ((errors == '') && ($('.btn-submit').html() == 'Log In') &&
                ($('#mobileNumber').val() != '') && ($('#password').val != '')) {
                $('#preloader').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#loginForm').submit();
            }
            //********* for Register *********//

            if (($('.btn-submit').html() == 'Continue to Register') && (errors == '')) {
                event.preventDefault();
                $('#preloader').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $.ajax({
                    type: "POST",
                    url: jqueryurl + "/quick/checkMobileNoforRegistration",
                    data: $('#loginForm').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });

                        console.log(response);
                        if (response.status == 'success') {

                            $('#ajaxmsg').css('color', 'white');
                            $('#ajaxmsg').html('Valid Mobile Number');
                            setTimeout(function() {
                                $('#ajaxmsg').html('');

                            }, 1000);
                            $('.btn-submit').html('Confirm OTP');
                            $('.mobilenodiv').hide('slow');
                            $('.resendotp').html('Resend OTP for Registration');
                            $('.otpdiv').show('slow');
                            $('.resendotpdiv').show('slow');



                        } else {
                            $('#ajaxmsg').css('color', 'red');
                            $('#ajaxmsg').html('User Not Found or User Already Registered');
                        }

                    }
                });
            }




            if (($('.btn-submit').html() == 'Confirm OTP') && (errors == '')) {
                $('#preloader').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                //checking for Otp Confirmation
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: jqueryurl + "/quick/checkOTPforRegistration",
                    data: {
                        'mobileNumber': $('#mobileNumber').val(),
                        'otppassword': $('#otppassword').val(),
                        'client_id': $('#client_id').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });
                        console.log(response);
                        if (response.status == 'success') {
                            $('#ajaxmsg').css('color', 'white');
                            $('.otpdiv').hide('slow');
                            $('.resendotp').hide('slow');
                            $('.passworddiv').show('slow');
                            $('.confirmpassworddiv').show('slow');
                            $('#ajaxmsg').html('OTP Confirmed');
                            $('.btn-submit').html('Register');
                            setTimeout(function() {
                                $('#ajaxmsg').html('');
                            }, 1000);
                        } else {
                            $('#ajaxmsg').css('color', 'red');
                            $('#ajaxmsg').html('Invalid OTP');
                            setTimeout(function() {
                                $('#ajaxmsg').html('');
                                window.location.reload(1);
                            }, 1000);
                        }
                    }
                });

            }

            if (($('.btn-submit').html() == 'Register') && (errors == '')) {
                event.preventDefault();
                $('#preloader').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $.ajax({
                    type: "POST",
                    url: jqueryurl + "/quick/registeruser",
                    data: {
                        'mobileNumber': $('#mobileNumber').val(),
                        'otppassword': $('#otppassword').val(),
                        'client_id': $('#client_id').val(),
                        'password': $('#password').val(),
                        'confirmpassword': $('#confirmpassword').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });
                        if (response.status == 'success') {
                            $('#ajaxmsg').css('color', 'white');
                            $('#ajaxmsg').html('Registered Successfully');
                            $('#mobileNumber').val('');
                            $('#password').val('');
                            $('#otppassword').val('');
                            $('#confirmpassword').val('');
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1200);
                        } else {
                            $('#ajaxmsg').css('color', 'red');
                            $('#ajaxmsg').html('Try Again later');
                            $('#mobileNumber').val('');
                            $('#password').val('');
                            $('#otppassword').val('');
                            $('#confirmpassword').val('');
                        }


                    }

                });

            }

            //********* Change password *******//
            if ((errors == '') && ($('.btn-submit').html() == 'Continue to Update Password')) {
                event.preventDefault();
                $('#preloader').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $.ajax({
                    type: "POST",
                    url: jqueryurl + '/quick/checkmobilenumbervalid',
                    data: {
                        'client_id': $('#client_id').val(),
                        'mobileNumber': $('#mobileNumber').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });
                        if (response.status == 'success') {
                            $('#ajaxmsg').css('color', 'white');
                            $('#ajaxmsg').html('Mobile Number is valid');
                            $('.resendotp').css('font-size', 'x-small');

                            setTimeout(function() {
                                $('#ajaxmsg').html('');
                            }, 1000);
                            $('.btn-submit').html('Confirm  OTP');
                            $('.mobilenodiv').hide('slow');
                            $('.resendotp').html('Resend OTP for Change Password');
                            $('.otpdiv').show('slow');
                            $('.resendotpdiv').show('slow');

                        } else {
                            $('#ajaxmsg').css('color', 'red');
                            $('#ajaxmsg').html('Invalid Mobile No or User not Exist');
                        }
                    }
                });
            }




            if ($('.btn-submit').html() == 'Confirm  OTP' && errors == '') {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: jqueryurl + '/quick/otppasswordcheckforforgotpassword',
                    data: {
                        'client_id': $('#client_id').val(),
                        'mobileNumber': $('#mobileNumber').val(),
                        'otppassword': $('#otppassword').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });
                        if (response.status == 'success') {
                            $('#ajaxmsg').css('color', 'white');
                            $('#ajaxmsg').html('Confirmed OTP');
                            setTimeout(function() {
                                $('#ajaxmsg').html('');
                            }, 1000);
                            $('.btn-submit').html('Update Password');
                            $('.otpdiv').hide('slow');

                            $('.confirmpassword').val();
                            $('.confirmpassworddiv').show('slow');
                            $('.password').val();
                            $('.passworddiv').show('slow');
                            $('.resendotpdiv').hide('slow');

                        } else {
                            $('#ajaxmsg').css('color', 'red');
                            $('#ajaxmsg').html('Invalid Mobile No or User not Exist');
                        }
                    }
                });
            }

            if ((errors == '') && ($('.btn-submit').html() == 'Update Password')) {
                event.preventDefault();
                console.log('Update Password');
                $('#preloader').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $.ajax({
                    type: "POST",
                    url: jqueryurl + "/quick/UpdatePassword",
                    data: $('#loginForm').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $("#preloader").fadeOut(function() {
                            $('.modal-backdrop.in').css('opacity', '0');
                            $('#preloader').modal('hide');
                        });
                        setTimeout(function() {
                            if (response.status == 'success') {

                                $('#ajaxmsg').css('color', 'white');
                                $('#ajaxmsg').html('Successfully Changed Password');
                                setTimeout(function() {
                                    window.location.reload(1);
                                }, 1200);
                            } else {
                                $('#ajaxmsg').css('color', 'red');
                                $('#ajaxmsg').html('User Not Registered ');
                            }
                        }, 500);
                    }
                });

            }

        });
		
		
		
	if('serviceWorker' in navigator) {
		navigator.serviceWorker
             .register('/worxogo/service-worker.js')
             .then(function() { console.log('Service Worker Registered'); });
	}
		

    });
}(jQuery));