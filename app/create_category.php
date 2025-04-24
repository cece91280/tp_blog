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
<h1>Ajouter une catégorie</h1>
<form action="traitment_category.php" method="post">
    <div>
        <label for="name"> nom de la catégorie :</label>
        <input type="text" name="name" id="name" >
    </div>
    <div>
        <label for="description">Description :</label>
        <input type="text" name="description" id="description" >
    </div>
    <button type="submit">Ajouter</button>
</form>
</main>
</body>
</html>