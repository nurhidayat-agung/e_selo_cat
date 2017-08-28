var app = angular.module("indekSiswa",[]);
app.controller("indexSiswaController", function ($scope,$http,$window,$compile) {
    $scope.idUser = serverVariable;
    $scope.getUserInformation = function () {
        $http.post(
            "../../php/siswa/loadProfile.php",
            {'idUser':$scope.idUser}
        ).then(function successCallback(response) {
            var jsonProfil = angular.fromJson(response.data);
            $scope.username = jsonProfil.username;
            $scope.maskPass = jsonProfil.password;
            $scope.status = jsonProfil.job;
            $scope.nama = jsonProfil.nama;
            $scope.email = jsonProfil.email;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
    $scope.getResponData = function () {
        $http.post(
            "../../php/siswa/getLastRespon.php",
            {'idUser':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.respons = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
});