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
    
  /*Edit in here*/
  $events = $calendar->events->listEvents('primary');  //get all the events from (<calendarId>)

    while(true) { 
      foreach ($events->getItems() as $event) {  //loop through all events
        echo $event->getSummary();  //display the title (summary)
        echo "<br />";
        echo $event->getId();
      }
      $pageToken = $events->getNextPageToken(); //if there is more results
      if ($pageToken) { 
        $optParams = array('pageToken' => $pageToken);
        $events = $service->events->listEvents('primary', $optParams);
      } else {
        break;
      }
    }
    
    /*ABOVE: gets the events summaries and id*/
    /*BELOW: updates the summary of an event, NEEDS eventID ' st30asql513jpmotlid1u5ket8 ' */
    
    echo "<br /><br />";
    // First retrieve the event from the API.
    $event = $calendar->events->get('primary', 'st30asql513jpmotlid1u5ket8'); //last param is the eventID

    $event->setSummary('Appointment at Somewhere');

    $updatedEvent = $calendar->events->update('primary', $event->getId(), $event);

    // Print the updated date.
    echo $updatedEvent->getUpdated();
    
   /*Edit in here*/  
    
} 
else { //we don't have access token
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php'; //set redirect variable
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect to url, sanitize if necessary
}
?>
