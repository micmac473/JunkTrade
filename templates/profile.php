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
  <div class ="row">
    <div class ="col-md-8 col-md-offset-2">
    <button type="button" onclick ="showProfilePictureForm();" class="btn btn-info">Update Profile Pic</button>
      <button type="button" onclick ="showForm();" class="btn btn-info">Add Item</button>
      <button type="button" onclick ="showSearch();" class="btn btn-info">Find Item</button>
    </div>
  </div>
  <!-- Perform a seafrch -->
  <div class="container" id ="ProfileSearch" style ="display:none;">
  <div class="row">
        <div class="col-md-6">
        <h2>Search Your Items</h2>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Seach.." />
                    <span class="input-group-btn">
                        <button onclick ="hideSearch();" class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
  </div>
</div>

  <!-- Update Profile Pic -->
  <div class ="row" style ="display:none" id ="uploadProfilePic">
    <div class ="col-md-6">
      <form class="form-horizontal" action ="profile.php" enctype="multipart/form-data" method ="POST">
      <!-- <form class="form-horizontal" action ="index.php/additem" enctype="multipart/form-data" method ="POST" onsubmit="return addItem();"> -->
        <fieldset>
          <legend style="text-align:center">Change Profile Pic</legend>
            <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Choose an Image </label>
              <div class="col-md-6">
                <input name="imagePic" class="input-file" id="imagePic" type="file" accept="image/*" required="">
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="upload"></label>
              <div class="col-md-4">
                <button type ="submit" name="uploadPic" class="btn btn-success" id="uploadPic">Add</button>
                  <button type="button"onclick ="hideProfilePictureForm();" class="btn btn-warning" ></a>Cancel
                </button>
              </div>
            </div>

          </fieldset>
        </form>
    </div>
  </div>

  <!-- Add Item -->
  <div class ="row" style ="display:none" id ="uploadItem">
    <div class ="col-md-6">
      <form class="form-horizontal" action ="profile.php" enctype="multipart/form-data" method ="POST">
      <!-- <form class="form-horizontal" action ="index.php/additem" enctype="multipart/form-data" method ="POST" onsubmit="return addItem();"> -->
        <fieldset>
          <legend style="text-align:center">Upload a New Item</legend>
            <!-- File Button --> 
            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Choose an Image </label>
              <div class="col-md-6">
                <input name="image" class="input-file" id="image" type="file" accept="image/*" required="">
              </div>
            </div>

            <!-- Input -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="ItemDescription">Item Name</label>
              <div class="col-md-6">                     
                <input name="itemname" class="form-control" id="itemname" type="text" placeholder="Item Name" required="" maxlength="20" >
              </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="ItemDescription">Item Description</label>
              <div class="col-md-6">                     
                <textarea name="itemdescription" class="form-control" id="itemdescription" placeholder="Tell us about your item" required=""></textarea>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="upload"></label>
              <div class="col-md-4">
                <button type ="submit" name="upload" class="btn btn-success" id="upload">Add</button>
                  <button type="button"onclick ="hideForm();" class="btn btn-warning" ></a>Cancel
                </button>
              </div>
            </div>

          </fieldset>
        </form>
    </div>
  </div>


  <div class ="row" style ="display:none" id ="updateItemform">
    <div class ="col-md-6">
      <form class="form-horizontal" action ="profile.php" method ="POST" enctype="multipart/form-data">
        <fieldset>
          <legend style="text-align:center">Edit Item</legend>
            <!-- File Button-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Choose an Image </label>
              <div class="col-md-6">
                <input name="imageU" class="input-file" id="imageU" type="file" accept="image/*" required="">
              </div>
            </div>
            
          	<!-- Input -->
            <div class="form-group"  >
              <!-- <label class="col-md-4 control-label" for="ItemDescription">ItemID</label> -->
              <div class="col-md-6">                     
                <input name="id" class="form-control" id="id"  type="hidden" placeholder="ID" required="" >
              </div>
            </div>
          
            <!-- Input -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="ItemDescription">Item Name</label>
              <div class="col-md-6">                     
                <input name="itemnameU" class="form-control" id="itemnameU" type="text" placeholder="Item Name" maxlength="20" required="">
              </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="ItemDescription">Item Description</label>
              <div class="col-md-6">                     
                <textarea name="itemdescriptionU" class="form-control" id="itemdescriptionU" placeholder="Tell us about your item" required=""></textarea>
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="upload"></label>
              <div class="col-md-4">
                <button type ="submit" name="uploadU" class="btn btn-success" id="uploadU">Update</button>
                  <button type="button"onclick ="hideUpdateForm();" class="btn btn-warning" ></a>Cancel
                </button>
              </div>
            </div>

          </fieldset>
        </form>
    </div>
  </div>
  <!-- this is a table which will list the pictures of the items which the user has uploaded, only the headings will be here-->

    <!--there should be a footer here -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--<script src="js/ie10-viewport-bug-workaround.js"></script> -->
<!--
<script src="js/jquery/dist/jquery.js"></script>
<script src="js/angular/angular.min.js"></script>
<script src="js/angular-route/angular-route.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="js/main.js"></script> -->
  <div class="row">
    <div class="col-md-7 table-responsive">
      <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">My Junk</h2>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_secp"></div>
    </div>

    <div class ="col-md-5 table-responsive">
      <h2 style="text-align: center; font-family: 'Acme', sans-serif; color:orange">Incoming Requests</h2>
    <!--<h4>Products</h4>
    <p>A table highlighting the available products</p> -->
      <div id="table_secr"></div>
    </div>
  </div>

</div>  <!-- close container -->  
<script type="text/template" id="table_headingp">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th> </th><th>Name</th><th>Description</th><th>Options</th><th>Uploaded</th>
    </tr>
    </thead>
    <tbody>
</script>

<script type="text/template" id="table_headingr">
  <table class="table table-hover table-condensed">
    <thead>
    <tr>
      <th>From</th><th>For Your Item</th><th>View</th><th>Decision</th>
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
                <img src="" id="imagepreview" style="width: 240px; height: 180px;">
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

              <div class="form-group"> <!-- Date input -->
                <label class="control-label" for="date">Requester</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input class="form-control" id="requester" name="requester" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> <!-- Date input -->
                <label class="control-label" for="date">Requester Item</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteritem" name="requesteritem" type="text" required disabled/>
                  </div>
                </div>
              </div> 

              <div class="form-group"> <!-- Date input -->
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

              <div class="form-group"> <!-- Date input -->
                <label class="control-label" for="date">Contact</label>
                <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                    <input class="form-control" id="requesteecontact" name="requesteecontact" type="tel" required/>
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

  <script>
    $(document).ready(function(){
      var date_input=$('input[name="tradedate"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>