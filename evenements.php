<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEvents – Événements</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    /* ============================================================
       VARIABLES & RESET
    ============================================================ */
    :root {
      --primary:        #CA8383;
      --primary-dark:   #7B4444;
      --primary-light:  #F4E3E3;
      --secondary:      #FFFFFF;
      --bg:             #FAF5F5;
      --card-bg:        #FDF8F8;
      --text-main:      #474141;
      --text-light:     #8A7F7F;
      --border:         #E5CFCF;
      --success:        #4CAF50;
      --shadow:         0 4px 18px rgba(0,0,0,0.08);
      --radius:         12px;
      --font-title:     'Playfair Display', serif;
      --font-body:      'DM Sans', sans-serif;
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

    /* Fallback si l'image n'existe pas */
    .logo-text {
      font-family: var(--font-title);
      font-size: 1.6rem;
      color: var(--primary);
      letter-spacing: 0.05em;
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
      background-color: var(--secondary);
      padding: 55px 20px 40px;
      text-align: center;
      border-bottom: 1px solid var(--border);
    }

    .hero h1 {
      font-family: var(--font-title);
      font-size: 2.4rem;
      color: var(--primary);
      margin-bottom: 10px;
      font-style: italic;
    }

    .hero p {
      font-size: 1.05rem;
      color: var(--text-light);
      margin-bottom: 28px;
    }

    /* Barre de recherche */
    .input-group {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .input-group input {
      padding: 12px 20px;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      width: 420px;
      max-width: 100%;
      font-size: 1rem;
      font-family: var(--font-body);
      color: var(--text-main);
      background-color: var(--card-bg);
      outline: none;
      transition: border-color 0.2s;
    }

    .input-group input:focus {
      border-color: var(--primary);
    }

    .input-group button {
      padding: 12px 24px;
      background-color: var(--primary);
      color: #fff;
      border: none;
      border-radius: var(--radius);
      cursor: pointer;
      font-size: 0.95rem;
      font-family: var(--font-body);
      font-weight: 500;
      transition: background-color 0.2s;
    }

    .input-group button:hover {
      background-color: var(--primary-dark);
    }

    /* Filtres de catégories */
    .categorie {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    .categorie button {
      background-color: var(--card-bg);
      border: 1.5px solid var(--primary);
      border-radius: 30px;
      cursor: pointer;
      padding: 8px 22px;
      color: var(--primary);
      font-size: 0.9rem;
      font-family: var(--font-body);
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .categorie button:hover,
    .categorie button.active {
      background-color: var(--primary);
      color: #fff;
    }

    /* ============================================================
       CHIFFRES CLÉS
    ============================================================ */
    .nos-chiffres {
      display: flex;
      justify-content: center;
      gap: 60px;
      padding: 40px 20px;
      background-color: var(--primary-light);
      flex-wrap: wrap;
    }

    .nos-chiffres .chiffre {
      text-align: center;
    }

    .nos-chiffres .chiffre h2 {
      font-family: var(--font-title);
      font-size: 2.2rem;
      color: var(--primary-dark);
      margin-bottom: 4px;
    }

    .nos-chiffres .chiffre p {
      font-size: 0.9rem;
      color: var(--text-light);
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    /* ============================================================
       CARDS ÉVÉNEMENTS
    ============================================================ */
    .cards {
      padding: 55px 40px;
      background-color: var(--secondary);
      text-align: center;
    }

    .cards h2 {
      font-family: var(--font-title);
      font-size: 1.9rem;
      color: var(--primary);
      margin-bottom: 35px;
      font-style: italic;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .evenement-item {
      background-color: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 22px;
      text-align: left;
      transition: box-shadow 0.3s ease, transform 0.2s ease;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .evenement-item:hover {
      box-shadow: var(--shadow);
      transform: translateY(-3px);
    }

    .badge {
      display: inline-block;
      background-color: var(--primary);
      color: #fff;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 500;
      letter-spacing: 0.04em;
      width: fit-content;
    }

    .evenement-item h3 {
      font-family: var(--font-title);
      color: var(--primary-dark);
      font-size: 1.2rem;
      margin: 0;
    }

    .evenement-item > p {
      font-size: 0.93rem;
      color: var(--text-light);
      line-height: 1.6;
    }

    .date {
      font-size: 0.88rem;
      color: var(--text-main);
      font-weight: 500;
    }

    /* Boutons d'action de la carte */
    .btn-groupe {
      display: flex;
      gap: 10px;
      margin-top: 5px;
    }

    .btn-participer,
    .btn-info {
      flex: 1;
      padding: 9px 14px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.88rem;
      font-family: var(--font-body);
      font-weight: 500;
      transition: all 0.2s ease;
      border: 1.5px solid var(--primary);
    }

    .btn-participer {
      background-color: var(--primary);
      color: #fff;
    }

    .btn-participer:hover {
      background-color: var(--primary-dark);
      border-color: var(--primary-dark);
    }

    .btn-info {
      background-color: transparent;
      color: var(--primary);
    }

    .btn-info:hover {
      background-color: var(--primary-light);
    }

    /* Détails déroulants */
    .details {
      display: none;
      padding: 14px;
      background-color: var(--primary-light);
      border-radius: 8px;
      font-size: 0.88rem;
      color: var(--text-main);
      line-height: 2;
      border-left: 3px solid var(--primary);
    }

    .details.open {
      display: block;
      animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-4px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ============================================================
       SECTION CONTACT
    ============================================================ */
    .contact {
      padding: 60px 20px;
      text-align: center;
      background-color: var(--bg);
    }

    .contact h2 {
      font-family: var(--font-title);
      font-size: 1.9rem;
      color: var(--primary);
      margin-bottom: 14px;
      font-style: italic;
    }

    .contact p {
      font-size: 0.97rem;
      color: var(--text-light);
      margin-bottom: 28px;
      line-height: 1.7;
      max-width: 520px;
      margin-left: auto;
      margin-right: auto;
    }

    .contact .btn-contact {
      padding: 14px 36px;
      font-size: 0.97rem;
      font-family: var(--font-body);
      font-weight: 500;
      color: #fff;
      background-color: var(--primary);
      border-radius: var(--radius);
      border: none;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .contact .btn-contact:hover {
      background-color: var(--primary-dark);
    }

    /* ============================================================
       NOS SERVICES
    ============================================================ */
    .nos-services {
      padding: 60px 40px;
      background-color: var(--secondary);
      text-align: center;
    }

    .nos-services h2 {
      font-family: var(--font-title);
      font-size: 1.9rem;
      color: var(--primary);
      margin-bottom: 35px;
      font-style: italic;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      max-width: 900px;
      margin: 0 auto;
    }

    .service-item {
      background-color: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 28px 20px;
      text-align: left;
      transition: box-shadow 0.2s;
    }

    .service-item:hover {
      box-shadow: var(--shadow);
    }

    .service-item h3 {
      font-family: var(--font-title);
      font-size: 1.05rem;
      color: var(--primary-dark);
      margin-bottom: 10px;
    }

    .service-item p {
      font-size: 0.88rem;
      color: var(--text-light);
      line-height: 1.6;
    }

    /* ============================================================
       MODALE
    ============================================================ */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      inset: 0;
      background-color: rgba(71, 65, 65, 0.5);
      justify-content: center;
      align-items: center;
    }

    /* CORRECTION BUG : la modal était toujours visible (display:flex dans le CSS) */
    /* Elle s'affiche uniquement via JS avec modal.style.display = 'flex' */

    .modal-content {
      background-color: #fff;
      padding: 32px 28px;
      border-radius: var(--radius);
      width: 400px;
      max-width: 92vw;
      text-align: center;
      position: relative;
      box-shadow: 0 8px 30px rgba(0,0,0,0.15);
      animation: slideUp 0.25s ease;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(20px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .modal-content h2 {
      font-family: var(--font-title);
      font-size: 1.3rem;
      color: var(--primary);
      margin-bottom: 20px;
    }

    .btn-close {
      position: absolute;
      top: 12px;
      right: 14px;
      background: none;
      border: none;
      font-size: 1.1rem;
      cursor: pointer;
      color: var(--text-light);
      line-height: 1;
      padding: 4px;
    }

    .btn-close:hover {
      color: var(--primary-dark);
    }

    .modal-content input {
      display: block;
      width: 100%;
      padding: 11px 14px;
      margin-bottom: 12px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 0.93rem;
      font-family: var(--font-body);
      color: var(--text-main);
      outline: none;
      transition: border-color 0.2s;
    }

    .modal-content input:focus {
      border-color: var(--primary);
    }

    .btn-submit {
      width: 100%;
      padding: 12px;
      background-color: var(--primary);
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.97rem;
      font-family: var(--font-body);
      font-weight: 500;
      transition: background-color 0.2s;
      margin-top: 4px;
    }

    .btn-submit:hover {
      background-color: var(--primary-dark);
    }

    .success-message {
      display: none;
      margin-top: 14px;
      padding: 10px;
      background-color: #e8f5e9;
      color: #2e7d32;
      border-radius: 8px;
      font-size: 0.9rem;
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
      margin-top: 0;
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

      .hero h1 {
        font-size: 1.7rem;
      }

      .cards {
        padding: 40px 16px;
      }

      .card-grid {
        grid-template-columns: 1fr;
      }

      .nos-chiffres {
        gap: 30px;
        padding: 30px 16px;
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
      <!-- Si l'image n'existe pas, le texte s'affiche à la place -->
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
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="evenements.php" class="active">Événements</a></li>
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
  <section class="nos-chiffres">
    <div class="chiffre">
      <h2>126</h2>
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

  <!-- ==================== CARDS ÉVÉNEMENTS ==================== -->
  <section class="cards">
    <h2>Découvrez nos événements à venir</h2>
    <div class="card-grid" id="cardGrid">

      <!-- Carte 1 -->
      <div class="evenement-item" data-periode="semaine">
        <span class="badge">Places limitées</span>
        <h3>Festival de Musique</h3>
        <p>Venez vibrer au rythme de la musique avec des artistes locaux et internationaux.</p>
        <div class="date">📅 20 avril 2026</div>
        <div class="btn-groupe">
          <button class="btn-participer" onclick="ouvrirModal('Festival de Musique')">Participer</button>
          <button class="btn-info" onclick="toggleDetails(this)">Plus d'infos ▼</button>
        </div>
        <div class="details">
          <p>📍 Lieu : Parc de la Villette, Paris</p>
          <p>🕐 Heure : 19h00 – 23h00</p>
          <p>💰 Prix : Gratuit</p>
          <p>👥 Places disponibles : 12</p>
        </div>
      </div>

      <!-- Carte 2 -->
      <div class="evenement-item" data-periode="mois">
        <span class="badge">Places limitées</span>
        <h3>Concert de Rock</h3>
        <p>Rejoignez-nous pour une soirée de rock en direct avec des groupes locaux et internationaux.</p>
        <div class="date">📅 2 mai 2026</div>
        <div class="btn-groupe">
          <!-- CORRECTION BUG : le nom de l'événement était 'Festival de Musique' pour tous -->
          <button class="btn-participer" onclick="ouvrirModal('Concert de Rock')">Participer</button>
          <button class="btn-info" onclick="toggleDetails(this)">Plus d'infos ▼</button>
        </div>
        <div class="details">
          <p>📍 Lieu : Zénith de Paris</p>
          <p>🕐 Heure : 20h00 – 00h00</p>
          <p>💰 Prix : 15 €</p>
          <p>👥 Places disponibles : 50</p>
        </div>
      </div>

      <!-- Carte 3 -->
      <div class="evenement-item" data-periode="trimestre">
        <span class="badge">Places limitées</span>
        <h3>Atelier de Cuisine</h3>
        <p>Apprenez à cuisiner des plats délicieux avec notre chef renommé.</p>
        <div class="date">📅 16 juin 2026</div>
        <div class="btn-groupe">
          <!-- CORRECTION BUG : le nom de l'événement était 'Festival de Musique' pour tous -->
          <button class="btn-participer" onclick="ouvrirModal('Atelier de Cuisine')">Participer</button>
          <button class="btn-info" onclick="toggleDetails(this)">Plus d'infos ▼</button>
        </div>
        <div class="details">
          <p>📍 Lieu : Studio Culinaire, Lyon</p>
          <p>🕐 Heure : 14h00 – 17h00</p>
          <p>💰 Prix : 25 €</p>
          <p>👥 Places disponibles : 20</p>
        </div>
      </div>

    </div>
  </section>

  <!-- ==================== MODALE INSCRIPTION ==================== -->
  <!--
    CORRECTIONS APPORTÉES :
    1. display:none par défaut (était display:flex → modal toujours visible)
    2. margin-left:500px supprimé (modal décalée sur desktop)
    3. Bouton fermer accessible via aria-label
    4. Chaque événement ouvre une modale avec son propre nom
  -->
  <div class="modal" id="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-content">
      <button class="btn-close" onclick="fermerModal()" aria-label="Fermer">✕</button>
      <h2 id="modalTitle">Inscription</h2>
      <input type="text"  id="nomInput"   placeholder="Votre nom complet" required>
      <input type="email" id="emailInput" placeholder="Votre adresse email" required>
      <input type="tel"   id="telInput"   placeholder="Votre numéro de téléphone">
      <button class="btn-submit" onclick="soumettre()">Confirmer l'inscription</button>
      <div class="success-message" id="successMsg">✅ Inscription confirmée ! À bientôt.</div>
    </div>
  </div>

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

  <!-- ==================== JAVASCRIPT ==================== -->
  <script>
    /* ---------- Hamburger ---------- */
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navLinks     = document.getElementById('navLinks');

    hamburgerBtn.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });

    /* ---------- Détails déroulants ---------- */
    function toggleDetails(button) {
      const details = button.closest('.btn-groupe').nextElementSibling;
      details.classList.toggle('open');
      button.textContent = details.classList.contains('open')
        ? "Plus d'infos ▲"
        : "Plus d'infos ▼";
    }

    /* ---------- Modale ---------- */
    function ouvrirModal(eventName) {
      document.getElementById('modalTitle').textContent = `Inscription à ${eventName}`;
      document.getElementById('successMsg').style.display = 'none';
      document.getElementById('nomInput').value   = '';
      document.getElementById('emailInput').value = '';
      document.getElementById('telInput').value   = '';
      const modal = document.getElementById('modal');
      modal.style.display = 'flex';
    }

    function fermerModal() {
      document.getElementById('modal').style.display = 'none';
    }

    // Fermer la modale en cliquant à l'extérieur
    document.getElementById('modal').addEventListener('click', function(e) {
      if (e.target === this) fermerModal();
    });

    function soumettre() {
      const nom   = document.getElementById('nomInput').value.trim();
      const email = document.getElementById('emailInput').value.trim();
      const tel   = document.getElementById('telInput').value.trim();

      if (!nom || !email) {
        alert('Veuillez remplir au moins votre nom et votre email.');
        return;
      }

      document.getElementById('successMsg').style.display = 'block';
      setTimeout(fermerModal, 3000);
    }

    /* ---------- Filtres catégories ---------- */
    function filtrerCategorie(btnClique, periode) {
      // Mettre à jour le bouton actif
      document.querySelectorAll('.categorie button').forEach(b => b.classList.remove('active'));
      btnClique.classList.add('active');

      // Afficher/masquer les cartes
      const cartes = document.querySelectorAll('.evenement-item');
      cartes.forEach(carte => {
        if (periode === 'tous' || carte.dataset.periode === periode) {
          carte.style.display = 'flex';
        } else {
          carte.style.display = 'none';
        }
      });
    }

    /* ---------- Recherche ---------- */
    function rechercherEvenement() {
      const terme = document.getElementById('searchInput').value.toLowerCase().trim();
      const cartes = document.querySelectorAll('.evenement-item');
      cartes.forEach(carte => {
        const titre = carte.querySelector('h3').textContent.toLowerCase();
        const desc  = carte.querySelector('p').textContent.toLowerCase();
        carte.style.display = (titre.includes(terme) || desc.includes(terme)) ? 'flex' : 'none';
      });
    }

    // Recherche en appuyant sur Entrée
    document.getElementById('searchInput').addEventListener('keydown', function(e) {
      if (e.key === 'Enter') rechercherEvenement();
    });
  </script>

</body>
</html>