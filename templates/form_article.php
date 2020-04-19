<?php
$route = isset($post) && $post->get('id') ? 'editArticle&articleid='.$post->get('id') : 'addArticle';
$submit = $route === 'addArticle' ? 'Envoyer' : 'Mettre à jour';

?>

<form method="post" action="../public/index.php?route=<?= $route; ?>">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" value="<?=isset($post) ? htmlspecialchars($post->get('title')):''; ?>"><br>
    <?=isset($errors['title']) ? $errors['title']:'';?>
    <label for="content">Contenu</label>
    <textarea name="content" id="content"><?= isset($post) ? htmlspecialchars($post->get('content')):''; ?></textarea><br>
    <?= isset($errors['content']) ? $errors['content']:'';?>
    <label for="author">Auteur</label>
    <input type="text" name="author" id="author" value="<?= isset($post) ? htmlspecialchars($post->get('author')):''; ?>">
    <?= isset($errors['author']) ? $errors['author']:''; ?>
    <input type="submit" value="<?= $submit; ?>" id="submit" name="submit">
</form>

