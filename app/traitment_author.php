<?php
// On vérifie si on utilise la bonne méthode pour le formulaire.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $email = $_POST['email'];
    if (empty($lastname) || empty($firstname) || empty($email)) {
        die("Veuillez remplir tous les champs");
    }

    // on vérifie si le nom ou le prénom correspond à la longueur de la base de données est si l'email est valide (sa
    // structure).//
    if (strlen($lastname) > 100 || strlen($firstname) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('au moins un champs est invalide');
    }

    // Toutes les vérifications sont validés, on peut enregistrer l'auteur dans la base de données.
    require_once "includes/dbconnect.php";
    $sql = 'INSERT INTO authors (lastname, firstname, email) VALUES(:lastname, :firstname, :email);';

    // On prépare la requête.
    $stmt = $pdo->prepare($sql);

    // On relie ou on attache les valeurs du formulaire au paramètre sql.
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    // On éxecute la requête.
    $exec = $stmt->execute();
    if ($exec) {
       echo 'auteur ajouté avec succès';
    }


}