<?php
include "../lib.php";
include "base.php";

if(isset($_GET['trader'])){
  $userID = $_GET['trader'];
  $userDetails = getUserItems($userID);
  $followeeInfo = getFollowID($userID);
  //echo $followeeInfo['followid'];
  //var_dump($userDetails);
  //print_r($userDetails);
  $userRequests = getAllNonUserItemRequestsForSpecificTrader($userID);
  $currentUser = getCurrentUser();
  $userRating = getUserRating($userID);
  //print_r($userRating);
  if($userRating[0][0] == null)
    $rating = $userRating[1][0];
  else if($userRating[1][0]==null)
    $rating = $userRating[0][0];
  else
    $rating = $userRating[0][0] + $userRating[1][0];
  $rating = number_format($rating, 1);


  $followers = getUserFollowersCount($userID);
  $tradeCount = getUserTradeCount($userID);
  $trades = $tradeCount[0][0] + $tradeCount[1][0];
  //print_r($followers);
  ///print_r($rating);
}

?>
<div class ="container-fluid">
  <div class="jumbotron">
    <div class="row text-center">
      <div class="col-lg-2">
        <?php
          echo getProfileImage($userID);
        ?>
      </div>
      <div class="col-lg-10">
        <?php
          echo "<h1>" . $userDetails[0]['firstname'] ." ". $userDetails[0]['lastname'] ." <small>(" . $userDetails[0]['username']. ")</small></h1>"  ;
        ?>
      
        <?php
          if($followeeInfo == null || $followeeInfo['followindicator'] == false){
            echo "<button type='button' class='btn btn-default' onClick=\"followTrader(". $userID .")\" data-toggle='tooltip' title='Click to Follow' data-placement='bottom'>Follow <i class='fa fa-rss' aria-hidden='true'></i></button> ";
          }
          else{
            echo "<button type='button' class='btn btn-success' onClick=\"unfollowTrader(". $userID .")\" data-toggle='tooltip' title='Click to Unfollow' data-placement='bottom'> Following <i class='fa fa-rss-square' aria-hidden='true'></i></button>";
          }
          echo "<span> <small>Followed by <a href='#' id='followerslist' data-toggle='popover' data-placement='bottom' data-trigger='focus' title='Followers' data-content=\"".print_r($followers,true)."\">". count($followers)."</a> people</small></span><br>";
          echo "<a href='#' data-toggle='tooltip' title=\"Trades ". $trades."<br>".$rating." out of 5 stars\" data-placement='bottom'><input  type='hidden' class='rating' data-filled='fa fa-star fa-3x' data-empty='fa fa-star-o fa-3x' data-readonly value=\"".$rating."\"/></a>";
          //echo "Trades: ".$tradeCount[0]['numtrades'];
        ?> 
    </div>
  </div>
</div>

    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
      <?php
        for($i = 0; $i < count($userDetails); $i++){
          $val = $userDetails[$i];
          for($j = 0; $j < count($userRequests); $j++){
            $req = $userRequests[$j];
            if($val['itemid'] == $req['item'] || $val['itemid'] == $req['item2']){
              if($req['decision'] == true){
                //echo "Accepted!";
                break;
              }
              else{
                if($req['requester'] == $currentUser){
                echo "<div class='panel panel-info'>";

                echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem(".$val['itemid'].")\"><strong>". $val['itemname'] . "</strong> </button><br><small> Views: ".$val['views']." </small><br></div>";
          
                echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";

                if($req['decision'] == null){
                  echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest(".$req['id'].")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div></div></div>";
                  //echo "Pending!" . $val['itemid'];
                }
                else{
                  echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
                  //echo "Denied!";
                }
                
          
                echo "</div>";
                break;
              }
              }
            }
          }

          if($j == count($userRequests)){
            echo "<div class='panel panel-info'>";

            echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem(".$val['itemid'].")\"><strong>". $val['itemname'] . "</strong> </button><br><small> Views: ".$val['views']." </small><br></div>";
          
            echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";
                
            echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
             
            echo "</div>";
            //echo "No Request made!";
          }
          
        }
      ?>
    
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    $('[data-toggle="popover"]').popover(); 
});

$('#input').rating('rate', 2.5);
</script>