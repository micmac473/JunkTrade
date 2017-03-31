<?php

include "../lib.php";

$fb_name;
$fb_id;





//++++++++++++++++++++++++++++

require_once __DIR__ . '/src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '552065338336275',
  'app_secret' => 'fed80c20693c796130702fc8f4be751f',
  'default_graph_version' => 'v2.4',
  ]);
$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
  //++++++++++++++++++++++++++
  $url = "https://graph.facebook.com/v2.6/me?fields=id,first_name,gender,email,picture,cover&access_token={$accessToken}";
    $headers = array("Content-type: application/json");
    
       
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
     curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
     curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
     curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
       
     $st=curl_exec($ch); 
     $result=json_decode($st,TRUE);
     echo "My name: ".$result['name'];
     $fb_firstname =$result['first_name'];
     $fb_email =$result['email'];
     $fb_id =$result['id'];
     $shorten = substr($fb_id, 0, -12);  // returns "abcde"
     $shorten =intval($shorten);
     echo "<img src=".$result['cover']['source'].">";
     echo $result['name'].'has an is of '.$result['id'];
    /*$_SESSION["user"] = $fb_name;
    $_SESSION["id"] = $fb_id; */
   

  //++++++++++++++++++++++++++++++
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('552065338336275'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());

}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
      



  //$email = $_POST['email'];
  //$password = $_POST['password'];
  //p($post);
  // print "Name: $name, Price:$price, Country: $countryId";
    /*$_SESSION["user"] = $fb_name;
    $_SESSION["id"] = $fb_id; */


if(true){
  $res = isExist($fb_firstname);
  if($res == null){
      $sessionId = saveFBUser($fb_firstname,$fb_email, $fb_id);
      $_SESSION["id"] = $sessionId;
      login($sessionId);
  }
  else{
    $isFbId = isExistFbId($res['fbid']);
    
    if($isFbId == null){
      updateFbId($res['id'], $fb_id);
    }
    $_SESSION["id"] = $res['id'];
    login($res['id']);
  }
  $_SESSION["user"] = $fb_firstname;
  header('Location: homepage.php'); 
}

?>

