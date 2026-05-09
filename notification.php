<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Notifications</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    /* ============================================================
       VARIABLES & RESET
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
      max-width: 700px;
      margin: 50px auto;
      padding: 0 20px;
    }

    .main-content h1 {
      font-family: var(--font-title);
      font-size: 2rem;
      color: var(--primary);
      font-style: italic;
      margin-bottom: 6px;
    }

    .sous-titre {
      font-size: 0.93rem;
      color: var(--text-light);
      margin-bottom: 30px;
    }

    /* Barre d'actions */
    .barre-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }

    .compteur {
      font-size: 0.88rem;
      color: var(--text-light);
    }

    .compteur span {
      font-weight: 600;
      color: var(--primary);
    }

    .btn-tout-lire {
      background: none;
      border: 1.5px solid var(--primary);
      color: var(--primary);
      padding: 7px 18px;
      border-radius: 20px;
      cursor: pointer;
      font-size: 0.85rem;
      font-family: var(--font-body);
      font-weight: 500;
      transition: all 0.2s;
    }

    .btn-tout-lire:hover {
      background-color: var(--primary);
      color: #fff;
    }

    /* ============================================================
       LISTE DES NOTIFICATIONS
    ============================================================ */
    .notif-liste {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .notif-item {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      background-color: var(--secondary);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 18px 20px;
      cursor: pointer;
      transition: box-shadow 0.2s, transform 0.2s;
      position: relative;
    }

    .notif-item:hover {
      box-shadow: var(--shadow);
      transform: translateY(-2px);
    }

    /* Notification non lue — bordure gauche colorée */
    .notif-item.non-lue {
      border-left: 4px solid var(--primary);
      background-color: #FFF7F7;
    }

    /* Icône de la notification */
    .notif-icone {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background-color: var(--primary-light);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      flex-shrink: 0;
    }

    .notif-item.non-lue .notif-icone {
      background-color: var(--primary);
    }

    /* Contenu texte */
    .notif-corps {
      flex: 1;
    }

    .notif-titre {
      font-weight: 500;
      font-size: 0.97rem;
      color: var(--text-main);
      margin-bottom: 4px;
    }

    .notif-item.non-lue .notif-titre {
      font-weight: 600;
      color: var(--primary-dark);
    }

    .notif-desc {
      font-size: 0.87rem;
      color: var(--text-light);
      line-height: 1.5;
    }

    .notif-date {
      font-size: 0.78rem;
      color: var(--text-light);
      margin-top: 6px;
    }

    /* Point rouge non lue */
    .point-non-lue {
      width: 9px;
      height: 9px;
      background-color: var(--primary);
      border-radius: 50%;
      flex-shrink: 0;
      margin-top: 6px;
    }

    .notif-item.lue .point-non-lue {
      display: none;
    }

    /* ============================================================
       ÉTAT VIDE (aucune notification)
    ============================================================ */
    .etat-vide {
      display: none;
      text-align: center;
      padding: 60px 20px;
    }

    .etat-vide .icone-vide {
      font-size: 3rem;
      margin-bottom: 16px;
    }

    .etat-vide h3 {
      font-family: var(--font-title);
      font-size: 1.3rem;
      color: var(--primary);
      margin-bottom: 8px;
      font-style: italic;
    }

    .etat-vide p {
      font-size: 0.92rem;
      color: var(--text-light);
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
      margin-top: 60px;
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
      .notif-item { padding: 14px 16px; }
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
        <li><a href="notification.php" class="active">
          <img src="images/notification.gif" alt="Notifications" onerror="this.outerHTML='🔔'">
        </a></li>
      </ul>
    </div>
  </nav>

  <!-- ==================== CONTENU ==================== -->
  <main class="main-content">
    <h1>🔔 Notifications</h1>
    <p class="sous-titre">Retrouvez ici toutes vos alertes et mises à jour.</p>

    <div class="barre-actions">
      <p class="compteur"><span id="nbNonLues">3</span> notification(s) non lue(s)</p>
      <button class="btn-tout-lire" onclick="toutMarquerLu()">Tout marquer comme lu</button>
    </div>

    <!-- Liste des notifications -->
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

    <!-- État vide -->
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

  <script>
    /* ---------- Hamburger ---------- */
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navLinks     = document.getElementById('navLinks');
    hamburgerBtn.addEventListener('click', () => navLinks.classList.toggle('active'));

    /* ---------- Marquer une notification comme lue ---------- */
    function marquerLu(item) {
      if (item.classList.contains('non-lue')) {
        item.classList.remove('non-lue');
        item.classList.add('lue');
        mettreAJourCompteur();
      }
    }

    /* ---------- Tout marquer comme lu ---------- */
    function toutMarquerLu() {
      document.querySelectorAll('.notif-item.non-lue').forEach(item => {
        item.classList.remove('non-lue');
        item.classList.add('lue');
      });
      mettreAJourCompteur();
    }

    /* ---------- Mettre à jour le compteur ---------- */
    function mettreAJourCompteur() {
      const nbNonLues = document.querySelectorAll('.notif-item.non-lue').length;
      document.getElementById('nbNonLues').textContent = nbNonLues;

      // Afficher l'état vide si toutes les notifications sont lues
      if (document.querySelectorAll('.notif-item').length === 0) {
        document.getElementById('etatVide').style.display = 'block';
      }
    }
  </script>

</body>
</html>