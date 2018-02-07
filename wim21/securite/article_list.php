<?php
require_once 'lib/common.php';
session_start();

$db = initDatabase();
$articles = $db->query("SELECT * FROM article")->fetchAll(PDO::FETCH_OBJ);

?>

<?php
include './templates/header.php';
?>

<body container>

<h1>Liste des articles</h1>

<?php
if (!empty($_SESSION['user'])) {
	echo "<p>Bonjour, " . $_SESSION['user']->name . ".</p>";
}
?>

<ul>
<?php
foreach ($articles as $article) {
	echo '<li><a href="article_view.php?id=' . $article->id .'">'
		. $article->title . "</a></li>\n";
}
?>
</ul>

<?php
include './templates/footer.php';
?>

</body>
</html>
