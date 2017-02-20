<?php
include "base.php";
?>

<div class="container-fluid">
  <div class="row">

    <div id = "searchitemblock" class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
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
		$user = $_SESSION["id"];
	  if(isset($_POST['searchsubmit'])){ 
	  if(isset($_GET['go'])){ 
	  if(preg_match("/^[  a-zA-Z]+/", $_POST['searchname'])){ 
	  $name=$_POST['searchname']; 
	  //-query  the database table
	  $db=mysqli_connect("localhost","root","","peertrading")or die("cannot connect to server"); 
	  $sql="SELECT  itemid, itemname, itemdescription, userid, picture, username FROM items, users WHERE $user <> `userid` AND itemname LIKE '%" . $name .  "%' && items.userid = users.id"; 
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

	   	echo "<div class='panel panel-default'>";
          //echo "<div class='panel-heading' style='text-align: right'> <em> Uploaded on: ".  $val['uploaddate']."</em></div>";
          echo "<div class='panel-heading'><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile(".$val['userid'].")\">" .  "<strong>" . $val['username'] . "</strong></button></div>";
          echo "<div class='panel-body'> <div class='text-center lead'> <strong>".  $val['itemname'] . "</strong> </div> <img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture']  ."\"  class='img-responsive img-thumbnail mx-auto'> </div>";
          echo "<div class='panel-footer'> <div class='row'><div class='col-lg-6'><button type='button' class='btn btn-success btn-block' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div><div class='col-lg-6'><button type='button' class='btn btn-info btn-block' onclick=\"viewItem(".$val['itemid'].")\"><i class='fa fa-eye fa-lg' aria-hidden='true'></i> View more</button> </div></div></div>";
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


