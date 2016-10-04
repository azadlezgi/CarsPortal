<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }


				$result = dbquery("SELECT
												marka_name,
												model_name,
												buyacars_id,
												buyacars_marka,
												buyacars_model,
												buyacars_iliot,
												buyacars_ilido,
												buyacars_yurushot,
												buyacars_yurushdo,
												buyacars_kuzareng,
												buyacars_kuzarengmet,
												buyacars_ban,
												buyacars_kuza,
												buyacars_qiymetiot,
												buyacars_qiymetido,
												buyacars_valyuta,
												buyacars_adi,
												buyacars_mobiltel,
												buyacars_tel,
												buyacars_email,
												buyacars_elaveinfo,
												buyacars_ip,
												buyacars_today,
												buyacars_views,
												buyacars_aktiv,
												buyacars_vip
									FROM ". DB_BUYACARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_BUYACARS .".buyacars_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_BUYACARS .".buyacars_model=". DB_MODEL .".model_id 
									WHERE (buyacars_aktiv='1' || buyacars_aktiv='4')
									AND buyacars_id='". $filedid ."'");

				if (dbrows($result)) {

					include LOCALE.LOCALESET."buyacar.php";
					$data = dbarray($result);

					### UPDATE BUYACARS VIEWS BEGIN
					$buyacars_views = $data['buyacars_views']+1;
					$resultviews = dbquery(
						"UPDATE ". DB_BUYACARS ." SET
														buyacars_views='". $buyacars_views ."'
						WHERE buyacars_id='". $data['buyacars_id'] ."'"
					);
					### UPDATE BUYACARS VIEWS END

					if (!empty($data['buyacars_id'])) set_title($locale['title'] ." ". $data['marka_name'] ." ". $data['model_name'] ." - ". $settings['sitename']);
					if (!empty($data['buyacars_id'])) set_meta("description", $locale['title'] ." ". $data['marka_name'] ." ". $data['model_name'] ." ". $locale['520'] ." ". $data['buyacars_iliot'] ." - ". $data['buyacars_ilido'] ." ". $locale['521'] ." ". $data['buyacars_yurushot'] ." - ". $data['buyacars_yurushdo']);
					if (!empty($data['buyacars_id'])) set_meta("keywords", "");

					echo "<div class='breadcrumb'>\n";
					echo "	<ul>\n";
					echo "		<li><a href='". BASEDIR ."'>". $locale['640'] ."</a></li>\n";
					echo "		<li><a href='". BASEDIR ."buyacars.php'>". $locale['641'] ."</a></li>\n";
					echo "		<li><span>". $data['marka_name'] ." ". $data['model_name'] ."</span></li>\n";
					echo "	</ul>\n";
					echo "</div>\n";

					opentable($data['marka_name'] ." ". $data['model_name']);
?>

	<div class="addcar"><a href="<?php echo BASEDIR; ?>addbuyacars.php"><?php echo $locale['600']; ?></a></div>
<?php
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
?>
	<div class="editcar"><a href="<?php echo ADMIN ."buyacars.php".  $aidlink ."&action=edit&id=". $data['buyacars_id']; ?>" target="_blank"><?php echo $locale['601']; ?></a></div>
<?php
	}
?>
	<div class="buyacarinfo">
		<div class="bloks blok1">
			<div class="blok_name"><?php echo $locale['502']; ?></div>
			<div class="fileds buyacars_marka">
				<label for="buyacars_marka"><?php echo $locale['510']; ?></label>
				<span><?php echo $data['marka_name']; ?></span>
			</div>
			<div class="fileds buyacars_model">
				<label for="buyacars_model"><?php echo $locale['510']; ?></label>
				<span><?php echo $data['model_name']; ?></span>
			</div>
			<div class="fileds buyacars_ili">
				<label for="buyacars_iliot"><?php echo $locale['520']; ?></label>
				<span><?php echo $data['buyacars_iliot']; ?> - <?php echo $data['buyacars_ilido']; ?></span>
			</div>
			<div class="fileds buyacars_yurush">
				<label for="buyacars_yurushot"><?php echo $locale['521']; ?></label>
				<span><?php echo $data['buyacars_yurushot']; ?> - <?php echo $data['buyacars_yurushdo']; ?></span>
			</div>
			<div class="fileds buyacars_kuzareng">
				<label for="buyacars_kuzareng"><?php echo $locale['530']; ?></label>
				<span><?php echo $locale['kuzareng_'. $data['buyacars_kuzareng']]; ?> <?php if ($data['cars_kuzarengmet']) { echo "<sup>". $locale['541'] ."</sup>"; } ?></span>
			</div>
			<div class="fileds buyacars_ban">
				<label for="buyacars_ban"><?php echo $locale['532']; ?></label>
				<span><?php echo $locale['ban_'. $data['buyacars_ban']]; ?></span>
			</div>
			<div class="fileds buyacars_kuza">
				<label for="buyacars_kuza"><?php echo $locale['533']; ?></label>
				<span><?php echo $locale['kuza_'. $data['buyacars_kuza']]; ?></span>
			</div>
			<div class="hr"></div>
		</div>
		<div class="bloks blok2">
			<div class="blok_name"><?php echo $locale['503']; ?></div>
			<div class="fileds buyacars_qiymeti">
				<label for="buyacars_qiymetiot"><?php echo $locale['540']; ?></label>
				<span><?php echo viewcena($data['buyacars_qiymetiot'], $data['buyacars_valyuta']); ?> - <?php echo viewcena($data['buyacars_qiymetido'], $data['buyacars_valyuta']); ?></span>
			</div>

			<?php if ($data['buyacars_aktiv']==1) { ?>
			<div class="fileds buyacars_adi">
				<label for="buyacars_adi"><?php echo $locale['541']; ?></label>
				<span><?php echo $data['buyacars_adi']; ?></span>
			</div>

			<div class="fileds buyacars_mobiltel">
				<label for="buyacars_mobiltel"><?php echo $locale['542']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['buyacars_mobiltel']); ?>" alt="" />
			</div>
			<?php if ($data['buyacars_tel']) { ?>
			<div class="fileds buyacars_tel">
				<label for="buyacars_tel"><?php echo $locale['543']; ?></label>
				<img src="<?php echo INCLUDES ."imgphone.php?text=". str_replace("+", "*", $data['buyacars_tel']); ?>" alt="" />
			</div>
			<?php } ?>
			<small style="color:#16BB2F;"><?php echo $locale['global_910']; ?></small>
			<?php if ($data['buyacars_email']) { ?>
			<div class="fileds buyacars_email">
				<label for="buyacars_email"><?php echo $locale['544']; ?></label>
				<span><?php echo $data['buyacars_email']; ?></span>
			</div>
			<?php } ?>
			<?php } else { ?>
			<div class="fileds satilib">
				<p><?php echo $locale['satilib_001']; ?></p>
			</div>
			<?php } ?>
			<div class="hr"></div>

			<div class="fileds buyacars_today">
				<label for="buyacars_today"><?php echo $locale['590']; ?></label>
				<span><?php echo date("d.m.Y", $data['buyacars_today']); ?></span>
			</div>
			<div class="fileds buyacars_id">
				<label for="buyacars_id"><?php echo $locale['591']; ?></label>
				<span><?php echo $data['buyacars_id']; ?></span>
			</div>
			<div class="fileds buyacars_views">
				<label for="buyacars_views"><?php echo $locale['592']; ?></label>
				<span><?php echo $data['buyacars_views']; ?></span>
			</div>
			<div class="hr"></div>

		</div>
		<div class="clear-both"></div>
		<div class="bloks blok3">

			<?php if ($data['buyacars_elaveinfo']) { ?>
			<div class="blok_name"><?php echo $locale['504']; ?></div>
			<div class="fileds buyacars_elaveinfo">
				<?php echo $data['buyacars_elaveinfo']; ?>
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