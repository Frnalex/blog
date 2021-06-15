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
    <title>Blog</title>
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
            <h2><a href="single.php?articleId=<?php echo htmlspecialchars($article['id']) ?>"><?php echo htmlspecialchars($article['title']); ?></a></h2>
            <p><?php echo htmlspecialchars($article['content']); ?></p>
            <p><?php echo htmlspecialchars($article['author']); ?></p>
            <p>Créé le : <?php echo htmlspecialchars($article['createdAt']); ?></p>
        </div>
        <br>

        <?php
        }
        $articles->closeCursor();
        ?>
    </div>
</body>

</html>