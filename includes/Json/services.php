<?php

include "../maincore.php";

if (isset($_POST['services'])) {

    $limit = (INT)$_POST['limit'];
    $random = (INT)$_POST['random'];
    $order = (INT)$_POST['order'];
    $where = stripinput($_POST['where']);

    // echo "<pre>";
    // print_r($limit);
    // echo "</pre>";
    // echo "<hr>";

    $viewcompanent = viewcompanent("service", "name");
    $seourl_component = $viewcompanent['components_id'];

    $result = dbquery("SELECT
                                                    service_id,
                                                    service_name,
                                                    service_imgocher,
                                                    seourl_url
							FROM ". DB_SERVICES ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=service_id AND seourl_component=". $seourl_component ."
							WHERE (service_aktiv='1' || service_aktiv='4')
							". ($random ? "AND rand()" : "") ."
							". ($where ? "AND ". $where : "") ."
							". ($order ? "ORDER BY `service_id` DESC" : "") ."
							". ($limit ? " LIMIT 0, ". $limit : ""));
    if (dbrows($result)) {
        $j=0;
        $service_array = array();
        while ($data = dbarray($result)) { $j++;
            $service_array[$j]['service_id'] = $data['service_id'];
            $service_array[$j]['service_name'] = $data['service_name'];
            $service_array[$j]['service_imgocher'] = (empty($data['service_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_imgocher']);
            $service_array[$j]['seourl_url'] = $data['seourl_url'];
        } // db whille
    } // db query

    echo json_encode($service_array);
    // echo "<pre>";
    // print_r($service_array);
    // echo "</pre>";
    // echo "<hr>";

} // if post
?>