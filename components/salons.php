<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."salons.php";

$settings['goruser'] = round($settings['goruser']/2);

if (!empty($locale['title'])) set_title($locale['title'] ." - ". $settings['sitename']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

add_to_head ("<link rel='canonical' href='http://". FUSION_HOST ."/autosalons/' />");


	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
	echo "		<li><span>". $locale['641'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($locale['h1']);
?>
	<div class="addcar"><a href="/autosalons/add/"><?php echo $locale['502']; ?></a></div>

	<div class="salonbloks allsalons">
		<h2><?php echo $locale['510']; ?></h2>
		<div class="salons">
			<?php


				$filterdb = " AND (salon_vip='5' || salon_vip='6')";


				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("salon", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											salon_name,
											salon_imgocher,
											seourl_url
									FROM ". DB_SALONS ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=salon_id AND seourl_component=". $seourl_component ."
									WHERE (salon_aktiv='1' || salon_aktiv='4')". $filterdb ."
									ORDER BY `salon_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-3">
				<div class="name"><a href="/<?php echo $data['seourl_url']; ?>"><?php echo $data['salon_name']; ?></a></div>
				<div class="images"><a href="/<?php echo $data['seourl_url']; ?>"><img src="<?php echo (empty($data['salon_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_imgocher']); ?>" alt="<?php echo $data['salon_name']; ?>"></a></div>
			</div>
			<?php
						if ($j==4) {
							$j=0;
							echo "<div class='clear'></div>\n";
						}
					}
				} else {
					echo $locale['501'];
				}
			?>
			<div class="clear"></div>
		</div>
	</div>


<?php
	echo navigation($_GET['page'], $settings['goruser'], "salon_id", DB_SALONS, "(salon_aktiv='1' || salon_aktiv='4')". $filterdb ."");

?>

	<div class="salonbloks allsalons">
		<h2><?php echo $locale['511']; ?></h2>
		<div class="salons">
			<?php


				$filterdb = " AND salon_vip NOT IN (5,6)";


				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("salon", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											salon_name,
											salon_imgocher,
											seourl_url
									FROM ". DB_SALONS ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=salon_id AND seourl_component=". $seourl_component ."
									WHERE (salon_aktiv='1' || salon_aktiv='4')". $filterdb ."
									ORDER BY `salon_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-3">
				<div class="name"><a href="/<?php echo $data['seourl_url']; ?>"><?php echo $data['salon_name']; ?></a></div>
				<div class="images"><a href="/<?php echo $data['seourl_url']; ?>"><img src="<?php echo (empty($data['salon_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_imgocher']); ?>" alt="<?php echo $data['salon_name']; ?>"></a></div>
			</div>
			<?php
						if ($j==4) {
							$j=0;
							echo "<div class='clear'></div>\n";
						}
					}
				} else {
					echo $locale['501'];
				}
			?>
			<div class="clear"></div>
		</div>
	</div>


<?php
	echo navigation($_GET['page'], $settings['goruser'], "salon_id", DB_SALONS, "(salon_aktiv='1' || salon_aktiv='4')". $filterdb ."");

	closetable();
?>