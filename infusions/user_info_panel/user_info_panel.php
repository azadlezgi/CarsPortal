<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

if (iMEMBER) {
	$msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");

	openside($userdata['user_name']);
	echo THEME_BULLET." <a href='".BASEDIR."edit_profile.php' class='side'>".$locale['global_120']."</a><br />\n";
	echo THEME_BULLET." <a href='".BASEDIR."messages.php' class='side'>".$locale['global_121']."</a><br />\n";
	echo THEME_BULLET." <a href='".BASEDIR."members.php' class='side'>".$locale['global_122']."</a><br />\n";

	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
		echo THEME_BULLET." <a href='".ADMIN."index.php".$aidlink."' class='side'>".$locale['global_123']."</a><br />\n";
	}

	echo THEME_BULLET." <a href='".BASEDIR."index.php?logout=yes' class='side'>".$locale['global_124']."</a>\n";

	if ($msg_count) {
		echo "<div style='text-align:center;margin-top:15px;'>\n";
		echo "<strong><a href='".BASEDIR."messages.php' class='side'>".sprintf($locale['global_125'], $msg_count);
		echo ($msg_count == 1 ? $locale['global_126'] : $locale['global_127'])."</a></strong>\n";
		echo "</div>\n";
	}

	closeside();
} else {
	if (!preg_match('/login.php/i',FUSION_SELF)) {
		$action_url = FUSION_SELF.(FUSION_QUERY ? "?".FUSION_QUERY : "");
		if (isset($_GET['redirect']) && strstr($_GET['redirect'], "/")) {
			$action_url = cleanurl(urldecode($_GET['redirect']));
		}

		openside($locale['global_100']);
		echo "<div style='text-align:center'>\n";
		echo "<form name='loginform' method='post' action='".$action_url."'>\n";
		echo $locale['global_101']."<br />\n<input type='text' name='user_name' class='textbox' style='width:100px' /><br />\n";
		echo $locale['global_102']."<br />\n<input type='password' name='user_pass' class='textbox' style='width:100px' /><br />\n";
		echo "<label for='remember_me'><input class='checkbox' type='checkbox' name='remember_me' id='remember_me' value='y' title='".$locale['global_103']."' style='vertical-align:middle;' /></label>\n";
		echo "<input type='submit' name='login' value='".$locale['global_104']."' class='button' /><br />\n";
		echo "</form>\n<br />\n";

		if ($settings['enable_registration']) {
			echo $locale['global_105']."<br /><br />\n";
		}
		echo $locale['global_106']."\n</div>\n";
		closeside();
	}
}
?>