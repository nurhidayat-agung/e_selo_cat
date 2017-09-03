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

	<!-- <!-- FONT -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

	<!-- Latest compiled and minified JavaScript -->

	<script src="../../library/js/jquery-2.1.1.min.js"></script>
	<script src="../../library/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../library/node_modules/angular/angular.min.js"></script>
    <script src="../../library/node_modules/angular-modal-service/dst/angular-modal-service.js"></script>
	<!-- angular -->
	<script src="../../controller/teacher/tambahtest.js"></script>

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
		<!-- <a href="tambahmapel.php">
			<div class="col-md-12 menu active">
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
		<a href="test.php">
            <div class="col-md-12 menu active">
                <div class="col-md-10">
                    <span>Test</span>
                </div>
                <div class="col-md-2">
                    <span><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                </div>
            </div>
            </a>
<!--		<a href="respon.php">-->
<!--			<div class="col-md-12 menu">-->
<!--				<div class="col-md-10">-->
<!--					<span>Input Respon</span>-->
<!--				</div>-->
<!--				<div class="col-md-2">-->
<!--					<span><i class="fa fa-book" aria-hidden="true"></i></span>-->
<!--				</div>-->
<!--			</div>-->
<!--		</a>-->

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
	<div id="main" ng-app="moduleTambahTest">
		<div class="no-padd col-md-12" id="homeTop" ng-controller="addTest">
			<div class="col-md-12 soal" >
                <form >
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="col-md-12 titleGenerate">
                                <span>Nama Test</span>
                            </div>
                            <div class="col-md-12 contentGenerate">
                                <div class="form-group">
                                    <input ng-model="namaTest" type="text" name="namatest" placeholder="masukan nama test" class="form-control" ng-change="" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="col-md-12 titleGenerate">
                                    <span>Sumber Bank Soal</span>
                                </div>
                                <div class="col-md-12 contentGenerate">
                                    <div class="input-group">
                                        <select name="banksoal" ng-model="banksoal" class="form-control" ng-init="loadBankSoal()" ng-change="cekJmlSoal()">
                                            <option value="">Select banksoal</option>
                                            <option ng-repeat="banksoal in banksoals" value="{{banksoal.idBankSoal}}">{{banksoal.namaBankSoal}}</option>
                                        </select>
                                    </div>
                                    <span>{{msgBankSoal}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 titleGenerate">
                                    <span>Jenis Test</span>
                                </div>
                                <div class="col-md-12 contentGenerate">
                                    <input type="radio" name="jenistest" value="adaptif" ng-model="radioJenis"> Adaptif &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="jenistest" value="klasik" ng-model="radioJenis"> Klasik<br>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-lg-6">
                                <div class="col-md-12 titleGenerate">
                                    <span>Komposisi Soal</span>
                                </div>
                                <div class="col-md-12 contentGenerate">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">Pilihan Ganda </span>
                                        <input type="number" name="pilihanganda" required="true" class="form-control" ng-model="jmlPilGan" aria-describedby="sizing-addon2">
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="sizing-addon2">Uraian &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                        <input type="number" name="uraian" required="true" class="form-control" ng-model="jmlEssay" aria-describedby="sizing-addon2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 titleGenerate">
                                    <span>Waktu Test</span>
                                </div>
                                <div class="col-md-12 contentGenerate">
                                    <div class="form-group">
                                        <input ng-model="waktuTest" type="number" name="skor" class="form-control" ng-change="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="paramGenerate">
                        <div class="col-md-12 tombol">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <input style="background-color: #42a5f5; color: white;" class="btn btn-sm sharp" type="submit" id="buttonGenerateSoal" value="Buat Test" name="input_soal" ng-click="pushTest()"/>
                                    </span>
                                </div>
                        </div>
                    </div>
                </form>
			</div>

            <div class="col-md-12 soal" id="inputSoal">
                <div class="col-md-12">
                    <center class="col-md-12">
                        <span class="titleGenerate">Daftar Test Dalam Data Base</span>
                    </center>
                </div>
                <div class="col-md-12 title table-responsive" id="inputSoal" ng-init="loadTest()">
                    <table class="table table-bordered">
                        <thead>
                        <tr >
                            <th class="col-md-1 titleGenerate" ><center>Id Test</center></th>
                            <th class="col-md-4 titleGenerate" ><center>Nama Test</center></th>
                            <th class="col-md-2 titleGenerate" ><center>Tim Pengajar</center></th>
                            <th class="col-md-1 titleGenerate" ><center>Jenis Test</center></th>
                            <th class="col-md-1 titleGenerate" ><center>Status</center></th>
                            <th class="col-md-1 titleGenerate" ><center>Ubah Status</center></th>
                            <th class="col-md-1 titleGenerate" ><center>Preview</center></th>
                            <th class="col-md-1 titleGenerate" ><center>Hapus</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="test in tests">
                            <th class="col-md-1 " >{{test.idTest}}</th>
                            <th class="col-md-4 " >{{test.namaTest}}</th>
                            <th class="col-md-2 " >{{test.namaTimPengajar}}</th>
                            <th class="col-md-1 " >{{test.jenisTest}}</th>
                            <th class="col-md-1 " >{{test.status}}</th>
                            <th class="col-md-1 btn-lg">
                                <div class="col-md-12">
                                    <a href="#" ng-click="ubahStatus(test)" class="col-md-12">
                                        <span class="glyphicon glyphicon-refresh col-md-12"></span>
                                    </a>
                                </div>
                            </th>
                            <th class="col-md-1 btn-lg">
                                <div class="col-md-12">
                                    <a href="#" ng-click="previewTest(test)" class="col-md-12">
                                        <span class="glyphicon glyphicon-search col-md-12"></span>
                                    </a>
                                </div>
                            </th>
                            <th class="col-md-1 btn-lg">
                                <div class="col-md-12">
                                    <a href="#" ng-click="deleteTest(test)" class="col-md-12">
                                        <span class="glyphicon glyphicon-trash col-md-12"></span>
                                    </a>
                                </div>
                            </th>
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


            <div class="col-md-12 soal" id="inputSoal">
                <div class="col-md-12 title table-responsive" id="inputSoal">
                    <table class="table table-bordered" >
                        <thead>
                        <tr >
                            <th class="col-md-1 titleGenerate" ><center>Id Soal</center></th>
                            <th class="col-md-5 titleGenerate" ><center>Butir Soal</center></th>
                            <th class="col-md-2 titleGenerate" ><center>Jenis Soal</center></th>
                            <th class="col-md-2 titleGenerate" ><center>Bobot Soal</center></th>
                            <th class="col-md-1 titleGenerate" ><center>Priview</center></th>
                            <th class="col-md-1 titleGenerate" ><center>Set Bobot</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="soal in soals">
                            <th class="col-md-1 " >{{soal.idSoal}}</th>
                            <th class="col-md-5 " >{{soal.isiSoal}}</th>
                            <th class="col-md-2 " >{{soal.jenisSoal}}</th>
                            <th class="col-md-2 " >{{soal.bobotSoal}}</th>
                            <th class="col-md-1 btn-lg">
                                <div class="col-md-12">
                                    <a href="#" ng-click="editTambahSoal(soal.idSoal,soal.jenisSoal)" class="col-md-12">
                                        <span class="glyphicon glyphicon-edit col-md-12"></span>
                                    </a>
                                </div>
                            </th>
                            <th class="col-md-1 btn-lg">
                                <div class="col-md-12">
                                    <a href="#" ng-click="deleteSoal(soal.idSoal)" class="col-md-12">
                                        <span class="glyphicon glyphicon-trash col-md-12"></span>
                                    </a>
                                </div>
                            </th>
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
                                        <span class="titleGenerate" id="deleteModalContent">apa anda yakin akan menghapus Test {{namaTest}}</span>
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

		</div>


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