/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("moduleTambahSiswa",['angularModalService']);
app4.controller("addSiswa",function($scope,$http,$window,$compile,ModalService){
    $scope.tambahSiswa = function () {
        ModalService.showModal({
            templateUrl: 'modalSiswa.html',
            controller: "tambahSiswa"
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadSiswa();
            });
            $scope.loadSiswa();
        });
    };

    $scope.loadSiswa = function () {
        $http.get(
            "../../php/siswa/loadSiswa.php"
        ).then(function successCallback(response) {
            $scope.siswas = response.data;
        },function errorCallback(response) {
            alert("load Siswa gagal");
        });
    };

    $scope.editSiswa = function (pushSiswa) {
        ModalService.showModal({
            templateUrl: 'modalSiswa.html',
            controller: "editSiswaC",
            inputs: {
                siswa: pushSiswa
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadSiswa();
            });
            $scope.loadSiswa();
        });
    };

    $scope.deleteSiswa = function (pushSiswa) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deleteSiswaC",
            inputs: {
                siswa: pushSiswa
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadSiswa();
            });
            $scope.loadSiswa();
        });
    };
});


app4.controller('deleteSiswaC', function($scope,$http,$window,close,siswa) {
    $scope.siswa = siswa;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/siswa/deleteSiswa.php",
            {'nis':siswa.nis}
        ).then(function successCallback(response) {
            $scope.modalno("sukses")
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('editSiswaC', function($scope,$http,$window,close,siswa) {
    $scope.nis = siswa.nis;
    $scope.namaSiswa = siswa.namaSiswa;
    $scope.password = siswa.password;
    $scope.idAngkatan = siswa.idAngkatan;
    $scope.idPleton = siswa.idPleton;
    
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/siswa/editSiswa.php",
            {'nis':$scope.nis,
            'namaSiswa':$scope.namaSiswa,
            'password':$scope.password,
            'idAngkatan':$scope.idAngkatan,
            'idPleton':$scope.idPleton
        }
        ).then(function successCallback(response) {
            if (response.data){
                alert("edit siswa berhasil");
                
            }else {
                alert("edit siswa gagal");;
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('tambahSiswa', function($scope,$http,$window,close) {
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };
    $scope.modalyes = function () {
        $http.post(
            "../../php/siswa/pushSiswa.php",
            {'nis':$scope.nis,
            'namaSiswa':$scope.namaSiswa,
            'password':$scope.password,
            'idAngkatan':$scope.idAngkatan,
            'idPleton':$scope.idPleton}
        ).then(function successCallback(response) {
            if (response.data){
                alert("tambah siswa berhasil");
                $scope.nis = null;
                $scope.namaSiswa = null;
                $scope.password = null;
                $scope.idAngkatan = null;
                $scope.idPleton = null;
            }else {
                alert("tambah siswa gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

