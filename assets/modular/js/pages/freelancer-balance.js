define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $               = require('jquery'),
        bootstrap       = require('bootstrap'),
        datetimepicker  = require('jquery_datetime_picker');
        
    var current_date      = new Date(),
        $from_datepicker  = $("#datepicker-from"),
        $to_datepicker    = $("#datepicker-to");
        
        
    $from_datepicker.datetimepicker({
        onSelectDate: function () {
            //update to date
        },
        timepicker: false,
        formatDate: 'D, M j, Y',
        format:	'D, M j, Y',
        maxDate: $to_datepicker.val()
    });
    
    $to_datepicker.datetimepicker({
        onSelectDate: function () {
            //Update from date
        },
        timepicker: false,
        formatDate: 'D, M j, Y',
        format:	'D, M j, Y',
        startDate:  $from_datepicker.val(),
        maxDate: current_date
    });
});
