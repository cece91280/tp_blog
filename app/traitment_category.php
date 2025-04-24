<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));

    if (empty($name)){
        die('Veuillez remplir le champ name.');
    }
    if (strlen($name) > 50 || strlen($description) > 255) {
        die('Au moins un champs est invalide');
    }

    require_once "includes/dbconnect.php";

    $sql = 'INSERT INTO categories (name, description) VALUES (:name, :description);)';

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':name', $name, PDO::PARAM_STR);

    $stmt->bindValue(':description', $description, PDO::PARAM_STR);

    $exec = $stmt->execute();
    if ($exec) {
        echo 'categories ajoutée avec succès';
    }
}