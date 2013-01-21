<?php
session_start();
?>
<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>
<?php
  require_once("facebook/src/facebook.php");

  $config = array();
  $config['appId'] = '233297683465645';
  $config['secret'] = 'de692723f1d70b69e1edbae46c5ce0a8';
  $facebook = new Facebook($config);
        $params = array(
				'scope'	=> 'email,read_stream, publish_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos',
          'redirect_uri' => curPageURL() . 'index.php'
        );

        $loginUrl = $facebook->getLoginUrl($params);   
		$user = $facebook->getUser();
		$logoutUrl = $facebook->getLogoutUrl();		

?>
<?php
error_reporting(0);
include_once 'wall/includes/db.php';
include_once 'wall/includes/functions.php';
include_once 'wall/includes/tolink.php';
include_once 'wall/includes/time_stamp.php';
include_once 'wall/session.php';

$Wall = new Wall_Updates();
$updatesarray=$Wall->Updates($uid);
?>
<!doctype html>
<html class="no-js">

	<head>
		<meta charset="utf-8"/>
		<title>ZENI</title>
		
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" media="all" href="css/style.css"/>
		<link href="wall/css/wall.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
		<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->
		
		
		<!-- JS -->
		<script src="js/jquery-1.6.4.min.js"></script>
		<script src="js/css3-mediaqueries.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/tabs.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<!-- include Cycle plugin -->
		<script type="text/javascript" src="http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js"></script>
		<script src="js/facebook.js"></script>
		 <script type="text/javascript" src="wall/js/jquery.oembed.js"></script>
		<script type="text/javascript" src="wall/js/wall.js"></script>
		<script type='text/javascript'>
		$(function(){
		  var prev;    
		  $('.button').hover(function(){
		  prev = $('.description_box').html();
			  $('.description_box').html(this.id);
		  }, function(){
			  $('.description_box').html(prev);
			  	$('.description_box').cycle({
					fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
				});
		  });
		})
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.description_box').cycle({
					fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
				});
			});
		</script>
		
			<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true,
				continuous: true,
				nextId: "slider1next",
				prevId: "slider1prev"
			});
			$("#slider2").easySlider({ 
				numeric: true
			});
		});	
	</script>	
	
	<script type="text/javascript">
			$(document).ready(function(){
				$('.boxgrid.slidedown').hover(function(){
					$(".cover", this).stop().animate({top:'-260px'},{queue:false,duration:300});
				}, function() {
					$(".cover", this).stop().animate({top:'0px'},{queue:false,duration:300});
				});
			});
		</script>
		
	

		
		<!-- Tweet -->
		<link rel="stylesheet" href="css/jquery.tweet.css" media="all"  /> 
		<script src="js/tweet/jquery.tweet.js" ></script> 
		<!-- ENDS Tweet -->
		<script type="text/javascript" src="js/easySlider1.7.js"></script> 
		<!-- superfish -->
		<link rel="stylesheet" media="screen" href="css/superfish.css" /> 
		<script  src="js/superfish-1.4.8/js/hoverIntent.js"></script>
		<script  src="js/superfish-1.4.8/js/superfish.js"></script>
		<script  src="js/superfish-1.4.8/js/supersubs.js"></script>
		<!-- ENDS superfish -->
		
		<!-- prettyPhoto -->
		<script  src="js/prettyPhoto/js/jquery.prettyPhoto.js"></script>
		<link rel="stylesheet" href="js/prettyPhoto/css/prettyPhoto.css"  media="screen" />
		<!-- ENDS prettyPhoto -->
		
		<!-- poshytip -->
		<link rel="stylesheet" href="js/poshytip-1.1/src/tip-twitter/tip-twitter.css"  />
		<link rel="stylesheet" href="js/poshytip-1.1/src/tip-yellowsimple/tip-yellowsimple.css"  />
		<script  src="js/poshytip-1.1/src/jquery.poshytip.min.js"></script>
		<!-- ENDS poshytip -->
		
		<!-- GOOGLE FONTS -->
		<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,300' rel='stylesheet' type='text/css'>
		
		<!-- Flex Slider -->
		<link rel="stylesheet" href="css/flexslider.css" >
		<script src="js/jquery.flexslider-min.js"></script>
		<!-- ENDS Flex Slider -->
		
		<!-- Less framework -->
		<link rel="stylesheet" media="all" href="css/lessframework.css"/>
		
		<!-- modernizr -->
		<script src="js/modernizr.js"></script>
		
		<!-- SKIN -->
		<link rel="stylesheet" media="all" href="css/skin.css"/>
		

	</head>
	
	<body lang="en">

	
		<header class="clearfix">
		
			<!-- top widget -->
			<div id="top-widget-holder">
				<div class="wrapper">
				<!-- top widget 
				<?php /* if(!$user) :  */?>
					<div class="login"><div class="right">התחבר | הרשמה</div><div class="left"><a href="</* ?php echo $loginUrl */?>"><img src="img/connect.png"/></a></div><div class="profesional" >בעל מקצוע ? לחץ כאן</div></div>
				<?php /* else: $user_profile = $facebook->api('/me','GET'); */?>	
					<div class="currentlogin"><div class="right"><?php /* echo '<img src="https://graph.facebook.com/'. $user .'/picture" width="50" height="50"/>' */ ?></div><div class="left"><?php/*  if ($user_profile['gender'] =='male'){echo 'ברוך הבא';} else {echo 'ברוכה הבאה';} */?></div><div class="firstname"><?php/*  echo $user_profile['name']  */?></div><div class="notification">יש לך 6 התראות חדשות</div></div>
				<?php /* endif; */ ?>	
				-->
					<div id="top-widget">
						<div class="padding">
						<ul  class="widget-cols clearfix">
								<li class="first-col">
									
									<div class="widget-block">
										<h4>Recent posts</h4>
										<div class="recent-post">
											<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
											<div class="post-head">
												<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
											</div>
										</div>
										<div class="recent-post">
											<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
											<div class="post-head">
												<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
											</div>
										</div>
										<div class="recent-post">
											<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
											<div class="post-head">
												<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
											</div>
										</div>
									</div>
								</li>
								
								<li class="second-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
									
								</li>
								
								<li class="third-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
					         		
								</li>
								
								<li class="fourth-col">
									
									<div class="widget-block">
										<h4>Dummy text</h4>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies ege. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
										<p>Pellentesque habitant morbi tristique senectus et netus et malesuada.</p>
									</div>
					         		
								</li>	
							</ul>				
						</div>
					</div>
				</div>
				<a href="#" id="top-open">Menu</a>
			</div>
			<!-- ENDS top-widget -->
		
			<div class="wrapper clearfix">
				
				<a href="index.html" id="logo"><img  src="img/newlogo.png" alt="Zeni" id="imglogo"></a>
				
				<nav>
					<ul id="nav" class="sf-menu">
						<li class="current-menu-item"><a href="index.html">ראשי</a></li>
						<li><a href="blog.html">אודותינו</a></li>
						<li><a href="page.html">שרותים ללקוחות</a>
							<ul>
								<li><a class="menu" href="#">מכרזים הפוכים</a></li>
								<li><a class="menu" href="#">הצעות מחיר</a></li>
								<li><a class="menu" href="#">הזמנת שרות אונליין</a></li>
								<li><a class="menu" href="#">השוואת מחירים</a></li>
								<li><a class="menu" href="#">שאל ת'מומחים</a></li>
							
							</ul>
						</li>
						<li><a href="page.html">שרותים לעסקים</a>
							<ul>
								<li><a href="#">אתר חינם לעסק</a></li>
								<li><a href="#">מערכת לניהול אתר</a></li>
								<li><a href="#">השתתפות במכרזים</a></li>
								<li><a href="#">מערכת לניהול העסק</a></li>
							</ul>
						</li>
						<li><a href="portfolio.html">דילים</a></li>
					</ul>
					<div id="combo-holder"></div>
				</nav>
			</div>
		</header>
		
		

		
		<!-- MAIN -->
		<div id="main">	
			<div class="wrapper">

				<!-- slider holder -->
				<div id="slider-holder" class="clearfix">
					
					<!-- slider -->
<div class="floated-content-home">
					
						<div class="entercode"><div class="codetitle">:קוד קנייה</div><div class="codeinput"> <input type="text" name="cpassword" id="cpassword" value="הזן כאן את הקוד שקיבלת מבית העסק" /></div><div class="codebutton"><div class="buttontext">הצג</div></div></div>
						<div class="maintext">
							<div class="description_box">
									<li>						
										<span class="page2">
											<h2><span class="firstletter">ק</span>בל המלצות על עסקים מחברים</h2>
											<p>זקוקים לשרות כלשהו , מוצר כלשהו . בביזר תוכלו לקבל את ההמלצות האמינות ביותר על העסקים הטובים ביותר , כאשר החברים שלכם כבר ביקרו בעסק וקיבלו את שרותיו והמליצו עליו , לכן תוכלו לדעת  שהבחירה שעשיתם היא הטובה ביותר</p>
											<img  src="img/like_biz.png" alt="Zeni" id="SDGH"/>
										</span>
									</li>
									<li>
										<span class="page1">
											<h2><span class="firstletter">ש</span>תף את הקניות שלך עם חברים</h2>
											<p>מהיום תוכל לשתף את הקניות שביצעת עם חברים ולקבל חוות , לקבל המלצות ועוד המון שירותים</p>
											<img  src="img/share-friends.png" alt="Zeni" id="SFSDF"/>
										</span>
									</li>
									<li>
										<span class="page3">
											<h2><span class="firstletter">פ</span>נק ת'חברה בהנחות בעסקים</h2>
											<p>במעמד הקנייה בבית העסק תקבל קוד קופון אשר עלייך להכניס באתר . לאחר הזנת הקופון יתווסף לרשימת הקופונים שלך קופון חדש מבית העסק בו רכשת , כאשר החברים שלך יוכלו להשתתש בקופון לרכישה בבית העסק</p>
											<img  src="img/shoppng_cart.png" alt="Zeni" id="JJJJ"/>
										</span>
									</li>						
							</div>	
						</div>	
						<div class="main_cupon-3">
						
						<div id="slider">
								
									<ul>				
										<li>
											<div class="boxgrid slidedown">
												<img class="cover" src="img/cupons/co1.jpg"/>
													<h3>The Nonsense Society</h3>
													<p>Art, Music, Word<br/><a href="http://www.nonsensesociety.com" target="_BLANK">Website</a></p>	
											</div>	
											<div class="boxgrid slidedown">
												<img class="cover" src="img/cupons/co2.jpg"/>
													<h3>The Nonsense Society</h3>
													<p>Art, Music, Word<br/><a href="http://www.nonsensesociety.com" target="_BLANK">Website</a></p>	
											</div>
											<div class="boxgrid slidedown">
												<img class="cover" src="img/cupons/co3.jpg"/>
													<h3>The Nonsense Society</h3>
													<p>Art, Music, Word<br/><a href="http://www.nonsensesociety.com" target="_BLANK">Website</a></p>	
											</div>
										</li>
										
										<li>
											<div class="boxgrid slidedown">
												<img class="cover" src="img/cupons/co1.jpg"/>
													<h3>The Nonsense Society</h3>
													<p>Art, Music, Word<br/><a href="http://www.nonsensesociety.com" target="_BLANK">Website</a></p>	
											</div>	
											<div class="boxgrid slidedown">
												<img class="cover" src="img/cupons/co2.jpg"/>
													<h3>The Nonsense Society</h3>
													<p>Art, Music, Word<br/><a href="http://www.nonsensesociety.com" target="_BLANK">Website</a></p>	
											</div>
											<div class="boxgrid slidedown">
												<img class="cover" src="img/cupons/co3.jpg"/>
													<h3>The Nonsense Society</h3>
													<p>Art, Music, Word<br/><a href="http://www.nonsensesociety.com" target="_BLANK">Website</a></p>	
											</div>
										</li>
										
									</ul>
								</div>
						
						
						
						</div>	
						
						<div class="wall-messages">
						
						<div id="wall_container">

<div id='flashmessage'>
<div id="flash" align="left"  ></div>
</div>
<div id="content">

<?php include('wall/load_messages.php'); ?>

</div>



</div>
						
						</div>
						
					</div>
					
					
		        	
		        	<div class="home-slider-clearfix "></div>
		        	
		        	<!-- Headline -->
		        	<div id="headline">
					<?php  if(!$user) :  ?>
						<div class="account">
							<div class="login"><a href="<?php echo $loginUrl ?>"><img  src="img/facebook_button.png" alt="Zeni" id="imglogo"></a></div>
						</div>
						
					<?php  else: $user_profile = $facebook->api('/me','GET'); ?>	
						<div class="account">
							<div class="currentlogin">
								<div class="right"><?php echo '<img src="https://graph.facebook.com/'. $user .'/picture" width="50" height="50"/>' ?></div><div class="left"><?php if ($user_profile['gender'] =='male'){echo 'ברוך הבא';} else {echo 'ברוכה הבאה';}?></div><div class="firstname"><?php echo $user_profile['name'] ?></div><div class="notification">יש לך 6 התראות חדשות</div>
								<div class="usermenu">
									<ul>
										<li><span class="count">54354</span><img  src="img/icons/credit.png" alt="Zeni" id="usericons"><label>ניקוד</label></li>
										<li><span class="count">433</span><img  src="img/icons/shops.png" alt="Zeni" id="usericons"><label>הקניות שלי</label></li>
										<li><span class="count">44</span><img  src="img/icons/cupon.png" alt="Zeni" id="usericons"><label>הקופונים שלי</label></li>
										<li><span class="count">65</span><img  src="img/icons/fav.png" alt="Zeni" id="usericons"><label>המועדפים שלי</label></li>
										<li><span class="count"></span><img  src="img/icons/setting.png" alt="Zeni" id="usericons"><label>הגדרות</label></li>
									</ul>
								</div>
							</div>
						</div>
					<?php  endif;  ?>		
						
						<div class="mainbutton">
							<span class="left"><a href="#" class="button" id="b1"><img src="img/buttons/1.png" alt="alt text" /><p>פתח מכרז חדש</p></a></span>
														<span class="left"><a href="#" class="button" id="b2"><img src="img/buttons/6.png" alt="alt text" /><p>קבל הצעת מחיר</p></a></span>
						</div>
						<div class="mainbutton">
														<span class="left"><a href="#" class="button" id="b3"><img src="img/buttons/2.png" alt="alt text" /><p>השוואת מחירים</p></a></span>
														<span class="left"><a href="#" class="button" id="b4"> <img src="img/buttons/5.png" alt="alt text" /><p>שאל ת'מומחים</p></a></span>
						</div>
						<div class="mainbutton">
														<span class="left"><a href="#" class="button" id="b5"><img src="img/buttons/3.png" alt="alt text" /><p>דילים וקופונים</p></a></span>
													<span class="left"><a href="#" class="button" id="b6"><img src="img/buttons/4.png" alt="alt text" /><p>הזמן שרות</p></a></span>
						</div>
		        		<em id="corner"></em>
		        	</div>
		        	<!-- ENDS headline -->
		        	
		        	
				</div>
				<!-- ENDS slider holder -->
				
				
				<!-- home-block -->
	        	<div class="home-block" >
	        		<h2 class="home-block-heading"><span>FEATURED POSTS</span></h2>
	        		<div class="one-third-thumbs clearfix" >
	        			<figure>
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-1.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure>
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-2.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure class="last">
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-3.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure>
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-4.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure>
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-5.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure class="last">
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-6.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		
	        		</div>
	        	</div>
	        	<!-- ENDS home-block -->
	        	
	        	
	        	<!-- home-block -->
	        	<div class="home-block">
	        		<h2 class="home-block-heading"><span>LATEST PROJECTS</span></h2>
	        		<div class="one-fourth-thumbs clearfix">
	        			
	        			
	        			<figure>
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-7.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure>
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-8.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure>
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-9.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<figure class="last">
		        			<figcaption>
	        					<strong>Pellentesque habitant morbi</strong>
	        					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</span>
	        					<em>December 08, 2011</em>
	        					<a href="single.html" class="opener"></a>
			        		</figcaption>
			        		
			        		<a href="single.html"  class="thumb"><img src="img/dummies/featured-10.jpg" alt="Alt text" /></a>
		        		</figure>
		        		
		        		<a href="#" class="more-link right">More projects  &#8594;</a>
		        		
		        		
		        		
	        		</div>
	        		
	        		
	        	</div>
	        	<!-- ENDS home-block -->
	        		        	
			</div>
		</div>
		<!-- ENDS MAIN -->
		
		
		<footer>
			<div class="wrapper">
			
				<ul  class="widget-cols clearfix">
					<li class="first-col">
						
						<div class="widget-block">
							<h4>Recent posts</h4>
							<div class="recent-post">
								<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
								<div class="post-head">
									<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
								</div>
							</div>
							<div class="recent-post">
								<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
								<div class="post-head">
									<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
								</div>
							</div>
							<div class="recent-post">
								<a href="#" class="thumb"><img src="img/dummies/54x54.gif" alt="Post" /></a>
								<div class="post-head">
									<a href="#">Pellentesque habitant morbi senectus</a><span> March 12, 2011</span>
								</div>
							</div>
						</div>
					</li>
					
					<li class="second-col">
						
						<div class="widget-block">
							<h4>Zeni Template</h4>
							<p>Hope you find this template useful you are free to use it on personal and commercial projects. See the full license at this <a href="http://luiszuno.com/blog/license" >link</a></p>
						</div>
						
					</li>
					
					<li class="third-col">
						
						<div class="widget-block">
							<div id="tweets" class="footer-col tweet">
		         				<h4>Twitter widget</h4>
		         			</div>
		         		</div>
		         		
					</li>
					
					<li class="fourth-col">
						
						<div class="widget-block">
							<h4>Placeholder images</h4>
							<p>Thanks to <a href="http://www.thebeaststudio.com/" >Moe Pike</a> for sharing his work as place holder images for this preview. Visit his <a href="http://www.thebeaststudio.com/" >website</a> and find more of his awesome work.</p>
						</div>
		         		
					</li>	
				</ul>				
				
				
				<div class="footer-bottom">
					<div class="left">Created by <a href="http://www.luiszuno.com" >luiszuno.com</a></div>
					<div class="right">
						<ul id="social-bar">
							<li><a href="http://www.facebook.com/pages/Ansimuz/224538697564461"  title="Become a fan" class="poshytip"><img src="img/social/facebook.png"  alt="Facebook" /></a></li>
							<li><a href="https://twitter.com/ansimuz" title="Follow my tweets" class="poshytip"><img src="img/social/twitter.png"  alt="twitter" /></a></li>
							<li><a href="https://plus.google.com/109030791898417339180/posts"  title="Add to the circle" class="poshytip"><img src="img/social/plus.png" alt="Google plus" /></a></li>
						</ul>
					</div>
				</div>
				
			</div>
		</footer>
	
	</body>
	
</html>