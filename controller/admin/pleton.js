/**
 * Created by kazt on 7/12/2017.
 */
var app4 = angular.module("moduleTambahPleton",['angularModalService']);
app4.controller("addPleton",function($scope,$http,$window,$compile,ModalService){
    $scope.tambahPleton = function () {
        ModalService.showModal({
            templateUrl: 'modalAddEdit.html',
            controller: "tambahPleton"
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadPleton();
            });
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

    $scope.editPleton = function (pushPleton) {
        ModalService.showModal({
            templateUrl: 'modalAddEdit.html',
            controller: "editPletonC",
            inputs: {
                pleton: pushPleton
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadPleton();
            });
        });
    };

    $scope.deletePleton = function (pushPleton) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deletePletonC",
            inputs: {
                pleton: pushPleton
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadPleton();
            });
        });
    };
});

app4.controller('deletePletonC', function($scope,$http,$window,close,pleton) {
    $scope.pleton = pleton;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/pleton/deletePleton.php",
            {'idPleton':pleton.idPleton}
        ).then(function successCallback(response) {
            $scope.modalno("sukses")
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('editPletonC', function($scope,$http,$window,close,pleton) {
    $scope.namaPleton = pleton.namaPleton;
    $scope.keterangan = pleton.keterangan;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/pleton/editPleton.php",
            {'idPleton':pleton.idPleton,'namaPleton':$scope.namaPleton,'keterangan':$scope.keterangan}
        ).then(function successCallback(response) {
            if (response.data){
                alert("edit pleton berhasil");
            }else {
                alert("edi pleton gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('tambahPleton', function($scope,$http,$window,close) {
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/pleton/pushPleton.php",
            {'namaPleton':$scope.namaPleton,'keterangan':$scope.keterangan}
        ).then(function successCallback(response) {
            if (response.data){
                alert("tambah pleton berhasil");
            }else {
                alert("tambah pleton gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

