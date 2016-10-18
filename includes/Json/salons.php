<?php

include "../maincore.php";

if (isset($_POST['salons'])) {

    $limit = (INT)$_POST['limit'];
    $random = (INT)$_POST['random'];
    $order = (INT)$_POST['order'];
    $where = stripinput($_POST['where']);

    // echo "<pre>";
    // print_r($limit);
    // echo "</pre>";
    // echo "<hr>";

    $viewcompanent = viewcompanent("salon", "name");
    $seourl_component = $viewcompanent['components_id'];

    $result = dbquery("SELECT
                                                    salon_id,
                                                    salon_name,
                                                    salon_imgocher,
                                                    seourl_url
							FROM ". DB_SALONS ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=salon_id AND seourl_component=". $seourl_component ."
							WHERE (salon_aktiv='1' || salon_aktiv='4')
							". ($random ? "AND rand()" : "") ."
							". ($where ? "AND ". $where : "") ."
							". ($order ? "ORDER BY `salon_id` DESC" : "") ."
							". ($limit ? " LIMIT 0, ". $limit : ""));
    if (dbrows($result)) {
        $j=0;
        $salon_array = array();
        while ($data = dbarray($result)) { $j++;
            $salon_array[$j]['salon_id'] = $data['salon_id'];
            $salon_array[$j]['salon_name'] = $data['salon_name'];
            $salon_array[$j]['salon_imgocher'] = (empty($data['salon_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_imgocher']);
            $salon_array[$j]['seourl_url'] = $data['seourl_url'];
        } // db whille
    } // db query

    echo json_encode($salon_array);
    // echo "<pre>";
    // print_r($salon_array);
    // echo "</pre>";
    // echo "<hr>";

} // if post
?>