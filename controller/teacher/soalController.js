/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("moduleTambahSoal",[]);
app4.controller("addSoal", function($scope,$http,$window,$compile){
    $scope.telephone = [];
    $scope.arrsoal = [];
    $scope.arrjawab = [];
    $scope.arropsi1 = [];
    $scope.arropsi2 = [];
    $scope.arropsi3 = [];
    $scope.arropsi4 = [];
    $scope.selectMapel = "";
    $scope.selectBankSoal = "";
    $scope.selectBab = "";
    $scope.jmlSoal = 0;
    $scope.idUser = serverVariable;
    $scope.ready = "true";
    var myEl = angular.element(document.querySelector( 'isiLoop' ));
    $scope.$watch('telephone', function (value) {
        console.log(value);
    }, true);
    $scope.loadMapel = function(){
        $http.get("../../php/tambahbab/loadmapel.php")
            .then(function successCallback(response) {
                $scope.mapels = response.data;
            }, function errorCallback(response) {
                alert("koneksi gagal");
            });
    }
    $scope.cekMapel = function(){
        console.log($scope.mapel);
        console.log($scope.idUser);
    }
    $scope.loadbanksoal = function(){
        $scope.selectMapel = $scope.mapel;
        console.log($scope.selectMapel);
        $http.post(
            "../../php/tambahsoal/loadbanksoal.php",
            {'idMapel':$scope.mapel}
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });

    };

    $scope.pushBab = function(){
        $scope.selectBab = $scope.bab;
        console.log("id bab : " + $scope.selectBab);

    };

    $scope.loadSoal = function () {
        console.log("id bank soal : " + $scope.selectBankSoal);
        console.log("id mapel : " + $scope.selectMapel);
        $http.post(
            "../../php/tambahsoal/loadsoal.php",
            {'idMapel': $scope.selectMapel, 'idBankSoal': $scope.selectBankSoal}
        ).then(function successCallback(response) {
              $scope.soals = response.data;
        }, function errorCallback(response) {
                alert("sambungan gagal");
        });
    };



});