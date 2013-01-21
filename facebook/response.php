<?php
session_start();
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8"/>
<link href="custom.css" rel="stylesheet" type="text/css" />
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</head>
<body>
<div class="container">
<center><h2>LOGIN INTO YOUR ACCOUNT WITH FACEBOOK</h2></center>
<div  style="padding-left: 450px;" class="fb-like" data-href="http://www.facebook.com/Learnwebscripts" data-send="false" data-width="450" data-show-faces="true"></div>


<?php
  require_once("src/facebook.php");

$facebook = new Facebook(array(
  'appId'  => '233297683465645',
  'secret' => 'de692723f1d70b69e1edbae46c5ce0a8',
));

// Get User ID
$user = $facebook->getUser();

//the login url
$loginUrl = $facebook->getLoginUrl();

//the logout url
$logoutUrl = $facebook->getLogoutUrl();
?>
<div>
<?php
if($user) {

?>
<center>
<br /><br />
<b>YOUR FACEBOOK DETAILS</b><br /><br />
<?php
if ($user) {
$attachment = array('message' => 'this is my message',
    'name' => 'This is my demo Facebook application!',
    'caption' => "Caption of the Post",
    'link' => 'http://mylink.com/ ',
    'description' => 'this is a description',
    'picture' => 'http://mysite.com/pic.gif ',
    'actions' => array(array('name' => 'Get Search',
    'link' => 'http://www.google.com/ '))
    );

    try {
    // Proceed knowing you have a user who is logged in and authenticated
    $result = $facebook->api('/me/feed/','post',$attachment);
    } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
    }

}



            $user_profile = $facebook->api('/me');

			$friends = $facebook->api('/me/friends');
			$likes = $facebook->api('/me/likes');
			$checkins = $facebook->api('/me/checkins');

		
			print_r($likes[data]);
            echo "<b>Name:</b> " . $user_profile['name'].'<br/>'.'<br/>';
            echo "<b>First Name:</b> " . $user_profile['first_name'].'<br/>'.'<br/>';
            echo "<b>Last Name:</b> " . $user_profile['last_name'].'<br/>'.'<br/>';
            echo "<b>Facebook profile link:</b> " . $user_profile['link'].'<br/>'.'<br/>';
            echo "<b>Location:</b> " . $user_profile['location']['name'].'<br/>'.'<br/>';
            echo "<b>Gender:</b> " . $user_profile['gender'].'<br/>'.'<br/>';
            echo "<b>Timezone:</b> " . $user_profile['timezone'].'<br/>'.'<br/>';
			print_r($user_profile);
			echo '<img src="https://graph.facebook.com/'. $_SESSION['User']['id'] .'/picture" width="30" height="30"/>';
			
			
			

            ?>
            </center>
            <?php
     
}
else
{
    echo 'SOME PROBLEM OCCOURED WHILE CONNECTING FACEBOOK PLEASE LOGIN AGAIN'.'<br/>'.'<br/>';
   ?>
  <center style="padding-top: 50px;"><a href="<?php echo $loginUrl?>"><img src="images/facebook.png"/></a></center> 
   <?php
}
?>
</div>

</div>
</body>
</html>
