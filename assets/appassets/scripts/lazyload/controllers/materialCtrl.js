// --- Material controller
;(function() {

	var app = angular.module("app.ctrls");

	// ==== divider demo
	app.controller("dividerDemo", ["$scope", function($scope) {
		$scope.messages = [{
			face : '/img/list/60.jpeg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		}, {
			face : '/img/list/60.jpeg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		}, {
			face : '/img/list/60.jpeg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		}];
	}])


	.controller("SubheaderCtrl", ["$scope", function($scope) {
		$scope.messages = [
		{
			face : 'images/sample/1.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/2.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/3.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/4.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/5.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/6.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/7.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/3.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/4.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		},
		{
			face : 'images/sample/6.jpg',
			what: 'Brunch this weekend?',
			who: 'Min Li Chan',
			when: '3:08PM',
			notes: " I'll be in your neighborhood doing errands"
		}
		];
	}])


	// progress circular
	.controller("progressCircularDemo", ["$scope", "$interval", function($scope, $interval) {
		
		$scope.mode = 'query';
		$scope.determinateValue = 30;
		$interval(function() {
			$scope.determinateValue += 1;
			if ($scope.determinateValue > 100) {
				$scope.determinateValue = 30;
			}
		}, 100, 0, true);
		
	}])

	// progress linear
	.controller("progressLinearDemo", ["$scope", "$interval", function($scope, $interval) {
		
		$scope.mode = 'query';
		$scope.determinateValue = 30;
		$scope.determinateValue2 = 30;
		$interval(function() {
			$scope.determinateValue += 1;
			$scope.determinateValue2 += 1.5;
			if ($scope.determinateValue > 100) {
				$scope.determinateValue = 30;
				$scope.determinateValue2 = 30;
			}
		}, 100, 0, true);
		$interval(function() {
			$scope.mode = ($scope.mode == 'query' ? 'determinate' : 'query');
		}, 7200, 0, true);
		
	}])


	// dialog demo
	.controller("MdDialogDemo", ["$scope", "$mdDialog", function($scope, $mdDialog) {
		
		$scope.alert = '';
		$scope.showAlert = function(ev) {
		    // Appending dialog to document.body to cover sidenav in docs app
		    // Modal dialogs should fully cover application
		    // to prevent interaction outside of dialog
		    $mdDialog.show(
		    	$mdDialog.alert()
		    	
		    	.title('This is an alert title')
		    	.content('You can specify some description text in here.')
		    	.ariaLabel('Alert Dialog Demo')
		    	.ok('Got it!')
		    	.targetEvent(ev)
		    	);
		};
		$scope.showConfirm = function(ev) {
		    // Appending dialog to document.body to cover sidenav in docs app
		    var confirm = $mdDialog.confirm()
		    .title('Would you like to delete your debt?')
		    .content('All of the banks have agreed to forgive you your debts.')
		    .ariaLabel('Lucky day')
		    .ok('Please do it!')
		    .cancel('Sounds like a scam')
		    .targetEvent(ev);
		    $mdDialog.show(confirm).then(function() {
		    	$scope.alert = 'You decided to get rid of your debt.';
		    }, function() {
		    	$scope.alert = 'You decided to keep your debt.';
		    });
		};

	}])


	// slider demo
	.controller("MdSliderDemo", ["$scope", function($scope) {
		$scope.color = {
			red: Math.floor(Math.random() * 255),
			green: Math.floor(Math.random() * 255),
			blue: Math.floor(Math.random() * 255)
		};
		$scope.rating1 = 3;
		$scope.rating2 = 2;
		$scope.rating3 = 4;
		$scope.disabled1 = 0;
		$scope.disabled2 = 70;
	}])


	// checkbox
	.controller("MdCheckboxDemo", ["$scope", function($scope) {
	 	$scope.data = {};
	 	$scope.data.cb1 = true;
	 	$scope.data.cb2 = false;
	 	$scope.data.cb3 = false;
	 	$scope.data.cb4 = false;
	 	$scope.data.cb5 = false;
	}])


	/// radios/switches
	.controller("MdRadioSwitchDemo", ["$scope", function($scope) {
	 	$scope.data = {
	 		group1: "Banana",
	 		cb1: true,
	 		cb4: true,
	 		cb5: false
	 	}
	 	
	}])

	// Input Demo
	.controller('MdInputDemo', ["$scope", function($scope) {
		$scope.user = {
			title: 'Developer',
			email: 'ipsum@lorem.com',
			firstName: '',
			lastName: '' ,
			company: 'Google' ,
			address: '1600 Amphitheatre Pkwy' ,
			city: 'Mountain View' ,
			state: 'CA' ,
			biography: 'Loves kittens, snowboarding, and can type at 130 WPM.\n\nAnd rumor has it she bouldered up Castle Craig!',
			postalCode : '94043'
		};
	}])
	.config(["$mdThemingProvider", function($mdThemingProvider){
	    // Configure a dark theme with primary foreground yellow
	    $mdThemingProvider.theme('docs-dark', 'default')
	    .primaryPalette('yellow')
	    .dark();
	}]);






//=== #end
})()

