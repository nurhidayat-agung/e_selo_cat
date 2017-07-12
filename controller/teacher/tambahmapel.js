/// <reference path="../../type_master/angularjs/angular.d.ts" />
/// <reference path="../../type_master/angularjs/angular-resource.d.ts" />

var app = angular.module("moduleTambahMapel",[]);  
app.controller("addMapel", function($scope, $http){
    $scope.isDataValid = false;
    $scope.isNamaNotValid = true;
    $scope.cekNamaMapel = function () {
        $http.post(
            "../../php/tambahmapel/isNamaMapel.php",
            {'namaMapel':$scope.namamapel}
        ).then(function successCallback(response) {
            if(response.data){
                $scope.isNamaNotValid = false;
                $scope.isDataValid = true;
            }else{
                $scope.isDataValid = false;
                $scope.isNamaNotValid = true;
                $scope.message = "mapel sudah terdaftar";
            }
        }, function errorCallback(response) {
            alert("koneksi gagal");
        });
    }
    $scope.pushMapel = function(){
        if ($scope.isDataValid){
            $http.post(
                "../../php/tambahmapel/pushMapel.php",
                {'namaMapel':$scope.namamapel, 'deskripsiMapel':$scope.deskripsimapel}
            ).then(function successCallback(response) {
                if(response.data){
                    $scope.isNamaNotValid = true;
                    $scope.namamapel = "";
                    $scope.deskripsimapel = "";
                    alert("Data berhasil dimasukan");
                }else{
                    $scope.isNamaNotValid = false;
                    $scope.message = "mapel sudah terdaftar";
                }
            }, function errorCallback(response) {
                alert("koneksi gagal");
            });
        }else {
            alert("maaf ada data yang tidak valid silahkan periksa kembali");
        }

        // alert("cek");
      }
 });


 