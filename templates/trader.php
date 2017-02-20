<?php
include "../lib.php";
include "base.php";

if(isset($_GET['trader'])){
  $userID = $_GET['trader'];
  $userDetails = getUserItems($userID);
  //var_dump($userDetails);
  //echo $traderInfo;
}

?>
<div class ="container-fluid">
  <div class="jumbotron">
    <div class="row">
      <div class="col-lg-2">
        <?php
          echo "<img src=../img/logo.png  style='width:100%; class='img-responsive img-thumbnail mx-auto'>";
        ?>
      </div>
      <div class="col-lg-8">
        <?php
          echo "<h1>" . $userDetails[0]['firstname'] ." ". $userDetails[0]['lastname'] ."</h1><p>" ."(" . $userDetails[0]['username']. ")". "</p>" ;
        ?>
      </div>
      <div class="col-lg-2">
        <button type="button" class="btn btn-default btn-block" onClick="followTrader('$val.userid')"><i class='fa fa-plus fa-lg' aria-hidden='true'></i> Follow</button>
      </div>
    </div>
  </div>
</div>

<div class ="container-fluid">
    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
      <?php
        for($i = 0; $i < count($userDetails); $i++){
          $val = $userDetails[$i];
          echo "<div class='panel panel-default'>";
          //echo "<div class='panel-heading' style='text-align: right'> <em> Uploaded on: ".  $val['uploaddate']."</em></div>";
          echo "<div class='panel-heading text-center lead'><strong>".  $val['itemname'] . "</strong></div>";
          echo "<div class='panel-body'> <img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture']  ."\"  class='img-responsive img-thumbnail mx-auto'> </div>";
          echo "<div class='panel-footer'> <div class='row'><div class='col-lg-6'><button type='button' class='btn btn-success btn-block' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div><div class='col-lg-6'><button type='button' class='btn btn-info btn-block' onclick=\"viewItem(".$val['itemid'].")\"><i class='fa fa-eye fa-lg' aria-hidden='true'></i> View more</button> </div></div></div>";
          echo "</div>";
        }
      ?>
    </div>
</div>

<!-- Item Request Modal -->
  <div class="modal fade" id="requestModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Request Transaction</h4>
        </div>
        <div class="modal-body">
          <form class="" onsubmit="return sendRequest();">
            <fieldset>

            <div class="form-group">
              <label class="control-label" for="name">Item Owner</label>
              <div class="">
                <input id="requestee" name="requestee" type="text" disabled placeholder="Item Owner" class="form-control input-md" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label" for="name">Item</label>
              <div class="">
                <input id="requesteditem" name="requesteditem" type="text" disabled placeholder="Requested Item" class="form-control input-md" required="">
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="control-label" for="selectbasic">Your Item</label>
              <div class="">
                <select id="myitems" name="myitems" class="form-control" required="">
                  
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="">
                <button  class="btn btn-success btn-block" type="submit">Send Request</button>
                <button  class="btn btn-danger btn-block" data-dismiss="modal">Cancel Request</button>

              </div>
            </div>

            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
