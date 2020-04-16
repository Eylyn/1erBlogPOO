<?php
//On inclut le fichier dont on a besoin (ici à la racine de notre site)
require 'Database.php';
//Ne pas oublier d'ajouter le fichier Article.php
require 'Article.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Mon blog</title>
</head>

<body>
    <div>
        <h1>Mon blog</h1>
        <p>En construction</p>
        <?php
        $article = new Article();
        $articles = $article->getArticles();
        while ($article = $articles->fetch()) {
        ?>
            <div>
                <h2><a href="single.php?articleid=<?=htmlspecialchars($article->id);?>"><?= htmlspecialchars($article->title); ?></a></h2>
                <p><?= htmlspecialchars($article->content); ?></p>
                <p><?= htmlspecialchars($article->author); ?></p>
                <p>Créé le : <?= htmlspecialchars($article->createdAt); ?></p>
            </div>
            <br>
        <?php
        }
        $articles->closeCursor();
        ?>
    </div>
</body>

</html>