-- Version du serveur : 8.0.27

--
-- Base de données : tp2_media_web
--
DROP DATABASE IF EXISTS tp2_media_web;
CREATE DATABASE IF NOT EXISTS tp2_media_web;
USE tp2_media_web;
-- --------------------------------------------------------


--
-- Structure de la table genres
--

DROP TABLE IF EXISTS genres;
CREATE TABLE IF NOT EXISTS genres (
  id int NOT NULL AUTO_INCREMENT,
  descGenre varchar(45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;


--
-- Dumping data for table `genres`
--

INSERT INTO genres (id,descGenre) VALUES
(1, 'POP'),
(2, 'Country'),
(3, 'Flamenco'),
(4, 'Hard rock'),
(5, 'Disco'),
(6, 'Rock'),
(7, 'Métal'),
(8, 'Jazz'),
(9, 'Classique'),
(10, 'Rap'),
(11, 'Oriental'),
(12, 'Chanson française'),
(13, 'Rai'),
(14, 'Traditionnel'),
(15, 'Autre');
SELECT * FROM GENRES;


--
-- Structure de la table roles
--

DROP TABLE IF EXISTS roles;
CREATE TABLE IF NOT EXISTS roles (
  id tinyint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descRole varchar(30) NOT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table roles
--

INSERT INTO roles (id, descRole) VALUES
(1, 'Chanteur'),
(2, 'Compositeur'),
(3, 'Interprète'),
(4, 'Auteur'),
(10, 'Autre');




--
-- Structure de la table continents
--

DROP TABLE IF EXISTS continents;
CREATE TABLE IF NOT EXISTS continents (
  id tinyint UNSIGNED NOT NULL,
  nom_continent varchar(45) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

--
-- Déchargement des données de la table continents
--

INSERT INTO continents (id, nom_continent) VALUES
(1, 'Europe'),
(2, 'Amérique du Nord'),
(3, 'Asie'),
(4, 'Amérique du Sud'),
(5, 'Afrique'),
(6, 'Océanie');

-- --------------------------------------------------------

--
-- Structure de la table pays
--

DROP TABLE IF EXISTS pays;
CREATE TABLE IF NOT EXISTS pays (
  id int NOT NULL AUTO_INCREMENT,
  nom_pays varchar(30) NOT NULL,
  code_monnaie varchar(3) NOT NULL,
  taux decimal(9,2) NOT NULL DEFAULT '1.00',
  id_continent tinyint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nom_pays (nom_pays),
  KEY fk_pays_continent (id_continent),
  CONSTRAINT fk_pays_continent FOREIGN KEY (id_continent) REFERENCES continents (id) 
) ENGINE=InnoDB;

--
-- Déchargement des données de la table pays
--

INSERT INTO pays (id, nom_pays, code_monnaie, taux, id_continent) VALUES
(1, 'Canada', 'CAD', '1.00', 2),
(2, 'Etats-Unis', 'USD', '0.78', 2),
(3, 'France', 'EUR', '0.69', 1),
(4, 'Suisse', 'CHF', '0.72', 1),
(7, 'Italie', 'EUR', '0.69', 1),
(12, 'Turquie', 'TRY', '10.80', 3),
(13, 'Liban', 'LBP', '15000.00', 3),
(14, 'Algerie', 'DZD', '11035.00', 5),
(15, 'Espagne', 'EUR', '0.69', 1),
(21, 'Maroc', 'MAD', '739.02', 5),
(23, 'Russie', 'RUB', '6173.00', 1),
(24, 'Chine', 'CNY', '495.60', 3);

SELECT * FROM pays;
-- --------------------------------------------------------
--
-- Table structure for table `villes`
--
DROP TABLE IF Exists villes;
CREATE TABLE IF NOT EXISTS villes (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_ville` varchar(30) NOT NULL UNIQUE,
  id_pays int NOT NULL, 
  PRIMARY KEY (`id`),
  KEY fk_ville_pays (id_pays),
  CONSTRAINT fk_ville_pays FOREIGN KEY (id_pays) REFERENCES pays (id) 
) ENGINE=InnoDB;

INSERT INTO `villes` VALUES
(1,  'Montréal',1),
(2,  'Trois-Rivière',1),
(3,  'Québec',1),
(4,  'Toronto',1),
(5,  'Varennes',1),
(8,  'Laval',1),
(12, 'Lévis',1),
(13, 'Winnipeg',1),
(14, 'Victoria',1),
(15, 'Windsor',1),
(16, 'Kingston',1),
(17, 'Ottawa',1),
(18, 'London',1),
(20, 'Vancouver',1),
(21, 'Paris',3),
(22, 'Nice',3),
(23, 'Agen',3),
(24, 'Lille',3),
(26, 'Grenoble',3),
(32, 'New york',2),
(33, 'Washington',2),
(34, 'Los Angeles',2),
(35, 'Dallas',2),
(36, 'Davie',2),
(37, 'Miami',2),
(38, 'Springville',2),
(40, 'Boston',2),
(41, 'Fribourg',4),
(42, 'Lausanne',4),
(43, 'Zurich',4),
(44, 'Genève',4),
(48, 'Izmir',12),
(52, 'Istanbul',12),
(53, 'Bursa',12),
(54, 'Ankara',12),
(55, 'Rome',7),
(57, 'Milan',7),
(60, 'Venise',7),
(61, 'Beyrouth',13),
(62, 'Tripoli',13),
(63, 'Alger',14),
(64, 'Tlemcen',14),
(65, 'Madrid',15),
(66, 'Rabat',21),
(67, 'Oran',14),
(72, 'Marrakech',21),
(73, 'Casablanca',21),
(74, 'Moscou',23),
(75, 'Pékin',24),
(77, 'Shanghai',24),
(79, 'Saint-Pétersbourg',23);
SELECT * FROM villes;

--
-- Table structure for table `albums`
--
DROP TABLE IF EXISTS albums;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `code_album` char(7) NOT NULL unique,
  `date_album` date DEFAULT NULL,
  `id_genre` int(11) NOT NULL,
  `pht_couvt` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  constraint chk_code_album check(regexp_like(code_album, '^[A-Z]{3}[0-9]{4}$')),
  KEY fk_genre_alb (id_genre),
  CONSTRAINT fk_genre_alb FOREIGN KEY (id_genre) REFERENCES genres (id)  
) ENGINE=InnoDB;

--
-- Déchargement des données de la table albums
--

INSERT INTO albums (id, titre, code_album, date_album, id_genre, pht_couvt) VALUES
(1, 'Battleground', 'BAT1245', '2011-11-04', 1, 'batt1.jpeg'),
(2, 'Love Life', 'LOF0011', '1984-03-12', 1, 'Berlin_Love_Life.png'),
(3, 'Falling into You', 'YOU2100', '2007-10-29', 1, 'fallingintoyou.jpg'),
(4, 'Plus bleu', 'PLB0010', '2010-01-01', 12, 'Plusbleu.jpeg'),
(5, 'Enrique', 'ENR0147', '1999-11-23', 1, 'enr122.png'),
(6, 'One World, One Flame', 'ONE1111', '2010-02-02', 6, 'onew.jpg'),
(7, 'Believe', 'BEL1258', '2012-06-15', 1, 'believe.jpg'),
(8, 'Colors', 'COL1456', '2017-06-02', 3, 'colors.jpg'),
(9, 'Others', 'BEL1260', '2020-01-15', 2, 'others.jpg'),
(10, 'Colors', 'COL1466', '2019-09-22', 4, 'colors2.jpg'),
(11, 'Ya Salam', 'NAN2014', '2003-04-12', 1, 'nancy1.jpg'),
(15, 'Christmas Hymns', 'FLB1970', '1977-12-01', 1, 'fairuz3.jpg'),
(16, 'Sahra', 'SAH1996', '1996-11-08', 13, 'sahra1.jpg'),
(17, 'Wala Alik', 'WAL2013', '2013-06-01', 1, 'wala2.jpg'),
(18, 'À vous les femmes', 'JUL1979', '1979-06-01', 12, 'femmes2.jpg'),
(19, 'In extremis', 'CAB2015', '2015-04-27', 12, 'france1.png');

-- --------------------------------------------------------

--
-- Structure de la table artistes
--

DROP TABLE IF EXISTS artistes;
CREATE TABLE IF NOT EXISTS `artistes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nom_artiste` varchar(45) NOT NULL unique,
  `pht_artiste` VARCHAR(100) NULL DEFAULT NULL,
  `id_ville` int not NULL,
  PRIMARY KEY (`id`),  
  CONSTRAINT fk_artiste_ville FOREIGN KEY (id_ville) REFERENCES villes (id)
  
) ENGINE=InnoDB;

--
-- Déchargement des données de la table artiste
--

INSERT INTO artistes (id, nom_artiste, pht_artiste, id_ville) VALUES
(1, 'Enrique Iglesias', 'enrique.png', 65),
(2, 'Charles Aznavour', 'charles.jpg', 21),
(3, 'Celine', 'celine.jpg', 1),
(4, 'Justin Bieber', NULL, 18),
(5, 'Danny Joe Brown', NULL, 36),
(6, 'Max Pantera', NULL, 35),
(7, 'Jack Yellen', NULL, 38),
(8, 'Galdston, Goldman', NULL, 32),
(9, 'Bryan Adams', NULL, 16),
(10, 'Barry, Taylor', NULL, 43),
(11, 'David Diamond', NULL, 32),
(12, 'Beck', NULL, 34),
(15, 'Michel Sardou', NULL, 21),
(17, 'Patrick Bruel', NULL, 64),
(19, 'Francis Cabrel', NULL, 23),
(23, 'Bastian Baker', NULL, 42),
(24, 'Mia Aegerter', NULL, 41),
(26, 'Adrian Stern', NULL, 43),
(27, 'Mustafa Ceceli', NULL, 54),
(30, 'Can Bonomo', NULL, 48),
(31, 'Gökhan Özen', NULL, 54),
(33, 'Marie-Mai', NULL, 5),
(34, 'Coeur de pirate', NULL, 1),
(35, 'Karim Ouellet', NULL, 3),
(38, 'Diane Dufresne', NULL, 1),
(40, 'Cheb Khaled', NULL, 67),
(42, 'Mika', NULL, 61),
(44, 'Fairuz', NULL, 61),
(45, 'Nancy Ajram', NULL, 61),
(46, 'Saad Lamjarred', NULL, 66),
(47, 'Julio Iglesias', NULL, 65);

-- --------------------------------------------------------

--
-- Structure de la table oeuvres
--

DROP TABLE IF EXISTS oeuvres;
CREATE TABLE IF NOT EXISTS oeuvres (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titre_oeuvre varchar(100) NOT NULL,
  id_artiste int UNSIGNED NOT NULL,
  id_role tinyint unsigned NOT NULL,
  dureesec int DEFAULT NULL,
  taillemb float DEFAULT NULL,
  lyrics longtext,
  date_ajout datetime DEFAULT CURRENT_TIMESTAMP,
  id_album int NOT NULL,
  prix int DEFAULT '1',
  KEY fk_oeuvre_alb (id_album),
  CONSTRAINT fk_oeuvre_alb FOREIGN KEY (id_album) REFERENCES Albums (id),
  KEY fk_oeuvre_art (id_artiste),
  CONSTRAINT fk_oeuvre_art FOREIGN KEY (id_artiste) REFERENCES artistes (id),
  KEY fk_oeuvre_role (id_role),
  CONSTRAINT fk_oeuvre_role FOREIGN KEY (id_role) REFERENCES roles(id)  
) ENGINE=InnoDB;

--
-- Déchargement des données de la table oeuvres
--

INSERT INTO oeuvres (id, titre_oeuvre, id_artiste, dureesec, taillemb, lyrics, date_ajout, id_album, prix,id_role) VALUES
(2, 'Gitana gitana', 2, 153, 1.6, NULL, '2015-04-02 00:00:00', 4, 2,1),
(3, 'Dis-moi que tu m\'aimes', 2, 162, 1.01, NULL, '2015-04-03 00:00:00', 4, 5,1),
(4, 'Le droit des femmes', 2, 267, 1.85, NULL, '2015-04-04 00:00:00', 4, 2,1),
(5, 'Avant de t\'aimer', 6, 229, 1.3, NULL, '2015-04-05 00:00:00', 4, 5,2),
(6, 'Les Caraïbes', 2, 295, 1.6, NULL, '2015-04-06 00:00:00', 4, 1,3),
(7, 'Amour amer', 2, 166, 0.8, NULL, '2015-04-07 00:00:00', 4, 5,1),
(8, 'Au piano bar', 2, 289, 1.9, NULL, '2015-04-08 00:00:00', 4, 1,1),
(9, 'Les images de la vie', 2, 270, 1.2, NULL, '2015-04-09 00:00:00', 4, 3,1),
(10, 'La Yiddishe mama', 7, 202, 1, NULL, '2015-04-10 00:00:00', 4, 5,1),
(11, 'De déraison en déraison', 2, 197, 1.1, NULL, '2015-04-11 00:00:00', 4, 6,1),
(12, 'Ma dernière chanson pour toi', 2, 192, 1.02, NULL, '2015-04-12 00:00:00', 4, 5,1),
(13, 'Les enfants', 2, 146, 0.92, NULL, '2015-04-01 00:00:00', 4, 6,1),
(14, 'Nous nous reverrons un jour ou l\'autre', 2, 224, 1.1, NULL, '2015-04-19 00:00:00', 4, 3,1),
(15, 'Ce métier', 2, 240, 1.8, NULL, '2015-04-10 00:00:00', 4, 4,1),
(16, 'It\'s All Coming Back to Me Now', 3, 457, 4.15, NULL, '2010-05-12 00:00:00', 3, 1,1),
(17, 'Because You Loved Me', 3, 273, 2.48, NULL, '2010-05-17 00:00:00', 3, 3,1),
(18, 'Falling into You', 3, 258, 2.35, NULL, '2010-05-14 00:00:00', 3, 5,1),
(19, 'Make You Happy', 3, 271, 2.46, NULL, '2010-05-31 00:00:00', 3, 3,1),
(20, 'Seduces Me', 3, 226, 2.05, NULL, '2010-06-06 00:00:00', 3, 5,1),
(21, 'All by Myself', 3, 312, 2.84, NULL, '2010-05-19 00:00:00', 3, 2,1),
(22, 'Declaration of Love', 3, 260, 2.36, NULL, '2010-06-07 00:00:00', 3, 2,2),
(23, 'Dreamin\' of You', 3, 307, 2.79, NULL, '2010-05-27 00:00:00', 3, 4,2),
(24, 'I Love You', 3, 330, 3.1, NULL, '2010-06-07 00:00:00', 3, 5,1),
(25, 'If That\'s What It Takes', 8, 252, 2.29, NULL, '2010-05-22 00:00:00', 3, 6,2),
(26, 'I Don\'t Know', 8, 278, 2.53, NULL, '2010-05-27 00:00:00', 3, 1,3),
(27, 'River Deep, Mountain High', 3, 250, 2.27, NULL, '2010-05-21 00:00:00', 3, 2,3),
(28, 'Call the Man', 3, 368, 3.35, NULL, '2010-06-07 00:00:00', 3, 1,1),
(29, 'Fly', 8, 178, 1.62, NULL, '2010-05-25 00:00:00', 3, 4,2),
(30, 'One World, One Flame', 9, 148, 1.2, NULL, '2017-03-04 00:00:00', 6, 3,2),
(31, 'All around the world (featuring Ludacris)', 4, 244, 2.22, NULL, '2014-06-06 00:00:00', 7, 6,1),
(32, 'Boyfriend', 4, 171, 1.55, NULL, '2014-06-13 00:00:00', 7, 4,1),
(33, 'As Long as You Love Me (featuring Big Sean)', 4, 229, 2.08, NULL, '2014-06-21 00:00:00', 7, 5,1),
(34, 'Catching Feelings', 4, 234, 2.13, NULL, '2014-06-20 00:00:00', 7, 5,2),
(35, 'Take You', 4, 220, 2, NULL, '2014-06-07 00:00:00', 7, 5,2),
(36, 'Right Here (featuring Drake)', 4, 204, 1.85, NULL, '2014-06-16 00:00:00', 7, 5,1),
(37, 'Fall', 4, 248, 2.25, NULL, '2014-06-14 00:00:00', 7, 6,1),
(38, 'Die in Your Arms', 4, 237, 2.15, NULL, '2014-06-28 00:00:00', 7, 5,1),
(39, 'Thought of You', 4, 230, 2.09, NULL, '2014-06-27 00:00:00', 7, 5,1),
(40, 'Beauty and a Beat (featuring Nicki Minaj)', 4, 228, 2.07, NULL, '2014-06-22 00:00:00', 7, 5,1),
(41, 'One Love', 4, 234, 2.13, NULL, '2014-07-04 00:00:00', 7, 5,1),
(42, 'Be Alright', 4, 189, 1.72, NULL, '2014-06-14 00:00:00', 7, 4,1),
(43, 'Believe', 4, 222, 2.02, NULL, '2014-06-09 00:00:00', 7, 5,1),
(44, 'Love Me Like You Do', 4, 279, 2.54, NULL, '2014-06-18 00:00:00', 7, 6,1),
(45, 'Fairytale', 4, 212, 1.93, NULL, '2014-07-02 00:00:00', 7, 5,1),
(46, 'Out Of Town Girl', 4, 213, 1.94, NULL, '2014-07-04 00:00:00', 7, 5,1),
(47, 'She Don\'t Like the Lights', 4, 239, 2.17, NULL, '2014-07-05 00:00:00', 7, 5,1),
(48, 'Maria', 4, 248, 2.25, NULL, '2014-06-26 00:00:00', 7, 6,1),
(49, 'Just Like Them', 4, 172, 1.56, NULL, '2014-07-04 00:00:00', 7, 4,1),
(51, 'Rhythm Divine', 1, 209, 1.9, NULL, '2013-07-05 00:00:00', 5, 5,1),
(52, 'Be With You', 10, 220, 2, NULL, '2013-07-17 00:00:00', 5, 5,1),
(53, 'I Have Always Loved You', 1, 264, 2.4, NULL, '2013-08-04 00:00:00', 5, 6,1),
(54, 'Sad Eyes', 1, 248, 2.25, NULL, '2013-08-04 00:00:00', 5, 6,1),
(55, 'I\'m Your Man', 1, 283, 2.57, NULL, '2013-07-11 00:00:00', 5, 7,1),
(56, 'Óyeme (\"Listen\")', 1, 262, 2.38, NULL, '2013-07-09 00:00:00', 5, 6,1),
(57, 'Could I Have This Kiss Forever (en duo avec Whitney Houston)', 1, 261, 2.37, NULL, '2013-08-04 00:00:00', 5, 6,1),
(58, 'You\'re My #1', 1, 269, 2.45, NULL, '2013-07-22 00:00:00', 5, 6,1),
(59, 'Alabao', 1, 240, 2.18, NULL, '2013-07-14 00:00:00', 5, 6,1),
(60, 'Bailamos', 10, 214, 1.95, NULL, '2013-07-15 00:00:00', 5, 5,1),
(61, 'Ritmo total (Rhythm Divine)', 10, 209, 1.9, NULL, '2013-07-31 00:00:00', 5, 5,1),
(62, 'Más es amar (Sad Eyes)', 1, 254, 2.31, NULL, '2013-07-26 00:00:00', 5, 6,1),
(63, 'No puedo más sin ti (I\'m Your Man)', 1, 288, 2.62, NULL, '2013-07-16 00:00:00', 5, 7,1),
(64, 'Colors', 12, 260, 4.2, NULL, '2018-07-15 00:00:00', 8, 6,1),
(65, 'Seventh Heaven', 12, 300, 5.4, NULL, '2018-07-16 00:00:00', 8, 7,1),
(66, 'I\'m So Free', 12, 247, 4.02, NULL, '2018-09-15 00:00:00', 8, 6,1),
(67, 'Dear Life', 12, 204, 3.4, NULL, '2018-09-16 00:00:00', 8, 5,1),
(68, 'No Distraction', 12, 290, 4.7, NULL, '2018-07-15 00:00:00', 8, 7,1),
(69, 'Dreams', 12, 295, 5.4, NULL, '2018-07-16 00:00:00', 8, 7,1),
(70, 'WOW', 12, 220, 3.12, NULL, '2018-09-15 00:00:00', 8, 5,1),
(71, 'Up All Night', 12, 190, 3.4, NULL, '2018-09-16 00:00:00', 8, 4,1),
(72, 'Square One', 12, 175, 2.12, NULL, '2018-09-15 00:00:00', 8, 4,1),
(73, 'Fix Me', 12, 193, 3.1, NULL, '2018-09-16 00:00:00', 8, 4,1),
(74, 'Wana Mali', 46, 193, 3.1, NULL, '2022-04-08 10:10:29', 17, 4,1),
(75, 'Jiti Fe Bali', 46, 221, 3.5, NULL, '2022-04-08 10:10:29', 17, 5,1),
(76, 'Lemima', 46, 234, 3.9, NULL, '2022-04-08 10:10:29', 17, 5,1),
(77, 'Salina', 46, 235, 3.91, NULL, '2022-04-08 10:10:29', 17, 5,1),
(78, 'Pauvres diables', 47, 181, 3.01, NULL, '2022-04-08 10:10:29', 18, 4,1),
(79, 'L\'amour c\'est quoi', 47, 291, 4.11, NULL, '2022-04-08 10:10:29', 18, 7,1),
(80, 'Les traditions', 47, 211, 3.21, NULL, '2022-04-08 10:10:29', 18, 5,1),
(81, 'Je n\'ai pas changé', 47, 210, 3.17, NULL, '2022-04-08 10:10:29', 18, 5,1),
(82, 'Moi je t\'aime', 47, 202, 3.04, NULL, '2022-04-08 10:10:29', 18, 5,1),
(83, 'Le mal de toi', 47, 274, 3.45, NULL, '2022-04-08 10:10:29', 18, 6,1),
(100, 'Dur comme fer', 19, 243, 3.25, NULL, '2022-04-08 10:10:29', 19, 6,1),
(101, 'À chaque amour que nous ferons', 19, 243, 3.25, NULL, '2022-04-08 10:10:29', 19, 6,1),
(102, 'Le Pays d\'à côté', 19, 269, 3.35, NULL, '2022-04-08 10:10:29', 19, 6,1),
(103, 'In extremis', 19, 342, 4.45, NULL, '2022-04-08 10:10:29', 19, 8,1),
(104, 'Dans chaque cœur', 19, 304, 4.25, NULL, '2022-04-08 10:10:29', 19, 7,1),
(105, 'La Voix du crooner', 19, 173, 2.25, NULL, '2022-04-08 10:10:29', 19, 4,1),
(106, 'Les Tours gratuits', 19, 280, 3.35, NULL, '2022-04-08 10:10:29', 19, 7,2);

-- --------------------------------------------------------

--
-- Structure de la table utilisateurs
--

DROP TABLE IF EXISTS utilisateurs;
CREATE TABLE utilisateurs (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom varchar(45) NOT NULL,
  courriel varchar(100) NOT NULL UNIQUE,
  mot_passe varchar(75) NOT NULL,
  id_ville int NOT NULL,
  urRole enum('ADMIN','GERANT','CLIENT') DEFAULT 'CLIENT',
  age int NULL,  -- CHECK (courriel REGEXP "^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$"),
  constraint chk_courriel check(regexp_like(courriel, '^[[:alnum:]\\._]+@[[:alnum:]]+(\\.[[:alnum:]]{2}){0,1}\.[a-z]{2,3}$','i')),
  CONSTRAINT fk_utilisateur_ville FOREIGN KEY (id_ville) REFERENCES villes(id)
) ENGINE=InnoDB;

/* Ceci est pour vous montrer les mots de passe avant le hashage.
INSERT INTO utilisateur (id_utilisateur, nom, mot_passe, courriel, age) VALUES
(1, 'ali', '123456', 'awdeali@gmail.com',44),
(2, 'jacob', 'asdfgh', 'jacob@gmail.com',30),
(3, 'mathieu', 'qwerty','math@hotmail.com',24),
(4, 'france', 'azerty','france@gmail.com',41),
(5, 'admin', 'admin1','admin@yahoo.ca',27);*/

--
-- Déchargement des données de la table utilisateurs
--

INSERT INTO utilisateurs (id, nom, courriel, mot_passe, id_ville, age) VALUES
(1, 'ali', 'awdeali@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 3, 44),
(2, 'jacob', 'jacob@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 1, 30),
(3, 'mathieu', 'math@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 32, 24),
(4, 'france', 'france@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 14, 41),
(5, 'admin', 'admin@yahoo.ca', '$2y$10$35vgM52yIeHBTkJefCXTSeF/.D.pwspopyx9YtI3hJI/MHv9iYgJ6', 3, 27),
(6, 'Pierre', 'pierre@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 13, 44),
(22, 'Gabriel', 'gab@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 1, 30),
(23, 'Francine', 'francine@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 21, 24),
(24, 'Samuelle', 'Sam1@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 65, 41),
(31, 'Alain', 'alain@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 3, 44),
(32, 'Alice', 'alice@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 44, 30),
(33, 'Mart', 'mart@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 54, 24),
(34, 'Jacques', 'jacq@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 43, 41),
(41, 'Pierre Francois', 'pief@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 13, 44),
(42, 'Marie', 'marie4@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 1, 30),
(43, 'Julie', 'julie@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 60, 24),
(44, 'James', 'james@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 75, 41),
(45, 'Alain', 'alainb@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 79, 44),
(46, 'Ela', 'ela2@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 55, 30),
(47, 'Martine', 'martine6@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 74, 24),
(48, 'Jacqueline', 'jacq985@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 75, 41),
(51, 'Pier', 'pier89@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 63, 44),
(52, 'Gabrielle', 'gab54@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 1, 30),
(53, 'Francine', 'francine87@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 21, 24),
(54, 'Samu', 'Sam169@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 60, 41),
(55, 'Ada', 'ada1234@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 61, 44),
(56, 'Aline', 'aline58@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 4, 30),
(57, 'Martine', 'mart258@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 12, 24),
(58, 'Jean', 'jean45@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 13, 41),
(59, 'Jean Francois', 'francois1@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 13, 44),
(60, 'Marie-Ann', 'ann23@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 33, 30),
(73, 'Joseane', 'jose56@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 35, 24),
(74, 'Jackie', 'jacki3@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 38, 41),
(75, 'Harry', 'harry3@gmail.com', '$2y$10$r/UN9n5f68nHEj.cmrKYZedVkkVwb.bPqglxbeUp3QWYegOqgd72q', 44, 44),
(76, 'Lea', 'lea1@gmail.com', '$2y$10$LTxTJNoE2rZ8FLsxN1q56Op0iT4WSyYWfKB0dVk7xeprAdPZIduP.', 21, 30),
(77, 'Bob', 'bob@hotmail.com', '$2y$10$3TnfMB4qvXQiSafeCSzakeNfbhqu3mff8y1WHbUw17FgAYvEuI1WS', 3, 24),
(78, 'Bily', 'bily@gmail.com', '$2y$10$5Y/OCXWajOXCIkj7WDgy7u4Fznu3BqaL4BlWn4FZzBiR1AEIVSFba', 32, 41);

UPDATE utilisateurs SET urRole='ADMIN' where id<=5;
UPDATE utilisateurs SET urRole='GERANT' where id>5 AND id<11;
SELECT * FROM utilisateurs;

--
-- Structure de la table commandes
--

DROP TABLE IF EXISTS commandes;
CREATE TABLE IF NOT EXISTS commandes (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_utilisateur int NOT NULL , 
	date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
	etat_commande ENUM('En cours', 'Acceptée', 'Annulée', 'En livraison', 'Livrée') DEFAULT 'En cours',
	CONSTRAINT fk_tbl_cmd_tbl_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB ;

--
-- Déchargement des données de la table commandes
--

INSERT INTO commandes (id, id_utilisateur, date_commande, etat_commande) VALUES
(1, 1, '2020-04-01 00:00:00', 'Acceptée'),
(2, 2, '2020-04-15 00:00:00', 'Livrée'),
(3, 1, '2020-07-24 00:00:00', 'Livrée'),
(4, 5, '2020-05-12 00:00:00', 'Livrée'),
(5, 2, '2020-08-10 00:00:00', 'Livrée'),
(6, 4, '2021-01-07 00:00:00', 'Annulée'),
(7, 1, '2020-11-21 00:00:00', 'Livrée'),
(8, 2, '2020-04-03 00:00:00', 'Livrée'),
(9, 1, '2020-09-18 00:00:00', 'Livrée'),
(10, 5, '2021-01-05 00:00:00', 'Livrée'),
(11, 55, '2020-12-15 00:00:00', 'Annulée'),
(12, 54, '2020-06-23 00:00:00', 'Livrée'),
(13, 51, '2020-09-24 00:00:00', 'Livrée'),
(14, 52, '2020-08-13 00:00:00', 'Livrée'),
(15, 41, '2020-10-02 00:00:00', 'Annulée'),
(16, 45, '2020-05-07 00:00:00', 'Livrée'),
(17, 43, '2020-05-08 00:00:00', 'Livrée'),
(18, 54, '2020-11-17 00:00:00', 'Annulée'),
(19, 1, '2021-01-19 00:00:00', 'Livrée'),
(20, 52, '2020-06-07 00:00:00', 'Annulée'),
(21, 75, '2020-05-16 00:00:00', 'Livrée'),
(22, 77, '2021-01-05 00:00:00', 'Livrée'),
(23, 33, '2020-08-22 00:00:00', 'Livrée'),
(24, 34, '2020-05-11 00:00:00', 'Livrée'),
(25, 23, '2020-06-22 00:00:00', 'Livrée'),
(26, 24, '2021-12-04 00:00:00', 'En livraison'),
(27, 1, '2022-01-19 00:00:00', 'Livrée'),
(28, 51, '2022-01-28 00:00:00', 'En livraison'),
(29, 42, '2022-02-03 00:00:00', 'En livraison'),
(30, 4, '2022-02-08 00:00:00', 'En livraison'),
(31, 33, '2022-01-07 00:00:00', 'En cours'),
(32, 44, '2022-01-16 00:00:00', 'En cours'),
(33, 57, '2022-01-17 00:00:00', 'En cours'),
(34, 24, '2022-01-17 00:00:00', 'En cours'),
(35, 60, '2022-01-18 00:00:00', 'En cours'),
(36, 54, '2022-01-18 00:00:00', 'En cours'),
(37, 34, '2022-01-19 00:00:00', 'En cours'),
(38, 74, '2022-02-02 00:00:00', 'En cours'),
(39, 55, '2022-02-06 00:00:00', 'En cours'),
(40, 24, '2022-02-07 00:00:00', 'En cours'),
(41, 5, '2022-02-11 00:00:00', 'En cours'),
(42, 34, '2022-02-17 00:00:00', 'En cours'),
(43, 74, '2022-02-17 00:00:00', 'En cours'),
(44, 31, '2022-02-20 00:00:00', 'En cours'),
(45, 55, '2022-02-20 00:00:00', 'En cours');
INSERT INTO commandes (`id_utilisateur`) 
VALUES ( '1'),
( '22'),
( '23'),
( '52'),
( '3'),
( '54'),
( '47'),
( '74');
SELECT * FROM commandes ORDER BY id_utilisateur,date_commande;
SELECT * FROM commandes ORDER BY id;
-- --------------------------------------------------------

--
-- Structure de la table ligne_commandes
--

DROP TABLE IF EXISTS ligne_commandes;
CREATE TABLE IF NOT EXISTS ligne_commandes (
  id_commande int NOT NULL,
  id_oeuvre int NOT NULL,
  Quantite tinyint unsigned DEFAULT 1,
  PRIMARY KEY (id_commande, id_oeuvre),
  CONSTRAINT fk_tbl_lgcmd_tbl_oeuvre FOREIGN KEY (id_oeuvre) REFERENCES oeuvres (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_tbl_lgcmd_tbl_cmd FOREIGN KEY (id_commande) REFERENCES commandes (id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

--
-- Déchargement des données de la table ligne_commandes
--

INSERT INTO ligne_commandes (id_commande, id_oeuvre, Quantite) VALUES
(1, 12, 4),
(1, 26, 2),
(1, 52, 1),
(1, 68, 2),
(2, 13, 3),
(2, 17, 1),
(2, 43, 2),
(2, 72, 6),
(3, 60, 7),
(4, 21, 7),
(4, 54, 4),
(5, 20, 9),
(5, 54, 9),
(6, 35, 9),
(6, 47, 9),
(7, 16, 8),
(7, 45, 11),
(7, 51, 9),
(8, 38, 1),
(8, 47, 4),
(8, 72, 4),
(9, 3, 10),
(9, 36, 6),
(9, 64, 7),
(10, 20, 2),
(10, 24, 2),
(10, 33, 11),
(10, 51, 3),
(11, 43, 11),
(11, 45, 10),
(11, 52, 3),
(12, 54, 6),
(12, 71, 3),
(12, 72, 1),
(12, 82, 6),
(13, 3, 7),
(13, 43, 10),
(14, 38, 7),
(14, 41, 9),
(15, 33, 3),
(15, 40, 7),
(15, 71, 1),
(16, 3, 2),
(16, 49, 2),
(16, 70, 8),
(17, 11, 1),
(17, 19, 1),
(17, 31, 6),
(17, 83, 7),
(18, 48, 1),
(19, 28, 3),
(19, 32, 9),
(19, 47, 7),
(20, 10, 9),
(20, 31, 7),
(20, 38, 9),
(20, 59, 1),
(21, 36, 6),
(22, 2, 1),
(22, 22, 5),
(22, 72, 2),
(23, 8, 8),
(24, 20, 4),
(24, 23, 7),
(24, 25, 3),
(24, 28, 9),
(24, 44, 9),
(24, 65, 7),
(25, 8, 6),
(25, 18, 6),
(25, 31, 10),
(25, 32, 5),
(25, 53, 6),
(26, 34, 1),
(26, 58, 4),
(27, 41, 5),
(27, 44, 2),
(28, 2, 10),
(28, 6, 8),
(28, 7, 8),
(28, 22, 7),
(28, 43, 2),
(28, 64, 3),
(29, 45, 6),
(30, 16, 2),
(31, 57, 5),
(32, 5, 5),
(32, 82, 6),
(33, 13, 5),
(33, 23, 6),
(33, 30, 3),
(33, 76, 2),
(34, 65, 6),
(35, 49, 3),
(35, 67, 4),
(35, 80, 8),
(36, 22, 4),
(36, 51, 3),
(36, 62, 7),
(36, 75, 4),
(37, 19, 7),
(37, 20, 9),
(38, 78, 7),
(39, 37, 8),
(39, 45, 6),
(39, 64, 5),
(39, 75, 10),
(40, 81, 8),
(41, 9, 1),
(41, 42, 4),
(41, 49, 5),
(41, 69, 6),
(41, 103, 9),
(42, 43, 7),
(42, 51, 6),
(42, 54, 9),
(42, 73, 4),
(42, 75, 7),
(43, 27, 6),
(43, 63, 1),
(44, 72, 9),
(44, 79, 2),
(44, 83, 3),
(45, 29, 9),
(46, 49, 3),
(47, 10, 1),
(47, 24, 2),
(47, 26, 1),
(47, 40, 5),
(47, 43, 7),
(47, 71, 7),
(47, 77, 8),
(48, 28, 10),
(48, 69, 8),
(49, 68, 2),
(50, 41, 6),
(51, 62, 3),
(51, 104, 9),
(52, 10, 6),
(52, 34, 8),
(53, 6, 1);

SELECT id_commande,nom,id_oeuvre, titre_oeuvre,quantite, prix  FROM ligne_commandes lg
INNER JOIN oeuvres o ON o.id=lg.id_oeuvre 
INNER JOIN commandes c ON c.id=lg.id_commande
INNER JOIN utilisateurs u ON u.id=c.id_utilisateur;

-- --------------------------------------------------------
-- --------------------------------------------------------

COMMIT;

