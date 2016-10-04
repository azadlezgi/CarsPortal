<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."buyacars.php";

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

	<div class="addcar"><a href="<?php echo BASEDIR ."addbuyacars.php"; ?>"><?php echo $locale['502']; ?></a></div>

	<div class="buyacarbloks allbuyacars">
		<table class="buyacars">
			<thead>
				<tr>
					<td><?php echo $locale['650']; ?></td>
					<td><?php echo $locale['651']; ?></td>
					<td><?php echo $locale['652']; ?></td>
					<td><?php echo $locale['653']; ?></td>
				</tr>
			</thead>
			<tbody>
			<?php

				$filterdb = "";


				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("buyacar", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											marka_name,
											model_name,
											buyacars_iliot,
											buyacars_ilido,
											buyacars_yurushot,
											buyacars_yurushdo,
											buyacars_qiymetiot,
											buyacars_qiymetido,
											buyacars_valyuta,
											seourl_url
									FROM ". DB_BUYACARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_BUYACARS .".buyacars_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_BUYACARS .".buyacars_model=". DB_MODEL .".model_id 
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=buyacars_id AND seourl_component=". $seourl_component ."
									WHERE (buyacars_aktiv='1' || buyacars_aktiv='4')". $filterdb ."
									ORDER BY `buyacars_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
				<tr>
					<td><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?></a></td>
					<td><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['buyacars_iliot']; ?> - <?php echo $data['buyacars_ilido']; ?></a></td>
					<td><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['buyacars_yurushot']; ?> - <?php echo $data['buyacars_yurushdo']; ?></a></td>
					<td><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo viewcena($data['buyacars_qiymetiot'], $data['buyacars_valyuta']); ?> - <?php echo viewcena($data['buyacars_qiymetido'], $data['buyacars_valyuta']); ?></a></td>
				</tr>
			<?
					} // dc whille
				} else {
			?>
				<tr>
					<td colspan="4"><?php echo $locale['501']; ?></td>
				</tr>
			<?php
				} // db query
			?>
			</tbody>
			<tfoot>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>


<?php

	echo navigation($_GET['page'], $settings['goruser'], "buyacars_id", DB_BUYACARS, "(buyacars_aktiv='1' || buyacars_aktiv='4')". $filterdb ."");

	closetable();
?>