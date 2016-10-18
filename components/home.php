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
					$('#home_last_cars').html('<div class=\"ajax-loader\"><img src=\"". IMAGES ."ajax-loader.GIF\" alt=\"\" /><br /><img src=\"". IMAGES ."ajax-loading.gif\" alt=\"\" /></div>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'10'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-2\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'><span class=\"cena\">'+ item.cars_qiymeti +'</span></a>';
								html += '	<span class=\'cars_ili col-sm-4\' title=\'". $locale['001'] ."\'><i class=\"fa fa-calendar\"></i> '+ item.cars_ili +'</span>';
								html += '	<span class=\'yurush col-sm-8\' title=\'". $locale['002'] ."\'><i class=\"fa fa-history\"></i> '+ item.cars_yurush +' ". $locale['izmerenii_001'] ."</span>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==5) {
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
			<div id="home_last_cars" class="row clearfix"></div>
			<div class="allcars"><a href="/cars/"><?php echo $locale['511']; ?></a></div>
		</div>
	</div>

	<div class="contentbanner">
		<div class="banner banner0">
<?php add_to_footer ("
<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
"); ?>
			<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4406631458345397" data-ad-slot="9074734469" data-ad-format="auto"></ins>
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
					$('#home_random_cars').html('<div class=\"ajax-loader\"><img src=\"". IMAGES ."ajax-loader.GIF\" alt=\"\" /><br /><img src=\"". IMAGES ."ajax-loading.gif\" alt=\"\" /></div>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'10', random:'1'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-2\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'><span class=\"cena\">'+ item.cars_qiymeti +'</span></a>';
								html += '	<span class=\'cars_ili col-sm-4\' title=\'". $locale['001'] ."\'><i class=\"fa fa-calendar\"></i> '+ item.cars_ili +'</span>';
								html += '	<span class=\'yurush col-sm-8\' title=\'". $locale['002'] ."\'><i class=\"fa fa-history\"></i> '+ item.cars_yurush +' ". $locale['izmerenii_001'] ."</span>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==5) {
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
			<div id="home_random_cars" class="row clearfix"></div>
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
					$('#home_vip_cars').html('<div class=\"ajax-loader\"><img src=\"". IMAGES ."ajax-loader.GIF\" alt=\"\" /><br /><img src=\"". IMAGES ."ajax-loading.gif\" alt=\"\" /></div>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'10', where:'(cars_vip=1 || cars_vip=4 || cars_vip=6)'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-2\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'><span class=\"cena\">'+ item.cars_qiymeti +'</span></a>';
								html += '	<span class=\'cars_ili col-sm-4\' title=\'". $locale['001'] ."\'><i class=\"fa fa-calendar\"></i> '+ item.cars_ili +'</span>';
								html += '	<span class=\'yurush col-sm-8\' title=\'". $locale['002'] ."\'><i class=\"fa fa-history\"></i> '+ item.cars_yurush +' ". $locale['izmerenii_001'] ."</span>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==5) {
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
			<div id="home_vip_cars" class="row clearfix"></div>
			<!-- <div class="allcars"><a href="/cars/"><?php echo $locale['511']; ?></a></div> -->
		</div>
	</div>

	<div class="contentbanner">
		<div class="banner banner0">
			<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4406631458345397" data-ad-slot="4306457667" data-ad-format="auto"></ins>
		</div>
		<?php
			// echo showbanners(13, "center");
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
					$('#home_moto_cars').html('<div class=\"ajax-loader\"><img src=\"". IMAGES ."ajax-loader.GIF\" alt=\"\" /><br /><img src=\"". IMAGES ."ajax-loading.gif\" alt=\"\" /></div>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/cars.php',
						dataType: 'json',
						data: {cars:'1', limit:'10', where:'cars_ban=2'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-2\'>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\'>'+ item.marka_name +' '+ item.model_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\'><img src=\''+ item.cars_imgocher +'\' alt=\''+ item.marka_name +' '+ item.model_name +'\'><span class=\"cena\">'+ item.cars_qiymeti +'</span></a>';
								html += '	<span class=\'cars_ili col-sm-4\' title=\'". $locale['001'] ."\'><i class=\"fa fa-calendar\"></i> '+ item.cars_ili +'</span>';
								html += '	<span class=\'yurush col-sm-8\' title=\'". $locale['002'] ."\'><i class=\"fa fa-history\"></i> '+ item.cars_yurush +' ". $locale['izmerenii_001'] ."</span>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==5) {
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
			<div id="home_moto_cars" class="row clearfix"></div>
			<div class="allcars"><a href="/cars/?ban=2"><?php echo $locale['536']; ?></a></div>
		</div>
	</div>

	<div class="contentbanner">
		<div class="banner banner0">
			<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4406631458345397" data-ad-slot="4945586069" data-ad-format="auto"></ins>
		</div>
		<?php
			// echo showbanners(16, "center");
		?>
	</div>


	<div class="salonbloks autosalons">
		<div class="title"><?php echo $locale['540']; ?></div>
		<div class="salon">

			<?php
			add_to_footer ("
			<script type='text/javascript'>
				<!--
				$(document).ready(function(){
					$('#home_autosalons').html('<div class=\"ajax-loader\"><img src=\"". IMAGES ."ajax-loader.GIF\" alt=\"\" /><br /><img src=\"". IMAGES ."ajax-loading.gif\" alt=\"\" /></div>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/salons.php',
						dataType: 'json',
						data: {salons:'1', limit:'15', where:'(salon_vip=1 || salon_vip=4 || salon_vip=6)'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-sm-2\'>';
								html += '	<a class=\'salon_name\' href=\'/'+ item.seourl_url +'\'>'+ item.salon_name +'</a>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\'><img src=\''+ item.salon_imgocher +'\' alt=\''+ item.salon_name +'\'></a>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==5) {
									html += '<div class=\'clear\'></div>';
									say=0;
								}
							});
							$('#home_autosalons').html( html );
						}
					});
				});
				//-->
			</script>
			");
			?>
			<div id="home_autosalons" class="row clearfix"></div>
		</div>
	</div>


	<div class="contentbanner">
		<div class="banner banner0">
			<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4406631458345397" data-ad-slot="1712918063" data-ad-format="auto"></ins>
		</div>
		<?php
			// echo showbanners(17, "center");
		?>
	</div>



<div class="marks_home">
	<?php
		add_to_footer ("<script type='text/javascript'>
		<!--
		function carscount(marka_id=0) {
			$.ajax({
				type: 'POST',
				url: '/". INCLUDES ."Json/cars_count.php',
				dataType: 'json',
				data: {marka_id: marka_id},
				success: function(data){
					if (data>0) {
						// console.log('dada: ', data);
						$('#home_marks .marka'+ marka_id +' .carcount').text( '('+ data +')' );
						$('#home_marks .marka'+ marka_id).removeClass( 'disabled');
					} else {
						$('#home_marks .marka'+ marka_id +' .carcount').text( '(0)' );
						$('#home_marks .marka'+ marka_id).removeAttr( 'href');
					}
				}
			});  
		} // function carscount
		
		$(document).ready(function(){
			$('#home_marks').html('<div class=\"ajax-loader\"><img src=\"". IMAGES ."ajax-loader.GIF\" alt=\"\" /><br /><img src=\"". IMAGES ."ajax-loading.gif\" alt=\"\" /></div>');
			$.ajax({
				type: 'POST',
				url: '/includes/Json/marka.php',
				dataType: 'json',
				data: { marka_submit: 1 },
				success: function(data){
					var html = '';
					$.each(data,function(inx, item) {
					
						setTimeout(carscount(inx), 1000);
						
						html += '<a href=\"/cars/?marka='+ inx +'\" class=\"allmarka marka'+ inx +' col-sm-3 clearfix disabled\"><span class=\"logos\"><img src=\"". IMAGES . $settings['markalogos_dir'] ."/'+ inx +'.gif\" alt=\"'+ item +'\"></span><span class=\"name\">'+ item +'</span><span class=\"carcount\"><img src=\"". IMAGES ."ajax-loading_small.gif\" alt=\"\" class=\"ajax-loader_small\"></span></a>';
					});
					$('#home_marks').html( html );
				}
			});
		});
		//-->
	</script>
	");
	?>
	<div id="home_marks" class="row clearfix"></div>
<?php
/*
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
*/
?>
	<div class="clear"></div>
</div>


	<div class="contentbanner">
		<div class="banner banner0">
			<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4406631458345397" data-ad-slot="5305512867" data-ad-format="auto"></ins>
		</div>
		<?php
			// echo showbanners(18, "center");
		?>
	</div>



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
		<?php add_to_footer ("
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = \"//connect.facebook.net/<?php echo $facemez; ?>/all.js#xfbml=1\";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>"); ?>
		<div class="fb-like-box" data-href="https://www.facebook.com/Autosaleaz" data-width="100%" data-height="556" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div>
	</div>

<?php


	closetable();
?>