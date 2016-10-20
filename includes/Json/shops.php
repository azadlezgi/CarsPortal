<?php

include "../maincore.php";

if (isset($_POST['shops'])) {

    $limit = (INT)$_POST['limit'];
    $random = (INT)$_POST['random'];
    $order = (INT)$_POST['order'];
    $where = stripinput($_POST['where']);

    // echo "<pre>";
    // print_r($limit);
    // echo "</pre>";
    // echo "<hr>";

    $viewcompanent = viewcompanent("shop", "name");
    $seourl_component = $viewcompanent['components_id'];

    $result = dbquery("SELECT
                                                    shop_id,
                                                    shop_name,
                                                    shop_imgocher,
                                                    seourl_url
							FROM ". DB_SHOPS ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=shop_id AND seourl_component=". $seourl_component ."
							WHERE (shop_aktiv='1' || shop_aktiv='4')
							". ($random ? "AND rand()" : "") ."
							". ($where ? "AND ". $where : "") ."
							". ($order ? "ORDER BY `shop_id` DESC" : "") ."
							". ($limit ? " LIMIT 0, ". $limit : ""));
    if (dbrows($result)) {
        $j=0;
        $shop_array = array();
        while ($data = dbarray($result)) { $j++;
            $shop_array[$j]['shop_id'] = $data['shop_id'];
            $shop_array[$j]['shop_name'] = $data['shop_name'];
            $shop_array[$j]['shop_imgocher'] = (empty($data['shop_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_imgocher']);
            $shop_array[$j]['seourl_url'] = $data['seourl_url'];
        } // db whille
    } // db query

    echo json_encode($shop_array);
    // echo "<pre>";
    // print_r($shop_array);
    // echo "</pre>";
    // echo "<hr>";

} // if post
?>