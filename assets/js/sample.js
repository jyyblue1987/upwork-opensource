	
	
var apiurl=siteurl;
var instagramClientId="9d4f6d0616894e51885e80acb9f9acf3";
var instagramRedirectUri="http://localhost/winjob/gettoken";
var acctokenlive="4800";
var instokenlive="4800";


		

function kick(org,atc,insid){
	window.location.replace(siteurl+"posts/?id="+insid+"&token="+atc);
	//location.reload();
}
		
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}



		function login_callbackb() {

createCookie("accessToken",accessToken, acctokenlive);	
var myarr = accessToken.split(".");
var userid = myarr[0];
createCookie("userid",userid, acctokenlive);	

  $.ajax({
                type: "GET",
                url: apiurl + 'api/Clients/GetAddCustomerClient/?client_id=' + userid,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", 'Bearer ' + readCookie("access_token"));
                    xhr.setRequestHeader("instagram_token", accessToken);
                },
                success: function (_d) {
					
var json =JSON.stringify(_d);
var sss=jQuery.parseJSON(json)
if(sss.Success){
loadmanageclient();
	
}
                }
            }).fail(function (_d) {
            });

			
			
   

    jQuery("#video")[0].src = "https://instagram.com/accounts/logout/";
		
		
		}
		

		var authenticateInstagram = function(instagramClientId, instagramRedirectUri, callback) {

			var popupWidth = 700,
				popupHeight = 500,
				popupLeft = (window.screen.width - popupWidth) / 2,
				popupTop = (window.screen.height - popupHeight) / 2;
	var popup = window.open('https://instagram.com/oauth/authorize/?client_id='+instagramClientId+'&redirect_uri='+instagramRedirectUri+'&response_type=token&scope=basic+public_content+comments+relationships+follower_list+likes', '', 'width='+popupWidth+',height='+popupHeight+',left='+popupLeft+',top='+popupTop+'');

			popup.onload = function() {

			
			}

		};

		
	function loginb() {

			authenticateInstagram(
			    instagramClientId,
			    instagramRedirectUri, 
			    login_callbackb 
			);

			return false;

		}
		
	
var mouseX,mouseY;

	
		
		$('#basic').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        addOns: {
            reCaptcha2: {
                element: 'captchaContainer',
                theme: 'light',
                siteKey: '6Lf-tggUAAAAAOzXu2Ub57Ws-IxAVy_WxEkB6WZ5',
                timeout: 120,
                message: 'The captcha is not valid'
            }
        },
        fields: {
            fname: {
                validators: {
                    notEmpty: {
                        message: 'Enter Firstname'
                    }
                }
            },
            lname: {
                validators: {
                    notEmpty: {
                        message: 'Enter Surname'
                    }
                }
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'Select Country'
                    }
                }
            },
            username: {
                validators: {
                    notEmpty: {
                        message: 'Enter Surname'
                    },
                    remote: {
                        message: 'Username already exist',
                        url: siteurl+"json/api/type/regapi/page/usernamecheck",
                        type: 'get'
                    }
                }
            },
            email: {
                threshold: 10,
                validators: {
                    notEmpty: {
                        message: 'Enter Your Email'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Not valid email address'
                    },
                    remote: {
                        message: 'Email already exist',
                        url: siteurl+"json/api/type/regapi/page/mailcheck",
                        type: 'get'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password Field cannot be empty'
                    },
                    passwoxrd: {
                        message: 'The password is not valid'
                    }
                }
            },
            confirm_password: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
				e.preventDefault();
        data.fv.disableSubmitButtons(false);
        
    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });






	
		
		$('#basice').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password Field cannot be empty'
                    },
                    passwoxrd: {
                        message: 'The password is not valid'
                    }
                }
            },
            confirm_password: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
				e.preventDefault();
        data.fv.disableSubmitButtons(false);
        
    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });





	
		
		$('#basicg').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            old_password: {
                validators: {
                    notEmpty: {
                        message: 'Old Password Field cannot be empty'
                    },
                    passwoxrd: {
                        message: 'The password is not valid'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'New Password Field cannot be empty'
                    },
                    passwoxrd: {
                        message: 'The password is not valid'
                    }
                }
            },
            confirm_password: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
				e.preventDefault();
        data.fv.disableSubmitButtons(false);
        
    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });





		
		$('#basicb').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'Enter Username'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password Field cannot be empty'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
				e.preventDefault();
        data.fv.disableSubmitButtons(false);
        
    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });

		$('#basicf').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Enter Full Name'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Enter Email'
                    }
                }
            },
            body: {
                validators: {
                    notEmpty: {
                        message: 'Write Something to us'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
				e.preventDefault();
        data.fv.disableSubmitButtons(false);
        
    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });


		
		$('#basicc').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Enter Email'
                    }
                }
            }
        }
    }).on('success.field.fv', function (e, data) {
				e.preventDefault();
        data.fv.disableSubmitButtons(false);
        
    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });









	jQuery('input#password').keyup(function() {
	
	


    var pswd = $(this).val();
if ( pswd.length < 8 ) {
    $('#length').removeClass('valid').addClass('invalid');
} else {
    $('#length').removeClass('invalid').addClass('valid');
}

if ( pswd.match(/[A-z]/) ) {
    $('#letter').removeClass('invalid').addClass('valid');
} else {
    $('#letter').removeClass('valid').addClass('invalid');
}

//validate capital letter
if ( pswd.match(/[A-Z]/) ) {
    $('#capital').removeClass('invalid').addClass('valid');
} else {
    $('#capital').removeClass('valid').addClass('invalid');
}

//validate number
if ( pswd.match(/\d/) ) {
    $('#number').removeClass('invalid').addClass('valid');
} else {
    $('#number').removeClass('valid').addClass('invalid');
}
	
	
}).focus(function() {
    jQuery('#pswd_info').show();
	
	
var p = jQuery("input#password");
var position = p.position();

        var x = mouseX;
        var y = mouseY - 0;
	
        $('#pswd_info').css({
            'top': position.top+60,
            'left': position.left
        }).fadeIn('slow');
}).blur(function() {
     jQuery('#pswd_info').hide();
});



jQuery('input#confirm_password').keyup(function() {
	
	
	
    var pswd = $(this).val();
if ( pswd != $('input#password').val() ) {
    $('#vefyx').removeClass('valid').addClass('invalid');
} else {
    $('#vefyx').removeClass('invalid').addClass('valid');
}

	
}).focus(function() {
    jQuery('#pswd_infob').show();
	
	
var p = jQuery("input#confirm_password");
var position = p.position();

        var x = mouseX;
        var y = mouseY - 0;
	
        $('#pswd_infob').css({
            'top': position.top+60,
            'left': position.left
        }).fadeIn('slow');
}).blur(function() {
    jQuery('#pswd_infob').hide();
});



 if ( $( "input#instatoken" ).length ) {
	 loadpost("start");
	 
 }
