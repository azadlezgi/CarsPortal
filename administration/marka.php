<?php

require_once "../includes/maincore.php";

if (!checkrights("MARK") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

require_once THEMES."templates/admin_header.php";

include LOCALE.LOCALESET."admin/marka.php";


$settings['goradmin'] = 100;


if ($_GET['marka']) {

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='". ADMIN . $aidlink ."&pagenum=3'>". $locale['640'] ."</a></li>\n";
	echo "		<li><a href='". ADMIN ."marka.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
	echo "		<li><span>". $locale['642'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

} else {
	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='". ADMIN . $aidlink ."&pagenum=3'>". $locale['640'] ."</a></li>\n";
	echo "		<li><span>". $locale['641'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";
}

	opentable($locale['h1']);

if ($_GET['marka']) {
########## MODEL BEGIN
?>
	<div class="markaname">
			<?php
				$resultmarka = dbquery("SELECT
											marka_id,
											marka_name
									FROM ". DB_MARKA ."
									WHERE marka_id='". (INT)$_GET['marka'] ."'");
				if (dbrows($resultmarka)) {
					$datamarka = dbarray($resultmarka);
			?>
				<span class="text"><?php echo $locale['503']; ?></span>
				<span class="logo"><?php echo "<img src='". IMAGES . $settings['markalogos_dir'] ."/". $datamarka['marka_id'] .".gif" ."' alt='". $datamarka['marka_name'] ."'>"; ?></span>
				<span class="name"><?php echo $datamarka['marka_name']; ?></span>

			<?php
				}
			?>			
	</div>

<?php
	if ($_GET['action']=="delete") {

		$viewcompanent = viewcompanent("car", "name");
		$components_id = $viewcompanent['components_id'];

		$result = dbquery("SELECT * FROM ". DB_CARS ." WHERE cars_model='". (INT)$_GET['id'] ."'");
		if (dbrows($result)) {
			$data = dbarray($result);

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images1'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images1']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images2'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images2']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images3'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images3']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images4'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images4']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images6']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images6']); }


			$result = dbquery("DELETE FROM ". DB_CARS ." WHERE cars_id='". $data['cars_id'] ."'");
			$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $components_id ."' AND seourl_filedid='". $data['cars_id'] ."'");
			$result = dbquery("DELETE FROM ". DB_SROK ." WHERE srok_post_type='". $components_id ."' AND srok_post_id='". $data['cars_id'] ."'");
		}

		$result = dbquery("DELETE FROM ". DB_MODEL ." WHERE model_id='". (INT)$_GET['id'] ."'");
		redirect(ADMIN ."marka.php". $aidlink ."&marka=". (INT)$_GET['marka'] ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

	} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {


		if ($_POST['model_submit']) {

			$model_id = (INT)$_GET['id'];
			$model_name = trim(stripinput(censorwords(substr($_POST['model_name'],0,255))));
			$model_marka_id = (INT)$_GET['marka'];
	
		} else if ($_GET['action']=="edit") {

			$result = dbquery("SELECT * FROM ". DB_MODEL ." WHERE model_id='". (INT)$_GET['id'] ."'");

			if (dbrows($result)) {
				$data = dbarray($result);

				$model_id = $data['model_id'];
				$model_name = $data['model_name'];
				$model_marka_id = $data['model_marka_id'];

			} // Yesli DB query yest

		} else {

			$model_id = "";
			$model_name = "";
			$model_marka_id = "";

		}

		if ($_POST['model_submit']) {

			if (empty($model_name)) { $error_model_name = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
			$model_count = dbcount("(model_id)", DB_MODEL, "model_name='". $model_name ."' AND model_marka_id='". $model_marka_id ."'");
			if ($model_count>0) { $error_model_name = 1; $error .= "<div class='error'>". $locale['error_520'] ."</div>\n"; }

			if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

			if ($error) {
				echo "<div id='close-message'>\n";
				echo $error;
				echo "</div>\n";
			} else {


				if ($_GET['action']=="edit") {

					### UPDATE MODEL BEGIN
					$result = dbquery(
						"UPDATE ". DB_MODEL ." SET
														model_name='". $model_name ."'
						WHERE model_id='". $model_id ."'"
					);
					### UPDATE MODEL END

					redirect(ADMIN ."marka.php". $aidlink ."&marka=". (INT)$_GET['marka'] ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
	
				} else if ($_GET['action']=="add") {

					### INSERT MODEL BEGIN
					$result = dbquery(
						"INSERT INTO ". DB_MODEL ." (
														model_name,
														model_marka_id
						) VALUES (
														'". $model_name ."',
														'". $model_marka_id ."'

						)"
					);
					$model_id = mysql_insert_id();
					### INSERT MODEL END

					redirect(ADMIN ."marka.php". $aidlink ."&marka=". (INT)$_GET['marka'] ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

				} // Yesli Edit ili Add


				$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

				unset($model_id);
				unset($model_name);
				unset($model_marka_id);

			} // Yesli Error Yest

		} // Yesli Post

	} // Yesli Edit ili Add

	if (isset($_GET['status'])) {
		echo "<div id='close-message'>\n";
		if ($_GET['status']=="added") {
			echo "<div class='status'>". $locale['status_004'] ."</div>\n";
		} else if ($_GET['status']=="edited") {
			echo "<div class='status'>". $locale['status_005'] ."</div>\n";
		} else if ($_GET['status']=="deleted") {
			echo "<div class='status'>". $locale['status_006'] ."</div>\n";
		}
		echo "</div>\n";
	}

?>

	<table class="model_adminka">
		<thead>
			<tr>
				<td class="model_id"><?php echo $locale['510']; ?></td>
				<td class="model_name"><?php echo $locale['512']; ?></td>
				<td class="model_cars"><?php echo $locale['514']; ?></td>
				<td class="model_href"><?php echo $locale['515']; ?></td>
			</tr>
		</thead>
		<tbody>
<?php

		if (isset($_GET['page'])) {
			$say = $_GET['page'];
		} else {
			$say = 1;
		}
		$rowstart = $settings['goradmin']*($say-1);

		$result = dbquery("SELECT
									model_id,
									model_name
							FROM ". DB_MODEL ."
							WHERE model_marka_id='". (INT)$_GET['marka'] ."'
							ORDER BY `model_id` DESC
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
				$carcount = dbcount("(cars_id)", DB_CARS, "cars_model='". $data['model_id'] ."'");
?>
			<tr>
				<td class="model_id">#<?php echo $data['model_id']; ?></td>
				<td class="model_name"><?php echo $data['model_name']; ?></td>
				<td class="model_cars">(<?php echo $carcount; ?>)</td>
				<td class="model_href">
					<a class='edit' href='<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". (INT)$_GET['marka'] ."&action=edit&id=". $data['model_id']; ?>' title='<?php echo $locale['520']; ?>'><img src='<?php echo IMAGES; ?>edit.png' alt='<?php echo $locale['520']; ?>'></a>
					<a class='delete' href='<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". (INT)$_GET['marka'] ."&action=delete&id=". $data['model_id']; ?>' title='<?php echo $locale['521']; ?>' onclick='return DeleteOk();'><img src='<?php echo IMAGES; ?>delete.png' alt='<?php echo $locale['521']; ?>'></a>
				</td>
			</tr>
<?php
			} // db query
		} else {
?>
			<tr>
				<td colspan="6"><?php echo $locale['501']; ?></td>
			</tr>
<?php
		}

?>
		</tbody>
		<tfoot>
		<form method="POST" name="addmodel" id="addmodel" action="<?php echo ADMIN ."marka.php". $aidlink ."&marka=". (INT)$_GET['marka'] . ($_GET['action']=="edit" ? "&action=edit&id=". (INT)$_GET['id'] : "&action=add"); ?>">
			<tr>
				<td class="model_name" colspan="3">
					<input class="textbox<?php echo ($error_model_name==1 ? " error" : ""); ?>" type="text" name="model_name" id="model_name" value="<?php echo $model_name; ?>" maxlength="255" />
				</td>
				<td class="model_href">
					<input class="button" value="<?php echo $locale['590']; ?>" type="submit" name="model_submit" id="model_submit" />
				</td>
			</tr>
		</form>
		</tfoot>
	</table>

<?php
	echo navigation($_GET['page'], $settings['goradmin'], "model_id", DB_MODEL, "model_marka_id='". (INT)$_GET['marka'] ."'");
?>

		<script type='text/javascript'>
			<!--
			function DeleteOk() {
				return confirm('<?php echo $locale['502']; ?>');
			}
			//-->
		</script>

<?php
########## MODEL END

} else {
########## MARKA BEGIN

	if ($_GET['action']=="delete") {

		$viewcompanent = viewcompanent("car", "name");
		$components_id = $viewcompanent['components_id'];

		$result = dbquery("SELECT * FROM ". DB_CARS ." WHERE cars_marka='". (INT)$_GET['id'] ."'");
		if (dbrows($result)) {
			$data = dbarray($result);

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images1'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images1']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images2'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images2']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images3'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images3']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images4'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images4']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5']); }

			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images6']); }
			if (is_file(IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5'])) { unlink (IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images6']); }


			$result = dbquery("DELETE FROM ". DB_CARS ." WHERE cars_id='". $data['cars_id'] ."'");
			$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $components_id ."' AND seourl_filedid='". $data['cars_id'] ."'");
			$result = dbquery("DELETE FROM ". DB_SROK ." WHERE srok_post_type='". $components_id ."' AND srok_post_id='". $data['cars_id'] ."'");
		}

		if (is_file(IMAGES . $settings['markalogos_dir'] ."/". (INT)$_GET['id'] .".gif")) { unlink (IMAGES . $settings['markalogos_dir'] ."/". (INT)$_GET['id'] .".gif"); }

		$result = dbquery("DELETE FROM ". DB_MARKA ." WHERE marka_id='". (INT)$_GET['id'] ."'");
		$result = dbquery("DELETE FROM ". DB_MODEL ." WHERE model_marka_id='". (INT)$_GET['id'] ."'");

		redirect(ADMIN ."marka.php". $aidlink ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

	} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {


		if ($_POST['marka_submit']) {

			$marka_id = (INT)$_GET['id'];
			$marka_imgvar  = trim(stripinput(censorwords(substr($_POST['marka_imgvar'],0,100))));
			$marka_imgsil  = trim(stripinput(censorwords(substr($_POST['marka_imgsil'],0,1))));
			if (empty($marka_imgvar)) {
				$marka_img = $_FILES['marka_img']['name'];
				$marka_imgtmp = $_FILES['marka_img']['tmp_name'];
				$marka_imgsize = $_FILES['marka_img']['size'];
				$marka_imgtype = $_FILES['marka_img']['type'];
			} else {
				$marka_img = $marka_imgvar;
			}
			$marka_name = trim(stripinput(censorwords(substr($_POST['marka_name'],0,255))));
	
		} else if ($_GET['action']=="edit") {

			$result = dbquery("SELECT * FROM ". DB_MARKA ." WHERE marka_id='". (INT)$_GET['id'] ."'");

			if (dbrows($result)) {
				$data = dbarray($result);

				$marka_id = $data['marka_id'];
				$marka_img = $data['marka_id'] .".gif";
				$marka_name = $data['marka_name'];
			} // Yesli DB query yest

		} else {

			$marka_id = "";
			$marka_img = "";
			$marka_name = "";

		}

		if ($_POST['marka_submit']) {

			if (empty($marka_imgvar)) {

				if (empty($marka_img)) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

				if (!empty($marka_img)) {
					if (strlen($marka_img) > 100) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
					// проверяем расширение файла
					$ext = strtolower(substr($marka_img, 1 + strrpos($marka_img, ".")));
					if (!in_array($ext, $valid_types)) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
					// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
					$findtchka = substr_count($marka_img, ".");
					if ($findtchka>1) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
					// 2. если в имени есть .php, .html, .htm - свободен! 
					if (preg_match("/\.php/i",$marka_img))  { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
					if (preg_match("/\.html/i",$marka_img)) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
					if (preg_match("/\.htm/i",$marka_img))  { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
					// 5. Размер фото
					$fotoksize = round($marka_imgsize/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
					$fotomax = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
					if ($fotoksize>$fotomax) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
					// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
					$size = getimagesize($marka_imgtmp);
					if ($size[0]>$settings['foto_x'] or $size[1]>$settings['foto_y']) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size[0] ."x". $size[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
					//if ($size[0]<$size[1]) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
					// Foto 0 Kb
					if ($marka_imgsize<0 and $marka_imgsize>$settings['foto_size']) { $error_marka_img = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
				}
			}
			if (empty($marka_name)) { $error_marka_name = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
			if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

			if ($error) {
				echo "<div id='close-message'>\n";
				echo $error;
				echo "</div>\n";
			} else {


				if ($_GET['action']=="edit") {

					### UPDATE MARKA BEGIN
					$result = dbquery(
						"UPDATE ". DB_MARKA ." SET
														marka_name='". $marka_name ."'
						WHERE marka_id='". $marka_id ."'"
					);
					### UPDATE MARKA END
	
				} else if ($_GET['action']=="add") {

					### INSERT MARKA BEGIN
					$result = dbquery(
						"INSERT INTO ". DB_MARKA ." (
														marka_name
						) VALUES (
														'". $marka_name ."'

						)"
					);
					$marka_id = mysql_insert_id();
					### INSERT MARKA END

				} // Yesli Edit ili Add



				$img_rand_key = mt_rand(100,999);

				if (empty($marka_imgvar)) {
					if (!empty($marka_img)) {
						$marka_imgname = $marka_id .".gif";
						copy($marka_imgtmp, IMAGES . $settings['markalogos_dir'] ."/tmp". $marka_imgname);
						img_resize(IMAGES . $settings['markalogos_dir'] ."/tmp". $marka_imgname, IMAGES . $settings['markalogos_dir'] ."/". $marka_imgname, $settings['markafoto_x'], $settings['markafoto_y']);
						unlink (IMAGES . $settings['markalogos_dir'] ."/tmp". $marka_imgname);
					}
				} else if ($marka_imgsil==1) {
					if (is_file(IMAGES . $settings['markalogos_dir'] ."/". $marka_imgvar)) { unlink (IMAGES . $settings['markalogos_dir'] ."/". $marka_imgvar); }
					$marka_imgname = "";
				} else {
					$marka_imgname = $marka_imgvar;
				}


				if ($_GET['action']=="edit") {
					redirect(ADMIN ."marka.php". $aidlink ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
				} else {
					redirect(ADMIN ."marka.php". $aidlink ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
				}

				$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

				unset($marka_id);
				unset($marka_img);
				unset($marka_name);

			} // Yesli Error Yest

		} // Yesli Post

	} // Yesli Edit ili Add

	if (isset($_GET['status'])) {
		echo "<div id='close-message'>\n";
		if ($_GET['status']=="added") {
			echo "<div class='status'>". $locale['status_001'] ."</div>\n";
		} else if ($_GET['status']=="edited") {
			echo "<div class='status'>". $locale['status_002'] ."</div>\n";
		} else if ($_GET['status']=="deleted") {
			echo "<div class='status'>". $locale['status_003'] ."</div>\n";
		}
		echo "</div>\n";
	}

?>

	<table class="marka_adminka">
		<thead>
			<tr>
				<td class="marka_id"><?php echo $locale['510']; ?></td>
				<td class="marka_img"><?php echo $locale['511']; ?></td>
				<td class="marka_name"><?php echo $locale['512']; ?></td>
				<td class="marka_model"><?php echo $locale['513']; ?></td>
				<td class="marka_cars"><?php echo $locale['514']; ?></td>
				<td class="marka_href"><?php echo $locale['515']; ?></td>
			</tr>
		</thead>
		<tbody>
<?php

		if (isset($_GET['page'])) {
			$say = $_GET['page'];
		} else {
			$say = 1;
		}
		$rowstart = $settings['goradmin']*($say-1);

		$result = dbquery("SELECT
									marka_id,
									marka_name
							FROM ". DB_MARKA ."
							ORDER BY `marka_id` DESC
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
				$carcount = dbcount("(cars_id)", DB_CARS, "cars_marka='". $data['marka_id'] ."'");
				$modelcount = dbcount("(model_id)", DB_MODEL, "model_marka_id='". $data['marka_id'] ."'");
?>
			<tr>
				<td class="marka_id"><a href="<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". $data['marka_id']; ?>">#<?php echo $data['marka_id']; ?></a></td>
				<td class="marka_img"><a href="<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". $data['marka_id']; ?>"><img src="<?php echo (file_exists(IMAGES . $settings['markalogos_dir'] ."/". $data['marka_id'] .".gif") ? IMAGES . $settings['markalogos_dir'] ."/". $data['marka_id'] .".gif" : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?>"></a></td>
				<td class="marka_name"><a href="<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". $data['marka_id']; ?>"><?php echo $data['marka_name']; ?></a></td>
				<td class="marka_model"><a href="<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". $data['marka_id']; ?>">(<?php echo $modelcount; ?>)</a></td>
				<td class="marka_cars"><a href="<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". $data['marka_id']; ?>">(<?php echo $carcount; ?>)</a></td>
				<td class="marka_href">
					<a class='sign' href='<?php echo ADMIN ."marka.php".  $aidlink ."&marka=". $data['marka_id']; ?>' title='<?php echo $locale['522']; ?>'><img src='<?php echo IMAGES; ?>sign-in.png' alt='<?php echo $locale['522']; ?>'></a>
					<a class='edit' href='<?php echo ADMIN ."marka.php".  $aidlink ."&action=edit&id=". $data['marka_id']; ?>' title='<?php echo $locale['520']; ?>'><img src='<?php echo IMAGES; ?>edit.png' alt='<?php echo $locale['520']; ?>'></a>
					<a class='delete' href='<?php echo ADMIN ."marka.php".  $aidlink ."&action=delete&id=". $data['marka_id']; ?>' title='<?php echo $locale['521']; ?>' onclick='return DeleteOk();'><img src='<?php echo IMAGES; ?>delete.png' alt='<?php echo $locale['521']; ?>'></a>
				</td>
			</tr>
<?php
			} // db query
		} else {
?>
			<tr>
				<td colspan="6"><?php echo $locale['501']; ?></td>
			</tr>
<?php
		}

?>
		</tbody>
	</table>
	<table class="marka_adminka">
		<tfoot>
		<form method="POST" name="addmarka" id="addmarka" action="<?php echo ADMIN ."marka.php". $aidlink . ($_GET['action']=="edit" ? "&action=edit&id=". (INT)$_GET['id'] : "&action=add"); ?>" enctype="multipart/form-data">
			<tr>
				<td class="marka_img" colspan="3">
					<?php 
					if ((file_exists(IMAGES . $settings['markalogos_dir'] ."/". $marka_img)) && (!empty($marka_img))) { ?>
					<input type="hidden" name="marka_imgvar" id="marka_imgvar" value="<?php echo $marka_img; ?>">
					<img src="<?php echo IMAGES . $settings['markalogos_dir'] ."/". $marka_img; ?>" alt="<?php echo $marka_name; ?>">
					<label class="checkbox" for="marka_imgsil"><input class="checkbox" value="1" type="checkbox" name="marka_imgsil" id="marka_imgsil"> <?php echo $locale['550']; ?></label>
					<?php } else { ?>
					<input class="textbox<?php echo ($error_marka_img==1 ? " error" : ""); ?>" type="file" name="marka_img" id="marka_img" accept="image/*" />
					<?php } ?>
				</td>
				<td class="marka_name" colspan="3">
					<input class="textbox<?php echo ($error_marka_name==1 ? " error" : ""); ?>" type="text" name="marka_name" id="marka_name" value="<?php echo $marka_name; ?>" maxlength="255" />
				</td>
				<td class="marka_href">
					<input class="button" value="<?php echo $locale['590']; ?>" type="submit" name="marka_submit" id="marka_submit" />
				</td>
			</tr>
		</form>
		</tfoot>
	</table>

<?php
	echo navigation($_GET['page'], $settings['goradmin'], "marka_id", DB_MARKA, "");
?>

		<script type='text/javascript'>
			<!--
			function DeleteOk() {
				return confirm('<?php echo $locale['502']; ?>');
			}
			//-->
		</script>

<?php
} // Yesli Yest marka_id

	closetable();
	
require_once THEMES."templates/footer.php";
?>