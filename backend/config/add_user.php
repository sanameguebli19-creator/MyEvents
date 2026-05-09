<?php
// ============================================================
// INSCRIPTION D'UN NOUVEL UTILISATEUR
// ============================================================

// CORRECTION : chemin corrigé selon l'arborescence réelle du projet
require_once __DIR__ . "/../config/db.php";

// ---- 1. Vérification des champs obligatoires ----
if (empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['password'])) {
    header('Location: ../../inscription.php?erreur=champs_vides');
    exit();
}

// ---- 2. Nettoyage des données ----
$nom      = trim($_POST['nom']);
$email    = trim($_POST['email']);
$tel      = isset($_POST['telephone']) ? trim($_POST['telephone']) : '';

// ---- 3. Validation de l'email ----
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../../inscription.php?erreur=email_invalide');
    exit();
}

// ---- 4. Vérifier si l'email existe déjà ----
$stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
$stmt->execute([$email]);

// CORRECTION : la redirection email_existe était placée APRÈS le exit()
// Elle était donc inaccessible (code mort). Maintenant correctement placée.
if ($stmt->rowCount() > 0) {
    header('Location: ../../inscription.php?erreur=email_existe');
    exit();
}

// ---- 5. Hashage sécurisé du mot de passe ----
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

// ---- 6. Insertion en base de données ----
try {
    $sql  = "INSERT INTO utilisateurs (nom, email, mot_de_passe, telephone) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $email, $password_hash, $tel]);

    // Redirection vers la page de connexion avec message de succès
    header('Location: ../../inscription.php?succes=1');
    exit();

} catch (PDOException $e) {
    // En cas d'erreur inattendue de la BDD
    header('Location: ../../inscription.php?erreur=serveur');
    exit();
}
?>