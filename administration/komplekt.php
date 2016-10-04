<?php

require_once "../includes/maincore.php";

if (!checkrights("KOMP") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

require_once THEMES."templates/admin_header.php";

include LOCALE.LOCALESET."admin/komplekt.php";

	echo "<div class='breadcrumb'>\n";
	echo "	<ul>\n";
	echo "		<li><a href='". ADMIN . $aidlink ."&pagenum=3'>". $locale['640'] ."</a></li>\n";
	echo "		<li><span>". $locale['641'] ."</span></li>\n";
	echo "	</ul>\n";
	echo "</div>\n";

	opentable($locale['h1']);


	if ($_GET['action']=="delete") {

		$result = dbquery("DELETE FROM ". DB_KOMP ." WHERE komp_id='". (INT)$_GET['id'] ."'");
		redirect(ADMIN ."komplekt.php". $aidlink ."&status=deleted". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

	} else if (($_GET['action']=="edit") || ($_GET['action']=="add")) {


		if ($_POST['komp_submit']) {

			$komp_id = (INT)$_GET['id'];
			$komp_name = stripinput(censorwords($_POST['komp_name']));

		} else if ($_GET['action']=="edit") {

			$result = dbquery("SELECT * FROM ". DB_KOMP ." WHERE komp_id='". (INT)$_GET['id'] ."'");

			if (dbrows($result)) {
				$data = dbarray($result);

				$komp_id = $data['komp_id'];
				$komp_name = unserialize($data['komp_name']);

			} // Yesli DB query yest

		} else {

			$komp_id = "";
			$komp_name = "";

		}

		if ($_POST['komp_submit']) {

			foreach ($komp_name as $key => $value) {
				if (empty($value)) { $error_komp_name = 1; $error .= "<div class='error'>". $locale['error_010'] ."</div>\n"; }
			}
			if ($_SESSION["antifludtime"]>=FUSION_TODAY)	{ $error .= "<div class='error'>". $locale['error_500'] ."</div>\n"; }

			if ($error) {
				echo "<div id='close-message'>\n";
				echo $error;
				echo "</div>\n";
			} else {

				if ($_GET['action']=="edit") {

					### UPDATE KOMP BEGIN
					$result = dbquery(
						"UPDATE ". DB_KOMP ." SET
														komp_name='". serialize($komp_name) ."'
						WHERE komp_id='". $komp_id ."'"
					);
					### UPDATE KOMP END
					redirect(ADMIN ."komplekt.php". $aidlink ."&status=edited". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

				} else if ($_GET['action']=="add") {

					### INSERT KOMP BEGIN
					$result = dbquery(
						"INSERT INTO ". DB_KOMP ." (
														komp_name
						) VALUES (
														'". serialize($komp_name) ."'

						)"
					);
					### INSERT KOMP END
					redirect(ADMIN ."komplekt.php". $aidlink ."&status=added". ($_GET['page'] ? "&page=". (INT)$_GET['page'] : ""), false);

				} // Yesli Edit ili Add

			} // Yesli Error Yest

		} // Yesli Post

	} // Yesli Edit ili Add

	if (isset($_GET['status'])) {
		echo "<div id='close-message'>\n";
		if ($_GET['status']=="added") {
			echo "<div class='status'>". $locale['status_001'] ."</div>\n";
		} else if ($_GET['status']=="edited") {
			echo "<div class='status'>". $locale['status_002'] ."</div>\n";
		} else if ($_GET['status']=="deleted") {
			echo "<div class='status'>". $locale['status_003'] ."</div>\n";
		}
		echo "</div>\n";
	}

?>

	<table class="komplekt">
		<thead>
			<tr>
				<td class="komp_id"><?php echo $locale['510']; ?></td>
				<td class="komp_name"><?php echo $locale['511']; ?></td>
				<td class="komp_href"><?php echo $locale['512']; ?></td>
			</tr>
		</thead>
		<tbody>
<?php

		if (isset($_GET['page'])) {
			$say = $_GET['page'];
		} else {
			$say = 1;
		}
		$rowstart = $settings['goradmin']*($say-1);

		$result = dbquery("SELECT
									komp_id,
									komp_name
							FROM ". DB_KOMP ."
							ORDER BY `komp_id` DESC
							LIMIT ". $rowstart .", ". $settings['goradmin'] ."");
		if (dbrows($result)) {
			while ($data = dbarray($result)) {
?>
			<tr>
				<td class="komp_id">#<?php echo $data['komp_id']; ?></td>
				<td class="komp_name"><?php echo unserialize($data['komp_name'])[LOCALESHORT]; ?></td>
				<td class="komp_href">
					<a class='edit' href='<?php echo ADMIN ."komplekt.php".  $aidlink ."&action=edit&id=". $data['komp_id']; ?>' title='<?php echo $locale['520']; ?>'><img src='<?php echo IMAGES; ?>edit.png' alt='<?php echo $locale['520']; ?>'></a>
					<a class='delete' href='<?php echo ADMIN ."komplekt.php".  $aidlink ."&action=delete&id=". $data['komp_id']; ?>' title='<?php echo $locale['521']; ?>' onclick='return DeleteOk();'><img src='<?php echo IMAGES; ?>delete.png' alt='<?php echo $locale['521']; ?>'></a>
				</td>
			</tr>
<?php
			} // db query
		} else {
?>
			<tr>
				<td colspan="3"><?php echo $locale['501']; ?></td>
			</tr>
<?php
		}

?>
		</tbody>
		<tfoot>
		<form method="POST" name="addkomp" id="addkomp" action="<?php echo ADMIN ."komplekt.php". $aidlink . ($_GET['action']=="edit" ? "&action=edit&id=". (INT)$_GET['id'] : "&action=add"); ?>">
			<tr>
				<td class="komp_name" colspan="2">
					<?php
						foreach ($languages as $key => $value) {
							echo "<span class='local_name ". $value['languages_folder'] ."'>". unserialize($value['languages_name'])[LOCALESHORT] ."</span>\n";
					?>
						<input class="textbox<?php echo ($error_komp_name==1 ? " error" : ""); ?>" type="text" name="komp_name[<?php echo $value['languages_short']; ?>]" id="komp_name" value="<?php echo $komp_name[$value['languages_short']]; ?>" maxlength="255" /><br />
					<?php
						}
					?>
				</td>
				<td class="komp_href">
					<input class="button" value="<?php echo $locale['590']; ?>" type="submit" name="komp_submit" id="komp_submit" />
				</td>
			</tr>
		</form>
		</tfoot>
	</table>

<?php
	echo navigation($_GET['page'], $settings['goradmin'], "komp_id", DB_KOMP, "");
?>

		<script type='text/javascript'>
			<!--
			function DeleteOk() {
				return confirm('<?php echo $locale['502']; ?>');
			}
			//-->
		</script>

<?php
	closetable();
	
require_once THEMES."templates/footer.php";
?>