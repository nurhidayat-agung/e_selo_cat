var app = angular.module("indekGuru",[]);
app.controller("contentController", function ($scope,$http,$window,$compile) {
    $scope.idUser = serverVariable;
    $scope.getLastBankSoal = function () {
        $http.get(
            "../../php/index/loadListBankSoal.php"
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.loadNilai = function () {
        $http.get(
            "../../php/statistik/loadNilai.php"
        ).then(function successCallback(response) {
            $scope.nilais = response.data;
        },function errorCallback(response) {
            alert("load Nilai gagal");
        });
        $scope.quantity = 10;
    };

    $scope.getLastRespon = function () {
        $http.get(
            "../../php/index/loadListRespon.php"
        ).then(function successCallback(response) {
            $scope.respons = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
    $scope.loadGuruProfile = function () {
        $http.post(
            "../../php/utilFunction/loadProfileUser.php",
            {'idUser':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.userName = response.data.nama;
            $scope.userPass = response.data.password;
            $scope.userEmail = response.data.email;
        },function errorCallback(response) {
            alert("load profile gagal");
        });
    };

});
