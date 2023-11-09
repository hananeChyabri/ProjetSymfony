-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 07 nov. 2023 à 15:37
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdplante`
--

-- --------------------------------------------------------

--
-- Structure de la table `plante`
--

CREATE TABLE `plante` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `famille_botanique` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `type_de_feuillage` varchar(255) DEFAULT NULL,
  `frequence_arrosage` varchar(255) DEFAULT NULL,
  `taille_mature` decimal(10,2) DEFAULT NULL,
  `periode_floraison` varchar(255) DEFAULT NULL,
  `utilisation` varchar(255) DEFAULT NULL,
  `lieu_cultive` varchar(255) DEFAULT NULL,
  `couleur_fleur` varchar(255) DEFAULT NULL,
  `climat` varchar(255) DEFAULT NULL,
  `exposition` varchar(255) DEFAULT NULL,
  `besoin_eau` varchar(255) DEFAULT NULL,
  `resistance_froid` varchar(255) DEFAULT NULL,
  `niveau_soin` varchar(255) DEFAULT NULL,
  `nature_terre` varchar(255) DEFAULT NULL,
  `humidite_sol` varchar(255) DEFAULT NULL,
  `ph_sol` varchar(255) DEFAULT NULL,
  `croissance` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type_plante` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plante`
--

INSERT INTO `plante` (`id`, `nom`, `famille_botanique`, `origin`, `type_de_feuillage`, `frequence_arrosage`, `taille_mature`, `periode_floraison`, `utilisation`, `lieu_cultive`, `couleur_fleur`, `climat`, `exposition`, `besoin_eau`, `resistance_froid`, `niveau_soin`, `nature_terre`, `humidite_sol`, `ph_sol`, `croissance`, `description`, `type_plante`) VALUES
(1, 'Févier test test', 'Fabacées, Légumineuses', 'Bhutan', 'Caduc ', '3', 14.96, '05', 'decoration', 'Intérieur', 'DarkSlateBlue', 'Montagnard', 'Ombre', 'Moyen', 'À protéger', 'Modéré', 'Terreau ', 'Humide', 'Alcalin ', 'Rapide', 'Le févier d’Amérique, Gleditsia triacanthos, est un arbre étalé au port léger qui porte de grandes gousses couleur acajou très décoratives et parfois de très longues épines acérées. D’une grande rusticité, il s’adapte dans toutes nos régions.', 'Fruit'),
(2, 'Fougère', 'Cactacées', 'Bulgaria', 'Caduc', '3', 95.27, '07', 'decoration', 'Potager ou verger', 'LightCoral', 'Méditerranéen', 'Ombre', 'Important', 'Fragile', 'Difficile', 'Terreau ', 'Humide', 'Acide ', 'Normale', 'Quia sit saepe sequi beatae nostrum impedit est labore.', 'Aromatique'),
(3, 'Bonsaï', 'Ranunculacées', 'Estonia', 'Persistant', '1', 136.98, '06', 'decoration', 'Potager ou verger', 'Peru', 'Océanique', 'Ombre', 'Moyen', 'Fragile', 'Difficile', 'Humifère', 'Drainé', 'Acide ', 'Normale', 'Temporibus sequi quasi culpa est ab totam saepe voluptas libero nulla rerum.', 'Plante ornementale'),
(4, 'Pivoine', 'Liliacées', 'Namibia', 'Persistant', '3', 60.84, '04', 'decoration', 'Jardin', 'Violet', 'Montagnard', 'Soleil', 'Moyen', 'Résistante', 'Difficile', 'Calcaire', 'Humide', 'Acide ', 'Lente', 'Nisi omnis minima est et exercitationem optio illum fugit qui aut eligendi.', 'Médicinale'),
(5, 'Lilas', 'Cucurbitacées', 'Antigua and Barbuda', 'Caduc', '3', 125.05, '04', 'decoration', 'Intérieur', 'OliveDrab', 'Méditerranéen', 'Soleil', 'Important', 'À protéger', 'Modéré', 'Caillouteuse ', 'Humide', 'Neutre', 'Rapide', 'Voluptatem aperiam quidem quia optio dolores pariatur voluptate sed velit voluptates nesciunt.', 'Fruit'),
(6, 'Orchidée', 'Lauracées', 'Tanzania', 'Caduc', '2', 147.29, '09', 'decoration', 'Balcon ou terrasse', 'DarkSalmon', 'Semi-océanique', 'Ombre', 'Moyen', 'Résistante', 'Facile', 'Humifère', 'Frais', 'Alcalin ', 'Rapide', 'Voluptatem nam omnis quidem et consequatur eos.', 'Plante de bassin'),
(7, 'Aloe Vera', 'Liliacées', 'Tanzania', 'Caduc', '0', 44.02, '06', 'decoration', 'Balcon ou terrasse', 'PaleGreen', 'Montagnard', 'Ombre', 'Moyen', 'Résistante', 'Difficile', 'Calcaire', 'Sec', 'Acide ', 'Normale', 'Consequatur aliquid minus officiis rerum quae occaecati enim natus sit aut occaecati ipsa.', 'Médicinale'),
(8, 'Bonsaï', 'Lauracées', 'Togo', 'Persistant', '3', 11.49, '06', 'decoration', 'Jardin', 'ForestGreen', 'Continental', 'Mi-ombre', 'Moyen', 'À protéger', 'Difficile', 'Calcaire', 'Humide', 'Acide ', 'Rapide', 'Ab non eum similique ut facilis aspernatur sint ut omnis ad.', 'Arbre'),
(9, 'Pivoine', 'Cucurbitacées', 'Malaysia', 'Caduc', '1', 243.73, '08', 'decoration', 'Jardin', 'OrangeRed', 'Océanique', 'Ombre', 'Important', 'À protéger', 'Facile', 'Humifère', 'Frais', 'Acide ', 'Rapide', 'Non omnis qui ut aliquid est illo consectetur est quibusdam possimus sint debitis recusandae.', 'Plante de bassin'),
(10, 'Jonquille', 'Lauracées', 'Faroe Islands', 'Caduc', '2', 291.88, '01', 'decoration', 'Jardin', 'LightCoral', 'Océanique', 'Mi-ombre', 'Faible', 'Résistante', 'Facile', 'Terre de bruyère', 'Frais', 'Alcalin ', 'Rapide', 'Quas accusantium quia unde sequi sint quis esse illum.', 'Plante de bassin'),
(11, 'Aloe Vera', 'Cucurbitacées', 'Kyrgyz Republic', 'Caduc', '0', 230.44, '04', 'decoration', 'Balcon ou terrasse', 'Indigo', 'Montagnard', 'Soleil', 'Faible', 'Fragile', 'Modéré', 'Humifère', 'Sec', 'Alcalin ', 'Rapide', 'Qui architecto molestiae dolorum repellendus quis deleniti et explicabo et.', 'Médicinale');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `plante`
--
ALTER TABLE `plante`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `plante`
--
ALTER TABLE `plante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
