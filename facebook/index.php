<?php
session_start();
?>
<!DOCTYPE>
<html>
<head>
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

  $config = array();
  $config['appId'] = '233297683465645';
  $config['secret'] = 'de692723f1d70b69e1edbae46c5ce0a8';

  $facebook = new Facebook($config);


        $params = array(
				'scope'	=> 'manage_pages,user_likes,user_checkins,user_birthday,user_activities,publish_checkins,create_event,ads_management,read_friendlists,email,read_stream, publish_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos',
          'redirect_uri' => 'http://www.bizzer.co.il/resp/facebook/response.php'
        );
        
        $loginUrl = $facebook->getLoginUrl($params);
        
        
?>
<div>
&nbsp;
</div>
<center style="padding-top: 50px;"><a href="<?php echo $loginUrl?>"><img src="images/facebook.png"/></a></center>
</div>
</body>
</html>
