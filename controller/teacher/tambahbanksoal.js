/**
 * Created by kazt on 7/5/2017.
 */

var app = angular.module("moduleTambahBankSoal", []);

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

app.controller("addBankSoal",function ($scope,$http,$window) {
    $scope.namaMapel = [];
    $scope.idUser = serverVariable;

    $scope.initial = function () {
        $scope.mapelValid = false;
        $scope.bankSoalValid = false;
        $scope.jumlahSoalValid = false;
        $scope.dataValid = false;
        $scope.namabanksoal = null;
        $scope.jumlahsoal = null;
        $scope.deskripsibanksoal = null;
    };

    $scope.loadMapel = function(){
        $http.get(
            "../../php/tambahbab/loadmapel.php"
        ).then(function successCallback(response) {
            $scope.mapels = response.data;
            $scope.rawJson = angular.fromJson(response.data);
            for (var i = 0; i < $scope.rawJson.length; i++){
                $scope.namaMapel.push($scope.rawJson[i].idMapel);
            }
        }, function errorCallback(response) {
            alert("koneksi gagal");
        });
    };

    $scope.cekMapel = function(mapel){
        var index = $scope.namaMapel.indexOf(mapel);
        console.log(index);
        console.log($scope.namaMapel[index]);
        if (index >= 0){
            $scope.initial();
            $scope.mapelValid = true;
        }else {
            $scope.mapelValid = false;
        }
    };

    $scope.cekBankSoal = function (namabanksoal) {
        $http.post(
            "../../php/tambahbanksoal/isbanksoal.php",
            {'namabanksoal': namabanksoal, 'idMapel': $scope.mapel}
        ).then(function successCallback(response) {
            if (response.data){
                console.log("nama bank soal valid");
                $scope.bankSoalValid = true;
                $scope.dataValid = false;
                console.log("jumlah soal = " + $scope.jumlahsoal);
                if (parseInt($scope.jumlahsoal)  >= 1 ){
                    $scope.dataValid = true;
                }else {
                    $scope.dataValid = false;
                }
            }else {
                console.log("nama bank soal tidak valid");
                $scope.bankSoalValid = false;
                $scope.dataValid = false;
            }
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.cekJumlahSoal = function (jumlahsoal) {
        if (parseInt(jumlahsoal) >= 1){
            $scope.dataValid = true;
        }else {
            $scope.dataValid = false;
        }
    };

    $scope.tambahBankSoal = function () {
        console.log("id mapel = " + $scope.mapel);
        console.log("nama bank soal = " + $scope.namabanksoal);
        console.log("jumlah soal = " + $scope.jumlahsoal);
        console.log("deskripsi bank soal = " + $scope.deskripsibanksoal);
        console.log("idUser = " + $scope.idUser);

        $http.post(
            "../../php/tambahbanksoal/pushbanksoal.php",
            {'idMapel': $scope.mapel, 'idUser': $scope.idUser, 'namaBankSoal': $scope.namabanksoal, 'jml_soal': $scope.jumlahsoal, 'deskripsiBankSoal': $scope.deskripsibanksoal}
        ).then(function successCallback(response) {
            if(response.data){
                console.log("sukses");
                $scope.namabanksoal = "";
                $scope.jumlahsoal = "";
                $scope.deskripsibanksoal = "";
                $scope.dataValid = false;
            }else {
                console.log("gagal");
            }
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };


});