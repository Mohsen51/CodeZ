var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
    $scope.custom= true;
    $scope.cpt= 0;
    $scope.disp = function(){
        $scope.custom = $scope.custom === false ? true : false;
    };
    $scope.addPoints = function (){
        $scope.cpt+=1;
    }
});