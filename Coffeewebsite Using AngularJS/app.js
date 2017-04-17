'use strict';

// Declare app level module which depends on views, and components
var myApp = angular.module('myApp', [
  'ngRoute',
  'coffeesControllers',
	'ui.bootstrap'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.
  	when('/coffees', {
  		templateUrl: 'coffees.html',
  		controller: 'coffeeListController'
  	}).
  	when('/coffees/:coffeeId', {
  		templateUrl: 'reviews.html',
  		controller: 'coffeeReviewController'
  	}).
  	otherwise({redirectTo: '/coffees'});
}]);

var coffeesControllers = angular.module('coffeesControllers', []);
coffeesControllers.controller('coffeeListController', ['$scope', 
	function($scope){
		$scope.coffees = [
	       {'id': 1,
	       'brand': "Average Andy's Coffee",
	       'name': 'Regular Coffee',
	       'country': 'Denmark',
	       'reviews': [
	               {'rating': 3,
	               'comment': "Could've been crispier",
	               'reviewer': "Chris P. Bacon"
	               }
	       		]
	       },
	       {'id': 2,
	       'brand': "Jimmy's Coffee",
	       'name': 'Mocha',
	       'country': 'America',
	       'reviews': [
			       {'rating': 10,
			       'comment': 'What everyone should drink in the morning!',
			       'reviewer': 'Earl Lee Riser'
			       },
			       {'rating': 10,
			       'comment': 'A genius of everything coffee',
			       'reviewer': 'Bob'
			       }
	       		]
	       },
	       {'id': 3,
	       'brand': "We Did Our Best",
	       'name': 'Latte',
	       'country': 'France',
	       'reviews': [
			       {'rating': 1,
			       'comment': " a 'latte' yuckiness.",
			       'reviewer': 'Tim Burr'
			       },
			       {'rating': 1,
			       'comment': 'Is this even coffee?',
			       'reviewer': 'Sue Flay'
			       },
			        {'rating': 1,
			       'comment': 'The grossest thing I have ever had.',
			       'reviewer': 'Myles Long'
			       },
			        {'rating': 5,
			       'comment': 'I dont know what the fuss is about, i dont think its too bad!',
			       'reviewer': 'Sara Bellum'
			       }
	       		]
	       },
	       {'id': 4,
	       'brand': "Jimmy's Special Coffee",
	       'name': 'Americano',
	       'country': 'America',
	       'reviews': [
			       {'rating': 10,
			       'comment': 'If I could rate it higher, I would!',
			       'reviewer': 'Justin Case'
			       },
			       {'rating': 10,
			       'comment': 'He does it again!',
			       'reviewer': 'Eileen Dover'
			       }
	       		]
	       }
	    ];
	    $scope.orderProp = 'name';
	}]);
coffeesControllers.controller('coffeeReviewController', ['$scope', '$routeParams', 
	function($scope, $routeParams){
		$scope.coffees =
	       [
	       {'id': 1,
	       'brand': "Average Andy's Coffee",
	       "imageUrl": "img/regular.jpg",
	       'name': 'Regular Coffee',
	       'country': 'Denmark',
	       'reviews': [
	               {'rating': 3,
	               'comment': "Could've been crispier",
	               'reviewer': "Chris P. Bacon"
	               }
	       ]
	       },
	       {'id': 2,
	       'brand': "Jimmy's Coffee",
	       "imageUrl": "img/mocha.jpg",
	       'name': 'Mocha',
	       'country': 'America',
	       'reviews': [
	       {'rating': 10,
	       'comment': 'What everyone should drink in the morning!',
	       'reviewer': 'Earl Lee Riser'
	       },
	       {'rating': 10,
	       'comment': 'A genius of everything coffee',
	       'reviewer': 'Bob'
	       }
	       ]
	       },
	       {'id': 3,
	       'brand': "We Did Our Best",
	       "imageUrl": "img/Latte.jpg",
	       'name': 'Latte',
	       'country': 'France',
	       'reviews': [
	       {'rating': 1,
	       'comment': " a 'latte' yuckiness.",
	       'reviewer': 'Tim Burr'
	       },
	       {'rating': 1,
	       'comment': 'Is this even coffee?',
	       'reviewer': 'Sue Flay'
	       },
	        {'rating': 1,
	       'comment': 'The grossest thing I have ever had.',
	       'reviewer': 'Myles Long'
	       },
	        {'rating': 5,
	       'comment': 'I dont know what the fuss is about, i dont think its too bad!',
	       'reviewer': 'Sara Bellum'
	       }
	       ]
	       },
	       {'id': 4,
	       'brand': "Jimmy's Special Coffee",
	       "imageUrl": "img/americano.jpg",
	       'name': 'Americano',
	       'country': 'America',
	       'reviews': [
	       {'rating': 10,
	       'comment': 'If I could rate it higher, I would!',
	       'reviewer': 'Justin Case'
	       },
	       {'rating': 10,
	       'comment': 'He does it again!',
	       'reviewer': 'Eileen Dover'
	       }
	       ]
	       }];
	    var id = $routeParams.coffeeId;
		$scope.coffeeReview = $scope.coffees[id-1]; 
	}]);