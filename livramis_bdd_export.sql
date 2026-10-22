-- Export SQL - 2026-05-22 21:03:29.228474
-- Database: livramis_bdd

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `author_to_books`;
CREATE TABLE `author_to_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('1', '1', '7');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('2', '1', '8');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('3', '1', '11');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('22', '8', '32');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('19', '8', '29');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('16', '6', '26');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('20', '8', '30');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('23', '8', '33');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('24', '8', '34');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('25', '8', '35');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('26', '8', '36');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('27', '8', '37');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('28', '9', '38');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('29', '6', '39');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('30', '6', '40');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('31', '6', '41');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('34', '10', '44');
INSERT INTO `author_to_books` (`id`, `id_author`, `id_book`) VALUES ('33', '10', '43');

DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `authors` (`id`, `name`) VALUES ('1', 'Karine Martins');
INSERT INTO `authors` (`id`, `name`) VALUES ('2', 'jk');
INSERT INTO `authors` (`id`, `name`) VALUES ('3', 'n');
INSERT INTO `authors` (`id`, `name`) VALUES ('4', 'f');
INSERT INTO `authors` (`id`, `name`) VALUES ('5', 'g');
INSERT INTO `authors` (`id`, `name`) VALUES ('6', 'Alexandre Arlène');
INSERT INTO `authors` (`id`, `name`) VALUES ('7', 'Sannon Messenger');
INSERT INTO `authors` (`id`, `name`) VALUES ('8', 'Shannon Messenger');
INSERT INTO `authors` (`id`, `name`) VALUES ('9', 'Celina Frenn & Gabriella Chianello');
INSERT INTO `authors` (`id`, `name`) VALUES ('10', 'Tabasa Tori');

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `synopsis` text NOT NULL,
  `state` tinytext NOT NULL,
  `emprumpt_date` date DEFAULT NULL,
  `author` tinytext NOT NULL,
  `user_id` int(11) NOT NULL,
  `have_picture` tinyint(1) NOT NULL DEFAULT 0,
  `categorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('7', 'Ceux qui ne peuvent pas mourir, Tome 1 : La bête de Porte-Vent', '<p>1887, en France. Gabriel Voltz travaille pour l’Ordre de la Saint-Vehme, une puissante confrérie occulte qui traque les Égarés, ces humains qu’un maléfice a transformés en créatures diaboliques. Sa mission le conduit dans un village de Bretagne frappé par une série de meurtres particulièrement atroces. </p><p> Voltz est, bien malgré lui, accompagné de Rose dans cette enquête. Une adolescente têtue et encombrante qui en sait déjà beaucoup trop... </p><p><br></p><p><span style="color: rgb(235, 214, 255);">Source : </span><a href="https://www.babelio.com/livres/Martins-Ceux-qui-ne-peuvent-pas-mourir-tome-1--La-bete-de/1162629" rel="noopener noreferrer" target="_blank" style="color: rgb(235, 214, 255);">Babelio</a></p>', 'Disponible', NULL, 'Karine Martins', '25', '1', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('8', 'Ceux qui ne peuvent pas mourir, Tome 2 : L''affaire Prometheus', '<p>Paris, 1889. Tandis que l''Exposition universelle bat son plein, ses promoteurs sont assassinés les uns après les autres. Sorti des geôles de la Sainte-Vehme, Gabriel Voltz est missionné par la Confrérie pour enquêter. Il retrouve l''intrépide Rose, et Grégoire, leur complice. Qui peut être à l’origine de crimes aussi barbares ? Des créatures surnaturelles qui peuplent le Paris sous-terrain aux indigènes exhibés à l’exposition coloniale, les coupables potentiels ne manquent pas…</p><p><br></p><p><span style="color: rgb(235, 214, 255);">Source : </span><a href="https://www.babelio.com/livres/Martins-Ceux-qui-ne-peuvent-pas-mourir-tome-2--Laffaire-/1323291" rel="noopener noreferrer" target="_blank" style="color: rgb(235, 214, 255);">Babelio</a></p>', 'Disponible', NULL, 'Karine Martins', '25', '1', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('11', 'Ceux qui ne peuvent pas mourir, Tome 3 : L''esprit de Werdenfels', '<p>Haute Bavière, 1889. Après avoir retrouvé son ami Grégoire, Gabriel recherche toujours Rose, disparue de façon inquiétante. Persuadé que la jeune fille est détenue au château de Werdenfels, siège de la confrérie, un petit groupe d''Égarés convainc l’immortel de s''y rendre. La forteresse est dirigée par Jonas, un esprit incarné qu''il s''agit de vaincre. Mais qui est-il vraiment ? Quel est son but ? Et pourquoi cette vallée reculée semble-t-elle si familière à Gabriel qui n’y a jamais mis les pieds ? Ses découvertes sur Jonas lui ouvrent peu à peu les portes de son propre passé...</p>', 'Disponible', NULL, 'Karine Martins', '25', '1', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('30', 'Gardiens des cités perdues, Tome 2 : Exil', '<p>Depuis qu''elle a quitté sa famille pour vivre parmi les elfes, Sophie attire tous les regards sur elle… et l''agitation soulevée par son enlèvement n''a rien arrangé !</p><p>La jeune télépathe fait alors une découverte extraordinaire : elle tombe nez à nez avec une alicorne. La créature fabuleuse, symbole d''espoir pour tous les elfes, pourra-t-elle apaiser les esprits ? Rien n''est moins sûr. Car bientôt Sophie va devoir prendre un risque immense pour protéger l''un de ses proches d''une mort certaine…</p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('26', 'Bloody Harry Tome 01', '<p>La prophétie raconte que cette BD est la plus drôle du monde des sorciers et que chaque page a été enchantée pour vous faire mourir de rire ! C''est un artefact bien trop dangereux, mieux vaut ne pas l''ouvrir.</p>', 'Disponible', NULL, 'Alexandre Arlène', '28', '0', '2');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('29', 'Gardiens des cités perdues, Tome 1', '<p class="ql-align-justify"><span style="color: rgb(0, 0, 0);">Sophie sait qu''elle n''est pas comme tout le monde : depuis toujours, elle entend les pensées des gens autour d''elle. Un matin, un étrange garçon l''aborde et lui apprend qu''elle n''est pas humaine. Elle doit rejoindre l''univers qu''elle a quitté douze ans plus tôt.</span></p><p class="ql-align-justify"><span style="color: rgb(0, 0, 0);">De retour parmi les siens, une question l''obsède : pourquoi l''a-t-on cachée si longtemps dans le monde des humains ?</span></p><p><br></p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('32', 'Gardiens des cités perdues, Tome 4 : Les invisibles', '<p>Sophie rejoint enfin le Cygne Noir, la mystérieuse organisation clandestine qui lui a fait voir le jour. Accompagnée de Fitz, Biana, Keefe et Dex, elle quitte les Cités perdues pour Florence.</p><p>Là-bas, elle espère en apprendre plus sur elle-même, mais aussi sur les Invisibles, le groupe de rebelles qui cherche à déstabiliser le monde des elfes…</p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('33', 'Gardiens des cités perdues, Tome 5 : Projet Polaris', '<p><span style="color: rgb(51, 51, 51);">Après un passage par Exillium, l''école réservée aux bannis, Sophie et ses amis sont de retour à l''académie Foxfire. Les nouveaux membres du Cygne Noir sont cependant en danger et les Invisibles multiplient les attaques contre les Cités perdues. Tandis que la tension monte avec les ogres, Sophie et sa troupe tentent d''en savoir davantage sur le plan de l''ennemi, le " Projet Polaris ". Un étrange symbole semble en être la clé et il serait lié à... Keefe !</span></p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('34', 'Gardiens des cités perdues, Tome 6 : Nocturna', '<p>Nocturna... Dans l''esprit de Sophie, ce mot brille comme un astre. Car c''est sans doute là que se trouve sa famille humaine, enlevée par les Invisibles ; là aussi que l''attendent les réponses à toutes ses questions. Or, Sophie va devoir pactiser avec plusieurs de ses ennemis pour s''y rendre. Rongée par le doute et par la peur, elle ignore encore que Nocturna dissimule un secret ancestral qui pourrait bien changer la face du monde.</p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('35', 'Gardiens des cités perdues, Tome 8.5 : Le livre des secrets', '<p class="ql-align-justify">Coup de théâtre dans les Cités perdues ! Si Sophie, désormais à la tête de la Brigade intrépide, croyait pouvoir déjouer les plans des Invisibles, c’était sans compter sur la trahison du roi des nains. Après ce rebondissement inattendu, Lady Gisela en a profité pour faire subir à Keefe une transformation capable de lui faire accepter – de force – son héritage. Mais l’expérience tourne court et l’Empathe tombe dans une sorte de coma dont personne, pas même sa mère, ne sait s’il se réveillera un jour.</p><p class="ql-align-justify">C’est sur ce suspense haletant que nous avions quitté Sophie et ses compagnons, avec plus de questions que de réponses : qu’est-il vraiment arrivé à Keefe ? Quand le garçon s’arrachera-t-il à son sommeil artificiel ? Sous quelle forme se manifestera son héritage ? Si le mystère plane toujours, Shannon Messenger s’apprête à nous faire quelques révélations explosives…</p><p class="ql-align-justify">Plongez dans les coulisses et les mystères des Cités perdues grâce à ce nouveau tome ! Truffé d’informations croustillantes (et, parfois, top secret !) et de détails savoureux, ce guide, enrichi d’illustrations inédites et commenté par vos personnages préférés, est un opus indispensable. Pour les plus impatients, un court roman de plus de deux cents pages en dévoilera un peu plus sur le sort de Keefe… Surprises garanties ! Voici donc un Livre des secrets qui saura satisfaire la curiosité de tous les fans de la série !</p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('36', 'Gardiens des cités perdues, Tome 9 : Lune stellaire', '<p>Sophie a frappé un grand coup. Lassée de voir ses ennemis prendre sans cesse plusieurs longueurs d''avance sur elle, la jeune fille a même carrément mis le feu aux poudres en provoquant les Invisibles sur leurs propres terres. Hélas, à l''heure où ses amis sont divisés et dispersés, alors qu''une crise interespèce menace, son audace risque bien de se retourner contre elle.</p><p><br></p><p>Malgré le danger, ses instincts la poussent à enquêter sur le projet Lune stellaire et sur Elyseus – qui pourrait bien être la clef de tout. Mais au sein des Cités perdues, dévoiler la vérité exige toujours des sacrifices. Or les plans des Invisibles, qui se précisent peu à peu, se révèlent terrifiants. Il semblerait que tout le monde se soit trompé : le plus grand mensonge des elfes pourrait bien tout détruire…</p><p><br></p><p>Dans la bataille qui s''annonce, une seule chose est sûre : rien ne sera jamais plus pareil. Dans ce neuvième tome de <em>Gardiens des cités perdues</em> , Sophie et ses amis s''apprêtent à découvrir la véritable signification du pouvoir – et du mal…</p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('37', 'Gardiens des cités perdues, Tome 9.5 : Le Livre des révélations', '<p>Une lettre. C''est tout ce que Keefe a laissé à Sophie pour expliquer sa fugue après avoir découvert à quel point ses tout nouveaux pouvoirs étaient dangereux. La seule solution à ses yeux ? Quitter les Cités perdues afin d''assurer la sécurité de la jeune fille et de leurs amis.</p><p><br></p><p>Mais qu''est-il véritablement arrivé au jeune elfe pendant que ses camarades tentaient de résoudre le mystère du projet Lune stellaire ? Où a-t-il disparu exactement ? Et qui a-t-il rencontré dans le monde des humains ? Les réponses dépassent de loin tout ce que l''on aurait pu imaginer... mais suffiront-elles à Keefe pour changer son destin ?</p><p><br></p><p>Le passé et le présent s''entremêlent dans ce Livre des révélations. Car Keefe, le chouchou des fans de la série Gardiens des Cités perdues, s''apprête à exhumer les souvenirs enfouis dans sa mémoire altérée grâce à des alliés pour le moins inattendus...</p>', 'Disponible', NULL, 'Shannon Messenger', '27', '0', '1');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('38', 'Gardiens des cités perdues, Volume 1 Partie 1', '<p>Sophie Foster est une jeune fille dotée d''étranges pouvoirs magiques qu''elle ne maîtrise pas vraiment. Quand elle découvre qu''elle est une elfe, c''est tout un monde fantastique, peuplé de créatures toutes plus étonnantes les unes que les autres, qui s''offre à elle : celui des Cités perdues.</p><p><br></p><p>L''univers baigné de magie créé par Shannon Messenger prend vie sous la forme d''un roman graphique haut en couleur. La célèbre série comme vous ne l''avez jamais vue !</p>', 'Disponible', NULL, 'Celina Frenn & Gabriella Chianello', '27', '0', '2');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('39', 'Bloody Harry T02', '<p>La prophétie raconte que cette BD est la plus drôle du monde des sorciers et que chaque page a été enchantée pour vous faire mourir de rire ! C''est un artefact bien trop dangereux.. mieux vaut ne pas l''ouvrir.</p>', 'Disponible', NULL, 'Alexandre Arlène', '28', '0', '2');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('40', 'Bloody Harry T03', '<p>La prophétie raconte que cette BD est la plus drôle du monde des sorciers et que chaque page a été enchantée pour vous faire mourir de rire ! C''est un artefact bien trop dangereux.. mieux vaut ne pas l''ouvrir.</p>', 'Disponible', NULL, 'Alexandre Arlène', '28', '0', '2');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('41', 'Bloody Harry T04', '<p>La prophétie raconte que cette BD est la plus drôle du monde des sorciers et que chaque page a été enchantée pour vous faire mourir de rire ! C''est un artefact bien trop dangereux.. mieux vaut ne pas l''ouvrir.</p>', 'Disponible', NULL, 'Alexandre Arlène', '28', '0', '2');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('44', 'Le Palais Des Assassins T01', '<p>Plus facile d''assassiner ses ennemis que de se faire des amis !</p><p><br></p><p>Karin vient d''entrer comme apprentie servante au quartier des femmes du palais impérial. Dans ce lieu à part, elle espère réaliser son vœu de toujours : se faire des amies ! Fille du haut fonctionnaire le plus craint de l''empire et considérée comme le bras armé de son conspirateur de père, elle a toute sa vie vécu isolée. Même si elle est experte dans l''art de l''assassinat, elle n''aspire qu''à une vie normale ! Pourtant, les efforts qu''elle fournit pour se rapprocher de ses camarades sont vains, car la peur qu''elle inspire fait d''elle une paria...</p><p><br></p>', 'Disponible', NULL, 'Tabasa Tori', '28', '0', '3');
INSERT INTO `books` (`id`, `title`, `synopsis`, `state`, `emprumpt_date`, `author`, `user_id`, `have_picture`, `categorie`) VALUES ('43', 'Le Palais Des Assassins T02', '<p>Karin vient d''entrer comme apprentie servante au quartier des femmes du palais impérial. Dans ce lieu à part, elle espère réaliser son voeu de toujours : se faire des amies ! Fille du haut fonctionnaire le plus craint de l''empire et considérée comme le bras armé de son conspirateur de père, elle a toute sa vie vécu isolée. Même si elle est experte dans l''art de l''assassinat, elle n''aspire qu''à une vie normale ! Pourtant, les efforts qu''elle fournit pour se rapprocher de ses camarades sont vains, car la peur qu''elle inspire fait d''elle une paria... Un soir de tempête, alors qu''elle est au bord du désespoir, un garçon s''approche pour lui offrir son parapluie avant de disparaître... Ce n''est autre que l''empereur lui-même ! Ce geste d''amitié inattendu redonne courage à la jeune fille, qui jure de prouver sa reconnaissance. L''occasion ne tarde pas : elle débusque un assassin infiltré qui cherche à atteindre le petit monarque et l''élimine grâce à ses talents cachés ! Tant de gens veulent la perte du souverain... mais Karin se promet de le protéger dans l''ombre ! Comment fraterniser dans un nid de vipères ? Le Palais des assassins vous entraîne dans l''univers d''une héroïne aussi habile au combat que maladroite en amitié ! </p>', 'Disponible', NULL, 'Tabasa Tori', '28', '0', '3');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`id`, `name`) VALUES ('1', 'Romans');
INSERT INTO `categories` (`id`, `name`) VALUES ('2', 'BDs');
INSERT INTO `categories` (`id`, `name`) VALUES ('3', 'Mangas');
INSERT INTO `categories` (`id`, `name`) VALUES ('4', 'Livres scolaires');

DROP TABLE IF EXISTS `discussions`;
CREATE TABLE `discussions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `discussions` (`id`, `id1`, `id2`) VALUES ('1', '25', '26');

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_discussion` int(11) NOT NULL,
  `id_sender` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `messages` (`id`, `id_discussion`, `id_sender`, `date`, `message`) VALUES ('1', '1', '25', '2025-03-11 21:39:33', 'Salut ça vas ?');
INSERT INTO `messages` (`id`, `id_discussion`, `id_sender`, `date`, `message`) VALUES ('2', '1', '26', '2025-03-11 21:39:33', 'Oui et toi ?');
INSERT INTO `messages` (`id`, `id_discussion`, `id_sender`, `date`, `message`) VALUES ('3', '1', '25', '2025-03-12 12:37:13', 'Nikel !');

DROP TABLE IF EXISTS `user_to_books`;
CREATE TABLE `user_to_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('10', '25', '11');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('7', '25', '8');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('6', '25', '7');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('12', '25', '13');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('31', '27', '32');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('28', '27', '29');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('25', '28', '26');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('29', '27', '30');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('32', '27', '33');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('33', '27', '34');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('34', '27', '35');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('35', '27', '36');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('36', '27', '37');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('37', '27', '38');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('38', '28', '39');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('39', '28', '40');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('40', '28', '41');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('43', '28', '44');
INSERT INTO `user_to_books` (`id`, `id_user`, `id_book`) VALUES ('42', '28', '43');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `password` text NOT NULL,
  `first_name` tinytext NOT NULL,
  `last_name` tinytext NOT NULL,
  `email` text NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `biographie` longtext NOT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT 0,
  `ban_raison` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `is_admin`, `biographie`, `is_ban`, `ban_raison`) VALUES ('25', 'Nathanaëlle', '$2y$10$gA6Csgair/dNGv/P.h9cUe/X8ooNwluUqwbvafJ5IbaT3nvygAv/.', 'Nathanaëlle', 'Petit--Frulio', 'titouan.petit-frulio@laposte.net', '1', '', '0', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `is_admin`, `biographie`, `is_ban`, `ban_raison`) VALUES ('27', 'Violette', '$2y$10$3trmXQhBFH.jpjnYmleAGOKbF5dv3MjtL20wDewqUNGXHFzhANPQ6', 'Violette', 'Dauvergne', 'kk@kk.kk', '0', '', '0', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `is_admin`, `biographie`, `is_ban`, `ban_raison`) VALUES ('28', 'Elmex', '$2y$10$61CpyFVz6BqMjSVbk3F9vuhGnNaVlKLJly4exYQUB9.CvScKv2BEW', 'Emma', 'MAURRAS', 'maurras.emma@gmail.com', '0', '', '0', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `is_admin`, `biographie`, `is_ban`, `ban_raison`) VALUES ('30', 'Fox', '$2y$10$pN.hlHXNWfAyWZ7o1FTR2OLfMUk5p.Vd0/AYPaBMwuSVoMmuY1IwW', 'Rafael', 'Fontana', 'chleufjunior@gmail.com', '0', '', '0', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `is_admin`, `biographie`, `is_ban`, `ban_raison`) VALUES ('31', 'Un gen', '$2y$10$u0dRFgX79U2LlPeoLaW/WOpxfKKYEaE3cdcoFZT/uaatiSKQpcvKe', 'X', 'X', 'X@gmail.com', '0', '', '1', 'Identité incorrecte. Contacter titouan.petit-frulio@laposte.net pour régler le problème.');
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `is_admin`, `biographie`, `is_ban`, `ban_raison`) VALUES ('32', 'Siaaaaaa', '$2y$12$0d65GMuUlNxV/lP1joZ.cu6V5xlNNbyqNYahc2F9TLfKxeugxfKQW', 'Sia', 'BLANC SALLETAZ', 'blancsalletaz.sia@gmail.com', '0', '', '0', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `is_admin`, `biographie`, `is_ban`, `ban_raison`) VALUES ('33', 'Dany', '$2y$12$jlbExJRoGfA2cfqvoPGyCeOUeWBN2/P81fQLoJxiOYTjSg7pXFUx.', 'Danièle', 'Dauvergne', 'danieledauvergne@sfr.fr', '0', '', '0', NULL);

SET FOREIGN_KEY_CHECKS=1;