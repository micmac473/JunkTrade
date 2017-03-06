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
  //print_r($userRequests);
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
          echo "<h1>" . $userDetails[0]['firstname'] ." ". $userDetails[0]['lastname'] ."</h1><p>" ."(" . $userDetails[0]['username']. ")" ;
        ?>
      
        <?php
          if($followeeInfo == null || $followeeInfo['followindicator'] == false){
            echo "<button type='button' class='btn btn-default' onClick=\"followTrader(". $userID .")\" data-toggle='tooltip' title='Click to Follow' data-placement='bottom'>Follow <i class='fa fa-rss' aria-hidden='true'></i></button> </p>";
          }
          else{
            echo "<button type='button' class='btn btn-success' onClick=\"unfollowTrader(". $userID .")\" data-toggle='tooltip' title='Click to Unfollow' data-placement='bottom'> Following <i class='fa fa-rss-square' aria-hidden='true'></i></button></p>";
          }
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
            if($val['itemid'] == $req['item']){
              if($req['decision'] == true){
                //echo "Accepted!";
                break;
              }
              else{
                echo "<div class='panel panel-default'>";

                echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link btn-lg' onclick=\"viewItem(".$val['itemid'].")\"><strong>". $val['itemname'] . "</strong> </button></div>";
          
                echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";

                if($req['decision'] == null){
                  echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest(".$req['id'].")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div></div></div>";
                  //echo "Pending!" . $val['itemid'];
                }
                else{
                  echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-success btn-block active' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
                  //echo "Denied!";
                }
                
          
                echo "</div>";
                break;
              }
            }
          }

          if($j == count($userRequests)){
            echo "<div class='panel panel-default'>";

            echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link btn-lg' onclick=\"viewItem(".$val['itemid'].")\"><strong>". $val['itemname'] . "</strong> </button></div>";
          
            echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";
                
            echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-success btn-block active' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
             
            echo "</div>";
            //echo "No Request made!";
          }
          
        }
      ?>
    
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>