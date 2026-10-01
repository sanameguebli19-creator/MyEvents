<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "backend/config/db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header('Location: connexion.php');
    exit();
}

$stmt = $pdo->prepare("
    SELECT e.titre, e.date, e.lieu, e.prix
    FROM participations p
    JOIN evenements e ON p.event_id = e.id
    WHERE p.user_id = ?
    ORDER BY e.date DESC
");
$stmt->execute([$_SESSION['user_id']]);
$participations = $stmt->fetchAll();

$initiale   = strtoupper(mb_substr($user['nom'], 0, 1));
$msg_succes = '';
$msg_erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $nouveau_nom = trim($_POST['nouveau_nom']);
    $nouveau_tel = trim($_POST['nouveau_tel']);
    $nouveau_mdp = $_POST['nouveau_mdp'];

    if (empty($nouveau_nom)) {
        $msg_erreur = "Le nom ne peut pas être vide.";
    } else {
        if (!empty($nouveau_mdp)) {
            $hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, telephone = ?, mot_de_passe = ? WHERE id = ?");
            $stmt->execute([$nouveau_nom, $nouveau_tel, $hash, $_SESSION['user_id']]);
        } else {
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, telephone = ? WHERE id = ?");
            $stmt->execute([$nouveau_nom, $nouveau_tel, $_SESSION['user_id']]);
        }
        $_SESSION['nom'] = $nouveau_nom;
        $user['nom']     = $nouveau_nom;
        $initiale        = strtoupper(mb_substr($nouveau_nom, 0, 1));
        $msg_succes      = "Profil mis à jour avec succès !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Mon espace</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-page">

  <!-- ==================== NAVBAR ==================== -->
  <nav class="navbar">
    <div class="logo">
      <img src="images/logo.png" alt="MyEvents"
           onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
      <span class="logo-text" style="display:none">MyEvents</span>
    </div>
    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
    <div class="nav-links" id="navLinks">
      <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="evenements.php">Événements</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="dashboard.php" class="active">👤 <?= htmlspecialchars($_SESSION['nom']) ?></a></li>
        <?php else: ?>
          <li><a href="connexion.php">Connexion</a></li>
        <?php endif; ?>
        <li><a href="notification.php">
          <img src="images/notification.gif" alt="Notifications" onerror="this.outerHTML='🔔'">
        </a></li>
      </ul>
    </div>
  </nav>

  <!-- ==================== CONTENU ==================== -->
  <main class="main-content">

    <div class="carte-profil">
      <div class="avatar"><?= htmlspecialchars($initiale) ?></div>
      <div class="profil-info">
        <h2>Bonjour, <?= htmlspecialchars($user['nom']) ?> 👋</h2>
        <p><?= htmlspecialchars($user['email']) ?></p>
        <?php if (!empty($user['telephone'])): ?>
          <p><?= htmlspecialchars($user['telephone']) ?></p>
        <?php endif; ?>
      </div>
      <div class="profil-actions">
        <button class="btn-modifier" onclick="toggleFormModifier()">✏️ Modifier mon profil</button>
        <a href="backend/config/logout.php" class="btn-deconnexion">🚪 Se déconnecter</a>
      </div>
    </div>

    <div class="form-modifier" id="formModifier">
      <h3>✏️ Modifier mon profil</h3>
      <?php if ($msg_succes): ?><div class="message-succes"><?= $msg_succes ?></div><?php endif; ?>
      <?php if ($msg_erreur): ?><div class="message-erreur"><?= $msg_erreur ?></div><?php endif; ?>
      <form method="POST" action="dashboard.php">
        <input type="hidden"   name="action"      value="modifier">
        <input type="text"     name="nouveau_nom"  placeholder="Nom complet" value="<?= htmlspecialchars($user['nom']) ?>" required>
        <input type="tel"      name="nouveau_tel"  placeholder="Téléphone"   value="<?= htmlspecialchars($user['telephone'] ?? '') ?>">
        <input type="password" name="nouveau_mdp"  placeholder="Nouveau mot de passe (laisser vide pour ne pas changer)">
        <div class="btn-row">
          <button type="submit" class="btn-sauvegarder">Sauvegarder</button>
          <button type="button" class="btn-annuler" onclick="toggleFormModifier()">Annuler</button>
        </div>
      </form>
    </div>

    <div>
      <h2 class="section-titre">
        🎟️ Mes participations
        <span class="badge-count"><?= count($participations) ?></span>
      </h2>

      <?php if (empty($participations)): ?>
        <div class="etat-vide">
          <div class="icone">🎪</div>
          <p>Vous n'avez participé à aucun événement pour l'instant.</p>
          <a href="evenements.php" class="btn-explorer">Explorer les événements</a>
        </div>
      <?php else: ?>
        <div class="participation-liste">
          <?php foreach ($participations as $p):
            $date_event  = new DateTime($p['date']);
            $aujourdhui  = new DateTime();
            $est_a_venir = $date_event >= $aujourdhui;
          ?>
          <div class="participation-item">
            <div class="participation-icone"><?= $est_a_venir ? '🎉' : '✅' ?></div>
            <div class="participation-info">
              <h4><?= htmlspecialchars($p['titre']) ?></h4>
              <p>
                📅 <?= $date_event->format('d/m/Y') ?>
                <?php if (!empty($p['lieu'])): ?>&nbsp;•&nbsp; 📍 <?= htmlspecialchars($p['lieu']) ?><?php endif; ?>
                <?php if ($p['prix'] > 0): ?>&nbsp;•&nbsp; 💰 <?= number_format($p['prix'], 2) ?> €
                <?php else: ?>&nbsp;•&nbsp; 💰 Gratuit<?php endif; ?>
              </p>
            </div>
            <span class="badge-statut <?= $est_a_venir ? 'a-venir' : 'passe' ?>">
              <?= $est_a_venir ? '📌 À venir' : '✔ Passé' ?>
            </span>
          </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  </main>

  <footer class="footer">
    <p>© 2024 MyEvents. Tous droits réservés.</p>
    <div class="footer-social">
      <span>Suivez-nous :</span>
      <a href="https://www.facebook.com/myevents"  target="_blank" rel="noopener"><img src="images/fb.png"      alt="Facebook"  onerror="this.style.display='none'"></a>
      <a href="https://www.twitter.com/myevents"   target="_blank" rel="noopener"><img src="images/twitter.png" alt="Twitter"   onerror="this.style.display='none'"></a>
      <a href="https://www.instagram.com/myevents" target="_blank" rel="noopener"><img src="images/inst.png"    alt="Instagram" onerror="this.style.display='none'"></a>
    </div>
  </footer>

  <script src="script.js"></script>
  <?php if ($msg_succes || $msg_erreur): ?>
    <script>document.getElementById('formModifier').style.display = 'block';</script>
  <?php endif; ?>
</body>
</html>