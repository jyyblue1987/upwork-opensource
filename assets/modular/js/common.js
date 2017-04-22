//The build will inline common dependencies into this file.

//For any third party dependencies, like jQuery, place them in the lib folder.

//Configure loading modules from the lib directory,
//except for 'app' ones, which are in a sibling
//directory.
requirejs.config({
    baseUrl: site_url + 'assets/modular/js/lib',
    shim : {
        bootstrap : { "deps" :['jquery'] },
        chatbox   : { "deps" :['jquery', 'bootstrap'] },
        payment   : { "deps" :['jquery', 'bootstrap'] },
        jquery_datetime_picker: { "deps" :['jquery'] },
        form_validation: { "deps" :['jquery'] },
        bootstrap_form_validation: { "deps" :['jquery', 'form_validation'] }
    },
    paths: {
        pages: '../pages',
        bootstrap: '../lib/bootstrap',
        jquery: '../lib/jquery-2.2.3',
        rating: '../lib/star-rating',
        chatbox: '../modules/chat-box',
        payment: '../modules/payment',
        helper: '../modules/helpers',
        bootstrap_datepicker: 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min',
        jquery_datetime_picker: '../lib/jquery.datetimepicker.full.min',
        "jquery-mousewheel": '../lib/jquery.mousewheel.min',
        moment: '../lib/moment',
        jquery_form: '../lib/jquery.form',
        form_validation: '../lib/formvalidation/formValidation.min',
        bootstrap_form_validation: '../lib/formvalidation/framework/bootstrap.min'
    }
});
