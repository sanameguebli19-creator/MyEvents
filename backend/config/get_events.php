<?php
header("Content-Type: application/json");
require_once "../config/db.php";

$stmt = $pdo->prepare("SELECT * FROM events");
$stmt->execute();

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events);
?>