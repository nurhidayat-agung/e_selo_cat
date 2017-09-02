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


    $scope.cekBankSoal = function (namabanksoal) {
        $http.post(
            "../../php/tambahbanksoal/isbanksoal.php",
            {'namabanksoal': namabanksoal}
        ).then(function successCallback(response) {
            if (response.data){
                console.log("nama bank soal valid");
                $scope.bankSoalValid = true;
                $scope.dataValid = true;
            }else {
                console.log("nama bank soal tidak valid");
                $scope.bankSoalValid = false;
                $scope.dataValid = false;
            }
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };


    $scope.tambahBankSoal = function () {
        console.log("id mapel = " + $scope.mapel);
        console.log("nama bank soal = " + $scope.namabanksoal);
        console.log("jumlah soal = " + $scope.jumlahsoal);
        console.log("deskripsi bank soal = " + $scope.deskripsibanksoal);
        console.log("idUser = " + $scope.idUser);

        // $http.post(
        //     "../../php/tambahbanksoal/pushbanksoal.php",
        //     {'idUser': $scope.idUser, 'namaBankSoal': $scope.namabanksoal,'deskripsiBankSoal': $scope.deskripsibanksoal}
        // ).then(function successCallback(response) {
        //     if(response.data){
        //         console.log("sukses");
        //         $scope.namabanksoal = "";
        //         $scope.deskripsibanksoal = "";
        //         $scope.dataValid = false;
        //     }else {
        //         console.log("gagal");
        //     }
        //     $scope.getBankSoal();
        // }, function errorCallback(response) {
        //     alert("sambungan gagal");
        // });
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