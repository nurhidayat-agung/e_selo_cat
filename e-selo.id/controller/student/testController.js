/// <reference path="../../../DefinitelyTyped-master/angularjs/angular.d.ts" />
/// <reference path="../../../DefinitelyTyped-master/angularjs/angular-resource.d.ts" />

var app4 = angular.module("moduleTambahSoal",[]);
app4.controller("addSoal", function($scope,$http,$window,$compile){
    $scope.score = 0;
    $scope.cekJawab = true;
    $scope.radioValue = null;
    $scope.countSoal = 1;
    $scope.jumlahSoal = 0;
    $scope.telephone = [];
    $scope.arrsoal = [];
    $scope.arrjawab = [];
    $scope.arropsi1 = [];
    $scope.arropsi2 = [];
    $scope.arropsi3 = [];
    $scope.arropsi4 = [];
    $scope.selectMapel;
    $scope.selectBankSoal;
    $scope.selectBab;
    $scope.jmlSoal;
    $scope.idUser = serverVariable;
    $scope.ready = "true";
    $scope.idResponTest;
    $scope.idSoal;
    $scope.dayaBeda;
    $scope.tingkatKesulitanSoal;
    $scope.cluster;
    // $scope.isiSoal;
    // $scope.pil1;
    // $scope.pil2;
    // $scope.pil3;
    // $scope.pil4;
    // $scope.getKunci;
    $scope.dataSoal;
    $scope.hideSoal = function(){
        $scope.myValue = true;
    }

    var myEl = angular.element(document.querySelector( 'isiLoop' ));
    $scope.$watch('telephone', function (value) {
        console.log(value);
    }, true);
    $scope.loadMapel = function(){
        $http.get("../../php/analisis/loadmapel.php")
            .then(function successCallback(response){
                $scope.mapels = response.data;
            },function errorCallback(response) {
                alert("sambungan gagal");
            });
    };
    $scope.cekMapel = function(){
        console.log($scope.mapel);
        console.log($scope.idUser);
    };
    $scope.loadbanksoal = function(){
        $scope.selectMapel = $scope.mapel;
        console.log($scope.selectMapel);
        $http.post(
            "../../php/analisis/loadbanksoal.php",
            {'idMapel':$scope.mapel}
        ).then(function successCallback(response){
            //alert(data);
            $scope.banksoals = response.data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
    $scope.loadbabmapel = function(){
        $scope.myValue = true;
        $scope.selectBankSoal = $scope.banksoal;
        console.log($scope.selectBankSoal);
        $http.post(
            "../../php/tambahsoal/loadbabmapel.php",
            {'idMapel':$scope.mapel}
        ).then(function successCallback(response){
            $scope.babs = response.data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.$watch('arrsoal', function (value) {
        console.log(value);
    }, true);

    //soal section
    $scope.mulaiUjian = function(){
        console.log("idMapel : " + $scope.mapel);
        console.log("idBanksoal : " + $scope.banksoal);
        console.log("idUser : " + $scope.idUser);
        $scope.myValue = false;
        $scope.countSoal = 1;
        $http.post(
            "../../php/siswa/pushResponTest.php",
            {'idBankSoal':$scope.banksoal,'idUser':$scope.idUser}
        ).then(function successCallback(response){
            var jSonData = angular.fromJson(response.data);
            $scope.idResponTest = jSonData.idResponTest;
            $scope.jumlahSoal = jSonData.jml_soal;
            console.log("jumlahSoal : " + $scope.jumlahSoal);
            $http.post(
                "../../php/siswa/loadSoalFirst.php",
                {'idBanksoal':$scope.banksoal}
            ).then(function successCallback(response){
                $scope.dataSoal = angular.fromJson(response.data);
                $scope.idSoal = $scope.dataSoal.idSoal;
                $scope.isiSoal = $scope.dataSoal.isiSoal;
                $scope.pil1 = $scope.dataSoal.pil1;
                $scope.pil2 = $scope.dataSoal.pil2;
                $scope.pil3 = $scope.dataSoal.pil3;
                $scope.pil4 = $scope.dataSoal.pil4;
                $scope.getKunci = $scope.dataSoal.kunci;
                $scope.dayaBeda = $scope.dataSoal.dayaBeda;
                $scope.tingkatKesulitanSoal = $scope.dataSoal.tingkatKesulitanSoal;
                $scope.cluster = $scope.dataSoal.cluster;
                console.log("kunci : " + $scope.getKunci);
            },function errorCallback(response) {
                alert("sambungan gagal");
            });
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };
    $scope.nextQuestion = function(){
        console.log("idResponTest : "+ $scope.idResponTest);
        console.log("idSoal : "+ $scope.idSoal);
        $scope.countSoal ++;
        //alert($scope.jumlahSoal + " " + $scope.countSoal);
        if($scope.radioValue === $scope.getKunci){
            if($scope.countSoal <= $scope.jumlahSoal ){
                $scope.score += 1;
                $http.post(
                    "../../php/siswa/pushResponDetail.php",
                    {'idResponTest':$scope.idResponTest,'idSoal':$scope.idSoal,'jawab':$scope.radioValue,'croscek':1,'bankSoal':$scope.banksoal}
                ).then(function successCallback(response){
                    var dataSoal2 = angular.fromJson(response.data);
                    $scope.idSoal = dataSoal2.idSoal;
                    $scope.isiSoal = dataSoal2.isiSoal;
                    $scope.pil1 = dataSoal2.pil1;
                    $scope.pil2 = dataSoal2.pil2;
                    $scope.pil3 = dataSoal2.pil3;
                    $scope.pil4 = dataSoal2.pil4;
                    $scope.getKunci = dataSoal2.kunci;
                    $scope.dayaBeda = dataSoal2.dayaBeda;
                    $scope.tingkatKesulitanSoal = dataSoal2.tingkatKesulitanSoal;
                    $scope.cluster = dataSoal2.cluster;
                },function errorCallback(response) {
                    alert("sambungan gagal");
                });
                // alert("score anda : " + $scope.score);
            }else{
                $scope.score += 1;
                // alert("score anda : " + $scope.score);
                $http.post(
                    "../../php/siswa/pushFinishRespon.php",
                    {'idResponTest':$scope.idResponTest,'score':$scope.score}
                ).then(function successCallback(response) {
                    if (response.data){
                        $window.location = 'index.php';
                    }else {
                        alert("gagal mengupdate nilai test");
                    }
                },function errorCallback(response) {
                    alert("sambungan gagal");
                });
            }
        }else{
            if($scope.countSoal <= $scope.jumlahSoal){
                $http.post(
                    "../../php/siswa/pushResponDetail.php",
                    {'idResponTest':$scope.idResponTest, 'idSoal':$scope.idSoal, 'jawab':$scope.radioValue, 'croscek':0, 'dayaBeda':$scope.dayaBeda, 'tingkatKesulitanSoal':$scope.tingkatKesulitanSoal, 'cluster':$scope.cluster, 'bankSoal':$scope.banksoal}
                ).then(function successCallback(response){
                    $scope.dataSoal2 = angular.fromJson(response.data);
                    $scope.idSoal = $scope.dataSoal2.idSoal;
                    $scope.isiSoal = $scope.dataSoal2.isiSoal;
                    $scope.pil1 = $scope.dataSoal2.pil1;
                    $scope.pil2 = $scope.dataSoal2.pil2;
                    $scope.pil3 = $scope.dataSoal2.pil3;
                    $scope.pil4 = $scope.dataSoal2.pil4;
                    $scope.getKunci = $scope.dataSoal2.kunci;
                    $scope.dayaBeda = $scope.dataSoal2.dayaBeda;
                    $scope.tingkatKesulitanSoal = $scope.dataSoal2.tingkatKesulitanSoal;
                    $scope.cluster = $scope.dataSoal2.cluster;
                },function errorCallback(response) {
                    alert("sambungan gagal");
                });
                // alert("score anda : " + $scope.score);
            }else{
                // alert("score anda : " + $scope.score);
                $http.post(
                    "../../php/siswa/pushFinishRespon.php",
                    {'idResponTest':$scope.idResponTest,'score':$scope.score}
                ).then(function successCallback(response) {
                    if (response.data){
                        $window.location = 'index.php';
                    }else {
                        alert("gagal mengupdate nilai test");
                    }
                },function errorCallback(response) {
                    alert("sambungan gagal");
                });
            }
        }
        $scope.radioValue = null;
    };
    $scope.readyNext = function(){
        $scope.cekJawab = false;
    };
    $scope.submitRespon = function () {
        $http.post(
            "../../php/siswa/pushFinishRespon.php",
            {'idResponTest':$scope.idResponTest,'score':$scope.score}
        ).then(function successCallback(response) {
            if (response.data){
                $window.location = 'index.php';
            }else {
                alert("gagal mengupdate nilai test");
            }
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

});

