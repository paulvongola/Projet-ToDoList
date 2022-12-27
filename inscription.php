<?php

//$bdd = new PDO

require_once 'BDD.php';

if (isset($_POST['forminscription'])) { // SI les cases sont vide cette ligne va permettre ou pas d'affirmer si c'est ok ou pas
    if (
        !empty($_POST['pseudo']) &&
        !empty($_POST['email']) &&
        !empty($_POST['email2']) &&
        !empty($_POST['mdp']) &&
        !empty($_POST['mdp2'])
    ) {


        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']); //htmlspecialchars permet d'éviter tous les caractères HTML pour éviter les injections de code
        $mail2 = htmlspecialchars($_POST['email2']);
        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); //méthode pour hashé le MDP
        $mdp2 = password_hash($_POST['mdp2'], PASSWORD_DEFAULT);
        $PasDerreur = 'Informations correctes !';



        $pseudolength = strlen($pseudo);
        if ($pseudolength <= 255) // Vérifie si le nombre caractère dépasse pas les 255
        {
            if ($email == $mail2) // Vérifie si le email de confirmation correspond au email indiquer pour l'inscription
            {
                if (filter_var($email, FILTER_VALIDATE_EMAIL))  // Permet de voir si le 1er email rentré correspond
                {
                    $reqmail = $db->prepare("SELECT * FROM user WHERE email = ?");
                    $reqmail->execute(array($email));
                    $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                        if ($_POST['mdp'] == $_POST['mdp2']) {
                            $insertmembre = $db->prepare("INSERT INTO user(pseudo, email, password) VALUES(?, ?, ?)");
                            $insertmembre->execute(array($pseudo, $email, $mdp)); // pour exécuter la fonction
                            $erreur = "Félicitations ! Tu n'as pas gagner la coupe du monde mais ... Ton compte a été créé ! <a href=\"connexion.php\"Me connecter</a>";
                            //$$_SESSION['comptecree'] = "Félicitations ! Tu n'as pas gagner la coupe du monde mais ... Ton compte a été créé !";

                            header('Location: connexion.php'); // si l'utilisateur est créé il va etre rediriger là
                        } else {
                            $erreur = "Vos mot de passe ne correspondent pas ! Tu es fatigué ?";
                        }
                    } else //Empêche une adresse email identique d'être réutiliser
                    {
                        $erreur = "Adresse e-email déjà utilisée !";
                    }
                }
            } else {
                $erreur = "Vos adresses e-email ne correspondent pas ! Oh !";
            }
        } else {
            $erreur = "Eh, mon ami ! Votre nom d'utilisateur ne doit dépasser 255 caractères, désolé !";
        }
    } else {
        $erreur = 'Tous les champs doivent être remplis';

        // echo "Paul te dit que non, tout n'est pas ok !"; // si on tente de s'inscrire si les cases sont vide
    }

    $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

    if (password_verify('IlovePokemon', $hash)) {
        echo 'Le mot de passe est valide !';
    } else {
        echo 'Le mot de passe est invalide.';
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
        <h3>Inscription</h3>
        <br /><br />

        <form method="POST" action="">
            <table>
                <tr>
                    <td>
                        <label for="pseudo">Nom d'utilisateur :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Nom d'utilisateur" name="pseudo" id="pseudo" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="email">E-Mail :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre email" name="email" id="email" />
                    </td>


                </tr>

                <tr>
                    <td>
                        <label for="email2">Confirmation E-Mail :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Confirmez votre e-email" name="email2" id="email2" />
                    </td>
                </tr>


                <tr>
                    <td>
                        <label for="mdp">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" name="mdp" id="mdp" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="mdp">Confirmation du mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmez votre M.D.P" name="mdp2" id="mdp2" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <br />
                        <div class="bouton-inscription">
                            <input type="submit" name="forminscription" value="Je m'inscris" />
                        </div>
                    </td>
                </tr>

            </table>
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