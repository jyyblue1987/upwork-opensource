define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $           = require('jquery'),
        bootstrap   = require('bootstrap');
        
    var available_balance = $("#available_bal").text();
    var tax_status        = parseInt( $("#tax_status").val() );
    var tax_url           = site_url + 'payment/tax-information';
    var alert_msg         = "!Please submit your tax information to complete withdrawal or Before withdrawing funds, all freelancers must provide their  tax information. <a href='"+ tax_url +"'> Add Tax Info </a>";
    var $alert_container  = $("#alert-msg");
    var $paymentType      = $("#payment_type");
    var $withdraw         = $("#bal_withdraw");
    var $processFees      = $("#processfees");
    var $newAvailable     = $("#new_available");
    var $balProcessFees   = $("#bal_processfees");
    var $withdraw_btn     = $('#Withdrawbutton');
    var $form             = $("#withdraw_from");
    var $errorContainer   = $("#erreo");
    var $result_msg       = $(".result-msg");
    
    function  calculatewithdraw(paymentType, withdraw) {
        
        var availablebal      = parseFloat( available_balance );
        var process_fees      = 1.00;  // 1 (paypal) and 2 (skrill) processing fees is 1.00
        var new_available     = 0.0;
        
        if (paymentType == 3) {// 3 (payoneer) processing fees is 2.00
            process_fees  = 2.00; 
        }
        
        new_available = parseFloat( availablebal - ( parseFloat( withdraw ) + process_fees ) );
        
        if( isNaN(new_available) )
            new_available = 0.00;
        
        $processFees.text(process_fees.toFixed(2));
        $newAvailable.text(new_available.toFixed(2));
        $balProcessFees.val(process_fees.toFixed(2));
    }
    
    function validate_withdraw_value( value ){
        if (!$.isNumeric(value)) {
            $errorContainer.text("Numeric value only");
            return false;
        }else{
            $errorContainer.text("");
        }
    }
    
    function validate_state()
    {
        var selected_option = $paymentType.find('option').filter(':selected');
        
        if(selected_option.val() == "")
        {
            $withdraw.prop('disabled',true).addClass('disabled-input');
            $withdraw_btn.prop('disabled',true).addClass('disabled');
        }
        else
        {
            $withdraw.prop('disabled',false).removeClass('disabled-input');
            $withdraw_btn.prop('disabled',false).removeClass('disabled');
        }
    }
    
    function calculate_wrapper(){
        
        var paymentType = $("#payment_type").val();
        var withdraw    = $withdraw.val();        
        calculatewithdraw(paymentType, withdraw);
    }
     
    validate_state();
    
    $paymentType.on("change", function(e){
        e.preventDefault();
        validate_state();
        $.proxy(calculate_wrapper, this)();
    });
    
    $withdraw.keyup(function (e) {
        e.preventDefault();
        validate_withdraw_value( this.value );
        $.proxy(calculate_wrapper, this)();
    });
    
    $withdraw.on('click', function (e) {
        e.preventDefault();
        validate_withdraw_value( this.value );
        $.proxy(calculate_wrapper, this)();
    });
    
    $("#cancelbutton").on('click', function (e) {
        $form[0].reset();
        $processFees.text("0.00");
        $newAvailable.text("0.00");
        
        if(!$withdraw.hasClass('disabled-input')){
            $withdraw.prop('disabled',false).addClass('disabled-input');
            $withdraw_btn.prop('disabled',false).addClass('disabled');
        }
        return false;
    });
    
    var is_sending_withdraw = false;
    
    $withdraw_btn.on('click', function (e) {
        
        e.preventDefault();
        
        if(is_sending_withdraw) return; 
        
        if ( tax_status == 0 ) {
            $alert_container.html(alert_msg).show();
            return false;
        }
        
        $alert_container.hide();
        
        var paymentType = $paymentType.val();
        var withdraw    = $withdraw.val();
        
        calculatewithdraw(paymentType, withdraw);
        
        is_sending_withdraw = true;
        $withdraw_btn.prop('disabled',true).addClass('disabled');
        
        var jqXhr = $.post(site_url + 'withdraw/retire', {form: $form.serialize()}, $.noop, "json");
        
        jqXhr.done(function(data){
            
            var rows = "";
            var json = data; 
            
            if (json.success) {
                $form[0].reset();
                $result_msg.html(json.message);
                $result_msg.show().delay(5000).fadeIn();
                var total = $('#total_work_time').val();

                if(json.record['operation_date'] == null)
                    json.record['operation_date'] = '';

                rows = "<tr><td>";
                rows += json.record['email']+"</td> <td> $ ";
                rows += json.record['amount']+"</td> <td>";
                rows += json.record['payment_type']+"</td> <td>";
                rows += json.record['status']+"</td> <td>";
                rows += json.record['operation_date']+"</td>";
                rows += "</tr>";

                $('#withdraw-table > tbody:last-child').append(rows);
                validate_state();
            }
            else {
                $result_msg.html(json.message);
                $result_msg.show().delay(5000).fadeOut();
            }
        });
        
        jqXhr.always(function(){
            is_sending_withdraw = false;
            $withdraw_btn.prop('disabled',false).removeClass('disabled');
        });
    });
    
});