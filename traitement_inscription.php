<?php
// Vérification si le formulaire de connexion est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs requis et sécurisation des données
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Connexion à la base de données (exemple avec MySQLi)
    $hostname = "localhost";
    $username = "root";
    $password_db = "root";
    $database = "base_de_donnees";

    $mysqli = new mysqli($hostname, $username, $password_db, $database);

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("La connexion à la base de données a échoué: " . $mysqli->connect_error);
    }

    // Préparation de la requête de sélection pour vérifier l'utilisateur
    $query = "SELECT id, email, password FROM utilisateurs WHERE email = ?";
    $stmt = $mysqli->prepare($query);

    // Liaison des paramètres et exécution de la requête
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Vérification si l'utilisateur existe
    if ($stmt->num_rows == 1) {
        // Liaison des résultats
        $stmt->bind_result($id, $email, $hashed_password);
        $stmt->fetch();

        // Vérification du mot de passe hashé
        if (password_verify($password, $hashed_password)) {
            // Authentification réussie
            session_start();

            // Stockage des données de session
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;

            // Redirection vers la page de profil ou tableau de bord
            header("Location: index.html");
            exit();
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect.";
        }
    } else {
        // Utilisateur non trouvé
        echo "Aucun utilisateur trouvé avec cette adresse e-mail.";
    }

    // Fermeture du statement et de la connexion MySQL
    $stmt->close();
    $mysqli->close();
}
?>
