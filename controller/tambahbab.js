/**
 * Created by kazt on 26/05/17.
 */
var app3 = angular.module("moduleTambahBab",[]);
app3.controller("addBab", function($scope,$http,$window){
    $scope.isBab = false;
    $scope.isMapel = false;
    $scope.init = function () {
        $scope.isBab = false;
        $scope.isMapel = false;
    }
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
    }

    $scope.cekMapel = function(mapel){
        var index = $scope.namaMapel.indexOf(mapel);
        console.log(index);
        if (index >= 0){
            $scope.isMapel = true;
        }else {
            $scope.isMapel = false;
        }
    }

    $scope.tambahBab = function(){
        console.log($scope.mapel);
        console.log($scope.namaBabMapel);
        console.log($scope.deskripsiBabMapel);
        $http.post(
            "pushBab.php",
            {'idMapel':$scope.mapel, 'namaBabMapel':$scope.namaBabMapel, 'deskripsiBabMapel':$scope.deskripsiBabMapel}
        ).success(function(data){
            alert(data);
            $scope.mapel = null;
            $scope.namaBabMapel = null;
            $scope.deskripsiBabMapel = null;
        });
    }
});