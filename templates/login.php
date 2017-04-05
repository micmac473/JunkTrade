
<?php 
session_unset();
include "../lib.php";
session_unset(); 

?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>JunkTrade Login</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <!-- Latest compiled and minified CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Sweetalert CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href ="../css/main.css" rel ="stylesheet">

    <!-- Bootstrap validator -->
    <link href="https://cdnjs.com/libraries/1000hz-bootstrap-validator" rel="styleshet">

    <!-- Scripts-->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <!-- Sweetalert JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- Main JS file-->
    <script src="../js/main.js"></script>

    <!-- Bootstrap validator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<style>
body {
  position: relative;
  margin: 0;
  padding-bottom: 6rem;
  min-height: 100%;
  background-color: #f6f6f6;
  font-family: "Roboto Condensed", sans-serif;
}
body, html{
     height: 100%;
  
      background-size: cover;
} 
form {
  background-color: #FFFFFF;
}
</style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../" style="padding-top: 0; margin:0;"><img alt ="logo" width ="70px" height ="500px" src ="../img/logo.png" class="img-responsive" style="max-height:146%;"></a>
          <a class ="navbar-brand" href ="../">JunkTrade</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
      
            <!--this is not rendering the login page as it shoul -->
            <ul class = "nav navbar-nav navbar-right ">
              <li><a href ="registration.phtml"><span class="glyphicon glyphicon-user"></span> Sign up</a></li>
              <li><a href ="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                
            </ul>
           <!--<ul class="nav navbar-nav navbar-right ">
                <li><button type="button" class="btn btn-primary btn-lg" onclick="window.location='templates/login.html'">login</button></li>
            </ul> -->
         
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
  <div class ="container">
    <div class="jumbotron" style="text-align:center; color: #096790; font-family: 'Oswald', sans-serif;">
      <h1 >Sign in to JunkTrade </h1>
      <h3> Let the trading begin!</h3>
    </div>
    <div class ="row main">
      <div class="main-login main-center">
        <!-- <form class="form-horizontal" onsubmit="return login();" method ="POST" action="index.php/users"> -->
          <form  role="form" data-toggle="validator" onsubmit="return login();">
          <fieldset>
            <!-- Form Name -->

            <div class="form-group has-feedback">
              <label for="username" class="cols-xs-2 control-label">Username or email address</label>
              <div class="cols-xs-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input autofocus type="text" class="form-control" name="email" id="email"  placeholder="Username or email" required/>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                
              </div>
            </div>

            <div class="form-group has-feedback">
              <label for="password" class="cols-xs-2 control-label">Password </label> 
              
              <div class="cols-xs-12">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" data-minlength="6" class="form-control" name="password" id="password"  placeholder="Password" required/>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <a class="pull-right"href ="reset.php" style ="color: blue; text-decoration: none;">Forgot password?</a></small>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <button name="saveBnt" class="btn btn-success btn-block login-button" id="saveBnt" type ="submit">Sign in</button>
                
              </div>
              <div>
                <?php
                  //Facebook 

                  require_once __DIR__ . '/src/Facebook/autoload.php';
                  $fb = new Facebook\Facebook([
                    'app_id' => '552065338336275',
                    'app_secret' => 'fed80c20693c796130702fc8f4be751f',
                    'default_graph_version' => 'v2.4',
                    ]);
                  $helper = $fb->getRedirectLoginHelper();
                  $permissions = ['email']; // optional
                    
                  $helper = $fb->getRedirectLoginHelper();

                  $permissions = ['email']; // Optional permissions
                  $loginUrl = $helper->getLoginUrl('http://localhost:8080/junktrade/templates/facebookSession.php', $permissions);
                  //$loginUrl = $helper->getLoginUrl('http://198.199.66.99/junktrade/templates/facebookSession.php', $permissions);

                  echo '<div class="form-group"> <a href="' . htmlspecialchars($loginUrl) . '" class="btn btn-primary btn-block"><i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i> Login with Facebook</a></div>';
                ?>
              </div>
          </fieldset>
        </form>
        <div class="footer">
          <p> <strong> &copy;2017 JunkTrade. All rights reserved</strong> </p>
        </div>

      </div>
    </div>
  </div>
  <!--FAcebook login -->
<!--footer -->
  
<body>
</html>