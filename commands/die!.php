<?php
$commands['die!'] = function(&$conn, $pl, $params) {
	// Don't allow a group message to kill the bot
	if($pl['type'] == "chat") {
		if(strpos($pl['from'],"bpratt") !== false) {
			$conn->message($pl['from'], "/me dies", $pl['type']);
			$conn->disconnect();
		} else {
			$conn->message($pl['from'], "Only my master can kill me!", $pl['type']);
		}
	} else {
		$conn->message($pl['from'], "/me decides not to die.", $pl['type']);
	}
}
?>
