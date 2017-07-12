<?php
session_start();
if($_SESSION['job'] == 'guru'){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Teacher Dashboard</title>

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

        <script src="../../library/node_modules/angular/angular.min.js"></script>
        <script src="../../controller/teacher/soalController.js"></script>
        <script src="../../library/js/jquery-2.1.1.min.js"></script>
        <script src="../../library/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

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
                <img src="../../assets/default-img.png" class="img-circle">
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
            <div class="col-md-12 menu">
                <div class="col-md-10">
                    <span>Tambah Bab Mapel</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                </div>
            </div>
        </a>
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
        <div class="container-fluid">
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
                        <div class="col-md-3">
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
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12 titleGenerate">
                                <span>Bank Soal</span>
                            </div>
                            <div class="col-md-12 contentGenerate">
                                <div class="input-group">
                                    <select name="banksoal" ng-model="banksoal" class="form-control" ng-change="loadbabmapel()">
                                        <option value="">Select banksoal</option>
                                        <option ng-repeat="banksoal in banksoals" value="{{banksoal.idBankSoal}}">{{banksoal.namaBankSoal}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-12 titleGenerate">
                                <span>Bab</span>
                            </div>
                            <div class="col-md-12 contentGenerate">
                                <div class="input-group">
                                    <select class="form-control" name="bab" ng-model="bab" ng-change="pushBab()">
                                        <option value="">Select banksoal</option>
                                        <option ng-repeat="bab in babs" value="{{bab.idBabMapel}}">{{bab.namaBabMapel}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-12 titleGenerate">
                                <span>Jumlah Soal</span>
                            </div>
                            <div class="col-md-12 contentGenerate">
                                <div class="input-group">
                                    <input type="number" id="jumlah-soal" class="form-control" ng-model="jml_soal" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="col-md-12 tombol">
                                <div class="input-group">
							     	<span class="input-group-btn">
							    		<button class="btn btn-primary btn-sm sharp" type="button" id="buttonGenerateSoal" value="input_soal" name="input_soal" ng-click="generateFormsoal()">Input Soal</button>
							    	</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 soal" id="inputSoal">
                        <div class="col-md-12 title" id="titleInputSoal">
                            <div class="col-md-1 titleGenerate">
                                <span>No</span>
                            </div>
                            <div class="col-md-8 titleGenerate">
                                <span>Soal</span>
                            </div>
                            <div class="col-md-3 titleGenerate">
                                <span>Jawaban</span>
                            </div>
                        </div>
                        <div id="isiLoop">
                            <!-- Output Generate -->
                            <!-- <div class="col-md-1 contentGenerate">
                                <span>1</span>
                            </div>
                            <div class="col-md-5 contentGenerate">
                                <div class="form-group">
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3 contentGenerate">
                                <div class="input-group">
                                    <select class="form-control" name="parameterBab">
                                        <option value="one">A</option>
                                        <option value="two">B</option>
                                        <option value="three">C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 contentGenerate">
                                <div class="input-group">
                                    <select class="form-control" name="parameterBab">
                                        <option value="one">Sulit</option>
                                        <option value="two">Sedang</option>
                                        <option value="three">Mudah</option>
                                    </select>
                                </div>
                            </div> -->

                            <!--
                            <div class="col-md-12 title animated fadeIn" id="isiInputSoal">
                                <div class="col-md-1 contentGenerate">
                                    <span>1</span>
                                </div>
                                <div class="col-md-8 contentGenerate">
                                    <div class="form-group">
                                        <textarea class="form-control" ng-model = "arrsoal[0]"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3 contentGenerate">
                                    <div class="input-group">
                                        <select class="form-control" name="parameterBab" ng-model="arrjawab[0]">
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                            <option value="d">D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 contentGenerate">
                                <div class="form-group">
                                    <textarea class="form-control" ng-model = "arropsi1[0]"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3 contentGenerate">
                                <div class="form-group">
                                    <textarea class="form-control" ng-model = "arropsi2[0]"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3 contentGenerate">
                                <div class="form-group">
                                    <textarea class="form-control" ng-model = "arropsi3[0]"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3 contentGenerate">
                                <div class="form-group">
                                    <textarea class="form-control" ng-model = "arropsi4[0]"></textarea>
                                </div>
                            </div>
                            -->


                        </div>
                        <div id="btn_inputSoal">

                            <div class="col-md-1 tombol">
                                <div class="input-group">
									<span class="input-group-btn">
										<input class="btn btn-primary btn-sm sharp" type="submit" id="buttonInputSoal" value="input_soal" name="lihat_soal" ng-click="pushSoal()">Input Soal</input>
									</span>
                                </div>
                            </div>

                        </div>
                        <div>
                            {{response}}
                        </div>
                    </div>


                    <!-- <div class="col-md-2" id="paramPilihan">
                        <div class="col-md-12 titleGenerate">
                            <span>Jumlah Pilihan</span>
                        </div>
                        <div class="col-md-12 contentGenerate">
                            <div class="input-group">
                                <input type="number" class="form-control" required>
                            </div>
                        </div>
                    </div> -->

                </div> <!-- <div class="col-md-12 soal" ng-controller="addSoal"> -->
            </div>
            <!-- Content Bawah -->
            <div class="no-padd col-md-12" id="homeBottom">

            </div>
        </div>
    </body>

    <script>

        /*
         $(document).ready(function() {
         $(".data").hover(function(){ $(this).toggleClass('.shad'); });

         var i = 0;

         var btn_inputSoalan = ('<div class="col-md-1 tombol">'+
         '<div class="input-group">'+
         '<span class="input-group-btn">'+
         '<button class="btn btn-primary btn-sm sharp" type="button" id="buttonInputSoal" value="input_soal" name="lihat_soal" ng-click="pushSoal()">Input Soal</button>'+
         '</span>'+
         '</div>'+
         '</div>');
         */

        /*
         $('#buttonGenerateSoal').click(function() {
         var jumlahSoal = $('#jumlah-soal').val();

         $('#isiLoop').html('');

         for (i = 0; i < jumlahSoal; i++) {
         $('#isiLoop').append('<div class="col-md-12 title animated fadeIn" id="isiInputSoal">'+
         '<div class="col-md-1 contentGenerate">'+
         '<span>'+(i+1)+'</span>'+
         '</div>'+
         '<div class="col-md-8 contentGenerate">'+
         '<div class="form-group">'+
         '<textarea class="form-control" ng-model ="arrsoal['+ i +']" ></textarea>'+
         '</div>'+
         '</div>'+
         '<div class="col-md-3 contentGenerate">'+
         '<div class="input-group">'+
         '<select class="form-control" name="parameterBab" ng-model="arrjawab['+ i +']>'+
         '<option value="">pilih kunci</option>'+
         '<option value="a">A</option>'+
         '<option value="b">B</option>'+
         '<option value="c">C</option>'+
         '<option value="d">D</option>'+

         '</select>'+
         '</div>'+
         '</div>'+
         '</div>'+
         '<div class="col-md-3 contentGenerate">'+
         '<div class="form-group">'+
         '<textarea class="form-control" ng-model = "arropsi1['+ i +']"></textarea>'+
         '</div>'+
         '</div>'+
         '<div class="col-md-3 contentGenerate">'+
         '<div class="form-group">'+
         '<textarea class="form-control" ng-model = "arropsi2['+ i +']"></textarea>'+
         '</div>'+
         '</div>'+
         '<div class="col-md-3 contentGenerate">'+
         '<div class="form-group">'+
         '<textarea class="form-control" ng-model = "arropsi3['+ i +']"></textarea>'+
         '</div>'+
         '</div>'+
         '<div class="col-md-3 contentGenerate">'+
         '<div class="form-group">'+
         '<textarea class="form-control" ng-model = "arropsi4['+ i +']"></textarea>'+
         '</div>'+
         '</div>');
         }
         });
         });*/
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