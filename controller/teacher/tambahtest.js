/// <reference path="../../type_master/angularjs/angular.d.ts" />
/// <reference path="../../type_master/angularjs/angular-resource.d.ts" />

var app = angular.module("moduleTambahTest",[]);
app.controller("addTest", function($scope, $http){
    $scope.idUser = serverVariable;
    $scope.isDataValid = false;
    $scope.isNamaNotValid = true;

    $scope.loadBankSoal = function(){
        $http.get(
            "../../php/utilFunction/loadbanksoal.php"
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

 });


 