<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."cars.php";

$resultmarka = dbquery("SELECT
											marka_id,
											marka_name
									FROM ". DB_MARKA ."
									WHERE marka_id='". (INT)$_GET['marka'] ."'");
if (dbrows($resultmarka)) {
	$datamarka = dbarray($resultmarka);
}
if ($_GET['model']) {
	$resultmodel = dbquery("SELECT
												model_id,
												model_name
										FROM ". DB_MODEL ."
										WHERE model_id='". (INT)$_GET['model'] ."'");
	if (dbrows($resultmodel)) {
		$datamodel = dbarray($resultmodel);
	}
}

if (!empty($locale['title'])) set_title($datamarka['marka_name'] ." ". ($datamodel['model_name'] ? $datamodel['model_name'] ." " : "") . $locale['title'] ." - ". $settings['sitename'] . ($_GET['page'] ? " | ". $locale['010'] . $_GET['page'] : "") );
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
	if ($datamarka['marka_id']) { echo "		<li><a href='/cars/marks/'>". $locale['641'] ."</a></li>\n"; }
	if ($_GET['model']) { echo "		<li><a href='/cars/?marka=". $datamarka['marka_id'] ."'>". $datamarka['marka_name'] ." ". $locale['642'] ."</a></li>\n"; }
	echo "		<li><span>". $locale['643'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($datamarka['marka_name'] ." ". ($datamodel['model_name'] ? $datamodel['model_name'] ." " : "") . $locale['h1']);	
?>

	<div class="addcar"><a href="/cars/add/"><?php echo $locale['502']; ?></a></div>

			<?php
				$filterdb = "";
				if ($_GET['marka']) { $filterdb .= " AND cars_marka='". (INT)$_GET['marka'] ."'"; }
				if ($_GET['model']) { $filterdb .= " AND cars_model='". (INT)$_GET['model'] ."'"; }
				if ($_GET['kuza']) { $filterdb .= " AND cars_kuza='". (INT)$_GET['kuza'] ."'"; }
				if ($_GET['ban']) { $filterdb .= " AND cars_ban='". (INT)$_GET['ban'] ."'"; }
				if ($_GET['iliot']) { $filterdb .= " AND cars_ili>='". (INT)$_GET['iliot'] ."'"; }
				if ($_GET['ilido']) { $filterdb .= " AND cars_ili<='". (INT)$_GET['ilido'] ."'"; }
				if ($_GET['qiymetiot']) { $filterdb .= " AND cars_qiymeti>='". (INT)$_GET['qiymetiot'] ."'"; }
				if ($_GET['qiymetido']) { $filterdb .= " AND cars_qiymeti<='". (INT)$_GET['qiymetido'] ."'"; }
				if ($_GET['veziyyet']) { $filterdb .= " AND cars_veziyyet='". (INT)$_GET['veziyyet'] ."'"; }



				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['cars_per_page']*($pagesay-1);

				$viewcompanent = viewcompanent("car", "name");
				$seourl_component = $viewcompanent['components_id'];

				// echo "<pre>";
				// print_r($filterdb);
				// echo "</pre>";
				// echo "<hr>";

				$result = dbquery("SELECT
											cars_id,
											marka_name,
											model_name,
											cars_ili,
											cars_veziyyet,
											cars_yurush,
											cars_motorobyom,
											cars_imgocher,
											cars_images1,
											cars_images2,
											cars_images3,
											cars_images4,
											cars_images5,
											cars_images6,
											cars_qiymeti,
											cars_valyuta,
											cars_desc_text,
											seourl_url
									FROM ". DB_CARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_CARS .".cars_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_CARS .".cars_model=". DB_MODEL .".model_id 
									LEFT JOIN ". DB_CARSDESC ." ON ". DB_CARS .".cars_id=". DB_CARSDESC .".cars_desc_car_id 
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=cars_id AND seourl_component=". $seourl_component ."
									WHERE (cars_aktiv='1' || cars_aktiv='4')". $filterdb ."
								
									LIMIT ". $rowstart .", ". $settings['cars_per_page'] ."");
//ORDER BY `cars_id` DESC

if ($_GET['filter_submit']) {
?>
	<div class="search_count success">
		<?php echo sprintf($locale['610'], dbcount("(cars_id)", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4')". $filterdb)); ?>
	</div>
<?php } ?>










<?php if ( $_GET['marka'] && !$_GET['model'] ) { ?>
<div class="markamodel">
<?php

	$filterdb_model = "";
	$filterurl_model = "";
	if ($_GET['veziyyet']==1) {
		$filterdb_model .= " AND cars_veziyyet='1'";
		$filterurl_model .= "&veziyyet=1";
	}
	if ($_GET['veziyyet']==2) {
		$filterdb_model .= " AND cars_veziyyet='2'";
		$filterurl_model .= "&veziyyet=2";
	}
	if ($_GET['veziyyet']==3) {
		$filterdb_model .= " AND cars_veziyyet='3'";
		$filterurl_model .= "&veziyyet=3";
	}
	if ($_GET['veziyyet']==4) {
		$filterdb_model .= " AND cars_veziyyet='4'";
		$filterurl_model .= "&veziyyet=4";
	}
	if ($_GET['kredit']==1) {
		$filterdb_model .= " AND cars_kredit='1'";
		$filterurl_model .= "&kredit=1";
	}

	$result_model = dbquery("SELECT
											model_id,
											model_name
									FROM ". DB_MODEL ."
									WHERE model_marka_id='". (INT)$_GET['marka'] ."'
									ORDER BY `model_name` ASC");
	if (dbrows($result_model)) {
?>
	<ul class="model_colums row">
<?php
		$j_model = 0;
		$counter_model = 0;
		while ($data_model = dbarray($result_model)) { $j_model++;
			$carcount_model = dbcount("(cars_id)", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4') AND cars_model='". $data_model['model_id'] ."'". $filterdb_model ."");
			if ($carcount_model>0) {
?>
		<li class="allmarka marka<?php echo $j_model; ?> col-sm-3">
			<div class="name"><?php echo ($carcount_model==0 ? $data_model['model_name'] : "<a href='/cars/?marka=". (INT)$_GET['marka'] ."&model=". $data_model['model_id'] . $filterurl_model ."'>". $data_model['model_name'] ."</a>" ); ?></div>
			<div class="carcount"><?php echo ($carcount_model==0 ? "(". $carcount_model .")" : "<span>(". $carcount_model .")</span>" ); ?></div>
			<div class="clear-both"></div>
		</li>
<?php
			$counter_model++;
		} // carcount_model > 0
	} // db whille
?>
	</ul>
<?php } ?>
</div>
<?php } // model list ?>








<ul class="cars_list allcars">
<?php
if (dbrows($result)) {
	while ($data = dbarray($result)) {

		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// echo "<hr>";

		$images_say = 0;
		if ($data['cars_images1']) { $cars_images1 = $data['cars_images1']; $images_say++; }
		if ($data['cars_images2']) { $cars_images2 = $data['cars_images2']; $images_say++; }
		if ($data['cars_images3']) { $cars_images3 = $data['cars_images3']; $images_say++; }
		if ($data['cars_images4']) { $cars_images4 = $data['cars_images4']; $images_say++; }
		if ($data['cars_images5']) { $cars_images5 = $data['cars_images5']; $images_say++; }
		if ($data['cars_images6']) { $cars_images6 = $data['cars_images6']; $images_say++; }

		$images_say_prosent = 100/$images_say;
?>
	<li class="cars_items cars_item<?php echo $data['cars_id']; ?>" id="<?php echo $data['cars_id']; ?>">
		<div class="cars_left">
			<a class="cars_images" href="/<?php echo $data['seourl_url']; ?>"<?php echo ($_GET['filter_submit'] ? " target='blank'" : ""); ?>>
				<img src="<?php echo (empty($data['cars_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>">
				<span class="cars_otherimages">
					<?php if ($cars_images1) { ?><img class="cars_otherimage1" src="<?php echo IMAGES . $settings['cars_foto_dir'] ."/sm". $cars_images1; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" /><?php } ?>
					<?php if ($cars_images2) { ?><img class="cars_otherimage2" src="<?php echo IMAGES . $settings['cars_foto_dir'] ."/sm". $cars_images2; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" /><?php } ?>
					<?php if ($cars_images3) { ?><img class="cars_otherimage3" src="<?php echo IMAGES . $settings['cars_foto_dir'] ."/sm". $cars_images3; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" /><?php } ?>
					<?php if ($cars_images4) { ?><img class="cars_otherimage4" src="<?php echo IMAGES . $settings['cars_foto_dir'] ."/sm". $cars_images4; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" /><?php } ?>
					<?php if ($cars_images5) { ?><img class="cars_otherimage5" src="<?php echo IMAGES . $settings['cars_foto_dir'] ."/sm". $cars_images5; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" /><?php } ?>
					<?php if ($cars_images6) { ?><img class="cars_otherimage6" src="<?php echo IMAGES . $settings['cars_foto_dir'] ."/sm". $cars_images6; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" /><?php } ?>
						</span>
				<span class="cars_otherselect">
					<?php if ($cars_images1) { ?><i id="cars_otherimage1" style="width: <?php echo $images_say_prosent; ?>%"></i><?php } ?>
					<?php if ($cars_images2) { ?><i id="cars_otherimage2" style="width: <?php echo $images_say_prosent; ?>%"></i><?php } ?>
					<?php if ($cars_images3) { ?><i id="cars_otherimage3" style="width: <?php echo $images_say_prosent; ?>%"></i><?php } ?>
					<?php if ($cars_images4) { ?><i id="cars_otherimage4" style="width: <?php echo $images_say_prosent; ?>%"></i><?php } ?>
					<?php if ($cars_images5) { ?><i id="cars_otherimage5" style="width: <?php echo $images_say_prosent; ?>%"></i><?php } ?>
					<?php if ($cars_images6) { ?><i id="cars_otherimage6" style="width: <?php echo $images_say_prosent; ?>%"></i><?php } ?>
				</span>
			</a>
		</div>
		<div class="cars_right">
			<div class="cars_header">
				<a class="cars_name col-sm-6" href="/<?php echo $data['seourl_url']; ?>"<?php echo ($_GET['filter_submit'] ? " target='blank'" : ""); ?>><?php echo $data['marka_name'] ." ". $data['model_name'] ." ". $data['cars_ili']; ?></a>
				<div class="cars_motorobyom col-sm-2"><?php echo $data['cars_motorobyom']; ?> <?php echo $locale['011']; ?></div>
				<div class="cars_ili col-sm-2"><?php echo ($data['cars_veziyyet']==1 ? $locale['012'] : $data['cars_yurush'] ." ". $locale['012']); ?></div>
				<div class="cars_qiymeti col-sm-2"><?php echo viewcena($data['cars_qiymeti'], $data['cars_valyuta']); ?></div>
			</div>
			<div class="cars_text">
				<p><?php echo strip_tags($data['cars_desc_text']); ?></p>
			</div>
		</div>
		<div class="clear"></div>
	</li>
<?php
	} // foreach cars_array
} else {
	header("HTTP/1.0 404 Not Found");
	echo "<p class='no_result'><img src='". IMAGES ."sad_cat.png' alt='' /><br />". $locale['501'] ."</p>\n";
} // db query
?>
</ul>


<?php

add_to_footer ("
<script type='text/javascript'>
	<!--
	$(document).ready(function() {
		$( '.cars_list .cars_items .cars_left .cars_images .cars_otherselect > i' ).hover(function() {
			var cars_item = $( this ).parent().parent().parent().parent().attr( 'id' );
			var cars_id = $( this ).attr( 'id' );
			$( '.cars_list .cars_item'+ cars_item +' .cars_left .cars_images > img' ).css( 'display', 'none' );
			$( '.cars_list .cars_item'+ cars_item +' .cars_left .cars_images .cars_otherimages .'+ cars_id ).css( 'display', 'block' );
		}, function() {
			var cars_item = $( this ).parent().parent().parent().parent().attr( 'id' );
			$( '.cars_list .cars_item'+ cars_item +' .cars_left .cars_images > img' ).css( 'display', 'block' );
			$( '.cars_list .cars_item'+ cars_item +' .cars_left .cars_images .cars_otherimages > img' ).css( 'display', 'none' );
		});
	});
	//-->
</script>
");

	echo navigation($_GET['page'], $settings['cars_per_page'], "cars_id", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4')". $filterdb ."");




// if ($_GET['marka']==5 && $_GET['model']==249) {
// echo '<iframe width="605" height="315" src="https://www.youtube.com/embed/2Sc3ymYNbGg" frameborder="0" allowfullscreen></iframe>'."\n";
// }
// if ($_GET['marka']==5 && $_GET['model']==5) {
// echo '<iframe width="605" height="315" src="https://www.youtube.com/embed/7XVSo8ffREg" frameborder="0" allowfullscreen></iframe>'."\n";
// }
// if ($_GET['marka']==5 && $_GET['model']==252) {
// echo '<iframe width="605" height="315" src="https://www.youtube.com/embed/ILeK5NhW60k" frameborder="0" allowfullscreen></iframe>'."\n";
// }
// if ($_GET['marka']==5 && $_GET['model']==258) {
// echo '<iframe width="605" height="315" src="https://www.youtube.com/embed/RpEt5VV_qoY" frameborder="0" allowfullscreen></iframe>'."\n";
// }
// if ($_GET['marka']==5 && $_GET['model']==642) {
// echo '<iframe width="605" height="315" src="https://www.youtube.com/embed/gp7pPk3vvso" frameborder="0" allowfullscreen></iframe>'."\n";
// }
// if ($_GET['marka']==4 && $_GET['model']==172) {
// echo '<iframe width="605" height="315" src="https://www.youtube.com/embed/pSjUAl0ZO90" frameborder="0" allowfullscreen></iframe>'."\n";
// }
// if ($_GET['marka']==4 && $_GET['model']==174) {
// echo '<iframe width="605" height="315" src="https://www.youtube.com/embed/ICd4qhZ9TSI" frameborder="0" allowfullscreen></iframe>'."\n";
// }




// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ($datamarka['marka_name'] || $datamodel['model_name']) {
// Call set_include_path() as needed to point to your client library.
include INCLUDES ."Google/autoload.php";
include INCLUDES ."Google/Client.php";
include INCLUDES ."Google/Service/YouTube.php";

  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google Developers Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyDAx6arX5eq6ezHv6Ac5kC1aNkUy5RGBM0';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);

  try {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id', array(
      'part' => 'snippet', 'q' => "Crash test ". $datamarka['marka_name'] . ($datamodel['model_name'] ? " ". $datamodel['model_name'] : ""),
      'maxResults' => 5,
    ));

    $videos = '';
    $channels = '';
    $playlists = '';

    	// echo "<pre>";
    	// print_r($searchResponse);
    	// echo "</pre>";
    	// echo "<hr>";


    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {
      switch ($searchResult['id']['kind']) {
        case 'youtube#video':
          $videos .= sprintf("<div>\n<h2>%s</h2>\n<iframe width='100%' height='315' src='https://www.youtube.com/embed/%s' frameborder='0' allowfullscreen></iframe><br />\n</div>\n",
              $searchResult['snippet']['title'], $searchResult['id']['videoId']);
          break;
        case 'youtube#channel':
          $channels .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['channelId']);
          break;
        case 'youtube#playlist':
          $playlists .= sprintf('<li>%s (%s)</li>',
              $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
          break;
      }
    }

    $htmlBody .= <<<END
    $videos
END;
  } catch (Google_Service_Exception $e) {
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }


	echo $htmlBody;
}




	closetable();
?>