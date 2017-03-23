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
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900" rel="stylesheet">

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
    <!-- AngularJS JavaScript file  -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <!-- AngularJS Route module -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>

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

    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>

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
        <span class="navbar-brand" style="color: white;text-shadow: 1px 1px #096790;"><strong> <?php echo $currentPage ?></strong></span>
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
          <li> <a href="#" data-toggle="tooltip" title="Upload Item" data-placement="bottom" onclick="showForm();"> <i class="fa fa-plus" aria-hidden="true"></i><i class="fa fa-file-image-o fa-2x" aria-hidden="true"></i> </a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle fa-2x" aria-hidden="true" ></i>
              <?php
                echo $_SESSION['user'];
              ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="profile.php"><i class="fa fa-user" aria-hidden="true" ></i> Profile</a></li>
              <li><a href="#" onclick="logout();"><i class="fa fa-sign-out" aria-hidden="true" ></i> Logout</a></li>
              <!-- <li><a href="google.com">Help</a></li> -->
            </ul>
          </li>
          
          <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell fa-2x" aria-hidden="true" ></i><span class="badge badge-notify" id ="requestsNotify"></span></a>
            <ul class="dropdown-menu" id="requests">
                <!-- <li><a href="#">Dynamically Populated Requets</a></li> -->
                
            </ul>

          </li>
          <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gavel fa-2x" aria-hidden="true" ></i><span class="badge badge-notify" id ="decisionsNotify"></span></a>
            <ul class="dropdown-menu" id="decisions">
                <!-- <li><a href="#">Dynamically Populated Requets</a></li> -->
                
            </ul>

          </li>

          <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-comment fa-2x" aria-hidden="true" ></i><span class="badge badge-notify" id ="chatNotify"></span></a>
            <ul class="dropdown-menu" id="messages">
                <!-- <li><a href="#">Dynamically Populated Requets</a></li> -->
                
            </ul>

          </li>
          
        </ul>


        <form method = "post" class="navbar-form" role="form" action ="search.php?go" id ="searchform">
        <div class="form-group" style="display:inline;">
          <div class="input-group" style="display:table;">

                  <span class="input-group-addon search-panel" class="btn btn-default" style="width:1%;">
                    <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">
                  <span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#item">Items</a></li>
                      <li><a href="#user">Traders</a></li>
                    </ul>
                    <input type="hidden" name="search_param" value="item" id="search_param">
                  </span>


            <input autofocus class="form-control" name="searchname" placeholder="Search for Junk" autocomplete="off" autofocus="autofocus" type="text">
            <span class="input-group-addon" class="btn btn-default" style="width:1%;" name="searchsubmit">
              <button type="submit" class="btn btn-default btn-xs" name="searchsubmit" value="Search">
                <i class="fa fa-search fa-fw"></i>
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
                  echo"<li style='background-color: #bdbdbd;'>";
                }
                else{
                  echo "<li>";
                }     
              ?>
                <a href="homepage.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Home</a>
                </li>

              <?php 
                if($currentPage == "Profile"){
                  echo"<li style='background-color: #bdbdbd;'>";
                } 

                else{
                  echo "<li>";
                }    
              ?>
                    <a href="profile.php"><i class="fa fa-user fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profile</a>
                </li>

              <?php 
                if($currentPage == "Notifications"){
                  echo"<li style='background-color: #bdbdbd;'>";
                } 

                else{
                  echo "<li>";
                }    
              ?>
                    <a href="notifications.php"><i class="fa fa-bell fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Notifications</a>
                </li>


              <?php 
                if($currentPage == "Requests"){
                  echo"<li style='background-color: #bdbdbd;'>";
                } 

                else{
                  echo "<li>";
                }    
              ?>
                    <a href="trade.php"><i class="fa fa-gavel fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Requests</a>
                </li>


              <?php 
                if($currentPage == "People"){
                  echo"<li style='background-color: #bdbdbd;'>";
                } 

                else{
                  echo "<li>";
                }    
              ?>
                    <a href="people.php"><i class="fa fa-users fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;People</a>
                </li>
              <?php 
                if($currentPage == "Saved"){
                  echo"<li style='background-color: #bdbdbd;'>";
                } 

                else{
                  echo "<li>";
                }    
              ?>
                    <a href="saved.php"><i class="fa fa-bookmark fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saved</a>
                </li>


              <?php 
                if($currentPage == "Meetup"){
                  echo"<li style='background-color: #bdbdbd;'>";
                } 

                else{
                  echo "<li>";
                }    
              ?>
                    <a href="meetup.php"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meetup</a>
                </li>

              <?php 
                if($currentPage == "History"){
                  echo"<li style='background-color: #bdbdbd;'>";
                } 

                else{
                  echo "<li>";
                }    
              ?>
                    <a href="history.php" ><i class="fa fa-hourglass fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;History</a>
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
    if($currentPage != "Trader"){

      ?>
      <div class="jumbotron container-fluid">
        <div class="container-fluid">
          <div class="row text-center">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
              <?php   
                $ppid = $_SESSION["id"];         
                echo getProfileImage($ppid);      
              ?>
            </div>
            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
              <h1 style="color:#096790 ;text-shadow: 2px 2px white;font-family: 'Fira Sans', sans-serif;"> 
                <?php  
                  date_default_timezone_set("America/Grenada");
                  $hour = date("H");
                  //echo $hour;
                  //$hour = 6;
                  if($hour >= 0 && $hour < 12){
                    if($hour < 6){
                      echo "Good Morning, ".$_SESSION["user"]."!= <i class='wi wi-moonset'></i>";
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
                <input name="itemImages[]" class="input-file" id="image" type="file" accept="image/*" required="">
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
                <input  name="itemname" class="form-control" id="itemname" type="text" placeholder="Item Name" required="" maxlength="50" >
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
                <button type ="submit" name="upload" class="btn btn-success btn-block" id="upload">Upload Item</button>
                <button type="button" onclick ="hideForm();" class="btn btn-warning btn-block" >Cancel</button>
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
</script>

