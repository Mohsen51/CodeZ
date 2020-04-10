<DOCTYPE>
<html>
<body>
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>  
<div ng-app="myApp" ng-controller="customersCtrl" ng-init="displayData()">

<table>
  <tr ng-repeat="x in names">
    <td>{{ x.player_pseudo }}</td>
    
  </tr>
</table>

</div>
</body>
</html>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {

	$scope.displayData = function(){
		$http.get("getdata.php")
		.success(function(data){
			$scope.names = data;
		});
	}

	
    
    
});
</script>