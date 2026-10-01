/* ============================================================
   MYEVENTS — script commun
   Chaque fonction vérifie que ses éléments existent avant
   d'agir : ce même fichier peut être chargé sur n'importe
   quelle page sans provoquer d'erreur.
   ============================================================ */

(() => {
  'use strict';

  /* ---------- MENU HAMBURGER (toutes les pages) ---------- */

  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const navLinks = document.getElementById('navLinks');

  if (hamburgerBtn && navLinks) {
    hamburgerBtn.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }

  /* ---------- NEWSLETTER (accueil.php) ---------- */

  window.sInscrire = function () {
    const emailInput = document.getElementById('emailNewsletter');
    const msg = document.getElementById('newsletterMsg');
    if (!emailInput || !msg) return;

    const email = emailInput.value.trim();

    if (!email || !email.includes('@')) {
      alert('Veuillez entrer une adresse email valide.');
      return;
    }

    // TODO : brancher un vrai enregistrement (fetch vers un script PHP)
    msg.style.display = 'block';
    emailInput.value = '';
  };

  /* ---------- FORCE DU MOT DE PASSE (inscription.php) ---------- */

  window.evaluerMdp = function (valeur) {
    const barres = ['b1', 'b2', 'b3', 'b4']
      .map((id) => document.getElementById(id))
      .filter(Boolean);

    if (!barres.length) return;

    let score = 0;
    if (valeur.length >= 6) score++;
    if (valeur.length >= 10) score++;
    if (/[A-Z]/.test(valeur) && /[0-9]/.test(valeur)) score++;
    if (/[^A-Za-z0-9]/.test(valeur)) score++;

    const couleurs = ['#e74c3c', '#e67e22', '#f1c40f', '#2ecc71'];

    barres.forEach((b, i) => {
      b.style.backgroundColor = i < score ? couleurs[score - 1] : 'var(--border)';
    });
  };

  /* ---------- PAGE ÉVÉNEMENTS (evenements.php) ---------- */

  window.toggleDetails = function (button) {
    const details = button.closest('.btn-groupe')?.nextElementSibling;
    if (!details) return;

    details.classList.toggle('open');
    button.textContent = details.classList.contains('open') ? "Plus d'infos ▲" : "Plus d'infos ▼";
  };

  // La modale de participation factice (ouvrirModal/soumettre) a été retirée :
  // le bouton "Participer" soumet maintenant un vrai formulaire vers
  // backend/config/participer.php (voir evenements.php).

  window.filtrerCategorie = function (btnClique, periode) {
    document.querySelectorAll('.categorie button').forEach((b) => b.classList.remove('active'));
    btnClique.classList.add('active');

    document.querySelectorAll('.evenement-item').forEach((carte) => {
      carte.style.display = (periode === 'tous' || carte.dataset.periode === periode) ? 'flex' : 'none';
    });
  };

  window.rechercherEvenement = function () {
    const input = document.getElementById('searchInput');
    if (!input) return;

    const terme = input.value.toLowerCase().trim();

    document.querySelectorAll('.evenement-item').forEach((carte) => {
      const titre = carte.querySelector('h3')?.textContent.toLowerCase() ?? '';
      const desc = carte.querySelector('p')?.textContent.toLowerCase() ?? '';
      carte.style.display = (titre.includes(terme) || desc.includes(terme)) ? 'flex' : 'none';
    });
  };

  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') window.rechercherEvenement();
    });
  }

  /* ---------- PAGE NOTIFICATIONS (notification.php) ---------- */

  function mettreAJourCompteurNotifs() {
    const compteur = document.getElementById('nbNonLues');
    if (!compteur) return;

    const nbNonLues = document.querySelectorAll('.notif-item.non-lue').length;
    compteur.textContent = nbNonLues;

    const etatVide = document.getElementById('etatVide');
    if (etatVide && document.querySelectorAll('.notif-item').length === 0) {
      etatVide.style.display = 'block';
    }
  }

  window.marquerLu = function (item) {
    if (item.classList.contains('non-lue')) {
      item.classList.remove('non-lue');
      item.classList.add('lue');
      mettreAJourCompteurNotifs();
    }
  };

  window.toutMarquerLu = function () {
    document.querySelectorAll('.notif-item.non-lue').forEach((item) => {
      item.classList.remove('non-lue');
      item.classList.add('lue');
    });
    mettreAJourCompteurNotifs();
  };

  /* ---------- ESPACE CLIENT (dashboard.php) ---------- */

  window.toggleFormModifier = function () {
    const form = document.getElementById('formModifier');
    if (!form) return;

    form.style.display = form.style.display === 'block' ? 'none' : 'block';
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };
})();