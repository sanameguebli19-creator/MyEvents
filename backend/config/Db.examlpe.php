<?php
/**
 * Gabarit de connexion à la base de données.
 *
 * 1. Copie ce fichier en "db.php" dans le même dossier :
 *      cp backend/config/db.example.php backend/config/db.php
 * 2. Renseigne tes vrais identifiants (hôte, base, utilisateur, mot de passe)
 * 3. Ne mets JAMAIS backend/config/db.php dans Git (voir .gitignore)
 */

$host     = 'localhost';
$dbname   = 'myevents';
$username = 'root';
$password = '';
$port     = 3306;

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}