<?php

include "../maincore.php";

if ($_POST['rentalcars']) {

    $limit = (INT)$_POST['limit'];
    $random = (INT)$_POST['random'];
    $order = (INT)$_POST['order'];
    $where = stripinput($_POST['where']);

    // echo "<pre>";
    // print_r($limit);
    // echo "</pre>";
    // echo "<hr>";

    $viewcompanent = viewcompanent("rentalcar", "name");
    $seourl_component = $viewcompanent['components_id'];

    $result = dbquery("SELECT
                                                        marka_name,
                                                        model_name,
                                                        rentalcar_id,
                                                        rentalcar_imgocher,
                                                        rentalcar_qiymeti,
                                                        rentalcar_valyuta,
                                                        seourl_url
							FROM ". DB_RENTALCARS ."
							INNER JOIN ". DB_MARKA ." ON ". DB_RENTALCARS .".rentalcar_marka=". DB_MARKA .".marka_id
							INNER JOIN ". DB_MODEL ." ON ". DB_RENTALCARS .".rentalcar_model=". DB_MODEL .".model_id 
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=rentalcar_id AND seourl_component=". $seourl_component ."
							WHERE rentalcar_aktiv='1'
							". ($random ? "AND rand()" : "") ."
							". ($where ? "AND ". $where : "") ."
							". ($order ? "ORDER BY `rentalcar_id` DESC" : "") ."
							". ($limit ? " LIMIT 0, ". $limit : ""));
    if (dbrows($result)) {
        $j=0;
        $rentalcar_array = array();
        while ($data = dbarray($result)) { $j++;
            $rentalcar_array[$j]['rentalcar_id'] = $data['rentalcar_id'];
            $rentalcar_array[$j]['marka_name'] = $data['marka_name'];
            $rentalcar_array[$j]['model_name'] = $data['model_name'];
            $rentalcar_array[$j]['rentalcar_imgocher'] = (empty($data['rentalcar_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_imgocher']);
            $rentalcar_array[$j]['rentalcar_qiymeti'] = viewcena($data['rentalcar_qiymeti'], $data['rentalcar_valyuta']);
            $rentalcar_array[$j]['seourl_url'] = $data['seourl_url'];
        } // db whille
    } // db query

    echo json_encode($rentalcar_array);
    // echo "<pre>";
    // print_r($rentalcar_array);
    // echo "</pre>";
    // echo "<hr>";

} // if post
?>