<?php
session_start();
if($_SESSION['job'] == 'guru'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Dashboard</title>
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
        <script src="../../controller/teacher/soalController.js"></script>

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
                <span id="nama"><?php echo $_SESSION['login_username']; ?>, S.Pd</span><br />
                <span id="level">Admin</span>
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
       <a href="angkatan.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Angkatan</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-file-text" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="guru.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Guru</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                </div>
            </div>
            </a> 
        <a href="timpengajar.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Tim Pengajar</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-book" aria-hidden="true"></i></span>
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
    <div id="main" ng-app="moduleTambahSoal" >
        <!-- Content Isi Atas -->
        <div class="no-padd col-md-12" id="homeTop" ng-controller="addSoal" ng-init="loadMapel()">
            <div class="col-md-12 soal" ng-controller="addSoal">
                <div class="generateSoal">
                    <div class="col-md-12" id="paramMapel">
                        <div class="col-md-4">
                        </div>
                    
                        <div class="col-md-4">
                            <div class="col-md-12 tombol">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button style="background-color: #42a5f5; color: white;"  class="btn btn-sm sharp" type="button" id="buttonGenerateSoal" value="input_soal" name="input_soal" ng-click="tambahSoal(mapel,banksoal)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Tambah Tim Pengajar </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>

                    <div class="col-md-12 soal" id="inputSoal">
                        <div class="col-md-12 title table-responsive" id="inputSoal" ng-init="displayData()">
                            <table class="table table-bordered" >
                                <thead>
                                <tr >
                                    <th class="col-md-1 titleGenerate" ><center>id Tim</center></th>
                                    <th class="col-md-2 titleGenerate" ><center>Nama Tim Pengajar</center></th>
                                    <th class="col-md-2 titleGenerate" ><center>Keterangan </center></th>
                                    <th class="col-md-1 titleGenerate" ><center>Edit</center></th>
                                    <th class="col-md-1 titleGenerate" ><center>Hapus</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="soal in soals">
                                    <th class="col-md-1 " >{{soal.idTim}}</th>
                                    <th class="col-md-2 " >{{soal.NamaTimPengajar}}</th>
                                    <th class="col-md-2 " >{{soal.Keterangan}}</th>
                                    <th class="col-md-2 " >{{soal.Email}}</th>
                                    <th class="col-md-1 " >{{soal.Password}}</th>
                                    <th class="col-md-1 btn-lg" ng-click="editTambahSoal(soal.idSoal,mapel)" >

                                    <a href="#">
                                    <span class="glyphicon glyphicon-edit" ></span>
                                    </a>
                                    </th> 
                                    <th class="col-md-1 btn-lg">
                                    <a href="#">
                                    <span class="glyphicon glyphicon-trash"   ng-click="deleteSoal(soal.idSoal)"></span>
                                    </a>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <span class="col-md-12 " ng-hide="!isNoSoal"><center>Tidak Ada Tim Pengajar dalam data base</center></span>
                        </div>
                        <div>
                            <span class="col-md-12 " ng-hide="!isNoSoal"><center>{{message}}</center></span>
                        </div>
                        <div>
                            {{response}}
                        </div>
                    </div>


                    <!-- The actual modal template, just a bit o bootstrap -->
                    <script type="text/ng-template" id="delete.html" id="delete">
                        <div class="modal fade container">
                            <div class="modal-dialog">
                                <div class="modal-content col-md-12">
                                    <div class="modal-header col-md-12">
                                        <button type="button" class="close" ng-click="close('Cancel')" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title titleGenerate">Hapus Soal</h4>
                                    </div>
                                    <div class="modal-body col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate" id="deleteModalContent">apa anda yakin akan menghapus</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer col-md-12">
                                        <div class="col-md-6">
                                            <!--                                            <button type="button" ng-click="close('No')" class="btn btn-default" data-dismiss="modal">No</button>-->
                                            <button type="button" ng-click="modalno()" data-dismiss="modal" class="btn btn-default">Batal</button>
                                        </div>
                                        <div class="col-lg-6">
                                            <!--                                            <button type="button" ng-click="close('Yes')" class="btn btn-primary" data-dismiss="modal">Yes</button>-->
                                            <button type="button" ng-click="modalyes()" data-dismiss="modal" class="btn btn-warning">Hapus</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </script>


                    <!-- The actual modal template, just a bit o bootstrap -->
                    <script type="text/ng-template" id="modal.html" id="myModal">
                        <div class="modal fade container" ng-init="init()">
                            <div class="modal-dialog">
                                <div class="modal-content col-md-12">
                                    <div class="modal-header col-md-12">
                                        <button type="button" class="close" ng-click="close('Cancel')" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title titleGenerate">Tambah/Edit Tim Pengajar </h4>
                                    </div>
                                    <div class="modal-body col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate">Nama Tim Pengajar : </span>
                                                <input type="text" class="form-control" placeholder="masukkan Nama Tim Pengajar">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate">Keterangan : </span>
                                                <input type="text" class="form-control" placeholder="masukkan Keterangan">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer col-md-12">
                                        <div class="col-md-6">
<!--                                            <button type="button" ng-click="close('No')" class="btn btn-default" data-dismiss="modal">No</button>-->
                                            <button type="button" ng-click="modalno()" data-dismiss="modal" class="btn btn-default">Batal</button>
                                        </div>
                                        <div class="col-lg-6">
<!--                                            <button type="button" ng-click="close('Yes')" class="btn btn-primary" data-dismiss="modal">Yes</button>-->
                                            <button type="button" ng-click="modalyes()" class="btn" style="background-color: #42a5f5; color: white;">Simpan</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </script>


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
