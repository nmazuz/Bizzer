 <ul>
 <?php
//Srinivas Tamada http://9lessons.info
//Loading Comments link with load_updates.php 

foreach($updatesarray as $data)
 {
 $msg_id=$data['msg_id'];
 $orimessage=$data['message'];
 $message=tolink(htmlentities($data['message']));
  $time=$data['created'];
   $username=$data['username'];
 $uid=$data['uid_fk'];
 $face=$Wall->Gravatar($uid);
 $commentsarray=$Wall->Comments($msg_id);
?>

<li class="stbody" id="stbody<?php echo $msg_id;?>">
<div class = "bubble" >
<div><img src="img/bizlogos/castro.jpg" class='bizlogo'/></div>
<div class="buyer-image"><img src="<?php echo $face;?>" class='big_face'/></div>
<div class="shop-title"><span class="title-text">חולצת טריקו לבנה עם פסים אדומים ומשבצות שחורות</span></div>
<div class="shop-image"><img src="img/shops/shoes.jpg" class='shop-photo'/></div>
<div class="clearfix"></div>
<div class="rating"><div class="star-rating"><img src="img/stars.png" /></div><div class="likes"><img src="img/like.png" /></div></div>
<div class="clearfix"></div>
<div class ="codebutton shop-data"><div class="view-shop-data">פרטי הקנייה</div></div>
<div class="clearfix"></div>
<div class ="status"><img src="img/best.png" /><img src="img/price.png" /><img src="img/comments.png" /></div>
</div>
<div class ="mycupon"><img src="img/mycp.png" /></div>

</li>

<?php
  }
 
?>
 </ul>


 


