
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login CAT</title>
  
  <link rel="stylesheet" href="library/css/reset.min.css">
  <link rel="stylesheet" href="library/node_modules/bootstrap/dist/css/bootstrap.min.css" />   

  <!-- font --> 
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='assets/fonts/font-montserrat.css'>
  <link rel='stylesheet prefetch' href='library/fonts/font-awesome.min.css'>
    <!-- font -->

  <link rel="stylesheet" href="style/styleIndex.css">
  <script src="library/node_modules/angular/angular.min.js"></script>
  <script src="controller/teacher/indexController.js"></script>
<!--   <style type="text/css">
    .container {
        width: 1000px; 
        height: 100%; 
        max-width: none;
        border:1px solid;
        vertical-align: top;
        position: relative;
       
      }

      .image {
        background-image: url('assets/background-1.jpg'); 
        position: relative;
      }

      .overlay:before{
        position: absolute;
        content:" ";
        top:0;
        left:0;
        width:100%;
        height:100%;
        display: block;
        z-index:0;
        background-color: rgba(100,19,0,0.5);
      }

    }
  </style> -->
</head>

<body style="background-color: lightgrey;" >
<nav class="navbar navbar-default" style="background-color: #4d79ff;">
  <div class="container-fluid">
    <div class="navbar-header" style="height: 100px; color: white;">
        <b><strong><h1 style="padding-top: 10px;">E-SELO</h1></strong></b>
        <b><strong>Electronics System Examination Object </strong></b>  
    </div>
    <p class="navbar-text navbar-right" style="padding-right: 40px;">
      <img src="assets/lemdikpol.png" height="100px" width="70px">
    </p>
  </div>
</nav>
<div class="container" style="max-width: 450px;">
<div class="form" ng-app="myapp" style="max-width: none;">
  <h1 style="color: #4d79ff;;">Students Login</h1>
  <div class="thumbnail" style="padding: 20px 30px"><img src="assets/sekpol.png"/></div>
  <form class="register-form" ng-controller="cRegis" name="formRegis">
    <input type="text" placeholder="username" name="username" ng-model="username" ng-change="change()" required class="form-username"/>
    <span ng-style="myStyle" ng-hide="!isusername">{{message}}</span>
    <input type="password" placeholder="password" name="password" ng-model="password" required ng-disabled="isusername" style=" margin-top: 20px"/>
    <input type="text" placeholder="Nama Terang" name="nama" ng-model="nama" required ng-disabled="isusername"/>
    <select class="form-control" 
            ng-model="job"
            ng-options="job for job in jobs"
            ng-init="job = jobs[0]"
            required
            ng-disabled="isusername">
    </select>
    <input type="email" placeholder="example@comapny" name="email" ng-model="email" required ng-disabled="isusername"/>
    <button ng-disabled="formRegis.$invalid" ng-click="insertData()" class ="myBtn" disabled>create</button>
    <p class="message">Already registered? <a href="#">Sign In</a></p>
  </form>
  <form class="login-form" method="post"  ng-controller="cLogin">
    <input type="text" placeholder="username" required="true" name="username" ng-model="lUsername"/>
    <input type="password" placeholder="password" required="true" name="password" ng-model="lPassword"/>
    <button type="submit" ng-click="login()">login</button>
    <p class="message">Not registered? <a href="#">Create an account</a></p>
  </form>
</div>

</div>
  <script src='library/js/jquery-2-1-3.min.js'></script>
    <script src="library/js/animateIndex.js"></script>
</body>
</html>
