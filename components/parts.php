<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."parts.php";

if (!empty($locale['title'])) set_title($locale['title'] ." - ". $settings['sitename'] . ($_GET['page'] ? " | ". $locale['010'] . $_GET['page'] : "") );
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

	<div class="addcar"><a href="<?php echo BASEDIR ."addparts.php"; ?>"><?php echo $locale['502']; ?></a></div>


	<?php
		$resultcat = dbquery("SELECT
											partcats_id,
											partcats_name
							FROM ". DB_PARTCATS ."
							ORDER BY `partcats_name` ASC");

		if (dbrows($resultcat)) {
	?>
	<div class="parts_partcats">
		<ul>
	<?php
			$jcat=0;
			while ($datacat = dbarray($resultcat)) { $jcat++;
	?>
			<li class="li_class<?php echo $jcat . ($jcat==1 ? " frist_li" : ""); ?>"><a href="<?php echo BASEDIR; ?>parts.php?category_id=<?php echo $datacat['partcats_id']; ?>" rel="nofollow"><?php echo unserialize($datacat['partcats_name'])[LOCALESHORT]; ?></a></li>
	<?php
			} //dbcompany whille
	?>
		</ul>
	</div>
	<?php
		} // dbcompany query
	?>


	<div class="partbloks allparts">
		<div class="parts row">
			<?php


				$filterdb = "";
				if (isset($_GET['category_id'])) {
					$filterdb .= " AND parts_category_id='". $_GET['category_id'] ."'";
				}
		

				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("part", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											parts_name,
											parts_imgocher,
											parts_qiymeti,
											parts_valyuta,
											seourl_url
									FROM ". DB_PARTS ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=parts_id AND seourl_component=". $seourl_component ."
									WHERE (parts_aktiv='1' || parts_aktiv='4')". $filterdb ."
									ORDER BY `parts_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-3">
				<div class="name"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['parts_name']; ?></a></div>
				<div class="images"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['parts_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
				<div class="cena"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo viewcena($data['parts_qiymeti'], $data['parts_valyuta']); ?></a></div>
			</div>
			<?php
						if ($j==4) {
							$j=0;
							echo "<div class='clear'></div>\n";
						}
					} // db while

				} else {
					header("HTTP/1.0 404 Not Found");
					echo $locale['501'];
				}
			?>
			<div class="clear"></div>
		</div>
	</div>


<?php

	echo navigation($_GET['page'], $settings['goruser'], "parts_id", DB_PARTS, "(parts_aktiv='1' || parts_aktiv='4')". $filterdb ."");



					if (!$_GET['page']) {
						echo "<div class='description'>\n";
						echo $locale['700'];
						echo "</div>\n";
					}

	closetable();
?>