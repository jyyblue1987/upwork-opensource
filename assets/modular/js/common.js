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
        payment   : { "deps" :['jquery', 'bootstrap'] }
    },
    paths: {
        pages: '../pages',
        bootstrap: '../lib/bootstrap',
        jquery: '../lib/jquery-2.2.3',
        rating: '../lib/star-rating',
        chatbox: '../modules/chat-box',
        payment: '../modules/payment'
    }
});
