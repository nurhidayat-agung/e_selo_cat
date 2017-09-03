<?php 
    include('../../php/angkatan/loadAngkatanSiswa.php');
    include('../../php/pleton/loadPletonSiswa.php');
?>
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
                <span id="nama"><h4 style="margin-bottom: 0px;"><?php echo $_SESSION['idUser']; ?></h4></span><br />
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
            <div class="col-md-4 data"">
            <div class="dataIn">
                <div class="col-md-12" id="dataUser">
                    <i class="fa fa-user-circle-o"></i>
                </div>
                <div class="col-md-12" id="jumlahUser">
                    <span>200</span>
                    <div class="divider"></div>
                    <button  data-toggle="modal" data-target="#exampleModal"  data-nis="<?=$_SESSION["nis"];?>" data-namasiswa="<?=$_SESSION["idUser"];?>" data-password="<?=$_SESSION["password"];?>"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>   change my Profile</button>
                </div>
            </div>
            </div>
            <a href="test.php">
                <div class="col-md-4 data">
                    <div class="dataIn">
                        <div class="col-md-12" id="dataSoal">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <div class="col-md-12" id="jumlahSoal">
                            <span>200</span>
                            <div class="divider"></div>
                            <span>Test</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="response.php">
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
                        <table class="table ">
                            <thead>
                            <tr>
                                <th><label>NIS</label></th>
                                <th>: {{nis}}</th>
                            </tr>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>: {{namaSiswa}}</th>
                            </tr>
                            <tr>
                                <th>Angkatan</th>
                                <th>: {{namaAngkatan}}</th>
                            </tr>
                            <tr>
                                <th>Pleton</th>
                                <th>: {{namaPleton}}</th>
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
                                <td>{{respon.namaTest}}</td>
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                      </div>
                      <form action="../../php/siswa/editProfile.php" method="post">
                      <div class="modal-body">            
                          <div class="form-group">
                            <input type="hidden" class="form-control" id="nis" name="nis">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="control-label">Nama Siswa:</label>
                            <input type="text" class="form-control" id="namaSiswa" name="namaSiswa">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="control-label">Password :</label>
                            <input type="text" class="form-control" id="password" name="password">
                          </div>
                          <div class="form-group">
                            <select name="idAngkatan" ng-model="idAngkatan" class="form-control" required="true">
                                <option value="">Pilih Angkatan </option>
                                    <?php foreach ($angkatan as $key) { ?>                                                    
                                <option value="<?php echo $key['idAngkatan']; ?>"><?php echo $key['namaAngkatan']; ?></option>
                                    <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <select name="idPleton" ng-model="idPleton" class="form-control" required="true">
                                <option value="">Pilih Pleton </option>
                                    <?php foreach ($pleton as $key) { ?>                                       
                                <option value="<?php echo $key['idPleton']; ?>"><?php echo $key['namaPleton']; ?></option>
                                                      <?php } ?>
                            </select>
                          </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin untuk edit Profile???');">SIMPAN</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div> 
        </div>
        <!-- Content Bawah -->
    </div>
    </body>
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var nis = button.data('nis')
          var namaSiswa = button.data('namasiswa')
          var password = button.data('password')
           // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('.modal-title').text('Edit Profile dengan NIS: ' + nis)
       
          modal.find('.modal-body #nis ').val(nis)
          modal.find('.modal-body #namaSiswa ').val(namaSiswa)
          modal.find('.modal-body #password ').val(password)
        })
    </script>
    <script>var serverVariable=<?=$_SESSION["nis"];?>;</script>
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