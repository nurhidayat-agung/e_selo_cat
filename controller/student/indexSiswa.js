var app = angular.module("indekSiswa",[]);
app.controller("indexSiswaController", function ($scope,$http,$window,$compile) {
    $scope.nis = serverVariable;

    $scope.getUserInformation = function () {
        $scope.isMulaiTest = false;
        $http.post(
            "../../php/siswa/loadProfile.php",
            {'nis':$scope.nis}
        ).then(function successCallback(response) {
            $scope.nis = response.data.nis;
            $scope.namaSiswa = response.data.namaSiswa;
            $scope.namaAngkatan = response.data.namaAngkatan;
            $scope.namaPleton = response.data.namaPleton;
        },function errorCallback(response) {
            alert("load profile gagal");
        });
    };
    $scope.getResponData = function () {
        $http.post(
            "../../php/siswa/getLastRespon.php",
            {'nis':$scope.nis}
        ).then(function successCallback(response) {
            $scope.respons = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };



});