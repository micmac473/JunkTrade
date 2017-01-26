
<?php session_unset();

include "../lib.php";
session_unset(); 
if(isset($_POST['email']) && isset($_POST['password'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  //p($post);
  // print "Name: $name, Price:$price, Country: $countryId";
  $res = checkLogin($email, $password);
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
          <form class="form-horizontal" method ="POST" action="index.php/login" onsubmit="return login();">
          <fieldset>
            <!-- Form Name -->
            <legend style="text-align: center">Sign in to JunkTrade</legend>

            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="email">Username or Email</label>  
              <div class="col-md-4">
              <input name="email" class="form-control input-md" id="email" required="" type="text" placeholder="johnDoe@example.com">
                
              </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="pass">Password</label>
              <div class="col-md-4">
                <input name="password" class="form-control input-md" id="password" required="" type="password" placeholder="password">
                
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="login"></label>
              <div class="col-md-4">
                <button name="saveBnt" class="btn btn-primary btn-block " id="saveBnt" type ="submit">Sign in</button>
                <a href ="#" style ="color: blue; text-decoration: none;">Forgot password?</a>
              </div>
            </div>
              
          </fieldset>
        </form>

      </div>
    </div>
  </div>
  <!--FAcebook login -->

</div>

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
  
try {
  if (isset($_SESSION['facebook_access_token'])) {
    $accessToken = $_SESSION['facebook_access_token'];
  } else {
      $accessToken = $helper->getAccessToken();
  }
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
 }
if (isset($accessToken)) {
  if (isset($_SESSION['facebook_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  } else {
    // getting short-lived access token
    $_SESSION['facebook_access_token'] = (string) $accessToken;
      // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();
    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
    $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
  }
  // redirect the user back to the same page if it has "code" GET variable
  if (isset($_GET['code'])) {
    header('Location: ./');
  }
  // getting basic info about user
  try {
    $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
    $profile = $profile_request->getGraphNode()->asArray();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    // redirecting user back to app login page
    header("Location: ./");
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  
  // printing $profile array on the screen which holds the basic info about user
  print_r($profile);
    // Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
  // replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
  $loginUrl = $helper->getLoginUrl('http://localhost:8080/JunkTrade/templates/homepage.php', $permissions);
  echo ' <div class ="container">
  <div class = "row">
    <div class="col-md-8 col-md-offset-2">
<a href="' . $loginUrl . '" class="btn btn-block btn-social btn-facebook">
    <span class="fa fa-facebook"></span> Sign in with Facebook</a>
    </div>

  </div>';
}
 
?>
<!--footer -->
  <div class="footer">
    <p> &copy; JunkTrade 2016 </p>
  </div>
<body>
</html>