$(document).ready(function () {
    $('#jobEdit').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: 'Title field cannot be empty'
                    }
                }
            },
            category: {
                validators: {
                    notEmpty: {
                        message: 'Category field cannot be empty'
                    }
                }
            },
            skills: {
                validators: {
                    notEmpty: {
                        message: 'Skills field cannot be empty'
                    }
                }
            },
            job_description: {
                validators: {
                    notEmpty: {
                        message: 'Job description field cannot be empty'
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
            if (!$('#jobEdit').data('formValidation').isValid())
            {
                return false;
            }
            else
            {
                $('.form-loader').show();
                $('input:submit').removeAttr('disabled');
            }
        },
        success: function (rs) {
            var data = JSON.parse(rs);
                if (data.code == '0')
                {
                    $('.form-loader').hide();
                    $('.form-msg').html(data.msg);
                    $('.form-msg').show();
                    $('.form-msg').fadeOut(10000);
                    $('input:submit').removeAttr('disabled');
                }
                else
                {
                    window.location = base_url() + 'jobs-home';
                }
        }
    };

    $('#jobEdit').ajaxForm(options);

});
