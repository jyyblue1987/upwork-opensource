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

        $('input:submit').removeAttr('disabled');
    }
    else
    {
        if(data.amt=='1')
        {
            $('#bid_amount_read').text($('#bid_amount').val());
            $('#bid_earning_read').text($('#bid_earning').val());
        }
        $(data.modal).find('.close').click();
    }
    $('.form-loader').hide();
    $('.form-msg').html(data.msg);
    $('.form-msg').show();
    $('.form-msg').fadeOut(10000);
}
$(document).ready(function () {
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
            successResp(rs);
        }
    };
    var options1 = {
        beforeSubmit: function () {
            $('.form-loader').show();
        },
        success: function (rs) {
            successResp(rs);
        }
    };
// bind form using 'ajaxForm'
    $('#jobApply').ajaxForm(options);
    $('#jobWithDraw').ajaxForm(options1);


});
