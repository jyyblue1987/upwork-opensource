/**
 * Created by Sergey on 31.12.2016.
 */
$(document).ready(function(){
  $("#addUserFile").on('click', function(event){
      event.preventDefault();
      var input_file = '<input type="file" class="file_upload" name="userfiles[]" id="" value="">  <div class="trst_icn"> </div>';
      $(this).closest('.form-group').append(input_file);
  });
  $("#attachFile").on('click','.trst_icn', function(event) {
        $(this).prev().remove();
        $(this).remove();
  });
  $("a.refresh").click(function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "contact/captcha_refresh",
            success: function(res) {
                if (res)
                {
                    $("#captcha").html(res);
                }
            }
        });
  });

    $('#contactus_form').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        message: 'This value is not valid',
        resetForm: 'true',
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
            email: {
                threshold: 10,
                validators: {
                    notEmpty: {
                        message: 'Enter Your Email'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Not valid email address'
                    }
                }
            },
            body: {
                validators: {
                    notEmpty: {
                        message: 'Write Something to us'
                    }
                }
            },
            captcha: {
                validators: {
                    notEmpty: {
                        message: 'Enter Security code'
                    },
                    remote: {
                        message: 'The security code is not valid',
                        url: siteurl+"json/api/type/regapi/page/captchacheck",
                        type: 'get'
                    }
                }
            },
        }
    }).on('success.field.fv', function (e, data) {
        e.preventDefault();
        data.fv.disableSubmitButtons(false);

    }).on('err.field.fv', function (e, data) {
        data.fv.disableSubmitButtons(false);
    });

});