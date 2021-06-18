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
        foreach ($articles as $article) {
        ?>

        <div>
            <h2><a href="../public/index.php?route=article&articleId=<?php echo htmlspecialchars($article->getId()) ?>"><?php echo htmlspecialchars($article->getTitle()); ?></a></h2>
            <p><?php echo htmlspecialchars($article->getContent()); ?></p>
            <p><?php echo htmlspecialchars($article->getAuthor()); ?></p>
            <p>Créé le : <?php echo htmlspecialchars($article->getCreatedAt()); ?></p>
        </div>
        <br>

        <?php
        }
        ?>
    </div>
</body>

</html>