<?php	
	if (!defined("IN_FUSION")) { die("Access Denied"); }

	include LOCALE.LOCALESET."infusions/left_rentalcar_panel.php";


				$viewcompanent = viewcompanent("rentalcar", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											marka_name,
											model_name,
											rentalcar_imgocher,
											rentalcar_qiymeti,
											rentalcar_valyuta,
											seourl_url
									FROM ". DB_RENTALCARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_RENTALCARS .".rentalcar_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_RENTALCARS .".rentalcar_model=". DB_MODEL .".model_id 
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=rentalcar_id AND seourl_component=". $seourl_component ."
									WHERE rentalcar_aktiv='1' AND (rentalcar_vip='3'||rentalcar_vip='4')
									ORDER BY RAND()
									LIMIT 0, 6");
				if (dbrows($result)) {
					openside($locale['infusions_lrentalcar_001']);
			?>
	<div class="carbloks lastrentalcars">
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
				<div class="marka-model"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?></a></div>
				<div class="images"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['rentalcar_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['rentalcars_foto_dir'] ."/sm". $data['rentalcar_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
				<div class="cena"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo viewcena($data['rentalcar_qiymeti'], $data['rentalcar_valyuta']); ?></a></div>
			</div>
			<?php } // db whille ?>
			<div class="clear-both"></div>
		</div>
	</div>

			<?php
					closeside();
				} // db query
			?>
