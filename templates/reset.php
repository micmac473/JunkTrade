
<?php session_unset();

include "../lib.php";
session_unset(); 
if(isset($_POST['user']) && isset($_POST['sAnswer'])){
  $user = $_POST['user'];
  $answeer = $_POST['sAnswer'];
  //p($post);
  // print "Name: $name, Price:$price, Country: $countryId";
  //$res = checkLogin($email, $password);
  $res = checkSecurityAnswer($user,$answer);
  if($res){
    header('Location: homepage.php');  
  }

}


?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>junkTrade Login</title>
    
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel ="stylesheet" href ="../css/bootstrap-theme.css" >


    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">
    <link href ="../css/main.css" rel ="stylesheet">

    <!-- google font  -->
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet">

    <script src="../bower_components/angular/angular.min.js"></script>
    <script src="../bower_components/angular-route/angular-route.min.js"></script>
    <script src ="../js/jquery-3.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="../js/main.js"></script>
<style>
body {
  position: relative;
  margin: 0;
  padding-bottom: 6rem;
  min-height: 100%;
  background-color: #f6f6f6;
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
          <a class="navbar-brand" href="#"><img alt ="logo" width ="30px" height ="30px" src ="../img/logo.png"></a>
          <a class ="navbar-brand" href ="../">junkTrade</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
      
            <!--this is not rendering the login page as it shoul -->
            <ul class = "nav navbar-nav navbar-right ">
                <li><a href ="login.php">Login</a></li>
            </ul>
            <ul class = "nav navbar-nav navbar-right ">
                <li><a href ="registration.phtml">Sign up</a></li>
            </ul>
           <!--<ul class="nav navbar-nav navbar-right ">
                <li><button type="button" class="btn btn-primary btn-lg" onclick="window.location='templates/login.html'">login</button></li>
            </ul> -->
         
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
  <div class ="container">
    <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">JunkTrade</h2>
    <div class ="row">
      <div class="col-md-8 col-md-offset-2">
        <!-- <form class="form-horizontal" onsubmit="return login();" method ="POST" action="index.php/users"> -->
          <form class="form-horizontal" method ="POST" action="index.php/reset" onsubmit="return reset();">
          <fieldset>
            <!-- Form Name -->
            <legend style="text-align: center">Reset Password</legend>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="email">Username or Email</label>  
              <div class="col-md-4">
              <input name="user" class="form-control input-md" id="user" required="" type="text" placeholder="username / john@example.com">
                
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="pass">Security Answer</label>
              <div class="col-md-4">
                <input name="sAnswer" class="form-control input-md" id="sAnswer" required="" type="password" placeholder="Answer">
                
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="login"></label>
              <div class="col-md-4">
                <button name="saveBnt" class="btn btn-primary btn-block " id="saveBnt" type ="submit">Submit Password Reset</button>
            </div>
              
          </fieldset>
        </form>

      </div>
    </div>
  </div>
  <!--FAcebook login -->

</div>


<!--footer -->
  <div class="footer">
    <p> &copy; JunkTrade 2016 </p>
  </div>
<body>
</html>