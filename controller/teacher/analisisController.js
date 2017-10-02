/// <reference path="../../../DefinitelyTyped-master/angularjs/angular.d.ts" />
/// <reference path="../../../DefinitelyTyped-master/angularjs/angular-resource.d.ts" />

var app4 = angular.module("analisisSoal",[]);
app4.controller("addSoal", function($scope,$http,$window,$compile){
    $scope.idUser = serverVariable;
    $scope.isIRT = false;
    $scope.isBankSoal = false;

    $scope.$watch('telephone', function (value) {
        console.log(value);
    }, true);

    $scope.loadbanksoal = function(){
        $scope.selectMapel = $scope.mapel;
        $http.post(
            "../../php/utilFunction/loadbanksoal.php",
            {'nip_nrp':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };


    $scope.showSoal = function () {
        $http.post(
            "../../php/analisis/loadSoalParameter.php",
            {'idBankSoal': $scope.banksoal}
        ).then(function successCallback(response) {
            $scope.analisises = null;
            if(response.data.status){
                $scope.analisises = response.data.data;
                $scope.isBankSoal = true;
            }else {
                alert("soal tidak di temukan");
                $scope.isBankSoal = false;
                $scope.isIRT = false;
            }
        },function errorCallback(response) {
            alert("sambungan gagal");
            $scope.isBankSoal = false;
            $scope.isIRT = false;
        });
    };

    $scope.resetResponButir =  function () {
        $http.post(
            "../../php/analisis/analisisTingkatKesulitan.php",
            {'status':false,'idBankSoal': $scope.banksoal}
        ).then(function successCallback(response) {
            $scope.isIRT = false;
            if (response.data.status){
                $scope.showSoal();
                alert(response.data.message);
            }else {
                alert(response.data.message);
            }
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.setResponButir = function () {
        console.log("id bank soal : " + $scope.banksoal);
        $http.post(
            "../../php/analisis/analisisTingkatKesulitan.php",
            {'status':true,'idBankSoal': $scope.banksoal}
        ).then(function successCallback(response) {
            if (response.data.status){
                $http.post(
                    "../../php/analisis/analisisDayaBeda.php",
                    {'idBankSoal': $scope.banksoal}
                ).then(function successCallback(response) {
                    if (response.data.status){
                        $scope.isIRT = true;
                        $scope.showSoal();
                        alert(response.data.message);
                        console.log(response.data);
                    }else {
                        alert(response.data.message);
                        $scope.isIRT = false;
                    }
                },function errorCallback(response) {
                    alert("analisis daya beda gagal");
                    $scope.isIRT = false;
                });
            }else {
                alert(response.data.message);
                $scope.isIRT = false;
            }
        },function errorCallback(response) {
            alert("sambungan gagal");
            $scope.isIRT = false;
        });
    };

    $scope.resetCluster = function () {
        $http.post(
            "../../php/analisis/analisisKmeans.php",
            {'status':false,'idBankSoal':$scope.banksoal}
        ).then(function successCallback(response) {
            $scope.showSoal();
            alert(response.data.messege);
        },function errorCallback(response) {
            alert("koneksi gagal");
        });
    };

    $scope.setCluster = function () {
        $http.post(
            "../../php/analisis/analisisKmeans.php",
            {'status':true,'idBankSoal':$scope.banksoal}
        ).then(function successCallback(response) {
            $scope.showSoal();
            alert(response.data.messege)
        },function errorCallback(response) {
            alert("koneksi gagal");
        });
    }
});

