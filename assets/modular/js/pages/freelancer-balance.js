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
        timepicker: false,
        formatDate: 'D, M j, Y',
        format:	'D, M j, Y'
    });
    
    $to_datepicker.datetimepicker({
        timepicker: false,
        formatDate: 'D, M j, Y',
        format:	'D, M j, Y'
    });
});
