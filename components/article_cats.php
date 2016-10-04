<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."article_cats.php";


$viewcompanent = viewcompanent("article_cats", "name");
$seourl_component = $viewcompanent['components_id'];

$c_result = dbquery("SELECT 
								article_cat_id,
								article_cat_title,
								article_cat_description,
								article_cat_keywords,
								article_cat_name,
								article_cat_h1,
								article_cat_access,
								article_cat_content,
								seourl_url
FROM ". DB_ARTICLE_CATS ."
LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_cat_id AND seourl_component=". $seourl_component ."
WHERE article_cat_id='". $filedid ."'");
if (dbrows($c_result)) {
	$c_data = dbarray($c_result);

								$article_cat_id = $c_data['article_cat_id'];
								$article_cat_title = unserialize($c_data['article_cat_title']);
								$article_cat_description = unserialize($c_data['article_cat_description']);
								$article_cat_keywords = unserialize($c_data['article_cat_keywords']);
								$article_cat_name = unserialize($c_data['article_cat_name']);
								$article_cat_h1 = unserialize($c_data['article_cat_h1']);
								$article_cat_access = $c_data['article_cat_access'];
								$article_cat_content = unserialize($c_data['article_cat_content']);
								$article_cat_seourl_url = $c_data['seourl_url'];

		set_title( ($article_cat_title[LOCALESHORT] ? $article_cat_title[LOCALESHORT] : $locale['title'] . $article_cat_name[LOCALESHORT] ." - Cars Azerbaijan") );
		set_meta("description", ($article_cat_description[LOCALESHORT] ? $article_cat_description[LOCALESHORT] : $locale['description']) );
		set_meta("keywords", ($article_cat_keywords[LOCALESHORT] ? $article_cat_keywords[LOCALESHORT] : $locale['keywords']) );
		add_to_head ("<link rel='canonical' href='http://". FUSION_HOST ."/". ($settings['opening_page']!=$article_cat_seourl_url ? $article_cat_seourl_url : "") ."' />");
		add_to_head ("<meta name='robots' content='index, follow' />");
		add_to_head ("<meta name='author' content='IssoHost' />");

		if (FUSION_URI!="/") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='/articles/'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $article_cat_name[LOCALESHORT] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
		}


		if ($article_cat_h1[LOCALESHORT]) {
			opentable($article_cat_h1[LOCALESHORT]);
		} else {
			opentable($article_cat_name[LOCALESHORT]);
		}

			if (checkgroup($article_cat_access)) {


				echo "<div class='articles'>\n";
				echo "<ul class='articles_list'>\n";


				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['articles_per_page']*($pagesay-1);

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
					AND article_cat='". $filedid ."'
					LIMIT ". $rowstart .", ". $settings['articles_per_page'] ."");


				if (dbrows($result)) { $say = 0;
					while ($data = dbarray($result)) { $say++;

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

					echo "<div class='clear'></div>\n";

					echo navigation($_GET['page'], $settings['articles_per_page'], "article_id", DB_ARTICLES, "article_status='1' AND article_date<'". FUSION_TODAY ."' AND article_cat='". $filedid ."'");

				} // db query



				ob_start();
				eval("?>".htmlspecialchars_decode($article_cat_content[LOCALESHORT])."<?php ");
				$custompage = ob_get_contents();
				ob_end_flush();
				$custompage = preg_split("/<!?--\s*pagebreak\s*-->/i", $custompage);
				$pagecount = count($custompage);
				echo $custompage[$_GET['rowstart']];


			} else {
				echo "<div class='admin-message' style='text-align:center'><br /><img style='border:0px; vertical-align:middle;' src ='". IMAGES ."warn.png' alt=''/><br /> ".$locale['400']."<br /><a href='index.php' onclick='javascript:history.back();return false;'>".$locale['403']."</a>\n<br /><br /></div>\n";
			}

		closetable();
}




?>