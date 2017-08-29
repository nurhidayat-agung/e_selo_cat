<?php
session_start();
if($_SESSION['job'] == 'siswa'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Student Dashboard</title>

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
        <script src="../../controller/student/indexSiswa.js"></script>

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
                <span id="level">Siswa</span>
            </div>
        </div>

        <a href="#">
            <div class="col-md-12 menu active">
                <div class="col-md-10">
                    <span>Home</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-home" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <a href="test.php">
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Test</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-file-text" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
        <!-- <a href="#">
            <div class="col-md-12 menu">
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
        </a> -->

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
    <div id="main">
        <!-- Content Isi Atas -->
        <div class="no-padd col-md-12" id="homeTop">
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
            <a href="siswa.php">
                <div class="col-md-4 data">
                    <div class="dataIn">
                        <div class="col-md-12" id="dataUser">
                            <i class="fa fa-user-circle-o"></i>
                        </div>
                        <div class="col-md-12" id="jumlahUser">
                            <span>200</span>
                            <div class="divider"></div>
                            <span>Siswa</span>
                        </div>
                    </div>
                </div>
            </a>
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
        <!-- Content Atas -->
        <div class="no-padd col-md-12" id="homeBottom" ng-app="indekSiswa" ng-controller="indexSiswaController">

            <div class="col-md-6 recent">
                <div class="col-md-12 recentIn">
                    <div class="col-md-12 recentTitle" id="jumlahSoal">
                        <i class="fa fa-user-circle-o"></i>
                        <span>Profil Siswa</span>
                        <div class="divider"></div>
                    </div>
                    <div class="col-md-12 recentContent" ng-init="getUserInformation()">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>IdUser</th>
                                <th>: {{idUser}}</th>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <th>: {{username}}</th>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <th>: {{maskPass}}</th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>: {{status}}</th>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <th>: {{nama}}</th>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <th>: {{email}}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-6 recent">
                <div class="col-md-12 recentIn">
                    <div class="col-md-12 recentTitle" id="jumlahResponse">
                        <i class="fa fa-check-circle-o"></i>
                        <span>Respon Terbaru</span>
                        <div class="divider"></div>
                    </div>
                    <div class="col-md-12 recentContent" ng-init="getResponData()">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nama Test</th>
                                <th>Nilai</th>
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
						    		<button class="btn btn-primary btn-sm sharp" type="button">More</button>
						    	</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Content Bawah -->
    </div>
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
    header("location:../../index.php");
}

?>