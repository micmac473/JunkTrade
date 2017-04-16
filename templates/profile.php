<?php
include "../lib.php";

//Moves item image files to folder and saved the file names and other other to DB
if(isset($_POST['upload'])){
  $defaultFileName = "defaultitemimage.jpg";

  $filetmp = $_FILES['itemImages']['tmp_name'][0];
  $filename = $_FILES["itemImages"]["name"][0];
  $filetype = $_FILES["itemImages"]["type"][0];
  $filepath = "../img/".$filename;
  
  $filetmp1 = $_FILES["itemImages"]["tmp_name"][1];
  if($_FILES["itemImages"]["name"][1] != null){
    $filename1 = $_FILES["itemImages"]["name"][1];
    $filepath1 = "../img/".$filename1;
     move_uploaded_file($filetmp1,$filepath1);
  }   
  else{
    $filename1 = $defaultFileName;
    $filepath1 = "../img/".$filename1;
  }
    

  $filetype1 = $_FILES["itemImages"]["type"][1];
  

  $filetmp2 = $_FILES["itemImages"]["tmp_name"][2];
  if($_FILES["itemImages"]["name"][2] != null){
    $filename2 = $_FILES["itemImages"]["name"][2];
    $filepath2 = "../img/".$filename2;
    move_uploaded_file($filetmp2,$filepath2);
  }
    
  else{
    $filename2 = $defaultFileName;
    $filepath2 = "../img/".$filename2;
  }
    

  $filetype2 = $_FILES["itemImages"]["type"][2];
  

  move_uploaded_file($filetmp,$filepath);
 
  //$imagePath = "../img/".$post['image'];
  try{
    $itemName = $_POST['itemname'];
    $itemDescription = $_POST['itemdescription'];
    //unset($_POST);
    //print_r($_POST);
    // print "Name: $name, Price:$price, Country: $countryId";
    $res = saveItem($filepath, $filepath1, $filepath2, $itemName, $itemDescription);
    //print_r($res);
    //var_dump($res);
  }catch(Exception $e){
    print( $e->getMessage());
  }

}


if (isset($_POST['uploadU'])) {
  /*$filetmp = $_FILES["imageU"]["tmp_name"];
  $filename = $_FILES["imageU"]["name"];
  $filetype = $_FILES["imageU"]["type"];
  $filepath = "../img/".$filename;
  
  move_uploaded_file($filetmp,$filepath); */

  $defaultFileName = "../img/defaultitemimage.jpg";

  $filetmp = $_FILES['itemImagesUpdate']['tmp_name'][0];
  $filename = $_FILES["itemImagesUpdate"]["name"][0];
  $filetype = $_FILES["itemImagesUpdate"]["type"][0];
  $filepath = "../img/".$filename;
  
  $filetmp1 = $_FILES["itemImagesUpdate"]["tmp_name"][1];
  if($_FILES["itemImagesUpdate"]["name"][1] != null){
    $filename1 = $_FILES["itemImagesUpdate"]["name"][1];
    $filepath1 = "../img/".$filename1;
     move_uploaded_file($filetmp1,$filepath1);
  }   
  else{
    $filename1 = $defaultFileName;
    $filepath1 = "../img/".$filename1;
  }
    

  $filetype1 = $_FILES["itemImagesUpdate"]["type"][1];
  

  $filetmp2 = $_FILES["itemImagesUpdate"]["tmp_name"][2];
  if($_FILES["itemImagesUpdate"]["name"][2] != null){
    $filename2 = $_FILES["itemImagesUpdate"]["name"][2];
    $filepath2 = "../img/".$filename2;
    move_uploaded_file($filetmp2,$filepath2);
  }
    
  else{
    $filename2 = $defaultFileName;
    $filepath2 = "../img/".$filename2;
  }
    

  $filetype2 = $_FILES["itemImagesUpdate"]["type"][2];
  

  move_uploaded_file($filetmp,$filepath);

  try{
    $id = $_POST['id'];
    $name = $_POST['itemnameU'];
    $description = $_POST['itemdescriptionU'];
    //$itempic = "../img/" . $_POST['imageU'];


    $db = getDBConnection();

    $sql = "UPDATE items SET itemname= '{$name}', itemdescription='{$description}', picture='{$filepath}', picture2 = '{$filepath1}', picture3 = '{$filepath2}' WHERE itemid=$id;";

    $db->query($sql);
    unset($_POST);
   /*if ($db->query($sql) === TRUE) {
         echo "Record updated successfully";
     } else {
         echo "Error updating record: " . $db->error;
     }
     */
     $db->close();
  }
  catch(Exception $e){
    print( $e->getMessage());
  }

}

if (isset($_POST['saveBnt'])) {
  try{
    $id = $_SESSION["id"];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['telephone'];

    $db = getDBConnection();

    $sql = "UPDATE users SET firstname='{$fname}', lastname='{$lname}', email='{$email}', telephone='{$phone}' WHERE id=$id;";
    $db->query($sql);
    unset($_POST);
    $db->close();
   }
   catch(Exception $e){
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
   }
   catch(Exception $e){
    print( $e->getMessage());
   }
}





$userID = getCurrentUser();
$userRating = getUserRating($userID);
  //print_r($userRating);
  if($userRating[0][0] == null)
    $rating = $userRating[1][0];
  else if($userRating[1][0]==null)
    $rating = $userRating[0][0];
  else
    $rating = $userRating[0][0] + $userRating[1][0];
  $rating = number_format($rating, 1);

$tradeCount = getUserTradeCount($userID);
$trades = $tradeCount[0][0] + $tradeCount[1][0];
include "base.php";
?>

<div class ="container-fluid">

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

  

  <div class ="row" style ="display:none" id ="updateItemform">
    <div class ="col-md-6">
      <form class="form-horizontal" action ="profile.php" method ="POST" enctype="multipart/form-data">
        <fieldset>
          <legend style="text-align:center">Edit Item</legend>
            <!-- File Button-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Photo 1 </label>
              <div class="col-md-6">
                <input name="itemImagesUpdate[]" class="input-file" id="imageU" type="file" accept="image/*" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Photo 2 </label>
              <div class="col-md-6">
                <input name="itemImagesUpdate[]" class="input-file" id="imageU" type="file" accept="image/*">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="uppic">Photo 3 </label>
              <div class="col-md-6">
                <input name="itemImagesUpdate[]" class="input-file" id="imageU" type="file" accept="image/*">
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
                <textarea name="itemdescriptionU" class="form-control" id="itemdescriptionU" placeholder="Tell us about your item" rows="5" required=""></textarea>
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

  <div class ="row" style ="display:none" id ="editProfileForm">
    <div class ="col-md-6">
      <form class="form-horizontal" action="profile.php" method ="POST" enctype="multipart/form-data">
        <fieldset>
          <legend style="text-align:center">Edit Profile</legend>
            <!-- File Button-->

          
            <!-- Input -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="editProfileForm">UserName</label>
              <div class="col-md-6">                     
                 <input autofocus type="text" pattern="^[_A-z0-9]{1,}$" minlength="3" maxlength="15" class="form-control" name="username" id="username"  placeholder="Enter your Username" disabled="">
              </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="editProfileForm">First Name</label>
              <div class="col-md-6">                     
                <input type="text" pattern="^[_A-z0-9]{1,}$" minlength="3" maxlength="15" class="form-control" name="firstname" id="firstname"  placeholder="Enter your First Name" required/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="editProfileForm">Last Name</label>
              <div class="col-md-6">                     
                <input type="text" pattern="^[_A-z0-9]{1,}$" minlength="3" maxlength="15" class="form-control" name="lastname" id="lastname"  placeholder="Enter your First Name" required/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="editProfileForm">Email</label>
              <div class="col-md-6">                     
                <input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" required/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="editProfileForm">Telephone (E.g. 868-123-4567 )</label>
              <div class="col-md-6">                     
                <input class="form-control" id="telephone" name="telephone" type="tel" placeholder="868-123-4567" />
              </div>
            </div>

            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="upload"></label>
              <div class="col-md-4">
                <button id="saveBnt" name="saveBnt" type="submit" class="btn btn-success" data-delay="disable">Update</button>
                  <button type="button"onclick ="hideEditProfileForm();" class="btn btn-warning" ></a>Cancel
                </button>
              </div>
            </div>

          </fieldset>
        </form>
    </div>
  </div>
  

  <div class="row">
    <div class="col-xs-12 table-responsive">
      <div class="page-header text-center" style="margin-top: 0; padding:0">
        <h2><i class="fa fa-gift" aria-hidden="true" ></i> Your Junk 
          <small>
            <span class="label label-primary" id="useritemscounttotal"></span>
          </small> 
        </h2>
        <h4>
          Available <span class="label label-success" id="useritemscountavailable"></span>
          Traded <span class="label label-danger" id="useritemscounttraded"></span> 
        </h4>
      </div>

      <div id="table_secp"></div>
    </div>
  </div>

</div>  <!-- close container -->  

<!-- Image Modal -->
  <div class="modal fade" id="itemimagesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="">

  

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
     <img id="picture1" style="width: 100%;" class="img-responsive" src="" alt="...">
    </div>
    <div class="item">
      <img id="picture2" style="width: 100%;" class="img-responsive" src="" alt="...">
    </div>
     <div class="item">
      <img id="picture3" style="width: 100%;" class="img-responsive" src="" alt="...">
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
    </div>
  </div>
  
<script type="text/template" id="table_headingp">
  <table class="table table-hover table-condensed" id="userprofileitems">
    <thead>
    <tr>
      <th><i class="fa fa-picture-o" aria-hidden="true" ></i> Picture</th>
      <th><i class="fa fa-gift" aria-hidden="true" ></i> Name</th>
      <th><i class="fa fa-pencil" aria-hidden="true" ></i> Description</th>
      <th colspan="2" class="text-center"><i class="fa fa-cog" aria-hidden="true" ></i></th>
      <th><i class="fa fa-calendar" aria-hidden="true" ></i> Uploaded</th>
      <th><i class="fa fa-question-circle" aria-hidden="true" ></i> State</th>
    </tr>
    </thead>
    <tbody>
</script>



<script>window.onload = function() {
    getUserItems();
};
</script>