<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Notifications</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="notification-page">

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
          <li><a href="dashboard.php">👤 <?= htmlspecialchars($_SESSION['nom']) ?></a></li>
        <?php else: ?>
          <li><a href="connexion.php">Connexion</a></li>
        <?php endif; ?>
        <li><a href="notification.php" class="active">
          <img src="images/notification.gif" alt="Notifications" onerror="this.outerHTML='🔔'">
        </a></li>
      </ul>
    </div>
  </nav>

  <!-- ==================== CONTENU ==================== -->
  <!-- ⚠️ Ces notifications sont fictives (codées en dur), à but de démonstration.
       Marquer comme lu ne change que l'affichage, rien n'est enregistré en base. -->
  <main class="main-content">
    <h1>🔔 Notifications</h1>
    <p class="sous-titre">Retrouvez ici toutes vos alertes et mises à jour.</p>

    <div class="barre-actions">
      <p class="compteur"><span id="nbNonLues">3</span> notification(s) non lue(s)</p>
      <button class="btn-tout-lire" onclick="toutMarquerLu()">Tout marquer comme lu</button>
    </div>

    <div class="notif-liste" id="notifListe">

      <div class="notif-item non-lue" onclick="marquerLu(this)">
        <div class="notif-icone">🎉</div>
        <div class="notif-corps">
          <p class="notif-titre">Inscription confirmée – Festival de Musique</p>
          <p class="notif-desc">Votre participation au Festival de Musique du 20 avril 2026 a bien été enregistrée.</p>
          <p class="notif-date">📅 Aujourd'hui à 10h34</p>
        </div>
        <div class="point-non-lue"></div>
      </div>

      <div class="notif-item non-lue" onclick="marquerLu(this)">
        <div class="notif-icone">⏰</div>
        <div class="notif-corps">
          <p class="notif-titre">Rappel – Concert de Rock dans 3 jours</p>
          <p class="notif-desc">N'oubliez pas votre événement au Zénith de Paris le 2 mai 2026 à 20h00.</p>
          <p class="notif-date">📅 Hier à 18h00</p>
        </div>
        <div class="point-non-lue"></div>
      </div>

      <div class="notif-item non-lue" onclick="marquerLu(this)">
        <div class="notif-icone">📢</div>
        <div class="notif-corps">
          <p class="notif-titre">Nouvel événement disponible – Atelier de Cuisine</p>
          <p class="notif-desc">Un nouvel atelier cuisine avec un chef renommé vient d'être publié. Places limitées !</p>
          <p class="notif-date">📅 Il y a 2 jours</p>
        </div>
        <div class="point-non-lue"></div>
      </div>

      <div class="notif-item lue" onclick="marquerLu(this)">
        <div class="notif-icone">✅</div>
        <div class="notif-corps">
          <p class="notif-titre">Bienvenue sur MyEvents !</p>
          <p class="notif-desc">Votre compte a été créé avec succès. Découvrez nos événements et participez !</p>
          <p class="notif-date">📅 Il y a 5 jours</p>
        </div>
        <div class="point-non-lue"></div>
      </div>

    </div>

    <div class="etat-vide" id="etatVide">
      <div class="icone-vide">🔕</div>
      <h3>Aucune notification</h3>
      <p>Vous êtes à jour ! Revenez bientôt pour de nouvelles alertes.</p>
    </div>

  </main>

  <!-- ==================== FOOTER ==================== -->
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
</body>
</html>