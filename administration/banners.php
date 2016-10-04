<?php

require_once "../includes/maincore.php";

if (!checkrights("SB") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/banners.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);


	if ($_GET['action']=="add") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."banners.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $locale['642'] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
	} else {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><span>". $locale['641'] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
	}


	opentable($locale['h1']);
	if ($_GET['action']=="delete") {
		
		$settings_value = explode("|", $settings['sitebanner'. (INT)$_GET['id']]);
		if (is_file(IMAGES . $settings['banners_dir'] ."/". $settings_value[2])) { unlink (IMAGES . $settings['banners_dir'] ."/". $settings_value[2]); }
		$result = dbquery("UPDATE ". DB_SETTINGS ." SET settings_value='' WHERE settings_name='sitebanner". (INT)$_GET['id'] ."'");

		redirect(ADMIN ."banners.php". $aidlink ."&status=deleted", false);

	} else if ($_GET['action']=="add") {

		if ($_POST['banners_submit']) {

			$banners_id = (INT)$_GET['id'];
			$banners_url = str_replace("|", "/", trim(stripinput(censorwords(substr($_POST['banners_url'],0,100)))));
			$banners_type = str_replace("|", "/", trim(stripinput(censorwords(substr($_POST['banners_type'],0,1)))));
			$banners_file = $_FILES['banners_file']['name'];
			$banners_filetmp = $_FILES['banners_file']['tmp_name'];
			$banners_filesize = $_FILES['banners_file']['size'];
			$banners_filetype = $_FILES['banners_file']['type'];
			$banners_title = str_replace("|", "/", trim(stripinput(censorwords(substr($_POST['banners_title'],0,255)))));

		} else {

			$banners_id = (INT)$_GET['id'];
			$banners_url = "http://";
			$banners_type = "";
			$banners_file = "";
			$banners_title = "";

		} // Yesli POST

		if ($_POST['banners_submit']) {

			if (empty($banners_url)) { $error_banners_url = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
			if ($banners_url=="http://") { $error_banners_url = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
			if (!empty($banners_url) && !preg_match('/^http:\/\//i', $banners_url)) {  $error_banners_url = 1; $error .= "<div class='error'>". $locale['error_011'] ."</div>\n";  }
			if (empty($banners_type)) { $error_banners_type = 1; $error .= "<div class='error'>". $locale['error_012'] ."</div>\n"; }
			if (empty($banners_file)) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

			if (!empty($banners_file)) {

				if ($banners_type==1) {
					$valid_types=array("swf"); // допустимые расширения
				}

				if (strlen($banners_file) > 100) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
				// проверяем расширение файла
				$ext1 = strtolower(substr($banners_file, 1 + strrpos($banners_file, ".")));
				if (!in_array($ext1, $valid_types)) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_051'] ." (". implode(", ", $valid_types) .")!</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$findtchka1 = substr_count($banners_file, ".");
				if ($findtchka1>1) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$banners_file))  { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
				if (preg_match("/\.html/i",$banners_file)) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$banners_file))  { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
				// 5. Размер фото
				$fotoksize1 = round($banners_filesize/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$fotomax1 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
				if ($fotoksize1>$fotomax1) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize1 ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$size1 = getimagesize($banners_filetmp);
				if ($size1[0]>$settings['foto_x'] or $size1[1]>$settings['foto_y']) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size1[0] ."x". $size1[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
				//if ($size1[0]<$size1[1]) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
				// Foto 0 Kb
				if ($banners_filesize<0 and $banners_filesize>$settings['foto_size']) { $error_banners_file = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
			}

			if (!check_admin_pass(isset($_POST['admin_password']) ? stripinput($_POST['admin_password']) : "")) { $error_admin_password = 1; $error .= "<div class='error'>". $locale['error_490'] ."</div>\n"; }

			if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

			if ($error) {
				echo "<div id='close-message'>\n";
				echo $error;
				echo "</div>\n";
			} else {

				if (!empty($banners_file)) {
					$banners_filename = explode(".", $banners_file);
					$banners_filename = "banner_". $banners_id .".". $banners_filename[1];
					copy($banners_filetmp, IMAGES . $settings['banners_dir'] ."/". $banners_filename);
				}

				$settings_value = $banners_url ."|". $banners_type ."|". $banners_filename ."|". $banners_title;
				$result = dbquery("UPDATE ". DB_SETTINGS ." SET settings_value='". $settings_value ."' WHERE settings_name='sitebanner". $banners_id ."'");

				set_admin_pass(isset($_POST['admin_password']) ? stripinput($_POST['admin_password']) : "");

				$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

				redirect(ADMIN ."banners.php". $aidlink ."&status=added", false);

				unset($banners_url);
				unset($banners_type);
				unset($banners_file);
				unset($banners_title);

			} // Yesli Error

		} // Yesli POST
	?>

	<form method="POST" name="addbanner" id="addbanner" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
		<table class="add_banners">
			<tbody>
				<tr>
					<td style="width:150px;"><?php echo $locale['650']; ?><?php echo UL; ?></td>
					<td>
						<input class="textbox<?php echo ($error_banners_url==1 ? " error" : ""); ?>" type="text" maxlength="100" name="banners_url" id="banners_url" value="<?php echo $banners_url; ?>" />
					</td>
				</tr>
				<tr>
					<td><?php echo $locale['651']; ?><?php echo UL; ?></td>
					<td>
						<select class="select<?php echo ($error_banners_type==1 ? " error" : ""); ?>" name="banners_type" id="banners_type">
							<option value="1"<?php echo ($banners_type==1 ? " selected" : ""); ?>><?php echo $locale['bannerstype_1']; ?></option>
							<option value="2"<?php echo ($banners_type==2 ? " selected" : ""); ?>><?php echo $locale['bannerstype_2']; ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $locale['652']; ?><?php echo UL; ?></td>
					<td>
						<input class="textbox<?php echo ($error_banners_file==1 ? " error" : ""); ?>" type="file" name="banners_file" id="banners_file" />
					</td>
				</tr>
				<tr>
					<td><?php echo $locale['653']; ?></td>
					<td>
						<input class="textbox<?php echo ($error_banners_title==1 ? " error" : ""); ?>" type="text" maxlength="255" name="banners_title" id="banners_title" value="<?php echo $banners_title; ?>" />
					</td>
				</tr>
				<?php // if (!check_admin_pass(isset($_POST['admin_password']) ? stripinput($_POST['admin_password']) : "")) { ?>
				<tr>
					<td><?php echo $locale['654']; ?></td>
					<td>
						<input class="textbox<?php echo ($error_admin_password==1 ? " error" : ""); ?>" type="password" maxlength="64" name="admin_password" id="admin_password" value="" style="width:150px;" autocomplete="off" />
					</td>
				</tr>
				<?php // } ?>
				<tr>
					<td colspan="2" style="text-align:center;">
						<input class="button" value="<?php echo $locale['501']; ?>" type="submit" name="banners_submit" id="banners_submit" onclick="return(check())" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>

	<?php
	} else {

		if (isset($_GET['status'])) {
			echo "<div id='close-message'>\n";
			if ($_GET['status']=="added") {
				echo "<div class='status'>". $locale['status_001'] ."</div>\n";
			} else if ($_GET['status']=="deleted") {
				echo "<div class='status'>". $locale['status_002'] ."</div>\n";
			}
			echo "</div>\n";
		}
?>

		<table class="banners_list">
			<tr>
				<td class="tops top1">
					<?php
						if ($settings['sitebanner1']) {
							echo "<div class='bannersam true'>";
							echo $locale['510'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=1' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['510'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=1'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="tops top2">
					<?php
						if ($settings['sitebanner2']) {
							echo "<div class='bannersam true'>";
							echo $locale['511'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=2' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['511'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=2'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="tops top3">
					<?php
						if ($settings['sitebanner3']) {
							echo "<div class='bannersam true'>";
							echo $locale['512'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=3' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['512'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=3'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="tops top4">
					<?php
						if ($settings['sitebanner4']) {
							echo "<div class='bannersam true'>";
							echo $locale['513'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=4' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['513'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=4'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
				<td class="lefts left1">
					<?php
						if ($settings['sitebanner5']) {
							echo "<div class='bannersam true'>";
							echo $locale['514'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=5' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['514'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=5'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="centers center1">
					<?php
						if ($settings['sitebanner13']) {
							echo "<div class='bannersam true'>";
							echo $locale['522'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=13' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['522'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=13' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="lefts left2">
					<?php
						if ($settings['sitebanner6']) {
							echo "<div class='bannersam true'>";
							echo $locale['515'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=6' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['515'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=6'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="centers center2">
					<?php
						if ($settings['sitebanner14']) {
							echo "<div class='bannersam true'>";
							echo $locale['523'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=14' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['523'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=14' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="lefts left3">
					<?php
						if ($settings['sitebanner7']) {
							echo "<div class='bannersam true'>";
							echo $locale['516'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=7' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['516'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=7'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="centers center3">
					<?php
						if ($settings['sitebanner15']) {
							echo "<div class='bannersam true'>";
							echo $locale['524'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=15' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['524'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=15' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="lefts left4">
					<?php
						if ($settings['sitebanner8']) {
							echo "<div class='bannersam true'>";
							echo $locale['517'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=8' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['517'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=8'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="centers center4">
					<?php
						if ($settings['sitebanner16']) {
							echo "<div class='bannersam true'>";
							echo $locale['525'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=16' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['525'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=16' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="lefts left5">
					<?php
						if ($settings['sitebanner9']) {
							echo "<div class='bannersam true'>";
							echo $locale['518'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=9' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['518'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=9'title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="centers center5">
					<?php
						if ($settings['sitebanner17']) {
							echo "<div class='bannersam true'>";
							echo $locale['526'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=17' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['526'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=17' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="lefts left6">
					<?php
						if ($settings['sitebanner10']) {
							echo "<div class='bannersam true'>";
							echo $locale['519'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=10' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['519'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=10' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="centers center6">
					<?php
						if ($settings['sitebanner18']) {
							echo "<div class='bannersam true'>";
							echo $locale['527'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=18' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['527'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=18' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="lefts left7">
					<?php
						if ($settings['sitebanner11']) {
							echo "<div class='bannersam true'>";
							echo $locale['520'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=11' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['520'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=11' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
				<td class="lefts left8">
					<?php
						if ($settings['sitebanner12']) {
							echo "<div class='bannersam true'>";
							echo $locale['521'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=12' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['521'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=12' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="foots foot1">
					<?php
						if ($settings['sitebanner19']) {
							echo "<div class='bannersam true'>";
							echo $locale['528'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=19' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['528'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=19' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="foots foot2">
					<?php
						if ($settings['sitebanner20']) {
							echo "<div class='bannersam true'>";
							echo $locale['529'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=20' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['529'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=20' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="foots foot3">
					<?php
						if ($settings['sitebanner21']) {
							echo "<div class='bannersam true'>";
							echo $locale['530'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=21' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['530'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=21' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
				<td class="foots foot4">
					<?php
						if ($settings['sitebanner22']) {
							echo "<div class='bannersam true'>";
							echo $locale['531'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=delete&id=22' title='". $locale['502'] ."' onclick='return DeleteOk();'>-</a>\n";
							echo "</div>";
						} else {
							echo "<div class='bannersam false'>";
							echo $locale['531'] ."\n";
							echo "<a href='". ADMIN ."banners.php".  $aidlink ."&action=add&id=22' title='". $locale['501'] ."'>+</a>\n";
							echo "</div>";
						}
					?>
				</td>
			</tr>
		</table>

		<script type='text/javascript'>
			<!--
			function DeleteOk() {
				return confirm('<?php echo $locale['503']; ?>');
			}
			//-->
		</script>

<?php

	} // Yesli Add ili Delete

	closetable();

require_once THEMES."templates/footer.php";
?>