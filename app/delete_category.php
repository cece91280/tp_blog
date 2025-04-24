<?php
// echo $_GET['id'];
//On test si l'ID existe
if (isset($_GET['id'])) {
    //On s'assure que l'id est bien numerique
    if (is_numeric($_GET['id'])) {
        //On se connecte a la base des donnees
        require_once 'includes/dbconnect.php';
        //On supprime les relations entre les posts et la categorie qu'on veut supprimer
        $query = 'DELETE FROM posts_categories WHERE categories_id = :id';
        $stmt = $pdo->prepare($query);


        // On relie les valuers des dy formulaires aux parametres SQL
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        //PDO ::execute - Exécute une requête préparée
        // On exécute la requête
        $exec = $stmt->execute();

        //On supprime la categorie
        $query = 'DELETE FROM categories WHERE id = :id';
        $stmt = $pdo->prepare($query);


        // On relie les valuers des dy formulaires aux parametres SQL
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

        //PDO ::execute - Exécute une requête préparée
        // On exécute la requête
        $exec = $stmt->execute();
        // On redirige l'utilisateur vers la page d'accueil
        if ($exec) {
            echo 'la categorie a bien été supprimée';
        }
    }
}
