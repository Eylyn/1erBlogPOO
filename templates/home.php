<?php


use App\src\DAO\ArticleDAO;
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
    </div>
</body>

</html>