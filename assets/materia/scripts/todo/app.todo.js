;(function() {
	"use strict";

angular.module("app.todo", [])

.factory("todoStorage", [function() {

	var STORAGE_ID = "_todo-task";

	var store = {
		todos : [],

		get : function() {
			return JSON.parse(localStorage.getItem(STORAGE_ID));
		},

		put : function(todos) {
			localStorage.setItem(STORAGE_ID, JSON.stringify(todos));
		}
	};

	return store;

}])

.controller("TodoCtrl", ["$scope", "todoStorage", "$filter",  function($s, store, $filter) {

	var demoTodos = [ 
		{
			title: "Eat healthy, Eat fresh",
			completed: false
		},
		{ 
			title: "Donate some money",
			completed: true
		},
		{
			title: "Wake up at 5:00 A.M",
			completed: false
		},
		{
			title: "Hangout with friends at 12:00",
			completed: false
		},
		{
			title: "Another todo on the list. Add as many you want.",
			completed: false
		},
		{
			title: "The last but not the least.",
			completed: true
		}
	];
	var todos = $s.todos = store.get() || demoTodos;
	
	$s.newTodo = "";
	$s.remainingCount = $filter("filter")(todos, {completed: false}).length;
	$s.editedTodo = null;
	$s.edited = false;
	$s.todoshow = "all";

	$s.$watch("remainingCount == 0", function(newVal) {
		$s.allChecked = newVal;
	});

	$s.filter = function(filter) {
		switch(filter) {
			case 'all': $s.statusFilter = ''; break;
			case 'active': $s.statusFilter = {completed: false}; break;
		}
	}


	$s.addTodo = function() {
		var newTodo = {
			title: $s.newTodo.trim(),
			completed: false
		};

		if(newTodo.length === 0) 
			return;

		todos.push(newTodo);
		store.put(todos);
		$s.newTodo = "";
		$s.remainingCount++;

	};

	$s.editTodo = function(todo) {
		$s.editedTodo = todo;
		$s.edited = true;
		// ng-model automatically do it in $s.todos
		$s.originalTodo = angular.extend({}, todo);
	}

	$s.removeTodo = function(todo) {
		$s.remainingCount -= todo.completed ? 0 : 1;
		todos.splice(todos.indexOf(todo), 1);
		store.put(todos);
	};

	$s.doneEditing = function(todo) {
		$s.editedTodo = null;
		$s.edited = false;
		todo.title = todo.title.trim();
		if(!todo.title) 
			$s.removeTodo(todo);

		store.put(todos);
	};

	$s.revertEditing = function(todo) {
		todos[todos.indexOf(todo)] = $scope.originalTodo;
		$s.doneEditing($s.originalTodo);
	}


	$s.toggleCompleted = function(todo) {
		$s.remainingCount += todo.completed ? -1 : 1;
		store.put(todos);
	};

	$s.clearCompleted = function() {
		$s.todos = todos = todos.filter(function(val) {
			return !val.completed;
		});
		store.put(todos);
	}

	$s.markAll = function(completed) {
		todos.forEach(function(todo) {
			todo.completed = !completed;
		});
		$s.remainingCount = completed ? todos.length : 0;
		store.put(todos);
	}



}])



}())



