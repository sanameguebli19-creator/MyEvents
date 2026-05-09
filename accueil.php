<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Accueil</title>
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

    .logo img {
      height: 80px;
      width: auto;
    }

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
      transition: all 0.3s ease;
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
       HERO
    ============================================================ */
    .hero {
      text-align: center;
      padding: 80px 20px 70px;
      background-color: var(--secondary);
      border-bottom: 1px solid var(--border);
    }

    .hero h1 {
      font-family: var(--font-title);
      font-size: 2.8rem;
      color: var(--primary);
      margin-bottom: 20px;
      font-style: italic;
      line-height: 1.3;
    }

    .hero p {
      font-size: 1.05rem;
      color: var(--text-light);
      margin-bottom: 14px;
      line-height: 1.7;
      max-width: 560px;
      margin-left: auto;
      margin-right: auto;
    }

    .hero .tagline {
      font-style: italic;
      color: var(--primary);
      font-size: 1rem;
      margin-bottom: 34px;
      display: block;
    }

    /* CORRECTION BUG : le lien était dans le <button>
       → <a> dans un <button> est invalide en HTML5.
       On utilise maintenant un <a> stylisé comme bouton. */
    .btn-hero {
      display: inline-block;
      background-color: var(--primary);
      color: #fff;
      text-decoration: none;
      font-size: 1rem;
      font-family: var(--font-body);
      font-weight: 500;
      padding: 16px 36px;
      border-radius: var(--radius);
      border: none;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .btn-hero:hover {
      background-color: var(--primary-dark);
    }

    /* ============================================================
       NOS ÉVÉNEMENTS
    ============================================================ */
    .nos-evenements {
      text-align: center;
      padding: 75px 20px;
      background-color: var(--primary-light);
      /* CORRECTION : background-size:contain causait un rendu cassé
         sur certaines résolutions — remplacé par cover avec overlay */
      background-image: url('images/sect2.jpg');
      background-size: cover;
      background-position: center;
      position: relative;
    }

    /* Overlay pour lisibilité du texte sur l'image */
    .nos-evenements::before {
      content: '';
      position: absolute;
      inset: 0;
      background-color: rgba(244, 227, 227, 0.82);
    }

    .nos-evenements > * {
      position: relative;
      z-index: 1;
    }

    .nos-evenements h2 {
      font-family: var(--font-title);
      font-size: 2.2rem;
      color: var(--text-main);
      margin-bottom: 16px;
      font-style: italic;
    }

    .nos-evenements p {
      font-size: 1rem;
      color: var(--text-main);
      margin-bottom: 32px;
      line-height: 1.7;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
      font-weight: 500;
    }

    .btn-evenements {
      display: inline-block;
      background-color: var(--primary);
      color: #fff;
      text-decoration: none;
      font-size: 1rem;
      font-family: var(--font-body);
      font-weight: 500;
      padding: 14px 32px;
      border-radius: var(--radius);
      transition: background-color 0.2s ease;
    }

    .btn-evenements:hover {
      background-color: var(--primary-dark);
    }

    /* ============================================================
       INSCRIPTION NEWSLETTER
    ============================================================ */
    .rejoignez-nous {
      text-align: center;
      padding: 70px 20px;
      background-color: var(--secondary);
    }

    .rejoignez-nous h2 {
      font-family: var(--font-title);
      font-size: 2rem;
      color: var(--primary);
      margin-bottom: 14px;
      font-style: italic;
    }

    .rejoignez-nous p {
      font-size: 1rem;
      color: var(--text-light);
      margin-bottom: 30px;
      line-height: 1.7;
      max-width: 460px;
      margin-left: auto;
      margin-right: auto;
    }

    .inscription {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .inscription input {
      padding: 12px 20px;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      width: 360px;
      max-width: 100%;
      font-size: 0.97rem;
      font-family: var(--font-body);
      color: var(--text-main);
      background-color: var(--card-bg);
      outline: none;
      transition: border-color 0.2s;
    }

    .inscription input:focus {
      border-color: var(--primary);
    }

    .inscription button {
      padding: 12px 28px;
      background-color: var(--primary);
      color: #fff;
      border: none;
      border-radius: var(--radius);
      cursor: pointer;
      font-size: 0.97rem;
      font-family: var(--font-body);
      font-weight: 500;
      transition: background-color 0.2s ease;
    }

    .inscription button:hover {
      background-color: var(--primary-dark);
    }

    /* Message de confirmation newsletter */
    .newsletter-msg {
      display: none;
      margin-top: 16px;
      font-size: 0.92rem;
      color: #2e7d32;
      font-weight: 500;
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

    .footer p {
      color: var(--text-light);
      font-size: 0.88rem;
    }

    .footer-social {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .footer-social span {
      font-size: 0.88rem;
      color: var(--text-light);
    }

    .footer a img {
      width: 26px;
      height: 26px;
      vertical-align: middle;
      opacity: 0.8;
      transition: opacity 0.2s;
    }

    .footer a img:hover {
      opacity: 1;
    }

    /* ============================================================
       RESPONSIVE MOBILE
    ============================================================ */
    @media (max-width: 768px) {
      .navbar {
        padding: 10px 20px;
        flex-wrap: wrap;
      }

      .logo img {
        height: 55px;
      }

      .hamburger {
        display: flex;
      }

      .nav-links {
        display: none;
        width: 100%;
      }

      .nav-links.active {
        display: block;
      }

      .nav-links ul {
        flex-direction: column;
        gap: 0;
        padding: 8px 0;
      }

      .nav-links ul li {
        padding: 10px 12px;
        border-bottom: 1px solid var(--border);
      }

      .nav-links ul li:last-child {
        border-bottom: none;
      }

      .hero {
        padding: 50px 16px;
      }

      .hero h1 {
        font-size: 1.9rem;
      }

      .nos-evenements {
        padding: 55px 16px;
      }

      .nos-evenements h2 {
        font-size: 1.7rem;
      }

      .inscription {
        flex-direction: column;
        align-items: center;
      }

      .inscription input {
        width: 100%;
      }

      .footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 24px 16px;
      }
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
      <span></span>
      <span></span>
      <span></span>
    </button>
    <div class="nav-links" id="navLinks">
      <ul>
        <li><a href="accueil.php" class="active">Accueil</a></li>
        <li><a href="evenements.php">Événements</a></li>
        <li><a href="connexion.php">Connexion</a></li>
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
    <!-- CORRECTION : <a> dans <button> est invalide en HTML5.
         On utilise directement un <a> stylisé en bouton. -->
    <span class="tagline">Votre confiance est la clé de notre succès.</span>
    <a href="evenements.php" class="btn-hero">Créer ton événement</a>
  </section>

  <!-- ==================== NOS ÉVÉNEMENTS ==================== -->
  <section class="nos-evenements">
    <h2>Nos événements</h2>
    <p>Découvrez nos événements récents et à venir, où nous avons créé des expériences
       mémorables pour nos clients.</p>
    <!-- CORRECTION : même problème <a> dans <button> → remplacé -->
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

  <!-- ==================== JAVASCRIPT ==================== -->
  <script>
    /* ---------- Hamburger ---------- */
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navLinks     = document.getElementById('navLinks');

    hamburgerBtn.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });

    /* ---------- Newsletter ---------- */
    function sInscrire() {
      const email = document.getElementById('emailNewsletter').value.trim();
      const msg   = document.getElementById('newsletterMsg');

      if (!email || !email.includes('@')) {
        alert('Veuillez entrer une adresse email valide.');
        return;
      }

      // Ici vous pourrez brancher un appel PHP/API pour enregistrer l'email
      msg.style.display = 'block';
      document.getElementById('emailNewsletter').value = '';
    }
  </script>

</body>
</html>