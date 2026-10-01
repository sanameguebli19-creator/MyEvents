<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Inscription</title>
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
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="evenements.php">Événements</a></li>
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

  <!-- ==================== FORMULAIRE ==================== -->
  <main class="main-content">
    <div class="form-container">
      <h2>Créer un compte</h2>

      <?php if (isset($_GET['erreur'])): ?>
        <div class="message-erreur">
          ❌ <?php
            if     ($_GET['erreur'] === 'email_existe')  echo "Cet email est déjà utilisé.";
            elseif ($_GET['erreur'] === 'champs_vides')  echo "Veuillez remplir tous les champs obligatoires.";
            else                                          echo "Une erreur est survenue. Veuillez réessayer.";
          ?>
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['succes'])): ?>
        <div class="message-succes">
          ✅ Inscription réussie ! <a href="connexion.php">Se connecter maintenant</a>
        </div>
      <?php endif; ?>

      <form action="backend/config/add_user.php" method="POST" id="formInscription">
        <input type="text"     name="nom"       placeholder="Nom complet *"   required autocomplete="name">
        <input type="email"    name="email"      placeholder="Adresse email *"  required autocomplete="email">

        <div class="password-wrapper">
          <input type="password" name="password" id="passwordInput"
                 placeholder="Mot de passe *" required autocomplete="new-password"
                 oninput="evaluerMdp(this.value)">
          <div class="force-mdp" id="forceMdp">
            <span id="b1"></span>
            <span id="b2"></span>
            <span id="b3"></span>
            <span id="b4"></span>
          </div>
        </div>

        <input type="tel" name="telephone" placeholder="Téléphone (optionnel)" autocomplete="tel">

        <button type="submit">Créer mon compte →</button>
      </form>

      <p class="mention">* Champs obligatoires. Vos données sont utilisées uniquement pour gérer votre compte.</p>

      <div class="separateur">ou</div>

      <a href="connexion.php" class="lien">Déjà un compte ? <strong>Se connecter</strong></a>
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