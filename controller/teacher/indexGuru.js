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
    $scope.getLastRespon = function () {
        $http.get(
            "../../php/index/loadListRespon.php"
        ).then(function successCallback(response) {
            $scope.respons = response.data;
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
});