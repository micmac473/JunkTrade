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

function checkSavedItem($itemId, $itemOwner){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `saved` s where s.itemid = $itemId and s.userid = '$userid' and s.itemowner = $itemOwner;";
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;	
}

function addItemToSaved($itemId, $itemOwner){
	$userId = $_SESSION['id'];
	$itemExists = checkSavedItem($itemId, $itemOwner);
	//echo $itemExists;
	$db = getDBConnection();
	//var_dump($itemExists);
	$savedId = $itemExists['savedid'];

	if($itemExists == null){
		$sql = "INSERT INTO `saved` (`itemid`, `userid`, `itemowner`, `savedindicator`) VALUES ($itemId, $userId, $itemOwner, true);";
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
	else{
		$sql = "UPDATE `saved` s SET `savedindicator` = true WHERE `savedid` = $savedId;";
		$res = null;
			if ($db != NULL){
				$res = $db->query($sql);
				$db->close();
			}
		return $res;
	}	
}

function removeItemFromSaved($savedId){
	$db = getDBConnection();
	$sql = "UPDATE `saved` s SET `savedindicator` = false WHERE `savedid` = $savedId;";
	$res = null;
	if ($db != NULL){
		$res = $db->query($sql);
		$db->close();
	}
	return $res;
} 

function checkFollowee($followee){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `follow` f where f.followee = $followee and f.follower = '$userid';";
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;	
}

function addFollowee($followee){
	$follower = $_SESSION['id'];
	$db = getDBConnection();
	$followeeExists = checkFollowee($followee);
	$followId = $followeeExists['followid'];

	if($followeeExists == null){
		$sql = "INSERT INTO `follow` (`follower`, `followee`, `followindicator`) VALUES ($follower, $followee, true);";
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
	else{
		$sql = "UPDATE `follow` f SET `followindicator` = true WHERE `followid` = $followId;";
		$res = null;
			if ($db != NULL){
				$res = $db->query($sql);
				$db->close();
			}
		return $res;
	}
	
}

function removeFollowee($followee){
	$db = getDBConnection();
	$sql = "UPDATE `follow` f SET `followindicator` = false WHERE `followee` = $followee;";
	$res = null;
	if ($db != NULL){
		$res = $db->query($sql);
		$db->close();
	}
	return $res;
} 

function saveRequesterFeedback($tradeId, $rating, $comment){
	$db = getDBConnection();
	$sql = "UPDATE `trade` t SET `requesterfeedbackrating` = '$rating', `requesterfeedbackcomment` = '$comment', `requesterfeedbackindicator` = true WHERE `tradeid` = $tradeId;";
	$res = null;
	if ($db != NULL){
		$res = $db->query($sql);
		$db->close();
	}
	return $res;
} 

function saveRequesteeFeedback($tradeId, $rating, $comment){
	$db = getDBConnection();
	$sql = "UPDATE `trade` t SET `requesteefeedbackrating` = '$rating', `requesteefeedbackcomment` = '$comment', `requesteefeedbackindicator` = true WHERE `tradeid` = $tradeId;";
	$res = null;
	if ($db != NULL){
		$res = $db->query($sql);
		$db->close();
	}
	return $res;
} 

function getFollowID($userId){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `follow` f where f.followee = $userId and f.follower = $userid;";
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;	
}


function saveTradeArrangement($requestId, $tradeDate, $tradeLocation, $requesteeContact, $requesterContact){
	$sql = "INSERT INTO `trade` (`requestid`, `tradedate`, `tradelocation`,`requesteecontact`, `requestercontact`) VALUES ($requestId, '$tradeDate', '$tradeLocation','$requesteeContact','$requesterContact');";
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

function getRequestedMeetupRequestee(){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `requests` r, `trade` t, `users` u, `items` i where r.id = t.requestid and r.requestee = u.id and r.item = i.itemid and r.requester = '$userid' AND t.requesterfeedbackindicator = false;";
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

function getRequestedMeetupRequester(){
	$userid = $_SESSION['id'];
	$sql = "SELECT `itemname` FROM `requests` r, `trade` t, `users` u, `items` i where r.requester = '$userid' and r.id = t.requestid and r.item2 = i.itemid and r.requester = u.id ;";
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

function getRequestsMeetupRequestee(){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `requests` r, `trade` t, `items` i, `users` u where r.requestee = '$userid' and r.id = t.requestid and r.item = i.itemid and r.requestee = u.id ;";
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

function getRequestsMeetupRequester(){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `requests` r, `trade` t, `items` i, `users` u where r.requestee = '$userid' and r.id = t.requestid and r.item2 = i.itemid and r.requester = u.id AND t.requesteefeedbackindicator = false;";
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


function getAcceptedUserItems(){
	$userid = $_SESSION['id'];
	$sql = "SELECT * FROM `requests` r WHERE r.requestee = $userid OR r.requester = $userid;";
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



function getAllUserItems(){
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

function getUserSavedItems(){
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `saved` s, `items` i, `users` u WHERE s.itemid = i.itemid AND i.userid = u.id AND s.userid = $userID AND `savedindicator` = true ORDER BY `saveddate` DESC;";
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

function getUserFollowees(){
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `follow` f, `users` u WHERE f.followee = u.id AND f.follower = $userID AND `followindicator` = true ORDER BY `followdate` DESC;";
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

function getUserFollowers(){
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `follow` f, `users` u WHERE f.follower = u.id AND f.followee = $userID AND `followindicator` = true ORDER BY `followdate` DESC;";
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

function getProfileItems($userID){
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
	$sql ="SELECT r.requestee, u.username, i.itemid, i.itemname, r.timerequested, r.decision, r.id FROM `requests` r, `items` i, `users` u where r.item = i.itemid AND r.requestee = u.id AND  r.requester = $userID ORDER BY r.timerequested DESC;";
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

function getAllItems(){
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

function getAllUserRequests(){
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `items` i, `requests` r WHERE i.itemid = r.item AND r.requester = $userID AND i.userid <> $userID  ORDER BY `uploaddate` DESC;";
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

function getAllNonUserItemsState(){
	$userID = $_SESSION["id"];
	//$sql ="SELECT r.id, r.decision, r.item, r.item2 FROM `items` i, `requests` r, `users` u WHERE i.itemid = r.item AND i.userid = u.id AND i.userid <> $userID  ORDER BY r.timerequested DESC;";
	//$sql = "SELECT * FROM `requests` r WHERE r.requestee = $userID OR r.requester = $userID;";
	$sql ="SELECT r.id, r.decision, r.item, r.item2, i.itemname, r.requester FROM `items` i, `requests` r WHERE i.userid <> $userID  AND i.itemid = r.item OR i.itemid = r.item2 ORDER BY r.timerequested DESC;";

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

function getRequesterItemsState(){
	$userID = $_SESSION["id"];
	$sql ="SELECT r.id, r.requester, r.decision, r.item FROM `items` i, `requests` r, `users` u WHERE i.itemid = r.item2 AND i.userid = u.id AND i.userid <> $userID  ORDER BY r.timerequested DESC;";
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

function getAllNonUserItemRequestsForSpecificTrader($requestee){
	$userID = $_SESSION["id"];
	$sql ="SELECT * FROM `requests` r WHERE r.requester = $userID AND r.requestee = $requestee ORDER BY r.timerequested DESC;";
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

function getItemImages($itemId){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT  i.picture, i.picture2, i.picture3 FROM `items` i WHERE i.itemid = $itemId;";
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getRequesterInfo($requestId){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT `username`, `itemname`, `requestercontact` FROM `requests` r, `items` i, `users` u WHERE r.id = $requestId AND r.requester = u.id AND r.item2 = i.itemid;" ;
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getRequesteeInfo($requestId){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT `itemname` FROM `requests` r, `items` i, `users` u WHERE r.id = $requestId AND r.requestee = u.id AND r.item = i.itemid;" ;
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


function getRequesterItem(){
	$userId = $_SESSION["id"];
	$db = getDBConnection();
	$requests = [];
	if ($db != null){
		$sql = "SELECT i.itemname, r.item2 FROM `requests` r, `items` i WHERE i.itemid = r.item2 AND r.requestee = $userId AND `decision` IS NULL ORDER BY r.timerequested DESC;";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$requests[] = $row;
		}
		$db->close();
	}
	//var_dump($requests);
	return $requests;
}

function getRequests(){
	$user = $_SESSION["id"];
	$db = getDBConnection();
	$requests = [];
	if ($db != null){
		$sql = "SELECT u.username, r.id, r.requester, i.itemname FROM `users` u, `requests` r, `items` i WHERE r.requester = u.id AND i.itemid = r.item AND r.requestee = $user AND `decision` IS NULL ORDER BY r.timerequested DESC;";
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
		$sql = "SELECT * FROM `items` i WHERE i.itemid = $itemid;";
		$res = $db->query($sql);
		if ($res){
			$rec= $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function getItemRequestForCurrentUser($itemid){
	$userId = $_SESSION["id"];
	$db = getDBConnection();
	$rec = null;
	if ($db != NULL){
		$sql = "SELECT * FROM `requests` r WHERE r.item = $itemid  AND r.requester = $userId ORDER BY r.timerequested DESC LIMIT 1;";
		$res = $db->query($sql);
		if ($res){
			$rec = $res->fetch_assoc();
		}
		$db->close();
	}
	return $rec;
}

function checkItemSaved($itemid){
	$userId = $_SESSION["id"];
	$db = getDBConnection();
	$rec = null;
	if ($db != NULL){
		$sql = "SELECT * FROM `saved` s WHERE s.itemid = $itemid AND s.userid = $userId;";
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

function getProfileImage($userid){
  $db = getDBConnection();
  $rec = null;
  if ($db != NULL){
    $sql = "SELECT `profilepicture` FROM `users` WHERE id = '$userid';";
    $res = $db->query($sql);
    if ($res){
      $rec= $res->fetch_assoc();
      
    }
    $db->close();
  }

  $pp =  json_encode($rec['profilepicture']);
if($pp == "null"){
return "<img src=../img/defaultPP.jpg style='width:auto; height: 150px; max-width: 150px; border-radius: 50px;' class='img-responsive img-thumbnail mx-auto'>";
 }
 else{
 return "<img src= $pp style='width:auto; height: 150px; max-width: 150px; border-radius: 50px;' class='img-responsive img-thumbnail mx-auto'>"; 
}
	
}

function saveRequest($requestee, $requesteeItem, $requesterItem, $requesterContact){
	//$owner = getItemOwner($itemid);
	$requesteeId = getRequesteeId($requestee);
	$requesteeItemId = getItemId($requesteeItem);
	$rId = $requesteeId['id'];
	$iId = $requesteeItemId['itemid'];
	//echo ($requesteeId['id']);
	$db = getDBConnection();
	$requester = $_SESSION['id'];
	$sql = "INSERT INTO `requests` (`requester`,`item2`,`requestercontact`, `requestee`,`item`) VALUES($requester,$requesterItem, '$requesterContact', $rId,$iId);";
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

function cancelRequest($requestId){
	$db = getDBConnection();
	$sql = "DELETE FROM `requests`  WHERE  id= $requestId";
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