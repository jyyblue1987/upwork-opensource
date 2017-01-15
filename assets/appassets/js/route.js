

myApp.config(['$routeProvider','$locationProvider', function($routeProvider,$locationProvider) {
  $routeProvider.
  when('/', {
    templateUrl: '../apptemp/home.html',
    controller: 'ListController'
  }).
  when('/dashboard', {
    templateUrl: 'templates/dashboard.html',
    controller: 'ListController'
  }).
  when('/details/:itemId', {
    templateUrl: 'templates/details.html',
    controller: 'DetailsController'
  }).
  otherwise({
    redirectTo: '/'
  });
  
$locationProvider.html5Mode(true)

}]);

