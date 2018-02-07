-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 05 juin 2017 à 17:15
-- Version du serveur :  10.1.22-MariaDB
-- Version de PHP :  7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `effectifs`
--

-- --------------------------------------------------------

--
-- Structure de la table `effectifs`
--

CREATE TABLE `effectifs` (
  `annee` smallint(6) NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` int(11) NOT NULL,
  `sexe` enum('Masculin','Feminin','','') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `effectifs`
--

INSERT INTO `effectifs` (`annee`, `code`, `nombre`, `sexe`) VALUES
(2001, 'CPGE', 886, 'Feminin'),
(2001, 'CPGE', 1430, 'Masculin'),
(2001, 'EC_ART', 298, 'Feminin'),
(2001, 'EC_ART', 421, 'Masculin'),
(2001, 'EC_autres', 1999, 'Masculin'),
(2001, 'EC_autres', 4648, 'Feminin'),
(2001, 'EC_JUR', 381, 'Feminin'),
(2001, 'EC_JUR', 1080, 'Masculin'),
(2001, 'EC_PARAM', 679, 'Masculin'),
(2001, 'EC_PARAM', 4079, 'Feminin'),
(2001, 'ENS', 271, 'Feminin'),
(2001, 'ENS', 688, 'Masculin'),
(2001, 'ING_autres', 215, 'Feminin'),
(2001, 'ING_autres', 1002, 'Masculin'),
(2001, 'STS', 4737, 'Feminin'),
(2001, 'STS', 5034, 'Masculin'),
(2001, 'UNIV', 37554, 'Masculin'),
(2001, 'UNIV', 47517, 'Feminin'),
(2002, 'CPGE', 959, 'Feminin'),
(2002, 'CPGE', 1406, 'Masculin'),
(2002, 'EC_ART', 321, 'Feminin'),
(2002, 'EC_ART', 451, 'Masculin'),
(2002, 'EC_autres', 1934, 'Masculin'),
(2002, 'EC_autres', 5064, 'Feminin'),
(2002, 'EC_JUR', 360, 'Feminin'),
(2002, 'EC_JUR', 1058, 'Masculin'),
(2002, 'EC_PARAM', 728, 'Masculin'),
(2002, 'EC_PARAM', 4600, 'Feminin'),
(2002, 'ENS', 283, 'Feminin'),
(2002, 'ENS', 665, 'Masculin'),
(2002, 'ING_autres', 249, 'Feminin'),
(2002, 'ING_autres', 1073, 'Masculin'),
(2002, 'STS', 4815, 'Feminin'),
(2002, 'STS', 5261, 'Masculin'),
(2002, 'UNIV', 38460, 'Masculin'),
(2002, 'UNIV', 47791, 'Feminin'),
(2003, 'CPGE', 1025, 'Feminin'),
(2003, 'CPGE', 1415, 'Masculin'),
(2003, 'EC_ART', 347, 'Feminin'),
(2003, 'EC_ART', 475, 'Masculin'),
(2003, 'EC_autres', 1959, 'Masculin'),
(2003, 'EC_autres', 4247, 'Feminin'),
(2003, 'EC_JUR', 427, 'Feminin'),
(2003, 'EC_JUR', 866, 'Masculin'),
(2003, 'EC_PARAM', 754, 'Masculin'),
(2003, 'EC_PARAM', 4934, 'Feminin'),
(2003, 'ENS', 296, 'Feminin'),
(2003, 'ENS', 691, 'Masculin'),
(2003, 'ING_autres', 260, 'Feminin'),
(2003, 'ING_autres', 962, 'Masculin'),
(2003, 'STS', 4860, 'Feminin'),
(2003, 'STS', 5369, 'Masculin'),
(2003, 'UNIV', 39880, 'Masculin'),
(2003, 'UNIV', 49443, 'Feminin'),
(2004, 'CPGE', 1147, 'Feminin'),
(2004, 'CPGE', 1574, 'Masculin'),
(2004, 'EC_ART', 370, 'Feminin'),
(2004, 'EC_ART', 455, 'Masculin'),
(2004, 'EC_autres', 1968, 'Masculin'),
(2004, 'EC_autres', 4095, 'Feminin'),
(2004, 'EC_JUR', 405, 'Feminin'),
(2004, 'EC_JUR', 562, 'Masculin'),
(2004, 'EC_PARAM', 714, 'Masculin'),
(2004, 'EC_PARAM', 5120, 'Feminin'),
(2004, 'ENS', 291, 'Feminin'),
(2004, 'ENS', 675, 'Masculin'),
(2004, 'ING_autres', 264, 'Feminin'),
(2004, 'ING_autres', 1094, 'Masculin'),
(2004, 'STS', 4947, 'Feminin'),
(2004, 'STS', 5482, 'Masculin'),
(2004, 'UNIV', 39491, 'Masculin'),
(2004, 'UNIV', 50227, 'Feminin'),
(2005, 'CPGE', 1170, 'Feminin'),
(2005, 'CPGE', 1683, 'Masculin'),
(2005, 'EC_ART', 406, 'Feminin'),
(2005, 'EC_ART', 439, 'Masculin'),
(2005, 'EC_autres', 1933, 'Masculin'),
(2005, 'EC_autres', 3961, 'Feminin'),
(2005, 'EC_JUR', 269, 'Feminin'),
(2005, 'EC_JUR', 530, 'Masculin'),
(2005, 'EC_PARAM', 744, 'Masculin'),
(2005, 'EC_PARAM', 5273, 'Feminin'),
(2005, 'ENS', 308, 'Feminin'),
(2005, 'ENS', 652, 'Masculin'),
(2005, 'ING_autres', 288, 'Feminin'),
(2005, 'ING_autres', 724, 'Masculin'),
(2005, 'STS', 4850, 'Feminin'),
(2005, 'STS', 5664, 'Masculin'),
(2005, 'UNIV', 37369, 'Masculin'),
(2005, 'UNIV', 48566, 'Feminin'),
(2006, 'CPGE', 1296, 'Feminin'),
(2006, 'CPGE', 1689, 'Masculin'),
(2006, 'EC_ART', 395, 'Feminin'),
(2006, 'EC_ART', 401, 'Masculin'),
(2006, 'EC_autres', 1652, 'Masculin'),
(2006, 'EC_autres', 3753, 'Feminin'),
(2006, 'EC_JUR', 317, 'Feminin'),
(2006, 'EC_JUR', 532, 'Masculin'),
(2006, 'EC_PARAM', 796, 'Masculin'),
(2006, 'EC_PARAM', 5088, 'Feminin'),
(2006, 'ENS', 446, 'Feminin'),
(2006, 'ENS', 753, 'Masculin'),
(2006, 'ING_autres', 262, 'Feminin'),
(2006, 'ING_autres', 934, 'Masculin'),
(2006, 'STS', 4853, 'Feminin'),
(2006, 'STS', 5614, 'Masculin'),
(2006, 'UNIV', 36330, 'Masculin'),
(2006, 'UNIV', 47250, 'Feminin'),
(2007, 'CPGE', 1357, 'Feminin'),
(2007, 'CPGE', 1699, 'Masculin'),
(2007, 'EC_ART', 408, 'Masculin'),
(2007, 'EC_ART', 410, 'Feminin'),
(2007, 'EC_autres', 1645, 'Masculin'),
(2007, 'EC_autres', 3707, 'Feminin'),
(2007, 'EC_JUR', 84, 'Feminin'),
(2007, 'EC_JUR', 285, 'Masculin'),
(2007, 'EC_PARAM', 832, 'Masculin'),
(2007, 'EC_PARAM', 5045, 'Feminin'),
(2007, 'ENS', 434, 'Feminin'),
(2007, 'ENS', 860, 'Masculin'),
(2007, 'ING_autres', 290, 'Feminin'),
(2007, 'ING_autres', 1197, 'Masculin'),
(2007, 'STS', 4847, 'Feminin'),
(2007, 'STS', 5591, 'Masculin'),
(2007, 'UNIV', 35503, 'Masculin'),
(2007, 'UNIV', 47307, 'Feminin'),
(2008, 'CPGE', 1421, 'Feminin'),
(2008, 'CPGE', 1779, 'Masculin'),
(2008, 'EC_ART', 407, 'Masculin'),
(2008, 'EC_ART', 443, 'Feminin'),
(2008, 'EC_autres', 329, 'Masculin'),
(2008, 'EC_autres', 614, 'Feminin'),
(2008, 'EC_JUR', 104, 'Feminin'),
(2008, 'EC_JUR', 275, 'Masculin'),
(2008, 'EC_PARAM', 780, 'Masculin'),
(2008, 'EC_PARAM', 5264, 'Feminin'),
(2008, 'ENS', 487, 'Feminin'),
(2008, 'ENS', 891, 'Masculin'),
(2008, 'ING_autres', 269, 'Feminin'),
(2008, 'ING_autres', 899, 'Masculin'),
(2008, 'STS', 4809, 'Feminin'),
(2008, 'STS', 5551, 'Masculin'),
(2008, 'UNIV', 36338, 'Masculin'),
(2008, 'UNIV', 50760, 'Feminin'),
(2009, 'CPGE', 1439, 'Feminin'),
(2009, 'CPGE', 1879, 'Masculin'),
(2009, 'EC_ART', 419, 'Masculin'),
(2009, 'EC_ART', 457, 'Feminin'),
(2009, 'EC_autres', 359, 'Masculin'),
(2009, 'EC_autres', 624, 'Feminin'),
(2009, 'EC_JUR', 106, 'Feminin'),
(2009, 'EC_JUR', 261, 'Masculin'),
(2009, 'EC_PARAM', 737, 'Masculin'),
(2009, 'EC_PARAM', 5727, 'Feminin'),
(2009, 'ENS', 480, 'Feminin'),
(2009, 'ENS', 908, 'Masculin'),
(2009, 'ING_autres', 254, 'Feminin'),
(2009, 'ING_autres', 859, 'Masculin'),
(2009, 'STS', 4927, 'Feminin'),
(2009, 'STS', 5595, 'Masculin'),
(2009, 'UNIV', 37845, 'Masculin'),
(2009, 'UNIV', 53130, 'Feminin'),
(2010, 'CPGE', 1322, 'Feminin'),
(2010, 'CPGE', 1889, 'Masculin'),
(2010, 'EC_ART', 420, 'Masculin'),
(2010, 'EC_ART', 480, 'Feminin'),
(2010, 'EC_autres', 375, 'Masculin'),
(2010, 'EC_autres', 679, 'Feminin'),
(2010, 'EC_JUR', 101, 'Feminin'),
(2010, 'EC_JUR', 246, 'Masculin'),
(2010, 'EC_PARAM', 554, 'Masculin'),
(2010, 'EC_PARAM', 4161, 'Feminin'),
(2010, 'ENS', 557, 'Feminin'),
(2010, 'ENS', 1132, 'Masculin'),
(2010, 'ING_autres', 322, 'Feminin'),
(2010, 'ING_autres', 1009, 'Masculin'),
(2010, 'STS', 4950, 'Feminin'),
(2010, 'STS', 5689, 'Masculin'),
(2010, 'UNIV', 36987, 'Masculin'),
(2010, 'UNIV', 51477, 'Feminin'),
(2011, 'CPGE', 1367, 'Feminin'),
(2011, 'CPGE', 1910, 'Masculin'),
(2011, 'EC_ART', 402, 'Masculin'),
(2011, 'EC_ART', 508, 'Feminin'),
(2011, 'EC_PARAM', 618, 'Masculin'),
(2011, 'EC_PARAM', 5304, 'Feminin'),
(2011, 'ENS', 535, 'Feminin'),
(2011, 'ENS', 1117, 'Masculin'),
(2011, 'ING_autres', 317, 'Feminin'),
(2011, 'ING_autres', 1056, 'Masculin'),
(2011, 'STS', 5091, 'Feminin'),
(2011, 'STS', 5875, 'Masculin'),
(2011, 'UNIV', 37639, 'Masculin'),
(2011, 'UNIV', 52561, 'Feminin'),
(2012, 'CPGE', 1447, 'Feminin'),
(2012, 'CPGE', 1923, 'Masculin'),
(2012, 'EC_ART', 433, 'Masculin'),
(2012, 'EC_ART', 512, 'Feminin'),
(2012, 'EC_autres', 373, 'Masculin'),
(2012, 'EC_autres', 730, 'Feminin'),
(2012, 'EC_JUR', 81, 'Feminin'),
(2012, 'EC_JUR', 205, 'Masculin'),
(2012, 'EC_PARAM', 611, 'Masculin'),
(2012, 'EC_PARAM', 5211, 'Feminin'),
(2012, 'ENS', 558, 'Feminin'),
(2012, 'ENS', 1183, 'Masculin'),
(2012, 'ING_autres', 324, 'Feminin'),
(2012, 'ING_autres', 1064, 'Masculin'),
(2012, 'STS', 5242, 'Feminin'),
(2012, 'STS', 5993, 'Masculin'),
(2012, 'UNIV', 37571, 'Masculin'),
(2012, 'UNIV', 52433, 'Feminin'),
(2013, 'CPGE', 1475, 'Feminin'),
(2013, 'CPGE', 2021, 'Masculin'),
(2013, 'EC_ART', 429, 'Masculin'),
(2013, 'EC_ART', 515, 'Feminin'),
(2013, 'EC_autres', 399, 'Masculin'),
(2013, 'EC_autres', 743, 'Feminin'),
(2013, 'EC_JUR', 77, 'Feminin'),
(2013, 'EC_JUR', 218, 'Masculin'),
(2013, 'EC_PARAM', 668, 'Masculin'),
(2013, 'EC_PARAM', 5533, 'Feminin'),
(2013, 'ENS', 466, 'Feminin'),
(2013, 'ENS', 1033, 'Masculin'),
(2013, 'ESPE', 308, 'Masculin'),
(2013, 'ESPE', 900, 'Feminin'),
(2013, 'ING_autres', 368, 'Feminin'),
(2013, 'ING_autres', 1078, 'Masculin'),
(2013, 'STS', 5358, 'Feminin'),
(2013, 'STS', 6047, 'Masculin'),
(2013, 'UNIV', 37415, 'Masculin'),
(2013, 'UNIV', 52106, 'Feminin'),
(2014, 'CPGE', 1530, 'Feminin'),
(2014, 'CPGE', 1942, 'Masculin'),
(2014, 'EC_ART', 438, 'Masculin'),
(2014, 'EC_ART', 532, 'Feminin'),
(2014, 'EC_JUR', 60, 'Feminin'),
(2014, 'EC_JUR', 196, 'Masculin'),
(2014, 'EC_PARAM', 595, 'Masculin'),
(2014, 'EC_PARAM', 5548, 'Feminin'),
(2014, 'ENS', 529, 'Feminin'),
(2014, 'ENS', 1271, 'Masculin'),
(2014, 'ESPE', 1038, 'Masculin'),
(2014, 'ESPE', 2658, 'Feminin'),
(2014, 'ING_autres', 392, 'Feminin'),
(2014, 'ING_autres', 1140, 'Masculin'),
(2014, 'UNIV', 36355, 'Masculin'),
(2014, 'UNIV', 50434, 'Feminin'),
(2015, 'CPGE', 1591, 'Feminin'),
(2015, 'CPGE', 2008, 'Masculin'),
(2015, 'EC_ART', 464, 'Masculin'),
(2015, 'EC_ART', 544, 'Feminin'),
(2015, 'EC_autres', 404, 'Masculin'),
(2015, 'EC_autres', 787, 'Feminin'),
(2015, 'EC_JUR', 96, 'Feminin'),
(2015, 'EC_JUR', 384, 'Masculin'),
(2015, 'EC_PARAM', 595, 'Masculin'),
(2015, 'EC_PARAM', 5548, 'Feminin'),
(2015, 'ENS', 529, 'Feminin'),
(2015, 'ENS', 1271, 'Masculin'),
(2015, 'ESPE', 1266, 'Masculin'),
(2015, 'ESPE', 3531, 'Feminin'),
(2015, 'ING_autres', 387, 'Feminin'),
(2015, 'ING_autres', 1109, 'Masculin'),
(2015, 'STS', 5427, 'Feminin'),
(2015, 'STS', 6224, 'Masculin'),
(2015, 'UNIV', 37125, 'Masculin'),
(2015, 'UNIV', 50574, 'Feminin');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`code`, `nom`) VALUES
('CPGE', 'Classes préparatoires aux grandes écoles (CPGE)'),
('EC_ART', 'Écoles supérieures art et culture'),
('EC_autres', 'Autres écoles de spécialités diverses'),
('EC_JUR', 'Écoles juridiques et administratives'),
('EC_PARAM', 'Écoles paramédicales et sociales'),
('ENS', 'Écoles normales supérieures (ENS)'),
('ESPE', 'ESPE'),
('ING_autres', 'Autres formations d\'ingénieurs'),
('STS', 'Sections de techniciens supérieurs (STS) et assimilés'),
('UNIV', 'Universités');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `effectifs`
--
ALTER TABLE `effectifs`
  ADD UNIQUE KEY `annee` (`annee`,`code`,`nombre`,`sexe`),
  ADD KEY `code` (`code`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`code`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `effectifs`
--
ALTER TABLE `effectifs`
  ADD CONSTRAINT `effectifs_ibfk_1` FOREIGN KEY (`code`) REFERENCES `formations` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
