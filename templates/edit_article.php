<?php $this->title = "Modifier l'article";?>

<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <form method="post" action="../public/index.php?route=editArticle&articleid=<?=htmlspecialchars($article->getId());?>">
        <label for="title">Titre</label><br>
        <input type="text" id="title" name="title" value="<?=htmlspecialchars($article->getTitle());?>"><br>
        <label for="content">Contenu</label>
        <textarea name="content" id="content" ><?=htmlspecialchars($article->getContent());?></textarea><br>
        <label for="author">Auteur</label>
        <input type="text" id="author" value="<?=htmlspecialchars($article->getAuthor());?>"><br>
        <input type="submit" name="submit" id="submit" value="Mettre à jour">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>