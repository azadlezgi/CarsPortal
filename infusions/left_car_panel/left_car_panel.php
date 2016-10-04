<?php	
	if (!defined("IN_FUSION")) { die("Access Denied"); }

	include LOCALE.LOCALESET."infusions/left_car_panel.php";


				$viewcompanent = viewcompanent("car", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											marka_name,
											model_name,
											cars_imgocher,
											cars_qiymeti,
											cars_valyuta,
											seourl_url
									FROM ". DB_CARS ."
									INNER JOIN ". DB_MARKA ." ON ". DB_CARS .".cars_marka=". DB_MARKA .".marka_id
									INNER JOIN ". DB_MODEL ." ON ". DB_CARS .".cars_model=". DB_MODEL .".model_id 
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=cars_id AND seourl_component=". $seourl_component ."
									WHERE cars_aktiv='1' AND (cars_vip='3'||cars_vip='4')
									ORDER BY RAND()
									LIMIT 0, 1");
				if (dbrows($result)) {
					openside($locale['infusions_lcar_001']);
			?>
	<div class="carbloks lastcars">
		<div class="cars row">
			<?php
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-6">
				<div class="marka-model"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?></a></div>
				<div class="images"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($data['cars_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['cars_foto_dir'] ."/sm". $data['cars_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
				<div class="cena"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo viewcena($data['cars_qiymeti'], $data['cars_valyuta']); ?></a></div>
			</div>
			<?
					} // db whille
			?>
		</div>
	</div>

			<?php
					closeside();
				} // db query
			?>
