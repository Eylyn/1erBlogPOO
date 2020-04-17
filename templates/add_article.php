<?php $this->title = "Nouvel Article"; ?>
<h1>Mon blog</h1>
<p>En construction</p>
<div>
    <form method="post" action="../public/index.php?route=addArticle">
        <label for="title">Titre</label><br>
        <input type="text" id="title" name="title" pattern="[A-za-zÄÅÇÉÑÖÜáàâäãåçéèêëíìîïñóòôöõúùûü-]{2-255}"><br>
        <label for="content">Contenu</label><br>
        <textarea id="content" name="content" pattern="[A-za-zÄÅÇÉÑÖÜáàâäãåçéèêëíìîïñóòôöõúùûü-]{10}"></textarea><br>
        <label for="author">Auteur</label><br>
        <input type="text" id="author" name="author" pattern="[A-za-zÄÅÇÉÑÖÜáàâäãåçéèêëíìîïñóòôöõúùûü-]{2-255}"><br>
        <input type="submit" value="Envoyer" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>