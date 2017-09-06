/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("moduleTambahKompi",['angularModalService']);
app4.controller("addKompi",function($scope,$http,$window,$compile,ModalService){
    $scope.tambahKompi = function () {
        ModalService.showModal({
            templateUrl: 'modalKompi.html',
            controller: "tambahKompi"
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadKompi();
            });
            $scope.loadKompi();
        });
    };

    $scope.loadKompi = function () {
        $http.get(
            "../../php/kompi/loadKompi.php"
        ).then(function successCallback(response) {
            $scope.kompis = response.data;
        },function errorCallback(response) {
            alert("load Kompi gagal");
        });
    };

    $scope.editKompi = function (pushKompi) {
        ModalService.showModal({
            templateUrl: 'modalKompi.html',
            controller: "editKompiC",
            inputs: {
                kompi: pushKompi
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadKompi();
            });
            $scope.loadKompi();
        });
    };

    $scope.deleteKompi = function (pushKompi) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deleteKompiC",
            inputs: {
                kompi: pushKompi
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadKompi();
            });
            $scope.loadKompi();
        });
    };
});

app4.controller('deleteKompiC', function($scope,$http,$window,close,kompi) {
    $scope.kompi = kompi;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/kompi/deleteKompi.php",
            {'idKompi':kompi.idKompi}
        ).then(function successCallback(response) {
            $scope.modalno("sukses")
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('editKompiC', function($scope,$http,$window,close,kompi) {
    $scope.idKompi = kompi.idKompi;
    $scope.namaKompi = kompi.namaKompi;
    $scope.keterangan = kompi.keterangan;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/kompi/editKompi.php",
            {'idKompi':$scope.idKompi,
            'namaKompi':$scope.namaKompi,
            'keterangan':$scope.keterangan
        }
        ).then(function successCallback(response) {
            if (response.data){
                alert("edit kompi berhasil");
                
            }else {
                alert("edit kompi gagal");;
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});


app4.controller('tambahKompi', function($scope,$http,$window,close) {
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/kompi/pushKompi.php",
            {'namaKompi':$scope.namaKompi,'keterangan':$scope.keterangan}
        ).then(function successCallback(response) {
            if (response.data){
                alert("tambah Kompi berhasil");
            }else {
                alert("tambah Kompi gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

