<?php
require_once __DIR__.'/vendor/autoload.php'; //link the autoloader

session_start(); //start session for our access token pass
date_default_timezone_set('America/Los_Angeles'); //just need this

$client = new Google_Client(); //create a new client
$client->setAuthConfig('client_secrets.json'); //set the secret
$client->addScope(Google_Service_Calendar::CALENDAR); //whats our scope, read and write
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback2.php'); //our redirect url

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) { //we have our access token
  $client->setAccessToken($_SESSION['access_token']); //set the access token to our client
  $calendar = new Google_Service_Calendar($client);  //create a new calendar service
    
  /*Edit in here*/
  $events = $calendar->events->listEvents('primary');  //get all the events from (<calendarId>)

    while(true) { 
      foreach ($events->getItems() as $event) {  //loop through all events
        echo "Summary: ";
        echo $event->getSummary();  //display the title (summary)
        echo " | ID: ";
        echo $event->getId();
        echo "<br /><br />";
      }
      $pageToken = $events->getNextPageToken(); //if there is more results
      if ($pageToken) { 
        $optParams = array('pageToken' => $pageToken);
        $events = $service->events->listEvents('primary', $optParams);
      } else {
        break;
      }
    }
    
    echo "<form action='index.php' method='post'><input type='submit' value='back' name='listButton'></form>";
    
} 
else { //we don't have access token
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback2.php'; //set redirect variable
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect to url, sanitize if necessary
}
?>
