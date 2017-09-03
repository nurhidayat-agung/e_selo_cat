/// <reference path="../../type_master/angularjs/angular.d.ts" />
/// <reference path="../../type_master/angularjs/angular-resource.d.ts" />

var app = angular.module("moduleTambahTest",[]);
app.controller("addTest", function($scope, $http){
    $scope.idUser = serverVariable;
    $scope.isDataValid = false;
    $scope.isNamaNotValid = true;
    $scope.msgBankSoal = "";
    $scope.jmlMaxPilGand = 0;
    $scope.jmlMaxEssay = 0;

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
                $scope.jmlMaxPilGand = response.data.jmlMaxPilGan;
                $scope.jmlMaxEssay = response.data.jmlMaxEssay;
                $scope.msgBankSoal = $scope.jmlMaxPilGand + " soal pilihan ganda dan " + $scope.jmlMaxEssay + " soal essay tersedia dalam banksoal";
            },function errorCallback(response) {
                alert("gagal load soal bank soal");
            });
        }else {
            $scope.jmlMaxPilGand = 0;
            $scope.jmlMaxEssay = 0;
            $scope.msgBankSoal = "";
        }
    };

    $scope.pushTest = function () {
        if($scope.banksoal > 0){
            if ($scope.jmlPilGan <= $scope.jmlMaxPilGand && $scope.jmlEssay <= $scope.jmlMaxEssay){
                $scope.scoreItem = 100/($scope.jmlEssay + $scope.jmlPilGan);
                $http.post(
                    "../../php/tambahTest/pushTest.php",
                    {
                        'idBankSoal':$scope.banksoal,
                        'namaTest':$scope.namaTest,
                        'jenisTest':$scope.radioJenis,
                        'waktuTest':$scope.waktuTest,
                        'scoreItem':$scope.scoreItem,
                        'jmlPilGanda':$scope.jmlPilGan,
                        'jmlEssay':$scope.jmlEssay
                    }
                ).then(function successCallback(response) {
                    if (response.data){
                        alert("test berhasil ditambahkan");
                        $scope.banksoal = null;
                        $scope.namaTest = null;
                        $scope.radioJenis = null;
                        $scope.waktuTest = null;
                        $scope.scoreItem = null;
                        $scope.jmlPilGan = null;
                        $scope.jmlEssay = null;
                    }else {
                        alert("test gagal ditambahkan");
                    }
                },function errorCallback(response) {
                    alert("koneksi gagal");
                });
            }else {
                alert("jumlah soal yang anda pilih melebihi yang tersedia di bank soal");
            }
        }else {
            alert("silahkan pilih banksoal terlebih dahulu");
        }
    };

    $scope.loadTest = function () {
        
    };

 });


 