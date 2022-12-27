<?php
session_start();
//$bdd = new PDO

require_once 'BDD.php';
if(isset($_SESSION['id']))
{

$requser = $db-> prepare("SELECT * FROM user WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();


// sert à mettre à jour le pseudo

if(isset($_POST['newpseudo']) && !empty($_POST['newpseudo']) && $_POST ['newpseudo'] != $user['pseudo'] )
{
    $newpseudo = htmlspecialchars($_POST['newpseudo']);
    $insertpsuedo = $db->prepare("UPDATE user SET pseudo = ? WHERE id");
    $insertpsuedo->execute(array($newpseudo, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
}

// sert à mettre à jour le mail

if(isset($_POST['newemail']) && !empty($_POST['newemail']) && $_POST ['newemail'] != $user['email'] )
{
    $newemail = htmlspecialchars($_POST['newemail']);
    $insertpsuedo = $db->prepare("UPDATE user SET email = ? WHERE id");
    $insertpsuedo->execute(array($newpseudo, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div align="center">
        <h3>Edition de mon profil</h3> 
        <form method="=POST" action="">
            <label>Pseudo :</label>
            <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>"<br /><br />
            <label>Email :</label>
            <input type="text" name="newemail" placeholder="Email" value="<?php echo $user['email']; ?>"<br /><br />
            <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
            <label>Confirmation - mot de passe</label>
            <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe"/><br /><br />
            <input type="submit" value="Mettre à jour mon profil"><br /><br />






        </form>
    
</body>

</html>
<?php
}
else
{
    header("Location: connexion.php");
}
?>