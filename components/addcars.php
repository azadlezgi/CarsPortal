<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

session_start();

include LOCALE.LOCALESET."addcars.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
	echo "		<li><a href='". BASEDIR ."cars/'>". $locale['641'] ."</a></li>\n";
	echo "		<li><span>". $locale['642'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($locale['h1']);

	if ($_POST['cars_rules']) {

		$cars_marka = trim(stripinput(censorwords(substr($_POST['cars_marka'],0,10))));
		$cars_model = trim(stripinput(censorwords(substr($_POST['cars_model'],0,10))));
		$cars_ili = trim(stripinput(censorwords(substr($_POST['cars_ili'],0,4))));
		$cars_veziyyet = trim(stripinput(censorwords(substr($_POST['cars_veziyyet'],0,1))));
		$cars_yurush = trim(stripinput(censorwords(substr($_POST['cars_yurush'],0,15))));
		$cars_oiltip = trim(stripinput(censorwords(substr($_POST['cars_oiltip'],0,1))));
		$cars_motorobyom = trim(stripinput(censorwords(substr($_POST['cars_motorobyom'],0,5))));
		$cars_motorguc = trim(stripinput(censorwords(substr($_POST['cars_motorguc'],0,5))));
		$cars_gedenteker = trim(stripinput(censorwords(substr($_POST['cars_gedenteker'],0,1))));
		$cars_karopka = trim(stripinput(censorwords(substr($_POST['cars_karopka'],0,1))));
		$cars_kuzareng = trim(stripinput(censorwords(substr($_POST['cars_kuzareng'],0,2))));
		$cars_salonreng = trim(stripinput(censorwords(substr($_POST['cars_salonreng'],0,2))));
		$cars_kuzarengmet = trim(stripinput(censorwords(substr($_POST['cars_kuzarengmet'],0,1))));
		$cars_ban = trim(stripinput(censorwords(substr($_POST['cars_ban'],0,1))));
		$cars_kuza = trim(stripinput(censorwords(substr($_POST['cars_kuza'],0,10))));


		$cars_images1 =  $_FILES['cars_images1']['name'];
		$cars_images1tmp  = $_FILES['cars_images1']['tmp_name'];
		$cars_images1size = $_FILES['cars_images1']['size'];
		$cars_images1type = $_FILES['cars_images1']['type'];

		$cars_images2 =  $_FILES['cars_images2']['name'];
		$cars_images2tmp  = $_FILES['cars_images2']['tmp_name'];
		$cars_images2size = $_FILES['cars_images2']['size'];
		$cars_images2type = $_FILES['cars_images2']['type'];

		$cars_images3 =  $_FILES['cars_images3']['name'];
		$cars_images3tmp  = $_FILES['cars_images3']['tmp_name'];
		$cars_images3size = $_FILES['cars_images3']['size'];
		$cars_images3type = $_FILES['cars_images3']['type'];

		$cars_images4 =  $_FILES['cars_images4']['name'];
		$cars_images4tmp  = $_FILES['cars_images4']['tmp_name'];
		$cars_images4size = $_FILES['cars_images4']['size'];
		$cars_images4type = $_FILES['cars_images4']['type'];

		$cars_images5 =  $_FILES['cars_images5']['name'];
		$cars_images5tmp  = $_FILES['cars_images5']['tmp_name'];
		$cars_images5size = $_FILES['cars_images5']['size'];
		$cars_images5type = $_FILES['cars_images5']['type'];

		$cars_images6 =  $_FILES['cars_images6']['name'];
		$cars_images6tmp  = $_FILES['cars_images6']['tmp_name'];
		$cars_images6size = $_FILES['cars_images6']['size'];
		$cars_images6type = $_FILES['cars_images6']['type'];

		$cars_qiymeti = trim(stripinput(censorwords(substr($_POST['cars_qiymeti'],0,10))));
		$cars_valyuta = trim(stripinput(censorwords(substr($_POST['cars_valyuta'],0,1))));
		$cars_kredit = trim(stripinput(censorwords(substr($_POST['cars_kredit'],0,1))));
		$cars_bank = trim(stripinput(censorwords(substr($_POST['cars_bank'],0,2))));
		$cars_ilkodenish = trim(stripinput(censorwords(substr($_POST['cars_ilkodenish'],0,10))));
		$cars_krvalyuta = trim(stripinput(censorwords(substr($_POST['cars_krvalyuta'],0,1))));
		$cars_muddet = trim(stripinput(censorwords(substr($_POST['cars_muddet'],0,2))));
		$cars_ayliqodenish = trim(stripinput(censorwords(substr($_POST['cars_ayliqodenish'],0,10))));
		$cars_qodovoy = trim(stripinput(censorwords(substr($_POST['cars_qodovoy'],0,10))));
		$cars_salon_id_chek = trim(stripinput(censorwords(substr($_POST['cars_salon_id_chek'],0,1))));
		$cars_salon_id = trim(stripinput(censorwords(substr($_POST['cars_salon_id'],0,10))));
		$cars_adi = trim(stripinput(censorwords(substr($_POST['cars_adi'],0,100))));
		$cars_qorod = trim(stripinput(censorwords(substr($_POST['cars_qorod'],0,10))));
		$cars_mobiltel = trim(stripinput(censorwords(substr($_POST['cars_mobiltel'],0,100))));
		$cars_mobiltel = str_replace(" ", "", $cars_mobiltel);
		$cars_mobiltel = str_replace("(", "", $cars_mobiltel);
		$cars_mobiltel = str_replace(")", "", $cars_mobiltel);
		$cars_mobiltel = str_replace("-", "", $cars_mobiltel);
		$cars_mobiltel = str_replace("_", "", $cars_mobiltel);
		$cars_tel = trim(stripinput(censorwords(substr($_POST['cars_tel'],0,100))));
		$cars_tel = str_replace(" ", "", $cars_tel);
		$cars_tel = str_replace("(", "", $cars_tel);
		$cars_tel = str_replace(")", "", $cars_tel);
		$cars_tel = str_replace("-", "", $cars_tel);
		$cars_tel = str_replace("_", "", $cars_tel);
		$cars_email = trim(stripinput(censorwords(substr($_POST['cars_email'],0,100))));
		$cars_komplekt = stripinput(censorwords($_POST['cars_komplekt']));
		$cars_desc_text = trim(stripinput(censorwords(substr($_POST['cars_desc_text'],0,1000))));
		$cars_ip = FUSION_IP;
		$cars_today = FUSION_TODAY;
		$cars_views = 1;
		$cars_aktiv = 2;
		$cars_vip = 0;

	} else {

		$cars_marka = "";
		$cars_model = "";
		$cars_ili = "";
		$cars_veziyyet = 2;
		$cars_yurush = "";
		$cars_oiltip = "";
		$cars_motorobyom = "";
		$cars_motorguc = "";
		$cars_gedenteker = "";
		$cars_karopka = "";
		$cars_kuzareng = "";
		$cars_salonreng = "";
		$cars_kuzarengmet = "";
		$cars_ban = "";
		$cars_kuza = "";
		$cars_images1 = "";
		$cars_images2 = "";
		$cars_images3 = "";
		$cars_images4 = "";
		$cars_images5 = "";
		$cars_images6 = "";
		$cars_qiymeti = "";
		$cars_valyuta = "";
		$cars_kredit = "";
		$cars_bank = "";
		$cars_ilkodenish = "";
		$cars_krvalyuta = "";
		$cars_muddet = "";
		$cars_ayliqodenish = "";
		$cars_qodovoy = "";
		$cars_salon_id_chek = "";
		$cars_salon_id = "";
		$cars_adi = "";
		$cars_qorod = "";
		$cars_mobiltel = "+994";
		$cars_tel = "+994";
		$cars_email = "";
		$cars_komplekt = "";
		$cars_desc_text = "";
		$cars_ip = "";
		$cars_today = "";
		$cars_views = "";
		$cars_aktiv = "";
		$cars_vip = "";

	}

	if ($_POST['cars_rules']) {

		if (empty($cars_marka)) { $error_cars_marka = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
		if (empty($cars_model)) { $error_cars_model = 1; $error .= "<div class='error'>". $locale['error_011'] ."</div>\n"; }

		if (empty($cars_ili)) { $error_cars_ili = 1; $error .= "<div class='error'>". $locale['error_020'] ."</div>\n"; }
		if (empty($cars_veziyyet)) { $error_cars_veziyyet = 1; $error .= "<div class='error'>". $locale['error_021'] ."</div>\n"; }
		if ($cars_yurush=="") { $error_cars_yurush = 1; $error .= "<div class='error'>". $locale['error_022'] ."</div>\n"; }
		if ($cars_yurush!="" && !preg_match("/^([0-9])+$/is", $cars_yurush)) { $error_cars_yurush = 1; $error .= "<div class='error'>". $locale['error_023'] ."</div>\n"; }


		if (empty($cars_oiltip)) { $error_cars_oiltip = 1; $error .= "<div class='error'>". $locale['error_030'] ."</div>\n"; }
		if ($cars_motorobyom=="") { $error_cars_motorobyom = 1; $error .= "<div class='error'>". $locale['error_031'] ."</div>\n"; }
		if ($cars_motorobyom!="" && !preg_match("/^([0-9])+$/is", $cars_motorobyom)) { $error_cars_motorobyom = 1; $error .= "<div class='error'>". $locale['error_032'] ."</div>\n"; }
		if ($cars_motorguc=="") { $error_cars_motorguc = 1; $error .= "<div class='error'>". $locale['error_033'] ."</div>\n"; }
		if ($cars_motorguc!="" && !preg_match("/^([0-9])+$/is", $cars_motorguc)) { $error_cars_motorguc = 1; $error .= "<div class='error'>". $locale['error_034'] ."</div>\n"; }
		if (empty($cars_gedenteker)) { $error_cars_gedenteker = 1; $error .= "<div class='error'>". $locale['error_035'] ."</div>\n"; }
		if (empty($cars_karopka)) { $error_cars_karopka = 1; $error .= "<div class='error'>". $locale['error_036'] ."</div>\n"; }

		if (empty($cars_kuzareng)) { $error_cars_kuzareng = 1; $error .= "<div class='error'>". $locale['error_040'] ."</div>\n"; }
		if (empty($cars_salonreng)) { $error_cars_salonreng = 1; $error .= "<div class='error'>". $locale['error_041'] ."</div>\n"; }
		if (empty($cars_ban)) { $error_cars_ban = 1; $error .= "<div class='error'>". $locale['error_042'] ."</div>\n"; }
		if (empty($cars_kuza)) { $error_cars_kuza = 1; $error .= "<div class='error'>". $locale['error_043'] ."</div>\n"; }


		if (empty($cars_images1)) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

		$valid_types=array("gif","jpg","png","jpeg");  // допустимые расширения

		if (!empty($cars_images1)) {
			if (strlen($cars_images1) > 100) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
			// проверяем расширение файла
			$ext1 = strtolower(substr($cars_images1, 1 + strrpos($cars_images1, ".")));
			if (!in_array($ext1, $valid_types)) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka1 = substr_count($cars_images1, ".");
			if ($findtchka1>1) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$cars_images1))  { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
			if (preg_match("/\.html/i",$cars_images1)) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$cars_images1))  { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize1 = round($cars_images1size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax1 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize1>$fotomax1) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $fotoksize1 ." Kb<br />". $locale['error_058'] ." ". $fotomax1 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size1 = getimagesize($cars_images1tmp);
			if ($size1[0]>$settings['foto_x'] or $size1[1]>$settings['foto_y']) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $size1[0] ."x". $size1[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size1[0]<$size1[1]) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
			// Foto 0 Kb
			if ($cars_images1size<0 and $cars_images1size>$settings['foto_size']) { $error_cars_images1 = 1; $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
		}


		if (!empty($cars_images2)) {
			if (strlen($cars_images2) > 100) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_064'] ."</div>\n"; }
			// проверяем расширение файла
			$ext2 = strtolower(substr($cars_images2, 1 + strrpos($cars_images2, ".")));
			if (!in_array($ext2, $valid_types)) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_065'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka2 = substr_count($cars_images2, ".");
			if ($findtchka2>1) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_066'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$cars_images2))  { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_067'] ."</div>\n"; }
			if (preg_match("/\.html/i",$cars_images2)) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_068'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$cars_images2))  { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_069'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize2 = round($cars_images2size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax2 = round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize2>$fotomax2) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_070'] ."<br />". $locale['error_057'] ." ". $fotoksize2 ." Kb<br />". $locale['error_058'] ." ". $fotomax2 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size2 = getimagesize($cars_images2tmp);
			if ($size2[0]>$settings['foto_x'] or $size2[1]>$settings['foto_y']) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_071'] ."<br />". $locale['error_060'] ." ". $size2[0] ."x". $size2[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size2[0]<$size2[1]) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_072'] ."</div>\n"; }
			// Foto 0 Kb
			if ($cars_images2size<"0" and $cars_images2size>$settings['foto_size']) { $error_cars_images2 = 1; $error .= "<div class='error'>". $locale['error_073'] ."</div>\n"; }
		}


		if (!empty($cars_images3)) {
			if (strlen($cars_images3) > 100) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_074'] ."</div>\n"; }
			// проверяем расширение файла
			$ext3 = strtolower(substr($cars_images3, 1 + strrpos($cars_images3, ".")));
			if (!in_array($ext3, $valid_types)) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_075'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka3=substr_count($cars_images3, ".");
			if ($findtchka3>1) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_076'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$cars_images3))  { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_077'] ."</div>\n"; }
			if (preg_match("/\.html/i",$cars_images3)) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_078'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$cars_images3))  { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_079'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize3=round($cars_images3size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax3=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize3>$fotomax3) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_080'] ."<br />". $locale['error_057'] ." ". $fotoksize3 ." Kb<br />". $locale['error_058'] ." ". $fotomax3 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size3=getimagesize($cars_images3tmp);
			if ($size3[0]>$settings['foto_x'] or $size3[1]>$settings['foto_y']) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_081'] ."<br />". $locale['error_060'] ." ". $size3[0] ."x". $size3[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size3[0]<$size3[1]) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_082'] ."</div>\n"; }
			// Foto 0 Kb
			if   ($cars_images3size<"0" and $cars_images3size>$settings['foto_size']) { $error_cars_images3 = 1; $error .= "<div class='error'>". $locale['error_083'] ."</div>\n"; }
		}


		if (!empty($cars_images4)) { 
			if (strlen($cars_images4) > 100) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_084'] ."</div>\n"; }
			// проверяем расширение файла
			$ext4 = strtolower(substr($cars_images4, 1 + strrpos($cars_images4, ".")));
			if (!in_array($ext4, $valid_types)) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_085'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka4=substr_count($cars_images4, ".");
			if ($findtchka4>1) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_086'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$cars_images4))  { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_087'] ."</div>\n"; }
			if (preg_match("/\.html/i",$cars_images4)) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_088'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$cars_images4))  { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_089'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize4=round($cars_images4size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax4=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize4>$fotomax4) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_090'] ."<br />". $locale['error_057'] ." ". $fotoksize4 ." Kb<br />". $locale['error_058'] ." ". $fotomax4 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size4=getimagesize($cars_images4tmp);
			if ($size4[0]>$settings['foto_x'] or $size4[1]>$settings['foto_y']) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_091'] ."<br />". $locale['error_060'] ." ". $size4[0] ."x". $size4[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size4[0]<$size4[1]) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_092'] ."</div>\n"; }
			// Foto 0 Kb
			if   ($cars_images4size<"0" and $cars_images4size>$settings['foto_size']) { $error_cars_images4 = 1; $error .= "<div class='error'>". $locale['error_093'] ."</div>\n"; }
		}


		if (!empty($cars_images5)) { 
			if (strlen($cars_images5) > 100) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_094'] ."</div>\n"; }
			// проверяем расширение файла
			$ext5 = strtolower(substr($cars_images5, 1 + strrpos($cars_images5, ".")));
			if (!in_array($ext5, $valid_types)) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_095'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka5=substr_count($cars_images5, ".");
			if ($findtchka5>1) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_096'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$cars_images5))  { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_097'] ."</div>\n"; }
			if (preg_match("/\.html/i",$cars_images5)) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_098'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$cars_images5))  { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_099'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize5=round($cars_images5size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax5=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($fotoksize5>$fotomax5) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_100'] ."<br />". $locale['error_057'] ." ". $fotoksize5 ." Kb<br />". $locale['error_058'] ." ". $fotomax5 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size5=getimagesize($cars_images5tmp);
			if ($size5[0]>$settings['foto_x'] or $size5[1]>$settings['foto_y']) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_101'] ."<br />". $locale['error_060'] ." ". $size5[0] ."x". $size5[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size5[0]<$size5[1]) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_102'] ."</div>\n"; }
			// Foto 0 Kb
			if ($cars_images5size<"0" and $cars_images5size>$settings['foto_size']) { $error_cars_images5 = 1; $error .= "<div class='error'>". $locale['error_103'] ."</div>\n"; }
		}


		if (!empty($cars_images6)) {
			if (strlen($cars_images6) > 100) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_104'] ."</div>\n"; }
			// проверяем расширение файла
			$ext6 = strtolower(substr($cars_images6, 1 + strrpos($cars_images6, ".")));
			if (!in_array($ext6, $valid_types)) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_105'] ."</div>\n"; }
			// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
			$findtchka6=substr_count($cars_images6, ".");
			if ($findtchka6>1) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_106'] ."</div>\n"; }
			// 2. если в имени есть .php, .html, .htm - свободен! 
			if (preg_match("/\.php/i",$cars_images6))  { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_107'] ."</div>\n"; }
			if (preg_match("/\.html/i",$cars_images6)) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_108'] ."</div>\n"; }
			if (preg_match("/\.htm/i",$cars_images6))  { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_109'] ."</div>\n"; }
			// 5. Размер фото
			$fotoksize6=round($cars_images6size/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
			$fotomax6=round($settings['foto_size']/10.24)/100; // максимальный размер фото в Кб.
			if ($cars_fotoksize6>$fotomax6) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_110'] ."<br />". $locale['error_057'] ." ". $fotoksize6 ." Kb<br />". $locale['error_058'] ." ". $fotomax6 ." Kb</div>\n"; }
			// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
			$size6=getimagesize($cars_images6tmp);
			if ($size6[0]>$settings['foto_x'] or $size6[1]>$settings['foto_y']) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_111'] ."<br />". $locale['error_060'] ." ". $size6[0] ."x". $size6[1] ."<br />". $locale['error_061'] ." ". $settings['foto_x'] ."x". $settings['foto_y'] ."</div>\n"; }
			//if ($size6[0]<$size6[1]) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_112'] ."</div>\n"; }
			// Foto 0 Kb
			if ($cars_images6size<"0" and $cars_images6size>$settings['foto_size']) { $error_cars_images6 = 1; $error .= "<div class='error'>". $locale['error_113'] ."</div>\n"; }
		}


		if (empty($cars_qiymeti)) { $error_cars_qiymeti = 1; $error .= "<div class='error'>". $locale['error_120'] ."</div>\n"; }
		if (!empty($cars_qiymeti) && !preg_match("/^([0-9])+$/is", $cars_qiymeti)) { $error_cars_qiymeti = 1; $error .= "<div class='error'>". $locale['error_121'] ."</div>\n"; }

		// if (!empty($cars_kredit) && empty($cars_bank)) { $error_cars_bank = 1; $error .= "<div class='error'>". $locale['error_130'] ."</div>\n"; }
		// if (!empty($cars_kredit) && empty($cars_ilkodenish)) { $error_cars_ilkodenish = 1; $error .= "<div class='error'>". $locale['error_131'] ."</div>\n"; }
		if (!empty($cars_kredit) && !empty($cars_ilkodenish) && !preg_match("/^([0-9])+$/is", $cars_ilkodenish)) { $error_cars_ilkodenish = 1; $error .= "<div class='error'>". $locale['error_132'] ."</div>\n"; }
		// if (!empty($cars_kredit) && empty($cars_muddet)) { $error_cars_muddet = 1; $error .= "<div class='error'>". $locale['error_133'] ."</div>\n"; }
		if (!empty($cars_kredit) && !empty($cars_muddet) && !preg_match("/^([0-9])+$/is", $cars_muddet)) { $error_cars_muddet = 1; $error .= "<div class='error'>". $locale['error_134'] ."</div>\n"; }
		// if (!empty($cars_kredit) && empty($cars_ayliqodenish)) { $error_cars_ayliqodenish = 1; $error .= "<div class='error'>". $locale['error_135'] ."</div>\n"; }
		if (!empty($cars_kredit) && !empty($cars_ayliqodenish) && !preg_match("/^([0-9])+$/is", $cars_ayliqodenish)) { $error_cars_ayliqodenish = 1; $error .= "<div class='error'>". $locale['error_136'] ."</div>\n"; }
		// if (!empty($cars_kredit) && empty($cars_qodovoy)) { $error_cars_qodovoy = 1; $error .= "<div class='error'>". $locale['error_137'] ."</div>\n"; }
		if (!empty($cars_kredit) && !empty($cars_qodovoy) && !preg_match("/^([0-9])+$/is", $cars_qodovoy)) { $error_cars_qodovoy = 1; $error .= "<div class='error'>". $locale['error_138'] ."</div>\n"; }

		if (!empty($cars_salon_id_chek) && empty($cars_salon_id)) { $error_cars_salon_id = 1; $error .= "<div class='error'>". $locale['error_140'] ."</div>\n"; }

		if (empty($cars_adi)) { $error_cars_adi = 1; $error .= "<div class='error'>". $locale['error_150'] ."</div>\n"; }
		if (empty($cars_qorod)) { $error_cars_qorod = 1; $error .= "<div class='error'>". $locale['error_151'] ."</div>\n"; }
		if (empty($cars_mobiltel)) { $error_cars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_152'] ."</div>\n"; }
		if ($cars_mobiltel=="+994") { $error_cars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_152'] ."</div>\n"; }
		// if (strlen($cars_mobiltel) < 13) { $error_cars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_152'] ."</div>\n"; }
		// if (!empty($cars_mobiltel) && !preg_match("/^([0-9])+$/is", $cars_mobiltel)) { $error_cars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_153'] ."</div>\n"; }
		// if (empty($cars_tel)) { $error_cars_tel = 1; $error .= "<div class='error'>". $locale['error_154'] ."</div>\n"; }
		// if ($cars_tel=="+994") { $error_cars_tel = 1; $error .= "<div class='error'>". $locale['error_154'] ."</div>\n"; }
		// if (strlen($cars_tel) < 13) { $error_cars_tel = 1; $error .= "<div class='error'>". $locale['error_154'] ."</div>\n"; }
		// if (!empty($cars_tel) && !preg_match("/^([0-9])+$/is", $cars_tel)) { $error_cars_tel = 1; $error .= "<div class='error'>". $locale['error_155'] ."</div>\n"; }
		if (!empty($cars_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $cars_email)) { $error_cars_email = 1; $error .= "<div class='error'>". $locale['error_156'] ."</div>\n"; }

		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);

			if (!empty($cars_images1)) {
				$cars_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
				$cars_images1namerl = "rl". $cars_images1name;
				$cars_images1namesm = "sm". $cars_images1name;
				copy($cars_images1tmp, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images1name);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images1name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images1name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['cars_foto_dir'] ."/". $cars_images1name);
			}

			if (!empty($cars_images2)) {
				$cars_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
				$cars_images2namerl = "rl". $cars_images2name;
				$cars_images2namesm = "sm". $cars_images2name;
				copy($cars_images2tmp, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images2name);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images2name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images2name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['cars_foto_dir'] ."/". $cars_images2name);
			}

			if (!empty($cars_images3)) {
				$cars_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
				$cars_images3namerl = "rl". $cars_images3name;
				$cars_images3namesm = "sm". $cars_images3name;
				copy($cars_images3tmp, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images3name);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images3name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images3name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['cars_foto_dir'] ."/". $cars_images3name);
			}

			if (!empty($cars_images4)) {
				$cars_images4name = FUSION_TODAY . $img_rand_key ."_4.jpg";
				$cars_images4namerl = "rl". $cars_images4name;
				$cars_images4namesm = "sm". $cars_images4name;
				copy($cars_images4tmp, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images4name);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images4name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images4namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images4name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images4namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['cars_foto_dir'] ."/". $cars_images4name);
			}

			if (!empty($cars_images5)) {
				$cars_images5name = FUSION_TODAY . $img_rand_key ."_5.jpg";
				$cars_images5namerl = "rl". $cars_images5name;
				$cars_images5namesm = "sm". $cars_images5name;
				copy($cars_images5tmp, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images5name);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images5name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images5namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images5name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images5namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['cars_foto_dir'] ."/". $cars_images5name);
			}

			if (!empty($cars_images6)) {
				$cars_images6name = FUSION_TODAY . $img_rand_key ."_6.jpg";
				$cars_images6namerl = "rl". $cars_images6name;
				$cars_images6namesm = "sm". $cars_images6name;
				copy($cars_images6tmp, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images6name);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images6name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images6namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['cars_foto_dir'] ."/". $cars_images6name, IMAGES . $settings['cars_foto_dir'] ."/". $cars_images6namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['cars_foto_dir'] ."/". $cars_images6name);
			}



			### INSERT CARS BEGIN
			$cars_imgocher = $cars_images1name;
			if ($cars_tel=="+994") { $cars_tel=""; }
			
			$result = dbquery(
				"INSERT INTO ". DB_CARS ." (
												cars_marka,
												cars_model,
												cars_ili,
												cars_veziyyet,
												cars_yurush,
												cars_oiltip,
												cars_motorobyom,
												cars_motorguc,
												cars_gedenteker,
												cars_karopka,
												cars_kuzareng,
												cars_salonreng,
												cars_kuzarengmet,
												cars_ban,
												cars_kuza,
												cars_images1,
												cars_images2,
												cars_images3,
												cars_images4,
												cars_images5,
												cars_images6,
												cars_imgocher,
												cars_qiymeti,
												cars_valyuta,
												cars_kredit,
												cars_bank,
												cars_ilkodenish,
												cars_krvalyuta,
												cars_muddet,
												cars_ayliqodenish,
												cars_qodovoy,
												cars_salon_id,
												cars_adi,
												cars_qorod,
												cars_mobiltel,
												cars_tel,
												cars_email,
												cars_komplekt,
												cars_ip,
												cars_today,
												cars_views,
												cars_aktiv,
												cars_vip
				) VALUES (
												'". $cars_marka ."',
												'". $cars_model ."',
												'". $cars_ili ."',
												'". $cars_veziyyet ."',
												'". $cars_yurush ."',
												'". $cars_oiltip ."',
												'". $cars_motorobyom ."',
												'". $cars_motorguc ."',
												'". $cars_gedenteker ."',
												'". $cars_karopka ."',
												'". $cars_kuzareng ."',
												'". $cars_salonreng ."',
												'". $cars_kuzarengmet ."',
												'". $cars_ban ."',
												'". $cars_kuza ."',
												'". $cars_images1name ."',
												'". $cars_images2name ."',
												'". $cars_images3name ."',
												'". $cars_images4name ."',
												'". $cars_images5name ."',
												'". $cars_images6name ."',
												'". $cars_imgocher ."',
												'". $cars_qiymeti ."',
												'". $cars_valyuta ."',
												'". $cars_kredit ."',
												'". $cars_bank ."',
												'". $cars_ilkodenish ."',
												'". $cars_krvalyuta ."',
												'". $cars_muddet ."',
												'". $cars_ayliqodenish ."',
												'". $cars_qodovoy ."',
												'". $cars_salon_id ."',
												'". $cars_adi ."',
												'". $cars_qorod ."',
												'". $cars_mobiltel ."',
												'". $cars_tel ."',
												'". $cars_email ."',
												'". implode(",", $cars_komplekt) ."',
												'". $cars_ip ."',
												'". $cars_today ."',
												'". $cars_views ."',
												'". $cars_aktiv ."',
												'". $cars_vip ."'

				)"
			);
			// $cars_id = mysql_insert_id();
			$cars_id = _DB::$linkes->insert_id;
			### INSERT CARS END


			$result_desc = dbquery(
				"INSERT INTO ". DB_CARSDESC ." (
													cars_desc_car_id,
													cars_desc_text
				) VALUES (
													'". $cars_id ."',
													'". str_replace("'", '"', $cars_desc_text) ."'
				)"
			);


			$result_marka = dbquery("SELECT marka_name FROM ". DB_MARKA ." WHERE marka_id='". $cars_marka ."'");
			if (dbrows($result_marka)) {
				$data_marka = dbarray($result_marka);
			}
			$result_model = dbquery("SELECT model_name FROM ". DB_MODEL ." WHERE model_id='". $cars_model ."'");
			if (dbrows($result_model)) {
				$data_model = dbarray($result_model);
			}


			### INSERT SEOURL BEGIN
			$seourl_url = "cars/". $cars_id ."-". autocrateseourls($data_marka['marka_name'] ."_". $data_model['model_name'] ."_". $cars_ili ."/");
			$viewcompanent = viewcompanent("car", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = $cars_id;

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
			$viewcompanent = viewcompanent("car", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $cars_id;
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
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_010'] ."</b></td><td>". date("d.m.Y H:i:s", $cars_today) ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_011'] ."</b></td><td>". $cars_id ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_012'] ."</b></td><td>". $data_marka['marka_name'] ." - ". $data_model['model_name'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_013'] ."</b></td><td>". $cars_adi ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_014'] ."</b></td><td>". $cars_mobiltel ."</td>\n</tr>\n";
				if (!empty($cars_tel))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_015'] ."</b></td><td>". $cars_tel ."</td>\n</tr>\n"; }
				if (!empty($cars_email))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_016'] ."</b></td><td>". $cars_email ."</td>\n</tr>\n"; }
				if (!empty($cars_desc_text)){ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_017'] ."</b></td><td>". $cars_desc_text ."</td>\n</tr>\n"; }
				$allmsg .= "<tr>\n<td colspan='2'> </td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>---</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['sitename'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteurl'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteemail'] ."</td>\n</tr>\n";
				$allmsg .= "</table>\n";

				// Отправляем письмо майлеру
				mail($settings['siteemail'], $cars_adi ." ". $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END


			$result_alter = dbquery("ALTER TABLE `". DB_CARS ."` ORDER BY `cars_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

			echo "<div class='success'>". $locale['success_001'] ."<b>". $cars_id ."</b></div>\n";

			// gormek
			$gormek = 1;
			// gormek

			unset($cars_marka);
			unset($cars_model);
			unset($cars_ili);
			unset($cars_veziyyet);
			unset($cars_yurush);
			unset($cars_oiltip);
			unset($cars_motorobyom);
			unset($cars_motorguc);
			unset($cars_gedenteker);
			unset($cars_karopka);
			unset($cars_kuzareng);
			unset($cars_salonreng);
			unset($cars_kuzarengmet);
			unset($cars_ban);
			unset($cars_kuza);
			unset($cars_images1);
			unset($cars_images2);
			unset($cars_images3);
			unset($cars_images4);
			unset($cars_images5);
			unset($cars_images6);
			unset($cars_qiymeti);
			unset($cars_valyuta);
			unset($cars_kredit);
			unset($cars_bank);
			unset($cars_ilkodenish);
			unset($cars_krvalyuta);
			unset($cars_muddet);
			unset($cars_ayliqodenish);
			unset($cars_qodovoy);
			unset($cars_salon_id_chek);
			unset($cars_salon_id);
			unset($cars_adi);
			unset($cars_qorod);
			unset($cars_mobiltel);
			unset($cars_tel);
			unset($cars_email);
			unset($cars_komplekt);
			unset($cars_desc_text);
			unset($cars_ip);
			unset($cars_today);
			unset($cars_views);
			unset($cars_aktiv);
			unset($cars_vip);

		} // Yesli Error Yest
	} // Yesli POST

	if ($gormek!=1) {
?>





<?php
add_to_footer("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>");
add_to_footer("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#cars_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#cars_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>");

add_to_footer("
<script type='text/javascript'>
	<!--
	function kreditvalidate(cars_kredit) {
		if (cars_kredit.checked == 1) {
			document.getElementById('kredit').style.display='block';
		} else {
			document.getElementById('kredit').style.display='none';
		}
	}
	function salonidvalidate(salon_id) {
		if (salon_id.checked == 1) {
			document.getElementById('salon').style.display='block';
		} else {
			document.getElementById('salon').style.display='none';
		}
	}
	//-->
</script>
");
?>

<form method="POST" name="addcar" id="addcar" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
	<div class="addcars row">
		<div class="bloks blok1 col-sm-6">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds cars_marka">
				<label for="cars_marka"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_marka==1 ? " error" : ""); ?>" name="cars_marka" id="cars_marka" onchange="dynamicSelect('cars_marka','cars_model');">
					<option value=""<?php echo ($cars_marka=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
	<?php
		$result = dbquery("SELECT
									marka_id,
									marka_name
							FROM ". DB_MARKA ."
							ORDER BY `marka_name`");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
	?>
					<option value="<?php echo $data['marka_id']; ?>"<?php echo ($data['marka_id']==$cars_marka ? " selected" : ""); ?>><?php echo $data['marka_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
				</select>
			</div>
			<div class="fileds cars_model">
				<label for="cars_model"><?php echo $locale['511']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_model==1 ? " error" : ""); ?>" name="cars_model" id="cars_model">
					<option value=""<?php echo ($cars_model=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
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
					<option class="<?php echo $data['model_marka_id']; ?>" value="<?php echo $data['model_id']; ?>"<?php echo ($data['model_id']==$cars_model ? " selected" : ""); ?>><?php echo $data['model_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
				</select>
				<script type="text/javascript">
					<!--
					dynamicSelect('cars_marka','cars_model');
					-->
				</script>
			</div>
			<div class="hr"></div>
			<div class="fileds cars_ili">
				<label for="cars_ili"><?php echo $locale['520']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_ili==1 ? " error" : ""); ?>" name="cars_ili" id="cars_ili">
					<option value=""<?php echo ($cars_ili=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
	<?php
		$yaeril1 = date('Y')+1;
		$yaeril2 = $yaeril1-60;
		for ($yi = $yaeril1; $yi >= $yaeril2; $yi--) {
	?>
					<option value="<?php echo $yi; ?>"<?php echo ($yi==$cars_ili ? " selected" : ""); ?>><?php echo $yi; ?></option>
	<?php
		} // for
	?>
				</select>
			</div>
			<div class="fileds cars_veziyyet">
				<label for="cars_veziyyet"><?php echo $locale['521']; ?><?php echo UL; ?></label>
				<div class="veziyyetlabel">
					<label><input class="radio<?php echo ($error_cars_veziyyet==1 ? " error" : ""); ?>" type="radio" value="1" name="cars_veziyyet" id="cars_veziyyet"<?php echo ($cars_veziyyet==1 ? " checked" : ""); ?>> <?php echo $locale['veziyyet_1']; ?></label>
					<label><input class="radio<?php echo ($error_cars_veziyyet==1 ? " error" : ""); ?>" type="radio" value="2" name="cars_veziyyet" id="cars_veziyyet"<?php echo ($cars_veziyyet==2 ? " checked" : ""); ?>> <?php echo $locale['veziyyet_2']; ?></label>
					<label><input class="radio<?php echo ($error_cars_veziyyet==1 ? " error" : ""); ?>" type="radio" value="3" name="cars_veziyyet" id="cars_veziyyet"<?php echo ($cars_veziyyet==3 ? " checked" : ""); ?>> <?php echo $locale['veziyyet_3']; ?></label>
					<label><input class="radio<?php echo ($error_cars_veziyyet==1 ? " error" : ""); ?>" type="radio" value="4" name="cars_veziyyet" id="cars_veziyyet"<?php echo ($cars_veziyyet==4 ? " checked" : ""); ?>> <?php echo $locale['veziyyet_4']; ?></label>
				</div>
				<div class="clear-both"></div>
			</div>
			<div class="fileds cars_yurush">
				<label for="cars_yurush"><?php echo $locale['522']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_cars_yurush==1 ? " error" : ""); ?>" type="text" maxlength="15" name="cars_yurush" id="cars_yurush" value="<?php echo $cars_yurush; ?>" />
			</div>
			<div class="hr"></div>
			<div class="fileds cars_oiltip">
				<label for="cars_oiltip"><?php echo $locale['530']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_oiltip==1 ? " error" : ""); ?>" name="cars_oiltip" id="cars_oiltip">
					<option value=""<?php echo ($cars_oiltip=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="1"<?php echo ($cars_oiltip==1 ? " selected" : ""); ?>><?php echo $locale['oiltip_1']; ?></option>
					<option value="2"<?php echo ($cars_oiltip==2 ? " selected" : ""); ?>><?php echo $locale['oiltip_2']; ?></option>
					<option value="3"<?php echo ($cars_oiltip==3 ? " selected" : ""); ?>><?php echo $locale['oiltip_3']; ?></option>
					<option value="4"<?php echo ($cars_oiltip==4 ? " selected" : ""); ?>><?php echo $locale['oiltip_4']; ?></option>
				</select>
			</div>
			<div class="fileds cars_motorobyom">
				<label for="cars_motorobyom"><?php echo $locale['531']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_cars_motorobyom==1 ? " error" : ""); ?>" type="text" maxlength="5" name="cars_motorobyom" id="cars_motorobyom" value="<?php echo $cars_motorobyom; ?>" />
			</div>
			<div class="fileds cars_motorguc">
				<label for="cars_motorguc"><?php echo $locale['532']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_cars_motorguc==1 ? " error" : ""); ?>" type="text" maxlength="5" name="cars_motorguc" id="cars_motorguc" value="<?php echo $cars_motorguc; ?>" />
			</div>
			<div class="fileds cars_gedenteker">
				<label for="cars_gedenteker"><?php echo $locale['533']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_gedenteker==1 ? " error" : ""); ?>" name="cars_gedenteker" id="cars_gedenteker">
					<option value=""<?php echo ($cars_gedenteker=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="1"<?php echo ($cars_gedenteker==1 ? " selected" : ""); ?>><?php echo $locale['gedenteker_1']; ?></option>
					<option value="2"<?php echo ($cars_gedenteker==2 ? " selected" : ""); ?>><?php echo $locale['gedenteker_2']; ?></option>
					<option value="3"<?php echo ($cars_gedenteker==3 ? " selected" : ""); ?>><?php echo $locale['gedenteker_3']; ?></option>
				</select>
			</div>
			<div class="fileds cars_karopka">
				<label for="cars_karopka"><?php echo $locale['534']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_karopka==1 ? " error" : ""); ?>" name="cars_karopka" id="cars_karopka">
					<option value=""<?php echo ($cars_karopka=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="1"<?php echo ($cars_karopka==1 ? " selected" : ""); ?>><?php echo $locale['karopka_1']; ?></option>
					<option value="2"<?php echo ($cars_karopka==2 ? " selected" : ""); ?>><?php echo $locale['karopka_2']; ?></option>
					<option value="3"<?php echo ($cars_karopka==3 ? " selected" : ""); ?>><?php echo $locale['karopka_3']; ?></option>
				</select>
			</div>
			<div class="hr"></div>
			<div class="fileds cars_kuzareng">
				<label for="cars_kuzareng"><?php echo $locale['540']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_kuzareng==1 ? " error" : ""); ?>" name="cars_kuzareng" id="cars_kuzareng">
					<option value=""<?php echo ($cars_kuzareng=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="2"<?php echo ($cars_kuzareng==2 ? " selected" : ""); ?>><?php echo $locale['kuzareng_2']; ?></option>
					<option value="12"<?php echo ($cars_kuzareng==12 ? " selected" : ""); ?>><?php echo $locale['kuzareng_12']; ?></option>
					<option value="11"<?php echo ($cars_kuzareng==11 ? " selected" : ""); ?>><?php echo $locale['kuzareng_11']; ?></option>
					<option value="7"<?php echo ($cars_kuzareng==7 ? " selected" : ""); ?>><?php echo $locale['kuzareng_7']; ?></option>
					<option value="21"<?php echo ($cars_kuzareng==21 ? " selected" : ""); ?>><?php echo $locale['kuzareng_21']; ?></option>
					<option value="3"<?php echo ($cars_kuzareng==3 ? " selected" : ""); ?>><?php echo $locale['kuzareng_3']; ?></option>
					<option value="8"<?php echo ($cars_kuzareng==8 ? " selected" : ""); ?>><?php echo $locale['kuzareng_8']; ?></option>
					<option value="9"<?php echo ($cars_kuzareng==9 ? " selected" : ""); ?>><?php echo $locale['kuzareng_9']; ?></option>
					<option value="15"<?php echo ($cars_kuzareng==15 ? " selected" : ""); ?>><?php echo $locale['kuzareng_15']; ?></option>
					<option value="5"<?php echo ($cars_kuzareng==5 ? " selected" : ""); ?>><?php echo $locale['kuzareng_5']; ?></option>
					<option value="10"<?php echo ($cars_kuzareng==10 ? " selected" : ""); ?>><?php echo $locale['kuzareng_10']; ?></option>
					<option value="1"<?php echo ($cars_kuzareng==1 ? " selected" : ""); ?>><?php echo $locale['kuzareng_1']; ?></option>
					<option value="14"<?php echo ($cars_kuzareng==14 ? " selected" : ""); ?>><?php echo $locale['kuzareng_14']; ?></option>
					<option value="6"<?php echo ($cars_kuzareng==6 ? " selected" : ""); ?>><?php echo $locale['kuzareng_6']; ?></option>
					<option value="35"<?php echo ($cars_kuzareng==35 ? " selected" : ""); ?>><?php echo $locale['kuzareng_35']; ?></option>
					<option value="27"<?php echo ($cars_kuzareng==27 ? " selected" : ""); ?>><?php echo $locale['kuzareng_27']; ?></option>
					<option value="4"<?php echo ($cars_kuzareng==4 ? " selected" : ""); ?>><?php echo $locale['kuzareng_4']; ?></option>
				</select>
			</div>
			<div class="fileds cars_kuzarengmet">
				<label for="cars_kuzarengmet"><?php echo $locale['541']; ?></label>
				<input class="checkbox<?php echo ($error_cars_kuzarengmet==1 ? " error" : ""); ?>" type="checkbox" value="1" name="cars_kuzarengmet" id="cars_kuzarengmet"<?php echo ($cars_kuzarengmet==1 ? " checked" : ""); ?> />
			</div>
			<div class="fileds cars_salonreng">
				<label for="cars_salonreng"><?php echo $locale['542']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_salonreng==1 ? " error" : ""); ?>" name="cars_salonreng" id="cars_salonreng">
					<option value=""<?php echo ($cars_salonreng=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="2"<?php echo ($cars_salonreng==2 ? " selected" : ""); ?>><?php echo $locale['salonreng_2']; ?></option>
					<option value="12"<?php echo ($cars_salonreng==12 ? " selected" : ""); ?>><?php echo $locale['salonreng_12']; ?></option>
					<option value="11"<?php echo ($cars_salonreng==11 ? " selected" : ""); ?>><?php echo $locale['salonreng_11']; ?></option>
					<option value="7"<?php echo ($cars_salonreng==7 ? " selected" : ""); ?>><?php echo $locale['salonreng_7']; ?></option>
					<option value="21"<?php echo ($cars_salonreng==21 ? " selected" : ""); ?>><?php echo $locale['salonreng_21']; ?></option>
					<option value="3"<?php echo ($cars_salonreng==3 ? " selected" : ""); ?>><?php echo $locale['salonreng_3']; ?></option>
					<option value="8"<?php echo ($cars_salonreng==8 ? " selected" : ""); ?>><?php echo $locale['salonreng_8']; ?></option>
					<option value="9"<?php echo ($cars_salonreng==9 ? " selected" : ""); ?>><?php echo $locale['salonreng_9']; ?></option>
					<option value="15"<?php echo ($cars_salonreng==15 ? " selected" : ""); ?>><?php echo $locale['salonreng_15']; ?></option>
					<option value="5"<?php echo ($cars_salonreng==5 ? " selected" : ""); ?>><?php echo $locale['salonreng_5']; ?></option>
					<option value="10"<?php echo ($cars_salonreng==10 ? " selected" : ""); ?>><?php echo $locale['salonreng_10']; ?></option>
					<option value="1"<?php echo ($cars_salonreng==1 ? " selected" : ""); ?>><?php echo $locale['salonreng_1']; ?></option>
					<option value="14"<?php echo ($cars_salonreng==14 ? " selected" : ""); ?>><?php echo $locale['salonreng_14']; ?></option>
					<option value="6"<?php echo ($cars_salonreng==6 ? " selected" : ""); ?>><?php echo $locale['salonreng_6']; ?></option>
					<option value="35"<?php echo ($cars_salonreng==35 ? " selected" : ""); ?>><?php echo $locale['salonreng_35']; ?></option>
					<option value="27"<?php echo ($cars_salonreng==27 ? " selected" : ""); ?>><?php echo $locale['salonreng_27']; ?></option>
					<option value="4"<?php echo ($cars_salonreng==4 ? " selected" : ""); ?>><?php echo $locale['salonreng_4']; ?></option>
				</select>
			</div>
			<div class="fileds cars_ban">
				<label for="cars_ban"><?php echo $locale['543']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_ban==1 ? " error" : ""); ?>" name="cars_ban" id="cars_ban" onchange="dynamicSelect('cars_ban','cars_kuza');">
					<option value=""<?php echo ($cars_ban=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="1"<?php echo ($cars_ban==1 ? " selected" : ""); ?>><?php echo $locale['ban_1']; ?></option>
					<option value="2"<?php echo ($cars_ban==2 ? " selected" : ""); ?>><?php echo $locale['ban_2']; ?></option>
					<!--<option value="3"<?php echo ($cars_ban==3 ? " selected" : ""); ?>><?php echo $locale['ban_3']; ?></option>-->
					<option value="4"<?php echo ($cars_ban==4 ? " selected" : ""); ?>><?php echo $locale['ban_4']; ?></option>
					<!--<option value="5"<?php echo ($cars_ban==5 ? " selected" : ""); ?>><?php echo $locale['ban_5']; ?></option>-->
					<option value="6"<?php echo ($cars_ban==6 ? " selected" : ""); ?>><?php echo $locale['ban_6']; ?></option>
					<option value="7"<?php echo ($cars_ban==7 ? " selected" : ""); ?>><?php echo $locale['ban_7']; ?></option>
					<!--<option value="8"<?php echo ($cars_ban==8 ? " selected" : ""); ?>><?php echo $locale['ban_8']; ?></option>-->
					<!--<option value="9"<?php echo ($cars_ban==9 ? " selected" : ""); ?>><?php echo $locale['ban_9']; ?></option>-->
				</select>
			</div>
			<div class="fileds cars_kuza">
				<label for="cars_kuza"><?php echo $locale['543']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_kuza==1 ? " error" : ""); ?>" name="cars_kuza" id="cars_kuza">
					<option value=""<?php echo ($cars_kuza=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option class='1' value='1'<?php echo ($cars_kuza==1 ? " selected" : ""); ?>><?php echo $locale['kuza_1']; ?></option>
					<option class='1' value='2'<?php echo ($cars_kuza==2 ? " selected" : ""); ?>><?php echo $locale['kuza_2']; ?></option>
					<option class='1' value='3'<?php echo ($cars_kuza==3 ? " selected" : ""); ?>><?php echo $locale['kuza_3']; ?></option>
					<option class='1' value='4'<?php echo ($cars_kuza==4 ? " selected" : ""); ?>><?php echo $locale['kuza_4']; ?></option>
					<option class='1' value='172'<?php echo ($cars_kuza==172 ? " selected" : ""); ?>><?php echo $locale['kuza_172']; ?></option>
					<option class='1' value='5'<?php echo ($cars_kuza==5 ? " selected" : ""); ?>><?php echo $locale['kuza_5']; ?></option>
					<option class='1' value='6'<?php echo ($cars_kuza==6 ? " selected" : ""); ?>><?php echo $locale['kuza_6']; ?></option>
					<option class='1' value='7'<?php echo ($cars_kuza==7 ? " selected" : ""); ?>><?php echo $locale['kuza_7']; ?></option>
					<option class='1' value='8'<?php echo ($cars_kuza==8 ? " selected" : ""); ?>><?php echo $locale['kuza_8']; ?></option>
					<option class='1' value='9'<?php echo ($cars_kuza==9 ? " selected" : ""); ?>><?php echo $locale['kuza_9']; ?></option>
					<option class='2' value='10'<?php echo ($cars_kuza==10 ? " selected" : ""); ?>><?php echo $locale['kuza_10']; ?></option>
					<option class='2' value='12'<?php echo ($cars_kuza==12 ? " selected" : ""); ?>><?php echo $locale['kuza_12']; ?></option>
					<option class='2' value='13'<?php echo ($cars_kuza==13 ? " selected" : ""); ?>><?php echo $locale['kuza_13']; ?></option>
					<option class='2' value='15'<?php echo ($cars_kuza==15 ? " selected" : ""); ?>><?php echo $locale['kuza_15']; ?></option>
					<option class='2' value='18'<?php echo ($cars_kuza==18 ? " selected" : ""); ?>><?php echo $locale['kuza_18']; ?></option>
					<option class='2' value='26'<?php echo ($cars_kuza==26 ? " selected" : ""); ?>><?php echo $locale['kuza_26']; ?></option>
					<option class='2' value='30'<?php echo ($cars_kuza==30 ? " selected" : ""); ?>><?php echo $locale['kuza_30']; ?></option>
					<option class='2' value='38'<?php echo ($cars_kuza==38 ? " selected" : ""); ?>><?php echo $locale['kuza_38']; ?></option>
					<option class='2' value='41'<?php echo ($cars_kuza==41 ? " selected" : ""); ?>><?php echo $locale['kuza_41']; ?></option>
					<option class='4' value='51'<?php echo ($cars_kuza==51 ? " selected" : ""); ?>><?php echo $locale['kuza_51']; ?></option>
					<option class='4' value='63'<?php echo ($cars_kuza==63 ? " selected" : ""); ?>><?php echo $locale['kuza_63']; ?></option>
					<option class='4' value='65'<?php echo ($cars_kuza==65 ? " selected" : ""); ?>><?php echo $locale['kuza_65']; ?></option>
					<option class='4' value='107'<?php echo ($cars_kuza==107 ? " selected" : ""); ?>><?php echo $locale['kuza_107']; ?></option>
					<option class='6' value='112'<?php echo ($cars_kuza==112 ? " selected" : ""); ?>><?php echo $locale['kuza_112']; ?></option>
					<option class='6' value='113'<?php echo ($cars_kuza==113 ? " selected" : ""); ?>><?php echo $locale['kuza_113']; ?></option>
					<option class='6' value='114'<?php echo ($cars_kuza==114 ? " selected" : ""); ?>><?php echo $locale['kuza_114']; ?></option>
					<option class='6' value='115'<?php echo ($cars_kuza==115 ? " selected" : ""); ?>><?php echo $locale['kuza_115']; ?></option>
					<option class='6' value='116'<?php echo ($cars_kuza==116 ? " selected" : ""); ?>><?php echo $locale['kuza_116']; ?></option>
					<option class='7' value='117'<?php echo ($cars_kuza==117 ? " selected" : ""); ?>><?php echo $locale['kuza_117']; ?></option>
					<option class='7' value='122'<?php echo ($cars_kuza==122 ? " selected" : ""); ?>><?php echo $locale['kuza_122']; ?></option>
					<option class='7' value='124'<?php echo ($cars_kuza==124 ? " selected" : ""); ?>><?php echo $locale['kuza_124']; ?></option>
					<option class='7' value='134'<?php echo ($cars_kuza==134 ? " selected" : ""); ?>><?php echo $locale['kuza_134']; ?></option>
					<option class='7' value='135'<?php echo ($cars_kuza==135 ? " selected" : ""); ?>><?php echo $locale['kuza_135']; ?></option>
					<option class='7' value='136'<?php echo ($cars_kuza==136 ? " selected" : ""); ?>><?php echo $locale['kuza_136']; ?></option>
					<option class='7' value='145'<?php echo ($cars_kuza==145 ? " selected" : ""); ?>><?php echo $locale['kuza_145']; ?></option> 
				</select>
				<script type="text/javascript">
					<!--
					dynamicSelect('cars_ban','cars_kuza');
					-->
				</script>
			</div>
		</div>
		<div class="bloks blok2 col-sm-6">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds cars_images">
				<label for="cars_images1"><?php echo $locale['550']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_cars_images1==1 ? " error" : ""); ?>" type="file" name="cars_images1" id="cars_images1" accept="image/*" />
				<label for="cars_images2"><?php echo $locale['551']; ?></label>
				<input class="textbox<?php echo ($error_cars_images2==1 ? " error" : ""); ?>" type="file" name="cars_images2" id="cars_images2" accept="image/*" />
				<label for="cars_images3"><?php echo $locale['552']; ?></label>
				<input class="textbox<?php echo ($error_cars_images3==1 ? " error" : ""); ?>" type="file" name="cars_images3" id="cars_images3" accept="image/*" />
				<label for="cars_images4"><?php echo $locale['553']; ?></label>
				<input class="textbox<?php echo ($error_cars_images4==1 ? " error" : ""); ?>" type="file" name="cars_images4" id="cars_images4" accept="image/*" />
				<label for="cars_images5"><?php echo $locale['554']; ?></label>
				<input class="textbox<?php echo ($error_cars_images5==1 ? " error" : ""); ?>" type="file" name="cars_images5" id="cars_images5" accept="image/*" />
				<label for="cars_images6"><?php echo $locale['555']; ?></label>
				<input class="textbox<?php echo ($error_cars_images6==1 ? " error" : ""); ?>" type="file" name="cars_images6" id="cars_images6" accept="image/*" />
			</div>
			<div class="hr"></div>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds cars_qiymeti">
				<label for="cars_qiymeti"><?php echo $locale['560']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_cars_qiymeti==1 ? " error" : ""); ?>" type="text" maxlength="10" name="cars_qiymeti" id="cars_qiymeti" value="<?php echo $cars_qiymeti; ?>" />
				<select class="select<?php echo ($error_cars_valyuta==1 ? " error" : ""); ?>" name="cars_valyuta" id="cars_valyuta">
					<option value="1"<?php echo ($cars_valyuta==1 ? " selected" : ""); ?>><?php echo $locale['valyuta_1']; ?></option>
					<option value="2"<?php echo ($cars_valyuta==2 ? " selected" : ""); ?>><?php echo $locale['valyuta_2']; ?></option>
					<option value="3"<?php echo ($cars_valyuta==3 ? " selected" : ""); ?>><?php echo $locale['valyuta_3']; ?></option>
				</select>
			</div>
			<div class="fileds cars_kredit">
				<label for="cars_kredit"><?php echo $locale['561']; ?></label>
				<input class="checkbox<?php echo ($error_cars_kredit==1 ? " error" : ""); ?>" type="checkbox" value="1" name="cars_kredit" id="cars_kredit"<?php echo ($cars_kredit==1 ? " checked" : ""); ?>  onclick="return kreditvalidate(cars_kredit);" />
			</div>
			<div id="kredit"<?php echo ($cars_kredit==1 ? " style='display:block;'" : " style='display:none;'"); ?>>
				<div class="fileds cars_bank">
					<label for="cars_bank"><?php echo $locale['562']; ?></label>
					<select class="select<?php echo ($error_cars_bank==1 ? " error" : ""); ?>" name="cars_bank" id="cars_bank">
						<option value=""<?php echo ($cars_bank=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
						<option value="1"<?php echo ($cars_bank==1 ? " selected" : ""); ?>><?php echo $locale['bank_1']; ?></option>
						<option value="2"<?php echo ($cars_bank==2 ? " selected" : ""); ?>><?php echo $locale['bank_2']; ?></option>
						<option value="3"<?php echo ($cars_bank==3 ? " selected" : ""); ?>><?php echo $locale['bank_3']; ?></option>
						<option value="4"<?php echo ($cars_bank==4 ? " selected" : ""); ?>><?php echo $locale['bank_4']; ?></option>
						<option value="5"<?php echo ($cars_bank==5 ? " selected" : ""); ?>><?php echo $locale['bank_5']; ?></option>
						<option value="6"<?php echo ($cars_bank==6 ? " selected" : ""); ?>><?php echo $locale['bank_6']; ?></option>
						<option value="7"<?php echo ($cars_bank==7 ? " selected" : ""); ?>><?php echo $locale['bank_7']; ?></option>
						<option value="8"<?php echo ($cars_bank==8 ? " selected" : ""); ?>><?php echo $locale['bank_8']; ?></option>
						<option value="9"<?php echo ($cars_bank==9 ? " selected" : ""); ?>><?php echo $locale['bank_9']; ?></option>
						<option value="10"<?php echo ($cars_bank==10 ? " selected" : ""); ?>><?php echo $locale['bank_10']; ?></option>
						<option value="11"<?php echo ($cars_bank==11 ? " selected" : ""); ?>><?php echo $locale['bank_11']; ?></option>
						<option value="12"<?php echo ($cars_bank==12 ? " selected" : ""); ?>><?php echo $locale['bank_12']; ?></option>
						<option value="13"<?php echo ($cars_bank==13 ? " selected" : ""); ?>><?php echo $locale['bank_13']; ?></option>
						<option value="14"<?php echo ($cars_bank==14 ? " selected" : ""); ?>><?php echo $locale['bank_14']; ?></option>
						<option value="15"<?php echo ($cars_bank==15 ? " selected" : ""); ?>><?php echo $locale['bank_15']; ?></option>
						<option value="16"<?php echo ($cars_bank==16 ? " selected" : ""); ?>><?php echo $locale['bank_16']; ?></option>
						<option value="17"<?php echo ($cars_bank==17 ? " selected" : ""); ?>><?php echo $locale['bank_17']; ?></option>
						<option value="18"<?php echo ($cars_bank==18 ? " selected" : ""); ?>><?php echo $locale['bank_18']; ?></option>
						<option value="19"<?php echo ($cars_bank==19 ? " selected" : ""); ?>><?php echo $locale['bank_19']; ?></option>
						<option value="20"<?php echo ($cars_bank==20 ? " selected" : ""); ?>><?php echo $locale['bank_20']; ?></option>
						<option value="21"<?php echo ($cars_bank==21 ? " selected" : ""); ?>><?php echo $locale['bank_21']; ?></option>
						<option value="22"<?php echo ($cars_bank==22 ? " selected" : ""); ?>><?php echo $locale['bank_22']; ?></option>
						<option value="23"<?php echo ($cars_bank==23 ? " selected" : ""); ?>><?php echo $locale['bank_23']; ?></option>
						<option value="24"<?php echo ($cars_bank==24 ? " selected" : ""); ?>><?php echo $locale['bank_24']; ?></option>
						<option value="25"<?php echo ($cars_bank==25 ? " selected" : ""); ?>><?php echo $locale['bank_25']; ?></option>
						<option value="26"<?php echo ($cars_bank==26 ? " selected" : ""); ?>><?php echo $locale['bank_26']; ?></option>
						<option value="27"<?php echo ($cars_bank==27 ? " selected" : ""); ?>><?php echo $locale['bank_27']; ?></option>
						<option value="28"<?php echo ($cars_bank==28 ? " selected" : ""); ?>><?php echo $locale['bank_28']; ?></option>
						<option value="29"<?php echo ($cars_bank==29 ? " selected" : ""); ?>><?php echo $locale['bank_29']; ?></option>
						<option value="30"<?php echo ($cars_bank==30 ? " selected" : ""); ?>><?php echo $locale['bank_30']; ?></option>
						<option value="31"<?php echo ($cars_bank==31 ? " selected" : ""); ?>><?php echo $locale['bank_31']; ?></option>
						<option value="32"<?php echo ($cars_bank==32 ? " selected" : ""); ?>><?php echo $locale['bank_32']; ?></option>
						<option value="33"<?php echo ($cars_bank==33 ? " selected" : ""); ?>><?php echo $locale['bank_33']; ?></option>
						<option value="34"<?php echo ($cars_bank==34 ? " selected" : ""); ?>><?php echo $locale['bank_34']; ?></option>
						<option value="35"<?php echo ($cars_bank==35 ? " selected" : ""); ?>><?php echo $locale['bank_35']; ?></option>
						<option value="36"<?php echo ($cars_bank==36 ? " selected" : ""); ?>><?php echo $locale['bank_36']; ?></option>
						<option value="37"<?php echo ($cars_bank==37 ? " selected" : ""); ?>><?php echo $locale['bank_37']; ?></option>
						<option value="38"<?php echo ($cars_bank==38 ? " selected" : ""); ?>><?php echo $locale['bank_38']; ?></option>
						<option value="39"<?php echo ($cars_bank==39 ? " selected" : ""); ?>><?php echo $locale['bank_39']; ?></option>
						<option value="40"<?php echo ($cars_bank==40 ? " selected" : ""); ?>><?php echo $locale['bank_40']; ?></option>
						<option value="41"<?php echo ($cars_bank==41 ? " selected" : ""); ?>><?php echo $locale['bank_41']; ?></option>
						<option value="42"<?php echo ($cars_bank==42 ? " selected" : ""); ?>><?php echo $locale['bank_42']; ?></option>
						<option value="43"<?php echo ($cars_bank==43 ? " selected" : ""); ?>><?php echo $locale['bank_43']; ?></option>
						<option value="44"<?php echo ($cars_bank==44 ? " selected" : ""); ?>><?php echo $locale['bank_44']; ?></option>
						<option value="45"<?php echo ($cars_bank==45 ? " selected" : ""); ?>><?php echo $locale['bank_45']; ?></option>
						<option value="46"<?php echo ($cars_bank==46 ? " selected" : ""); ?>><?php echo $locale['bank_46']; ?></option>
					<select>
				</div>
				<div class="fileds cars_ilkodenish">
					<label for="cars_ilkodenish"><?php echo $locale['563']; ?></label>
					<input class="textbox<?php echo ($error_cars_ilkodenish==1 ? " error" : ""); ?>" type="text" maxlength="10" name="cars_ilkodenish" id="cars_ilkodenish" value="<?php echo $cars_ilkodenish; ?>" />
					<select class="select<?php echo ($error_cars_krvalyuta==1 ? " error" : ""); ?>" name="cars_krvalyuta" id="cars_krvalyuta">
						<option value="1"<?php echo ($cars_krvalyuta==1 ? " selected" : ""); ?>><?php echo $locale['krvalyuta_1']; ?></option>
						<option value="2"<?php echo ($cars_krvalyuta==2 ? " selected" : ""); ?>><?php echo $locale['krvalyuta_2']; ?></option>
						<option value="3"<?php echo ($cars_krvalyuta==3 ? " selected" : ""); ?>><?php echo $locale['krvalyuta_3']; ?></option>
						<option value="4"<?php echo ($cars_krvalyuta==4 ? " selected" : ""); ?>><?php echo $locale['krvalyuta_4']; ?></option>
					</select>
				</div>
				<div class="fileds cars_muddet">
					<label for="cars_muddet"><?php echo $locale['564']; ?></label>
					<input class="textbox<?php echo ($error_cars_muddet==1 ? " error" : ""); ?>" type="text" maxlength="2" name="cars_muddet" id="cars_muddet" value="<?php echo $cars_muddet; ?>" />
					<?php echo $locale['muddet_1']; ?>
				</div>
				<div class="fileds cars_ayliqodenish">
					<label for="cars_ayliqodenish"><?php echo $locale['565']; ?></label>
					<input class="textbox<?php echo ($error_cars_ayliqodenish==1 ? " error" : ""); ?>" type="text" maxlength="10" name="cars_ayliqodenish" id="cars_ayliqodenish" value="<?php echo $cars_ayliqodenish; ?>" />
					<?php echo $locale['ayliqodenish_1']; ?>
				</div>
				<div class="fileds cars_qodovoy">
					<label for="cars_qodovoy"><?php echo $locale['566']; ?></label>
					<input class="textbox<?php echo ($error_cars_qodovoy==1 ? " error" : ""); ?>" type="text" maxlength="10" name="cars_qodovoy" id="cars_qodovoy" value="<?php echo $cars_qodovoy; ?>" />
					<?php echo $locale['qodovoy_1']; ?>
				</div>
			</div>
			<div class="hr"></div>
			<div class="fileds cars_salon_id_chek">
				<label for="cars_salon_id_chek"><?php echo $locale['570']; ?></label>
				<input class="checkbox<?php echo ($error_cars_salon_id_chek==1 ? " error" : ""); ?>" type="checkbox" value="1" name="cars_salon_id_chek" id="cars_salon_id_chek"<?php echo ($cars_salon_id_chek=="" ? "" : " checked"); ?>  onclick="return salonidvalidate(cars_salon_id_chek);" />
			</div>
			<div id="salon"<?php echo ($cars_salon_id_chek=="" ? " style='display:none;'" : " style='display:block;'"); ?>>
				<div class="fileds cars_salon_id">
					<label for="cars_salon_id"><?php echo $locale['571']; ?></label>
					<select class="select<?php echo ($error_cars_salon_id==1 ? " error" : ""); ?>" name="cars_salon_id" id="cars_salon_id">
						<option value=""<?php echo ($cars_salon_id=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
		<?php
			$result = dbquery("SELECT
										salon_id,
										salon_name
								FROM ". DB_SALONS ."
								WHERE salon_aktiv='1'
								ORDER BY `salon_name`");
			if (dbrows($result)) {
				while ($data = dbarray($result)) {
		?>
						<option value="<?php echo $data['salon_id']; ?>"<?php echo ($data['salon_id']==$cars_salon_id ? " selected" : ""); ?>><?php echo $data['salon_name']; ?></option>
		<?php
				} // db whille
			} // db query
		?>
					</select> 
				</div>
			</div>
			<div class="fileds cars_adi">
				<label for="cars_adi"><?php echo $locale['580']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_cars_adi==1 ? " error" : ""); ?>" type="text" maxlength="100" name="cars_adi" id="cars_adi" value="<?php echo $cars_adi; ?>" />
			</div>
			<div class="fileds cars_qorod">
				<label for="cars_qorod"><?php echo $locale['581']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_cars_qorod==1 ? " error" : ""); ?>" name="cars_qorod" id="cars_qorod">
					<option value=""<?php echo ($cars_qorod=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<optgroup label="<?php echo $locale['zona_1']; ?>">
						<option value="1"<?php echo ($cars_qorod==1 ? " selected" : ""); ?>><?php echo $locale['qorod_1']; ?></option>
						<option value="2"<?php echo ($cars_qorod==2 ? " selected" : ""); ?>><?php echo $locale['qorod_2']; ?></option>
						<option value="3"<?php echo ($cars_qorod==3 ? " selected" : ""); ?>><?php echo $locale['qorod_3']; ?></option>
						<option value="4"<?php echo ($cars_qorod==4 ? " selected" : ""); ?>><?php echo $locale['qorod_4']; ?></option>
						<option value="5"<?php echo ($cars_qorod==5 ? " selected" : ""); ?>><?php echo $locale['qorod_5']; ?></option>
						<option value="6"<?php echo ($cars_qorod==6 ? " selected" : ""); ?>><?php echo $locale['qorod_6']; ?></option>
						<option value="7"<?php echo ($cars_qorod==7 ? " selected" : ""); ?>><?php echo $locale['qorod_7']; ?></option>
						<option value="8"<?php echo ($cars_qorod==8 ? " selected" : ""); ?>><?php echo $locale['qorod_8']; ?></option>
						<option value="9"<?php echo ($cars_qorod==9 ? " selected" : ""); ?>><?php echo $locale['qorod_9']; ?></option>
						<option value="10"<?php echo ($cars_qorod==10 ? " selected" : ""); ?>><?php echo $locale['qorod_10']; ?></option>
						<option value="11"<?php echo ($cars_qorod==11 ? " selected" : ""); ?>><?php echo $locale['qorod_11']; ?></option>
						<option value="12"<?php echo ($cars_qorod==12 ? " selected" : ""); ?>><?php echo $locale['qorod_12']; ?></option>
						<option value="13"<?php echo ($cars_qorod==13 ? " selected" : ""); ?>><?php echo $locale['qorod_13']; ?></option>
						<option value="14"<?php echo ($cars_qorod==14 ? " selected" : ""); ?>><?php echo $locale['qorod_14']; ?></option>
						<option value="15"<?php echo ($cars_qorod==15 ? " selected" : ""); ?>><?php echo $locale['qorod_15']; ?></option>
						<option value="16"<?php echo ($cars_qorod==16 ? " selected" : ""); ?>><?php echo $locale['qorod_16']; ?></option>
						<option value="17"<?php echo ($cars_qorod==17 ? " selected" : ""); ?>><?php echo $locale['qorod_17']; ?></option>
						<option value="18"<?php echo ($cars_qorod==18 ? " selected" : ""); ?>><?php echo $locale['qorod_18']; ?></option>
						<option value="19"<?php echo ($cars_qorod==19 ? " selected" : ""); ?>><?php echo $locale['qorod_19']; ?></option>
						<option value="20"<?php echo ($cars_qorod==20 ? " selected" : ""); ?>><?php echo $locale['qorod_20']; ?></option>
					</optgroup>
						<optgroup label="<?php echo $locale['zona_2']; ?>">
						<option value="51"<?php echo ($cars_qorod==51 ? " selected" : ""); ?>><?php echo $locale['qorod_51']; ?></option>
						<option value="52"<?php echo ($cars_qorod==52 ? " selected" : ""); ?>><?php echo $locale['qorod_52']; ?></option>
						<option value="53"<?php echo ($cars_qorod==53 ? " selected" : ""); ?>><?php echo $locale['qorod_53']; ?></option>
						<option value="54"<?php echo ($cars_qorod==54 ? " selected" : ""); ?>><?php echo $locale['qorod_54']; ?></option>
					</optgroup>
				</select>
			</div>
			<div class="fileds cars_mobiltel">
				<label for="cars_mobiltel"><?php echo $locale['582']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_cars_mobiltel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="cars_mobiltel" id="cars_mobiltel" value="<?php echo $cars_mobiltel; ?>" />
			</div>
			<div class="fileds cars_tel">
				<label for="cars_tel"><?php echo $locale['583']; ?></label>
				<input class="textbox<?php echo ($error_cars_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="cars_tel" id="cars_tel" value="<?php echo $cars_tel; ?>" />
			</div>
			<div class="fileds cars_email">
				<label for="cars_email"><?php echo $locale['584']; ?></label>
				<input class="textbox<?php echo ($error_cars_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="cars_email" id="cars_email" value="<?php echo $cars_email; ?>" />
				<?php echo $locale['585']; ?>
			</div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3 col-sm-12">
			<div class="hr"></div>
			<div class="blok_name"><?php echo $locale['505']; ?></div>
			<div class="fileds cars_komplekt row">
		<?php
			$result = dbquery("SELECT
										komp_id,
										komp_name
								FROM ". DB_KOMP ."
								ORDER BY `komp_name`");
			if (dbrows($result)) {
				while ($data = dbarray($result)) { $kompsay++;
		?>
						<label for="cars_komplekt<?php echo $data['komp_id']; ?>" class="komptretiy col-sm-2"><input class="checkbox" type="checkbox" value="<?php echo $data['komp_id']; ?>" name="cars_komplekt[]" id="cars_komplekt<?php echo $data['komp_id']; ?>"<?php echo (in_array($data['komp_id'], $cars_komplekt) ? " checked" : ""); ?> /><?php echo unserialize($data['komp_name'])[LOCALESHORT]; ?></label>
		<?php
				} // db whille
			} // db query
		?>
			</div>
			<div class="hr"></div>
			<div class="blok_name"><?php echo $locale['506']; ?></div>
			<div class="fileds cars_elaveinfo">
				<textarea class="textbox<?php echo ($error_cars_desc_text==1 ? " error" : ""); ?>" rows="7" cols="70" name="cars_desc_text" id="cars_desc_text"><?php echo $cars_desc_text; ?></textarea>
			</div>
			<div class="hr"></div>
			<div class="fileds cars_submit">
				<a href="#" onclick="document.getElementById('qayda').style.display='block'; return false"><?php echo $locale['591']; ?></a>
				<input class="checkbox" type="checkbox" value="rules" name="cars_rules" id="#cars_rules" onclick="this.form.cars_submit.disabled=!this.form.cars_rules.checked" />
				<input disabled class="button" value="<?php echo $locale['590']; ?>" type="submit" name="cars_submit" id="cars_submit" onclick="return(check())" />
			</div>
			<div class="fileds cars_qayda" id="qayda" style="display:none;">
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