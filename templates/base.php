<?php
if(!isset($_SESSION)){
  session_start();
}

$currentPage = getCurrentPage();

function getCurrentPage(){
  $currentPage = basename($_SERVER['PHP_SELF']);
  $page = "";
  if(stripos($currentPage,"homepage") !== false)
    $page = "Homepage";
  else if(stripos($currentPage,"profile") !== false)
    $page = "Profile";
  else if(stripos($currentPage,"notifications") !== false)
    $page = "Notifications";
  else if(stripos($currentPage,"trader") !== false)
    $page = "Trader Detail";
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
    $page = "Item Detail";
  

  return $page;
  $ppid = $SESSION['id'];
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
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

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

      .dropdown-menu > li{
    padding:50px;
}
    
    </style>
</head>
<body>
  <div id="wrapper">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand btn btn-link btn-menu toggle" id="menu-toggle" href="#" style="padding-left:0.2em; padding-right:0.2em;"><i class="fa fa-bars"></i>  </a>
        <a class="navbar-brand" href="homepage.php" style="padding-left:0;padding-top: 0; margin:0;"><img alt ="logo" width ="70px" height ="500px" src ="../img/logo.png" class="img-responsive" style="max-height:146%;"></a>
        <a href="#" class="navbar-brand" style="color: white;font-family: 'Roboto Condensed', sans-serif; padding-left:0.2em; padding-right:0.2em;"><?php echo $currentPage ?></a>
        
        <!--<a class="navbar-brand" href ="homepage.php">JunkTrade</a> -->
        <!--<a class ="navbar-brand" href ="homepage.php">junkTrade</a> -->
      </div>

      <div id="mynavbar" class="navbar-collapse collapse">
        
        
        <ul class="nav navbar-nav navbar-right">
          <li> <a href="#" data-toggle="tooltip" title="Upload Item" data-placement="bottom" onclick="toggler('uploadItem');" style="padding-left:1em;"> <i class="fa fa-plus" aria-hidden="true"></i><i class="fa fa-file-image-o fa-lg" aria-hidden="true"></i> </a></li>
          <?php
          $ppid = $_SESSION["id"]; 
          echo '<li style="padding-top: 7px"> <img class="img-circle" alt ="profilepicture" width ="40px" height ="40px" src ='. getProfilePictureNavBar($ppid).'> </li>'
          ?>
          <li class="dropdown" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 0.1em">
              <?php
                echo '<strong>'.$_SESSION['user'].'</strong>';
              ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="profile.php"><i class="fa fa-user" aria-hidden="true" ></i> Profile</a></li>
              <li><a href="#" onclick="logout();"><i class="fa fa-sign-out" aria-hidden="true" ></i> Logout</a></li>
              <!-- <li><a href="google.com">Help</a></li> -->
            </ul>
          </li>
          
          <li class="dropdown">
            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell fa-lg" aria-hidden="true" ></i><span class="badge badge-notify" id ="requestsNotify"></span></a>
            <ul class="dropdown-menu" id="requests" style="padding: 50">
                <!-- <li><a href="#">Dynamically Populated Requets</a></li> -->
                
            </ul>

          </li>
          <li class="dropdown">
            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gavel fa-lg" aria-hidden="true" ></i><span class="badge badge-notify" id ="decisionsNotify"></span></a>
            <ul class="dropdown-menu" id="decisions" >
                <!-- <li><a href="#">Dynamically Populated Requets</a></li> -->
                
            </ul>

          </li>

          <li class="dropdown">
            <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-comment fa-lg" aria-hidden="true" ></i><span class="badge badge-notify" id ="chatNotify"></span></a>
            <ul class="dropdown-menu" id="messages">
                <!-- <li><a href="#">Dynamically Populated Requets</a></li> -->
                
            </ul>

          </li>
          
        </ul>


        <form method = "post" class="navbar-form" role="form" action ="search.php?go" id ="searchform">
          <div class="form-group" style="display:inline;">
            <div class="input-group" style="display:table;">
              <span class="input-group-addon search-panel" class="btn btn-default" style="width:1%;">
                <button type="button" class="btn btn-link dropdown-toggle btn-xs" data-toggle="dropdown" style="text-decoration: none; color: grey">
                  <span id="search_concept"><i class="fa fa-filter" aria-hidden="true" style="color: #096790;"></i> Filter by</span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#item"><i class="fa fa-gift" aria-hidden="true" style="color: #096790;"></i> Items</a></li>
                  <li><a href="#user"><i class="fa fa-user" aria-hidden="true" style="color: #096790;"></i> Traders</a></li>
                </ul>
                <input type="hidden" name="search_param" value="item" id="search_param">
              </span>
              <input autofocus class="form-control" name="searchname" placeholder="Search JunkTrade" autocomplete="off" autofocus="autofocus" type="text" required>
              <span class="input-group-addon" class="btn btn-default" style="width:1%;" name="searchsubmit">
                <button type="submit" class="btn btn-link btn-xs" name="searchsubmit" value="Search">
                  <i class="fa fa-search fa-fw" style="color: #096790;"></i>
                </button>
              </span>
            </div>
          </div>
        </form>



      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
              <?php 
                if($currentPage == "Homepage"){
                  echo"<li style='background-color: #096790;'> <a href='homepage.php' style='color: white'><i class='fa fa-home fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Home</a>";
                }
                else{
                  echo "<li><a href='homepage.php'><i class='fa fa-home fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Home</a>";
                }     
              ?>
                
                </li>

              <?php 
                if($currentPage == "Profile"){
                  echo"<li style='background-color: #096790;'> <a href='profile.php' style='color: white'><i class='fa fa-user fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profile</a>";
                } 

                else{
                  echo "<li><a href='profile.php'><i class='fa fa-user fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profile</a>";
                }    
              ?>
    
                </li>

              <?php 
                if($currentPage == "Notifications"){
                  echo"<li style='background-color: #096790;'><a href='notifications.php' style='color: white'><i class='fa fa-bell fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Notifications</a>";
                } 

                else{
                  echo "<li><a href='notifications.php'><i class='fa fa-bell fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Notifications</a>";
                }    
              ?>
                </li>


              <?php 
                if($currentPage == "Requests"){
                  echo"<li style='background-color: #096790;'><a href='trade.php' style='color: white'><i class='fa fa-gavel fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Requests</a>";
                } 

                else{
                  echo "<li><a href='trade.php'><i class='fa fa-gavel fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;Requests</a>";
                }    
              ?>
                </li>


              <?php 
                if($currentPage == "People"){
                  echo"<li style='background-color: #096790;'><a href='people.php' style='color: white'><i class='fa fa-users fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;People</a>";
                } 

                else{
                  echo "<li><a href='people.php'><i class='fa fa-users fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;People</a>";
                }    
              ?>
          
                </li>
              <?php 
                if($currentPage == "Saved"){
                  echo"<li style='background-color: #096790;'><a href='saved.php' style='color: white'><i class='fa fa-bookmark fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saved</a>";
                } 

                else{
                  echo "<li><a href='saved.php'><i class='fa fa-bookmark fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saved</a>";
                }    
              ?>
                </li>


              <?php 
                if($currentPage == "Meetup"){
                  echo"<li style='background-color: #096790;'><a href='meetup.php' style='color: white'><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meetup</a>";
                } 

                else{
                  echo "<li><a href='meetup.php'><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meetup</a>";
                }    
              ?>
                </li>

              <?php 
                if($currentPage == "History"){
                  echo"<li style='background-color: #096790;'><a href='history.php' style='color: white'><i class='fa fa-hourglass fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;History</a>";
                } 

                else{
                  echo "<li><a href='history.php'><i class='fa fa-hourglass fa-lg' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;History</a>";
                }    
              ?>
                </li>
                <li>
                    <a href="" onclick="return logout();"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
                </li>

                
                
                <li class="footerHome">
                  <p><strong> &copy;2017 JunkTrade. All rights reserved</strong></p>
                </li>
            </ul>
        </div>
    <?php 
    if($currentPage != "Trader" && $currentPage != "Profile" && $currentPage != "Trader Detail"){

      ?>
      <div class="container-fluid" style="">
        <div class="row text-center">
          <div id ="greeting" class="page-header col-xs-12" style="margin-top: 0; border-color: white; border-width: 2px; padding:0">
            <h1 style="color:#096790;text-shadow: 4px 3px white; font-family: 'Lobster', cursive; "> 
              <?php  
                date_default_timezone_set("America/Grenada");
                $hour = date("H");
                  //echo $hour;
                  //$hour = 6;
                if($hour >= 0 && $hour < 12){
                  if($hour < 6){
                    echo "Good Morning, ".$_SESSION["user"]."! <i class='wi wi-moonset'></i>";
                  }
                  else if ($hour >=6 && $hour <=7){
                    echo "Good Morning, ".$_SESSION["user"]."! <i class='wi wi-sunrise'></i>";
                  }
                  else{
                    echo "Good Morning, ".$_SESSION["user"]."! <i class='wi wi-day-sunny'></i>";
                  }  
                }
                else if($hour >= 12 && $hour < 18){
                  echo "Good Afternoon, ". $_SESSION["user"]. "! <i class='wi wi-day-sunny'></i>";
                }
                else{
                  if($hour == 18){
                    echo "Good Evening, ". $_SESSION["user"]. "! <i class='wi wi-sunset'></i>";
                  }
                  else{
                    echo "Good Evening, ". $_SESSION["user"]. "! <i class='wi wi-night-clear'></i>";
                  }  
                }
              ?>
            </h1>

          </div>
        </div>
      </div>
  <?php
  }
  ?>

  <?php
  
  if($currentPage == "Profile"){
      $userRating = getUserRating($_SESSION["id"]);
      //print_r($userRating);
      if($userRating[0][0] == null)
        $rating = $userRating[1][0];
      else if($userRating[1][0]==null)
        $rating = $userRating[0][0];
      else
        $rating = ($userRating[0][0] + $userRating[1][0])/2.0;
      $rating = number_format($rating, 1);
      //print_r($rating);
      ?>
      <div class="jumbotron container-fluid">
        <div class="row text-center">
          <div class="col-lg-2 col-md-1 col-sm-1 col-xs-12">
            <?php   
              $ppid = $_SESSION["id"];       
              echo "<a href='#' onclick=\"viewProfileImage(".$ppid.")\">" .getProfileImage($ppid)."</a>"; 
                //echo $_SESSION["id"];  
            ?>
          </div>
          <div class="col-lg-10 col-md-11 col-sm-11 col-xs-12">
            <h1 style="color:#096790 ;text-shadow: 4px 3px white;font-family: 'Lobster', cursive;"> 
              <?php  
                date_default_timezone_set("America/Grenada");
                $hour = date("H");
                  //echo $hour;
                  //$hour = 6;
                if($hour >= 0 && $hour < 12){
                  if($hour < 6){
                    echo "Good Morning, ".$_SESSION["user"]."! <i class='wi wi-moonset'></i>";
                  }
                  else if ($hour >=6 && $hour <=7){
                    echo "Good Morning, ".$_SESSION["user"]."! <i class='wi wi-sunrise'></i>";
                  }
                  else{
                    echo "Good Morning, ".$_SESSION["user"]."! <i class='wi wi-day-sunny'></i>";
                  }  
                }
                else if($hour >= 12 && $hour < 18){
                  echo "Good Afternoon, ". $_SESSION["user"]. "! <i class='wi wi-day-sunny'></i>";
                }
                else{
                  if($hour == 18){
                    echo "Good Evening, ". $_SESSION["user"]. "! <i class='wi wi-sunset'></i>";
                  }
                  else{
                    echo "Good Evening, ". $_SESSION["user"]. "! <i class='wi wi-night-clear'></i>";
                  }  
                }
              ?>
            </h1>
          </div>
          <a href='#' data-toggle='tooltip' data-html='true' title= '<?php echo $rating. " out of 5 stars <br>  Trades: ". $trades?>' data-placement='bottom'><input  type='hidden' class='rating' data-filled='fa fa-star fa-3x' data-empty='fa fa-star-o fa-3x' data-readonly value= <?php echo $rating ?> ></a>
        </div>
      </div>
  <?php
  }
  ?>


<!-- Add Item -->
  <div class ="row col-lg-12 col-md-12 col-sm-12 col-xs-12" style ="display:none" id ="uploadItem">
    <div class ="">
      <form class="form-horizontal" action ="profile.php" enctype="multipart/form-data" method ="POST">
      <!-- <form class="form-horizontal" action ="index.php/additem" enctype="multipart/form-data" method ="POST" onsubmit="return addItem();"> -->
        <fieldset>
          <legend style="text-align:center">Upload a New Item</legend>
            <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Image 1 </label>
              <div class="col-md-6">
                <input name="itemImages[]"  class="input-file" id="image" type="file" accept="image/*" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Image 2 </label>
              <div class="col-md-6">
                <input name="itemImages[]" class="input-file" id="image2" type="file" accept="image/*">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Image 3 </label>
              <div class="col-md-6">
                <input name="itemImages[]" class="input-file" id="image3" type="file" accept="image/*">
              </div>
            </div>

            <!-- Input -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="ItemDescription">Item Name</label>
              <div class="col-md-6">                     
                <input  autofocus name="itemname"  class="form-control" id="itemname" type="text" placeholder="Item Name" required="" maxlength="50" autofocus="autofocus">
              </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="ItemDescription">Item Description</label>
              <div class="col-md-6">                     
                <textarea name="itemdescription" class="form-control" rows="5" id="itemdescription" placeholder="Tell us about your item" required=""></textarea>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="upload"></label>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-lg-6">
                    <button type ="submit" name="upload" class="btn btn-success btn-block" id="upload"><i class="fa fa-upload" aria-hidden="true"></i>  Upload Item</button>
                  </div>
                  <div class="col-lg-6">
                    <button type="button" onclick ="hideForm();" class="btn btn-warning btn-block" ><i class="fa fa-ban" aria-hidden="true"></i>  Cancel</button>
                  </div>
                </div>
              </div>
            </div>

          </fieldset>
        </form>
    </div>
  </div>


<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

<!-- Item Request Modal -->
  <div class="modal fade" id="requestModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title text-center">Request <i class="fa fa-envira" aria-hidden="true"></i></h2>
        </div>
        <div class="modal-body">
          <form class="" onsubmit="return sendRequest();">
            <fieldset>

            <div class="form-group">
              <label class="control-label" for="name">Item Owner</label>
              <div class="">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input id="requestee" name="requestee" type="text" disabled placeholder="Item Owner" class="form-control input-md" required="">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="name">Owner's Item</label>
              <div class="">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                  <input id="requesteeitem" name="requesteeitem" type="text" disabled placeholder="Requested Item" class="form-control input-md" required="">
                </div>
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="control-label" for="selectbasic">Your Items (Available)</label>
              <div class="">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                  <select id="requesteritem" name="requesteritem" class="form-control" required=""> 

                  </select>
                </div>
              </div>
            </div>

            <div class="form-group"> 
                <label class="control-label" for="date">Your Phone Number</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                    <input class="form-control" id="requestercontact" name="requestercontact" type="text" placeholder="868-123-4567"required pattern="\d{3}[\-]\d{3}[\-]\d{4}"/>
                  </div>
                  <small><span class="help-block">Format: 868-123-4567</span></small>
                </div>
              </div> 
            <div class="form-group">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <button  class="btn btn-success btn-block" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Request</button>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <button  onclick="return cancelRequest();" class="btn btn-danger btn-block" data-dismiss="modal" > <i class="fa fa-ban" aria-hidden="true"></i> Cancel Request</button>
              </div>
            </div>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Chat Modal -->
  <div class="modal fade" id="chatmodal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content" >
        <div class="modal-body" >
          <form class="form" id="chatform" onsubmit="return sendMessage();">
            <fieldset>

              <div class="modal-header" style="background-color:#096790; color: white">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close" aria-hidden="true"></i></button>
                <h2 class="modal-title" style="text-align: center" ><i class="fa fa-comment" aria-hidden="true"></i> <span id="tradername"></span> <small><em><span id="traderstatus" style="color: white">  </span></em></small> </h2>
             </div>

              <input id="traderusername" name="traderusername" type="hidden" disabled class="form-control input-md">
              <input id="userid" name="userid" type="hidden" disabled class="form-control input-md">
              <input id="traderid" name="traderid" type="hidden" disabled class="form-control input-md">
              <!-- <div class="form-group">
                <div class="">                     
                  <textarea class="form-control"  id="messages" rows="10" name="messages" readonly="readonly"></textarea>
                </div>
              </div> -->

              <div class="form-group" style="background-color:white">
                <div class="">                     
                  <div id="divmessages" style="overflow-y: scroll; height: 250px;">
                  </div>
                </div>
              </div>
              <div class="form-group" >
                <div class="row" >
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <input autofocus class="form-control" type="text" id="message" maxlength="200" placeholder="Message" autocomplete="off"  required/>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <button class="btn btn-primary btn-block" type="submit">Send</button> 
                  </div>     
                </div>
              </div>

            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Image Modal -->
  <div class="modal fade" id="profilepicturemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      
        <img src="" id="profilepicture" class="img-responsive" style="width: 100%;" >
    </div>
  </div>
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

