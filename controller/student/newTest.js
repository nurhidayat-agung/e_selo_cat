var app = angular.module("testSiswa",[]);
app.controller("testSiswa", function ($scope,$http,$window,$compile) {
    $scope.nis = serverVariable;
    var test;
    var soal;
    $scope.countSoal = 0;
    $scope.scoreTest = 0;
    $scope.idRespon = 0;
    $scope.crossCek = 0;

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
    }

    $scope.loadPilGan = function () {
        $scope.isPilgan=true;
        $http.post(
            "../../php/testSiswa/loadSoal.php",
            {'idResponTest':$scope.idRespon,'idTest':test.idTest,'jenis':"Pilihan Ganda"}
        ).then(function successCallback(response) {
            soal = angular.fromJson(response.data);
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
        $http.post(
            "../../php/testSiswa/loadSoal.php",
            {'idResponTest':$scope.idRespon,'idTest':test.idTest,'jenis':"Melengkapi"}
        ).then(function successCallback(response) {
            soal = angular.fromJson(response.data);
            $scope.countSoal ++;
            $scope.isiSoal = soal.isiSoal;
            console.log("jumlah essay : " + soal.jumlahEsay)
            if (soal.jumlahEsay === 1){
                $scope.isPil2 =true;
                $scope.isPil3 = true;
            }else if (soal.jumlahEsay === 2){
                $scope.isPil3 = true;
            }else {

            }
        },function errorCallback(response) {
            alert("gagal load soal");
        });
    };
    $scope.mulaiTest = function (pushTest) {
        console.log("mulai test");
        test = pushTest;
        console.log("jumlah pilgan "+ test.jmlPilGanda);
        console.log("jumlah essay " + pushTest.jmlEssay);
        console.log("nama test " + pushTest.namaTest);
        console.log("waktu test " + pushTest.waktuTest);
        console.log("score item " + pushTest.scoreItem);
        console.log("jenis test "+ pushTest.jenisTest);
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
            }else {
                alert("gagal update nilai");
            }
        },function errorCallback(response) {
            alert("gagal update nilai");
        });
    };
    $scope.nextQuestion = function () {
        console.log("skore : "+ $scope.scoreTest);
        console.log("score test : " + test.scoreItem)
        if($scope.isPilgan){
            if(test.jenisTest === "klasik"){
                if ($scope.radioValue === soal.kunci){
                    $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                }
                if ($scope.countSoal < test.jmlPilGanda){
                    $scope.loadPilGan();
                }else {
                    $scope.loadEssay();
                }
            }else {
                if ($scope.radioValue === soal.kunci){
                    $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                }
                if ($scope.countSoal < test.jmlPilGanda){
                    $scope.loadPilGan();
                }else {
                    $scope.loadEssay();
                }
            }
        }else {
            if(test.jenisTest === "klasik"){
                if (soal.jumlahEsay === 1){
                    if($scope.pilihan1.toUpperCase() === soal.pil1.toUpperCase()){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                    }
                }else if (soal.jumlahEsay === 2){
                    if($scope.pilihan1.toUpperCase() === soal.pil1.toUpperCase() && $scope.pilihan2.toUpperCase() === soal.pil2.toUpperCase()){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                    }
                }else {
                    if($scope.pilihan1.toUpperCase() === soal.pil1.toUpperCase() && $scope.pilihan2.toUpperCase() === soal.pil2.toUpperCase() && $scope.pilihan3.toUpperCase() === soal.pil3.toUpperCase()){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + parseFloat(test.scoreItem);
                    }
                }
                if ($scope.countSoal < (parseInt(test.jmlPilGanda) + parseInt(test.jmlEssay))){
                    $scope.loadEssay();
                }else {
                    $scope.submitResponFinish();
                }
            }else {
                if (soal.jumlahEsay === 1){
                    if($scope.pilihan1.toUpperCase() === soal.pil1.toUpperCase()){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                    }
                }else if (soal.jumlahEsay === 2){
                    if($scope.pilihan1.toUpperCase() === soal.pil1.toUpperCase() && $scope.pilihan2.toUpperCase() === soal.pil2.toUpperCase()){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                    }
                }else {
                    if($scope.pilihan1.toUpperCase() === soal.pil1.toUpperCase() && $scope.pilihan2.toUpperCase() === soal.pil2.toUpperCase() && $scope.pilihan3.toUpperCase() === soal.pil3.toUpperCase()){
                        $scope.scoreTest = parseFloat($scope.scoreTest) + ((parseFloat(test.scoreItem) * parseFloat(soal.bobotSoal)));
                    }
                }
                if ($scope.countSoal < (parseInt(test.jmlPilGanda) + parseInt(test.jmlEssay))){
                    $scope.loadEssay();
                }else {
                    $scope.submitResponFinish();
                }
            }
        }
    };
});