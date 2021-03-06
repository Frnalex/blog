<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/main.css">
</head>

<body class="admin">

    <main class="main">
        <div class="container">
            <?php echo $content ?>
        </div>
    </main>

    <script src="/js/script.js"></script>
</body>

</html>