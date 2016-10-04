<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

				$result = dbquery("SELECT
												salon_id,
												salon_name,
												salon_qorod,
												salon_adress,
												salon_mobiltel,
												salon_tel,
												salon_email,
												salon_site,
												salon_images1,
												salon_images2,
												salon_images3,
												salon_imgocher,
												salon_elaveinfo,
												salon_today,
												salon_aktiv,
												salon_views
									FROM ". DB_SALONS ."
									WHERE (salon_aktiv='1' || salon_aktiv='4')
									AND salon_id='". $filedid ."'");

				if (dbrows($result)) {

					include LOCALE.LOCALESET."salon.php";
					$data = dbarray($result);

					### UPDATE SALONS VIEWS BEGIN
					$salon_views = $data['salon_views']+1;
					$resultviews = dbquery(
						"UPDATE ". DB_SALONS ." SET
														salon_views='". $salon_views ."'
						WHERE salon_id='". $data['salon_id'] ."'"
					);
					### UPDATE SALONS VIEWS END

					if (!empty($data['salon_id'])) set_title($locale['title'] ." - ". $data['salon_name'] ." - ". $settings['sitename']);
					$salon_elaveinfo = strip_tags($data['salon_elaveinfo']);
					if (!empty($data['salon_id'])) set_meta("description", ($salon_elaveinfo ? $salon_elaveinfo : $locale['511'] ." ". $locale['qorod_'. $data['salon_qorod']] ." ". $locale['512'] ." ". $data['salon_adress']) );
					if (!empty($data['salon_id'])) set_meta("keywords", "");

					echo "<div class='breadcrumb'>\n";
					echo "	<ul>\n";
					echo "		<li><a href='/'>". $locale['640'] ."</a></li>\n";
					echo "		<li><a href='/autosalons/'>". $locale['641'] ."</a></li>\n";
					echo "		<li><span>". $data['salon_name'] ."</span></li>\n";
					echo "	</ul>\n";
					echo "</div>\n";

					opentable($data['salon_name']);
?>

	<div class="addcar"><a href="/autosalons/add/"><?php echo $locale['600']; ?></a></div>
<?php
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
?>
	<div class="editcar"><a href="/<?php echo ADMIN ."salons.php".	$aidlink ."&action=edit&id=". $data['salon_id']; ?>" target="_blank"><?php echo $locale['601']; ?></a></div>
<?php
	}
?>
	<div class="saloninfo">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds salon_name">
				<label for="salon_name"><?php echo $locale['510']; ?></label>
				<span><?php echo $data['salon_name']; ?></span>
			</div>
			<div class="fileds salon_qorod">
				<label for="salon_qorod"><?php echo $locale['511']; ?></label>
				<span><?php echo $locale['qorod_'. $data['salon_qorod']]; ?></span>
			</div>
			<div class="fileds salon_adress">
				<label for="salon_adress"><?php echo $locale['512']; ?></label>
				<span><?php echo $data['salon_adress']; ?></span>
			</div>
			<?php if ($data['salon_aktiv']==1) { ?>
			<div class="fileds salon_mobiltel">
				<label for="salon_mobiltel"><?php echo $locale['513']; ?></label>
				<img src="/<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['salon_mobiltel']); ?>" alt="" />
			</div>
			<?php if ($data['salon_tel']) { ?>
			<div class="fileds salon_tel">
				<label for="salon_tel"><?php echo $locale['514']; ?></label>
				<img src="/<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['salon_tel']); ?>" alt="" />
			</div>
			<?php } ?>
			<small style="color:#16BB2F;"><?php echo $locale['global_910']; ?></small>
			<?php if ($data['salon_email']) { ?>
			<div class="fileds salon_email">
				<label for="salon_email"><?php echo $locale['515']; ?></label>
				<span><?php echo $data['salon_email']; ?></span>
			</div>
			<?php } ?>
			<?php if ($data['salon_site']) { ?>
			<div class="fileds salon_site">
				<label for="salon_site"><?php echo $locale['517']; ?></label>
				<span><?php echo $data['salon_site']; ?></span>
			</div>
			<?php } ?>
			<?php } else { ?>
			<div class="fileds satilib">
				<p><?php echo $locale['satilib_001']; ?></p>
			</div>
			<?php } ?>
			<div class="hr"></div>

			<div class="fileds salon_map">
				<?php
					echo ("<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.15&sensor=false&libraries=places'></script>");
					echo ("<script type='text/javascript'> 
						<!--
						var gmarkers = []; 
						var map = null;
						function initialize() {
							var myOptions = {
												zoom: 12,
												// center: new google.maps.LatLng('40.417235', '49.839271'),
												mapTypeControl: true,
												mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
												navigationControl: true,
												mapTypeId: google.maps.MapTypeId.ROADMAP
							} // myOptions
							map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
							geocoder = new google.maps.Geocoder();
							geocoder.geocode( { 'address': 'Azerbaijan, ". $locale['qorod_'. $data['salon_qorod']] .", ". $data['salon_adress'] ."'}, function(results, status) {
								if (status == google.maps.GeocoderStatus.OK) {
									map.setCenter(results[0].geometry.location);
									// console.log('Центр:', results);
									var marker = new google.maps.Marker({
										map: map,
										position: results[0].geometry.location,
										animation: google.maps.Animation.DROP,
									});

									google.maps.event.addListener(marker, 'click', function() {
										infowindow.setContent('<b>". $data['salon_name'] ."</b><br />". $locale['qorod_'. $data['salon_qorod']] .", ". $data['salon_adress'] ."');
										infowindow.open(map,marker);
										// map.setZoom(13);
									});
								} else {
									console.log('Geocode was not successful for the following reason: ' + status);
								}
							});
						} // function initialize
						google.maps.event.addDomListener(window, 'load', initialize);
						var infowindow = new google.maps.InfoWindow({ 
							size: new google.maps.Size(150,50)
						});
						//-->
					</script>");
				?>
				<div id='map_canvas' style="width:100%; height:200px;"></div>
			</div>


		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds salon_images">
				<div class="big-img">
					<a rel="lightbox[plants]" href="/<?php echo (empty($data['salon_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_imgocher']); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"><img name="bigimg" src="/<?php echo (empty($data['salon_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a>
				</div>
				<div class="small-img">
					<div class="flexslider">
						<ul class="slides">
							<?php if ($data['salon_images1']) { ?><li><img class="img1" src="/<?php echo IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images1']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='/<?php echo INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_images1']; ?>';"></li><?php } ?>
							<?php if ($data['salon_images2']) { ?><li><img class="img2" src="/<?php echo IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images2']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='/<?php echo INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_images2']; ?>';"></li><?php } ?>
							<?php if ($data['salon_images3']) { ?><li><img class="img3" src="/<?php echo IMAGES . $settings['salons_foto_dir'] ."/sm". $data['salon_images3']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='/<?php echo INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_images3']; ?>';"></li><?php } ?>
						</ul>
					</div>

					<script type="text/javascript">
						<!--
						$(window).load(function() {
							$('.flexslider').flexslider({
								animation: "slide",
								animationLoop: false,
								itemWidth: 70,
								itemMargin: 5,
								controlNav: false,
								directionNav: true,
								slideshow: false,
							});
						});
						//-->
					</script>

				</div>
				<div class="hidden-big-img">
					<?php if ($data['salon_images2']) { ?><a rel="lightbox[plants]" href="/<?php echo INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_images2']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['salon_images3']) { ?><a rel="lightbox[plants]" href="/<?php echo INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_images3']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['salon_images4']) { ?><a rel="lightbox[plants]" href="/<?php echo INCLUDES ."foto.php?folder=". $settings['salons_foto_dir'] ."&file=". $data['salon_images4']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
				</div>
			</div>
			<div class="hr"></div>
			
			<div class="fileds salon_today">
				<label for="salon_today"><?php echo $locale['590']; ?></label>
				<span><?php echo date("d.m.Y", $data['salon_today']); ?></span>
			</div>
			<div class="fileds salon_id">
				<label for="salon_id"><?php echo $locale['591']; ?></label>
				<span><?php echo $data['salon_id']; ?></span>
			</div>
			<div class="fileds salon_views">
				<label for="salon_views"><?php echo $locale['592']; ?></label>
				<span><?php echo $data['salon_views']; ?></span>
			</div>
			<div class="hr"></div>

		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">

			<?php if ($data['salon_elaveinfo']) { ?>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds salon_elaveinfo">
				<?php echo $data['salon_elaveinfo']; ?>
			</div>
			<div class="hr"></div>
			<?php } ?>

			<div class="blok_name"><?php echo $locale['global_027']; ?></div>
			<div class="fileds cars_comments">

				<div id="fb-root"></div>
				<script>(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/<?php echo $locale['fb_lang'] ?>/sdk.js#xfbml=1&version=v2.0";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>

				<div class="fb-comments" data-href="http://<?php echo $settings['site_host'] . FUSION_URI; ?>" data-width="600" data-numposts="5" data-colorscheme="light"></div>

			</div>
			<div class="hr"></div>

		</div>
	</div>


			<?php

				$filterdb = " AND cars_salon_id='". $data['salon_id'] ."'";

				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("car", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											marka_name,
											model_name,
											cars_marka,
											cars_imgocher,
											cars_qiymeti,
											cars_valyuta,
											seourl_url
									FROM ". DB_CARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_CARS .".cars_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_CARS .".cars_model=". DB_MODEL .".model_id 
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=cars_id AND seourl_component=". $seourl_component ."
									WHERE (cars_aktiv='1' || cars_aktiv='4')". $filterdb ."
									ORDER BY `cars_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
			?>
	<div class="carbloks allcars">
		<div class="title"><?php echo $locale['620']; ?></div>
		<div class="cars">
			<?php
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?>">
				<div class="marka-model"><a href="/<?php echo $data['seourl_url']; ?>" target="_blank"><?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?></a></div>
				<div class="images"><a href="/<?php echo $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['cars_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
				<div class="cena"><a href="/<?php echo $data['seourl_url']; ?>" target="_blank"><?php echo viewcena($data['cars_qiymeti'], $data['cars_valyuta']); ?></a></div>
			</div>
			<?php
						if ($j==5) { $j=0; }
						$cars_marka_id = $data['cars_marka'];
						$cars_marka_name = $data['marka_name'];
					} // db while
			?>
			<div class="clear-both"></div>
		</div>
	</div>

			<?php echo navigation($_GET['page'], $settings['goruser'], "cars_id", DB_CARS, "(cars_aktiv='1' || cars_aktiv='4')". $filterdb .""); ?>



			<div class="carbloks allcars">
				<div class="title"><?php echo $cars_marka_name ." ". $locale['508']; ?></div>
				<div class="cars">
				<?php
				echo ("
					<script type='text/javascript'>
						<!--
						$(document).ready(function(){
							$('#car_all_marks').html('<img src=\'/". IMAGES ."ajax-loader.GIF\' alt=\'\' class=\'ajax-loader\' /><br /><img src=\'/". IMAGES ."ajax-loading.gif\' alt=\'\' class=\'ajax-loading\'>');
							$.ajax({
								type: 'POST',
								url: '/". INCLUDES ."Json/cars.php',
								dataType: 'json',
								data: {cars:'1', limit:'10', where:'cars_marka=". $cars_marka_id ."'},
								success: function(data){
									var html = '';
									var say = 0;
									$.each(data,function(inx, item) { say++;
										html += '<div class=\'items item'+ say +'\'>';
										html += '	<div class=\'marka-model\'><a href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.marka_name +' '+ item.model_name +'</a></div>';
										html += '	<div class=\'images\'><a href=\'/'+ item.seourl_url +'\' target=\'_blank\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'></a></div>';
										html += '	<div class=\'cena\'><a href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.cars_qiymeti +'</a></div>';
										html += '</div>';
										// console.log(item.marka_name +' - '+ item.model_name);

										if (say==5) { say=0; }
									});
									$('#car_all_marks').html( html );
								}
							});
						});
						//-->
					</script>
					");
					?>
					<div id="car_all_marks"></div>

					<div class="clear-both"></div>
					<div class="allcars"><a href="<?php echo BASEDIR; ?>cars/?marka=<?php echo $cars_marka_id; ?>" target="_blank"><?php echo sprintf($locale['509'], $cars_marka_name); ?></a></div>
				</div>
			</div>

			<?php } // db query ?>


	<div class="obyazatelno"><?php echo $locale['610']; ?></div>

<?php
					closetable();
	
				} else { 
					include COMPONENTS."404.php";
				} // Esli salon Yest
?>