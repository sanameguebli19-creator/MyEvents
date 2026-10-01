<?php
// ============================================================
// DÉCONNEXION UTILISATEUR
// ============================================================
session_start();

// Effacer toutes les variables de session
$_SESSION = [];

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: ../../connexion.php');
exit();
?>