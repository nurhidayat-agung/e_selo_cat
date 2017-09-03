/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("moduleTambahSoal",['angularModalService']);
app4.controller("addSoal",function($scope,$http,$window,$compile,ModalService){
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
    $scope.isNoSoal = true;
    var myEl = angular.element(document.querySelector( 'isiLoop' ));
    $scope.$watch('telephone', function (value) {
        console.log(value);
    }, true);

    $scope.loadBankSoal = function(){
        $scope.selectMapel = $scope.mapel;
        console.log($scope.selectMapel);
        $http.post(
            "../../php/utilFunction/loadbanksoal.php",
            {'nip_nrp':$scope.idUser}
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
        console.log("id bank soal : " + $scope.banksoal);
        if ($scope.banksoal > 0){
            $http.post(
                "../../php/tambahsoal/loadsoal.php",
                {'idBankSoal': $scope.banksoal }
            ).then(function successCallback(response) {
                var jsonData = angular.fromJson(response.data);
                if (jsonData.status){
                    // alert("true");
                    $scope.soals = jsonData.data;
                    $scope.isNoSoal = false;
                }else {
                    // alert("false");
                    $scope.isNoSoal = true;
                    $scope.soals = [];
                }
                //   $scope.soals = response.data;
            }, function errorCallback(response) {
                alert("sambungan gagal");
            });
        }else {
            $scope.soals = [];
            $scope.isNoSoal = true;
        }
    };

    $scope.tambahSoalPilganda = function (pushBankSoal) {
        console.log("banksoal : " + $scope.banksoal);
        if ($scope.banksoal > 0){
            ModalService.showModal({
                templateUrl: 'modal.html',
                controller: "ModalController",
                inputs: {
                    idBankSoal: pushBankSoal
                }
            }).then(function(modal) {
                modal.element.modal();
                modal.close.then(function(result) {
                    // $scope.message = "You said " + result;
                    $scope.loadSoal();
                });
            });
        }else {
            alert("silahkan pilih bank soal terlebih dahulu")
        }

    };


    $scope.editTambahSoal = function (pushIdSoal,jenisSoal) {
        if (jenisSoal === "Pilihan Ganda"){
            ModalService.showModal({
                templateUrl: 'modal.html',
                controller: "EditModalController",
                inputs: {
                    idSoal: pushIdSoal
                }
            }).then(function(modal) {
                modal.element.modal();
                modal.close.then(function(result) {
                    // $scope.message = "You said " + result;
                    $scope.loadSoal();
                });
                $scope.loadSoal();
            });
        }else {
            ModalService.showModal({
                templateUrl: 'modalEsay.html',
                controller: "EditModalEsayController",
                inputs: {
                    idSoal: pushIdSoal
                }
            }).then(function(modal) {
                modal.element.modal();
                modal.close.then(function(result) {
                    // $scope.message = "You said " + result;
                    $scope.loadSoal();
                });
            });
        }
    };

    $scope.deleteSoal = function (pushIdSoal) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "DeleteController",
            inputs: {
                idSoal: pushIdSoal
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadSoal();
            });
        });
    };

    $scope.tambahSoalEssay = function (pushBankSoal) {
        if ($scope.banksoal > 0){
            ModalService.showModal({
                templateUrl: 'modalEsay.html',
                controller: "ModalEsayController",
                inputs: {
                    idBankSoal: pushBankSoal
                }
            }).then(function(modal) {
                modal.element.modal();
                modal.close.then(function(result) {
                    // $scope.message = "You said " + result;
                    $scope.loadSoal();
                });
            });
        }else {
            alert("silahkan pilih bank soal terlebih dahulu")
        }
    }
});

app4.controller('EditModalEsayController', function($scope,$http,$window,close,idSoal) {
    $http.post(
        "../../php/tambahsoal/loadSoalDetail.php",
        {'idSoal':idSoal}
    ).then(function successCallback(response) {
        var jsonSoal = angular.fromJson(response.data);
        if (jsonSoal.status){
            console.log(jsonSoal.data.isiSoal);
            var dataSoal = jsonSoal.data;
            $scope.tambahIsiSoal = dataSoal.isiSoal;
            $scope.pilihan1 = dataSoal.pil1;
            $scope.pilihan2 = dataSoal.pil2;
            $scope.pilihan3 = dataSoal.pil3;
            $scope.jumlahEsay = dataSoal.jumlahEsay;

        }
    },function errorCallback(response) {
        alert("load bank soal gagal");
    });

    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        if ($scope.jumlahEsay > 0){
            $http.post(
                "../../php/tambahsoal/editSoalPilihanGanda.php",
                {'idSoal': idSoal, 'isiSoal':$scope.tambahIsiSoal, 'pil1':$scope.pilihan1, 'pil2':$scope.pilihan2, 'pil3':$scope.pilihan3, 'jumlahEsay':$scope.jumlahEsay}
            ).then(function successCallback(response) {
                // console.log(response.data.toString());
                if (response.data){
                    $scope.mWarning = {
                        "color" : "black"
                    };
                    $scope.mMessage = "Soal berhasil diubah";
                    close('sukses',500);
                }else {
                    $scope.mWarning = {
                        "color" : "red"
                    };
                    $scope.mMessage = "soal gagal diubah ke data base";
                }
            },function errorCallback(response) {
                alert("gagal load soal");
            });
        }else {
            alert("silahkan pilih jumlah esay terlebih dahulu");
        }
    };
});


app4.controller('ModalEsayController',function ($scope, $http, $window, close, idBankSoal) {
    $scope.eIdBankSoal = idBankSoal;
    $scope.modalyes = function () {
        console.log("cek");
        if($scope.jumlahEsay > 0){
            $http.post(
                "../../php/tambahsoal/pushSoalEsay.php",
                {'idBankSoal': $scope.eIdBankSoal, 'isiSoal':$scope.tambahIsiSoal, 'pil1':$scope.pilihan1, 'pil2':$scope.pilihan2, 'pil3':$scope.pilihan3, 'jumlahEsay':$scope.jumlahEsay}
            ).then(function successCallback(response) {
                // console.log(response.data.toString());
                if (response.data){
                    $scope.mWarning = {
                        "color" : "black"
                    };
                    $scope.mMessage = "soal berhasil ditambahkan ke database";
                    close('sukses',500);
                }else {
                    $scope.mWarning = {
                        "color" : "red"
                    };
                    $scope.mMessage = "soal gagal ditambahkan ke data base";
                }
            },function errorCallback(response) {
                alert("gagal load soal");
            });
        }else {
            alert("silahkan pilih jumlah esay terlebih dahulu");
        }
    };

    $scope.modalno = function () {
        close('Cansel', 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };
});

app4.controller('DeleteController', function($scope,$http,$window,close,idSoal) {
    $scope.idSoal = idSoal;
    $scope.modalyes = function () {
        $http.post(
            "../../php/tambahsoal/deleteSoal.php",
            {'idSoal':idSoal}
        ).then(function successCallback(response) {
            if(response.data){
                close('sukses', 500);
            }
        },function errorCallback(response) {
            alert("delete soal gagal");
        });
    };

    $scope.modalno = function () {
        close('Cansel', 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

});


app4.controller('ModalController', function($scope,$http,$window,close,idBankSoal) {
    $scope.mIdBankSoal = idBankSoal;
    $scope.modalyes = function () {
        if ($scope.jawaban !== ""){
            $http.post(
                "../../php/tambahsoal/pushSoalPilGan.php",
                {'idBankSoal': $scope.mIdBankSoal, 'isiSoal':$scope.tambahIsiSoal, 'pil1':$scope.pilihan1, 'pil2':$scope.pilihan2, 'pil3':$scope.pilihan3, 'pil4':$scope.pilihan4, 'pil5': $scope.pilihan5, 'kunci':$scope.jawaban}
            ).then(function successCallback(response) {
                // console.log(response.data.toString());
                if (response.data){
                    $scope.mWarning = {
                        "color" : "black"
                    };
                    $scope.mMessage = "soal berhasil ditambahkan ke database";
                    close('sukses', 500);
                }else {
                    $scope.mWarning = {
                        "color" : "red"
                    };
                    $scope.mMessage = "soal gagal ditambahkan ke data base";
                }
            },function errorCallback(response) {
                alert("gagal push soal")
            });
        }else {
            alert("silahkan pilih kunci jawab terlebih dahulu");
        }
    };

    $scope.modalno = function () {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

});


app4.controller('EditModalController', function($scope,$http,$window,close,idSoal) {
    $http.post(
        "../../php/tambahsoal/loadSoalDetail.php",
        {'idSoal':idSoal}
    ).then(function successCallback(response) {
        var jsonSoal = angular.fromJson(response.data);
        if (jsonSoal.status){
            console.log(jsonSoal.data.isiSoal);
            var dataSoal = jsonSoal.data;
            $scope.tambahIsiSoal = dataSoal.isiSoal;
            $scope.pilihan1 = dataSoal.pil1;
            $scope.pilihan2 = dataSoal.pil2;
            $scope.pilihan3 = dataSoal.pil3;
            $scope.pilihan4 = dataSoal.pil4;
            $scope.pilihan5 = dataSoal.pil5;
            $scope.jawaban = dataSoal.kunci;

        }
    },function errorCallback(response) {
        alert("load bank soal gagal");
    });

    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        if ($scope.jawaban !== ""){
            $http.post(
                "../../php/tambahsoal/editSoalPilihanGanda.php",
                {'idSoal': idSoal, 'isiSoal':$scope.tambahIsiSoal, 'pil1':$scope.pilihan1, 'pil2':$scope.pilihan2, 'pil3':$scope.pilihan3, 'pil4':$scope.pilihan4, 'pil5': $scope.pilihan5, 'kunci':$scope.jawaban}
            ).then(function successCallback(response) {
                // console.log(response.data.toString());
                if (response.data){
                    $scope.mWarning = {
                        "color" : "black"
                    };
                    $scope.mMessage = "Soal berhasil diubah";
                    close('sukses',500);
                }else {
                    $scope.mWarning = {
                        "color" : "red"
                    };
                    $scope.mMessage = "soal gagal diubah ke data base";
                }
            },function errorCallback(response) {
                alert("gagal push soal");
            });
        }else {
            alert("silahkan pilih kunci jawab terlebih dahulu");
        }
    };
});