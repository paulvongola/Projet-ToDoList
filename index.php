<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Créer des liens de connexion et d'enregistrement -->


    <?php 
        if (true) {
    ?>   
            <a href="deco">deco</a>
    <?php 
        } else  {
    ?>
            <a href="co">Co</a>
    <?php 
        } 
    ?>

    <a href="connexion.php" target="" class="button">Connexion</a>
    <a href="./deconnexion.php" target="_blank" class="button">Déconnexion</a>
    <a href="./inscription.php" target="_blank" class="button">Enregistrement</a>

    <!-- les inputs seront dans un formulaire qui enverra les données en POST -->

</body>
</html>