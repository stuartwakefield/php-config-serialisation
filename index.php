<?php
function array_url_pairs($source) {
	$result = array();
	$pairs = explode('&', http_build_query($source));
	foreach($pairs as $pair) {
		$pos = strpos($pair, '=');
		$value = '';
		if ($pos === false) {
			$key = $pair;
		} else {
			$remaining = substr($pair, $pos + 1);
			$key = urldecode(substr($pair, 0, $pos));
			if ($remaining !== false) {
				$value = $remaining;
			}
		}
		$result[] = array(urldecode($key), urldecode($value));
	}
	return $result;
}

function render_hidden_inputs($data) {
	$pairs = array_url_pairs($data);
	$inputs = array();
	foreach($pairs as $pair) {
		$name = htmlspecialchars($pair[0]);
		$value = htmlspecialchars($pair[1]);
		$inputs[] = "<input type=\"hidden\" name=\"$name\" value=\"$value\"/>";
	}
	return implode($inputs);
}

$a = array(
	'siteId' => 'news',
	'forumId' => 'news_1234',
	'preset' => 'responsive'
);

$b = array(
	'siteId' => 'sport',
	'forumId' => 'sport_1234',
	'preset' => 'responsive',
	'ratings' => false
);

$aParamPairs = array_url_pairs(array('config' => $a));
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="lib/jquery-1.9.1.min.js"></script>
		<script src="lib/module.js"></script>
	</head>
	<body>
		<div class="module" data-config="<?= htmlspecialchars(json_encode($a)) ?>">
			<form action="post.php" method="post">
				<?= render_hidden_inputs(array('config' => $a)) ?>
				<textarea name="comment" placeholder="Enter your comment"></textarea>
				<button type="submit">Post</button>
			</form>
			<a class="module-trigger" href="">Trigger</a>	
		</div>
		<div class="module" data-config="<?= htmlspecialchars(json_encode($b)) ?>">
			<form action="post.php" method="post">
				<?= render_hidden_inputs(array('config' => $a)) ?>
				<textarea name="comment" placeholder="Enter your comment"></textarea>
				<button type="submit">Post</button>
			</form>
			<a class="module-trigger" href="">Trigger</a>
		</div>
	</body>
</html>
