<?php
require 'Database.php';
require 'Article.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Mon blog</h1>

    <?php
    $article = new Article();
    $articles = $article->getArticle($_GET['articleId']);
    $article = $articles->fetch()

    ?>
    <div>
        <h2><?= htmlspecialchars($article['title']); ?></h2>
        <p><?= htmlspecialchars($article['content']); ?></p>
        <p><?= htmlspecialchars($article['author']); ?></p>
        <p>Créé le : <?= htmlspecialchars($article['createdAt']); ?></p>
    </div>
    <br>
    <?php
    $articles->closeCursor();
    ?>

    <a href="home.php">Retour à l'accueil</a>

</body>

</html>