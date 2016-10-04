<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."rentalcars.php";

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
	<div class="addcar"><a href="<?php echo BASEDIR ."addrentalcars.php"; ?>"><?php echo $locale['502']; ?></a></div>


	<?php
		$resultcompany = dbquery("SELECT
											rentalcar_company
							FROM ". DB_RENTALCARS ."
							WHERE (rentalcar_aktiv='1' || rentalcar_aktiv='4')
							ORDER BY `rentalcar_company` ASC");

		if (dbrows($resultcompany)) {
	?>
	<div class="rentalcarscompany">
		<ul>
	<?php
			$jcompany=0;
			$companyname = array();
			while ($datacompany = dbarray($resultcompany)) {
				if (!in_array($datacompany['rentalcar_company'], $companyname)) { $jcompany++;
	?>
			<li class="li_class<?php echo $jcompany . ($jcompany==1 ? " frist_li" : ""); ?>"><a href="<?php echo BASEDIR; ?>rentalcars.php?company=<?php echo $datacompany['rentalcar_company']; ?>" rel="nofollow"><?php echo $datacompany['rentalcar_company']; ?></a></li>
	<?php
					$companyname[] = $datacompany['rentalcar_company'];
				} // in_array companyname
			} //dbcompany whille
	?>
		</ul>
	</div>
	<?php
		} // dbcompany query
	?>

	<div class="rentalcarbloks allrentalcars">
		<div class="rentalcars">
			<?php


				$filterdb = "";
				if ($_GET['company']) {
					$filtercompany = trim(stripinput(censorwords(substr($_GET['company'],0,255))));
					$filterdb .= " AND rentalcar_company='". $filtercompany ."'";
				}


				if (isset($_GET['page'])) {
					$pagesay = (int)$_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("rentalcar", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											marka_name,
											model_name,
											rentalcar_imgocher,
											rentalcar_qiymeti,
											rentalcar_valyuta,
											seourl_url
									FROM ". DB_RENTALCARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_RENTALCARS .".rentalcar_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_RENTALCARS .".rentalcar_model=". DB_MODEL .".model_id 
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=rentalcar_id AND seourl_component=". $seourl_component ."
									WHERE (rentalcar_aktiv='1' || rentalcar_aktiv='4')". $filterdb ."
									ORDER BY `rentalcar_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-3">
				<div class="marka-model"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?></a></div>
				<div class="images"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['rentalcar_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
				<div class="cena"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo viewcena($data['rentalcar_qiymeti'], $data['rentalcar_valyuta']); ?></a></div>
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

	echo navigation($_GET['page'], $settings['goruser'], "rentalcar_id", DB_RENTALCARS, "(rentalcar_aktiv='1' || rentalcar_aktiv='4')". $filterdb ."");

	closetable();
?>