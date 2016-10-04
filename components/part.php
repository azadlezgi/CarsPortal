<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }


				$result = dbquery("SELECT
												parts_id,
												parts_category_id,
												parts_name,
												parts_qiymeti,
												parts_valyuta,
												parts_shop_id,
												parts_adi,
												parts_mobiltel,
												parts_tel,
												parts_email,
												parts_images1,
												parts_images2,
												parts_images3,
												parts_imgocher,
												parts_elaveinfo,
												parts_ip,
												parts_today,
												parts_aktiv,
												parts_views
									FROM ". DB_PARTS ."
									WHERE (parts_aktiv='1' || parts_aktiv='4')
									AND parts_id='". $filedid ."'");

				if (dbrows($result)) {

					include LOCALE.LOCALESET."part.php";
					$data = dbarray($result);

					### UPDATE parts VIEWS BEGIN
					$parts_views = $data['parts_views']+1;
					$resultviews = dbquery(
						"UPDATE ". DB_PARTS ." SET
														parts_views='". $parts_views ."'
						WHERE parts_id='". $data['parts_id'] ."'"
					);
					### UPDATE parts VIEWS END


					if (!empty($data['parts_id'])) set_title($locale['title'] ." ". $data['parts_name'] ." - ". $settings['sitename']);
					$parts_elaveinfo = strip_tags($data['parts_elaveinfo']);
					if (!empty($data['parts_id'])) set_meta("description", ($parts_elaveinfo ? $parts_elaveinfo : "") );
					if (!empty($data['parts_id'])) set_meta("keywords", "");

					echo "<div class='breadcrumb'>\n";
					echo "	<ul>\n";
					echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
					echo "		<li><a href='". BASEDIR ."parts.php'>". $locale['641'] ."</a></li>\n";
					echo "		<li><span>". $data['parts_name'] ."</span></li>\n";
					echo "	</ul>\n";
					echo "</div>\n";

					opentable($data['parts_name']);
?>

	<div class="addcar"><a href="<?php echo BASEDIR; ?>addparts.php"><?php echo $locale['600']; ?></a></div>
<?php
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
?>
	<div class="editcar"><a href="<?php echo ADMIN ."parts.php".  $aidlink ."&action=edit&id=". $data['parts_id']; ?>" target="_blank"><?php echo $locale['601']; ?></a></div>
<?php
	}
?>
	<div class="partinfo">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>

			<?php
				$result_partcats = dbquery("SELECT
											partcats_name
									FROM ". DB_PARTCATS ."
									WHERE partcats_id='". $data['parts_category_id'] ."'");
				if (dbrows($result_partcats)) {
					$data_partcats = dbarray($result_partcats);
			?>
			<div class="fileds parts_category_id">
				<label for="parts_category_id"><?php echo $locale['510']; ?></label>
				<span><?php echo unserialize($data_partcats['partcats_name'])[LOCALESHORT]; ?></span>
			</div>
			<?php
				} // db query
			?>
			<div class="fileds parts_name">
				<label for="parts_name"><?php echo $locale['511']; ?></label>
				<span><?php echo $data['parts_name']; ?></span>
			</div>
			<div class="fileds parts_qiymeti">
				<label for="parts_qiymeti"><?php echo $locale['512']; ?></label>
				<span class='viewcena'><?php echo viewcena($data['parts_qiymeti'], $data['parts_valyuta']); ?></span>
			</div>
			
			<?php if ($data['parts_aktiv']==1) { ?>
			<?php
				$result_shop = dbquery("SELECT
											shop_name
									FROM ". DB_SHOPS ."
									WHERE shop_aktiv='1' AND shop_id='". $data['parts_shop_id'] ."'");
				if (dbrows($result_shop)) {
					$data_shop = dbarray($result_shop);
			?>
			<div class="fileds parts_shop_id">
				<label for="parts_shop_id"><?php echo $locale['513']; ?></label>
				<span><?php echo $data_shop['shop_name']; ?></span>
			</div>
			<?php
				} // db query
			?>
			<div class="fileds parts_adi">
				<label for="parts_adi"><?php echo $locale['514']; ?></label>
				<span><?php echo $data['parts_adi']; ?></span>
			</div>
			<div class="fileds parts_mobiltel">
				<label for="parts_mobiltel"><?php echo $locale['515']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['parts_mobiltel']); ?>" alt="" />
			</div>
			<?php if ($data['parts_tel']) { ?>
			<div class="fileds parts_tel">
				<label for="parts_tel"><?php echo $locale['516']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['parts_tel']); ?>" alt="" />
			</div>
			<?php } ?>
			<small style="color:#16BB2F;"><?php echo $locale['global_910']; ?></small>
			<?php if ($data['parts_email']) { ?>
			<div class="fileds parts_email">
				<label for="parts_email"><?php echo $locale['517']; ?></label>
				<span><?php echo $data['parts_email']; ?></span>
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
			<div class="fileds parts_images">
				<div class="big-img">
					<a rel="lightbox[plants]" href="<?php echo (empty($data['parts_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['parts_foto_dir'] ."&file=". $data['parts_imgocher']); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"><img name="bigimg" src="<?php echo (empty($data['parts_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['parts_foto_dir'] ."&file=". $data['parts_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a>
				</div>
				<div class="small-img">
					<div class="flexslider">
						<ul class="slides">
							<?php if ($data['parts_images1']) { ?><li><img class="img1" src="<?php echo IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images1']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['parts_foto_dir'] ."&file=". $data['parts_images1']; ?>';"></li><?php } ?>
							<?php if ($data['parts_images2']) { ?><li><img class="img2" src="<?php echo IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images2']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['parts_foto_dir'] ."&file=". $data['parts_images2']; ?>';"></li><?php } ?>
							<?php if ($data['parts_images3']) { ?><li><img class="img3" src="<?php echo IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_images3']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['parts_foto_dir'] ."&file=". $data['parts_images3']; ?>';"></li><?php } ?>
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
					<?php if ($data['parts_images2']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['parts_foto_dir'] ."&file=". $data['parts_images2']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['parts_images3']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['parts_foto_dir'] ."&file=". $data['parts_images3']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
				</div>
			</div>
			<div class="hr"></div>

			<div class="fileds parts_today">
				<label for="parts_today"><?php echo $locale['590']; ?></label>
				<span><?php echo date("d.m.Y", $data['parts_today']); ?></span>
			</div>
			<div class="fileds parts_id">
				<label for="parts_id"><?php echo $locale['591']; ?></label>
				<span><?php echo $data['parts_id']; ?></span>
			</div>
			<div class="fileds parts_views">
				<label for="parts_views"><?php echo $locale['592']; ?></label>
				<span><?php echo $data['parts_views']; ?></span>
			</div>
			<div class="hr"></div>

		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">

			<?php if ($data['parts_elaveinfo']) { ?>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds parts_elaveinfo">
				<?php echo $data['parts_elaveinfo']; ?>
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
				} // Esli PART Yest
?>