;(function() {
"use strict";

angular.module("app.form.ctrls", [])

.controller("WizardMinimalCtrl", ["$scope", function($scope) {

	$scope.currentInput = 0;
	$scope.totalInput = 4;
	$scope.progress = 0;
	$scope.inputToggle = [true, false, false, false];

	$scope._progress = function() {
		$scope.progress = $scope.currentInput*(100/$scope.totalInput);
	};
	$scope.nextInput = function() {
		$scope.currentInput += 1;
		$scope._progress();
		// false's all values
		$scope.inputToggle.forEach(function(v, i) {
			$scope.inputToggle[i] = false;
		});
		$scope.inputToggle[$scope.currentInput] = true;

	};

}])



.controller("FormWizardCtrl", ["$scope", function($scope) {
	$scope.steps = [true, false, false];

	$scope.stepNext = function(index) {
		for(var i = 0; i < $scope.steps.length; i++) {
			$scope.steps[i] = false;
		}

		$scope.steps[index] = true;
	}

	$scope.stepReset = function() {
		$scope.steps = [true, false, false];
	}

}])



// end
}())