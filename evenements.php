<?php
session_start();
require_once __DIR__ . "/backend/config/db.php";

// ---- Récupération des événements depuis la base ----
$stmt = $pdo->prepare("SELECT * FROM evenements ORDER BY `date` ASC");
$stmt->execute();
$evenements = $stmt->fetchAll();

// ---- Messages renvoyés par backend/config/participer.php ----
$message = null;

if (isset($_GET['succes']) && $_GET['succes'] === 'participation') {
    $message = ['type' => 'succes', 'texte' => '✅ Votre participation a bien été enregistrée !'];
} elseif (isset($_GET['info']) && $_GET['info'] === 'deja_inscrit') {
    $message = ['type' => 'info', 'texte' => 'ℹ️ Vous êtes déjà inscrit(e) à cet événement.'];
} elseif (isset($_GET['erreur'])) {
    $textes = [
        'event_invalide'     => "Événement invalide.",
        'event_introuvable'  => "Cet événement n'existe plus.",
        'serveur'            => "Une erreur est survenue. Veuillez réessayer.",
    ];
    $message = ['type' => 'erreur', 'texte' => '❌ ' . ($textes[$_GET['erreur']] ?? "Une erreur est survenue.")];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Événements</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="evenements-page">

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
        <li><a href="evenements.php" class="active">Événements</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="dashboard.php">👤 <?= htmlspecialchars($_SESSION['nom']) ?></a></li>
        <?php else: ?>
          <li><a href="connexion.php">Connexion</a></li>
        <?php endif; ?>
        <li><a href="notification.php">
          <img src="images/notification.gif" alt="Notifications" onerror="this.outerHTML='🔔'">
        </a></li>
      </ul>
    </div>
  </nav>

  <!-- ==================== HERO ==================== -->
  <section class="hero">
    <h1>Bienvenue sur MyEvents</h1>
    <p>Créez, gérez et partagez vos événements en toute simplicité.</p>

    <div class="input-group">
      <input type="text" id="searchInput" placeholder="Rechercher un événement…">
      <button onclick="rechercherEvenement()">Rechercher</button>
    </div>

    <div class="categorie">
      <button class="active" onclick="filtrerCategorie(this, 'tous')">Tous</button>
      <button onclick="filtrerCategorie(this, 'semaine')">Cette semaine</button>
      <button onclick="filtrerCategorie(this, 'mois')">Ce mois</button>
      <button onclick="filtrerCategorie(this, 'trimestre')">Ce trimestre</button>
    </div>
  </section>

  <!-- ==================== CHIFFRES CLÉS ==================== -->
  <!-- "Événements créés" est calculé depuis la base ; les deux autres
       chiffres restent des exemples marketing tant qu'il n'y a pas
       encore assez de données réelles. -->
  <section class="nos-chiffres">
    <div class="chiffre">
      <h2><?= count($evenements) ?></h2>
      <p>Événements créés</p>
    </div>
    <div class="chiffre">
      <h2>3 400</h2>
      <p>Participants</p>
    </div>
    <div class="chiffre">
      <h2>98%</h2>
      <p>Satisfaction</p>
    </div>
  </section>

  <?php if ($message): ?>
    <div class="message-<?= $message['type'] ?>" style="max-width:600px;margin:20px auto 0;">
      <?= htmlspecialchars($message['texte']) ?>
    </div>
  <?php endif; ?>

  <!-- ==================== CARDS ÉVÉNEMENTS ==================== -->
  <!-- Les événements viennent maintenant de la table `evenements` ;
       le bouton "Participer" envoie un vrai formulaire à
       backend/config/participer.php, qui enregistre la participation
       en base (table `participations`). -->
  <section class="cards">
    <h2>Découvrez nos événements à venir</h2>

    <?php if (empty($evenements)): ?>
      <p style="color:var(--text-light);">Aucun événement pour le moment. Revenez bientôt !</p>
    <?php else: ?>
    <div class="card-grid" id="cardGrid">

      <?php foreach ($evenements as $e): ?>
      <div class="evenement-item" data-periode="<?= htmlspecialchars($e['periode']) ?>">
        <span class="badge">Places limitées</span>
        <h3><?= htmlspecialchars($e['titre']) ?></h3>
        <p><?= htmlspecialchars($e['description']) ?></p>
        <div class="date">📅 <?= (new DateTime($e['date']))->format('d F Y') ?></div>

        <div class="btn-groupe">
          <?php if (isset($_SESSION['user_id'])): ?>
            <form action="backend/config/participer.php" method="POST" style="flex:1;">
              <input type="hidden" name="event_id" value="<?= (int) $e['id'] ?>">
              <button type="submit" class="btn-participer" style="width:100%;">Participer</button>
            </form>
          <?php else: ?>
            <a href="connexion.php" class="btn-participer" style="flex:1;text-align:center;text-decoration:none;">
              Se connecter pour participer
            </a>
          <?php endif; ?>
          <button class="btn-info" type="button" onclick="toggleDetails(this)">Plus d'infos ▼</button>
        </div>

        <div class="details">
          <?php if (!empty($e['lieu'])): ?><p>📍 Lieu : <?= htmlspecialchars($e['lieu']) ?></p><?php endif; ?>
          <?php if (!empty($e['horaire'])): ?><p>🕐 Heure : <?= htmlspecialchars($e['horaire']) ?></p><?php endif; ?>
          <p>💰 Prix : <?= $e['prix'] > 0 ? number_format($e['prix'], 2) . ' €' : 'Gratuit' ?></p>
          <?php if ($e['places_disponibles'] !== null): ?>
            <p>👥 Places disponibles : <?= (int) $e['places_disponibles'] ?></p>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
    <?php endif; ?>
  </section>

  <!-- ==================== CONTACT ==================== -->
  <section class="contact">
    <h2>Contactez-nous</h2>
    <p>Vous avez des questions ou souhaitez discuter de votre prochain événement ?
       N'hésitez pas à nous contacter.</p>
    <button class="btn-contact">Contactez-nous</button>
  </section>

  <!-- ==================== NOS SERVICES ==================== -->
  <section class="nos-services">
    <h2>Nos services</h2>
    <div class="services-grid">
      <div class="service-item">
        <h3>Planification d'événements</h3>
        <p>Nous vous aidons à planifier chaque détail de votre événement pour une expérience sans stress.</p>
      </div>
      <div class="service-item">
        <h3>Gestion des invités</h3>
        <p>Gérez facilement vos invités avec notre système de gestion d'invités convivial.</p>
      </div>
      <div class="service-item">
        <h3>Promotion d'événements</h3>
        <p>Nous vous aidons à promouvoir votre événement pour attirer un public plus large.</p>
      </div>
    </div>
  </section>

  <!-- ==================== FOOTER ==================== -->
  <footer class="footer">
    <p>© 2024 MyEvents. Tous droits réservés.</p>
    <div class="footer-social">
      <span>Suivez-nous :</span>
      <a href="https://www.facebook.com/myevents" target="_blank" rel="noopener">
        <img src="images/fb.png" alt="Facebook" onerror="this.style.display='none'">
      </a>
      <a href="https://www.twitter.com/myevents" target="_blank" rel="noopener">
        <img src="images/twitter.png" alt="Twitter" onerror="this.style.display='none'">
      </a>
      <a href="https://www.instagram.com/myevents" target="_blank" rel="noopener">
        <img src="images/inst.png" alt="Instagram" onerror="this.style.display='none'">
      </a>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>