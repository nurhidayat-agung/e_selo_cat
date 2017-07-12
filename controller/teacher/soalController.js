/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("moduleTambahSoal",[]);
app4.controller("addSoal", function($scope,$http,$window,$compile){
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


        // success(function(data){
        //     //alert(data);
        //     $scope.banksoals = data;
        // });
    }
    $scope.loadbabmapel = function(){
        $scope.selectBankSoal = $scope.banksoal;
        console.log($scope.selectBankSoal);
        $http.post(
            "../../php/tambahsoal/loadbabmapel.php",
            {'idMapel':$scope.mapel}
        ).then(
            function successCallback(response) {
                $scope.babs = response.data;
            },function errorCallback(response) {
                alert("sambungan gagal")
            }
        );

        // success(function(data){
        //     //alert(data);
        //     $scope.babs = data;
        // });
    }
    $scope.pushBab = function(){
        $scope.selectBab = $scope.bab;
        console.log($scope.selectBab);
    }
    $scope.pushSoal = function(){
        //   console.log("mapel dipilih " + $scope.selectMapel);
        //   console.log("bab dipilih " + $scope.selectBab);
        //   console.log("banksoal dipilih " + $scope.selectBankSoal);
        //   console.log("jumlah soal dipilih " + $scope.jml_soal);
        //   console.log($scope.arrsoal[0]);
        for(var i = 0; i < $scope.jml_soal ; i++){
            if($scope.arrsoal[i] === null || $scope.arrjawab[i] === null || $scope.arropsi1[i] === null || $scope.arropsi2[i] === null || $scope.arropsi3[i] === null || $scope.arropsi4[i] === null){
                $scope.ready = "false";
            }else{
                $scope.ready = "true";
            }
        }
        if($scope.ready === "true"){
            $http.post(
                "pushSoal.php",
                {'jumlah':$scope.jml_soal,'idBankSoal':$scope.banksoal,'isiSoal':$scope.arrsoal,'pil1':$scope.arropsi1,'pil2':$scope.arropsi2,'pil3':$scope.arropsi3,'pil4':$scope.arropsi4,'kunci':$scope.arrjawab,'idBabMapel':$scope.bab}
            ).success(function(data){
                if(data){
                    alert("all data have been inserted");
                    angular.element(document.getElementById('isiLoop')).html('');
                }
                //$scope.response = data
            });

        }else{
            alert("semua field harus di isi");
        }


    }

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

});


// success(function(data){
//     $scope.mapels = data;
// })