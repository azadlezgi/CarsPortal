<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."shops.php";

if (!empty($locale['title'])) set_title($locale['title'] ." - ". $settings['sitename']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
	echo "		<li><span>". $locale['641'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($locale['h1']);
?>
	<div class="addcar"><a href="<?php echo BASEDIR ."addshops.php"; ?>"><?php echo $locale['502']; ?></a></div>

	<div class="shopbloks allshops">
		<div class="shops">
			<?php


				$filterdb = "";


				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("shop", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											shop_name,
											shop_imgocher,
											seourl_url
									FROM ". DB_SHOPS ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=shop_id AND seourl_component=". $seourl_component ."
									WHERE (shop_aktiv='1' || shop_aktiv='4')". $filterdb ."
									ORDER BY `shop_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-3">
				<div class="name"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['shop_name']; ?></a></div>
				<div class="images"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['shop_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_imgocher']); ?>" alt="<?php echo $data['shop_name']; ?>"></a></div>
			</div>
			<?
						if ($j==5) { $j=0; }
					}
				} else {
					echo $locale['501'];
				}
			?>
			<div class="clear-both"></div>
		</div>
	</div>


<?php

	echo navigation($_GET['page'], $settings['goruser'], "shop_id", DB_SHOPS, "(shop_aktiv='1' || shop_aktiv='4')". $filterdb ."");

	closetable();
?>