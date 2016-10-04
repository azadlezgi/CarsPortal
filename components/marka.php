<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

if ( preg_match("/veziyyet=/", FUSION_URI) ) {
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /cars/marks/veziyyet_". (INT)$_GET['veziyyet'] ."/" );
	exit();
}

include LOCALE.LOCALESET."marka.php";

if (!empty($locale['title'])) set_title($locale['title'] ." - ". $settings['sitename']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
	echo "		<li><span>". $locale['641'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($locale['h1']);

?>


	<div class="addcar"><a href="/cars/add/"><?php echo $locale['502']; ?></a></div>

	<div class="marks_page row">
	<?php

		$filterdb = "";
		$filterurl = "";
		if ($_GET['veziyyet']==1) {
					$filterdb .= " AND cars_veziyyet='1'";
					$filterurl .= "&veziyyet=1";
		}
		if ($_GET['veziyyet']==2) {
					$filterdb .= " AND cars_veziyyet='2'";
					$filterurl .= "&veziyyet=2";
		}
		if ($_GET['veziyyet']==3) {
					$filterdb .= " AND cars_veziyyet='3'";
					$filterurl .= "&veziyyet=3";
		}
		if ($_GET['veziyyet']==4) {
					$filterdb .= " AND cars_veziyyet='4'";
					$filterurl .= "&veziyyet=4";
		}
		if ($_GET['kredit']==1) {
					$filterdb .= " AND cars_kredit='1'";
					$filterurl .= "&kredit=1";
		}

		$result = dbquery("SELECT
											marka_id,
											marka_name
									FROM ". DB_MARKA ."
									ORDER BY `marka_name` ASC");
		if (dbrows($result)) {
			$j = 0;
			$counter = 0;
			while ($data = dbarray($result)) {
				$carcount = dbcount("(cars_id)", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4') AND cars_marka='". $data['marka_id'] ."'". $filterdb ."");

				if ($carcount>0) { $j++; $counter++;

					$last_class = "";
					if ($counter==3) {
						$counter = 0;
						$last_class = " marka_last";
					}
	?>
		<div class="allmarka marka<?php echo $j . ($last_class ? $last_class : ""); ?> col-sm-3">
			<div class="logos"><?php echo ($carcount==0 ? "<img src='". (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['markalogos_dir'] ."/". $data['marka_id'] .".gif") ? IMAGES . $settings['markalogos_dir'] ."/". $data['marka_id'] .".gif" : IMAGES ."imagenotfound.jpg") ."' alt='". $data['marka_name'] ."'>" : "<a href='/cars/?marka=".  $data['marka_id'] . $filterurl ."'><img src='". (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['markalogos_dir'] ."/". $data['marka_id'] .".gif") ? IMAGES . $settings['markalogos_dir'] ."/". $data['marka_id'] .".gif" : IMAGES ."imagenotfound.jpg") ."' alt='". $data['marka_name'] ."'></a>" ); ?></div>
			<div class="name"><?php echo ($carcount==0 ? $data['marka_name'] : "<a href='/cars/?marka=".  $data['marka_id'] . $filterurl ."'>". $data['marka_name'] ."</a>" ); ?></div>
			<div class="carcount">(<?php echo $carcount; ?>)</div>
			<div class="clear"></div>
		</div>
	<?php 
				} // carcount > 0
			} // db whille
	?>
		<div class="clear"></div>
	<?php
		} else {
			echo $locale['501'];
		}
	?>
	</div>


<?php
	closetable();
?>