<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Inscription</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    /* ============================================================
       VARIABLES & RESET (identiques aux autres pages)
    ============================================================ */
    :root {
      --primary:       #CA8383;
      --primary-dark:  #7B4444;
      --primary-light: #F4E3E3;
      --secondary:     #FFFFFF;
      --bg:            #FAF5F5;
      --card-bg:       #FDF8F8;
      --text-main:     #474141;
      --text-light:    #8A7F7F;
      --border:        #E5CFCF;
      --error-bg:      #FCE8E8;
      --error-color:   #A84E4E;
      --success-bg:    #E8F5E9;
      --success-color: #2E7D32;
      --shadow:        0 4px 18px rgba(0,0,0,0.08);
      --radius:        12px;
      --font-title:    'Playfair Display', serif;
      --font-body:     'DM Sans', sans-serif;
    }

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: var(--font-body);
      background-color: var(--bg);
      color: var(--text-main);
      overflow-x: hidden;
    }

    /* ============================================================
       NAVBAR
    ============================================================ */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #F7EEEE;
      padding: 10px 40px;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 2px 8px rgba(202,131,131,0.1);
    }

    .logo img { height: 80px; width: auto; }

    .logo-text {
      font-family: var(--font-title);
      font-size: 1.6rem;
      color: var(--primary);
    }

    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      background: none;
      border: none;
      padding: 4px;
    }

    .hamburger span {
      display: block;
      width: 24px;
      height: 2px;
      background-color: var(--primary);
      border-radius: 2px;
    }

    .nav-links ul {
      list-style: none;
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .nav-links ul li a {
      color: var(--primary);
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      transition: color 0.2s;
    }

    .nav-links ul li a:hover,
    .nav-links ul li a.active {
      color: var(--primary-dark);
      text-decoration: underline;
    }

    .nav-links ul li a img {
      width: 26px;
      height: 26px;
      vertical-align: middle;
    }

    /* ============================================================
       CONTENU PRINCIPAL
    ============================================================ */
    .main-content {
      min-height: calc(100vh - 130px);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 16px;
    }

    /* ============================================================
       CARTE FORMULAIRE
       CORRECTION : styles input/button/a maintenant scoped dans
       .form-container uniquement (ne débordent plus sur navbar/footer)
    ============================================================ */
    .form-container {
      background: var(--secondary);
      padding: 36px 32px;
      border-radius: var(--radius);
      width: 400px;
      max-width: 100%;
      text-align: center;
      box-shadow: var(--shadow);
    }

    .form-container h2 {
      font-family: var(--font-title);
      font-size: 1.7rem;
      color: var(--primary);
      margin-bottom: 24px;
      font-style: italic;
    }

    .form-container input {
      display: block;
      width: 100%;
      padding: 11px 14px;
      margin-bottom: 14px;
      border-radius: 8px;
      border: 1px solid var(--border);
      font-size: 0.95rem;
      font-family: var(--font-body);
      color: var(--text-main);
      background-color: var(--card-bg);
      outline: none;
      transition: border-color 0.2s;
    }

    .form-container input:focus {
      border-color: var(--primary);
    }

    /* Indicateur de force du mot de passe */
    .password-wrapper {
      position: relative;
      margin-bottom: 14px;
    }

    .password-wrapper input {
      margin-bottom: 6px;
    }

    .force-mdp {
      display: flex;
      gap: 4px;
      height: 4px;
      margin-bottom: 8px;
    }

    .force-mdp span {
      flex: 1;
      border-radius: 2px;
      background-color: var(--border);
      transition: background-color 0.3s;
    }

    .form-container button[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.97rem;
      font-family: var(--font-body);
      font-weight: 500;
      transition: background-color 0.2s ease;
      margin-top: 4px;
    }

    .form-container button[type="submit"]:hover {
      background-color: var(--primary-dark);
    }

    .form-container .lien {
      display: block;
      margin-top: 16px;
      color: var(--text-light);
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.2s;
    }

    .form-container .lien:hover { color: var(--primary); }

    /* Messages */
    .message-erreur {
      background-color: var(--error-bg);
      color: var(--error-color);
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 16px;
      font-size: 0.9rem;
      border-left: 3px solid var(--error-color);
      text-align: left;
    }

    .message-succes {
      background-color: var(--success-bg);
      color: var(--success-color);
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 16px;
      font-size: 0.9rem;
      border-left: 3px solid var(--success-color);
    }

    .message-succes a {
      color: var(--success-color);
      font-weight: 600;
      text-decoration: underline;
    }

    /* Séparateur */
    .separateur {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 18px 0;
      color: var(--text-light);
      font-size: 0.82rem;
    }

    .separateur::before,
    .separateur::after {
      content: '';
      flex: 1;
      height: 1px;
      background-color: var(--border);
    }

    /* Mention obligatoire */
    .mention {
      font-size: 0.78rem;
      color: var(--text-light);
      margin-top: 14px;
      line-height: 1.5;
    }

    /* ============================================================
       FOOTER
    ============================================================ */
    .footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
      background-color: #F7EEEE;
      padding: 30px 50px;
    }

    .footer p { color: var(--text-light); font-size: 0.88rem; }

    .footer-social {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .footer-social span { font-size: 0.88rem; color: var(--text-light); }

    .footer a img {
      width: 26px;
      height: 26px;
      vertical-align: middle;
      opacity: 0.8;
      transition: opacity 0.2s;
    }

    .footer a img:hover { opacity: 1; }

    /* ============================================================
       RESPONSIVE MOBILE
    ============================================================ */
    @media (max-width: 768px) {
      .navbar { padding: 10px 20px; flex-wrap: wrap; }
      .logo img { height: 55px; }
      .hamburger { display: flex; }
      .nav-links { display: none; width: 100%; }
      .nav-links.active { display: block; }
      .nav-links ul { flex-direction: column; gap: 0; padding: 8px 0; }
      .nav-links ul li { padding: 10px 12px; border-bottom: 1px solid var(--border); }
      .nav-links ul li:last-child { border-bottom: none; }
      .footer { flex-direction: column; align-items: center; text-align: center; padding: 24px 16px; }
    }
  </style>
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
        <li><a href="connexion.php">Connexion</a></li>
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

      <!-- Messages d'erreur PHP -->
      <?php if (isset($_GET['erreur'])): ?>
        <div class="message-erreur">
          ❌ <?php
            if     ($_GET['erreur'] === 'email_existe')  echo "Cet email est déjà utilisé.";
            elseif ($_GET['erreur'] === 'champs_vides')  echo "Veuillez remplir tous les champs obligatoires.";
            else                                          echo "Une erreur est survenue. Veuillez réessayer.";
          ?>
        </div>
      <?php endif; ?>

      <!-- Message de succès PHP -->
      <?php if (isset($_GET['succes'])): ?>
        <div class="message-succes">
          ✅ Inscription réussie ! <a href="connexion.php">Se connecter maintenant</a>
        </div>
      <?php endif; ?>

      <!--
        CORRECTION : action corrigée vers le bon chemin
        (était "../backend/API/add_user.php" → chemin incorrect selon l'arborescence)
      -->
      <form action="backend/config/add_user.php" method="POST" id="formInscription">
        <input type="text"     name="nom"       placeholder="Nom complet *"   required autocomplete="name">
        <input type="email"    name="email"      placeholder="Adresse email *"  required autocomplete="email">

        <div class="password-wrapper">
          <input type="password" name="password" id="passwordInput"
                 placeholder="Mot de passe *" required autocomplete="new-password"
                 oninput="evaluerMdp(this.value)">
          <!-- Barre de force du mot de passe -->
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

  <script>
    /* ---------- Hamburger ---------- */
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navLinks     = document.getElementById('navLinks');
    hamburgerBtn.addEventListener('click', () => navLinks.classList.toggle('active'));

    /* ---------- Indicateur de force du mot de passe ---------- */
    function evaluerMdp(valeur) {
      const barres  = [document.getElementById('b1'), document.getElementById('b2'),
                       document.getElementById('b3'), document.getElementById('b4')];
      let score = 0;

      if (valeur.length >= 6)                    score++;
      if (valeur.length >= 10)                   score++;
      if (/[A-Z]/.test(valeur) && /[0-9]/.test(valeur)) score++;
      if (/[^A-Za-z0-9]/.test(valeur))           score++;

      const couleurs = ['#e74c3c', '#e67e22', '#f1c40f', '#2ecc71'];

      barres.forEach((b, i) => {
        b.style.backgroundColor = i < score ? couleurs[score - 1] : 'var(--border)';
      });
    }
  </script>

</body>
</html>