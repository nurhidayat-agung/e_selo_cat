<?php
	session_start();
	if($_SESSION['job'] == 'guru'){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Teacher Dashboard</title>
	<link rel="icon" type="image/png" sizes="32x32" href="../../assets/favicon-32x32.png">
    //css
    <link rel="stylesheet" type="text/css" href="../../library/css/coba.css">
    <link rel="stylesheet" type="text/css" href="../../library/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../library/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../../library/css/animate.css">
    <!-- CSS CUSTOM -->
    <link rel="stylesheet" type="text/css" href="../../library/css/mine.css">


    // js
    <script src="../../library/js/jquery-2.1.1.min.js"></script>
    <script src="../../library/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../library/node_modules/angular/angular.min.js"></script>
    <script src="../../library/node_modules/angular-modal-service/dst/angular-modal-service.js"></script>
    <script src="../../controller/teacher/responController.js"></script>


	<!-- Optional theme -->
    <link rel="stylesheet" href="../../library/node_modules/bootstrap/dist/css/bootstrap-theme.css">

	<!-- FONT -->
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

	<!-- Latest compiled and minified JavaScript -->






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
			<div class="col-md-12 menu ">
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
<!--		<a href="respon.php">-->
<!--			<div class="col-md-12 menu active">-->
<!--				<div class="col-md-10">-->
<!--					<span>Input Respon</span>-->
<!--				</div>-->
<!--				<div class="col-md-2">-->
<!--					<span><i class="fa fa-book" aria-hidden="true"></i></span>-->
<!--				</div>-->
<!--			</div>-->
<!--		</a>-->
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

		<a href="../../logoutAdmin.php">
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
	<div id="main" ng-app="moduleTambahRespon" >
	<!-- Content Isi Atas -->
		<div class="no-padd col-md-12" id="homeTop" ng-controller="addRespon" ng-init="loadMapel()">
			<div class="col-md-12 soal" >
				<div class="generateSoal">
					<div class="col-md-12" id="paramMapel">
						<div class="col-md-4">
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
						<div class="col-md-4">
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
								<span>Id Siswa</span>
							</div>
							<div class="col-md-12 contentGenerate">
								<div class="input-group">
										<select name="mapel" ng-model="siswa" class="form-control" required="true" ng-change="cekuser()">
											<option value="">pilih siswa</option>
											<option ng-repeat="siswa in siswas" value="{{siswa.idUser}}">{{siswa.username}}</option> 
										</select>
									</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="col-md-12 tombol">
								<div class="input-group">
							     	<span class="input-group-btn">
							    		<button  style="background-color: #42a5f5; color: white;" class="btn btn-sm sharp" type="button" id="buttonGenerateSoal" value="input_soal" name="input_soal" ng-click="generateResponForm()">Generate</button>
							    	</span>
							    </div>
							</div>
						</div>
					</div>

					<div class="col-md-12 soal" id="inputSoal">
						<div class="col-md-12 title" id="titleInputSoal">
							<div class="col-md-1 titleGenerate">
								<span>Nomor</span>
							</div>
							<div class="col-md-8 titleGenerate">
								<span>Butir Soal</span>
							</div>
							<div class="col-md-1 titleGenerate">
								<span>Kunci</span>
							</div>
							<div class="col-md-2 titleGenerate">
								<span>Jawaban</span>
							</div>				
						</div>
						<div id="isiLoop">
							
							
							

						</div>
						<div id="btn_inputSoal">

							<div class="col-md-1 tombol">
								<div class="input-group">
									<span class="input-group-btn">
										<input style="background-color: #42a5f5; color: white;" class="btn  btn-sm sharp" type="submit" id="buttonInputSoal" value="Submit Response" name="lihat_soal" ng-click="pushRespon()">Submit Response</input>
									</span>
								</div>
							</div>
						</div>	
				</div>	
			</div>
		</div>
		<div>
			{{response}}				
		</div>
		
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
		header("location:../../admin/index.php");
	}

?>