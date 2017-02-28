<?php
include "../lib.php";
include "base.php";

if(isset($_GET['item'])){
	$itemid = $_GET['item'];
	//var_dump($itemid);

	$itemDetails = getItem($itemid);
  $itemId = $itemDetails['itemid'];
	$username = getUsername($itemDetails['userid']);
  $savedItem = checkItemSaved($itemId);
  //var_dump($savedItem);
	//var_dump($username);
}
?>

<div class ="container-fluid">
  <div class="row">
  <?php
    echo "<div class='col-lg-4'>
  			<img src=\"" . $itemDetails['picture'] . "\"  style='width:100%; class='img-responsive img-thumbnail mx-auto'>
  		</div>";
  	echo "<div class='col-lg-5'>
  			<button type='button' class='btn btn-default' onclick=\"viewTraderProfile(".$itemDetails['userid'].")\">" . $username['username'] . "</button>
        <p> Date added: " . $itemDetails['uploaddate'] . "</p>
  			<h1><u>" . $itemDetails['itemname'] . "</u></h1>
  			<p>" . $itemDetails['itemdescription'] . "</p>
  		</div>";
    echo "<div class='col-lg-3'>";
    echo "<button type='button' class='btn btn-success btn-block' onclick=\"displayItemsForRequest(".$itemDetails['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus' aria-hidden='true'></i> Make Request</button>";
    if($savedItem == null || $savedItem['savedindicator'] == false){
      echo "<button type='button' class='btn btn-warning btn-block' onclick=\"addToSavedItems(".$itemDetails['itemid'].")\" id='requestbtn'><i class='fa fa-bookmark' aria-hidden='true'></i> Save</button>";
    }
    else{
      echo "<button type='button' class='btn btn-danger btn-block' onclick=\"removeSavedItem(".$savedItem['savedid'].")\" id='requestbtn'><i class='fa fa-trash' aria-hidden='true'></i> Remove Saved Item</button>";
    }
    
    echo "</div>";

  ?>
  </div>
</div>

