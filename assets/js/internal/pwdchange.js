$('#pwdchange').formValidation({
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
var options = {
    beforeSubmit: function () {
        if (!$('#pwdchange').data('formValidation').isValid())
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
$('#pwdchange').ajaxForm(options);