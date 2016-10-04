<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

				$result = dbquery("SELECT
												service_id,
												service_name,
												service_qorod,
												service_adress,
												service_mobiltel,
												service_tel,
												service_email,
												service_site,
												service_images1,
												service_images2,
												service_images3,
												service_imgocher,
												service_elaveinfo,
												service_today,
												service_aktiv,
												service_views
									FROM ". DB_SERVICES ."
									WHERE (service_aktiv='1' || service_aktiv='4')
									AND service_id='". $filedid ."'");

				if (dbrows($result)) {

					include LOCALE.LOCALESET."service.php";
					$data = dbarray($result);

					### UPDATE SERVICES VIEWS BEGIN
					$service_views = $data['service_views']+1;
					$resultviews = dbquery(
						"UPDATE ". DB_SERVICES ." SET
														service_views='". $service_views ."'
						WHERE service_id='". $data['service_id'] ."'"
					);
					### UPDATE SERVICES VIEWS END

					if (!empty($data['service_id'])) set_title($locale['title'] ." ". $data['service_name'] ." - ". $settings['sitename']);
					$service_elaveinfo = strip_tags($data['service_elaveinfo']);
					if (!empty($data['service_id'])) set_meta("description", ($service_elaveinfo ? $service_elaveinfo : $locale['511'] ." ". $locale['qorod_'. $data['service_qorod']] ." ". $locale['512'] ." ". $data['service_adress']) );
					if (!empty($data['service_id'])) set_meta("keywords", "");

					echo "<div class='breadcrumb'>\n";
					echo "	<ul>\n";
					echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
					echo "		<li><a href='". BASEDIR ."services.php'>". $locale['641'] ."</a></li>\n";
					echo "		<li><span>". $data['service_name'] ."</span></li>\n";
					echo "	</ul>\n";
					echo "</div>\n";

					opentable($data['service_name']);
?>

	<div class="addcar"><a href="<?php echo BASEDIR; ?>addservices.php"><?php echo $locale['600']; ?></a></div>
<?php
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
?>
	<div class="editcar"><a href="<?php echo ADMIN ."services.php".  $aidlink ."&action=edit&id=". $data['service_id']; ?>" target="_blank"><?php echo $locale['601']; ?></a></div>
<?php
	}
?>
	<div class="serviceinfo">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds service_name">
				<label for="service_name"><?php echo $locale['510']; ?></label>
				<span><?php echo $data['service_name']; ?></span>
			</div>
			<div class="fileds service_qorod">
				<label for="service_qorod"><?php echo $locale['511']; ?></label>
				<span><?php echo $locale['qorod_'. $data['service_qorod']]; ?></span>
			</div>
			<div class="fileds service_adress">
				<label for="service_adress"><?php echo $locale['512']; ?></label>
				<span><?php echo $data['service_adress']; ?></span>
			</div>
			<?php if ($data['service_aktiv']==1) { ?>
			<div class="fileds service_mobiltel">
				<label for="service_mobiltel"><?php echo $locale['513']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['service_mobiltel']); ?>" alt="" />
			</div>
			<?php if ($data['service_tel']) { ?>
			<div class="fileds service_tel">
				<label for="service_tel"><?php echo $locale['514']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['service_tel']); ?>" alt="" />
			</div>
			<?php } ?>
			<small style="color:#16BB2F;"><?php echo $locale['global_910']; ?></small>
			<?php if ($data['service_email']) { ?>
			<div class="fileds service_email">
				<label for="service_email"><?php echo $locale['515']; ?></label>
				<span><?php echo $data['service_email']; ?></span>
			</div>
			<?php } ?>
			<?php if ($data['service_site']) { ?>
			<div class="fileds service_site">
				<label for="service_site"><?php echo $locale['517']; ?></label>
				<span><?php echo $data['service_site']; ?></span>
			</div>
			<?php } ?>
			<?php } else { ?>
			<div class="fileds satilib">
				<p><?php echo $locale['satilib_001']; ?></p>
			</div>
			<?php } ?>
			<div class="hr"></div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds service_images">
				<div class="big-img">
					<a rel="lightbox[plants]" href="<?php echo (empty($data['service_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_imgocher']); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"><img name="bigimg" src="<?php echo (empty($data['service_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a>
				</div>
				<div class="small-img">
					<div class="flexslider">
						<ul class="slides">
							<?php if ($data['service_images1']) { ?><li><img class="img1" src="<?php echo IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images1']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_images1']; ?>';"></li><?php } ?>
							<?php if ($data['service_images2']) { ?><li><img class="img2" src="<?php echo IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images2']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_images2']; ?>';"></li><?php } ?>
							<?php if ($data['service_images3']) { ?><li><img class="img3" src="<?php echo IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_images3']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_images3']; ?>';"></li><?php } ?>
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
					<?php if ($data['service_images2']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_images2']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['service_images3']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_images3']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['service_images4']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['services_foto_dir'] ."&file=". $data['service_images4']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
				</div>
			</div>
			<div class="hr"></div>

			<div class="fileds service_today">
				<label for="service_today"><?php echo $locale['590']; ?></label>
				<span><?php echo date("d.m.Y", $data['service_today']); ?></span>
			</div>
			<div class="fileds service_id">
				<label for="service_id"><?php echo $locale['591']; ?></label>
				<span><?php echo $data['service_id']; ?></span>
			</div>
			<div class="fileds service_views">
				<label for="service_views"><?php echo $locale['592']; ?></label>
				<span><?php echo $data['service_views']; ?></span>
			</div>
			<div class="hr"></div>

		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">

			<?php if ($data['service_elaveinfo']) { ?>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds service_elaveinfo">
				<?php echo $data['service_elaveinfo']; ?>
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



	<div class="obyazatelno"><?php echo $locale['610']; ?></div>

<?php
					closetable();
	
				} else { 
					include COMPONENTS."404.php";
				} // Esli service Yest
?>