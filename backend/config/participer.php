<?php
// ============================================================
// PARTICIPATION À UN ÉVÉNEMENT
// ============================================================

session_start();
require_once __DIR__ . "/../config/db.php";

// ---- 1. Vérifier que l'utilisateur est connecté ----
// CORRECTION : l'ancien code prenait user_id depuis $_POST
// N'importe qui pouvait envoyer un faux user_id → faille de sécurité
// On utilise maintenant la SESSION qui est gérée côté serveur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../connexion.php');
    exit();
}

// ---- 2. Vérifier que la requête est bien un POST ----
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../evenements.php');
    exit();
}

// ---- 3. Vérifier que l'event_id est fourni et valide ----
if (empty($_POST['event_id']) || !is_numeric($_POST['event_id'])) {
    header('Location: ../../evenements.php?erreur=event_invalide');
    exit();
}

$user_id  = (int) $_SESSION['user_id'];
$event_id = (int) $_POST['event_id'];

// ---- 4. Vérifier que l'événement existe ----
$stmt = $pdo->prepare("SELECT id FROM evenements WHERE id = ?");
$stmt->execute([$event_id]);
if ($stmt->rowCount() === 0) {
    header('Location: ../../evenements.php?erreur=event_introuvable');
    exit();
}

// ---- 5. Vérifier que l'utilisateur ne participe pas déjà ----
// CORRECTION : l'ancien code n'avait aucune vérification de doublon
$stmt = $pdo->prepare("SELECT id FROM participations WHERE user_id = ? AND event_id = ?");
$stmt->execute([$user_id, $event_id]);

if ($stmt->rowCount() > 0) {
    header('Location: ../../evenements.php?info=deja_inscrit');
    exit();
}

// ---- 6. Enregistrer la participation ----
try {
    $sql  = "INSERT INTO participations (user_id, event_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $event_id]);

    header('Location: ../../evenements.php?succes=participation');
    exit();

} catch (PDOException $e) {
    header('Location: ../../evenements.php?erreur=serveur');
    exit();
}
?>