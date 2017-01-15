// --- imagecrop controller
;(function() {

	var app = angular.module("app.ctrls");
	// Image Crop Ctrl
	app.controller("ImageCropCtrl", ["$scope",function($scope) {	
		$scope.myImage='';
		$scope.myCroppedImage='';
		$scope.areaType = "square";

		var handleFileSelect=function(evt) {
			var file=evt.currentTarget.files[0];
			var reader = new FileReader();
			reader.onload = function (evt) {
				$scope.$apply(function($scope){
					$scope.myImage=evt.target.result;
				});
			};
			reader.readAsDataURL(file);
		};
		angular.element(document.querySelector('#imageCropInput')).on('change',handleFileSelect);

	}])

//=== #end
})()