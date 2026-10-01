<?php
// ============================================================
// API JSON : liste des événements
// CORRECTION : la requête interrogeait la table "events", qui
// n'existe pas — la vraie table s'appelle "evenements" (voir
// participer.php et dashboard.php qui l'utilisent déjà).
// ============================================================

header("Content-Type: application/json");
require_once __DIR__ . "/../config/db.php";

$stmt = $pdo->prepare("SELECT * FROM evenements ORDER BY `date` ASC");
$stmt->execute();

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events);