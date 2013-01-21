<?php

$requested_page = $_POST['page_num'];
$set_limit = (($requested_page - 1) * 6) . ",6";

$con = mysql_connect("localhost", "nmazuz_bizzer", "niso7265");
mysql_select_db("nmazuz_bizzer");


$result = mysql_query("select  * from messages order by msg_id asc limit $set_limit");



$html = '<ul>';

while ($row = mysql_fetch_array($result)) {
    $html .= '<li class="stbody" id="stbody<?php echo $msg_id;?>">
<div class = "bubble" >
<div><img src="img/bizlogos/castro.jpg" class="bizlogo"/></div>
<div class="buyer-image"><img src="<?php echo $face;?>" class="big_face"/></div>
<div class="shop-title"><span class="title-text">חולצת טריקו לבנה עם פסים אדומים ומשבצות שחורות</span></div>
<div class="shop-image"><img src="img/shops/shoes.jpg" class="shop-photo"/></div>
<div class="clearfix"></div>
<div class="rating"><div class="star-rating"><img src="img/stars.png" /></div><div class="likes"><img src="img/like.png" /></div></div>
<div class="clearfix"></div>
<div class ="codebutton shop-data"><div class="view-shop-data">פרטי הקנייה</div></div>
<div class="clearfix"></div>
<div class ="status"><img src="img/best.png" /><img src="img/price.png" /><img src="img/comments.png" /></div>
</div>
<div class ="mycupon"><img src="img/mycp.png" /></div>

</li>';
}
$html .= '</ul>';

echo $html;
exit;
?>
