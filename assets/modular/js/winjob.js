//Load common code that includes config, then load the app logic for mystaff page.

requirejs(['./common'], function (common) {
    //TODO: set a validation on the global variable page.
    requirejs(['pages/' + page]);
});