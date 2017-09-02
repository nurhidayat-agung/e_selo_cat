<?php
session_start();
if($_SESSION['job'] == 'guru'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Teacher Dashboard</title>
        <link rel="icon" type="image/png" sizes="32x32" href="../../assets/favicon-32x32.png">
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


        <!-- Latest compiled and minified JavaScript -->
        <script src="../../library/js/jquery-2.1.1.min.js"></script>
        <script src="../../library/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../../library/node_modules/angular/angular.min.js"></script>
        <script src="../../library/node_modules/angular-modal-service/dst/angular-modal-service.js"></script>
        <script src="../../controller/teacher/export.js"></script>

        <!-- FONT -->
        <link href="../../library/fonts/font-oswald.css" rel="stylesheet">


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
                <span id="nama"><?php echo $_SESSION['nama']; ?>, S.Pd</span><br />
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
       <!--  <a href="tambahmapel.php">
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
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Tambah Bab Mapel</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                </div>
            </div>
        </a> -->
        <a href="tambahbanksoal.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Tambah Bank Soal</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="soal.php">
            <div class="col-md-12 menu active">
                <div class="col-md-10">
                    <span>Soal</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-file-text" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="test.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Test</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                </div>
            </div>
            </a> 
<!--        <a href="respon.php">-->
<!--            <div class="col-md-12 menu">-->
<!--                <div class="col-md-10">-->
<!--                    <span>Input Respon</span>-->
<!--                </div>-->
<!--                <div class="col-md-2">-->
<!--                    <span><i class="fa fa-book" aria-hidden="true"></i></span>-->
<!--                </div>-->
<!--            </div>-->
<!--        </a>-->
        <a href="analisis.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Analisis</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="statistik.php">
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

    <!-- Use any element to open the sidenav -->

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
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

    <!-- content -->
    <div id="main" ng-app="statistikNilai" >
        <!-- Content Isi Atas -->
        <div class="no-padd col-md-12" id="homeTop" ng-controller="statistikC">
            <div class="col-md-12 soal" ">
                <div class="generateSoal">
                    <div class="col-md-12" id="paramMapel">
                        <!-- <div class="col-md-4">
                            <div class="col-md-12 titleGenerate">
                                <div>Mapel</div>
                            </div>
                            <div class="col-md-12 contentGenerate" >
                                <div class="input-group">
                                    <select name="mapel" ng-model="mapel" class="form-control" ng-change="loadbanksoal()" required="true">
                                        <option value="">pilih mapel</option>
                                        <option ng-repeat="mapel in mapels" value="{{mapel.idMapel}}">{{mapel.namaMapel}}</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-4">
                          
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 tombol">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button style="background-color: #42a5f5; color: white;"  class="btn btn-sm sharp" type="button" id="buttonGenerateSoal" value="input_soal" name="input_soal" ng-click="exportToExcel('#tableToExport')"><span class="glyphicon glyphicon-save" aria-hidden="true"></span>  Donwload Data</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>

                    <div class="col-md-12 soal">
                        <div class="col-md-12 title table-responsive" ng-init="loadNilai()" >
                            <table class="table table-bordered" id="tableToExport" >
                                <thead>
                                <tr >
                                    <th class="col-md-1 titleGenerate" ><center>NIS</center></th>
                                    <th class="col-md-1 titleGenerate" ><center>ID Test</center></th>
                                    <th class="col-md-2 titleGenerate" ><center>Jenis Soal</center></th>
                                    <th class="col-md-1 titleGenerate" ><center>Nilai</center></th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="nilai in nilais">
                                    <th class="col-md-1 " >{{nilai.nis}}</th>
                                    <th class="col-md-1 " >{{nilai.idTest}}</th>
                                    <th class="col-md-2 " >{{nilai.jenis}}</th>
                                    <th class="col-md-1 " >{{nilai.nilaiResponTest}}</th>
                                    
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <span class="col-md-12 " ng-hide="!isNoSoal"><center>Tidak Ada soal dalam data base</center></span>
                        </div>
                        <div>
                            <span class="col-md-12 " ng-hide="!isNoSoal"><center>{{message}}</center></span>
                        </div>
                        <div>
                            {{response}}
                        </div>
                    </div>

                </div> <!-- <div class="col-md-12 soal" ng-controller="addSoal"> -->
            </div>
            <!-- Content Bawah -->
            <div class="no-padd col-md-12" id="homeBottom">

            </div>
        </div>
    </body>

    <script>

    </script>
    <script>var serverVariable=<?=$_SESSION["idUser"];?>;</script>
    <script src="../../library/js/creartive.js"></script>
    </html>

    <?php
}
else{
    header("location:../../index.php");
}

?>