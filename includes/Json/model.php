<?php

include "../maincore.php";

$model_arr = array();

if ($_POST['marka_submit']) {

    $model_result = dbquery("SELECT
                                        model_id,
                                        model_name                                        
                                FROM ". DB_MODEL ."
                                WHERE model_marka_id=". (INT)$_POST['marka_submit']);
    if (dbrows($model_result)) {
        $say=0;
        while ($model_data = dbarray($model_result)) {
            $model_arr[$model_data['model_id']] = $model_data['model_name'];
        } // db whille
    } // db query

    asort($model_arr);
} // if post model

echo json_encode($model_arr);

?>