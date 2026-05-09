<?php
// ============================================================
// CONNEXION À LA BASE DE DONNÉES via PDO
// ============================================================

$host     = '127.0.0.1';
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
            // Lève une exception en cas d'erreur SQL
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // Retourne les résultats sous forme de tableaux associatifs par défaut
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Désactive l'émulation des requêtes préparées (plus sécurisé)
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // En production, ne jamais afficher le message d'erreur complet
    // Ici on le garde pour le développement local
    die("Erreur de connexion : " . $e->getMessage());
}
?>