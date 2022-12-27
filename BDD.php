<?php
define('DSN', 'mysql:host=localhost;dbname=todo');
define('USER_NAME','dracaufeu');
define('USER_PASS', 'Ilovepikachu');


try {
    // On va préparer un tableau d'option pour la configuration de l'objet PDO que l'on va créer
    $pdo_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
    $db = new PDO(DSN, USER_NAME, USER_PASS, $pdo_options); // On instancie la classe PDO
    // $db contient un objet qui est une instance de la classe PDO;
} catch (PDOException $exception) {
    // On affiche le message d'erreur !!
    // ATTENTION : on ne fait ça qu'en développement, pas en production
    echo $exception->getMessage();
}
