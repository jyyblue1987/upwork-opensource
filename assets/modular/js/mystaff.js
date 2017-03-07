//Load common code that includes config, then load the app logic for mystaff page.
requirejs(['./common'], function (common) {
    requirejs(['app/module']);
});