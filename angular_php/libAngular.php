<?php
include("../lib.php");

function allUserDetails(){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT u.fbid, u.username, u.firstname, u.lastname, u.email, u.telephone FROM `users` u ORDER BY username ASC";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$users[] = $row;
		}
		$db->close();
	}
	return $users;
}

function allItemDetails(){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT u.username, i.itemname, i.itemdescription, i.uploaddate FROM `items` i ,`users` u WHERE u.id = i.userid ORDER BY username ASC ";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$items[] = $row;
		}
		$db->close();
	}
	return $items;
}

function allRequestDetails(){
	$db = getDBConnection();
	$rec = null;
	if ($db != null){
		$sql = "SELECT requester, item2, requestee, item, decision, timerequested, denyreason  FROM `requests` ORDER BY decision ASC";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$requests[] = $row;
		}
		$db->close();
	}
	return $requests;
}