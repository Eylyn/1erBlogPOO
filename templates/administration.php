<?php $this->title = 'Administration'; ?>

<h1>Mon blog</h1>
<p>En construction</p>
<?= $this->session->show('add_article'); ?>
<?= $this->session->show('edit_article'); ?>
<?= $this->session->show('delete_article'); ?>
<?= $this->session->show('unflag_comment'); ?>
<h2>Articles</h2>
<a href="../public/index.php?route=addArticle">Nouvel article</a>
<table>
    <tr>
        <td>Id</td>
        <td>Titre</td>
        <td>Contenu</td>
        <td>Auteur</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($articles as $article) {
    ?>
        <tr>
            <td><?= htmlspecialchars($article->getId()); ?></td>
            <td><a href="../public/index.php?route=article&articleid=<?= htmlspecialchars($article->getId()); ?>"><?= htmlspecialchars($article->getTitle()); ?></a></td>
            <td><?= substr(htmlspecialchars($article->getContent()), 0, 150); ?></td>
            <td><?= htmlspecialchars($article->getAuthor()); ?></td>
            <td>Créé le : <?= htmlspecialchars($article->getCreatedAt()); ?></td>
            <td>
                <a href="../public/index.php?route=editArticle&articleid=<?= $article->getId(); ?>">Modifier</a>
                <a href="../public/index.php?route=deleteArticle&articleid=<?= $article->getId(); ?>">Supprimer</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<h2>Commentaires signalés</h2>
<table>
    <tr>
        <td>Id</td>
        <td>Pseudo</td>
        <td>Message</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>
    <?php
    foreach ($comments as $comment) {
    ?>
        <tr>
            <td><?= htmlspecialchars($comment->getId()); ?></td>
            <td><?= htmlspecialchars($comment->getPseudo()); ?></td>
            <td><?= substr(htmlspecialchars($comment->getContent()), 0, 150); ?></td>
            <td>Créé le : <?= htmlspecialchars($comment->getCreatedAt()); ?></td>
            <td>
                <a href="../public/index.php?route=unflagComment&commentid=<?= $comment->getId(); ?>">Désignaler le commentaire</a>
                <a href="../public/index.php?route=deleteComment&commentid=<?= $comment->getId(); ?>">Supprimer le commentaire</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<h2>Utilisateurs</h2>

<a href="../public/index.php">Retour à l'accueil</a>