<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

$cache_time_ilap = 86400; // Время жизни кэша в секундах
$cache_file_ilap = CACHE . LOCALESHORT ."_infusions_last_addeds_panel"; // Файл будет находиться, например, в /cache/a.php.html
if ( (file_exists($cache_file_ilap)) && ((time() - $cache_time_ilap) < filemtime($cache_file_ilap)) ) {
	include $cache_file_ilap;
} else {
	


	include LOCALE . LOCALESET ."infusions/last_addeds_panel.php";

	$oneday = FUSION_TODAY-86400;
	$sevenday = FUSION_TODAY-604800;
	$thirtyday = FUSION_TODAY-25920000;

	$onedaycars = dbcount("(cars_id)", DB_CARS, "cars_today>='". $oneday ."'");
	$sevendaycars = dbcount("(cars_id)", DB_CARS, "cars_today>='". $sevenday ."'");
	$thirtydaycars = dbcount("(cars_id)", DB_CARS, "cars_today>='". $thirtyday ."'");

	$onedaybuyacars = dbcount("(buyacars_id)", DB_BUYACARS, "buyacars_today>='". $oneday ."'");
	$sevendaybuyacars = dbcount("(buyacars_id)", DB_BUYACARS, "buyacars_today>='". $sevenday ."'");
	$thirtydaybuyacars = dbcount("(buyacars_id)", DB_BUYACARS, "buyacars_today>='". $thirtyday ."'");

	$onedaysalon = dbcount("(salon_id)", DB_SALONS, "salon_today>='". $oneday ."'");
	$sevendaysalon = dbcount("(salon_id)", DB_SALONS, "salon_today>='". $sevenday ."'");
	$thirtydaysalon = dbcount("(salon_id)", DB_SALONS, "salon_today>='". $thirtyday ."'");

	$onedayshop = dbcount("(shop_id)", DB_SHOPS, "shop_today>='". $oneday ."'");
	$sevendayshop = dbcount("(shop_id)", DB_SHOPS, "shop_today>='". $sevenday ."'");
	$thirtydayshop = dbcount("(shop_id)", DB_SHOPS, "shop_today>='". $thirtyday ."'");

	$onedayservice = dbcount("(service_id)", DB_SERVICES, "service_today>='". $oneday ."'");
	$sevendayservice = dbcount("(service_id)", DB_SERVICES, "service_today>='". $sevenday ."'");
	$thirtydayservice = dbcount("(service_id)", DB_SERVICES, "service_today>='". $thirtyday ."'");

	$onedayrentalcar = dbcount("(rentalcar_id)", DB_RENTALCARS, "rentalcar_today>='". $oneday ."'");
	$sevendayrentalcar = dbcount("(rentalcar_id)", DB_RENTALCARS, "rentalcar_today>='". $sevenday ."'");
	$thirtydayrentalcar = dbcount("(rentalcar_id)", DB_RENTALCARS, "rentalcar_today>='". $thirtyday ."'");

	$onedayparts = dbcount("(parts_id)", DB_PARTS, "parts_today>='". $oneday ."'");
	$sevendayparts = dbcount("(parts_id)", DB_PARTS, "parts_today>='". $sevenday ."'");
	$thirtydayparts = dbcount("(parts_id)", DB_PARTS, "parts_today>='". $thirtyday ."'");

	$onedayads = $onedaycars+$onedaybuyacars+$onedaysalon+$onedayshop+$onedayservice+$onedayrentalcar+$onedayparts;
	$sevendayads = $sevendaycars+$sevendaybuyacars+$sevendaysalon+$sevendayshop+$sevendayservice+$sevendayrentalcar+$sevendayparts;
	$thirtydayads = $thirtydaycars+$thirtydaybuyacars+$thirtydaysalon+$thirtydayshop+$thirtydayservice+$thirtydayrentalcar+$thirtydayparts;


	$return = openside($locale['infusions_lads_001'], false);
	$return .= "<ul class='last_items'>\n";
	if ($onedayads) { $return .= "<li class='item item_first'>". sprintf($locale['infusions_lads_010'], $onedayads) ."</li>\n"; }
	if ($sevendayads) { $return .= "<li class='item'>". sprintf($locale['infusions_lads_011'], $sevendayads) ."</li>\n"; }
	if ($thirtydayads) { $return .= "<li class='item'>". sprintf($locale['infusions_lads_012'], $thirtydayads) ."</li>\n"; }
	$return .= "</ul>\n";
	$return .= closeside(false);

	echo $return;


	/*write_cache*/
	$handle_ilap = fopen($cache_file_ilap, 'w'); // Открываем файл для записи и стираем его содержимое
	fwrite($handle_ilap, $return); // Сохраняем всё содержимое буфера в файл
	fclose($handle_ilap); // Закрываем файл
	// ob_end_flush(); // Выводим страницу в браузере
	/*//write_cache*/

} // Yesli Yest cache_file
?>