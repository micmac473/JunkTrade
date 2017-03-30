<?php
require 'vendor/autoload.php';
include 'lib.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\App as App;
use \Slim\Container as Container;
use Slim\Views\PhpRenderer as PhpRenderer;
use Slim\Views\Twig as Twig;



$configuration = [
		'settings' => [
				'displayErrorDetails' => true,
		],
		'renderer' => new Twig("./templates")
];
$container = new Container($configuration);
$app = new App($container);

// Uses a PHP templating system to display HTML when requested
$app->get('/', function (Request $request, Response $response) {
	return $this->renderer->render($response, "/index.phtml");//this should be index.phtml as opped to base
});

$app->get('/templates/login.phtml', function (Request $request, Response $response) {
	return $this->renderer->render($response, "/base.phtml");//this should be index.phtml as opped to base
});

$app->get('/templates/registration.phtml', function (Request $request, Response $response) {
	return $this->renderer->render($response, "/registration.phtml");//this should be index.phtml as opped to base
});

$app->get("/users", function(Request $request, Response $response){
	$users = getAllUsers();
	
	$response = $response->withJson($users);
	return $response;
});

$app->get("/user", function(Request $request, Response $response){
	$user = getCurrentUser();
	
	$response = $response->withJson($user);
	return $response;
});

$app->get("/items/{id}", function(Request $request, Response $response){
	$userID = $request->getAttribute('id');
	$items = getUserItems($userID);
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/edititem/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$item = getUserItem($val);
	
	if($item > 0){
		$response = $response->withJson($item);
	}
	else{
		$response = $response->withStatus(404);
	}
	return $response;
});

$app->get("/owner/{id}", function(Request $request, Response $response){
	$userID = $request->getAttribute('id');
	$owner = getItemOwner($userID);
	
	$response = $response->withJson($owner);
	return $response;
});

$app->get("/items", function(Request $request, Response $response){
	$items = getAllItems();
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/userrequests", function(Request $request, Response $response){
	$items = getAllUserRequests();
	
	$response = $response->withJson($items);
	return $response;
});





$app->get("/requests", function(Request $request, Response $response){
	$requests = getRequests();
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/decisions", function(Request $request, Response $response){
	$decisions = getDecisions();
	
	$response = $response->withJson($decisions);
	return $response;
});

$app->get("/requester/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$requests = getRequesterInfo($val);
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/requestee/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$requests = getRequesteeInfo($val);
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/itemimages/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$requests = getItemImages($val);
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/requestdetails/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$request = getRequestDetails($val);
	
	$response = $response->withJson($request);
	return $response;
});

$app->get("/acceptrequest/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$requests = acceptRequest($val);
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/denyrequest/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$requests = denyRequest($val);
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/homepage/{id}", function(Request $request, Response $response){
	$sort = $request->getAttribute('id');
	$items = getAllItems($sort);
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/data", function(Request $request, Response $response){
	$data = getGraphData();
	
	$response = $response->withJson($data);
	return $response;
});

$app->get("/profile", function(Request $request, Response $response){
	$items = getAllUserItems();
	
	$response = $response->withJson($items);
	return $response;
});

// Retrieves all the items that the logged in user has saved
$app->get("/getsaveditems", function(Request $request, Response $response){
	$items = getUserSavedItems();
	
	$response = $response->withJson($items);
	return $response;
});

// Retrieves all the people that the logged in user has followed
$app->get("/followees", function(Request $request, Response $response){
	$items = getUserFollowees();
	
	$response = $response->withJson($items);
	return $response;
});

// Retrieves all the people that has followed the logged in user
$app->get("/followers", function(Request $request, Response $response){
	$items = getUserFollowers();
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/trade", function(Request $request, Response $response){
	$items = getAllUserTrade();
	
	$response = $response->withJson($items);
	return $response;
});


$app->get("/outgoingrequestitems", function(Request $request, Response $response){
	
	$items = getOutgoingRequestItems();
	$response = $response->withJson($items);
	return $response;
});

$app->get("/acceptedtradestatus", function(Request $request, Response $response){
	$items = getAcceptedTradeStatus();
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/login", function(Request $request, Response $response){
	$items = checkLogin("micmcm","micmcm");
	
	$response = $response->withJson($items);
	return $response;
});


$app->get("/request", function(Request $request, Response $response){
	$items = saveRequest(2,"rastaman","Cloud Server");
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/requestedmeetuprequestee", function(Request $request, Response $response){
	$items = getRequestedMeetupRequestee();
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/requestedmeetuprequester", function(Request $request, Response $response){
	$items = getRequestedMeetupRequester();
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/requestsmeetuprequestee", function(Request $request, Response $response){
	$items = getRequestsMeetupRequestee();
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/requestsmeetuprequester", function(Request $request, Response $response){
	$items = getRequestsMeetupRequester();
	
	$response = $response->withJson($items);
	return $response;
});


// Retrieves all meet ups for the current user
$app->get("/usermeetup", function(Request $request, Response $response){
	$events = getUserMeetUp();
	
	$response = $response->withJson($events);
	return $response;
});

// Retrieves all meet ups for the current user
$app->get("/userfollowerupdates", function(Request $request, Response $response){
	$events = getUserFollowerUpdates();
	
	$response = $response->withJson($events);
	return $response;
});

$app->get("/userfollowerupdatesrequests", function(Request $request, Response $response){
	$requests = getUserFollowerUpdatesRequests();
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/gettradehistoryrequested", function(Request $request, Response $response){
	$trades = getTradeHistoryRequested();
	
	$response = $response->withJson($trades);
	return $response;
});

$app->get("/gettradehistoryrequesteduserinfo", function(Request $request, Response $response){
	$trades = getTradeHistoryRequestedUserInfo();
	
	$response = $response->withJson($trades);
	return $response;
});

$app->get("/gettradehistoryrequests", function(Request $request, Response $response){
	$trades = getTradeHistoryRequests();
	
	$response = $response->withJson($trades);
	return $response;
});

$app->get("/gettradehistoryrequestsuserinfo", function(Request $request, Response $response){
	$trades = getTradeHistoryRequestsUserInfo();
	
	$response = $response->withJson($trades);
	return $response;
});

/*app->get("/gettradehistoryrequesteduserinfo", function(Request $request, Response $response){
	$trades = getTradeHistoryRequestedUserInfo();
	
	$response = $response->withJson($trades);
	return $response;
});

$app->get("/gettradehistoryrequestsuserinfo", function(Request $request, Response $response){
	$trades = getTradeHistoryRequestsUserInfo();
	
	$response = $response->withJson($trades);
	return $response;
}); */


$app->get("/incomingrequestshistoryrequester", function(Request $request, Response $response){
	$incoming = getIncomingRequestsHistory();
	
	$response = $response->withJson($incoming);
	return $response;
});

$app->get("/incomingrequestshistoryuser", function(Request $request, Response $response){
	$incoming = getIncomingRequestsHistoryUser();
	
	$response = $response->withJson($incoming);
	return $response;
});

$app->get("/request/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = saveRequest($val);
	if ($rec > 0){
		$response = $response->withStatus(201);
		$response = $response->withJson(array( "id" => $rec));
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->get("/itemstatus/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = getItemStatus($val);

	$response = $response->withJson($rec);
	return $response;
	/*
	if ($rec){
		$response = $response->withStatus(201);
		$response = $response->withJson(true);
	} else {
		$response = $response->withJson(false);
	}
	return $response; */
});

$app->get("/requeststatus/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = getRequestStatus($val);
	$response = $response->withJson($rec);
	return $response;
	/*if ($rec){
		$response = $response->withStatus(201);
		$response = $response->withJson(true);
	} else {
		$response = $response->withJson(false);
	}
	return $response; */
});

$app->get("/deleteitem/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = deleteItem($val);
	if ($rec){
		$response = $response->withStatus(201);
		$response = $response->withJson(array( "deleted" => $rec));
	} else {
		$response = $response->withJson(false);
	}
	return $response;
});


$app->get("/viewitem/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = productViews($val);
	//echo $rec;
	$response = $response->withJson($rec);
	return $response;
});

$app->get("/getitem/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	
	$rec = getItem($val);
	$response = $response->withJson($rec);
	return $response;
});


$app->get("/requesteritem", function(Request $request, Response $response){
	
	$items = getRequesterItem();
	$response = $response->withJson($items);
	return $response;
});



$app->get("/accepteduseritems", function(Request $request, Response $response){
	
	$items = getAcceptedUserItems();
	$response = $response->withJson($items);
	return $response;
});

$app->get("/allnonuseritemsstate", function(Request $request, Response $response){
	$items = getAllNonUserItemsState();
	
	$response = $response->withJson($items);
	return $response;
});

$app->get("/newmessages", function(Request $request, Response $response){
	$messages = getNewMessages();
	
	$response = $response->withJson($messages);
	return $response;
});

$app->get("/newmessagesnotification", function(Request $request, Response $response){
	$messages = getNewMessagesNotification();
	
	$response = $response->withJson($messages);
	return $response;
});
$app->get("/userstatus/{id}", function(Request $request, Response $response){
	$traderId = $request->getAttribute('id');
	$status = getUserStatus($traderId);
	
	$response = $response->withJson($status);
	return $response;
});

$app->get("/getmessages/{id}", function(Request $request, Response $response){
	$traderId = $request->getAttribute('id');
	$messages = getMessages($traderId);
	
	$response = $response->withJson($messages);
	return $response;
});

$app->get("/getusername/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = getUsername($val);
	//$rec = addItemToSaved($val, 1);

	$response = $response->withJson($rec);
	return $response;
});

// Testing the function that checks if an item has been saved already
$app->get("/checkitemsaved/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = checkSavedItem($val, 1);
	//$rec = addItemToSaved($val, 1);

	$response = $response->withJson($rec);
	return $response;
});



$app->post("/login", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	//var_dump($post);
	$email = $post['email'];
	$password = $post['password'];
	//print_r($post);
	// print "Name: $name, Price:$price, Country: $countryId";
	$res = checkLogin($email, $password);
	//print_r ($res);
	if ($res != false){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withJson(400);
	}
	return $response;
});

$app->post("/login1", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	//var_dump($post);
	$email = $post['email'];
	$securityQuestion = $post['securityquestion'];
	$sAnswer = $post['sAnswer'];
	//print_r($post);
	// print "Name: $name, Price:$price, Country: $countryId";
	$res = checkLogin1($email, $securityQuestion, $sAnswer);
	//print_r ($res);
	if ($res != false){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withJson(400);
	}
	return $response;
});

$app->post("/register", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$username = $post['username'];
	$firstname = $post['firstname'];
	$lastname = $post['lastname'];
	$email = $post['email'];
	$telephone = $post['telephone'];
	//$address = $post['address'];
	$password = $post['password'];
	$securityQuestion = $post['securityquestion'];
	$securityAnswer = $post['securityanswer'];
	//print_r($post);
	// print "Name: $name, Price:$price, Country: $countryId";
	$res = saveUser($username, $firstname, $lastname, $email, $telephone, $password, $securityQuestion, $securityAnswer);
	//print_r ($res);
	if ($res){
		$response = $response->withStatus(201);
		$response = $response->withJson(array( "id" => $res));
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
	//return $this->renderer->render($response, "/login.html");
});

$app->post("/update", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$password = $post['password'];
	
	$res = updatePassword($password);
	//var_dump($res);
	if ($res == 1){
		$response = $response->withStatus(201);
		$response = $response->withJson(array(true));
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
	//return $this->renderer->render($response, "/login.html");
});

$app->post("/additem", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	//var_dump($post);

	/*$filetmp = $_FILES["image"]["tmp_name"];
	$filename = $_FILES["image"]["name"];
	$filetype = $_FILES["image"]["type"];
	$filepath = "img/".$filename;
	
	move_uploaded_file($filetmp,$filepath);
	print_r($filetmp); */

	$imagePath = "../img/".$post['image'];
	$itemName = $post['itemname'];
	$itemDescription = $post['itemdescription'];
	//print_r($post);
	// print "Name: $name, Price:$price, Country: $countryId";
	$res = saveItem($imagePath, $itemName, $itemDescription);
	//print_r ($res);
	if ($res > 0){
		$response = $response->withStatus(201);
		$response = $response->withJson(array( "id" => $res));
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/request", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$requestee = $post['requestee'];
	$requesteeItem = $post['requesteeitem'];
	$requesterItem = $post['requesteritem'];
	$requesterContact = $post['requestercontact'];

	$res = saveRequest($requestee, $requesteeItem, $requesterItem, $requesterContact);
	
	if ($res > 0){
		$response = $response->withStatus(201);
		$response = $response->withJson(array("id" => $res));
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/acceptrequest", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$requestId = $post['requestid'];
	$requesteeItem = $post['requesteeitem'];
	$requesterItem = $post['requesteritem'];

	$res = acceptRequest($requestId, $requesteeItem, $requesterItem);
	
	if ($res){
		$response = $response->withStatus(201);
		$response = $response->withJson(array("id" => $res));
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/denyrequest", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$requestId = $post['requestid'];
	$denyReason = $post['denyreason'];

	$res = denyRequest($requestId, $denyReason);
	
	if ($res){
		$response = $response->withStatus(201);
		$response = $response->withJson(array("id" => $res));
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/tradearrangement", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$requestId = $post['requestid'];
	$tradeDate = $post['tradedate'];
	$tradeLocation = $post['tradelocation'];
	$requesteeContact = $post['requesteecontact'];
	$requesterContact = $post['requestercontact'];
	$res = saveTradeArrangement($requestId, $tradeDate, $tradeLocation, $requesteeContact, $requesterContact);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/saveitem", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$itemId = $post['itemid'];
	$itemOwner = $post['itemowner'];
	$res = addItemToSaved($itemId, $itemOwner);
	if ($res > 0 || $res == true){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/removedsaveditem", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$savedId = $post['savedid'];
	$res = removeItemFromSaved($savedId);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/follow", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$followee = $post['followee'];

	$res = addFollowee($followee);
	if ($res > 0 || $res == true){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/unfollow", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$followee = $post['followee'];
	$res = removeFollowee($followee);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/requesterfeedback", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$tradeId = $post['tradeid'];
	$rating = $post['rating'];
	$comment = $post['comment'];
	$res = saveRequesterFeedback($tradeId, $rating, $comment);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/requesteefeedback", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$tradeId = $post['tradeid'];
	$rating = $post['rating'];
	$comment = $post['comment'];
	$res = saveRequesteeFeedback($tradeId, $rating, $comment);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/cancelrequest", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$requestId = $post['requestid'];
	$res = cancelRequest($requestId);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});


$app->post("/setrequeststoviewed", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$requestId = $post['requestid'];
	$res = setRequestToViewed($requestId);
	
	$response = $response->withJson($res);
	return $response;
});

$app->post("/sendmessage", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$sentFrom = $post['sentfrom'];
	$sentTo = $post['sentto'];
	$message = $post['message'];
	$res = saveMessage($sentFrom, $sentTo, $message);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson(array("id"=>$res));
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/readmessage", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$chatId = $post['chatid'];
	$res = readMessage($chatId);
	/*if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson(array("id"=>$res));
		
	} else {
		$response = $response->withStatus(400);
	} */
	$response = $response->withJson($res);
	return $response;
});

$app->post("/changetradedate", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$tradeId = $post['tradeid'];
	$newTradeDate = $post['newtradedate'];
	$res = changeTradeDate($tradeId, $newTradeDate);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/changetradelocation", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$tradeId = $post['tradeid'];
	$newTradeLocation = $post['newtradelocation'];
	$res = changeTradeLocation($tradeId, $newTradeLocation);
	if ($res){
		//$name = $_SESSION["name"];
		$response = $response->withStatus(201);
		$response = $response->withJson($res);
		
	} else {
		$response = $response->withStatus(400);
	}
	return $response;
});

$app->post("/logout", function(Request $request, Response $response){
	$post = $request->getParsedBody();
	$userId = $post['userid'];
	$res = logout($userId);
});

$app->run();

