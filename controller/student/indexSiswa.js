var app = angular.module("indekSiswa",[]);
app.controller("indexSiswaController", function ($scope,$http,$window,$compile) {
    $scope.idUser = serverVariable;
    $scope.getUserInformation = function () {
        $http.post(
            
        ).then(function () {
            
        },function () {
            
        });
    };
});