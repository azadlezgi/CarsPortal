<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }


				$result = dbquery("SELECT
												marka_name,
												model_name,
												cars_id,
												cars_marka,
												cars_model,
												cars_ili,
												cars_veziyyet,
												cars_yurush,
												cars_oiltip,
												cars_motorobyom,
												cars_motorguc,
												cars_gedenteker,
												cars_karopka,
												cars_kuzareng,
												cars_salonreng,
												cars_kuzarengmet,
												cars_ban,
												cars_kuza,
												cars_images1,
												cars_images2,
												cars_images3,
												cars_images4,
												cars_images5,
												cars_images6,
												cars_imgocher,
												cars_qiymeti,
												cars_valyuta,
												cars_kredit,
												cars_bank,
												cars_ilkodenish,
												cars_krvalyuta,
												cars_muddet,
												cars_ayliqodenish,
												cars_qodovoy,
												cars_salon_id,
												cars_adi,
												cars_qorod,
												cars_mobiltel,
												cars_tel,
												cars_email,
												cars_komplekt,
												cars_desc_text,
												cars_today,
												cars_aktiv,
												cars_views
									FROM ". DB_CARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_CARS .".cars_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_CARS .".cars_model=". DB_MODEL .".model_id 
									INNER JOIN ". DB_CARSDESC ." ON ". DB_CARS .".cars_id=". DB_CARSDESC .".cars_desc_car_id 
									WHERE (cars_aktiv='1' || cars_aktiv='4')
									AND cars_id='". $filedid ."'");

				if (dbrows($result)) {

					include LOCALE.LOCALESET."car.php";
					$data = dbarray($result);


					$cars_komplekt = explode(",", $data['cars_komplekt']);

					// DB_KOMP BEGIN
					$resultkomp = dbquery("SELECT
												komp_id,
												komp_name
										FROM ". DB_KOMP ."
										ORDER BY `komp_name`");
					$datakomp_array = array();
					if (dbrows($resultkomp)) {
						$cars_komplekt = explode(",", $data['cars_komplekt']);
						while ($datakomp = dbarray($resultkomp)) { $kompsay++;
							$komp_name = unserialize($datakomp['komp_name']);
							$datakomp_array[$datakomp['komp_id']] = $komp_name[LOCALESHORT];
						} // db while
					} // db query
					// DB_KOMP END


					### UPDATE CARS VIEWS BEGIN
					$cars_views = $data['cars_views']+1;
					$resultviews = dbquery(
						"UPDATE ". DB_CARS ." SET
														cars_views='". $cars_views ."'
						WHERE cars_id='". $data['cars_id'] ."'"
					);
					### UPDATE CARS VIEWS END


					if (!empty($data['cars_id'])) set_title($data['marka_name'] ." ". $data['model_name'] ." ". $data['cars_ili'] ." - ". $settings['sitename']);
					if (!empty($data['cars_id'])) set_meta("description",
															$data['marka_name'] ." ".
															$data['model_name'] ." - ".
															$locale['description_1'] ." ". $data['cars_ili'] ."; ". 
															$locale['description_2'] ." ". $locale['veziyyet_'. $data['cars_veziyyet']] ."; ".
															sprintf($locale['description_3'], $data['cars_yurush']) ."; ".
															$locale['description_4'] ." ". $locale['oiltip_'. $data['cars_oiltip']] ."; ".
															sprintf($locale['description_5'], $data['cars_motorobyom']) ."; ".
															sprintf($locale['description_6'], $data['cars_motorguc'])
														);

					$keywords_komp = array();
					foreach ($datakomp_array as $komp_key => $komp_value) {
						if (in_array($komp_key, $cars_komplekt)) {
							$keywords_komp[$komp_key] = $komp_value;
						}
					}
					if ($keywords_komp) set_meta("keywords", implode(", ", $keywords_komp));

					echo "<div class='breadcrumb'>\n";
					echo "	<ul>\n";
					echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
					echo "		<li><a href='/cars/'>". $locale['641'] ."</a></li>\n";
					echo "		<li><span>". $data['marka_name'] ." ". $data['model_name'] ."</span></li>\n";
					echo "	</ul>\n";
					echo "</div>\n";

					opentable($data['marka_name'] ." ". $data['model_name']);
?>

	<div class="addcar"><a href="/cars/add/"><?php echo $locale['600']; ?></a></div>
<?php
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
?>
	<div class="editcar"><a href="/<?php echo ADMIN ."cars.php".  $aidlink ."&action=edit&id=". $data['cars_id']; ?>" target="_blank"><?php echo $locale['601']; ?></a></div>
	<div class="delcar"><a href="/<?php echo ADMIN ."cars.php".  $aidlink ."&action=delete&id=". $data['cars_id']; ?>" target="_blank" onclick="return DeleteOk();"><?php echo $locale['602']; ?></a></div>
	<div class="clear"></div>
<?php
	}
?>
	<div class="carinfo row">
		<div class="bloks blok1 col-sm-5">
			<div class="blok_fields">
				<div class="blok_name"><?php echo $locale['502']; ?></div>
				<div class="fileds cars_marka">
					<label for="cars_marka"><?php echo $locale['510']; ?></label>
					<span><?php echo $data['marka_name']; ?></span>
				</div>
				<div class="fileds cars_model">
					<label for="cars_model"><?php echo $locale['511']; ?></label>
					<span><?php echo $data['model_name']; ?></span>
				</div>
				<div class="hr"></div>
				<div class="fileds cars_ili">
					<label for="cars_ili"><?php echo $locale['520']; ?></label>
					<span><?php echo $data['cars_ili']; ?></span>
				</div>
				<div class="fileds cars_veziyyet">
					<label for="cars_veziyyet"><?php echo $locale['521']; ?></label>
					<span><?php echo $locale['veziyyet_'. $data['cars_veziyyet']]; ?></span>
				</div>
				<div class="fileds cars_yurush">
					<label for="cars_yurush"><?php echo $locale['522']; ?></label>
					<span><?php echo $data['cars_yurush']; ?></span>
				</div>
				<div class="hr"></div>
				<div class="fileds cars_oiltip">
					<label for="cars_oiltip"><?php echo $locale['530']; ?></label>
					<span><?php echo $locale['oiltip_'. $data['cars_oiltip']]; ?></span>
				</div>
				<div class="fileds cars_motorobyom">
					<label for="cars_motorobyom"><?php echo $locale['531']; ?></label>
					<span><?php echo $data['cars_motorobyom']; ?></span>
				</div>
				<div class="fileds cars_motorguc">
					<label for="cars_motorguc"><?php echo $locale['532']; ?></label>
					<span><?php echo $data['cars_motorguc']; ?></span>
				</div>
				<div class="fileds cars_gedenteker">
					<label for="cars_gedenteker"><?php echo $locale['533']; ?></label>
					<span><?php echo $locale['gedenteker_'. $data['cars_gedenteker']]; ?></span>
				</div>
				<div class="fileds cars_karopka">
					<label for="cars_karopka"><?php echo $locale['534']; ?></label>
					<span><?php echo $locale['karopka_'. $data['cars_karopka']]; ?></span>
				</div>
				<div class="hr"></div>
				<div class="fileds cars_kuzareng">
					<label for="cars_kuzareng"><?php echo $locale['540']; ?></label>
					<span><?php echo $locale['kuzareng_'. $data['cars_kuzareng']]; ?> <?php if ($data['cars_kuzarengmet']) { echo "<sup>". $locale['541'] ."</sup>"; } ?></span>
				</div>
				<div class="fileds cars_salonreng">
					<label for="cars_salonreng"><?php echo $locale['542']; ?></label>
					<span><?php echo $locale['salonreng_'. $data['cars_salonreng']]; ?></span>
				</div>
				<div class="fileds cars_ban">
					<label for="cars_ban"><?php echo $locale['543']; ?></label>
					<span><?php echo $locale['ban_'. $data['cars_ban']]; ?></span>
				</div>
				<div class="fileds cars_kuza">
					<label for="cars_kuza"><?php echo $locale['543']; ?></label>
					<span><?php echo $locale['kuza_'. $data['cars_kuza']]; ?></span>
				</div>
				<div class="hr"></div>
			</div>
			<div class="blok_fields">
				<div class="blok_name"><?php echo $locale['507']; ?></div>
				<div class="fileds cars_qiymeti">
					<label for="cars_qiymeti"><?php echo $locale['560']; ?></label>
					<span class='viewcena'><?php echo viewcena($data['cars_qiymeti'], $data['cars_valyuta']); ?></span>
				</div>
				<div class="fileds cars_kredit">
					<label for="cars_kredit"><?php echo $locale['561']; ?></label>
					<span><?php echo $locale['kredit_'. $data['cars_kredit']]; ?></span>
				</div>
				<?php if ($data['cars_kredit']==1) { ?>
				<div id="kredit">
					<?php if ($data['cars_bank']) { ?>
					<div class="fileds cars_bank">
						<label for="cars_bank"><?php echo $locale['562']; ?></label>
						<span><?php echo $locale['bank_'. $data['cars_bank']]; ?></span>
					</div>
					<?php } ?>
					<?php if ($data['cars_ilkodenish']) { ?>
					<div class="fileds cars_ilkodenish">
						<label for="cars_ilkodenish"><?php echo $locale['563']; ?></label>
						<span><?php echo viewcena($data['cars_ilkodenish'], $data['cars_krvalyuta']); ?></span>
					</div>
					<?php } ?>
					<?php if ($data['cars_muddet']) { ?>
					<div class="fileds cars_muddet">
						<label for="cars_muddet"><?php echo $locale['564']; ?></label>
						<span><?php echo $data['cars_muddet']; ?> <?php echo $locale['muddet_1']; ?></span>
					</div>
					<?php } ?>
					<?php if ($data['cars_ayliqodenish']) { ?>
					<div class="fileds cars_ayliqodenish">
						<label for="cars_ayliqodenish"><?php echo $locale['565']; ?></label>
						<span><?php echo $data['cars_ayliqodenish']; ?> <?php echo $locale['ayliqodenish_1']; ?></span>
					</div>
					<?php } ?>
					<?php if ($data['cars_qodovoy']) { ?>
					<div class="fileds cars_qodovoy">
						<label for="cars_qodovoy"><?php echo $locale['566']; ?></label>
						<span><?php echo $data['cars_qodovoy']; ?> <?php echo $locale['qodovoy_1']; ?></span>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
				<div class="hr"></div>
			</div>
		</div>
		<div class="bloks blok2 col-sm-7">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="cars_images">

				<div id="image-block" class="clearfix">
					<div id="view_full_size">
						<ul class="slides" id="full_size_list_frame">
							<?php if ($data['cars_imgocher']) { ?><li id="full_size_0"><a href="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_imgocher']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_imgocher'] : IMAGES ."imagenotfound.jpg"); ?>" itemprop="url" data-fullscreenmode="true" data-autoslide="true" class="html5lightbox" data-group="adsitem" data-thumbnail="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_imgocher']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_imgocher'] : IMAGES ."imagenotfound.jpg"); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><img itemprop="image" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_imgocher']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_imgocher'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><span class="item_zoom zoom_lupa"></span></a></li><?php } ?>
							<?php if ($data['cars_images1'] && $data['cars_images1']!=$data['cars_imgocher']) { ?><li id="full_size_1"><a href="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1'] : IMAGES ."imagenotfound.jpg"); ?>" itemprop="url" data-fullscreenmode="true" data-autoslide="true" class="html5lightbox" data-group="adsitem" data-thumbnail="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1'] : IMAGES ."imagenotfound.jpg"); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><img itemprop="image" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images1'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><span class="item_zoom zoom_lupa"></span></a></li><?php } ?>
							<?php if ($data['cars_images2'] && $data['cars_images2']!=$data['cars_imgocher']) { ?><li id="full_size_2"><a href="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2'] : IMAGES ."imagenotfound.jpg"); ?>" itemprop="url" data-fullscreenmode="true" data-autoslide="true" class="html5lightbox" data-group="adsitem" data-thumbnail="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2'] : IMAGES ."imagenotfound.jpg"); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><img itemprop="image" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images2'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><span class="item_zoom zoom_lupa"></span></a></li><?php } ?>
							<?php if ($data['cars_images3'] && $data['cars_images3']!=$data['cars_imgocher']) { ?><li id="full_size_3"><a href="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3'] : IMAGES ."imagenotfound.jpg"); ?>" itemprop="url" data-fullscreenmode="true" data-autoslide="true" class="html5lightbox" data-group="adsitem" data-thumbnail="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3'] : IMAGES ."imagenotfound.jpg"); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><img itemprop="image" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images3'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><span class="item_zoom zoom_lupa"></span></a></li><?php } ?>
							<?php if ($data['cars_images4'] && $data['cars_images4']!=$data['cars_imgocher']) { ?><li id="full_size_3"><a href="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4'] : IMAGES ."imagenotfound.jpg"); ?>" itemprop="url" data-fullscreenmode="true" data-autoslide="true" class="html5lightbox" data-group="adsitem" data-thumbnail="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4'] : IMAGES ."imagenotfound.jpg"); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><img itemprop="image" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images4'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><span class="item_zoom zoom_lupa"></span></a></li><?php } ?>
							<?php if ($data['cars_images5'] && $data['cars_images5']!=$data['cars_imgocher']) { ?><li id="full_size_3"><a href="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5'] : IMAGES ."imagenotfound.jpg"); ?>" itemprop="url" data-fullscreenmode="true" data-autoslide="true" class="html5lightbox" data-group="adsitem" data-thumbnail="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5'] : IMAGES ."imagenotfound.jpg"); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><img itemprop="image" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><span class="item_zoom zoom_lupa"></span></a></li><?php } ?>
							<?php if ($data['cars_images6'] && $data['cars_images6']!=$data['cars_imgocher']) { ?><li id="full_size_3"><a href="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images6']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images6'] : IMAGES ."imagenotfound.jpg"); ?>" itemprop="url" data-fullscreenmode="true" data-autoslide="true" class="html5lightbox" data-group="adsitem" data-thumbnail="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images6']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images6'] : IMAGES ."imagenotfound.jpg"); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><img itemprop="image" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images5']) ? IMAGES . $settings['cars_foto_dir'] ."/rl". $data['cars_images6'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>"><span class="item_zoom zoom_lupa"></span></a></li><?php } ?>
						</ul>
					</div>
				</div>
				<div id="views_block" class="clearfix">
					<div id="thumbs_list">
						<ul class="slides" id="thumbs_list_frame">
							<?php if ($data['cars_imgocher']) { ?><li id="thumbnail_0"><span><img class="img-responsive" id="thumb_0" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_imgocher']) ? IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_imgocher'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>" itemprop="image"></span></li><?php } ?>
							<?php if ($data['cars_images1'] && $data['cars_images1']!=$data['cars_imgocher']) { ?><li id="thumbnail_1"><span><img class="img-responsive" id="thumb_1" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images1']) ? IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images1'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>" itemprop="image"></span></li><?php } ?>
							<?php if ($data['cars_images2'] && $data['cars_images2']!=$data['cars_imgocher']) { ?><li id="thumbnail_2"><span><img class="img-responsive" id="thumb_2" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images2']) ? IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images2'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>" itemprop="image"></span></li><?php } ?>
							<?php if ($data['cars_images3'] && $data['cars_images3']!=$data['cars_imgocher']) { ?><li id="thumbnail_3"><span><img class="img-responsive" id="thumb_3" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images3']) ? IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images3'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>" itemprop="image"></span></li><?php } ?>
							<?php if ($data['cars_images4'] && $data['cars_images4']!=$data['cars_imgocher']) { ?><li id="thumbnail_4"><span><img class="img-responsive" id="thumb_4" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images4']) ? IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images4'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>" itemprop="image"></span></li><?php } ?>
							<?php if ($data['cars_images5'] && $data['cars_images5']!=$data['cars_imgocher']) { ?><li id="thumbnail_5"><span><img class="img-responsive" id="thumb_5" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5']) ? IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images5'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>" itemprop="image"></span></li><?php } ?>
							<?php if ($data['cars_images6'] && $data['cars_images6']!=$data['cars_imgocher']) { ?><li id="thumbnail_6"><span><img class="img-responsive" id="thumb_6" src="<?php echo (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images6']) ? IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_images6'] : IMAGES ."imagenotfound.jpg"); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?> <?php echo $data['cars_ili']; ?>" itemprop="image"></span></li><?php } ?>
						</ul>
					</div>
				</div>
<?php
add_to_footer ("<script  type='text/javascript' src='/". THEME ."js/html5lightbox.js'></script>");
add_to_head ("<link rel='stylesheet' href='/". THEME ."css/flexslider.css' type='text/css' media='screen' />");
add_to_footer ("<script  type='text/javascript' src='/". THEME ."js/jquery.flexslider.js'></script>");
add_to_footer ("<script type='text/javascript'>
	<!--
	$(window).load(function() {

		$('#view_full_size').flexslider({
			animation: 'slide',
			controlNav: false,
			directionNav: false,
			animationLoop: false,
			slideshow: false,
			sync: '#carousel'
		});

		$('#thumbs_list').flexslider({
			animation: 'slide',
			animationLoop: false,
			pauseOnHover: true,
			controlNav: false,
			directionNav: true,
			itemWidth: 107,
			itemMargin: 10,
			asNavFor: '#view_full_size'
		});
	});
	//-->
</script>");
?>

			</div>
			<div class="hr"></div>
			<div class="blok_name"><?php echo $locale['504']; ?></div>

			<?php if ($data['cars_aktiv']==1) { ?>
			<?php if ($data['cars_salon_id']) { ?>
			<div id="salon">
				<div class="fileds cars_salon_id">
					<label for="cars_salon_id"><?php echo $locale['570']; ?></label>
					<span><?php
						$resultsalon = dbquery("SELECT
													salon_name
											FROM ". DB_SALONS ."
											WHERE salon_aktiv='1' AND salon_id='". $data['cars_salon_id'] ."'");
						if (dbrows($resultsalon)) {
							$datasalon = dbarray($resultsalon);
							echo $datasalon['salon_name'];
						} // db query
					?></span>
				</div>
			</div>
			<?php } ?>
			<div class="fileds cars_adi">
				<label for="cars_adi"><?php echo $locale['580']; ?></label>
				<span><?php echo $data['cars_adi']; ?></span>
			</div>
			<div class="fileds cars_qorod">
				<label for="cars_qorod"><?php echo $locale['581']; ?></label>
				<span><?php echo $locale['qorod_'. $data['cars_qorod']]; ?></span>
			</div>
			<div class="fileds cars_mobiltel">
				<label for="cars_mobiltel"><?php echo $locale['582']; ?></label>
				<span><?php echo $data['cars_mobiltel']; ?></span>
			</div>
			<?php if ($data['cars_tel']) { ?>
			<div class="fileds cars_tel">
				<label for="cars_tel"><?php echo $locale['583']; ?></label>
				<span><?php echo $data['cars_tel']; ?></span>
			</div>
			<?php } ?>
			<small style="display:block;margin:0 0 15px 0;color:#16BB2F;text-align:center;"><?php echo $locale['global_910']; ?></small>
			<?php if ($data['cars_email']) { ?>
			<div class="fileds cars_email">
				<label for="cars_email"><?php echo $locale['584']; ?></label>
				<span><?php echo $data['cars_email']; ?></span>
			</div>
			<?php } ?>
			<?php } else { ?>
			<div class="fileds satilib">
				<p><?php echo $locale['satilib_001']; ?></p>
			</div>
			<?php } ?>
			<div class="hr"></div>

			<div class="fileds cars_today">
				<label for="cars_today"><?php echo $locale['590']; ?></label>
				<span><?php echo date("d.m.Y", $data['cars_today']); ?></span>
			</div>
			<div class="fileds cars_id">
				<label for="cars_id"><?php echo $locale['591']; ?></label>
				<span><?php echo $data['cars_id']; ?></span>
			</div>
			<div class="fileds cars_views">
				<label for="cars_views"><?php echo $locale['592']; ?></label>
				<span><?php echo $data['cars_views']; ?></span>
			</div>

			<div class="cars_share">
				<h4><?php echo $locale['593']; ?></h4>
				<div class="share42init"></div>
			</div>
			<?php add_to_footer("<script type='text/javascript' src='/". THEME ."js/share42.js'></script>"); ?>

			<div class="hr"></div>

		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3 col-sm-12">
			<div class="blok_name"><?php echo $locale['505']; ?></div>
			<div class="cars_komplekt row">
		<?php
			$komp_say=0;
			foreach ($datakomp_array as $komp_key => $komp_value) { $komp_say++;
		?>
				<div class="komptretiy col-sm-3">
					<label for="cars_komplekt<?php echo $komp_key; ?>">
						<?php if (in_array($komp_key, $cars_komplekt)) { ?>
						<img src="<?php echo IMAGES; ?>yes.png" alt="">
						<?php } else { ?>
						<img src="<?php echo IMAGES; ?>no.png" alt="">
						<?php } ?>
						<?php echo $komp_value; ?>
					</label>
				</div>
		<?php
			} // foreach datakomp_array
		?>
			</div>
			<div class="hr"></div>

			<?php // if ($data['cars_desc_text']) { ?>
			<div class="blok_name"><?php echo $locale['506']; ?></div>
			<div class="fileds cars_elaveinfo">
				<?php echo $data['cars_desc_text']; ?>









<?php
// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
if ($data['marka_name'] || $data['model_name']) {
// Call set_include_path() as needed to point to your client library.
include INCLUDES ."Google/autoload.php";
include INCLUDES ."Google/Client.php";
include INCLUDES ."Google/Service/YouTube.php";

  /*
   * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
   * Google Developers Console <https://console.developers.google.com/>
   * Please ensure that you have enabled the YouTube Data API for your project.
   */
  $DEVELOPER_KEY = 'AIzaSyCbwDKMv_2zqSriJOyPkTt5gTOKGvDuiJc';

  $client = new Google_Client();
  $client->setDeveloperKey($DEVELOPER_KEY);

  // Define an object that will be used to make all API requests.
  $youtube = new Google_Service_YouTube($client);


	// if (LOCALESET=="Azerbaijani/") { include LOCALE ."Russian/global.php"; }
	// $y_search_q = trim($data['marka_name'] ." ". $data['model_name'] ." ". $data['cars_ili'] ." ". $locale['kuzareng_'. $data['cars_kuzareng']]);
	$y_search_q = trim($data['marka_name'] ." ". $data['model_name'] ." ". $data['cars_ili'] ." Test drive");
	// echo "<pre>";
	// print_r($y_search_q);
	// echo "</pre>";
	// echo "<hr>";
	// if (LOCALESET=="Azerbaijani/") { include LOCALE.LOCALESET."global.php"; }

  try {
		// Call the search.list method to retrieve results matching the specified
		// query term.

		$searchResponse = $youtube->search->listSearch('id', array(
		  'part' => 'snippet',
		  'q' => $y_search_q,
		  'maxResults' => 1,
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

			// echo "<pre>";
			// print_r($searchResult);
			// echo "</pre>";
			// echo "<hr>";

		  switch ($searchResult['id']['kind']) {
				case 'youtube#video':

				  $videos .= "<div>\n<br /><iframe width='605' height='350' src='https://www.youtube.com/embed/". $searchResult['id']['videoId'] ."' frameborder='0' allowfullscreen  style='width:100%;'></iframe><br />\n</div>\n";
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
?>









			</div>
			<div class="hr"></div>
			<?php // } ?>




			<div class="blok_name"><?php echo $locale['506a']; ?></div>
			<div class="cars_comments">

				<div id="fb-root"></div>
				<?php
				add_to_footer ("
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = '//connect.facebook.net/". $locale['fb_lang'] ."/sdk.js#xfbml=1&version=v2.0';
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>");
				?>

				<div class="fb-comments" data-href="http://<?php echo $settings['site_host'] . FUSION_URI; ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>

			</div>
			<div class="hr"></div>

			<?php
				// $viewcompanent = viewcompanent("car", "name");
				// $seourl_component = $viewcompanent['components_id'];

				// $result_fatured = dbquery("SELECT
				// 							marka_name,
				// 							model_name,
				// 							cars_imgocher,
				// 							cars_qiymeti,
				// 							cars_valyuta,
				// 							seourl_url
				// 					FROM ". DB_CARS ."
				// 					INNER JOIN ". DB_MARKA ." ON ". DB_CARS .".cars_marka=". DB_MARKA .".marka_id
				// 					INNER JOIN ". DB_MODEL ." ON ". DB_CARS .".cars_model=". DB_MODEL .".model_id 
				// 					LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=cars_id AND seourl_component=". $seourl_component ."
				// 					WHERE cars_aktiv='1'
				// 					AND cars_id!='". $data['cars_id'] ."'
				// 					AND cars_marka='". $data['cars_marka'] ."'
				// 					AND cars_model='". $data['cars_model'] ."'
				// 					ORDER BY `cars_id` DESC
				// 					LIMIT 0, 5");

				// if (dbrows($result_fatured)) {
				// 	$j_fatured=0;
			?>
			<div class="carbloks allcars">
				<div class="title"><?php echo $data['marka_name'] ." ". $data['model_name'] ." ". $locale['508']; ?></div>
				<div class="cars">
				<?php
				add_to_footer ("
					<script type='text/javascript'>
						<!--
						$(document).ready(function(){
							$('#car_all_models').html('<img src=\'". IMAGES ."ajax-loader.GIF\' alt=\'\' class=\'ajax-loader\' /><br /><img src=\'". IMAGES ."ajax-loading.gif\' alt=\'\' class=\'ajax-loading\'>');
							$.ajax({
								type: 'POST',
								url: '/". INCLUDES ."Json/cars.php',
								dataType: 'json',
								data: {cars:'1', limit:'4', where:'cars_id!=". $data['cars_id'] ." AND cars_marka=". $data['cars_marka'] ." AND cars_model=". $data['cars_model'] ."'},
								success: function(data){
									var html = '';
									var say = 0;
									$.each(data,function(inx, item) { say++;
										html += '<div class=\'items item'+ say +' col-sm-3\'>';
										html += '	<div class=\'marka-model\'><a href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.marka_name +' '+ item.model_name +'</a></div>';
										html += '	<div class=\'images\'><a href=\'/'+ item.seourl_url +'\' target=\'_blank\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'></a></div>';
										html += '	<div class=\'cena\'><a href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.cars_qiymeti +'</a></div>';
										html += '</div>';
										// console.log(item.marka_name +' - '+ item.model_name);

										if (say==5) { say=0; }
									});
									$('#car_all_models').html( html );
								}
							});
						});
						//-->
					</script>
					");
					?>
					<div id="car_all_models" class="row"></div>

					<?php /* while ($data_fatured = dbarray($result_fatured)) { $j_fatured++; ?>
					<div class="items item<?php echo $j_fatured; ?>">
						<div class="marka-model"><a href="<?php echo BASEDIR . $data_fatured['seourl_url']; ?>" target="_blank"><?php echo $data_fatured['marka_name']; ?> <?php echo $data_fatured['model_name']; ?></a></div>
						<div class="images"><a href="<?php echo BASEDIR . $data_fatured['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data_fatured['cars_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['cars_foto_dir'] ."/rl". $data_fatured['cars_imgocher']); ?>" alt="<?php echo $data_fatured['marka_name']; ?> <?php echo $data_fatured['model_name']; ?>"></a></div>
						<div class="cena"><a href="<?php echo BASEDIR . $data_fatured['seourl_url']; ?>" target="_blank"><?php echo viewcena($data_fatured['cars_qiymeti'], $data_fatured['cars_valyuta']); ?></a></div>
					</div>
					<?php } // db while */ ?>
					<div class="clear-both"></div>
					<?php // if ($j_fatured==5) { ?>
					<div class="allcars"><a href="/cars/?marka=<?php echo $data['cars_marka']; ?>&model=<?php echo $data['cars_model']; ?>" target="_blank"><?php echo sprintf($locale['509'], $data['marka_name'] ." ". $data['model_name']); ?></a></div>
					<?php // } // yesli bolshe 5 -i ?>
				</div>
			</div>
			<?php // } // db query ?>

		</div>
		<div class="clear-both"></div>

		<div class="obyazatelno"><?php echo $locale['610']; ?></div>

	</div>


<?php

echo ("<script type='text/javascript'>
			<!--
			function DeleteOk() {
				return confirm('Вы уверены?');
			}
			//-->
		</script>");

					closetable();
	
				} else { 
					include COMPONENTS."404.php";
				} // Esli CAR Yest
?>