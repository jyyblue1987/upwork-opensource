//This file will help us to define function helpers which will 
//be used by js module.

define(['jquery'], function ($) {
    return {
        getBody: function () {
            return $('body');
        }
    };
});

