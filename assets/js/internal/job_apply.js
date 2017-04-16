function setFee() {
    var myRate = $('#bid_amount').val();
    if (parseInt(myRate) > 0) {
        $('#bid_fee').val(parseInt(myRate) / 10);
        $('#bid_earning').val(parseInt(myRate) - (parseInt(myRate) / 10));
    } else {
        $('#bid_fee').val('');
        $('#bid_earning').val('');
    }
}
function successResp(rs)
{
    var data = JSON.parse(rs);
    if (data.code == '0')
    {
        $('.form-loader').hide();
        $('.form-msg').html(data.msg);
        $('.form-msg').show();
        $('.form-msg').fadeOut(10000);
        $('input:submit').removeAttr('disabled');
        $(window).scrollTop();
    }
    else
    {
        window.location = base_url() + 'jobs/my-bids';
    }
}
$(document).ready(function () {

    Dropzone.options.myDropzone = {
        url: "/jobs/apply",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        init: function () {

            var submitButton = document.querySelector("#submit-all");
            var wrapperThis = this;

            submitButton.addEventListener("click", function () {
                if (!$('#jobApply').data('formValidation').isValid())
                {
                    return false;
                }
                else
                {
                    $('.form-loader').show();
                    //formData.append($('#jobApply').serialize());
                    wrapperThis.processQueue();
                    $('input:submit').removeAttr('disabled');
                }


            });

            this.on("addedfile", function (file) {

                // Create the remove button
                var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Remove File</button>");

                // Listen to the click event
                removeButton.addEventListener("click", function (e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview.
                    wrapperThis.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });

                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });

            this.on('sendingmultiple', function (data, xhr, formData) {
                formData.append('job_id', $('#jobId').val());
                formData.append('bid_amount', $('#bid_amount').val());
                formData.append('bid_fee', $('#bid_fee').val());
                formData.append('bid_earning', $('#bid_earning').val());
                formData.append('job_duration', $('#job_duration').val());
                formData.append('cover_latter', $('#cover_latter').val());
                formData.append('job_title', $('#job_title').val());
            });
            this.on("success", function (file, response) {
                successResp(response)
            });
        }
    };


    setFee();
    $('#bid_amount').keyup(function () {
        setFee();
    });

    $('#jobApply').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
        fields: {
            bid_amount: {
                validators: {
                    notEmpty: {
                        message: '&nbsp;'
                    }
                }
            },
            cover_latter: {
                validators: {
                    notEmpty: {
                        message: 'Cover latter field cannot be empty'
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
            if ($('#my-dropzone').find('.dz-preview').length > 0)
            {
                return false;
            }
            if (!$('#jobApply').data('formValidation').isValid())
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
            successResp(rs)
        }
    };
// bind form using 'ajaxForm'
    $('#jobApply').ajaxForm(options);


});
