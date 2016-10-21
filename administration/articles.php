<?php
 
	require_once "../includes/maincore.php";

	if (!checkrights("A") || !defined("iAUTH") || !isset($_GET['aid']) || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

	require_once THEMES ."templates/admin_header.php";
	require_once INCLUDES."photo_functions_include.php";
	include LOCALE.LOCALESET."admin/articles.php";

	if ($settings['tinymce_enabled']) {
		//echo "<script language='javascript' type='text/javascript'>advanced();</script>\n";
	} else {
		require_once INCLUDES."html_buttons_include.php";
	}

	opentable($locale['400']);


	if ($_GET['action']=="del") {

		$result = dbquery("SELECT article_image FROM ". DB_ARTICLES ." WHERE article_id='". (INT)$_GET['id'] ."' LIMIT 1");
		if (dbrows($result)) {
			$data = dbarray($result);
			if (!empty($data['article_image']) && file_exists(IMAGES_A . $data['article_image'])) { unlink(IMAGES_A . $data['article_image']); }
			if (!empty($data['article_image']) && file_exists(IMAGES_A_T . $data['article_image'])) { unlink(IMAGES_A_T . $data['article_image']); }
		} // Tesli Yest DB query

		$result = dbquery("DELETE FROM ".DB_ARTICLES." WHERE article_id='". (INT)$_GET['id'] ."'");
		$result = dbquery("DELETE FROM ".DB_COMMENTS." WHERE comment_item_id='". (INT)$_GET['id'] ."' and comment_type='A'");
		$result = dbquery("DELETE FROM ".DB_RATINGS." WHERE rating_item_id='". (INT)$_GET['id'] ."' and rating_type='A'");

		$viewcompanent = viewcompanent("articles", "name");
		$seourl_component = $viewcompanent['components_id'];
		$seourl_filedid = (INT)$_GET['id'];

		$result = dbquery("DELETE FROM ". DB_SEOURL ." WHERE seourl_component='". $seourl_component ."' AND seourl_filedid='". $seourl_filedid ."'");

		redirect(FUSION_SELF . $aidlink ."&status=del&id=". (INT)$_GET['id']);

	} else if ($_GET['action']=="add" || $_GET['action']=="edit") {

		if (isset($_POST['save'])) {

			$article_cat = (INT)$_POST['article_cat'];
			$article_title = stripinput($_POST['article_title']);
			$article_description = stripinput($_POST['article_description']);
			$article_keywords = stripinput($_POST['article_keywords']);
			$article_name = stripinput($_POST['article_name']);
			$article_h1 = stripinput($_POST['article_h1']);
			$article_content = stripinput($_POST['article_content']);
			$article_access = (INT)$_POST['article_access'];
			$article_status = (INT)$_POST['article_status'];
			$article_order = (INT)$_POST['article_order'];
			$comments = (INT)$_POST['article_comments'];
			$ratings = (INT)$_POST['article_ratings'];
			$article_alias = stripinput($_POST['article_alias']);
			// $article_alias = str_replace("help/", "", $article_alias);

			$article_image =  $_FILES['article_image']['name'];
			$article_imagetmp  = $_FILES['article_image']['tmp_name'];
			$article_imagesize = $_FILES['article_image']['size'];
			$article_imagetype = $_FILES['article_image']['type'];

			$article_image_yest =  stripinput($_POST['article_image_yest']);

		} else if ($_GET['action']=="edit") {

			$viewcompanent = viewcompanent("article_item", "name");
			$seourl_component = $viewcompanent['components_id'];

			$result = dbquery(
				"SELECT 
											article_id,
											article_cat,
											article_title,
											article_description,
											article_keywords,
											article_name,
											article_image,
											article_h1,
											article_content,
											article_access,
											article_status,
											article_order,
											article_comments,
											article_ratings,
											seourl_url
				FROM ". DB_ARTICLES ."
				LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_id AND seourl_component=". $seourl_component ."
				WHERE article_id='". (INT)$_GET['id'] ."' LIMIT 1"
			);
			if (dbrows($result)) {
				$data = dbarray($result);
											$article_cat = $data['article_cat'];
											$article_title = unserialize($data['article_title']);
											$article_description = unserialize($data['article_description']);
											$article_keywords = unserialize($data['article_keywords']);
											$article_name = unserialize($data['article_name']);
											$article_image = $data['article_image'];
											$article_h1 = unserialize($data['article_h1']);
											$article_content = unserialize($data['article_content']);
											$article_access = $data['article_access'];
											$article_status = $data['article_status'];
											$article_order = $data['article_order'];
											$comments = $data['article_comments'];
											$ratings = $data['article_ratings'];
											$article_alias = $data['seourl_url'];
											// $article_alias = str_replace("help/", "", $article_alias);

			} else {
				redirect(FUSION_SELF . $aidlink);
			}

		} else {

				$article_cat = "";
				$article_title = "";
				$article_description = "";
				$article_keywords = "";
				$article_name = "";
				$article_image = "";
				$article_h1 = "";
				$article_content = "";
				$article_access = "";
				$article_status = 1;
				$article_order = "";
				$comments = "";
				$ratings = "";
				$article_alias = "";

		} // Yesli POST


		if ($article_cat) {
			$viewcompanent_type = viewcompanent("article_cats", "name");
			$seourl_component_type = $viewcompanent_type['components_id'];

			$result_type = dbquery("SELECT
												seourl_url
			FROM ". DB_SEOURL ."
			WHERE seourl_component='" . $seourl_component_type ."'
			AND seourl_filedid='". $article_cat ."'
			LIMIT 1");
			if (dbrows($result_type)) {
				$data_type = dbarray($result_type);
				$article_cat_alias = $data_type['seourl_url'];
			}

			$article_alias = str_replace($article_cat_alias ."/", "", $article_alias);

		} // Yesli yest catalog_type


		if (isset($_POST['save'])) {

			if (empty($article_cat)) {
					$error .= "<div class='error'>". $locale['450'] ."</div>\n";
			}

			foreach ($article_name as $key => $value) {
				if (empty($value) && empty($error_name)) {
					$error .= "<div class='error'>". $locale['451'] ."</div>\n";
					$error_name = 1;
				}
			}

			foreach ($article_content as $key => $value) {
				if (empty($value) && empty($error_content)) {
					$error .= "<div class='error'>". $locale['452'] ."</div>\n";
					$error_content = 1;
				}
			}

			if (!empty($article_image)) {
				if (strlen($article_image) > 100) { $error .= "<div class='error'>". $locale['error_050'] ."</div>\n"; }
				// проверяем расширение файла
				$article_image_ext = strtolower(substr($article_image, 1 + strrpos($article_image, ".")));
				if (!in_array($article_image_ext, $photo_valid_types)) { $error .= "<div class='error'>". $locale['error_051'] ."</div>\n"; }
				// 1. считаем кол-во точек в выражении - если большей одной - СВОБОДЕН!
				$article_image_findtochka = substr_count($article_image, ".");
				if ($article_image_findtochka>1) { $error .= "<div class='error'>". $locale['error_052'] ."</div>\n"; }
				// 2. если в имени есть .php, .html, .htm - свободен! 
				if (preg_match("/\.php/i",$article_image))  { $error .= "<div class='error'>". $locale['error_053'] ."</div>\n"; }
				if (preg_match("/\.html/i",$article_image)) { $error .= "<div class='error'>". $locale['error_054'] ."</div>\n"; }
				if (preg_match("/\.htm/i",$article_image))  { $error .= "<div class='error'>". $locale['error_055'] ."</div>\n"; }
				// 5. Размер фото
				$article_image_fotosize = round($article_imagesize/10.24)/100; // размер ЗАГРУЖАЕМОГО ФОТО в Кб.
				$article_image_fotomax = round($settings['news_photo_max_b']/10.24)/100; // максимальный размер фото в Кб.
				if ($article_image_fotosize>$article_image_fotomax) { $error .= "<div class='error'>". $locale['error_056'] ."<br />". $locale['error_057'] ." ". $article_image_fotosize ." Kb<br />". $locale['error_058'] ." ". $article_image_fotomax ." Kb</div>\n"; }
				// 6. "Габариты" фото > $maxwidth х $maxheight - ДО свиданья! :-)
				$article_image_getsize = getimagesize($article_imagetmp);
				if ($article_image_getsize[0]>$settings['news_photo_max_w'] or $article_image_getsize[1]>$settings['news_photo_max_h']) { $error .= "<div class='error'>". $locale['error_059'] ."<br />". $locale['error_060'] ." ". $article_image_getsize[0] ."x". $article_image_getsize[1] ."<br />". $locale['error_061'] ." ". $settings['news_photo_max_w'] ."x". $settings['news_photo_max_h'] ."</div>\n"; }
				// if ($article_image_getsize[0]<$article_image_getsize[1]) { $error .= "<div class='error'>". $locale['error_062'] ."</div>\n"; }
				// Foto 0 Kb
				if ($article_imagesize<0 and $article_imagesize>$settings['foto_size']) { $error .= "<div class='error'>". $locale['error_063'] ."</div>\n"; }
			}





			if (isset($error)) {

				echo "	<div class='admin-message'>\n";
				echo "		<div id='close-message'>". $error ."</div>\n";
				echo "	</div>\n";

			} else {


			if (!empty($article_image)) {

				$img_rand_key = mt_rand(100,999);

				// $$article_image = stripfilename(str_replace(" ", "_", strtolower($article_image)));
				$article_image_ext = strrchr($article_image, ".");
				$article_image = stripfilename(str_replace(" ", "_", strtolower(substr($article_image, 0, strrpos($article_image, ".")))));


				if ($article_image_ext == ".gif") {
					$article_image_filetype = 1;
				} elseif ($article_image_ext == ".jpg") {
					$article_image_filetype = 2;
				} elseif ($article_image_ext == ".png") {
					$article_image_filetype = 3;
				} else {
					$article_image_filetype = false; 
				}

				$article_image = image_exists(IMAGES_A, $article_image . $img_rand_key . $article_image_ext);

				move_uploaded_file($article_imagetmp, IMAGES_A . $article_image);
				// if (function_exists("chmod")) { chmod(IMAGES_A . $article_image, 0644); }

				createthumbnail($article_image_filetype, IMAGES_A . $article_image, IMAGES_A_T . $article_image, $settings['articles_photo_w'], $settings['articles_photo_h']);
				if ($settings['articles_thumb_ratio'] == 0) {
					createthumbnail($article_image_filetype, IMAGES_A . $article_image, IMAGES_A_T . $article_image, $settings['articles_thumb_w'], $settings['articles_thumb_h']);
				} else {
					createsquarethumbnail($article_image_filetype, IMAGES_A . $article_image, IMAGES_A_T . $article_image, $settings['articles_thumb_w']);
				}
			} else {
				$article_image = (isset($_POST['article_image_yest']) ? (preg_match("/^[-0-9A-Z_\.\[\]]+$/i", $_POST['article_image_yest']) ? $_POST['article_image_yest'] : "") : "");
			} // Photo Upload



				if ($_GET['action']=="edit") {

					if (isset($_POST['del_image'])) {
						if (!empty($article_image_yest) && file_exists(IMAGES_A . $article_image_yest)) { unlink(IMAGES_A . $article_image_yest); }
						if (!empty($article_image_yest) && file_exists(IMAGES_A_T . $article_image_yest)) { unlink(IMAGES_A_T . $article_image_yest); }
						$article_image = "";
					}

					$result = dbquery(
						"UPDATE ". DB_ARTICLES ." SET
															article_cat='". $article_cat ."',
															article_title='". serialize($article_title) ."',
															article_description='". serialize($article_description) ."',
															article_keywords='". serialize($article_keywords) ."',
															article_name='". serialize($article_name) ."',
															article_image='". $article_image ."',
															article_h1='". serialize($article_h1) ."',
															article_content='". serialize($article_content) ."',
															article_access='". $article_access ."',
															article_status='". $article_status ."',
															article_order='". $article_order ."',
															article_comments='". $comments ."',
															article_ratings='". $ratings ."'
						WHERE article_id='". (INT)$_GET['id'] ."'"
					);
					$article_id = (INT)$_GET['id'];

				} else {

					$result = dbquery(
						"INSERT INTO ". DB_ARTICLES ." (
															article_cat,
															article_title,
															article_description,
															article_keywords,
															article_name,
															article_image,
															article_h1,
															article_content,
															article_access,
															article_status,
															article_order,
															article_comments,
															article_ratings
						) VALUES (
															'". $article_cat ."',
															'". serialize($article_title) ."',
															'". serialize($article_description) ."',
															'". serialize($article_keywords) ."',
															'". serialize($article_name) ."',
															'". $article_image ."',
															'". serialize($article_h1) ."',
															'". serialize($article_content) ."',
															'". $article_access ."',
															'". $article_status ."',
															'". $article_order ."',
															'". $comments ."',
															'". $ratings ."'
						)"
					);
					$article_id = mysql_insert_id();

				} // UPDATE ILI INSERT


				$viewcompanent = viewcompanent("article_item", "name");
				$seourl_component = $viewcompanent['components_id'];

				if (empty($article_alias)) {
					$article_alias = autocrateseourls($article_name[LOCALESHORT]);
				} else {
					$article_alias = autocrateseourls($article_alias);
				}

				$seourl_url = (empty($article_alias) ? "article". $article_id .".php" : $article_alias);
				$seourl_filedid = $article_id;

				$viewseourl = viewseourl($seourl_url, "url");

				if ($viewseourl['seourl_url']==$seourl_url) {
					if (($viewseourl['seourl_filedid']==$seourl_filedid) && ($viewseourl['seourl_component']==$seourl_component)) {
						$seourl_url = $seourl_url;
					} else {
						$seourl_url = "article". $article_id .".php";
					}
				}  // Yesli URL YEst

				$seourl_url = $article_cat_alias ."/". $seourl_url;
				$article_alias = $seourl_url;


				if ($_GET['action']=="edit") {
					$result = dbquery(
						"UPDATE ". DB_SEOURL ." SET
															seourl_url='". $seourl_url ."',
															seourl_lastmod='". date("Y-m-d") ."'
						WHERE seourl_filedid='". $seourl_filedid ."' AND seourl_component='". $seourl_component ."'"
					);
				} else {
					$result = dbquery(
									"INSERT INTO ". DB_SEOURL ." (
																	seourl_url,
																	seourl_component,
																	seourl_filedid,
																	seourl_lastmod
										) VALUES (
																	'". $seourl_url ."',
																	'". $seourl_component ."',
																	'". $seourl_filedid ."',
																	'". date("Y-m-d") ."'
										)"
									);
				} // Yesli action edit 


				////////// redirect
				if ($_GET['action']=="edit") {
					redirect(FUSION_SELF . $aidlink ."&status=edit&id=". $article_id ."&url=". $article_alias, false);
				} else {
					redirect(FUSION_SELF . $aidlink ."&status=add&id=". $article_id ."&url=". $article_alias, false);
				} ////////// redirect

			} // Yesli Error

		} // Yesli POST save


		$result = dbquery(
							"SELECT
												article_cat_id,
												article_cat_name
							FROM ". DB_ARTICLE_CATS ."
							ORDER BY article_cat_name DESC");
		$catlist = ""; $sel = "";
		while ($data = dbarray($result)) {
			$catlist_article_cat_name = unserialize($data['article_cat_name']);
			if (isset($article_cat)) $sel = ($article_cat == $data['article_cat_id'] ? " selected='selected'" : "");
			$catlist .= "<option value='".$data['article_cat_id']."'$sel>". $catlist_article_cat_name[LOCALESHORT] ."</option>\n";
		}

		$user_groups = getusergroups();
		$access_opts = "";
		$sel = "";
		while (list($key, $user_group) = each($user_groups)) {
			$sel = ($cat_access == $user_group['0'] ? " selected='selected'" : "");
			$access_opts .= "<option value='". $user_group['0'] ."'$sel>". $user_group['1'] ."</option>\n";
		}

		?>

		<form name='inputform' method='POST' action='<?php echo FUSION_SELF . $aidlink; ?>&action=<?php echo $_GET['action'];?><?php echo (isset($_GET['id']) && isnum($_GET['id']) ? "&id=". $_GET['id'] : ""); ?>' enctype='multipart/form-data'>
			<table class="articles">
				<tbody>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['420']; ?></span>
							<?php
								foreach ($languages as $key => $value) {
									if ($languages_count>1) { echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n"; }
							?>
									<input type='text' name="article_title[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_title[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['421']; ?></span>
							<?php
								foreach ($languages as $key => $value) {
									if ($languages_count>1) { echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n"; }
							?>
									<input type='text' name="article_description[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_description[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['422']; ?></span>
							<?php
								foreach ($languages as $key => $value) {
									if ($languages_count>1) { echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n"; }
							?>
									<input type='text' name="article_keywords[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_keywords[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['423']; ?>*</span>
							<?php
								foreach ($languages as $key => $value) {
									if ($languages_count>1) { echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n"; }
							?>
									<input type='text' name="article_name[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_name[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['424']; ?></span>
							<?php
								foreach ($languages as $key => $value) {
									if ($languages_count>1) { echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n"; }
							?>
									<input type='text' name="article_h1[<?php echo $value['languages_short']; ?>]" value="<?php echo $article_h1[$value['languages_short']]; ?>" class='textbox' maxlength="500" style='width:98%;' /><br />
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['425']; ?></span>
							<input readonly type='text' name='article_siteurl' value='<?php echo $settings['siteurl']; ?>' class='textbox' style='width:150px;' />
							<input type='text' name='article_alias' value='<?php echo $article_alias; ?>' class='textbox' style='width:430px;' />
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['427']; ?></span>
							<select name='article_cat' class='textbox' style='width:200px;'>
								<?php echo $catlist; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['428']; ?></span>
							<select name='article_access' class='textbox' style='width:200px;'>
								<?php echo $access_opts; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['440']; ?></span>
							<?php if ($article_image != "" && $article_image_t1 != "") { ?>
								<img src='<?php echo IMAGES_A_T . $article_image_t1; ?>' alt='<?php echo $locale['440']; ?>' /><br />
								<label><input type='checkbox' name='del_image' value='y' /> <?php echo $locale['441']; ?></label>
								<input type='hidden' name='article_image_yest' value='<?php echo $article_image; ?>' />
								<input type='hidden' name='article_image_yest_t1' value='<?php echo $article_image_t1; ?>' />
								<input type='hidden' name='article_image_yest_t2' value='<?php echo $article_image_t2; ?>' />
							<?php } else { ?>
								<input type='file' name='article_image' class='textbox' style='width:250px;' /><br />
								<?php echo sprintf($locale['442'], parsebytesize($settings['news_photo_max_b'])); ?>
							<?php }	?>
						</td>
					</tr>
					<tr>
						<td class="tbl">
							<span class='polya_name'><?php echo $locale['426']; ?>*</span>
							<?php
								foreach ($languages as $key => $value) {
									if ($languages_count>1) { echo "<span class='local_name lang_". $value['languages_short'] ."'>". $value['languages_name'] ."</span>\n"; }
							?>
								<textarea id='editor<?php echo $value['languages_id']; ?>' name="article_content[<?php echo $value['languages_short']; ?>]" cols='95' rows='15' class='textbox' style='width:613px'><?php echo $article_content[$value['languages_short']]; ?></textarea><br />
							<?php
								if (!$settings['tinymce_enabled']) {
							?>
									<input type='button' value='<?php echo $locale['431']; ?>' class='button' onclick=\"insertText('article_content', '&lt;!--PAGEBREAK--&gt;');\" />
									<input type='button' value='&lt;?php?&gt;' class='button' onclick=\"addText('article_content', '&lt;?php\\n', '\\n?&gt;');\" />
									<input type='button' value='&lt;p&gt;' class='button' onclick=\"addText('article_content', '&lt;p&gt;', '&lt;/p&gt;');\" />
									<input type='button' value='&lt;br /&gt;' class='button' onclick=\"insertText('article_content', '&lt;br /&gt;');\" />
									<?php
										echo display_html("inputform", "article_content", true);
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
						<td class="tbl">
							<label><input type='checkbox' name='article_status' value='1'<?php echo ($article_status == "1" ? " checked='checked'" : ""); ?> />  <?php echo $locale['429']; ?></label><br />

						<?php
							if ($settings['comments_enabled']!=="0") {
						?>
							<label><input type='checkbox' name='article_comments' value='1'<?php echo ($comments == "1" ? " checked='checked'" : ""); ?> /> <?php echo $locale['430']; ?></label><br />
						<?php
							}
						?>

						<?php
							if ($settings['ratings_enabled']!=="0") {
						?>
							<label><input type='checkbox' name='article_ratings' value='1'<?php echo ($ratings == "1" ? " checked='checked'" : ""); ?> /> <?php echo $locale['431']; ?></label><br />
						<?php
							}
						?>
						</td>
					</tr>
				<tr>
					<td class='tbl'>
						<input type='submit' name='save' value='<?php echo $locale['432']; ?>' class='button' />
					</td>
				</tr>
				</tbody>
			</table>
		</form>


		<script type='text/javascript'>
		<?php
		if ($settings['tinymce_enabled']) { 
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
		if ($_GET['status']=="add") { $message = "<div class='success'>". $locale['success_002'] ." ID: ". intval($_GET['id']) ."</div>\n"; $message .= "<div class='success'>". $locale['success_001'] ."<a href='". BASEDIR . $_GET['url'] ."' target='_blank'>". $_GET['url'] ."</a></div>\n"; }
		elseif ($_GET['status']=="edit") { $message = "<div class='success'>". $locale['success_003'] ." ID: ". intval($_GET['id']) ."</div>\n"; $message .= "<div class='success'>". $locale['success_001'] ."<a href='". BASEDIR . $_GET['url'] ."' target='_blank'>". $_GET['url'] ."</a></div>\n"; }
		elseif ($_GET['status']=="del") { $message = "<div class='success'>". $locale['success_004'] ." ID: ". intval($_GET['id']) ."</div>\n"; }
		elseif ($_GET['status']=="active") { $message = "<div class='success'>". $locale['success_005'] ." ID: ". intval($_GET['id']) ."</div>\n"; }
		elseif ($_GET['status']=="deactive") { $message = "<div class='success'>". $locale['success_006'] ." ID: ". intval($_GET['id']) ."</div>\n"; }
	} // status

	echo "	<div class='admin-message'>\n";
	if ($message) {
	echo "		<div id='close-message'>". $message ."</div>\n";
	} // message
	echo "	</div>\n";


add_to_head("<script type='text/javascript' src='". INCLUDES ."jquery/jquery-ui.js'></script>");
add_to_head("<script type='text/javascript'>
	<!--
	$(document).ready(function() {
		$('.spisok_stranic tbody').sortable({
			handle : '.handle',
			placeholder: 'state-highlight',
			connectWith: '.connected',
			scroll: true,
			axis: 'y',
			update: function () {
				var ul = $(this),
					order = ul.sortable('serialize'),
					i = 0;
				$('.admin-message').empty();
				$('.admin-message').load('". FUSION_SELF . $aidlink ."&action=order&'+ order);
				ul.find('.num').each(function(i) {
					$(this).text(i+1);
				});
				// ul.find('tr').removeClass('tbl2').removeClass('tbl1');
				// ul.find('tr:odd').addClass('tbl2');
				// ul.find('tr:even').addClass('tbl1');
				window.setTimeout('closeDiv();',2500);
			}
		});
	});
	//-->
</script>");
?>


<?php
	if ($_GET['page']>1) { $pagesay = (INT)$_GET['page']; }
	else { $pagesay = 1; }
	$rowstart = $settings['articles_per_page']*($pagesay-1);

	$viewcompanent = viewcompanent("article_item", "name");
	$seourl_component = $viewcompanent['components_id'];

	$result = dbquery("SELECT 
								article_id,
								article_name,
								article_status,
								article_order,
								seourl_url
		FROM ". DB_ARTICLES ."
		LEFT JOIN ". DB_SEOURL ." ON seourl_filedid=article_id AND seourl_component=". $seourl_component ."
		LIMIT ". $rowstart .", ". $settings['articles_per_page']);

	echo "<a href='". FUSION_SELF . $aidlink ."&action=add' class='add_page'>". $locale['010'] ."</a><br />\n";

	if (dbrows($result)) {
?>

	<table class="spisok_stranic">
		<thead>
			<tr>
				<td class="list"></td>
				<td class="name"><?php echo $locale['401']; ?></td>
				<td class="status"><?php echo $locale['402']; ?></td>
				<td class="num"><?php echo $locale['403']; ?></td>
				<td class="links"><?php echo $locale['404']; ?></td>
			</tr>
		</thead>
		<tbody class="connected ui-sortable">
	<?php
			while ($data = dbarray($result)) {
				$article_name = unserialize($data['article_name']);
	?>
			<tr id="listItem_<?php echo $data['article_id']; ?>">
				<td class="list"><img src="<?php echo IMAGES; ?>arrow.png" alt="<?php echo $locale['410']; ?>" class="handle" /></td>
				<td class="name"><a href="<?php echo FUSION_SELF . $aidlink; ?>&action=edit&id=<?php echo $data['article_id']; ?>" title="<?php echo $article_name[LOCALESHORT]; ?>"><?php echo $article_name[LOCALESHORT]; ?></a></td>
				<td class="status">
					<a href="<?php echo FUSION_SELF . $aidlink; ?>&action=status&id=<?php echo $data['article_id']; ?>&status=<?php echo $data['article_status']; ?>" title="<?php echo ($data['article_id'] ? $locale['411'] : $locale['412']); ?>"><img src="<?php echo IMAGES; ?>status/status_<?php echo $data['article_status']; ?>.png" alt="<?php echo ($data['article_id'] ? $locale['411'] : $locale['412']); ?>"></a>
				</td>
				<td class="num"><?php echo $data['article_order']; ?></td>
				<td class="links">
					<a href="<?php echo BASEDIR . $data['seourl_url']; ?>" target="_blank" title="<?php echo $locale['413']; ?>"><img src="<?php echo IMAGES; ?>view.png" alt="<?php echo $locale['413']; ?>"></a>
					<a href="<?php echo FUSION_SELF . $aidlink; ?>&action=edit&id=<?php echo $data['article_id']; ?>" title="<?php echo $locale['414']; ?>"><img src="<?php echo IMAGES; ?>edit.png" alt="<?php echo $locale['414']; ?>"></a>
					<a href="<?php echo FUSION_SELF . $aidlink; ?>&action=del&id=<?php echo $data['article_id']; ?>" title="<?php echo $locale['415']; ?>" onclick="return DeleteOk();"><img src="<?php echo IMAGES; ?>delete.png" alt="<?php echo $locale['415']; ?>"></a>
				</td>
			</tr>

	<?php
			} // db whille
	?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo navigation($pagesay, $settings['articles_per_page'], "article_id", DB_ARTICLES, "article_status='1' && article_date<'". FUSION_TODAY ."'"); ?>
				</td>
			</tr>
		</tfoot>
	</table>

	<script type='text/javascript'>
		function DeleteOk() {
			return confirm('<?php echo $locale['450']; ?>');
		}
	</script>

	<?php
	} else {

		echo "No items";

	} // db query

	} // Yesli Isset Action 


	closetable();
	require_once THEMES."templates/footer.php";
?>
