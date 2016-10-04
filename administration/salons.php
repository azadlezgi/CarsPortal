<?php

require_once "../includes/maincore.php";

if (!checkrights("SALON") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }


require_once THEMES."templates/admin_header.php";

session_start();

include LOCALE.LOCALESET."admin/salons.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);


	if ($_GET['action']=="edit") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."salons.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $locale['642'] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
	} else if ($_GET['action']=="add") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."salons.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
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

	$viewcompanent = viewcompanent("salon", "name");
	$components_id = $viewcompanent['components_id'];

	$result = dbquery("SELECT * FROM ". DB_SALONS ." WHERE salon_id='". (INT)$_GET['id'] ."'");

	if (dbrows($result)) {
		$data = dbarray($result);

		### UPDATE CARS BEGIN
		$resultcars = dbquery(
			"UPDATE ". DB_CARS ." SET
											cars_salon_id=''
			WHERE cars_salon_id='". $data['salon_id'] ."'"
		);
		### UPDATE CARS END

		if (is_file(IMAGES . $settings['salons_foto_dir'] ."/rl". $data['salon_images1'])) { unlink (IMAGES . $settings['salons_foto_dir'] ."/rl". $data['salon_images1']); }
		if (is_file(IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images1'])) { unlink (IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images1']); }

		if (is_file(IMAGES . $settings['salons_foto_dir'] ."/rl". $data['salon_images2'])) { unlink (IMAGES . $settings['salons_foto_dir'] ."/rl". $data['salon_images2']); }
		if (is_file(IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images2'])) { unlink (IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images2']); }

		if (is_file(IMAGES . $settings['salons_foto_dir'] ."/rl". $data['salon_images3'])) { unlink (IMAGES . $settings['salons_foto_dir'] ."/rl". $data['salon_images3']); }
		if (is_file(IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images3'])) { unlink (IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images3']); }

		$result = dbquery("DELETE FROM ". DB_SALONS ." WHERE salon_id='". $data['salon_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $components_id ."' AND seourl_filedid='". $data['salon_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SROK ." WHERE srok_post_type='". $components_id ."' AND srok_post_id='". $data['salon_id'] ."'");

	}

	redirect(ADMIN ."salons.php". $aidlink ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {

	if ($_POST['salon_submit']) {

		$salon_id = (INT)$_GET['id'];
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

		$salon_imgocher  = trim(stripinput(censorwords(substr($_POST['salon_imgocher'],0,100))));

		$salon_images1var  = trim(stripinput(censorwords(substr($_POST['salon_images1var'],0,100))));
		$salon_images2var  = trim(stripinput(censorwords(substr($_POST['salon_images2var'],0,100))));
		$salon_images3var  = trim(stripinput(censorwords(substr($_POST['salon_images3var'],0,100))));

		$salon_images1sil  = trim(stripinput(censorwords(substr($_POST['salon_images1sil'],0,1))));
		$salon_images2sil  = trim(stripinput(censorwords(substr($_POST['salon_images2sil'],0,1))));
		$salon_images3sil  = trim(stripinput(censorwords(substr($_POST['salon_images3sil'],0,1))));

		if (empty($salon_images1var)) {
			$salon_images1 = $_FILES['salon_images1']['name'];
			$salon_images1tmp = $_FILES['salon_images1']['tmp_name'];
			$salon_images1size = $_FILES['salon_images1']['size'];
			$salon_images1type = $_FILES['salon_images1']['type'];
		} else {
			$salon_images1 = $salon_images1var;
		}

		if (empty($salon_images2var)) {
			$salon_images2 =  $_FILES['salon_images2']['name'];
			$salon_images2tmp  = $_FILES['salon_images2']['tmp_name'];
			$salon_images2size = $_FILES['salon_images2']['size'];
			$salon_images2type = $_FILES['salon_images2']['type'];
		}
		 else {
			$salon_images2 = $salon_images2var;
		}

		if (empty($salon_images3var)) {
			$salon_images3 =  $_FILES['salon_images3']['name'];
			$salon_images3tmp  = $_FILES['salon_images3']['tmp_name'];
			$salon_images3size = $_FILES['salon_images3']['size'];
			$salon_images3type = $_FILES['salon_images3']['type'];
		} else {
			$salon_images3 = $salon_images3var;
		}

		$salon_elaveinfo = trim(censorwords(substr($_POST['salon_elaveinfo'],0,10000)));
		$salon_ip = FUSION_IP;
		$salon_today = FUSION_TODAY;
		$salon_views = 0;

		if ($_POST['salon_submit']==$locale['593']) {
			$salon_aktiv = 1;
		} else {
			$salon_aktiv = trim(stripinput(censorwords(substr($_POST['salon_aktiv'],0,1))));
		}
		$salon_vip = trim(stripinput(censorwords(substr($_POST['salon_vip'],0,1))));

		$sms_send = trim(stripinput(censorwords(substr((INT)$_POST['sms_send'],0,1))));
		$mail_send = trim(stripinput(censorwords(substr((INT)$_POST['mail_send'],0,1))));

		$car_srok_date = trim(stripinput(censorwords(substr($_POST['car_srok_date'],0,15))));

		if ($_GET['action']=="edit") {
			$viewcompanent = viewcompanent("salon", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $salon_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$salon_srok = $data_srok['srok_date']+$car_srok_date;;
			} // Yesli result_srok DB query yest
		} else {
			$salon_srok = (FUSION_TODAY+$settings['qalmavaxti'])+$car_srok_date;
		}

	} else if ($_GET['action']=="edit") {

		$result = dbquery("SELECT * FROM ". DB_SALONS ." WHERE salon_id='". (INT)$_GET['id'] ."'");

		if (dbrows($result)) {
			$data = dbarray($result);

			$salon_id = $data['salon_id'];
			$salon_name = $data['salon_name'];
			$salon_qorod = $data['salon_qorod'];
			$salon_adress = $data['salon_adress'];
			$salon_mobiltel = $data['salon_mobiltel'];
			$salon_tel = $data['salon_tel'];
			$salon_email = $data['salon_email'];
			$salon_site = $data['salon_site'];
			$salon_images1 = $data['salon_images1'];
			$salon_images2 = $data['salon_images2'];
			$salon_images3 = $data['salon_images3'];
			$salon_imgocher = $data['salon_imgocher'];
			$salon_elaveinfo = $data['salon_elaveinfo'];
			$salon_ip = $data['salon_ip'];
			$salon_today = $data['salon_today'];
			$salon_views = $data['salon_views'];
			$salon_aktiv = $data['salon_aktiv'];
			$salon_vip = $data['salon_vip'];

			if ($salon_aktiv==2) {
				$mail_send = 1;
				$sms_send = 1;
			} else {
				$mail_send = 0;
				$sms_send = 0;
			}

			$viewcompanent = viewcompanent("salon", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $salon_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$salon_srok = $data_srok['srok_date'];
			} // Yesli result_srok DB query yest

		} // Yesli DB query yest

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
		$salon_ip = FUSION_IP;
		$salon_today = FUSION_TODAY;
		$salon_views = 0;
		$salon_aktiv = 2;
		$salon_vip = 0;

		$mail_send = 1;
		$sms_send = 1;

		$salon_srok = FUSION_TODAY+$settings['qalmavaxti'];

	}

	if ($_POST['salon_submit']) {

		if (empty($salon_name)) { $error_salon_name = 1; $error .= "<div class='error'>". $locale['error_001'] ."</div>\n"; }
		if (empty($salon_qorod)) { $error_salon_qorod = 1; $error .= "<div class='error'>". $locale['error_002'] ."</div>\n"; }
		if (empty($salon_adress)) { $error_salon_adress = 1; $error .= "<div class='error'>". $locale['error_003'] ."</div>\n"; }
		if (empty($salon_mobiltel)) { $error_salon_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (strlen($salon_mobiltel) < 13) { $error_salon_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (!empty($salon_mobiltel) && !preg_match("/^([0-9])+$/is", $salon_mobiltel)) { $error_salon_mobiltel = 1; $error .= "<div class='error'>". $locale['error_005'] ."</div>\n"; }
		// if (empty($salon_tel)) { $error_salon_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (strlen($salon_tel) < 13) { $error_salon_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (!empty($salon_tel) && !preg_match("/^([0-9])+$/is", $salon_tel)) { $error_salon_tel = 1; $error .= "<div class='error'>". $locale['error_007'] ."</div>\n"; }
		if (!empty($salon_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $salon_email)) { $error_salon_email = 1; $error .= "<div class='error'>". $locale['error_008'] ."</div>\n"; }
		if (!empty($salon_site) && !eregi("^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$", $salon_site)) { $error_salon_site = 1; $error .= "<div class='error'>". $locale['error_009'] ."</div>\n"; }


		if (empty($salon_images1var)) {

			if (empty($salon_images1)) { $error_salon_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

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
		}

		if (empty($salon_images2var)) {
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
		}

		if (empty($salon_images3var)) {
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
		}

		//if (empty($salon_imgocher)) { $error_salon_imgocher = 1; $error .= "<div class='error'>". $locale['error_115'] ."</div>\n"; }


		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);


			if (empty($salon_images1var)) {
				if (!empty($salon_images1)) {
					$salon_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
					$salon_images1namerl = "rl". $salon_images1name;
					$salon_images1namesm = "sm". $salon_images1name;
					copy($salon_images1tmp, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name);
					img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['salons_foto_dir'] ."/". $salon_images1name);

					if (empty($salon_imgocher)) { $salon_imgocher = $salon_images1name; }
				}
			} else if ($salon_images1sil==1) {
				if (is_file(IMAGES . $settings['salons_foto_dir'] ."/rl". $salon_images1var)) { unlink (IMAGES . $settings['salons_foto_dir'] ."/rl". $salon_images1var); }
				if (is_file(IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images1var)) { unlink (IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images1var); }
				if ($salon_imgocher==$salon_images1var) { $salon_imgocher = ""; }
				$salon_images1name = "";
			} else {
				$salon_images1name = $salon_images1var;
			}

			if (empty($salon_images2var)) {
				if (!empty($salon_images2)) {
					$salon_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
					$salon_images2namerl = "rl". $salon_images2name;
					$salon_images2namesm = "sm". $salon_images2name;
					copy($salon_images2tmp, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name);
					img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['salons_foto_dir'] ."/". $salon_images2name);

					if (empty($salon_imgocher)) { $salon_imgocher = $salon_images2name; }
				}
			} else if ($salon_images2sil==1) {
				if (is_file(IMAGES . $settings['salons_foto_dir'] ."/rl". $salon_images2var)) { unlink (IMAGES . $settings['salons_foto_dir'] ."/rl". $salon_images2var); }
				if (is_file(IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images2var)) { unlink (IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images2var); }
				if ($salon_imgocher==$salon_images2var) { $salon_imgocher = $salon_images1name; }
				$salon_images2name = "";
			} else {
				$salon_images2name = $salon_images2var;
			}

			if (empty($salon_images3var)) {
				if (!empty($salon_images3)) {
					$salon_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
					$salon_images3namerl = "rl". $salon_images3name;
					$salon_images3namesm = "sm". $salon_images3name;
					copy($salon_images3tmp, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name);
					img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name, IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['salons_foto_dir'] ."/". $salon_images3name);

					if (empty($salon_imgocher)) { $salon_imgocher = $salon_images3name; }
				}
			} else if ($salon_images3sil==1) {
				if (is_file(IMAGES . $settings['salons_foto_dir'] ."/rl". $salon_images3var)) { unlink (IMAGES . $settings['salons_foto_dir'] ."/rl". $salon_images3var); }
				if (is_file(IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images3var)) { unlink (IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images3var); }
				if ($salon_imgocher==$salon_images3var) { $salon_imgocher = $salon_images1name; }
				$salon_images3name = "";
			} else {
				$salon_images3name = $salon_images3var;
			}


		if ($_GET['action']=="edit") {

			### UPDATE salon BEGIN
			if ($salon_tel=="+994") { $salon_tel=""; }

			$result = dbquery(
				"UPDATE ". DB_SALONS ." SET
												salon_name='". $salon_name ."',
												salon_qorod='". $salon_qorod ."',
												salon_adress='". $salon_adress ."',
												salon_mobiltel='". $salon_mobiltel ."',
												salon_tel='". $salon_tel ."',
												salon_email='". $salon_email ."',
												salon_site='". $salon_site ."',
												salon_images1='". $salon_images1name ."',
												salon_images2='". $salon_images2name ."',
												salon_images3='". $salon_images3name ."',
												salon_imgocher='". $salon_imgocher ."',
												salon_elaveinfo='". $salon_elaveinfo ."',
												salon_aktiv='". $salon_aktiv ."',
												salon_vip='". $salon_vip ."'
				WHERE salon_id='". $salon_id ."'"
			);
			### UPDATE salon END


			### UPDATE SROK BEGIN
			$viewcompanent = viewcompanent("salon", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $salon_id;
			$srok_date = $salon_srok;

			$result = dbquery(
				"UPDATE ". DB_SROK ." SET
												srok_date='". $srok_date ."'
				WHERE srok_post_id='". $srok_post_id ."' AND srok_post_type='". $srok_post_type ."'"
			);
			### UPDATE SROK END


		} else if ($_GET['action']=="add") {

			### INSERT salon BEGIN
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
			$salon_id = mysql_insert_id();
			### INSERT salon END


			### INSERT SEOURL BEGIN
			$seourl_url = "salon". $salon_id .".php";
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
			$srok_date = $salon_srok;

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
			if (($settings['sendsms']==1) && ($sms_send==1) && ($salon_aktiv==1) && (!empty($salon_mobiltel))) {

				include INCLUDES .'smsapi/config.php';
				include INCLUDES .'smsapi/Addressbook.php';
				include INCLUDES .'smsapi/Exceptions.php';
				include INCLUDES .'smsapi/Account.php';
				include INCLUDES .'smsapi/Stat.php';


				$sender = substr($settings['sitename'], 0, 11);
				$text = sprintf($locale['sms_001'], $salon_id);
				$phone = $salon_mobiltel;
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
			if (($settings['sendmail']==1) && ($mail_send==1) && ($salon_aktiv==1) && (!empty($salon_email))) {

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "". $locale['mail_010'] ." <b>". $salon_id ."</b><br />\n";
				$allmsg .= "". $locale['mail_011'] ."<br />\n";
				$allmsg .= "<a href='". $settings['siteurl'] ."salon". $salon_id .".php' target='_blank'>". $settings['siteurl'] ."salon". $salon_id .".php</a><br /><br />\n";
				$allmsg .= "". $locale['mail_012'] ."<br />\n";
				$allmsg .= "". $settings['sitename'] ."<br />\n";
				$allmsg .= "". $settings['siteurl'] ."<br />\n";
				$allmsg .= "". $settings['siteemail'] ."<br />\n";

				// Отправляем письмо майлеру
				mail($salon_email, $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END

			
			$result_alter = dbquery("ALTER TABLE `". DB_SALONS ."` ORDER BY `salon_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];


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

			unset($salon_srok);

			if ($_GET['action']=="edit") {
				redirect(ADMIN ."salons.php". $aidlink ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} else if ($_GET['action']=="add") {
				redirect(ADMIN ."salons.php". $aidlink ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} // Edit ili Add redirect

		} // Yesli Error Yest
	} // Yesli POST

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
			<?php if (($settings['sendsms']==1) && ($salon_aktiv==2)) { ?>
			<div class="fileds sms_send">
				<label for="sms_send" style="color:green;"><?php echo $locale['586']; ?></label>
				<input class="checkbox<?php echo ($error_sms_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="sms_send" id="sms_send"<?php echo ($sms_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="fileds salon_tel">
				<label for="salon_tel"><?php echo $locale['514']; ?></label>
				<input class="textbox<?php echo ($error_salon_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="salon_tel" id="salon_tel" value="<?php echo $salon_tel; ?>" />
			</div>
			<div class="fileds salon_email">
				<label for="salon_email"><?php echo $locale['515']; ?></label>
				<input class="textbox<?php echo ($error_salon_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="salon_email" id="salon_email" value="<?php echo $salon_email; ?>" />
			</div>
			<?php if (($settings['sendmail']==1) && ($salon_aktiv==2)) { ?>
			<div class="fileds mail_send">
				<label for="mail_send" style="color:green;"><?php echo $locale['587']; ?></label>
				<input class="checkbox<?php echo ($error_mail_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="mail_send" id="mail_send"<?php echo ($mail_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
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
				<?php if (empty($salon_images1)) { ?>
				<input class="textbox<?php echo ($error_salon_images1==1 ? " error" : ""); ?>" type="file" name="salon_images1" id="salon_images1" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto1">
					<input type="hidden" name="salon_images1var" id="salon_images1var" value="<?php echo $salon_images1; ?>">
					<img src="<?php echo IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images1; ?>" alt="<?php echo $locale['520']; ?>">
					<label class="radio" for="salon_imgocher1"><input class="radio" type="radio" name="salon_imgocher" id="salon_imgocher1"<?php echo ($salon_images1==$salon_imgocher ? " checked" : ""); ?> value="<?php echo $salon_images1; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="salon_images1sil"><input class="checkbox" value="1" type="checkbox" name="salon_images1sil" id="salon_images1sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="salon_images2"><?php echo $locale['521']; ?></label>
				<?php if (empty($salon_images2)) { ?>
				<input class="textbox<?php echo ($error_salon_images2==1 ? " error" : ""); ?>" type="file" name="salon_images2" id="salon_images2" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto2">
					<input type="hidden" name="salon_images2var" id="salon_images2var" value="<?php echo $salon_images2; ?>">
					<img src="<?php echo IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images2; ?>" alt="<?php echo $locale['521']; ?>">
					<label class="radio" for="salon_imgocher2"><input class="radio" type="radio" name="salon_imgocher" id="salon_imgocher2"<?php echo ($salon_images2==$salon_imgocher ? " checked" : ""); ?> value="<?php echo $salon_images2; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="salon_images2sil"><input class="checkbox" value="1" type="checkbox" name="salon_images2sil" id="salon_images2sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="salon_images3"><?php echo $locale['522']; ?></label>
				<?php if (empty($salon_images3)) { ?>
				<input class="textbox<?php echo ($error_salon_images3==1 ? " error" : ""); ?>" type="file" name="salon_images3" id="salon_images3" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto3">
					<input type="hidden" name="salon_images3var" id="salon_images3var" value="<?php echo $salon_images3; ?>">
					<img src="<?php echo IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_images3; ?>" alt="<?php echo $locale['522']; ?>">
					<label class="radio" for="salon_imgocher3"><input class="radio" type="radio" name="salon_imgocher" id="salon_imgocher3"<?php echo ($salon_images3==$salon_imgocher ? " checked" : ""); ?> value="<?php echo $salon_images3; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="salon_images3sil"><input class="checkbox" value="1" type="checkbox" name="salon_images3sil" id="salon_images3sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>

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
		</div>

		<div class="bloks blok1">
			<div class="fileds salon_ip">
				<label for="salon_ip"><?php echo $locale['700']; ?></label>
				<input readonly class="textbox" type="text" name="salon_ip" id="salon_ip" value="<?php echo $salon_ip; ?>" />
			</div>
			<div class="fileds salon_today">
				<label for="salon_today"><?php echo $locale['701']; ?></label>
				<input readonly class="textbox" type="text" name="salon_today" id="salon_today" value="<?php echo date("d.m.Y", $salon_today); ?>" />
			</div>
			<div class="fileds salon_srok">
				<label for="salon_srok"><?php echo $locale['702']; ?></label>
				<input readonly class="textbox" type="text" name="salon_srok" id="salon_srok" value="<?php echo date("d.m.Y", $salon_srok); ?>" />
			</div>
			<div class="fileds salon_views">
				<label for="salon_views"><?php echo $locale['703']; ?></label>
				<input readonly class="textbox" type="text" name="salon_views" id="salon_views" value="<?php echo $salon_views; ?>" />
			</div>
		</div>

		<div class="bloks blok2">
			<div class="fileds salon_vip">
				<label for="salon_vip"><?php echo $locale['704']; ?></label>
				<select class="select" name="salon_vip" id="salon_vip">
					<option value="0"<?php echo ($salon_vip==0 ? " selected" : ""); ?>><?php echo $locale['vip_0']; ?></option>
					<option value="1"<?php echo ($salon_vip==1 ? " selected" : ""); ?>><?php echo $locale['vip_1']; ?></option>
					<option value="2"<?php echo ($salon_vip==2 ? " selected" : ""); ?>><?php echo $locale['vip_2']; ?></option>
					<option value="3"<?php echo ($salon_vip==3 ? " selected" : ""); ?>><?php echo $locale['vip_3']; ?></option>
					<option value="4"<?php echo ($salon_vip==4 ? " selected" : ""); ?>><?php echo $locale['vip_4']; ?></option>
					<option value="5"<?php echo ($salon_vip==5 ? " selected" : ""); ?>><?php echo $locale['vip_5']; ?></option>
					<option value="6"<?php echo ($salon_vip==6 ? " selected" : ""); ?>><?php echo $locale['vip_6']; ?></option>
				</select>
			</div>
			<div class="fileds salon_aktiv">
				<label for="salon_aktiv"><?php echo $locale['705']; ?></label>
				<select class="select" name="salon_aktiv" id="salon_aktiv">
					<option value="0"<?php echo ($salon_aktiv==2 ? " selected" : ""); ?>><?php echo $locale['status_0']; ?></option>
					<option value="1"<?php echo ($salon_aktiv==1 ? " selected" : ""); ?>><?php echo $locale['status_1']; ?></option>
					<option value="4"<?php echo ($salon_aktiv==4 ? " selected" : ""); ?>><?php echo $locale['status_4']; ?></option>
				</select>
			</div>
			<div class="fileds car_srok_date">
				<label for="car_srok_date"><?php echo $locale['706']; ?></label>
				<select class="select" name="car_srok_date" id="car_srok_date">
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
			<div class="fileds salon_submit">
				<?php if (($_GET['action']=="edit") && ($salon_aktiv==2)) { ?>
					<input class="button" value="<?php echo $locale['593']; ?>" type="submit" name="salon_submit" id="salon_submit" onclick="return(check())" />
				<?php } else { ?>
					<input class="button" value="<?php echo ($_GET['action']=="edit" ? $locale['592'] : $locale['590']); ?>" type="submit" name="salon_submit" id="salon_submit" onclick="return(check())" />
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
	var ckeditor = CKEDITOR.replace('salon_elaveinfo');
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

		$viewcompanent = viewcompanent("salon", "name");
		$seourl_component = $viewcompanent['components_id'];

		if ((isset($_GET['order'])) && (isset($_GET['by']))) {
			$order = $_GET['order'];
			$by = $_GET['by'];
		} else {
			$order = "salon_id";
			$by = "DESC";
		}

		$result = dbquery("SELECT
									salon_id,
									salon_name,
									salon_imgocher,
									salon_today,
									salon_aktiv,
									salon_vip,
									seourl_url
							FROM ". DB_SALONS ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=salon_id AND seourl_component=". $seourl_component ."
							ORDER BY `". $order ."` ". $by ."
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		echo "<div class='addcar'><a href='". ADMIN ."salons.php".  $aidlink ."&action=add'>". $locale['711'] ."</a></div>\n";
		echo "<table class='salonslist'>\n";
		echo "		<thead>\n";
		echo "				<tr>\n";
		echo "						<td class='salon_id'><a href='". ADMIN ."salons.php".  $aidlink ."&order=salon_id&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['650'] . ($order=="salon_id" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='salon_images'>". $locale['651'] ."</td>\n";
		echo "						<td class='salon_marka'><a href='". ADMIN ."salons.php".  $aidlink ."&order=salon_name&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['652'] . ($order=="salon_name" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='salon_vip'><a href='". ADMIN ."salons.php".  $aidlink ."&order=salon_vip&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['653'] . ($order=="salon_vip" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='salon_aktiv'><a href='". ADMIN ."salons.php".  $aidlink ."&order=salon_aktiv&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['654'] . ($order=="salon_aktiv" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='salon_today'><a href='". ADMIN ."salons.php".  $aidlink ."&order=salon_today&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['655'] . ($order=="salon_today" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='salon_href'>". $locale['656'] ."</td>\n";
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
		echo "						<td class='salon_id'>#". $data['salon_id'] ."</td>\n";
		echo "						<td class='salon_images'><a href='". ADMIN ."salons.php".  $aidlink ."&action=edit&id=". $data['salon_id'] ."'><img src='". (empty($data['salon_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_imgocher']) ."' alt=''></a></td>\n";
		echo "						<td class='salon_name'><a href='". ADMIN ."salons.php".  $aidlink ."&action=edit&id=". $data['salon_id'] ."'>". $data['salon_name'] ."</a></td>\n";
		echo "						<td class='salon_vip'><img src='". IMAGES ."vip_icons/". ($data['salon_vip']==0 ? "vip_off.png" : "vip_on.png") ."' alt='". $locale['vip_'. $data['salon_vip']] ."' title='". $locale['vip_'. $data['salon_vip']] ."'></td>\n";
		echo "						<td class='salon_aktiv'><img src='". IMAGES . "status/status_". $data['salon_aktiv'] .".png' alt='". $locale['status_'. $data['salon_aktiv']] ."' title='". $locale['status_'. $data['salon_aktiv']] ."'></td>\n";
		echo "						<td class='salon_today'>". date("d.m.Y", $data['salon_today']) ."</td>\n";
		echo "						<td class='salon_href'>\n";
		echo "							<a class='view' href='". BASEDIR . $data['seourl_url'] ."' target='_blank' title='". $locale['660'] ."'><img src='". IMAGES ."view.png' alt='". $locale['660'] ."'></a>\n";
		echo "							<a class='edit' href='". ADMIN ."salons.php".  $aidlink ."&action=edit&id=". $data['salon_id'] ."' title='". $locale['661'] ."'><img src='". IMAGES ."edit.png' alt='". $locale['661'] ."'></a>\n";
		echo "							<a class='delete' href='". ADMIN ."salons.php".  $aidlink ."&action=delete&id=". $data['salon_id'] ."' title='". $locale['662'] ."' onclick='return DeleteOk();'><img src='". IMAGES ."delete.png' alt='". $locale['662'] ."'></a>\n";
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
		echo "						<td class='salon_id'>&nbsp;</td>\n";
		echo "						<td class='salon_images'>&nbsp;</td>\n";
		echo "						<td class='salon_name'>&nbsp;</td>\n";
		echo "						<td class='salon_vip'>&nbsp;</td>\n";
		echo "						<td class='salon_aktiv'>&nbsp;</td>\n";
		echo "						<td class='salon_today'>&nbsp;</td>\n";
		echo "						<td class='salon_href'>&nbsp;</td>\n";
		echo "				</tr>\n";
		echo "		</tfoot>\n";
		echo "	</table>\n";


		echo navigation($_GET['page'], $settings['goradmin'], "salon_id", DB_SALONS, "");
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