-- Adminer 4.8.1 MySQL 5.5.5-10.6.12-MariaDB-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `author` (`id`, `name`) VALUES
(92,	'Luc Rémond'),
(93,	'Mathias Wigge'),
(94,	'Paula Henning'),
(95,	'Robert Henning'),
(96,	'Kosch'),
(97,	'Johannes Sich'),
(98,	'Non renseigné'),
(99,	'Alexander Bernhardt'),
(100,	'Jules Messaud'),
(101,	'Maxime Tardif'),
(102,	'Antonin Boccara'),
(103,	'Romaric Galonnier'),
(104,	'Christian Kudahl'),
(105,	'Marvin Hegen'),
(106,	'Richard Garfield'),
(107,	'Skaff Elias'),
(108,	'David Carmona'),
(109,	'Karen Nguyen'),
(110,	'Antoine Bauza'),
(111,	'Kaya Miyano'),
(112,	'Rémi Mathieu'),
(113,	'Bruno Faidutti'),
(114,	'Vlaada Chvátil'),
(115,	'Bruno Cathala'),
(116,	'Théo Rivière');

DROP TABLE IF EXISTS `bibliogame`;
CREATE TABLE `bibliogame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `is_available` tinyint(1) DEFAULT NULL,
  `borrowed_by` int(11) DEFAULT NULL,
  `borrowed_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_2E765A0DE48FD905` (`game_id`),
  KEY `IDX_2E765A0D7597D3FE` (`member_id`),
  CONSTRAINT `FK_2E765A0D7597D3FE` FOREIGN KEY (`member_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_2E765A0DE48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `editor`;
CREATE TABLE `editor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `editor` (`id`, `name`, `slug`) VALUES
(50,	'Scorpion Masqué',	'scorpion-masqué'),
(51,	'Super Meeple',	'super-meeple'),
(52,	'Borderline',	'borderline'),
(53,	'Look Out Spiele',	'look-out-spiele'),
(54,	'Spielwiese',	'spielwiese'),
(55,	'Spin Master',	'spin-master'),
(56,	'Magilano',	'magilano'),
(57,	'Gigamic',	'gigamic'),
(58,	'Lucky Duck Games',	'lucky-duck-games'),
(59,	'OldChap',	'oldchap'),
(60,	'Iello',	'iello'),
(61,	'Unfriendly games',	'unfriendly-games'),
(62,	'Repos Production',	'repos-production'),
(63,	'Cocktail games',	'cocktail-games'),
(64,	'Space Cowboys',	'space-cowboys'),
(65,	'EDGE',	'edge'),
(66,	'Savana',	'savana'),
(67,	'Bombyx',	'bombyx');

DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editor_id` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `minimum_age` int(11) DEFAULT NULL,
  `release_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `rating` double DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `player_min` int(11) NOT NULL,
  `player_max` int(11) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `short_description` longtext NOT NULL,
  `long_description` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_232B318C6995AC4C` (`editor_id`),
  CONSTRAINT `FK_232B318C6995AC4C` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `game` (`id`, `editor_id`, `title`, `minimum_age`, `release_at`, `rating`, `duration`, `image_url`, `player_min`, `player_max`, `slug`, `short_description`, `long_description`) VALUES
(112,	50,	'Sky Team',	14,	'1994-09-27 21:11:07',	NULL,	20,	'https://www.play-in.com/img/product/l/sky-team-jeu-scorpion-masque-boite.jpg',	2,	2,	'sky-team',	'Dans Sky Team, vous et votre copilote êtes aux commandes d\'un avion de ligne. Saurez-vous le faire atterrir sans cahots ?',	'Sky Team : Pas de turbulences dans le cockpit !\n\nSky Team est un jeu de pose de dés coopératif à communication limité dans lequel les joueurs doivent parvenir à poser un avion sans encombre dans son aéroport. Il se joue exclusivement à 2 joueurs ou joueuses, dès 14 ans, pour des parties de 20 minutes environ.\n\nFaites atterrir votre avion de ligne\n\nL\'aéroport est en vue, mais la piste est encore encombrée, les trains d\'atterrissage peinent à sortir, les volets à s\'ouvrir... Et il faut encore gérer la vitesse ! \n\nRépartissez-vous les rôles de Pilote et Copilote. Chacun devra s\'aligner sur l\'autre mais aura ses propres actions à gérer. La partie se joue en 7 manches, chacune comportant 3 phases. Durant la première, vous pouvez discuter librement pour établir votre stratégie de la manche. Une fois que vous avez lancé les dés, la communication est limitée ! Passez en phase de pose de dés. Ceux-ci activeront différentes zones, certaines accessibles aux deux joueurs, d\'autres propres à chaque rôle. Certains emplacements requièrent des valeurs particulières, d\'autres se font en réaction aux actions de votre partenaire. Utilisez votre Radio pour dégager la piste d\'atterrissage avant de vous y engager, déployez votre train d\'atterrissage et vos volets, et surtout gérez l\'axe de votre avion et la puissance allouée aux réacteurs pour coordonner votre progression avec votre altitude, qui décroit automatiquement à chaque manche. Enfin, utilisez les freins pour immobiliser votre appareil. Heureusement, des services de café vous aident à affuter votre concentration et modifier les dés ! La troisième phase permet à chacun de récupérer ses dés et voit l\'altitude de l\'avion se réduire. Aurez-vous préparé votre véhicule comme il faut quand vous toucherez le sol ?\n\nUn jeu de coopération tout en interactions\n\nSky Team propose un défi passionnant à chaque partie ! Coordination et efficacité seront nécessaires pour poser votre engin, pour des ambiances riches en sueurs froides ! Une fois le scénario d\'introduction fini, découvrez des règles avancées pour un challenge à votre niveau et plusieurs modules à combiner au fil de scénarios préparés ou de dispositions issues de votre imagination ! Un jeu idéal pour les joueurs initiés qui recherchent une expérience intense à deux joueurs !Contenu :\n\n1 Tableau de bord1 rondelle Axe de l’avion4 dés Pilote (bleus) et 4 dés Copilote (orange)2 écrans / aide de jeu1 piste Altitude1 piste Approche Montréal - YUL12 jetons Avion2 marqueurs de Résistance au vent (bleu et orange)1 marqueur Frein (rouge)3 marqueurs Concentration4 modules10 Interrupteurs, pour les Volets et Train d’atterrissage et Freins1 dé Trafic2 marqueurs Relance2 livrets de règlesÀ partir de 14 ans, pour 2 joueurs et pour des parties d\'environ 20 minutes.\n'),
(113,	51,	'Ark Nova - Extension Mondes Marins',	14,	'1960-01-10 11:18:12',	NULL,	120,	'https://www.play-in.com/img/product/l/ark-nova-extension-fonds-marins-boite-de-jeu.jpg',	1,	4,	'ark-nova---extension-mondes-marins',	'Avec Mondes Marins, ajoutez des aquariums à vos zoos d\'Ark Nova et remplissez-les d\'animaux marins ! Découvrez aussi les nouvelles universités et leurs effets !',	'Ark Nova - Extension Mondes Marins\n\nMondes Marins est une extension pour le jeu de gestion de main Ark Nova, qui permet d\'ajouter à son zoo des aquariums, mais aussi un nouveau type d\'université. Il se joue de 1 à 4, dès 14 ans, pour des parties entre 90 et 150 minutes.\n\nIntégrez le monde du silence\n\nLe monde aquatique rejoint les zoos d\'Ark Nova ! Avec cette extension, découvrez de nouveaux animaux et des tuiles aquarium pour les héberger ! Le plateau Association évolue aussi, avec de nouvelles universités qui permettent d\'obtenir des icônes Animal supplémentaires ! Des versions alternatives des cartes Action augmentent l\'asymétrie du jeu et multiplient les stratégies ! De quoi renouveler l\'expérience déjà riche d\'Ark Nova !\n\nUn jeu de base Ark Nova est nécessaire pour jouer à cette extension.Contenu :\n\n1 plateau Association119 cartes40 jetons en bois30 jetonsÀ partir de 14 ans, de 1 à 4 joueurs et pour des parties d\'environ 120 minutes.\n'),
(114,	52,	'Kluster',	14,	'1955-05-13 05:02:35',	NULL,	10,	'https://www.play-in.com/img/product/l/kluster.jpg',	1,	4,	'kluster',	'Kluster est un jeu d\'aimants stratégique totalement fou, rapide et fun ! Placez toutes vos pierres avant vos adversaires mais attention au champ magnétique !',	'Présent dans les listes suivantes :\n\n\n\n\n\n\n\n\n\n\n\nSélection des meilleurs jeux de voyage\n\n\n\n\n\n\n\n\n\n\n\nKluster : Magnétisme stratégique\n\nKluster est un jeu d\'adresse et de stratégie qui repose sur l\'utilisation d\'un champ magnétique.\n\nChaque joueur reçoit en début de partie un nombre égal de pierres aimantées. Chacun à votre tour, vous devez placer une pierre dans la zone définie par la corde. Le premier à se débarasser de toutes ses pierres est déclaré vainqueur. Mais attention, si votre pierre s\'aimante à celle d\'un autre joueur, vous devez les récupérer toutes les deux !\n\nKluster introduit des ruses à utiliser contre vos adversaires : déplacer la corde, utiliser le champ magnétique, poser des pierres verticalement, placer vos pierres les unes à côté des autres...Chaque pierre est différente (taille et forme) et n\'a pas le même pouvoir magnétique !\n\nPassez entre les pierres, ma&icirc;trisez le champ magnétique, imposez votre stratégie !\n\n \n\nEn raison des lois belges regardant la vente de jeux et jouets, Kluster n\'est pas disponible pour la Belgique.Contenu :\n\n24 pierres magné­tiques1 corde1 sac de trans­portÀ partir de 14 ans, de 1 à 4 joueurs et pour des parties d\'environ 10 minutes.\n'),
(115,	53,	'Forêt Mixte',	10,	'2003-05-16 06:32:11',	NULL,	60,	'https://www.play-in.com/img/product/l/foret-mixte-jeu-look-out-spiele-boite.jpg',	2,	4,	'forêt-mixte',	'Dans Forêt Mixte, multipliez les arbres de votre forêt pour accueillir les créatures qui vivent dans leurs frondaisons et avoir le plus beau sous-bois !',	'Forêt Mixte : Un sous-bois grouillant de vie\n\nForêt Mixte est un jeu de gestion de main et combinaisons de cartes dans lequel joueurs et joueuses posent des arbres et développent la vie autour ! Il se joue de 2 à 5, dès 10 ans, pour 60 minutes.\n\nPlantez des arbres pour abriter des animaux\n\nDans une forêt, les arbres grouillent de vie, des racines au fa&icirc;te. Multipliez les essences pour accueillir un maximum de diversité dans votre forêt mixte pour préparer la venue de l\'hiver.\n\nDurant une partie, les tours des joueurs s\'alternent jusqu\'à ce que trois cartes d\'Hiver soient révélées. &Agrave; votre tour, vous avez le choix entre prendre jusqu\'à deux cartes de la pioche et/ou la clairière, jusqu\'à une limite de 10, ou jouer une carte de votre main. Chaque carte a un coût en cartes que vous devez défausser de votre main vers la clairière. Les cartes d\'Arbres se posent écartées les unes des autres sur votre plateau. Pour les autres cartes, choisissez la moitié (droite/gauche ou haut/bas) que vous voulez utiliser et glissez l\'autre dans un emplacement disponible sous un arbre. Chaque carte apporte en plus des capacités immédiates, permanentes ou de fin de partie en fonction de leur type, qui s\'activent si vous avez payé des cartes du type préféré de l\'animal joué. Trois cartes Hiver sont placées dans le dernier tiers de la pioche. Quand toutes les trois sont révélées, la partie s\'arrête immédiatement. Comptez les points de tous les éléments de votre forêt pour obtenir e meilleur score et remporter la partie !\n\nDes combinaisons multiples\n\nForêt Mixte offre une expérience de jeu touffue, pleine d\'options, mais aux règles simples de prise en main. Il ravira les joueurs de tous âges et niveaux par son ambiance calme, ses splendides illustrations et les choix que proposent chacune de ses cartes. Amoureux de la nature, redécouvrez les sous-bois avec Forêt Mixte !Contenu :\n\n180 cartes (66 arbres, 48 cartes eau/bas, 44 droite/gauche, 3 hiver, 14 cartes références, 5 grottes)1 plateau clairière1 bloc de score1 livret de règlesÀ partir de 10 ans, de 2 à 4 joueurs et pour des parties d\'environ 60 minutes.\n'),
(116,	54,	'MicroMacro : Crime City - Showdown',	10,	'1934-11-03 23:22:19',	NULL,	30,	'https://www.play-in.com/img/product/l/micro-macro-crime-city-showdown-jeu-edition-spielwiese-boite.jpg',	1,	4,	'micromacro-:-crime-city---showdown',	'Showdown est le 4e volet du jeu d\'enquête coopératif MicroMacro, As d\'Or 2021. Résolvez 16 affaires en observant la grande carte détaillée de Crime City !',	'MicroMacro : de l\'enquête et de la coopération\n\nMicroMacro : Crime City est un jeu coopératif d\'enquête dans lequel une équipe de détectives observe et explore à la loupe la très grande carte de Crime City, à la manière d\'un \"Où est Charlie?\". Le premier épisode de la série a remporté l\'As d\'Or 2021 lors du Festival International des Jeux de Cannes. Ce quatrième volet, Showdown, permet d\'explorer une nouvelle partie de la ville au cours de 16 enquêtes criminelles.\n\nEn début de partie tous les joueurs se concertent pour choisir un scénario. L\'un d\'entre vous est désigné enquêteur principal : il a comme tâche de lire les cartes enquêtes qui constituent le scénario. Chaque carte vous attribue une mission précise : retrouver l\'arme du crime, découvrir le mobile du meurtrier, chercher le lieu de vie de la victime, etc. Tous ensemble, vous observez avec attention la carte de 100x75 cm afin de répondre à toutes ces questions. Une fois que vous avez répondu correctement à toutes les cartes enquête, la partie est finie !\n\nMicroMacro Showdown : le quatrième volet\n\nMicroMacro est un jeu familial au succès immédiat grâce à son concept aussi simple que novateur. Afin de profiter au mieux de cette expérience, Showdown signale à chaque affaire le public visé à l\'aide d\'un logo bien identifiable. Trois niveaux sont identifiés, des sujets matures à réserver à un public averti, jusqu\'aux affaires plus légères qu\'enfants et parents peuvent explorer ensemble sans risque de violence ! Pour les adultes et les experts, certaines des affaires de Showdown vont se révéler bien plus corsées que celles des épisodes précédents. Et si vous appréciez le challenge et que vous n\'avez pas joué aux précédents opus de MicroMacro, sachez qu\'il est possible de jouer à Showdown sans avoir joué ou testé les autres ! Chaque jeu est indépendant l\'un des autres. Alors laissez-vous tenter par l\'appel du crime et munissez-vous de votre loupe ! Contenu :\n\n1 plan de la ville 1m x 75 cm16 enveloppes120 cartes enquête1 loupe (+ autocollant)À partir de 10 ans, de 1 à 4 joueurs et pour des parties d\'environ 30 minutes.\n'),
(117,	55,	'Perplexus Beast',	8,	'1972-08-31 08:59:09',	NULL,	0,	'https://www.play-in.com/img/product/l/perplexus-beast.jpg',	1,	1,	'perplexus-beast',	'Perplexus est une sphère contenant un labyrinthe en 3D. La version Beast est idéale pour tous les joueurs avec ses 100 étapes et ses 3 niveaux de jeu.',	'Perplexus Beast : labyrinthe et casse-tête en volume\n\nUn Perplexus est une sphère contenant un incroyable labyrinthe en 3D. En tournant la sphère entre vos doigts, vous allez guider une bille le long d\'un parcours sinueux pour l\'amener jusqu\'à la ligne d\'arrivée. Vous devez toutefois respecter les différentes étapes du parcours, chacune étant numérotée le long du labyrinthe.\n\nLa version Beast contient 3 niveaux et 100 obstacles au challenge croissant. C\'est le modèle idéal pour tous les joueurs afin de découvrir la gamme Perplexus. Cette version contient entre autre des spirales, sauts, zig-zag et une rampe de tous les dangers !\n\nLes plus :\n\n\n\nMet à l\'épreuve votre dextérité et votre adresse\n\nIdéal pour les amateurs de casse-têtes\n\nUne belle manière de faire chauffer sa matière grise\n\nContenu :\n\n1 Sphère contenant un parcours et une bille1 Règle du jeuÀ partir de 8 ans, pour 1 joueur.\n'),
(118,	56,	'Skyjo',	8,	'2013-02-05 17:25:46',	NULL,	30,	'https://www.play-in.com/img/product/l/skyjo_jeu_magilano_boite.jpg',	2,	8,	'skyjo',	'Découvrez Skyjo, un jeu de cartes idéal en famille ou entre amis. Échangez, retournez vos cartes et soyez celui avec le moins de points à la fin de la partie !',	'Skyjo : un jeu de cartes familial et convivial\n\nSkyjo est un jeu à la fois simple, agréable et rapide ! Prenez place autour de la table, avec vos amis, votre famille et/ou vos enfants pour une partie de cartes endiablée !\n\nIl s\'agit d\'une adaptation du jeu de cartes traditionnel nommé \'jeu du Golf\'. Pourquoi Golf ? Parce que comme dans ce sport, le but est de faire le moins de points possibles. Aujourd\'hui, Skyjo est un véritable phénomène de société ! C\'est le jeu le plus vendu dans les magasins Playin en 2023.\n\nQu\'est-ce qui explique le succès de Skyjo ? \n\nSa simplicité, couplée à de la profondeur de jeu, est l\'argument numéro 1 de Skyjo. C\'est aussi la raison pour laquelle il a su séduire un si large public de tous âges. On apprend les règles en quelques minutes seulement puis on encha&icirc;ne les parties ! Une partie est assez longue pour être intéressante, mais assez courte pour donner envie d\'en relancer une autre. La part de hasard causé par les cartes est également appréciable car elle apporte de la variété : les manches se suivent mais ne se ressemblent pas.\n\nSkyjo est désormais considéré comme un indispensable pour tout adepte des jeux de société.Il a su se démarquer de jeux similaires comme Hilo grâce à son design simple et efficace et un bouche à oreille redoutable. L\'essayer, c\'est l\'adopter et en parler à ses amis.\n\nQuelles sont les règles de Skyjo ? \n\nDans Skyjo les joueurs débutent avec 12 cartes devant eux, disposées face cachée, et dont les valeurs s\'échelonnent de 1 à 12.Deux actions différentes s\'offrent à vous lorsque c\'est votre tour : piocher une carte, ou récupérer une carte de la défausse.\n\n\n\nSi vous choisissez de piocher, regardez la carte et décidez ou non de l\'échanger avec l\'une de vos 12 cartes (face cachée ou non). La carte restante (l\'échangée ou celle de la pioche) va directement dans la défausse.\n\nDans le second cas, vous échangez la carte et défaussez l\'ancienne.\n\n\n\nDans tous les cas vous devez révéler l\'une de vos cartes avant de passer la main. \n\nSi vous réussissez à compléter une colonne avec le même chiffre trois fois, vous pouvez défausser cette colonne. La manche prend fin une fois qu\'un joueur a retourné toutes ses cartes. Chacun comptabilise ses points. Celui qui totalise le moins de points remporte la partie !\n\nLes avantages de Skyjo\n\n\n\nDes règles simples et accessibles pour tout le monde. Les tout petits jouent avec les parents, les grands parents...c\'est un jeu intergénérationnel ! \n\nSon petit format permet de l\'emmener partout. En vacances, à une soirée entre amis, à l\'apéro, vous pouvez toujours sortir votre Skyjo.\n\nPermet aux plus jeunes de se familiariser avec la manipulation des chiffres. De nombreux parents font jouer leurs enfants dès 5 ou 6 ans sans souci.\n\n\n\nSkyjo ou Skyjo Action ? \n\nSuite au triomphe de Skyjo, une nouvelle édition a vu le jour : Skyjo Action.\n\nCette version contient des cartes Actions qui permettent d\'accomplir toutes sortes de manigances comme jouer un tour supplémentaire ou échanger des cartes avec un autre joueur.Il est conseillé de jouer d\'abord au Skyjo classique avant de passer à la version Action, dont les cartes spéciales viendront renouveler votre expérience de jeu dans un second temps. Pour en savoir plus, consulter notre article \'Quelle version de Skyjo choisir\' ?\n\nPrésent dans les listes suivantes :\n\n\n\nSélection meilleurs jeux famille\n\nContenu :\n\n150 cartes1 carnet1 règle du jeuÀ partir de 8 ans, de 2 à 8 joueurs et pour des parties d\'environ 30 minutes.\n'),
(119,	57,	'Akropolis',	8,	'1926-09-19 04:23:57',	NULL,	25,	'https://www.play-in.com/img/product/l/akropolis-jeu-gigamic-boite.jpg',	2,	4,	'akropolis',	'Élevez votre cité de la Grèce Antique vers les cieux dans Akropolis, un jeu de tuiles familial qui n\'hésite pas à prendre de la hauteur ! ',	'Akropolis : construire vers les cieux\n\nAkropolis est un jeu de draft et de placement de tuiles où des architectes rivalisent d\'ingéniosité pour construire leur cité antique. Démarquez-vous des autres villes en bâtissant des quartiers en hauteur ! Chaque partie dure environ 25 minutes, pour 2 à 4 joueurs dès 8 ans.\n\nHabitations, temples, marchés, jardins, casernes... votre tâche est d\'agencer ces différents quartiers afin d\'ériger la cité la plus splendide de la Grèce antique. En respectant des règles d\'harmonie bien précises (casernes à l\'extérieur de la ville, habitations côte à côte...), accumulez les points et formez des étages de quartiers ! Conjuguant un système de draft simple et du placement, vous sélectionnez l\'une des tuiles disponibles puis la positionnez dans votre espace personnel. En exploitant vos carrières, vous pourrez récupérer de la pierre, vous donnant plus de souplesse pour acheter les meilleures tuiles au marché ! En fin de partie, le joueur avec le plus haut score est déclaré vainqueur.\n\nAkropolis est un jeu familial en moins de 30 minutes\n\nStratégie et accessibilité sont les deux grandes qualités d\'Akropolis. Ce jeu de Jules Messaud illustré avec énergie par Pauline Détraz convient à toute la famille et plait rapidement à tout le monde. Sa simplicité et son ergonomie participent grandement au plaisir de jouer ! Il a reçu le Tric Trac de Bronze 2022 et le TricTrac d\'Or Famille 2022, et a reçu l\'As d\'Or jeu de l\'année 2023, catégorie Tous Publics ! Et pour les amoureux du jeu, découvrez le mode solo, proposé par Gigamic !Contenu :\n\n4 tuiles de départ61 tuiles Cité4 aides de jeu40 cubes Pierre1 pion Architecte en chef1 bloc de score1 règle du jeuÀ partir de 8 ans, de 2 à 4 joueurs et pour des parties d\'environ 25 minutes.\n'),
(120,	58,	'Earth',	14,	'2020-04-24 15:57:26',	NULL,	60,	'https://www.play-in.com/img/product/l/earth-jeu-lucky-duck-games-boite.jpg',	1,	5,	'earth',	'Dans Earth, choisissez avec soin les terrains et les plantes qui composeront votre île pour correspondre au mieux à son écosystème et y attirer des animaux !',	'Earth : célébrez la beauté de la Terre\n\nEarth est un jeu stratégique de composition de tableau dans lequel les joueurs doivent créer l\'&icirc;le la plus luxuriante. Il se joue de 1 à 5 joueurs, dès 14 ans, pour des parties de 45 à 90 minutes.\n\nCréez un tableau de plantes\n\nLa Terre offre une diversité de terrains, plantes, climats et animaux. Saurez-vous agencer le plus efficace écosystème ?\n\nChaque joueur commence avec une &icirc;le, un climat et une carte &Eacute;cosystème propres, qui définissent ses conditions de départ et des avantages sur certaines actions, ainsi qu\'un objectif de fin de partie. Deux cartes écosystème et 4 cartes Faune partagées définissent des objectifs communs. &Agrave; votre tour, choisissez une action. Vous bénéficiez de son effet principal, les autres joueurs bénéficient de son effet secondaire, puis tout le monde peut activer les capacités de ses cartes de la couleur de l\'action.\n\nLes actions vous permettent de piocher des cartes pour les ajouter à votre main, de poser des cartes de votre main sur votre &icirc;le, dans une limite de 4x4 cartes, et d\'envoyer des cartes de votre main ou de la pioche dans votre compost, où chaque carte rapporte 1 point en fin de partie. Vous pouvez aussi obtenir des ressources de Sol, la monnaie du jeu, de Germes, qui rapporte les points mais peut être sacrifié pour obtenir du Sol, et faire cro&icirc;tre la Flore de votre &icirc;le, augmentant sa valeur jusqu\'à atteindre sa Canopée.\n\nLes cartes qui composent votre &icirc;le sont des cartes Terrain, qui offrent des facultés passives et de score de fin de partie, et surtout les cartes Flore qui apportent des pouvoirs et entrent en combinaisons les unes avec les autres. Les cartes Animaux sont communes à tous les joueurs et constituent une course aux objectifs. Plus ils sont accomplis tôt, plus ils rapportent de points, tandis que les cartes &Eacute;cosystème proposent des objectifs de fin de partie. Enfin, des cartes &Eacute;vénements, jouables même en dehors de votre tour, peuvent vous apporter des bonus ponctuels en échange d\'une perte de points de victoire. \n\nLe premier joueur à terminer son tableau de 4x4 cartes obtient un bonus de 7 points, terminez le tour en cours puis comptez les points de chacun : valeur brute des cartes et des Animaux, conditions des Terrains et des &Eacute;cosystèmes, nombre de cartes dans le Compost, cubes de Germes et tronçons de Croissance ou Canopée de vos Flores. Faites le meilleur score pour remporter la victoire !\n\nUn jeu beau, intelligent et surprenant\n\nEarth est un jeu à l\'image de la Terre à laquelle il rend hommage. Beau, ses plus de 350 cartes toutes uniques s\'ornent de splendides photographies des sujets qu\'elles abordent. Complexe, il propose de nombreuses stratégies à développer suivant vos choix de départs, qui changent à chaque partie. Surprenant, car il réussit pour autant à proposer des règles accessibles où les pictogrammes suffisent à convoyer les règles, et où chaque action a une foule de répercussions autant chez soi que chez les autres joueurs, sans pour autant se charger de lourdeur. Pourvu d\'un mode en équipe et d\'un mode solo, Earth s\'adresse à un public initié mais ne sera pas dédaigné par les amateurs de jeux Expert, qui trouveront dans ce jeu de composition de tableau un challenge passionnant !Contenu :\n\n283 cartes Terre145 cubes Germe105 jetons Sol88 pions Tronc74 pions Canopée32 carte Écosystème25 jetons Feuille23 cartes Faune10 cartes Île10 cartes Climat6 cartes Mode Solo5 plateaux Joueur1 jeton Joueur Actif1 jeton Premier joueur1 plateau Faune1 bloc de score1 livret de règlesÀ partir de 14 ans, de 1 à 5 joueurs et pour des parties d\'environ 60 minutes.\n'),
(121,	59,	'Focus',	10,	'1991-09-20 13:52:28',	NULL,	15,	'https://www.play-in.com/img/product/l/focus-jeu-old-chap-boite.jpg',	2,	2,	'focus',	'Dans Focus, retirez des cartes pour faire deviner votre illustration à votre partenaire… Mais prenez garde à ne pas retourner la sienne !',	'Focus - Faites deviner sans vous tromper\n\nFocus est un jeu coopératif d\'association d\'idées dans lequel chaque joueur doit deviner la carte de l\'autre tout en lui faisant deviner la sienne dans une grille partagée. Il se joue exclusivement à 2, dès 10 ans, pour des parties de 15 minutes environ.\n\nPrenez des risques en donnant des indices\n\nUne grille de 16 images est disposée devant vous, à côté d\'une colonne de 4 autres images. Observez votre carte repère : c\'est la position sur la grille de l\'image que vous allez devoir faire deviner en retirant des cartes. La mauvaise nouvelle ? Votre partenaire aussi en a une, il joue sur la même grille que vous, et il vous est interdit de communiquer.\n\n&Agrave; votre tour, retirez une carte de la grille ou de la colonne, et placez-la devant vous. Cette carte doit idéalement présenter un indice pour faire deviner celle qui vous a été désignée. Forme, couleur, thématique, tout est autorisé, mais attention : si vous retirez la carte de votre partenaire, vous perdez tous les deux. Quand il ne reste sur la grille que les deux cartes qui vous ont été désignées, vous remportez la partie.\n\nDu nouveau dans l\'association d\'idées\n\nFocus propose un jeu rapide et malin qui reprend des principes très efficaces des jeux d\'association d\'idée : Retrouver des images dans une grille à l\'aide d\'autres images. L\'idée novatrice, c\'est que les indices à donner font partie de la même grille. &Agrave; chaque nouvelle carte, le champ des possibles se réduit, mais le risque de prendre la carte interdite augmente. Rapide à comprendre mais difficile à gagner, son principe addictif et ses trois variantes de règles vous promettent de nombreuses parties enflammées !Contenu :\n\n168 cartes Illustration16 cartes Repère1 livret de règlesÀ partir de 10 ans, pour 2 joueurs et pour des parties d\'environ 15 minutes.\n'),
(122,	60,	'Mindbug',	8,	'1964-05-17 16:37:40',	NULL,	20,	'https://www.play-in.com/img/product/l/mindbug-jeu-iello-boite.jpg',	2,	2,	'mindbug',	'Dans Mindbug, dirigez vos créatures contre votre adversaire et prenez possession de celles qu\'il vous oppose… Mais prenez garde à ses mindbugs !',	'Mindbug : bluffez et volez les créatures adverses\n\nMindbug est un jeu de cartes d\'affrontement pour deux joueurs où chacun peut prendre possession des créatures de l\'adversaire quand elles sont jouées. Il se joue exclusivement à 2 joueurs, dès 8 ans, pour des parties de 20 minutes.\n\nFaites-vous des n&oelig;uds au cerveau\n\nDistribuez 10 cartes Créature à chaque joueur : 5 pour sa main, 5 dans sa pioche. Et donnez à chacun 2 cartes Mindbugs. Vous êtes prêts ? &Agrave; chaque tour, choisissez si vous jouez une carte de votre main ou activez une carte de votre table. Si vous jouez une carte de votre main, activez son éventuelle capacité de mise en jeu, puis repiochez pour avoir 5 cartes en main. Si vous activez une carte de votre table, vous infligez un point de dégâts à votre adversaire, sauf s\'il utilise une de ses créatures pour bloquer. Dans ce cas, la créature la plus faible est détruite. Si leurs valeurs sont identique, les deux sont défaussées. Certaines créatures possèdent des capacités de combat particulières, ce qui épice le jeu.\n\nMais la vraie particularité du jeu réside dans ses cartes Mindbug ! Vous pouvez les jouer chaque fois que votre adversaire annonce ajouter une créature sur le plateau, et lui prendre sa créature comme si vous veniez de la jouer. Votre adversaire rejoue alors, mais vous avez gagné une carte ! Faites bien attention : vous ne disposez que de 2 cartes Mindbug, et surtout : votre adversaire dispose aussi de 2 Mindbugs ! Faut-il prendre le contrôle de la créature qu\'il joue ou attendre qu\'il en joue une plus puissante ? Chaque joueur commence avec 3 points de vie, sitôt un joueur réduit à 0, l\'autre a remporté la partie !\n\nUn jeu de créatures magiques\n\nDeux joueurs qui s\'affrontent par le biais de créatures ? Un éventail de capacités tactiques ? On reconna&icirc;t là la patte de Richard Garfield, nom célèbre dans les jeux de société et surtout auteur du plus connu des Jeux de Cartes à Collectionner ! Si un air de famille avec Magic est effectivement indéniable, Mindbug trouve son identité propre : pas de phase de montée en puissante, le fun est immédiat, et les Mindbugs ajoutent une sensation de jeu unique, où bluff et guessing deviennent fondamentaux pour protéger son jeu !Contenu :\n\n48 cartes Créature4 cartes Mindbug1 feuillet de règlesÀ partir de 8 ans, pour 2 joueurs et pour des parties d\'environ 20 minutes.\n'),
(123,	61,	'Nekojima',	6,	'2014-04-01 12:15:48',	NULL,	15,	'https://www.play-in.com/img/product/l/nekojima-jeu-unfrienly-games-boite.jpg',	1,	5,	'nekojima',	'Dans Nekojima, empilez les pylônes électriques et déposez des chats sur les câbles sans rien renverser !',	'Nekojima : Construisez le réseau de l\'&icirc;le aux chats\n\nNekojima est un jeu d\'adresse malin et addictif dans lequel joueurs et joueuses doivent empiler des pylônes électriques sans que les fils se touchent. Il se joue de 1 à 5, dès 8 ans, pour des parties de 15 minutes environ.\n\nNe laissez pas les fils se toucher\n\nL\'&icirc;le des chats a besoin d\'électricité dans ses 4 quartiers et vous avez tous été retenus pour l\'installer ! Tous ! Que le meilleur gagne !\n\nLancez les dés pour déterminer les quartiers que vous devez relier : chaque dé a 4 faces qui correspondent aux quartiers de l\'&icirc;le, une face qui vous laisse le choix et une face qui donne le choix à vos adversaires. Une fois les quartiers désignés, piochez un cube. Si vous piochez un cube noir, gardez-le de côté et repiochez. La couleur du cube indique la couleur et la longueur du câble que vous allez devoir placer. Vous devez placer ce câble en ne touchant que les deux pylônes auxquels il est relié, chacun reposant dans un des quartiers prédéterminés. Les câbles ne doivent rien toucher quand vous achevez votre placement. Donnez les cubes noirs à vos adversaires. En plus de leur câble, ils devront suspendre un chat à un câble de la même couleur que le dernier cube tiré, sans qu\'il touche quoi que ce soit d\'autre que ce câble. Quand un joueur renverse des pylônes durant son tour, la partie prend fin et tous les autres joueurs remportent la partie !\n\nDe nombreuses façons de jouer\n\nNekojima propose une expérience pleine de fun et de tension, parfaite pour les soirées d\'ambiance entre amis ou en famille. Ses règles présentent de nombreuses variantes pour toujours plus d\'amusement : limitez le nombre de pylônes par quartier, ou leur hauteur, jouez en équipe ou même jouez en simultané en tenant chacun un pylône dans la main. &Ecirc;tes-vous prêts à relever le défi ?Contenu :\n\n1 plateau de jeu en bois21 Denchuu (Poteaux électriques) en bois2 dés Quartier en bois7 silhouettes Chat28 cubes en bois1 sac à cubes1 compteur de niveau21 tokens Nid d’oiseau1 livret de règles À partir de 6 ans, de 1 à 5 joueurs et pour des parties d\'environ 15 minutes.\n'),
(124,	62,	'7 Wonders Édition 2020',	10,	'2016-08-20 15:07:39',	NULL,	30,	'https://www.play-in.com/img/product/l/7-wonders-edition-2020-jeu-repos-production-boite.jpg',	3,	7,	'7-wonders-Édition-2020',	'7 Wonders, le jeu de civilisation stratégique revient dans une nouvelle formule ! Draftez les meilleurs cartes, bâtissez votre Merveille et dominez l\'Antiquité.',	'7 Wonders - Le jeu de stratégie antique\n\nPrenez la tête de l&rsquo;une des sept grandes cités du monde Antique. Exploitez les ressources naturelles de vos terres, marchez vers le progrès, développez vos relations commerciales et affirmez votre suprématie militaire. Laissez votre empreinte dans l&rsquo;histoire des civilisations en bâtissant une merveille architecturale qui transcendera les temps futurs.\n\n7 Wonders - Draftez et développez votre cité\n\n7 Wonders est un jeu de civilisation stratégique dans lequel chaque joueur prend la tête d\'un empire de l\'Antiquité. Vous commencez la partie avec une Merveille (au choix ou déterminé aléatoirement) qui oriente légèrement votre tactique et vous octroie certaines ressources et capacités. Au fil des âges, vous construisez de nouvelles strates de votre Merveille et devenez de plus en plus puissant ! Votre objectif est de vous imposer comme la plus grande civilisation de tous les temps.\n\nLa partie se déroule en trois &Acirc;ges. Chaque &Acirc;ge se déroule de la même façon :\n\n\n\nLa session de draft : vous choisissez une carte de votre main que vous jouez immédiatement. Vous passez le restant des cartes à votre voisin de gauche ou de droite (selon la manche). Vous procédez ainsi jusqu\'à épuisement des cartes en main. Les cartes ont toutes un coût en ressources. Choisissez bien ! Vous pouvez toujours commercer les ressources manquantes avec vos voisins ou avec la banque.\n\nLa phase de décompte des points : à la fin de la manche vous remportez ou perdez des points de victoire selon le résultat des batailles militaires. N\'oubliez pas de constituer une armée pour vous défendre !\n\n\n\n7 Wonders - Tous les chemins mènent à la victoire\n\nTout au long de la partie restez attentif aux faits et gestes de vos voisins : interceptez une carte trop puissante pour lui, observez l\'état de ses forces militaires, utilisez le commerce à votre avantage...Votre capacité d\'adaptation sera testé à chaque instant !\n\n&Agrave; l\'issue des trois &Acirc;ges les joueurs passent au décompte des points. La puissance de votre civilisation va varier en fonction de votre développement scientifique et de vos champs d\'expertises, de votre suprématie militaire, de votre Merveille et de vos guildes.\n\n7 Wonders - Une nouvelle édition pour les 10 ans du jeu\n\nAvec cette nouvelle version, 7 Wonders fait peau neuve !\n\n\n\nLes graphismes du jeu ont été revus (couverture, design des cartes, merveilles, thermoformage).\n\nLes règles sont plus simples d\'accès pour les nouveaux joueurs, sont désormais condensées sur 8 pages et accompagnées d\'une aide de jeu repensée.\n\nLes cartes bénéficient d\'une nouvelle ergonomie, avec une lisibilité accrue.\n\nLes guildes auparavent réparties entre les extensions sont toutes présentes dans la boite de base\n\nLes Merveilles sont bien plus grandes et possèdent une face jour (côté A) et une face nuit (côté B).\n\nLa boite de jeu est plus grande tout en restant à une taille standard\n\nLe cha&icirc;nage reprend l\'iconographie de 7 Wonders Duel\n\nDes symboles sont intégrés afin que les joueurs daltoniens puissent jouer sans encombres\n\n\n\nAttention, l\'édition 2020 de 7 Wonders n\'est pas compatible avec les anciens produits 7 Wonders ! \n\nPour en savoir plus sur 7 Wonders :\n\n\n\nles changements de l\'édition 2020\n\nle guide des extensions de 7 Wonders\n\nTout savoir sur le jeu de base 7 Wonders\n\n\n\nPrésent dans les listes suivantes :\n\n\n\nSélection des meilleurs jeux adulte\n\nSélection des meilleurs jeux de stratégie\n\nSélection meilleurs jeux famille\n\nContenu :\n\n7 plateaux Merveille 7 cartes Merveille49 cartes Âge I 49 cartes Âge II 50 cartes Âge III 46 jetons Conflit24 pièces de monnaie de valeur 3 46 pièces de monnaie de valeur 11 carnet de scores 1 livret de règles 1 aide de jeu 2 cartes 2 joueursÀ partir de 10 ans, de 3 à 7 joueurs et pour des parties d\'environ 30 minutes.\n'),
(125,	63,	'Trio',	6,	'1926-05-16 23:16:22',	NULL,	15,	'https://www.play-in.com/img/product/l/trio-boite-de-jeu.jpg',	3,	6,	'trio',	'Dans Trio, faites preuve de mémoire pour retrouver les trio de cartes parmi celles de la table ou des extrémités de votre main ou de celles de vos adversaires !',	'Trio : Déduisez l\'emplacement des cartes en trio !\n\nTrio est un jeu de mémoire et de déduction qui emprunte au memory et au jeu des 7 familles. Il se joue de 3 à 6, dès 7 ans, pour des parties de 15 minutes environ. \n\nDévoilez trois cartes identiques\n\nL\'objectif du jeu est d\'obtenir trois trios de cartes ou le trio de 7 ! Chaque joueur commence avec des cartes en main, qu\'il doit organiser dans l\'ordre croissant. Le reste des cartes est disposé face cachée sur la table. &Agrave; votre tour, dévoilez des cartes identiques pour former un trio et le remporter. Si vous dévoilez deux cartes différentes, votre tour s\'arrête et les cartes sont retournées. Vous pouvez dévoiler n\'importe quelle carte de la table, mais les cartes tenues en main doivent toujours correspondre à la plus haute ou la plus basse carte de son propriétaire, même vous ! Réussirez-vous à déduire les cartes que cachent vos adversaires ? Soyez le premier à dévoiler trois trios ou le trio de 7 pour remporter la partie !\n\nUn jeu simple et redoutable\n\nTrio est un jeu qui a toute sa place aux meilleures tables d\'ambiance ! Simple et rapide, il peut être joué avec sa famille comme avec ses amis. Il propose une variante Picante qui augmente la stratégie, ainsi qu\'une version en équipes, simple ou picante, où les membres d\'une même équipe peuvent s\'échanger des cartes, mais sans communiquer ! Un classique immédiat !Contenu :\n\n36 cartes1 règle du jeuÀ partir de 6 ans, de 3 à 6 joueurs et pour des parties d\'environ 15 minutes.\n'),
(126,	60,	'Ancient Knowledge',	12,	'1988-05-10 09:16:17',	NULL,	90,	'https://www.play-in.com/img/product/l/ancient-knowledge-jeu-iello-expert-boite.jpg',	2,	4,	'ancient-knowledge',	'Dans Ancient Knowledge, érigez des monuments et construisez des artefacts pour laisser une trace des connaissances de votre civilisation aux âges à venir.',	'Ancient Knowledge : exploitez les savoirs de vos merveilles\n\nAncient Knowledge est un jeu de construction de moteurs temporaires dans lequel les joueurs dirigent des civilisations sur le déclin qui doivent transmettre leurs connaissances. Il se joue de 2 à 4, dès 12 ans, pour des parties de 60 à 120 minutes. \n\nCréez un héritage culturel\n\nParviendrez-vous à bâtir des monuments et construire des artefacts qui transmettront toutes vos connaissances avant de tomber dans l\'oubli ?\n\nFaites des combinaisons d\'effets de cartes sur un tapis roulant ludique. &Agrave; chaque tour, effectuez trois phases pour développer votre civilisation. Lors de la phase d\'action, choisissez deux options parmi Créer pour poser des cartes sur votre plateau, Apprendre pour développer vos manières de marquer des points, Archiver pour empêcher la perte de précieuses données, Excaver et Fouiller pour récupérer des cartes dans votre main. Lors de la phase de Timeline, activez tous les monuments et artefacts de votre plateau dans l\'ordre de votre choix pour bénéficier de leurs effets et déclencher de puissantes combinaisons.\n\nVient enfin la phase de déclin : votre frise temporelle avance et les monuments qui sortent de votre plateau tombent dans le Passé. Assurez-vous d\'en avoir retiré toutes les informations ! Quand le 14ème monument d\'un joueur est tombé dans le Passé, continuez la partie jusqu\'à ce que chacun ait joué autant de tours, et comptez vos points. Le plus haut score remporte la partie !\n\nVoyez chuter les civilisations\n\nAncient Knowledge propose un jeu où mécaniques classiques de construction de moteurs et principes innovants se mélangent à la perfection. Ses règles demeurent accessibles malgré une belle complexité, et permettent aux joueurs initiés d\'y trouver un beau défi. Les splendides illustrations, de concert avec les annotations, vous permettent de découvrir les merveilles et mystères de notre passé, pour une immersion optimale.Contenu :\n\n 148 cartes (63x88mm)45 cartes (44x63mm)4 plateaux bâtisseurs1 pion premier joueur50 jetons savoir perdu3 tuiles connaissances1 carnet de scores1 règle du jeuÀ partir de 12 ans, de 2 à 4 joueurs et pour des parties d\'environ 90 minutes.\n'),
(127,	64,	'UNLOCK! Star Wars Escape Game',	10,	'2019-05-09 06:25:52',	NULL,	60,	'https://www.play-in.com/img/product/l/unlock-star-wars-escape-game-jeu-space-cowboys-boite.jpg',	1,	6,	'unlock!-star-wars-escape-game',	'Dans cet épisode spécial d\'Unlock!, voyagez dans une galaxie lointaine et venez à bout de trois escape games consacrés à Star Wars, la saga des Jedi !',	'UNLOCK! Star Wars : Que la force soit avec vous !\n\nCombinez votre passion pour la résolution d\'enquêtes aux plus grands épisodes de la saga Star Wars !\n\nUnlock! est un jeu coopératif inspiré des Escape Games : vous avez 60 minutes pour réussir à vaincre les énigmes proposées par un scénario donné.\n\nComposé de trois aventures bourrées d\'action, cet Unlock! vous fera vivre des combats contre l\'Empire et des séquences de vaisseaux spatiaux ! Toutes les histoires se déroulent sur la période de la première trilogie (épisodes IV à VI). Chaque mission est l\'occasion de découvrir les factions de l\'univers :\n\n\n\nLa Bataille de Hoth : l\'importante forteresse glaciaire des Rebelles, la base &Eacute;cho, est un lieu de choix pour le QG de la résistance. Alors que vous effectuez votre patrouille à dos de Tauntaun, des événements inattendus chamboulent vos plans.\n\nUn Retard Inattendu : contrebandiers de la bordure extérieure, les soldats de l\'Empire interceptent votre cargaison destinée à Jabba le Hutt et vous mettent en cellule. Vous devez vous enfuir au plus vite avec votre astromech et la cargaison !\n\nMission secrète sur Jedha : espion impérial, vous débarquez dans la ville de Jedha et devez récupérer une caisse pleine de cristaux kyber avant de retourner sur votre Destroyer Stellaire.\n\n\n\nChaque mission bénéficie d\'un set de 60 cartes entièrement illustrées par des artistes estampillés Star Wars.\n\nUNLOCK! : un escape game dans votre salon\n\nChaque aventure de cet Unlock! Star Wars Escape Game est indépendante et peut se jouer dans l\'ordre que vous préférez.\n\nCet opus se joue comme les autres jeux de la gamme : les joueurs vont mettre en place au centre de la table des cartes qui représentent des lieux, des objets ou des énigmes. Il vous faudra communiquer et mettre en commun vos idées et indices afin de progresser dans l\'intrigue et débloquer les épreuves successives.\n\nMais comment choisir ma bo&icirc;te de Unlock! ?\n\nUne application pour vous mener vers la Force\n\nIncarnation du droïde couteau-suisse R2-D2, une application gratuite vous accompagne dans toute votre aventure. Celle-ci permet de valider les codes obtenus, mais elle comporte aussi d\'autres fonctionnalités :\n\n\n\nun décompte de 60 minutes est intégré afin de garder un &oelig;il sur le temps restant,\n\nune ambiance musicale spécifique évolue avec l\'approche du dénouement,\n\nun système d\'indices aide les joueurs coincés à progresser sur les énigmes difficiles.\n\n\n\nLes plus :\n\n\n\n3 Escape Games dans l\'univers incroyable de Star Wars\n\nDe l\'action, des énigmes et des sabres lasers !\n\nCadeau idéal pour tous les fans de la saga\n\nContenu :\n\n1 tutoriel de 10 cartes180 cartes (3 x 60)1 règle du jeu2 feuilletsÀ partir de 10 ans, de 1 à 6 joueurs et pour des parties d\'environ 60 minutes.\n'),
(128,	65,	'Citadelles - Quatrième Édition : Nouveau Format',	10,	'1967-01-01 10:10:39',	NULL,	45,	'https://www.play-in.com/img/product/l/citadelles-4e-edition-nouveau-format.jpg',	2,	8,	'citadelles---quatrième-Édition-:-nouveau-format',	'Dans Citadelles 4e édition, bâtissez la cité la plus prestigieuse en choisissant le soutien d\'un Personnage au moment stratégique et en bluffant vos rivaux !',	'Citadelles : Un jeu de société de bluff et de malices\n\nCitadelles est un jeu de construction de ville basé sur le bluff et les identités secrètes. Votre objectif est de construire la cité la plus prestigieuse afin de remporter les faveurs du Roi. Pour atteindre votre but vous allez faire appel à des personnages aux pouvoirs variés, amasser des pièces d\'or et bâtir des quartiers. \n\nCitadelles se jouer de 2 à 7 joueurs, dès 10 ans et pour des parties d\'environ 45 minutes.\n\nCitadelles : Quelles sont les règles principales ?\n\nAu début de la manche chaque joueur (en commençant par celui avec la couronne) choisit une carte personnage qu\'il laisse face cachée devant lui. Ce personnage possède différentes caractéristiques :\n\n\n\nil peut être un noble (roi, échevin, cardinal, patricien, archiviste...) ou un individu peu recommandable (sorcière, voleur, espion, assassin...)\n\nil possède une valeur qui décide dans quel ordre les joueurs vont jouer (du plus petit au plus grand),\n\net il a un pouvoir : voler un personnage, détruire un bâtiment, gagner de l\'or...\n\n\n\nUne fois que tout le monde possède un personnage, ceux-ci sont appelés les uns après les autres, dans l\'ordre croissant de  valeur. &Agrave; votre tour vous allez :\n\n\n\nactiver le pouvoir de votre personnage\n\nchoisir entre gagner une pièce d\'or ou piocher une carte Quartier\n\néventuellement construire un Quartier contre des pièces d\'or\n\n\n\nUne fois qu\'un joueur construit son huitième Quartier, il déclenche la fin de la partie. Le vainqueur est celui dont la cité totalise le plus de points de prestige. \n\nCitadelles : une galerie de personnages très variés\n\nLors de vos premières parties, il est conseillé de jouer avec les 8 personnages de base. Vous pourrez ensuite découvrir les  personnages supplémentaires de l\'extension la Cité Sombre.\n\n\n\nl\'Assassin peut assassiner un autre personnage, qui ne pourra pas jouer durant cette manche,\n\nle Voleur peut voler les pièces d\'or d\'un autre personnage (autre que celui choisit par l\'Assassin). Il lui dérobe toutes ses pièces d\'or une fois révélé,\n\nle Magicien peut soit échanger toute sa main de cartes avec un autre joueur de son choix, soit échanger un certain nombre de ses cartes avec la pioche,\n\nle Roi reçoit une pièce d\'or par quartier noble dans sa cité. Il reçoit aussi la carte Couronne qui lui permet de choisir en premier son personnage au tour suivant,\n\nl\'&Eacute;vêque reçoit une pièce d\'or par quartier religieux dans sa cité. Il ne peut être la cible du Condottiere,\n\nle Marchand reçoit une pièce d\'or par quartier marchand dans sa cité. il reçoit une pièce d\'or supplémentaire au début de son tour,\n\nl\'Architecte pioche deux cartes Quartiers au début de son tour et peut construire jusqu\'à 3 Quartiers,\n\nle Condottiere reçoit une pièce d\'or par quartier militaire dans sa cité. Il peut détruire un quartier de son choix chez un autre joueur en payant son coût -1 pièce.\n\n\n\nCitadelles est un jeu stratégique qui mêle différentes mécaniques ingénieuses : draft de cartes, identités secrètes, bluff et déduction, gestion de ressources... La multiplicité des personnages (27 cartes !) rend vos parties uniques et la présence de protagonistes agressifs renforce le dynamisme et les interactions entre joueurs. Assassin, Magicien, Voleur... contrez les plans de vos adversaires en dérobant leurs pièces d\'or ou leurs cartes ! Chaque partie est riche en rebondissements ET en réflexion.\n\nCitadelles : la 4eme &Eacute;dition dans un format compact\n\nCette édition de Citadelles contient tous les personnages et lieux de l\'édition Classique, accompagnés de l\'extension La Cité Sombre. Celle-ci intègre 9 personnages supplémentaires ainsi que 12 Quartiers inédits ! Le design des cartes est par ailleurs différent et la qualité du matériel est revu à la hausse avec des pièces d\'or et une couronne en plastique.\n\nIl s\'agit du nouveau format de la 4e édition :\n\n\n\nLa bo&icirc;te de jeu est plus réduite (15x23cm contre 25x25cm avant).\n\nLes cartes d\'aide de jeu et de personnages font la même taille que les cartes quartier (57x88mm).\n\nLes différents jetons sont remplacés dans cette version par des cartes au format mini US (41x63mm).\n\nContenu :\n\n27 cartes Personnage84 cartes Quartier27 cartes Rôle1 Couronne en Plastique22 Pièces d’Or en Plastique5 jetons1 livret de règlesÀ partir de 10 ans, de 2 à 8 joueurs et pour des parties d\'environ 45 minutes.\n'),
(129,	66,	'Traîtres à Bord !',	10,	'1998-12-28 08:17:07',	NULL,	20,	'https://www.play-in.com/img/product/l/traitres-a-bord-boite-de-jeu.jpg',	3,	8,	'traîtres-à-bord !',	'Dans Traîtres à Bord !, trouvez les mutins qui se sont glissés dans votre équipage de pirates et envoyez-les à la planche avant qu\'ils ne contrôlent du navire !',	'Tra&icirc;tres à Bord ! - Trouvez les mutins dans l\'équipage\n\nTra&icirc;tres à Bord ! est un jeu de bluff et déduction à rôles cachés dans lequel joueurs et joueuses incarnent des pirates dans un équipage au bord de la mutinerie. Il se joue de 3 à 8, dès 10 ans, pour des parties de 20 minutes environ.\n\nPassez-les à la planche !\n\nIl y a de la dissension au sein des pirates ! Tandis que les uns cherchent à accumuler assez d\'or pour pouvoir jouir d\'une tranquillité bien méritée, les autres essaient de renverser l\'ordre établi !\n\nAu début de la partie, chaque joueur reçoit une carte de rôle secret. Si vous obtenez une carte Pirate, votre objectif est de mettre dans le coffre commun assez d\'or pour atteindre l\'objectif de la partie, ou d\'envoyer tous les mutins à la planche. Si vous obtenez une carte Mutin, votre Objectif est qu\'un pirate se trompe quand il annonce qu\'il y a assez d\'or dans le coffre, qu\'il reste autant de pirates que de mutins ou que la pioche de cartes se retrouve vide.\n\n&Agrave; chaque tour, vous avez le choix entre placer une carte +1, 0 ou -2 de votre main dans le coffre ou jouer une carte action de votre main. Dans le premier cas, annoncez la valeur que vous ajoutez au coffre (il est bien sûr possible de mentir). Dans le second cas, activez les pouvoirs de la carte. La plupart permettent de jouer sur les cartes de votre main, du coffre ou de la pioche, mais certaines sont des cartes planches. Jouez ces dernières devant les personnes que vous suspectez. Si quelqu\'un obtient trois planches, il tombe à l\'eau et est éliminé de la partie, même s\'il peut toujours participer aux discussions. &Eacute;liminez les membres de l\'équipe adverse pour simplifier votre jeu et gagner !\n\nAu début de son tour, un Pirate peut annoncer que le coffre contient la valeur à atteindre suivant le nombre de joueurs. S\'il a raison, les Pirates gagnent ! Sinon, les Mutins l\'emportent. &Agrave; la fin de son tour, chaque joueur reconstitue sa main pour atteindre trois cartes. Si la pioche est vide, c\'est une victoire des Mutins !\n\nUn jeu d\'ambiance très malin \n\nTra&icirc;tres à Bord s\'adresse aux joueurs et joueuses de tous âges et de tout niveau. Ses règles sont simples à comprendre, et le fait d\'annoncer ce que l\'on met dans le coffre crée autant de suspicion que de rire. Avec une esthétique de toute beauté, ce jeu nous plonge dans l\'ambiance pirate, où tous les coups sont permis ! Amateurs et amatrices de jeux à rôles cachés, ne passez pas à côté de ce petit bijou du genre !Contenu :\n\n8 cartes Rôle42 cartes Butin34 cartes Action1 livret de règlesÀ partir de 10 ans, de 3 à 8 joueurs et pour des parties d\'environ 20 minutes.\n'),
(130,	60,	'Codenames',	10,	'2017-03-21 09:10:56',	NULL,	15,	'https://www.play-in.com/img/product/l/codenames_jeu_iello_boite.png',	2,	8,	'codenames',	'Dans ce jeu d\'association d\'idées et de déduction, chaque chef doit donner un mot à ses agents pour qu\'ils retrouvent les noms de code de leurs contacts',	'Codenames : un jeu d\'espionnage\n\nVous êtes des espions d\'élite et votre mission est de parvenir à retrouver tous vos agents infiltrés avant l\'équipe adverse. A la tête de chaque équipe un ma&icirc;tre-espion guide les opérations. Seuls les mâitres-espions ont connaissances de la véritable identité des agents infiltrés. Les autres espions n\'ont que leur nom de code. C\'est à l\'aide de ces noms de codes que les espions vont devoir trouver ces agents infiltrés !\n\nCodenames : des associations d\'idées\n\nCodenames est un jeu d\'association d\'idées et de déduction dans lequel chaque ma&icirc;tre-espion doit donner une combinaison d\'un indice et d\'un chiffre afin que ses espions retrouvent les noms de code de ses contacts (exemple: \"animaux 3\").\n\nTant que l\'équipe désigne bien un contact allié, elle peut continuer à jouer. Si par contre elle indique un personnage neutre ou adverse, l\'équpe adverse prend la main. Attention l\'équipe qui a le malheur de désigner un assassin perd instantanément la partie!\n\nCodenames : un jeu d\'équipe \n\nLes faux-pas sont fréquents dans Codenames : à vous d\'être vigilant et d\'être plus efficace que l\'équipe adverse : jouez sur le sens multiple des mots, trouvez des connexions entre ceux-ci et faites travailler vos méninges ! Le temps est en effet précieux dans Codenames, car chaque minute qui passe peut être un avantage pour l\'équipe adverse. La première équipe à avoir retrouvé tous ses agents infiltrés à l\'aide des noms de code remporte la partie !\n\nLa gamme Codenames vous propose des jeux d\'ambiance et de réflexion qui peuvent se jouer facilement en famille ou avec des amis. \n\nLes plus :\n\n\n\nFacile à prendre en main\n\nConvivial\n\nJeu en équipe\n\nVariante pour deux ou trois joueurs\n\nPeut se jouer avec tout le monde!\n\n\n\nPrésent dans les listes suivantes :\n\n\n\nSélection meilleurs jeux famille\n\nSélection jeux d\'ambiance\n\nContenu :\n\n8 cartes Informateurs Bleus8 cartes Informateurs Rouges1 carte Agent Double7 cartes Témoins1 carte Assassin400 cartes Noms de Code40 cartes Clé1 support pour carte Clé1 livret de règlesÀ partir de 10 ans, de 2 à 8 joueurs et pour des parties d\'environ 15 minutes.\n'),
(131,	67,	'Sea Salt & Paper',	8,	'1954-11-14 19:01:02',	NULL,	30,	'https://www.play-in.com/img/product/l/sea-salt-and-paper-jeu-bombyx-boite.jpg',	2,	4,	'sea-salt-&-paper',	'Dans Sea Salt & Paper, collectionnez les cartes représentant des origamis marins et arrêtez la manche quand vous pensez être en tête… ',	'Sea Salt & Paper : partez à la chasse aux sirènes\n\nSea Salt & Paper est un jeu de cartes fun et léger, où vous collectionnez des cartes illustrées d\'origamis au thème marin. Il se joue de 2 à 4, dès 8 ans, pour des parties de 30 minutes environ.\n\nEstimez la valeur des cartes en main\n\nLe principe du jeu est très simple. &Agrave; chaque tour, choisissez entre piocher deux cartes face cachée, en ajouter une à votre main et défausser l\'autre face visible, ou prendre la carte face visible du haut de la pioche. Quand vous atteignez 7 points, vous pouvez mettre fin à la manche. Deux éléments ajoutent du piquant au jeu : à la fin de votre tour, si vous avez une paire de cartes duo identiques, vous pouvez les révéler pour activer leur capacité. Rejouez, récupérez des cartes de la pioche ou de la défausse ou volez-en à vos adversaires, les effets peuvent avoir des conséquences renversantes ! Par ailleurs, quand vous décidez de mettre fin au jeu, vous pouvez dire STOP et arrêter immédiatement la partie pour que tout le onde marque ses points, ou laisser un tour aux autres joueurs. Si aucun ne parvient à dépasser votre score, vous marquez vos points et privez les autres joueurs de leurs points. Mais c\'est vous qui perdez vos points si quelqu\'un score plus haut que vous.  Vous sentez-vous assez confiant pour leur laisser cette chance ?\n\nUn jeu malin aux jolies cartes.\n\nBruno Cathala fait partie des auteurs de ce petit jeu malin, et on reconna&icirc;t sa patte ingénieuse. Les cartes proposent diverses façons de marquer des points, permettant de nombreuses combinaisons et renouvelant le jeu à chaque partie, et une condition de victoire immédiate peut être déclenchée si un joueur obtient les 4 sirènes du jeu. Observez bien vos adversaires pour ne pas vous faire prendre de court ! Le matériel de jeu est très plaisant. La bo&icirc;te, menue, s\'emporte partout et tient dans la paume de la main. Les illustrations prennent le parti original d\'être des photographies d\'origamis, présentant un univers poétique de mer et de papier. Contenu :\n\n58 cartes6 aides de jeu1 dépliant de règlesÀ partir de 8 ans, de 2 à 4 joueurs et pour des parties d\'environ 30 minutes.\n');

DROP TABLE IF EXISTS `game_author`;
CREATE TABLE `game_author` (
  `game_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`author_id`),
  KEY `IDX_C09A7500E48FD905` (`game_id`),
  KEY `IDX_C09A7500F675F31B` (`author_id`),
  CONSTRAINT `FK_C09A7500E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C09A7500F675F31B` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `game_author` (`game_id`, `author_id`) VALUES
(127,	98);

DROP TABLE IF EXISTS `game_illustrator`;
CREATE TABLE `game_illustrator` (
  `game_id` int(11) NOT NULL,
  `illustrator_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`illustrator_id`),
  KEY `IDX_495A53B5E48FD905` (`game_id`),
  KEY `IDX_495A53B5653613B3` (`illustrator_id`),
  CONSTRAINT `FK_495A53B5653613B3` FOREIGN KEY (`illustrator_id`) REFERENCES `illustrator` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_495A53B5E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `game_illustrator` (`game_id`, `illustrator_id`) VALUES
(117,	82),
(118,	82),
(126,	79),
(127,	82),
(128,	82),
(130,	82);

DROP TABLE IF EXISTS `game_theme`;
CREATE TABLE `game_theme` (
  `game_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`theme_id`),
  KEY `IDX_A5469E87E48FD905` (`game_id`),
  KEY `IDX_A5469E8759027487` (`theme_id`),
  CONSTRAINT `FK_A5469E8759027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A5469E87E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `game_theme` (`game_id`, `theme_id`) VALUES
(115,	60),
(117,	59),
(118,	59),
(120,	60),
(120,	63),
(121,	59),
(122,	60),
(123,	59),
(124,	65),
(124,	66),
(125,	62),
(126,	65),
(126,	66),
(127,	64),
(128,	66),
(130,	59);

DROP TABLE IF EXISTS `game_tmp`;
CREATE TABLE `game_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `href` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `game_tmp` (`id`, `name`, `href`) VALUES
(121,	'Booster Étincelle de Rébellion - Star Wars Unlimited FR',	'/produit/516474-booster_Etincelle_de_rebellion_-_star_wars_unlimited_fr'),
(122,	'Sky Team',	'/produit/487574-sky_team'),
(123,	'6 qui Prend !',	'/produit/201516-6_qui_prend_'),
(124,	'Ark Nova - Extension Mondes Marins',	'/produit/500364-ark_nova_-_extension_mondes_marins'),
(125,	'Kluster',	'/produit/279818-kluster'),
(126,	'Les Loups-Garous de Thiercelieux - Best Of',	'/produit/202741-les_loups-garous_de_thiercelieux_-_best_of'),
(127,	'Forêt Mixte',	'/produit/505661-foret_mixte'),
(128,	'MicroMacro : Crime City - Showdown',	'/produit/512374-micromacro__crime_city_-_showdown'),
(129,	'Perplexus Beast',	'/produit/362797-perplexus_beast'),
(131,	'Skyjo',	'/produit/264994-skyjo'),
(132,	'Akropolis',	'/produit/418967-akropolis'),
(133,	'Earth',	'/produit/465936-earth'),
(134,	'Focus',	'/produit/471362-focus'),
(135,	'Mindbug',	'/produit/461881-mindbug'),
(136,	'Nekojima',	'/produit/504533-nekojima'),
(137,	'7 Wonders Édition 2020',	'/produit/296514-7_wonders_Edition_2020'),
(138,	'Trio',	'/produit/467441-trio'),
(139,	'Ancient Knowledge',	'/produit/495678-ancient_knowledge'),
(140,	'UNLOCK! Star Wars Escape Game',	'/produit/292842-unlock_star_wars_escape_game'),
(141,	'Citadelles - Quatrième Édition : Nouveau Format',	'/produit/376802-citadelles_-_quatrieme_Edition__nouveau_format'),
(142,	'Traîtres à Bord !',	'/produit/501939-traitres_a_bord'),
(143,	'Codenames',	'/produit/202136-codenames'),
(144,	'Sea Salt & Paper',	'/produit/442627-sea_salt_et_paper');

DROP TABLE IF EXISTS `game_type`;
CREATE TABLE `game_type` (
  `game_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`game_id`,`type_id`),
  KEY `IDX_67CB3B05E48FD905` (`game_id`),
  KEY `IDX_67CB3B05C54C8C93` (`type_id`),
  CONSTRAINT `FK_67CB3B05C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_67CB3B05E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `game_type` (`game_id`, `type_id`) VALUES
(112,	116),
(112,	117),
(112,	118),
(112,	119),
(112,	120),
(113,	120),
(113,	121),
(113,	122),
(113,	123),
(114,	118),
(114,	124),
(114,	125),
(115,	120),
(115,	126),
(115,	127),
(116,	117),
(116,	119),
(116,	122),
(117,	124),
(117,	128),
(118,	118),
(118,	125),
(118,	128),
(118,	129),
(119,	120),
(119,	123),
(119,	130),
(119,	131),
(120,	126),
(121,	116),
(121,	117),
(121,	118),
(121,	119),
(121,	125),
(121,	132),
(121,	133),
(122,	133),
(123,	118),
(123,	124),
(124,	120),
(124,	121),
(124,	126),
(124,	127),
(124,	130),
(124,	134),
(125,	117),
(125,	135),
(126,	120),
(126,	130),
(126,	134),
(127,	117),
(127,	118),
(127,	119),
(127,	136),
(127,	137),
(128,	120),
(128,	130),
(128,	138),
(129,	117),
(129,	118),
(129,	129),
(129,	138),
(130,	116),
(130,	117),
(130,	118),
(130,	125),
(130,	132),
(131,	125),
(131,	126),
(131,	129);

DROP TABLE IF EXISTS `illustrator`;
CREATE TABLE `illustrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `illustrator` (`id`, `name`) VALUES
(79,	'Adrien Rives'),
(80,	'Eric Hibbeler'),
(81,	'Loïc Billiau'),
(82,	'Non renseigné'),
(83,	'Judit Piella'),
(84,	'Toni Llobet'),
(85,	'Daniel Goll'),
(86,	'Pauline Détraz'),
(87,	'M81 Studio'),
(88,	'Yulia Sozonik'),
(89,	'Simon Caruso'),
(90,	'Denis Martynets'),
(91,	'Gilles Warmoes'),
(92,	'Miguel Coimbra'),
(93,	'Laura Michaud'),
(94,	'Emilien Rotival'),
(95,	'Pierre Ples'),
(96,	'Laura Bazzoni'),
(97,	'Lucien Derainne'),
(98,	'Pierre');

DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `theme` (`id`, `name`, `slug`) VALUES
(59,	'Non renseigné',	'non-renseigné'),
(60,	'Animaux',	'animaux'),
(61,	'Sciences',	'sciences'),
(62,	'Abstrait',	'abstrait'),
(63,	'Nature',	'nature'),
(64,	'Enquête',	'enquête'),
(65,	'Antiquité',	'antiquité'),
(66,	'Construction de Ville',	'construction-de-ville'),
(67,	'Médiéval Fantastique',	'médiéval-fantastique'),
(68,	'Science Fiction',	'science-fiction'),
(69,	'Star Wars',	'star-wars'),
(70,	'Médiéval',	'médiéval'),
(71,	'Pirates',	'pirates'),
(72,	'Océan',	'océan');

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `slug` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type` (`id`, `name`, `slug`) VALUES
(116,	'Communication Limitée',	'communication-limitée'),
(117,	'Déduction',	'déduction'),
(118,	'Jeux Ambiance',	'jeux-ambiance'),
(119,	'Jeux Coopératifs',	'jeux-coopératifs'),
(120,	'Jeux de Stratégie',	'jeux-de-stratégie'),
(121,	'Jeux de Gestion',	'jeux-de-gestion'),
(122,	'Jeux Solo',	'jeux-solo'),
(123,	'Placement de Tuiles',	'placement-de-tuiles'),
(124,	'Adresse',	'adresse'),
(125,	'Apéro',	'apéro'),
(126,	'Collection',	'collection'),
(127,	'Combinaisons',	'combinaisons'),
(128,	'Logique',	'logique'),
(129,	'Jeux de Voyage',	'jeux-de-voyage'),
(130,	'Draft',	'draft'),
(131,	'Nommé As d Or 2023',	'nommé-as-d-or-2023'),
(132,	'Créativité',	'créativité'),
(133,	'Jeux à deux',	'jeux-à-deux'),
(134,	'Civilisation',	'civilisation'),
(135,	'Mémoire',	'mémoire'),
(136,	'Escape Game',	'escape-game'),
(137,	'Narratif',	'narratif'),
(138,	'Bluff',	'bluff');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `birthed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `postal_code` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2023-12-01 06:10:31

