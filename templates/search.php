<?php
include "base.php";
?>

<div class="container-fluid">
  <div class="row">
    


    <div class="col-xs-2">
    </div>

    <div id = "searchitemblock" class="col-lg-4- col-md-4 col-s-4 col-xs-12">
    	<p>
	    <h3>Search For An Item</h3> 
	    <p>You may enter any key word</p> 
	    <form  method="post" action="search.php?go"  id="searchform"> 
	      <input  type="text" name="searchname"> 
	      <input  type="submit" name="searchsubmit" value="Search"> 
	    </form> 
	</p>

<?php

$item = null;

	  if(isset($_POST['searchsubmit'])){ 
	  if(isset($_GET['go'])){ 
	  if(preg_match("/^[  a-zA-Z]+/", $_POST['searchname'])){ 
	  $name=$_POST['searchname']; 
	  //-query  the database table
	  $db=mysqli_connect("localhost","root","","peertrading")or die("cannot connect to server"); 
	  $sql="SELECT  itemid, itemname, itemdescription, userid, picture, username FROM items, users WHERE itemname LIKE '%" . $name .  "%' && items.userid = users.id"; 
	  //-run  the query against the mysql query function 
	  $result=$db->query($sql); 
	  //-create  while loop and loop through result set 
	  while($result && $row = $result->fetch_assoc()){ 
	          $item[]  =$row;
	   }

	if($item != null){
	   foreach ($item as $key => $val) {
	  //-display the result of the array 
	   	$ID = $val['userid'];

	   	echo "<div class='panel panel-primary'>";
        echo "<div class='panel-heading'>".  $val['itemname'] . "</div>"; 
        echo "<div class='panel-body'> <img style='cursor: pointer;width:100%;' onclick=\"views(".$val['itemid'].")\" src=\"" . $val['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";
        echo "<div class='panel-footer'>".  $val['username'] . "</div>"; 
        echo "<div class='panel-footer'>".  $val['itemdescription'] . "</div>"; 
        echo "<div class='panel-footer'> <button type='button' class='btn btn-primary' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus' aria-hidden='true'></i></button><button type='button' class='btn btn-success' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-user-plus' aria-hidden='true'></i></button></div>";
        echo "</div>";
    }
	  } 
	  } 
	  else{ 
	  echo  "<p>Please enter a search query</p>"; 
	  } 
	  } 
	  } 	

	  ?>




      </div>
     <div class="col-xs-2">
    
    </div>

  </div>
</div>


