<?php
require_once __DIR__.'/vendor/autoload.php';  //set autoloader

session_start();  //start session for authcode

$client = new Google_Client();  //create a client
$client->setAuthConfigFile('client_secrets.json');  //set secret
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback2.php');  //set redirect url
$client->addScope(Google_Service_Calendar::CALENDAR); //set our scope

if (! isset($_GET['code'])) {  //if we don't have the code yet
  $auth_url = $client->createAuthUrl(); //create an authentication link
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL)); //ask the user for authentication
} 
else {  //we have been authenticated
  $client->authenticate($_GET['code']); //take the auth code and set it in client
  $_SESSION['access_token'] = $client->getAccessToken();  //set the access token to session var
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/signin-listEvent.php';  //redirect var to host address
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));  //last redirect
    //use this redirect to go to your handleing spot authenticaion is done at this point
}
?>