$('#emailchange').formValidation({
    framework: 'bootstrap',
    excluded: ':disabled',
    message: 'This value is not valid',
    resetForm: 'true',
    fields: {
        old_email: {
            validators: {
                notEmpty: {
                    message: 'Old email field cannot be empty'
                },
                emailAddress: {
                    message: 'Email is not valid'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'Email field cannot be empty'
                },
                emailAddress: {
                    message: 'Email is not valid'
                },
                different: {
                    field: 'old_email',
                    message: 'New email should be different from old email'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password field cannot be empty'
                },
                passwoxrd: {
                    message: 'The password is not valid'
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
var options = {
    beforeSubmit: function () {
        if (!$('#emailchange').data('formValidation').isValid())
        {
            return false;
        }
        else
        {
            $('.form-loader').show();
            $('#butupdat').removeAttr('disabled');
        }
    },
    success: function (rs) {
        $('.form-loader').hide();
        $('.form-msg').html(rs);
        $('.form-msg').show();        
        $('.form-msg').fadeOut(10000);
    }
};
// bind form using 'ajaxForm' 
$('#emailchange').ajaxForm(options);
// AJAX code to check input field values when onblur event triggerd.
function validate(field, query) {

    if (!$('#email').parent().parent().hasClass('has-error'))
    {
        var xmlhttp;
        var url = siteurl + "json/api/type/regapi/page/mailcheck";
        if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
                document.getElementById(field).innerHTML = "Validating..";
            } else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var response = JSON.parse(xmlhttp.responseText);
                if (response.valid)
                {
                    document.getElementById(field).innerHTML = '';
                }
                else
                    document.getElementById(field).innerHTML = 'Email already exist';
            }
        }
        xmlhttp.open("GET", url + "?email=" + query, false);
        xmlhttp.send();
    }
}