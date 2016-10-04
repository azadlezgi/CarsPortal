<?php

require_once "../includes/maincore.php";

if (!checkrights("PARTS") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }


require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/parts.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);


	if ($_GET['action']=="edit") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."parts.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $locale['642'] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
	} else if ($_GET['action']=="add") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."parts.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $locale['643'] ."</span></li>\n";
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

	$viewcompanent = viewcompanent("part", "name");
	$components_id = $viewcompanent['components_id'];

	$result = dbquery("SELECT * FROM ". DB_PARTS ." WHERE parts_id='". (INT)$_GET['id'] ."'");

	if (dbrows($result)) {
		$data = dbarray($result);

		if (is_file(IMAGES . $settings['parts_foto_dir'] ."/rl". $data['parts_images1'])) { unlink (IMAGES . $settings['parts_foto_dir'] ."/rl". $data['parts_images1']); }
		if (is_file(IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images1'])) { unlink (IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images1']); }

		if (is_file(IMAGES . $settings['parts_foto_dir'] ."/rl". $data['parts_images2'])) { unlink (IMAGES . $settings['parts_foto_dir'] ."/rl". $data['parts_images2']); }
		if (is_file(IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images2'])) { unlink (IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images2']); }

		if (is_file(IMAGES . $settings['parts_foto_dir'] ."/rl". $data['parts_images3'])) { unlink (IMAGES . $settings['parts_foto_dir'] ."/rl". $data['parts_images3']); }
		if (is_file(IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images3'])) { unlink (IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images3']); }

		$result = dbquery("DELETE FROM ". DB_PARTS ." WHERE parts_id='". $data['parts_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $components_id ."' AND seourl_filedid='". $data['parts_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SROK ." WHERE srok_post_type='". $components_id ."' AND srok_post_id='". $data['parts_id'] ."'");

	}

	redirect(ADMIN ."parts.php". $aidlink ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {


	if ($_POST['parts_submit']) {

		$parts_id = (INT)$_GET['id'];
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

		$parts_imgocher  = trim(stripinput(censorwords(substr($_POST['parts_imgocher'],0,100))));

		$parts_images1var  = trim(stripinput(censorwords(substr($_POST['parts_images1var'],0,100))));
		$parts_images2var  = trim(stripinput(censorwords(substr($_POST['parts_images2var'],0,100))));
		$parts_images3var  = trim(stripinput(censorwords(substr($_POST['parts_images3var'],0,100))));

		$parts_images1sil  = trim(stripinput(censorwords(substr($_POST['parts_images1sil'],0,1))));
		$parts_images2sil  = trim(stripinput(censorwords(substr($_POST['parts_images2sil'],0,1))));
		$parts_images3sil  = trim(stripinput(censorwords(substr($_POST['parts_images3sil'],0,1))));

		if (empty($parts_images1var)) {
			$parts_images1 = $_FILES['parts_images1']['name'];
			$parts_images1tmp = $_FILES['parts_images1']['tmp_name'];
			$parts_images1size = $_FILES['parts_images1']['size'];
			$parts_images1type = $_FILES['parts_images1']['type'];
		} else {
			$parts_images1 = $parts_images1var;
		}

		if (empty($parts_images2var)) {
			$parts_images2 =  $_FILES['parts_images2']['name'];
			$parts_images2tmp  = $_FILES['parts_images2']['tmp_name'];
			$parts_images2size = $_FILES['parts_images2']['size'];
			$parts_images2type = $_FILES['parts_images2']['type'];
		}
		 else {
			$parts_images2 = $parts_images2var;
		}

		if (empty($parts_images3var)) {
			$parts_images3 =  $_FILES['parts_images3']['name'];
			$parts_images3tmp  = $_FILES['parts_images3']['tmp_name'];
			$parts_images3size = $_FILES['parts_images3']['size'];
			$parts_images3type = $_FILES['parts_images3']['type'];
		} else {
			$parts_images3 = $parts_images3var;
		}

		$parts_elaveinfo = trim(censorwords(substr($_POST['parts_elaveinfo'],0,10000)));
		$parts_ip = FUSION_IP;
		$parts_today = FUSION_TODAY;
		$parts_views = 0;


		if ($_POST['parts_submit']==$locale['593']) {
			$parts_aktiv = 1;
		} else {
			$parts_aktiv = trim(stripinput(censorwords(substr($_POST['parts_aktiv'],0,1))));
		}

		$parts_vip = trim(stripinput(censorwords(substr($_POST['parts_vip'],0,1))));

		$sms_send = trim(stripinput(censorwords(substr((INT)$_POST['sms_send'],0,1))));
		$mail_send = trim(stripinput(censorwords(substr((INT)$_POST['mail_send'],0,1))));


		$part_srok_date = trim(stripinput(censorwords(substr($_POST['part_srok_date'],0,15))));

		if ($_GET['action']=="edit") {

			$viewcompanent = viewcompanent("part", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $parts_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$parts_srok = $data_srok['srok_date']+$part_srok_date;;
			} // Yesli result_srok DB query yest
		} else {
			$parts_srok = (FUSION_TODAY+$settings['qalmavaxti'])+$part_srok_date;
		}

	} else if ($_GET['action']=="edit") {

		$result = dbquery("SELECT * FROM ". DB_PARTS ." WHERE parts_id='". (INT)$_GET['id'] ."'");

		if (dbrows($result)) {
			$data = dbarray($result);

			$parts_id = $data['parts_id'];
			$parts_category_id = $data['parts_category_id'];
			$parts_name = $data['parts_name'];
			$parts_qiymeti = $data['parts_qiymeti'];
			$parts_valyuta = $data['parts_valyuta'];
			$parts_shop_id = $data['parts_shop_id'];
			$parts_adi = $data['parts_adi'];
			$parts_mobiltel = $data['parts_mobiltel'];
			$parts_tel = $data['parts_tel'];
			$parts_email = $data['parts_email'];

			$parts_images1 = $data['parts_images1'];
			$parts_images2 = $data['parts_images2'];
			$parts_images3 = $data['parts_images3'];
			$parts_imgocher = $data['parts_imgocher'];

			$parts_elaveinfo = $data['parts_elaveinfo'];
			$parts_ip = $data['parts_ip'];
			$parts_today = $data['parts_today'];
			$parts_views = $data['parts_views'];
			$parts_aktiv = $data['parts_aktiv'];
			$parts_vip = $data['parts_vip'];

			if ($parts_aktiv==2) {
				$mail_send = 1;
				$sms_send = 1;
			} else {
				$mail_send = 0;
				$sms_send = 0;
			}

			$viewcompanent = viewcompanent("part", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $parts_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$parts_srok = $data_srok['srok_date'];
			} // Yesli result_srok DB query yest

		} // Yesli DB query yest

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
		$parts_ip = FUSION_IP;
		$parts_today = FUSION_TODAY;
		$parts_views = 1;
		$parts_aktiv = 2;
		$parts_vip = 0;

		$mail_send = 1;
		$sms_send = 1;

		$parts_srok = FUSION_TODAY+$settings['qalmavaxti'];

	}

	if ($_POST['parts_submit']) {

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
		// if (strlen($parts_tel) < 13) { $error_parts_tel = 1; $error .= "<div class='error'>". $locale['error_018'] ."</div>\n"; }
		// if (!empty($parts_tel) && !preg_match("/^([0-9])+$/is", $parts_tel)) { $error_parts_tel = 1; $error .= "<div class='error'>". $locale['error_019'] ."</div>\n"; }
		if (!empty($parts_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $parts_email)) { $error_parts_email = 1; $error .= "<div class='error'>". $locale['error_020'] ."</div>\n"; }



		if (empty($parts_images1var)) {

			if (empty($parts_images1)) { $error_parts_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

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
		}

		if (empty($parts_images2var)) {
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
		}

		if (empty($parts_images3var)) {
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
		}


		//if (empty($parts_imgocher)) { $error_parts_imgocher = 1; $error .= "<div class='error'>". $locale['error_115'] ."</div>\n"; }

		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);


			if (empty($parts_images1var)) {
				if (!empty($parts_images1)) {
					$parts_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
					$parts_images1namerl = "rl". $parts_images1name;
					$parts_images1namesm = "sm". $parts_images1name;
					copy($parts_images1tmp, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name);
					img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['parts_foto_dir'] ."/". $parts_images1name);

					if (empty($parts_imgocher)) { $parts_imgocher = $parts_images1name; }
				}
			} else if ($parts_images1sil==1) {
				if (is_file(IMAGES . $settings['parts_foto_dir'] ."/rl". $parts_images1var)) { unlink (IMAGES . $settings['parts_foto_dir'] ."/rl". $parts_images1var); }
				if (is_file(IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images1var)) { unlink (IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images1var); }
				if ($parts_imgocher==$parts_images1var) { $parts_imgocher = ""; }
				$parts_images1name = "";
			} else {
				$parts_images1name = $parts_images1var;
			}

			if (empty($parts_images2var)) {
				if (!empty($parts_images2)) {
					$parts_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
					$parts_images2namerl = "rl". $parts_images2name;
					$parts_images2namesm = "sm". $parts_images2name;
					copy($parts_images2tmp, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name);
					img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['parts_foto_dir'] ."/". $parts_images2name);

					if (empty($parts_imgocher)) { $parts_imgocher = $parts_images2name; }
				}
			} else if ($parts_images2sil==1) {
				if (is_file(IMAGES . $settings['parts_foto_dir'] ."/rl". $parts_images2var)) { unlink (IMAGES . $settings['parts_foto_dir'] ."/rl". $parts_images2var); }
				if (is_file(IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images2var)) { unlink (IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images2var); }
				if ($parts_imgocher==$parts_images2var) { $parts_imgocher = $parts_images1name; }
				$parts_images2name = "";
			} else {
				$parts_images2name = $parts_images2var;
			}

			if (empty($parts_images3var)) {
				if (!empty($parts_images3)) {
					$parts_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
					$parts_images3namerl = "rl". $parts_images3name;
					$parts_images3namesm = "sm". $parts_images3name;
					copy($parts_images3tmp, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name);
					img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name, IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['parts_foto_dir'] ."/". $parts_images3name);

					if (empty($parts_imgocher)) { $parts_imgocher = $parts_images3name; }
				}
			} else if ($parts_images3sil==1) {
				if (is_file(IMAGES . $settings['parts_foto_dir'] ."/rl". $parts_images3var)) { unlink (IMAGES . $settings['parts_foto_dir'] ."/rl". $parts_images3var); }
				if (is_file(IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images3var)) { unlink (IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images3var); }
				if ($parts_imgocher==$parts_images3var) { $parts_imgocher = $parts_images1name; }
				$parts_images3name = "";
			} else {
				$parts_images3name = $parts_images3var;
			}



		if ($_GET['action']=="edit") {

			### UPDATE parts BEGIN
			if ($parts_tel=="+994") { $parts_tel=""; }

			$result = dbquery(
				"UPDATE ". DB_PARTS ." SET
												parts_category_id='". $parts_category_id ."',
												parts_name='". $parts_name ."',
												parts_qiymeti='". $parts_qiymeti ."',
												parts_valyuta='". $parts_valyuta ."',
												parts_shop_id='". $parts_shop_id ."',
												parts_adi='". $parts_adi ."',
												parts_mobiltel='". $parts_mobiltel ."',
												parts_tel='". $parts_tel ."',
												parts_email='". $parts_email ."',
												parts_images1='". $parts_images1name ."',
												parts_images2='". $parts_images2name ."',
												parts_images3='". $parts_images3name ."',
												parts_imgocher='". $parts_imgocher ."',
												parts_elaveinfo='". $parts_elaveinfo ."',
												parts_aktiv='". $parts_aktiv ."',
												parts_vip='". $parts_vip ."'
				WHERE parts_id='". $parts_id ."'"
			);
			### UPDATE parts END


			### UPDATE SROK BEGIN
			$viewcompanent = viewcompanent("part", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $parts_id;
			$srok_date = $parts_srok;

			$result = dbquery(
				"UPDATE ". DB_SROK ." SET
												srok_date='". $srok_date ."'
				WHERE srok_post_id='". $srok_post_id ."' AND srok_post_type='". $srok_post_type ."'"
			);
			### UPDATE SROK END


		} else if ($_GET['action']=="add") {

			### INSERT parts BEGIN
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
			$parts_id = mysql_insert_id();
			### INSERT parts END


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
			$srok_date = $parts_srok;

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


		} // Edit ili Add




			### SEND SMS BEGIN
			if (($settings['sendsms']==1) && ($sms_send==1) && ($parts_aktiv==1) && (!empty($parts_mobiltel))) {

				include INCLUDES .'smsapi/config.php';
				include INCLUDES .'smsapi/Addressbook.php';
				include INCLUDES .'smsapi/Exceptions.php';
				include INCLUDES .'smsapi/Account.php';
				include INCLUDES .'smsapi/Stat.php';


				$sender = substr($settings['sitename'], 0, 11);
				$text = sprintf($locale['sms_001'], $parts_id);
				$phone = $parts_mobiltel;
				$datetime = "";
				$sms_lifetime = "0";


				$Gateway=new APISMS($sms_key_private, $sms_key_public, 'http://atompark.com/api/sms/');
				$Addressbook=new Addressbook($Gateway);
				$Exceptions=new Exceptions($Gateway);
				$Account=new Account($Gateway);
				$Stat = new Stat ($Gateway);

				//Проверяем баланс счета
				$res=$Account->getUserBalance('USD');
				$balancesms = $res["result"]["balance_currency"]; 

				if($balancesms < 1) {
					$headerssms=null;
					$headerssms.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
					$headerssms.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
					$headerssms.="X-Mailer: PHP/".phpversion()."\r\n";

					$allmsgsms = sprintf($locale['sms_003'], $balancesms);
					//echo $allmsgsms;

					mail($settings['siteemail'], $locale['sms_002'], $allmsgsms, $headerssms);
				} // Yesli balance < 1

				$res=$Stat->sendSMS($sender, $text, $phone, $datetime, $sms_lifetime);
				if (isset($res["result"]["error"])) {
					// echo "Ошибка: ". $res["result"]["code"] ."";
				} else {
					// echo "Сообщение поставлено в очередь id: {$res["result"]["id"]}, price: {$res["result"]["price"]} {$res["result"]["currency"]}";
				}

			} // Yesli sendsms 1
			### SEND SMS END


			### SEND MAIL BEGIN
			if (($settings['sendmail']==1) && ($mail_send==1) && ($parts_aktiv==1) && (!empty($parts_email))) {

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "". $locale['mail_010'] ." <b>". $parts_id ."</b><br />\n";
				$allmsg .= "". $locale['mail_011'] ."<br />\n";
				$allmsg .= "<a href='". $settings['siteurl'] ."part". $parts_id .".php' target='_blank'>". $settings['siteurl'] ."part". $parts_id .".php</a><br /><br />\n";
				$allmsg .= "". $locale['mail_012'] ."<br />\n";
				$allmsg .= "". $settings['sitename'] ."<br />\n";
				$allmsg .= "". $settings['siteurl'] ."<br />\n";
				$allmsg .= "". $settings['siteemail'] ."<br />\n";

				// Отправляем письмо майлеру
				mail($parts_email, $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END


			$result_alter = dbquery("ALTER TABLE `". DB_PARTS ."` ORDER BY `parts_id` DESC");
			

			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];



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

			unset($parts_srok);


			if ($_GET['action']=="edit") {
				redirect(ADMIN ."parts.php". $aidlink ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} else if ($_GET['action']=="add") {
				redirect(ADMIN ."parts.php". $aidlink ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} // Edit ili Add redirect


		} // Yesli Error Yest
	} // Yesli POST

?>


<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#parts_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#parts_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addpart" id="addpart" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
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
			<?php if (($settings['sendsms']==1) && ($parts_aktiv==2)) { ?>
			<div class="fileds sms_send">
				<label for="sms_send" style="color:green;"><?php echo $locale['519']; ?></label>
				<input class="checkbox<?php echo ($error_sms_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="sms_send" id="sms_send"<?php echo ($sms_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="fileds parts_tel">
				<label for="parts_tel"><?php echo $locale['516']; ?></label>
				<input class="textbox<?php echo ($error_parts_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="parts_tel" id="parts_tel" value="<?php echo $parts_tel; ?>" />
			</div>
			<div class="fileds parts_email">
				<label for="parts_email"><?php echo $locale['517']; ?></label>
				<input class="textbox<?php echo ($error_parts_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="parts_email" id="parts_email" value="<?php echo $parts_email; ?>" />
				<?php echo $locale['518']; ?>
			</div>
			<?php if (($settings['sendmail']==1) && ($parts_aktiv==2)) { ?>
			<div class="fileds mail_send">
				<label for="mail_send" style="color:green;"><?php echo $locale['520']; ?></label>
				<input class="checkbox<?php echo ($error_mail_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="mail_send" id="mail_send"<?php echo ($mail_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds parts_images">

				<label for="parts_images1"><?php echo $locale['550']; ?><?php echo UL; ?></label>
				<?php if (empty($parts_images1)) { ?>
				<input class="textbox<?php echo ($error_parts_images1==1 ? " error" : ""); ?>" type="file" name="parts_images1" id="parts_images1" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto1">
					<input type="hidden" name="parts_images1var" id="parts_images1var" value="<?php echo $parts_images1; ?>">
					<img src="<?php echo IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images1; ?>" alt="<?php echo $locale['550']; ?>">
					<label class="radio" for="parts_imgocher1"><input class="radio" type="radio" name="parts_imgocher" id="parts_imgocher1"<?php echo ($parts_images1==$parts_imgocher ? " checked" : ""); ?> value="<?php echo $parts_images1; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="parts_images1sil"><input class="checkbox" value="1" type="checkbox" name="parts_images1sil" id="parts_images1sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="parts_images2"><?php echo $locale['551']; ?></label>
				<?php if (empty($parts_images2)) { ?>
				<input class="textbox<?php echo ($error_parts_images2==1 ? " error" : ""); ?>" type="file" name="parts_images2" id="parts_images2" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto2">
					<input type="hidden" name="parts_images2var" id="parts_images2var" value="<?php echo $parts_images2; ?>">
					<img src="<?php echo IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images2; ?>" alt="<?php echo $locale['551']; ?>">
					<label class="radio" for="parts_imgocher2"><input class="radio" type="radio" name="parts_imgocher" id="parts_imgocher2"<?php echo ($parts_images2==$parts_imgocher ? " checked" : ""); ?> value="<?php echo $parts_images2; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="parts_images2sil"><input class="checkbox" value="1" type="checkbox" name="parts_images2sil" id="parts_images2sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="parts_images3"><?php echo $locale['552']; ?></label>
				<?php if (empty($parts_images3)) { ?>
				<input class="textbox<?php echo ($error_parts_images3==1 ? " error" : ""); ?>" type="file" name="parts_images3" id="parts_images3">
				<?php } else { ?>
				<div class="fotos foto3" accept="image/*" />
					<input type="hidden" name="parts_images3var" id="parts_images3var" value="<?php echo $parts_images3; ?>">
					<img src="<?php echo IMAGES . $settings['parts_foto_dir'] ."/sm". $parts_images3; ?>" alt="<?php echo $locale['552']; ?>">
					<label class="radio" for="parts_imgocher3"><input class="radio" type="radio" name="parts_imgocher" id="parts_imgocher3"<?php echo ($parts_images3==$parts_imgocher ? " checked" : ""); ?> value="<?php echo $parts_images3; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="parts_images3sil"><input class="checkbox" value="1" type="checkbox" name="parts_images3sil" id="parts_images3sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>

			</div>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds parts_elaveinfo">
				<textarea class="textbox<?php echo ($error_parts_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="parts_elaveinfo" id="parts_elaveinfo"><?php echo $parts_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
		</div>

		<div class="bloks blok1">
			<div class="fileds parts_ip">
				<label for="parts_ip"><?php echo $locale['700']; ?></label>
				<input readonly class="textbox" type="text" name="parts_ip" id="parts_ip" value="<?php echo $parts_ip; ?>" />
			</div>
			<div class="fileds parts_today">
				<label for="parts_today"><?php echo $locale['701']; ?></label>
				<input readonly class="textbox" type="text" name="parts_today" id="parts_today" value="<?php echo date("d.m.Y", $parts_today); ?>" />
			</div>
			<div class="fileds parts_srok">
				<label for="parts_srok"><?php echo $locale['702']; ?></label>
				<input readonly class="textbox" type="text" name="parts_srok" id="parts_srok" value="<?php echo date("d.m.Y", $parts_srok); ?>" />
			</div>
			<div class="fileds parts_views">
				<label for="parts_views"><?php echo $locale['703']; ?></label>
				<input readonly class="textbox" type="text" name="parts_views" id="parts_views" value="<?php echo $parts_views; ?>" />
			</div>
		</div>

		<div class="bloks blok2">
			<div class="fileds parts_vip">
				<label for="parts_vip"><?php echo $locale['704']; ?></label>
				<select class="select" name="parts_vip" id="parts_vip">
					<option value="0"<?php echo ($parts_vip==0 ? " selected" : ""); ?>><?php echo $locale['vip_0']; ?></option>
					<option value="1"<?php echo ($parts_vip==1 ? " selected" : ""); ?>><?php echo $locale['vip_1']; ?></option>
					<option value="2"<?php echo ($parts_vip==2 ? " selected" : ""); ?>><?php echo $locale['vip_2']; ?></option>
					<option value="3"<?php echo ($parts_vip==3 ? " selected" : ""); ?>><?php echo $locale['vip_3']; ?></option>
					<option value="4"<?php echo ($parts_vip==4 ? " selected" : ""); ?>><?php echo $locale['vip_4']; ?></option>
					<option value="5"<?php echo ($parts_vip==5 ? " selected" : ""); ?>><?php echo $locale['vip_5']; ?></option>
					<option value="6"<?php echo ($parts_vip==6 ? " selected" : ""); ?>><?php echo $locale['vip_6']; ?></option>
				</select>
			</div>
			<div class="fileds parts_aktiv">
				<label for="parts_aktiv"><?php echo $locale['705']; ?></label>
				<select class="select" name="parts_aktiv" id="parts_aktiv">
					<option value="0"<?php echo ($parts_aktiv==2 ? " selected" : ""); ?>><?php echo $locale['status_0']; ?></option>
					<option value="1"<?php echo ($parts_aktiv==1 ? " selected" : ""); ?>><?php echo $locale['status_1']; ?></option>
					<option value="4"<?php echo ($parts_aktiv==4 ? " selected" : ""); ?>><?php echo $locale['status_4']; ?></option>
				</select>
			</div>
			<div class="fileds paer_srok_date">
				<label for="part_srok_date"><?php echo $locale['706']; ?></label>
				<select class="select" name="part_srok_date" id="part_srok_date">
					<option value="-62208000"><?php echo $locale['davam_-62208000']; ?></option>	
					<option value="-31104000"><?php echo $locale['davam_-31104000']; ?></option>	
					<option value="-15552000"><?php echo $locale['davam_-15552000']; ?></option>
					<option value="-12960000"><?php echo $locale['davam_-12960000']; ?></option>
					<option value="-10368000"><?php echo $locale['davam_-10368000']; ?></option>
					<option value="-7776000"><?php echo $locale['davam_-7776000']; ?></option>
					<option value="-5184000"><?php echo $locale['davam_-5184000']; ?></option>
					<option value="-2592000"><?php echo $locale['davam_-2592000']; ?></option>
					<option value="0" selected><?php echo $locale['vip_0']; ?></option>
					<option value="2592000"><?php echo $locale['davam_2592000']; ?></option>
					<option value="5184000"><?php echo $locale['davam_5184000']; ?></option>
					<option value="7776000"><?php echo $locale['davam_7776000']; ?></option>
					<option value="10368000"><?php echo $locale['davam_10368000']; ?></option>
					<option value="12960000"><?php echo $locale['davam_12960000']; ?></option>
					<option value="15552000"><?php echo $locale['davam_15552000']; ?></option>
					<option value="31104000"><?php echo $locale['davam_31104000']; ?></option>
					<option value="62208000"><?php echo $locale['davam_62208000']; ?></option>
				</select>
			</div>
		</div>
		<div class="clear-both"></div>

		<div class="bloks blok3">
			<div class="hr"></div>
			<div class="fileds parts_submit">
				<?php if (($_GET['action']=="edit") && ($parts_aktiv==2)) { ?>
					<input class="button" value="<?php echo $locale['593']; ?>" type="submit" name="parts_submit" id="parts_submit" onclick="return(check())" />
				<?php } else { ?>
					<input class="button" value="<?php echo ($_GET['action']=="edit" ? $locale['592'] : $locale['590']); ?>" type="submit" name="parts_submit" id="parts_submit" onclick="return(check())" />
				<?php } ?>
			</div>
		</div>
	</div>
</form>



<?php
	if ($settings['tinymce_enabled']) { 
		$_SESSION['tinymce_sess'] = 1;
?>
<script type="text/javascript">
	<!--
	var ckeditor = CKEDITOR.replace('parts_elaveinfo');
	CKFinder.setupCKEditor( ckeditor, '<?php echo INCLUDES; ?>jscripts/ckeditor/ckfinder/' );
	//-->
</script>
<?php } // Yesli Text Editor CKEDITOR ?>


<?php
} else {

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


		if (isset($_GET['page'])) {
			$say = $_GET['page'];
		} else {
			$say = 1;
		}
		$rowstart = $settings['goradmin']*($say-1);

		$viewcompanent = viewcompanent("part", "name");
		$seourl_component = $viewcompanent['components_id'];

		if ((isset($_GET['order'])) && (isset($_GET['by']))) {
			$order = $_GET['order'];
			$by = $_GET['by'];
		} else {
			$order = "parts_id";
			$by = "DESC";
		}

		$result = dbquery("SELECT
									parts_id,
									parts_name,
									parts_imgocher,
									parts_today,
									parts_aktiv,
									parts_vip,
									seourl_url
							FROM ". DB_PARTS ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=parts_id AND seourl_component=". $seourl_component ."
							ORDER BY `". $order ."` ". $by ."
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		echo "<div class='addcar'><a href='". ADMIN ."parts.php".  $aidlink ."&action=add'>". $locale['711'] ."</a></div>\n";
		echo "<table class='partslist'>\n";
		echo "		<thead>\n";
		echo "				<tr>\n";
		echo "						<td class='parts_id'><a href='". ADMIN ."parts.php".  $aidlink ."&order=parts_id&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['650'] . ($order=="parts_id" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='parts_images'>". $locale['651'] ."</td>\n";
		echo "						<td class='parts_name'><a href='". ADMIN ."parts.php".  $aidlink ."&order=parts_name&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['652'] . ($order=="parts_name" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='parts_vip'><a href='". ADMIN ."parts.php".  $aidlink ."&order=parts_vip&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['653'] . ($order=="parts_vip" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='parts_aktiv'><a href='". ADMIN ."parts.php".  $aidlink ."&order=parts_aktiv&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['654'] . ($order=="parts_aktiv" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='parts_today'><a href='". ADMIN ."parts.php".  $aidlink ."&order=parts_today&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['655'] . ($order=="parts_today" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='parts_href'>". $locale['656'] ."</td>\n";
		echo "				</tr>\n";
		echo "		</thead>\n";
		echo "		<tbody>\n";

		if (dbrows($result)) {
			while ($data = dbarray($result)) {

				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
				// echo "<hr>";

		echo "				<tr>\n";
		echo "						<td class='parts_id'>#". $data['parts_id'] ."</td>\n";
		echo "						<td class='parts_images'><a href='". ADMIN ."parts.php".  $aidlink ."&action=edit&id=". $data['parts_id'] ."'><img src='". (empty($data['parts_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_imgocher']) ."' alt=''></a></td>\n";
		echo "						<td class='parts_name'><a href='". ADMIN ."parts.php".  $aidlink ."&action=edit&id=". $data['parts_id'] ."'>". $data['parts_name'] ."</a></td>\n";
		echo "						<td class='parts_vip'><img src='". IMAGES ."vip_icons/". ($data['parts_vip']==0 ? "vip_off.png" : "vip_on.png") ."' alt='". $locale['vip_'. $data['parts_vip']] ."' title='". $locale['vip_'. $data['parts_vip']] ."'></td>\n";
		echo "						<td class='parts_aktiv'><img src='". IMAGES . "status/status_". $data['parts_aktiv'] .".png' alt='". $locale['status_'. $data['parts_aktiv']] ."' title='". $locale['status_'. $data['parts_aktiv']] ."'></td>\n";
		echo "						<td class='parts_today'>". date("d.m.Y", $data['parts_today']) ."</td>\n";
		echo "						<td class='parts_href'>\n";
		echo "							<a class='view' href='". BASEDIR . $data['seourl_url'] ."' target='_blank' title='". $locale['660'] ."'><img src='". IMAGES ."view.png' alt='". $locale['660'] ."'></a>\n";
		echo "							<a class='edit' href='". ADMIN ."parts.php".  $aidlink ."&action=edit&id=". $data['parts_id'] ."' title='". $locale['661'] ."'><img src='". IMAGES ."edit.png' alt='". $locale['661'] ."'></a>\n";
		echo "							<a class='delete' href='". ADMIN ."parts.php".  $aidlink ."&action=delete&id=". $data['parts_id'] ."' title='". $locale['662'] ."' onclick='return DeleteOk();'><img src='". IMAGES ."delete.png' alt='". $locale['662'] ."'></a>\n";
		echo "						</td>\n";
		echo "				</tr>\n";

			} // db whille
		} else {

		echo "				<tr>\n";
		echo "						<td colspan='8'>". $locale['710'] ."</td>\n";
		echo "				</tr>\n";

		} // db query

		echo "		</tbody>\n";
		echo "		<tfoot>\n";
		echo "				<tr>\n";
		echo "						<td class='parts_id'>&nbsp;</td>\n";
		echo "						<td class='parts_images'>&nbsp;</td>\n";
		echo "						<td class='parts_name'>&nbsp;</td>\n";
		echo "						<td class='parts_vip'>&nbsp;</td>\n";
		echo "						<td class='parts_aktiv'>&nbsp;</td>\n";
		echo "						<td class='parts_today'>&nbsp;</td>\n";
		echo "						<td class='parts_href'>&nbsp;</td>\n";
		echo "				</tr>\n";
		echo "		</tfoot>\n";
		echo "	</table>\n";


		echo navigation($_GET['page'], $settings['goradmin'], "parts_id", DB_PARTS, "");
?>

		<script type='text/javascript'>
			<!--
			function DeleteOk() {
				return confirm('<?php echo $locale['712']; ?>');
			}
			//-->
		</script>

<?php
} // Yesli Edit Add ili Delete

	closetable();
	
require_once THEMES."templates/footer.php";
?>