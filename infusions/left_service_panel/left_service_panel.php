<?php	
	if (!defined("IN_FUSION")) { die("Access Denied"); }

	include LOCALE.LOCALESET."infusions/left_service_panel.php";


				$viewcompanent = viewcompanent("service", "name");
				$seourl_component = $viewcompanent['components_id'];

				$result = dbquery("SELECT
											service_name,
											service_imgocher,
											seourl_url
									FROM ". DB_SERVICES ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=service_id AND seourl_component=". $seourl_component ."
									WHERE service_aktiv='1' AND (service_vip='3'||service_vip='4')
									ORDER BY RAND()
									LIMIT 0, 1");
				if (dbrows($result)) {
					openside($locale['infusions_lservice_001']);
			?>
	<div class="carbloks lastcars">
		<div class="cars row">
			<?php
					$j=0;
					while ($data = dbarray($result)) { $j++;
			?>
			<div class="items item<?php echo $j; ?> col-sm-6">
				<div class="marka-model"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><?php echo $data['service_name']; ?></a></div>
				<div class="images"><a href="/<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank"><img src="/<?php echo (empty($data['service_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['services_foto_dir'] ."/sm". $data['service_imgocher']); ?>" alt="<?php echo $data['marka_name']; ?> <?php echo $data['model_name']; ?>"></a></div>
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
