/**
 * Created by kazt on 26/05/17.
 */
var app3 = angular.module("moduleTambahBab",[]);
app3.controller("addBab", function($scope,$http,$window){
    $scope.isBab = false;
    $scope.isMapel = false;
    $scope.message = "";
    $scope.init = function () {
        $scope.isBab = false;
        $scope.isMapel = false;
        $scope.isBabNotValid = false;
        $scope.isDataValid = false;
    };
    $scope.namaMapel = [];
    $scope.idUser = serverVariable;
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
            $scope.isMapel = true;
        }else {
            $scope.isMapel = false;
        }
    };

    $scope.cekBab = function (namaBabMapel) {
        console.log($scope.mapel);
        console.log(namaBabMapel);
        $http.post(
            "../../php/tambahbab/isbabmapel.php",
            {'namaBab':namaBabMapel, 'idMapel':$scope.mapel}
        ).then(function successCallback(response) {
            if (response.data){
                $scope.isBabNotValid = false;
                $scope.message = "";
                console.log("nama bab tersedia");
                $scope.isBab = true;
                $scope.isDataValid = true;
            }else {
                $scope.isBabNotValid = true;
                $scope.message = "nama bab sudah ada";
                console.log("nama bab sudah ada");
                $scope.isBab = false;
                $scope.isDataValid = false;
            }
        }, function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    }

    $scope.tambahBab = function(){
        console.log("sebelum dikirim")
        console.log($scope.mapel);
        console.log($scope.namaBabMapel);
        console.log($scope.deskripsiBabMapel);

        $http.post(
            "../../php/tambahbab/pushBab.php",
            {'idMapel':$scope.mapel, 'namaBabMapel':$scope.namaBabMapel, 'deskripsiBabMapel':$scope.deskripsiBabMapel}
        ).then(function successCallback(response) {
            if (response.data){
                alert("data berhasil di tambah kan");
                $scope.namaBabMapel = "";
                $scope.deskripsiBabMapel = "";
                $scope.isBab = false;
                $scope.isDataValid = false;
            }
        }, function errorCallback(response) {
            alert("koneksi gagal");
        });
    };
});