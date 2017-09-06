/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("statistikNilai",['angularModalService']);
app4.controller("statistikC",function($scope,Excel,$timeout,$http,$window,$compile,ModalService){
    $scope.idUser = serverVariable;
    $scope.loadNilai = function () {
        $http.get(
            "../../php/statistik/loadNilai.php"
        ).then(function successCallback(response) {
            $scope.nilais = response.data;
        },function errorCallback(response) {
            alert("load statistik gagal");
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
    $scope.loadBankSoal = function(){
        $http.post(
            "../../php/statistik/loadbanksoal.php"
        ).then(function successCallback(response) {
            $scope.banksoals = response.data;
        }, function errorCallback(response) {
            alert("load bank soal gagal");
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
    $scope.loadAngkatan = function () {
        $http.get(
            "../../php/angkatan/loadAngkatan.php"
        ).then(function successCallback(response) {
            $scope.angkatans = response.data;
        },function errorCallback(response) {
            alert("load angkatan gagal");
        });
    };
    $scope.exportToExcel=function(tableId){ // ex: '#my-table'
            var exportHref=Excel.tableToExcel(tableId,'WireWorkbenchDataExport');
            $timeout(function(){location.href=exportHref;},100); // trigger download
        }

});


app4.factory('Excel',function($window){
        var uri='data:application/vnd.ms-excel;base64,',
            template='<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64=function(s){return $window.btoa(unescape(encodeURIComponent(s)));},
            format=function(s,c){return s.replace(/{(\w+)}/g,function(m,p){return c[p];})};
        return {
            tableToExcel:function(tableId,worksheetName){
                var table=$(tableId),
                    ctx={worksheet:worksheetName,table:table.html()},
                    href=uri+base64(format(template,ctx));
                return href;
            }
        };
    })