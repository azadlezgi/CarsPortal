<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

session_start();

include LOCALE.LOCALESET."addshops.php";

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

	if ($_POST['shop_submit']) {

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

		$shop_images1 =  $_FILES['shop_images1']['name'];
		$shop_images1tmp  = $_FILES['shop_images1']['tmp_name'];
		$shop_images1size = $_FILES['shop_images1']['size'];
		$shop_images1type = $_FILES['shop_images1']['type'];

		$shop_images2 =  $_FILES['shop_images2']['name'];
		$shop_images2tmp  = $_FILES['shop_images2']['tmp_name'];
		$shop_images2size = $_FILES['shop_images2']['size'];
		$shop_images2type = $_FILES['shop_images2']['type'];

		$shop_images3 =  $_FILES['shop_images3']['name'];
		$shop_images3tmp  = $_FILES['shop_images3']['tmp_name'];
		$shop_images3size = $_FILES['shop_images3']['size'];
		$shop_images3type = $_FILES['shop_images3']['type'];

		$shop_elaveinfo = trim(stripinput(censorwords(substr($_POST['shop_elaveinfo'],0,1000))));
		$shop_ip = FUSION_IP;
		$shop_today = FUSION_TODAY;
		$shop_views = 1;
		$shop_aktiv = 2;
		$shop_vip = 0;

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
		$shop_ip = "";
		$shop_today = "";
		$shop_views = "";
		$shop_aktiv = "";
		$shop_vip = "";

	}

	if ($_POST['shop_submit']) {

		if (empty($shop_name)) { $error_shop_name = 1; $error .= "<div class='error'>". $locale['error_001'] ."</div>\n"; }
		if (empty($shop_qorod)) { $error_shop_qorod = 1; $error .= "<div class='error'>". $locale['error_002'] ."</div>\n"; }
		if (empty($shop_adress)) { $error_shop_adress = 1; $error .= "<div class='error'>". $locale['error_003'] ."</div>\n"; }
		if (empty($shop_mobiltel)) { $error_shop_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		if ($shop_mobiltel=="+994") { $error_shop_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (strlen($shop_mobiltel) < 13) { $error_shop_mobiltel = 1; $error .= "<div class='error'>". $locale['error_004'] ."</div>\n"; }
		// if (!empty($shop_mobiltel) && !preg_match("/^([0-9])+$/is", $shop_mobiltel)) { $error_shop_mobiltel = 1; $error .= "<div class='error'>". $locale['error_005'] ."</div>\n"; }
		// if (empty($shop_tel)) { $error_shop_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if ($shop_tel=="+994") { $error_shop_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (strlen($shop_tel) < 13) { $error_shop_tel = 1; $error .= "<div class='error'>". $locale['error_006'] ."</div>\n"; }
		// if (!empty($shop_tel) && !preg_match("/^([0-9])+$/is", $shop_tel)) { $error_shop_tel = 1; $error .= "<div class='error'>". $locale['error_007'] ."</div>\n"; }
		if (!empty($shop_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $shop_email)) { $error_shop_email = 1; $error .= "<div class='error'>". $locale['error_008'] ."</div>\n"; }
		if (!empty($shop_site) && !eregi("^[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$", $shop_site)) { $error_shop_site = 1; $error .= "<div class='error'>". $locale['error_009'] ."</div>\n"; }


		if (empty($shop_images1)) { $error_shop_images1 = 1; $error .= "<div class='error'>". $locale['error_049'] ."</div>\n"; }

		$valid_types=array("gif","jpg","png","jpeg");  // допустимые расширения

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

		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$img_rand_key = mt_rand(100,999);

			if (!empty($shop_images1)) {
				$shop_images1name = FUSION_TODAY . $img_rand_key ."_1.jpg";
				$shop_images1namerl = "rl". $shop_images1name;
				$shop_images1namesm = "sm". $shop_images1name;
				copy($shop_images1tmp, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name);
				img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['shops_foto_dir'] ."/". $shop_images1name);
			}

			if (!empty($shop_images2)) {
				$shop_images2name = FUSION_TODAY . $img_rand_key ."_2.jpg";
				$shop_images2namerl = "rl". $shop_images2name;
				$shop_images2namesm = "sm". $shop_images2name;
				copy($shop_images2tmp, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name);
				img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['shops_foto_dir'] ."/". $shop_images2name);
			}

			if (!empty($shop_images3)) {
				$shop_images3name = FUSION_TODAY . $img_rand_key ."_3.jpg";
				$shop_images3namerl = "rl". $shop_images3name;
				$shop_images3namesm = "sm". $shop_images3name;
				copy($shop_images3tmp, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name);
				img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3namerl, $settings['rlfoto_x'], $settings['rlfoto_y']);
				img_resize(IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name, IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3namesm, $settings['smfoto_x'], $settings['smfoto_y']);
				unlink (IMAGES . $settings['shops_foto_dir'] ."/". $shop_images3name);
			}


			### INSERT shop BEGIN
			$shop_imgocher = $shop_images1name;
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
			// $shop_id = mysql_insert_id();
			$shop_id = _DB::$linkes->insert_id;
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
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_010'] ."</b></td><td>". date("d.m.Y H:i:s", $shop_today) ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_011'] ."</b></td><td>". $shop_id ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_012'] ."</b></td><td>". $shop_name ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_013'] ."</b></td><td>". $shop_mobiltel ."</td>\n</tr>\n";
				if (!empty($shop_tel))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_014'] ."</b></td><td>". $shop_tel ."</td>\n</tr>\n"; }
				if (!empty($shop_email))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_015'] ."</b></td><td>". $shop_email ."</td>\n</tr>\n"; }
				if (!empty($shop_site))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_016'] ."</b></td><td>". $shop_site ."</td>\n</tr>\n"; }
				if (!empty($shop_elaveinfo)){ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_017'] ."</b></td><td>". $shop_elaveinfo ."</td>\n</tr>\n"; }
				$allmsg .= "<tr>\n<td colspan='2'> </td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>---</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['sitename'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteurl'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteemail'] ."</td>\n</tr>\n";
				$allmsg .= "</table>\n";

				// Отправляем письмо майлеру
				mail($settings['siteemail'], $shop_name ." ". $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END

			
			$result_alter = dbquery("ALTER TABLE `". DB_SHOPS ."` ORDER BY `shop_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

			echo "<div class='success'>". $locale['success_001'] ."<b>". $shop_id ."</b></div>\n";

			// gormek
			$gormek = 1;
			// gormek

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

		} // Yesli Error Yest
	} // Yesli POST

	if ($gormek!=1) {
?>


<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#shop_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#shop_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addshop" id="addshop" action="<?php echo FUSION_URI; ?>" enctype="multipart/form-data">
	<div class="addshops">
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
			<div class="fileds shop_tel">
				<label for="shop_tel"><?php echo $locale['514']; ?></label>
				<input class="textbox<?php echo ($error_shop_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="shop_tel" id="shop_tel" value="<?php echo $shop_tel; ?>" />
			</div>
			<div class="fileds shop_email">
				<label for="shop_email"><?php echo $locale['515']; ?></label>
				<input class="textbox<?php echo ($error_shop_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="shop_email" id="shop_email" value="<?php echo $shop_email; ?>" />
				<?php echo $locale['516']; ?>
			</div>
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
				<input class="textbox<?php echo ($error_shop_images1==1 ? " error" : ""); ?>" type="file" name="shop_images1" id="shop_images1" accept="image/*" />
				<label for="shop_images2"><?php echo $locale['521']; ?></label>
				<input class="textbox<?php echo ($error_shop_images2==1 ? " error" : ""); ?>" type="file" name="shop_images2" id="shop_images2" accept="image/*" />
				<label for="shop_images3"><?php echo $locale['522']; ?></label>
				<input class="textbox<?php echo ($error_shop_images3==1 ? " error" : ""); ?>" type="file" name="shop_images3" id="shop_images3" accept="image/*" />
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
			<div class="fileds shop_submit">
				<a href="#" onclick="document.getElementById('qayda').style.display='block'; return false"><?php echo $locale['591']; ?></a>
				<input class="checkbox" type="checkbox" value="rules" name="shop_rules" id="#shop_rules" onclick="this.form.shop_submit.disabled=!this.form.shop_rules.checked" />
				<input disabled class="button" value="<?php echo $locale['590']; ?>" type="submit" name="shop_submit" id="shop_submit" onclick="return(check())" />
			</div>
			<div class="fileds shop_qayda" id="qayda" style="display:none;">
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