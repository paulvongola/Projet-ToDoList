--le fichier permettant la création de la base de donnée, et des tables (et d'un utilisateur MySQL)

-- Création de la base profile (si elle n'existe pas déjà)
CREATE DATABASE IF NOT EXISTS todo; 

-- Créer un utlisateur MySQL pour cette application 
CREATE USER IF NOT EXISTS 'dracaufeu'@'localhost' IDENTIFIED BY 'Ilovepikachu'; 

-- Pour modifier le mot de passe d'un utilisateur MySQL (si on l'a perdu par exemple). A faire depuis le compte root. 
-- ALTER USER batman@localhost IDENTIFIED BY 'NewPassword'; 

-- Gestion des droits : 
-- On accorde tous les droits à l'utilisateur batman sur la base profile 

GRANT ALL PRIVILEGES ON dracaufeu.* TO dracaufeu@localhost;

USE todo; -- On se positionne sur la base 'profile'

-- Création de la table utilisateur 

CREATE TABLE user ( 
    id INT AUTO_INCREMENT, 
    email VARCHAR(100) NOT NULL, -- email est une chaîne de caractère de longueur variable (jusqu'à 100 caractères max)
    password VARCHAR(255) NOT NULL,  -- la valeur de cette colonne doit être renseignée  
    pseudo VARCHAR(30),
    -- On indique quelle est la clé primaire : 
    PRIMARY KEY (id)
); 


CREATE TABLE tasks ( 
    id INT AUTO_INCREMENT, 
    name VARCHAR(255) NOT NULL,
    -- On indique quelle est la clé primaire : 
    PRIMARY KEY (id)
); 


-- On rajoute une contrainte d'unicité sur la colonne email
ALTER TABLE user ADD CONSTRAINT UNIQUE(email);
ALTER TABLE user ADD CONSTRAINT UNIQUE(pseudo);

-- Insertion de données de test

-- INSERT INTO user(email, pseudo, password) VALUES ('toto@toto.com', 'superman', 'kryptonite'); 
-- INSERT INTO user(email, pseudo, password) VALUES ('toto@toto.com', 'spiderman', 'araignée'), ('batman@gotham.be', 'superman', 'batmobile');

