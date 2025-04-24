<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<main>
    <h1>Ajouter un Auteur</h1>
    <form action="traitment_author.php" method="post">
        <div>
            <label for="lastname"> Nom de l'auteur :</label>
            <input type="text" name="lastname" id="lastname" >
        </div>
        <div>
            <label for="firstname">Prénom de l'auteur :</label>
            <input type="text" name="firstname" id="firstname" >
        </div>
        <div>
            <label for="email"></label>
            <input type="text" name="email" id="email" >
        </div>

        <button type="submit">Ajouter</button>
    </form>
</main
</body>
</html>
