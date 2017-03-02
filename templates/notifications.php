<?php
include "../lib.php";
include "base.php";

if(isset($_POST['upload'])){

  $filetmp = $_FILES["image"]["tmp_name"];
  $filename = $_FILES["image"]["name"];
  $filetype = $_FILES["image"]["type"];
  $filepath = "../img/".$filename;
  
  move_uploaded_file($filetmp,$filepath);

  //$imagePath = "../img/".$post['image'];
  try{
    $itemName = $_POST['itemname'];
    $itemDescription = $_POST['itemdescription'];
    //unset($_POST);
    //print_r($_POST);
    // print "Name: $name, Price:$price, Country: $countryId";
    $res = saveItem($filepath, $itemName, $itemDescription);
    //var_dump($res);
  }catch(Exception $e){
    print( $e->getMessage());
  }

}

if (isset($_POST['uploadU'])) {
$filetmp = $_FILES["imageU"]["tmp_name"];
  $filename = $_FILES["imageU"]["name"];
  $filetype = $_FILES["imageU"]["type"];
  $filepath = "../img/".$filename;
  
  move_uploaded_file($filetmp,$filepath);
try{
$id = $_POST['id'];
$name = $_POST['itemnameU'];
$description = $_POST['itemdescriptionU'];
//$itempic = "../img/" . $_POST['imageU'];


$db = getDBConnection();

$sql = "UPDATE items SET itemname= '{$name}', itemdescription='{$description}', picture='{$filepath}' WHERE itemid=$id;";

 $db->query($sql);
unset($_POST);
 /*if ($db->query($sql) === TRUE) {
       echo "Record updated successfully";
   } else {
       echo "Error updating record: " . $db->error;
   }
   */
   $db->close();
 }catch(Exception $e){
  print( $e->getMessage());
 }

}

if (isset($_POST['uploadPic'])) {
$filetmp = $_FILES["imagePic"]["tmp_name"];
  $filename = $_FILES["imagePic"]["name"];
  $filetype = $_FILES["imagePic"]["type"];
  $filepath = "../img/".$filename;
  
  move_uploaded_file($filetmp,$filepath);
try{
$id = $_SESSION["id"];
$db = getDBConnection();

$sql = "UPDATE users SET profilepicture='{$filepath}' WHERE id=$id;";

 $db->query($sql);
unset($_POST);
   $db->close();
 }catch(Exception $e){
  print( $e->getMessage());
 }

}
?>

<div class ="container-fluid">
  <div class="row">
    <div class ="">
      <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">Incoming Requests</h2>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_secr"></div>
    </div>
  </div>

</div>  <!-- close container -->  

<script type="text/template" id="table_headingr">
  <table class="table table-hover table-condensed table-responsive">
    <thead>
      <tr>
        <th>From</th>
        <th>With</th>
        <th>For</th>
        <th>View Request</th>
        <th>Make Decision</th>
      </tr>
    </thead>
    <tbody>
</script>

<!-- View Modal -->
  <div class="modal fade" id="requestModalP" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="viewrequestform">
            <fieldset>

            <div class="form-group">
              <label class="col-md-12 control-label" for="name">Requester</label>
              <div class="col-md-12">
                <input id="requester" name="requester" type="text" disabled placeholder="Item Owner" class="form-control input-md" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12 control-label" for="name">Item</label>
              <div class="col-md-12">
                <input id="requesteritem" name="requesteritem" type="text" disabled placeholder="Requested Item" class="form-control input-md" required="">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 control-label" for="name"></label>
              <div class="col-md-12">
                <img src="" id="imagepreview" style="width: 100%">
              </div>
            </div>
            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div> 

<!-- Meet up Modal -->
  <div class="modal fade" id="meetUpModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <form class="form" id="meetupform" onsubmit="return sendArrangement();">
            <fieldset>

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Request Details</h2>
             </div>
              <input id="requestid" name="requestid" type="hidden" disabled placeholder="Requested Item" class="form-control input-md">

              <div class="form-group"> 
                <label class="control-label" for="date">Requester</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input class="form-control" id="requester" name="requester" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> 
                <label class="control-label" for="date">Requester Item</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteritem" name="requesteritem" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> 
                <label class="control-label" for="date">Requester Phone Number</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                    <input class="form-control" id="requestercontact" name="requestercontact" type="tel" disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> 
                <label class="control-label" for="date">Your Item</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteeitem" name="requesteeitem" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="modal-header">
                <h2 class="modal-title" style="text-align: center">Meetup Details</h2>
              </div>

              <div class="form-group"> <!-- Date input -->
                <label class="control-label" for="date">Date</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input class="form-control" id="tradedate" name="tradedate" placeholder="MM/DD/YYY" type="text" required/>
                  </div>
                </div>
              </div> 

              <div class="form-group">
                <label class="control-label" for="selectbasic">UWI Location</label>
                <div class="">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                  <select id="tradelocation" name="tradelocation" class="form-control" required>
                    <option value="" disabled selected> Select a campus location</option>
                    <option value="Food Court">Food Court</option>
                    <option value="JFK Quadrangle">JFK Quadrangle</option>
                    <option value="LRC Greens">LRC Greens</option>
                    <option value="DAAGA">DAAGA</option>
                    <option value="Student Admin">Student Admin</option>
                    <option value="Bookstore">Bookstore</option>
                  </select>
                </div>
              </div>
              </div>

              <div class="form-group"> 
                <label class="control-label" for="date">Phone Number</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteecontact" name="requesteecontact" type="tel" required pattern="[868][0-9]{9}"/>
                  </div>
                </div>
              </div> 

              <div class="form-group">
                <div class="">
                  <button  class="btn btn-success btn-block" type="submit">Send Arrangement</button>
                  <button  class="btn btn-danger btn-block" data-dismiss="modal" onclick="cancelArrangement()">Cancel Arrangement</button>
                </div>
              </div>

            </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>