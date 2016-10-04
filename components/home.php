<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."home.php";

if (!empty($locale['title'])) set_title($locale['title']);
if (!empty($locale['description'])) set_meta("description", $locale['description']);
if (!empty($locale['keywords'])) set_meta("keywords", $locale['keywords']);

	opentable($locale['h1']);
?>



	<div class="carbloks lastcars">
		<div class="title"><?php echo $locale['510']; ?></div>
		<div class="cars">

		<?php
		add_to_footer ("
			<script type='text/javascript'>
				<!--
				$(document).ready(function(){
					$('#home_last_cars').html('<img src=\'". IMAGES ."ajax-loader.GIF\' alt=\'\' class=\'ajax-loader\' /><br /><img src=\'". IMAGES ."ajax-loading.gif\' alt=\'\' class=\'ajax-loading\'>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'8'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-3\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'></a>';
								html += '	<a class=\'cena\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.cars_qiymeti +'</a>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==4) {
									html += '<div class=\'clear\'></div>';
									say=0;
								}
							});
							$('#home_last_cars').html( html );
						}
					});
				});
				//-->
			</script>
			");
			?>
			<div id="home_last_cars" class="row"></div>
			<div class="clear-both"></div>
			<div class="allcars"><a href="/cars/"><?php echo $locale['511']; ?></a></div>
		</div>
	</div>

	<div class="contentbanner">
		<div class="banner banner0">
			<?php if (FUSION_HOST=="cars-az.com") { ?>
				<!-- Yayimla - ad code starts -->
				<span id="show_ads_46aa031ab4e6394b219b201322e64a57_2529"></span>
				<script language="javascript" type="text/javascript" src="http://yayimla.az/net/show-ads.js"></script>
				<script language="javascript">
				if (window.ads_46aa031ab4e6394b219b201322e64a57 ){ ads_46aa031ab4e6394b219b201322e64a57+= 1;}else{ ads_46aa031ab4e6394b219b201322e64a57 =1;}
				ads_46aa031ab4e6394b219b201322e64a57_2529=ads_46aa031ab4e6394b219b201322e64a57;
				timer_46aa031ab4e6394b219b201322e64a572529=window.setInterval(function(){
				if(window.gc4ca4238a0b923820dcc509a6f75849b){
				setTimeout("showAdsforContent(2529,300,250,'http://yayimla.az/net/publisher-show-ads.php',"+ads_46aa031ab4e6394b219b201322e64a57_2529+",'ads_46aa031ab4e6394b219b201322e64a57')",1000*(ads_46aa031ab4e6394b219b201322e64a57_2529 -1));
				window.clearInterval(timer_46aa031ab4e6394b219b201322e64a572529);}},100);
				ads_46aa031ab4e6394b219b201322e64a57_2529_position=0;
				</script>
				<!-- Yayimla - ad code  ends -->

				<!-- Yayimla - ad code starts -->
				<span id="show_ads_46aa031ab4e6394b219b201322e64a57_2530"></span>
				<script language="javascript" type="text/javascript" src="http://yayimla.az/net/show-ads.js"></script>
				<script language="javascript">
				if (window.ads_46aa031ab4e6394b219b201322e64a57 ){ ads_46aa031ab4e6394b219b201322e64a57+= 1;}else{ ads_46aa031ab4e6394b219b201322e64a57 =1;}
				ads_46aa031ab4e6394b219b201322e64a57_2530=ads_46aa031ab4e6394b219b201322e64a57;
				timer_46aa031ab4e6394b219b201322e64a572530=window.setInterval(function(){
				if(window.gc4ca4238a0b923820dcc509a6f75849b){
				setTimeout("showAdsforContent(2530,300,250,'http://yayimla.az/net/publisher-show-ads.php',"+ads_46aa031ab4e6394b219b201322e64a57_2530+",'ads_46aa031ab4e6394b219b201322e64a57')",1000*(ads_46aa031ab4e6394b219b201322e64a57_2530 -1));
				window.clearInterval(timer_46aa031ab4e6394b219b201322e64a572530);}},100);
				ads_46aa031ab4e6394b219b201322e64a57_2530_position=0;
				</script>
				<!-- Yayimla - ad code  ends -->
			<?php } else if (FUSION_HOST=="ru.cars-az.com") { ?>
				<!-- Yayimla - ad code starts -->
				<span id="show_ads_46aa031ab4e6394b219b201322e64a57_2598"></span>
				<script language="javascript" type="text/javascript" src="http://yayimla.az/net/show-ads.js"></script>
				<script language="javascript">
				if (window.ads_46aa031ab4e6394b219b201322e64a57 ){ ads_46aa031ab4e6394b219b201322e64a57+= 1;}else{ ads_46aa031ab4e6394b219b201322e64a57 =1;}
				ads_46aa031ab4e6394b219b201322e64a57_2598=ads_46aa031ab4e6394b219b201322e64a57;
				timer_46aa031ab4e6394b219b201322e64a572598=window.setInterval(function(){
				if(window.gc4ca4238a0b923820dcc509a6f75849b){
				setTimeout("showAdsforContent(2598,300,250,'http://yayimla.az/net/publisher-show-ads.php',"+ads_46aa031ab4e6394b219b201322e64a57_2598+",'ads_46aa031ab4e6394b219b201322e64a57')",1000*(ads_46aa031ab4e6394b219b201322e64a57_2598 -1));
				window.clearInterval(timer_46aa031ab4e6394b219b201322e64a572598);}},100);
				ads_46aa031ab4e6394b219b201322e64a57_2598_position=0;
				</script>
				<!-- Yayimla - ad code  ends -->

				<!-- Yayimla - ad code starts -->
				<span id="show_ads_46aa031ab4e6394b219b201322e64a57_2600"></span>
				<script language="javascript" type="text/javascript" src="http://yayimla.az/net/show-ads.js"></script>
				<script language="javascript">
				if (window.ads_46aa031ab4e6394b219b201322e64a57 ){ ads_46aa031ab4e6394b219b201322e64a57+= 1;}else{ ads_46aa031ab4e6394b219b201322e64a57 =1;}
				ads_46aa031ab4e6394b219b201322e64a57_2600=ads_46aa031ab4e6394b219b201322e64a57;
				timer_46aa031ab4e6394b219b201322e64a572600=window.setInterval(function(){
				if(window.gc4ca4238a0b923820dcc509a6f75849b){
				setTimeout("showAdsforContent(2600,300,250,'http://yayimla.az/net/publisher-show-ads.php',"+ads_46aa031ab4e6394b219b201322e64a57_2600+",'ads_46aa031ab4e6394b219b201322e64a57')",1000*(ads_46aa031ab4e6394b219b201322e64a57_2600 -1));
				window.clearInterval(timer_46aa031ab4e6394b219b201322e64a572600);}},100);
				ads_46aa031ab4e6394b219b201322e64a57_2600_position=0;
				</script>
				<!-- Yayimla - ad code  ends -->
			<?php } else if (FUSION_HOST=="en.cars-az.com") { ?>

			<?php } ?>
		</div>
		<?php // echo showbanners(13, "center"); ?>
	</div>

	<div class="carbloks randomcars">
		<div class="title"><?php echo $locale['520']; ?></div>
		<div class="cars">

		<?php
		add_to_footer ("
			<script type='text/javascript'>
				<!--
				$(document).ready(function(){
					$('#home_random_cars').html('<img src=\'". IMAGES ."ajax-loader.GIF\' alt=\'\' class=\'ajax-loader\' /><br /><img src=\'". IMAGES ."ajax-loading.gif\' alt=\'\' class=\'ajax-loading\'>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'8', random:'1'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-3\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'></a>';
								html += '	<a class=\'cena\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.cars_qiymeti +'</a>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==4) {
									html += '<div class=\'clear\'></div>';
									say=0;
								}
							});
							$('#home_random_cars').html( html );
						}
					});
				});
				//-->
			</script>
			");
			?>
			<div id="home_random_cars" class="row"></div>
			<div class="clear-both"></div>
			<div class="allcars"><a href="/cars/"><?php echo $locale['511']; ?></a></div>
		</div>
	</div>


	<div class="contentbanner">
		<a  style="display:block; padding:1px;" href="http://heyvanbazari.az/" rel="nofollow" target="_blank"><img style="width:100%;" src="<?php echo IMAGES; ?>banners/banner_heyvanbarazi.jpg" alt=""></a>
		<?php
			// echo showbanners(14, "center");
		?>
	</div>


	<div class="carbloks vipcars">
		<div class="title"><?php echo $locale['530']; ?></div>
		<div class="cars">

		<?php
		add_to_footer ("
			<script type='text/javascript'>
				<!--
				$(document).ready(function(){
					$('#home_vip_cars').html('<img src=\'". IMAGES ."ajax-loader.GIF\' alt=\'\' class=\'ajax-loader\' /><br /><img src=\'". IMAGES ."ajax-loading.gif\' alt=\'\' class=\'ajax-loading\'>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'8', where:'(cars_vip=1 || cars_vip=4 || cars_vip=6)'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-3\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'></a>';
								html += '	<a class=\'cena\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.cars_qiymeti +'</a>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==4) {
									html += '<div class=\'clear\'></div>';
									say=0;
								}
							});
							$('#home_vip_cars').html( html );
						}
					});
				});
				//-->
			</script>
			");
			?>
			<div id="home_vip_cars" class="row"></div>
			<div class="clear-both"></div>
			<!-- <div class="allcars"><a href="/cars/"><?php echo $locale['511']; ?></a></div> -->
		</div>
	</div>

	<div class="contentbanner">
		<?php
			echo showbanners(13, "center");
			// echo showbanners(15, "center");
		?>
	</div>

	<div class="carbloks motocars">
		<div class="title"><?php echo $locale['535']; ?></div>
		<div class="cars">

		<?php
		add_to_footer ("
			<script type='text/javascript'>
				<!--
				$(document).ready(function(){
					$('#home_moto_cars').html('<img src=\'". IMAGES ."ajax-loader.GIF\' alt=\'\' class=\'ajax-loader\' /><br /><img src=\'". IMAGES ."ajax-loading.gif\' alt=\'\' class=\'ajax-loading\'>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'8', where:'cars_ban=2'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-3\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'></a>';
								html += '	<a class=\'cena\' href=\'/'+ item.seourl_url +'\' target=\'_blank\'>'+ item.cars_qiymeti +'</a>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==4) {
									html += '<div class=\'clear\'></div>';
									say=0;
								}
							});
							$('#home_moto_cars').html( html );
						}
					});
				});
				//-->
			</script>
			");
			?>
			<div id="home_moto_cars" class="row"></div>
			<div class="clear-both"></div>
			<div class="allcars"><a href="/cars/?ban=2"><?php echo $locale['536']; ?></a></div>
		</div>
	</div>

	<div class="contentbanner">
		<?php
			echo showbanners(16, "center");
		?>
	</div>


	<div class="salonbloks autosalons">
		<div class="title"><?php echo $locale['540']; ?></div>
		<div class="salon row">
			<?php
				$viewcompanent = viewcompanent("salon", "name");
				$seourl_component = $viewcompanent['components_id'];

				$salon_result = dbquery("SELECT
											salon_name,
											salon_imgocher,
											seourl_url
									FROM ". DB_SALONS ."
									LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=salon_id AND seourl_component=". $seourl_component ."
									WHERE (salon_aktiv='1' || salon_aktiv='4') AND (salon_vip='1'||salon_vip='4'||salon_vip='6')
									ORDER BY RAND()
									LIMIT 0, 10");
				if (dbrows($salon_result)) {
					$salon_j=0;
					while ($salon_data = dbarray($salon_result)) { $salon_j++;
			?>
			<div class="items item<?php echo $salon_j; ?> col-sm-2">
				<a class="salon_name" href="/<?php echo $salon_data['seourl_url']; ?>" target="_blank"><?php echo $salon_data['salon_name']; ?></a>
				<a class="images" href="/<?php echo  $salon_data['seourl_url']; ?>" target="_blank"><img src="<?php echo (empty($salon_data['salon_imgocher']) ? IMAGES ."imagenotfound.jpg" : IMAGES . $settings['salons_foto_dir'] ."/sm". $salon_data['salon_imgocher']); ?>" alt="<?php echo $salon_data['salon_name']; ?>"></a>
			</div>
			<?php
					} // db whille
				} else {
					echo $locale['501'];
				} // db query
			?>
			<div class="clear"></div>
		</div>
	</div>


	<div class="contentbanner">
		<?php
			echo showbanners(17, "center");
		?>
	</div>



<div class="marks_home row">
<?php
	$marka_result = dbquery("SELECT
												marka_id,
												marka_name
							FROM ". DB_MARKA ."");
										// ORDER BY `marka_name` ASC
	if (dbrows($marka_result)) {
		$marka_j = 0;
		while ($marka_data = dbarray($marka_result)) { $marka_j++;

			add_to_footer ("
			<script type='text/javascript'>
				<!--
				$(document).ready(function(){
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars_count.php',
						dataType: 'json',
						data: {marka_id:'". $marka_data['marka_id'] ."'},
						success: function(data){
							var html = '';
							if (data>0) {
								html += '<div class=\'logos\'><a href=\'/model.php?marka=".  $marka_data['marka_id'] ."\'><img src=\'". (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['markalogos_dir'] ."/". $marka_data['marka_id'] .".gif") ? "". IMAGES . $settings['markalogos_dir'] ."/". $marka_data['marka_id'] .".gif" : IMAGES ."imagenotfound.jpg") ."\' alt=\'". $marka_data['marka_name'] ."\'></a></div>';
								html += '<div class=\'name\'><a href=\'/model.php?marka=".  $marka_data['marka_id'] ."\'>". $marka_data['marka_name'] ."</a></div>';
								html += '<div class=\'carcount\'><a href=\'/model.php?marka=".  $marka_data['marka_id'] ."\'>('+ data +')</a></div>';
							} else {
								html += '<div class=\'logos\'><img src=\'". (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['markalogos_dir'] ."/". $marka_data['marka_id'] .".gif") ? "". IMAGES . $settings['markalogos_dir'] ."/". $marka_data['marka_id'] .".gif" : IMAGES ."imagenotfound.jpg") ."\' alt=\'". $marka_data['marka_name'] ."\'></div>';
								html += '<div class=\'name\'>". $marka_data['marka_name'] ."</div>';
								html += '<div class=\'carcount\'>('+ data +')</div>';
							}
							html += '<div class=\'clear\'></div>';

							$('.marks_home .marka". $marka_j ."').html( html );
						}
					});
				});
				//-->
			</script>
			");

			echo "<div class='allmarka marka". $marka_j ." col-sm-3'>\n";
			echo "<div class='logos'><img src='". (file_exists($_SERVER['DOCUMENT_ROOT'] . IMAGES . $settings['markalogos_dir'] ."/". $marka_data['marka_id'] .".gif") ? "". IMAGES . $settings['markalogos_dir'] ."/". $marka_data['marka_id'] .".gif" : "". IMAGES ."imagenotfound.jpg") ."' alt='". $marka_data['marka_name'] ."'></div>\n";
			echo "<div class='name'>". $marka_data['marka_name'] ."</div>\n";
			echo "<div class='carcount'>(<img src='". IMAGES ."ajax-loading_small.gif' alt='' class='ajax-loader_small' />)</div>\n";
			echo "<div class='clear'></div>\n";
			echo "</div>\n";

		} // db whille
	} else {
		echo $locale['501'];
	} // db query
?>
	<div class="clear"></div>
</div>


	<div class="contentbanner">
		<?php
			echo showbanners(18, "center");
		?>
	</div>


<?/*
	<div class="facebook-block">
		<?php
			// Facebook block
			if (LOCALESHORT=="az") {
				$facemez="az_AZ";
			} elseif (LOCALESHORT=="ru") {
				$facemez="ru_RU";
			} elseif (LOCALESHORT=="en") {
				$facemez="en_US";
			} 
		?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/<?php echo $facemez; ?>/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like-box" data-href="https://www.facebook.com/Autosaleaz" data-width="605" data-height="556" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div>					
	</div>

<?php
*/

	closetable();
?>