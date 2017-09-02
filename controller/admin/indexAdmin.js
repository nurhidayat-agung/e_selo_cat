/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("moduleTambahGuru",['angularModalService']);
app4.controller("addGuru",function($scope,$http,$window,$compile,ModalService){
    $scope.tambahGuru = function () {
        ModalService.showModal({
            templateUrl: 'modalGuru.html',
            controller: "tambahGuru"
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadGuru();
            });
            $scope.loadGuru();
        });
    };

 $scope.loadAngkatan = function () {
        $http.get(
            "../../php/angkatan/loadAngkatan.php"
        ).then(function successCallback(response) {
            $scope.angkatans = response.data;
        },function errorCallback(response) {
            alert("load angkatan gagal");
        });
    };


    $scope.loadGuru = function () {
        $http.get(
            "../../php/guru/loadGuru.php"
        ).then(function successCallback(response) {
            $scope.gurus = response.data;
        },function errorCallback(response) {
            alert("load Guru gagal");
        });
    };

    $scope.loadTimPengajar = function () {
        $http.get(
            "../../php/timpengajar/loadTimPengajar.php"
        ).then(function successCallback(response) {
            $scope.timpengajars = response.data;
        },function errorCallback(response) {
            alert("load Tim Pengajar gagal");
        });
    };

    $scope.loadPleton = function () {
        $http.get(
            "../../php/pleton/loadPleton.php"
        ).then(function successCallback(response) {
            $scope.pletons = response.data;
        },function errorCallback(response) {
            alert("load Pleton gagal");
        });
    };
    $scope.editGuru = function (pushGuru) {
        ModalService.showModal({
            templateUrl: 'modalGuru.html',
            controller: "editGuruC",
            inputs: {
                guru: pushGuru
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadGuru();
            });
            $scope.loadGuru();
        });
    };

    $scope.deleteGuru = function (pushGuru) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deleteGuruC",
            inputs: {
                guru: pushGuru
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadGuru();
            });
            $scope.loadGuru();
        });
    };
});

app4.controller('deleteGuruC', function($scope,$http,$window,close,guru) {
    $scope.guru = guru;
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/guru/deleteGuru.php",
            {'nip_nrp':guru.nip_nrp}
        ).then(function successCallback(response) {
            $scope.modalno("sukses")
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('editGuruC', function($scope,$http,$window,close,guru) {
    $scope.username = guru.username;
    $scope.password = guru.password;
    $scope.job = guru.job;
    $scope.nama = guru.nama;
    $scope.email = guru.email;

    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/guru/editGuru.php",
            {'nip_nrp':$scope.nip_nrp,
            'username':$scope.username,
            'password':$scope.password,
            'job':$scope.job,
            'nama':$scope.nama,
            'email':$scope.email
        }
        ).then(function successCallback(response) {
            if (response.data){
                alert("edit angkatan berhasil");
                
            }else {
                alert("edit angkatan gagal");;
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('tambahGuru', function($scope,$http,$window,close) {
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/angkatan/pushGuru.php",
            {'nip_nrp':$scope.nip_nrp,
            'username':$scope.username,
            'password':$scope.password,
            'job':$scope.job,
            'nama':$scope.nama,
            'email':$scope.email}
        ).then(function successCallback(response) {
            if (response.data){
                alert("tambah Guru berhasil");
            }else {
                alert("tambah Guru gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

