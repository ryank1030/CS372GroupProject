<?php
require_once __DIR__.'/vendor/autoload.php'; //link the autoloader

session_start(); //start session for our access token pass
date_default_timezone_set('America/Los_Angeles'); //just need this

$client = new Google_Client(); //create a new client
$client->setAuthConfig('client_secrets.json'); //set the secret
$client->addScope(Google_Service_Calendar::CALENDAR); //whats our scope, read and write
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php'); //our redirect url

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) { //we have our access token
  $client->setAccessToken($_SESSION['access_token']); //set the access token to our client
  $calendar = new Google_Service_Calendar($client);  //create a new calendar service
    
  $event = new Google_Service_Calendar_Event(array( //create our event
  'summary' => 'PHP test event',
  'start' => array(
    'date' => '2017-03-21',
  ),
  'end' => array(
    'date' => '2017-03-22',
  ),
));

$calendarId = 'primary';  //what calendar would you like to add too
$event = $calendar->events->insert($calendarId, $event); //add the event to our calendar
printf('Event created: %s\n', $event->htmlLink); //print that we created our event
    
    
} 
else { //we don't have access token
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php'; //set redirect variable
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect to url, sanitize if necessary
}
?>
