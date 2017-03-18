<?php

$client = new Google_Client();  //client object | Primary container for configeraion stuff
$client->setApplicationName("My_Application");
$client->setAuthConfig('client_secret.jaon');
$client->setAccessType("offline");  //allows us to access offline
$client->setIncludeGrantedScopes(true); //incremental authenticaion ******* NOT SURE WHAT THIS DOES
$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY); //View metadata for files in your Google Drive
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php'); //our redirect url
$client->setDeveloperKey("<API KEY GOES HERE!!!!");  //sets simple API key
//API keys are for when we DO NOT want to access private user data

$auth_url = $client->createAuthUrl(); //Generate a URL to request access from Google's OAuth 2.0 server
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL)); //Redirect the user to $auth_url

//the user gets a new window prompting them to give us access to their data
//We get redirected back to the redirect URL above


//One of two things can happen now
//1. We get an error message similar to this: https://oauth2.example.com/auth?error=access_denied
//The user declined our access
//2. We get a authorization code similar to this 
// https://oauth2.example.com/auth?code=4/P7q7W91a-oMsCeLvIaQm6bTrgtp7
//The user granted our access

//The redirect URL will most likely be http://localhost/oauth2callback



//ERROR HANDLEING

//we got a error back now what

//ERROR HANDLEING



//We are granted access now what
//We will first echange the authorization code for an access token
$client->authenticate($_GET['code']); //store our auth code
$access_token = $client->getAccessToken(); //retrieve our access token and store it

//If you need to apply an access token to a new Google_Client object
//for example, if you stored the access token in a user session, use the setAccessToken method
$client->setAccessToken($access_token);

//Now lets build a service
//call the API wiht an authorized google_client
$drive = new Google_Service_Drive($client);

//Now we can make API calls
$files = $drive->files->listFiles(array())->getItems(); //list the files in the users google drive







////this is for books!!!!!!!!!!!!
$service = new Google_Service_BookS($client); //service object 
//Takes the client object and returns classes for IO, authentication and scope information

//API calls
//Usually a chain call to a function for API specific stuff like making a calender entry
$optParams = array('filter' => 'free-ebooks'); //filter for free books
$results = $service->volumes->listVolumes('Henry David Thoreau', $optParams); 
//list the free books with name Henry David...


//two main types of responses ITEMS and COLLECTIONS
foreach ($results as $items) {  //set each item found to $item and loop though all
    echo $item['volumeInfo']['title'], "<br /> \n"; //display the volume and title
}