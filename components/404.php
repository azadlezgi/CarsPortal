<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."404.php";

header("HTTP/1.0 404 Not Found");

set_title($locale['title']);
set_meta("description", $locale['description']);
set_meta("keywords", $locale['keywords']);

opentable( $locale['h1'] );
?>
	<div class='error404'>
		<img src='/<?php echo IMAGES; ?>404.png' alt='<?php echo $locale['500']; ?>'>
	</div>
<?php
closetable();
?>