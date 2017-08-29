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
        // $http({
        //         url: "../../view/guru/soal.php",
        //         method: "POST",
        //         data: {
        //             data: variable
        //         }
        //     }).success(function(response) {
        //    // console.log(response);
        // });
        console.log("id bank soal : " + $scope.banksoal);
        console.log("id mapel : " + $scope.selectMapel);
        if ($scope.banksoal > 0){
            $http.post(
                "../../php/tambahsoal/loadsoal.php",
                {'idMapel': $scope.selectMapel, 'idBankSoal': $scope.banksoal }
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

    $scope.tambahSoal = function (pushMapel,pushBankSoal) {
        ModalService.showModal({
            templateUrl: 'modal.html',
            controller: "ModalController",
            inputs: {
                idMapel: pushMapel,
                idBankSoal: pushBankSoal
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadSoal();
            });
        });
    };


    $scope.editTambahSoal = function (pushIdSoal,pushMapel) {
        ModalService.showModal({
            templateUrl: 'modal.html',
            controller: "EditModalController",
            inputs: {
                idSoal: pushIdSoal,
                mapel: pushMapel
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadSoal();
            });
        });
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


app4.controller('ModalController', function($scope,$http,$window,close,idMapel,idBankSoal) {
    $scope.mIdMapel = idMapel;
    $scope.mIdBankSoal = idBankSoal;
    // $scope.tambahIsiSoal = $scope.mIdMapel + " " + $scope.mIdBankSoal;
    $http.post(
        "../../php/tambahsoal/loadbabmapel.php",
        {'idMapel':$scope.mIdMapel}
    ).then(function successCallback(response) {
        $scope.babs = response.data;
    },function errorCallback(response) {
        alert("load bank soal gagal");
    });

    $scope.modalyes = function () {
        console.log("$idBankSoal : " + $scope.mIdBankSoal);
        console.log("$isiSoal : " + $scope.tambahIsiSoal);
        console.log("$pil1 : " + $scope.pilihan1);
        console.log("$pil2 : " + $scope.pilihan2);
        console.log("$pil3 : " + $scope.pilihan3);
        console.log("$pil4 : " + $scope.pilihan4);
        console.log("$babmapel : " + $scope.bab);
        console.log("$kunci : " + $scope.jawaban);
        $http.post(
            "../../php/tambahsoal/pushsoal.php",
            {'idBankSoal': $scope.mIdBankSoal, 'isiSoal':$scope.tambahIsiSoal, 'pil1':$scope.pilihan1, 'pil2':$scope.pilihan2, 'pil3':$scope.pilihan3, 'pil4':$scope.pilihan4, 'babmapel': $scope.bab, 'kunci':$scope.jawaban}
        ).then(function successCallback(response) {
            // console.log(response.data.toString());
            if (response.data){
                $scope.mWarning = {
                    "color" : "black"
                };
                $scope.mMessage = "soal berhasil ditambahkan ke database";
            }else {
                $scope.mWarning = {
                    "color" : "red"
                };
                $scope.mMessage = "soal gagal ditambahkan ke data base";
            }
        },function errorCallback(response) {

        });
    };

    $scope.modalno = function () {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

});


app4.controller('EditModalController', function($scope,$http,$window,close,idSoal,mapel) {
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
            $scope.jawaban = dataSoal.kunci;
            $http.post(
                "../../php/tambahsoal/loadbabmapel.php",
                {'idMapel': mapel}
            ).then(function successCallback(response) {
                $scope.babs = response.data;
                $scope.bab = dataSoal.idBabMapel;
            }, function errorCallback(response) {

            });
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
        $http.post(
            "../../php/tambahsoal/editSoal.php",
            {'idSoal': idSoal, 'isiSoal':$scope.tambahIsiSoal, 'pil1':$scope.pilihan1, 'pil2':$scope.pilihan2, 'pil3':$scope.pilihan3, 'pil4':$scope.pilihan4, 'babmapel': $scope.bab, 'kunci':$scope.jawaban}
        ).then(function successCallback(response) {
            // console.log(response.data.toString());
            if (response.data){
                $scope.mWarning = {
                    "color" : "black"
                };
                $scope.mMessage = "Soal berhasil diubah";
            }else {
                $scope.mWarning = {
                    "color" : "red"
                };
                $scope.mMessage = "soal gagal diubah ke data base";
            }
        },function errorCallback(response) {

        });
    };

});