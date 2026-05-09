<?php
// ============================================================
// CONNEXION UTILISATEUR
// ============================================================

session_start();

// CORRECTION : chemin corrigé
require_once __DIR__ . "/../config/db.php";

// ---- 1. Vérifier que la requête vient bien d'un formulaire POST ----
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../connexion.php');
    exit();
}

// ---- 2. Vérification des champs ----
if (empty($_POST['email']) || empty($_POST['password'])) {
    header('Location: ../../connexion.php?error=champs_vides');
    exit();
}

// ---- 3. Nettoyage ----
$email    = trim($_POST['email']);
$password = $_POST['password'];

// ---- 4. Recherche de l'utilisateur en base ----
$sql  = "SELECT * FROM utilisateurs WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch();

// ---- 5. Vérification du mot de passe ----
// CORRECTION : la colonne s'appelle 'mot_de_passe' dans la BDD (définie dans add_user.php)
// L'ancien code utilisait $user['password'] → clé inexistante → connexion toujours refusée
if ($user && password_verify($password, $user['mot_de_passe'])) {

    // ---- 6. Démarrage de la session ----
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nom']     = $user['nom'];
    $_SESSION['email']   = $user['email'];

    // Régénérer l'ID de session pour éviter la fixation de session
    session_regenerate_id(true);

    // Redirection vers l'accueil
    header('Location: ../../accueil.php');
    exit();

} else {
    // Identifiants incorrects
    header('Location: ../../connexion.php?error=1');
    exit();
}
?>