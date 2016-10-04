<?php
	
	include "../maincore.php";

	if ($_POST['marka_id']) {

	
		$carcount = dbcount("(cars_id)", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4') AND cars_marka='". (INT)$_POST['marka_id'] ."'");

		echo json_encode($carcount);
		// echo "<pre>";
		// print_r($carcount);
		// echo "</pre>";
		// echo "<hr>";

	} // if post cars_id
?>