
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login CAT</title>
  
  <link rel="stylesheet" href="library/css/reset.min.css">
  <link rel="stylesheet" href="library/node_modules/bootstrap/dist/css/bootstrap.min.css" />    
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="style/styleIndex.css">
  <script src="library/node_modules/angular/angular.min.js"></script>
  <script src="controller/teacher/indexController.js"></script>
</head>

<body>
<div class="container">
  <div class="info">
    <h1>Login CAT System</h1>
  </div>
</div>
<div class="form" ng-app="myapp">
  <div class="thumbnail"><img src="assets/hat.svg"/></div>
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
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="library/js/animateIndex.js"></script>
</body>
</html>
