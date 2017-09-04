/// <reference path="../../type_master/angularjs/angular.d.ts" />
/// <reference path="../../type_master/angularjs/angular-resource.d.ts" />

 var app = angular.module("myapp",[]);  
 app.controller("cRegis", function($scope,$http,$window){
     // $scope.jobs = ["siswa","guru"];
     $scope.isavailable = false;
     $scope.isusername = true;
     $scope.change = function(){
        if ($scope.nis === "") {
            $scope.isusername = false;
            $scope.message = "NIS harus di isi";
        }else{
            $http.post(  
                "php/index/cekuser.php",  
                {'nis':$scope.nis}  
            ).then(function successCallback(response) {
                if(response.data){
                    $scope.isavailable = true;
                    $scope.message = "NIS tersedia";
                    $scope.isusername = false;
                }else{
                    $scope.isavailable = false;
                    $scope.message = "NIS telah terdaftar";
                    $scope.isusername = true;
                }
            }, function errorCallback(response) {
                    alert("insert data gagal");
            });
        }              
      }
     $scope.insertData = function(){            
        $http.post(  
            "php/index/register.php",  
            {'nis':$scope.nis, 'namaSiswa':$scope.namaSiswa,'password':$scope.password,'idAngkatan':$scope.idAngkatan,'idPleton':$scope.idPleton,'idKompi':$scope.idKompi}  
        ).then(function successCallback(response) {
            if(response.data){
                alert('Registrasi Berhasil, Silahkan login');
                $scope.username = null;  
                $scope.password = null;
                $scope.nama = null;
                $scope.email = null;
            }
        }, function errorCallback(response) {
                alert("insert data gagal");
        });  
      };

    $scope.loadPleton = function () {
        $http.get(
            "php/pleton/loadPleton.php"
        ).then(function successCallback(response) {
            $scope.pletons = response.data;
        },function errorCallback(response) {
            alert("load Pleton gagal");
        });
    };

    $scope.loadKompi = function () {
        $http.get(
            "php/kompi/loadKompi.php"
        ).then(function successCallback(response) {
            $scope.kompis = response.data;
        },function errorCallback(response) {
            alert("load Kompi gagal");
        });
    };

    $scope.loadAngkatan = function () {
        $http.get(
            "php/angkatan/loadAngkatan.php"
        ).then(function successCallback(response) {
            $scope.angkatans = response.data;
        },function errorCallback(response) {
            alert("load angkatan gagal");
        });
    };

 });
 app.controller("cLogin",function($scope,$http,$window){
     $scope.login = function(){
         console.log("lnis : "+ $scope.lnis);
         console.log("lPassword : "+ $scope.lPassword);
         $http.post(
         "php/index/loginSiswa.php",
         {'nis':$scope.lnis, 'password':$scope.lPassword}
         ).then(function successCallback(response) {
             if(response.data === "siswa"){
                $window.location = 'view/siswa/index.php';
             }else{
                 alert("username and password salah");
             }
         }, function errorCallback(response) {
             alert("koneksi bermasalah");
         });
     };

 });
