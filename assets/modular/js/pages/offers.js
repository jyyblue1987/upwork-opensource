define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $               = require('jquery'),
        datetimepicker  = require('jquery_datetime_picker'),
        bootstrap       = require('bootstrap'),
        Utils           = require('helper'),
        jquery_form     = require('jquery_form'),
        formValidation  = require('form_validation'),
        bootstrap_form_validation = require('bootstrap_form_validation');
        
    $('#budget-edit').on('click', function(event) {
        event.preventDefault();
        $(this).addClass('hide');
        $('#budget-edit-field').removeClass('hide');
    });
    
    var $form = $('#hire_job');
    var $milestone_input = $form.find('#milestone-input-container');
    
    $form.find('input[name="budget_type"]').on('change', function(){
        var  value =  $('input[name=budget_type]').filter(":checked").val();
        
        if(value === '2')
        {
            $milestone_input.removeClass("hide");
            $milestone_input.find('input').focus();
	}else{
            $milestone_input.addClass("hide");
        }
    });
    
    $(document).on('keyup', '#milestone-input-container input', function() {
        var value = parseInt($(this).val());
	if(isNaN(value)){
            $(this).val("");
	}
    });
    
    $('#datetimepicker').datetimepicker({
        timepicker: false,
        format: 'd/m/Y'
    });    
    
    var is_sending      = false;
    var notif_container = $("#notif-container"); 
    
    $form.on('submit', function(event) {
        
        event.preventDefault();
        
        if(is_sending) return; 
        
        is_sending = true;
        
        $form.find('#hire-btn-submit').prop('disabled', true);
        
        var jqXhr = $.post($form.attr('action'), $form.serialize(), $.noop, 'json' );
        
        jqXhr.done(function(data) {
            
            if(data.status == 'success'){
                Utils.display_message(notif_container, 'alert-success', 'hide', data.message);
            }else{
                Utils.display_message(notif_container, 'alert-danger', 'hide', data.message);
            }
            
            if(data.redirect)
                setTimeout(function(){ Utils.redirect(data.redirect_url); }, 1000);
        });
        
        jqXhr.always(function(){
            $form.find('#hire-btn-submit').prop('disabled', false);
            is_sending = false;
        });
        
        return false;
    });
    
    var $limit_value_content = $('#weekly-limit-value');
    var $limit_input         = $('input[name="limit"]');
    
    $limit_input.on('change', function(){
        
        var $limit_checked = $limit_input.filter(':checked');
        
        if($limit_checked.val() == 0) {
            $limit_value_content.addClass('hide');
        }else {
            $limit_value_content.removeClass('hide');
        }
    });
    
    var limit_error = $('#weekly_limit_error');
    
    $('#weekly_limit_input').on('keyup', function() {
	
        var value = parseFloat($(this).val());
        
        if(isNaN( value )) 
        {
            $('#weekly-limit-amount').addClass('hide');	
            limit_error.text('Enter Numbers Only');
            limit_error.show().delay(5000).fadeOut(); 
            return false;
        }
        
        $('#weekly-limit-amount').removeClass('hide');	
        
        var bid_amount = parseFloat($('#bid_amount_result').val());
        var week_limit = parseFloat($('#weekly_limit_input').val());
        
        var total = bid_amount * week_limit;
        if(total > 0){
            $('#weekly_limit_amount').val(total.toFixed(2));
        } 
        
        $('#weekly-limit-amount').html( '= $'+ total.toFixed(2) +' max/week');
    });
    
    
    var $modal_proposal = $('#myModal2');
    
    if($modal_proposal.length)
    {
        var $bid_amount  = $modal_proposal.find('#bid_amount');
        var $bid_fee     = $modal_proposal.find('#bid_fee');
        var $bid_earning = $modal_proposal.find('#bid_earning');
        var $jobApplyBtn = $modal_proposal.find('#jobApply');
        
        Utils.setFee($bid_amount, $bid_fee, $bid_earning);
        $bid_amount.keyup(function () {
            Utils.setFee($bid_amount, $bid_fee, $bid_earning);
        });
        
        $jobApplyBtn.formValidation({
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
        
        var notif_interview_container = $('#notif-interview-container');
        var bid_amount_updating       = false;
        $jobApplyBtn.ajaxForm({
            beforeSubmit: function () {
                
                if(bid_amount_updating) return; 
                
                if (! $jobApplyBtn.data('formValidation').isValid() )
                {
                    return false;
                }
                
                $modal_proposal.find('input:submit').prop('disabled', true);
                bid_amount_updating = true;
            },
            success: function (rs) 
            {   
                var data  = JSON.parse(rs);
                
                 if( data.amt == '1' )
                {
                    var amount = parseFloat($bid_amount.val());
                    $('#_bid_amount').text(amount.toFixed(2));
                    $('#bid_amount_result').val($bid_amount.val());
                }

                $(data.modal).find('.close').click();

                Utils.display_message(notif_interview_container, '', 'hide', data.msg);
            },
            complete: function()
            {
                $modal_proposal.find('input:submit').prop('disabled', false);
                bid_amount_updating = false;
            }
        });
    }
    
});