var app4 = angular.module("moduleTambahRespon",[]);
app4.controller("addRespon", function($scope,$http,$window,$compile){

    $scope.resJawab = [];
    $scope.idSiswa;
    $scope.resIdSoal = [];
    $scope.resIsiSoal = [];
    $scope.resKunci = [];
    $scope.resIdResponTest;
    $scope.siswa;
    $scope.jmlSoal;
    $scope.selectBankSoal;
    $scope.rawDataSoal = [];
    $scope.resCroscek = [];

    // gk perlu
    $scope.arrjawab = [];
    $scope.arropsi1 = [];
    $scope.arropsi2 = [];
    $scope.arropsi3 = [];
    $scope.arropsi4 = [];
    //

    $scope.selectMapel;
    $scope.selectBab;
    $scope.idUser = serverVariable;
    $scope.ready = "true";

    var myEl = angular.element(document.querySelector( 'isiLoop' ));

    $http.get(
        "../../php/inputRespon/loadmapel.php"
    ).then(function successCallback(response) {
        $scope.mapels = response.data;
        $http.get(
            "../../php/inputRespon/loadsiswa.php"
        ).then(function successCallback(response) {
            $scope.siswas = response.data;
        }, function errorCallback(response) {
            alert("koneksi gagal");
        });
    }, function errorCallback(response) {
        alert("koneksi gagal");
    });

    $scope.cekMapel = function(){
        console.log($scope.mapel);
        console.log($scope.idUser);
    };

    $scope.loadbanksoal = function(){
        $scope.selectMapel = $scope.mapel;
        console.log($scope.selectMapel);
        $http.post(
            "../../php/inputRespon/loadbanksoal.php",
            {'idMapel':$scope.mapel}
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        },function errorCallback(response) {
            alert("koneksi gagal");
        });
    };

    $scope.loadbabmapel = function(){
        $scope.selectBankSoal = $scope.banksoal;
        console.log($scope.selectBankSoal);
        $http.post(
            "../../php/inputRespon/getJmlSoal.php",
            {'idBankSoal':$scope.selectBankSoal}
        ).then(function successCallback(response) {
            console.log('idBankSoal :' + $scope.selectBankSoal);
            $scope.jmlSoal= response.data;
            console.log('jumlah soal : '+ $scope.jmlSoal);
        },function errorCallback(response) {
            alert("koneksi gagal");
        });
    };

    $scope.pushBab = function(){
        $scope.selectBab = $scope.bab;
        console.log($scope.selectBab);
    };


    $scope.generateFormsoal = function(){
        console.log("mapel dipilih " + $scope.selectMapel);
        console.log("bab dipilih " + $scope.selectBab);
        console.log("banksoal dipilih " + $scope.selectBankSoal);
        console.log("jumlah soal dipilih " + $scope.jml_soal);
        angular.element(document.getElementById('isiLoop')).html('');
        for(i = 0; i < $scope.jml_soal; i++){
            var part = angular.element('<div class="col-md-12 title animated fadeIn" id="isiInputSoal"><div class="col-md-1 contentGenerate"><span>'+(i+1)+'</span></div><div class="col-md-8 contentGenerate"><div class="form-group"><textarea class="form-control" ng-model = "arrsoal[' + i + ']" required="true"></textarea></div></div><div class="col-md-3 contentGenerate"><div class="input-group"><select class="form-control" name="parameterBab" ng-model="arrjawab[' + i + ']" required = "true"><option value="a">A</option><option value="b">B</option><option value="c">C</option><option value="d">D</option></select></div></div></div><div class="col-md-3 contentGenerate"><div class="form-group"><textarea class="form-control" ng-model = "arropsi1[' + i + ']" required = "true"></textarea></div></div><div class="col-md-3 contentGenerate"><div class="form-group"><textarea class="form-control" ng-model = "arropsi2[' + i + ']" required = "true"></textarea></div></div><div class="col-md-3 contentGenerate"><div class="form-group"><textarea class="form-control" ng-model = "arropsi3[' + i + ']" required = "true"></textarea></div></div><div class="col-md-3 contentGenerate"><div class="form-group"><textarea class="form-control" ng-model = "arropsi4[' + i + ']" required = "true"></textarea></div></div>');
            var compile = $compile(part)($scope);
            angular.element(document.getElementById('isiLoop')).append(part);
        }


    }
    $scope.$watch('arrsoal', function (value) {
        console.log(value);
    }, true);

    $scope.generateResponForm = function(){
        $http.post(
            "../../php/inputRespon/getFormResponse.php",
            {'idBankSoal':$scope.selectBankSoal}
        ).then(function successCallback(response){
            $scope.rawDataSoal = angular.fromJson(response.data);
            // $scope.response = $scope.rawDataSoal.length;
            for(var i = 0; i < $scope.rawDataSoal.length; i++){
                $scope.resIdSoal[i] = $scope.rawDataSoal[i].idSoal;
                $scope.resIsiSoal[i] = $scope.rawDataSoal[i].isiSoal;
                $scope.resKunci[i]= $scope.rawDataSoal[i].kunci;
            }
            angular.element(document.getElementById('isiLoop')).html('');
            for(var i = 0; i < $scope.jmlSoal; i++){
                var part = angular.element('<div class="col-md-12 title animated fadeIn" id="isiInputSoal"><div class="col-md-1 contentGenerate"><span>'+(i+1)+'</span></div><div class="col-md-8 contentGenerate"><div class="form-group"><textarea class="form-control" ng-model = "resIsiSoal['+ i +']"></textarea></div></div><div class="col-md-1 contentGenerate"><div class="input-group"><div class="col-md-1 contentGenerate"><span style="text-transform: uppercase">{{resKunci['+i+']}}</span></div></div></div><div class="col-md-2 contentGenerate"><div class="input-group"><select class="form-control" name="parameterBab" ng-model="resJawab['+ i +']"><option value="">Pilih Jawaban</option><option value="a">A</option><option value="b">B</option><option value="c">C</option><option value="d">D</option></select></div></div></div>');
                var compile = $compile(part)($scope);
                angular.element(document.getElementById('isiLoop')).append(part);
            }
        }, function errorCallback(response) {
            alert("koneksi gagal");
        });
    };

    $scope.pushRespon = function(){
        console.log($scope.resKunci[0]);
        console.log($scope.resJawab[0]);
        $scope.nilai = 0;
        for(var i = 0; i < $scope.jmlSoal ; i++){
            if(angular.equals($scope.resKunci[i],$scope.resJawab[i])){
                $scope.resCroscek[i] = 1;
                $scope.nilai ++;
            }else{
                $scope.resCroscek[i] = 0;
            }
        }
        // for(var i = 0; i < $scope.jmlSoal ; i++){
        //     console.log($scope.resCroscek[i]);
        // }
        $http.post(
            "../../php/inputRespon/pushResponTest.php",
            {'idUser':$scope.siswa, 'idBanksoal':$scope.banksoal, 'jenis':'klasik'}
        ).then(function successCallback(response) {
            if (response.data > 0){
                console.log("idResponTest ; " + response.data);
                $scope.resIdResponTest = response.data;
                $http.post(
                    "../../php/inputRespon/pushDetailRespon.php",
                    {'idResponTest':$scope.resIdResponTest,'idSoal':$scope.resIdSoal,'jawab':$scope.resJawab,'croscek':$scope.resCroscek,'jumlah':$scope.jmlSoal}
                ).then(function successCallback(response){
                    if(response.data){
                        alert("all data have been inserted");
                        angular.element(document.getElementById('isiLoop')).html('');
                        $http.post(
                            "../../php/inputRespon/updateStatusRespon.php",
                            {'idResponTest':$scope.resIdResponTest,'status':'finish','nilai':$scope.nilai}
                        ).then(function successCallback(response){
                            if(response.data){
                                alert("Detail Respon klasik berhasil di tambahkan");
                            }
                        }, function errorCallback(response) {
                            alert("koneksi gagal");
                        });
                    }
                    //$scope.response = data
                }, function errorCallback(response) {
                    alert("koneksi gagal");
                });
            }else {
                console.log("idResponTest : " + response.data);
            }
        }, function errorCallback(response) {
            alert("koneksi gagal");
        });
    };
    $scope.cekuser = function(){
        console.log("id bank soal :" + $scope.banksoal);
        console.log("id siswa : " + $scope.siswa);
    };

});