<?php
//Verifier l'existence d'un ID//
if (isset($_GET['id'])) {
//Verifier que l'ID est un nombre entier//
    if (is_numeric($_GET['id'])) {
//Se connecter a la base de donnée//
        require_once 'includes/dbconnect.php';
        $sql = 'SELECT posts.title, posts.created_at  FROM posts LEFT JOIN posts_categories ON posts.id = posts_categories.posts_id WHERE posts_categories.categories_id = :id  ;';
//Preparer notre requete//
        $stmt = $pdo->prepare($sql);
//Binder la variable dynamique//
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
//Executer la requete//
        $stmt->execute();
        $articles = $stmt->fetchAll();
        //recuperation du nom de la catégorie//
        $sql = 'SELECT name  FROM categories WHERE id = :id  ;';
//Preparer notre requete//
        $stmt = $pdo->prepare($sql);
//Binder la variable dynamique//
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
//Executer la requete//
        $stmt->execute();
        $categoryName = htmlspecialchars($stmt->fetchColumn());
    }
}
//Afficher le resultat//
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Article de la catégorie: <?= $categoryName ?> </title>
</head>
<body>
<main>
    <h1>Article de la catégorie: <?= $categoryName ?> </h1>

    <?php if (count($articles) == 0): ?>
        <p>Cette catégorie n'a pas d'article</p>
    <?php else: ?>

        <?php foreach ($articles as $article): ?>
            <article>
                <h2><?= $article['title'] ?></h2>
                <time datetime="<?= $article['created_at'] ?>"><?= $article['created_at'] ?></time>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
    <a href="category.php">Retour vers liste des catégories</a>
</main>
</body>
</html>