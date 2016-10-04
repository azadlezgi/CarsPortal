<?php	

if (!defined("IN_FUSION")) { die("Access Denied"); }

$list_open = false;
$list_opensub = false;

openside($locale['global_001']);
$result = dbquery("SELECT
							link_id,
							link_name,
							link_url,
							link_parent,
							link_window,
							link_visibility
				FROM ". DB_SITE_LINKS ."
				WHERE (link_position='1' || link_position='2') AND link_parent='0'
				ORDER BY link_order");
if (dbrows($result)) {

	$i = 0;
	echo "<div id='navigation'>\n";
	while($data = dbarray($result)) {
		$li_class = ""; $i++;
		if (checkgroup($data['link_visibility'])) {
			if (unserialize($data['link_name'])[LOCALESHORT] != "---" && $data['link_url'] == "---") {
				if ($list_open) { echo "</ul>\n"; $list_open = false; }
				echo "<h2>".parseubb(unserialize($data['link_name'])[LOCALESHORT], "b|i|u|color|img")."</h2>\n";
			} else if (unserialize($data['link_name'])[LOCALESHORT] == "---" && $data['link_url'] == "---") {
				if ($list_open) { echo "</ul>\n"; $list_open = false; }
				echo "<hr class='side-hr' />\n";
			} else {
				if (!$list_open) { echo "<ul>\n"; $list_open = true; }
				$link_target = ($data['link_window'] == "1" ? " target='_blank'" : "");
				$li_class .= "liclass". $data['link_id'];
				if ($i == 1) { $li_class .= " first-link"; }
				if (FUSION_URI == "/". $data['link_url']) { $li_class .= " current-link"; }

				echo "	<li". ($li_class ? " class='". $li_class ."'" : "") .">";
				echo "<a href='". (preg_match("!^(ht|f)tp(s)?://!i", $data['link_url']) ? BASEDIR : "") . $data['link_url'] ."'". $link_target ." class='side'>";
				echo "<span>". parseubb(unserialize($data['link_name'])[LOCALESHORT], "b|i|u|color|img") ."</span>";
				echo "</a>";

				$resultsub = dbquery("SELECT
											link_id,
											link_name,
											link_url,
											link_parent,
											link_window,
											link_visibility
								FROM ". DB_SITE_LINKS ."
								WHERE (link_position='1' || link_position='2') AND link_parent='". $data['link_id'] ."'
								ORDER BY link_order");
				if (dbrows($resultsub)) {
					$isub = 0;
					if (!$list_opensub) { echo "\n		<ul>\n"; $list_opensub = true; }
					while($datasub = dbarray($resultsub)) {
						$li_classsub = ""; $isub++;
						$link_targetsub = ($datasub['link_window'] == "1" ? " target='_blank'" : "");
						$li_classsub .= "liclass". $datasub['link_id'];
						if ($isub == 1) { $li_classsub .= " first-link"; }
						if (FUSION_URI == "/". $datasub['link_url']) { $li_classsub .= " current-link"; }

						echo "			<li". ($li_classsub ? " class='". $li_classsub ."'" : "") .">";
						echo "<a href='". (preg_match("!^(ht|f)tp(s)?://!i", $datasub['link_url']) ? BASEDIR : "") . $datasub['link_url'] ."'". $link_targetsub ." class='side'>";
						echo "<span>". parseubb(unserialize($datasub['link_name'])[LOCALESHORT], "b|i|u|color|img") ."</span>";
						echo "</a>";
						echo "</li>\n";

					} // sub db while
					if ($list_opensub) { echo "		</ul>\n	"; }
				} // sub db query
				echo "</li>\n";

			}
		}
	} // db while
	if ($list_open) { echo "</ul>\n"; }
	echo "</div>\n";
} else {
	echo $locale['global_002'];
} // db query
closeside();
?>