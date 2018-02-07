<?php
require_once 'lib/common.php';
session_start();

if (empty($_GET['id'])) {
	header('Location: article_list.php');
	exit();
}

$db = initDatabase();
$article = $db->query("SELECT * FROM article WHERE id=" . $_GET['id'])
               ->fetch(PDO::FETCH_OBJ);

$article->comments = $db->query("SELECT c.*, u.login, u.url "
								. "FROM comment c JOIN user u ON c.id_user=u.id"
								. " WHERE id_article=" . $_GET['id'])
                        ->fetchAll(PDO::FETCH_OBJ);

?>
<?php 
include 'templates/header.php';
?>
<body container>

<h1>Article</h1>

<?php

echo '<div  id="article">'
	. '<h3>'. $article->title .'</h3>'
	. '<div id="content">' . $article->content . '</div>';

echo '<h5 class="_bb1">Commentaires</h5>';
if (empty($article->comments)) {
	echo '<p>Aucun</p>';
} else {
	foreach ($article->comments as $comment) {
		echo '<section class="alert-box">';
		echo		 "<b class='_ts2'>".$comment->title."</b>"
			. (isset($_SESSION['user']->id) && $comment->id_user == $_SESSION['user']->id ?
			' <a href="comment_create.php?id_article=' . $comment->id_article
			. '&amp;id_comment=' . $comment->id . '" title="'. $comment->title
			. '">Modifier ce commentaire</a>' :
			'')
			. '<p class="_ts2">' . $comment->content ."</p>"
			.  "<p><span class='tag-box -warning'><a href=\"$comment->url\">$comment->login</a></p>";
		echo "</section>";
	}
}
echo "</div>";

if (empty($_SESSION['user'])) {
	echo '<p>Il faut être identifié pour poster un commentaire.</p>';
} else {
	if ($article->closed) {
		echo "<p>Article fermé, non modifiable.</p>";
	} else {
		echo '<p> <a href="comment_create.php?id_article='. $article->id
			.'">Ajouter un commentaire</a> avec votre compte : ' . $_SESSION['user']->name
			.' </p>';
	}
}
?>

<p> <a href="article_list.php">Retour à la liste des articles</a> </p>

<?php
include './templates/footer.php';
?>

</body>
</html>
