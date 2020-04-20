<?php $this->title = "Incription"; ?>
<h1>Mon Blog</h1>
<p>En construction</p>
<div>
    <form method="post" action="../public/index.php?route=register">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="<?= isset($post) ? htmlspecialchars($post->get('pseudo')):'';?>"><br>
        <?= isset($errors['pseudo']) ? $errors['pseudo'] : ''; ?>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password"><br>
        <?= isset($errors['password']) ? $errors['password']:''; ?>
        <input type="submit" value="Inscription" id="submit" name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>