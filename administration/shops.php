<?php

require_once "../includes/maincore.php";

if (!checkrights("SHOP") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }


require_once THEMES."templates/admin_header.php";

session_start();

include LOCALE.LOCALESET."admin/shops.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);


	if ($_GET['action']=="edit") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."shops.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $locale['642'] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
	} else if ($_GET['action']=="add") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."shops.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
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

	$viewcompanent = viewcompanent("shop", "name");
	$components_id = $viewcompanent['components_id'];

	$result = dbquery("SELECT * FROM ". DB_SHOPS ." WHERE shop_id='". (INT)$_GET['id'] ."'");

	if (dbrows($result)) {
		$data = dbarray($result);

		if (is_file(IMAGES . $settings['shops_foto_dir'] ."/rl". $data['shop_images1'])) { unlink (IMAGES . $settings['shops_foto_dir'] ."/rl". $data['shop_images1']); }
		if (is_file(IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images1'])) { unlink (IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images1']); }

		if (is_file(IMAGES . $settings['shops_foto_dir'] ."/rl". $data['shop_images2'])) { unlink (IMAGES . $settings['shops_foto_dir'] ."/rl". $data['shop_images2']); }
		if (is_file(IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images2'])) { unlink (IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images2']); }

		if (is_file(IMAGES . $settings['shops_foto_dir'] ."/rl". $data['shop_images3'])) { unlink (IMAGES . $settings['shops_foto_dir'] ."/rl". $data['shop_images3']); }
		if (is_file(IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images3'])) { unlink (IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images3']); }

		$result = dbquery("DELETE FROM ". DB_SHOPS ." WHERE shop_id='". $data['shop_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $components_id ."' AND seourl_filedid='". $data['shop_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SROK ." WHERE srok_post_type='". $components_id ."' AND srok_post_id='". $data['shop_id'] ."'");

	}

	redirect(ADMIN ."shops.php". $aidlink ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {

	if ($_POST['shop_submit']) {

		$shop_id = (INT)$_GET['id'];
		$shop_name = trim(stripinput(censorwords(substr($_POST['shop_name'],0,255))));
		$shop_qorod = trim(stripinput(censorwords(substr($_POST['shop_qorod'],0,10))));
		$shop_adress = trim(stripinput(censorwords(substr($_POST['shop_adress'],0,500))));
		$shop_mobiltel = trim(stripinput(censorwords(substr($_POST['shop_mobiltel'],0,100))));
		$shop_mobiltel = str_replace(" ", "", $shop_mobiltel);
		$shop_mobiltel = str_replace("(", "", $shop_mobiltel);
		$shop_mobiltel = str_replace(")", "", $shop_mobiltel);
		$shop_mobiltel = str_replace("-", "", $shop_mobiltel);
		$shop_mobiltel = str_replace("_", "", $shop_mobiltel);
		$shop_tel = trim(stripinput(censorwords(substr($_POST['shop_tel'],0,100))));
		$shop_tel = str_replace(" ", "", $shop_tel);
		$shop_tel = str_replace("(", "", $shop_tel);
		$shop_tel = str_replace(")", "", $shop_tel);
		$shop_tel = str_replace("-", "", $shop_tel);
		$shop_tel = str_replace("_", "", $shop_tel);
		$shop_email = trim(stripinput(censorwords(substr($_POST['shop_email'],0,100))));
		$shop_site = trim(stripinput(censorwords(substr($_POST['shop_site'],0,100))));
		$shop_site = str_replace("http://", "", $shop_site);
		$shop_site = explode("/", $shop_site);
		$shop_site = $shop_site[0];

		$shop_imgocher  = trim(stripinput(censorwords(substr($_POST['shop_imgocher'],0,100))));

		$shop_images1var  = trim(stripinput(censorwords(substr($_POST['shop_images1var'],0,100))));
		$shop_images2var  = trim(stripinput(censorwords(substr($_POST['shop_images2var'],0,100))));
		$shop_images3var  = trim(stripinput(censorwords(substr($_POST['shop_images3var'],0,100))));

		$shop_images1sil  = trim(stripinput(censorwords(substr($_POST['shop_images1sil'],0,1))));
		$shop_images2sil  = trim(stripinput(censorwords(substr($_POST['shop_images2sil'],0,1))));
		$shop_images3sil  = trim(stripinput(censorwords(substr($_POST['shop_images3sil'],0,1))));

		if (empty($shop_images1var)) {
			$shop_images1 = $_FILES['shop_images1']['name'];
			$shop_images1tmp = $_FILES['shop_images1']['tmp_name'];
			$shop_images1size = $_FILES['shop_images1']['size'];
			$shop_images1type = $_FILES['shop_images1']['type'];
		} else {
			$shop_images1 = $shop_images1var;
		}

		if (empty($shop_images2var)) {
			$shop_images2 =  $_FILES['shop_images2']['name'];
			$shop_images2tmp  = $_FILES['shop_images2']['tmp_name'];
			$shop_images2size = $_FILES['shop_images2']['size'];
			$shop_images2type = $_FILES['shop_images2']['type'];
		}
		 else {
			$shop_images2 = $shop_images2var;
		}

		if (empty($shop_images3var)) {
			$shop_images3 =  $_FILES['shop_images3']['name'];
			$shop_images3tmp  = $_FILES['shop_images3']['tmp_name'];
			$shop_images3size = $_FILES['shop_images3']['size'];
			$shop_images3type = $_FILES['shop_images3']['type'];
		} else {
			$shop_images3 = $shop_images3var;
		}

		$shop_elaveinfo = trim(censorwords(substr($_POST['shop_elaveinfo'],0,10000)));
		$shop_ip = FUSION_IP;
		$shop_today = FUSION_TODAY;
		$shop_views = 0;

		if ($_POST['shop_submit']==$locale['593']) {
			$shop_aktiv = 1;
		} else {
			$shop_aktiv = trim(stripinput(censorwords(substr($_POST['shop_aktiv'],0,1))));
		}
		$shop_vip = trim(stripinput(censorwords(substr($_POST['shop_vip'],0,1))));

		$sms_send = trim(stripinput(censorwords(substr((INT)$_POST['sms_send'],0,1))));
		$mail_send = trim(stripinput(censorwords(substr((INT)$_POST['mail_send'],0,1))));

		$car_srok_date = trim(stripinput(censorwords(substr($_POST['car_srok_date'],0,15))));

		if ($_GET['action']=="edit") {
			$viewcompanent = viewcompanent("shop", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $shop_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$shop_srok = $data_srok['srok_date']+$car_srok_date;;
			} // Yesli result_srok DB query yest
		} else {
			$shop_srok = (FUSION_TODAY+$settings['qalmavaxti'])+$car_srok_date;
		}

	} else if ($_GET['action']=="edit") {

		$result = dbquery("SELECT * FROM ". DB_SHOPS ." WHERE shop_id='". (INT)$_GET['id'] ."'");

		if (dbrows($result)) {
			$data = dbarray($result);

			$shop_id = $data['shop_id'];
			$shop_name = $data['shop_name'];
			$shop_qorod = $data['shop_qorod'];
			$shop_adress = $data['shop_adress'];
			$shop_mobiltel = $data['shop_mobiltel'];
			$shop_tel = $data['shop_tel'];
			$shop_email = $data['shop_email'];
			$shop_site = $data['shop_site'];
			$shop_images1 = $data['shop_images1'];
			$shop_images2 = $data['shop_images2'];
			$shop_images3 = $data['shop_images3'];
			$shop_imgocher = $data['shop_imgocher'];
			$shop_elaveinfo = $data['shop_elaveinfo'];
			$shop_ip = $data['shop_ip'];
			$shop_today = $data['shop_today'];
			$shop_views = $data['shop_views'];
			$shop_aktiv = $data['shop_aktiv'];
			$shop_vip = $data['shop_vip'];

			if ($shop_aktiv==2) {
				$mail_send = 1;
				$sms_send = 1;
			} else {
				$mail_send = 0;
				$sms_send = 0;
			}

			$viewcompanent = viewcompanent("shop", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $shop_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$shop_srok = $data_srok['srok_date'];
			} // Yesli result_srok DB query yest

		} // Yesli DB query yest

	} else {

		$shop_name = "";
		$shop_qorod = "";
		$shop_adress = "";
		$shop_mobiltel = "+994";
		$shop_tel = "+994";
		$shop_email = "";
		$shop_site = "";
		$shop_images1 = "";
		$shop_images2 = "";
		$shop_images3 = "";
		$shop_elaveinfo = "";
		$shop_ip = FUSION_IP;
		$shop_today = FUSION_TODAY;
		$shop_views = 0;
		$shop_aktiv = 2;
		$shop_vip = 0;

		$mail_send = 1;
		$sms_send = 1;

		$shop_srok = FUSION_TODAY+$settings['qalmavaxti'];

	}

	if ($_POST['shop_submit']) {

		if (empty($shop_name)) { $error_shop_name = 1; $error .= "<div class='error'>". $locale['error_001'] ."</div>\n"; }
		if (empty($shop_qorod)) { $error_shop_qorod = 1; $error .= "<div class='error'>". $locale['error_002'] ."</div>\n"; }
		if (empty($shop_adress)) { $error_shop_adress = 1; $error .= "<div class='error'>". $locale['error_003'] ."</div>\n"; }
		if (empty($shop_mobiltel)) { $error_shop_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (strlen($shop_mobiltel) < 13) { $error_shop_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (!empty($shop_mobiltel) && !preg_match("/^([0-9])+$/is", $shop_mobiltel)) { $error_shop_mobiltel = 1; $error .= "<div class='error'>". $locale['error_005'] ."</div>\n"; }
		// if (empty($shop_tel)) { $error_shop_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (strlen($shop_tel) < 13) { $error_shop_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (!empty($shop_tel) && !preg_match("/^([0-9])+$/is", $shop_tel)) { $error_shop_tel = 1; $error .= "<div class='error'>". $locale['error_007'] ."</div>\n"; }
		if (!empty($shop_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $shop_email)) { $error_shop_email = 1; $error .= "<div class='error'>". $locale['error_008'] ."</div>\n"; }
		if (!empty($shop_site) && !eregi("^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$", $shop_site)) { $error_shop_site = 1; $error .= "<div class='error'>". $locale['error_009'] ."</div>\n"; }


		if (empty($shop_images1var)) {

			if (empty($shop_images1)) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

			if (!empty($shop_images1)) {
				if (strlen($shop_images1) > 100) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
				// проверяем расширение файла
				$ext1 = strtolower(substr($shop_images1, 1 + strrpos($shop_images1, ".")));
				if (!in_array($ext1, $valid_types)) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$findtchka1 = substr_count($shop_images1, ".");
				if ($findtchka1>1) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$shop_images1))  { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
				if (preg_match("/\.html/i",$shop_images1)) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$shop_images1))  { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
				// 5. Размер фото
				$fotoksize1 = round($shop_images1size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$fotomax1 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
				if ($fotoksize1>$fotomax1) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize1 ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$size1 = getimagesize($shop_images1tmp);
				if ($size1[0]>$settings['foto_x'] or $size1[1]>$settings['foto_y']) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size1[0] ."x". $size1[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
				//if ($size1[0]<$size1[1]) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
				// Foto 0 Kb
				if ($shop_images1size<0 and $shop_images1size>$settings['foto_size']) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
			}
		}

		if (empty($shop_images2var)) {
			if (!empty($shop_images2)) {
				if (strlen($shop_images2) > 100) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_064'] ."</div>\n"; }
				// проверяем расширение файла
				$ext2 = strtolower(substr($shop_images2, 1 + strrpos($shop_images2, ".")));
				if (!in_array($ext2, $valid_types)) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_065'] ."</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$findtchka2 = substr_count($shop_images2, ".");
				if ($findtchka2>1) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_066'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$shop_images2))  { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_067'] ."</div>\n"; }
				if (preg_match("/\.html/i",$shop_images2)) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_068'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$shop_images2))  { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_069'] ."</div>\n"; }
				// 5. Размер фото
				$fotoksize2 = round($shop_images2size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$fotomax2 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
				if ($fotoksize2>$fotomax2) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_070'] ."<br />". $locale['error_057'] ." ". $fotoksize2 ." Kb<br />". $locale['error_058'] ." ". $fotomax2 ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$size2 = getimagesize($shop_images2tmp);
				if ($size2[0]>$settings['foto_x'] or $size2[1]>$settings['foto_y']) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_071'] ."<br />". $locale['error_060'] ." ". $size2[0] ."x". $size2[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
				//if ($size2[0]<$size2[1]) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_072'] ."</div>\n"; }
				// Foto 0 Kb
				if ($shop_images2size<"0" and $shop_images2size>$settings['foto_size']) { $error_shop_images2 = 1; $error .= "<div class='error'>". $locale['error_073'] ."</div>\n"; }
			}
		}

		if (empty($shop_images3var)) {
			if (!empty($shop_images3)) {
				if (strlen($shop_images3) > 100) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_074'] ."</div>\n"; }
				// проверяем расширение файла
				$ext3 = strtolower(substr($shop_images3, 1 + strrpos($shop_images3, ".")));
				if (!in_array($ext3, $valid_types)) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_075'] ."</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$findtchka3=substr_count($shop_images3, ".");
				if ($findtchka3>1) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_076'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$shop_images3))  { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_077'] ."</div>\n"; }
				if (preg_match("/\.html/i",$shop_images3)) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_078'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$shop_images3))  { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_079'] ."</div>\n"; }
				// 5. Размер фото
				$fotoksize3=round($shop_images3size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$fotomax3=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
				if ($fotoksize3>$fotomax3) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_080'] ."<br />". $locale['error_057'] ." ". $fotoksize3 ." Kb<br />". $locale['error_058'] ." ". $fotomax3 ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$size3=getimagesize($shop_images3tmp);
				if ($size3[0]>$settings['foto_x'] or $size3[1]>$settings['foto_y']) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_081'] ."<br />". $locale['error_060'] ." ". $size3[0] ."x". $size3[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
				//if ($size3[0]<$size3[1]) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_082'] ."</div>\n"; }
				// Foto 0 Kb
				if   ($shop_images3size<"0" and $shop_images3size>$settings['foto_size']) { $error_shop_images3 = 1; $error .= "<div class='error'>". $locale['error_083'] ."</div>\n"; }
			}
		}

		//if (empty($shop_imgocher)) { $error_shop_imgocher = 1; $error .= "<div class='error'>". $locale['error_115'] ."</div>\n"; }


		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);


			if (empty($shop_images1var)) {
				if (!empty($shop_images1)) {
					$shop_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
					$shop_images1namerl = "rl". $shop_images1name;
					$shop_images1namesm = "sm". $shop_images1name;
					copy($shop_images1tmp, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name);
					img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name);

					if (empty($shop_imgocher)) { $shop_imgocher = $shop_images1name; }
				}
			} else if ($shop_images1sil==1) {
				if (is_file(IMAGES . $settings['shops_foto_dir'] ."/rl". $shop_images1var)) { unlink (IMAGES . $settings['shops_foto_dir'] ."/rl". $shop_images1var); }
				if (is_file(IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images1var)) { unlink (IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images1var); }
				if ($shop_imgocher==$shop_images1var) { $shop_imgocher = ""; }
				$shop_images1name = "";
			} else {
				$shop_images1name = $shop_images1var;
			}

			if (empty($shop_images2var)) {
				if (!empty($shop_images2)) {
					$shop_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
					$shop_images2namerl = "rl". $shop_images2name;
					$shop_images2namesm = "sm". $shop_images2name;
					copy($shop_images2tmp, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name);
					img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name);

					if (empty($shop_imgocher)) { $shop_imgocher = $shop_images2name; }
				}
			} else if ($shop_images2sil==1) {
				if (is_file(IMAGES . $settings['shops_foto_dir'] ."/rl". $shop_images2var)) { unlink (IMAGES . $settings['shops_foto_dir'] ."/rl". $shop_images2var); }
				if (is_file(IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images2var)) { unlink (IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images2var); }
				if ($shop_imgocher==$shop_images2var) { $shop_imgocher = $shop_images1name; }
				$shop_images2name = "";
			} else {
				$shop_images2name = $shop_images2var;
			}

			if (empty($shop_images3var)) {
				if (!empty($shop_images3)) {
					$shop_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
					$shop_images3namerl = "rl". $shop_images3name;
					$shop_images3namesm = "sm". $shop_images3name;
					copy($shop_images3tmp, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name);
					img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name);

					if (empty($shop_imgocher)) { $shop_imgocher = $shop_images3name; }
				}
			} else if ($shop_images3sil==1) {
				if (is_file(IMAGES . $settings['shops_foto_dir'] ."/rl". $shop_images3var)) { unlink (IMAGES . $settings['shops_foto_dir'] ."/rl". $shop_images3var); }
				if (is_file(IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images3var)) { unlink (IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images3var); }
				if ($shop_imgocher==$shop_images3var) { $shop_imgocher = $shop_images1name; }
				$shop_images3name = "";
			} else {
				$shop_images3name = $shop_images3var;
			}


		if ($_GET['action']=="edit") {

			### UPDATE shop BEGIN
			if ($shop_tel=="+994") { $shop_tel=""; }

			$result = dbquery(
				"UPDATE ". DB_SHOPS ." SET
												shop_name='". $shop_name ."',
												shop_qorod='". $shop_qorod ."',
												shop_adress='". $shop_adress ."',
												shop_mobiltel='". $shop_mobiltel ."',
												shop_tel='". $shop_tel ."',
												shop_email='". $shop_email ."',
												shop_site='". $shop_site ."',
												shop_images1='". $shop_images1name ."',
												shop_images2='". $shop_images2name ."',
												shop_images3='". $shop_images3name ."',
												shop_imgocher='". $shop_imgocher ."',
												shop_elaveinfo='". $shop_elaveinfo ."',
												shop_aktiv='". $shop_aktiv ."',
												shop_vip='". $shop_vip ."'
				WHERE shop_id='". $shop_id ."'"
			);
			### UPDATE shop END


			### UPDATE SROK BEGIN
			$viewcompanent = viewcompanent("shop", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $shop_id;
			$srok_date = $shop_srok;

			$result = dbquery(
				"UPDATE ". DB_SROK ." SET
												srok_date='". $srok_date ."'
				WHERE srok_post_id='". $srok_post_id ."' AND srok_post_type='". $srok_post_type ."'"
			);
			### UPDATE SROK END


		} else if ($_GET['action']=="add") {

			### INSERT shop BEGIN
			if ($shop_tel=="+994") { $shop_tel=""; }
			
			$result = dbquery(
				"INSERT INTO ". DB_SHOPS ." (
												shop_name,
												shop_qorod,
												shop_adress,
												shop_mobiltel,
												shop_tel,
												shop_email,
												shop_site,
												shop_images1,
												shop_images2,
												shop_images3,
												shop_imgocher,
												shop_elaveinfo,
												shop_ip,
												shop_today,
												shop_views,
												shop_aktiv,
												shop_vip
				) VALUES (
												'". $shop_name ."',
												'". $shop_qorod ."',
												'". $shop_adress ."',
												'". $shop_mobiltel ."',
												'". $shop_tel ."',
												'". $shop_email ."',
												'". $shop_site ."',
												'". $shop_images1name ."',
												'". $shop_images2name ."',
												'". $shop_images3name ."',
												'". $shop_imgocher ."',
												'". $shop_elaveinfo ."',
												'". $shop_ip ."',
												'". $shop_today ."',
												'". $shop_views ."',
												'". $shop_aktiv ."',
												'". $shop_vip ."'

				)"
			);
			$shop_id = mysql_insert_id();
			### INSERT shop END


			### INSERT SEOURL BEGIN
			$seourl_url = "shop". $shop_id .".php";
			$viewcompanent = viewcompanent("shop", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = $shop_id;

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
			$viewcompanent = viewcompanent("shop", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $shop_id;
			$srok_date = $shop_srok;

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
			if (($settings['sendsms']==1) && ($sms_send==1) && ($shop_aktiv==1) && (!empty($shop_mobiltel))) {

				include INCLUDES .'smsapi/config.php';
				include INCLUDES .'smsapi/Addressbook.php';
				include INCLUDES .'smsapi/Exceptions.php';
				include INCLUDES .'smsapi/Account.php';
				include INCLUDES .'smsapi/Stat.php';


				$sender = substr($settings['sitename'], 0, 11);
				$text = sprintf($locale['sms_001'], $shop_id);
				$phone = $shop_mobiltel;
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
			if (($settings['sendmail']==1) && ($mail_send==1) && ($shop_aktiv==1) && (!empty($shop_email))) {

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "". $locale['mail_010'] ." <b>". $shop_id ."</b><br />\n";
				$allmsg .= "". $locale['mail_011'] ."<br />\n";
				$allmsg .= "<a href='". $settings['siteurl'] ."shop". $shop_id .".php' target='_blank'>". $settings['siteurl'] ."shop". $shop_id .".php</a><br /><br />\n";
				$allmsg .= "". $locale['mail_012'] ."<br />\n";
				$allmsg .= "". $settings['sitename'] ."<br />\n";
				$allmsg .= "". $settings['siteurl'] ."<br />\n";
				$allmsg .= "". $settings['siteemail'] ."<br />\n";

				// Отправляем письмо майлеру
				mail($shop_email, $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END

			
			$result_alter = dbquery("ALTER TABLE `". DB_SHOPS ."` ORDER BY `shop_id` DESC");
			

			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];


			unset($shop_name);
			unset($shop_qorod);
			unset($shop_adress);
			unset($shop_mobiltel);
			unset($shop_tel);
			unset($shop_email);
			unset($shop_site);
			unset($shop_images1);
			unset($shop_images2);
			unset($shop_images3);
			unset($shop_imgocher);
			unset($shop_elaveinfo);
			unset($shop_ip);
			unset($shop_today);
			unset($shop_views);
			unset($shop_aktiv);
			unset($shop_vip);

			unset($shop_srok);

			if ($_GET['action']=="edit") {
				redirect(ADMIN ."shops.php". $aidlink ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} else if ($_GET['action']=="add") {
				redirect(ADMIN ."shops.php". $aidlink ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} // Edit ili Add redirect

		} // Yesli Error Yest
	} // Yesli POST

?>



<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#shop_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#shop_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addshop" id="addshop" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
	<div class="addshop">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds shop_name">
				<label for="shop_name"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_shop_name==1 ? " error" : ""); ?>" type="text" maxlength="255" name="shop_name" id="shop_name" value="<?php echo $shop_name; ?>" />
			</div>
			<div class="fileds shop_qorod">
				<label for="shop_qorod"><?php echo $locale['511']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_shop_qorod==1 ? " error" : ""); ?>" name="shop_qorod" id="shop_qorod">
					<option value=""<?php echo ($shop_qorod=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<optgroup label="<?php echo $locale['zona_1']; ?>">
						<option value="1"<?php echo ($shop_qorod==1 ? " selected" : ""); ?>><?php echo $locale['qorod_1']; ?></option>
						<option value="2"<?php echo ($shop_qorod==2 ? " selected" : ""); ?>><?php echo $locale['qorod_2']; ?></option>
						<option value="3"<?php echo ($shop_qorod==3 ? " selected" : ""); ?>><?php echo $locale['qorod_3']; ?></option>
						<option value="4"<?php echo ($shop_qorod==4 ? " selected" : ""); ?>><?php echo $locale['qorod_4']; ?></option>
						<option value="5"<?php echo ($shop_qorod==5 ? " selected" : ""); ?>><?php echo $locale['qorod_5']; ?></option>
						<option value="6"<?php echo ($shop_qorod==6 ? " selected" : ""); ?>><?php echo $locale['qorod_6']; ?></option>
						<option value="7"<?php echo ($shop_qorod==7 ? " selected" : ""); ?>><?php echo $locale['qorod_7']; ?></option>
						<option value="8"<?php echo ($shop_qorod==8 ? " selected" : ""); ?>><?php echo $locale['qorod_8']; ?></option>
						<option value="9"<?php echo ($shop_qorod==9 ? " selected" : ""); ?>><?php echo $locale['qorod_9']; ?></option>
						<option value="10"<?php echo ($shop_qorod==10 ? " selected" : ""); ?>><?php echo $locale['qorod_10']; ?></option>
						<option value="11"<?php echo ($shop_qorod==11 ? " selected" : ""); ?>><?php echo $locale['qorod_11']; ?></option>
						<option value="12"<?php echo ($shop_qorod==12 ? " selected" : ""); ?>><?php echo $locale['qorod_12']; ?></option>
						<option value="13"<?php echo ($shop_qorod==13 ? " selected" : ""); ?>><?php echo $locale['qorod_13']; ?></option>
						<option value="14"<?php echo ($shop_qorod==14 ? " selected" : ""); ?>><?php echo $locale['qorod_14']; ?></option>
						<option value="15"<?php echo ($shop_qorod==15 ? " selected" : ""); ?>><?php echo $locale['qorod_15']; ?></option>
						<option value="16"<?php echo ($shop_qorod==16 ? " selected" : ""); ?>><?php echo $locale['qorod_16']; ?></option>
						<option value="17"<?php echo ($shop_qorod==17 ? " selected" : ""); ?>><?php echo $locale['qorod_17']; ?></option>
						<option value="18"<?php echo ($shop_qorod==18 ? " selected" : ""); ?>><?php echo $locale['qorod_18']; ?></option>
						<option value="19"<?php echo ($shop_qorod==19 ? " selected" : ""); ?>><?php echo $locale['qorod_19']; ?></option>
						<option value="20"<?php echo ($shop_qorod==20 ? " selected" : ""); ?>><?php echo $locale['qorod_20']; ?></option>
					</optgroup>
						<optgroup label="<?php echo $locale['zona_2']; ?>">
						<option value="51"<?php echo ($shop_qorod==51 ? " selected" : ""); ?>><?php echo $locale['qorod_51']; ?></option>
						<option value="52"<?php echo ($shop_qorod==52 ? " selected" : ""); ?>><?php echo $locale['qorod_52']; ?></option>
						<option value="53"<?php echo ($shop_qorod==53 ? " selected" : ""); ?>><?php echo $locale['qorod_53']; ?></option>
						<option value="54"<?php echo ($shop_qorod==54 ? " selected" : ""); ?>><?php echo $locale['qorod_54']; ?></option>
					</optgroup>
				</select>
			</div>
			<div class="fileds shop_adress">
				<label for="shop_adress"><?php echo $locale['512']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_shop_adress==1 ? " error" : ""); ?>" type="text" maxlength="500" name="shop_adress" id="shop_adress" value="<?php echo $shop_adress; ?>" />
			</div>
			<div class="fileds shop_mobiltel">
				<label for="shop_mobiltel"><?php echo $locale['513']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_shop_mobiltel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="shop_mobiltel" id="shop_mobiltel" value="<?php echo $shop_mobiltel; ?>" />
			</div>
			<?php if (($settings['sendsms']==1) && ($shop_aktiv==2)) { ?>
			<div class="fileds sms_send">
				<label for="sms_send" style="color:green;"><?php echo $locale['586']; ?></label>
				<input class="checkbox<?php echo ($error_sms_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="sms_send" id="sms_send"<?php echo ($sms_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="fileds shop_tel">
				<label for="shop_tel"><?php echo $locale['514']; ?></label>
				<input class="textbox<?php echo ($error_shop_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="shop_tel" id="shop_tel" value="<?php echo $shop_tel; ?>" />
			</div>
			<div class="fileds shop_email">
				<label for="shop_email"><?php echo $locale['515']; ?></label>
				<input class="textbox<?php echo ($error_shop_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="shop_email" id="shop_email" value="<?php echo $shop_email; ?>" />
			</div>
			<?php if (($settings['sendmail']==1) && ($shop_aktiv==2)) { ?>
			<div class="fileds mail_send">
				<label for="mail_send" style="color:green;"><?php echo $locale['587']; ?></label>
				<input class="checkbox<?php echo ($error_mail_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="mail_send" id="mail_send"<?php echo ($mail_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="fileds shop_site">
				<label for="shop_site"><?php echo $locale['517']; ?></label>
				<input class="textbox<?php echo ($error_shop_site==1 ? " error" : ""); ?>" type="text" maxlength="100" name="shop_site" id="shop_site" value="<?php echo $shop_site; ?>" />
			</div>
			<div class="hr"></div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds shop_images">

				<label for="shop_images1"><?php echo $locale['520']; ?><?php echo UL; ?></label>
				<?php if (empty($shop_images1)) { ?>
				<input class="textbox<?php echo ($error_shop_images1==1 ? " error" : ""); ?>" type="file" name="shop_images1" id="shop_images1" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto1">
					<input type="hidden" name="shop_images1var" id="shop_images1var" value="<?php echo $shop_images1; ?>">
					<img src="<?php echo IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images1; ?>" alt="<?php echo $locale['520']; ?>">
					<label class="radio" for="shop_imgocher1"><input class="radio" type="radio" name="shop_imgocher" id="shop_imgocher1"<?php echo ($shop_images1==$shop_imgocher ? " checked" : ""); ?> value="<?php echo $shop_images1; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="shop_images1sil"><input class="checkbox" value="1" type="checkbox" name="shop_images1sil" id="shop_images1sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="shop_images2"><?php echo $locale['521']; ?></label>
				<?php if (empty($shop_images2)) { ?>
				<input class="textbox<?php echo ($error_shop_images2==1 ? " error" : ""); ?>" type="file" name="shop_images2" id="shop_images2" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto2">
					<input type="hidden" name="shop_images2var" id="shop_images2var" value="<?php echo $shop_images2; ?>">
					<img src="<?php echo IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images2; ?>" alt="<?php echo $locale['521']; ?>">
					<label class="radio" for="shop_imgocher2"><input class="radio" type="radio" name="shop_imgocher" id="shop_imgocher2"<?php echo ($shop_images2==$shop_imgocher ? " checked" : ""); ?> value="<?php echo $shop_images2; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="shop_images2sil"><input class="checkbox" value="1" type="checkbox" name="shop_images2sil" id="shop_images2sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="shop_images3"><?php echo $locale['522']; ?></label>
				<?php if (empty($shop_images3)) { ?>
				<input class="textbox<?php echo ($error_shop_images3==1 ? " error" : ""); ?>" type="file" name="shop_images3" id="shop_images3" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto3">
					<input type="hidden" name="shop_images3var" id="shop_images3var" value="<?php echo $shop_images3; ?>">
					<img src="<?php echo IMAGES . $settings['shops_foto_dir'] ."/sm". $shop_images3; ?>" alt="<?php echo $locale['522']; ?>">
					<label class="radio" for="shop_imgocher3"><input class="radio" type="radio" name="shop_imgocher" id="shop_imgocher3"<?php echo ($shop_images3==$shop_imgocher ? " checked" : ""); ?> value="<?php echo $shop_images3; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="shop_images3sil"><input class="checkbox" value="1" type="checkbox" name="shop_images3sil" id="shop_images3sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>

			</div>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds shop_elaveinfo">
				<textarea class="textbox<?php echo ($error_shop_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="shop_elaveinfo" id="shop_elaveinfo"><?php echo $shop_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
		</div>

		<div class="bloks blok1">
			<div class="fileds shop_ip">
				<label for="shop_ip"><?php echo $locale['700']; ?></label>
				<input readonly class="textbox" type="text" name="shop_ip" id="shop_ip" value="<?php echo $shop_ip; ?>" />
			</div>
			<div class="fileds shop_today">
				<label for="shop_today"><?php echo $locale['701']; ?></label>
				<input readonly class="textbox" type="text" name="shop_today" id="shop_today" value="<?php echo date("d.m.Y", $shop_today); ?>" />
			</div>
			<div class="fileds shop_srok">
				<label for="shop_srok"><?php echo $locale['702']; ?></label>
				<input readonly class="textbox" type="text" name="shop_srok" id="shop_srok" value="<?php echo date("d.m.Y", $shop_srok); ?>" />
			</div>
			<div class="fileds shop_views">
				<label for="shop_views"><?php echo $locale['703']; ?></label>
				<input readonly class="textbox" type="text" name="shop_views" id="shop_views" value="<?php echo $shop_views; ?>" />
			</div>
		</div>

		<div class="bloks blok2">
			<div class="fileds shop_vip">
				<label for="shop_vip"><?php echo $locale['704']; ?></label>
				<select class="select" name="shop_vip" id="shop_vip">
					<option value="0"<?php echo ($shop_vip==0 ? " selected" : ""); ?>><?php echo $locale['vip_0']; ?></option>
					<option value="1"<?php echo ($shop_vip==1 ? " selected" : ""); ?>><?php echo $locale['vip_1']; ?></option>
					<option value="2"<?php echo ($shop_vip==2 ? " selected" : ""); ?>><?php echo $locale['vip_2']; ?></option>
					<option value="3"<?php echo ($shop_vip==3 ? " selected" : ""); ?>><?php echo $locale['vip_3']; ?></option>
					<option value="4"<?php echo ($shop_vip==4 ? " selected" : ""); ?>><?php echo $locale['vip_4']; ?></option>
					<option value="5"<?php echo ($shop_vip==5 ? " selected" : ""); ?>><?php echo $locale['vip_5']; ?></option>
					<option value="6"<?php echo ($shop_vip==6 ? " selected" : ""); ?>><?php echo $locale['vip_6']; ?></option>
				</select>
			</div>
			<div class="fileds shop_aktiv">
				<label for="shop_aktiv"><?php echo $locale['705']; ?></label>
				<select class="select" name="shop_aktiv" id="shop_aktiv">
					<option value="0"<?php echo ($shop_aktiv==2 ? " selected" : ""); ?>><?php echo $locale['status_0']; ?></option>
					<option value="1"<?php echo ($shop_aktiv==1 ? " selected" : ""); ?>><?php echo $locale['status_1']; ?></option>
					<option value="4"<?php echo ($shop_aktiv==4 ? " selected" : ""); ?>><?php echo $locale['status_4']; ?></option>
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
			<div class="fileds shop_submit">
				<?php if (($_GET['action']=="edit") && ($shop_aktiv==2)) { ?>
					<input class="button" value="<?php echo $locale['593']; ?>" type="submit" name="shop_submit" id="shop_submit" onclick="return(check())" />
				<?php } else { ?>
					<input class="button" value="<?php echo ($_GET['action']=="edit" ? $locale['592'] : $locale['590']); ?>" type="submit" name="shop_submit" id="shop_submit" onclick="return(check())" />
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
	var ckeditor = CKEDITOR.replace('shop_elaveinfo');
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

		$viewcompanent = viewcompanent("shop", "name");
		$seourl_component = $viewcompanent['components_id'];

		if ((isset($_GET['order'])) && (isset($_GET['by']))) {
			$order = $_GET['order'];
			$by = $_GET['by'];
		} else {
			$order = "shop_id";
			$by = "DESC";
		}

		$result = dbquery("SELECT
									shop_id,
									shop_name,
									shop_imgocher,
									shop_today,
									shop_aktiv,
									shop_vip,
									seourl_url
							FROM ". DB_SHOPS ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=shop_id AND seourl_component=". $seourl_component ."
							ORDER BY `". $order ."` ". $by ."
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		echo "<div class='addcar'><a href='". ADMIN ."shops.php".  $aidlink ."&action=add'>". $locale['711'] ."</a></div>\n";
		echo "<table class='shopslist'>\n";
		echo "		<thead>\n";
		echo "				<tr>\n";
		echo "						<td class='shop_id'><a href='". ADMIN ."shops.php".  $aidlink ."&order=shop_id&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['650'] . ($order=="shop_id" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='shop_images'>". $locale['651'] ."</td>\n";
		echo "						<td class='shop_marka'><a href='". ADMIN ."shops.php".  $aidlink ."&order=shop_name&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['652'] . ($order=="shop_name" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='shop_vip'><a href='". ADMIN ."shops.php".  $aidlink ."&order=shop_vip&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['653'] . ($order=="shop_vip" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='shop_aktiv'><a href='". ADMIN ."shops.php".  $aidlink ."&order=shop_aktiv&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['654'] . ($order=="shop_aktiv" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='shop_today'><a href='". ADMIN ."shops.php".  $aidlink ."&order=shop_today&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['655'] . ($order=="shop_today" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='shop_href'>". $locale['656'] ."</td>\n";
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
		echo "						<td class='shop_id'>#". $data['shop_id'] ."</td>\n";
		echo "						<td class='shop_images'><a href='". ADMIN ."shops.php".  $aidlink ."&action=edit&id=". $data['shop_id'] ."'><img src='". (empty($data['shop_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_imgocher']) ."' alt=''></a></td>\n";
		echo "						<td class='shop_name'><a href='". ADMIN ."shops.php".  $aidlink ."&action=edit&id=". $data['shop_id'] ."'>". $data['shop_name'] ."</a></td>\n";
		echo "						<td class='shop_vip'><img src='". IMAGES ."vip_icons/". ($data['shop_vip']==0 ? "vip_off.png" : "vip_on.png") ."' alt='". $locale['vip_'. $data['shop_vip']] ."' title='". $locale['vip_'. $data['shop_vip']] ."'></td>\n";
		echo "						<td class='shop_aktiv'><img src='". IMAGES . "status/status_". $data['shop_aktiv'] .".png' alt='". $locale['status_'. $data['shop_aktiv']] ."' title='". $locale['status_'. $data['shop_aktiv']] ."'></td>\n";
		echo "						<td class='shop_today'>". date("d.m.Y", $data['shop_today']) ."</td>\n";
		echo "						<td class='shop_href'>\n";
		echo "							<a class='view' href='". BASEDIR . $data['seourl_url'] ."' target='_blank' title='". $locale['660'] ."'><img src='". IMAGES ."view.png' alt='". $locale['660'] ."'></a>\n";
		echo "							<a class='edit' href='". ADMIN ."shops.php".  $aidlink ."&action=edit&id=". $data['shop_id'] ."' title='". $locale['661'] ."'><img src='". IMAGES ."edit.png' alt='". $locale['661'] ."'></a>\n";
		echo "							<a class='delete' href='". ADMIN ."shops.php".  $aidlink ."&action=delete&id=". $data['shop_id'] ."' title='". $locale['662'] ."' onclick='return DeleteOk();'><img src='". IMAGES ."delete.png' alt='". $locale['662'] ."'></a>\n";
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
		echo "						<td class='shop_id'>&nbsp;</td>\n";
		echo "						<td class='shop_images'>&nbsp;</td>\n";
		echo "						<td class='shop_name'>&nbsp;</td>\n";
		echo "						<td class='shop_vip'>&nbsp;</td>\n";
		echo "						<td class='shop_aktiv'>&nbsp;</td>\n";
		echo "						<td class='shop_today'>&nbsp;</td>\n";
		echo "						<td class='shop_href'>&nbsp;</td>\n";
		echo "				</tr>\n";
		echo "		</tfoot>\n";
		echo "	</table>\n";


		echo navigation($_GET['page'], $settings['goradmin'], "shop_id", DB_SHOPS, "");
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