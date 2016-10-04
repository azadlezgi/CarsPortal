<?php

	require_once "../includes/maincore.php";

	if (!checkrights("AC") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

	require_once THEMES ."templates/admin_header.php";
	include LOCALE . LOCALESET ."admin/article_cats.php";


	if ($settings['tinymce_enabled']) {
		//echo "<script language='javascript' type='text/javascript'>advanced();</script>\n";
	} else {
		require_once INCLUDES."html_buttons_include.php";
	}

	opentable($locale['402']);



	if ($_GET['action']=="del") {

		$result_articles = dbquery("SELECT article_id FROM ". DB_ARTICLES ." WHERE article_cat='". (INT)$_GET['id'] ."'");

		if (dbrows($result_articles)) {
			redirect(FUSION_SELF . $aidlink ."&status=notdel&id=". (INT)$_GET['id']);
		} else {

			$result = dbquery("DELETE FROM ". DB_ARTICLE_CATS ." WHERE article_cat_id='". (INT)$_GET['id'] ."'");

			$viewcompanent = viewcompanent("article_cats", "name");
			$seourl_component = $viewcompanent['components_id'];
			$seourl_filedid = (INT)$_GET['id'];

			$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $seourl_component ."' AND seourl_filedid='". $seourl_filedid ."'");

			redirect(FUSION_SELF . $aidlink ."&status=del&id=". (INT)$_GET['id']);

		} // Yesli Cat zapolnen

	} else if ($_GET['action']=="add" || $_GET['action']=="edit") {

		if (isset($_POST['save'])) {

			$article_cat_title = stripinput($_POST['article_cat_title']);
			$article_cat_description = stripinput($_POST['article_cat_description']);
			$article_cat_keywords = stripinput($_POST['article_cat_keywords']);
			$article_cat_name = stripinput($_POST['article_cat_name']);
			$article_cat_h1 = stripinput($_POST['article_cat_h1']);
			$article_cat_alias = stripinput($_POST['article_cat_alias']);
			$article_cat_alias = $article_cat_alias;
			$article_cat_content = stripinput($_POST['article_cat_content']);
			$article_cat_access = $_POST['article_cat_access'];
			$addlink = isset($_POST['add_link']) ? " checked='checked'" : "";
			$comments = isset($_POST['article_cat_comments']) ? "1" : "0";
			$ratings = isset($_POST['article_cat_ratings']) ? "1" : "0";

		} else if ($_GET['action']=="edit") {

			$viewcompanent = viewcompanent("article_cats", "name");
			$seourl_component = $viewcompanent['components_id'];

			$result = dbquery(
				"SELECT 
											article_cat_id,
											article_cat_title,
											article_cat_description,
											article_cat_keywords,
											article_cat_name,
											article_cat_h1,
											article_cat_access,
											article_cat_content,
											seourl_url
				FROM ". DB_ARTICLE_CATS ."
				LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_cat_id AND seourl_component=". $seourl_component ."
				WHERE article_cat_id='". (INT)$_GET['id'] ."' LIMIT 1"
			);
			if (dbrows($result)) {
				$data = dbarray($result);
											$article_cat_title = unserialize($data['article_cat_title']);
											$article_cat_description = unserialize($data['article_cat_description']);
											$article_cat_keywords = unserialize($data['article_cat_keywords']);
											$article_cat_name = unserialize($data['article_cat_name']);
											$article_cat_h1 = unserialize($data['article_cat_h1']);
											$article_cat_alias = $data['seourl_url'];
											$article_cat_alias = $article_cat_alias;
											$article_cat_access = $data['article_cat_access'];
											$article_cat_content = unserialize($data['article_cat_content']);
											$addlink = "";

			} else {
				redirect(FUSION_SELF . $aidlink);
			}

		} else {

				$article_cat_title = "";
				$article_cat_description = "";
				$article_cat_keywords = "";
				$article_cat_name = "";
				$article_cat_h1 = "";
				$article_cat_alias = "";
				$article_cat_access = "";
				$article_cat_content = "";
				$comments = "";
				$ratings = "";
				$addlink = "";

		}


		if (isset($_POST['save'])) {


			foreach ($article_cat_name as $key => $value) {
				if (empty($value) && empty($error_name)) {
					$error .= "<div class='error'>". $locale['451'] ."</div>\n";
					$error_name = 1;
				}
			}

			// foreach ($article_cat_content as $key => $value) {
			// 	if (empty($value) && empty($error_content)) {
			// 		$error .= "<div class='error'>". $locale['452'] ."</div>\n";
			// 		$error_content = 1;
			// 	}
			// }


		if (isset($error)) {

			echo "	<div class='admin-message'>\n";
			echo "		<div id='close-message'>". $error ."</div>\n";
			echo "	</div>\n";

		} else {

			if ($_GET['action']=="edit") {

				$result = dbquery(
					"UPDATE ". DB_ARTICLE_CATS ." SET
														article_cat_title='". serialize($article_cat_title) ."',
														article_cat_description='". serialize($article_cat_description) ."',
														article_cat_keywords='". serialize($article_cat_keywords) ."',
														article_cat_name='". serialize($article_cat_name) ."',
														article_cat_h1='". serialize($article_cat_h1) ."',
														article_cat_access='". $article_cat_access ."',
														article_cat_content='". serialize($article_cat_content) ."'					WHERE article_cat_id='". (INT)$_GET['id'] ."'"
				);
				$article_cat_id = (INT)$_GET['id'];

			} else {

				$result = dbquery(
					"INSERT INTO ". DB_ARTICLE_CATS ." (
														article_cat_title,
														article_cat_description,
														article_cat_keywords,
														article_cat_name,
														article_cat_h1,
														article_cat_access,
														article_cat_content
					) VALUES (
														'". serialize($article_cat_title) ."',
														'". serialize($article_cat_description) ."',
														'". serialize($article_cat_keywords) ."',
														'". serialize($article_cat_name) ."',
														'". serialize($article_cat_h1) ."',
														'". $article_cat_access ."',
														'". serialize($article_cat_content) ."'
					)"
				);
				$article_cat_id = mysql_insert_id();

			} // UPDATE ILI INSERT


			$viewcompanent = viewcompanent("article_cats", "name");
			$seourl_component = $viewcompanent['components_id'];


			if (empty($article_cat_alias)) {
				$article_cat_alias = autocrateseourls($article_cat_name[LOCALESHORT]);
			} else {
				$article_cat_alias = autocrateseourls($article_cat_alias);
			}

			$seourl_url = (empty($article_cat_alias) ? "article_cats_". $article_cat_id ."" : "". $article_cat_alias ."");
			$seourl_filedid = $article_cat_id;

			$viewseourl = viewseourl($seourl_url, "url");

			if ($viewseourl['seourl_url']==$seourl_url) {
				if (($viewseourl['seourl_filedid']==$seourl_filedid) && ($viewseourl['seourl_component']==$seourl_component)) {
					$seourl_url = $seourl_url;
				} else {
					$seourl_url = "article_cats_". $article_cat_id ."";
				}
			}  // Yesli URL YEst


			$article_cat_alias = $seourl_url;


			if ($_GET['action']=="edit") {
				$result = dbquery(
					"UPDATE ".DB_SEOURL." SET
														seourl_url='".$seourl_url."'
					WHERE seourl_filedid='". $seourl_filedid ."' AND seourl_component='". $seourl_component ."'"
				);
			} else {
				$result = dbquery(
								"INSERT INTO ".DB_SEOURL." (
																seourl_url,
																seourl_component,
																seourl_filedid
									) VALUES (
																'". $seourl_url ."',
																'". $seourl_component ."',
																'". $seourl_filedid ."'
									)"
								);
			} // Yesli action edit 


			 // add_link BEGIN
			if (isset($_POST['add_link'])) {

				$data = dbarray(dbquery(
							"SELECT link_order
							FROM ". DB_SITE_LINKS ."
							ORDER BY link_order DESC LIMIT 1"));
				$link_order = $data['link_order'] + 1;
				$result = dbquery(
					"INSERT INTO ".DB_SITE_LINKS." (
														link_name,
														link_url,
														link_visibility,
														link_position,
														link_window,
														link_order
					) VALUES (
														'".serialize($article_cat_name)."',
														'".$article_cat_alias."',
														'".$article_cat_access."',
														'1',
														'0',
														'".$link_order."'
					)"
				);
			} // add_link END

			////////// redirect
			if ($_GET['action']=="edit") {
				redirect(FUSION_SELF . $aidlink ."&status=edit&id=". $article_cat_id ."&url=". $article_cat_alias, false);
			} else {
				redirect(FUSION_SELF . $aidlink ."&status=add&id=". $article_cat_id ."&url=". $article_cat_alias, false);
			} ////////// redirect

		} // Yesli Error yest
	} // Yesli POST


	$user_groups = getusergroups();
	$access_opts = "";
	$sel = "";
	while (list($key, $user_group) = each($user_groups)) {
		$sel = ($cat_access == $user_group['0'] ? " selected='selected'" : "");
		$access_opts .= "<option value='". $user_group['0'] ."'$sel>". $user_group['1'] ."</option>\n";
	}

	echo "<a href='". FUSION_SELF.$aidlink ."' class='go_back'>". $locale['471'] ."</a><br />\n";
?>

	<form name='inputform' method='POST' action='<?php echo FUSION_SELF . $aidlink; ?>&action=<?php echo $_GET['action'];?><?php echo (isset($_GET['id']) && isnum($_GET['id']) ? "&id=". $_GET['id'] : ""); ?>'>
		<table class='center'>

			<tr>
				<td class='tbl'>
					<span class='polya_name'><?php echo $locale['440']; ?></span>
					<?php
						foreach ($languages as $key => $value) {
							echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n";
					?>
							<input type='text' name="article_cat_title[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_cat_title[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
					<span class='polya_name'><?php echo $locale['441']; ?></span>
					<?php
						foreach ($languages as $key => $value) {
							echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n";
					?>
							<input type='text' name="article_cat_description[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_cat_description[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
					<span class='polya_name'><?php echo $locale['442']; ?></span>
					<?php
						foreach ($languages as $key => $value) {
							echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n";
					?>
							<input type='text' name="article_cat_keywords[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_cat_keywords[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
					<span class='polya_name'><?php echo $locale['422']; ?></span>
					<?php
						foreach ($languages as $key => $value) {
							echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n";
					?>
							<input type='text' name="article_cat_name[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_cat_name[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
					<span class='polya_name'>H1</span>
					<?php
						foreach ($languages as $key => $value) {
							echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n";
					?>
							<input type='text' name="article_cat_h1[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_cat_h1[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
					<span class='polya_name'><?php echo $locale['443']; ?><br />
					<input readonly type='text' name='article_cat_siteurl' value='<?php echo $settings['siteurl']; ?>' class='textbox' style='width:150px;' />
					<input type='text' name='article_cat_alias' value='<?php echo $article_cat_alias; ?>' class='textbox' style='width:430px;' />
				</td>
			</tr>

			<tr>
				<td class='tbl'>
					<span class='polya_name'><?php echo $locale['423']; ?><br />
					<select name='article_cat_access' class='textbox' style='width:200px;'>
						<?php echo $access_opts; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
					<span class='polya_name'><?php echo $locale['424']; ?><br />
					<?php
						foreach ($languages as $key => $value) {
							echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n";
					?>
							<textarea id='editor<?php echo $value['languages_id']; ?>' name="article_cat_content[<?php echo $value['languages_short']; ?>]" cols='95' rows='15' class='textbox' style='width:613px'><?php echo $article_cat_content[$value['languages_short']]; ?></textarea><br />
					<?php
						if (!$settings['tinymce_enabled']) {
					?>
							<input type='button' value='<?php echo $locale['431']; ?>' class='button' onclick=\"insertText('article_cat_content', '&lt;!--PAGEBREAK--&gt;');\" />
							<input type='button' value='&lt;?php?&gt;' class='button' onclick=\"addText('article_cat_content', '&lt;?php\\n', '\\n?&gt;');\" />
							<input type='button' value='&lt;p&gt;' class='button' onclick=\"addText('article_cat_content', '&lt;p&gt;', '&lt;/p&gt;');\" />
							<input type='button' value='&lt;br /&gt;' class='button' onclick=\"insertText('article_cat_content', '&lt;br /&gt;');\" />
							<?php
								echo display_html("inputform", "article_cat_content", true);
							?>
					<?php
						} // Yesli Text Editor Net
					?>
					<?php
						}
					?>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
				<?php
					if ($_GET['action']=="add") {
				?>
					<label><input type='checkbox' name='add_link' value='1'<?php echo $addlink; ?> />  <?php echo $locale['426']; ?></label><br />
				<?php
					}
				?>

				<?php
					if ($settings['comments_enabled']!=="0") {
				?>
					<label><input type='checkbox' name='article_cat_comments' value='1'<?php echo $comments; ?> /> <?php echo $locale['427']; ?></label><br />
				<?php
					}
				?>

				<?php
					if ($settings['ratings_enabled']!=="0") {
				?>
					<label><input type='checkbox' name='article_cat_ratings' value='1'<?php echo $ratings; ?> /> <?php echo $locale['428']; ?></label><br />
				<?php
					}
				?>
				</td>
			</tr>
			<tr>
				<td class='tbl'>
					<input type='submit' name='save' value='<?php echo $locale['430']; ?>' class='button' />
				</td>
			</tr>
		</table>
	</form>


	<script type='text/javascript'>
	<?php
	if ($settings['tinymce_enabled']==2) { 
		foreach ($languages as $key => $value) {
	?>
		var ckeditor<?php echo $value['languages_id']; ?> = CKEDITOR.replace('editor<?php echo $value['languages_id']; ?>');
		CKFinder.setupCKEditor( ckeditor<?php echo $value['languages_id']; ?>, '<?php echo INCLUDES; ?>jscripts/ckeditor/ckfinder/' );
	<?php
		} // foreach $languages
	} // Yesli Text Editor CKEDITOR
	?>
	</script>

<?php
} else {


	if ($_GET['status']) {
		if ($_GET['status']=="add") {

			$message = "<div class='success'>". $locale['410'] ." ID: ". intval($_GET['id']) ."</div>\n";
			$message .= "<div class='success'>". $locale['412'] ."<a href='".BASEDIR.$_GET['url']."' target='_blank'>". $_GET['url'] ."</a></div>\n";

		} elseif ($_GET['status']=="edit") {

			$message = "<div class='success'>". $locale['411'] ." ID: ". intval($_GET['id']) ."</div>\n";
			$message .= "<div class='success'>". $locale['412'] ."<a href='".BASEDIR.$_GET['url']."' target='_blank'>". $_GET['url'] ."</a></div>\n";

		} elseif ($_GET['status']=="del") {

			$message = "<div class='success'>". $locale['413'] ." ID: ". intval($_GET['id']) ."</div>\n";

		} elseif ($_GET['status']=="notdel") {

			$message = "<div class='error'>". $locale['414'] ." ID: ". intval($_GET['id']) ."</div>\n";

		}
		if ($message) {
			echo "	<div class='admin-message'>\n";
			echo "		<div id='close-message'>". $message ."</div>\n";
			echo "	</div>\n";
		}
	}

	$viewcompanent = viewcompanent("article_cats", "name");
	$seourl_component = $viewcompanent['components_id'];


	$result = dbquery("SELECT 
								article_cat_id,
								article_cat_name,
								seourl_url
		FROM ".DB_ARTICLE_CATS."
		LEFT JOIN ".DB_SEOURL." ON seourl_filedid=article_cat_id AND seourl_component=". $seourl_component ."
		ORDER BY article_cat_name");

	echo "<a href='". FUSION_SELF.$aidlink ."&action=add' class='add_page'>". $locale['472'] ."</a><br />\n";
?>

	<table class="spisok_stranic">
		<thead>
			<tr>
				<td class="list cat_id"><span><?php echo $locale['432']; ?></span></td>
				<td class="list"><span><?php echo $locale['422']; ?></span></td>
				<td class="list links"><span><?php echo $locale['433']; ?></span></td>
			</tr>
		</thead>
		<tbody>
	<?php
			while ($data = dbarray($result)) {
				$article_cat_name = unserialize($data['article_cat_name']);
				$article_count = dbcount("(article_id)", DB_ARTICLES, "article_cat='". $data['article_cat_id'] ."'");
	?>
			<tr>
				<td class="list cat_id" style="border-bottom:1px solid silver;">#<?php echo $data['article_cat_id']; ?></td>
				<td class="list" style="border-bottom:1px solid silver;"><?php echo $article_cat_name[LOCALESHORT]; ?> (<?php echo $article_count; ?>)</td>
				<td class="list links" style="border-bottom:1px solid silver;">
					<a href="<?php echo BASEDIR.$data['seourl_url']; ?>" target="_blank" title="<?php echo $locale['431']; ?>"><img src="<?php echo IMAGES; ?>view.png" alt="<?php echo $locale['431']; ?>"></a>
					<a href="<?php echo FUSION_SELF.$aidlink; ?>&action=edit&id=<?php echo $data['article_cat_id']; ?>" title="<?php echo $locale['420']; ?>"><img src="<?php echo IMAGES; ?>edit.png" alt="<?php echo $locale['420']; ?>"></a>
					<a href="<?php echo FUSION_SELF.$aidlink; ?>&action=del&id=<?php echo $data['article_cat_id']; ?>" title="<?php echo $locale['421']; ?>" onclick="return DeleteOk();"><img src="<?php echo IMAGES; ?>delete.png" alt="<?php echo $locale['421']; ?>"></a>
				</td>
			</tr>

	<?php
			} // db whille
	?>
		</tbody>
	</table>

	<script type='text/javascript'>
		function DeleteOk() {
			return confirm('<?php echo $locale['450']; ?>');
		}
	</script>

<?php
} // Yesli GET action

	closetable();
	require_once THEMES."templates/footer.php";
?>