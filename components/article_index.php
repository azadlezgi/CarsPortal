<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."article_index.php";



set_title($locale['title']);
set_meta("description", $locale['description']);
set_meta("keywords", $locale['keywords']);
		// add_to_head ("<link rel='canonical' href='http://". FUSION_HOST ."/articles/' />");
		// add_to_head ("<meta name='robots' content='index, follow' />");
		// add_to_head ("<meta name='author' content='Cars-Az' />");

if (FUSION_URI!="/") {
echo "<div class='breadcrumb'>\n";
echo "	<ul>\n";
echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
echo "		<li><span>". $locale['641'] ."</span></li>\n";
echo "	</ul>\n";
echo "</div>\n";
}

opentable($locale['h1']);

echo "<div class='articles'>\n";
$viewcompanent = viewcompanent("article_cats", "name");
$seourl_component = $viewcompanent['components_id'];

$c_result = dbquery("
	SELECT 
								article_cat_id,
								article_cat_name,
								article_cat_access,
								seourl_url
	FROM ". DB_ARTICLE_CATS ."
	LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_cat_id AND seourl_component=". $seourl_component ."
	WHERE article_cat_status='1'
	ORDER BY article_cat_order ASC");
if (dbrows($c_result)) {


	$viewcompanent = viewcompanent("article_item", "name");
	$seourl_component = $viewcompanent['components_id'];

	$articles_arr = array();
	$result = dbquery("SELECT 
											article_id,
											article_name,
											article_image,
											article_extract,
											article_cat,
											article_order
											article_access,
											seourl_url
			FROM ". DB_ARTICLES ."
			LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_id AND seourl_component=". $seourl_component ."
			WHERE article_status='1'
			AND article_date<'". FUSION_TODAY ."'
	");

			if (dbrows($result)) {
				while ($data = dbarray($result)) {




	while ($c_data = dbarray($c_result)) { $say++;

		$article_cat_id = $c_data['article_cat_id'];
		$article_cat_name = unserialize($c_data['article_cat_name']);
		$article_cat_access = $c_data['article_cat_access'];
		$article_cat_seourl_url = $c_data['seourl_url'];

		if (checkgroup($article_cat_access)) {

			$viewcompanent = viewcompanent("article_item", "name");
			$seourl_component = $viewcompanent['components_id'];

			$result = dbquery("SELECT 
											article_id,
											article_name,
											article_image,
											article_extract,
											article_access,
											seourl_url
					FROM ". DB_ARTICLES ."
					LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_id AND seourl_component=". $seourl_component ."
					WHERE article_status='1'
					AND article_date<'". FUSION_TODAY ."'
					AND article_cat='". $article_cat_id ."'
					LIMIT 0, 3");
//			ORDER BY article_order ASC

			if (dbrows($result)) {

				echo "<div class='article_cat'>\n";
				echo "<a href='/". $article_cat_seourl_url ."' class='article_cat_name'>". $article_cat_name[LOCALESHORT] ."</a>\n";
				echo "<a href='/". $article_cat_seourl_url ."' class='article_cat_more'>". $locale['410'] ."</a>\n";
				echo "<ul class='articles_list'>\n";

				while ($data = dbarray($result)) {

					$article_id = $data['article_id'];
					$article_name = unserialize($data['article_name']);
					$article_image = $data['article_image'];
					$article_extract = unserialize($data['article_extract']);
					$article_access = $data['article_access'];
					$article_seourl_url = $data['seourl_url'];

					if (checkgroup($article_access)) {
?>

	<li class="article_<?php echo $article_id; ?>">
		<div class="articles">
			<a href="/<?php echo $article_seourl_url; ?>" class="article_title"><?php echo $article_name[LOCALESHORT]; ?></a>
			<div class="art_content">
				<?php if ($article_image) { ?>
				<a href="/<?php echo $article_seourl_url; ?>" class="article_img"><img src="<?php echo IMAGES_A_T . $article_image; ?>" alt="<?php echo $article_name[LOCALESHORT]; ?>"></a>
				<?php } ?>
				<p><?php echo mb_substr(strip_tags(str_replace("><", "> <", htmlspecialchars_decode($article_extract[LOCALESHORT]))), 0, 550) ; ?></p>

				<a href="/<?php echo $article_seourl_url; ?>" class="article_more"><?php echo $locale['411']; ?></a>
				<div class="clear"></div>
			</div>
		</div>
	</li>
<?php
					} // article_access
				} // db whille
				echo "</ul>\n";
				echo "</div>\n";
			} // db query
		} // article_cat_access
	} // db whille
				} // db query
			} // db whille
} // db query
echo "</div>\n";

closetable();

?>