<?php
$commands['github'] = function(&$conn, $event, $params) {
	if (!empty($params[0])) {
		if(!empty($params[1])) {
			// Get last commit from repo
			$response = curl_get_contents("https://api.github.com/repos/" . $params[0] . "/" . $params[1] . "/commits","alanaktion");
			if(!$response = json_decode($response)) {
				$conn->message($event['from'], "Unable to load repository.", $event['type']);
				return;
			}
			if(is_array($response) && !empty($response[0]->commit)) {
				$commit = $response[0]->commit;
				$conn->message($event['from'], "Last commit:\n" . $commit->author->name . ": " . $commit->message . "\n" . $response[0]->html_url, $event['type']);
			} else {
				$conn->message($event['from'], $params[0] . "/" . $params[1] . " has no visible commits!", $event['type']);
			}
		} else {
			// Get repo list
			$response = json_decode(curl_get_contents("https://api.github.com/users/" . $params[0] . "/repos","alanaktion"));
			$str = $params[0] . "'s repositories:";
			if(!empty($response) && is_array($response)) {
				foreach($response as $repo) {
					$str .= "\n" . $repo->name . " - " . $repo->description;
				}
				$conn->message($event['from'], $str, $event['type']);
			} else {
				$conn->message($event['from'], "User not found, or has no visible repositories.", $event['type']);
			}
		}
	} else {
		$conn->message($event['from'], "Usage: #github <username> [repository]", $event['type']);
	}
}
?>