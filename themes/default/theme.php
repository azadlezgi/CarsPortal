<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

define("THEME_BULLET", "<span class='bullet'></span>");

require_once INCLUDES."theme_functions_include.php";

function render_page($license = false) {
	
global $settings, $main_style, $locale, $mysql_queries_time, $languages, $aidlink;

add_to_head ("<meta name='viewport' content='width=device-width, initial-scale=1'>");

add_to_footer ("<script  type='text/javascript' src='/". THEME ."js/jquery.cookie.js'></script>");

add_to_footer ("<script  type='text/javascript' src='/". THEME ."js/bootstrap.js'></script>");
add_to_head ("<link rel='stylesheet' href='/". THEME ."css/font-awesome.css?2' type='text/css' media='screen' />");
add_to_head ("<link rel='stylesheet' href='/". THEME ."css/bootstrap.css?2' type='text/css' media='screen' />");

add_to_head ("<link rel='stylesheet' href='/". THEME ."styles.css?2' type='text/css' media='screen' />");

foreach ($languages as $lang_key => $lang_value) {
	add_to_head ("<link rel='alternate' hreflang='". $lang_value['languages_short'] ."' href='". $lang_value['languages_site'] ."' />");
} // foreach languages

include "includes/top-admin_panel.php";

?>
<div class="wrapper">
	<header>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<a href="/" id="logo"><i class="fa fa-car"></i>CARS <span>AZ</span></a>
				</div>
				<div class="col-sm-7">
					<?php include INFUSIONS ."toplinks_panel/toplinks_panel.php"; ?>
				</div>
				<div class="col-sm-2 text-right clearfix">
					<div id="languages-block">
						<div class="current">
							<span class="flags flag_<?php echo LOCALESHORT; ?>"><?php echo LOCALESHORT; ?><i class="fa fa-angle-down"></i></span>
						</div>
						<ul class="languages-block_ul">
							<?php foreach ($languages as $lang_key => $lang_value) { ?>
							<li<?php echo (LOCALESHORT==$lang_value['languages_short'] ? ' class="selected"' : ''); ?>>
								<a href="<?php echo $lang_value['languages_site'] . FUSION_URI; ?>"><span class="flags flag_<?php echo $lang_value['languages_short']; ?>"><?php echo $lang_value['languages_name']; ?></span></a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section class="filter_panel">
		<div class="container">
			<?php include INFUSIONS."cars_filter_panel/cars_filter_panel.php"; ?>
		</div>
	</section>

	<nav>
		<div class="container">
			<?php echo showsublinks("", ""); ?>
		</div>
	</nav>

	<section>
		<div class="container">
			<div class="row">
				<?php if (U_CENTER) { ?>
				<div class="col-sm-12 clearfix">
					<?php echo U_CENTER; ?>
				</div>
				<?php } ?>

				<?php if (LEFT) { ?>
					<div class="col-sm-3 left_block">
						<aside>
							<?php echo LEFT; ?>
						</aside>
					</div>
				<?php } ?>

				<?php if (LEFT && RIGHT) { ?>
				<div class="col-sm-6 center_block">
				<?php } else if (LEFT) { ?>
				<div class="col-sm-9 right_block clearfix">
				<?php } else if (RIGHT) { ?>
				<div class="col-sm-9 left_block">
				<?php } else { ?>
				<div class="col-sm-12 clearfix">
				<?php } ?>
					<article>
						<?php // echo U_CONTENT; ?>
						<?php echo CONTENT; ?>
						<?php // echo L_CONTENT; ?>
					</article>
				</div>

				<?php if (RIGHT) { ?>
				<div class="col-sm-3 right clearfix">
					<aside>
						<?php echo RIGHT; ?>
					</aside>
				</div>
				<?php } ?>

				<?php if (L_CENTER) { ?>
				<div class="col-sm-12 clearfix">
					<?php echo L_CENTER; ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<footer>
		<div class="container">
			<div class="row">
				<div class="foot_blocks links_footer col-sm-3">
					<h4><?php echo $locale['global_950']; ?></h4>
					<?php include INFUSIONS ."toplinks_panel/toplinks_panel.php"; ?>
				</div>
				<div class="foot_blocks nav_footer col-sm-3">
					<h4><?php echo $locale['global_951']; ?></h4>
					<?php echo showsublinks("", "foot_nav"); ?>
				</div>
				<div class="foot_blocks socsets_footer col-sm-3">
					<h4><?php echo $locale['global_952']; ?></h4>
					<ul class="socsets">
						<li class="facebook"><i class="fa fa-facebook-square"></i><a href="#" target="_blank" title="Facebook">Facebook</a></li>
						<li class="twitter"><i class="fa fa-twitter-square"></i><a href="#" target="_blank" title="Twitter">Twitter</a></li>
						<li class="google-plus"><i class="fa fa-google-plus-square"></i><a href="#" target="_blank" title="Google+">Google+</a></li>
						<li class="youtube"><i class="fa fa-youtube-square"></i><a href="#" target="_blank" title="YouTube">YouTube</a></li>
					</ul>
					<ul class="payments_metods">
						<li><i class="fa fa-cc-visa"></i></li>
						<li><i class="fa fa-cc-mastercard"></i></li>
						<li><i class="fa fa-cc-discover"></i></li>
						<li><i class="fa fa-cc-amex"></i></li>
						<li><i class="fa fa-cc-paypal"></i></li>
					</ul>
				</div>
				<div class="foot_blocks contacts_footer col-xs-3 clearfix">
					<h4><?php echo $locale['global_953']; ?></h4>
					<ul class="footcontact">
						<li><i class="fa fa-map-marker"></i> <?php echo $locale['adress']; ?></li>
						<li><i class="fa fa-phone-square"></i> <?php echo $locale['email']; ?></li>
						<li><i class="fa fa-envelope-square"></i> <?php echo $locale['phone']; ?></li>
						<li><i class="fa fa-skype"></i> <?php echo $locale['skype']; ?></li>
					</ul>
				</div>
				<hr class="bottom-line">
				<div class="copy col-xs-4">
					<?php echo $locale['copy']; ?>
				</div>
				<div class="col-xs-4">

				</div>
				<div class="counters col-xs-4 text-right">
<!-- ILK-10 Azeri Website Directory -->
<script> x=screen.width ; y=screen.height ; resolution=x+"x"+y;document.write("<a href='http://www.ilk10.az/comment.php?id=36327' target='_blank' rel='nofollow'><img alt='ILK-10 Azeri Website Directory' src='http://www.ilk10.az/counter/count3.php?color=liliac&id=36327&res="+resolution+"&ref="+escape(document.referrer)+"'></a> "); </script> <noscript><a href='http://www.ilk10.az/comment.php?id=36327' target='_blank' rel='nofollow'><img alt='ILK-10 Azeri Website Directory' src='http://www.ilk10.az/counter/count3.php?color=liliac&id=36327'></a></noscript>
<!-- //ILK-10 Azeri Website Directory -->

<!--LiveInternet counter-->
<script type="text/javascript">
<!--
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t14.1;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border='0' width='88' height='31'><\/a>")
//-->
</script>
<!--/LiveInternet-->

				</div>
			</div>
		</div>
	</footer>
</div>


<!-- GoogleAnalyticsObject -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54777620-4', 'auto');
  ga('send', 'pageview');

</script>
<!-- /GoogleAnalyticsObject -->


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter32514435 = new Ya.Metrika({id:32514435,
                    webvisor:true,
                    clickmap:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/32514435" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<?php
	/*foreach ($mysql_queries_time as $query) {
		echo $query[0]." QUERY: ".$query[1]."<br />";
	}*/
} // function render_page

/* New in v7.02 - render comments */
function render_comments($c_data, $c_info){
	global $locale, $settings;
	opentable($locale['c100']);
	if (!empty($c_data)){
		echo "<div class='comments floatfix'>\n";
			$c_makepagenav = '';
			if ($c_info['c_makepagenav'] !== FALSE) { 
			echo $c_makepagenav = "<div style='text-align:center;margin-bottom:5px;'>".$c_info['c_makepagenav']."</div>\n"; 
		}
			foreach($c_data as $data) {
			$comm_count = "<a href='".FUSION_REQUEST."#c".$data['comment_id']."' id='c".$data['comment_id']."' name='c".$data['comment_id']."'>#".$data['i']."</a>";
			echo "<div class='tbl2 clearfix floatfix'>\n";
			if ($settings['comments_avatar'] == "1") { echo "<span class='comment-avatar'>".$data['user_avatar']."</span>\n"; }
			echo "<span style='float:right' class='comment_actions'>".$comm_count."\n</span>\n";
			echo "<span class='comment-name'>".$data['comment_name']."</span>\n<br />\n";
			echo "<span class='small'>".$data['comment_datestamp']."</span>\n";
	if ($data['edit_dell'] !== false) { echo "<br />\n<span class='comment_actions'>".$data['edit_dell']."\n</span>\n"; }
			echo "</div>\n<div class='tbl1 comment_message'>".$data['comment_message']."</div>\n";
		}
		echo $c_makepagenav;
		if ($c_info['admin_link'] !== FALSE) {
			echo "<div style='float:right' class='comment_admin'>".$c_info['admin_link']."</div>\n";
		}
		echo "</div>\n";
	} else {
		echo $locale['c101']."\n";
	}
	closetable();   
} // function render_comments

function render_news($subject, $news, $info) {

	echo "<div class='render_news'>\n";
	echo "<h1>". $subject ."</h1>\n";
	echo "<div class='main-body'>". $info['cat_image'] . $news ."</div>\n";
	echo "<div class='newsposter'>";
	echo newsposter($info," &middot;").newscat($info," &middot;").newsopts($info,"&middot;").itemoptions("N",$info['news_id']);
	echo "</div>\n";
	echo "</div>\n";

} // function render_news

function render_article($subject, $article, $info) {
	
	echo "<div class='render_article'>\n";
	echo "<h1>". $subject ."</h1>\n";
	echo "<div class='main-body'>". ($info['article_breaks'] == "y" ? nl2br($article) : $article)."</div>\n";
	echo "<div class='articleposter'>";
	echo articleposter($info," &middot;").articlecat($info," &middot;").articleopts($info,"&middot;").itemoptions("A",$info['article_id']);
	echo "</div>\n";
	echo "</div>\n";

} // function render_article

function opentable($title) {

	echo "<div class='render_page'>\n";
	echo "<h1>". $title ."</h1>\n";
	echo "<div class='main-body'>\n";

} // function opentable

function closetable() {

	echo "<div class='clear'></div>\n";
	echo "</div>\n";
	echo "</div>\n";

} // function closetable

function openside($title, $echo = true, $collapse = false, $state = "on") {

	global $panel_collapse; $panel_collapse = $collapse;
	
	$return .= "<div class='openside'>\n";
	if ($title) {
		$return .= "<h4>". $title ."</h4>\n";
	}
	if ($collapse == true) {
		if ($title) {
			$return .= "<div class='side-title'>". panelbutton($state, str_replace(" ", "", $title)) ."</div>\n";
		}
	}
	$return .= "<div class='side-body'>\n";	
	if ($collapse == true) { $return .= panelstate($state, $boxname); }

	if ($echo==true) { echo $return; }
	else { return $return; }

} // function openside

function closeside($echo = true) {
	
	global $panel_collapse;

	if ($panel_collapse == true) { $return .= "</div>\n"; }
	$return .= "</div>\n";
	$return .= "</div>\n";

	if ($echo==true) { echo $return; }
	else { return $return; }

} // function closeside
?>