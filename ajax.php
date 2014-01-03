<?php
$config = $_GET['config'];
$data = array(
	'html' => "<div class=\"return\">{$config['siteId']}/{$config['forumId']}</div>"
);
echo json_encode($data);
