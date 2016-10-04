<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

session_start();

include LOCALE.LOCALESET."addparts.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
	echo "		<li><span>". $locale['641'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($locale['h1']);

	if ($_POST['parts_rules']) {

		$parts_category_id = trim(stripinput(censorwords(substr($_POST['parts_category_id'],0,10))));
		$parts_name = trim(stripinput(censorwords(substr($_POST['parts_name'],0,255))));
		$parts_qiymeti = trim(stripinput(censorwords(substr($_POST['parts_qiymeti'],0,10))));
		$parts_valyuta = trim(stripinput(censorwords(substr($_POST['parts_valyuta'],0,1))));
		$parts_shop_id = trim(stripinput(censorwords(substr($_POST['parts_shop_id'],0,10))));
		$parts_adi = trim(stripinput(censorwords(substr($_POST['parts_adi'],0,100))));
		$parts_mobiltel = trim(stripinput(censorwords(substr($_POST['parts_mobiltel'],0,100))));
		$parts_mobiltel = str_replace(" ", "", $parts_mobiltel);
		$parts_mobiltel = str_replace("(", "", $parts_mobiltel);
		$parts_mobiltel = str_replace(")", "", $parts_mobiltel);
		$parts_mobiltel = str_replace("-", "", $parts_mobiltel);
		$parts_mobiltel = str_replace("_", "", $parts_mobiltel);
		$parts_tel = trim(stripinput(censorwords(substr($_POST['parts_tel'],0,100))));
		$parts_tel = str_replace(" ", "", $parts_tel);
		$parts_tel = str_replace("(", "", $parts_tel);
		$parts_tel = str_replace(")", "", $parts_tel);
		$parts_tel = str_replace("-", "", $parts_tel);
		$parts_tel = str_replace("_", "", $parts_tel);
		$parts_email = trim(stripinput(censorwords(substr($_POST['parts_email'],0,100))));


		$parts_images1 =  $_FILES['parts_images1']['name'];
		$parts_images1tmp  = $_FILES['parts_images1']['tmp_name'];
		$parts_images1size = $_FILES['parts_images1']['size'];
		$parts_images1type = $_FILES['parts_images1']['type'];

		$parts_images2 =  $_FILES['parts_images2']['name'];
		$parts_images2tmp  = $_FILES['parts_images2']['tmp_name'];
		$parts_images2size = $_FILES['parts_images2']['size'];
		$parts_images2type = $_FILES['parts_images2']['type'];

		$parts_images3 =  $_FILES['parts_images3']['name'];
		$parts_images3tmp  = $_FILES['parts_images3']['tmp_name'];
		$parts_images3size = $_FILES['parts_images3']['size'];
		$parts_images3type = $_FILES['parts_images3']['type'];


		$parts_elaveinfo = trim(stripinput(censorwords(substr($_POST['parts_elaveinfo'],0,1000))));
		$parts_ip = FUSION_IP;
		$parts_today = FUSION_TODAY;
		$parts_views = 1;
		$parts_aktiv = 2;
		$parts_vip = 0;

	} else {

		$parts_category_id = "";
		$parts_name = "";
		$parts_qiymeti = "";
		$parts_valyuta = "";
		$parts_shop_id = "";
		$parts_adi = "";
		$parts_mobiltel = "+994";
		$parts_tel = "+994";
		$parts_email = "";

		$parts_images1 = "";
		$parts_images2 = "";
		$parts_images3 = "";

		$parts_elaveinfo = "";
		$parts_ip = "";
		$parts_today = "";
		$parts_views = "";
		$parts_aktiv = "";
		$parts_vip = "";

	} // Yesli POST

	if ($_POST['parts_rules']) {

		if (empty($parts_category_id)) { $error_parts_category_id = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
		if (empty($parts_name)) { $error_parts_name = 1; $error .= "<div class='error'>". $locale['error_011'] ."</div>\n"; }
		if (empty($parts_qiymeti)) { $error_parts_qiymeti = 1; $error .= "<div class='error'>". $locale['error_012'] ."</div>\n"; }
		if (!empty($parts_qiymeti) && !preg_match("/^([0-9])+$/is", $parts_qiymeti)) { $error_parts_qiymeti = 1; $error .= "<div class='error'>". $locale['error_013'] ."</div>\n"; }
		// if (empty($parts_shop_id)) { $error_parts_shop_id = 1; $error .= "<div class='error'>". $locale['error_014'] ."</div>\n"; }
		if (empty($parts_adi)) { $error_parts_adi = 1; $error .= "<div class='error'>". $locale['error_015'] ."</div>\n"; }
		if (empty($parts_mobiltel)) { $error_parts_mobiltel = 1; $error .= "<div class='error'>". $locale['error_016'] ."</div>\n"; }
		if ($parts_mobiltel=="+994") { $error_parts_mobiltel = 1; $error .= "<div class='error'>". $locale['error_016'] ."</div>\n"; }
		// if (strlen($parts_mobiltel) < 13) { $error_parts_mobiltel = 1; $error .= "<div class='error'>". $locale['error_016'] ."</div>\n"; }
		// if (!empty($parts_mobiltel) && !preg_match("/^([0-9])+$/is", $parts_mobiltel)) { $error_parts_mobiltel = 1; $error .= "<div class='error'>". $locale['error_017'] ."</div>\n"; }
		// if (empty($parts_tel)) { $error_parts_tel = 1; $error .= "<div class='error'>". $locale['error_018'] ."</div>\n"; }
		// if ($parts_tel=="+994") { $error_parts_tel = 1; $error .= "<div class='error'>". $locale['error_018'] ."</div>\n"; }
		// if (strlen($parts_tel) < 13) { $error_cars_tel = 1; $error .= "<div class='error'>". $locale['error_018'] ."</div>\n"; }
		// if (!empty($parts_tel) && !preg_match("/^([0-9])+$/is", $parts_tel)) { $error_cars_tel = 1; $error .= "<div class='error'>". $locale['error_019'] ."</div>\n"; }
		if (!empty($parts_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $parts_email)) { $error_parts_email = 1; $error .= "<div class='error'>". $locale['error_020'] ."</div>\n"; }




		if (empty($parts_images1)) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

		// $valid_types=array("gif","jpg","png","jpeg");  // допустимые расширения

		if (!empty($parts_images1)) {
			if (strlen($parts_images1) > 100) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
			// проверяем расширение файла
			$ext1 = strtolower(substr($parts_images1, 1 + strrpos($parts_images1, ".")));
			if (!in_array($ext1, $valid_types)) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka1 = substr_count($parts_images1, ".");
			if ($findtchka1>1) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$parts_images1))  { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
			if (preg_match("/\.html/i",$parts_images1)) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$parts_images1))  { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize1 = round($parts_images1size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax1 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize1>$fotomax1) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize1 ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size1 = getimagesize($parts_images1tmp);
			if ($size1[0]>$settings['foto_x'] or $size1[1]>$settings['foto_y']) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size1[0] ."x". $size1[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size1[0]<$size1[1]) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
			// Foto 0 Kb
			if ($parts_images1size<0 and $parts_images1size>$settings['foto_size']) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
		}


		if (!empty($parts_images2)) {
			if (strlen($parts_images2) > 100) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_064'] ."</div>\n"; }
			// проверяем расширение файла
			$ext2 = strtolower(substr($parts_images2, 1 + strrpos($parts_images2, ".")));
			if (!in_array($ext2, $valid_types)) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_065'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka2 = substr_count($parts_images2, ".");
			if ($findtchka2>1) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_066'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$parts_images2))  { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_067'] ."</div>\n"; }
			if (preg_match("/\.html/i",$parts_images2)) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_068'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$parts_images2))  { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_069'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize2 = round($parts_images2size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax2 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize2>$fotomax2) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_070'] ."<br />". $locale['error_057'] ." ". $fotoksize2 ." Kb<br />". $locale['error_058'] ." ". $fotomax2 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size2 = getimagesize($parts_images2tmp);
			if ($size2[0]>$settings['foto_x'] or $size2[1]>$settings['foto_y']) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_071'] ."<br />". $locale['error_060'] ." ". $size2[0] ."x". $size2[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size2[0]<$size2[1]) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_072'] ."</div>\n"; }
			// Foto 0 Kb
			if ($parts_images2size<"0" and $parts_images2size>$settings['foto_size']) { $error_parts_images2 = 1; $error .= "<div class='error'>". $locale['error_073'] ."</div>\n"; }
		}


		if (!empty($parts_images3)) {
			if (strlen($parts_images3) > 100) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_074'] ."</div>\n"; }
			// проверяем расширение файла
			$ext3 = strtolower(substr($parts_images3, 1 + strrpos($parts_images3, ".")));
			if (!in_array($ext3, $valid_types)) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_075'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka3=substr_count($parts_images3, ".");
			if ($findtchka3>1) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_076'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$parts_images3))  { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_077'] ."</div>\n"; }
			if (preg_match("/\.html/i",$parts_images3)) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_078'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$parts_images3))  { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_079'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize3=round($parts_images3size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax3=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize3>$fotomax3) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_080'] ."<br />". $locale['error_057'] ." ". $fotoksize3 ." Kb<br />". $locale['error_058'] ." ". $fotomax3 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size3=getimagesize($parts_images3tmp);
			if ($size3[0]>$settings['foto_x'] or $size3[1]>$settings['foto_y']) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_081'] ."<br />". $locale['error_060'] ." ". $size3[0] ."x". $size3[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size3[0]<$size3[1]) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_082'] ."</div>\n"; }
			// Foto 0 Kb
			if   ($parts_images3size<"0" and $parts_images3size>$settings['foto_size']) { $error_parts_images3 = 1; $error .= "<div class='error'>". $locale['error_083'] ."</div>\n"; }
		}


		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);

			if (!empty($parts_images1)) {
				$parts_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
				$parts_images1namerl = "rl". $parts_images1name;
				$parts_images1namesm = "sm". $parts_images1name;
				copy($parts_images1tmp, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name);
				img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name);
			}

			if (!empty($parts_images2)) {
				$parts_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
				$parts_images2namerl = "rl". $parts_images2name;
				$parts_images2namesm = "sm". $parts_images2name;
				copy($parts_images2tmp, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name);
				img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name);
			}

			if (!empty($parts_images3)) {
				$parts_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
				$parts_images3namerl = "rl". $parts_images3name;
				$parts_images3namesm = "sm". $parts_images3name;
				copy($parts_images3tmp, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name);
				img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name);
			}



			### INSERT PARTS BEGIN
			$parts_imgocher = $parts_images1name;
			if ($parts_tel=="+994") { $parts_tel=""; }
			
			$result = dbquery(
				"INSERT INTO ". DB_PARTS ." (
												parts_category_id,
												parts_name,
												parts_qiymeti,
												parts_valyuta,
												parts_shop_id,
												parts_adi,
												parts_mobiltel,
												parts_tel,
												parts_email,
												parts_images1,
												parts_images2,
												parts_images3,
												parts_imgocher,
												parts_elaveinfo,
												parts_ip,
												parts_today,
												parts_views,
												parts_aktiv,
												parts_vip
				) VALUES (
												'". $parts_category_id ."',
												'". $parts_name ."',
												'". $parts_qiymeti ."',
												'". $parts_valyuta ."',
												'". $parts_shop_id ."',
												'". $parts_adi ."',
												'". $parts_mobiltel ."',
												'". $parts_tel ."',
												'". $parts_email ."',
												'". $parts_images1name ."',
												'". $parts_images2name ."',
												'". $parts_images3name ."',
												'". $parts_imgocher ."',
												'". $parts_elaveinfo ."',
												'". $parts_ip ."',
												'". $parts_today ."',
												'". $parts_views ."',
												'". $parts_aktiv ."',
												'". $parts_vip ."'
				)"
			);
			// $parts_id = mysql_insert_id();
			$parts_id = _DB::$linkes->insert_id;
			### INSERT PARTS END


			### INSERT SEOURL BEGIN
			$seourl_url = "part". $parts_id .".php";
			$viewcompanent = viewcompanent("part", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = $parts_id;

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
			$viewcompanent = viewcompanent("part", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $parts_id;
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
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_010'] ."</b></td><td>". date("d.m.Y H:i:s", $parts_today) ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_011'] ."</b></td><td>". $parts_id ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_012'] ."</b></td><td>". $parts_name ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_013'] ."</b></td><td>". $partss_adi ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_014'] ."</b></td><td>". $parts_mobiltel ."</td>\n</tr>\n";
				if (!empty($parts_tel))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_015'] ."</b></td><td>". $parts_tel ."</td>\n</tr>\n"; }
				if (!empty($parts_email))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_016'] ."</b></td><td>". $parts_email ."</td>\n</tr>\n"; }
				if (!empty($parts_elaveinfo)){ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_017'] ."</b></td><td>". $parts_elaveinfo ."</td>\n</tr>\n"; }
				$allmsg .= "<tr>\n<td colspan='2'> </td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>---</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['sitename'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteurl'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteemail'] ."</td>\n</tr>\n";
				$allmsg .= "</table>\n";

				// Отправляем письмо майлеру
				mail($settings['siteemail'], $parts_adi ." ". $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END


			$result_alter = dbquery("ALTER TABLE `". DB_PARTS ."` ORDER BY `parts_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

			echo "<div class='success'>". $locale['success_001'] ."<b>". $parts_id ."</b></div>\n";

			// gormek
			$gormek = 1;
			// gormek


			unset($parts_category_id);
			unset($parts_name);
			unset($parts_qiymeti);
			unset($parts_valyuta);
			unset($parts_shop_id);
			unset($parts_adi);
			unset($parts_mobiltel);
			unset($parts_tel);
			unset($parts_images1);
			unset($parts_images2);
			unset($parts_images3);
			unset($parts_elaveinfo);
			unset($parts_ip);
			unset($parts_today);
			unset($parts_views);
			unset($parts_aktiv);
			unset($parts_vip);

		} // Yesli Error Yest
	} // Yesli POST

	if ($gormek!=1) {
?>




<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#parts_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#parts_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addparts" id="addparts" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
	<div class="addparts">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds parts_category_id">
				<label for="parts_category_id"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_parts_category_id==1 ? " error" : ""); ?>" name="parts_category_id" id="parts_category_id">
					<option value=""<?php echo ($parts_category_id=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
	<?php
		$result = dbquery("SELECT
									partcats_id,
									partcats_name
							FROM ". DB_PARTCATS ."
							ORDER BY `partcats_name`");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
	?>
					<option value="<?php echo $data['partcats_id']; ?>"<?php echo ($data['partcats_id']==$parts_category_id ? " selected" : ""); ?>><?php echo unserialize($data['partcats_name'])[LOCALESHORT]; ?></option>
	<?php
			} // db whille
		} // db query
	?>
				</select>
			</div>
			<div class="fileds parts_name">
				<label for="parts_name"><?php echo $locale['511']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_parts_name==1 ? " error" : ""); ?>" type="text" maxlength="255" name="parts_name" id="parts_name" value="<?php echo $parts_name; ?>" />
			</div>
			<div class="fileds parts_qiymeti">
				<label for="parts_qiymeti"><?php echo $locale['512']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_parts_qiymeti==1 ? " error" : ""); ?>" type="text" maxlength="10" name="parts_qiymeti" id="parts_qiymeti" value="<?php echo $parts_qiymeti; ?>" />
				<select class="select<?php echo ($error_parts_valyuta==1 ? " error" : ""); ?>" name="parts_valyuta" id="parts_valyuta">
					<option value="1"<?php echo ($parts_valyuta==1 ? " selected" : ""); ?>><?php echo $locale['valyuta_1']; ?></option>
					<option value="2"<?php echo ($parts_valyuta==2 ? " selected" : ""); ?>><?php echo $locale['valyuta_2']; ?></option>
					<option value="3"<?php echo ($parts_valyuta==3 ? " selected" : ""); ?>><?php echo $locale['valyuta_3']; ?></option>
				</select>
			</div>
			<div class="fileds parts_shop_id">
				<label for="parts_shop_id"><?php echo $locale['513']; ?></label>
				<select class="select<?php echo ($error_parts_shop_id==1 ? " error" : ""); ?>" name="parts_shop_id" id="parts_shop_id">
					<option value=""<?php echo ($parts_shop_id=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
		<?php
			$result = dbquery("SELECT
										shop_id,
										shop_name
								FROM ". DB_SHOPS ."
								WHERE shop_aktiv='1'
								ORDER BY `shop_name`");
			if (dbrows($result)) {
				while ($data = dbarray($result)) {
		?>
					<option value="<?php echo $data['shop_id']; ?>"<?php echo ($data['shop_id']==$parts_shop_id ? " selected" : ""); ?>><?php echo $data['shop_name']; ?></option>
		<?php
				} // db whille
			} // db query
		?>
				</select> 
			</div>
			<div class="fileds parts_adi">
				<label for="parts_adi"><?php echo $locale['514']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_parts_adi==1 ? " error" : ""); ?>" type="text" maxlength="100" name="parts_adi" id="parts_adi" value="<?php echo $parts_adi; ?>" />
			</div>
			<div class="fileds parts_mobiltel">
				<label for="parts_mobiltel"><?php echo $locale['515']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_parts_mobiltel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="parts_mobiltel" id="parts_mobiltel" value="<?php echo $parts_mobiltel; ?>" />
			</div>
			<div class="fileds parts_tel">
				<label for="parts_tel"><?php echo $locale['516']; ?></label>
				<input class="textbox<?php echo ($error_parts_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="parts_tel" id="parts_tel" value="<?php echo $parts_tel; ?>" />
			</div>
			<div class="fileds parts_email">
				<label for="parts_email"><?php echo $locale['517']; ?></label>
				<input class="textbox<?php echo ($error_parts_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="parts_email" id="parts_email" value="<?php echo $parts_email; ?>" />
				<?php echo $locale['518']; ?>
			</div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds parts_images">
				<label for="parts_images1"><?php echo $locale['550']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_parts_images1==1 ? " error" : ""); ?>" type="file" name="parts_images1" id="parts_images1" accept="image/*" />
				<label for="parts_images2"><?php echo $locale['551']; ?></label>
				<input class="textbox<?php echo ($error_parts_images2==1 ? " error" : ""); ?>" type="file" name="parts_images2" id="parts_images2" accept="image/*" />
				<label for="parts_images3"><?php echo $locale['552']; ?></label>
				<input class="textbox<?php echo ($error_parts_images3==1 ? " error" : ""); ?>" type="file" name="parts_images3" id="parts_images3" accept="image/*" />
			</div>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="hr"></div>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds parts_elaveinfo">
				<textarea class="textbox<?php echo ($error_parts_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="parts_elaveinfo" id="parts_elaveinfo"><?php echo $parts_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
			<div class="fileds parts_submit">
				<a href="#" onclick="document.getElementById('qayda').style.display='block'; return false"><?php echo $locale['591']; ?></a>
				<input class="checkbox" type="checkbox" value="rules" name="parts_rules" id="#parts_rules" onclick="this.form.parts_submit.disabled=!this.form.parts_rules.checked" />
				<input disabled class="button" value="<?php echo $locale['590']; ?>" type="submit" name="parts_submit" id="parts_submit" onclick="return(check())" />
			</div>
			<div class="fileds parts_qayda" id="qayda" style="display:none;">
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