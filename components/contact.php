<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."contact.php";

	if (!empty($locale['title'])) add_to_title($locale['title']);
	if (!empty($locale['description'])) add_to_description($locale['description']);
	if (!empty($locale['keywords'])) add_to_keywords($locale['keywords']);

	opentable($locale['h1']);

	if ($_POST['sendmessage']) {

		$error = "";
		$mailname = isset($_POST['mailname']) ? substr(stripinput(trim($_POST['mailname'])), 0, 50) : "";
		$email = isset($_POST['email']) ? substr(stripinput(trim($_POST['email'])), 0, 100) : "";
		$subject = isset($_POST['subject']) ? substr(str_replace(array("\r","\n","@"), "", descript(stripslash(trim($_POST['subject'])))), 0, 50) : "";
		$message = isset($_POST['message']) ? descript(stripslash(trim($_POST['message']))) : "";

		if ($mailname == "") { $error_mailname = 1; $error .= "<div class='error'>". $locale['420'] ."</div>\n"; }
		if ($email == "" || !preg_match("/^[-0-9A-Z_\.]{1,50}@([-0-9A-Z_\.]+\.){1,50}([0-9A-Z]){2,4}$/i", $email)) { $error_email = 1; $error .= "<div class='error'>". $locale['421'] ."</div>\n"; }
		if ($subject == "") { $error_subject = 1; $error .= "<div class='error'>". $locale['422'] ."</div>\n"; }
		if ($message == "") { $error_message = 1; $error .= "<div class='error'>". $locale['423'] ."</div>\n"; }

		$_CAPTCHA_IS_VALID = false;
		include INCLUDES."captchas/".$settings['captcha']."/captcha_check.php";
		if ($_CAPTCHA_IS_VALID == false) { $error_captcha = 1; $error .= "<div class='error'>". $locale['424'] ."</div>\n"; }

		if ($error) {
			echo "<div id='close-message'>\n";
			echo $error;
			echo "</div>\n";
		} else {

			$message .= $locale['441'];

			require_once INCLUDES."sendmail_include.php";
			if (!sendemail($settings['siteusername'],$settings['siteemail'],$mailname,$email,$subject,$message, "html")) {
				echo "<div id='close-message'>\n";
				echo "<div class='error'>". $locale['425'] ."</div>\n";
				echo "</div>\n";
			} else {
				echo "<div class='success'>". $locale['440'] ."</div>\n";
			}

		} // Yesli Error
	} // Yesli POST

		echo $locale['401']."<br /><br />\n";

		echo "<h2>". $locale['450'] ."</h2>\n";
		echo "<form method='POST' name='userform' id='userform' action='". FUSION_URI ."'>\n";
		echo "<table cellpadding='0' cellspacing='0' class='center'>\n<tr>\n";
		echo "<td width='100' class='tbl'>".$locale['402']."</td>\n";
		echo "<td class='tbl'><input type='text' name='mailname' maxlength='50' class='textbox' style='width: 200px;' /></td>\n";
		echo "</tr>\n<tr>\n";
		echo "<td width='100' class='tbl'>".$locale['403']."</td>\n";
		echo "<td class='tbl'><input type='text' name='email' maxlength='100' class='textbox' style='width: 200px;' /></td>\n";
		echo "</tr>\n<tr>\n";
		echo "<td width='100' class='tbl'>".$locale['404']."</td>\n";
		echo "<td class='tbl'><input type='text' name='subject' maxlength='50' class='textbox' style='width: 200px;' /></td>\n";
		echo "</tr>\n<tr>\n";
		echo "<td width='100' class='tbl'>".$locale['405']."</td>\n";
		echo "<td class='tbl'><textarea name='message' rows='10' class='textbox' cols='50'></textarea></td>\n";
		echo "</tr>\n<tr>\n";
		echo "<td width='100' class='tbl'>".$locale['407']."</td>\n";
		echo "<td class='tbl'>";
		include INCLUDES."captchas/".$settings['captcha']."/captcha_display.php";
		if (!isset($_CAPTCHA_HIDE_INPUT) || (isset($_CAPTCHA_HIDE_INPUT) && !$_CAPTCHA_HIDE_INPUT)) {
			echo "</td>\n</tr>\n<tr>";
			echo "<td class='tbl'><label for='captcha_code'>".$locale['408']."</label></td>\n";
			echo "<td class='tbl'>";
			echo "<input type='text' id='captcha_code' name='captcha_code' class='textbox' autocomplete='off' style='width:100px' />";
		} // captcha
		echo "</td>\n</tr>\n<tr>\n";
		echo "<td align='center' colspan='2' class='tbl'>\n";
		echo "<input type='submit' name='sendmessage' value='".$locale['406']."' class='button' /></td>\n";
		echo "</tr>\n</table>\n</form>\n";


	closetable();
?>