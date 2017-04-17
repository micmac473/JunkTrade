<?php
include "../lib.php";
include "base.php";

if(isset($_GET['trader'])){
  $userID = $_GET['trader'];
  $userDetails = getUserItems($userID);
  $userInfo = getUserInfo($userID);
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
    $rating = ($userRating[0][0] + $userRating[1][0])/2.0;
  $rating = number_format($rating, 1);
  //print_r($rating);

  $followers = getUserFollowersCount($userID);
  $tradeCount = getUserTradeCount($userID);
  $trades = $tradeCount[0][0] + $tradeCount[1][0];
  //print_r($followers);
  ///print_r($rating);
}

$currProfileItems =[];
?>
<div class ="container-fluid">
  <div class="jumbotron">
    <div class="row text-center">
      <div class="col-lg-2">
        <?php
          echo "<a href='#' onClick=\"viewProfileImage(".$userID.")\">".getProfileImage($userID)."</a>";
          echo "<button type='button' class='btn btn-link btn-xs' onClick=\"reportTrader(".$userID.")\" data-toggle='tooltip' title='Click to Report Trader' data-placement='bottom'><i class='fa fa-commenting' aria-hidden='true'></i> Report Trader</button>";
        ?>
      </div>
      <div class="col-lg-10">
        <?php
          echo "<h1>" . $userInfo['firstname'] ." ". $userInfo['lastname'] ." <small>(" . $userInfo['username']. ")</small></h1>"  ;
        ?>
      
        <?php
          if($followeeInfo == null || $followeeInfo['followindicator'] == false){
            echo "<button type='button' class='btn btn-default' onClick=\"followTrader(". $userID .")\" data-toggle='tooltip' title='Click to Follow' data-placement='bottom'><i class='fa fa-rss' aria-hidden='true'></i> Follow </button> ";
          }
          else{
            echo "<button type='button' class='btn btn-success' onClick=\"unfollowTrader(". $userID .")\" data-toggle='tooltip' title='Click to Unfollow' data-placement='bottom'><i class='fa fa-rss-square' aria-hidden='true'></i> Following </button>";
          }
          echo "<span> <small>Followed by <a href='#' id='followerslist' data-html ='true' data-toggle='popover' data-placement='right' data-trigger='focus' data-content=\"";
            foreach ($followers as $key => $value) {
              if($value['id'] != $currentUser)
                echo "<a class='btn btn-link' href='#' onclick='viewTraderProfile(".$value['id'].")'>".$value['username']."</a><br/>";
              else
                echo "<a class='btn btn-link disabled' href='#'>".$value['username']."</a><br/>";
            }
          echo "\">". count($followers)."</a> people</small></span><br>";
          echo "<a href='#' data-toggle='tooltip' data-html='true' title=\"Trades: ". $trades."<br>".$rating." out of 5 stars\" data-placement='bottom'><input  type='hidden' class='rating'  data-filled='fa fa-star fa-3x' data-empty='fa fa-star-o fa-3x' data-readonly value=\"".$rating."\"/></a>";

          //echo "Trades: ".$tradeCount[0]['numtrades'];
        ?> 
    </div>
  </div>
</div>

    <div id="traderitems">
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
                  echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
                  echo "<div class='panel panel-warning'>";

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
                  echo "</div>";
                  $currProfileItems [] = $val['itemid'];
                  break;
                }
              }
            }
          }

          if($j == count($userRequests)){
            echo "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>";
            echo "<div class='panel panel-info'>";

            echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem(".$val['itemid'].")\"><strong>". $val['itemname'] . "</strong> </button><br><small> Views: ".$val['views']." </small><br></div>";
          
            echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";
                
            echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
             
            echo "</div>";
            echo "</div>";
            $currProfileItems [] = $val['itemid'];
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


var traderId = <?php echo json_encode($_GET['trader']) ?>;
var currItems = <?php echo json_encode($currProfileItems) ?>;
var currDeniedRequests = <?php echo json_encode(getItemRequestDeniedStatusTrader($_GET['trader'])) ?>;
var currItemRequests = <?php echo json_encode(getTraderProfileItemsTradedStatus($_GET['trader'])) ?>;
console.log(currItems);
console.log(currDeniedRequests);
currItems.forEach(function(el){
  if(currDeniedRequests != null){
    for(var i =0; i < currDeniedRequests.length; i++){
      if(el == currDeniedRequests[i]['item'] && currDeniedRequests[i]['decision'] == false){
        deniedResponse(currDeniedRequests[i]['itemname']);
      } 
    } 
  }
  
});
//var userItems = <?php echo json_encode(getUserItems($_GET['trader'])) ?>;
//console.log(userItems);
//var userItemsRequests = <?php echo json_encode(getAllNonUserItemRequestsForSpecificTrader($_GET['trader'])) ?>;

setInterval(function(){
  queryUserItemsChange(traderId, currItems);
  queryDeniedRequestsTrader(traderId, currItems)
},2500);


function queryUserItemsChange(traderId, currItems){
  //console.log(userItems);
  //$.get("../index.php/items/"+traderId, function(items){
    $.get("../index.php/itemsrequests/"+traderId, function(itemsRequests){
      //console.log(itemsRequests);
      //console.log(currItems);

      currItems.forEach(function(el){
        for(var i =0; i < itemsRequests.length; i++){
          if(el == itemsRequests[i]['item'] || el == itemsRequests[i]['item2'])
            itemChange(itemsRequests[i]['itemname']);
        }
      });
    },"json");
  //},"json");

}

function queryDeniedRequestsTrader(traderId, currItems){
  $.get("../index.php/itemsdeniedstatustrader/"+traderId, function(traderRequests){
    currItems.forEach(function(el){
      if(traderRequests != null){
        for(var i =0; i < traderRequests.length; i++){
          if(traderRequests[i]['item'] == el && traderRequests[i]['decision'] == false){
            deniedResponse(traderRequests[i]['itemname']);
          }
        }
      }
    });
  },"json");
}

function itemChange(itemName){
  swal({ 
        title: "Sorry,\"" +itemName+"\" has been traded",
        text: "Page shall be refreshed",
        type: "warning",
        timer: 2000,
        showConfirmButton: false
        },
        function(){
            window.location.reload();
        }
    );      
}

function deniedResponse(itemName){
    swal({ 
        title: itemName +" Request was Denied!",
        text: "Redirecting to Outgoing Requests to view reason",
        type: "warning",
        timer: 2000,
        showConfirmButton: false
    },
        function(){
            window.location.href = 'trade.php';
        }
    );       
}

</script>