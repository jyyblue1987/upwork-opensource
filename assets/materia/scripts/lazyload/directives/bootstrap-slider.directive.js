;(function() {
"use strict";

angular.module("ui.slider", [])	


.directive("uiRangeSlider", [function() {
	return {
		restrict: "A",
		link: function(scope, elem, attrs) {
			elem.slider();
		}
	}
}])


}())






