<?php

/************************************************************
*   Création d'une instance PDO pour se connecter à la BDD_BELLE_EPOQUE  *
*                                    *
***********************************************************/
$dsn = "mysql:host=localhost;dbname=bdd_belle_epoque;charset=utf8";
$user = "root";
$password= "root";

try{
    // Si tout se passe bien
    $db_connexion = new PDO($dsn, $user, $password);
    $db_connexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8mb4');
    $db_connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
}
catch(PDOException $e){
    // Si une erreur est levée
    echo('Impossible d\'accéder à la base de données');
}