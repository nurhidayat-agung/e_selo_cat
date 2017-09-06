
angular.module("clock", ["ds.clock"]).controller("AppCtrl", function ($scope) {
    $scope.getTime = function () {
        $scope.format = 'dd-MMM-yyyy hh:mm:ss a';
    };
});