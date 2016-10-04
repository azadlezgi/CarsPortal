<?php

require_once "../includes/maincore.php";

if (!iADMIN || $userdata['user_rights'] == "" || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

require_once THEMES."templates/admin_header.php";

if (!isset($_GET['pagenum']) || !isnum($_GET['pagenum'])) $_GET['pagenum'] = 1;

$admin_images = true;

// Work out which tab is the active default (redirect if no tab available)
$default = false;
for ($i = 5; $i > 0; $i--) {
	if ($pages[$i]) { $default = $i; }
}
if (!$default) { redirect("../index.php"); }

// Ensure the admin is allowed to access the selected page
if (!$pages[$_GET['pagenum']]) { redirect("index.php".$aidlink."&pagenum=$default"); }

// Display admin panels & pages
opentable($locale['200']." - v".$settings['version']);
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
for ($i = 1; $i < 6; $i++) {
	$class = ($_GET['pagenum'] == $i ? "tbl1" : "tbl2");
	if ($pages[$i]) {
		echo "<td align='center' width='20%' class='$class'><span class='small'>\n";
		echo ($_GET['pagenum'] == $i ? "<strong>".$locale['ac0'.$i]."</strong>" : "<a href='index.php".$aidlink."&amp;pagenum=$i'>".$locale['ac0'.$i]."</a>")."</span></td>\n";
	} else {
		echo "<td align='center' width='20%' class='$class'><span class='small' style='text-decoration:line-through'>\n";
		echo $locale['ac0'.$i]."</span></td>\n";
	}
}
echo "</tr>\n<tr>\n<td colspan='5' class='tbl'>\n";
$result = dbquery("SELECT * FROM ".DB_ADMIN." WHERE admin_page='".$_GET['pagenum']."' ORDER BY admin_title");
$rows = dbrows($result);
if ($rows != 0) {
	$counter = 0; $columns = 4;
	$align = $admin_images ? "center" : "left";
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	while ($data = dbarray($result)) {
		if (checkrights($data['admin_rights']) && $data['admin_link'] != "reserved") {
			if ($counter != 0 && ($counter % $columns == 0)) { echo "</tr>\n<tr>\n"; }
			echo "<td align='$align' width='20%' class='tbl'>";
			if ($admin_images) {
				echo "<span class='small'><a href='".$data['admin_link'].$aidlink."'><img src='".get_image("ac_".$data['admin_title'])."' alt='".$data['admin_title']."' style='border:0px;' /></a><br />\n".$data['admin_title']."</span>";
			} else {
				echo "<span class='small'>".THEME_BULLET." <a href='".$data['admin_link'].$aidlink."'>".$data['admin_title']."</a></span>";
			}
			echo "</td>\n";
			$counter++;
		}
	}
	echo "</tr>\n</table>\n";
}
echo "</td>\n</tr>\n</table>\n";
closetable();

$members_registered = dbcount("(user_id)", DB_USERS, "user_status<='1' OR user_status='3' OR user_status='5'");
$members_unactivated = dbcount("(user_id)", DB_USERS, "user_status='2'");
$members_security_ban = dbcount("(user_id)", DB_USERS, "user_status='4'");
$members_canceled = dbcount("(user_id)", DB_USERS, "user_status='5'");

opentable($locale['250']);
echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n<td valign='top' width='50%' class='small'>\n";
if (checkrights("M")) {
	echo "<a href='".ADMIN."members.php".$aidlink."'>".$locale['251']."</a> $members_registered<br />\n";
	echo "<a href='".ADMIN."members.php".$aidlink."&amp;status=2'>".$locale['252']."</a> $members_unactivated<br />\n";
	echo "<a href='".ADMIN."members.php".$aidlink."&amp;status=4'>".$locale['253']."</a> $members_security_ban<br />\n";
	echo "<a href='".ADMIN."members.php".$aidlink."&amp;status=5'>".$locale['263']."</a> $members_canceled<br />\n";
	if ($settings['enable_deactivation'] == "1") {
		$time_overdue = time() - (86400 * $settings['deactivation_period']);
		$members_inactive = dbcount("(user_id)", DB_USERS, "user_lastvisit<'$time_overdue' AND user_actiontime='0' AND user_joined<'$time_overdue' AND user_status='0'");
		echo "<a href='".ADMIN."members.php".$aidlink."&amp;status=8'>".$locale['264']."</a> $members_inactive<br />\n";
	}
} else {
	echo $locale['251']." ".$members_registered."<br />\n";
	echo $locale['252']." ".$members_unactivated."<br />\n";
	echo $locale['253']." ".$members_security_ban."<br />\n";
	echo $locale['263']." ".$members_canceled."<br />\n";
}
echo "</td>\n<td valign='top' width='50%' class='small'>
".(checkrights("CAR") ? "<a href='". ADMIN ."cars.php" . $aidlink. "'>". $locale['254'] ."</a>" : $locale['254']) ." ". dbcount("(cars_id)", DB_CARS, "cars_aktiv='2'") ."<br />
".(checkrights("BUYAC") ? "<a href='". ADMIN ."buyacars.php" . $aidlink ."'>". $locale['255'] ."</a>" : $locale['255']) ." ". dbcount("(buyacars_id)", DB_BUYACARS, "buyacars_aktiv='2'") ."<br />
".(checkrights("SALON") ? "<a href='". ADMIN ."salons.php" . $aidlink ."'>". $locale['256'] ."</a>" : $locale['256']) ." ". dbcount("(salon_id)", DB_SALONS, "salon_aktiv='2'") ."<br />
".(checkrights("SHOP") ? "<a href='". ADMIN ."shops.php" . $aidlink ."'>". $locale['260'] ."</a>" : $locale['260']) ." ". dbcount("(shop_id)", DB_SHOPS, "shop_aktiv='2'") ."<br />
".(checkrights("SERVI") ? "<a href='". ADMIN ."services.php". $aidlink ."'>". $locale['265'] ."</a>" : $locale['265']) ." ". dbcount("(service_id)", DB_SERVICES, "service_aktiv='2'") ."<br />
".(checkrights("RENTAL") ? "<a href='". ADMIN ."rentalcars.php". $aidlink ."'>". $locale['268'] ."</a>" : $locale['268']) ." ". dbcount("(rentalcar_id)", DB_RENTALCARS, "rentalcar_aktiv='2'") ."<br />
".(checkrights("PARTS") ? "<a href='". ADMIN ."parts.php". $aidlink ."'>". $locale['269'] ."</a>" : $locale['269']) ." ". dbcount("(parts_id)", DB_PARTS, "parts_aktiv='2'") ."<br />
</td>\n</tr>\n</table>\n";
closetable();

require_once THEMES."templates/footer.php";
?>
