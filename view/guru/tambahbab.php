<?php
session_start();
if($_SESSION['job'] == 'guru'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Teacher Dashboard</title>

        <script src="../../library/node_modules/angular/angular.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../../library/css/coba.css">

        <link rel="stylesheet" type="text/css" href="../../library/css/font-awesome.min.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="../../library/node_modules/bootstrap/dist/css/bootstrap.min.css">

        <!-- Animate CSS -->
        <link rel="stylesheet" href="../../library/css/animate.css">

        <!-- CSS CUSTOM -->
        <link rel="stylesheet" type="text/css" href="../../library/css/mine.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="../../library/node_modules/bootstrap/dist/css/bootstrap-theme.css">

        <!-- FONT -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

        <!-- Latest compiled and minified JavaScript -->

        <script src="../../library/js/jquery-2.1.1.min.js"></script>
        <script src="../../library/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- angular -->
        <script src="../../controller/teacher/tambahbab.js"></script>

        <!-- Jquery Loaded -->
        <!-- <script src="js/jquery-2.1.1.min.js"></script> -->

        <!-- ALL META TAG -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimum-scale=1">
        <meta name="description" content="Sistem Pendukung Keputusan">
        <meta name="keywords" content="Learning, Pembelajaran, Pendukung Keputusan">

        <!-- META TAG FOR FB SHARE -->
        <meta property="og:title" content="Sistem Pendukung Keputusan">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <meta property="og:site_name" content="Sistem Pendukung Keputusan">
        <meta property="og:description" content="Learning, Pembelajaran, Pendukung Keputusan">

    </head>
    <body onload="startTime()">
    <div id="mySidenav" class="sidenav">
        <!-- Profile Admin -->
        <div class="col-md-12 profil">
            <div class="cen">
                <img src="../../assets/sekpol.png" class="img-circle" style="width: 70; height: 100px;">
                <span id="nama"><?php echo $_SESSION['login_username']; ?>, S.Pd</span><br />
                <span id="level">Guru</span>
            </div>
        </div>

        <a href="index.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Home</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-home" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="tambahmapel.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Tambah Mapel</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="tambahbab.php">
            <div class="col-md-12 menu active">
                <div class="col-md-10">
                    <span>Tambah Bab Mapel</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="tambahbanksoal.php">
            <div class="col-md-12 menu ">
                <div class="col-md-10">
                    <span>Tambah Bank Soal</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                </div>
            </div>
            <a href="soal.php">
                <div class="col-md-12 menu">
                    <div class="col-md-10">
                        <span>Soal</span>
                    </div>
                    <div class="col-md-2">
                        <span><i class="fa fa-file-text" aria-hidden="true"></i></span>
                    </div>
                </div>
            </a>
            <a href="respon.php">
                <div class="col-md-12 menu">
                    <div class="col-md-10">
                        <span>Input Respon</span>
                    </div>
                    <div class="col-md-2">
                        <span><i class="fa fa-book" aria-hidden="true"></i></span>
                    </div>
                </div>
            </a>

            <a href="analisis.php">
                <div class="col-md-12 menu ">
                    <div class="col-md-10">
                        <span>Analisis</span>
                    </div>
                    <div class="col-md-2">
                        <span><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-12 menu">
                    <div class="col-md-10">
                        <span>Statistik</span>
                    </div>
                    <div class="col-md-2">
                        <span><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                    </div>
                </div>
            </a>

            <a href="../../logout.php">
                <div class="col-md-12 logout">
                    <div class="col-md-10">
                        <span>Logout</span>
                    </div>
                    <div class="col-md-2">
                        <span><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                    </div>
                </div>
            </a>
    </div>
    <nav id="nav-barbar" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid" id="navbar-conteent">
            <div class="navbar-header">

                <span onclick="openNav()" id="open" class="navbar-brand"><i class="fa fa-bars" aria-hidden="true"></i></span>

                <span onclick="closeNav()" id="close" class="navbar-brand"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>

            </div>
            <div class="time">
                <span id="time"></span>
            </div>
        </div>
    </nav>
    <div id="main">
        <!-- Content Isi Atas -->
        <div class="no-padd col-md-12" id="homeTop">
            <div class="col-md-12 soal">
                <div class="generateSoal" ng-app="moduleTambahBab">
                    <form ng-controller="addBab" name="formBab" ng-init="init()">
                        <div class="col-md-12" id="paramMapel">
                            <div class="col-md-12 titleGenerate">
                                <span>Mata Pelajaran</span>
                            </div>
                            <div class="col-md-12 contentGenerate" ng-init="loadMapel()">
                                <div class="input-group">
                                    <select name="mapel" ng-model="mapel" class="form-control" ng-change="cekMapel(mapel)" required="true">
                                        <option value="">pilih mapel</option>
                                        <option ng-repeat="mapel in mapels" value="{{mapel.idMapel}}">{{mapel.namaMapel}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 titleGenerate">
                                <span>Nama Bab Mapel</span>
                                <br/>
                                <span ng-hide="!isBabNotValid" style="color: red">{{message}}</span>
                            </div>
                            <div class="col-md-12 contentGenerate">
                                <div class="form-group">
                                    <input ng-model="namaBabMapel" ng-disabled="!isMapel" type="text" name="namaBabMapel" placeholder="masukan nama bab mapel" class="form-control" required="true" ng-change="cekBab(namaBabMapel)"></input>
                                </div>
                            </div>

                            <div class="col-md-12 titleGenerate">
                                <span>Deskripsi Bab Mapel</span>
                            </div>
                            <div class="col-md-12 contentGenerate">
                                <textarea class="form-control" ng-disabled="!isBab" placeholder="keteragan bab mapel" required="true" name="deskripsiBabMapel" ng-model="deskripsiBabMapel"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12" id="paramGenerate">
                            <div class="col-md-12 tombol">
                                <div class="input-group">
                                            <span class="input-group-btn">
                                                <button ng-disabled="!isDataValid" class="btn btn-primary btn-sm sharp" type="submit" id="buttonGeneratebab" value="input_bab" name="input_bab" ng-click="tambahBab()">Tambah Bab</button>
                                            </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Content Bawah -->

    </div>
    </body>
    <script>var serverVariable=<?=$_SESSION["idUser"];?>;</script>
    <script src="../../library/js/creartive.js"></script>
    </html>
    <?php
}
else{
    header("location:../../index.php");
}

?>