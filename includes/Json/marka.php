<?php

include "../maincore.php";

$marka_arr = array();

$marka_result = dbquery("SELECT
									marka_id,
									marka_name
							FROM ". DB_MARKA);
if (dbrows($marka_result)) {
    while ($marka_data = dbarray($marka_result)) {
        $marka_arr[$marka_data['marka_id']] = $marka_data['marka_name'];
    } // db whille
} // db query

asort($marka_arr);

echo json_encode($marka_arr);

?>