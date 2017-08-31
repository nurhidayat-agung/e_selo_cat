/**
 * Created by kazt on 7/12/2017.
 */
var app4 = angular.module("moduleTambahPleton",['angularModalService']);
app4.controller("addPleton",function($scope,$http,$window,$compile,ModalService){
    $scope.tambahAngkatan = function () {
        ModalService.showModal({
            templateUrl: 'modalAddEdit.html',
            controller: "tambahPleton"
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadPleton();
            });
            $scope.loadPleton();
        });
    };

    $scope.loadPleton = function () {
        $http.get(
            "../../php/pleton/loadPleton.php"
        ).then(function successCallback(response) {
            $scope.pletons = response.data;
        },function errorCallback(response) {
            alert("load pleton gagal");
        });
    };

    $scope.editAngkatan = function (pushAngkatan) {
        ModalService.showModal({
            templateUrl: 'modalAddEdit.html',
            controller: "editAngkatanC",
            inputs: {
                angkatan: pushAngkatan
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadAngkatan();
            });
            $scope.loadAngkatan();
        });
    };

    $scope.deleteAngkatan = function (pushAngkatan) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deleteAngkatanC",
            inputs: {
                angkatan: pushAngkatan
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadAngkatan();
            });
            $scope.loadAngkatan();
        });
    };
});

app4.controller('deleteAngkatanC', function($scope,$http,$window,close,angkatan) {
    $scope.angkatan = angkatan;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/angkatan/deleteAngkatan.php",
            {'idAngkatan':angkatan.idAngkatan}
        ).then(function successCallback(response) {
            $scope.modalno("sukses")
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('editAngkatanC', function($scope,$http,$window,close,angkatan) {
    $scope.namaAngkatan = angkatan.namaAngkatan;
    $scope.deskripsiAngkatan = angkatan.deskripsiAngkatan;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/angkatan/editAngkatan.php",
            {'idAngkatan':angkatan.idAngkatan,'namaAngkatan':$scope.namaAngkatan,'deskripsiAngkatan':$scope.deskripsiAngkatan}
        ).then(function successCallback(response) {
            if (response.data){
                alert("edit angkatan berhasil");
            }else {
                alert("edi angkatan gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('tambahAngkatan', function($scope,$http,$window,close) {
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/angkatan/pushAngkatan.php",
            {'namaAngkatan':$scope.namaAngkatan,'deskripsiAngkatan':$scope.deskripsiAngkatan}
        ).then(function successCallback(response) {
            if (response.data){
                alert("tambah angkatan berhasil");
            }else {
                alert("tambah angkatan gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

