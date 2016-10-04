<?php

require_once "../includes/maincore.php";

if (!checkrights("BUYAC") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }


require_once THEMES."templates/admin_header.php";

session_start();

include LOCALE.LOCALESET."admin/buyacars.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);


	if ($_GET['action']=="edit") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."buyacars.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
		echo "		<li><span>". $locale['642'] ."</span></li>\n";
		echo "	</ul>\n";
		echo "</div>\n";
	} else if ($_GET['action']=="add") {
		echo "<div class='breadcrumb'>\n";
		echo "	<ul>\n";
		echo "		<li><a href='". ADMIN . $aidlink ."'>". $locale['640'] ."</a></li>\n";
		echo "		<li><a href='". ADMIN ."buyacars.php". $aidlink ."'>". $locale['641'] ."</a></li>\n";
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

	$viewcompanent = viewcompanent("buyacar", "name");
	$components_id = $viewcompanent['components_id'];

	$result = dbquery("SELECT * FROM ". DB_BUYACARS ." WHERE buyacars_id='". (INT)$_GET['id'] ."'");

	if (dbrows($result)) {
		$data = dbarray($result);

		$result = dbquery("DELETE FROM ". DB_BUYACARS ." WHERE buyacars_id='". $data['buyacars_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $components_id ."' AND seourl_filedid='". $data['buyacars_id'] ."'");
		$result = dbquery("DELETE FROM ". DB_SROK ." WHERE srok_post_type='". $components_id ."' AND srok_post_id='". $data['buyacars_id'] ."'");

	}

	redirect(ADMIN ."buyacars.php". $aidlink ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {


	if ($_POST['buyacars_submit']) {

		$buyacars_id = (INT)$_GET['id'];
		$buyacars_marka = trim(stripinput(censorwords(substr($_POST['buyacars_marka'],0,10))));
		$buyacars_model = trim(stripinput(censorwords(substr($_POST['buyacars_model'],0,10))));
		$buyacars_iliot = trim(stripinput(censorwords(substr($_POST['buyacars_iliot'],0,4))));
		$buyacars_ilido = trim(stripinput(censorwords(substr($_POST['buyacars_ilido'],0,4))));
		$buyacars_yurushot = trim(stripinput(censorwords(substr($_POST['buyacars_yurushot'],0,15))));
		$buyacars_yurushdo = trim(stripinput(censorwords(substr($_POST['buyacars_yurushdo'],0,15))));
		$buyacars_kuzareng = trim(stripinput(censorwords(substr($_POST['buyacars_kuzareng'],0,2))));
		$buyacars_kuzarengmet = trim(stripinput(censorwords(substr($_POST['buyacars_kuzarengmet'],0,1))));
		$buyacars_ban = trim(stripinput(censorwords(substr($_POST['buyacars_ban'],0,1))));
		$buyacars_kuza = trim(stripinput(censorwords(substr($_POST['buyacars_kuza'],0,10))));
		$buyacars_qiymetiot = trim(stripinput(censorwords(substr($_POST['buyacars_qiymetiot'],0,10))));
		$buyacars_qiymetido = trim(stripinput(censorwords(substr($_POST['buyacars_qiymetido'],0,10))));
		$buyacars_valyuta = trim(stripinput(censorwords(substr($_POST['buyacars_valyuta'],0,1))));
		$buyacars_adi = trim(stripinput(censorwords(substr($_POST['buyacars_adi'],0,100))));
		$buyacars_mobiltel = trim(stripinput(censorwords(substr($_POST['buyacars_mobiltel'],0,100))));
		$buyacars_mobiltel = str_replace(" ", "", $buyacars_mobiltel);
		$buyacars_mobiltel = str_replace("(", "", $buyacars_mobiltel);
		$buyacars_mobiltel = str_replace(")", "", $buyacars_mobiltel);
		$buyacars_mobiltel = str_replace("-", "", $buyacars_mobiltel);
		$buyacars_mobiltel = str_replace("_", "", $buyacars_mobiltel);
		$buyacars_tel = trim(stripinput(censorwords(substr($_POST['buyacars_tel'],0,100))));
		$buyacars_tel = str_replace(" ", "", $buyacars_tel);
		$buyacars_tel = str_replace("(", "", $buyacars_tel);
		$buyacars_tel = str_replace(")", "", $buyacars_tel);
		$buyacars_tel = str_replace("-", "", $buyacars_tel);
		$buyacars_tel = str_replace("_", "", $buyacars_tel);
		$buyacars_email = trim(stripinput(censorwords(substr($_POST['buyacars_email'],0,100))));
		$buyacars_elaveinfo = trim(censorwords(substr($_POST['buyacars_elaveinfo'],0,10000)));
		$buyacars_ip = FUSION_IP;
		$buyacars_today = FUSION_TODAY;
		$buyacars_views = 0;

		if ($_POST['buyacars_submit']==$locale['593']) {
			$buyacars_aktiv = 1;
		} else {
			$buyacars_aktiv = trim(stripinput(censorwords(substr($_POST['buyacars_aktiv'],0,1))));
		}
		$buyacars_vip = trim(stripinput(censorwords(substr($_POST['buyacars_vip'],0,1))));

		$sms_send = trim(stripinput(censorwords(substr((INT)$_POST['sms_send'],0,1))));
		$mail_send = trim(stripinput(censorwords(substr((INT)$_POST['mail_send'],0,1))));

		$car_srok_date = trim(stripinput(censorwords(substr($_POST['car_srok_date'],0,15))));

		if ($_GET['action']=="edit") {
			$viewcompanent = viewcompanent("buyacar", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $buyacars_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$buyacars_srok = $data_srok['srok_date']+$car_srok_date;;
			} // Yesli result_srok DB query yest
		} else {
			$buyacars_srok = (FUSION_TODAY+$settings['qalmavaxti'])+$car_srok_date;
		}

	} else if ($_GET['action']=="edit") {

		$result = dbquery("SELECT * FROM ". DB_BUYACARS ." WHERE buyacars_id='". (INT)$_GET['id'] ."'");

		if (dbrows($result)) {
			$data = dbarray($result);

			$buyacars_id = $data['buyacars_id'];
			$buyacars_marka = $data['buyacars_marka'];
			$buyacars_model = $data['buyacars_model'];
			$buyacars_iliot = $data['buyacars_iliot'];
			$buyacars_ilido = $data['buyacars_ilido'];
			$buyacars_yurushot = $data['buyacars_yurushot'];
			$buyacars_yurushdo = $data['buyacars_yurushdo'];
			$buyacars_kuzareng = $data['buyacars_kuzareng'];
			$buyacars_kuzarengmet = $data['buyacars_kuzarengmet'];
			$buyacars_ban = $data['buyacars_ban'];
			$buyacars_kuza = $data['buyacars_kuza'];
			$buyacars_qiymetiot = $data['buyacars_qiymetiot'];
			$buyacars_qiymetido = $data['buyacars_qiymetido'];
			$buyacars_valyuta = $data['buyacars_valyuta'];
			$buyacars_adi = $data['buyacars_adi'];
			$buyacars_mobiltel = $data['buyacars_mobiltel'];
			$buyacars_tel = $data['buyacars_tel'];
			$buyacars_email = $data['buyacars_email'];
			$buyacars_elaveinfo = $data['buyacars_elaveinfo'];
			$buyacars_ip = $data['buyacars_ip'];
			$buyacars_today = $data['buyacars_today'];
			$buyacars_views = $data['buyacars_views'];
			$buyacars_aktiv = $data['buyacars_aktiv'];
			$buyacars_vip = $data['buyacars_vip'];

			if ($buyacars_aktiv==2) {
				$mail_send = 1;
				$sms_send = 1;
			} else {
				$mail_send = 0;
				$sms_send = 0;
			}

			$viewcompanent = viewcompanent("buyacar", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $buyacars_id;

			$result_srok = dbquery("SELECT * FROM ". DB_SROK ." WHERE srok_post_type='". $srok_post_type ."' AND srok_post_id='". $srok_post_id ."'");
			if (dbrows($result_srok)) {
				$data_srok = dbarray($result_srok);
				$buyacars_srok = $data_srok['srok_date'];
			} // Yesli result_srok DB query yest

		} // Yesli DB query yest

	} else {

		$buyacars_marka = "";
		$buyacars_model = "";
		$buyacars_iliot = "";
		$buyacars_ilido = "";
		$buyacars_yurushot = "";
		$buyacars_yurushdo = "";
		$buyacars_kuzareng = "";
		$buyacars_kuzarengmet = "";
		$buyacars_ban = "";
		$buyacars_kuza = "";
		$buyacars_qiymetiot = "";
		$buyacars_qiymetido = "";
		$buyacars_valyuta = "";
		$buyacars_adi = "";
		$buyacars_mobiltel = "+994";
		$buyacars_tel = "+994";
		$buyacars_email = "";
		$buyacars_elaveinfo = "";
		$buyacars_ip = FUSION_IP;
		$buyacars_today = FUSION_TODAY;
		$buyacars_views = 0;
		$buyacars_aktiv = 2;
		$buyacars_vip = 0;

		$mail_send = 1;
		$sms_send = 1;

		$buyacars_srok = FUSION_TODAY+$settings['qalmavaxti'];

	}

	if ($_POST['buyacars_submit']) {

		if (empty($buyacars_marka)) { $error_buyacars_marka = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
		if (empty($buyacars_model)) { $error_buyacars_model = 1; $error .= "<div class='error'>". $locale['error_011'] ."</div>\n"; }

		if (empty($buyacars_iliot)) { $error_buyacars_iliot = 1; $error .= "<div class='error'>". $locale['error_020'] ."</div>\n"; }
		if (empty($buyacars_ilido)) { $error_buyacars_ilido = 1; $error .= "<div class='error'>". $locale['error_021'] ."</div>\n"; }
		if ((INT)$buyacars_iliot>(INT)$buyacars_ilido) { $error_buyacars_iliot = 1; $error_buyacars_ilido = 1; $error .= "<div class='error'>". $locale['error_022'] ."</div>\n"; }
		if ($buyacars_yurushot=="") { $error_buyacars_yurushot = 1; $error .= "<div class='error'>". $locale['error_023'] ."</div>\n"; }
		if ($buyacars_yurushot!="" && !preg_match("/^([0-9])+$/is", $buyacars_yurushot)) { $error_buyacars_yurushot = 1; $error .= "<div class='error'>". $locale['error_024'] ."</div>\n"; }
		if ($buyacars_yurushdo=="") { $error_buyacars_yurushdo = 1; $error .= "<div class='error'>". $locale['error_025'] ."</div>\n"; }
		if ($buyacars_yurushdo!="" && !preg_match("/^([0-9])+$/is", $buyacars_yurushdo)) { $error_buyacars_yurushdo = 1; $error .= "<div class='error'>". $locale['error_026'] ."</div>\n"; }
		if ((INT)$buyacars_yurushot>(INT)$buyacars_yurushdo) { $error_buyacars_yurushot = 1; $error_buyacars_yurushdo = 1; $error .= "<div class='error'>". $locale['error_027'] ."</div>\n"; }

		if (empty($buyacars_kuzareng)) { $error_buyacars_kuzareng = 1; $error .= "<div class='error'>". $locale['error_030'] ."</div>\n"; }
		if (empty($buyacars_ban)) { $error_buyacars_ban = 1; $error .= "<div class='error'>". $locale['error_031'] ."</div>\n"; }
		if (empty($buyacars_kuza)) { $error_buyacars_kuza = 1; $error .= "<div class='error'>". $locale['error_032'] ."</div>\n"; }

		if ($buyacars_qiymetiot=="") { $error_buyacars_qiymetiot = 1; $error .= "<div class='error'>". $locale['error_040'] ."</div>\n"; }
		if ($buyacars_qiymetiot!="" && !preg_match("/^([0-9])+$/is", $buyacars_qiymetiot)) { $error_buyacars_qiymetiot = 1; $error .= "<div class='error'>". $locale['error_041'] ."</div>\n"; }
		if ($buyacars_qiymetido=="") { $error_buyacars_qiymetido = 1; $error .= "<div class='error'>". $locale['error_042'] ."</div>\n"; }
		if ($buyacars_qiymetido!="" && !preg_match("/^([0-9])+$/is", $buyacars_qiymetido)) { $error_buyacars_qiymetido = 1; $error .= "<div class='error'>". $locale['error_043'] ."</div>\n"; }
		if ((INT)$buyacars_qiymetiot>(INT)$buyacars_qiymetido) { $error_buyacars_qiymetiot = 1; $error_buyacars_qiymetido = 1; $error .= "<div class='error'>". $locale['error_044'] ."</div>\n"; }


		if (empty($buyacars_adi)) { $error_buyacars_adi = 1; $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
		if (empty($buyacars_mobiltel)) { $error_buyacars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
		// if (strlen($buyacars_mobiltel) < 13) { $error_buyacars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
		// if (!empty($buyacars_mobiltel) && !preg_match("/^([0-9])+$/is", $buyacars_mobiltel)) { $error_buyacars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
		// if (empty($buyacars_tel)) { $error_buyacars_tel = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
		// if (strlen($buyacars_tel) < 13) { $error_buyacars_tel = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
		// if (!empty($buyacars_tel) && !preg_match("/^([0-9])+$/is", $buyacars_tel)) { $error_buyacars_tel = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
		if (!empty($buyacars_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $buyacars_email)) { $error_buyacars_email = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }

		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {


		if ($_GET['action']=="edit") {

			### UPDATE buyacars BEGIN
			if ($buyacars_tel=="+994") { $buyacars_tel=""; }

			$result = dbquery(
				"UPDATE ". DB_BUYACARS ." SET
												buyacars_marka='". $buyacars_marka ."',
												buyacars_model='". $buyacars_model ."',
												buyacars_iliot='". $buyacars_iliot ."',
												buyacars_ilido='". $buyacars_ilido ."',
												buyacars_yurushot='". $buyacars_yurushot ."',
												buyacars_yurushdo='". $buyacars_yurushdo ."',
												buyacars_kuzareng='". $buyacars_kuzareng ."',
												buyacars_kuzarengmet='". $buyacars_kuzarengmet ."',
												buyacars_ban='". $buyacars_ban ."',
												buyacars_kuza='". $buyacars_kuza ."',
												buyacars_qiymetiot='". $buyacars_qiymetiot ."',
												buyacars_qiymetido='". $buyacars_qiymetido ."',
												buyacars_valyuta='". $buyacars_valyuta ."',
												buyacars_adi='". $buyacars_adi ."',
												buyacars_mobiltel='". $buyacars_mobiltel ."',
												buyacars_tel='". $buyacars_tel ."',
												buyacars_email='". $buyacars_email ."',
												buyacars_elaveinfo='". $buyacars_elaveinfo ."',
												buyacars_aktiv='". $buyacars_aktiv ."',
												buyacars_vip='". $buyacars_vip ."'
				WHERE buyacars_id='". $buyacars_id ."'"
			);
			### UPDATE buyacars END


			### UPDATE SROK BEGIN
			$viewcompanent = viewcompanent("buyacar", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $buyacars_id;
			$srok_date = $buyacars_srok;

			$result = dbquery(
				"UPDATE ". DB_SROK ." SET
												srok_date='". $srok_date ."'
				WHERE srok_post_id='". $srok_post_id ."' AND srok_post_type='". $srok_post_type ."'"
			);
			### UPDATE SROK END


		} else if ($_GET['action']=="add") {

			### INSERT buyacars BEGIN
			if ($buyacars_tel=="+994") { $buyacars_tel=""; }
			
			$result = dbquery(
				"INSERT INTO ". DB_BUYACARS ." (
												buyacars_marka,
												buyacars_model,
												buyacars_iliot,
												buyacars_ilido,
												buyacars_yurushot,
												buyacars_yurushdo,
												buyacars_kuzareng,
												buyacars_kuzarengmet,
												buyacars_ban,
												buyacars_kuza,
												buyacars_qiymetiot,
												buyacars_qiymetido,
												buyacars_valyuta,
												buyacars_adi,
												buyacars_mobiltel,
												buyacars_tel,
												buyacars_email,
												buyacars_elaveinfo,
												buyacars_ip,
												buyacars_today,
												buyacars_views,
												buyacars_aktiv,
												buyacars_vip
				) VALUES (
												'". $buyacars_marka ."',
												'". $buyacars_model ."',
												'". $buyacars_iliot ."',
												'". $buyacars_ilido ."',
												'". $buyacars_yurushot ."',
												'". $buyacars_yurushdo ."',
												'". $buyacars_kuzareng ."',
												'". $buyacars_kuzarengmet ."',
												'". $buyacars_ban ."',
												'". $buyacars_kuza ."',
												'". $buyacars_qiymetiot ."',
												'". $buyacars_qiymetido ."',
												'". $buyacars_valyuta ."',
												'". $buyacars_adi ."',
												'". $buyacars_mobiltel ."',
												'". $buyacars_tel ."',
												'". $buyacars_email ."',
												'". $buyacars_elaveinfo ."',
												'". $buyacars_ip ."',
												'". $buyacars_today ."',
												'". $buyacars_views ."',
												'". $buyacars_aktiv ."',
												'". $buyacars_vip ."'

				)"
			);
			$buyacars_id = mysql_insert_id();
			### INSERT buyacars END


			### INSERT SEOURL BEGIN
			$seourl_url = "buyacar". $buyacars_id .".php";
			$viewcompanent = viewcompanent("buyacar", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = $buyacars_id;

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
			$viewcompanent = viewcompanent("buyacar", "name");
			$srok_post_type = $viewcompanent['components_id'];
			$srok_post_id = $buyacars_id;
			$srok_date = $buyacars_srok;

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
			if (($settings['sendsms']==1) && ($sms_send==1) && ($buyacars_aktiv==1) && (!empty($buyacars_mobiltel))) {

				include INCLUDES .'smsapi/config.php';
				include INCLUDES .'smsapi/Addressbook.php';
				include INCLUDES .'smsapi/Exceptions.php';
				include INCLUDES .'smsapi/Account.php';
				include INCLUDES .'smsapi/Stat.php';


				$sender = substr($settings['sitename'], 0, 11);
				$text = sprintf($locale['sms_001'], $buyacars_id);
				$phone = $buyacars_mobiltel;
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
			if (($settings['sendmail']==1) && ($buyacars_aktiv==1) && (!empty($buyacars_email))) {

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "". $locale['mail_010'] ." <b>". $buyacars_id ."</b><br />\n";
				$allmsg .= "". $locale['mail_011'] ."<br />\n";
				$allmsg .= "<a href='". $settings['siteurl'] ."buyacar". $buyacars_id .".php' target='_blank'>". $settings['siteurl'] ."buyacar". $buyacars_id .".php</a><br /><br />\n";
				$allmsg .= "". $locale['mail_012'] ."<br />\n";
				$allmsg .= "". $settings['sitename'] ."<br />\n";
				$allmsg .= "". $settings['siteurl'] ."<br />\n";
				$allmsg .= "". $settings['siteemail'] ."<br />\n";

				// Отправляем письмо майлеру
				mail($buyacars_email, $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END


			$result_alter = dbquery("ALTER TABLE `". DB_BUYACARS ."` ORDER BY `buyacars_id` DESC");

			
			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];



			unset($buyacars_marka);
			unset($buyacars_model);
			unset($buyacars_iliot);
			unset($buyacars_ilido);
			unset($buyacars_yurushot);
			unset($buyacars_yurushdo);
			unset($buyacars_kuzareng);
			unset($buyacars_kuzarengmet);
			unset($buyacars_ban);
			unset($buyacars_kuza);
			unset($buyacars_qiymetiot);
			unset($buyacars_qiymetido);
			unset($buyacars_valyuta);
			unset($buyacars_adi);
			unset($buyacars_mobiltel);
			unset($buyacars_tel);
			unset($buyacars_email);
			unset($buyacars_elaveinfo);
			unset($buyacars_ip);
			unset($buyacars_today);
			unset($buyacars_views);
			unset($buyacars_aktiv);
			unset($buyacars_vip);

			unset($buyacars_srok);


			if ($_GET['action']=="edit") {
				redirect(ADMIN ."buyacars.php". $aidlink ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} else if ($_GET['action']=="add") {
				redirect(ADMIN ."buyacars.php". $aidlink ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);
			} // Edit ili Add redirect


		} // Yesli Error Yest
	} // Yesli POST

?>

<script type="text/javascript">
	<!--
	function kreditvalidate(buyacars_kredit) {
		if (buyacars_kredit.checked == 1) {
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
	
	-->
</script>



<?php add_to_head ("<script type='text/javascript' src='". THEME ."js/jquery.inputmask.js'></script>"); ?>
<?php add_to_head ("<script type='text/javascript'>// <![CDATA[
$(document).ready(function() {
	$('#buyacars_mobiltel').inputmask('+999 ( 99 ) 999-99-99');
	$('#buyacars_tel').inputmask('+999 ( 99 ) 999-99-99');
    });
// ]]></script>"); ?>


<form method="POST" name="addbuyacar" id="addbuyacar" action="<?php echo FUSION_URI; ?>">
	<div class="addbuyacars">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds buyacars_marka">
				<label for="buyacars_marka"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_buyacars_marka==1 ? " error" : ""); ?>" name="buyacars_marka" id="buyacars_marka" onchange="dynamicSelect('buyacars_marka','buyacars_model');">
					<option value=""<?php echo ($buyacars_marka=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
	<?php
		$result = dbquery("SELECT
									marka_id,
									marka_name
							FROM ". DB_MARKA ."
							ORDER BY `marka_name`");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
	?>
					<option value="<?php echo $data['marka_id']; ?>"<?php echo ($data['marka_id']==$buyacars_marka ? " selected" : ""); ?>><?php echo $data['marka_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
				</select>
			</div>
			<div class="fileds buyacars_model">
				<label for="buyacars_model"><?php echo $locale['510']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_buyacars_model==1 ? " error" : ""); ?>" name="buyacars_model" id="buyacars_model">
					<option value=""<?php echo ($buyacars_model=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
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
					<option class="<?php echo $data['model_marka_id']; ?>" value="<?php echo $data['model_id']; ?>"<?php echo ($data['model_id']==$buyacars_model ? " selected" : ""); ?>><?php echo $data['model_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
				</select>
				<script type="text/javascript">
					<!--
					dynamicSelect('buyacars_marka','buyacars_model');
					-->
				</script>
			</div>
			<div class="fileds buyacars_ili">
				<label for="buyacars_iliot"><?php echo $locale['520']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_buyacars_iliot==1 ? " error" : ""); ?>" name="buyacars_iliot" id="buyacars_iliot">
					<option value=""<?php echo ($buyacars_iliot=="" ? " selected" : ""); ?>><?php echo $locale['505']; ?></option>
	<?php
		$yaerilot1 = date('Y')+1;
		$yaerilot2 = $yaerilot1-60;
		for ($yiot = $yaerilot1; $yiot >= $yaerilot2; $yiot--) {
	?>
					<option value="<?php echo $yiot; ?>"<?php echo ($yiot==$buyacars_iliot ? " selected" : ""); ?>><?php echo $yiot; ?></option>
	<?php
		} // for
	?>
				</select>
				-
				<select class="select<?php echo ($error_buyacars_ilido==1 ? " error" : ""); ?>" name="buyacars_ilido" id="buyacars_ilido">
					<option value=""<?php echo ($buyacars_ilido=="" ? " selected" : ""); ?>><?php echo $locale['506']; ?></option>
	<?php
		$yaerildo1 = date('Y')+1;
		$yaerildo2 = $yaerildo1-60;
		for ($yido = $yaerildo1; $yido >= $yaerildo2; $yido--) {
	?>
					<option value="<?php echo $yido; ?>"<?php echo ($yido==$buyacars_ilido ? " selected" : ""); ?>><?php echo $yido; ?></option>
	<?php
		} // for
	?>
				</select>				
			</div>
			<div class="fileds buyacars_yurush">
				<label for="buyacars_yurushot"><?php echo $locale['521']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_buyacars_yurushot==1 ? " error" : ""); ?>" type="text" maxlength="15" name="buyacars_yurushot" id="buyacars_yurushot" value="<?php echo $buyacars_yurushot; ?>" placeholder="<?php echo $locale['505']; ?>" />
				-
				<input class="textbox<?php echo ($error_buyacars_yurushdo==1 ? " error" : ""); ?>" type="text" maxlength="15" name="buyacars_yurushdo" id="buyacars_yurushdo" value="<?php echo $buyacars_yurushdo; ?>" placeholder="<?php echo $locale['506']; ?>" />
			</div>
			<div class="fileds buyacars_kuzareng">
				<label for="buyacars_kuzareng"><?php echo $locale['530']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_buyacars_kuzareng==1 ? " error" : ""); ?>" name="buyacars_kuzareng" id="buyacars_kuzareng">
					<option value=""<?php echo ($buyacars_kuzareng=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="2"<?php echo ($buyacars_kuzareng==2 ? " selected" : ""); ?>><?php echo $locale['kuzareng_2']; ?></option>
					<option value="12"<?php echo ($buyacars_kuzareng==12 ? " selected" : ""); ?>><?php echo $locale['kuzareng_12']; ?></option>
					<option value="11"<?php echo ($buyacars_kuzareng==11 ? " selected" : ""); ?>><?php echo $locale['kuzareng_11']; ?></option>
					<option value="7"<?php echo ($buyacars_kuzareng==7 ? " selected" : ""); ?>><?php echo $locale['kuzareng_7']; ?></option>
					<option value="21"<?php echo ($buyacars_kuzareng==21 ? " selected" : ""); ?>><?php echo $locale['kuzareng_21']; ?></option>
					<option value="3"<?php echo ($buyacars_kuzareng==3 ? " selected" : ""); ?>><?php echo $locale['kuzareng_3']; ?></option>
					<option value="8"<?php echo ($buyacars_kuzareng==8 ? " selected" : ""); ?>><?php echo $locale['kuzareng_8']; ?></option>
					<option value="9"<?php echo ($buyacars_kuzareng==9 ? " selected" : ""); ?>><?php echo $locale['kuzareng_9']; ?></option>
					<option value="15"<?php echo ($buyacars_kuzareng==15 ? " selected" : ""); ?>><?php echo $locale['kuzareng_15']; ?></option>
					<option value="5"<?php echo ($buyacars_kuzareng==5 ? " selected" : ""); ?>><?php echo $locale['kuzareng_5']; ?></option>
					<option value="10"<?php echo ($buyacars_kuzareng==10 ? " selected" : ""); ?>><?php echo $locale['kuzareng_10']; ?></option>
					<option value="1"<?php echo ($buyacars_kuzareng==1 ? " selected" : ""); ?>><?php echo $locale['kuzareng_1']; ?></option>
					<option value="14"<?php echo ($buyacars_kuzareng==14 ? " selected" : ""); ?>><?php echo $locale['kuzareng_14']; ?></option>
					<option value="6"<?php echo ($buyacars_kuzareng==6 ? " selected" : ""); ?>><?php echo $locale['kuzareng_6']; ?></option>
					<option value="35"<?php echo ($buyacars_kuzareng==35 ? " selected" : ""); ?>><?php echo $locale['kuzareng_35']; ?></option>
					<option value="27"<?php echo ($buyacars_kuzareng==27 ? " selected" : ""); ?>><?php echo $locale['kuzareng_27']; ?></option>
					<option value="4"<?php echo ($buyacars_kuzareng==4 ? " selected" : ""); ?>><?php echo $locale['kuzareng_4']; ?></option>
				</select>
			</div>
			<div class="fileds buyacars_kuzarengmet">
				<label for="buyacars_kuzarengmet"><?php echo $locale['521']; ?></label>
				<input class="checkbox<?php echo ($error_buyacars_kuzarengmet==1 ? " error" : ""); ?>" type="checkbox" value="1" name="buyacars_kuzarengmet" id="buyacars_kuzarengmet"<?php echo ($buyacars_kuzarengmet==1 ? " checked" : ""); ?> />
			</div>

			<div class="fileds buyacars_ban">
				<label for="buyacars_ban"><?php echo $locale['532']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_buyacars_ban==1 ? " error" : ""); ?>" name="buyacars_ban" id="buyacars_ban" onchange="dynamicSelect('buyacars_ban','buyacars_kuza');">
					<option value=""<?php echo ($buyacars_ban=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option value="1"<?php echo ($buyacars_ban==1 ? " selected" : ""); ?>><?php echo $locale['ban_1']; ?></option>
					<option value="2"<?php echo ($buyacars_ban==2 ? " selected" : ""); ?>><?php echo $locale['ban_2']; ?></option>
					<!--<option value="3"<?php echo ($buyacars_ban==3 ? " selected" : ""); ?>><?php echo $locale['ban_3']; ?></option>-->
					<option value="4"<?php echo ($buyacars_ban==4 ? " selected" : ""); ?>><?php echo $locale['ban_4']; ?></option>
					<!--<option value="5"<?php echo ($buyacars_ban==5 ? " selected" : ""); ?>><?php echo $locale['ban_5']; ?></option>-->
					<option value="6"<?php echo ($buyacars_ban==6 ? " selected" : ""); ?>><?php echo $locale['ban_6']; ?></option>
					<option value="7"<?php echo ($buyacars_ban==7 ? " selected" : ""); ?>><?php echo $locale['ban_7']; ?></option>
					<!--<option value="8"<?php echo ($buyacars_ban==8 ? " selected" : ""); ?>><?php echo $locale['ban_8']; ?></option>-->
					<!--<option value="9"<?php echo ($buyacars_ban==9 ? " selected" : ""); ?>><?php echo $locale['ban_9']; ?></option>-->
				</select>
			</div>
			<div class="fileds buyacars_kuza">
				<label for="buyacars_kuza"><?php echo $locale['533']; ?><?php echo UL; ?></label>
				<select class="select<?php echo ($error_buyacars_kuza==1 ? " error" : ""); ?>" name="buyacars_kuza" id="buyacars_kuza">
					<option value=""<?php echo ($buyacars_kuza=="" ? " selected" : ""); ?>><?php echo $locale['501']; ?></option>
					<option class='1' value='1'<?php echo ($buyacars_kuza==1 ? " selected" : ""); ?>><?php echo $locale['kuza_1']; ?></option>
					<option class='1' value='2'<?php echo ($buyacars_kuza==2 ? " selected" : ""); ?>><?php echo $locale['kuza_2']; ?></option>
					<option class='1' value='3'<?php echo ($buyacars_kuza==3 ? " selected" : ""); ?>><?php echo $locale['kuza_3']; ?></option>
					<option class='1' value='4'<?php echo ($buyacars_kuza==4 ? " selected" : ""); ?>><?php echo $locale['kuza_4']; ?></option>
					<option class='1' value='5'<?php echo ($buyacars_kuza==5 ? " selected" : ""); ?>><?php echo $locale['kuza_5']; ?></option>
					<option class='1' value='6'<?php echo ($buyacars_kuza==6 ? " selected" : ""); ?>><?php echo $locale['kuza_6']; ?></option>
					<option class='1' value='7'<?php echo ($buyacars_kuza==7 ? " selected" : ""); ?>><?php echo $locale['kuza_7']; ?></option>
					<option class='1' value='8'<?php echo ($buyacars_kuza==8 ? " selected" : ""); ?>><?php echo $locale['kuza_8']; ?></option>
					<option class='1' value='9'<?php echo ($buyacars_kuza==9 ? " selected" : ""); ?>><?php echo $locale['kuza_9']; ?></option>
					<option class='2' value='10'<?php echo ($buyacars_kuza==10 ? " selected" : ""); ?>><?php echo $locale['kuza_10']; ?></option>
					<option class='2' value='12'<?php echo ($buyacars_kuza==12 ? " selected" : ""); ?>><?php echo $locale['kuza_12']; ?></option>
					<option class='2' value='13'<?php echo ($buyacars_kuza==13 ? " selected" : ""); ?>><?php echo $locale['kuza_13']; ?></option>
					<option class='2' value='15'<?php echo ($buyacars_kuza==15 ? " selected" : ""); ?>><?php echo $locale['kuza_15']; ?></option>
					<option class='2' value='18'<?php echo ($buyacars_kuza==18 ? " selected" : ""); ?>><?php echo $locale['kuza_18']; ?></option>
					<option class='2' value='26'<?php echo ($buyacars_kuza==26 ? " selected" : ""); ?>><?php echo $locale['kuza_26']; ?></option>
					<option class='2' value='30'<?php echo ($buyacars_kuza==30 ? " selected" : ""); ?>><?php echo $locale['kuza_30']; ?></option>
					<option class='2' value='38'<?php echo ($buyacars_kuza==38 ? " selected" : ""); ?>><?php echo $locale['kuza_38']; ?></option>
					<option class='2' value='41'<?php echo ($buyacars_kuza==41 ? " selected" : ""); ?>><?php echo $locale['kuza_41']; ?></option>
					<option class='4' value='51'<?php echo ($buyacars_kuza==51 ? " selected" : ""); ?>><?php echo $locale['kuza_51']; ?></option>
					<option class='4' value='63'<?php echo ($buyacars_kuza==63 ? " selected" : ""); ?>><?php echo $locale['kuza_63']; ?></option>
					<option class='4' value='65'<?php echo ($buyacars_kuza==65 ? " selected" : ""); ?>><?php echo $locale['kuza_65']; ?></option>
					<option class='4' value='107'<?php echo ($buyacars_kuza==107 ? " selected" : ""); ?>><?php echo $locale['kuza_107']; ?></option>
					<option class='6' value='112'<?php echo ($buyacars_kuza==112 ? " selected" : ""); ?>><?php echo $locale['kuza_112']; ?></option>
					<option class='6' value='113'<?php echo ($buyacars_kuza==113 ? " selected" : ""); ?>><?php echo $locale['kuza_113']; ?></option>
					<option class='6' value='114'<?php echo ($buyacars_kuza==114 ? " selected" : ""); ?>><?php echo $locale['kuza_114']; ?></option>
					<option class='6' value='115'<?php echo ($buyacars_kuza==115 ? " selected" : ""); ?>><?php echo $locale['kuza_115']; ?></option>
					<option class='6' value='116'<?php echo ($buyacars_kuza==116 ? " selected" : ""); ?>><?php echo $locale['kuza_116']; ?></option>
					<option class='7' value='117'<?php echo ($buyacars_kuza==117 ? " selected" : ""); ?>><?php echo $locale['kuza_117']; ?></option>
					<option class='7' value='122'<?php echo ($buyacars_kuza==122 ? " selected" : ""); ?>><?php echo $locale['kuza_122']; ?></option>
					<option class='7' value='124'<?php echo ($buyacars_kuza==124 ? " selected" : ""); ?>><?php echo $locale['kuza_124']; ?></option>
					<option class='7' value='134'<?php echo ($buyacars_kuza==134 ? " selected" : ""); ?>><?php echo $locale['kuza_134']; ?></option>
					<option class='7' value='135'<?php echo ($buyacars_kuza==135 ? " selected" : ""); ?>><?php echo $locale['kuza_135']; ?></option>
					<option class='7' value='136'<?php echo ($buyacars_kuza==136 ? " selected" : ""); ?>><?php echo $locale['kuza_136']; ?></option>
					<option class='7' value='145'<?php echo ($buyacars_kuza==145 ? " selected" : ""); ?>><?php echo $locale['kuza_145']; ?></option> 
				</select>
				<script type="text/javascript">
					<!--
					dynamicSelect('buyacars_ban','buyacars_kuza');
					-->
				</script>
			</div>
			<div class="hr"></div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds buyacars_qiymeti">
				<label for="buyacars_qiymetiot"><?php echo $locale['540']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_buyacars_qiymetiot==1 ? " error" : ""); ?>" type="text" maxlength="10" name="buyacars_qiymetiot" id="buyacars_qiymetiot" value="<?php echo $buyacars_qiymetiot; ?>" placeholder="<?php echo $locale['506']; ?>" />
				-
				<input class="textbox<?php echo ($error_buyacars_qiymetido==1 ? " error" : ""); ?>" type="text" maxlength="10" name="buyacars_qiymetido" id="buyacars_qiymetido" value="<?php echo $buyacars_qiymetido; ?>" placeholder="<?php echo $locale['506']; ?>" />
				<select class="select<?php echo ($error_buyacars_valyuta==1 ? " error" : ""); ?>" name="buyacars_valyuta" id="buyacars_valyuta">
					<option value="1"<?php echo ($buyacars_valyuta==1 ? " selected" : ""); ?>><?php echo $locale['valyuta_1']; ?></option>
					<option value="2"<?php echo ($buyacars_valyuta==2 ? " selected" : ""); ?>><?php echo $locale['valyuta_2']; ?></option>
					<option value="3"<?php echo ($buyacars_valyuta==3 ? " selected" : ""); ?>><?php echo $locale['valyuta_3']; ?></option>
				</select>
			</div>


			<div class="fileds buyacars_adi">
				<label for="buyacars_adi"><?php echo $locale['541']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_buyacars_adi==1 ? " error" : ""); ?>" type="text" maxlength="100" name="buyacars_adi" id="buyacars_adi" value="<?php echo $buyacars_adi; ?>" />
			</div>

			<div class="fileds buyacars_mobiltel">
				<label for="buyacars_mobiltel"><?php echo $locale['542']; ?><?php echo UL; ?></label>
				<input class="textbox<?php echo ($error_buyacars_mobiltel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="buyacars_mobiltel" id="buyacars_mobiltel" value="<?php echo $buyacars_mobiltel; ?>" />
			</div>
			<?php if (($settings['sendsms']==1) && ($buyacars_aktiv==2)) { ?>
			<div class="fileds sms_send">
				<label for="sms_send" style="color:green;"><?php echo $locale['586']; ?></label>
				<input class="checkbox<?php echo ($error_sms_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="sms_send" id="sms_send"<?php echo ($sms_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="fileds buyacars_tel">
				<label for="buyacars_tel"><?php echo $locale['543']; ?></label>
				<input class="textbox<?php echo ($error_buyacars_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="buyacars_tel" id="buyacars_tel" value="<?php echo $buyacars_tel; ?>" />
			</div>
			<div class="fileds buyacars_email">
				<label for="buyacars_email"><?php echo $locale['544']; ?></label>
				<input class="textbox<?php echo ($error_buyacars_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="buyacars_email" id="buyacars_email" value="<?php echo $buyacars_email; ?>" />
			</div>
			<?php if (($settings['sendmail']==1) && ($buyacars_aktiv==2)) { ?>
			<div class="fileds mail_send">
				<label for="mail_send" style="color:green;"><?php echo $locale['587']; ?></label>
				<input class="checkbox<?php echo ($error_mail_send==1 ? " error" : ""); ?>" type="checkbox" value="1" name="mail_send" id="mail_send"<?php echo ($mail_send==1 ? " checked" : ""); ?> />
			</div>
			<?php } ?>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds buyacars_elaveinfo">
				<textarea class="textbox<?php echo ($error_buyacars_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="buyacars_elaveinfo" id="buyacars_elaveinfo"><?php echo $buyacars_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
		</div>

		<div class="bloks blok1">
			<div class="fileds buyacars_ip">
				<label for="buyacars_ip"><?php echo $locale['700']; ?></label>
				<input readonly class="textbox" type="text" name="buyacars_ip" id="buyacars_ip" value="<?php echo $buyacars_ip; ?>" />
			</div>
			<div class="fileds buyacars_today">
				<label for="buyacars_today"><?php echo $locale['701']; ?></label>
				<input readonly class="textbox" type="text" name="buyacars_today" id="buyacars_today" value="<?php echo date("d.m.Y", $buyacars_today); ?>" />
			</div>
			<div class="fileds buyacars_srok">
				<label for="buyacars_srok"><?php echo $locale['702']; ?></label>
				<input readonly class="textbox" type="text" name="buyacars_srok" id="buyacars_srok" value="<?php echo date("d.m.Y", $buyacars_srok); ?>" />
			</div>
			<div class="fileds buyacars_views">
				<label for="buyacars_views"><?php echo $locale['703']; ?></label>
				<input readonly class="textbox" type="text" name="buyacars_views" id="buyacars_views" value="<?php echo $buyacars_views; ?>" />
			</div>
		</div>

		<div class="bloks blok2">
			<div class="fileds buyacars_vip">
				<label for="buyacars_vip"><?php echo $locale['704']; ?></label>
				<select class="select" name="buyacars_vip" id="buyacars_vip">
					<option value="0"<?php echo ($buyacars_vip==0 ? " selected" : ""); ?>><?php echo $locale['vip_0']; ?></option>
					<option value="1"<?php echo ($buyacars_vip==1 ? " selected" : ""); ?>><?php echo $locale['vip_1']; ?></option>
					<option value="2"<?php echo ($buyacars_vip==2 ? " selected" : ""); ?>><?php echo $locale['vip_2']; ?></option>
					<option value="3"<?php echo ($buyacars_vip==3 ? " selected" : ""); ?>><?php echo $locale['vip_3']; ?></option>
					<option value="4"<?php echo ($buyacars_vip==4 ? " selected" : ""); ?>><?php echo $locale['vip_4']; ?></option>
					<option value="5"<?php echo ($buyacars_vip==5 ? " selected" : ""); ?>><?php echo $locale['vip_5']; ?></option>
					<option value="6"<?php echo ($buyacars_vip==6 ? " selected" : ""); ?>><?php echo $locale['vip_6']; ?></option>
				</select>
			</div>
			<div class="fileds buyacars_aktiv">
				<label for="buyacars_aktiv"><?php echo $locale['705']; ?></label>
				<select class="select" name="buyacars_aktiv" id="buyacars_aktiv">
					<option value="0"<?php echo ($buyacars_aktiv==2 ? " selected" : ""); ?>><?php echo $locale['status_0']; ?></option>
					<option value="1"<?php echo ($buyacars_aktiv==1 ? " selected" : ""); ?>><?php echo $locale['status_1']; ?></option>
					<option value="4"<?php echo ($buyacars_aktiv==4 ? " selected" : ""); ?>><?php echo $locale['status_4']; ?></option>
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
			<div class="fileds buyacars_submit">
				<?php if (($_GET['action']=="edit") && ($buyacars_aktiv==2)) { ?>
					<input class="button" value="<?php echo $locale['593']; ?>" type="submit" name="buyacars_submit" id="buyacars_submit" onclick="return(check())" />
				<?php } else { ?>
					<input class="button" value="<?php echo ($_GET['action']=="edit" ? $locale['592'] : $locale['590']); ?>" type="submit" name="buyacars_submit" id="buyacars_submit" onclick="return(check())" />
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
	var ckeditor = CKEDITOR.replace('buyacars_elaveinfo');
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

		$viewcompanent = viewcompanent("buyacar", "name");
		$seourl_component = $viewcompanent['components_id'];

		if ((isset($_GET['order'])) && (isset($_GET['by']))) {
			$order = $_GET['order'];
			$by = $_GET['by'];
		} else {
			$order = "buyacars_id";
			$by = "DESC";
		}

		$result = dbquery("SELECT
									buyacars_id,
									marka_name,
									model_name,
									buyacars_today,
									buyacars_aktiv,
									buyacars_vip,
									seourl_url
							FROM ". DB_BUYACARS ."
							INNER JOIN ". DB_MARKA ." ON ". DB_BUYACARS .".buyacars_marka=". DB_MARKA .".marka_id
							INNER JOIN ". DB_MODEL ." ON ". DB_BUYACARS .".buyacars_model=". DB_MODEL .".model_id 
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=buyacars_id AND seourl_component=". $seourl_component ."
							ORDER BY `". $order ."` ". $by ."
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		echo "<div class='addcar'><a href='". ADMIN ."buyacars.php".  $aidlink ."&action=add'>". $locale['711'] ."</a></div>\n";
		echo "<table class='buyacarslist'>\n";
		echo "		<thead>\n";
		echo "				<tr>\n";
		echo "						<td class='buyacars_id'><a href='". ADMIN ."buyacars.php".  $aidlink ."&order=buyacars_id&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['650'] . ($order=="buyacars_id" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='buyacars_marka'><a href='". ADMIN ."buyacars.php".  $aidlink ."&order=buyacars_marka&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['652'] . ($order=="buyacars_marka" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='buyacars_vip'><a href='". ADMIN ."buyacars.php".  $aidlink ."&order=buyacars_vip&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['653'] . ($order=="buyacars_vip" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='buyacars_aktiv'><a href='". ADMIN ."buyacars.php".  $aidlink ."&order=buyacars_aktiv&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['654'] . ($order=="buyacars_aktiv" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='buyacars_today'><a href='". ADMIN ."buyacars.php".  $aidlink ."&order=buyacars_today&by=". ($by=="DESC" ? "ASC" : "DESC") . ($_GET['page'] ? "&page=". (INT)$_GET['page'] : "") ."'>". $locale['655'] . ($order=="buyacars_today" ? ($by=="DESC" ? " <img src='". IMAGES ."sort_desc.png' alt='". $locale['sort_desc'] ."'>" : " <img src='". IMAGES ."sort_asc.png' alt='". $locale['sort_asc'] ."'>") : "") ."</a></td>\n";
		echo "						<td class='buyacars_href'>". $locale['656'] ."</td>\n";
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
		echo "						<td class='buyacars_id'>#". $data['buyacars_id'] ."</td>\n";
		echo "						<td class='buyacars_name'><a href='". ADMIN ."buyacars.php".  $aidlink ."&action=edit&id=". $data['buyacars_id'] ."'>". $data['marka_name'] ." ". $data['model_name'] ."</a></td>\n";
		echo "						<td class='buyacars_vip'><img src='". IMAGES ."vip_icons/". ($data['buyacars_vip']==0 ? "vip_off.png" : "vip_on.png") ."' alt='". $locale['vip_'. $data['buyacars_vip']] ."' title='". $locale['vip_'. $data['buyacars_vip']] ."'></td>\n";
		echo "						<td class='buyacars_aktiv'><img src='". IMAGES . "status/status_". $data['buyacars_aktiv'] .".png' alt='". $locale['status_'. $data['buyacars_aktiv']] ."' title='". $locale['status_'. $data['buyacars_aktiv']] ."'></td>\n";
		echo "						<td class='buyacars_today'>". date("d.m.Y", $data['buyacars_today']) ."</td>\n";
		echo "						<td class='buyacars_href'>\n";
		echo "							<a class='view' href='". BASEDIR . $data['seourl_url'] ."' target='_blank' title='". $locale['660'] ."'><img src='". IMAGES ."view.png' alt='". $locale['660'] ."'></a>\n";
		echo "							<a class='edit' href='". ADMIN ."buyacars.php".  $aidlink ."&action=edit&id=". $data['buyacars_id'] ."' title='". $locale['661'] ."'><img src='". IMAGES ."edit.png' alt='". $locale['661'] ."'></a>\n";
		echo "							<a class='delete' href='". ADMIN ."buyacars.php".  $aidlink ."&action=delete&id=". $data['buyacars_id'] ."' title='". $locale['662'] ."' onclick='return DeleteOk();'><img src='". IMAGES ."delete.png' alt='". $locale['662'] ."'></a>\n";
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
		echo "						<td class='buyacars_id'>&nbsp;</td>\n";
		echo "						<td class='buyacars_name'>&nbsp;</td>\n";
		echo "						<td class='buyacars_vip'>&nbsp;</td>\n";
		echo "						<td class='buyacars_aktiv'>&nbsp;</td>\n";
		echo "						<td class='buyacars_today'>&nbsp;</td>\n";
		echo "						<td class='buyacars_href'>&nbsp;</td>\n";
		echo "				</tr>\n";
		echo "		</tfoot>\n";
		echo "	</table>\n";


		echo navigation($_GET['page'], $settings['goradmin'], "buyacars_id", DB_BUYACARS, "");
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