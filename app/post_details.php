<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];
    require_once 'includes/dbconnect.php';
    $sql = 'SELECT posts.*, authors.firstname, authors.lastname FROM posts JOIN authors ON posts.authors_id = authors.id WHERE posts.id = :posts_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':posts_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch();
    $sql = 'SELECT * FROM comments WHERE posts_id = :posts_id ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':posts_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll();
    if(!$post){
        die('Post introuvable');
    }
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
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
<header><a href="index.php">Accueil</a></header>
<main>
    <section>
    <h1><?= htmlspecialchars($post['title']) ?></h1>

    <div>
    <?= $post['content'] ?>
    </div>
    <div>
    <p><strong>Auteur :</strong><?= htmlspecialchars($post['firstname'])?> <?= htmlspecialchars($post['lastname'])?></p>
    <time datetime="<?=$post['created_at']?>"><?=$post['created_at']?></time>
    </div>
    </section>
    <section>
        <h2>Laisser un commentaire</h2>
        <form action="add_comment.php" method="post">
            <input type="hidden" name="id" value="<?=htmlspecialchars($post['id'])?>">

            <label for="conteneur">Commentaire</label>
            <input type="textarea" name="conteneur" id="conteneur" cols="70" rows="10" placeholder="écrire içi">

            <button type="submit">Envoyer</button>
        </form>
        <div>
            <?php foreach ($comments as $comment): ?>
                <p><?=$comment['content']?></p>
                <time datetime="<?= $comment['created_at']?>"><?= $comment['created_at']?></time>
            <?php endforeach; ?>
        </div>
    </section>


</main>
</body>
</html>
