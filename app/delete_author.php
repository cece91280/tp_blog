<?php
// echo $_GET['id'];
//On test si l'ID existe
if(isset($_GET['id'])) {
    //On s'assure que l'id est bien numerique
    if (is_numeric($_GET['id'])) {
        //On se connecte a la base des donnees

        require_once 'includes/dbconnect.php';
        //Recuperer tous les posts de l'auteur
        $sql = 'SELECT id FROM posts WHERE authors_id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        $stmt->execute();

        $posts = $stmt->fetchAll();
        //   var_dump($posts);
        //   die();
        //Parcourir les posts
        foreach ($posts as $post) {
            //Supprimer les commentaires
            $query = 'DELETE FROM comments WHERE posts_id = :id';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $post['id'], PDO::PARAM_INT);
            $exec = $stmt->execute();

            //Supprimer les posts-categories

            $query = 'DELETE FROM posts_categories WHERE posts_id = :id';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $post['id'], PDO::PARAM_INT);
            $exec = $stmt->execute();

            //Supprimer le post (literation des posts)
            $query = 'DELETE FROM posts WHERE id = :id';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $post['id'], PDO::PARAM_INT);
            $exec = $stmt->execute();
        }


        // On prépare la requête de suppresion de l'auteur
        $query = 'DELETE FROM authors WHERE id = :id';
        $stmt = $pdo->prepare($query);

        // On relie les valuers des dy formulaires aux parametres SQL
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        //PDO ::execute - Exécute une requête préparée
        // On exécute la requête
        $exec = $stmt->execute();

        // On redirige l'utilisateur vers la page d'accueil
        if ($exec) {
            echo 'l\'auteur a bien été supprimé';
        }
    }
}