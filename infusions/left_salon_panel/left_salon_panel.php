<?php
if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."infusions/left_salon_panel.php";

openside($locale['infusions_lsalon_001']);
?>
	<div class="carbloks lastcars">
		<div class="cars">
			<?php
			add_to_footer ("
			<script type='text/javascript'>
				<!--
				$(document).ready(function(){
					$('#left_salon_panel').html('<div class=\"ajax-loader\"><img src=\"". IMAGES ."ajax-loader.GIF\" alt=\"\" /><br /><img src=\"". IMAGES ."ajax-loading.gif\" alt=\"\" /></div>');
					$.ajax({
						type: 'POST',
						url: '/". INCLUDES ."Json/salons.php',
						dataType: 'json',
						data: {salons:'1', limit:'6', where:'(salon_aktiv=1 || salon_aktiv=4)'},
						success: function(data){
							var html = '';
							var say = 0;
							$.each(data,function(inx, item) { say++;
								html += '<div class=\'items item'+ say +' col-xs-6\'>';
								html += '	<a class=\'images\' href=\'/'+ item.seourl_url +'\'><img src=\''+ item.salon_imgocher +'\' alt=\''+ item.salon_name +'\'></a>';
								html += '	<a class=\'marka-model\' href=\'/'+ item.seourl_url +'\'>'+ item.salon_name +'</a>';
								html += '</div>';
								// console.log(item.marka_name +' - '+ item.model_name);

								if (say==2) {
									html += '<div class=\'clear\'></div>';
									say=0;
								}
							});
							$('#left_salon_panel').html( html );
						}
					});
				});
				//-->
			</script>
			");
			?>
			<div id="left_salon_panel" class="row clearfix"></div>
		</div>
	</div>
<?php closeside(); ?>