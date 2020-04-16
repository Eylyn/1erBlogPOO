<?php
require '../vendor/autoload.php';

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Mon blog</title>
</head>

<body>
    <div>
        <h1>Mon Blog</h1>
        <p>En construction</p>
        <?php
        $article = new \App\src\DAO\ArticleDAO();
        $articles = $article->getArticle($_GET['articleid']);
        $article = $articles->fetch()
        ?>
        <div>
            <h2><?= htmlspecialchars($article->title); ?> </h2>
            <p><?= htmlspecialchars($article->content); ?></p>
            <p><?= htmlspecialchars($article->author); ?></p>
            <p>Créé le : <?= htmlspecialchars($article->createdAt) ?></p>
        </div>
        <br>
        <?php
        $articles->closeCursor();
        ?>
        <a href="home.php">Retour à l'accueil</a>
        <div id='comments' class="text-left" style="margin-left: 50px">
            <h3>Commentaires</h3>
            <?php
            $comment = new \App\src\DAO\CommentDAO();
            $comments = $comment->getCommentsFromArticle($_GET['articleid']);

            while ($comment = $comments->fetch()) {
            ?>
                <h4><?= htmlspecialchars($comment->pseudo); ?></h4>
                <p><?= htmlspecialchars($comment->content); ?></p>
                <p>Posté le <?= htmlspecialchars($comment->createdAt); ?></p>
            <?php
            }
            $comments->closeCursor();
            ?>
        </div>
    </div>
</body>

</html>