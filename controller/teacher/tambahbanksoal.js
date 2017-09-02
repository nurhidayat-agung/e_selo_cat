/**
 * Created by kazt on 7/5/2017.
 */

var app = angular.module("moduleTambahBankSoal", ['angularModalService']);

app.directive('integer', function(){
    return {
        require: 'ngModel',
        link: function(scope, ele, attr, ctrl){
            ctrl.$parsers.unshift(function(viewValue){
                return parseInt(viewValue, 10);
            });
        }
    };
});

app.controller("addBankSoal",function ($scope,$http,ModalService,$window) {
    $scope.namaMapel = [];
    $scope.idUser = serverVariable;
    $scope.isThereBankSoal = false;
    $scope.isKetua = false;

    $scope.initial = function () {
        $scope.loadKetua();
    };

    $scope.loadKetua =  function () {
        $http.post(
            "../../php/tambahbanksoal/isKetua.php",
            {"idUser":$scope.idBankSoal}
        ).then(function successCallback(response) {
            if(response.data){
                $scope.isKetua = true;
            }else {
                $scope.isKetua = false;
            }
        },function errorCallback(response) {
            alert("gagalmelihat status ketua")
        });
    };

    $scope.loadTimPengajar = function () {
        console.log("idUser : "+ $scope.idUser);
        $http.post(
            "../../php/tambahbanksoal/loadTimPengajarUser.php",
            {'nip_nrp':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.pengajars = response.data;
        },function errorCallback(response) {
            alert("gagal load tim pengajar");
        });
    };

    $scope.cekBankSoal = function () {
        if ($scope.timPengajar > 0){
            console.log("idTimPengajar : "+ $scope.timPengajar);
            console.log("namaBankSoal : " + $scope.namabanksoal);
            console.log("deskripsiBankSoal : " + $scope.deskripsibanksoal);
            $http.post(
                "../../php/tambahbanksoal/isbanksoal.php",
                {'nip_nrp':$scope.idUser,'namaBankSoal': $scope.namabanksoal}
            ).then(function successCallback(response) {
                console.log("respon : "+response.data);
                if (response.data){
                    console.log("ready push bank soal");
                    $scope.pushBankSoal();
                }else {
                    alert("nama bank soal sudah ada dalam data base");
                }
            }, function errorCallback(response) {
                alert("sambungan gagal");
            });
        }else {
            alert("pilih tim pengajar terlebih dahulu");
        }

    };


    $scope.tambahBankSoal = function () {
        console.log("id mapel = " + $scope.mapel);
        console.log("nama bank soal = " + $scope.namabanksoal);
        console.log("jumlah soal = " + $scope.jumlahsoal);
        console.log("deskripsi bank soal = " + $scope.deskripsibanksoal);
        console.log("idUser = " + $scope.idUser);
        $scope.cekBankSoal()
    };

    $scope.pushBankSoal = function () {
        console.log("idTimPengajar : "+ $scope.timPengajar);
        console.log("namaBankSoal : " + $scope.namabanksoal);
        console.log("deskripsiBankSoal : " + $scope.deskripsibanksoal);
        $http.post(
            "../../php/tambahbanksoal/pushbanksoal.php",
            {'idTimPengajar': $scope.timPengajar,'namaBankSoal': $scope.namabanksoal,'deskripsiBankSoal': $scope.deskripsibanksoal}
        ).then(function successCallback(response) {
            if(response.data){
                console.log("sukses");
                $scope.namabanksoal = "";
                $scope.deskripsibanksoal = "";
                $scope.dataValid = false;
            }else {
                console.log("gagal");
            }
            $scope.getBankSoal();
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.getBankSoal = function () {
        console.log("getBankSoal");
        $http.post(
            "../../php/tambahbanksoal/getBankSoal.php",
            {'idUser':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
            if (response.data.length > 0){
                $scope.isThereBankSoal = true;
            }else {
                $scope.isThereBankSoal = false;
            }
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.deleteBankSoal = function (idBankSoal) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "DeleteController",
            inputs: {
                idBankSoal: idBankSoal
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.getBankSoal();
            });
        });
    };
});

app.controller('DeleteController', function($scope,$http,$window,close,idBankSoal) {
    $scope.idBankSoal = idBankSoal;
    $scope.modalyes = function () {

    };
});