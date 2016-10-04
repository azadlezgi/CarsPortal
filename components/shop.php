<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

				$result = dbquery("SELECT
												shop_id,
												shop_name,
												shop_qorod,
												shop_adress,
												shop_mobiltel,
												shop_tel,
												shop_email,
												shop_site,
												shop_images1,
												shop_images2,
												shop_images3,
												shop_imgocher,
												shop_elaveinfo,
												shop_today,
												shop_aktiv,
												shop_views
									FROM ". DB_SHOPS ."
									WHERE (shop_aktiv='1' || shop_aktiv='4')
									AND shop_id='". $filedid ."'");

				if (dbrows($result)) {

					include LOCALE.LOCALESET."shop.php";
					$data = dbarray($result);

					### UPDATE SHOPS VIEWS BEGIN
					$shop_views = $data['shop_views']+1;
					$resultviews = dbquery(
						"UPDATE ". DB_SHOPS ." SET
														shop_views='". $shop_views ."'
						WHERE shop_id='". $data['shop_id'] ."'"
					);
					### UPDATE SHOPS VIEWS END


					if (!empty($data['shop_id'])) set_title($locale['title'] ." ". $data['shop_name'] ." - ". $settings['sitename']);
					$shop_elaveinfo = strip_tags($data['shop_elaveinfo']);
					if (!empty($data['shop_id'])) set_meta("description", ($shop_elaveinfo ? $shop_elaveinfo : $locale['511'] ." ". $locale['qorod_'. $data['shop_qorod']] ." ". $locale['512'] ." ". $data['shop_adress']) );
					if (!empty($data['shop_id'])) set_meta("keywords", "");

					echo "<div class='breadcrumb'>\n";
					echo "	<ul>\n";
					echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
					echo "		<li><a href='". BASEDIR ."shops.php'>". $locale['641'] ."</a></li>\n";
					echo "		<li><span>". $data['shop_name'] ."</span></li>\n";
					echo "	</ul>\n";
					echo "</div>\n";

					opentable($data['shop_name']);
?>

	<div class="addcar"><a href="<?php echo BASEDIR; ?>addshops.php"><?php echo $locale['600']; ?></a></div>
<?php
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
?>
	<div class="editcar"><a href="<?php echo ADMIN ."shops.php".  $aidlink ."&action=edit&id=". $data['shop_id']; ?>" target="_blank"><?php echo $locale['601']; ?></a></div>
<?php
	}
?>
	<div class="shopinfo">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds shop_name">
				<label for="shop_name"><?php echo $locale['510']; ?></label>
				<span><?php echo $data['shop_name']; ?></span>
			</div>
			<div class="fileds shop_qorod">
				<label for="shop_qorod"><?php echo $locale['511']; ?></label>
				<span><?php echo $locale['qorod_'. $data['shop_qorod']]; ?></span>
			</div>
			<div class="fileds shop_adress">
				<label for="shop_adress"><?php echo $locale['512']; ?></label>
				<span><?php echo $data['shop_adress']; ?></span>
			</div>
			<?php if ($data['shop_aktiv']==1) { ?>
			<div class="fileds shop_mobiltel">
				<label for="shop_mobiltel"><?php echo $locale['513']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['shop_mobiltel']); ?>" alt="" />
			</div>
			<?php if ($data['shop_tel']) { ?>
			<div class="fileds shop_tel">
				<label for="shop_tel"><?php echo $locale['514']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['shop_tel']); ?>" alt="" />
			</div>
			<?php } ?>
			<small style="color:#16BB2F;"><?php echo $locale['global_910']; ?></small>
			<?php if ($data['shop_email']) { ?>
			<div class="fileds shop_email">
				<label for="shop_email"><?php echo $locale['515']; ?></label>
				<span><?php echo $data['shop_email']; ?></span>
			</div>
			<?php } ?>
			<?php if ($data['shop_site']) { ?>
			<div class="fileds shop_site">
				<label for="shop_site"><?php echo $locale['517']; ?></label>
				<span><?php echo $data['shop_site']; ?></span>
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
			<div class="fileds shop_images">
				<div class="big-img">
					<a rel="lightbox[plants]" href="<?php echo (empty($data['shop_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_imgocher']); ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"><img name="bigimg" src="<?php echo (empty($data['shop_imgocher']) ? IMAGES ."imagenotfound.jpg" : INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a>
				</div>
				<div class="small-img">
					<div class="flexslider">
						<ul class="slides">
							<?php if ($data['shop_images1']) { ?><li><img class="img1" src="<?php echo IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images1']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_images1']; ?>';"></li><?php } ?>
							<?php if ($data['shop_images2']) { ?><li><img class="img2" src="<?php echo IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images2']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_images2']; ?>';"></li><?php } ?>
							<?php if ($data['shop_images3']) { ?><li><img class="img3" src="<?php echo IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_images3']; ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>" onclick="bigimg.src='<?php echo INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_images3']; ?>';"></li><?php } ?>
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
					<?php if ($data['shop_images2']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_images2']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['shop_images3']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_images3']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
					<?php if ($data['shop_images4']) { ?><a rel="lightbox[plants]" href="<?php echo INCLUDES ."foto.php?folder=". $settings['shops_foto_dir'] ."&file=". $data['shop_images4']; ?>" title="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a><?php } ?>
				</div>
			</div>
			<div class="hr"></div>

			<div class="fileds shop_today">
				<label for="shop_today"><?php echo $locale['590']; ?></label>
				<span><?php echo date("d.m.Y", $data['shop_today']); ?></span>
			</div>
			<div class="fileds shop_id">
				<label for="shop_id"><?php echo $locale['591']; ?></label>
				<span><?php echo $data['shop_id']; ?></span>
			</div>
			<div class="fileds shop_views">
				<label for="shop_views"><?php echo $locale['592']; ?></label>
				<span><?php echo $data['shop_views']; ?></span>
			</div>
			<div class="hr"></div>

		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">

			<?php if ($data['shop_elaveinfo']) { ?>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds shop_elaveinfo">
				<?php echo $data['shop_elaveinfo']; ?>
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

				$filterdb .= " AND parts_shop_id='". $data['shop_id'] ."'";
	

				if (isset($_GET['page'])) {
					$pagesay = $_GET['page'];
				} else {
					$pagesay = 1;
				}
				$rowstart = $settings['goruser']*($pagesay-1);

				$viewcompanent = viewcompanent("part", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											parts_name,
											parts_imgocher,
											parts_qiymeti,
											parts_valyuta,
											seourl_url
									FROM ". DB_PARTS ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=parts_id AND seourl_component=". $seourl_component ."
									WHERE (parts_aktiv='1' || parts_aktiv='4')". $filterdb ."
									ORDER BY `parts_id` DESC
									LIMIT ". $rowstart .", ". $settings['goruser'] ."");

				if (dbrows($result)) {
			?>
	<div class="partbloks allparts">
		<div class="parts">
			<?php
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?>">
				<div class="name"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['parts_name']; ?></a></div>
				<div class="images"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['parts_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['parts_foto_dir'] ."/sm". $data['parts_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
				<div class="cena"><a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo viewcena($data['parts_qiymeti'], $data['parts_valyuta']); ?></a></div>
			</div>
			<?
						if ($j==5) { $j=0; }
					} // db whille
			?>
			<div class="clear-both"></div>
		</div>
	</div>
			<?php
					echo navigation($_GET['page'], $settings['goruser'], "parts_id", DB_PARTS, "parts_aktiv='1'". $filterdb ."");

				} // db query
			?>




	<div class="obyazatelno"><?php echo $locale['610']; ?></div>

<?php
					closetable();
	
				} else { 
					include COMPONENTS."404.php";
				} // Esli shop Yest
?>