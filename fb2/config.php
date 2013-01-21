<?php
include_once("inc/facebook.php"); //include facebook SDK
 
######### edit details ##########
$appId = 'xxxxxxxxxxxxxxxxx'; //Facebook App ID
$appSecret = 'xxxxxxxxxxxxxxxxxxxxxxx'; // Facebook App Secret
$return_url = 'http://localhost/publish_to_wall/process.php';  //return url (url to script)
$homeurl = 'http://localhost/publish_to_wall/';  //return to home
$fbPermissions = 'publish_stream,manage_pages';  //Required facebook permissions
##################################

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret
));

$fbuser = $facebook->getUser();
?>