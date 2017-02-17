<?php
include "../lib.php";
include "base.php";

if(isset($_GET['item'])){
	$itemid = $_GET['item'];
	//var_dump($itemid);

	$itemDetails = getItem($itemid);
	//var_dump($itemDetails);
	$username = getUsername($itemDetails['userid']);
	//var_dump($username);
}
?>

<div class ="container-fluid">
  <div class="row">
  <?php
  	echo "<div class='col-lg-4'>
  			<img src=\"" . $itemDetails['picture'] . "\"  style='width:100%; class='img-responsive img-thumbnail mx-auto'>
  		</div>";
  	echo "<div class='col-lg-4'>
  			<button type='button' class='btn btn-default btn-block' onclick=\"viewTraderProfile(".$itemDetails['userid'].")\">Owner: " . $username['username'] . "</button>
  			<h1><u>" . $itemDetails['itemname'] . "</u></h1>
  			<p>" . $itemDetails['itemdescription'] . "</p>
  			
  				<button type='button' class='btn btn-success btn-block' onclick=\"displayItemsForRequest(".$itemDetails['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus' aria-hidden='true'></i> Make Request</button> 
  			
  			
  			<button type='button' class='btn btn-warning btn-block' onclick=\"addToSavedItems(".$itemDetails['itemid'].")\" id='requestbtn'><i class='fa fa-bookmark' aria-hidden='true'></i> Save</button> 
  			

  		</div>";
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