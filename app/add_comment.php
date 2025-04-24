<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"], $_POST["conteneur"]) && is_numeric($_POST['id'])) {
        require_once "includes/dbconnect.php";
        $sql = 'INSERT INTO comments (posts_id, content) VALUES (:id, :conteneur, NOW());';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $stmt->bindValue(':conteneur', $_POST['conteneur'], PDO::PARAM_STR);
        $stmt->execute();

        header("Location: post_details.php?id={$_POST['id']}");
        exit;
    }else{
        echo 'Erreur : données incorrectes';
    }
}