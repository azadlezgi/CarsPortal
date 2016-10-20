<?php

include "../maincore.php";

if ($_POST['parts']) {

    $limit = (INT)$_POST['limit'];
    $random = (INT)$_POST['random'];
    $order = (INT)$_POST['order'];
    $where = stripinput($_POST['where']);

    // echo "<pre>";
    // print_r($limit);
    // echo "</pre>";
    // echo "<hr>";

    $viewcompanent = viewcompanent("part", "name");
    $seourl_component = $viewcompanent['components_id'];

    $result = dbquery("SELECT
                                                    parts_id,
                                                    parts_name,
                                                    parts_imgocher,
                                                    parts_qiymeti,
                                                    parts_valyuta,
                                                    seourl_url
							FROM ". DB_PARTS ."
							LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=parts_id AND seourl_component=". $seourl_component ."
							WHERE parts_aktiv='1'
							". ($random ? "AND rand()" : "") ."
							". ($where ? "AND ". $where : "") ."
							". ($order ? "ORDER BY `parts_id` DESC" : "") ."
							". ($limit ? " LIMIT 0, ". $limit : ""));
    if (dbrows($result)) {
        $j=0;
        $parts_array = array();
        while ($data = dbarray($result)) { $j++;
            $parts_array[$j]['parts_id'] = $data['parts_id'];
            $parts_array[$j]['parts_name'] = $data['parts_name'];
            $parts_array[$j]['parts_imgocher'] = (empty($data['parts_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_imgocher']);
            $parts_array[$j]['parts_qiymeti'] = viewcena($data['parts_qiymeti'], $data['parts_valyuta']);
            $parts_array[$j]['seourl_url'] = $data['seourl_url'];
        } // db whille
    } // db query

    echo json_encode($parts_array);
    // echo "<pre>";
    // print_r($parts_array);
    // echo "</pre>";
    // echo "<hr>";

} // if post
?>