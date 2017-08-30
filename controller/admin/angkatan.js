/**
 * Created by kazt on 7/12/2017.
 */


var app4 = angular.module("moduleTambahSoal",['angularModalService']);
app4.controller("addSoal",function($scope,$http,$window,$compile,ModalService){

});

app4.controller('EditModalEsayController', function($scope,$http,$window,close,idSoal) {
    $scope.modalno = function (result) {
        close(result, 500);
    };

    $scope.close = function(result) {
        close(result, 500); // close, but give 500ms for bootstrap to animate
    };

    $scope.modalyes = function () {

    };
});