<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."services.php";

$settings['goruser'] = round($settings['goruser']/2);

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
	<div class="addcar"><a href="<?php echo BASEDIR ."addservices.php"; ?>"><?php echo $locale['502']; ?></a></div>

	<div class="servicebloks allservices">
		<h2><?php echo $locale['510']; ?></h2>
		<div class="services row">
			<?php


				$filterdb = " AND (service_vip='5' || service_vip='6')";


				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("service", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											service_name,
											service_imgocher,
											seourl_url
									FROM ". DB_SERVICES ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=service_id AND seourl_component=". $seourl_component ."
									WHERE (service_aktiv='1' || service_aktiv='4')". $filterdb ."
									ORDER BY `service_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-3">
				<div class="name"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['service_name']; ?></a></div>
				<div class="images"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['service_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_imgocher']); ?>" alt="<?php echo $data['service_name']; ?>"></a></div>
				<div class="text"></div>
			</div>
			<?php
						if ($j==4) {
							$j=0;
							echo "<div class='clear'></div>\n";
						}
					} // while
				} else {
					echo $locale['501'];
				} // if
			?>
			<div class="clear"></div>
		</div>
	</div>


	<div class="servicebloks allservices">
		<h2><?php echo $locale['511']; ?></h2>
		<div class="services row">
			<?php


				$filterdb = " AND service_vip NOT IN (5,6)";


				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("service", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											service_name,
											service_imgocher,
											seourl_url
									FROM ". DB_SERVICES ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=service_id AND seourl_component=". $seourl_component ."
									WHERE (service_aktiv='1' || service_aktiv='4')". $filterdb ."
									ORDER BY `service_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-3">
				<div class="name"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['service_name']; ?></a></div>
				<div class="images"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['service_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_imgocher']); ?>" alt="<?php echo $data['service_name']; ?>"></a></div>
				<div class="text"></div>
			</div>
			<?php
						if ($j==4) {
							$j=0;
							echo "<div class='clear'></div>\n";
						}
					} // while
				} else {
					echo $locale['501'];
				} // if
			?>
			<div class="clear"></div>
		</div>
	</div>


<?php

	echo navigation($_GET['page'], $settings['goruser'], "service_id", DB_SERVICES, "(service_aktiv='1' || service_aktiv='4')". $filterdb ."");

	closetable();
?>