<?php

$viewcompanent = viewcompanent("article_item", "name");
$seourl_component = $viewcompanent['components_id'];

$articles_arr = array();
$result = dbquery("SELECT 
											article_id,
											article_name,
											seourl_url
			FROM ". DB_ARTICLES ."
			LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_id AND seourl_component=". $seourl_component ."
			WHERE article_alias=''
	");

if (dbrows($result)) { $say=0;
    while ($data = dbarray($result)) { $say++;
        if (say<5) {

            $article_alias = $data['seourl_url'];

    //        $result_upd = dbquery(
    //            "UPDATE ". DB_ARTICLES ." SET
    //															article_alias='". $article_cat ."''
    //						WHERE article_id='". $data['article_id'] ."'"
    //        );

            echo "<pre>";
            print_r($data);
            echo "<pre>";
            echo "<hr>";

        }
    }
}