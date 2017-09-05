/**
 * Created by kazt on 7/12/2017.
 */
var app4 = angular.module("moduleTimPengajar",['angularModalService']);
app4.controller("addPengajar",function($scope,$http,$window,$compile,ModalService){
    $scope.isDetailTim = false;
    $scope.selectTimId = 0;
    $scope.initial = function () {
        $scope.spnposisi = "anggota";
        $http.get(
            "../../php/guru/loadGuru.php"
        ).then(function successCallback(response) {
            if (response.data.length > 0){
                $scope.users = response.data;
            }
        },function errorCallback(response) {
            alert("load guru gagal");
        });
    };

    $scope.loadDetailTimPengajar = function () {
        if($scope.selectTimId > 0){
            $http.post(
                "../../php/timpengajar/loadDetailTimPengajar.php",
                {"idTimPengajar":$scope.selectTimId}
            ).then(function successCallback(response) {
                console.log(JSON.stringify(response.data));
                $scope.members = response.data;
            },function errorCallback(response) {
                alert("gagal Load anggota");
            });
        }else {
            alert("silahkan pilih tim pengajar");
        }
    };

    $scope.tambahTimPengajar = function () {
        ModalService.showModal({
            templateUrl: 'modalAddEdit.html',
            controller: "tambahTimPengajar"
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadTimPengajar();
            });
            $scope.loadTimPengajar();
        });
    };

    $scope.loadTimPengajar = function () {
        $http.get(
            "../../php/timpengajar/loadTimPengajar.php"
        ).then(function successCallback(response) {
            if (response.data.length > 0){

                $scope.pengajars = response.data;
            }
        },function errorCallback(response) {
            alert("load Tim pengajar gagal");
        });
    };

    $scope.deleteDetailPengajar = function (pushMember) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deleteDetailPengajarC",
            inputs: {
                detailPengajar: pushMember
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadDetailTimPengajar();
            });
            $scope.loadDetailTimPengajar();
        });
    };


    $scope.deleteTimPengajar = function (pushTimPengajar) {
        $scope.isDetailTim = false;
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deleteTimPengajarC",
            inputs: {
                timPengajar: pushTimPengajar
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadTimPengajar();
            });
            $scope.loadTimPengajar();
        });
    };

    $scope.editAnggotaTimPengajar = function (pushTimPengajar) {
        $scope.isDetailTim = true;
        $scope.edtNama = pushTimPengajar.namaTimPengajar;
        $scope.edtKeterangan = pushTimPengajar.keterangan;
        $scope.selectTimId = pushTimPengajar.idTimPengajar;
        $scope.loadDetailTimPengajar();
    };

    $scope.editTimPengajar = function () {
        if ($scope.selectTimId > 0){
            $http.post(
                "../../php/timpengajar/editTimPengajar.php",
                {'idTimPengajar':$scope.selectTimId,'namaTimPengajar':$scope.edtNama,'keterangan':$scope.edtKeterangan}
            ).then(function successCallback(response) {
                if (response.data){
                    alert("edit berhasil");
                    $scope.loadTimPengajar();
                }else {
                    alert("gagal edit");
                }
            },function errorCallback(response) {
                alert("koneksi bermasalah");
            });
        }else {
            alert("silahkan pilih tim pengajar terlebih dahulu");
        }
    };

    $scope.tambahAnggota = function () {
        console.log("selected id : " + $scope.selectTimId);
        console.log("nip_nrp : " + $scope.spnnipnrp);
        console.log("status : " + $scope.spnposisi);
        if($scope.selectTimId > 0){
            if($scope.spnnipnrp > 0){
                $http.post(
                    "../../php/timpengajar/pushDetailTimPengajar.php",
                    {'idTimPengajar':$scope.selectTimId,'nip_nrp':$scope.spnnipnrp,'posisi':$scope.spnposisi}
                ).then(function successCallback(response) {
                    if(response.data){
                        alert("tambah anggota sukses");
                        $scope.loadDetailTimPengajar();
                    }
                },function errorCallback(response) {
                    alert("koneksi bermasalah");
                });
            }else {
                alert("silahkan pilih guru terlebih dahulu");
            }
        }else{
            alert("silahkan pilih tim pengajar terlebih dahulu");
        }
    };

    $scope.deleteDetailPengajar = function (pushMember) {
        ModalService.showModal({
            templateUrl: 'delete.html',
            controller: "deleteDetailPengajarC",
            inputs: {
                detailPengajar: pushMember
            }
        }).then(function(modal) {
            modal.element.modal();
            modal.close.then(function(result) {
                // $scope.message = "You said " + result;
                $scope.loadDetailTimPengajar();
            });
            $scope.loadDetailTimPengajar();
        });
    };
});

app4.controller('deleteDetailPengajarC', function($scope,$http,$window,close,detailPengajar) {
    $scope.detailTimPengajar = detailPengajar;
    $scope.pesanHapus = "apa yakin akan mengapus anggota " + detailPengajar.nama + " ?";
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/timpengajar/deleteDetailTimPengajar.php",
            {'idDetailTimPengajar':detailPengajar.idDetailTimPengajar}
        ).then(function successCallback(response) {
            $scope.modalno("gagal")
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

app4.controller('deleteTimPengajarC', function($scope,$http,$window,close,timPengajar) {
    $scope.timPengajar = timPengajar;
    $scope.pesanHapus = "apa yakin akan mengapus pengajar " + $scope.timPengajar.namaTimPengajar + " ?";
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/timpengajar/deleteTimPengajar.php",
            {'idTimPengajar':timPengajar.idTimPengajar}
        ).then(function successCallback(response) {
            $scope.modalno("gagal")
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});


app4.controller('tambahTimPengajar', function($scope,$http,$window,close) {
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {
        $http.post(
            "../../php/timpengajar/pushTimPengajar.php",
            {'namaTimPengajar':$scope.namaTimPengajar,'keterangan':$scope.keterangan}
        ).then(function successCallback(response) {
            if (response.data){
                alert("tambah Tim Pengajar berhasil");
            }else {
                alert("tambah Tim Pengajar gagal");
            }
        },function errorCallback(response) {
            alert("koneksi bermasalah");
        });
    };
});

