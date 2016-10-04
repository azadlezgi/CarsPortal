<?php	
	if (!defined("IN_FUSION")) { die("Access Denied"); }

	include LOCALE.LOCALESET."infusions/left_shop_panel.php";


				$viewcompanent = viewcompanent("shop", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											shop_name,
											shop_imgocher,
											seourl_url
									FROM ". DB_SHOPS ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=shop_id AND seourl_component=". $seourl_component ."
									WHERE shop_aktiv='1' AND (shop_vip='3'||shop_vip='4')
									ORDER BY RAND()
									LIMIT 0, 6");
				if (dbrows($result)) {
					openside($locale['infusions_lshop_001']);
			?>
	<div class="carbloks lastcars">
		<div class="cars row">
			<?php
					$j=0;
					$j_last=0;
					while ($data = dbarray($result)) { $j++; $j_last++;
						if ($j_last==2) {
							$last_class=" last";
							$j_last=0;
						} else {
							$last_class="";
						}
			?>
			<div class="items item<?php echo $j . ($last_class ? $last_class : ""); ?> col-sm-6">
				<div class="images"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['shop_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['shops_foto_dir'] ."/sm". $data['shop_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
				<div class="marka-model"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['shop_name']; ?></a></div>
			</div>
			<?php } // db whille ?>
			<div class="clear-both"></div>
		</div>
	</div>

			<?php
					closeside();
				} // db query
			?>
