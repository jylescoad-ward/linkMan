<link href="assets/main.css" rel="stylesheet" type="text/css" />
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$currentStatus = "Loading";
	$linksJSON = json_decode(file_get_contents("links.json"));
	$linksHTML = "";

	if (ISSET($_GET['p'])) {
		$p = $_GET['p'];
		foreach($linksJSON as $json) {
			if ($json->data === $p){
				$currentStatus = "Redirecting to '".$json->name."'";
				header('Location: '.$json->destination);
				die();
			}
			print_r($json);
		}
	}

	foreach($linksJSON as $json) {
		$addString = "<li><a href='https://u.jyles.club/?p=".$json->data."'>".$json->name."</a></li>";
		$linksHTML=$linksHTML.$addString;
		$currentStatus = "Links";
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>u.jyles.club</title>
	</head>
	<body>
		<div class="container">
			<h1>u.jyles.club</h3>
			<code><?php echo $currentStatus; ?></code>
			<div class="links">
				<ul>
					<?php echo $linksHTML; ?>
				</ul>
			</div>
		</div>
	</body>
</html>