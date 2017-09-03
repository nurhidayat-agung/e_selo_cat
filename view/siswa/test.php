<?php
	session_start();
	if($_SESSION['status'] == 'siswa'){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
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
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

	<!-- Latest compiled and minified JavaScript -->

    <script src="../../library/js/jquery-2.1.1.min.js"></script>
    <script src="../../library/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../library/node_modules/angular/angular.min.js"></script>
    <script src="../../controller/student/newTest.js"></script>

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
                <span id="nama"><h4 style="margin-bottom: 0px;"><?php echo $_SESSION['idUser']; ?></h4></span><br />
                <span id="level">Siswa</span>
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
		<a href="test.php">
			<div class="col-md-12 menu active">
				<div class="col-md-10">
					<span>Test</span>
				</div>
				<div class="col-md-2">
					<span><i class="fa fa-file-text" aria-hidden="true"></i></span>
				</div>
			</div>
		</a>
		<a href="response.php">
                <div class="col-md-12 menu">
                    <div class="col-md-10">
                        <span>Response</span>
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
	<div id="main" ng-app="testSiswa" >
	<!-- Content Isi Atas -->
		<div class="no-padd col-md-12" id="homeTop" ng-controller="testSiswa">
			<div class="col-md-12 soal">
				<div class="generateSoal">
					<div class="col-md-12" id="paramMapel" ng-hide="isMulaiTest">
                        <div class="col-md-12 soal" id="inputSoal">
                            <div class="col-md-12 title table-responsive" id="inputSoal" >
                                <table class="table table-bordered" ng-init="loadTestSiswa()">
                                    <thead>
                                    <tr >
                                        <th class="col-md-1 titleGenerate" ><center>Id Test</center></th>
                                        <th class="col-md-5 titleGenerate" ><center>Nama Test</center></th>
                                        <th class="col-md-3 titleGenerate" ><center>Jenis Test</center></th>
                                        <th class="col-md-2 titleGenerate" ><center>Waktu Test</center></th>
                                        <th class="col-md-1 titleGenerate" ><center>Mulai Test</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="test in tests">
                                        <th class="col-md-1 " >{{test.idTest}}</th>
                                        <th class="col-md-5 " >{{test.namaTest}}</th>
                                        <th class="col-md-3 " >{{test.jenisTest}}</th>
                                        <th class="col-md-2 " >{{test.waktuTest}}</th>
                                        <th class="col-md-1">
                                            <a href="#" class="col-md-12" ng-click="mulaiTest(test)">
                                                <span class="glyphicon glyphicon-play-circle col-md-12"></span>
                                            </a>
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <span class="col-md-12 " ng-hide="!isNoSoal"><center>Tidak Ada Angkatan dalam data base</center></span>
                            </div>
                            <div>
                                <span class="col-md-12 " ng-hide="!isNoSoal"><center>{{message}}</center></span>
                            </div>
                            <div>
                                {{response}}
                            </div>
                        </div>
					</div>
					<div id="isiLoop"  ng-hide="!isMulaiTest" ">
						<div class="no-padd col-md-12" id="homeBottom">
							<div class="col-md-12 soal" id="inputSoal">
								<div class="col-md-4 col-md-offset-8 waktu" id="waktu">
									waktu
								</div>
								<div class="divider"></div>
									<div class="col-md-12" id="isiSoal">
										<div class="col-md-1 nomerSoal">
											<span>{{countSoal}}.</span>
										</div>
										<div class="col-md-11 isiSoal" >
											<span>{{isiSoal}}?</span>
										</div>
										<div class="col-md-12 col-md-offset-1">
											<div class="col-md-12 jawaban" ng-hide="!isPilgan">
												<div class="radio">
													<label><input type="radio" name="optradio" ng-model="radioValue" value = "a" ng-change="readyNext()" >A. {{pil1}}</label>
												</div>
												<div class="radio">
													<label><input type="radio" name="optradio" ng-model="radioValue" value = "b" ng-change="readyNext()" >B. {{pil2}}</label>
												</div>
												<div class="radio">
													<label><input type="radio" name="optradio" ng-model="radioValue" value = "c" ng-change="readyNext()" >C. {{pil3}}</label>
												</div>
												<div class="radio">
													<label><input type="radio" name="optradio" ng-model="radioValue" value = "d" ng-change="readyNext()" >D. {{pil4}}</label>
												</div>
                                                <div class="radio">
                                                    <label><input type="radio" name="optradio" ng-model="radioValue" value = "d" ng-change="readyNext()" >e. {{pil5}}</label>
                                                </div>
											</div>
										</div>
                                        <div class="col-md-12" ng-hide="isPilgan">
                                            <div class="form-group col-md-6" ng-hide="isPil1">
                                                <span class="titleGenerate">Point ke 1</span>
                                                <textarea class="form-control textArea" style="height: 50px;" ng-model="pilihan1" placeholder="Essay ke 1"></textarea>
                                            </div>
                                            <div class="form-group col-md-6" ng-hide="isPil2">
                                                <span class="titleGenerate">Point ke 2</span>
                                                <textarea class="form-control textArea" style="height: 50px;" ng-model="pilihan2" placeholder="Essay ke 2"></textarea>
                                            </div>
                                            <div class="form-group col-md-6" ng-hide="isPil3">
                                                <span class="titleGenerate">Point ke 3</span>
                                                <textarea class="form-control textArea" style="height: 50px;" ng-model="pilihan3" placeholder="Essay ke 3"></textarea>
                                            </div>
                                        </div>
									</div>
			
									<div id="btn_inputSoal">
										<div class="col-md-4 col-md-offset-8" id="paramNextPrev">
											<div class="col-md-6 tombolNextPrev">
													<div class="input-group">
														<span class="input-group-btn">
															<button style="background-color: #42a5f5" class="btn btn-sm sharp" type="button" id="buttonGenerateSoal" value="input_soal" name="input_soal" ng-click="nextQuestion()"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"> <strong>Next</strong></span></button>
														</span>
													</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>							
					</div>
					<div id="btn_inputSoal" ng-hide="!isMulaiTest">
						<div class="col-md-1 tombol">
							<div class="input-group">
								<span class="input-group-btn">
									<input style="background-color: #42a5f5; color: white;" class="btn btn-sm sharp" type="submit" id="buttonInputSoal" value="Submit Response" name="submitResponse" ng-click="submitResponFinish()">Ahiri Test</input>
								</span>
							</div>
						</div>
					</div>
					<div>
						{{response}}
					</div>
				</div>		
			</div> <!-- <div class="col-md-12 soal" ng-controller="addSoal"> -->
		</div><!--<div class="no-padd col-md-12" id="homeTop" ng-controller="addSoal" ng-init="loadMapel()">-->	
		<!-- Content Bawah -->
		<div class="no-padd col-md-12" id="homeBottom">
			
		</div>
	</div><!--<div id="main" ng-app="moduleTambahSoal" >-->
</body>

<script>
$(document).ready(function() {

 var detik = 00;
              var menit = 00;
              var jam   = 1;
              
             /**
               * Membuat function hitung() sebagai Penghitungan Waktu
             */
            function hitung() {
                /** setTimout(hitung, 1000) digunakan untuk 
                    * mengulang atau merefresh halaman selama 1000 (1 detik) 
                */
                setTimeout(hitung,1000);
  
               /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
               if(menit < 10 && jam == 0){
                     var peringatan = 'style="color:red"';
               };
 
               /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
               $('#waktu').html(
                      '' + jam + ' : ' + menit + ' : ' + detik + ''
                );
  
                /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                detik --;
 
                /** Jika var detik < 0
                    * var detik akan dikembalikan ke 59
                    * Menit akan Berkurang 1
                */
                if(detik < 0) {
                    detik = 59;
                    menit --;
 
                    /** Jika menit < 0
                        * Maka menit akan dikembali ke 59
                        * Jam akan Berkurang 1
                    */
                    if(menit < 0) {
                        menit = 59;
                        jam --;
 
                        /** Jika var jam < 0
                            * clearInterval() Memberhentikan Interval dan submit secara otomatis
                        */
                        if(jam < 0) {                                                                 
                            clearInterval();  
                        } 
                    } 
                } 
            }           
            /** Menjalankan Function Hitung Waktu Mundur */
            hitung();

});



</script>
<script>var serverVariable=<?=$_SESSION["nis"];?>;</script>

<script src="../../library/js/creartive.js"></script>
</html>

<?php
	}
	else{
		header("location:../../index.php");
	}

?>