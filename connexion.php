<?php
session_start();
//$bdd = new PDO

require_once 'BDD.php';

if(isset($_POST['formconnexion']))
{
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    // $mdpconnect = password_hash($_POST['mdpconnect'], PASSWORD_DEFAULT);
    $mdpconnect = $_POST['mdpconnect'];

    if(!empty($emailconnect) && !empty($mdpconnect))
    {
        // on récupère le user par son email
        $requser = $db->prepare("SELECT * FROM user WHERE email = ?");
        $requser->execute(array($emailconnect));

        // si on a un user
        $userexist = $requser->fetch();
        if ($userexist)
        {
            // on vérifie son mdp
            if(password_verify($mdpconnect,$userexist['password'])) {

                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                $_SESSION['email'] = $userinfo['email'];
                header("Location: profil.php?id=".$_SESSION);
            }

        } 
    }
    else 
    {
        $erreur = "Tous les champs doivent être complétés ! ";
    }


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div align="center">
        <h3>Connexion</h3>
        <br /><br />

        <form method="POST" action="">
            <input type="email" name="emailconnect" placeholder="Email" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <input type="submit" name="formconnexion" value="Se connecter" />


            
        </form>
        <?php
        if (isset($erreur)) {
            echo "<div class='error'>$erreur</div>";
        } else if (isset($PasDerreur)) {
           echo "<div class='not_error'>$PasDerreur</div>";
        }
        ?>
</body>

</html>