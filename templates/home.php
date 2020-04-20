<?php $this->title = 'Accueil'; ?>

<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('edit_article'); ?>
<?= $this->session->show('delete_article'); ?>
<?= $this->session->show('add_comment'); ?>
<?= $this->session->show('flag_comment'); ?>
<a href="../public/index.php?route=addArticle">Nouvel article</a>
<?php
foreach ($articles as $article) {
?>
    <div>
        <h2><a href="../public/index.php?route=article&articleid=<?= htmlspecialchars($article->getId()); ?>"><?= htmlspecialchars($article->getTitle()); ?></a></h2>
        <p><?= htmlspecialchars($article->getContent()); ?></p>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
        <p>Créé le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
    </div>
    <br>
<?php
}
?>