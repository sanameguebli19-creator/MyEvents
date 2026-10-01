

CREATE DATABASE IF NOT EXISTS myevents
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE myevents;

-- ---------- Utilisateurs ----------
CREATE TABLE utilisateurs (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  nom           VARCHAR(100) NOT NULL,
  email         VARCHAR(150) NOT NULL UNIQUE,
  mot_de_passe  VARCHAR(255) NOT NULL,   -- hashé avec password_hash()
  telephone     VARCHAR(20)  DEFAULT NULL,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------- Événements ----------
CREATE TABLE evenements (
  id                  INT AUTO_INCREMENT PRIMARY KEY,
  titre               VARCHAR(150) NOT NULL,
  description         TEXT         DEFAULT NULL,
  `date`              DATE         NOT NULL,
  horaire             VARCHAR(50)  DEFAULT NULL,   -- ex : "19h00 – 23h00"
  lieu                VARCHAR(150) DEFAULT NULL,
  prix                DECIMAL(6,2) NOT NULL DEFAULT 0,
  places_disponibles  INT          DEFAULT NULL,
  periode             ENUM('semaine','mois','trimestre') NOT NULL DEFAULT 'mois',
  created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------- Participations ----------
CREATE TABLE participations (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  user_id    INT NOT NULL,
  event_id   INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_participation (user_id, event_id),
  FOREIGN KEY (user_id)  REFERENCES utilisateurs(id) ON DELETE CASCADE,
  FOREIGN KEY (event_id) REFERENCES evenements(id)   ON DELETE CASCADE
);

INSERT INTO evenements (titre, description, `date`, horaire, lieu, prix, places_disponibles, periode) VALUES
('Festival de Musique',
 'Venez vibrer au rythme de la musique avec des artistes locaux et internationaux.',
 '2026-04-20', '19h00 – 23h00', 'Parc de la Villette, Paris', 0.00, 12, 'semaine'),

('Concert de Rock',
 'Rejoignez-nous pour une soirée de rock en direct avec des groupes locaux et internationaux.',
 '2026-05-02', '20h00 – 00h00', 'Zénith de Paris', 15.00, 50, 'mois'),

('Atelier de Cuisine',
 'Apprenez à cuisiner des plats délicieux avec notre chef renommé.',
 '2026-06-16', '14h00 – 17h00', 'Studio Culinaire, Lyon', 25.00, 20, 'trimestre');