$(document).ready(function () {

    $('#jobCreate').formValidation({
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
            if (!$('#jobCreate').data('formValidation').isValid())
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
            console.log(rs);
            var data = JSON.parse(rs);
            console.log(data);
            if ($.trim(data.code) == '1')
            {
                window.location = base_url() + "jobs/preview-job-posting";
            }
            else
            {
                if (data.id == '0')
                {
                    $('.form-loader').hide();
                    $('.form-msg').html(rs.msg);
                    $('.form-msg').show();
                    $('.form-msg').fadeOut(10000);
                    $('input:submit').removeAttr('disabled');
                }
                else
                {
                    window.location = base_url() + 'jobs-home';
                }

            }
        }
    };
// bind form using 'ajaxForm' 
    $('#jobCreate').ajaxForm(options);
    $('#previewBtn').click(function () {
        $('#buttonVal').val('0');
    });
    $('#submitBtn').click(function () {
        $('#buttonVal').val('1');
    });

});
