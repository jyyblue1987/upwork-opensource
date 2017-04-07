define(function (require) {
    
    /**
     * LOAD DEPENDENCIES
     */
    var $               = require('jquery'),
        bootstrap       = require('bootstrap'),
        datetimepicker  = require('jquery_datetime_picker');
        
    var $from_datepicker  = $("#datepicker-from"),
        $to_datepicker    = $("#datepicker-to");
        
        
    $from_datepicker.datetimepicker({
        timepicker: false,
        format:	'D, M j, Y'
    });
    
    $to_datepicker.datetimepicker({
        timepicker: false,
        format:	'D, M j, Y'
    });
});
