<?php
	
	include "../maincore.php";

	if ($_POST['cars']) {

		$limit = (INT)$_POST['limit'];
		$random = (INT)$_POST['random'];
		$order = (INT)$_POST['order'];
		$where = stripinput($_POST['where']);

		// echo "<pre>";
		// print_r($limit);
		// echo "</pre>";
		// echo "<hr>";

		$viewcompanent = viewcompanent("car", "name");
		$seourl_component = $viewcompanent['components_id'];

		$result = dbquery("SELECT
														marka_name,
														model_name,
														cars_id,
														cars_imgocher,
														cars_qiymeti,
														cars_valyuta,
														cars_ban,
														cars_vip,
														seourl_url
							FROM ". DB_CARS ."
							INNER JOIN ". DB_MARKA ." ON ". DB_CARS .".cars_marka=". DB_MARKA .".marka_id
							INNER JOIN ". DB_MODEL ." ON ". DB_CARS .".cars_model=". DB_MODEL .".model_id 
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=cars_id AND seourl_component=". $seourl_component ."
							WHERE cars_aktiv='1'
							". ($random ? "AND rand()" : "") ."
							". ($where ? "AND ". $where : "") ."
							". ($order ? "ORDER BY `cars_id` DESC" : "") ."
							". ($limit ? " LIMIT 0, ". $limit : ""));
		if (dbrows($result)) {
			$j=0;
			$cars_array = array();
			while ($data = dbarray($result)) { $j++;
				$cars_array[$j]['cars_id'] = $data['cars_id'];
				$cars_array[$j]['marka_name'] = $data['marka_name'];
				$cars_array[$j]['model_name'] = $data['model_name'];
				$cars_array[$j]['cars_imgocher'] = (empty($data['cars_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_imgocher']);
				$cars_array[$j]['cars_qiymeti'] = viewcena($data['cars_qiymeti'], $data['cars_valyuta']);
				$cars_array[$j]['cars_ban'] = $data['cars_ban'];
				$cars_array[$j]['cars_vip'] = $data['cars_vip'];
				$cars_array[$j]['seourl_url'] = $data['seourl_url'];
			} // db whille
		} // db query

		echo json_encode($cars_array);
		// echo "<pre>";
		// print_r($cars_array);
		// echo "</pre>";
		// echo "<hr>";

	} // if post
?>