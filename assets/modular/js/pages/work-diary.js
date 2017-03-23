define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $               = require('jquery'),
        bootstrap       = require('bootstrap'),
        datetimepicker  = require('jquery_datetime_picker');
    
    function calculated_total_hour(){
        
        var staring_hour = $staring_hour.data('xdsoft_datetimepicker').getValue();
        var end_hour     = $end_hour.data('xdsoft_datetimepicker').getValue();
        
        if(staring_hour && end_hour){
            
            var difference   = ( end_hour.getHours() ) - ( staring_hour.getHours() );
            var currenttotal = parseFloat(weeklywork) + parseFloat(difference);
            
            if (currenttotal > weeklylimit) {
                $('.result-hour').html('You have cross the weekly Limit ');
                $(".result-hour").show().delay(5000).fadeOut();
            }
            
            $("#total_hour").val( difference );
        }
        else{
            $("#total_hour").val('');
        }
    }
    
    function on_select_end_hour_change(time, input, event){
        $(".end_error").hide();
        event.stopPropagation();
        conf_start_datetime.maxTime = time;
        $staring_hour.data('xdsoft_datetimepicker').setOptions( conf_start_datetime );
    }
    
    function on_select_staring_hour_change(time, input, event ){
        $(".start_error").hide();
        event.stopPropagation();        
        conf_end_datetime.minTime = time;
        $end_hour.data('xdsoft_datetimepicker').setOptions( conf_end_datetime );
    }
    
    
    function on_change_date(time, input, event){
        event.stopPropagation();
        
        end_datetimepicker   = $('#' + $(input).attr('id')).data('xdsoft_datetimepicker');
        popup_datetimepicker = $(input).data('xdsoft_datetimepicker');
        var current_value    = end_datetimepicker.getValue();
        
        if(!current_value) return;
        
        var active_hour      = popup_datetimepicker.find('.xdsoft_time').filter(function(){ return ! $(this).hasClass('xdsoft_disabled') });
        var valid_hours = [];
        active_hour.each(function(){
           valid_hours.push($(this).data('hour')); 
        });
        
        current_hour = current_value.getHours();
        if( $.inArray(current_hour, valid_hours) !== -1 ){
            return calculated_total_hour();
        }
        $(input).val('');
    }
    
    var current_date     = new Date(),
        $datepicker      = $("#datepicker"),
        $formFilter      = $("#searchfilter"),
        $select_contract = $("#jobchanges"),
        $end_hour        = $('#end_hour'),
        $staring_hour    = $('#staring_hour'),
        $weeklywork      = $('#weeklywork'),
        $weeklylimit     = $('#weeklylimit'),
        $form            = $("#hourly_workcalculetor"),
        weeklywork       = $weeklywork.val(),
        weeklylimit      = $weeklylimit.val(),
        conf_end_datetime = {
            formatTime: "H:i",
            format: "H:i",
            showMeridian: true,
            autoclose: true,
            datepicker: false,
            disabledMinTime: true,
            maxTime: new Date(),
            maxDate: new Date(),
            onSelectTime: on_select_end_hour_change,
            onChangeDateTime: on_change_date
        },
        conf_start_datetime = {
            formatTime: "H:i",
            format: "H:i",
            showMeridian: true,
            autoclose: true,
            datepicker: false,
            disabledMaxTime: true,
            maxTime: new Date(),
            maxDate: new Date(),
            onSelectTime: on_select_staring_hour_change,
            onChangeDateTime: on_change_date
        };
    
    $end_hour.datetimepicker( conf_end_datetime );
    $staring_hour.datetimepicker( conf_start_datetime );
    
    $select_contract.change(function () {
        $formFilter.submit();
    });
        
    $datepicker.datetimepicker({
        onSelectDate: function () {
            $formFilter.submit();
        },
        timepicker: false,
        formatDate: 'D, M j, Y',
        format:	'D, M j, Y',
        startDate:  $datepicker.val(),
        maxDate: current_date
    });
    
    var is_submitting_work = false;
        
    $('#submitbutton').on('click', function (e) {
        
        if(is_submitting_work) return;
        
        if ($staring_hour.val().trim() === "") {
            $('.start_error').html("enter some value");
            return false;
        }
        
        if ($end_hour.val().trim() === "") {
            $('.end_error').html("enter some value");
            return false;
        }
        
        var $that   = $(this);
        var $loading = $that.find('.form-loader');
        
        //display loading
        $loading.removeClass('hide').addClass('fa-spin');
        is_submitting_work = true;
        
        var jqXhr    = $.post(site_url + "jobs/work_hour", { form: $form.serialize() + '&total_hour=' + parseInt($("#total_hour").val()) }, $.noop, 'json');
        
        jqXhr.done(function( data ){
            
            if (data.success) {
                
                $form[0].reset();
                $('.result-msg').html(data.message);
                $(".result-msg").show().delay(5000).fadeOut();
                var total = $('#total_work_time').val();
                $(".show_totlaworktime").html(parseFloat(data.todaywork) + parseFloat(total));

                var $option = $select_contract.find('option').filter(':selected');
                window.location = site_url + "jobs/work-diary?fmJob=" + $option.val();
            } else {
                $('.result-msg').html(data.message);
                $(".result-msg").show().delay(5000).fadeOut();
            }
            
        });
        
        jqXhr.fail(function(){
            
        });
        
        jqXhr.always(function(){
            //hide loading.
            $loading.removeClass('fa-spin').addClass('hide');
            is_submitting_work = false;
        });
        
    });
    
});