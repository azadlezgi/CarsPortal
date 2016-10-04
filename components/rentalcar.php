<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }


				$result = dbquery("SELECT
												marka_name,
												model_name,
												rentalcar_id,
												rentalcar_marka,
												rentalcar_model,
												rentalcar_ili,
												rentalcar_qiymeti,
												rentalcar_valyuta,
												rentalcar_company,
												rentalcar_adi,
												rentalcar_mobiltel,
												rentalcar_tel,
												rentalcar_email,
												rentalcar_images1,
												rentalcar_images2,
												rentalcar_images3,
												rentalcar_images4,
												rentalcar_images5,
												rentalcar_images6,
												rentalcar_imgocher,
												rentalcar_elaveinfo,
												rentalcar_today,
												rentalcar_aktiv,
												rentalcar_views
									FROM ". DB_RENTALCARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_RENTALCARS .".rentalcar_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_RENTALCARS .".rentalcar_model=". DB_MODEL .".model_id 
									WHERE (rentalcar_aktiv='1' || rentalcar_aktiv='4')
									AND rentalcar_id='". $filedid ."'");

				if (dbrows($result)) {

					include LOCALE.LOCALESET."rentalcar.php";
					$data = dbarray($result);

					### UPDATE SERVICES VIEWS BEGIN
					$rentalcar_views = $data['rentalcar_views']+1;
					$resultviews = dbquery(
						"UPDATE ". DB_RENTALCARS ." SET
														rentalcar_views='". $rentalcar_views ."'
						WHERE rentalcar_id='". $data['rentalcar_id'] ."'"
					);
					### UPDATE SERVICES VIEWS END

					if (!empty($data['rentalcar_id'])) set_title($locale['title'] ." ". $data['marka_name'] ." ". $data['model_name'] ." - ". $settings['sitename']);
					$rentalcar_elaveinfo = strip_tags($data['rentalcar_elaveinfo']);
					if (!empty($data['salon_id'])) set_meta("description", ($rentalcar_elaveinfo ? $rentalcar_elaveinfo : $data['marka_name'] ." ". $data['model_name'] ." ". $locale['description_1'] ." ". $data['cars_ili'] ) );
					if (!empty($data['rentalcar_id'])) set_meta("keywords", "");

					echo "<div class='breadcrumb'>\n";
					echo "	<ul>\n";
					echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
					echo "		<li><a href='". BASEDIR ."rentalcars.php'>". $locale['641'] ."</a></li>\n";
					echo "		<li><span>". $data['marka_name'] ." ". $data['model_name'] ."</span></li>\n";
					echo "	</ul>\n";
					echo "</div>\n";

					opentable($data['marka_name'] ." ". $data['model_name']);
?>

	<div class="addcar"><a href="<?php echo BASEDIR; ?>addrentalcars.php"><?php echo $locale['600']; ?></a></div>
<?php
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
?>
	<div class="editcar"><a href="<?php echo ADMIN ."rentalcars.php".  $aidlink ."&action=edit&id=". $data['rentalcar_id']; ?>" target="_blank"><?php echo $locale['601']; ?></a></div>
<?php
	}
?>
	<div class="rentalcarinfo">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds rentalcar_marka">
				<label for="rentalcar_marka"><?php echo $locale['510']; ?></label>
				<span><?php echo $data['marka_name']; ?></span>
			</div>
			<div class="fileds rentalcar_model">
				<label for="rentalcar_model"><?php echo $locale['511']; ?></label>
				<span><?php echo $data['model_name']; ?></span>
			</div>
			<div class="fileds rentalcar_ili">
				<label for="rentalcar_ili"><?php echo $locale['512']; ?></label>
				<span><?php echo $data['rentalcar_ili']; ?></span>
			</div>

			<div class="fileds rentalcar_qiymeti">
				<label for="rentalcar_qiymeti"><?php echo $locale['513']; ?></label>
				<span class='viewcena'><?php echo viewcena($data['rentalcar_qiymeti'], $data['rentalcar_valyuta']); ?></span>
			</div>
			<div class="fileds rentalcar_company">
				<label for="rentalcar_company"><?php echo $locale['514']; ?></label>
				<span><?php echo $data['rentalcar_company']; ?></span>
			</div>
			
			<?php if ($data['rentalcar_aktiv']==1) { ?>
			<div class="fileds rentalcar_adi">
				<label for="rentalcar_adi"><?php echo $locale['515']; ?></label>
				<span><?php echo $data['rentalcar_adi']; ?></span>
			</div>
			<div class="fileds rentalcar_mobiltel">
				<label for="rentalcar_mobiltel"><?php echo $locale['516']; ?></label>
				<span><img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['rentalcar_mobiltel']); ?>" alt="" />
			</div>
			<?php if ($data['rentalcar_tel']) { ?>
			<div class="fileds rentalcar_tel">
				<label for="rentalcar_tel"><?php echo $locale['517']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['rentalcar_tel']); ?>" alt="" />
			</div>
			<?php } ?>
			<?php if ($data['rentalcar_email']) { ?>
			<div class="fileds rentalcar_email">
				<label for="rentalcar_email"><?php echo $locale['518']; ?></label>
				<span><?php echo $data['rentalcar_email']; ?></span>
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
			<div class="fileds rentalcar_images">
				<div class="big-img">
					<a rel="lightbox[plants]" href="<?php echo (empty($data['rentalcar_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_imgocher']); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"><img name="bigimg" src="<?php echo (empty($data['rentalcar_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a>
				</div>
				<div class="small-img">
					<div class="flexslider">
						<ul class="slides">
							<?php if ($data['rentalcar_images1']) { ?><li><img class="img1" src="<?php echo IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_images1']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images1']; ?>';"></li><?php } ?>
							<?php if ($data['rentalcar_images2']) { ?><li><img class="img2" src="<?php echo IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_images2']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images2']; ?>';"></li><?php } ?>
							<?php if ($data['rentalcar_images3']) { ?><li><img class="img3" src="<?php echo IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_images3']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images3']; ?>';"></li><?php } ?>
							<?php if ($data['rentalcar_images4']) { ?><li><img class="img4" src="<?php echo IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_images4']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images4']; ?>';"></li><?php } ?>
							<?php if ($data['rentalcar_images5']) { ?><li><img class="img5" src="<?php echo IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_images5']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images5']; ?>';"></li><?php } ?>
							<?php if ($data['rentalcar_images6']) { ?><li><img class="img6" src="<?php echo IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_images6']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images6']; ?>';"></li><?php } ?>
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
					<?php if ($data['rentalcar_images2']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images2']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['rentalcar_images3']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images3']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['rentalcar_images4']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images4']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['rentalcar_images5']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images5']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['rentalcar_images6']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['rentalcars_foto_dir'] ."&file=". $data['rentalcar_images6']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
				</div>
			</div>
			<div class="hr"></div>

			<div class="fileds rentalcar_today">
				<label for="rentalcar_today"><?php echo $locale['590']; ?></label>
				<span><?php echo date("d.m.Y", $data['rentalcar_today']); ?></span>
			</div>
			<div class="fileds rentalcar_id">
				<label for="rentalcar_id"><?php echo $locale['591']; ?></label>
				<span><?php echo $data['rentalcar_id']; ?></span>
			</div>
			<div class="fileds rentalcar_views">
				<label for="rentalcar_views"><?php echo $locale['592']; ?></label>
				<span><?php echo $data['rentalcar_views']; ?></span>
			</div>
			<div class="hr"></div>

		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">

			<?php if ($data['rentalcar_elaveinfo']) { ?>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds rentalcar_elaveinfo">
				<?php echo $data['rentalcar_elaveinfo']; ?>
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
				} // Esli CAR Yest
?>