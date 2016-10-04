<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

session_start();

include LOCALE.LOCALESET."addbuyacars.php";

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

	if ($_POST['buyacars_submit']) {

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
		$buyacars_elaveinfo = trim(stripinput(censorwords(substr($_POST['buyacars_elaveinfo'],0,1000))));
		$buyacars_ip = FUSION_IP;
		$buyacars_today = FUSION_TODAY;
		$buyacars_views = 1;
		$buyacars_aktiv = 2;
		$buyacars_vip = 0;

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
		$buyacars_ip = "";
		$buyacars_today = "";
		$buyacars_views = "";
		$buyacars_aktiv = "";
		$buyacars_vip = "";

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
		if ($buyacars_mobiltel=="+994") { $error_buyacars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
		// if (strlen($buyacars_mobiltel) < 13) { $error_buyacars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
		// if (!empty($buyacars_mobiltel) && !preg_match("/^([0-9])+$/is", $buyacars_mobiltel)) { $error_buyacars_mobiltel = 1; $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
		// if (empty($buyacars_tel)) { $error_buyacars_tel = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
		// if ($buyacars_tel=="+994") { $error_buyacars_tel = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
		// if (strlen($buyacars_tel) < 13) { $error_buyacars_tel = 1; $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
		// if (!empty($buyacars_tel) && !preg_match("/^([0-9])+$/is", $buyacars_tel)) { $error_buyacars_tel = 1; $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
		if (!empty($buyacars_email) && !eregi("^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$", $buyacars_email)) { $error_buyacars_email = 1; $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }

		if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {


			### INSERT buyacars BEGIN
			$buyacars_imgocher = $buyacars_images1name;
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
			// $buyacars_id = mysql_insert_id();
			$buyacars_id = _DB::$linkes->insert_id;
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

				$result_marka = dbquery("SELECT marka_name FROM ". DB_MARKA ." WHERE marka_id='". $buyacars_marka ."'");
				if (dbrows($result_marka)) {
					$data_marka = dbarray($result_marka);
				}

				$result_model = dbquery("SELECT model_name FROM ". DB_MODEL ." WHERE model_id='". $buyacars_model ."'");
				if (dbrows($result_model)) {
					$data_model = dbarray($result_model);
				}

				$headers=null;
				$headers.="Content-Type: text/html; charset=". $locale['charset'] ."\r\n";
				$headers.="From: ". $settings['sitename'] ." <no-reply@". $settings['site_host'] .">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";

				// Собираем всю информацию в теле письма
				$allmsg .= "<table border='0' width='100%'>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_010'] ."</b></td><td>". date("d.m.Y H:i:s", $buyacars_today) ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_011'] ."</b></td><td>". $buyacars_id ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_012'] ."</b></td><td>". $data_marka['marka_name'] ." - ". $data_model['model_name'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_013'] ."</b></td><td>". $buyacars_adi ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_014'] ."</b></td><td>". $buyacars_mobiltel ."</td>\n</tr>\n";
				if (!empty($buyacars_tel))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_015'] ."</b></td><td>". $buyacars_tel ."</td>\n</tr>\n"; }
				if (!empty($buyacars_email))		{ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_016'] ."</b></td><td>". $buyacars_email ."</td>\n</tr>\n"; }
				if (!empty($buyacars_elaveinfo)){ $allmsg .= "<tr>\n<td width='30%'><b>". $locale['mail_017'] ."</b></td><td>". $buyacars_elaveinfo ."</td>\n</tr>\n"; }
				$allmsg .= "<tr>\n<td colspan='2'> </td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>---</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['sitename'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteurl'] ."</td>\n</tr>\n";
				$allmsg .= "<tr>\n<td colspan='2'>". $settings['siteemail'] ."</td>\n</tr>\n";
				$allmsg .= "</table>\n";

				// Отправляем письмо майлеру
				mail($settings['siteemail'], $buyacars_adi ." ". $locale['mail_001'], $allmsg, $headers);
			} // Yesli sendmail 1
			### SEND MAIL END


			$result_alter = dbquery("ALTER TABLE `". DB_BUYACARS ."` ORDER BY `buyacars_id` DESC");


			$_SESSION["antifludtime"] = FUSION_TODAY+$settings['antifludtime'];

			echo "<div class='success'>". $locale['success_001'] ."<b>". $buyacars_id ."</b></div>\n";

			// gormek
			$gormek = 1;
			// gormek

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

		} // Yesli Error Yest
	} // Yesli POST

	if ($gormek!=1) {
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
			<div class="fileds buyacars_tel">
				<label for="buyacars_tel"><?php echo $locale['543']; ?></label>
				<input class="textbox<?php echo ($error_buyacars_tel==1 ? " error" : ""); ?>" type="text" maxlength="100" name="buyacars_tel" id="buyacars_tel" value="<?php echo $buyacars_tel; ?>" />
			</div>
			<div class="fileds buyacars_email">
				<label for="buyacars_email"><?php echo $locale['544']; ?></label>
				<input class="textbox<?php echo ($error_buyacars_email==1 ? " error" : ""); ?>" type="text" maxlength="100" name="buyacars_email" id="buyacars_email" value="<?php echo $buyacars_email; ?>" />
				<?php echo $locale['545']; ?>
			</div>
			<div class="hr"></div>
		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds buyacars_elaveinfo">
				<textarea class="textbox<?php echo ($error_buyacars_elaveinfo==1 ? " error" : ""); ?>" rows="7" cols="70" name="buyacars_elaveinfo" id="buyacars_elaveinfo"><?php echo $buyacars_elaveinfo; ?></textarea>
			</div>
			<div class="hr"></div>
			<div class="fileds buyacars_submit">
				<a href="#" onclick="document.getElementById('qayda').style.display='block'; return false"><?php echo $locale['591']; ?></a>
				<input class="checkbox" type="checkbox" value="rules" name="buyacars_rules" id="#buyacars_rules" onclick="this.form.buyacars_submit.disabled=!this.form.buyacars_rules.checked" />
				<input disabled class="button" value="<?php echo $locale['590']; ?>" type="submit" name="buyacars_submit" id="buyacars_submit" onclick="return(check())" />
			</div>
			<div class="fileds buyacars_qayda" id="qayda" style="display:none;">
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