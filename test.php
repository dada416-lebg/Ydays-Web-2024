<?php
$servername = "localhost3306";  // Adresse du serveur MySQL (généralement localhost)
$username = "root";  // Nom d'utilisateur MySQL
$password = "root";  // Mot de passe MySQL
$dbname = "base_de_donnees";  // Nom de la base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
?>