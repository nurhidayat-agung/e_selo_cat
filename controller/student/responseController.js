/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("response",['angularModalService']);
app4.controller("responseC",function($scope,$http,$window,$compile,ModalService){
     $scope.nis = serverVariable;
    $scope.loadResponTest = function () {
        $http.post(
            "../../php/siswa/loadResponTest.php",
            {'nis':$scope.nis}
        ).then(function successCallback(response) {
            $scope.nilais = response.data;
        },function errorCallback(response) {
            alert("load statistik gagal");
        });
    };
   

});


