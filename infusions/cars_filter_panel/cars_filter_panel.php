<?php	
	if (!defined("IN_FUSION")) { die("Access Denied"); }

	include LOCALE.LOCALESET."infusions/cars_filter_panel.php";
?>

<form method="GET" name="filter" id="filter" action="/cars/">
	<div class="carsfilter">
		<div class="fileds filter_marka col-sm-3">
			<label for="filter_marka"><?php echo $locale['infusions_cfp_010']; ?></label>
			<select class="select" name="marka" id="filter_marka" onchange="dynamicSelect('filter_marka', 'filter_model');">
				<option value=""<?php echo ((INT)$_GET['marka']=="" ? " selected" : ""); ?>><?php echo $locale['infusions_cfp_001']; ?></option>
	<?php
		$filter_result = dbquery("SELECT
									marka_id,
									marka_name
							FROM ". DB_MARKA ."
							ORDER BY `marka_name`");
		if (dbrows($filter_result)) {
			while ($filter_data = dbarray($filter_result)) {
	?>
				<option value="<?php echo $filter_data['marka_id']; ?>"<?php echo ((INT)$_GET['marka']==$filter_data['marka_id'] ? " selected" : ""); ?>><?php echo $filter_data['marka_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
			</select>
		</div>
		<div class="fileds filter_model col-sm-3">
			<label for="filter_model"><?php echo $locale['infusions_cfp_011']; ?></label>
			<select class="select" name="model" id="filter_model">
				<option value=""<?php echo ((INT)$_GET['model']=="" ? " selected" : ""); ?>><?php echo $locale['infusions_cfp_001']; ?></option>
	<?php
		$filter_result = dbquery("SELECT
									model_id,
									model_name,
									model_marka_id
							FROM ". DB_MODEL ."
							ORDER BY `model_name`");
		if (dbrows($filter_result)) {
			while ($filter_data = dbarray($filter_result)) {
	?>
				<option class="<?php echo $filter_data['model_marka_id']; ?>" value="<?php echo $filter_data['model_id']; ?>"<?php echo ((INT)$_GET['model']==$filter_data['model_id'] ? " selected" : ""); ?>><?php echo $filter_data['model_name']; ?></option>
	<?php
			} // db whille
		} // db query
	?>
			</select>
		</div>
		<div class="fileds filter_ban col-sm-3">
			<label for="filter_ban"><?php echo $locale['infusions_cfp_012']; ?></label>
			<select class="select" name="ban" id="filter_ban" onchange="dynamicSelect('filter_ban','filter_kuza');">
				<option value=""<?php echo ((INT)$_GET['ban']=="" ? " selected" : ""); ?>><?php echo $locale['infusions_cfp_001']; ?></option>
				<option value="1"<?php echo ((INT)$_GET['ban']==1 ? " selected" : ""); ?>><?php echo $locale['ban_1']; ?></option>
				<option value="2"<?php echo ((INT)$_GET['ban']==2 ? " selected" : ""); ?>><?php echo $locale['ban_2']; ?></option>
				<!--<option value="3"<?php echo ((INT)$_GET['ban']==3 ? " selected" : ""); ?>><?php echo $locale['ban_3']; ?></option>-->
				<option value="4"<?php echo ((INT)$_GET['ban']==4 ? " selected" : ""); ?>><?php echo $locale['ban_4']; ?></option>
				<!--<option value="5"<?php echo ((INT)$_GET['ban']==5 ? " selected" : ""); ?>><?php echo $locale['ban_5']; ?></option>-->
				<option value="6"<?php echo ((INT)$_GET['ban']==6 ? " selected" : ""); ?>><?php echo $locale['ban_6']; ?></option>
				<option value="7"<?php echo ((INT)$_GET['ban']==7 ? " selected" : ""); ?>><?php echo $locale['ban_7']; ?></option>
				<!--<option value="8"<?php echo ((INT)$_GET['ban']==8 ? " selected" : ""); ?>><?php echo $locale['ban_8']; ?></option>-->
				<!--<option value="9"<?php echo ((INT)$_GET['ban']==9 ? " selected" : ""); ?>><?php echo $locale['ban_9']; ?></option>-->
			</select>
		</div>
		<div class="fileds filter_kuza col-sm-3">
			<label for="filter_kuza"><?php echo $locale['infusions_cfp_013']; ?></label>
			<select class="select" name="kuza" id="filter_kuza">
				<option value=""<?php echo ((INT)$_GET['kuza']=="" ? " selected" : ""); ?>><?php echo $locale['infusions_cfp_001']; ?></option>
				<option class='1' value='1'<?php echo ((INT)$_GET['kuza']==1 ? " selected" : ""); ?>><?php echo $locale['kuza_1']; ?></option>
				<option class='1' value='2'<?php echo ((INT)$_GET['kuza']==2 ? " selected" : ""); ?>><?php echo $locale['kuza_2']; ?></option>
				<option class='1' value='3'<?php echo ((INT)$_GET['kuza']==3 ? " selected" : ""); ?>><?php echo $locale['kuza_3']; ?></option>
				<option class='1' value='4'<?php echo ((INT)$_GET['kuza']==4 ? " selected" : ""); ?>><?php echo $locale['kuza_4']; ?></option>
				<option class='1' value='5'<?php echo ((INT)$_GET['kuza']==5 ? " selected" : ""); ?>><?php echo $locale['kuza_5']; ?></option>
				<option class='1' value='6'<?php echo ((INT)$_GET['kuza']==6 ? " selected" : ""); ?>><?php echo $locale['kuza_6']; ?></option>
				<option class='1' value='7'<?php echo ((INT)$_GET['kuza']==7 ? " selected" : ""); ?>><?php echo $locale['kuza_7']; ?></option>
				<option class='1' value='8'<?php echo ((INT)$_GET['kuza']==8 ? " selected" : ""); ?>><?php echo $locale['kuza_8']; ?></option>
				<option class='1' value='9'<?php echo ((INT)$_GET['kuza']==9 ? " selected" : ""); ?>><?php echo $locale['kuza_9']; ?></option>
				<option class='2' value='10'<?php echo ((INT)$_GET['kuza']==10 ? " selected" : ""); ?>><?php echo $locale['kuza_10']; ?></option>
				<option class='2' value='12'<?php echo ((INT)$_GET['kuza']==12 ? " selected" : ""); ?>><?php echo $locale['kuza_12']; ?></option>
				<option class='2' value='13'<?php echo ((INT)$_GET['kuza']==13 ? " selected" : ""); ?>><?php echo $locale['kuza_13']; ?></option>
				<option class='2' value='15'<?php echo ((INT)$_GET['kuza']==15 ? " selected" : ""); ?>><?php echo $locale['kuza_15']; ?></option>
				<option class='2' value='18'<?php echo ((INT)$_GET['kuza']==18 ? " selected" : ""); ?>><?php echo $locale['kuza_18']; ?></option>
				<option class='2' value='26'<?php echo ((INT)$_GET['kuza']==26 ? " selected" : ""); ?>><?php echo $locale['kuza_26']; ?></option>
				<option class='2' value='30'<?php echo ((INT)$_GET['kuza']==30 ? " selected" : ""); ?>><?php echo $locale['kuza_30']; ?></option>
				<option class='2' value='38'<?php echo ((INT)$_GET['kuza']==38 ? " selected" : ""); ?>><?php echo $locale['kuza_38']; ?></option>
				<option class='2' value='41'<?php echo ((INT)$_GET['kuza']==41 ? " selected" : ""); ?>><?php echo $locale['kuza_41']; ?></option>
				<option class='4' value='51'<?php echo ((INT)$_GET['kuza']==51 ? " selected" : ""); ?>><?php echo $locale['kuza_51']; ?></option>
				<option class='4' value='63'<?php echo ((INT)$_GET['kuza']==63 ? " selected" : ""); ?>><?php echo $locale['kuza_63']; ?></option>
				<option class='4' value='65'<?php echo ((INT)$_GET['kuza']==65 ? " selected" : ""); ?>><?php echo $locale['kuza_65']; ?></option>
				<option class='4' value='107'<?php echo ((INT)$_GET['kuza']==107 ? " selected" : ""); ?>><?php echo $locale['kuza_107']; ?></option>
				<option class='6' value='112'<?php echo ((INT)$_GET['kuza']==112 ? " selected" : ""); ?>><?php echo $locale['kuza_112']; ?></option>
				<option class='6' value='113'<?php echo ((INT)$_GET['kuza']==113 ? " selected" : ""); ?>><?php echo $locale['kuza_113']; ?></option>
				<option class='6' value='114'<?php echo ((INT)$_GET['kuza']==114 ? " selected" : ""); ?>><?php echo $locale['kuza_114']; ?></option>
				<option class='6' value='115'<?php echo ((INT)$_GET['kuza']==115 ? " selected" : ""); ?>><?php echo $locale['kuza_115']; ?></option>
				<option class='6' value='116'<?php echo ((INT)$_GET['kuza']==116 ? " selected" : ""); ?>><?php echo $locale['kuza_116']; ?></option>
				<option class='7' value='117'<?php echo ((INT)$_GET['kuza']==117 ? " selected" : ""); ?>><?php echo $locale['kuza_117']; ?></option>
				<option class='7' value='122'<?php echo ((INT)$_GET['kuza']==122 ? " selected" : ""); ?>><?php echo $locale['kuza_122']; ?></option>
				<option class='7' value='124'<?php echo ((INT)$_GET['kuza']==124 ? " selected" : ""); ?>><?php echo $locale['kuza_124']; ?></option>
				<option class='7' value='134'<?php echo ((INT)$_GET['kuza']==134 ? " selected" : ""); ?>><?php echo $locale['kuza_134']; ?></option>
				<option class='7' value='135'<?php echo ((INT)$_GET['kuza']==135 ? " selected" : ""); ?>><?php echo $locale['kuza_135']; ?></option>
				<option class='7' value='136'<?php echo ((INT)$_GET['kuza']==136 ? " selected" : ""); ?>><?php echo $locale['kuza_136']; ?></option>
				<option class='7' value='145'<?php echo ((INT)$_GET['kuza']==145 ? " selected" : ""); ?>><?php echo $locale['kuza_145']; ?></option> 
			</select>
		</div>
		<div class="fileds filter_ili col-sm-3">
			<label for="filter_iliot"><?php echo $locale['infusions_cfp_014']; ?></label>
			<div class="row">
				<span class="col-sm-6">
					<select class="select col-sm-6" name="iliot" id="filter_iliot">
						<option value=""<?php echo ((INT)$_GET['iliot']=="" ? " selected" : ""); ?>><?php echo $locale['infusions_cfp_002']; ?></option>
	<?php
		$yaeril1 = date('Y')+1;
		$yaeril2 = $yaeril1-60;
		for ($yi = $yaeril2; $yi <= $yaeril1; $yi++) {
	?>
						<option value="<?php echo $yi; ?>"<?php echo ((INT)$_GET['iliot']==$yi ? " selected" : ""); ?>><?php echo $yi; ?></option>
	<?php
		} // for
	?>
					</select>
				</span>
				<span class="col-sm-6">
					<select class="select" name="ilido" id="filter_ilido">
						<option value=""<?php echo ((INT)$_GET['ilido']=="" ? " selected" : ""); ?>><?php echo $locale['infusions_cfp_003']; ?></option>
	<?php
		$yaeril1 = date('Y')+1;
		$yaeril2 = $yaeril1-60;
		for ($yi = $yaeril1; $yi >= $yaeril2; $yi--) {
	?>
						<option value="<?php echo $yi; ?>"<?php echo ((INT)$_GET['ilido']==$yi ? " selected" : ""); ?>><?php echo $yi; ?></option>
	<?php } // for ?>
					</select>
				</span>
			</div>
		</div>
		<div class="fileds filter_qiymeti col-sm-3">
			<label for="filter_qiymetiot"><?php echo $locale['infusions_cfp_015']; ?></label>
			<div class="row">
				<span class="col-sm-6">
					<input class="textbox" type="text" maxlength="10" name="qiymetiot" id="filter_qiymetiot" value="<?php echo (!empty($_GET['qiymetiot']) ? (INT)$_GET['qiymetiot'] : ""); ?>" placeholder="<?php echo $locale['infusions_cfp_002']; ?>" />
				</span>
				<span class="col-sm-6">
					<input class="textbox" type="text" maxlength="10" name="qiymetido" id="filter_qiymetido" value="<?php echo (!empty($_GET['qiymetido']) ? (INT)$_GET['qiymetido'] : ""); ?>" placeholder="<?php echo $locale['infusions_cfp_003']; ?>" />
			</div>
		</div>
		<div class="fileds filter_veziyyet col-sm-3">
			<label for="filter_veziyyet"><?php echo $locale['infusions_cfp_016']; ?></label>
			<select class="select" name="veziyyet" id="filter_veziyyet">
				<option value=""<?php echo ((INT)$_GET['veziyyet']=="" ? " selected" : ""); ?>><?php echo $locale['infusions_cfp_001']; ?></option>
				<option value="1"<?php echo ((INT)$_GET['veziyyet']==1 ? " selected" : ""); ?>><?php echo $locale['veziyyet_1']; ?></option>
				<option value="2"<?php echo ((INT)$_GET['veziyyet']==2 ? " selected" : ""); ?>><?php echo $locale['veziyyet_2']; ?></option>
				<option value="3"<?php echo ((INT)$_GET['veziyyet']==3 ? " selected" : ""); ?>><?php echo $locale['veziyyet_3']; ?></option>
				<option value="4"<?php echo ((INT)$_GET['veziyyet']==4 ? " selected" : ""); ?>><?php echo $locale['veziyyet_4']; ?></option>
			</select>
		</div>
		<div class="fileds filter_submit col-sm-3">
			<label>&nbsp;</label>
			<input class="button" value="<?php echo $locale['infusions_cfp_020']; ?>" type="submit" name="filter_submit" id="filter_submit" />
			<?php if ($_GET['filter_submit']) { ?> 
			<a href="/cars/"class="filter_cancel" id="filter_cancel" rel="nofollow">[<?php echo $locale['infusions_cfp_021']; ?>]</a>
			<?php } ?>
		</div>
		<div class="clear"></div>
	</div>
</form>

<?php
add_to_footer ("
<script type='text/javascript'>
	<!--
	function filtercount() {
		var filter_marka = $('#filter #filter_marka').val();
		var filter_model = $('#filter #filter_model').val();
		var filter_ban = $('#filter #filter_ban').val();
		var filter_kuza = $('#filter #filter_kuza').val();
		var filter_iliot = $('#filter #filter_iliot').val();
		var filter_ilido = $('#filter #filter_ilido').val();
		var filter_qiymetiot = $('#filter #filter_qiymetiot').val();
		var filter_qiymetido = $('#filter #filter_qiymetido').val();
		var filter_veziyyet = $('#filter #filter_veziyyet').val();
		$.ajax({
			type: 'GET',
			url: '/". INCLUDES ."Json/filter_count.php',
			dataType: 'json',
			data: {
						filter_submit:'1',
						filter_marka: filter_marka,
						filter_model: filter_model,
						filter_ban: filter_ban,
						filter_kuza: filter_kuza,
						filter_iliot: filter_iliot,
						filter_ilido: filter_ilido,
						filter_qiymetiot: filter_qiymetiot,
						filter_qiymetido: filter_qiymetido,
						filter_veziyyet: filter_veziyyet
			},
			success: function(data){
				var html = '';
				html += '". $locale['infusions_cfp_022'] ." '+ data +' ". $locale['infusions_cfp_023'] ."';

				console.log( html );

				$('#filter #filter_submit').val( html );
			}
		});
	}

	$(document).ready(function() {
		$('#filter #filter_marka').change(function() {
			filtercount();
		});
		$('#filter #filter_model').change(function() {
			filtercount();
		});
		$('#filter #filter_ban').change(function() {
			filtercount();
		});
		$('#filter #filter_kuza').change(function() {
			filtercount();
		});
		$('#filter #filter_iliot').change(function() {
			filtercount();
		});
		$('#filter #filter_ilido').change(function() {
			filtercount();
		});
		$('#filter #filter_qiymetiot').keyup(function() {
			var filter_qiymetiot = parseInt($('#filter #filter_qiymetiot').val());
			// console.log( filter_qiymetiot );
			if (filter_qiymetiot>0) {
				$('#filter #filter_qiymetiot').val( filter_qiymetiot );
				filtercount();
			} else {
				$('#filter #filter_qiymetiot').val('');
			}
		});
		$('#filter #filter_qiymetido').keyup(function() {
			var filter_qiymetido = parseInt($('#filter #filter_qiymetido').val());
			// console.log( filter_qiymetido );
			if (filter_qiymetido>0) {
				$('#filter #filter_qiymetido').val( filter_qiymetido );
				filtercount();
			} else {
				$('#filter #filter_qiymetido').val('');
			}
		});
		$('#filter #filter_veziyyet').change(function() {
			filtercount();
		});
	});
	//-->
</script>
");
add_to_footer ("
<script type='text/javascript'>
	<!--
	filtercount();
	//-->
</script>
");
add_to_footer ('
<script type="text/javascript">
	<!--
	function dynamicSelect(id1, id2) {
		// Browser and feature tests to see if there is enough W3C DOM support
		var agt = navigator.userAgent.toLowerCase();
		var is_ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
		var is_mac = (agt.indexOf("mac") != -1);
		if (!(is_ie && is_mac) && document.getElementById && document.getElementsByTagName) {
			// Obtain references to both select boxes
			var sel1 = document.getElementById(id1);
			var sel2 = document.getElementById(id2);
			// Clone the dynamic select box
			var clone = sel2.cloneNode(true);
			// Obtain references to all cloned options 
			var clonedOptions = clone.getElementsByTagName("option");
			// Onload init: call a generic function to display the related options in the dynamic select box
			refreshDynamicSelectOptions(sel1, sel2, clonedOptions);
			// Onchange of the main select box: call a generic function to display the related options in the dynamic select box
			sel1.onchange = function() {
				refreshDynamicSelectOptions(sel1, sel2, clonedOptions);
			};
		}
	}

	function refreshDynamicSelectOptions(sel1, sel2, clonedOptions) {
		// Delete all options of the dynamic select box
		while (sel2.options.length) {
			sel2.remove(0);
		}
		// Create regular expression objects for "select" and the value of the selected option of the main select box as class names
		var pattern1 = /( |^)(select)( |$)/;
		var pattern2 = new RegExp("( |^)(" + sel1.options[sel1.selectedIndex].value + ")( |$)");
		// Iterate through all cloned options
		for (var i = 0; i < clonedOptions.length; i++) {
			// If the classname of a cloned option either equals "select" or equals the value of the selected option of the main select box
			if (clonedOptions[i].className.match(pattern1) || clonedOptions[i].className.match(pattern2) || clonedOptions[i].className==0) {
				// Clone the option from the hidden option pool and append it to the dynamic select box
				sel2.appendChild(clonedOptions[i].cloneNode(true));
			}
		}
		var selected_model = document.getElementById("selected_model")
		if (selected_model) {
			setTimeout("selected_model.selected = true", 0);
		}
	}
	-->
</script>
');
add_to_footer ("
<script type='text/javascript'>
	<!--
	dynamicSelect('filter_marka', 'filter_model');
	//-->
</script>
");
add_to_footer ("
<script type='text/javascript'>
	<!--
	dynamicSelect('filter_ban','filter_kuza');
	//-->
</script>
");
?>