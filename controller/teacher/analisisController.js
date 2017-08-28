/// <reference path="../../../DefinitelyTyped-master/angularjs/angular.d.ts" />
/// <reference path="../../../DefinitelyTyped-master/angularjs/angular-resource.d.ts" />

var app4 = angular.module("analisisSoal",[]);
app4.controller("addSoal", function($scope,$http,$window,$compile){
    $scope.$watch('telephone', function (value) {
        console.log(value);
    }, true);
    $scope.loadMapel = function(){
        $http.get(
            "../../php/analisis/loadmapel.php"
        ).then(function successCallback(response){
            $scope.mapels = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
    $scope.cekMapel = function(){
        console.log($scope.mapel);
        console.log($scope.idUser);
    };
    $scope.loadbanksoal = function(){
        $scope.selectMapel = $scope.mapel;
        console.log($scope.selectMapel);
        $http.post(
            "../../php/analisis/loadbanksoal.php",
            {'idMapel':$scope.mapel}
        ).then(function successCallback(response){
            //alert(data);
            $scope.banksoals = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
    $scope.displayData = function(){
        $http.get(
            "../../php/analisis/loadAnalisis.php"
        ).then(function successCallback(response){
            $scope.analisises = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
    $scope.analisis = function(){
        console.log($scope.mapel);
        console.log($scope.banksoal);
        $http.post(
            "../../php/analisis/analisisClustering.php",
            {'idMapel':$scope.mapel, 'idBanksoal':$scope.banksoal}
        ).then(function successCallback(response){
            $scope.dataSoal = angular.fromJson(response.data);
            var a = $scope.dataSoal.a;
            var b = $scope.dataSoal.b;
            var c = $scope.dataSoal.c;
            alert(a+" "+" "+b+" "+c);
            //$scope.banksoals = data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.showSoal = function () {
        $http.post(
            "../../php/analisis/loadSoalParameter.php",
            {'idBankSoal': $scope.banksoal}
        ).then(function successCallback(response) {
            if(response.data.status){
                $scope.analisises = response.data.data;
            }else {
                alert("soal tidak di temukan");
            }
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.resetResponButir =  function () {
        $http.post(
            "../../php/analisis/analisisTingkatKesulitan.php",
            {'status':false,'idBankSoal': $scope.banksoal}
        ).then(function successCallback(response) {
            $scope.showSoal();

        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.setResponButir = function () {
        $http.post(
            "../../php/analisis/analisisTingkatKesulitan.php",
            {'status':true,'idBankSoal': $scope.banksoal}
        ).then(function successCallback(response) {
            $scope.showSoal();

        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
});

