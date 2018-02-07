<?php
require_once 'lib/common.php';
session_start();

$db = initDatabase();

if (empty($_REQUEST['id_article'])) {
	header('Location: article_list.php');
	exit();
}
if (!empty($_GET['title']) && !empty($_GET['content'])) {
	$title = $_GET['title'];
	$content = $_GET['content'];
	if (empty($_GET['id_comment'])) { // nouveau ou modif ?
		$sql = "INSERT INTO comment (id_article, title, content, id_user) "
			."VALUES (".$_GET['id_article'].", '$title', '$content', ".$_SESSION['user']->id.")";
	} else {
		$sql = "UPDATE comment SET title='$title', content='$content', id_user=". $_SESSION['user']->id
			." WHERE id = " . $_GET['id_comment'];
	}
	if ($db->query($sql)) {
		header('Location: article_view.php?id=' . $_GET['id_article']);
		exit();
	} else {
		die("Erreur  : $sql");
	}
}
?>
<?php
include './templates/header.php';
?>
<body container>

<h1>Ajouter/modifier un commentaire</h1>
<form action="" method="get">
<fieldset>
<?php if (!empty($_REQUEST['id_comment'])) {
echo '<input name="id_comment" type="hidden" value="' . $_REQUEST['id_comment'] ."\" />\n";
} ?>
		<input name="id_article" type="hidden" value="<?php echo $_REQUEST['id_article']; ?>" />
<div><label>        Titre  <input name="title" type="text" value="" size="60" /></label></div>
<div> <label>       Texte  <textarea name="content" cols="60" rows="6"></textarea></label></div>
		<button type="submit" name="ok" value="1">Ajouter ce commentaire</button>
</fieldset>
</form>
<?php
	include './templates/footer.php';
?>
</body>
</html>
