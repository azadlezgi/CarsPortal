<?php

require_once "../includes/maincore.php";

if (!checkrights("SERVI") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }


require_once THEMES."templates/admin_header.php";

session_start();

include LOCALE.LOCALESET."admin/services.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);


	if ($_GET['action']=="edit") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."services.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $locale['642'] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
	} else if ($_GET['action']=="add") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."services.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
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

	$viewcompanent = viewcompanent("service", "name");
	$components_id = $viewcompanent['components_id'];

	$result = dbquery("SELECT * FROM ". DB_SERVICES ." WHERE service_id='". (INT)$_GET['id'] ."'");

	if (dbrows($result)) {
		$data = dbarray($result);

		if (is_file(IMAGES . $settings['services_foto_dir'] ."/rl". $data['service_images1'])) { unlink (IMAGES . $settings['services_foto_dir'] ."/rl". $data['service_images1']); }
		if (is_file(IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images1'])) { unlink (IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images1']); }

		if (is_file(IMAGES . $settings['services_foto_dir'] ."/rl". $data['service_images2'])) { unlink (IMAGES . $settings['services_foto_dir'] ."/rl". $data['service_images2']); }
		if (is_file(IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images2'])) { unlink (IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images2']); }

		if (is_file(IMAGES . $settings['services_foto_dir'] ."/rl". $data['service_images3'])) { unlink (IMAGES . $settings['services_foto_dir'] ."/rl". $data['service_images3']); }
		if (is_file(IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images3'])) { unlink (IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images3']); }

		$result = dbquery("DELETE FROM ". DB_SERVICES ." WHERE service_id='". $data['service_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $components_id ."' AND seourl_filedid='". $data['service_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SROK ." WHERE srok_post_type='". $components_id ."' AND srok_post_id='". $data['service_id'] ."'");

	}

	redirect(ADMIN ."services.php". $aidlink ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {

	if ($_POST['service_submit']) {

		$service_id = (INT)$_GET['id'];
		$service_name = trim(stripinput(censorwords(substr($_POST['service_name'],0,255))));
		$service_qorod = trim(stripinput(censorwords(substr($_POST['service_qorod'],0,10))));
		$service_adress = trim(stripinput(censorwords(substr($_POST['service_adress'],0,500))));
		$service_mobiltel = trim(stripinput(censorwords(substr($_POST['service_mobiltel'],0,100))));
		$service_mobiltel = str_replace(" ", "", $service_mobiltel);
		$service_mobiltel = str_replace("(", "", $service_mobiltel);
		$service_mobiltel = str_replace(")", "", $service_mobiltel);
		$service_mobiltel = str_replace("-", "", $service_mobiltel);
		$service_mobiltel = str_replace("_", "", $service_mobiltel);
		$service_tel = trim(stripinput(censorwords(substr($_POST['service_tel'],0,100))));
		$service_tel = str_replace(" ", "", $service_tel);
		$service_tel = str_replace("(", "", $service_tel);
		$service_tel = str_replace(")", "", $service_tel);
		$service_tel = str_replace("-", "", $service_tel);
		$service_tel = str_replace("_", "", $service_tel);
		$service_email = trim(stripinput(censorwords(substr($_POST['service_email'],0,100))));
		$service_site = trim(stripinput(censorwords(substr($_POST['service_site'],0,100))));
		$service_site = str_replace("http://", "", $service_site);
		$service_site = explode("/", $service_site);
		$service_site = $service_site[0];

		$service_imgocher  = trim(stripinput(censorwords(substr($_POST['service_imgocher'],0,100))));

		$service_images1var  = trim(stripinput(censorwords(substr($_POST['service_images1var'],0,100))));
		$service_images2var  = trim(stripinput(censorwords(substr($_POST['service_images2var'],0,100))));
		$service_images3var  = trim(stripinput(censorwords(substr($_POST['service_images3var'],0,100))));

		$service_images1sil  = trim(stripinput(censorwords(substr($_POST['service_images1sil'],0,1))));
		$service_images2sil  = trim(stripinput(censorwords(substr($_POST['service_images2sil'],0,1))));
		$service_images3sil  = trim(stripinput(censorwords(substr($_POST['service_images3sil'],0,1))));

		if (empty($service_images1var)) {
			$service_images1 = $_FILES['service_images1']['name'];
			$service_images1tmp = $_FILES['service_images1']['tmp_name'];
			$service_images1size = $_FILES['service_images1']['size'];
			$service_images1type = $_FILES['service_images1']['type'];
		} else {
			$service_images1 = $service_images1var;
		}

		if (empty($service_images2var)) {
			$service_images2 =  $_FILES['service_images2']['name'];
			$service_images2tmp  = $_FILES['service_images2']['tmp_name'];
			$service_images2size = $_FILES['service_images2']['size'];
			$service_images2type = $_FILES['service_images2']['type'];
		}
		 else {
			$service_images2 = $service_images2var;
		}

		if (empty($service_images3var)) {
			$service_images3 =  $_FILES['service_images3']['name'];
			$service_images3tmp  = $_FILES['service_images3']['tmp_name'];
			$service_images3size = $_FILES['service_images3']['size'];
			$service_images3type = $_FILES['service_images3']['type'];
		} else {
			$service_images3 = $service_images3var;
		}

		$service_elaveinfo = trim(censorwords(substr($_POST['service_elaveinfo'],0,10000)));
		$service_ip = FUSION_IP;
		$service_today = FUSION_TODAY;
		$service_views = 0;

		if ($_POST['service_submit']==$locale['593']) {
			$service_aktiv = 1;
		} else {
			$service_aktiv = trim(stripinput(censorwords(substr($_POST['service_aktiv'],0,1))));
		}
		$service_vip = trim(stripinput(censorwords(substr($_POST['service_vip'],0,1))));

		$sms_send = trim(stripinput(censorwords(substr((INT)$_POST['sms_send'],0,1))));
		$mail_send = trim(stripinput(censorwords(substr((INT)$_POST['mail_send'],0,1))));

		$car_srok_date = trim(stripinput(censorwords(substr($_POST['car_srok_date'],0,15))));

		if ($_GET['action']=="edit") {
			$viewcompanent = viewcompanent("service", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $service_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$service_srok = $data_srok['srok_date']+$car_srok_date;;
			} // Yesli result_srok DB query yest
		} else {
			$service_srok = (FUSION_TODAY+$settings['qalmavaxti'])+$car_srok_date;
		}

	} else if ($_GET['action']=="edit") {

		$result = dbquery("SELECT * FROM ". DB_SERVICES ." WHERE service_id='". (INT)$_GET['id'] ."'");

		if (dbrows($result)) {
			$data = dbarray($result);

			$service_id = $data['service_id'];
			$service_name = $data['service_name'];
			$service_qorod = $data['service_qorod'];
			$service_adress = $data['service_adress'];
			$service_mobiltel = $data['service_mobiltel'];
			$service_tel = $data['service_tel'];
			$service_email = $data['service_email'];
			$service_site = $data['service_site'];
			$service_images1 = $data['service_images1'];
			$service_images2 = $data['service_images2'];
			$service_images3 = $data['service_images3'];
			$service_imgocher = $data['service_imgocher'];
			$service_elaveinfo = $data['service_elaveinfo'];
			$service_ip = $data['service_ip'];
			$service_today = $data['service_today'];
			$service_views = $data['service_views'];
			$service_aktiv = $data['service_aktiv'];
			$service_vip = $data['service_vip'];

			if ($service_aktiv==2) {
				$mail_send = 1;
				$sms_send = 1;
			} else {
				$mail_send = 0;
				$sms_send = 0;
			}

			$viewcompanent = viewcompanent("service", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $service_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$service_srok = $data_srok['srok_date'];
			} // Yesli result_srok DB query yest

		} // Yesli DB query yest

	} else {

		$service_name = "";
		$service_qorod = "";
		$service_adress = "";
		$service_mobiltel = "+994";
		$service_tel = "+994";
		$service_email = "";
		$service_site = "";
		$service_images1 = "";
		$service_images2 = "";
		$service_images3 = "";
		$service_elaveinfo = "";
		$service_ip = FUSION_IP;
		$service_today = FUSION_TODAY;
		$service_views = 0;
		$service_aktiv = 2;
		$service_vip = 0;

		$mail_send = 1;
		$sms_send = 1;

		$service_srok = FUSION_TODAY+$settings['qalmavaxti'];

	}

	if ($_POST['service_submit']) {

		if (empty($service_name)) { $error_service_name = 1; $error .= "<div class='error'>". $locale['error_001'] ."</div>\n"; }
		if (empty($service_qorod)) { $error_service_qorod = 1; $error .= "<div class='error'>". $locale['error_002'] ."</div>\n"; }
		if (empty($service_adress)) { $error_service_adress = 1; $error .= "<div class='error'>". $locale['error_003'] ."</div>\n"; }
		if (empty($service_mobiltel)) { $error_service_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (strlen($service_mobiltel) < 13) { $error_service_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (!empty($service_mobiltel) && !preg_match("/^([0-9])+$/is", $service_mobiltel)) { $error_service_mobiltel = 1; $error .= "<div class='error'>". $locale['error_005'] ."</div>\n"; }
		// if (empty($service_tel)) { $error_service_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (strlen($service_tel) < 13) { $error_service_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (!empty($service_tel) && !preg_match("/^([0-9])+$/is", $service_tel)) { $error_service_tel = 1; $error .= "<div class='error'>". $locale['error_007'] ."</div>\n"; }
		if (!empty($service_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $service_email)) { $error_service_email = 1; $error .= "<div class='error'>". $locale['error_008'] ."</div>\n"; }
		if (!empty($service_site) && !eregi("^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$", $service_site)) { $error_service_site = 1; $error .= "<div class='error'>". $locale['error_009'] ."</div>\n"; }


		if (empty($service_images1var)) {

			if (empty($service_images1)) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

			if (!empty($service_images1)) {
				if (strlen($service_images1) > 100) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
				// проверяем расширение файла
				$ext1 = strtolower(substr($service_images1, 1 + strrpos($service_images1, ".")));
				if (!in_array($ext1, $valid_types)) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$findtchka1 = substr_count($service_images1, ".");
				if ($findtchka1>1) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$service_images1))  { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
				if (preg_match("/\.html/i",$service_images1)) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$service_images1))  { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
				// 5. Размер фото
				$fotoksize1 = round($service_images1size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$fotomax1 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
				if ($fotoksize1>$fotomax1) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize1 ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$size1 = getimagesize($service_images1tmp);
				if ($size1[0]>$settings['foto_x'] or $size1[1]>$settings['foto_y']) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size1[0] ."x". $size1[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
				//if ($size1[0]<$size1[1]) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
				// Foto 0 Kb
				if ($service_images1size<0 and $service_images1size>$settings['foto_size']) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
			}
		}

		if (empty($service_images2var)) {
			if (!empty($service_images2)) {
				if (strlen($service_images2) > 100) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_064'] ."</div>\n"; }
				// проверяем расширение файла
				$ext2 = strtolower(substr($service_images2, 1 + strrpos($service_images2, ".")));
				if (!in_array($ext2, $valid_types)) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_065'] ."</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$findtchka2 = substr_count($service_images2, ".");
				if ($findtchka2>1) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_066'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$service_images2))  { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_067'] ."</div>\n"; }
				if (preg_match("/\.html/i",$service_images2)) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_068'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$service_images2))  { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_069'] ."</div>\n"; }
				// 5. Размер фото
				$fotoksize2 = round($service_images2size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$fotomax2 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
				if ($fotoksize2>$fotomax2) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_070'] ."<br />". $locale['error_057'] ." ". $fotoksize2 ." Kb<br />". $locale['error_058'] ." ". $fotomax2 ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$size2 = getimagesize($service_images2tmp);
				if ($size2[0]>$settings['foto_x'] or $size2[1]>$settings['foto_y']) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_071'] ."<br />". $locale['error_060'] ." ". $size2[0] ."x". $size2[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
				//if ($size2[0]<$size2[1]) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_072'] ."</div>\n"; }
				// Foto 0 Kb
				if ($service_images2size<"0" and $service_images2size>$settings['foto_size']) { $error_service_images2 = 1; $error .= "<div class='error'>". $locale['error_073'] ."</div>\n"; }
			}
		}

		if (empty($service_images3var)) {
			if (!empty($service_images3)) {
				if (strlen($service_images3) > 100) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_074'] ."</div>\n"; }
				// проверяем расширение файла
				$ext3 = strtolower(substr($service_images3, 1 + strrpos($service_images3, ".")));
				if (!in_array($ext3, $valid_types)) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_075'] ."</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$findtchka3=substr_count($service_images3, ".");
				if ($findtchka3>1) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_076'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$service_images3))  { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_077'] ."</div>\n"; }
				if (preg_match("/\.html/i",$service_images3)) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_078'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$service_images3))  { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_079'] ."</div>\n"; }
				// 5. Размер фото
				$fotoksize3=round($service_images3size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$fotomax3=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
				if ($fotoksize3>$fotomax3) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_080'] ."<br />". $locale['error_057'] ." ". $fotoksize3 ." Kb<br />". $locale['error_058'] ." ". $fotomax3 ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$size3=getimagesize($service_images3tmp);
				if ($size3[0]>$settings['foto_x'] or $size3[1]>$settings['foto_y']) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_081'] ."<br />". $locale['error_060'] ." ". $size3[0] ."x". $size3[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
				//if ($size3[0]<$size3[1]) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_082'] ."</div>\n"; }
				// Foto 0 Kb
				if   ($service_images3size<"0" and $service_images3size>$settings['foto_size']) { $error_service_images3 = 1; $error .= "<div class='error'>". $locale['error_083'] ."</div>\n"; }
			}
		}

		//if (empty($service_imgocher)) { $error_service_imgocher = 1; $error .= "<div class='error'>". $locale['error_115'] ."</div>\n"; }


		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);


			if (empty($service_images1var)) {
				if (!empty($service_images1)) {
					$service_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
					$service_images1namerl = "rl". $service_images1name;
					$service_images1namesm = "sm". $service_images1name;
					copy($service_images1tmp, IMAGES . $settings['services_foto_dir'] ."/". $service_images1name);
					img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images1name, IMAGES . $settings['services_foto_dir'] ."/". $service_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images1name, IMAGES . $settings['services_foto_dir'] ."/". $service_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['services_foto_dir'] ."/". $service_images1name);

					if (empty($service_imgocher)) { $service_imgocher = $service_images1name; }
				}
			} else if ($service_images1sil==1) {
				if (is_file(IMAGES . $settings['services_foto_dir'] ."/rl". $service_images1var)) { unlink (IMAGES . $settings['services_foto_dir'] ."/rl". $service_images1var); }
				if (is_file(IMAGES . $settings['services_foto_dir'] ."/sm". $service_images1var)) { unlink (IMAGES . $settings['services_foto_dir'] ."/sm". $service_images1var); }
				if ($service_imgocher==$service_images1var) { $service_imgocher = ""; }
				$service_images1name = "";
			} else {
				$service_images1name = $service_images1var;
			}

			if (empty($service_images2var)) {
				if (!empty($service_images2)) {
					$service_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
					$service_images2namerl = "rl". $service_images2name;
					$service_images2namesm = "sm". $service_images2name;
					copy($service_images2tmp, IMAGES . $settings['services_foto_dir'] ."/". $service_images2name);
					img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images2name, IMAGES . $settings['services_foto_dir'] ."/". $service_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images2name, IMAGES . $settings['services_foto_dir'] ."/". $service_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['services_foto_dir'] ."/". $service_images2name);

					if (empty($service_imgocher)) { $service_imgocher = $service_images2name; }
				}
			} else if ($service_images2sil==1) {
				if (is_file(IMAGES . $settings['services_foto_dir'] ."/rl". $service_images2var)) { unlink (IMAGES . $settings['services_foto_dir'] ."/rl". $service_images2var); }
				if (is_file(IMAGES . $settings['services_foto_dir'] ."/sm". $service_images2var)) { unlink (IMAGES . $settings['services_foto_dir'] ."/sm". $service_images2var); }
				if ($service_imgocher==$service_images2var) { $service_imgocher = $service_images1name; }
				$service_images2name = "";
			} else {
				$service_images2name = $service_images2var;
			}

			if (empty($service_images3var)) {
				if (!empty($service_images3)) {
					$service_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
					$service_images3namerl = "rl". $service_images3name;
					$service_images3namesm = "sm". $service_images3name;
					copy($service_images3tmp, IMAGES . $settings['services_foto_dir'] ."/". $service_images3name);
					img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images3name, IMAGES . $settings['services_foto_dir'] ."/". $service_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
					img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images3name, IMAGES . $settings['services_foto_dir'] ."/". $service_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
					unlink (IMAGES . $settings['services_foto_dir'] ."/". $service_images3name);

					if (empty($service_imgocher)) { $service_imgocher = $service_images3name; }
				}
			} else if ($service_images3sil==1) {
				if (is_file(IMAGES . $settings['services_foto_dir'] ."/rl". $service_images3var)) { unlink (IMAGES . $settings['services_foto_dir'] ."/rl". $service_images3var); }
				if (is_file(IMAGES . $settings['services_foto_dir'] ."/sm". $service_images3var)) { unlink (IMAGES . $settings['services_foto_dir'] ."/sm". $service_images3var); }
				if ($service_imgocher==$service_images3var) { $service_imgocher = $service_images1name; }
				$service_images3name = "";
			} else {
				$service_images3name = $service_images3var;
			}


		if ($_GET['action']=="edit") {

			### UPDATE service BEGIN
			if ($service_tel=="+994") { $service_tel=""; }

			$result = dbquery(
				"UPDATE ". DB_SERVICES ." SET
												service_name='". $service_name ."',
												service_qorod='". $service_qorod ."',
												service_adress='". $service_adress ."',
												service_mobiltel='". $service_mobiltel ."',
												service_tel='". $service_tel ."',
												service_email='". $service_email ."',
												service_site='". $service_site ."',
												service_images1='". $service_images1name ."',
												service_images2='". $service_images2name ."',
												service_images3='". $service_images3name ."',
												service_imgocher='". $service_imgocher ."',
												service_elaveinfo='". $service_elaveinfo ."',
												service_aktiv='". $service_aktiv ."',
												service_vip='". $service_vip ."'
				WHERE service_id='". $service_id ."'"
			);
			### UPDATE service END


			### UPDATE SROK BEGIN
			$viewcompanent = viewcompanent("service", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $service_id;
			$srok_date = $service_srok;

			$result = dbquery(
				"UPDATE ". DB_SROK ." SET
												srok_date='". $srok_date ."'
				WHERE srok_post_id='". $srok_post_id ."' AND srok_post_type='". $srok_post_type ."'"
			);
			### UPDATE SROK END


		} else if ($_GET['action']=="add") {

			### INSERT service BEGIN
			if ($service_tel=="+994") { $service_tel=""; }
			
			$result = dbquery(
				"INSERT INTO ". DB_SERVICES ." (
												service_name,
												service_qorod,
												service_adress,
												service_mobiltel,
												service_tel,
												service_email,
												service_site,
												service_images1,
												service_images2,
												service_images3,
												service_imgocher,
												service_elaveinfo,
												service_ip,
												service_today,
												service_views,
												service_aktiv,
												service_vip
				) VALUES (
												'". $service_name ."',
												'". $service_qorod ."',
												'". $service_adress ."',
												'". $service_mobiltel ."',
												'". $service_tel ."',
												'". $service_email ."',
												'". $service_site ."',
												'". $service_images1name ."',
												'". $service_images2name ."',
												'". $service_images3name ."',
												'". $service_imgocher ."',
												'". $service_elaveinfo ."',
												'". $service_ip ."',
												'". $service_today ."',
												'". $service_views ."',
												'". $service_aktiv ."',
												'". $service_vip ."'

				)"
			);
			$service_id = mysql_insert_id();
			### INSERT service END


			### INSERT SEOURL BEGIN
			$seourl_url = "service". $service_id .".php";
			$viewcompanent = viewcompanent("service", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = $service_id;

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
			$viewcompanent = viewcompanent("service", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $service_id;
			$srok_date = $service_srok;

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
			if (($settings['sendsms']==1) && ($sms_send==1) && ($service_aktiv==1) && (!empty($service_mobiltel))) {

				include INCLUDES .'smsapi/config.php';
				include INCLUDES .'smsapi/Addressbook.php';
				include INCLUDES .'smsapi/Exceptions.php';
				include INCLUDES .'smsapi/Account.php';
				include INCLUDES .'smsapi/Stat.php';


				$sender = substr($settings['sitename'], 0, 11);
				$text = sprintf($locale['sms_001'], $service_id);
				$phone = $service_mobiltel;
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
			if (($settings['sendmail']==1) && ($mail_send==1) && ($service_aktiv==1) && (!empty($service_email))) {

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "". $locale['mail_010'] ." <b>". $service_id ."</b><br />\n";
				$allmsg .= "". $locale['mail_011'] ."<br />\n";
				$allmsg .= "<a href='". $settings['siteurl'] ."service". $service_id .".php' target='_blank'>". $settings['siteurl'] ."service". $service_id .".php</a><br /><br />\n";
				$allmsg .= "". $locale['mail_012'] ."<br />\n";
				$allmsg .= "". $settings['sitename'] ."<br />\n";
				$allmsg .= "". $settings['siteurl'] ."<br />\n";
				$allmsg .= "". $settings['siteemail'] ."<br />\n";

				// Отправляем письмо майлеру
				mail($service_email, $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END

			
			$result_alter = dbquery("ALTER TABLE `". DB_SERVICES ."` ORDER BY `service_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];


			unset($service_name);
			unset($service_qorod);
			unset($service_adress);
			unset($service_mobiltel);
			unset($service_tel);
			unset($service_email);
			unset($service_site);
			unset($service_images1);
			unset($service_images2);
			unset($service_images3);
			unset($service_imgocher);
			unset($service_elaveinfo);
			unset($service_ip);
			unset($service_today);
			unset($service_views);
			unset($service_aktiv);
			unset($service_vip);

			unset($service_srok);

			if ($_GET['action']=="edit") {
				redirect(ADMIN ."services.php". $aidlink ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} else if ($_GET['action']=="add") {
				redirect(ADMIN ."services.php". $aidlink ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} // Edit ili Add redirect

		} // Yesli Error Yest
	} // Yesli POST

?>



<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#service_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#service_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addservice" id="addservice" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
	<div class="addservice">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds service_name">
				<label for="service_name"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_service_name==1 ? " error" : ""); ?>" type="text" maxlength="255" name="service_name" id="service_name" value="<?php echo $service_name; ?>" />
			</div>
			<div class="fileds service_qorod">
				<label for="service_qorod"><?php echo $locale['511']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_service_qorod==1 ? " error" : ""); ?>" name="service_qorod" id="service_qorod">
					<option value=""<?php echo ($service_qorod=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<optgroup label="<?php echo $locale['zona_1']; ?>">
						<option value="1"<?php echo ($service_qorod==1 ? " selected" : ""); ?>><?php echo $locale['qorod_1']; ?></option>
						<option value="2"<?php echo ($service_qorod==2 ? " selected" : ""); ?>><?php echo $locale['qorod_2']; ?></option>
						<option value="3"<?php echo ($service_qorod==3 ? " selected" : ""); ?>><?php echo $locale['qorod_3']; ?></option>
						<option value="4"<?php echo ($service_qorod==4 ? " selected" : ""); ?>><?php echo $locale['qorod_4']; ?></option>
						<option value="5"<?php echo ($service_qorod==5 ? " selected" : ""); ?>><?php echo $locale['qorod_5']; ?></option>
						<option value="6"<?php echo ($service_qorod==6 ? " selected" : ""); ?>><?php echo $locale['qorod_6']; ?></option>
						<option value="7"<?php echo ($service_qorod==7 ? " selected" : ""); ?>><?php echo $locale['qorod_7']; ?></option>
						<option value="8"<?php echo ($service_qorod==8 ? " selected" : ""); ?>><?php echo $locale['qorod_8']; ?></option>
						<option value="9"<?php echo ($service_qorod==9 ? " selected" : ""); ?>><?php echo $locale['qorod_9']; ?></option>
						<option value="10"<?php echo ($service_qorod==10 ? " selected" : ""); ?>><?php echo $locale['qorod_10']; ?></option>
						<option value="11"<?php echo ($service_qorod==11 ? " selected" : ""); ?>><?php echo $locale['qorod_11']; ?></option>
						<option value="12"<?php echo ($service_qorod==12 ? " selected" : ""); ?>><?php echo $locale['qorod_12']; ?></option>
						<option value="13"<?php echo ($service_qorod==13 ? " selected" : ""); ?>><?php echo $locale['qorod_13']; ?></option>
						<option value="14"<?php echo ($service_qorod==14 ? " selected" : ""); ?>><?php echo $locale['qorod_14']; ?></option>
						<option value="15"<?php echo ($service_qorod==15 ? " selected" : ""); ?>><?php echo $locale['qorod_15']; ?></option>
						<option value="16"<?php echo ($service_qorod==16 ? " selected" : ""); ?>><?php echo $locale['qorod_16']; ?></option>
						<option value="17"<?php echo ($service_qorod==17 ? " selected" : ""); ?>><?php echo $locale['qorod_17']; ?></option>
						<option value="18"<?php echo ($service_qorod==18 ? " selected" : ""); ?>><?php echo $locale['qorod_18']; ?></option>
						<option value="19"<?php echo ($service_qorod==19 ? " selected" : ""); ?>><?php echo $locale['qorod_19']; ?></option>
						<option value="20"<?php echo ($service_qorod==20 ? " selected" : ""); ?>><?php echo $locale['qorod_20']; ?></option>
					</optgroup>
						<optgroup label="<?php echo $locale['zona_2']; ?>">
						<option value="51"<?php echo ($service_qorod==51 ? " selected" : ""); ?>><?php echo $locale['qorod_51']; ?></option>
						<option value="52"<?php echo ($service_qorod==52 ? " selected" : ""); ?>><?php echo $locale['qorod_52']; ?></option>
						<option value="53"<?php echo ($service_qorod==53 ? " selected" : ""); ?>><?php echo $locale['qorod_53']; ?></option>
						<option value="54"<?php echo ($service_qorod==54 ? " selected" : ""); ?>><?php echo $locale['qorod_54']; ?></option>
					</optgroup>
				</select>
			</div>
			<div class="fileds service_adress">
				<label for="service_adress"><?php echo $locale['512']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_service_adress==1 ? " error" : ""); ?>" type="text" maxlength="500" name="service_adress" id="service_adress" value="<?php echo $service_adress; ?>" />
			</div>
			<div class="fileds service_mobiltel">
				<label for="service_mobiltel"><?php echo $locale['513']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_service_mobiltel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="service_mobiltel" id="service_mobiltel" value="<?php echo $service_mobiltel; ?>" />
			</div>
			<?php if (($settings['sendsms']==1) && ($service_aktiv==2)) { ?>
			<div class="fileds sms_send">
				<label for="sms_send" style="color:green;"><?php echo $locale['586']; ?></label>
				<input class="checkbox<?php echo ($error_sms_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="sms_send" id="sms_send"<?php echo ($sms_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="fileds service_tel">
				<label for="service_tel"><?php echo $locale['514']; ?></label>
				<input class="textbox<?php echo ($error_service_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="service_tel" id="service_tel" value="<?php echo $service_tel; ?>" />
			</div>
			<div class="fileds service_email">
				<label for="service_email"><?php echo $locale['515']; ?></label>
				<input class="textbox<?php echo ($error_service_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="service_email" id="service_email" value="<?php echo $service_email; ?>" />
			</div>
			<?php if (($settings['sendmail']==1) && ($service_aktiv==2)) { ?>
			<div class="fileds mail_send">
				<label for="mail_send" style="color:green;"><?php echo $locale['587']; ?></label>
				<input class="checkbox<?php echo ($error_mail_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="mail_send" id="mail_send"<?php echo ($mail_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="fileds service_site">
				<label for="service_site"><?php echo $locale['517']; ?></label>
				<input class="textbox<?php echo ($error_service_site==1 ? " error" : ""); ?>" type="text" maxlength="100" name="service_site" id="service_site" value="<?php echo $service_site; ?>" />
			</div>
			<div class="hr"></div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds service_images">

				<label for="service_images1"><?php echo $locale['520']; ?><?php echo UL; ?></label>
				<?php if (empty($service_images1)) { ?>
				<input class="textbox<?php echo ($error_service_images1==1 ? " error" : ""); ?>" type="file" name="service_images1" id="service_images1" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto1">
					<input type="hidden" name="service_images1var" id="service_images1var" value="<?php echo $service_images1; ?>">
					<img src="<?php echo IMAGES . $settings['services_foto_dir'] ."/sm". $service_images1; ?>" alt="<?php echo $locale['520']; ?>">
					<label class="radio" for="service_imgocher1"><input class="radio" type="radio" name="service_imgocher" id="service_imgocher1"<?php echo ($service_images1==$service_imgocher ? " checked" : ""); ?> value="<?php echo $service_images1; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="service_images1sil"><input class="checkbox" value="1" type="checkbox" name="service_images1sil" id="service_images1sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="service_images2"><?php echo $locale['521']; ?></label>
				<?php if (empty($service_images2)) { ?>
				<input class="textbox<?php echo ($error_service_images2==1 ? " error" : ""); ?>" type="file" name="service_images2" id="service_images2" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto2">
					<input type="hidden" name="service_images2var" id="service_images2var" value="<?php echo $service_images2; ?>">
					<img src="<?php echo IMAGES . $settings['services_foto_dir'] ."/sm". $service_images2; ?>" alt="<?php echo $locale['521']; ?>">
					<label class="radio" for="service_imgocher2"><input class="radio" type="radio" name="service_imgocher" id="service_imgocher2"<?php echo ($service_images2==$service_imgocher ? " checked" : ""); ?> value="<?php echo $service_images2; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="service_images2sil"><input class="checkbox" value="1" type="checkbox" name="service_images2sil" id="service_images2sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>


				<label for="service_images3"><?php echo $locale['522']; ?></label>
				<?php if (empty($service_images3)) { ?>
				<input class="textbox<?php echo ($error_service_images3==1 ? " error" : ""); ?>" type="file" name="service_images3" id="service_images3" accept="image/*" />
				<?php } else { ?>
				<div class="fotos foto3">
					<input type="hidden" name="service_images3var" id="service_images3var" value="<?php echo $service_images3; ?>">
					<img src="<?php echo IMAGES . $settings['services_foto_dir'] ."/sm". $service_images3; ?>" alt="<?php echo $locale['522']; ?>">
					<label class="radio" for="service_imgocher3"><input class="radio" type="radio" name="service_imgocher" id="service_imgocher3"<?php echo ($service_images3==$service_imgocher ? " checked" : ""); ?> value="<?php echo $service_images3; ?>"> <?php echo $locale['556']; ?></label>
					<label class="checkbox" for="service_images3sil"><input class="checkbox" value="1" type="checkbox" name="service_images3sil" id="service_images3sil"> <?php echo $locale['557']; ?></label>
				</div>
				<?php } ?>

			</div>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds service_elaveinfo">
				<textarea class="textbox<?php echo ($error_service_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="service_elaveinfo" id="service_elaveinfo"><?php echo $service_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
		</div>

		<div class="bloks blok1">
			<div class="fileds service_ip">
				<label for="service_ip"><?php echo $locale['700']; ?></label>
				<input readonly class="textbox" type="text" name="service_ip" id="service_ip" value="<?php echo $service_ip; ?>" />
			</div>
			<div class="fileds service_today">
				<label for="service_today"><?php echo $locale['701']; ?></label>
				<input readonly class="textbox" type="text" name="service_today" id="service_today" value="<?php echo date("d.m.Y", $service_today); ?>" />
			</div>
			<div class="fileds service_srok">
				<label for="service_srok"><?php echo $locale['702']; ?></label>
				<input readonly class="textbox" type="text" name="service_srok" id="service_srok" value="<?php echo date("d.m.Y", $service_srok); ?>" />
			</div>
			<div class="fileds service_views">
				<label for="service_views"><?php echo $locale['703']; ?></label>
				<input readonly class="textbox" type="text" name="service_views" id="service_views" value="<?php echo $service_views; ?>" />
			</div>
		</div>

		<div class="bloks blok2">
			<div class="fileds service_vip">
				<label for="service_vip"><?php echo $locale['704']; ?></label>
				<select class="select" name="service_vip" id="service_vip">
					<option value="0"<?php echo ($service_vip==0 ? " selected" : ""); ?>><?php echo $locale['vip_0']; ?></option>
					<option value="1"<?php echo ($service_vip==1 ? " selected" : ""); ?>><?php echo $locale['vip_1']; ?></option>
					<option value="2"<?php echo ($service_vip==2 ? " selected" : ""); ?>><?php echo $locale['vip_2']; ?></option>
					<option value="3"<?php echo ($service_vip==3 ? " selected" : ""); ?>><?php echo $locale['vip_3']; ?></option>
					<option value="4"<?php echo ($service_vip==4 ? " selected" : ""); ?>><?php echo $locale['vip_4']; ?></option>
					<option value="5"<?php echo ($service_vip==5 ? " selected" : ""); ?>><?php echo $locale['vip_5']; ?></option>
					<option value="6"<?php echo ($service_vip==6 ? " selected" : ""); ?>><?php echo $locale['vip_6']; ?></option>
				</select>
			</div>
			<div class="fileds service_aktiv">
				<label for="service_aktiv"><?php echo $locale['705']; ?></label>
				<select class="select" name="service_aktiv" id="service_aktiv">
					<option value="0"<?php echo ($service_aktiv==2 ? " selected" : ""); ?>><?php echo $locale['status_0']; ?></option>
					<option value="1"<?php echo ($service_aktiv==1 ? " selected" : ""); ?>><?php echo $locale['status_1']; ?></option>
					<option value="4"<?php echo ($service_aktiv==4 ? " selected" : ""); ?>><?php echo $locale['status_4']; ?></option>
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
			<div class="fileds service_submit">
				<?php if (($_GET['action']=="edit") && ($service_aktiv==2)) { ?>
					<input class="button" value="<?php echo $locale['593']; ?>" type="submit" name="service_submit" id="service_submit" onclick="return(check())" />
				<?php } else { ?>
					<input class="button" value="<?php echo ($_GET['action']=="edit" ? $locale['592'] : $locale['590']); ?>" type="submit" name="service_submit" id="service_submit" onclick="return(check())" />
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
	var ckeditor = CKEDITOR.replace('service_elaveinfo');
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

		$viewcompanent = viewcompanent("service", "name");
		$seourl_component = $viewcompanent['components_id'];

		if ((isset($_GET['order'])) && (isset($_GET['by']))) {
			$order = $_GET['order'];
			$by = $_GET['by'];
		} else {
			$order = "service_id";
			$by = "DESC";
		}

		$result = dbquery("SELECT
									service_id,
									service_name,
									service_imgocher,
									service_today,
									service_aktiv,
									service_vip,
									seourl_url
							FROM ". DB_SERVICES ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=service_id AND seourl_component=". $seourl_component ."
							ORDER BY `". $order ."` ". $by ."
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		echo "<div class='addcar'><a href='". ADMIN ."services.php".  $aidlink ."&action=add'>". $locale['711'] ."</a></div>\n";
		echo "<table class='serviceslist'>\n";
		echo "		<thead>\n";
		echo "				<tr>\n";
		echo "						<td class='service_id'><a href='". ADMIN ."services.php".  $aidlink ."&order=service_id&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['650'] . ($order=="service_id" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='service_images'>". $locale['651'] ."</td>\n";
		echo "						<td class='service_marka'><a href='". ADMIN ."services.php".  $aidlink ."&order=service_name&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['652'] . ($order=="service_name" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='service_vip'><a href='". ADMIN ."services.php".  $aidlink ."&order=service_vip&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['653'] . ($order=="service_vip" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='service_aktiv'><a href='". ADMIN ."services.php".  $aidlink ."&order=service_aktiv&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['654'] . ($order=="service_aktiv" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='service_today'><a href='". ADMIN ."services.php".  $aidlink ."&order=service_today&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['655'] . ($order=="service_today" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='service_href'>". $locale['656'] ."</td>\n";
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
		echo "						<td class='service_id'>#". $data['service_id'] ."</td>\n";
		echo "						<td class='service_images'><a href='". ADMIN ."services.php".  $aidlink ."&action=edit&id=". $data['service_id'] ."'><img src='". (empty($data['service_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_imgocher']) ."' alt=''></a></td>\n";
		echo "						<td class='service_name'><a href='". ADMIN ."services.php".  $aidlink ."&action=edit&id=". $data['service_id'] ."'>". $data['service_name'] ."</a></td>\n";
		echo "						<td class='service_vip'><img src='". IMAGES ."vip_icons/". ($data['service_vip']==0 ? "vip_off.png" : "vip_on.png") ."' alt='". $locale['vip_'. $data['service_vip']] ."' title='". $locale['vip_'. $data['service_vip']] ."'></td>\n";
		echo "						<td class='service_aktiv'><img src='". IMAGES . "status/status_". $data['service_aktiv'] .".png' alt='". $locale['status_'. $data['service_aktiv']] ."' title='". $locale['status_'. $data['service_aktiv']] ."'></td>\n";
		echo "						<td class='service_today'>". date("d.m.Y", $data['service_today']) ."</td>\n";
		echo "						<td class='service_href'>\n";
		echo "							<a class='view' href='". BASEDIR . $data['seourl_url'] ."' target='_blank' title='". $locale['660'] ."'><img src='". IMAGES ."view.png' alt='". $locale['660'] ."'></a>\n";
		echo "							<a class='edit' href='". ADMIN ."services.php".  $aidlink ."&action=edit&id=". $data['service_id'] ."' title='". $locale['661'] ."'><img src='". IMAGES ."edit.png' alt='". $locale['661'] ."'></a>\n";
		echo "							<a class='delete' href='". ADMIN ."services.php".  $aidlink ."&action=delete&id=". $data['service_id'] ."' title='". $locale['662'] ."' onclick='return DeleteOk();'><img src='". IMAGES ."delete.png' alt='". $locale['662'] ."'></a>\n";
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
		echo "						<td class='service_id'>&nbsp;</td>\n";
		echo "						<td class='service_images'>&nbsp;</td>\n";
		echo "						<td class='service_name'>&nbsp;</td>\n";
		echo "						<td class='service_vip'>&nbsp;</td>\n";
		echo "						<td class='service_aktiv'>&nbsp;</td>\n";
		echo "						<td class='service_today'>&nbsp;</td>\n";
		echo "						<td class='service_href'>&nbsp;</td>\n";
		echo "				</tr>\n";
		echo "		</tfoot>\n";
		echo "	</table>\n";


		echo navigation($_GET['page'], $settings['goradmin'], "service_id", DB_SERVICES, "");
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