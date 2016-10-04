<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

session_start();

include LOCALE.LOCALESET."addrentalcars.php";

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

	if ($_POST['rentalcar_rules']) {

		$rentalcar_marka = trim(stripinput(censorwords(substr($_POST['rentalcar_marka'],0,10))));
		$rentalcar_model = trim(stripinput(censorwords(substr($_POST['rentalcar_model'],0,10))));
		$rentalcar_ili = trim(stripinput(censorwords(substr($_POST['rentalcar_ili'],0,4))));
		$rentalcar_qiymeti = trim(stripinput(censorwords(substr($_POST['rentalcar_qiymeti'],0,10))));
		$rentalcar_valyuta = trim(stripinput(censorwords(substr($_POST['rentalcar_valyuta'],0,1))));
		$rentalcar_company = trim(stripinput(censorwords(substr($_POST['rentalcar_company'],0,255))));
		$rentalcar_adi = trim(stripinput(censorwords(substr($_POST['rentalcar_adi'],0,255))));
		$rentalcar_mobiltel = trim(stripinput(censorwords(substr($_POST['rentalcar_mobiltel'],0,100))));
		$rentalcar_mobiltel = str_replace(" ", "", $rentalcar_mobiltel);
		$rentalcar_mobiltel = str_replace("(", "", $rentalcar_mobiltel);
		$rentalcar_mobiltel = str_replace(")", "", $rentalcar_mobiltel);
		$rentalcar_mobiltel = str_replace("-", "", $rentalcar_mobiltel);
		$rentalcar_mobiltel = str_replace("_", "", $rentalcar_mobiltel);
		$rentalcar_tel = trim(stripinput(censorwords(substr($_POST['rentalcar_tel'],0,100))));
		$rentalcar_tel = str_replace(" ", "", $rentalcar_tel);
		$rentalcar_tel = str_replace("(", "", $rentalcar_tel);
		$rentalcar_tel = str_replace(")", "", $rentalcar_tel);
		$rentalcar_tel = str_replace("-", "", $rentalcar_tel);
		$rentalcar_tel = str_replace("_", "", $rentalcar_tel);
		$rentalcar_email = trim(stripinput(censorwords(substr($_POST['rentalcar_email'],0,100))));

		$rentalcar_images1 =  $_FILES['rentalcar_images1']['name'];
		$rentalcar_images1tmp  = $_FILES['rentalcar_images1']['tmp_name'];
		$rentalcar_images1size = $_FILES['rentalcar_images1']['size'];
		$rentalcar_images1type = $_FILES['rentalcar_images1']['type'];

		$rentalcar_images2 =  $_FILES['rentalcar_images2']['name'];
		$rentalcar_images2tmp  = $_FILES['rentalcar_images2']['tmp_name'];
		$rentalcar_images2size = $_FILES['rentalcar_images2']['size'];
		$rentalcar_images2type = $_FILES['rentalcar_images2']['type'];

		$rentalcar_images3 =  $_FILES['rentalcar_images3']['name'];
		$rentalcar_images3tmp  = $_FILES['rentalcar_images3']['tmp_name'];
		$rentalcar_images3size = $_FILES['rentalcar_images3']['size'];
		$rentalcar_images3type = $_FILES['rentalcar_images3']['type'];

		$rentalcar_images4 =  $_FILES['rentalcar_images4']['name'];
		$rentalcar_images4tmp  = $_FILES['rentalcar_images4']['tmp_name'];
		$rentalcar_images4size = $_FILES['rentalcar_images4']['size'];
		$rentalcar_images4type = $_FILES['rentalcar_images4']['type'];

		$rentalcar_images5 =  $_FILES['rentalcar_images5']['name'];
		$rentalcar_images5tmp  = $_FILES['rentalcar_images5']['tmp_name'];
		$rentalcar_images5size = $_FILES['rentalcar_images5']['size'];
		$rentalcar_images5type = $_FILES['rentalcar_images5']['type'];

		$rentalcar_images6 =  $_FILES['rentalcar_images6']['name'];
		$rentalcar_images6tmp  = $_FILES['rentalcar_images6']['tmp_name'];
		$rentalcar_images6size = $_FILES['rentalcar_images6']['size'];
		$rentalcar_images6type = $_FILES['rentalcar_images6']['type'];

		$rentalcar_elaveinfo = trim(stripinput(censorwords(substr($_POST['rentalcar_elaveinfo'],0,1000))));
		$rentalcar_ip = FUSION_IP;
		$rentalcar_today = FUSION_TODAY;
		$rentalcar_views = 1;
		$rentalcar_aktiv = 2;
		$rentalcar_vip = 0;

	} else {

		$rentalcar_marka = "";
		$rentalcar_model = "";
		$rentalcar_ili = "";
		$rentalcar_qiymeti = "";
		$rentalcar_valyuta = "";
		$rentalcar_company = "";
		$rentalcar_adi = "";
		$rentalcar_qorod = "";
		$rentalcar_mobiltel = "+994";
		$rentalcar_tel = "+994";
		$rentalcar_email = "";

		$rentalcar_images1 = "";
		$rentalcar_images2 = "";
		$rentalcar_images3 = "";
		$rentalcar_images4 = "";
		$rentalcar_images5 = "";
		$rentalcar_images6 = "";

		$rentalcar_elaveinfo = "";
		$rentalcar_ip = "";
		$rentalcar_today = "";
		$rentalcar_views = "";
		$rentalcar_aktiv = "";
		$rentalcar_vip = "";

	}

	if ($_POST['rentalcar_rules']) {

		if (empty($rentalcar_marka)) { $error_rentalcar_marka = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
		if (empty($rentalcar_model)) { $error_rentalcar_model = 1; $error .= "<div class='error'>". $locale['error_011'] ."</div>\n"; }
		if (empty($rentalcar_ili)) { $error_rentalcar_ili = 1; $error .= "<div class='error'>". $locale['error_012'] ."</div>\n"; }
		if (empty($rentalcar_qiymeti)) { $error_rentalcar_qiymeti = 1; $error .= "<div class='error'>". $locale['error_013'] ."</div>\n"; }
		if (!empty($rentalcar_qiymeti) && !preg_match("/^([0-9])+$/is", $rentalcar_qiymeti)) { $error_rentalcar_qiymeti = 1; $error .= "<div class='error'>". $locale['error_014'] ."</div>\n"; }
		// if (empty($rentalcar_company)) { $error_rentalcar_company = 1; $error .= "<div class='error'>". $locale['error_015'] ."</div>\n"; }
		if (empty($rentalcar_adi)) { $error_rentalcar_adi = 1; $error .= "<div class='error'>". $locale['error_016'] ."</div>\n"; }
		if (empty($rentalcar_mobiltel)) { $error_rentalcar_mobiltel = 1; $error .= "<div class='error'>". $locale['error_017'] ."</div>\n"; }
		if ($rentalcar_mobiltel=="+994") { $error_rentalcar_mobiltel = 1; $error .= "<div class='error'>". $locale['error_017'] ."</div>\n"; }
		// if (strlen($rentalcar_mobiltel) < 13) { $error_rentalcar_mobiltel = 1; $error .= "<div class='error'>". $locale['error_017'] ."</div>\n"; }
		// if (!empty($rentalcar_mobiltel) && !preg_match("/^([0-9])+$/is", $rentalcar_mobiltel)) { $error_rentalcar_mobiltel = 1; $error .= "<div class='error'>". $locale['error_018'] ."</div>\n"; }
		// if (empty($rentalcar_tel)) { $error_rentalcar_tel = 1; $error .= "<div class='error'>". $locale['error_019'] ."</div>\n"; }
		// if ($rentalcar_tel=="+994") { $error_rentalcar_tel = 1; $error .= "<div class='error'>". $locale['error_019'] ."</div>\n"; }
		// if (strlen($rentalcar_tel) < 13) { $error_rentalcar_tel = 1; $error .= "<div class='error'>". $locale['error_019'] ."</div>\n"; }
		// if (!empty($rentalcar_tel) && !preg_match("/^([0-9])+$/is", $rentalcar_tel)) { $error_rentalcar_tel = 1; $error .= "<div class='error'>". $locale['error_020'] ."</div>\n"; }
		if (!empty($rentalcar_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $rentalcar_email)) { $error_rentalcar_email = 1; $error .= "<div class='error'>". $locale['error_021'] ."</div>\n"; }


		if (empty($rentalcar_images1)) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

		if (!empty($rentalcar_images1)) {
			if (strlen($rentalcar_images1) > 100) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
			// проверяем расширение файла
			$ext1 = strtolower(substr($rentalcar_images1, 1 + strrpos($rentalcar_images1, ".")));
			if (!in_array($ext1, $valid_types)) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka1 = substr_count($rentalcar_images1, ".");
			if ($findtchka1>1) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$rentalcar_images1))  { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
			if (preg_match("/\.html/i",$rentalcar_images1)) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$rentalcar_images1))  { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize1 = round($rentalcar_images1size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax1 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize1>$fotomax1) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize1 ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size1 = getimagesize($rentalcar_images1tmp);
			if ($size1[0]>$settings['foto_x'] or $size1[1]>$settings['foto_y']) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size1[0] ."x". $size1[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size1[0]<$size1[1]) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
			// Foto 0 Kb
			if ($rentalcar_images1size<0 and $rentalcar_images1size>$settings['foto_size']) { $error_rentalcar_images1 = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
		}


		if (!empty($rentalcar_images2)) {
			if (strlen($rentalcar_images2) > 100) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_064'] ."</div>\n"; }
			// проверяем расширение файла
			$ext2 = strtolower(substr($rentalcar_images2, 1 + strrpos($rentalcar_images2, ".")));
			if (!in_array($ext2, $valid_types)) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_065'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka2 = substr_count($rentalcar_images2, ".");
			if ($findtchka2>1) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_066'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$rentalcar_images2))  { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_067'] ."</div>\n"; }
			if (preg_match("/\.html/i",$rentalcar_images2)) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_068'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$rentalcar_images2))  { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_069'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize2 = round($rentalcar_images2size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax2 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize2>$fotomax2) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_070'] ."<br />". $locale['error_057'] ." ". $fotoksize2 ." Kb<br />". $locale['error_058'] ." ". $fotomax2 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size2 = getimagesize($rentalcar_images2tmp);
			if ($size2[0]>$settings['foto_x'] or $size2[1]>$settings['foto_y']) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_071'] ."<br />". $locale['error_060'] ." ". $size2[0] ."x". $size2[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size2[0]<$size2[1]) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_072'] ."</div>\n"; }
			// Foto 0 Kb
			if ($rentalcar_images2size<"0" and $rentalcar_images2size>$settings['foto_size']) { $error_rentalcar_images2 = 1; $error .= "<div class='error'>". $locale['error_073'] ."</div>\n"; }
		}


		if (!empty($rentalcar_images3)) {
			if (strlen($rentalcar_images3) > 100) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_074'] ."</div>\n"; }
			// проверяем расширение файла
			$ext3 = strtolower(substr($rentalcar_images3, 1 + strrpos($rentalcar_images3, ".")));
			if (!in_array($ext3, $valid_types)) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_075'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka3=substr_count($rentalcar_images3, ".");
			if ($findtchka3>1) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_076'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$rentalcar_images3))  { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_077'] ."</div>\n"; }
			if (preg_match("/\.html/i",$rentalcar_images3)) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_078'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$rentalcar_images3))  { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_079'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize3=round($rentalcar_images3size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax3=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize3>$fotomax3) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_080'] ."<br />". $locale['error_057'] ." ". $fotoksize3 ." Kb<br />". $locale['error_058'] ." ". $fotomax3 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size3=getimagesize($rentalcar_images3tmp);
			if ($size3[0]>$settings['foto_x'] or $size3[1]>$settings['foto_y']) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_081'] ."<br />". $locale['error_060'] ." ". $size3[0] ."x". $size3[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size3[0]<$size3[1]) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_082'] ."</div>\n"; }
			// Foto 0 Kb
			if   ($rentalcar_images3size<"0" and $rentalcar_images3size>$settings['foto_size']) { $error_rentalcar_images3 = 1; $error .= "<div class='error'>". $locale['error_083'] ."</div>\n"; }
		}


		if (!empty($rentalcar_images4)) { 
			if (strlen($rentalcar_images4) > 100) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_084'] ."</div>\n"; }
			// проверяем расширение файла
			$ext4 = strtolower(substr($rentalcar_images4, 1 + strrpos($rentalcar_images4, ".")));
			if (!in_array($ext4, $valid_types)) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_085'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka4=substr_count($rentalcar_images4, ".");
			if ($findtchka4>1) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_086'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$rentalcar_images4))  { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_087'] ."</div>\n"; }
			if (preg_match("/\.html/i",$rentalcar_images4)) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_088'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$rentalcar_images4))  { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_089'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize4=round($rentalcar_images4size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax4=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize4>$fotomax4) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_090'] ."<br />". $locale['error_057'] ." ". $fotoksize4 ." Kb<br />". $locale['error_058'] ." ". $fotomax4 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size4=getimagesize($rentalcar_images4tmp);
			if ($size4[0]>$settings['foto_x'] or $size4[1]>$settings['foto_y']) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_091'] ."<br />". $locale['error_060'] ." ". $size4[0] ."x". $size4[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size4[0]<$size4[1]) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_092'] ."</div>\n"; }
			// Foto 0 Kb
			if   ($rentalcar_images4size<"0" and $rentalcar_images4size>$settings['foto_size']) { $error_rentalcar_images4 = 1; $error .= "<div class='error'>". $locale['error_093'] ."</div>\n"; }
		}


		if (!empty($rentalcar_images5)) { 
			if (strlen($rentalcar_images5) > 100) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_094'] ."</div>\n"; }
			// проверяем расширение файла
			$ext5 = strtolower(substr($rentalcar_images5, 1 + strrpos($rentalcar_images5, ".")));
			if (!in_array($ext5, $valid_types)) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_095'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka5=substr_count($rentalcar_images5, ".");
			if ($findtchka5>1) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_096'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$rentalcar_images5))  { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_097'] ."</div>\n"; }
			if (preg_match("/\.html/i",$rentalcar_images5)) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_098'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$rentalcar_images5))  { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_099'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize5=round($rentalcar_images5size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax5=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize5>$fotomax5) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_100'] ."<br />". $locale['error_057'] ." ". $fotoksize5 ." Kb<br />". $locale['error_058'] ." ". $fotomax5 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size5=getimagesize($rentalcar_images5tmp);
			if ($size5[0]>$settings['foto_x'] or $size5[1]>$settings['foto_y']) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_101'] ."<br />". $locale['error_060'] ." ". $size5[0] ."x". $size5[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size5[0]<$size5[1]) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_102'] ."</div>\n"; }
			// Foto 0 Kb
			if ($rentalcar_images5size<"0" and $rentalcar_images5size>$settings['foto_size']) { $error_rentalcar_images5 = 1; $error .= "<div class='error'>". $locale['error_103'] ."</div>\n"; }
		}


		if (!empty($rentalcar_images6)) {
			if (strlen($rentalcar_images6) > 100) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_104'] ."</div>\n"; }
			// проверяем расширение файла
			$ext6 = strtolower(substr($rentalcar_images6, 1 + strrpos($rentalcar_images6, ".")));
			if (!in_array($ext6, $valid_types)) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_105'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka6=substr_count($rentalcar_images6, ".");
			if ($findtchka6>1) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_106'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$rentalcar_images6))  { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_107'] ."</div>\n"; }
			if (preg_match("/\.html/i",$rentalcar_images6)) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_108'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$rentalcar_images6))  { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_109'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize6=round($rentalcar_images6size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax6=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($rentalcar_fotoksize6>$fotomax6) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_110'] ."<br />". $locale['error_057'] ." ". $fotoksize6 ." Kb<br />". $locale['error_058'] ." ". $fotomax6 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size6=getimagesize($rentalcar_images6tmp);
			if ($size6[0]>$settings['foto_x'] or $size6[1]>$settings['foto_y']) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_111'] ."<br />". $locale['error_060'] ." ". $size6[0] ."x". $size6[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size6[0]<$size6[1]) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_112'] ."</div>\n"; }
			// Foto 0 Kb
			if ($rentalcar_images6size<"0" and $rentalcar_images6size>$settings['foto_size']) { $error_rentalcar_images6 = 1; $error .= "<div class='error'>". $locale['error_113'] ."</div>\n"; }
		}


		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);

			if (!empty($rentalcar_images1)) {
				$rentalcar_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
				$rentalcar_images1namerl = "rl". $rentalcar_images1name;
				$rentalcar_images1namesm = "sm". $rentalcar_images1name;
				copy($rentalcar_images1tmp, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images1name);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images1name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images1name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images1name);
			}

			if (!empty($rentalcar_images2)) {
				$rentalcar_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
				$rentalcar_images2namerl = "rl". $rentalcar_images2name;
				$rentalcar_images2namesm = "sm". $rentalcar_images2name;
				copy($rentalcar_images2tmp, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images2name);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images2name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images2name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images2name);
			}

			if (!empty($rentalcar_images3)) {
				$rentalcar_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
				$rentalcar_images3namerl = "rl". $rentalcar_images3name;
				$rentalcar_images3namesm = "sm". $rentalcar_images3name;
				copy($rentalcar_images3tmp, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images3name);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images3name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images3name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images3name);
			}

			if (!empty($rentalcar_images4)) {
				$rentalcar_images4name = FUSION_TODAY . $img_rand_key ."_4.jpg";
				$rentalcar_images4namerl = "rl". $rentalcar_images4name;
				$rentalcar_images4namesm = "sm". $rentalcar_images4name;
				copy($rentalcar_images4tmp, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images4name);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images4name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images4namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images4name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images4namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images4name);
			}

			if (!empty($rentalcar_images5)) {
				$rentalcar_images5name = FUSION_TODAY . $img_rand_key ."_5.jpg";
				$rentalcar_images5namerl = "rl". $rentalcar_images5name;
				$rentalcar_images5namesm = "sm". $rentalcar_images5name;
				copy($rentalcar_images5tmp, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images5name);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images5name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images5namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images5name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images5namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images5name);
			}

			if (!empty($rentalcar_images6)) {
				$rentalcar_images6name = FUSION_TODAY . $img_rand_key ."_6.jpg";
				$rentalcar_images6namerl = "rl". $rentalcar_images6name;
				$rentalcar_images6namesm = "sm". $rentalcar_images6name;
				copy($rentalcar_images6tmp, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images6name);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images6name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images6namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images6name, IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images6namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['rentalcars_foto_dir'] ."/". $rentalcar_images6name);
			}



			### INSERT rentalcarS BEGIN
			$rentalcar_imgocher = $rentalcar_images1name;
			if ($rentalcar_tel=="+994") { $rentalcar_tel=""; }
			
			$result = dbquery(
				"INSERT INTO ". DB_RENTALCARS ." (
												rentalcar_marka,
												rentalcar_model,
												rentalcar_ili,
												rentalcar_qiymeti,
												rentalcar_valyuta,
												rentalcar_company,
												rentalcar_adi,
												rentalcar_mobiltel,
												rentalcar_tel,
												rentalcar_email,
												rentalcar_images1,
												rentalcar_images2,
												rentalcar_images3,
												rentalcar_images4,
												rentalcar_images5,
												rentalcar_images6,
												rentalcar_imgocher,
												rentalcar_elaveinfo,
												rentalcar_ip,
												rentalcar_today,
												rentalcar_views,
												rentalcar_aktiv,
												rentalcar_vip
				) VALUES (
												'". $rentalcar_marka ."',
												'". $rentalcar_model ."',
												'". $rentalcar_ili ."',
												'". $rentalcar_qiymeti ."',
												'". $rentalcar_valyuta ."',
												'". $rentalcar_company ."',
												'". $rentalcar_adi ."',
												'". $rentalcar_mobiltel ."',
												'". $rentalcar_tel ."',
												'". $rentalcar_email ."',
												'". $rentalcar_images1name ."',
												'". $rentalcar_images2name ."',
												'". $rentalcar_images3name ."',
												'". $rentalcar_images4name ."',
												'". $rentalcar_images5name ."',
												'". $rentalcar_images6name ."',
												'". $rentalcar_imgocher ."',
												'". $rentalcar_elaveinfo ."',
												'". $rentalcar_ip ."',
												'". $rentalcar_today ."',
												'". $rentalcar_views ."',
												'". $rentalcar_aktiv ."',
												'". $rentalcar_vip ."'

				)"
			);
			// $rentalcar_id = mysql_insert_id();
			$rentalcar_id = _DB::$linkes->insert_id;
			### INSERT rentalcarS END


			### INSERT SEOURL BEGIN
			$seourl_url = "rentalcar". $rentalcar_id .".php";
			$viewcompanent = viewcompanent("rentalcar", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = $rentalcar_id;

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
			$viewcompanent = viewcompanent("rentalcar", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $rentalcar_id;
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

				$result_marka = dbquery("SELECT marka_name FROM ". DB_MARKA ." WHERE marka_id='". $rentalcar_marka ."'");
				if (dbrows($result_marka)) {
					$data_marka = dbarray($result_marka);
				}

				$result_model = dbquery("SELECT model_name FROM ". DB_MODEL ." WHERE model_id='". $rentalcar_model ."'");
				if (dbrows($result_model)) {
					$data_model = dbarray($result_model);
				}

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "<table border='0' width='100%'>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_010'] ."</b></td><td>". date("d.m.Y H:i:s", $rentalcar_today) ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_011'] ."</b></td><td>". $rentalcar_id ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_012'] ."</b></td><td>". $data_marka['marka_name'] ." - ". $data_model['model_name'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_013'] ."</b></td><td>". $rentalcar_adi ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_014'] ."</b></td><td>". $rentalcar_mobiltel ."</td>\n</tr>\n";
				if (!empty($rentalcar_tel))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_015'] ."</b></td><td>". $rentalcar_tel ."</td>\n</tr>\n"; }
				if (!empty($rentalcar_email))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_016'] ."</b></td><td>". $rentalcar_email ."</td>\n</tr>\n"; }
				if (!empty($rentalcar_elaveinfo)){ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_017'] ."</b></td><td>". $rentalcar_elaveinfo ."</td>\n</tr>\n"; }
				$allmsg .= "<tr>\n<td colspan='2'> </td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>---</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['sitename'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteurl'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteemail'] ."</td>\n</tr>\n";
				$allmsg .= "</table>\n";

				// Отправляем письмо майлеру
				mail($settings['siteemail'], $rentalcar_adi ." ". $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END


			$result_alter = dbquery("ALTER TABLE `". DB_RENTALCARS ."` ORDER BY `rentalcar_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

			echo "<div class='success'>". $locale['success_001'] ."<b>". $rentalcar_id ."</b></div>\n";

			// gormek
			$gormek = 1;
			// gormek

			unset($rentalcar_marka);
			unset($rentalcar_model);
			unset($rentalcar_ili);
			unset($rentalcar_qiymeti);
			unset($rentalcar_valyuta);
			unset($rentalcar_company);
			unset($rentalcar_adi);
			unset($rentalcar_mobiltel);
			unset($rentalcar_tel);
			unset($rentalcar_email);
			unset($rentalcar_images1);
			unset($rentalcar_images2);
			unset($rentalcar_images3);
			unset($rentalcar_images4);
			unset($rentalcar_images5);
			unset($rentalcar_images6);
			unset($rentalcar_elaveinfo);
			unset($rentalcar_ip);
			unset($rentalcar_today);
			unset($rentalcar_views);
			unset($rentalcar_aktiv);
			unset($rentalcar_vip);

		} // Yesli Error Yest
	} // Yesli POST

	if ($gormek!=1) {
?>



<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#rentalcar_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#rentalcar_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addcar" id="addcar" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
	<div class="addrentalcars">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds rentalcar_marka">
				<label for="rentalcar_marka"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_rentalcar_marka==1 ? " error" : ""); ?>" name="rentalcar_marka" id="rentalcar_marka" onchange="dynamicSelect('rentalcar_marka','rentalcar_model');">
					<option value=""<?php echo ($rentalcar_marka=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
	<?php
		$result = dbquery("SELECT
									marka_id,
									marka_name
							FROM ". DB_MARKA ."
							ORDER BY `marka_name`");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
	?>
					<option value="<?php echo $data['marka_id']; ?>"<?php echo ($data['marka_id']==$rentalcar_marka ? " selected" : ""); ?>><?php echo $data['marka_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
				</select>
			</div>
			<div class="fileds rentalcar_model">
				<label for="rentalcar_model"><?php echo $locale['511']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_rentalcar_model==1 ? " error" : ""); ?>" name="rentalcar_model" id="rentalcar_model">
					<option value=""<?php echo ($rentalcar_model=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
	<?php
		$result = dbquery("SELECT
									model_id,
									model_name,
									model_marka_id
							FROM ". DB_MODEL ."
							ORDER BY `model_name`");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
	?>
					<option class="<?php echo $data['model_marka_id']; ?>" value="<?php echo $data['model_id']; ?>"<?php echo ($data['model_id']==$rentalcar_model ? " selected" : ""); ?>><?php echo $data['model_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
				</select>
				<script type="text/javascript">
					<!--
					dynamicSelect('rentalcar_marka','rentalcar_model');
					-->
				</script>
			</div>
			<div class="fileds rentalcar_ili">
				<label for="rentalcar_ili"><?php echo $locale['512']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_rentalcar_ili==1 ? " error" : ""); ?>" name="rentalcar_ili" id="rentalcar_ili">
					<option value=""<?php echo ($rentalcar_ili=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
	<?php
		$yaeril1 = date('Y')+1;
		$yaeril2 = $yaeril1-60;
		for ($yi = $yaeril1; $yi >= $yaeril2; $yi--) {
	?>
					<option value="<?php echo $yi; ?>"<?php echo ($yi==$rentalcar_ili ? " selected" : ""); ?>><?php echo $yi; ?></option>
	<?php
		} // for
	?>
				</select>
			</div>
			<div class="fileds rentalcar_qiymeti">
				<label for="rentalcar_qiymeti"><?php echo $locale['513']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_qiymeti==1 ? " error" : ""); ?>" type="text" maxlength="10" name="rentalcar_qiymeti" id="rentalcar_qiymeti" value="<?php echo $rentalcar_qiymeti; ?>" />
				<select class="select<?php echo ($error_rentalcar_valyuta==1 ? " error" : ""); ?>" name="rentalcar_valyuta" id="rentalcar_valyuta">
					<option value="1"<?php echo ($rentalcar_valyuta==1 ? " selected" : ""); ?>><?php echo $locale['valyuta_1']; ?></option>
					<option value="2"<?php echo ($rentalcar_valyuta==2 ? " selected" : ""); ?>><?php echo $locale['valyuta_2']; ?></option>
					<option value="3"<?php echo ($rentalcar_valyuta==3 ? " selected" : ""); ?>><?php echo $locale['valyuta_3']; ?></option>
				</select>
			</div>
			<div class="fileds rentalcar_company">
				<label for="rentalcar_company"><?php echo $locale['514']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_company==1 ? " error" : ""); ?>" type="text" maxlength="255" name="rentalcar_company" id="rentalcar_company" value="<?php echo $rentalcar_company; ?>" />
			</div>
			<div class="fileds rentalcar_adi">
				<label for="rentalcar_adi"><?php echo $locale['515']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_adi==1 ? " error" : ""); ?>" type="text" maxlength="255" name="rentalcar_adi" id="rentalcar_adi" value="<?php echo $rentalcar_adi; ?>" />
			</div>
			<div class="fileds rentalcar_mobiltel">
				<label for="rentalcar_mobiltel"><?php echo $locale['516']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_mobiltel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="rentalcar_mobiltel" id="rentalcar_mobiltel" value="<?php echo $rentalcar_mobiltel; ?>" />
			</div>
			<div class="fileds rentalcar_tel">
				<label for="rentalcar_tel"><?php echo $locale['517']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="rentalcar_tel" id="rentalcar_tel" value="<?php echo $rentalcar_tel; ?>" />
			</div>
			<div class="fileds rentalcar_email">
				<label for="rentalcar_email"><?php echo $locale['518']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="rentalcar_email" id="rentalcar_email" value="<?php echo $rentalcar_email; ?>" />
				<?php echo $locale['519']; ?>
			</div>
			<div class="hr"></div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds rentalcar_images">
				<label for="rentalcar_images1"><?php echo $locale['530']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_images1==1 ? " error" : ""); ?>" type="file" name="rentalcar_images1" id="rentalcar_images1" accept="image/*" />
				<label for="rentalcar_images2"><?php echo $locale['531']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_images2==1 ? " error" : ""); ?>" type="file" name="rentalcar_images2" id="rentalcar_images2" accept="image/*" />
				<label for="rentalcar_images3"><?php echo $locale['532']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_images3==1 ? " error" : ""); ?>" type="file" name="rentalcar_images3" id="rentalcar_images3" accept="image/*" />
				<label for="rentalcar_images4"><?php echo $locale['533']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_images4==1 ? " error" : ""); ?>" type="file" name="rentalcar_images4" id="rentalcar_images4" accept="image/*" />
				<label for="rentalcar_images5"><?php echo $locale['534']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_images5==1 ? " error" : ""); ?>" type="file" name="rentalcar_images5" id="rentalcar_images5" accept="image/*" />
				<label for="rentalcar_images6"><?php echo $locale['535']; ?></label>
				<input class="textbox<?php echo ($error_rentalcar_images6==1 ? " error" : ""); ?>" type="file" name="rentalcar_images6" id="rentalcar_images6" accept="image/*" />
			</div>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds rentalcar_elaveinfo">
				<textarea class="textbox<?php echo ($error_rentalcar_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="rentalcar_elaveinfo" id="rentalcar_elaveinfo"><?php echo $rentalcar_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
			<div class="fileds rentalcar_submit">
				<a href="#" onclick="document.getElementById('qayda').style.display='block'; return false"><?php echo $locale['591']; ?></a>
				<input class="checkbox" type="checkbox" value="rules" name="rentalcar_rules" id="#rentalcar_rules" onclick="this.form.rentalcar_submit.disabled=!this.form.rentalcar_rules.checked" />
				<input disabled class="button" value="<?php echo $locale['590']; ?>" type="submit" name="rentalcar_submit" id="rentalcar_submit" onclick="return(check())" />
			</div>
			<div class="fileds rentalcar_qayda" id="qayda" style="display:none;">
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