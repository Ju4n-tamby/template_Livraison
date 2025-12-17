CREATE DATABASE Livraison;
USE Livraison;

CREATE TABLE lvr_Livreurs(
  id_livreur INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100),
  salaire DECIMAL(10,2)
);

CREATE TABLE lvr_Vehicules(
  id_vehicule INT PRIMARY KEY AUTO_INCREMENT,
  modele VARCHAR(200),
  consommation DECIMAL(10,2)
);

CREATE TABLE lvr_VoitureDuJour(
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_vehicule INT,
  id_livreur INT,
  date DATE,
  FOREIGN KEY (id_vehicule) REFERENCES lvr_Vehicules(id_vehicule),
  FOREIGN KEY (id_livreur) REFERENCES lvr_Livreurs(id_livreur)
);

CREATE TABLE lvr_Zone(
  id_zone INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100),
  distance_km DECIMAL(10,2)
);

CREATE TABLE lvr_Statut(
  id_statut INT PRIMARY KEY AUTO_INCREMENT,
  libelle VARCHAR(100)
);

CREATE TABLE lvr_Livraisons(
  id_livraison INT PRIMARY KEY AUTO_INCREMENT,
  id_voiture_du_jour INT,
  depart VARCHAR(200),
  id_zone INT,
  id_statut INT,
  date_livraison DATETIME,
  colis VARCHAR(200),
  cout_revient DECIMAL(10,2),
  FOREIGN KEY (id_voiture_du_jour) REFERENCES lvr_VoitureDuJour(id),
  FOREIGN KEY (id_zone) REFERENCES lvr_Zone(id_zone),
  FOREIGN KEY (id_statut) REFERENCES lvr_Statut(id_statut)
);


