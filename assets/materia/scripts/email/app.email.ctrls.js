;(function() {
"use strict";

angular.module("app.email.ctrls", [])

// ====== ui-select demo 
.controller("EmailCtrl", ["$scope", "$modal", function($scope, $modal) {

	// labels
	$scope.labelColors = [ "#5974d9", "#19c395", "#fc3644", "#232429", "#f1d44b"]
	$scope.labels = [
		{type: "Work", color: $scope.labelColors[0]},
		{type: "Reciept", color: $scope.labelColors[1]},
		{type: "My Data", color: $scope.labelColors[2]}
	]
	$scope.newlabel = "";

	// List of mails for demo. 
	$scope.emailLists = [
		{
			subject: "Some nice subject here.",
			content: "Nor again is there anyone who loves or pursues or desires to obtain pain of itself...",	// this will contain full content with html markup and added by database.
			read: true,	// mail read/unread
			sender: "Jonathan Doe",	// sender name
			date: "3 mins ago",
			attachment: true, 	// has attachment or not
			active: false
		},
		{
			subject: "Meetup at C.P, New Delhi",
			content: "Lorem ipsum dolar sit amet...",
			read: false,
			sender: "Organizer.com",
			date: "12th Feb",
			attachment: false, 
			active: true
		},
		{
			subject: "Calling all android developers to join me",
			content: "Pellentesque habitant morbi tristique senectus et netus...",
			read: true,
			sender: "android.io",
			date: "11th Jan",
			attachment: true, 
			active: false
		},
		{
			subject: "Meetup at C.P, New Delhi",
			content: "Lorem ipsum dolar sit amet...",
			read: false,
			sender: "Organizer.com",
			date: "22nd Dec",
			attachment: false, 
			active: false
		},
		{
			subject: "RE: Question about account information V334RE99e: s3ss",
			content: "Hi, Thanks for the reply, I want to know something....",
			read: false,
			sender: "trigger.io",
			date: "12 Dec",
			attachment: true, 
			active: false
		},
	];

	// add labels
	$scope.addLabel = function() {
		var l = $scope.labelColors.length,
			c = $scope.labelColors[Math.floor(Math.random()*l)];
		if($scope.newlabel)
			$scope.labels.push({type: $scope.newlabel, color: c});
		$scope.newlabel = "";
	};

	$scope.compose = function() {
		$modal.open({
			templateUrl: "views/email/compose.html",
			size: "md",
			controller: "EmailCtrl",
			resolve: function() {},
			windowClass: 'modalRapid'	 // animation class
		});

	}

	$scope.composeClose = function() {
		$scope.$close();	// this method is associated with $modal scope which is this.
	}

}])





// #end 
}())