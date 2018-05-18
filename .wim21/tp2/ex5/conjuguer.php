<?php
$terminaisons = array(
"present" => array("e","es","e","ons","ez","ent"),
"futur" => array("erai","eras","era","erons","erez","eront"),
"imparfait" => array("ais","ais","ait","ions","iez","aient")
);
$pronoms=array("je","tu","il","nous","vous","ils");
if (isset($_POST['verbe'])) $verbe = $_POST['verbe'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />

		<link rel="stylesheet" href="https://cdn.concisecss.com/concise.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-utils/concise-utils.min.css">
		<link rel="stylesheet" href="https://cdn.concisecss.com/concise-ui/concise-ui.min.css">
		<link rel="stylesheet" href="./css/style.css">

		<title></title>
	</head>
	<body container class="_ps">

	</body>
</html>
