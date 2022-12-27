<?php
session_start();
//$bdd = new PDO

require_once 'BDD.php';
if(isset($_GET['id']) && $_GET['id'] > 1)
{

$getid = intval($_GET['id']); 
$requser = $db->prepare('SELECT * FROM user WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch(); // sert à l'affichage des données

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
        <h3>Profil de <?php echo $userinfo['pseudo'];?> </h3> 
        <br /><br />
        Pseudo = <?php echo $userinfo['pseudo'];?>
        <br />
        Mail = <?php echo $userinfo['email'];?>
<?php
        if(isset($_SESSION['id']) && $userinfo['id'] == $_SESSION['id']);
        {
            ?>
            <a href="#"> Editer mon profil</a>
            <a href="deconnexion.php"> Se déconnecter</a>
            <a href="todo.php"> Accéder à ma Todo List</a>

            <?php
        }
        ?>
</body>

</html>
<?php
}
?>