<?php
session_start();

function getDBConnection(){
	try{ 
		//$db = new mysqli("localhost","peertrading","k$3eYUdUz_Th","peertrading");
		$db = new mysqli("localhost","root","","peertrading");
		if ($db == null && $db->connect_errno > 0)return null;
		return $db;
	}catch(Exception $e){ } 
	return null;
}


function checkLogin($email, $password){
	$password = sha1($password);
	$sql = "SELECT * FROM `users` where `email`='$email' OR `username`='$email'";
	//print($email);
	$db = getDBConnection();
	//print_r($db);
	if($db != NULL){
		$res = $db->query($sql);
		if ($res && $row = $res->fetch_assoc()){
			if($row['password'] == $password){
				$_SESSION["user"] = $row['firstname'];
				$_SESSION["id"] = $row['id'];
				return $row['firstname'];
			}
				
		}
	}
	return false;
}

function checkLogin1($email, $securityQuestion, $sAnswer){
	$sAnswer = sha1($sAnswer);
	$sql = "SELECT * FROM `users` where `email`='$email' OR `username`='$email' AND `sQuestion` = '$securityQuestion' ";
	//print($email);
	$db = getDBConnection();
	//print_r($db);
	if($db != NULL){
		$res = $db->query($sql);
		if ($res && $row = $res->fetch_assoc()){
			if($row['sAnswer'] == $sAnswer){
				$_SESSION["user"] = $row['username'];
				return $row['firstname'];
			}
				
		}
	}
	return false;
}


function saveUser($username, $firstname, $lastname, $email, $password, $securityQuestion, $securityAnswer){
	$password = sha1($password);
	$securityAnswer = sha1($securityAnswer);
	$sql = "INSERT INTO `users` (`username`, `firstname`, `lastname`, `email`, `password`, `sQuestion`, `sAnswer`) VALUES ('$username', '$firstname', '$lastname', '$email', '$password','$securityQuestion','$securityAnswer');";
	$id = -1;
	$db = getDBConnection();
	if ($db != NULL){
		$res = $db->query($sql);
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
}
function saveTradeArrangement($requestId, $tradeDate, $tradeLocation){
	$sql = "INSERT INTO `trade` (`requestid`, `tradedate`, `tradelocation`) VALUES ($requestId, '$tradeDate', '$tradeLocation');";
	$id = -1;
	$db = getDBConnection();
	if ($db != NULL){
		$res = $db->query($sql);
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
}

function getRequestingMeetup(){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `requests` r, `trade` t where r.requester = '$userid' and r.id = t.requestid";
	$items =[];
	$db = getDBConnection();
		if ($db != NULL){
			$res = $db->query($sql);
			while($res && $row = $res->fetch_assoc()){
				$items[] = $row;
		}//while
		$db->close();
	}//if
	return $items;
}

function getRequestedMeetup(){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `requests` r, `trade` t where r.requestee = '$userid' AND r.id = t.requestid";
	$items =[];
	$db = getDBConnection();
		if ($db != NULL){
			$res = $db->query($sql);
			while($res && $row = $res->fetch_assoc()){
				$items[] = $row;
		}//while
		$db->close();
	}//if
	return $items;
}

function isExist($FBID){
	$sql = "SELECT * FROM `users` WHERE id = '$FBID';";
	$db = getDBConnection();
	if($db != NULL){
		$res = $db->query($sql);
		if($res && $row = $res->fetch_assoc()){
			//var_dump($data);
			if($row["id"]!=NUll)return true;
		}
		return false;
	}
}

function saveFBUser($FBUsername, $FBID){
	$sql = "INSERT INTO `users` (`id`,`username`) VALUES ('$FBID','$FBUsername');";
	$id = -1;
	$db = getDBConnection();
	if ($db != NULL){
		$res = $db->query($sql);
	
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
}


function saveProfile($contact, $interest, $tradables){
	$sql = "INSERT INTO profile (`contact`,`interest`,`tradables`) VALUES ($contact, 'interest', 'tradables')";
	try{
		$db = getDBConnection();
		if ($db != NULL){
			$db->query($sql);
			$id = $db->insert_id;
			if ($id >0)return TRUE;
		}
	}catch (Exception $e){}
	return FALSE;
}

function saveTransactions($User1,$User2,$item1,$item2){
	$sql = "INSERT INTO transaction(`user1`,`user2`,`item1`,`item2`) VALUES('$User1','$User2','$item1','$item2')";
	try{
		$db = getDBConnection();
		if ($db != NULL){
			$db->query($sql);
			$id = $db->insert_id;
			if ($id >0)return TRUE;
		}
	}catch (Exception $e){}
	return FALSE;
}

function saveItem($picture,$itemname, $itemDescription){

	$userid =$_SESSION['id'];
	//$sql = "INSERT INTO items(`userId`,`picture`,`itemDescription`) VALUES('userid','$picture','$itemDescription')"; */
	$db = getDBConnection();
	$userId = $_SESSION['id'];
	$sql = "INSERT INTO items(`itemname`, `userid`,`picture`,`itemdescription`) VALUES('$itemname','$userId','$picture','$itemDescription');";
	$id = -1;
	if ($db != NULL){
		$res = $db->query($sql);
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
}

function saveRating ($username,$ratings){
	//$oldrating = "SELECT rating FROM ratings WHERE username=$'username;";

	$sql = "INSERT INTO ratings(`username`,`rating`) VALUES ('$username','$rating')";
	try{
		$db = getDBConnection();
		if ($db != NULL){
			$db->query($sql);
			$id = $db->insert_id;
			if ($id >0)return TRUE;
		}
	}catch (Exception $e){}
	return FALSE;
}

function getRecentActivity(){
	$db = getDBConnection();
	$activity = [];

	if($db != NULL){
		$sql = "SELECT tradables FROM profile";

		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$activity[] = $row;
		}
		$db->close();
	}
	return $activity;
}

function getAllUsers(){
	$db = getDBConnection();
	$users = [];
	if ($db != null){
		$sql = "SELECT * FROM `users`";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$users[] = $row;
		}
		$db->close();
	}
	return $users;
}

function getCurrentUser(){
	return $_SESSION["id"];
}



function getAllUserItems(){//should be session id here instead of useId
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `items` where `userid` =$userID ORDER BY `uploaddate` DESC;";
	$items =[];
	//print($sql);
		$db = getDBConnection();
		if ($db != NULL){
			$res = $db->query($sql);
			while($res && $row = $res->fetch_assoc()){
			$items[] = $row;
		}//while
		$db->close();
	}//if
	return $items;
}

function getProfileItems($userID){//should be session id here instead of useId
	//$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `items` where `userid` = $userID ORDER BY `uploaddate` DESC;";
	$items =[];
	//print($sql);
		$db = getDBConnection();
		if ($db != NULL){
			$res = $db->query($sql);
			while($res && $row = $res->fetch_assoc()){
			$items[] = $row;
		}//while
		$db->close();
	}//if
	return $items;
}

function getAllUserTrade(){//should be session id here instead of useId
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `requests` r, `items` i, `users` u where r.item = i.itemid AND r.requestee = u.id AND  r.requester = $userID ORDER BY r.timerequested DESC;";
	$items =[];
	//print($sql);
		$db = getDBConnection();
		if ($db != NULL){
			$res = $db->query($sql);
			while($res && $row = $res->fetch_assoc()){
			$items[] = $row;
		}//while
		$db->close();
	}//if
	return $items;
}

function getUserItems($userid){//should be session id here instead of useId
	//$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `items` i, `users` u where u.id = i.userid AND `userid` = $userid ORDER BY `itemname` ASC;";
	$items =[];
	//print($sql);
		$db = getDBConnection();
		if ($db != NULL){
			$res = $db->query($sql);
			while($res && $row = $res->fetch_assoc()){
			$items[] = $row;
		}//while
		$db->close();
	}//if
	return $items;
}

function getAllItems(){//should be session id here instead of useId
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `items` i, `users` u WHERE i.userid = u.id AND `userid` <> $userID ORDER BY `uploaddate` DESC;";
	$items =[];
	//print($sql);
		$db = getDBConnection();
		if ($db != NULL){
			$res = $db->query($sql);
			while($res && $row = $res->fetch_assoc()){
			$items[] = $row;
		}//while
		$db->close();
	}//if
	return $items;
}

function getUserItem($val){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT * FROM items WHERE itemid = $val;";
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getUsername($val){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT `username` FROM `users` WHERE id = $val;";
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getRequests(){
	$user = $_SESSION["id"];
	$db = getDBConnection();
	$requests = [];
	if ($db != null){
		$sql = "SELECT * FROM `users` u, `requests` r, `items` i WHERE r.requester = u.id AND i.itemid = r.item AND r.requestee = $user AND `decision` IS NULL ORDER BY r.timerequested DESC;";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$requests[] = $row;
		}
		$db->close();
	}
	//var_dump($requests);
	return $requests;
}

function getRequestDetails($requestid){
	$user = $_SESSION["id"];
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT * FROM `requests` r, `items` i, `users` u WHERE r.requester = u.id AND i.itemid = r.item2 AND r.requestee = $user AND r.id = $requestid;";
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}
function getDecisions(){
	$user = $_SESSION["id"];
	$db = getDBConnection();
	$requests = [];
	if ($db != null){
		$sql = "SELECT * FROM `users` u, `requests` r, `items` i WHERE r.requester = u.id AND i.itemid = r.item AND r.requester = $user AND `decision` IS NOT NULL ORDER BY i.itemname ASC;";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$requests[] = $row;
		}
		$db->close();
	}
	//var_dump($requests);
	return $requests;
}

function getItemOwner($itemid){
	$db = getDBConnection();
	$user = null;
	if ($db != NULL){
		$sql = "SELECT * FROM `users` u, `items` i WHERE i.userid = u.id AND i.itemid = '$itemid';";
		$res = $db->query($sql);
		if ($res){
			$user = $res->fetch_assoc();
		}
		$db->close();
	}
	return $user;
} 

function getRequesteeId($requestee){
	$db = getDBConnection();
	$rec = null;
	if ($db != NULL){
		$sql = "SELECT `id` FROM `users` WHERE username = '$requestee';";
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getItemId($item){
	$db = getDBConnection();
	$rec = null;
	if ($db != NULL){
		$sql = "SELECT `itemid` FROM `items` WHERE itemname = '$item';";
		$res = $db->query($sql);
		if ($res){
			$rec= $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getItem($itemid){
	$db = getDBConnection();
	$rec = null;
	if ($db != NULL){
		$sql = "SELECT * FROM `items` WHERE itemid = '$itemid';";
		$res = $db->query($sql);
		if ($res){
			$rec= $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getItemImage($item){
	$db = getDBConnection();
	$rec = null;
	if ($db != NULL){
		$sql = "SELECT `picture` FROM `items` WHERE itemid = '$item';";
		$res = $db->query($sql);
		if ($res){
			$rec= $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}


function saveRequest($myItem, $requestee, $requestedItem){
	//$owner = getItemOwner($itemid);
	$requesteeId = getRequesteeId($requestee);
	$requestedItemId = getItemId($requestedItem);
	$rId = $requesteeId['id'];
	$iId = $requestedItemId['itemid'];
	//echo ($requesteeId['id']);
	$db = getDBConnection();
	$requester = $_SESSION['id'];
	$sql = "INSERT INTO `requests` (`requester`,`item2`,`requestee`,`item`) VALUES($requester,$myItem, $rId,$iId);";
	$id = -1;
	if ($db != NULL){
		$res = $db->query($sql);
			if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
} 

function getItemStatus($item){
	$db = getDBConnection();
	$rec = [];
	if ($db != NULL){
		$sql = "SELECT * FROM `items` i, `requests` r WHERE item = $item;";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$rec[] = $row;
		}
		$db->close();
	}
	return $rec;
}

//In progress
function getRequestStatus($item){
	$db = getDBConnection();
	$rec = [];
	if ($db != NULL){
		$sql = "SELECT * FROM `requests` WHERE `item` = $item AND `decision` = false;";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$rec[] = $row;
		}
		$db->close();
	}
	return $rec;
}

function deleteItem($itemid){
	$db = getDBConnection();
	$sql = "DELETE FROM `items` WHERE itemid = $itemid";
	$res = null;
	if ($db != NULL){
		$res = $db->query($sql);
		$db->close();
	}
	return $res;
} 


function acceptRequest($requestId){
	$db = getDBConnection();
	$sql = "UPDATE `requests` SET `decision` = true WHERE `id` = $requestId;";
	$res = null;
	if ($db != NULL){
		$res = $db->query($sql);
		
	}
	return $res;
}

function denyRequest($requestId){
	$db = getDBConnection();
	$sql = "UPDATE `requests` r SET `decision` = false WHERE r.id = $requestId;";
	$res = null;
	if ($db != NULL){
		$res = $db->query($sql);
		$db->close();
	}
	return $res;
}

function productViews($itemid){
	$sql = "UPDATE `items` i SET `views` = `views`+1 WHERE i.itemid = $itemid";
    $res = null;
    $db = getDBConnection();
    if ($db != NULL){
      $res = $db->query($sql);
      $db->close();
    }
  	return $res;
}

function updatePassword($password){
	$password = sha1($password);
	$user = $_SESSION["user"];
	$sql = "UPDATE `users` SET `password` = '$password' WHERE `username` = '$user' OR `email` = '$user'";
    $res = null;
    $db = getDBConnection();
    if ($db != NULL){
		
      $res = $db->query($sql);
      $db->close();
    }
	//echo $res;
  	return $res;
}

function getGraphData(){
	$user = $_SESSION["id"];
	$db = getDBConnection();
	$data = [];
	if ($db != null){
		$sql = "SELECT `itemname`, `views` FROM `items` WHERE `userid` <> $user ORDER BY views DESC LIMIT 5";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$data[] = $row;
		}
		$db->close();
	}
	return $data;

}


?>