<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }


// echo "<pre>";
// print_r($languages);
// echo "<pre>";

	// openside($locale['global_901']);
	echo "<ul class='locale_panel'>\n";
	sort($languages); 
	foreach ($languages as $locale_key => $locale_value) { $j_locale++;
		$languages_name = unserialize($locale_value['languages_name']);
		// echo "<pre>";
		// print_r($languages_name);
		// echo "<pre>";
		echo "<li class='lang_". $locale_value['languages_short'] . ($locale_value['languages_short']==LOCALESHORT ? " lang_active" : "") ."'><a href='http://". ($locale_value['languages_short']!="az" ? $locale_value['languages_short'] ."." : "") . $settings['site_host'] . FUSION_REQUEST ."' title='". $languages_name[LOCALESHORT] ."' style='background:url(/". IMAGES ."flags/". $locale_value['languages_short'] .".png) no-repeat center'>". $languages_name[LOCALESHORT] ."</a></li>\n";
	} // locale foreach
	echo "</ul>\n";
	// closeside();

?>