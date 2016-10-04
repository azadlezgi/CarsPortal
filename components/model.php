<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."model.php";

$resultmarka = dbquery("SELECT
											marka_id,
											marka_name
									FROM ". DB_MARKA ."
									WHERE marka_id='". (INT)$_GET['marka'] ."'");
if (dbrows($resultmarka)) {
	$datamarka = dbarray($resultmarka);
}

if (!empty($locale['title'])) set_title($datamarka['marka_name'] ." ". $locale['title'] ." - ". $settings['sitename']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
	echo "		<li><a href='/cars/marks/'>". $locale['641'] ."</a></li>\n";
	echo "		<li><span>". $locale['642'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($datamarka['marka_name'] ." ". $locale['h1']);

?>

	<div class="addcar"><a href="/cars/add/"><?php echo $locale['502']; ?></a></div>

	<?php if ($datamarka['marka_name']) { ?>
	<div class="markaname">
				<span class="text"><?php echo $locale['503']; ?></span>
				<span class="logo"><?php echo "<img src='/". IMAGES . $settings['markalogos_dir'] ."/". $datamarka['marka_id'] .".gif" ."' alt='". $datamarka['marka_name'] ."'>"; ?></span>
				<span class="name"><?php echo $datamarka['marka_name']; ?></span>		
	</div>
	<?php } ?>	

	<div class="markamodel">
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
											model_id,
											model_name
									FROM ". DB_MODEL ."
									WHERE model_marka_id='". (INT)$_GET['marka'] ."'
									ORDER BY `model_name` ASC");
				if (dbrows($result)) {
					$rowcount = ceil((@mysql_num_rows($result)/4));
			?>
			<table>
				<tbody>
					<tr>
						<td width="25%">

			<?php
					$j = 0;
					$counter = 0;
					while ($data = dbarray($result)) { $j++;
						if ($counter != 0 && ($counter % $rowcount == 0)) { echo "</td>\n<td width='25%'>\n"; }
						$carcount = dbcount("(cars_id)", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4') AND cars_model='". $data['model_id'] ."'". $filterdb ."");
			?>
							<div class="allmarka marka<?php echo $j; ?>">
								<div class="icons"><?php echo ($carcount==0 ? "&nbsp;" : "<a href='/cars/?marka=". (INT)$_GET['marka'] ."&model=". $data['model_id'] . $filterurl ."'>&nbsp;</a>" ); ?></div>
								<div class="name"><?php echo ($carcount==0 ? $data['model_name'] : "<a href='/cars/?marka=". (INT)$_GET['marka'] ."&model=". $data['model_id'] . $filterurl ."'>". $data['model_name'] ."</a>" ); ?></div>
								<div class="carcount"><?php echo ($carcount==0 ? "(". $carcount .")" : "<a href='/cars/?marka=". (INT)$_GET['marka'] ."&model=". $data['model_id'] . $filterurl ."'>(". $carcount .")</a>" ); ?></div>
								<div class="clear-both"></div>
							</div>
			<?
						$counter++;
					} // db whille
			?>
						</td>
					</tr>
				</tbody>
			</table>

			<div class="viewallmodels">
				<a href="/cars/?marka=<?php echo (INT)$_GET['marka'] . $filterurl; ?>"><?php echo $locale['505']; ?></a>
			</div>

			<?php
				} else {
					echo $locale['501'];
				}
			?>
	</div>


<?php
	closetable();
?>