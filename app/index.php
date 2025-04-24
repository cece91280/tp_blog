<?php
require_once 'includes/dbconnect.php';

$sql = 'SELECT * FROM posts';
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<main>
    <h1>Liste des articles</h1>
    <section>
        <?php foreach ($posts as $post) : ?>
            <article>
                <h2><?= $post['title']; ?></h2>
                <time datetime="<?= $post['created_at']; ?>"><?= $post['created_at']; ?></time>
                <a href="post_details.php?id=<?= $post['id'] ?>">Voir plus</a>
            </article>
        <?php endforeach; ?>
    </section>
</main>
</body>
</html>
