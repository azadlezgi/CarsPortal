<?php
	
	include "../maincore.php";

	if ($_GET['filter_submit']) {

		$filterdb = "";
		if ($_GET['filter_marka']) { $filterdb .= " AND cars_marka='". (INT)$_GET['filter_marka'] ."'"; }
		if ($_GET['filter_model']) { $filterdb .= " AND cars_model='". (INT)$_GET['filter_model'] ."'"; }
		if ($_GET['filter_kuza']) { $filterdb .= " AND cars_kuza='". (INT)$_GET['filter_kuza'] ."'"; }
		if ($_GET['filter_ban']) { $filterdb .= " AND cars_ban='". (INT)$_GET['filter_ban'] ."'"; }
		if ($_GET['filter_iliot']) { $filterdb .= " AND cars_ili>='". (INT)$_GET['filter_iliot'] ."'"; }
		if ($_GET['filter_ilido']) { $filterdb .= " AND cars_ili<='". (INT)$_GET['filter_ilido'] ."'"; }
		if ($_GET['filter_qiymetiot']) { $filterdb .= " AND cars_qiymeti>='". (INT)$_GET['filter_qiymetiot'] ."'"; }
		if ($_GET['filter_qiymetido']) { $filterdb .= " AND cars_qiymeti<='". (INT)$_GET['filter_qiymetido'] ."'"; }
		if ($_GET['filter_veziyyet']) { $filterdb .= " AND cars_veziyyet='". (INT)$_GET['filter_veziyyet'] ."'"; }
	
		$carcount = dbcount("(cars_id)", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4')". $filterdb);

		echo json_encode($carcount);
		// echo "<pre>";
		// print_r($carcount);
		// echo "</pre>";
		// echo "<hr>";

	} // if post cars_id
?>