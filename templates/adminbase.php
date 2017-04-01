<?php
if(!isset($_SESSION)){
  session_start();
}

$currentPage = getCurrentPage();

function getCurrentPage(){
  $currentPage = basename($_SERVER['PHP_SELF']);
  $page = "";
  if(stripos($currentPage,"admin") !== false)
    $page = "Dashboard";
  else if(stripos($currentPage,"profile") !== false)
    $page = "Profile";
  else if(stripos($currentPage,"notifications") !== false)
    $page = "Notifications";
  else if(stripos($currentPage,"trader") !== false)
    $page = "Trader";
  else if(stripos($currentPage,"trade") !== false)
    $page = "Requests";
  else if(stripos($currentPage,"people") !== false)
    $page = "People";
  else if(stripos($currentPage,"saved") !== false)
    $page = "Saved";
  else if(stripos($currentPage,"meetup") !== false)
    $page = "Meetup";
  else if(stripos($currentPage,"search") !== false)
    $page = "Search";
  else if(stripos($currentPage,"history") !== false)
    $page = "History";
  else if(stripos($currentPage,"item") !== false)
    $page = "Item";
  

  return $page;
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>JunkTrade</title>

    <!-- google font  -->
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <!-- Latest compiled and minified CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Sweetalert CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href ="../css/main.css" rel ="stylesheet">

    <link href ="../css/bootstrap-rating.css" rel ="stylesheet">

    <!-- Weather Icons CSS -->
    <link href ="../css/weather-icons.min.css" rel ="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
    <!-- Scripts-->
    <!-- AngularJS JavaScript file  
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script> -->

    <!-- AngularJS Route module 
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script> -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Pusher 
    <script src="//js.pusher.com/3.1/pusher.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <!-- Sweetalert JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- Main JS file-->
    <script src="../js/main.js"></script>

     <!-- Bootstrap rating -->
    <script src="../js/bootstrap-rating.js"></script>

     <!-- Bootstrap Datepicker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <!-- Backand SDK 
    <script src="//cdn.backand.net/vanilla-sdk/1.0.9/backand.js"></script>
    <script src="//cdn.backand.net/angular1-sdk/1.9.5/backand.provider.js"></script>  -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="../js/moment.js"></script>

    <style>
      ./*city{
        background-image:url(http://www.buyandsellnow.ca/wp-content/uploads/2016/06/3d_banner_background.png);
        
      } */
    </style>
</head>
<body>
  <div id="wrapper">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a id="menu-toggle" href="#"><i class="navbar-brand btn-menu toggle fa fa-bars fa-lg" aria-hidden="true"></i>  </a>
        <a class="navbar-brand" href="homepage.php" style="padding-top: 0; margin:0;"><img alt ="logo" width ="70px" height ="500px" src ="../img/logo.png" class="img-responsive" style="max-height:146%;"></a>
        
        <!--<a class="navbar-brand" href ="homepage.php">JunkTrade</a> -->
        <!--<a class ="navbar-brand" href ="homepage.php">junkTrade</a> -->
      </div>

      <div id="navbar" class="navbar-collapse collapse">
        <span class="navbar-brand" style="color: white;font-family: 'Roboto Condensed', sans-serif;"><?php echo $currentPage ?></span>
        <!--  <ul class="nav navbar-nav">

         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="">Electronics</a></li>
              <li><a href="#">Furniture</a></li>
              <li><a href="#">Books & Magazines</a></li>
              <li><a href="#">Clothes</a></li>
            </ul>
          </li>
        </ul> -->

        <!--<form class="navbar-form navbar-left" role="form" action ="search.php?go">
          <div class="form-group">
            <input type="text" placeholder="Search for Junk" class="form-control" name="searchname">
          </div>
          <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true" name="searchsubmit"></i></button>
        </form> -->

        <ul class="nav navbar-nav navbar-right">
          

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle fa-lg" aria-hidden="true" ></i>
              <?php
                echo $_SESSION['user'];
              ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#" onclick="logout();"><i class="fa fa-sign-out" aria-hidden="true" ></i> Logout</a></li>
              <!-- <li><a href="google.com">Help</a></li> -->
            </ul>
          </li>
          
        </ul>


      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
              <?php 
                if($currentPage == "Dashboard"){
                  echo"<li style='background-color: #096790;'> <a href='homepage.php' style='color: white'><i class='fa fa-cogs fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a>";
                }
                else{
                  echo "<li><a href='homepage.php'><i class='fa fa-cogs fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a>";
                }     
              ?>
                
                </li>

              <?php 
                if($currentPage == "Profile"){
                  echo"<li style='background-color: #096790;'> <a href='profile.php' style='color: white'><i class='fa fa-users fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users</a>";
                } 

                else{
                  echo "<li><a href='profile.php'><i class='fa fa-users fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users</a>";
                }    
              ?>
    
                </li>

              <?php 
                if($currentPage == "Notifications"){
                  echo"<li style='background-color: #096790;'><a href='notifications.php' style='color: white'><i class='fa fa-bell fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Notifications</a>";
                } 

                else{
                  echo "<li><a href='notifications.php'><i class='fa fa-gift fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Items</a>";
                }    
              ?>
                </li>


              <?php 
                if($currentPage == "Requests"){
                  echo"<li style='background-color: #096790;'><a href='trade.php' style='color: white'><i class='fa fa-gavel fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Requests</a>";
                } 

                else{
                  echo "<li><a href='trade.php'><i class='fa fa-gavel fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Requests</a>";
                }    
              ?>
                </li>

                <li>
                    <a href="" onclick="return logout();"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
                </li>

                
                
                <li class="footerHome">
                  <p><strong> &copy;2017 JunkTrade. All rights reserved</strong></p>
                </li>
            </ul>
        </div>
     
    



<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({html: true}); 

    $('.search-panel .dropdown-menu').find('a').click(function(e) {
    e.preventDefault();
    var param = $(this).attr("href").replace("#","");
    var concept = $(this).text();
    $('.search-panel span#search_concept').text(concept);
    $('.input-group #search_param').val(param);
  });  
  });


  $('#chatmodal').on('shown.bs.modal', function() {
    $('#message').focus();
    var element = document.getElementById("divmessages");
    element.scrollTop = element.scrollHeight;
  })

</script>

