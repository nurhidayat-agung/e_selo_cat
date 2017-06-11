/// <reference path="../../type_master/angularjs/angular.d.ts" />
/// <reference path="../../type_master/angularjs/angular-resource.d.ts" />

 var app = angular.module("myapp",[]);  
 app.controller("cRegis", function($scope,$http,$window){
     $scope.jobs = ["siswa","guru"];
     $scope.isavailable = false;
     $scope.isusername = true;
     $scope.change = function(){
        if ($scope.username == "") {
            $scope.isusername = false;
            $scope.message = "username harus diisis";
        }else{
            $http.post(  
                "php/index/cekuser.php",  
                {'username':$scope.username}  
            ).then(function successCallback(response) {
                if(response.data){
                    $scope.isavailable = true;
                    $scope.message = "username tersedia";
                    $scope.isusername = false;
                }else{
                    $scope.isavailable = false;
                    $scope.message = "username telah terdaftar";
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
            {'username':$scope.username, 'password':$scope.password,'nama':$scope.nama,'job':$scope.job,'email':$scope.email}  
        ).then(function successCallback(response) {
            if(response.data){
                alert("insert data berhasil");
                $scope.username = null;  
                $scope.password = null;
                $scope.nama = null;
                $scope.email = null;
            }
        }, function errorCallback(response) {
                alert("insert data gagal");
        });  
      }  
 });
 app.controller("cLogin",function($scope,$http,$window){
     $scope.login = function(){
         $http.post(
         "php/index/login.php",
         {'username':$scope.lUsername, 'password':$scope.lPassword}
         ).then(function successCallback(response) {
             if(response.data == "siswa"){
                 // $window.location = 'masagung/siswa/index.php';
                 alert("siswa");
             }else if(response.data == "guru"){
                 $window.location = 'view/guru/index.php';
             }else{
                 alert("username and password salah");
             }
         }, function errorCallback(response) {
             alert("koneksi bermasalah");
         });
     }

 });


// success(function(data){
//     console.log(data);
//     if(data.indexOf("siswa") > -1){
//         $window.location = 'masagung/siswa/index.php';
//     }else if(data.indexOf("guru") > -1){
//         $window.location = 'masagung/admin/index.php';
//     }else{
//         alert("username and password salah");
//     }
// });