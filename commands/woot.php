<?php
$commands['woot'] = function(&$conn, $pl, $params) {
	$conn->message($pl['from'], "http://x.co/wootlight", $pl['type']);
}
?>
