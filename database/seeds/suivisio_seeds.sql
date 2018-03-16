INSERT INTO `categories` (`id`, `nomenclature`, `label`, `course_id`) VALUES
(1, 'P1', 'Production de services', NULL),
(2, 'P2', 'Fournitures de services', NULL),
(3, 'P3', 'Conception et maintenance de solutions d''infrastructures', 3),
(4, 'P4', 'Conception et maintenance de solutions applicatives', 3),
(5, 'P5', 'Gestion du patrtimoine informatique', NULL),
(8, 'P4', 'Conception et maintenance de solutions applicatives', 2),
(9, 'P3', 'Conception et maintenance de solutions d''infrastructures', 2);

INSERT INTO `domains` (`id`, `category_id`, `nomenclature`, `label`) VALUES
(1, 1, 'D1.1', 'Analyse de la demande'),
(2, 1, 'D1.2', 'Choix d''une solution'),
(3, 1, 'D1.3', 'Mise en production d''un service'),
(4, 1, 'D1.4', 'Travail en mode projet'),
(5, 2, 'D2.1', 'Exploitation des services'),
(6, 2, 'D2.2', 'Gestion des incidents et des demandes d''assistance'),
(7, 2, 'D2.3', 'Gestion des problèmes et des changements'),
(8, 3, 'D3.1', 'Conception d''une solution d''infrastructure'),
(9, 3, 'D3.2', 'Installation d''une solution d''infrastructure'),
(10, 3, 'D3.3', 'Administration et supervision d''une infrastructure'),
(11, 4, 'D4.1', 'Conception et réalisation d''une solution applicative'),
(12, 4, 'D4.2', 'Maintenance d''une solution applicative'),
(13, 5, 'D5.1', 'Gestion des configurations'),
(14, 5, 'D5.2', 'Gestion des compétences');

INSERT INTO `courses` (`id`, `name`, `label`) VALUES
(1, '1ere année', 'indifférencie'),
(2, 'SLAM', 'solutions logicielles et applications métiers'),
(3, 'SISR', 'Solutions d’infrastructure, systèmes et réseaux');

INSERT INTO `sources` (`id`, `label`, `description`) VALUES
(1, 'Stage 1', 'SITUATIONS VECUES EN STAGE DE PREMIERE ANNEE DANS L''ORGANISATION'),
(2, 'Stage 2', 'SITUATIONS VECUES EN STAGE DE DEUXIEME ANNEE DANS L''ORGANISATION'),
(3, 'TP', 'SITUATIONS VECUES EN FORMATION (TP)'),
(4, 'PPE', 'SITUATIONS VECUES EN FORMATION (PPE)');
(5, 'Alternance', 'SITUATIONS VECUES EN ALTERNANCE');

INSERT INTO `main_activities` (`id`, `name`) VALUES
(6, 'Production d''une solution logicielle et d''infrastructure'),
(7, 'Prise en charge d''incidents et de demandes d''assistance'),
(10, 'Élaboration de documents relatifs à la production'),
(11, 'Mise en place d’un dispositif de veille technologique');

INSERT INTO `activities` (`id`, `domain_id`, `nomenclature`, `label`, `lngutile`, `main_activity_id`, `deleted_at`) VALUES
(1, 1, 'A1.1.1', 'Analyse du cahier des charges d''un service à produire', 54, 6, NULL),
(2, 1, 'A1.1.2', 'Étude de l''impact de l''intégration d''un service sur le système informatique', 47, 6, NULL),
(3, 1, 'A1.1.3', 'Étude des exigences liées à la qualité attendue d''un service', 47, 6, NULL),
(4, 2, 'A1.2.1', 'Élaboration et présentation d''un dossier de choix de solution technique', 49, 6, NULL),
(5, 2, 'A1.2.2', 'Rédaction des spécifications techniques de la solution retenue (adaptation d''une solution existante ou réalisation d''une nouvelle solution)', 54, NULL, NULL),
(6, 2, 'A1.2.3', 'Évaluation des risques liés à l''utilisation d''un service', 57, NULL, NULL),
(7, 2, 'A1.2.4', 'Détermination des tests nécessaires à la validation d''un service', 51, NULL, NULL),
(8, 2, 'A1.2.5', 'Définition des niveaux d''habilitation associés à un service', 37, NULL, NULL),
(9, 3, 'A1.3.1', 'Test d''intégration et d''acceptation d''un service', 49, NULL, NULL),
(10, 3, 'A1.3.2', 'Définition des éléments nécessaires à la continuité d''un service', 51, NULL, NULL),
(11, 3, 'A1.3.3', 'Accompagnement de la mise en place d''un nouveau service', 56, NULL, NULL),
(12, 3, 'A1.3.4', 'Déploiement d''un service', 25, NULL, NULL),
(13, 4, 'A1.4.1', 'Participation à un projet', 25, 7, NULL),
(14, 4, 'A1.4.2', 'Évaluation des indicateurs de suivi d''un projet et justification des écarts', 47, 7, NULL),
(15, 4, 'A1.4.3', 'Gestion des ressources', 22, NULL, NULL),
(16, 5, 'A2.1.1', 'Accompagnement des utilisateurs dans la prise en main d''un service', 53, NULL, NULL),
(17, 5, 'A2.1.2', 'Évaluation et maintien de la qualité d''un service', 50, NULL, NULL),
(18, 6, 'A2.2.1', 'Suivi et résolution d''incidents', 32, 7, NULL),
(19, 6, 'A2.2.2', 'Suivi et réponse à des demandes d''assistance', 45, 7, NULL),
(20, 6, 'A2.2.3', 'Réponse à une interruption de service', 37, 7, NULL),
(21, 7, 'A2.3.1', 'Identification, qualification et évaluation d''un problème', 58, NULL, NULL),
(22, 7, 'A2.3.2', 'Proposition d''amélioration d''un service', 41, NULL, NULL),
(23, 8, 'A3.1.1', 'Proposition d''une solution d''infrastructure', 45, 10, NULL),
(24, 8, 'A3.1.2', 'Maquettage et prototypage d''une solution d''infrastructure', 58, 10, NULL),
(25, 8, 'A3.1.3', 'Prise en compte du niveau de sécurité nécessaire à une infrastructure', 48, NULL, NULL),
(26, 9, 'A3.2.1', 'Installation et configuration d''éléments d''infrastructure', 57, NULL, NULL),
(27, 9, 'A3.2.2', 'Remplacement ou mise à jour d''éléments défectueux ou obsolètes', 49, NULL, NULL),
(28, 9, 'A3.2.3', 'Mise à jour de la documentation technique d''une solution d''infrastructure', 41, NULL, NULL),
(29, 10, 'A3.3.1', 'Administration sur site ou à distance des éléments d''un réseau, de serveurs, de services et d''équipements terminaux', 50, NULL, NULL),
(30, 10, 'A3.3.2', 'Planification des sauvegardes et gestion des restaurations', 59, NULL, NULL),
(31, 10, 'A3.3.3', 'Gestion des identités et des habilitations', 42, NULL, NULL),
(32, 10, 'A3.3.4', 'Automatisation des tâches d''administration', 43, NULL, NULL),
(33, 10, 'A3.3.5', 'Gestion des indicateurs et des fichiers d''activité', 51, NULL, NULL),
(34, 11, 'A4.1.1', 'Proposition d''une solution applicative', 39, 10, NULL),
(35, 11, 'A4.1.2', 'Conception ou adaptation de l''interface utilisateur d''une solution applicative', 51, 10, NULL),
(36, 11, 'A4.1.3', 'Conception ou adaptation d''une base de données', 47, 10, NULL),
(37, 11, 'A4.1.4', 'Définition des caractéristiques d''une solution applicative', 59, NULL, NULL),
(38, 11, 'A4.1.5', 'Prototypage de composants logiciels', 35, NULL, NULL),
(39, 11, 'A4.1.6', 'Gestion d''environnements de développement et de test', 53, NULL, NULL),
(40, 11, 'A4.1.7', 'Développement, utilisation ou adaptation de composants logiciels', 54, NULL, NULL),
(41, 11, 'A4.1.8', 'Réalisation des tests nécessaires à la validation d''éléments adaptés ou développés', 49, NULL, NULL),
(42, 11, 'A4.1.9', 'Rédaction d''une documentation technique', 40, NULL, NULL),
(43, 11, 'A4.1.10', 'Rédaction d''une documentation d''utilisation', 45, NULL, NULL),
(44, 12, 'A4.2.1', 'Analyse et correction d''un dysfonctionnement, d''un problème de qualité de service ou de sécurité', 44, NULL, NULL),
(45, 12, 'A4.2.2', 'Adaptation d''une solution applicative aux évolutions de ses composants', 52, NULL, NULL),
(46, 12, 'A4.2.3', 'Réalisation des tests nécessaires à la mise en production d''éléments mis à jour', 57, NULL, NULL),
(47, 12, 'A4.2.4', 'Mise à jour d''une documentation technique', 42, NULL, NULL),
(48, 13, 'A5.1.1', 'Mise en place d''une gestion de configuration', 45, NULL, NULL),
(49, 13, 'A5.1.2', 'Recueil d''informations sur une configuration et ses éléments', 44, NULL, NULL),
(50, 13, 'A5.1.3', 'Suivi d''une configuration et de ses éléments', 45, NULL, NULL),
(51, 13, 'A5.1.4', 'Étude de propositions de contrat de service (client, fournisseur)', 43, NULL, NULL),
(52, 13, 'A5.1.5', 'Évaluation d''un élément de configuration ou d''une configuration', 40, NULL, NULL),
(53, 13, 'A5.1.6', 'Évaluation d''un investissement informatique', 44, NULL, NULL),
(54, 14, 'A5.2.1', 'Exploitation des référentiels, normes et standards adoptés par le prestataire informatique', 50, 11, NULL),
(55, 14, 'A5.2.2', 'Veille technologique', 20, 11, NULL),
(56, 14, 'A5.2.3', 'Repérage des compléments de formation ou d''auto-formation utiles à l''acquisition de nouvelles compétences', 37, 11, NULL),
(57, 14, 'A5.2.4', 'Étude d‘une technologie, d''un composant, d''un outil ou d''une méthode', 51, 11, NULL);

INSERT INTO `activity_category` (`activity_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(35, 4),
(36, 4),
(40, 4),
(41, 4),
(48, 5),
(49, 5),
(50, 5),
(51, 5),
(52, 5),
(53, 5),
(54, 5),
(55, 5),
(56, 5),
(57, 5),
(34, 8),
(35, 8),
(36, 8),
(37, 8),
(38, 8),
(39, 8),
(40, 8),
(41, 8),
(42, 8),
(43, 8),
(44, 8),
(45, 8),
(46, 8),
(47, 8),
(23, 9),
(24, 9),
(26, 9),
(30, 9);
