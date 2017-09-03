/// <reference path="../../type_master/angularjs/angular.d.ts" />
/// <reference path="../../type_master/angularjs/angular-resource.d.ts" />

var app = angular.module("moduleTambahTest",[]);
app.controller("addTest", function($scope, $http){
    $scope.idUser = serverVariable;
    $scope.isDataValid = false;
    $scope.isNamaNotValid = true;
    $scope.msgBankSoal = "";
    $scope.jmlPilGand = 0;
    $scope.jmlEssay = 0;

    $scope.loadBankSoal = function(){
        $http.post(
            "../../php/tambahbanksoal/loadBankSoalUser.php",
            {'nip_nrp':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.cekJmlSoal = function () {
        if ($scope.banksoal > 0){
            $http.post(
                "../../php/tambahTest/cekJmlSoal.php",
                {'idBankSoal':$scope.banksoal}
            ).then(function successCallback(response) {
                $scope.jmlPilGand = response.data.jmlPilGan;
                $scope.jmlEssay = response.data.jmlEssay;
                $scope.msgBankSoal = $scope.jmlPilGand + " soal pilihan ganda dan " + $scope.jmlEssay + " soal essay tersedia dalam banksoal";
            },function errorCallback(response) {
                alert("gagal load soal bank soal");
            });
        }else {
            $scope.jmlPilGand = 0;
            $scope.jmlEssay = 0;
            $scope.msgBankSoal = "";
        }
    }

    $scope.pushTest = function () {
        if($scope.banksoal > 0){

        }else {
            alert("silahkan pilih banksoal terlebih dahulu");
        }
    };

 });


 