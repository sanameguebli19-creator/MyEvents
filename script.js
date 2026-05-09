  
  //humberger
  const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navLinks = document.getElementById('navLinks');

    hamburgerBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    }); 
    //details
    function toggleDetails(button) {
        const details = button.parentElement.nextElementSibling;
        details.classList.toggle('open');
        button.textContent = details.classList.contains('open') ? 'Plus d\'infos ▲' : 'Plus d\'infos ▼';
    }
    //popup
    function ouvrirModal(eventName) {
        document.getElementById('modalTitle').textContent = `Inscription à ${eventName}`;
        document.getElementById('modal').style.display = 'block';
    }
    function fermerModal() {
        document.getElementById('modal').style.display = 'none';
        document.getElementById('successMsg').style.display = 'none';
    }
    function soumettre() {
        const nom = document.getElementById('nomInput').value;
        const email = document.getElementById('emailInput').value;
        const tel = document.getElementById('telInput').value;
        if (nom && email && tel) {
            document.getElementById('successMsg').style.display = 'block';
            setTimeout(fermerModal, 3000);
        } else {
            alert('Veuillez remplir tous les champs.');
        }
    }
   