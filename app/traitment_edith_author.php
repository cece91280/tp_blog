<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $id = $_POST['id'];

    if (empty($lastname) || empty($firstname) || empty($email)) {
        die("Veuillez remplir tous les champs");
    }
    if (strlen($lastname) > 100 || strlen($firstname) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL) || !is_numeric($id)) {
        die('au moins un champs est invalide');
    }
    require_once 'includes/dbconnect.php';

    $sql = 'UPDATE authors SET lastname = :lastname, firstname = :firstname, email = :email WHERE id = :id';
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':lastname', $lastname PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    $exec = $stmt->execute();
    if ($exec) {
        echo 'La modification a bien étais effectuer';
    }
}