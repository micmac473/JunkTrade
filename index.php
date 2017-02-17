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

$app->get("/requestee", function(Request $request, Response $response){
	$requests = getRequesteeId("jamtart");
	
	$response = $response->withJson($requests);
	return $response;
});

$app->get("/itemimage/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	$requests = getItemImage($val);
	
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

$app->get("/homepage", function(Request $request, Response $response){
	$items = getAllItems();
	
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

$app->get("/trade", function(Request $request, Response $response){
	$items = getAllUserTrade();
	
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
	if ($rec){
		$response = $response->withStatus(201);
		$response = $response->withJson(true);
	} else {
		$response = $response->withJson(false);
	}
	return $response;
});

$app->get("/requeststatus/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = getRequestStatus($val);
	if ($rec){
		$response = $response->withStatus(201);
		$response = $response->withJson(true);
	} else {
		$response = $response->withJson(false);
	}
	return $response;
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

	$response = $response->withJson($rec);
	return $response;
});

$app->get("/getitem/{id}", function(Request $request, Response $response){
	$val = $request->getAttribute('id');
	// Get Record for Specific Country
	$rec = getItem($val);

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
	$sAnswer = $post['sAnswer'];
	//print_r($post);
	// print "Name: $name, Price:$price, Country: $countryId";
	$res = checkLogin1($email, $sAnswer);
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
	//$contact = $post['contact'];
	//$address = $post['address'];
	$password = $post['password'];
	$securityQuestion = $post['securityquestion'];
	$securityAnswer = $post['securityanswer'];
	//print_r($post);
	// print "Name: $name, Price:$price, Country: $countryId";
	$res = saveUser($username, $firstname, $lastname, $email, $password, $securityQuestion, $securityAnswer);
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
	$myItem = $post['myitem'];
	$requestee = $post['requestee'];
	$requestedItem = $post['requesteditem'];

	$res = saveRequest($myItem, $requestee, $requestedItem);
	
	if ($res > 0){
		$response = $response->withStatus(201);
		$response = $response->withJson(array("id" => $res));
		
	} else {
		$response = $response->withJson(400);
	}
	return $response;
});

$app->run();
