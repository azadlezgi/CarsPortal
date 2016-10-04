<?php

if (!defined("IN_FUSION")) { die("Access Denied"); }

include LOCALE.LOCALESET."infusions/member_poll_panel.php";

if (isset($_POST['cast_vote']) && 
	(isset($_POST['poll_id']) && isnum($_POST['poll_id'])) && 
		(isset($_POST['voteoption']) && isnum($_POST['voteoption']))) { // bug #1010
	$result = dbquery("SELECT
																	v.vote_ip,
																	v.vote_id,
																	p.poll_opt_0,
																	p.poll_opt_1,
																	p.poll_opt_2,
																	p.poll_opt_3,
																	p.poll_opt_4,
																	p.poll_opt_5,
																	p.poll_opt_6,
																	p.poll_opt_7,
																	p.poll_opt_8,
																	p.poll_opt_9,
																	p.poll_started,
																	p.poll_ended
		FROM ". DB_POLLS ." p 
		LEFT JOIN ". DB_POLL_VOTES ." v ON p.poll_id = v.poll_id
		WHERE p.poll_id='". $_POST['poll_id'] ."'
		ORDER BY v.vote_id");
	if (dbrows($result)) {
		$voters = array();
		while($pdata = dbarray($result)) {
			$voters[] = $pdata['vote_ip'];
			$data     = $pdata;
		}
		if (($data['poll_started'] < time() && ($data['poll_ended'] == 0)) && (empty($voters) || !in_array(FUSION_IP, $voters)) && !empty($data["poll_opt_".$_POST['voteoption']])) { // bug #1010
			$result = dbquery("INSERT INTO ". DB_POLL_VOTES ." (
																	vote_ip,
																	vote_opt,
																	poll_id
			) VALUES (
																	'". FUSION_IP ."',
																	'". $_POST['voteoption'] ."',
																	'". $_POST['poll_id'] ."'
			)");
		}
	}
	redirect(FUSION_URI);
}

openside($locale['infusions_mpoll_130']);
$result = dbquery("SELECT
								poll_id,
								poll_title,
								poll_opt_0,
								poll_opt_1,
								poll_opt_2,
								poll_opt_3,
								poll_opt_4,
								poll_opt_5,
								poll_opt_6,
								poll_opt_7,
								poll_opt_8,
								poll_opt_9,
								poll_started,
								poll_ended
FROM ". DB_POLLS ."
ORDER BY poll_started DESC LIMIT 1");
if (dbrows($result)) {
	$data = dbarray($result);
	$poll_title = $data['poll_title'];
	$poll_option = array();
	for ($i = 0; $i <= 9; $i++) {
		if ($data["poll_opt_".$i]) $poll_option[$i] = $data["poll_opt_".$i];
	}
	$result2 = dbquery("SELECT * FROM ". DB_POLL_VOTES ." WHERE vote_ip='". FUSION_IP ."' AND poll_id='". $data['poll_id'] ."'");
	if (!dbrows($result2) && $data['poll_ended'] == 0) {
		$poll = ""; $i = 0; $num_opts = count($poll_option);
		while ($i < $num_opts) {
			$poll .= "<label><input type='radio' name='voteoption' value='". $i ."' />". $poll_option[$i] ."</label><br />\n";
			$i++;
		}
		echo "<form name='voteform' method='post' action='". FUSION_URI ."'>\n";
		echo "<strong>". $poll_title ."</strong><br /><br />\n";
		echo $poll;
		echo "<div style='text-align:center'><input type='hidden' name='poll_id' value='". $data['poll_id'] ."' />\n";
		echo "<br /><input type='submit' name='cast_vote' value='". $locale['infusions_mpoll_131'] ."' class='button' />";
		echo "</div>\n</form>\n";
	} else {
		$poll =  ""; $i = 0; $num_opts = count($poll_option);
		$poll_votes = dbcount("(vote_opt)", DB_POLL_VOTES, "poll_id='".$data['poll_id']."'");
		while ($i < $num_opts) {
			$num_votes = dbcount("(vote_opt)", DB_POLL_VOTES, "vote_opt='$i' AND poll_id='".$data['poll_id']."'");
			$opt_votes = ($poll_votes ? number_format(100 / $poll_votes * $num_votes) : 0);
			$poll .= "<div>".$poll_option[$i]."</div>\n";
			$poll .= "<div style='border:1px solid silver; height:12px;'><img src='/".get_image("pollbar")."' alt='".$poll_option[$i]."' height='12' width='".$opt_votes."' class='poll' /></div>\n";
			$poll .= "<div>".$opt_votes."% [".$num_votes." ".($num_votes == 1 ? $locale['infusions_mpoll_133'] : $locale['infusions_mpoll_134'])."]</div><br />\n";
			$i++;
		}
		echo "<strong>".$poll_title."</strong><br /><br />\n".$poll;
		echo "<div style='text-align:center'>".$locale['infusions_mpoll_135'].$poll_votes."<br />\n";
		// if (!iMEMBER) {
		// 	echo $locale['infusions_mpoll_132']."<br />";
		// }
		echo $locale['infusions_mpoll_136'].showdate("shortdate", $data['poll_started']);
		if ($data['poll_ended'] > 0) {
			echo "<br />\n".$locale['infusions_mpoll_137'].showdate("shortdate", $data['poll_ended'])."\n";
		}
		$result = dbcount("(poll_id)", DB_POLLS);
		if ($result > 1) {
			echo "<br /><br /><a href='". BASEDIR ."polls_archive.php' class='side'>".$locale['infusions_mpoll_138']."</a>\n";
		}
		echo "</div>\n";
	}
} else {
	echo "<div style='text-align:center'>".$locale['infusions_mpoll_142']."</div>\n";
}
closeside();
?>