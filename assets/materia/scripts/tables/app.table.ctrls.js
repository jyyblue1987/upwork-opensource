;(function() {
"use strict";

angular.module("app.table.ctrls", [])

// Responsive Table Data (static)
.controller("ResponsiveTableDemoCtrl", ["$scope", function($scope) {

	$scope.responsiveData = [
		{
			post: "My First Blog",
			author: "Johnny",
			categories: "WebDesign",
			tags: ["wordpress", "blog"],
			date: "20-3-2004",
			tagColor: "pink"
		},
		{
			post: "How to Design",
			author: "Jenifer",
			categories: "design",
			tags: ["photoshop", "illustrator"],
			date: "2-4-2012",
			tagColor: "primary"
		},
		{
			post: "Something is missing",
			author: "Joe",
			categories: "uncategorized",
			tags: ["abc", "def", "ghi"],
			date: "20-5-2013",
			tagColor: "success"
		},
		{
			post: "Learn a new language",
			author: "Rinky",
			categories: "language",
			tags: ["C++", "Java", "PHP"],
			date: "10-5-2014",
			tagColor: "danger"
		},
		{
			post: "I love singing. Do you?",
			author: "AJ",
			categories: "singing",
			tags: ["music"],
			date: "2-10-2014",
			tagColor: "info"
		}

	];
}])


// Data Table 
.controller("DataTableCtrl", ["$scope", "$filter", function($scope, $filter) {
	// data
	$scope.datas = [
		{engine: "Gecko", browser: "Firefox 3.0", platform: "Win 98+/OSX.2+", version: 1.7, grade: "A"},
		{engine: "Gecko", browser: "Firefox 5.0", platform: "Win 98+/OSX.2+", version: 1.8, grade: "A"},
		{engine: "KHTML", browser: "Konqureror 3.5", platform: "KDE 3.5", version: 3.5, grade: "A"},
		{engine: "Presto", browser: "Opera 8.0", platform: "Win 95+/OS.2+", version: "-", grade: "A"},
		{engine: "Misc", browser: "IE Mobile", platform: "Windows Mobile 6", version: "-", grade: "C"},
		{engine: "Trident", browser: "IE 5.5", platform: "Win 95+", version: 5, grade: "A"},
		{engine: "Trident", browser: "IE 6", platform: "Win 98+", version: 7, grade: "A"},
		{engine: "Webkit", browser: "Safari 3.0", platform: "OSX.4+", version: 419.3, grade: "A"},
		{engine: "Webkit", browser: "iPod Touch / iPhone", platform: "OSX.4+", version: 420, grade: "B"},
	];
	var prelength = $scope.datas.length;

	// create random data (uses `track by $index` in html for duplicacy)
	for(var i = prelength; i < 100; i++) {
		var rand = Math.floor(Math.random()*prelength);
		$scope.datas.push($scope.datas[rand]);
	}

	$scope.searchKeywords = "";
	$scope.filteredData = [];	
	$scope.row = "";


	$scope.numPerPageOpts = [5, 7, 10, 25, 50, 100];
	$scope.numPerPage = $scope.numPerPageOpts[1];
	$scope.currentPage = 1;
	$scope.currentPageStores = []; // data to hold per pagination


	$scope.select = function(page) {
		var start = (page - 1)*$scope.numPerPage,
			end = start + $scope.numPerPage;

		$scope.currentPageStores = $scope.filteredData.slice(start, end);
	}

	$scope.onFilterChange = function() {
		$scope.select(1);
		$scope.currentPage = 1;
		$scope.row = '';
	}

	$scope.onNumPerPageChange = function() {
		$scope.select(1);
		$scope.currentPage = 1;
	}

	$scope.onOrderChange = function() {
		$scope.select(1);
		$scope.currentPage = 1;
	}


	$scope.search = function() {
		$scope.filteredData = $filter("filter")($scope.datas, $scope.searchKeywords);
		$scope.onFilterChange();
	}

	$scope.order = function(rowName) {
		if($scope.row == rowName)
			return;
		$scope.row = rowName;
		$scope.filteredData = $filter('orderBy')($scope.datas, rowName);
		$scope.onOrderChange();
	}

	// init
	$scope.search();
	$scope.select($scope.currentPage);



}])

}())