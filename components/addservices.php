<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

session_start();

include LOCALE.LOCALESET."addservices.php";

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

	if ($_POST['service_submit']) {

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

		$service_images1 =  $_FILES['service_images1']['name'];
		$service_images1tmp  = $_FILES['service_images1']['tmp_name'];
		$service_images1size = $_FILES['service_images1']['size'];
		$service_images1type = $_FILES['service_images1']['type'];

		$service_images2 =  $_FILES['service_images2']['name'];
		$service_images2tmp  = $_FILES['service_images2']['tmp_name'];
		$service_images2size = $_FILES['service_images2']['size'];
		$service_images2type = $_FILES['service_images2']['type'];

		$service_images3 =  $_FILES['service_images3']['name'];
		$service_images3tmp  = $_FILES['service_images3']['tmp_name'];
		$service_images3size = $_FILES['service_images3']['size'];
		$service_images3type = $_FILES['service_images3']['type'];

		$service_elaveinfo = trim(stripinput(censorwords(substr($_POST['service_elaveinfo'],0,1000))));
		$service_ip = FUSION_IP;
		$service_today = FUSION_TODAY;
		$service_views = 1;
		$service_aktiv = 2;
		$service_vip = 0;

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
		$service_ip = "";
		$service_today = "";
		$service_views = "";
		$service_aktiv = "";
		$service_vip = "";

	}

	if ($_POST['service_submit']) {

		if (empty($service_name)) { $error_service_name = 1; $error .= "<div class='error'>". $locale['error_001'] ."</div>\n"; }
		if (empty($service_qorod)) { $error_service_qorod = 1; $error .= "<div class='error'>". $locale['error_002'] ."</div>\n"; }
		if (empty($service_adress)) { $error_service_adress = 1; $error .= "<div class='error'>". $locale['error_003'] ."</div>\n"; }
		if (empty($service_mobiltel)) { $error_service_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		if ($service_mobiltel=="+994") { $error_service_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (strlen($service_mobiltel) < 13) { $error_service_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (!empty($service_mobiltel) && !preg_match("/^([0-9])+$/is", $service_mobiltel)) { $error_service_mobiltel = 1; $error .= "<div class='error'>". $locale['error_005'] ."</div>\n"; }
		// if (empty($service_tel)) { $error_service_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if ($service_tel=="+994") { $error_service_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (strlen($service_tel) < 13) { $error_service_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (!empty($service_tel) && !preg_match("/^([0-9])+$/is", $service_tel)) { $error_service_tel = 1; $error .= "<div class='error'>". $locale['error_007'] ."</div>\n"; }
		if (!empty($service_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $service_email)) { $error_service_email = 1; $error .= "<div class='error'>". $locale['error_008'] ."</div>\n"; }
		if (!empty($service_site) && !eregi("^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$", $service_site)) { $error_service_site = 1; $error .= "<div class='error'>". $locale['error_009'] ."</div>\n"; }


		if (empty($service_images1)) { $error_service_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

		$valid_types=array("gif","jpg","png","jpeg");  // допустимые расширения

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

		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);

			if (!empty($service_images1)) {
				$service_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
				$service_images1namerl = "rl". $service_images1name;
				$service_images1namesm = "sm". $service_images1name;
				copy($service_images1tmp, IMAGES . $settings['services_foto_dir'] ."/". $service_images1name);
				img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images1name, IMAGES . $settings['services_foto_dir'] ."/". $service_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images1name, IMAGES . $settings['services_foto_dir'] ."/". $service_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['services_foto_dir'] ."/". $service_images1name);
			}

			if (!empty($service_images2)) {
				$service_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
				$service_images2namerl = "rl". $service_images2name;
				$service_images2namesm = "sm". $service_images2name;
				copy($service_images2tmp, IMAGES . $settings['services_foto_dir'] ."/". $service_images2name);
				img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images2name, IMAGES . $settings['services_foto_dir'] ."/". $service_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images2name, IMAGES . $settings['services_foto_dir'] ."/". $service_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['services_foto_dir'] ."/". $service_images2name);
			}

			if (!empty($service_images3)) {
				$service_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
				$service_images3namerl = "rl". $service_images3name;
				$service_images3namesm = "sm". $service_images3name;
				copy($service_images3tmp, IMAGES . $settings['services_foto_dir'] ."/". $service_images3name);
				img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images3name, IMAGES . $settings['services_foto_dir'] ."/". $service_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['services_foto_dir'] ."/". $service_images3name, IMAGES . $settings['services_foto_dir'] ."/". $service_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['services_foto_dir'] ."/". $service_images3name);
			}


			### INSERT service BEGIN
			$service_imgocher = $service_images1name;
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
			// $service_id = mysql_insert_id();
			$service_id = _DB::$linkes->insert_id;
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
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_010'] ."</b></td><td>". date("d.m.Y H:i:s", $service_today) ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_011'] ."</b></td><td>". $service_id ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_012'] ."</b></td><td>". $service_name ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_013'] ."</b></td><td>". $service_mobiltel ."</td>\n</tr>\n";
				if (!empty($service_tel))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_014'] ."</b></td><td>". $service_tel ."</td>\n</tr>\n"; }
				if (!empty($service_email))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_015'] ."</b></td><td>". $service_email ."</td>\n</tr>\n"; }
				if (!empty($service_site))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_016'] ."</b></td><td>". $service_site ."</td>\n</tr>\n"; }
				if (!empty($service_elaveinfo)){ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_017'] ."</b></td><td>". $service_elaveinfo ."</td>\n</tr>\n"; }
				$allmsg .= "<tr>\n<td colspan='2'> </td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>---</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['sitename'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteurl'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteemail'] ."</td>\n</tr>\n";
				$allmsg .= "</table>\n";

				// Отправляем письмо майлеру
				mail($settings['siteemail'], $service_name ." ". $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END
			

			$result_alter = dbquery("ALTER TABLE `". DB_SERVICES ."` ORDER BY `service_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

			echo "<div class='success'>". $locale['success_001'] ."<b>". $service_id ."</b></div>\n";

			// gormek
			$gormek = 1;
			// gormek

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

		} // Yesli Error Yest
	} // Yesli POST

	if ($gormek!=1) {
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
			<div class="fileds service_tel">
				<label for="service_tel"><?php echo $locale['514']; ?></label>
				<input class="textbox<?php echo ($error_service_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="service_tel" id="service_tel" value="<?php echo $service_tel; ?>" />
			</div>
			<div class="fileds service_email">
				<label for="service_email"><?php echo $locale['515']; ?></label>
				<input class="textbox<?php echo ($error_service_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="service_email" id="service_email" value="<?php echo $service_email; ?>" />
				<?php echo $locale['516']; ?>
			</div>
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
				<input class="textbox<?php echo ($error_service_images1==1 ? " error" : ""); ?>" type="file" name="service_images1" id="service_images1" accept="image/*" />
				<label for="service_images2"><?php echo $locale['521']; ?></label>
				<input class="textbox<?php echo ($error_service_images2==1 ? " error" : ""); ?>" type="file" name="service_images2" id="service_images2" accept="image/*" />
				<label for="service_images3"><?php echo $locale['522']; ?></label>
				<input class="textbox<?php echo ($error_service_images3==1 ? " error" : ""); ?>" type="file" name="service_images3" id="service_images3" accept="image/*" />
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
			<div class="fileds service_submit">
				<a href="#" onclick="document.getElementById('qayda').style.display='block'; return false"><?php echo $locale['591']; ?></a>
				<input class="checkbox" type="checkbox" value="rules" name="service_rules" id="#service_rules" onclick="this.form.service_submit.disabled=!this.form.service_rules.checked" />
				<input disabled class="button" value="<?php echo $locale['590']; ?>" type="submit" name="service_submit" id="service_submit" onclick="return(check())" />
			</div>
			<div class="fileds service_qayda" id="qayda" style="display:none;">
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