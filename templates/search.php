<?php
include "../lib.php";
include "base.php";

?>

<div class="container-fluid">
  <div class="row">

    <div id = "searchitemblock" class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">

<?php
	$items = [];
	$requests = [];
	$user = $_SESSION["id"];
	if(isset($_POST['searchsubmit'])){ 
		if(isset($_GET['go'])){ 
		  	if(preg_match("/^[  a-zA-Z]+/", $_POST['searchname'])){ 
		 		$name=$_POST['searchname'];
		 		$type=$_POST['search_param'];
		 		echo $name;
		 		echo $type;
		 		

		  //-query  the database table
		  		$db=mysqli_connect("localhost","root","","peertrading")or die("cannot connect to server"); 
		  		$sql="SELECT  itemid, itemname, itemdescription, userid, picture, username,firstname, profilepicture, views FROM items, users WHERE $user <> `userid` AND itemname LIKE '%" . $name .  "%' && items.userid = users.id"; 
		  //-run  the query against the mysql query function 
		  		$result=$db->query($sql); 
		  //-create  while loop and loop through result set 
		  		while($result && $row = $result->fetch_assoc()){ 
		          $items[]  =$row;
		   		}

		   		$sql ="SELECT r.id, r.decision, r.item, r.item2, i.itemname, r.requester FROM `items` i, `requests` r WHERE i.userid <> $user  AND i.itemid = r.item OR i.itemid = r.item2 ORDER BY r.timerequested DESC,  r.decision DESC;";

		   		$result=$db->query($sql); 
		  //-create  while loop and loop through result set 
		  		while($result && $row = $result->fetch_assoc()){ 
		        	$requests[] = $row;
		   		}
		   		echo json_encode($items);
		   		$user = getCurrentUser();
				echo "<h1> Showing results for \"".$_POST['searchname']."\" </h1>";
		if($items != null){
			if($type == "item"){
		   			for($i = 0; $i < count($items); $i++) {
		  //-display the result of the array 
		   				//$ID = $val['userid'];
		   				$item = $items[$i];
		   				for($j = 0; $j < count($requests); $j++){
		   					$request = $requests[$j];
		   					if($request['item'] == $item['itemid'] || $request['item2'] == $item['itemid']){
		   						if($request['decision'] == true){
		   							break;
		   						}
		   						else{
		   							if($request['requester'] == $user){
		   								echo "<div class='panel panel-info'>";

			            				echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem(".$item['itemid'].")\"><strong>". $item['itemname'] . "</strong> </button><br><small> Views: ".$item['views']." </small><br></div>";
			          
			            				echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$item['itemid'].")\" src=\"" . $item['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";

			                			if($request['decision']==null){
			                				echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest(".$request['id'].")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div></div></div>";
			                			}
			                			else{
			                				echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest(".$item['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
			                			}
			            				
			             
			            				echo "</div>";
			            				break;
		   							}
		   						}
		   					}
		   				}
		   				if($j == count($requests)){
		   					echo "<div class='panel panel-info'>";

			            	echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem(".$item['itemid'].")\"><strong>". $item['itemname'] . "</strong> </button><br><small> Views: ".$item['views']." </small><br></div>";
			          
			            	echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$item['itemid'].")\" src=\"" . $item['picture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";
			                
			            	echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest(".$item['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
			             
			            	echo "</div>";
		   				}
		          		
	    			}

			}//end if($type == "item")
			else if($type == "users"){
		   			for($i = 0; $i < count($items); $i++) {
		  //-display the result of the array 
		   				//$ID = $val['userid'];
		   				$item = $items[$i];
		   				for($j = 0; $j < count($requests); $j++){
		   					$request = $requests[$j];
		   					if($request['item'] == $item['itemid'] || $request['item2'] == $item['itemid']){
		   						if($request['decision'] == true){
		   							break;
		   						}
		   						else{
		   							if($request['requester'] == $user){
		   								echo "<div class='panel panel-danger'>";

			            				echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem(".$item['itemid'].")\"><strong>". $item['firstname'] . "</strong> </button><br><small> Views: ".$item['views']." </small><br></div>";

			                			if($request['decision']==null){
			                				echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest(".$request['id'].")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div></div></div>";
			                			}
			                			else{
			                				echo "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest(".$item['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
			                			}
			            				
			             
			            				echo "</div>";
			            				break;
		   							}
		   						}
		   					}
		   				}
		   				if($j == count($requests)){
		   					echo "<div class='panel panel-danger'>";

			            	echo "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem(".$item['itemid'].")\"><strong>". $item['firstname'] . "</strong> </button><br></div>";
			          
			            	echo "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$item['itemid'].")\" src=\"" . $item['profilepicture'] . "\"  class='img-responsive img-thumbnail mx-auto'> </div>";
			             
			            	echo "</div>";
		   				}
		          		
	    			}

			}

		 }//end if($items == null)
		  		/*echo "<div class='panel panel-default'>";

	          echo "<div class='panel-heading'><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile(".$val['userid'].")\">" .  "<strong>" . $val['username'] . "</strong></button></div>";
	          echo "<div class='panel-body'> <div class='text-center lead'> <strong>".  $val['itemname'] . "</strong> </div> <img style='cursor: pointer;width:100%;' onclick=\"viewItem(".$val['itemid'].")\" src=\"" . $val['picture']  ."\"  class='img-responsive img-thumbnail mx-auto'> </div>";
	          echo "<div class='panel-footer'> <div class='row'><div class='col-lg-6'><button type='button' class='btn btn-success btn-block' onclick=\"displayItemsForRequest(".$val['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div><div class='col-lg-6'><button type='button' class='btn btn-info btn-block' onclick=\"viewItem(".$val['itemid'].")\"><i class='fa fa-eye fa-lg' aria-hidden='true'></i> View more</button> </div></div></div>";
	          echo "</div>"; */ 
	  
	  		if($items == null){ 
	  			echo  "<img src=../img/noresults.jpg style='width:100%; border-radius: 50px;' class='img-responsive img-thumbnail mx-auto'>"; 	  
	  		}//end if($items == null)
	  	} 
	} 	
}
	  ?>




      </div>
     <div class="col-xs-2">
    
    </div>

  </div>
</div>


