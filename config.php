<?php
$host = 'localhost';
$db = 'memoire_online';
$user = 'root';
$pass = ''; // Remplacez par votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
