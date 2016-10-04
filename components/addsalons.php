<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

session_start();

include LOCALE.LOCALESET."addsalons.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
	echo "		<li><a href='". BASEDIR ."autosalons/'>". $locale['641'] ."</a></li>\n";
	echo "		<li><span>". $locale['642'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($locale['h1']);

	if ($_POST['salon_submit']) {

		$salon_name = trim(stripinput(censorwords(substr($_POST['salon_name'],0,255))));
		$salon_qorod = trim(stripinput(censorwords(substr($_POST['salon_qorod'],0,10))));
		$salon_adress = trim(stripinput(censorwords(substr($_POST['salon_adress'],0,500))));
		$salon_mobiltel = trim(stripinput(censorwords(substr($_POST['salon_mobiltel'],0,100))));
		$salon_mobiltel = str_replace(" ", "", $salon_mobiltel);
		$salon_mobiltel = str_replace("(", "", $salon_mobiltel);
		$salon_mobiltel = str_replace(")", "", $salon_mobiltel);
		$salon_mobiltel = str_replace("-", "", $salon_mobiltel);
		$salon_mobiltel = str_replace("_", "", $salon_mobiltel);
		$salon_tel = trim(stripinput(censorwords(substr($_POST['salon_tel'],0,100))));
		$salon_tel = str_replace(" ", "", $salon_tel);
		$salon_tel = str_replace("(", "", $salon_tel);
		$salon_tel = str_replace(")", "", $salon_tel);
		$salon_tel = str_replace("-", "", $salon_tel);
		$salon_tel = str_replace("_", "", $salon_tel);
		$salon_email = trim(stripinput(censorwords(substr($_POST['salon_email'],0,100))));
		$salon_site = trim(stripinput(censorwords(substr($_POST['salon_site'],0,100))));
		$salon_site = str_replace("http://", "", $salon_site);
		$salon_site = explode("/", $salon_site);
		$salon_site = $salon_site[0];

		$salon_images1 =  $_FILES['salon_images1']['name'];
		$salon_images1tmp  = $_FILES['salon_images1']['tmp_name'];
		$salon_images1size = $_FILES['salon_images1']['size'];
		$salon_images1type = $_FILES['salon_images1']['type'];

		$salon_images2 =  $_FILES['salon_images2']['name'];
		$salon_images2tmp  = $_FILES['salon_images2']['tmp_name'];
		$salon_images2size = $_FILES['salon_images2']['size'];
		$salon_images2type = $_FILES['salon_images2']['type'];

		$salon_images3 =  $_FILES['salon_images3']['name'];
		$salon_images3tmp  = $_FILES['salon_images3']['tmp_name'];
		$salon_images3size = $_FILES['salon_images3']['size'];
		$salon_images3type = $_FILES['salon_images3']['type'];

		$salon_elaveinfo = trim(stripinput(censorwords(substr($_POST['salon_elaveinfo'],0,1000))));
		$salon_ip = FUSION_IP;
		$salon_today = FUSION_TODAY;
		$salon_views = 1;
		$salon_aktiv = 2;
		$salon_vip = 0;

	} else {

		$salon_name = "";
		$salon_qorod = "";
		$salon_adress = "";
		$salon_mobiltel = "+994";
		$salon_tel = "+994";
		$salon_email = "";
		$salon_site = "";

		$salon_images1 = "";
		$salon_images2 = "";
		$salon_images3 = "";

		$salon_elaveinfo = "";
		$salon_ip = "";
		$salon_today = "";
		$salon_views = "";
		$salon_aktiv = "";
		$salon_vip = "";

	}

	if ($_POST['salon_submit']) {

		if (empty($salon_name)) { $error_salon_name = 1; $error .= "<div class='error'>". $locale['error_001'] ."</div>\n"; }
		if (empty($salon_qorod)) { $error_salon_qorod = 1; $error .= "<div class='error'>". $locale['error_002'] ."</div>\n"; }
		if (empty($salon_adress)) { $error_salon_adress = 1; $error .= "<div class='error'>". $locale['error_003'] ."</div>\n"; }
		if (empty($salon_mobiltel)) { $error_salon_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		if ($salon_mobiltel=="+994") { $error_salon_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (strlen($salon_mobiltel) < 13) { $error_salon_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (!empty($salon_mobiltel) && !preg_match("/^([0-9])+$/is", $salon_mobiltel)) { $error_salon_mobiltel = 1; $error .= "<div class='error'>". $locale['error_005'] ."</div>\n"; }
		// if (empty($salon_tel)) { $error_salon_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if ($salon_tel=="+994") { $error_salon_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (strlen($salon_tel) < 13) { $error_salon_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (!empty($salon_tel) && !preg_match("/^([0-9])+$/is", $salon_tel)) { $error_salon_tel = 1; $error .= "<div class='error'>". $locale['error_007'] ."</div>\n"; }
		if (!empty($salon_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $salon_email)) { $error_salon_email = 1; $error .= "<div class='error'>". $locale['error_008'] ."</div>\n"; }
		if (!empty($salon_site) && !eregi("^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$", $salon_site)) { $error_salon_site = 1; $error .= "<div class='error'>". $locale['error_009'] ."</div>\n"; }


		if (empty($salon_images1)) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

		$valid_types=array("gif","jpg","png","jpeg");  // допустимые расширения

		if (!empty($salon_images1)) {
			if (strlen($salon_images1) > 100) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
			// проверяем расширение файла
			$ext1 = strtolower(substr($salon_images1, 1 + strrpos($salon_images1, ".")));
			if (!in_array($ext1, $valid_types)) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka1 = substr_count($salon_images1, ".");
			if ($findtchka1>1) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$salon_images1))  { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
			if (preg_match("/\.html/i",$salon_images1)) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$salon_images1))  { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize1 = round($salon_images1size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax1 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize1>$fotomax1) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize1 ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size1 = getimagesize($salon_images1tmp);
			if ($size1[0]>$settings['foto_x'] or $size1[1]>$settings['foto_y']) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size1[0] ."x". $size1[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size1[0]<$size1[1]) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
			// Foto 0 Kb
			if ($salon_images1size<0 and $salon_images1size>$settings['foto_size']) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
		}


		if (!empty($salon_images2)) {
			if (strlen($salon_images2) > 100) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_064'] ."</div>\n"; }
			// проверяем расширение файла
			$ext2 = strtolower(substr($salon_images2, 1 + strrpos($salon_images2, ".")));
			if (!in_array($ext2, $valid_types)) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_065'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka2 = substr_count($salon_images2, ".");
			if ($findtchka2>1) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_066'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$salon_images2))  { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_067'] ."</div>\n"; }
			if (preg_match("/\.html/i",$salon_images2)) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_068'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$salon_images2))  { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_069'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize2 = round($salon_images2size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax2 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize2>$fotomax2) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_070'] ."<br />". $locale['error_057'] ." ". $fotoksize2 ." Kb<br />". $locale['error_058'] ." ". $fotomax2 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size2 = getimagesize($salon_images2tmp);
			if ($size2[0]>$settings['foto_x'] or $size2[1]>$settings['foto_y']) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_071'] ."<br />". $locale['error_060'] ." ". $size2[0] ."x". $size2[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size2[0]<$size2[1]) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_072'] ."</div>\n"; }
			// Foto 0 Kb
			if ($salon_images2size<"0" and $salon_images2size>$settings['foto_size']) { $error_salon_images2 = 1; $error .= "<div class='error'>". $locale['error_073'] ."</div>\n"; }
		}


		if (!empty($salon_images3)) {
			if (strlen($salon_images3) > 100) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_074'] ."</div>\n"; }
			// проверяем расширение файла
			$ext3 = strtolower(substr($salon_images3, 1 + strrpos($salon_images3, ".")));
			if (!in_array($ext3, $valid_types)) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_075'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka3=substr_count($salon_images3, ".");
			if ($findtchka3>1) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_076'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$salon_images3))  { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_077'] ."</div>\n"; }
			if (preg_match("/\.html/i",$salon_images3)) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_078'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$salon_images3))  { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_079'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize3=round($salon_images3size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax3=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize3>$fotomax3) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_080'] ."<br />". $locale['error_057'] ." ". $fotoksize3 ." Kb<br />". $locale['error_058'] ." ". $fotomax3 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size3=getimagesize($salon_images3tmp);
			if ($size3[0]>$settings['foto_x'] or $size3[1]>$settings['foto_y']) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_081'] ."<br />". $locale['error_060'] ." ". $size3[0] ."x". $size3[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size3[0]<$size3[1]) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_082'] ."</div>\n"; }
			// Foto 0 Kb
			if   ($salon_images3size<"0" and $salon_images3size>$settings['foto_size']) { $error_salon_images3 = 1; $error .= "<div class='error'>". $locale['error_083'] ."</div>\n"; }
		}

		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);

			if (!empty($salon_images1)) {
				$salon_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
				$salon_images1namerl = "rl". $salon_images1name;
				$salon_images1namesm = "sm". $salon_images1name;
				copy($salon_images1tmp, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name);
				img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name);
			}

			if (!empty($salon_images2)) {
				$salon_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
				$salon_images2namerl = "rl". $salon_images2name;
				$salon_images2namesm = "sm". $salon_images2name;
				copy($salon_images2tmp, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name);
				img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name);
			}

			if (!empty($salon_images3)) {
				$salon_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
				$salon_images3namerl = "rl". $salon_images3name;
				$salon_images3namesm = "sm". $salon_images3name;
				copy($salon_images3tmp, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name);
				img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name);
			}


			### INSERT salon BEGIN
			$salon_imgocher = $salon_images1name;
			if ($salon_tel=="+994") { $salon_tel=""; }
			
			$result = dbquery(
				"INSERT INTO ". DB_SALONS ." (
												salon_name,
												salon_qorod,
												salon_adress,
												salon_mobiltel,
												salon_tel,
												salon_email,
												salon_site,
												salon_images1,
												salon_images2,
												salon_images3,
												salon_imgocher,
												salon_elaveinfo,
												salon_ip,
												salon_today,
												salon_views,
												salon_aktiv,
												salon_vip
				) VALUES (
												'". $salon_name ."',
												'". $salon_qorod ."',
												'". $salon_adress ."',
												'". $salon_mobiltel ."',
												'". $salon_tel ."',
												'". $salon_email ."',
												'". $salon_site ."',
												'". $salon_images1name ."',
												'". $salon_images2name ."',
												'". $salon_images3name ."',
												'". $salon_imgocher ."',
												'". $salon_elaveinfo ."',
												'". $salon_ip ."',
												'". $salon_today ."',
												'". $salon_views ."',
												'". $salon_aktiv ."',
												'". $salon_vip ."'

				)"
			);
			// $salon_id = mysql_insert_id();
			$salon_id = _DB::$linkes->insert_id;
			### INSERT salon END


			### INSERT SEOURL BEGIN
			$seourl_url = "autosalons/". $salon_id ."-". autocrateseourls($salon_name ."_". $locale['qorod_'. $salon_qorod]) ."/";
			$viewcompanent = viewcompanent("salon", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = $salon_id;

			$result = dbquery(
				"INSERT INTO ". DB_SEOURL ." (
													seourl_url,
													seourl_component,
													seourl_filedid
				) VALUES (
													'". $seourl_url ."',
													'". $seourl_component ."',
													'". $seourl_filedid ."'
				)"
			);
			### INSERT SEOURL END


			### INSERT SROK BEGIN
			$viewcompanent = viewcompanent("salon", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $salon_id;
			$srok_date = FUSION_TODAY+$settings['qalmavaxti'];

			$result = dbquery(
				"INSERT INTO ". DB_SROK ." (
													srok_post_type,
													srok_post_id,
													srok_date
				) VALUES (
													'". $srok_post_type ."',
													'". $srok_post_id ."',
													'". $srok_date ."'
				)"
			);
			### INSERT SROK END



			### SEND MAIL BEGIN
			if ($settings['sendmail']==1) {

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "<table border='0' width='100%'>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_010'] ."</b></td><td>". date("d.m.Y H:i:s", $salon_today) ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_011'] ."</b></td><td>". $salon_id ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_012'] ."</b></td><td>". $salon_name ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_013'] ."</b></td><td>". $salon_mobiltel ."</td>\n</tr>\n";
				if (!empty($salon_tel))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_014'] ."</b></td><td>". $salon_tel ."</td>\n</tr>\n"; }
				if (!empty($salon_email))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_015'] ."</b></td><td>". $salon_email ."</td>\n</tr>\n"; }
				if (!empty($salon_site))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_016'] ."</b></td><td>". $salon_site ."</td>\n</tr>\n"; }
				if (!empty($salon_elaveinfo)){ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_017'] ."</b></td><td>". $salon_elaveinfo ."</td>\n</tr>\n"; }
				$allmsg .= "<tr>\n<td colspan='2'> </td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>---</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['sitename'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteurl'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteemail'] ."</td>\n</tr>\n";
				$allmsg .= "</table>\n";

				// Отправляем письмо майлеру
				mail($settings['siteemail'], $salon_name ." ". $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END


			$result_alter = dbquery("ALTER TABLE `". DB_SALONS ."` ORDER BY `salon_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

			echo "<div class='success'>". $locale['success_001'] ."<b>". $salon_id ."</b></div>\n";

			// gormek
			$gormek = 1;
			// gormek

			unset($salon_name);
			unset($salon_qorod);
			unset($salon_adress);
			unset($salon_mobiltel);
			unset($salon_tel);
			unset($salon_email);
			unset($salon_site);
			unset($salon_images1);
			unset($salon_images2);
			unset($salon_images3);
			unset($salon_imgocher);
			unset($salon_elaveinfo);
			unset($salon_ip);
			unset($salon_today);
			unset($salon_views);
			unset($salon_aktiv);
			unset($salon_vip);

		} // Yesli Error Yest
	} // Yesli POST

	if ($gormek!=1) {
?>


<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#salon_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#salon_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addsalon" id="addsalon" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
	<div class="addsalon">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds salon_name">
				<label for="salon_name"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_salon_name==1 ? " error" : ""); ?>" type="text" maxlength="255" name="salon_name" id="salon_name" value="<?php echo $salon_name; ?>" />
			</div>
			<div class="fileds salon_qorod">
				<label for="salon_qorod"><?php echo $locale['511']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_salon_qorod==1 ? " error" : ""); ?>" name="salon_qorod" id="salon_qorod">
					<option value=""<?php echo ($salon_qorod=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<optgroup label="<?php echo $locale['zona_1']; ?>">
						<option value="1"<?php echo ($salon_qorod==1 ? " selected" : ""); ?>><?php echo $locale['qorod_1']; ?></option>
						<option value="2"<?php echo ($salon_qorod==2 ? " selected" : ""); ?>><?php echo $locale['qorod_2']; ?></option>
						<option value="3"<?php echo ($salon_qorod==3 ? " selected" : ""); ?>><?php echo $locale['qorod_3']; ?></option>
						<option value="4"<?php echo ($salon_qorod==4 ? " selected" : ""); ?>><?php echo $locale['qorod_4']; ?></option>
						<option value="5"<?php echo ($salon_qorod==5 ? " selected" : ""); ?>><?php echo $locale['qorod_5']; ?></option>
						<option value="6"<?php echo ($salon_qorod==6 ? " selected" : ""); ?>><?php echo $locale['qorod_6']; ?></option>
						<option value="7"<?php echo ($salon_qorod==7 ? " selected" : ""); ?>><?php echo $locale['qorod_7']; ?></option>
						<option value="8"<?php echo ($salon_qorod==8 ? " selected" : ""); ?>><?php echo $locale['qorod_8']; ?></option>
						<option value="9"<?php echo ($salon_qorod==9 ? " selected" : ""); ?>><?php echo $locale['qorod_9']; ?></option>
						<option value="10"<?php echo ($salon_qorod==10 ? " selected" : ""); ?>><?php echo $locale['qorod_10']; ?></option>
						<option value="11"<?php echo ($salon_qorod==11 ? " selected" : ""); ?>><?php echo $locale['qorod_11']; ?></option>
						<option value="12"<?php echo ($salon_qorod==12 ? " selected" : ""); ?>><?php echo $locale['qorod_12']; ?></option>
						<option value="13"<?php echo ($salon_qorod==13 ? " selected" : ""); ?>><?php echo $locale['qorod_13']; ?></option>
						<option value="14"<?php echo ($salon_qorod==14 ? " selected" : ""); ?>><?php echo $locale['qorod_14']; ?></option>
						<option value="15"<?php echo ($salon_qorod==15 ? " selected" : ""); ?>><?php echo $locale['qorod_15']; ?></option>
						<option value="16"<?php echo ($salon_qorod==16 ? " selected" : ""); ?>><?php echo $locale['qorod_16']; ?></option>
						<option value="17"<?php echo ($salon_qorod==17 ? " selected" : ""); ?>><?php echo $locale['qorod_17']; ?></option>
						<option value="18"<?php echo ($salon_qorod==18 ? " selected" : ""); ?>><?php echo $locale['qorod_18']; ?></option>
						<option value="19"<?php echo ($salon_qorod==19 ? " selected" : ""); ?>><?php echo $locale['qorod_19']; ?></option>
						<option value="20"<?php echo ($salon_qorod==20 ? " selected" : ""); ?>><?php echo $locale['qorod_20']; ?></option>
					</optgroup>
						<optgroup label="<?php echo $locale['zona_2']; ?>">
						<option value="51"<?php echo ($salon_qorod==51 ? " selected" : ""); ?>><?php echo $locale['qorod_51']; ?></option>
						<option value="52"<?php echo ($salon_qorod==52 ? " selected" : ""); ?>><?php echo $locale['qorod_52']; ?></option>
						<option value="53"<?php echo ($salon_qorod==53 ? " selected" : ""); ?>><?php echo $locale['qorod_53']; ?></option>
						<option value="54"<?php echo ($salon_qorod==54 ? " selected" : ""); ?>><?php echo $locale['qorod_54']; ?></option>
					</optgroup>
				</select>
			</div>
			<div class="fileds salon_adress">
				<label for="salon_adress"><?php echo $locale['512']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_salon_adress==1 ? " error" : ""); ?>" type="text" maxlength="500" name="salon_adress" id="salon_adress" value="<?php echo $salon_adress; ?>" />
			</div>
			<div class="fileds salon_mobiltel">
				<label for="salon_mobiltel"><?php echo $locale['513']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_salon_mobiltel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="salon_mobiltel" id="salon_mobiltel" value="<?php echo $salon_mobiltel; ?>" />
			</div>
			<div class="fileds salon_tel">
				<label for="salon_tel"><?php echo $locale['514']; ?></label>
				<input class="textbox<?php echo ($error_salon_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="salon_tel" id="salon_tel" value="<?php echo $salon_tel; ?>" />
			</div>
			<div class="fileds salon_email">
				<label for="salon_email"><?php echo $locale['515']; ?></label>
				<input class="textbox<?php echo ($error_salon_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="salon_email" id="salon_email" value="<?php echo $salon_email; ?>" />
				<?php echo $locale['516']; ?>
			</div>
			<div class="fileds salon_site">
				<label for="salon_site"><?php echo $locale['517']; ?></label>
				<input class="textbox<?php echo ($error_salon_site==1 ? " error" : ""); ?>" type="text" maxlength="100" name="salon_site" id="salon_site" value="<?php echo $salon_site; ?>" />
			</div>
			<div class="hr"></div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds salon_images">
				<label for="salon_images1"><?php echo $locale['520']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_salon_images1==1 ? " error" : ""); ?>" type="file" name="salon_images1" id="salon_images1" accept="image/*" />
				<label for="salon_images2"><?php echo $locale['521']; ?></label>
				<input class="textbox<?php echo ($error_salon_images2==1 ? " error" : ""); ?>" type="file" name="salon_images2" id="salon_images2" accept="image/*" />
				<label for="salon_images3"><?php echo $locale['522']; ?></label>
				<input class="textbox<?php echo ($error_salon_images3==1 ? " error" : ""); ?>" type="file" name="salon_images3" id="salon_images3" accept="image/*" />
			</div>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds salon_elaveinfo">
				<textarea class="textbox<?php echo ($error_salon_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="salon_elaveinfo" id="salon_elaveinfo"><?php echo $salon_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
			<div class="fileds salon_submit">
				<a href="#" onclick="document.getElementById('qayda').style.display='block'; return false"><?php echo $locale['591']; ?></a>
				<input class="checkbox" type="checkbox" value="rules" name="salon_rules" id="#salon_rules" onclick="this.form.salon_submit.disabled=!this.form.salon_rules.checked" />
				<input disabled class="button" value="<?php echo $locale['590']; ?>" type="submit" name="salon_submit" id="salon_submit" onclick="return(check())" />
			</div>
			<div class="fileds salon_qayda" id="qayda" style="display:none;">
				<a class="clouse" href="#" onclick="document.getElementById('qayda').style.display='none'; return false">x</a>
				<?php echo $locale['600']; ?>
			</div>
		</div>
	</div>
</form>
<div class="obyazatelno"><?php echo $locale['610']; ?></div>
<?php
	} // Yesli gormek 1 tushta

	closetable();
?>