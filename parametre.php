<?php
$hostname = "localhost"; // Nom d'hôte de la base de données
$username = "root"; // Nom d'utilisateur MySQL
$password = "root"; // Mot de passe MySQL
$database = "base_de_donnees"; // Nom de la base de données

// Connexion à la base de données MySQL
$mysqli = new mysqli($hostname, $username, $password, $database);

// Vérification de la connexion
if ($mysqli->connect_errno) {
    die("La connexion à la base de données a échoué: " . $mysqli->connect_error);
}
?>
