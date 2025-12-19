CREATE DATABASE Livraison;
USE Livraison;

CREATE TABLE lvr_Livreurs(
  id_livreur INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100),
  salaire DECIMAL(10,2)
);

CREATE TABLE lvr_Vehicules(
  id_vehicule INT PRIMARY KEY AUTO_INCREMENT,
  marque VARCHAR(200)
);

CREATE TABLE lvr_Zone(
  id_zone INT PRIMARY KEY AUTO_INCREMENT,
  zone VARCHAR(100)
);

CREATE TABLE lvr_Statut(
  id_statut INT PRIMARY KEY AUTO_INCREMENT,
  libelle VARCHAR(100)
);

CREATE TABLE lvr_Param_Livraison(
  id_param INT PRIMARY KEY AUTO_INCREMENT,
  prix_kg DECIMAL(10,2),
  adresse_depart VARCHAR(200)
);

CREATE TABLE lvr_Colis(
  id_colis INT PRIMARY KEY AUTO_INCREMENT,
  libelle VARCHAR(200),
  poids DECIMAL(10,2)
);

CREATE TABLE lvr_Livraisons(
  id_livraison INT PRIMARY KEY AUTO_INCREMENT,
  id_vehicule INT,
  id_livreur INT,
  montant_recette DECIMAL(10,2),
  id_zone INT,
  id_colis INT,
  date_livraison DATETIME,
  id_statut INT,
  FOREIGN KEY (id_vehicule) REFERENCES lvr_Vehicules(id_vehicule),
  FOREIGN KEY (id_livreur) REFERENCES lvr_Livreurs(id_livreur),
  FOREIGN KEY (id_zone) REFERENCES lvr_Zone(id_zone),
  FOREIGN KEY (id_colis) REFERENCES lvr_Colis(id_colis),
  FOREIGN KEY (id_statut) REFERENCES lvr_Statut(id_statut)
);

INSERT INTO lvr_Param_Livraison (prix_kg, adresse_depart) VALUES (3000, 'Anosibe, Antananarivo');

INSERT INTO lvr_Statut (libelle) VALUES
('En attente'), ('Livré'), ('Annulé');

INSERT INTO lvr_Livreurs (nom, salaire) VALUES
('Jean Dupont', 2500), ('Marie0 Curie', 2700), ('Albert Einstein', 2800), ('Isaac Newton', 2600), ('Galileo Galilei', 2550);

INSERT INTO lvr_Vehicules (marque) VALUES
('Toyota'), ('Ford'), ('Honda'), ('Nissan'), ('Chevrolet');

-- INSERT INTO lvr_Zone (zone) VALUES
-- ('Antananarivo'), ('Toamasina'), ('Fianarantsoa'), ('Mahajanga'), ('Toliara');

INSERT INTO lvr_Vehicules (marque) VALUES 
('Volkswagen'), ('Porsche'), ('BMW'), ('Audi'), ('Mercedes-Benz');


INSERT INTO lvr_Livreurs (nom, salaire) VALUES
('Juan Albert', 15000),('Lupin Man', 15000), ('Nathan Pois', 15000), ('Parish Yoh', 15000), ('Pont ', 15000), 
('Mihaja Man', 18000), 
('Toit Gut', 18000), ('Grut', 18000),
('Michael Faraday', 20000), ('Charles Darwin', 20000), ('Chaplin Tolet', 20000), ('Nunes Mendes', 20000);

ALTER TABLE lvr_Zone ADD COLUMN bonus DECIMAL(10,2) DEFAULT 0;

TRUNCATE TABLE lvr_Zone;

INSERT INTO lvr_Zone (bonus) VALUES
('Antananarivo', 12.5), ('Toamasina', 12.5), ('Fianarantsoa', 12.5), ('Mahajanga', 0), ('Toliara', 0);