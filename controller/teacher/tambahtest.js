/// <reference path="../../type_master/angularjs/angular.d.ts" />
/// <reference path="../../type_master/angularjs/angular-resource.d.ts" />

var app = angular.module("moduleTambahTest",['angularModalService']);
app.controller("addTest", function($scope,$http,$window,$compile,ModalService){
    $scope.idUser = serverVariable;
    $scope.isDataValid = false;
    $scope.isNamaNotValid = true;
    $scope.msgBankSoal = "";
    $scope.jmlMaxPilGand = 0;
    $scope.jmlMaxEssay = 0;
    $scope.isEditTest = false;
    $scope.selectIdTest = 0;

    $scope.loadBankSoal = function(){
        $http.post(
            "../../php/tambahbanksoal/loadBankSoalUser.php",
            {'nip_nrp':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        }, function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.cekJmlSoal = function () {
        if ($scope.banksoal > 0){
            $http.post(
                "../../php/tambahTest/cekJmlSoal.php",
                {'idBankSoal':$scope.banksoal}
            ).then(function successCallback(response) {
                $scope.jmlMaxPilGand = response.data.jmlMaxPilGan;
                $scope.jmlMaxEssay = response.data.jmlMaxEssay;
                $scope.msgBankSoal = $scope.jmlMaxPilGand + " soal pilihan ganda dan " + $scope.jmlMaxEssay + " soal essay tersedia dalam banksoal";
            },function errorCallback(response) {
                alert("gagal load soal bank soal");
            });
        }else {
            $scope.jmlMaxPilGand = 0;
            $scope.jmlMaxEssay = 0;
            $scope.msgBankSoal = "";
        }
    };

    $scope.pushTest = function () {
        if($scope.banksoal > 0){
            if ($scope.jmlPilGan > 0 && $scope.jmlEssay > 0 && $scope.namaTest !== '' && $scope.waktuTest > 0){
                if ($scope.jmlPilGan <= $scope.jmlMaxPilGand && $scope.jmlEssay <= $scope.jmlMaxEssay){
                    $scope.scoreItem = 100/($scope.jmlEssay + $scope.jmlPilGan);
                    $http.post(
                        "../../php/tambahTest/pushTest.php",
                        {
                            'idBankSoal':$scope.banksoal,
                            'namaTest':$scope.namaTest,
                            'jenisTest':$scope.radioJenis,
                            'waktuTest':$scope.waktuTest,
                            'scoreItem':$scope.scoreItem,
                            'jmlPilGanda':$scope.jmlPilGan,
                            'jmlEssay':$scope.jmlEssay
                        }
                    ).then(function successCallback(response) {
                        if (response.data){
                            alert("test berhasil ditambahkan");
                            $scope.banksoal = null;
                            $scope.namaTest = null;
                            $scope.radioJenis = null;
                            $scope.waktuTest = null;
                            $scope.scoreItem = null;
                            $scope.jmlPilGan = null;
                            $scope.jmlEssay = null;
                            $scope.loadTest();
                        }else {
                            alert("test gagal ditambahkan");
                        }
                    },function errorCallback(response) {
                        alert("koneksi gagal");
                    });
                }else {
                    alert("jumlah soal yang anda pilih melebihi yang tersedia di bank soal");
                }
            }else {
                alert("pastikan semua field terisi");
            }
        }else {
            alert("silahkan pilih banksoal terlebih dahulu");
        }
    };

    $scope.loadTest = function () {
        console.log("nip_nrp : "+ $scope.idUser);
        $http.post(
            "../../php/tambahTest/loadTest.php",
            {'nip_nrp':$scope.idUser}
        ).then(function successCallback(response) {
            $scope.tests = response.data;
            console.log(JSON.stringify(response.data));
        },function errorCallback(response) {
            alert("sambungan gagal");
        });
    };

    $scope.ubahStatus = function (pushTest) {
        console.log("idTest : " + pushTest.idTest);
        console.log("status : " + pushTest.status);
        if(pushTest.status === 'close'){
            $http.post(
                "../../php/tambahTest/changeStatTest.php",
                {'idTest':pushTest.idTest,'status':"open"}
            ).then(function successCallback(response) {
                $scope.loadTest();
            },function errorCallback(response) {
                alert("gagal ubah status");
            });
        }else {
            $http.post(
                "../../php/tambahTest/changeStatTest.php",
                {'idTest':pushTest.idTest,'status':"close"}
            ).then(function successCallback(response) {
                $scope.loadTest();
            },function errorCallback(response) {
                alert("gagal ubah status");
            });
        }
    };

    $scope.deleteTest = function (pushTest) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "DeleteController",
            inputs: {
                test: pushTest
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadTest();
            });
        });
    };

    // $scope.loadTestDetail = function () {
    //     $http.post(
    //         "../../php/tambahTest/loadSoalTest.php",
    //         {'idTest':$scope.selectIdTest}
    //     ).then(function successCallback(response) {
    //         $scope.soals = response.data;
    //     },function errorCallback(response) {
    //         alert("gagal load soal test");
    //     });
    // };

    $scope.loadTestDetail = function (idBankSoal) {
        $http.post(
            "../../php/tambahTest/loadSoalBank.php",
            {'idBankSoal':idBankSoal}
        ).then(function successCallback(response) {
            $scope.soals = response.data;
        },function errorCallback(response) {
            alert("gagal load soal test");
        });
    };

    $scope.previewTest = function (pushTest) {
        $scope.isEditTest = true;
        $scope.selectIdTest = pushTest.idTest;
        console.log(pushTest.jmlPilGanda);
        console.log(pushTest.jmlEssay);
        console.log(pushTest.waktuTest);
        var time = pushTest.waktuTest;
        var pilGan = pushTest.jmlPilGanda;
        var essay = pushTest.jmlEssay;
        $scope.namaTest = pushTest.namaTest;
        $scope.banksoal = pushTest.idBankSoal;
        $scope.radioJenis = pushTest.jenisTest;
        $scope.waktuTest = parseInt(time);
        $scope.jmlPilGan = parseInt(pilGan);
        $scope.jmlEssay = parseInt(essay);
        $scope.loadTestDetail(pushTest.idBankSoal);
    };

    $scope.pushEditTest = function () {
        if ($scope.namaTest !== '' && $scope.waktuTest > 0){
            $http.post(
                "../../php/tambahTest/editTest.php",
                {'idTest':$scope.selectIdTest,'namaTest':$scope.namaTest,'waktuTest':$scope.waktuTest}
            ).then(function successCallback(response) {
                if(response.data){
                    alert("edit berhasil");
                    $scope.isEditTest = false;
                    $scope.banksoal = null;
                    $scope.namaTest = null;
                    $scope.radioJenis = null;
                    $scope.waktuTest = null;
                    $scope.scoreItem = null;
                    $scope.jmlPilGan = null;
                    $scope.jmlEssay = null;
                }else {
                    alert("edit gagal");
                }
                $scope.loadTest();
            },function errorCallback(response) {
                alert("delete soal gagal");
            });
        }
    };

    $scope.batalEditTest = function () {
        $scope.isEditTest = false;
    };

    $scope.priviewSoal = function (pushSoal) {
        if (pushSoal.jenisSoal === 'Pilihan Ganda'){
            ModalService.showModal({
                templateUrl: 'modal.html',
                controller: "EditModalController",
                inputs: {
                    idSoal: pushSoal.idSoal
                }
            }).then(function(modal) {
                modal.element.modal();
                modal.close.then(function(result) {
                    // $scope.message = "You said " + result;
                    $scope.loadTestDetail($scope.banksoal);
                });
                $scope.loadTestDetail($scope.banksoal);
            });
        }else {
            ModalService.showModal({
                templateUrl: 'modalEsay.html',
                controller: "EditModalEsayController",
                inputs: {
                    idSoal: pushSoal.idSoal
                }
            }).then(function(modal) {
                modal.element.modal();
                modal.close.then(function(result) {
                    // $scope.message = "You said " + result;
                    $scope.loadTestDetail($scope.banksoal);
                });
                $scope.loadTestDetail($scope.banksoal);
            });
        }
    };

    $scope.setBobot = function (pushSoal) {
        ModalService.showModal({
            templateUrl: 'bobot.html',
            controller: "BobotController",
            inputs: {
                soal: pushSoal
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadTestDetail($scope.banksoal);
            });
            $scope.loadTestDetail($scope.banksoal);
        });
    };
});

app.controller('BobotController', function($scope,$http,$window,close,soal) {
    $scope.bobot = 1;
    console.log("idSoal : " + soal.idSoal);
    console.log("bobot : " + soal.bobot);
    $scope.modalyes = function () {
        $http.post(
            "../../php/tambahTest/setBobot.php",
            {'idSoal':soal.idSoal,'bobot':$scope.bobot}
        ).then(function successCallback(response) {
            if(response.data){
                close('sukses', 500);
            }
        },function errorCallback(response) {
            alert("set bobot soal gagal");
        });
    };

    $scope.modalno = function () {
        close('Cansel', 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };
});

app.controller('DeleteController', function($scope,$http,$window,close,test) {
    $scope.namaTest = test.namaTest;
    $scope.modalyes = function () {
        $http.post(
            "../../php/tambahTest/deleteTest.php",
            {'idTest':test.idTest}
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

app.controller('EditModalController', function($scope,$http,$window,close,idSoal) {
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

app.controller('EditModalEsayController', function($scope,$http,$window,close,idSoal) {
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
                "../../php/tambahsoal/editSoalEsay.php",
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
 