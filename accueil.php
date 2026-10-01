<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Accueil</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

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
        <li><a href="accueil.php" class="active">Accueil</a></li>
        <li><a href="evenements.php">Événements</a></li>
        <!-- CORRECTION : ce lien conditionnel était un <li> flottant hors de <ul>,
             invalide en HTML et mal affiché. Il est maintenant à sa place. -->
        <?php if (isset($_SESSION['user_id'])): ?>
          <li><a href="dashboard.php">👤 <?= htmlspecialchars($_SESSION['nom']) ?></a></li>
        <?php else: ?>
          <li><a href="connexion.php">Connexion</a></li>
        <?php endif; ?>
        <li><a href="notification.php">
          <img src="images/notification.gif" alt="Notifications"
               onerror="this.outerHTML='🔔'">
        </a></li>
      </ul>
    </div>
  </nav>

  <!-- ==================== HERO ==================== -->
  <section class="hero">
    <h1>Partagez avec nous<br>vos moments importants.</h1>
    <p>Nous donnons vie à vos événements privés et professionnels avec une attention
       particulière portée à l'excellence et à l'émotion pour que chaque occasion soit inoubliable.</p>
    <span class="tagline">Votre confiance est la clé de notre succès.</span>
    <a href="evenements.php" class="btn-hero">Créer ton événement</a>
  </section>

  <!-- ==================== NOS ÉVÉNEMENTS ==================== -->
  <section class="nos-evenements">
    <h2>Nos événements</h2>
    <p>Découvrez nos événements récents et à venir, où nous avons créé des expériences
       mémorables pour nos clients.</p>
    <a href="evenements.php" class="btn-evenements">Voir tous les événements</a>
  </section>

  <!-- ==================== NEWSLETTER ==================== -->
  <section class="rejoignez-nous">
    <h2>Inscrivez-vous</h2>
    <p>Rejoignez-nous et soyez le premier informé des dernières nouveautés et offres spéciales.</p>
    <div class="inscription">
      <input type="email" id="emailNewsletter" placeholder="Entrez votre email">
      <button onclick="sInscrire()">S'inscrire</button>
    </div>
    <p class="newsletter-msg" id="newsletterMsg">✅ Merci ! Vous êtes bien inscrit(e).</p>
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