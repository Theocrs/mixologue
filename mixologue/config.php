<?php
// $dsn => la bd choisie + l'adresse ip de la bd + nom de la bd
$dsn = 'mysql:host=localhost;dbname=mixologue;charset=utf8mb4';
// $utilisateur = le nom de connexion + $mpd = mot de passe de connexion
$utilisateur = 'root';
$mdp = '';
// try => on essaye d'établir la connexion avec le dsn + user + pwd
try {
    // création d'un objet PDO et connexion
    $connDB = new PDO($dsn, $utilisateur, $mdp);
    // Récupérer les erreurs avec les constantes d'erreurs PDO
    $connDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Capturer l'erreur avec la classe PDOException s'il y'a eu lieu
} catch (PDOException $e) {
    // die() => on quitte l'appli et on renvoie un message
    die('Erreur : ' . $e->getMessage());
}
?>