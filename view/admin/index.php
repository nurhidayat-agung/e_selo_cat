<?php
session_start();
if($_SESSION['job'] == 'admin'){
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Dashboard</title>
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

        <!-- FONT -->
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

        <!-- Latest compiled and minified JavaScript -->

        <script src="../../library/js/jquery-2.1.1.min.js"></script>
        <script src="../../library/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../../library/node_modules/angular/angular.min.js"></script>
        <script src="../../library/node_modules/angular-modal-service/dst/angular-modal-service.js"></script>
        <script src="../../controller/admin/profile.js"></script>

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
                <span id="nama"><?php echo $_SESSION['login_username']; ?></span><br />
                <span id="level">Admin</span>
            </div>
        </div>

        <a href="index.php">
            <div class="col-md-12 menu active">
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
        <a href="pleton.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Pleton</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-android" aria-hidden="true"></i></span>
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


        <a href="siswa.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Data Siswa</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-address-card" aria-hidden="true"></i></span>
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
    <div id="main" >
        <!-- Content Isi Atas -->
        <div class="no-padd col-md-12" id="homeTop" ng-app="admin">
            <a href="test.php">
                <div class="col-md-4 data">
                    <div class="dataIn">
                        <div class="col-md-12" id="dataSoal">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <div class="col-md-12" id="jumlahSoal">
                            <span>200</span>
                            <div class="divider"></div>
                            <span>Soal</span>
                        </div>
                    </div>
                </div>
            </a>
           
                <div class="col-md-4 data" ng-controller="editProfile">
                    <div class="dataIn">
                        <div class="col-md-12" id="dataUser">
                            <i class="fa fa-user-circle-o"></i>
                        </div>
                        <div class="col-md-12" id="jumlahUser" >
                            <span>200</span>
                            <div class="divider"></div>
                            <span class="glyphicon glyphicon-wrench" ng-click="show()" aria-hidden="true"></span> Edit Profile
                        </div>
                    </div>
                </div>

            <a href="statistik.php">
                <div class="col-md-4 data">
                    <div class="dataIn">
                        <div class="col-md-12" id="dataResponse">
                            <i class="fa fa-check-circle-o"></i>
                        </div>
                        <div class="col-md-12" id="jumlahResponse">
                            <span>200</span>
                            <div class="divider"></div>
                            <span>Response</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="no-padd col-md-12" id="homeBottom" ng-app="indekSiswa" ng-controller="indexSiswaController">

            <div class="col-md-6 recent">
                <div class="col-md-12 recentIn">
                    <div class="col-md-12 recentTitle" id="jumlahSoal">
                        <i class="fa fa-user-circle-o"></i>
                        <span>Angkatan </span>
                        <div class="divider"></div>
                    </div>
                    <div class="col-md-12 recentContent" ng-init="getResponData()">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID Pleton</th>
                                <th>Nama Angkatan</th>
                                <th>Deskripsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="respon in respons">
                                <td>{{respon.idpleton}}</td>
                                <td>{{respon.namaBankSoal}}</td>
                                <td>{{respon.nilaiResponTest}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 recentButton">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button style="background-color: #42a5f5; color: white;" class="btn btn-sm sharp" type="button">More</button>
                                </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 recent">
                <div class="col-md-12 recentIn">
                    <div class="col-md-12 recentTitle" id="jumlahResponse">
                        <i class="fa fa-check-circle-o"></i>
                        <span>Data Guru</span>
                        <div class="divider"></div>
                    </div>
                    <div class="col-md-12 recentContent" ng-init="getResponData()">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nama Angkatan</th>
                                <th>Deskripsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="respon in respons">
                                <td>{{respon.namaBankSoal}}</td>
                                <td>{{respon.nilaiResponTest}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 recentButton">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button style="background-color: #42a5f5; color: white;" class="btn btn-sm sharp" type="button">More</button>
                                </span>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-md-6 recent" style="padding-top: 30px;">
                <div class="col-md-12 recentIn">
                    <div class="col-md-12 recentTitle" id="jumlahSoal">
                        <i class="fa fa-user-circle-o"></i>
                        <span>Angkatan </span>
                        <div class="divider"></div>
                    </div>
                    <div class="col-md-12 recentContent" ng-init="getResponData()">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>NIK/NRP</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Job</th>
                                <th>Nama</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="respon in respons">
                                <td>{{respon.idpleton}}</td>
                                <td>{{respon.namaBankSoal}}</td>
                                <td>{{respon.nilaiResponTest}}</td>
                                <td>{{respon.idpleton}}</td>
                                <td>{{respon.namaBankSoal}}</td>
                                <td>{{respon.nilaiResponTest}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 recentButton">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button style="background-color: #42a5f5; color: white;" class="btn btn-sm sharp" type="button">More</button>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 recent" style="padding-top: 30px;">
                <div class="col-md-12 recentIn">
                    <div class="col-md-12 recentTitle" id="jumlahSoal">
                        <i class="fa fa-user-circle-o"></i>
                        <span>Tim Pengajar</span>
                        <div class="divider"></div>
                    </div>
                    <div class="col-md-12 recentContent" ng-init="getResponData()">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID Tim/th>
                                <th>Nama Tim Pengajar</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="respon in respons">
                                <td>{{respon.idpleton}}</td>
                                <td>{{respon.namaBankSoal}}</td>
                                <td>{{respon.nilaiResponTest}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 recentButton">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button style="background-color: #42a5f5; color: white;" class="btn btn-sm sharp" type="button">More</button>
                                </span>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/ng-template" id="modal.html" id="myModal">
                        <div class="modal fade container" ng-init="init()">
                            <div class="modal-dialog">
                                <div class="modal-content col-md-12">
                                    <div class="modal-header col-md-12">
                                        <button type="button" class="close" ng-click="close('Cancel')" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title titleGenerate">Tambah/Edit Guru </h4>
                                    </div>
                                    <div class="modal-body col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate">NIK : </span>
                                                <input type="text" class="form-control" placeholder="masukkan NIK">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate">Nama : </span>
                                                <input type="text" class="form-control" placeholder="masukkan nama">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate">Job : </span>
                                                <input type="text" class="form-control" placeholder="masukkan pekerjaan">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate">Email : </span>
                                                <input type="email" class="form-control" placeholder="example@gmail.com">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="titleGenerate">Password : </span>
                                                <input type="password" class="form-control" placeholder="masukkan password">
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

        </div>
        <!-- Content Bawah -->
    </div>
    </div>
    <!-- table  -->
        
    <!-- end teble -->
    </body>
    <script>var serverVariable=<?=$_SESSION["idUser"];?>;</script>
    <script>
        $(document).ready(function() {
            $(".data").hover(function(){ $(this).toggleClass('.shad'); });
        });
    </script>

    <script src="../../library/js/creartive.js"></script>
    </html>
    <?php
}
else{
    header("location:index.php");
}
