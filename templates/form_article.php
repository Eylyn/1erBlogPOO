<?php
$route = isset($article) && $article->getId() ? 'editArticle&articleid='.$article->getId() : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';
$title = isset($article) && $article->getTitle() ? htmlspecialchars($article->getTitle()) : '';
$content = isset($article) && $article->getContent() ? htmlspecialchars($article->getContent()) : '';
$author = isset($article) && $article->getAuthor() ? htmlspecialchars($article->getAuthor()) : '';
?>

<form method="post" action="../public/index.php?route=<?= $route; ?>">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" value="<?= $title; ?>"><br>
    <label for="content">Contenu</label>
    <textarea name="content" id="content"><?= $content; ?></textarea><br>
    <label for="author">Auteur</label>
    <input type="text" name="author" id="author" value="<?= $author; ?>">
    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>

