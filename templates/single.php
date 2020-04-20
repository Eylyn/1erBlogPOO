<?php $this->title = "Article"; ?>

<h1>Mon Blog</h1>
<p>En construction</p>
<div>
    <h2><?= htmlspecialchars($article->getTitle()); ?> </h2>
    <p><?= htmlspecialchars($article->getContent()); ?></p>
    <p><?= htmlspecialchars($article->getAuthor()); ?></p>
    <p>Créé le : <?= htmlspecialchars($article->getCreatedAt()) ?></p>
</div>
<br>
<div class="actions">
    <a href="../public/index.php?route=editArticle&articleid=<?= $article->getId(); ?>">Modifier</a>
    <a href="../public/index.php?route=deleteArticle&articleid=<?= $article->getId(); ?>">Supprimer</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>
<div id='comments' class="text-left" style="margin-left: 50px">
    <h3>Ajouter un commentaire</h3>
    <?php include('form_comment.php'); ?>
    <h3>Commentaires</h3>
    <?php
    foreach ($comments as $comment) {
    ?>
        <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
        <p><?= htmlspecialchars($comment->getContent()); ?></p>
        <p>Posté le <?= htmlspecialchars($comment->getCreatedAt()); ?></p>
    <?php
    }
    ?>
</div>