<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (is_numeric($_GET['id'])) {
        require_once 'includes/dbconnect.php';
        $author_id = $_GET['id'];
        $sql = 'SELECT posts.title, posts.created_at, authors.lastname, authors.firstname FROM authors LEFT JOIN posts ON posts.authors_id = authors.id WHERE authors.id = :id;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $author_id, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll();
        $authorLastname = $posts[0]['lastname'];
        $authorFirstname = $posts[0]['firstname'];
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article écris par <?= $authorLastname ?> <?= $authorFirstname ?></title>
</head>
<body>
<main>
    <h1>Article écrit par <?= $authorLastname ?> <?= $authorFirstname ?></h1>
    <?php if (!isset($posts[0]['title'])): ?>
        <p>Cet auteur n'a pas d'article</p>
    <?php else: ?>

        <?php foreach ($posts as $post): ?>
            <article>
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <time datetime="<?= $post['created_at'] ?>"><?= $post['created_at'] ?></time>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
</body>
</html>
