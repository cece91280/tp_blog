<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $id = $_POST['id'];

    if (empty($name) || empty($id)){
        die('Veuillez remplir le champ name.');
    }
    if (strlen($name) > 50 || strlen($description) > 255 || is_numeric($id)) {
        die('Au moins un champs est invalide');
    }
    require_once "includes/dbconnect.php";

    $query = 'UPDATE categories SET name = :name, description = :description WHERE id = :id;';

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $execute = $stmt->execute();
    if ($execute){
        echo 'La modification a bien étais effectuer';
    }
}