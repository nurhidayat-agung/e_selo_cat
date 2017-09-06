var app = angular.module("testSiswa",[]);
app.controller("testSiswa", function ($scope,$http,$window,$compile,$timeout) {
    $scope.nis = serverVariable;
    var test;
    var soal;
    var timeTest;
    $scope.countSoal = 0;
    $scope.scoreTest = 0;
    $scope.idRespon = 0;
    $scope.crossCek = 0;
    $scope.kunci = '';
    $scope.jawab = '';
    $scope.sec = 0;
    $scope.min = 0;
    $scope.isTimeOut = false;

    $scope.runTime = function () {
        $scope.onTimeout = function(){
            if($scope.sec > 0){
                $scope.sec --;
                if ($scope.sec === 0) {
                    if($scope.min > 0){
                        $scope.sec = 59;
                        $scope.min --;
                    }
                }
            }else{
                if ($scope.sec === 0) {
                    if($scope.min > 0){
                        $scope.sec = 59;
                        $scope.min --;
                    }
                }
            }
            if($scope.min == 0 && $scope.sec == 0){
                $scope.isTimeOut = true;
                $scope.nextQuestion();
            }else{
                mytimeout = $timeout($scope.onTimeout,1000);
            }
        }
        var mytimeout = $timeout($scope.onTimeout,1000);
    };


    $scope.removeString = function (string) {
        return string.replace(/[\s]/g, '');
    };

    $scope.loadTestSiswa = function () {
        console.log("nip_nrp : " + $scope.nis);
        $http.post(
            "../../php/testSiswa/loadTestSiswa.php",
            {'nip_nrp':$scope.nis}
        ).then(function successCallback(response) {
            $scope.tests = response.data
            console.log(JSON.stringify(response.data));
        },function errorCallback(response) {
            alert("gagal load test");
        });
    };

    $scope.loadPilGan = function () {
        $scope.isPilgan=true;
        $scope.radioValue = "";
        $http.post(
            "../../php/testSiswa/loadSoal.php",
            {'idResponTest':$scope.idRespon,'idTest':test.idTest,'jenis':"Pilihan Ganda"}
        ).then(function successCallback(response) {
            soal = angular.fromJson(response.data);
            console.log("idSoal : " + soal.idSoal);
            $scope.countSoal ++;
            $scope.isiSoal = soal.isiSoal;
            $scope.pil1 = soal.pil1;
            $scope.pil2 = soal.pil2;
            $scope.pil3 = soal.pil3;
            $scope.pil4 = soal.pil4;
            $scope.pil5 = soal.pil5;
        },function errorCallback(response) {
            alert("gagal load soal");
        });
    };
    $scope.loadEssay = function () {
        $scope.isPilgan=false;
        $scope.pilihan1 = "";
        $scope.pilihan2 = "";
        $scope.pilihan3 = "";
        $http.post(
            "../../php/testSiswa/loadSoal.php",
            {'idResponTest':$scope.idRespon,'idTest':test.idTest,'jenis':"Melengkapi"}
        ).then(function successCallback(response) {
            soal = angular.fromJson(response.data);
            console.log("idSoal : " + soal.idSoal);
            $scope.countSoal ++;
            $scope.isiSoal = soal.isiSoal;
            console.log("jumlah essay : " + soal.jumlahEsay);
            if (parseInt(soal.jumlahEsay) === 1){
                $scope.isPil1 = false;
                $scope.isPil2 = true;
                $scope.isPil3 = true;
                $scope.kunci = soal.pil1;
            }else if (parseInt(soal.jumlahEsay) === 2){
                $scope.isPil1 = false;
                $scope.isPil2 = false;
                $scope.isPil3 = true;
                $scope.kunci = soal.pil1 + "," + soal.pil2;
            }else {
                $scope.isPil1 = false;
                $scope.isPil2 = false;
                $scope.isPil3 = false;
                $scope.kunci = soal.pil1 + "," + soal.pil2 + "," + soal.pil3;
            }
        },function errorCallback(response) {
            alert("gagal load soal");
        });
    };
    $scope.mulaiTest = function (pushTest) {
        console.log("mulai test");
        test = pushTest;
        console.log("jumlah pilgan "+ test.jmlPilGanda);
        console.log("jumlah essay " + test.jmlEssay);
        console.log("nama test " + test.namaTest);
        console.log("waktu test " + test.waktuTest);
        console.log("score item " + test.scoreItem);
        console.log("jenis test "+ test.jenisTest);
        $scope.min = parseInt(test.waktuTest);
        $scope.runTime();
        $scope.isMulaiTest = true;
        $http.post(
            "../../php/testSiswa/pushResponStart.php",
            {'nis':$scope.nis,'idTest':test.idTest,'jenis':test.jenisTest}
        ).then(function successCallback(response) {
            $scope.idRespon = response.data;
            if($scope.countSoal < test.jmlPilGanda){
                $scope.loadPilGan();
            }else {
                scope.loadEssay();
            }
        },function errorCallback(response) {
            alert("gagal load test");
        });
    };

    $scope.submitResponFinish = function () {
        console.log("idResponTest : " + $scope.idRespon);
        console.log("score : " + $scope.scoreTest);
        $http.post(
            "../../php/siswa/pushFinishRespon.php",
            {'idResponTest':$scope.idRespon,'score':$scope.scoreTest}
        ).then(function successCallback(response) {
            if (response.data){
                console.log("idResponTest : " + $scope.idRespon);
                console.log("score : " + $scope.scoreTest);
                $window.location = 'index.php';
            }else {
                alert("gagal update nilai");
            }
        },function errorCallback(response) {
            alert("gagal update nilai");
        });
    };
    $scope.nextQuestion = function () {
        console.log("skore : "+ $scope.scoreTest);
        console.log("score test : " + test.scoreItem);
        if($scope.isPilgan){
            if(test.jenisTest === "klasik"){
                if ($scope.radioValue === soal.kunci){
                    $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                    $scope.crossCek = 1;
                }else {
                    $scope.crossCek = 0;
                }
                $http.post(
                    "../../php/testSiswa/pushDetailRespon.php",
                    {'idResponTest':$scope.idRespon,'idSoal':soal.idSoal,'croscek':$scope.crossCek,'kunci':soal.kunci,'jawab':$scope.radioValue}
                ).then(function successCallback(response) {
                    if (response.data){
                        if ($scope.isTimeOut){
                            $scope.submitResponFinish();
                        }else if ($scope.countSoal < test.jmlPilGanda){
                            $scope.loadPilGan();
                        }else {
                            $scope.loadEssay();
                        }
                    }else {
                        alert("gagal update soal");
                    }
                },function errorCallback(response) {
                    alert("gagal update nilai");
                });
            }else {
                if ($scope.radioValue === soal.kunci){
                    $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                    $scope.crossCek = 1;
                }else {
                    $scope.crossCek = 0;
                };
                $http.post(
                    "../../php/testSiswa/pushDetailRespon.php",
                    {'idResponTest':$scope.idRespon,'idSoal':soal.idSoal,'croscek':$scope.crossCek,'kunci':soal.kunci,'jawab':$scope.radioValue}
                ).then(function successCallback(response) {
                    if (response.data){
                        if ($scope.isTimeOut){
                            $scope.submitResponFinish();
                        }else if ($scope.countSoal < test.jmlPilGanda){
                            $scope.loadPilGan();
                        }else {
                            $scope.loadEssay();
                        }
                    }else {
                        alert("gagal update soal");
                    }
                },function errorCallback(response) {
                    alert("gagal update nilai");
                });
            }
        }else {
            if(test.jenisTest === "klasik"){
                console.log("jumlah esay : " + soal.jumlahEsay);
                if (parseInt(soal.jumlahEsay) === 1){
                    $scope.jawab = $scope.pilihan1;
                    if($scope.removeString($scope.pilihan1.toUpperCase()) === $scope.removeString(soal.pil1.toUpperCase())){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                        $scope.crossCek = 1;
                    }else {
                        $scope.crossCek = 0;
                    }

                }else if (parseInt(soal.jumlahEsay) === 2){
                    $scope.jawab = $scope.pilihan2 + "," + $scope.pilihan2;
                    if($scope.removeString($scope.pilihan1.toUpperCase()) === $scope.removeString(soal.pil1.toUpperCase()) && $scope.removeString($scope.pilihan2.toUpperCase()) === $scope.removeString(soal.pil2.toUpperCase())){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                        $scope.crossCek = 1;
                    }else {
                        $scope.crossCek = 0;
                    }
                }else {
                    $scope.jawab = $scope.pilihan1 + "," + $scope.pilihan2 + "," + $scope.pilihan3;
                    if($scope.removeString($scope.pilihan1.toUpperCase()) === $scope.removeString(soal.pil1.toUpperCase()) && $scope.removeString($scope.pilihan2.toUpperCase()) === $scope.removeString(soal.pil2.toUpperCase()) && $scope.removeString($scope.pilihan3.toUpperCase()) === $scope.removeString(soal.pil3.toUpperCase())){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                        $scope.crossCek = 1;
                    }else {
                        $scope.crossCek = 0;
                    }
                }
                $http.post(
                    "../../php/testSiswa/pushDetailRespon.php",
                    {'idResponTest':$scope.idRespon,'idSoal':soal.idSoal,'croscek':$scope.crossCek,'kunci':$scope.kunci,'jawab':$scope.jawab}
                ).then(function successCallback(response) {
                    if (response.data){
                        if ($scope.isTimeOut){
                            $scope.submitResponFinish();
                        }else if ($scope.countSoal < (parseInt(test.jmlPilGanda) + parseInt(test.jmlEssay))){
                            $scope.loadEssay();
                        }else {
                            $scope.submitResponFinish();
                        }
                    }else {
                        alert("gagal update soal");
                    }
                },function errorCallback(response) {
                    alert("gagal update nilai");
                });
            }else {
                if (parseInt(soal.jumlahEsay) === 1){
                    $scope.jawab = $scope.pilihan1;
                    if($scope.removeString($scope.pilihan1.toUpperCase()) === $scope.removeString(soal.pil1.toUpperCase())){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                        $scope.crossCek = 1;
                    }else {
                        $scope.crossCek = 0;
                    }
                }else if (parseInt(soal.jumlahEsay) === 2){
                    $scope.jawab = $scope.pilihan2 + "," + $scope.pilihan2;
                    if($scope.removeString($scope.pilihan1.toUpperCase()) === $scope.removeString(soal.pil1.toUpperCase()) && $scope.removeString($scope.pilihan2.toUpperCase()) === $scope.removeString(soal.pil2.toUpperCase())){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                        $scope.crossCek = 1;
                    }else {
                        scope.crossCek = 0
                    }
                }else {
                    $scope.jawab = scope.pilihan1 + "," + $scope.pilihan2 + "," + $scope.pilihan3;
                    if($scope.removeString($scope.pilihan1.toUpperCase()) === $scope.removeString(soal.pil1.toUpperCase()) && $scope.removeString($scope.pilihan2.toUpperCase()) === $scope.removeString(soal.pil2.toUpperCase()) && $scope.removeString($scope.pilihan3.toUpperCase()) === $scope.removeString(soal.pil3.toUpperCase())){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                        scope.crossCek = 1;
                    }else {
                        scope.crossCek = 0;
                    }
                }
                $http.post(
                    "../../php/testSiswa/pushDetailRespon.php",
                    {'idResponTest':$scope.idRespon,'idSoal':soal.idSoal,'croscek':$scope.crossCek,'kunci':$scope.kunci,'jawab':$scope.jawab}
                ).then(function successCallback(response) {
                    if (response.data){
                        if ($scope.isTimeOut){
                            $scope.submitResponFinish();
                        }else if ($scope.countSoal < (parseInt(test.jmlPilGanda) + parseInt(test.jmlEssay))){
                            $scope.loadEssay();
                        }else {
                            $scope.submitResponFinish();
                        }
                    }else {
                        alert("gagal update soal");
                    }
                },function errorCallback(response) {
                    alert("gagal update nilai");
                });

            }
        }
    };
});