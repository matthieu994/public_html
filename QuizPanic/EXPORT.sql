
--
-- Base de données :  `petitm`
--
CREATE DATABASE IF NOT EXISTS `projet_matthieu` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projet_matthieu`;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `username` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `room` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lobbys`
--

CREATE TABLE `lobbys` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `score` int(3) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `room` varchar(25) DEFAULT NULL,
  `answer` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lobbys`
--

INSERT INTO `lobbys` (`id`, `username`, `score`, `admin`, `room`, `answer`) VALUES
(3, 'admin', 0, 0, NULL, 0),
(4, 'testT', 0, 0, NULL, 0),
(5, 'AAAAAAAAAA', 0, 0, NULL, 0),
(6, 'david', 0, 0, NULL, NULL),
(7, 'abcd', 0, 0, NULL, NULL),
(8, 'ketchup', 0, 0, NULL, NULL),
(9, 'hey', 0, 0, NULL, NULL),
(10, 'test', 3, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `username` varchar(25) NOT NULL,
  `question` mediumtext NOT NULL,
  `answer1` mediumtext NOT NULL,
  `answer2` mediumtext NOT NULL,
  `answer3` mediumtext NOT NULL,
  `answer4` mediumtext NOT NULL,
  `good_answer` int(1) NOT NULL,
  `question_set` varchar(25) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`username`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `good_answer`, `question_set`, `id`) VALUES
('Sofian', 'Quel est le mot préféré de benoit', 'Excellent', 'génial', 'bravo', 'coucou', 1, 'Public', 92),
('admin', 'Quelle entreprise, fondée par Jack Ma, domine le commerce électronique en Chine ?', 'Chinaco', 'Gearbest', 'Tang Frères', 'Alibaba', 4, 'Public', 116),
('admin', 'Qui incarne Cyrano de Bergerac dans le film éponyme de 1990 ?', 'Alain Delon', 'Jean Reno', 'Christian Clavier', 'Gérard Depardieu', 4, 'Public', 118),
('admin', 'Dans quel domaine artistique le français Jacques Majorelle a-t-il exercé ses talents ?', 'Peinture', 'Cinéma', 'Théâtre', 'Photographie', 1, 'NULL', 119),
('admin', 'À quel historien et pédagogue français doit-on les Jeux olympiques modernes ?', 'Pierre de Coubertin', 'Napoléon Bonaparte', 'Duc de Windsor', 'Pie XI', 1, 'NULL', 120),
('admin', 'À quel insecte Volkswagen a-t-elle emprunté le nom pour une des ses voitures ?', 'Coccinelle', 'Libellule', 'Sauterelle', 'Papillon', 1, 'NULL', 121),
('admin', 'Quel reptile africain fait en sorte que sa peau prenne la couleur du milieu où il évolue ?', 'Caméléon', 'Crotale', 'Genette', 'Lézard', 1, 'NULL', 122),
('admin', 'Qui aurait murmuré cette phrase en 1633 : « Et pourtant elle tourne » ?', 'Galilée', 'De Vinci', 'Copernic', 'Newton', 1, 'NULL', 126),
('admin', 'Dans quel pays se situe la Kabylie, région historique et ethnolinguistique ?', 'Algérie', 'Tunisie', 'Maroc', 'Irak', 1, 'Public', 127),
('admin', 'Quel sport fut créé par Jigoro Kano, alors éducateur dans l\'enseignement primaire ?', 'Judo', 'Karaté', 'Sumo', 'Tae kwon do', 1, 'Public', 128),
('admin', 'Quel célèbre compositeur et musicien allemand est devenu sourd à 27 ans ?', 'Beethoven', 'Wagner', 'Bach', 'Mozart', 1, 'Public', 129),
('admin', 'Situé au nord du continent africain, sur combien de pays le Sahara est-il étendu ?', '10', '5', '8', '13', 1, 'Public', 130),
('admin', 'Quel poisson prédateur commun en eaux douces possède environ 700 dents ?', 'Brochet', 'Carpe', 'Truite', 'Goujon', 1, 'Public', 131),
('admin', 'Qui a réalisé le film The Pledge avec Jack Nicholson et Robin Wright Penn ?', 'Sean Penn', 'Sam Mendes', 'John Astin', 'Tom Hanks', 1, 'Public', 132),
('admin', 'En quelle année Philippe Noiret se fit-il connaître avec le film Zazie dans le métro ?', '1960', '1950', '1970', '1980', 1, 'Public', 133),
('admin', 'Aux côtés de quel musicien Élodie Frégé a-t-elle sorti Le jeu des 7 erreurs ?', 'Benjamin Biolay', 'Pascal Obispo', 'Laurent Voulzy', 'Etienne Daho', 1, 'Public', 134),
('admin', 'Quel auteur belge de bandes dessinées est le scénariste de Kid Paddle ?', 'Midam', 'Midem', 'Modem', 'Mudim', 1, 'Public', 135),
('admin', 'Dans quel continent trouve-t-on le mandrill, apparenté au babouin ?', 'Afrique', 'Asie', 'Océanie', 'Europe', 1, 'Public', 136),
('admin', 'Combien de temps dura l\'impressionnant règne de la reine Victoria ?', 'Près de 64 ans', 'Près de 47 ans', 'Près de 53 ans', 'Près de 39 ans', 1, 'Public', 137),
('admin', 'Combien y avait-il de candidats au premier tour des présidentielles de 2007 en France ?', '12', '11', '10', '13', 1, 'Public', 138),
('admin', 'Le futurisme est un mouvement littéraire et artistique originaire de quel pays ?', 'Italie', 'France', 'Royaume-Uni', 'Allemagne', 1, 'Public', 139),
('admin', 'De symbole T, que vaut le préfixe « téra », extrait du système international ?', '10 exposant 12', '10 exposant 9', '10 exposant 15', '10 exposant 20', 1, 'Public', 140),
('admin', 'À qui doit-on le canal de Suez, percé entre 1859 et 1869 ?', 'Ferdinand de Lesseps', 'Léonide Méssine', 'Andrew Jackson', 'François Charles', 1, 'Public', 141),
('admin', 'Quelle plante à la racine comestible est utilisée pour la fabrication du tapioca ?', 'Manioc', 'Guarana', 'Ginseng', 'Gingembre', 1, 'Public', 142),
('admin', 'Quelle unité monétaire est principalement utilisée au Paraguay ?', 'Guarani', 'Couronne', 'Peso', 'Franc', 1, 'Public', 143),
('admin', 'Quel est le prénom de la fille du musicien brésilien Joao Gilberto ?', 'Bebel', 'Rosanna', 'Felicia', 'Hanne', 1, 'Public', 144),
('admin', 'Quel guitariste a fondé le groupe de heavy-metal Kiss, en 1973 ?', 'Paul Stanley', 'Dave Mustaine', 'Kirk Hammett', 'Mick Mars', 1, 'Public', 145),
('admin', 'Les félins ont tous des griffes rétractiles sauf lequel de ces carnivores ?', 'Guépard', 'Léopard', 'Panthère', 'Lion', 1, 'Public', 146),
('admin', 'Quel film à succès a réuni sur les écrans Sean Connery et Christophe Lambert ?', 'Highlander', 'Subway', 'Mad Max', 'Greystoke', 1, 'Public', 147),
('admin', 'Quel pays, dont les premiers habitants étaient des Newars, a pour capitale Katmandou ?', 'Népal', 'Tibet', 'Corée du Nord', 'Pakistan', 1, 'Public', 148),
('admin', 'Dans quel film John Travolta incarne-t-il un ange tombé du ciel ?', 'Michael', 'Johnny', 'Sam', 'Jerry', 1, 'Public', 149),
('admin', 'Pour quel auteur-compositeur-interprète français aux 40 millions de disques vendus Capri est-il fini ?', 'Hervé Vilard', 'Salvatore Adamo', 'Serge Lama', 'Charles Aznavour', 1, 'Public', 150),
('admin', 'Quel peintre, né en 1844, est également appelé par beaucoup « le Douanier » ?', 'Henri Rousseau', 'Pablo Picasso', 'Edgar Degas', 'Salvador Dali', 1, 'Public', 151),
('admin', 'Quel personnage imaginaire fut popularisé par le roman de E.R. Burroughs et par le cinéma ?', 'Tarzan', 'King-Kong', 'Nessie', 'Le Yéti', 1, 'Public', 152),
('admin', 'Quelle est la seule valeur à la roulette à porter la couleur verte ?', 'Le zéro', 'Le quarante', 'Le cinquante', 'Le treize', 1, 'Public', 153),
('admin', 'Quelle est la race du chien de Columbo, l\'inspecteur très obstiné et perspicace de la télévision ?', 'Basset', 'Beagle', 'Bichon', 'Barbet', 1, 'Public', 154),
('admin', 'Quelle est la plus petite unité de mémoire utilisable sur un ordinateur ?', 'Bit', 'Byte', 'Giga', 'Méga', 1, 'Public', 155),
('admin', 'Dans le langage familier, comment appelle-t-on la dent du petit enfant ?', 'Quenotte', 'Menotte', 'Bouillotte', 'Marmotte', 1, 'Public', 156),
('admin', 'Où se situe la célèbre base navale américaine de Guantanamo, réputée pour sa sévérité ?', 'Cuba', 'Mexique', 'Hawaii', 'Paraguay', 1, 'Public', 157),
('admin', 'Quelle est la spécialité du sportif tunisien Oussama Mellouli ?', 'Natation', 'Marathon', 'Football', 'Boxe', 1, 'Public', 158),
('admin', 'Quel acteur français a remporté le premier rôle dans le film Le Guépard ?', 'Alain Delon', 'Claude Brasseur', 'Jean Gabin', 'Jean-Paul Belmondo', 1, 'Public', 159),
('admin', 'Qui était le compagnon de Paul de Tarse, désigné aussi sous le nom de saint Paul ?', 'Saint Luc', 'Saint Matthieu', 'Saint Jean', 'Saint Marc', 1, 'Public', 160),
('admin', 'Quel titre de noblesse est immédiatement inférieur à celui de comte ?', 'Vicomte', 'Marquis', 'Duc', 'Archiduc', 1, 'Public', 161),
('admin', 'Quelle est la capitale de la Nouvelle-Zélande, pays d\'Océanie au sud-ouest de l\'océan Pacifique ?', 'Wellington', 'Dublin', 'Sydney', 'Auckland', 1, 'Public', 162),
('admin', 'Quel film a réuni sur les écrans Isabelle Adjani et Sharon Stone ?', 'Diabolique', 'Les sorcières', 'Ange et Démon', 'Les ensorceleuses', 1, 'Public', 163),
('admin', 'Comment est également appelée la Transat Jacques Vabre ?', 'Route du café', 'Route du rhum', 'Trophée du rhum', 'Vendée Globe', 1, 'Public', 164),
('admin', 'Quel oiseau vivant dans l\'hémisphère nord nage le plus vite ?', 'Pingouin', 'Bécassine', 'Martinet', 'Pie', 1, 'Public', 165),
('admin', 'Quelle est la plus grosse des planètes de notre Système solaire ?', 'Jupiter', 'Saturne', 'Uranus', 'Neptune', 1, 'Public', 166),
('admin', 'Apparu il y a 450 millions d\'années, à quelle classe animale le scorpion appartient-il ?', 'Arachnides', 'Reptiles', 'Insectes', 'Mammifères', 1, 'Public', 167),
('admin', 'Quel frère d\'une actrice prénommée Mary a réalisé le film La fièvre du samedi soir ?', 'John Badham', 'John Travolta', 'John Payne', 'John Remezick', 1, 'Public', 168),
('admin', 'Au Moyen Âge, comment appelait-on un village fortifié ?', 'Bastide', 'Château fort', 'Rempart', 'Tour', 1, 'Public', 169),
('admin', 'Quelle ville du Kent est célèbre pour sa source miraculeuse ?', 'Tunbridge Wells', 'Gillingham', 'Dartford', 'Ramsgate', 1, 'Public', 170),
('admin', 'Quel apéritif à base de vin est aromatisé avec des plantes amères et toniques ?', 'Vermouth', 'Kokebok', 'Gentiane', 'Piccolo', 1, 'Public', 171),
('admin', 'À quel écrivain, membre de l\'Académie française, doit-on le roman intitulé Le sagouin ?', 'Mauriac', 'Giono', 'Camus', 'Barjavel', 1, 'Public', 172),
('admin', 'Quel président Français trouva la mort dans une situation « inhabituelle » ?', 'Félix Faure', 'René Coty', 'Georges Pompidou', 'Raymond Poincaré', 1, 'Public', 173),
('admin', 'Comment appelle-t-on le versant de la montagne non situé au soleil ?', 'Ubac', 'Adret', 'Étant', 'Ressac', 1, 'Public', 174),
('admin', 'Quel oiseau palmipède a pour particularité de construire un nid flottant ?', 'Grèbe', 'Grèle', 'Grève', 'Grène', 1, 'Public', 175),
('admin', 'Un bédane, qui doit son nom à sa ressemblance avec un bec de canard, est un outil proche du...', 'Ciseau à bois', 'Maillet', 'Vilebrequin', 'Rabot', 1, 'Public', 176),
('admin', 'Quel arbre est connu pour atteindre les volumes les plus importants ?', 'Le séquoia', 'Le chêne', 'Le pin', 'Le hêtre', 1, 'Public', 177),
('admin', 'Quelles sont les trois couleurs fondamentales pour le peintre ?', 'Rouge, bleu et jaune', 'Blanc, bleu et rouge', 'Vert, rouge et jaune', 'Rouge, bleu et vert', 1, 'Public', 178),
('admin', 'Dans quelle ville peut-on admirer le très touristique pont des Soupirs ?', 'Venise', 'Avignon', 'Prague', 'Londres', 1, 'Public', 179),
('admin', 'Quel métier exerçait le sportif argentin Juan Manuel Fangio ?', 'Pilote', 'Nageur', 'Boxeur', 'Coureur', 1, 'Public', 180),
('admin', 'Quelle personne a pour mission principale de gérer un site internet ?', 'Un webmaster', 'Un webcontroler', 'Un websiter', 'Un webcleaner', 1, 'Public', 181),
('admin', 'Avant de devenir chevalier, quel est le rang pour un apprenti Jedi ?', 'Padawan', 'Novice', 'Jawas', 'Hutts', 1, 'Public', 182),
('admin', 'Dans quelle aventure Tintin se retrouve-t-il face à un impressionnant Yeti ?', 'Tintin au Tibet', 'Tintin au Congo', 'Le Lotus bleu', 'Coke en Stock', 1, 'Public', 183),
('admin', 'Comment se prénomment les frères de William et Averell Dalton dans Lucky Luke ?', 'Joe et Jack', 'Jim et John', 'John et Joe', 'Jack et Jim', 1, 'Public', 184),
('admin', 'Dans quel sport Rocco Francis Marchegiano dit « Rocky Marciano » était-il imbattable ?', 'La boxe', 'Le tennis', 'La natation', 'Le catch', 1, 'Public', 185),
('admin', 'Quels muscles du corps humain peuvent être qualifiés de « tablettes de chocolat » ?', 'Les abdominaux', 'Les adducteurs', 'Les triceps', 'Les biceps', 1, 'Public', 186),
('admin', 'Durant quelle période Philippe Pétain assura-t-il le gouvernement de la France ?', 'De 1940 à 1944', 'De 1939 à 1945', 'De 1941 à 1944', 'De 1941 à 1945', 1, 'Public', 187),
('admin', 'Quel est le prénom de Kate Winslet dans le film Titanic de James Cameron ?', 'Rose', 'Liz', 'Carla', 'Jeanne', 1, 'Public', 188),
('admin', 'Sur quelle espérance de vie moyenne une girafe peut-elle compter ?', '25 ans', '55 ans', '15 ans', '75 ans', 1, 'Public', 189),
('admin', 'Quel célèbre Claude a réalisé en 1985 le film Poulet au vinaigre ?', 'Claude Chabrol', 'Claude Berri', 'Claude Miller', 'Claude Pieplu', 1, 'Public', 190),
('admin', 'Quel archipel appartenant au Portugal est constitué de neuf îles et de plusieurs îlots ?', 'Les Açores', 'Les Baléares', 'Les Canaries', 'Les îles Caïman', 1, 'Public', 191),
('admin', 'En combien de provinces le Canada est-il divisé en plus des trois territoires fédéraux ?', '10 provinces', '4 provinces', '6 provinces', '50 provinces', 1, 'Public', 192),
('admin', 'Quelle faille des États-Unis est la cause de nombreux tremblements de terre ?', 'San Andreas', 'San Francisco', 'Nouveau Mexique', 'Los Angeles', 1, 'Public', 193),
('admin', 'Quel groupe hollandais des années 1990 était composé de Ray et Anita ?', '2 Unlimited', 'Enigma', 'Scorpions', 'Ace of base', 1, 'Public', 194),
('admin', 'Quel titre donnait-on à Simon Bolivar, général et homme d\'État vénézuélien ?', 'Libertador', 'Conquistador', 'Dictator', 'Volador', 1, 'Public', 195),
('admin', 'Qui a écrit et composé le deuxième album de Vanessa Paradis ?', 'Serge Gainsbourg', 'Lenny Kravitz', 'Johnny Depp', 'Alain Bashung', 1, 'Public', 196),
('admin', 'Quelle est la couleur du cercle figurant sur le drapeau du Laos ?', 'Blanche', 'Rouge', 'Bleue', 'Jaune', 1, 'Public', 197),
('admin', 'Hô-Chi-Minh-Ville est le nouveau nom de quel poumon économique ?', 'Saigon', 'Pékin', 'Vientiane', 'Tokyo', 1, 'Public', 198),
('admin', 'Dans quel pays les falaises de Moher sont-elles une attraction touristique ?', 'Irlande', 'Australie', 'Argentine', 'Grèce', 1, 'Public', 199),
('admin', 'Qui débute un de ses romans par : « Longtemps, je me suis couché de bonne heure » ?', 'Proust', 'Zola', 'Flaubert', 'Gide', 1, 'Public', 200),
('admin', 'Dans quel domaine est utilisé le terme « propylée », apparu bien avant Jésus-Christ ?', 'En architecture', 'En botanique', 'En littérature', 'En généalogie', 1, 'Public', 201),
('admin', 'De quelle plante de la famille des Liliacées le nom signifie-t-il « turban » en perse ?', 'La tulipe', 'La digitale', 'La jonquille', 'Le renoncule', 1, 'Public', 202),
('admin', 'Qui a inspiré à Ian Fleming le nom de James Bond pour son célèbre personnage ?', 'Un ornithologue', 'Un sportif', 'Un géologue', 'Un marin', 1, 'Public', 203),
('admin', 'Quelles festivités étaient célébrées à Sparte en hommage à Apollon ?', 'Les Karneia', 'Les Mounichies', 'Les Septéries', 'Les Thalysies', 1, 'Public', 204),
('admin', 'Combien existe-t-il de manières différentes de commencer une partie aux échecs ?', '20', '10', '24', '32', 1, 'Public', 205),
('admin', 'Quelle est la couleur du passeport de l\'union européenne délivré en Belgique ou en France ?', 'Bordeaux', 'Bleue', 'Verte', 'Grise', 1, 'Public', 206),
('admin', 'Comment appelle-t-on le cachet apposé sur un passeport permettant l\'entrée dans un pays ?', 'Un visa', 'Un permis', 'Un titre', 'Un code', 1, 'Public', 207),
('admin', 'De quel pays le drapeau est-il appelé « Union Jack » ou encore « Union Flag » par certains ?', 'La Grande Bretagne', 'La Grèce', 'La Finlande', 'La Suisse', 1, 'Public', 208),
('admin', 'Que vous fournira-t-on presque exclusivement pour mettre sur vos frites aux États-Unis ?', 'Du ketchup', 'De la mayonnaise', 'Du pickles', 'De la tartare', 1, 'Public', 209),
('admin', 'Quel est le seul pays d\'Europe où certaines voitures ont encore des phares jaunes ?', 'La France', 'La Belgique', 'Le Portugal', 'La Grèce', 1, 'Public', 210),
('admin', 'Quelle ville est considérée par beaucoup comme étant le centre diamantaire mondial ?', 'Anvers', 'Bruxelles', 'Liège', 'Mons', 1, 'Public', 211),
('admin', 'Quel fruit du badianier de Chine parfume des boissons comme l\'ouzo ou comme l\'arak ?', 'L\'anis étoilé', 'Le gingembre', 'Le sel noir', 'Le carvi', 1, 'Public', 212),
('admin', 'Combien coûte l\'autoroute qui relie directement les villes d\'Amsterdam et de Bruxelles ?', 'Rien', '12 euros', '19 euros', '27 euros', 1, 'Public', 213),
('admin', 'Vers où regarde-t-on en tout premier lieu avant de traverser une route en Irlande ?', 'La droite', 'La gauche', 'L\'avant', 'L\'arrière', 1, 'Public', 214),
('admin', 'Qu\'est-ce qui est turc, né en Autriche et fréquemment mangé en France au petit déjeuner ?', 'Le croissant', 'La crêpe', 'La gaufre', 'Le pistolet', 1, 'Public', 215),
('admin', 'De quel pays très fortement peuplé le paon est-il l\'oiseau national ?', 'L\'Inde', 'Le Japon', 'La Thaïlande', 'La Chine', 1, 'Public', 216),
('admin', 'Qu\'est-ce qu\'un lama, si ce n\'est pas un animal de grande taille de la cordillère des Andes ?', 'Un moine tibétain', 'Un arbre turc', 'Un pain grec', 'Un policier slave', 1, 'Public', 217),
('admin', 'Combien de zéros dans un trillion américain, égal à un million à la puissance trois ?', '12', '9', '6', '15', 1, 'Public', 218),
('admin', 'Contre quelle maladie, aussi appelée « vomi noir », vous fait-on une vaccination antiamarile ?', 'La fièvre jaune', 'La dysenterie', 'Le choléra', 'Le typhus', 1, 'Public', 219),
('admin', 'Quel port dans lequel entrent 31 000 bateaux par an est le premier de Hollande ?', 'Rotterdam', 'Amsterdam', 'La Haye', 'Utrecht', 1, 'Public', 220),
('admin', 'Quelle « protection » est-il plutôt judicieux de prévoir en Inde entre juin et octobre ?', 'Un parapluie', 'Un préservatif', 'Un casque', 'Des gants', 1, 'Public', 221),
('admin', 'Quel pays composé de provinces et de territoires a choisi le castor comme emblème national ?', 'Le Canada', 'Le Mexique', 'Le Honduras', 'Le Costa Rica', 1, 'Public', 222),
('admin', 'Quel liquide est mis sur les plages australiennes pour neutraliser les piqûres des méduses ?', 'Du vinaigre', 'De l\'essence', 'Du dissolvant', 'De la bière', 1, 'Public', 223),
('admin', 'Combien coûte une boisson alcoolisée sur un vol international Air France en première classe ?', 'Rien', '10 euros', '20 euros', '30 euros', 1, 'Public', 224),
('admin', 'De quel pays pouviez-vous jadis recevoir une carte postale affranchie avec 60 escudos ?', 'Du Portugal', 'De la Grèce', 'Des Pays-Bas', 'Du Brésil', 1, 'Public', 225),
('admin', 'Quelle est la langue qui a soixante trois formes de présent et de nombreux mots pour désigner la neige ?', 'Eskimo', 'Eyak', 'Han', 'Tanacross', 1, 'Public', 226),
('admin', 'Combien y a-t-il de bandes bleues et blanches sur le drapeau de la Grèce ?', 'Neuf', 'Sept', 'Cinq', 'Trois', 1, 'Public', 227),
('admin', 'Quelle est la drogue que l\'on tire de l\'écorce du Cinchona et que l\'on retrouve dans le Schweppes ?', 'La quinine', 'La nicotine', 'La brucine', 'Le camphre', 1, 'Public', 228),
('admin', 'Qu\'est-ce qui change autour du 180e méridien, dans l\'océan Pacifique ?', 'La date', 'La température', 'La lumière', 'L\'humidité', 1, 'Public', 229),
('admin', 'Jusqu\'à quelle valeur en-dessous de zéro peut descendre le thermomètre en hiver en Sibérie ?', '- 80°C', '- 60°C', '- 40°C', '- 20°C', 1, 'Public', 230),
('admin', 'À quoi vous servira un charpoi en Inde, que vous le fassiez en boule, sur le dos ou sur le ventre ?', 'À dormir', 'À chasser', 'À manger', 'À travailler', 1, 'Public', 231),
('admin', 'Quelle heure est-il à Los Angeles quand vous prenez votre petit déjeuner à New York à 8h ?', '5h', '2h', '10h', '3h', 1, 'Public', 232),
('admin', 'Quel État très fortement peuplé est aussi le plus grand des États-Unis, après l\'Alaska ?', 'Le Texas', 'La Virginie', 'Le Wyoming', 'Le Michigan', 1, 'Public', 233),
('admin', 'À côté de quel animal mythique se dresse fièrement le lion du passeport britannique ?', 'Une licorne', 'Un ours', 'Un panda', 'Un mouton', 1, 'Public', 234),
('admin', 'Qui repose dans les trois petites pyramides de Gizeh, placées à côté des trois grandes ?', 'Les reines', 'Les prêtres', 'Les esclaves', 'Les mages', 1, 'Public', 235),
('admin', 'Quel logiciel de traitement de texte a été mis au point par Microsoft ?', 'Word', 'Excel', 'PowerPoint', 'Access', 1, 'Public', 236),
('admin', 'Le logiciel Excel extrait de la suite bureautique Microsoft Office est un...', 'Tableur', 'Traitement de texte', 'Navigateur internet', 'Client de messagerie', 1, 'Public', 237),
('admin', 'En informatique, comment appelle-t-on une erreur de programmation encore non localisée ?', 'Un bug', 'Un crack', 'Un spam', 'Un virus', 1, 'Public', 238),
('admin', 'Quelle version de Windows Microsoft a-t-il lancé le vendredi 26 octobre 2012 ?', 'Windows 8', 'Windows 7', 'Windows CE', 'Windows Mobile', 1, 'Public', 239),
('admin', 'Comment est communément abrégée la publication assistée par ordinateur ?', 'PAO', 'USB', 'VGA', 'CIO', 1, 'Public', 240),
('admin', 'Quelle application informatique de la société Apple permet de gérer facilement un iPod ?', 'iTunes', 'QuickTime', 'FileMaker', 'HyperCard', 1, 'Public', 241),
('admin', 'En informatique, quel logiciel permet de créer des calculs automatiques ?', 'Un tableur', 'Un débogueur', 'Un navigateur', 'Un explorateur', 1, 'Public', 242),
('admin', 'Quel pirate informatique casse les systèmes informatique et les logiciels protégés ?', 'Un hacker', 'Un blagueur', 'Un forceur', 'Un pirateur', 1, 'Public', 243),
('admin', 'Quels logiciels installés sur PC, tablette ou smartphone, permettent de « surfer » sur Internet ?', 'Des navigateurs', 'Des tableurs', 'Des éditeurs', 'Des émulateurs', 1, 'Public', 244),
('admin', 'Quel outil développé par le géant Google permet de gérer son emploi du temps ?', 'Google Agenda', 'Google TimeLine', 'Google Tempo', 'Google Mobile', 1, 'Public', 245),
('admin', 'Quelle grande société a reçu le feu vert en 2011 pour le rachat de Skype ?', 'Microsoft', 'Google', 'Apple', 'Facebook', 1, 'Public', 246),
('admin', 'Quel est probablement le plus connu des systèmes informatiques dits « libre » ?', 'Linux', 'Windows', 'MS-DOS', 'Mac OS', 1, 'Public', 247),
('admin', 'Quelle est le nom de la solution professionnelle de services Google ?', 'Google Apps', 'Google Pro', 'Google Serve', 'Google Mac', 1, 'Public', 248),
('admin', 'Quel logiciel est mis gratuitement et librement à disposition par son créateur ?', 'Un freeware', 'Un malware', 'Un adware', 'Un software', 1, 'Public', 249),
('admin', 'En avril 2012, quelle start-up Facebook a-t-il racheté pour un milliard de dollars ?', 'Instagram', 'Globalnet', 'Valve', 'Backelite', 1, 'Public', 250),
('admin', 'Au Québec, quel mot est souvent utilisé pour désigner le courrier électronique ?', 'Courriel', 'Emel', 'Lettrinter', 'Copitel', 1, 'Public', 251),
('admin', 'Quel logiciel de Microsoft a remplacé Windows Live Messenger en 2013 ?', 'Skype', 'Instagram', 'QuickTime', 'Pidgin', 1, 'Public', 252),
('admin', 'Quel nom portait le navigateur Internet de Microsoft, devenu aujourd\'hui Microsoft Edge ?', 'Internet Explorer', 'Safari', 'Chrome', 'Firefox', 1, 'Public', 253),
('admin', 'Quel logiciel est indispensable pour protéger votre ordinateur sur Internet ?', 'Un antivirus', 'Un chat', 'Un navigateur', 'Une messagerie', 1, 'Public', 254),
('admin', 'Qui est le tout premier pape à avoir envoyé un message sur Twitter ?', 'Benoît XVI', 'François', 'Jean-Paul II', 'Paul VI', 1, 'Public', 255),
('admin', 'Quel courrielleur créé par Mozilla est le compagnon idéal du navigateur Firefox ?', 'Thunderbird', 'Incredimail', 'Sylpheed', 'Foxmail', 1, 'Public', 256),
('admin', 'Quel nom porte la suite bureautique en ligne proposée par Microsoft ?', 'Office 365', 'KOffice', 'OpenOffice', 'StarOffice', 1, 'Public', 257),
('admin', 'Quel était le nom de code de la version 3.1 de Windows ?', 'Janus', 'Startus', 'Uranus', 'Opus', 1, 'Public', 258),
('admin', 'Quel nom porte le service de stockage en ligne de Windows Live ?', 'Onedrive', 'Dropbox', 'RapidShare', 'MediaFire', 1, 'Public', 259),
('admin', 'Quel est le nouveau nom du logiciel gratuit de messagerie instantanée Gaim ?', 'Pidgin', 'Connect', 'iShare', 'Komunnity', 1, 'Public', 260),
('admin', 'Quelle suite logicielle équivaut à Microsoft Office chez le géant Google ?', 'Google Documents', 'OpenOffice', 'Google Sites', 'Works', 1, 'Public', 261),
('admin', 'De quel pays la suite logicielle gratuite Opera est-elle originaire ?', 'Norvège', 'France', 'Italie', 'Autriche', 1, 'Public', 262),
('admin', 'Lequel de ces outils ne permet pas de visionner des pages web ?', 'Acrobat Reader', 'Mozilla Firefox', 'Google Chrome', 'Internet Explorer', 1, 'Public', 263),
('admin', 'Combien de téléchargements dénombrait-on sur le célèbre App Store fin 2012 ?', '35 milliards', '25 milliards', '15 milliards', '5 milliards', 1, 'Public', 264),
('admin', 'Quelle est la date « officielle » de création de Wikipédia en Français ?', 'Le 23 mars 2001', 'Le 2 janvier 1999', 'Le 15 janvier 2002', 'Le 8 décembre 2000', 1, 'Public', 265);


-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `maxplayers` int(2) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'On',
  `question_count` int(2) NOT NULL DEFAULT '5',
  `delay` int(2) NOT NULL DEFAULT '10',
  `question_set` varchar(25) NOT NULL,
  `question` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `username`, `maxplayers`, `status`, `question_count`, `delay`, `question_set`, `question`) VALUES
(62, 'Salle 1', 'admin', 2, 'On', 5, 10, 'Public', NULL),
(63, 'DUT', 'testT', 1, 'On', 5, 10, '', -1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `avatar` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `avatar`) VALUES
(1, 'user', 'Matthieu', '098f6bcd4621d373cade4e832627b4f6', 1),
(3, 'restricted', 'questions', 'restricted', 1),
(5, 'restricted', 'users', 'restricted', 1),
(6, 'user', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(7, 'user', 'testT', '91f70994dc0126828b25bd255ebb4cbb', 3),
(8, 'user', 'AAAAAAAAAA', '16c52c6e8326c071da771e66dc6e9e57', 4),
(9, 'user', 'david', '172522ec1028ab781d9dfd17eaca4427', 1),
(10, 'user', 'abcd', 'e2fc714c4727ee9395f324cd2e7f331f', 1),
(11, 'user', 'ketchup', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(12, 'user', 'hey', '6057f13c496ecf7fd777ceb9e79ae285', 1),
(13, 'user', 'test', '098f6bcd4621d373cade4e832627b4f6', 12);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lobbys`
--
ALTER TABLE `lobbys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_room` (`name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lobbys`
--
ALTER TABLE `lobbys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT pour la table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lobbys`
--
ALTER TABLE `lobbys`
  ADD CONSTRAINT `lobbys_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
