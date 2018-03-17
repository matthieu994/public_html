-- Base de données :  `TP5`
CREATE DATABASE IF NOT EXISTS `TP5` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `TP5`;

--------------------------------------------------------

-- Structure de la table `listeDeCourse`

CREATE TABLE IF NOT EXISTS `listeDeCourse` (
  `identifiant` int(11) NOT NULL,
  `article` text NOT NULL,
  `quantite` int(11) NOT NULL,
  `personne` varchar(25) NOT NULL,
  `prix` int(10) NOT NULL,
  `payeur` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `listeDeCourse`
  ADD PRIMARY KEY (`identifiant`);

ALTER TABLE `listeDeCourse`
  MODIFY `identifiant` int(11) NOT NULL AUTO_INCREMENT;

--------------------------------------------------------

-- Structure de la table `paiement`

CREATE TABLE `paiement` (
  `personne` varchar(25) NOT NULL,
  `montant` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `paiement`
  ADD PRIMARY KEY (`personne`),
  ADD UNIQUE KEY `personne` (`personne`);
