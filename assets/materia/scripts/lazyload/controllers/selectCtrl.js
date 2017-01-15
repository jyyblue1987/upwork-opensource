// --- ui-select controller
;(function() {

	var app = angular.module("app.ctrls");
	// Tree View Demo Ctrl
	app.controller("SelectDemoCtrl", ["$scope", function($scope) {
		$scope.person = {};
		// demo one
		$scope.people = [
		    { name: 'Adam',      email: 'adam@mail.com'},
		    { name: 'Amalie',    email: 'amalie@mail.com'},
		    { name: 'Nicolás',   email: 'nicolas@mail.com'},
		    { name: 'Wladimir',  email: 'wladimir@mail.com'},
		    { name: 'Samantha',  email: 'samantha@mail.com'},
		    { name: 'Estefanía', email: 'estefanía@mail.com'},
		    { name: 'Natasha',   email: 'natasha@mail.com'},
		    { name: 'Nicole',    email: 'nicole@mail.com'},
		    { name: 'Adrian',    email: 'adrian@mail.com'}
		];

		$scope.state = {};
		$scope.timezone = [ 
			{tag: 1, name: "Alaska"},
			{tag: 1, name: "Hawaii"},
			{tag: 2, name: "California"},
			{tag: 2, name: "Nevada"},
			{tag: 2, name: "Oregon"},
			{tag: 2, name: "Washington"},
			{tag: 3, name: "Arizona"},
			{tag: 3, name: "Colorado"},
			{tag: 3, name: "Idaho"},
			{tag: 3, name: "Montana"},
			{tag: 3, name: "Nebraska"},
			{tag: 3, name: "New Mexico"},
			{tag: 3, name: "North Dakota"},
			{tag: 3, name: "Utah"},
			{tag: 3, name: "Wyoming"},
			{tag: 4, name: "Alabama"},
			{tag: 4, name: "Arkansas"},
			{tag: 4, name: "Illinois"},
			{tag: 4, name: "Iowa"},
			{tag: 4, name: "Kansas"},
			{tag: 4, name: "Kentucky"},
			{tag: 4, name: "Louisiana"},
			{tag: 4, name: "Minnesota"},
			{tag: 4, name: "Mississippi"},
			{tag: 4, name: "Missouri"},
		];

		$scope.timezoneFn = function (item){
		 	switch(item.tag) {
		 		case 1: return "Alaskan/Hawaiian Time Zone";
		 		case 2: return "Pacific Time Zone";
		 		case 3: return "Moutain Time Zone";
		 		case 4: return "Central Time Zone";
		 	}
		};

		// Multiple Select
		$scope.availableColors = ['Red','Green','Blue','Yellow','Magenta','Maroon','Umbra','Turquoise', 'Array of Strings'];
		$scope.multipleDemo = {};
		$scope.multipleDemo.colors = ['Blue','Red', 'Array of Strings'];
		$scope.multipleDemo.selectedPeopleWithGroupBy = [$scope.people[8], $scope.people[0]];

		$scope.someGroupFn = function (item){
			if (item.name[0] >= 'A' && item.name[0] <= 'M')
				return 'From A - M';
			if (item.name[0] >= 'N' && item.name[0] <= 'Z')
				return 'From N - Z';
		};
	}])

//=== #end
})()